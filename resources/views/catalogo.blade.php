@extends('layouts.app') @section('title', 'Catálogo de Bonsáis - Bonsai Dō')

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

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($productos as $producto)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body d-flex flex-column">
                        <h3 class="fs-5">{{ $producto->nombre }}</h3>
                        <p class="text-muted small">
                            {{ $producto->categorias->pluck('nombre')->join(', ') }}
                        </p>
                        <p class="card-text small">{{ Str::limit($producto->descripcion, 70) }}</p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold">{{ number_format($producto->precio, 2) }} €</span>
                            
                            <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-bonsai btn-sm">
                                    + Comprar
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