@extends('plantilla')
@section('titulo', 'Publicaciones')
@section('contenido')
    <h1 style="margin-left: 5rem;">Publicaciones</h1>
    @foreach($publicaciones as $publicacion)
        <div class="card"  style="width: 70rem; margin-left: 5rem; margin-bottom: 1rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $publicacion->titulo }}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">User</h6>
                <p class="card-text">{{ $publicacion->contenido }}</p>
                <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn btn-success btn-sm">Comentarios</a>
                <a href="#" class="card-link">Ir al perfil</a>
            </div>
        </div>
    @endforeach

@endsection
