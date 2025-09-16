<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalTahapan;

class JadwalTahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JadwalTahapan::factory()->count(10)->create();
    }
}
