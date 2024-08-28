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

    <div class="accordion" id="accordionExample" style="margin-left: 5rem; margin-right: 5rem; margin-top: 1rem; margin-bottom: 1rem;">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h5>Editar la Categoria</h5>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <!-- FORM PARA CREAR  -->
                    <form method="post" action="{{ route('categorias.update', ['id'=>$categoria->id]) }}">
                        @csrf
                        @method('put')

                        <div class="row g-3">
                            <div class="col-md-7" >
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ $categoria->nombre}}">
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
