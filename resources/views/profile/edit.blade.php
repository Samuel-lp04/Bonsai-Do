@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Título de la página -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-dark">Mi Perfil</h1>
                <p class="text-muted">Gestiona tus datos personales y credenciales de acceso</p>
            </div>

            <!-- Mensaje de éxito flotante -->
            @if (session('success'))
                <div class="alert alert-success shadow-sm border-0 alert-dismissible fade show" role="alert">
                    🌿 {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- TARJETA 1: Editar Datos Básicos -->
            <div class="card shadow-sm border-0 mb-4 p-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-4">Datos Personales</h3>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label text-muted fw-semibold">Nombre completo</label>
                                <!-- Le hemos devuelto el borde estándar para que sea intuitivo -->
                                <input type="text" class="form-control py-2 px-3 border @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label text-muted fw-semibold">Teléfono</label>
                                <input type="text" class="form-control py-2 px-3 border @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}" required>
                                @error('telefono') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-muted fw-semibold">Correo electrónico</label>
                            <input type="email" class="form-control py-2 px-3 border @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TARJETA 2: Cambiar Contraseña -->
            <div class="card shadow-sm border-0 mb-4 p-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-4">Seguridad de la Cuenta</h3>
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="current_password" class="form-label text-muted fw-semibold">Contraseña actual</label>
                            <input type="password" class="form-control py-2 px-3 border @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label text-muted fw-semibold">Nueva contraseña</label>
                                <input type="password" class="form-control py-2 px-3 border @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label text-muted fw-semibold">Confirmar contraseña</label>
                                <input type="password" class="form-control py-2 px-3 border" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary px-4 py-2">Actualizar Contraseña</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- BOTÓN DE BORRAR CUENTA DISCRETO -->
            <div class="text-center mt-5 mb-4">
                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalBorrarCuenta">
                    Eliminar mi cuenta de Bonsai Do
                </button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL EMERGENTE: Aviso Permanente -->
<div class="modal fade" id="modalBorrarCuenta" tabindex="-1" aria-labelledby="modalBorrarCuentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold" id="modalBorrarCuentaLabel">⚠️ Advertencia Crítica</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <div class="modal-body p-4 text-center">
                <h5 class="mb-3">¿Estás a punto de irte?</h5>
                <p class="text-muted">Si eliminas tu cuenta, se borrará <strong>de forma permanente</strong> todo tu historial de pedidos y tus datos personales.</p>
                <p class="text-danger fw-bold small mb-0">Esta acción no se puede deshacer de ninguna manera.</p>
            </div>
            
            <div class="modal-footer border-0 justify-content-center bg-light">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                
                <!-- El formulario real de borrado está aquí dentro -->
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Sí, eliminar definitivamente</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection