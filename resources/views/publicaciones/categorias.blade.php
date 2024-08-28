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

    <h1 style="margin-left: 5rem; margin-right: 5rem;">Categorias</h1>

    <table class="table" style="margin-left: 5rem;">
        <thead>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <div class="card" style="width: 18rem; margin-left: 5rem; margin-top: 1rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{  $categoria->nombre  }}</h5>
                        <a href="{{ route('categorias.edit', ['id' => $categoria->id])}}" class="btn btn-success btn-sm">Editar</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$categoria->id}}">
                            Eliminar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar {{$categoria->nombre}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Esta seguro que quiere eliminar la categoria {{$categoria->nombre}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('categorias.destroy' , ['id'=>$categoria->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="accordion" id="accordionExample" style="margin-left: 5rem; margin-right: 5rem; margin-top: 1rem; margin-bottom: 1rem;">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h5>Crear una Categoria</h5>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <!-- FORM PARA CREAR  -->
                    <form method="post" action="{{ route('categorias.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-7" >
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value=" ">
                                    <label for="nombre">Nombre de la Categoria</label>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <input class="btn btn-primary" type="submit" value="Guardar" style="margin-left: 1rem;">
                        <input class="btn btn-danger" type="reset" value="Limpiar" style="margin-left: 1rem;">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
