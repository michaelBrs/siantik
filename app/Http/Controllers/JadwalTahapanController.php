<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalTahapan;
use App\Models\FormPenilaian;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class JadwalTahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('siantik.penilaian.formPenilaianTahapan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_form_penilaian)
    {
        $dataTahapan = FormPenilaian::findOrFail($id_form_penilaian);
        $tahunTahapan = $dataTahapan->tahun;

        return view('siantik.penilaian.jadwal-tahapan', compact('id_form_penilaian', 'tahunTahapan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getFormPenilaian(Request $request)
    {
        if ($request->ajax()) {
            $data = FormPenilaian::select('id', 'tahun', 'nama_form', 'tahap_form', 'batas_waktu', 'status')
                ->orderBy('tahun', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status ? '<span class="badge badge-light-success">Aktif</span>' : '<span class="badge badge-light-danger">Tidak Aktif</span>';
                })
                ->addColumn('aksi', function ($row) {
                    $showUrl = route('jadwal-tahapan.show', $row->id);
                    return view('siantik.penilaian._parsials.kelola-tahapan-aksi', compact('showUrl', 'row'));
                })
                ->rawColumns(['aksi', 'status'])
                ->make(true);
        }
    }

    public function getJadwalTahapan(Request $request, $id_form_penilaian = null)
    {
        if ($request->ajax()) {
            $query = JadwalTahapan::query();
                
            if ($id_form_penilaian) {
                $query->where('id_form_penilaian', $id_form_penilaian);
            }

            $data = $query->orderBy('tanggal_mulai', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_mulai', function ($row) {
                    return Carbon::parse($row->tanggal_mulai)->translatedFormat('d F Y');
                })
                ->editColumn('tanggal_selesai', function ($row) {
                    return Carbon::parse($row->tanggal_selesai)->translatedFormat('d F Y');
                })
                ->editColumn('status', function ($row) {
                    return $row->status ? '<span class="badge badge-light-success">Aktif</span>' : '<span class="badge badge-light-danger">Tidak Aktif</span>';
                })
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('jadwal-tahapan.edit', $row->id);
                    $deleteUrl = route('jadwal-tahapan.destroy', $row->id);
                    return view('siantik.penilaian._parsials.jadwal-tahapan-aksi', compact('editUrl', 'deleteUrl'));
                })
                ->rawColumns(['aksi', 'status'])
                ->make(true);
        }
    }
}
