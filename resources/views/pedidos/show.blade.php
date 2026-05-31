@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">@lang('messages.Info_Cli')</h5>
            <p class="card-text"><strong>@lang('messages.Direccion_envio')</strong> {{ $pedido->direccion_envio }}</p>
            <p class="card-text"><strong>@lang('messages.Estado'):</strong> {{ ucfirst($pedido->estado_pedido) }}</p>
            <p class="card-text"><strong>@lang('messages.Total_pagado')</strong> {{ $pedido->total }} €</p>
        </div>
    </div>

    <h4 class="mt-5">@lang('messages.Productos_Comprados')</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>@lang('messages.Producto')</th>
                <th>@lang('messages.Cantidad')</th>
                <th>@lang('messages.Precio_Unitario')</th>
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
    <a href="{{ url()->previous() }}" class="btn btn-secondary">@lang('messages.Volver_listado')</a>
    </div>
</div>
@endsection