<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categoria::create([
            'id' => 1,
            'nombre_categoria' => 'Hogar'
        ]);

        Categoria::create([
            'id' => 2,
            'nombre_categoria' => 'Cocina'
        ]);

        Categoria::create([
            'id' => 3,
            'nombre_categoria' => 'Educacion'
        ]);
    }
}
