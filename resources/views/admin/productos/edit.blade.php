@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">✏️ Editar: {{ $producto->nombre }}</h2>
            </div>

            <div class="card shadow-sm border-0 p-4">
                <div class="card-body">
                    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <label for="nombre" class="form-label text-muted fw-semibold">Nombre del Bonsái</label>
                                <input type="text" class="form-control border @error('nombre') is-invalid border-danger @enderror" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label for="precio" class="form-label text-muted fw-semibold">Precio (€)</label>
                                <input type="number" step="0.01" min="0" class="form-control border @error('precio') is-invalid border-danger @enderror" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                                @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="stock" class="form-label text-muted fw-semibold">Stock (Unidades)</label>
                                <input type="number" min="0" class="form-control border @error('stock') is-invalid border-danger @enderror" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-8 mb-4">
                                <label for="imagen_url" class="form-label text-muted fw-semibold">Ruta de la Imagen</label>
                                <input type="text" class="form-control border @error('imagen_url') is-invalid border-danger @enderror" id="imagen_url" name="imagen_url" value="{{ old('imagen_url', $producto->imagen_url) }}" required>
                                @error('imagen_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="form-label text-muted fw-semibold">Descripción y Cuidados</label>
                            <textarea class="form-control border @error('descripcion') is-invalid border-danger @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted fw-semibold">Categorías (Selecciona al menos una)</label>
                            <div class="p-3 border rounded bg-light @error('categorias') border-danger @enderror">
                                <div class="row">
                                    @foreach($categorias as $categoria)
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="categorias[]" value="{{ $categoria->id }}" id="cat_{{ $categoria->id }}" 
                                                {{ (is_array(old('categorias')) && in_array($categoria->id, old('categorias'))) || (!is_array(old('categorias')) && in_array($categoria->id, $idCategoriasSeleccionadas)) ? 'checked' : '' }}>
                                                
                                                <label class="form-check-label" for="cat_{{ $categoria->id }}">
                                                    {{ $categoria->nombre }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('categorias') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary px-4 py-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">Actualizar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection