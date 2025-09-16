<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormPenilaianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tahun' => $this->faker->numberBetween(2023, 2025),
            'nama_form' => $this->faker->sentence(3),
            'tahap_form' => 'Tahap ' . $this->faker->randomDigitNotNull(),
            'batas_waktu' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'keterangan' => $this->faker->optional()->sentence(10),
        ];
    }
}
