<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = [
            ['q' => 'Bagaimana cara mendapatkan akun (username & password)?',
             'a' => 'Akun dibuat oleh admin. Jika belum punya, hubungi helpdesk.'],
            ['q' => 'Bagaimana mekanisme lupa password?',
             'a' => 'Gunakan menu Lupa Password atau hubungi helpdesk.'],
            ['q' => 'Jika koneksi internet terputus apakah data hilang?',
             'a' => 'Data tersimpan setelah menekan tombol Simpan. Jika belum menyimpan, data belum masuk.'],
        ];
    
        $docs = [
            ['title'=>'Perpres 95/2018 tentang SPBE','url'=>'https://example.com/perpres95.pdf'],
            ['title'=>'PermenPANRB 59/2020','url'=>'https://example.com/permen59.pdf'],
            ['title'=>'Pedoman Menteri PANRB No. 6 Tahun 2023','url'=>'https://example.com/pedoman6.pdf'],
        ];
    
        $helpdesks = [
            ['nama'=>'Nomor Kantor (office hour)','desc'=>'(021) 7398381 – 89 Ext. 2111','tel'=>'0217398381'],
            ['nama'=>'Nugroho Arief Prasetyo','desc'=>'K/L/Provinsi','tel'=>'082249190828'],
            ['nama'=>'Joshua Ariel Perkasa','desc'=>'Kota','tel'=>'085651015615'],
        ];
    
        return view('siantik.bantuan', compact('faqs','docs','helpdesks'));
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
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function show(Bantuan $bantuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bantuan $bantuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bantuan $bantuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bantuan $bantuan)
    {
        //
    }
}
