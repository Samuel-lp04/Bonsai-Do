@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Crear Nueva Categoría</h5>
                    </div>
                    @if ($errors->any())
                        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                            <strong>¡Atención! Hay errores de validación:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                            <strong>¡Error crítico!</strong> {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('categorias.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                                <input type="text" class="form-control border @error('traducciones.es.nombre') is-invalid border-danger @enderror" id="nombre_es" name="traducciones[es][nombre]" value="{{ old('traducciones.es.nombre') }}" placeholder="Ej: Bonsái Interior" required>
                                @error('traducciones.es.nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control border @error('traducciones.es.descripcion') is-invalid border-danger @enderror" id="descripcion_es" name="traducciones[es][descripcion]" rows="4" required>{{ old('traducciones.es.descripcion') }}</textarea>
                                @error('traducciones.es.descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-outline-secondary w-100 text-start" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseIngles" aria-expanded="false"
                                    aria-controls="collapseIngles">
                                    ➕ Añadir traducción en Inglés (Opcional)
                                </button>

                                <div class="collapse mt-3 {{ old('traducciones.en.nombre') || old('traducciones.en.descripcion') || $errors->has('traducciones.en.*') ? 'show' : '' }}"
                                    id="collapseIngles">
                                    <div class="p-4 border rounded bg-light">
                                        <h5 class="text-dark fw-semibold mb-3">🇬🇧 Textos en Inglés</h5>

                                        <div class="mb-3">
                                            <label for="nombre_en" class="form-label text-muted fw-semibold">Nombre de la Categoría (Inglés)</label>
                                            <input type="text"
                                                class="form-control border @error('traducciones.en.nombre') is-invalid border-danger @enderror"
                                                id="nombre_en" name="traducciones[en][nombre]"
                                                value="{{ old('traducciones.en.nombre') }}" placeholder="Ej: Retusa Ficus">
                                            @error('traducciones.en.nombre') <div class="invalid-feedback">{{ $message }}
                                            </div> @enderror
                                        </div>

                                        <div>
                                            <label for="descripcion_en"
                                                class="form-label text-muted fw-semibold">Descripción (Inglés)</label>
                                            <textarea
                                                class="form-control border @error('traducciones.en.descripcion') is-invalid border-danger @enderror"
                                                id="descripcion_en" name="traducciones[en][descripcion]"
                                                rows="4">{{ old('traducciones.en.descripcion') }}</textarea>
                                            @error('traducciones.en.descripcion') <div class="invalid-feedback">
                                            {{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar Categoría</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection