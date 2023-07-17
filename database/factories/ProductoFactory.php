<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 ** Al ejecutar Tinker, Comando Crear registro:
 ** \App\Models\Producto::factory()->count(10)->create()
 */
class ProductoFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        return [
            'categoria_id' => Categoria::factory(),
            'nombre' => $this->faker->sentence(),
            'slug'   => $this->faker->slug(),            
            'descripcion'  => $this->faker->paragraph(),
            'imagen' => $this->faker->imageUrl(),
            'token'   => Str::random(10)
        ];
    }
}
