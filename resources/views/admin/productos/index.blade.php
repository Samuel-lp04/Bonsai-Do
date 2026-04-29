@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Listado de Bonsáis (Panel de Admin)</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Bonsái</a>
    
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }} €</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;" 
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este bonsái? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection