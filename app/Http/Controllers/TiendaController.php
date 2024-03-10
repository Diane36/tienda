<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendas=Tienda::all();
        return view('tienda/tiendaIndex',compact('tiendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tienda/tiendaCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'editorial' => 'required',
            'precio'=> 'required',
        ]);
        $libro = new Tienda();
        $libro->titulo =$request->titulo;
        $libro->autor =$request->autor;
        $libro->editorial =$request->editorial;
        $libro->precio =$request->precio;
        $libro->libro_code =$request->libro_code;
        $libro->save();
        dd('Validación exitosa');

        return redirect()->route('tienda.index');
        exit();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tienda $tienda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tienda $tienda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tienda $tienda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda)
    {
        //
    }
}
