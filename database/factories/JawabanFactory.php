<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Soal;

class JawabanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_soal' => 51, 
            'jawaban' => $this->faker->sentence(3),
            'bobot_jawaban' => $this->faker->numberBetween(1, 10),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }
}
