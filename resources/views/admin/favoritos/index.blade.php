@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Favoritos</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                @if($productosTop->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-bar-chart-line text-muted display-1"></i>
                        <p class="text-muted mt-3 fs-5">Aún no hay datos. Los clientes no han guardado ningún favorito.</p>
                    </div>

                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 10%;">Top</th>
                                    <th scope="col" style="width: 45%;">Bonsái</th>
                                    <th scope="col" style="width: 20%;">Precio</th>
                                    <th scope="col" class="text-center" style="width: 25%;">Veces Guardado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productosTop as $index => $producto)
                                    <tr>
                                        <td class="text-center fw-bold fs-5 text-dark">
                                            @if($index == 0)
                                                <span title="Oro">🥇</span>
                                            @elseif($index == 1)
                                                <span title="Plata">🥈</span>
                                            @elseif($index == 2)
                                                <span title="Bronce">🥉</span>
                                            @else
                                                <span class="text-muted">{{ $index + 1 }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-3 py-2">
                                                <img src="{{ asset($producto->imagen_url) }}" alt="{{ $producto->nombre }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                                <h3 class="fs-5 fw-bold text-body">{{ $producto->nombre }}</h3>
                                            </div>
                                        </td>

                                        <td class="fw-bold text-dark">
                                            {{ number_format($producto->precio, 2) }} €
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill fs-6 px-3 py-2 shadow-sm">
                                                <i class="bi bi-heart-fill me-1"></i>
                                                {{ $producto->usuarios_favoritos_count }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center mt-4">
            <a href="{{ url('home') }}" class="btn btn-outline-pizarra-oscuro">
                <i class="bi bi-arrow-left"></i> Volver al catálogo
            </a>
        </div>
    </div>
@endsection