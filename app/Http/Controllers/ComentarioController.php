<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comentarios = Comentario::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        // Validar los datos
        //$request->validate([
            //'texto_comentario' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
        //]);
        // Crear una nueva publicacion 17
        $publicacion = Publicacion::findOrFail($id);
        $comentario = new Comentario();
        // Asignamos valores de la publicacion
        $comentario->texto_comentario = $request->input('comentario');
        $comentario->usuario = 'User1';
        $comentario->publicaciones_id = $publicacion->id;


        // Guardar   Save()
        if ($comentario->save()){
            //Mensaje,  se creo correctamente
            return redirect()->route('comentarios.show',['id'=>$comentario->publicaciones_id])->with('exito', 'El comentario se envio correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('comentarios.show',['id'=>$comentario->publicaciones_id])->with('fracaso', 'El comentario no se puedo enviar.');
        }

        // Retornar al index y mostrar el mensaje de que se creo la publicacion
        return redirect()->route('publicaciones.comentario');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Mostrar un recurso en especifico
        //Recuperar de la BD la publicacion
        //if (isset($comentario)){
            //$publicacion = Publicacion::where();
        //}
        $publicacion = Publicacion::findOrFail($id);
        $comentarios = Comentario::where('publicaciones_id', $id)->get();
        //Si ya tengo el producto, retornar una vista
        return view('publicaciones.comentario', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comentario = Comentario::find($id);
        $publicacion = Publicacion::where('id', $comentario->publicaciones_id)->first();
        $eliminados = Comentario::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.show', ['publicacion'=>$publicacion->id])->with('fracaso', 'El comentario no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.show', ['publicacion'=>$publicacion->id])->with('exito', 'El comentario se elimino correctamente.');
        }
    }
}
