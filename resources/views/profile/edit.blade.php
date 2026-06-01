@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Título de la página -->
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-dark">@lang('messages.Perfil_titulo')</h1>
                    <p class="text-muted">@lang('messages.Perfil_subtitulo')</p>
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
                        <h3 class="fw-bold mb-4">@lang('messages.Datos')</h3>
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name"
                                        class="form-label text-muted fw-semibold">@lang('messages.Nombre')</label>
                                    <input type="text"
                                        class="form-control py-2 px-3 border @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="telefono"
                                        class="form-label text-muted fw-semibold">@lang('messages.Telefono')</label>
                                    <input type="text"
                                        class="form-control py-2 px-3 border @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}"
                                        required>
                                    @error('telefono') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email"
                                    class="form-label text-muted fw-semibold">@lang('messages.Correo_Electronico')</label>
                                <input type="email"
                                    class="form-control py-2 px-3 border @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit"
                                    class="btn btn-primary px-4 py-2">@lang('messages.Guardar_Cambios')</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- TARJETA 2: Cambiar Contraseña -->
                <div class="card shadow-sm border-0 mb-4 p-4">
                    <div class="card-body">
                        <h3 class="fw-bold mb-4">@lang('messages.Seguridad')</h3>
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="current_password"
                                    class="form-label text-muted fw-semibold">@lang('messages.Contraseña_Actual')</label>
                                <input type="password"
                                    class="form-control py-2 px-3 border @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required>
                                @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="password"
                                        class="form-label text-muted fw-semibold">@lang('messages.Nueva_Contraseña')</label>
                                    <input type="password"
                                        class="form-control py-2 px-3 border @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation"
                                        class="form-label text-muted fw-semibold">@lang('messages.Confirmar_Contraseña')</label>
                                    <input type="password" class="form-control py-2 px-3 border" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit"
                                    class="btn btn-outline-primary px-4 py-2">@lang('messages.Actualizar_Contraseña')</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->rol === 'cliente')
                    <!-- LISTA DE FAVORITOS -->
                    <div class="card shadow-sm border-0 mb-4 p-3">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">@lang('messages.Bonsais_Fav')</h3>

                            @if($favoritos->isEmpty())
                                <div class="text-center py-4">
                                    <i class="bi bi-heart text-muted display-1"></i>
                                    <p class="text-muted mt-3">@lang('messages.No_Fav')</p>
                                    <a href="{{ route('catalogo') }}"
                                        class="btn btn-outline-success mt-2">@lang('messages.Explorar_Catálogo')</a>
                                </div>

                            @else
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    @foreach($favoritos as $producto)
                                        <div class="col">
                                            <div class="card h-100 border-0 shadow-sm card-bonsai">
                                                <img src="{{ asset($producto->imagen_url) }}" class="card-img-top h-100 w-100"
                                                    style="object-fit: cover;" alt="{{ $producto->producto_nombre }}">
                                                <div class="card-body text-center">
                                                    <h3 class="fs-5 fw-bold">{{ $producto->nombre }}</h3>
                                                    <p class="fs-4 fw-bold text-dark">{{ number_format($producto->precio, 2) }} €</p>

                                                    <form action="{{ route('favoritos.toggle', $producto->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                            <i class="bi bi-heartbreak"></i> @lang('messages.Quitar_Fav')
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- SECCION DE PEDIDOS -->
                    <div class="card shadow-sm border-0 mb-4 p-3">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">@lang('messages.Pedidos_Recientes')</h3>
                            @include('pedidos.partial.mis-pedidos')
                        </div>
                    </div>

                    <!-- CRUD DIRECCIONES -->
                    <div class="card shadow-sm border-0 mb-4 p-3">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">@lang('messages.Gestion_Direcciones')</h3>
                            <div class="card-body">
                                <form method="POST" id="form-compra">
                                    @csrf

                                    @forelse($direcciones as $dir)
                                        <div class="form-check border p-3 mb-2 rounded">
                                            <input class="form-check-input" type="radio" name="direccion_id" id="dir{{ $dir->id }}"
                                                value="{{ $dir->id }}" data-calle="{{ $dir->calle }}"
                                                data-numero="{{ $dir->numero }}" data-ciudad="{{ $dir->ciudad }}"
                                                data-cp="{{ $dir->codigo_postal }}" required {{ $loop->first ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2" for="dir{{ $dir->id }}">
                                                <strong>{{ $dir->calle }} {{ $dir->numero }}</strong><br>
                                                <small class="text-muted">{{ $dir->ciudad }}, CP: {{ $dir->codigo_postal }}</small>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="alert alert-warning text-center">
                                            @lang('messages.No_Direcciones')
                                        </div>
                                    @endforelse

                                    <div class="mt-4 d-flex gap-2 align-items-center">
                                        <button type="button" class="btn btn-bonsai btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalNuevaDireccion">
                                            @lang('messages.Añadir_Direccion')
                                        </button>

                                        @if($direcciones->isNotEmpty())
                                            <button type="submit" formaction="{{ route('direccion.editar.seleccionada') }}"
                                                class="btn btn-bonsai btn-sm">
                                                <i class="bi bi-pencil"></i> @lang('messages.Editar_Direccion')
                                            </button>

                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalBorrarDireccion">
                                                <i class="bi bi-trash"></i> @lang('messages.Borrar_Direccion')
                                            </button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- BOTÓN DE BORRAR CUENTA DISCRETO -->
                <div class="text-center mt-5 mb-4">
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#modalBorrarCuenta">
                        @lang('messages.Eliminar_Cuenta')
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL EMERGENTE: Aviso Permanente -->
    <div class="modal fade" id="modalBorrarCuenta" tabindex="-1" aria-labelledby="modalBorrarCuentaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold" id="modalBorrarCuentaLabel">@lang('messages.Advertencia_critica')</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4 text-center">
                    <h5 class="mb-3">@lang('messages.Pregunta_irte')</h5>
                    <p class="text-muted">@lang('messages.Msg_eliminar')</p>
                    <p class="text-danger fw-bold small mb-0">@lang('messages.No_Deshacer')</p>
                </div>

                <div class="modal-footer border-0 justify-content-center bg-light">
                    <button type="button" class="btn btn-secondary px-4"
                        data-bs-dismiss="modal">@lang('messages.Cancelar')</button>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">@lang('messages.Si_eliminar')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL NUEVA DIRECCION-->
    <div class="modal fade" id="modalNuevaDireccion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">@lang('messages.Nueva_direccion')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('direccion.guardar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Calle')</label>
                            <input type="text" name="calle" class="form-control" placeholder="Ej: Avenida de la Palmera"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Numero')</label>
                            <input type="number" name="numero" class="form-control" placeholder="Ej: 15" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.Ciudad')</label>
                                <input type="text" name="ciudad" class="form-control" placeholder="Ej: Sevilla" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.C_Postal')</label>
                                <input type="number" name="codigo_postal" class="form-control" placeholder="41012" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-bonsai" data-bs-dismiss="modal">@lang('messages.Cancelar')</button>
                        <button type="submit" class="btn btn-primary">@lang('messages.Guardar_direccion')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal borrar direccion-->
    <div class="modal fade" id="modalBorrarDireccion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">@lang('messages.Borrar_Direccion_Titulo')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('direccion.borrar.seleccionada') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-center">@lang('messages.Borrar_Direccion_Texto')</p>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-bonsai" data-bs-dismiss="modal">@lang('messages.Cancelar')</button>
                        <button type="submit" form="form-compra" formaction="{{ route('direccion.borrar.seleccionada') }}"
                            class="btn btn-outline-danger">
                            @lang('messages.Borrar_Direccion_boton')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection