<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunSoal;
use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\PertanyaanProfilling;
use App\Models\DataKeahlian;
use App\Models\KebutuhanPelatihan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('siantik.penilaian.tahun-soal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siantik.penilaian.addTahunSoal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        TahunSoal::create([
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('soal.index')->with('success', 'Tahun Soal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_tahun_soal)
    {
        $dataTahunSoal = TahunSoal::findOrFail($id_tahun_soal);
        $tahunSoal = $dataTahunSoal->tahun;

        return view('siantik.penilaian.soal', compact('id_tahun_soal', 'tahunSoal'));
    }

    public function showSoalProfilling($id_tahun_soal)
    {
        $dataProfilling = PertanyaanProfilling::where('id_tahun_soal', $id_tahun_soal)->get();

        return view('siantik.penilaian.soalProfilling', [
            'id_tahun_soal' => $id_tahun_soal,
            'profilling'    => $dataProfilling,
        ]);
    }

    //Show Soal/Aspek
    public function showJawaban($id_soal)
    {
        $dataSoal = Soal::findOrFail($id_soal);
        $jawabanSoal = $dataSoal->soal;
        $idTahunSoal = $dataSoal->id_tahun_soal;
        

        return view('siantik.penilaian.jawaban', compact('id_soal', 'jawabanSoal', 'idTahunSoal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahunSoal = TahunSoal::findOrFail($id);
        return view('siantik.penilaian.editTahunSoal', compact('tahunSoal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $tahunSoal = TahunSoal::findOrFail($id);
        $tahunSoal->update([
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('soal.index')->with('success', 'Data Tahun Soal berhasil diperbarui.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soal = TahunSoal::findOrFail($id);

        $soal->delete();

        return redirect()->route('soal.index')
                        ->with('success', 'Form penilaian berhasil dihapus.');
    }


    public function createSoal($id_tahun_soal)
    {
        // dd($id_tahun_soal);
        $dataTahunSoal = TahunSoal::findOrFail($id_tahun_soal);
        // dd($dataTahunSoal);
        return view('siantik.penilaian.addSoal', compact('dataTahunSoal'));
    }

    public function storeSoal(Request $request)
    {
        Soal::create([
            'id_tahun_soal' => $request->id_tahun_soal,
            'soal' => $request->soal,
            'nilai_soal' => $request->nilai_soal,
            'nilai_target' => $request->nilai_target,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('soal.showSoal', $request->id_tahun_soal)->with('success', 'Data Aspek berhasil ditambahkan.');

    }

    public function getTahunSoal(Request $request)
    {
        if ($request->ajax()) {
            $data = TahunSoal::select('id', 'tahun', 'deskripsi')
                ->orderBy('tahun', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $showUrl = route('soal.show', $row->id);
                    $showProfilling = route('soal.showSoalProfilling', $row->id);
                    $editUrl = route('soal.edit', $row->id);
                    $deleteUrl = route('soal.destroy', $row->id);
                    return view('siantik.penilaian._parsials.tahun-soal-aksi', compact('showUrl', 'editUrl', 'deleteUrl', 'showProfilling', 'row'));
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    //getSoal
    public function data(Request $request, $id_tahun_soal = null)
    {
        if ($request->ajax()) {
            $query = Soal::query();

            if ($id_tahun_soal) {
                $query->where('id_tahun_soal', $id_tahun_soal);
            }

            $data = $query->orderBy('id_tahun_soal', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $showUrl = route('soal.showJawaban', $row->id);
                    $editUrl = route('soal.editSoal', $row->id);
                    $deleteUrl = route('soal.destroy', $row->id);
                    return view('siantik.penilaian._parsials.soal-aksi', compact('showUrl', 'editUrl', 'deleteUrl', 'row'));
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        abort(403, 'This endpoint only accepts AJAX requests.');
    }

    public function editSoal($id)
    {
        $soal = Soal::findOrFail($id);
        $dataTahunSoal = TahunSoal::get();

        // dd($soal);

        return view('siantik.penilaian.editSoal', compact('soal', 'dataTahunSoal'));
    }

    public function updateSoal(Request $request, $id)
    {
        $request->validate([
            'soal' => 'required|string',
        ]);

        $soal = Soal::findOrFail($id);

        $soal->update([
            'id_tahun_soal' => $request->tahunSoal,
            'soal' => $request->soal,
            'nilai_soal' => $request->nilai_soal,
            'nilai_target' => $request->nilai_target,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('soal.showSoal', $soal->id_tahun_soal)->with('success', 'Data Soal berhasil diperbarui.');
    }

    public function getJawaban(Request $request, $id_soal = null)
    {
        if ($request->ajax()) {
            $query = Jawaban::query();

            if ($id_soal) {
                $query->where('id_soal', $id_soal);
            }

            $data = $query->orderBy('id_soal', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('jawaban.editJawaban', $row->id);
                    $deleteUrl = route('soal.destroy', $row->id);
                    return view('siantik.penilaian._parsials.jawaban-aksi', compact('editUrl', 'deleteUrl'));
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        abort(403, 'This endpoint only accepts AJAX requests.');
    }

    // public function createJawaban($id_soal)
    // {
    //     // Pastikan soal ada
    //     $soal = Soal::findOrFail($id_soal);
    //     return view('siantik.penilaian.addJawaban', compact('id_soal', 'soal'));
    // }

    public function editJawaban($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $soals = Soal::get();

        // dd($soal);

        return view('siantik.penilaian.editJawaban', compact('jawaban', 'soals'));
    }


    public function updateJawaban(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $jawaban = Jawaban::findOrFail($id);

        $jawaban->update([
            'id_soal' => $request->soal,
            'jawaban' => $request->jawaban,
            'bobot_jawaban' => $request->bobot_jawaban,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('soal.showJawaban', ['id_soal' => $jawaban->id_soal])->with('success', 'Data jawaban berhasil diperbarui.');
    }


    public function dataTambahanProfilling($id_tahun_soal)
    {
        // Ambil semua pertanyaan profilling berdasarkan id_tahun_soal
        $pertanyaanProfilings = PertanyaanProfilling::where('id_tahun_soal', $id_tahun_soal)->get();

        $data = [];

        foreach ($pertanyaanProfilings as $pertanyaan) {
            $data[] = [
                'id' => $pertanyaan->id,
                'pertanyaan' => $pertanyaan->pertanyaan,
                'keterangan' => $pertanyaan->keterangan,
                'keahlians' => DataKeahlian::where('id_pertanyaan_profilling', $pertanyaan->id)->get(),
                'pelatihans' => KebutuhanPelatihan::where('id_pertanyaan_profilling', $pertanyaan->id)->get(),
            ];
        }

        return view('siantik.penilaian.data-tambahan-profilling', [
            'data' => $data,
            'id_tahun_soal' => $id_tahun_soal,
        ]);
    }
            
    
}
