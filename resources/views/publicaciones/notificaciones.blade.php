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

    <h1 style="margin-left: 5rem; margin-right: 5rem;">Notificaciones</h1>

    <table class="table" style="margin-left: 5rem;">
        <thead>
        <tr>
            <th scope="col">Nombre de la Categoria</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td> </td>
            </tr>
        @endforeach
        </tbody>
    </table>




@endsection
