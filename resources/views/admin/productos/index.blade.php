@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Listado de Bonsáis (Panel de Admin)</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Añadir Nuevo Bonsái</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ number_format($producto->precio, 2, ',', '.') }} €</td>
                <td>
                    @forelse($producto->categorias as $categoria)
                        <span class="badge bg-success">{{ $categoria->nombre }}</span>
                    @empty
                        <span class="text-muted small">Sin categoría</span>
                    @endforelse
                </td>
                <td>
                    @if($producto->stock == 0)
                        <span class="badge bg-danger">Agotado (0)</span>
                    @elseif($producto->stock <= 5)
                        <span class="badge bg-warning text-dark">Últimos {{ $producto->stock }}</span>
                    @else
                        {{ $producto->stock }}
                    @endif
                </td>
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
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">No hay bonsáis registrados en el sistema.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-end align-items-center mt-4">
        <a href="{{ url('home') }}" class="btn btn-outline-pizarra-oscuro">
            <i class="bi bi-arrow-left"></i> Volver al catálogo
        </a>
    </div>
</div>
@endsection