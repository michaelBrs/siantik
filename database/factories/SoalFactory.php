<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_tahun_soal' => $this->faker->numberBetween(1, 200),
            'soal' => $this->faker->sentence(8),
            'nilai_soal' => $this->faker->randomFloat(1, 1, 5), // 1.0 - 5.0
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
