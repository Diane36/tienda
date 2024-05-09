<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\Archivo;
use Illuminate\Mail\Message;
use App\Mail\AgregaLibro;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
            'archivo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $request->merge(['user_id' => Auth::id()]);
        $tienda = Tienda::create($request->all());
        $archivo = $this->guardarArchivo($request->archivo, $tienda);
        if (!$archivo) {
            return redirect()->route('tienda.index')->with('error', 'Error al cargar el archivo.');
        }

        Mail::to(auth()->user()->email)->send(new AgregaLibro($tienda));

        return redirect()->route('tienda.index')->with('success', 'Libro agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tienda $tienda)
    {
        $archivos = Archivo::where('tienda_id', $tienda->id)->get();
        return view('tienda.tiendaShow', compact('tienda', 'archivos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tienda $tienda)
    {
        $this->authorize('update', $tienda);
        return view('tienda.tiendaEdit', compact('tienda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tienda $tienda)
    {
        $this->authorize('update', $tienda);
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
        $this->authorize('delete', $tienda);
        $tienda->delete();
        return redirect()->route('tienda.index');
    }
    
    public function download(Archivo $archivo){
        
        return response()->download(storage_path('app/' . $archivo->ubicacion), $archivo->nombre_original);
    }

    protected function guardarArchivo($archivo, $tienda)
{
    if (!$archivo->isValid()) {
        return false;
    }

    $ubicacion = $archivo->store('public/archivos_tienda');

    return $tienda->archivos()->create([
        'ubicacion' => $ubicacion,
        'nombre_original' => $archivo->getClientOriginalName(),
        'mime' => $archivo->getMimeType(),
    ]);
}
}
