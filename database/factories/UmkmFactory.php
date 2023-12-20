<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 3),
            'nama_umkm' => fake()->company(),
            'pemilik_umkm' => fake()->lastName(),
            'no_telp' => fake()->phoneNumber(),
            'alamat_umkm' => fake()->address(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'status' => fake()->randomElement(['pending', 'accepted']),
        ];
    }
}
