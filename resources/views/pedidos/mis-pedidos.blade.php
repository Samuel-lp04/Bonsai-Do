@extends('layouts.app')

@section('title', 'Mis Pedidos - Bonsai Dō')

@section('content')
    <div class="container mb-5">

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Mis Pedidos</h1>
            <p class="text-muted">Sigue el rastro de tus bonsáis hasta tu hogar</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="ps-4 py-3">Nº de Pedido</th>
                                    <th scope="col" class="py-3">Fecha</th>
                                    <th scope="col" class="py-3">Total</th>
                                    <th scope="col" class="pe-4 py-3 text-end">Estado</th>
                                    <th scope="col" class="pe-4 py-3 text-end">Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr>
                                        <td class="ps-4 py-3 fw-bold text-secondary">
                                            #{{ $pedido->id }}
                                        </td>
                                        <td class="py-3">
                                            {{ $pedido->fecha_pedido->format('d/m/Y') }}
                                        </td>
                                        <td class="py-3 fw-semibold">
                                            {{ number_format($pedido->total, 2) }} €
                                        </td>
                                        <td class="pe-4 py-3 text-end">
                                            @if($pedido->estado_pedido == 'Enviado')
                                                <span
                                                    class="badge bg-success px-3 py-2 rounded-pill">{{ $pedido->estado_pedido }}</span>
                                            @elseif($pedido->estado_pedido == 'En preparación')
                                                <span
                                                    class="badge bg-warning text-dark px-3 py-2 rounded-pill">{{ $pedido->estado_pedido }}</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary px-3 py-2 rounded-pill">{{ $pedido->estado_pedido }}</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 py-3 text-end">
                                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info text-white">Ver Detalles</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary">Seguir comprando</a>
                </div>
            </div>
        </div>
    </div>
@endsection