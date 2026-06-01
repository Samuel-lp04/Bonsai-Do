<div class="container-fluid mb-5 px-0">

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">@lang('messages.Pedidos_titulo')</h1>
        <p class="text-muted">@lang('messages.Pedidos_subtitulo')</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="ps-4 py-3">@lang('messages.N_Pedido')</th>
                                    <th scope="col" class="py-3">@lang('messages.Fecha')</th>
                                    <th scope="col" class="py-3">@lang('messages.total')</th>
                                    <th scope="col" class="pe-4 py-3 text-end">@lang('messages.Estado')</th>
                                    <th scope="col" class="pe-4 py-3 text-end">@lang('messages.Detalles')</th>
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
                                            <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                class="btn btn-primary text-white">@lang('messages.Ver_Detalles')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('catalogo') }}" class="btn btn-bonsai">@lang('messages.Seguir_Comprando')</a>
            </div>
        </div>
    </div>
</div>