<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('publicaciones.categorias')->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('publicaciones.categorias' , ['categorias' => $categorias, 'crear']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
        'nombre' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/|unique:categorias,nombre',
        ]);
        $categoria = new Categoria();
        // Asignamos valores de la publicacion
        $categoria->nombre = $request->input('nombre');

        // Guardar   Save()
        if ($categoria->save()){
            //Mensaje,  se creo correctamente
            return redirect()->route('publicaciones.index')->with('exito', 'La categoria se creo correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('publicaciones.index')->with('fracaso', 'La categoria no se puedo crear.');
        }

        // Retornar al index y mostrar el mensaje de que se creo la publicacion
        return redirect()->route('publicaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categorias = Categoria::all();
        return view('publicaciones.categorias', ['categorias' => $categorias, 'eliminar']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('publicaciones.editarCategoria', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/|unique:categorias,nombre,'.$id,
        ]);
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->input('nombre');

        // Guardar   Save()
        if ($categoria->save()){
            //Mensaje,  se creo correctamente
            return redirect()->route('publicaciones.index')->with('exito', 'La categoria se edito correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('publicaciones.index')->with('fracaso', 'La categoria no se puedo editar.');
        }

        // Retornar al index y mostrar el mensaje de que se creo la publicacion
        return redirect()->route('publicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Categoria::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.index')->with('fracaso', 'La categoria no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.index')->with('exito', 'La categoria se elimino correctamente.');
        }
    }
}
