@extends('plantilla')
@section('titulo', 'Comentarios')
@section('contenido')

    @if(isset($publicacion))
        <h3 style="margin-left: 5rem; margin-top: 1rem;">Editar Publicacion</h3>
    @else
        <h3 style="margin-left: 5rem; margin-top: 1rem;">Nueva Publicacion!!</h3>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" style="margin-left: 5rem; margin-right: 5rem; margin-top: 1rem;"
          @if(isset($publicacion))
              action="{{ route('publicaciones.update', ['id'=>$publicacion->id]) }}"
          @else
              action="{{ route('publicaciones.store') }}"
        @endif
    >
        @csrf
        @if(isset($publicacion))
            @method('put')
        @endif
        <div class="row g-3">
            <div class="col-md-7" >
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="titulo" placeholder="Titulo" name="titulo" value="{{ isset($publicacion) ? $publicacion->titulo : old('titulo') }}" >
                    <label for="titulo">Titulo</label>
                </div>
            </div>
        </div>

        <div class="row g-3" >
            <div class="col-md-13">
                <div class="form-floating">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Contenido" id="contenido" name="contenido" style="height: 100px" value="{{ isset($publicacion) ? $publicacion->contenido : old('contenido') }}"></textarea>
                        <label for="contenido"></label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Elegir Categorias
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @forelse($categorias as $categoria)
                            <input type="checkbox" name="categorias_eleccion[]" value="{{ $categoria->id }}"><label>{{ $categoria->nombre }} </label><br>
                        @empty
                            <input type="checkbox" value="No hay Categias disponibles">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <p></p>
        <input class="btn btn-primary" type="submit" value="Guardar" style="margin-left: 8rem;">
        <input class="btn btn-danger" type="reset" value="Limpiar" style="margin-left: 1rem;">

    </form>



@endsection
