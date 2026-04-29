<!doctype html>
<html lang="{{ str_replace('', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/bootstrap.bundle.min.js'])
</head>
<body>
	<div id="app">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand py-0" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Bonsai Do" style="height: 80px; width: auto;">
                </a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ ('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Lado Izquierdo de la Barra -->
					<ul class="navbar-nav me-auto">
						@auth @if(Auth::user()->rol === 'admin')
						<li class="nav-item">
							<a class="nav-link text-success fw-bold" href="{{ route('pedidos.index') }}">📦 Pedidos Clientes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-success fw-bold" href="{{ url('admin/productos') }}">🌱 Gestión Bonsáis</a>
						</li>
						@else
						<li class="nav-item">
							<a class="nav-link text-success fw-bold" href="{{ route('catalogo') }}">📖 Catálogo</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-success fw-bold" href="{{ route('carrito.ver') }}">
                        🛒 Carrito 
                        <span class="badge bg-success rounded-pill">
                            {{ count(session('carrito', [])) }}
                        </span>
                    </a>
						</li>
						@endif @endauth
					</ul>

					<!-- Lado Derecho de la Barra -->
					<ul class="navbar-nav ms-auto">
						<!-- Enlaces de Autenticación -->
						@guest @if (Route::has('login'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ ('Entrar') }}</a>
						</li>
						@endif @if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ ('Registrarse') }}</a>
						</li>
						@endif @else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    👤 {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->rol) }})
                </a>

							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<!-- Enlace a tu CRUD de Perfil -->
								<a class="dropdown-item" href="{{ route('profile.edit') }}">⚙️ Mi Perfil</a> @if(Auth::user()->rol === 'cliente')
								<a class="dropdown-item" href="{{ route('mis-pedidos') }}">🛍️ Mis Compras</a> @endif

								<div class="dropdown-divider"></div>

								<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        🚪 {{ ('Cerrar sesión') }}
                    </a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="py-4">
			@yield('content')
		</main>
	</div>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>