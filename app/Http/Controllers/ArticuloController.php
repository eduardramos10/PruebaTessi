<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articulos =  Articulo::with('categoria')->get();
        return $articulos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $articulo = new Articulo();
        $articulo->numero_registro = $request->numero_registro;
        $articulo->nombre = $request->nombre;
        $articulo->cantidad = $request->cantidad;
        $articulo->categoria_id = $request->categoria_id;

        $articulo->save();
        return $articulo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $articulo = Articulo::find($id);
        $articulo->numero_registro = $request->numero_registro;
        $articulo->nombre = $request->nombre;
        $articulo->cantidad = $request->cantidad;
        $articulo->categoria_id = $request->categoria_id;

        $articulo->save();
        return $articulo;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articulo = Articulo::find($id);
        $articulo->delete();
        return $articulo;
    }

    public function numeroRegistros()
    {
        //
        $articulo = Articulo::select('numero_registro')->pluck('numero_registro');
        return $articulo;
    }

}
