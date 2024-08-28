<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Comentario;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar publicaciones
        $categorias = Categoria::all();
        $publicaciones = Publicacion::orderby('created_at', 'DESC')->get();
        return view('publicaciones.index',['publicaciones'=>$publicaciones, 'categorias'=>$categorias]);

    }

    public function filtrado(Request $request)
    {
        $busqueda = $request->input('buscar');
        $categorias = Categoria::where('nombre', '%like%', $busqueda)->get();
        $publicaciones = Publicacion::where('id', )->get();
        return view('publicaciones.index')->with(['publicaciones', $publicaciones]);

    }

    public function create()
    {
        $categorias = Categoria::all();
        $publicaciones = Publicacion::orderby('created_at', 'DESC')->get();
        return view('publicaciones.nuevaPublicacion')->with('categorias', $categorias);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'titulo' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
            'contenido' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
        ]);
        // Crear una nueva publicacion
        $publicacion = new Publicacion();
        // Asignamos valores de la publicacion
        $publicacion->titulo = $request->input('titulo');
        $publicacion->contenido = $request->input('contenido');
        $publicacion->cantidad_comentarios = 0;
        $publicacion->usuario_id = 1;



        // Guardar   Save()
        if ($publicacion->save()){
            //Mensaje,  se creo correctamente
            $categorias_eleccion = ' ';
            if(isset($_POST['categorias_eleccion'])){
                foreach ($_POST['categorias_eleccion'] as $eleccion){
                    $publicacion->categorias()->attach($eleccion);
                }
            }
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se creo correctamente.');
        }else{
            //Mensaje, no se pudo crear
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se puedo crear.');
        }

        // Retornar al index y mostrar el mensaje de que se creo la publicacion
        return redirect()->route('publicaciones.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Mostrar un recurso en especifico
        //Recuperar de la BD la publicacion
        $publicacion = Publicacion::findOrFail($id);
        $comentarios = Comentario::where('publicaciones_id', $id)->get();
        //Si ya tengo el producto, retornar una vista
        return view('publicaciones.comentario', ['publicacion'=>$publicacion, 'comentarios'=>$comentarios]);
    }

    public function edit(string $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        $categorias = Categoria::all();
        $categoria_publicacion = $publicacion->categorias;
        return view('publicaciones.nuevaPublicacion', ['publicacion'=>$publicacion, 'categorias'=>$categorias, 'categoria_publicacion'=>$categoria_publicacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validaciones
        $request->validate([
            'titulo' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
            'contenido' => 'required|max:500|regex:/[a-zA-Z0-9 ]+/',
        ]);

        //Buscamos la Publicacion
        $publicacion = Publicacion::findOrFail($id);

        //Asignamos los valores de la publicacion
        $publicacion->titulo = $request->input('titulo');
        $publicacion->contenido = $request->input('contenido');

        //Guardamos
        if ($publicacion->save()){
            //Mensaje, se guardo correctamente
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se edito correctamente.');
        }else{
            //Mensaje, no se logro guardar
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se pudo editar.');
        }

        //Retornar al index y mostrar el mensaje de que se creo la publicacion
        return redirect()->route('publicacion.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Buscamos la publicacion y la eliminamos
        $eliminados = Publicacion::destroy($id);

        if ($eliminados < 0){
            return redirect()->route('publicaciones.index')->with('fracaso', 'La publicacion no se pudo borrar.');
        }else {
            return redirect()->route('publicaciones.index')->with('exito', 'La publicacion se elimino correctamente.');
        }

    }
}
