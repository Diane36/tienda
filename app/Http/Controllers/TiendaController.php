<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
         // ->only()
    }
    
     public function index()
    {
        $tiendasDelUsuario = Auth::user()->tienda;
        $todasLasTiendas = Tienda::all();

        if ($tiendasDelUsuario !== null) {
            $tiendas = $todasLasTiendas->merge($tiendasDelUsuario);
        } else {
            $tiendas = $todasLasTiendas;
        }

        
        //$tiendas=Tienda::all();
        //$tiendas = Auth::user()->tienda;
        return view('tienda.tiendaIndex',compact('tiendas'));
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

        $request->merge(['user_id' => Auth::id()]);
        $tienda = Tienda::create($request->all());

        return redirect()->route('tienda.index')->with('success', 'Libro agregado exitosamente.');
        exit();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tienda $tienda)
    {
        return view('tienda/tiendaShow', compact('tienda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tienda $tienda)
    {
        return view('tienda.tiendaEdit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tienda $tienda)
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
        $libro->save();

        $libro->update($request->all());

        return redirect()->route('tienda.index');
        exit();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda)
    {
        $tienda->delete();
        return redirect()->route('tienda.index');
    }


}
