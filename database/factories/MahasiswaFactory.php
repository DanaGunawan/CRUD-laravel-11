<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


  
     public function definition(): array
     {
         return [
             'nim' => $this->faker->unique()->numberBetween(2215320,221532999),
             'nama' => $this->faker->name(),
             'jurusan' => $this->jurusan(rand(0, 6)) // Changed 7 to 6 to match the array index
         ];
     }
     
     public function jurusan($i)
     {
         $jurusan = ['Sipil', 'Elektro', 'Mesin', 'Akuntansi', 'AB', 'Pariwisata','Teknologi Informasi'];
         return $jurusan[$i];
     }     

    }