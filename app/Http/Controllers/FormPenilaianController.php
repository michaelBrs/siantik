<?php

namespace App\Http\Controllers;

use App\Models\FormPenilaian;
use App\Models\TahunSoal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FormPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = FormPenilaian::get();

        return view('siantik.penilaian.formPenilaian', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahunSoals = TahunSoal::orderBy('tahun', 'desc')->get();

        return view('siantik.penilaian.addFormPenilaian', compact('tahunSoals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tahun'         => 'required|integer',
            'nama_form'     => 'required|string|max:255',
            'tahap_form'    => 'required|string|max:255',
            'tahunSoal'     => 'required|exists:tahun_soals,id',
            'waktu_mulai'   => 'required|date',
            'batas_waktu'   => 'required|date|after_or_equal:waktu_mulai',
            'status'        => 'required|in:0,1',
            'is_generate'   => 'required',
            'keterangan'    => 'nullable|string',
        ]);

        // Simpan ke database
        $formPenilaian = FormPenilaian::create([
            'tahun'          => $validated['tahun'],
            'nama_form'      => $validated['nama_form'],
            'tahap_form'     => $validated['tahap_form'],
            'id_tahun_soal'  => $validated['tahunSoal'],
            'waktu_mulai'    => $validated['waktu_mulai'],
            'batas_waktu'    => $validated['batas_waktu'],
            'status'         => $validated['status'],
            'is_generate'    => $validated['is_generate'],
            'keterangan'     => $validated['keterangan'] ?? null,
        ]);

        // Redirect dengan pesan sukses
        return redirect()
            ->route('formPenilaian.index')
            ->with('success', 'Form Penilaian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormPenilaian  $formPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(FormPenilaian $formPenilaian)
    {
        //View untuk Satker
        // return view('siantik.penilaian.formPenilaianSatker');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormPenilaian  $formPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formPenilaian = FormPenilaian::findOrFail($id);
        $tahunSoals = TahunSoal::get();
        
        return view('siantik.penilaian.editFormPenilaian', compact('formPenilaian', 'tahunSoals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormPenilaian  $formPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'tahun'     => 'required',
        ]);

        // Ambil data soal
        $formPenilaian = FormPenilaian::findOrFail($id);

        // Update data soal
        $formPenilaian->update([
            'tahun'          => $request->tahun,
            'nama_form'    => $request->nama_form,
            'tahap_form'  => $request->tahap_form,
            'id_tahun_soal' => $request->tahunSoal,
            'waktu_mulai' => $request->waktu_mulai,
            'batas_waktu' => $request->batas_waktu,
            'status' => $request->status,
            'keterangan'    => $request->keterangan,
        ]);

        // Redirect ke halaman list soal tahun tersebut dengan pesan sukses
        return redirect()
            ->route('formPenilaian.index')
            ->with('success', 'Data soal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormPenilaian  $formPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormPenilaian $formPenilaian)
    {
        //
    }

    public function getFormPenilaian(Request $request)
    {
        if ($request->ajax()) {
            $data = FormPenilaian::with(['tahunSoal'])
                ->orderBy('tahun', 'desc')
                ->orderBy('tahap_form', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('versi_soal', function($row){
                    return $row->tahunSoal->deskripsi ?? '-';
                })
                ->editColumn('status', function ($row) {
                    return $row->status ? '<span class="badge badge-light-success">Aktif</span>' : '<span class="badge badge-light-danger">Tidak Aktif</span>';
                })
                ->addColumn('aksi', function ($row) {
                    $editUrl = route('formPenilaian.edit', $row->id);
                    $generateForm = route('formPenilaianSatker.generate', $row->id);
                    $deleteUrl = route('formPenilaian.destroy', $row->id);
                    return view('siantik.penilaian._parsials.form-penilaian-aksi', compact('editUrl', 'deleteUrl', 'generateForm', 'row'));
                })
                ->rawColumns(['aksi', 'status'])
                ->make(true);
        }
    }

    public function generateForm($formPenilaianId)
    {
        $now = Carbon::now();
        
        DB::beginTransaction();

        try {

            DB::table('form_penilaian_satkers')->insertUsing([
                'wilayah_id',
                'is_locked',
                'locked_at',
                'form_penilaian_id',
                'submit',
                'is_generate',
                'indeks_kematangan',
                'predikat_kematangan',
                'created_at',
                'updated_at'
            ], 
            DB::table('wilayah')->selectRaw(
                'id, 0 as is_locked, NULL as locked_at, ? as form_penilaian_id, 0 as submit, 0 as is_generate, NULL as indeks_kematangan, NULL as predikat_kematangan, ? as created_at, ? as updated_at',
                [$formPenilaianId, $now, $now]
            ));

            $formPenilaian = FormPenilaian::findOrFail($formPenilaianId);
            $formPenilaian->update([
                'is_generate' => 1,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Form berhasil digenerate.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('warning', 'Data gagal di generate: ' . $e->getMessage());
        }

        
    }

}
