@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Información del Cliente</h5>
            <p class="card-text"><strong>Dirección de envío:</strong> {{ $pedido->direccion_envio }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ ucfirst($pedido->estado_pedido) }}</p>
            <p class="card-text"><strong>Total Pagado:</strong> {{ $pedido->total }} €</p>
        </div>
    </div>

    <h4 class="mt-5">Productos Comprados</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->precio_unitario }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection