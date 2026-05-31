@extends('layouts.app')
@section('title', 'Catálogo de Bonsáis - Bonsai Dō')

@section('content')
    <div class="container mb-5">
        <div class="selector-idiomas">
            <a href="{{ route('lang.switch', 'es') }}">🇪🇸 Español</a>
            <a href="{{ route('lang.switch', 'en') }}">🇬🇧 English</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">@lang('messages.Catalogo_titulo')</h1>
            <p class="text-muted">@lang('messages.Catalogo_subtitulo')</p>
        </div>


        <div class="row mb-5">
            <div class="col-12 text-center">
                <a href="{{ route('catalogo') }}"
                    class="btn {{ is_null($categoria_id) ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill me-2 mb-2 px-4">
                    Todos
                </a>

                @foreach($categorias as $cat)
                    <a href="{{ route('catalogo.categoria', $cat->id) }}"
                        class="btn {{ $categoria_id == $cat->id ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill me-2 mb-2 px-4">
                        {{ $cat->nombre }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($productos as $producto)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 card-bonsai">
                        <div style="height: 250px; overflow: hidden;">
                            <img src="{{ asset($producto->imagen_url) }}" class="card-img-top h-100 w-100"
                                style="object-fit: cover;" alt="{{ $producto->producto_nombre }}">
                            <p class="text-danger mt-2">Ruta generada: {{ asset($producto->imagen_url) }}</p>
                        </div>

                        <div class="card-body d-flex flex-column">


                            <p class="text-muted small">
                                {{ $producto->categoria_nombre ?? 'Sin categoría' }}
                            </p>

                            <h3 class="fs-5 fw-bold">{{ $producto->producto_nombre }}</h3>

                            <p class="text-muted small flex-grow-1">
                                {{ $producto->descripcion }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fs-4 fw-bold text-dark">{{ number_format($producto->precio, 2) }} €</span>
                                <div class="d-flex gap-2">
                                    @auth
                                        @php
                                            $esFavorito = Auth::user()->favoritos->contains('id', $producto->producto_id);
                                        @endphp
                                        <form action="{{ route('favoritos.toggle', $producto->producto_id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn {{ $esFavorito ? 'btn-pizarra' : 'btn-outline-pizarra' }} rounded px-2" title="Favorito">
                                                <i class="bi bi-heart-fill fs-5"></i>
                                            </button>
                                        </form>
                                    @endauth

                                    <form action="{{ route('carrito.add', $producto->producto_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary rounded-pill px-3">
                                            <i class="bi bi-cart-plus"></i>@lang('messages.Boton_compra')
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection