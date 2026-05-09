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

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Nuestro Catálogo</h1>
            <p class="text-muted">Encuentra la paz en la naturaleza</p>
        </div>

        <!--============================================================================================================-->
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
        <!--============================================================================================================-->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($productos as $producto)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 card-bonsai">
                        <div style="height: 250px; overflow: hidden;">
                            <img src="{{ $producto->imagen_url }}" class="card-img-top h-100 w-100" style="object-fit: cover;"
                                alt="{{ $producto->producto_nombre }}"
                                onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Bonsai+Do';">
                        </div>

                        <div class="card-body d-flex flex-column">


                            <p class="text-muted small">
                                {{ $producto->categoria_nombre ?? 'Sin categoría' }}
                            </p>

                            <h3 class="fs-5 fw-bold">{{ $producto->producto_nombre }}</h3>

                            <p class="text-muted small flex-grow-1">
                                {{ Str::limit($producto->descripcion ?? 'Ejemplar seleccionado de nuestra colección privada.', 90) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fs-4 fw-bold">{{ number_format($producto->precio, 2) }} €</span>

                                <form action="{{ route('carrito.add', $producto->producto_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary rounded-pill px-3">
                                        <i class="bi bi-cart-plus"></i> + Comprar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection