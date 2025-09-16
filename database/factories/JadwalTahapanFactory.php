<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JadwalTahapan;

class JadwalTahapanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = JadwalTahapan::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+7 days');

        return [
            'nama_tahapan' => $this->faker->sentence(3),
            'tanggal_mulai' => $startDate,
            'tanggal_selesai' => $endDate,
            'status' => $this->faker->boolean,
        ];
    }
}
