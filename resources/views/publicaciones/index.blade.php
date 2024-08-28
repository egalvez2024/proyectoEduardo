@extends('plantilla')
@section('titulo', 'Publicaciones')
@section('contenido')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif


    <!-- Button trigger MODAL CREAR -->
    <h1 style="margin-left: 5rem;">Publicaciones<a class="btn btn-primary" href="{{ route('publicaciones.create') }}" style="margin-left: 44rem;">+ Nueva Publicacion</a></h1>


    <!-- MOSTRAR PUBLICACIONES  -->

    <table class="table" style="margin-left: 5rem;">
        <thead>
        <tr>
            <th scope="col">Categorias</th>
            <th scope="col">Titulo</th>
            <th scope="col">Contenido</th>
        </tr>
        </thead>
        <tbody>

        @foreach($publicaciones as $publicacion)
            <tr>
                <td>
                    @forelse($publicacion->categorias as $categoria)
                        <span class="badge text-bg-secondary">{{ $categoria->nombre }}</span>
                    @empty
                        <span class="badge text-bg-secondary">Sin Categoria</span>
                    @endforelse
                </td>
                <td>{{ $publicacion->titulo }}</td>
                <td>{{ $publicacion->contenido }}</td>
                <td scope="col">
                    <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn btn-outline-success btn-sm">Comentarios</a>
                    <a href="{{ route('publicaciones.edit', ['id'=> $publicacion->id]) }}" class="btn btn-outline-info btn-sm">Editar</a>

                    <!-- Button trigger MODAL ELIMINAR -->
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINAR{{$publicacion->id}}">
                        Eliminar
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td>
                <div class="row" >
                    @forelse($publicacion->categorias as $categoria)
                        <div class="col-sm-1">
                            <span class="badge text-bg-secondary" >  {{ $categoria->nombre }}  </span>
                        </div>
                    @empty
                        <div class="col">
                            <span class="badge text-bg-secondary" >Sin Categoria</span>
                        </div>
                    @endforelse
                </div>
            </td>
        </tr>
        </tfoot>
    </table>

    <!-- Modal ELIMINAR-->
    <div class="modal fade" id="MODALELIMINAR{{$publicacion->id}}" tabindex="-1" aria-labelledby="MODALELIMINARLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="MODALELIMINARLabel">Eliminar Publicacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Estas seguro que quieres eliminar la publicacion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('publicaciones.destroy' , ['id'=>$publicacion->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
