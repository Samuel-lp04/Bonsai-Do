@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Bonsái: {{ $producto->nombre }}</h2>
    
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Precio (€)</label>
                <input type="number" step="0.01" class="form-control" name="precio" value="{{ $producto->precio }}" required>
                @error('precio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" value="{{ $producto->stock }}" required>
                @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">URL de la Imagen</label>
            <input type="text" class="form-control" name="imagen_url" value="{{ $producto->imagen_url }}" required>
            @error('imagen_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection