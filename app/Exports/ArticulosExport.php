<?php

namespace App\Exports;

use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticulosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Articulo::all();

        $data = Articulo::select('articulo.numero_registro',
                                'articulo.cantidad',
                                'articulo.nombre',
                                'categoria.nombre_categoria')
                        ->join('categoria', 'articulo.categoria_id', '=', 'categoria.id')
                        ->get();

        return $data;
    }
}
