<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TahunSoal;

class TahunSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunSoal::factory()->count(20)->create();
    }
}
