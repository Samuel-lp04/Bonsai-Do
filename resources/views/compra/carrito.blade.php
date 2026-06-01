@extends('layouts.app')

@section('title', 'Tu Carrito de la Compra - Bonsai Dō')

@section('content')
    <div class="container mb-5 mt-4">

        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">@lang('messages.Carrito_titulo')</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('carrito') && count(session('carrito')) > 0)
                    <div class="row">

                        <div class="col-md-7">
                            @php $total = 0; @endphp

                            @foreach(session('carrito') as $id => $item)
                                @php $total += $item['precio'] * $item['cantidad']; @endphp

                                <div class="card shadow-sm border-0 mb-3 rounded-0 border-start border-4 border-secondary">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="me-3 bg-light" style="width: 80px; height: 80px; overflow: hidden;">
                                            <img src="{{ $item['imagen_url'] ?? 'https://via.placeholder.com/80' }}"
                                                alt="{{ $item['nombre'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="fw-bold text-dark mb-1">{{ $item['nombre'] }}</h5>

                                            <div class="mb-3">
                                                <span class="fs-5 fw-bold text-success">
                                                    [ {{ number_format($item['precio'] * $item['cantidad'], 2) }} € ]
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <span class="text-muted small me-2">@lang('messages.Cantidad'):</span>

                                                <form action="{{ route('carrito.update', $id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="accion" value="restar">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-secondary py-0 px-2 rounded-0 shadow-none">-</button>
                                                </form>

                                                <span class="mx-3 fw-bold text-dark" style="min-width: 20px; text-align: center;">
                                                    {{ $item['cantidad'] }}
                                                </span>

                                                <form action="{{ route('carrito.update', $id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="accion" value="sumar">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-secondary py-0 px-2 rounded-0 shadow-none">+</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-5">
                            <div class="bg-white p-4 shadow-sm border border-secondary border-1 border-dashed">
                                <h5 class="mb-4 text-center fw-bold text-dark">@lang('messages.Resumen_Pedido')</h5>

                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span>@lang('messages.Subtotal')</span>
                                    <span>[ {{ number_format($total, 2) }} € ]</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="mb-0 fw-bold">@lang('messages.Total')</h4>
                                    <span class="fs-4 fw-bold text-dark">[ {{ number_format($total, 2) }} € ]</span>
                                </div>

                                @guest
                                    <div class="border border-secondary p-4 text-center mt-3 bg-light">
                                        <div class="text-warning fs-3 mb-2">🔒</div>
                                        <h6 class="fw-bold text-dark">@lang('messages.Sesion_Requerida')</h6>
                                        <p class="text-muted small mb-3">@lang('messages.Msg_Sesion_Requerida')</p>

                                        <div class="d-grid gap-2">
                                            <a href="{{ route('login') }}" class="btn btn-outline-dark fw-bold rounded-0">
                                                @lang('messages.Iniciar_sesion')
                                            </a>
                                            <a href="{{ route('register') }}" class="btn btn-outline-secondary rounded-0">
                                                @lang('messages.Registrar')
                                            </a>
                                        </div>
                                    </div>
                                @endguest

                                @auth
                                    <div class="d-grid mt-4">
                                        <a href="{{ route('checkout') }}" class="btn btn-bonsai btn-lg fw-bold rounded-0">
                                            @lang('messages.Tramitar_Pedido')
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>

                    </div>
                @else
                    <div class="text-center py-5 bg-white shadow-sm border border-secondary border-dashed">
                        <h3 class="text-muted mb-3">@lang('messages.Carrito_Vacio')</h3>
                        <a href="{{ route('catalogo') }}" class="btn btn-outline-secondary mt-2 rounded-0">@lang('messages.Volver_Catalogo')</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection