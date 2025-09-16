<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\FormPenilaianSatker;
use App\Models\Wilayah;
use App\Models\FormPenilaian;
use App\Models\User;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\PenilaianSoal;
use App\Models\PenilaianJawaban;
use App\Models\Pilihan;
use App\Models\PenilaianPilihan;
use App\Models\SkorKematangan;
use Illuminate\Http\JsonResponse;


class FormPenilaianSatkerController extends Controller
{
    //Helper untuk Mengatur Akses siapa aja yang boleh lihat dan tidak berdasarkan tingkatan admin
    private function visibleWilayahIds(): array
    {
        $user     = auth()->user();
        $roleName = $user->getRoleNames()->first();            // 'Admin', 'Admin Provinsi', 'Admin Kabupaten', dst
        $wilayahId= $user->profile->wilayah_id ?? null;

        // Admin Pusat → semua wilayah
        // if ($roleName === 'Admin') {
        //     return Wilayah::pluck('id')->all();
        // }

        // Admin Provinsi → provinsinya + semua kab/kota di bawahnya
        // if ($roleName === 'Admin Provinsi') {
        //     if (!$wilayahId) return [];
        //     $childIds = Wilayah::where('id_parent', $wilayahId)->pluck('id')->all();
        //     return array_merge([$wilayahId], $childIds);
        // }

        // Admin/Operator Kabupaten → hanya wilayahnya sendiri
        return $wilayahId ? [$wilayahId] : [];
    }

    public function index()
    {
        $wilayahUser = auth()->user()->profile->wilayah_id ?? null;
        $dataFormSatker = FormPenilaianSatker::with(['wilayah', 'formPenilaian'])
            ->where('wilayah_id', $wilayahUser)
            ->get();

        $totalFormSatker = $dataFormSatker->count();

        $activeFormSatker = FormPenilaianSatker::where('wilayah_id', $wilayahUser)
            ->whereRelation('formPenilaian', 'status', 1)
            ->count();

        $unActiveFormSatker = FormPenilaianSatker::where('wilayah_id', $wilayahUser)
            ->whereRelation('formPenilaian', 'status', 0)
            ->count();

        return view('siantik.penilaian.formPenilaianSatker', compact('dataFormSatker', 'totalFormSatker', 'activeFormSatker', 'unActiveFormSatker'));
    }

    public function create()
    {
        $wilayah = Wilayah::all();
        $formPenilaian = FormPenilaian::all();
        return view('form_penilaian_satkers.create', compact('wilayah', 'formPenilaian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'form_penilaian_id' => 'required|exists:form_penilaian,id',
        ]);

        FormPenilaianSatker::create($request->all());

        return redirect()->route('form-penilaian-satkers.index')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit(FormPenilaianSatker $formPenilaianSatker)
    {
        $wilayah = Wilayah::all();
        $formPenilaian = FormPenilaian::all();
        return view('form_penilaian_satkers.edit', compact('formPenilaianSatker', 'wilayah', 'formPenilaian'));
    }

    public function update(Request $request, FormPenilaianSatker $formPenilaianSatker)
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayah,id',
            'form_penilaian_id' => 'required|exists:form_penilaian,id',
        ]);

        $formPenilaianSatker->update($request->all());

        return redirect()->route('form-penilaian-satkers.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(FormPenilaianSatker $formPenilaianSatker)
    {
        $formPenilaianSatker->delete();
        return redirect()->route('form-penilaian-satkers.index')->with('success', 'Data berhasil dihapus.');
    }

    //Show Aspek
    public function show($id_formPenilaianSatker)
    {

        $userWilayahId = auth()->user()->profile->wilayah_id;

        // Ambil data FormPenilaianSatker sesuai wilayah
        $formPenilaianSatker = FormPenilaianSatker::with(['formPenilaian', 'formPenilaian.tahunSoal', 'penilaianSoals.soal'])
                ->withAvg('penilaianSoals as progres_avg', 'progres') 
                ->where('id', $id_formPenilaianSatker)
                ->where('wilayah_id', $userWilayahId)
                ->firstOrFail();

        // Ambil semua penilaian soal
        $penilaianSoals = $formPenilaianSatker->penilaianSoals;
        $namaForm = $formPenilaianSatker->formPenilaian->nama_form;

        //Persentasi
        $progress = (int) round($formPenilaianSatker->progres_avg ?? 0);

        return view('siantik.penilaian.penilaianSoal', [
            'dataFormPenilaian' => $formPenilaianSatker->formPenilaian,
            'id_formPenilaianSatker' => $id_formPenilaianSatker,
            'penilaianSoals' => $penilaianSoals,
            'progres' => $progress,
            'nama_form' => $namaForm
        ]);
    }

    //show Indikator
    public function showPenilaianJawaban(Request $request, $id_penilaianSoal)
    {
        if ($request->ajax()) {
            $userWilayahId = auth()->user()->profile->wilayah_id;

            // Pastikan penilaian_soal milik wilayah user
            $validSoal = PenilaianSoal::where('id', $id_penilaianSoal)
                ->whereHas('formPenilaianSatker', function ($q) use ($userWilayahId) {
                    $q->where('wilayah_id', $userWilayahId);
                })
                ->exists();

            if (!$validSoal) {
                abort(403, 'Akses ditolak');
            }

            $data = PenilaianJawaban::with(['jawaban'])
                ->where('id_penilaian_soal', $id_penilaianSoal);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('jawaban', fn($row) => $row->jawaban->jawaban ?? '-')
                ->addColumn('aksi', function($row) {
                    return view('siantik.penilaian._parsials.form-penilaian-jawaban', ['row' => $row]);
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        
        $soal = PenilaianSoal::with(['formPenilaianSatker', 'formPenilaianSatker.formPenilaian', 'soal'])
            ->findOrFail($id_penilaianSoal);

        // jika bukan request ajax, kembalikan view
        return view('siantik.penilaian.penilaianJawaban', [
            'id_penilaianSoal'        => $soal->id,
            'id_formPenilaianSatker'  => $soal->id_form_penilaian_satker,
            'nama_form' => $soal->formPenilaianSatker->formPenilaian->nama_form,
            'soal' => $soal->soal->soal,
        ]);
    }

    public function getFormPenilaianSatker(Request $request)
    {
        if ($request->ajax()) {
            $userWilayahId = auth()->user()->profile->wilayah_id;

            $data = FormPenilaianSatker::with(['wilayah', 'formPenilaian'])
                ->withAvg('penilaianSoals as progres_avg', 'progres') 
                ->where('wilayah_id', $userWilayahId)
                ->orderBy('id', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_wilayah', function($row){
                    return $row->wilayah->nama_wilayah ?? '-';
                })
                ->addColumn('nama_form', function($row){
                    return $row->formPenilaian->nama_form ?? '-';
                })
                ->addColumn('indeks_kematangan', function($row){
                    return $row->indeks_kematangan ?? '';
                })
                ->addColumn('predikat_kematangan', function($row){
                    $predikat = $row->predikat_kematangan ?? '-';
                
                    $colors = [
                        'Cukup (Initial)'        => 'warning',
                        'Baik (Repeatable)'         => 'info',
                        'Sangat Baik (Defined)'  => 'primary',
                        'Memuaskan (Optimized)'    => 'success',
                    ];
                
                    $color = $colors[$predikat] ?? 'secondary';
                
                    return '<span class="badge badge-light-' . $color . ' fw-bold">' . e($predikat) . '</span>';
                })
                ->addColumn('batas_waktu', function($row){
                    return $row->formPenilaian->batas_waktu ?? '-';
                })
                ->editColumn('status', function ($row) {
                    return $row->formPenilaian->status ? '<span class="badge badge-light-success">Aktif</span>' : '<span class="badge badge-light-info">Tidak Aktif</span>';
                })
                ->editColumn('kemajuan', function ($row) {
                    // pastikan controller sudah withAvg('penilaianSoals as progres_avg', 'progres')
                    $progress = (int) round($row->progres_avg ?? 0);
                    $progress = max(0, min(100, $progress)); // clamp 0..100

                    // tentukan warna
                    if ($progress >= 100) {
                        $bar = 'success';
                    } elseif ($progress >= 80) {
                        $bar = 'info';
                    } elseif ($progress >= 50) {
                        $bar = 'warning';
                    } else {
                        $bar = 'danger';
                    }

                    $label = $progress . '%' . ($progress >= 100 ? ' Selesai' : '');

                    return '
                        <div class="d-flex flex-stack mb-2">
                            <span class="text-dark fw-bold fs-7">' . $label . '</span>
                        </div>
                        <div class="progress h-6px w-100 bg-light-' . $bar . '">
                            <div class="progress-bar bg-' . $bar . '"
                                role="progressbar"
                                style="width: ' . $progress . '%;"
                                aria-valuenow="' . $progress . '"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    ';
                })
                ->addColumn('aksi', function ($row) {
                    $showUrl = route('formPenilaianSatker.show', $row->id);
                    $generate = route('formPenilaianSatker.generateSoalJawaban', $row->id);
                    $kunci = route('formPenilaianSatker.kunci', $row->id);
                    return view('siantik.penilaian._parsials.form-penilaian-satker-aksi', compact('showUrl', 'generate', 'kunci', 'row'));
                })
                ->rawColumns(['aksi', 'status', 'nama_wilayah', 'nama_form', 'kemajuan', 'predikat_kematangan'])
                ->make(true);
        }
    }


    public function getPenilaianSoal($id_formPenilaianSatker)
    {
        $data = PenilaianSoal::with(['formPenilaianSatker', 'soal'])
            ->where('id_form_penilaian_satker', $id_formPenilaianSatker)
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('id', fn($row) => $row->id)
            ->addColumn('soal', function($row) {
                return $row->soal->soal ?? '-';
            })
            // ->addColumn('nilai', function($row) {
            //     $nilai = $row->nilai ?? 0;
            //     $nilaiSoal = $row->soal->nilai_soal ?? 0;
            //     return "<span class='fw-bold text-primary'>{$nilai}</span> / <span class='text-muted'>{$nilaiSoal}</span>";
            // })
            ->editColumn('progres', function ($row) {
                $progress = $row->progres ?? 0;
                $progress = max(0, min(100, $progress)); // clamp 0..100

                    // tentukan warna
                    if ($progress >= 100) {
                        $bar = 'success';
                    } elseif ($progress >= 80) {
                        $bar = 'info';
                    } elseif ($progress >= 50) {
                        $bar = 'warning';
                    } else {
                        $bar = 'danger';
                    }

                    $label = $progress . '%' . ($progress >= 100 ? ' Selesai' : '');

                    return '
                        <div class="d-flex flex-stack mb-2">
                            <span class="text-dark fw-bold fs-7">' . $label . '</span>
                        </div>
                        <div class="progress h-6px w-100 bg-light-' . $bar . '">
                            <div class="progress-bar bg-' . $bar . '"
                                role="progressbar"
                                style="width: ' . $progress . '%;"
                                aria-valuenow="' . $progress . '"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    ';
            })
            ->addColumn('aksi', function($row) {
                return view('siantik.penilaian._parsials.form-penilaian-soal', ['row' => $row]);
            })
            ->rawColumns(['aksi', 'progres'])
            ->make(true);
    }

    public function pagePenilaianSoal($formPs)
    {
        $userWilayahId = auth()->user()->profile->wilayah_id;

        $formPenilaianSatker = FormPenilaianSatker::with(['formPenilaian', 'formPenilaian.tahunSoal', 'penilaianSoals.soal'])
                ->withAvg('penilaianSoals as progres_avg', 'progres') 
                ->where('id', $formPs)
                ->where('wilayah_id', $userWilayahId)
                ->firstOrFail();

        //Persentasi
        $progress = (int) round($formPenilaianSatker->progres_avg ?? 0);
        $namaForm = $formPenilaianSatker->formPenilaian->nama_form;

        return view('siantik.penilaian.penilaianSoal', [
            'id_formPenilaianSatker' => (int)$formPs,
            'progres' => $progress,
            'nama_form' => $namaForm
        ]);
    }


    public function getJawaban($id_penilaian_soal)
    {

        $data = PenilaianJawaban::with('jawaban', 'penilaianPilihans.pilihan', 'penilaianSoal.formPenilaianSatker')
            ->where('id_penilaian_soal', $id_penilaian_soal);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('jawaban', fn($row) => $row->jawaban->jawaban ?? '-')
            // ->editColumn('bobot_jawaban', fn($row) => $row->bobot_jawaban)
            ->editColumn('aksi', function ($row) {
                    $keterangans = $row->penilaianPilihans->firstWhere('is_select', 1);

                    if ($keterangans && $keterangans->pilihan) {
                        return '<span class="badge badge-light-success">' . e($keterangans->pilihan->keterangan) . '</span>';
                    }
                    return '<span class="text-muted">Belum dinilai</span>'; 
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function getPilihan($id_penilaian_jawaban)
    {
        $data = PenilaianPilihan::with('pilihan')
            ->where('id_penilaian_jawaban', $id_penilaian_jawaban);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('urutan', fn($row) => $row->pilihan->urutan ?? '-')
            ->editColumn('keterangan', fn($row) => $row->pilihan->keterangan ?? '-')
            ->editColumn('deskripsi', fn($row) => $row->pilihan->deskripsi ?? '-')
            ->editColumn('aksi', function ($row) {
                return '
                    <div class="text-center">
                        <input type="radio" name="pilihan_' . $row->id_penilaian_jawaban . '" value="' . $row->id_pilihan . '" ' . ($row->is_select ? 'checked' : '') . '>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function getModalJawaban($id_penilaianSoal, $idJawaban)
    {
        // Ambil data penilaian soal (beserta soal aslinya)
        $soals = PenilaianSoal::with('soal', 'formPenilaianSatker')
            ->where('id', $id_penilaianSoal)
            ->firstOrFail();

        // Ambil data jawaban spesifik dari penilaian_jawabans
        $jawabans = PenilaianJawaban::with(['penilaianPilihans.pilihan'])
            ->where('id_penilaian_soal', $id_penilaianSoal)
            ->where('id_jawaban', $idJawaban)
            ->firstOrFail();

        //Mengambil pilihan
        $pilihans = PenilaianJawaban::with(['penilaianPilihans.pilihan'])
            ->where('id_penilaian_soal', $id_penilaianSoal)
            ->where('id_jawaban', $idJawaban)
            ->get();

        return view('siantik.penilaian.modal.modal-jawaban', compact('jawabans', 'soals', 'pilihans', 'id_penilaianSoal'));
    }

    public function simpanJawaban(Request $request)
    {
        //Jika terlunci jangan disimpan
        // $form = FormPenilaianSatker::findOrFail($request->id_form_penilaian_satker);
        // if ($form->is_locked) {
        //     return back()->with('warning', 'Data sudah dikunci dan tidak bisa diubah.');
        // }

        $request->validate([
            'id_penilaian_soal' => 'required|exists:penilaian_soals,id',
            'id_penilaian_jawaban' => 'required|exists:penilaian_jawabans,id',
            'id_penilaian_pilihan' => 'required|exists:penilaian_pilihans,id',
            'keterangan_pilihan' => 'required|string|min:50|max:500',
            'link_pendukung' => 'nullable|url',
            'id_jawaban' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Reset is_select semua pilihan pada jawaban ini
            PenilaianPilihan::where('id_penilaian_jawaban', $request->id_penilaian_jawaban)
                ->update(['is_select' => 0]);

            // Tandai pilihan yang dipilih
            PenilaianPilihan::where('id', $request->id_penilaian_pilihan)
                ->update(['is_select' => 1]);

            //Mengambil nilai bobot_jawaban jawabans
            // Ambil data pilihan dan jawaban
            $pilihan = PenilaianPilihan::findOrFail($request->id_penilaian_pilihan);
            $jawaban = PenilaianJawaban::findOrFail($request->id_penilaian_jawaban);
            $tingkat = $pilihan->pilihan->tingkat;
            $bobotJawaban = $jawaban->jawaban->bobot_jawaban;
            $hasilBobot = $tingkat * $bobotJawaban; //Perhitungan Rumus
            
            // Simpan keterangan dan link di jawaban
            PenilaianJawaban::where('id', $request->id_penilaian_jawaban)
                ->update([
                    'keterangan_pilihan' => $request->keterangan_pilihan,
                    'link_pendukung' => $request->link_pendukung,
                    'bobot_jawaban' => $hasilBobot,
                ]);

            //Hitung dan simpan total nilai = bobot_jawaban
            $totalNilai = PenilaianJawaban::where('id_penilaian_soal', $request->id_penilaian_soal)
                ->sum('bobot_jawaban');

            //simpan Progres
            $totalJawaban = PenilaianJawaban::where('id_penilaian_soal', $request->id_penilaian_soal)->count();
            $jawabanBernilai = PenilaianJawaban::where('id_penilaian_soal', $request->id_penilaian_soal)
                            ->where('bobot_jawaban', '>', 0)
                            ->count();
            $progres = $totalJawaban > 0 ? round(($jawabanBernilai / $totalJawaban) * 100, 2) : 0;

            PenilaianSoal::where('id', $request->id_penilaian_soal)
                ->update([
                    'nilai' => $totalNilai,
                    'progres' => $progres,
                ]);

            DB::commit();

            return back()->with('success', 'Penilaian indikator berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('warning', 'Generate gagal: ' . $e->getMessage());
        }
    }


    public function generateSoalJawaban($id)
    {
        
        $formSatker = FormPenilaianSatker::with('formPenilaian.tahunSoal.soals')->findOrFail($id);
        
        // Cek apakah user yang login berhak mengakses berdasarkan wilayah
        $userWilayahId = auth()->user()->profile->wilayah_id;
        if ($formSatker->wilayah_id != $userWilayahId) {
            return back()->with('error', 'Anda tidak memiliki akses untuk data ini.');
        }
        
        // Cek apakah sudah digenerate sebelumnya
        if ($formSatker->is_generate) {
            return back()->with('warning', 'Data sudah digenerate sebelumnya.');
        }

        DB::beginTransaction();
        
        try {
            $soals = $formSatker->formPenilaian->tahunSoal->soals;
            
            // Simpan ke tabel penilaian_soals dan penilaian_jawabans
            foreach ($soals as $soal) {
                // Insert ke penilaian_soals
                $penilaianSoal = PenilaianSoal::create([
                    'id_form_penilaian_satker' => $formSatker->id,
                    'id_soal' => $soal->id,
                    'nilai' => 0,
                ]);
                
                // Ambil semua jawaban dari soal ini
                $jawabans = Jawaban::where('id_soal', $soal->id)->get();
                foreach ($jawabans as $jawaban) {
                    $penilaianJawaban = PenilaianJawaban::create([
                        'id_penilaian_soal' => $penilaianSoal->id,
                        'id_soal' => $soal->id,
                        'id_jawaban' => $jawaban->id,
                        'bobot_jawaban' => 0,
                        'is_select' => 0,
                    ]);

                    $pilihans = Pilihan::where('id_jawaban', $jawaban->id)->get();
                    foreach ($pilihans as $pilihan) {
                        PenilaianPilihan::create([
                            'id_penilaian_jawaban' => $penilaianJawaban->id,
                            'id_pilihan' => $pilihan->id,
                            'is_select' => 0,
                            'nilai' => 0,
                        ]);
                    }
                }
            }

            // Update status is_generate
            $formSatker->update(['is_generate' => 1]);

            DB::commit();
            return back()->with('success', 'Generate berhasil dilakukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Generate gagal: ' . $e->getMessage());
        }
    }

    public function kunciForm($id)
    {
        $cek = FormPenilaianSatker::with(['formPenilaian'])
                ->withAvg('penilaianSoals as progres_avg', 'progres')
                ->where('id', $id)
                ->firstOrFail();

        $form = FormPenilaianSatker::findOrFail($id);


        DB::beginTransaction();

        try {
            if($cek->progres_avg == 100){ //Settimg untuk kondisi 100%

                $totalNilai = (float) \App\Models\PenilaianSoal::where('id_form_penilaian_satker', $form->id)->sum('nilai');
                $indeksKematangan = $totalNilai/5;

                $skor = SkorKematangan::query()
                    ->where('min', '<=', $indeksKematangan)
                    ->where(function ($q) use ($indeksKematangan) {
                        $q->where('maks', '>=', $indeksKematangan)
                        ->orWhereNull('maks');
                    })
                    ->orderByDesc('min') // kalau overlap, ambil rentang dengan min terbesar
                    ->first();

                $predikatKematangan = $skor->status ?? '-';

                $form->update([
                        'indeks_kematangan' => $indeksKematangan,
                        'predikat_kematangan' => $predikatKematangan,
                    ]);

                // dd($form);
            
                // Pastikan hanya boleh mengunci jika belum dikunci
                if (!$form->is_locked) {
                    $form->is_locked = true;
                    $form->locked_at = now();
                    $form->save();

                    DB::commit();
                    return redirect()->back()->with('success', 'Form berhasil dikunci. Terimakasih sudah menyelesaikan penilaian kematangan TIK.');
                } else {
                    // DB::commit();
                    return redirect()->back()->with('warning', 'Form sudah dikunci sebelumnya.');
                }
            } else {
                DB::commit();
                return redirect()->back()->with('warning', 'Pengisian belum 100%.');
            }
            // dd($cek->progres_avg);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('warning', 'Gagal kunci dan simpan : ' . $e->getMessage());
        }    
    }

    //Memunculkan menu Home
    public function showHome()
    {
        return view('siantik.dashboard.dashboard'); 
    }

    //Memunculkan menu Home
    public function showStatistik()
    {
        return view('siantik.dashboard.statistik'); 
    }

    //Memunculkan penilaian di Dashboard User
    public function listFormSatker()
    {
        // --- ambil info user + profil + tingkat (eager load)
        $user = auth()->user()->load([
            'profile:id,user_id,satker,tingkat_id,wilayah_id',
            'profile.tingkat:id,nama',
        ]);
        $userSatker      = $user->profile->satker ?? null;               // kolom "satker" dari user_profiles
        $userTingkatNama = $user->profile->tingkat->nama ?? null;        // nama tingkat (join ke tabel tingkat)
        $userWilayahId   = $user->profile->wilayah_id ?? null;

        $visibleIds = $this->visibleWilayahIds(); //Helper

        // Dropdown: unik per form_penilaian_id dalam cakupan wilayah user
        $satkerForms = \App\Models\FormPenilaianSatker::query()
            ->whereIn('wilayah_id', $visibleIds)
            ->select('form_penilaian_id')
            ->with(['formPenilaian:id,nama_form,tahun,keterangan'])
            ->distinct()
            ->get()
            ->sortByDesc(fn($row) => $row->formPenilaian->tahun)
            ->values();

        // Map latest satker per form (dipakai data-satker di <option>)
        $latestByForm = \App\Models\FormPenilaianSatker::query()
            ->whereIn('wilayah_id', $visibleIds)
            ->selectRaw('form_penilaian_id, MAX(id) as last_id')
            ->groupBy('form_penilaian_id')
            ->pluck('last_id', 'form_penilaian_id');

        // Default (terbaru di wilayah yang terlihat)
        $defaultFormSatkerId = \App\Models\FormPenilaianSatker::whereIn('wilayah_id', $visibleIds)->max('id');
        // $defaultFormSatkerId = (float) $visibleIds;
        // dd($defaultFormSatkerId);

        // dd($FormSatker);
        // Nilai & predikat untuk default (kalau ada)
        $indeksKematangan = 0.0; 
        $predikatKematangan = '-';
        if ($defaultFormSatkerId) {
            $indeksKematangan = (float) \App\Models\PenilaianSoal::where('id_form_penilaian_satker', $defaultFormSatkerId)->sum('nilai');
            $predikatKematangan =
                $indeksKematangan <= 1 ? 'Buruk' :
                ($indeksKematangan <= 2 ? 'Cukup Buruk' :
                ($indeksKematangan <= 3 ? 'Baik' :
                ($indeksKematangan <= 4 ? 'Cukup Baik' : 'Sangat Baikkkkkkkk')));
        }

        return view('siantik.dashboard.home', compact('satkerForms','latestByForm','defaultFormSatkerId','indeksKematangan','predikatKematangan'))
            ->with([
                'defaultFormSatker' => $defaultFormSatkerId,
                'userSatker' => $userSatker,
                'userTingkatNama' => $userTingkatNama,
            ]);
    }

    // ---------- API: Radar Chart ----------
    public function chartData(FormPenilaianSatker $formSatker)
    {
        $visible = $this->visibleWilayahIds();
        abort_unless(in_array($formSatker->wilayah_id, $visible, true), 403);

        $rows = PenilaianSoal::query()
            ->with(['soal:id,soal,nilai_target'])
            ->where('id_form_penilaian_satker', $formSatker->id)
            ->select('id_soal','nilai')
            ->orderBy('id_soal')
            ->get();

        $labels = [];
        $indeks = [];
        $target = [];

        if($formSatker->is_locked){
            foreach ($rows as $r) {
                $labels[] = $r->soal->soal ?? ('Aspek '.$r->id_soal);
                $indeks[] = (float) $r->nilai;
                $target[] = (float) ($r->soal->nilai_target ?? 0);
            }
        }

        return response()->json(compact('labels','indeks','target'));
    }

    // ---------- API: Ringkasan Indeks & Predikat ----------
    public function summaryData(FormPenilaianSatker $formSatker): JsonResponse
    {
        $visible = $this->visibleWilayahIds();
        abort_unless(in_array($formSatker->wilayah_id, $visible, true), 403);

        if($formSatker->is_locked){
            $indeksKematangan = $formSatker->indeks_kematangan;
            $predikat = $formSatker->predikat_kematangan;
        } else{
            $indeksKematangan = '';
            $predikat = '';
        }

        return response()->json([
            'indeks'   => round($indeksKematangan, 1),
            'predikat' => $predikat,
        ]);
    }

    // ---------- API: Tabel Soal (Aspek) ----------
    public function tableSoalData(FormPenilaianSatker $formSatker): JsonResponse
    {
        $visible = $this->visibleWilayahIds();
        abort_unless(in_array($formSatker->wilayah_id, $visible, true), 403);

        $formSatker->load('formPenilaian:id,id_tahun_soal');
        $tahunId = $formSatker->formPenilaian->id_tahun_soal;

        if($formSatker->is_locked){
            $rows = Soal::query()
                ->leftJoin('penilaian_soals as ps', function ($q) use ($formSatker) {
                    $q->on('ps.id_soal', '=', 'soal.id')
                    ->where('ps.id_form_penilaian_satker', $formSatker->id);
                })
                ->where('soal.id_tahun_soal', $tahunId)
                ->orderBy('soal.id')
                ->get([
                    'soal.id as id_soal',
                    'soal.soal',
                    DB::raw('COALESCE(ps.nilai, 0) as nilai'),
                ]);
        } else{
            $rows = '';
        }

        return response()->json($rows);
    }

    // ---------- API: Tabel Jawaban (Indikator) ----------
    public function jawabanData(FormPenilaianSatker $formSatker): JsonResponse
    {
        $visible = $this->visibleWilayahIds();
        abort_unless(in_array($formSatker->wilayah_id, $visible, true), 403);

        if($formSatker->is_locked){
            $rows = DB::table('penilaian_soals as ps')
                ->join('soal as s', 's.id', '=', 'ps.id_soal')
                ->join('jawabans as j', 'j.id_soal', '=', 's.id')
                ->leftJoin('penilaian_jawabans as pj', function ($q) {
                    $q->on('pj.id_penilaian_soal', '=', 'ps.id')
                    ->on('pj.id_jawaban', '=', 'j.id');
                })
                ->where('ps.id_form_penilaian_satker', $formSatker->id)
                ->orderBy('j.id_soal')
                ->orderBy('j.id')
                ->get([
                    'j.id as id_jawaban',
                    'j.jawaban',
                    'pj.bobot_jawaban',
                ]);
        }  else{
                $rows = '';
            }

        return response()->json($rows);
    }

}
