<?php

namespace Database\Seeders;

use App\Models\Articulo;
use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Articulo::create([
            'id' => 1,
            'numero_registro' => 1000,
            'nombre' => 'Silla',
            'cantidad' => 12,
            'categoria_id' => 1
        ]);

        Articulo::create([
            'id' => 2,
            'numero_registro' => 2000,
            'nombre' => 'Estufa',
            'cantidad' => 4,
            'categoria_id' => 2
        ]);

        Articulo::create([
            'id' => 3,
            'numero_registro' => 3000,
            'nombre' => 'Cuaderno',
            'cantidad' => 40,
            'categoria_id' => 3
        ]);

    }
}
