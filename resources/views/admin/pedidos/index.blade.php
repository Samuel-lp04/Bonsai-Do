@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Pedidos</h2>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha de Compra</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                    <tr>
                        <td class="align-middle fw-bold">#{{ $pedido->id }}</td>
                        
                        <td class="align-middle">{{ $pedido->user->name ?? 'Cliente Desconocido' }}</td>
                        
                        <td class="align-middle">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        
                        <td class="align-middle fw-bold text-success">{{ number_format($pedido->total, 2, ',', '.') }} €</td>
                        
                        <td class="align-middle">
                           @if($pedido->estado_pedido == 'En preparación')
                                <span class="badge bg-warning text-dark px-3 py-2">En preparación</span>
                            @elseif($pedido->estado_pedido == 'En camino')
                                <span class="badge bg-info text-dark px-3 py-2">En camino</span>
                            @elseif($pedido->estado_pedido == 'cancelado')
                                <span class="badge bg-danger px-3 py-2">Cancelado</span>
                            @elseif($pedido->estado_pedido == 'completado')
                                <span class="badge bg-success px-3 py-2">Completado</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">{{ ucfirst($pedido->estado_pedido) }}</span>
                            @endif      
                        </td>
                        
                        <td class="align-middle text-center">
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary text-white">Ver Detalles</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($pedidos->isEmpty())
        <div class="alert alert-info text-center mt-4">
            Aún no se ha realizado ningún pedido en la tienda.
        </div>
    @endif
</div>
@endsection