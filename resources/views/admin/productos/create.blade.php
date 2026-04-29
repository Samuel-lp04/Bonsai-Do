@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Añadir Nuevo Bonsái</h2>
    
    <form action="{{ route('productos.store') }}" method="POST" class="mt-4">
        @csrf
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Bonsái</label>
            <input type="text" class="form-control" name="nombre" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" step="0.01" class="form-control" name="precio" required>
                @error('precio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock inicial</label>
                <input type="number" class="form-control" name="stock" required>
                @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="imagen_url" class="form-label">URL de la Imagen</label>
            <input type="text" class="form-control" name="imagen_url" required>
            @error('imagen_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar Bonsái</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection