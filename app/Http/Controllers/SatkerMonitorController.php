<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FormPenilaianSatker;
use App\Models\PenilaianSoal;
use App\Models\PenilaianJawaban;
use App\Models\PenilaianPilihan;
use App\Models\Wilayah;
use App\Models\SkorKematangan;

class SatkerMonitorController extends Controller
{
    /** Admin pusat boleh melihat SEMUA wilayah. Ubah role sesuai aplikasi. */
    private function isAdminPusat(): bool
    {
        $u = auth()->user();
        if (!$u) return false;

        // Jika pakai Spatie Permission:
        if (method_exists($u, 'hasAnyRole')) {
            return $u->hasAnyRole(['Admin', 'admin-pusat', 'super-admin']);
        }

        // Fallback kalau tak pakai Spatie
        return (bool) ($u->is_admin ?? false);
    }

    /**
     * Daftar wilayah yang boleh dilihat user.
     * - return null  => tidak dibatasi (admin pusat)
     * - return array => dibatasi ke wilayah pengguna
     */
    private function visibleWilayahIds(): ?array
    {
        if ($this->isAdminPusat()) {
            return null; // lihat semua
        }

        $wilayahId = auth()->user()->profile->wilayah_id ?? null;
        return $wilayahId ? [$wilayahId] : [0]; // [0] agar tak mengembalikan semua bila null
    }


    private function canSee(FormPenilaianSatker $formSatker): bool
    {
        $visible = $this->visibleWilayahIds();   // null = admin pusat (boleh semua)
        return $visible === null || in_array($formSatker->wilayah_id, $visible, true);
    }


    /* ===========================
     *  VIEW LIST + FILTER
     * =========================== */

    public function index(Request $request)
    {
        $visible = $this->visibleWilayahIds();

        // Dropdown FORM (unik per form_penilaian_id)
        $forms = FormPenilaianSatker::query()
            ->when($visible !== null, fn ($q) => $q->whereIn('wilayah_id', $visible))
            ->select('form_penilaian_id')
            ->with(['formPenilaian:id,nama_form,tahun,keterangan,status'])
            ->distinct()
            ->orderByDesc('form_penilaian_id')
            ->get();

        $jumlahSatker = Wilayah::count();
        $jumlahProvinsi = Wilayah::where('tingkat_wilayah', 1)->count();
        $jumlahKabKota = Wilayah::where('tingkat_wilayah', 2)->count();

        // Dropdown WILAYAH
        $wilayahList = Wilayah::select('id','nama_wilayah')
            ->when($visible !== null, fn ($q) => $q->whereIn('id', $visible))
            ->orderBy('nama_wilayah')
            ->get();

        $wilayahProv = Wilayah::select('id','nama_wilayah', 'kode_pro', 'kode_wilayah')
            ->when($visible !== null, fn ($q) => $q->whereIn('id', $visible))
            ->where([
                ['tingkat_wilayah', '=', 1], ['keterangan', '=', null],
            ])
            ->orderBy('kode_wilayah', 'asc')
            ->get();

        // Default: pilih form yang status=1 (aktif) kalau ada; kalau tidak, ambil yang terbaru
        $defaultForm = $forms->filter(fn ($f) => (int)($f->formPenilaian->status ?? 0) === 1)->first();
        $defaultFormId = optional($defaultForm)->form_penilaian_id
            ?? optional($forms->sortByDesc(fn ($x) => (int)($x->formPenilaian->tahun ?? 0))->first())->form_penilaian_id;

        return view('siantik.dashboard.list-satker', 
                compact('forms','wilayahList','defaultFormId', 'jumlahSatker', 'jumlahProvinsi', 'jumlahKabKota', 'wilayahProv'));
    }

    /* ===========================
     *  JSON UNTUK DATATABLES
     * =========================== */

    public function data(Request $request)
    {
        $visible = $this->visibleWilayahIds();

        $query = FormPenilaianSatker::query()
            ->select('form_penilaian_satkers.*')
            ->withAvg('penilaianSoals as progres_avg','progres')
            ->when($visible !== null, fn ($q) => $q->whereIn('wilayah_id', $visible))
            ->when($request->filled('form_id'),    fn ($q) => $q->where('form_penilaian_id', (int) $request->input('form_id')))
            ->when($request->filled('wilayah_id'), fn ($q) => $q->where('wilayah_id', (int) $request->input('wilayah_id')))
            ->when($request->filled('status'), function ($q) use ($request) {
                $s = $request->input('status');
                if ($s === 'Selesai') $q->where('is_locked', 1);
                if ($s === 'Proses')    $q->where('is_locked', 0);
            })
            ->when($request->filled('tingkat_wilayah'), function ($q) use ($request) {
                $tingkat = (int) $request->input('tingkat_wilayah');
                $q->whereHas('wilayah', fn($w) => $w->where('tingkat_wilayah', $tingkat));
            })
            ->when($request->filled('kode_pro'), function ($q) use ($request) {
                $kodePro = $request->input('kode_pro');
                $q->whereHas('wilayah', fn($w) => $w->where('kode_pro', $kodePro));
            })
            ->with([
                'wilayah:id,nama_wilayah,tingkat_wilayah,satker',
                'wilayah.userProfiles:id,wilayah_id,satker,tingkat_id',
                'wilayah.userProfiles.tingkat:id,nama',
                'formPenilaian:id,nama_form,tahun,status',
            ])
            // ->select('form_penilaian_satkers.*')
            ->orderByDesc('id');
        
        $rows = $query->get()->map(function ($row) {
            // Ambil SATKER & TINGKAT spesifik: pakai profil pertama di wilayah tsb
            $profile     = $row->wilayah->userProfiles->first();
            $satkerNama  = $profile?->satker ?? '-';
            $tingkatNama = $profile?->tingkat?->nama ?? '-';


            // Sudah disimpan di tabel form_penilaian_satkers
            $i = (float) ($row->indeks_kematangan ?? 0);

            if($row->indeks_kematangan == 0){
                $predikat = '-';
            } else {
                $nilaiPredikat = $row->predikat_kematangan
                    ?? ($i <= 1 ? 'Cukup (Initial)'
                    : ($i <= 2 ? 'Baik (Repeatable)'
                    : ($i <= 3 ? 'Sangat Baik (Defined)'
                    : ($i <= 4 ? 'Cukup Baik' : 'Sangat Baik'))));

                $colors = [
                    'Cukup (Initial)'        => 'warning',
                    'Baik (Repeatable)'         => 'info',
                    'Sangat Baik (Defined)'  => 'primary',
                    'Memuaskan (Optimized)'    => 'success',
                ];
            
                $color = $colors[$nilaiPredikat] ?? 'secondary';
            
                $predikat = '<span class="badge badge-light-' . $color . ' fw-bold">' . e($nilaiPredikat) . '</span>';
            }

            $wilayahKode = $row->wilayah->id ?? $row->wilayah_id;

            $progres = (int) round($row->progres_avg ?? 0);
            $progres = max(0, min(100, $progres));                     // clamp
            $label   = number_format($progres, 0) . '%';

            $bar = match (true) {
                $progres >= 80 => 'success',
                $progres >= 60 => 'primary',
                $progres >= 40 => 'warning',
                $progres >  0  => 'danger',
                default         => 'gray-600',
            };

            $kemajuanHtml = '
                <div class="d-flex flex-stack mb-2">
                    <span class="text-'.$bar.' fw-bold fs-8">'.$label.'</span>
                </div>
                <div class="progress h-6px w-100 bg-light-'.$bar.'">
                    <div class="progress-bar bg-'.$bar.'" role="progressbar"
                        style="width: '.$progres.'%;"
                        aria-valuenow="'.$progres.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            ';

            return [
                'id'                 => $row->id,
                'kemajuan'           => $kemajuanHtml,
                'wilayah'            => $row->wilayah->nama_wilayah ?? '-',
                'tingkat'            => $tingkatNama,
                'satker'             => $row->wilayah->satker ?? '-',
                'form'               => $row->formPenilaian->nama_form ?? '-',
                'tahun'              => $row->formPenilaian->tahun ?? '-',
                'indeks_kematangan'  => number_format($i, 1),
                'predikat'           => $predikat,
                'status'             => $row->is_locked ? 'Selesai' : 'Proses',
                'aksi'               => view('siantik.dashboard._partials.aksi-list', ['row' => $row])->render(),
                'wilayah_sort'       => $wilayahKode,
            ];
        });

        return response()->json(['data' => $rows]);
    }

    public function show(FormPenilaianSatker $formSatker)
    {
        // muat relasi yang dibutuhkan
        $formSatker->load([
            'formPenilaian:id,nama_form,tahun,keterangan,id_tahun_soal',
            'wilayah:id,nama_wilayah',
            'wilayah.userProfiles:id,wilayah_id,satker,tingkat_id',
            'wilayah.userProfiles.tingkat:id,nama',
            'formPenilaian.tahunSoal.profillings',
            'penilaianProfillings.pertanyaan',
        ]);

        // ambil 1 profil yang mewakili satker pada wilayah tsb
        $profile = $formSatker->wilayah->userProfiles->first();

        // fallback aman jika belum ada user_profiles untuk wilayah tsb
        if (!$profile) {
            $profile = UserProfile::with('tingkat:id,nama')
                ->where('wilayah_id', $formSatker->wilayah_id)
                ->latest('id')
                ->first();
        }

        $instansiNama   = $profile->satker
            ?? ($formSatker->wilayah->nama_wilayah ?? '-');      // tampilkan nama satker, fallback ke nama wilayah
        $tingkatNama    = $profile?->tingkat?->nama ?? '-';

        // nilai & predikat ambil dari kolom yang sudah disimpan di form_penilaian_satkers
        $indeksKematangan   = (float) ($formSatker->indeks_kematangan ?? 0);
    
        // dd($predikatKematangan);
        if($indeksKematangan == 0){
            $predikatKematangan = '-';
        } else {
            $predikatKematangan = $formSatker->predikat_kematangan ?? '-';
        }

        if($formSatker->is_locked){
            $info = 'Selesai';
        } else {
            $info = 'Proses';
        }


        //Data Profilling
        $profilPertanyaans = [];
        $profilJawabanMap = [];
        $profilPertanyaans = $formSatker->formPenilaian->tahunSoal->profillings ?? collect();
        $profilJawabanMap  = $formSatker->penilaianProfillings->keyBy('id_pertanyaan_profilling') ?? collect();
        

        // kirim ke blade detail (yang mirip dashboard, tanpa dropdown/progress)
        return view('siantik.dashboard.view-detail-satker', [
            'formSatker'          => $formSatker,
            'instansiNama'        => $instansiNama,
            'tingkatNama'         => $tingkatNama,
            'indeksKematangan'    => $indeksKematangan,
            'predikatKematangan'  => $predikatKematangan,
            'waktuSubmit'         => $info,
            'defaultFormSatker'   => $formSatker->id,
            
            'profilPertanyaans'    => $profilPertanyaans,
            'profilJawabanMap'     => $profilJawabanMap,
        ]);
    }

    /** Radar chart */
    public function chartData(FormPenilaianSatker $formSatker)
    {
        abort_unless($this->canSee($formSatker), 403);

        $rows = PenilaianSoal::with(['soal:id,soal,nilai_target'])
            ->where('id_form_penilaian_satker', $formSatker->id)
            ->orderBy('id_soal')
            ->get(['id_soal','nilai']);

        $labels = []; $indeks = []; $target = [];
        foreach ($rows as $r) {
            $labels[] = $r->soal->soal ?? ('Aspek '.$r->id_soal);
            $indeks[] = (float) $r->nilai;
            $target[] = (float) ($r->soal->nilai_target ?? 0);
        }

        return response()->json(compact('labels','indeks','target'));
    }

    /** Tabel aspek (soal) */
    public function soalData(FormPenilaianSatker $formSatker)
    {
        // pastikan relasi tahun dimuat (sesuaikan nama kolomnya!)
        $formSatker->load('formPenilaian:id,id_tahun_soal');
        $tahunId = $formSatker->formPenilaian->id_tahun_soal ?? null;

        // Query dasar: LEFT JOIN semua soal dengan nilai penilaian_soals (jika ada) untuk form satker ini
        $q = DB::table('soal as s')
            ->leftJoin('penilaian_soals as ps', function ($join) use ($formSatker) {
                $join->on('ps.id_soal', '=', 's.id')
                    ->where('ps.id_form_penilaian_satker', $formSatker->id);
            })
            ->select([
                's.id as id_soal',
                's.soal',
                DB::raw('COALESCE(ps.nilai, 0) as nilai'),
            ])
            ->orderBy('s.id');

        // Jalur 1: filter berdasarkan tahun jika tersedia
        if (!empty($tahunId)) {
            $q->where('s.id_tahun_soal', $tahunId);
        } else {
            $q->whereIn('s.id', function ($sub) use ($formSatker) {
                $sub->from('penilaian_soals')
                    ->select('id_soal')
                    ->where('id_form_penilaian_satker', $formSatker->id);
            });
        }

        $rows = $q->get();

        return response()->json($rows);
    }

    /** Tabel indikator (jawaban) */
    public function jawabanData(FormPenilaianSatker $formSatker)
    {
        abort_unless($this->canSee($formSatker), 403);

        $rows = DB::table('penilaian_soals as ps')
            ->join('soal as s', 's.id', '=', 'ps.id_soal')
            ->join('jawabans as j', 'j.id_soal', '=', 's.id')
            ->leftJoin('penilaian_jawabans as pj', function ($q) {
                $q->on('pj.id_penilaian_soal','=','ps.id')
                ->on('pj.id_jawaban','=','j.id');
            })
            ->where('ps.id_form_penilaian_satker', $formSatker->id)
            ->orderBy('j.id_soal')
            ->orderBy('j.id')
            ->get([
                DB::raw('COALESCE(pj.id, 0) as id_penilaian_jawaban'),
                'j.id as id_jawaban',
                'j.jawaban',
                'pj.bobot_jawaban',
            ]);

        return response()->json($rows);
    }

    public function getModalJawaban($id_penilaian_jawaban, $id_jawaban)
    {
        if ($id_penilaian_jawaban == 0) {
            return response("<div class='p-5 text-danger'>Belum ada penilaian untuk jawaban ini</div>", 200);
        }

        $jawabans = PenilaianJawaban::with([
                'jawaban',
                'penilaianSoal.soal',
                'penilaianPilihans.pilihan'
            ])
            ->find($id_penilaian_jawaban);

        if (!$jawabans) {
            return response("<div class='p-5 text-danger'>Jawaban tidak ditemukan</div>", 404);
        }

        $soals = $jawabans->penilaianSoal ?? null;
        $pilihans = $jawabans->penilaianPilihans ?? [];

        return view('siantik.dashboard.view-modal-jawaban', compact('jawabans', 'soals', 'pilihans'));
    }

    public function unlockSatker(float $id)
    {

        $formSatker = FormPenilaianSatker::findOrFail($id);

        $formSatker->update([
            'is_locked' => 0 
        ]);

        // dd($formSatker);

        return redirect()->back()->with('success', 'Form berhasil dibuka dan dapat di edit kembali');
    }
}