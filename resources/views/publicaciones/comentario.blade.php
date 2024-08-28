@extends('plantilla')
@section('titulo', 'Comentarios')
@section('contenido')
    @csrf
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

    <div class="card" style="width: 70rem; margin-left: 5rem; margin-bottom: 1rem; margin-top: 1rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $publicacion->titulo }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">User</h6>
            <p class="card-text">{{ $publicacion->contenido }}</p>
        </div>
    </div>
    <div class="card" style="width: 70rem;  margin-left: 5rem; ">
        <div class="card-header">
            Comentarios
        </div>
        <ul class="list-group list-group-flush">
            @foreach($comentarios as $comentario)
                <li class="list-group-item" >
                    <h6>{{ $comentario->usuario }}</h6>
                    {{ $comentario->texto_comentario }}
                    <div>
                        <!-- Button trigger MODAL ELIMINAR -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#MODALELIMINARC{{$comentario->id}}" style="margin-left: 63rem;">
                            Eliminar
                        </button>

                        <!-- Modal ELIMINAR-->
                        <div class="modal fade" id="MODALELIMINARC{{$comentario->id}}" tabindex="-1" aria-labelledby="MODALELIMINARCLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="MODALELIMINARCLabel">Eliminar Comentario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Estas seguro que quieres eliminar el comentario?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('comentarios.destroy' , ['id'=>$comentario->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <p></p>

    <form method="post" action="{{ route('comentarios.store', ['id'=>$publicacion->id]) }}" style="margin-left: 5rem;">
        @csrf
        <div class="row g-3">
            <div class="col-md-10">
                <div class="col-md-19">
                    <div class="form-floating">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="comentario" id="comentario" name="comentario" style="height: 100px" value=" "></textarea>
                            <label for="comentario">Escribe un comentario...</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-1" >
                <div class="row">
                    <input class="btn btn-primary btn-g" type="submit" value="Enviar" style="margin-left: 0.05rem; margin-top: 0.5rem;">
                </div>
                <div class="row">
                    <input class="btn btn-danger btn-g" type="reset" value="Cancelar" style="margin-left: 0.05rem; margin-top: 0.5rem;">
                </div>

            </div>
        </div>
    </form>


@endsection
