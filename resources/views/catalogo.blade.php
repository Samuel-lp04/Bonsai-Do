@extends('layouts.app')
@section('title', 'Catálogo de Bonsáis - Bonsai Dō')

@section('content')
    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <strong>¡Atención!</strong> {{ session('error') }}
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
                    @lang('messages.Boton_todos')
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
                                style="object-fit: cover;" alt="{{ $producto->nombre }}">
                            <p class="text-danger mt-2">@lang('messages.Ruta_img') {{ asset($producto->imagen_url) }}</p>
                        </div>

                        <div class="card-body d-flex flex-column">


                            <p class="text-muted small">
                                @forelse ($producto->categorias as $categoria)
                                    @php
                                        $traduccion = $categoria->traducciones->where('idioma', app()->getLocale())->first();
                                        $nombreCategoria = $traduccion ? $traduccion->nombre : ($categoria->traducciones->first()->nombre ?? 'Categoría sin nombre');
                                    @endphp

                                    {{ $nombreCategoria }}@if(!$loop->last), @endif
                                @empty
                                    {{ __('messages.Sin_Cat') }}
                                @endforelse
                            </p>

                            <h3 class="fs-5 fw-bold">{{ $producto->nombre }}</h3>

                            <p class="text-muted small flex-grow-1">
                                {{ $producto->descripcion }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fs-4 fw-bold text-dark">{{ number_format($producto->precio, 2) }} €</span>
                                <div class="d-flex gap-2">
                                    @if(Auth::check() && Auth::user()->rol === 'cliente')
                                        @auth
                                            @php
                                                $esFavorito = Auth::user()->favoritos->contains('id', $producto->id);
                                            @endphp
                                            <form action="{{ route('favoritos.toggle', $producto->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn {{ $esFavorito ? 'btn-pizarra' : 'btn-outline-pizarra' }} rounded px-2"
                                                    title="Favorito">
                                                    <i class="bi bi-heart-fill fs-5"></i>
                                                </button>
                                            </form>
                                        @endauth
                                    @endif
                                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
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