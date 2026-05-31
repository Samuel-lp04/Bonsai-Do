@extends('layouts.app')

@section('content')


    <div class="container mb-5 mt-4">
        @error('direccion_id')
            <div class="text-danger mt-2 fw-bold">
                {{ $message }}
            </div>
        @enderror
        <h2 class="fw-bold mb-4">@lang('messages.Pago')</h2>

        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">@lang('messages.Direcciones')</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comprar.procesar') }}" method="POST" id="form-compra">
                            @csrf

                            @forelse($direcciones as $dir)
                                <div class="form-check border p-3 mb-2 rounded">
                                    <input class="form-check-input" type="radio" name="direccion_id" id="dir{{ $dir->id }}"
                                        value="{{ $dir->id }}" required {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="dir{{ $dir->id }}">
                                        <strong>{{ $dir->calle }} {{ $dir->numero }}</strong><br>
                                        <small class="text-muted">{{ $dir->ciudad }}, CP: {{ $dir->codigo_postal }}</small>
                                    </label>
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">
                                    @lang('messages.No_Direcciones')
                                </div>
                            @endforelse

                            <div class="mt-4">
                                <button type="button" class="btn btn-bonsai btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalNuevaDireccion">
                                    @lang('messages.Añadir_Direccion')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">@lang('messages.Resumen_Pedido')</h4>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5">@lang('messages.Total')</span>
                            <span class="fs-4 fw-bold text-success">{{ number_format($total_del_carro, 2) }} €</span>
                        </div>
                        <button type="submit" form="form-compra" class="btn btn-bonsai btn-lg w-100">
                            @lang('messages.Confirmar_Compra')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNuevaDireccion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">@lang('messages.Nueva_direccion')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('direccion.guardar') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Calle')</label>
                            <input type="text" name="calle" class="form-control" placeholder="Ej: Avenida de la Palmera"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Numero')</label>
                            <input type="number" name="numero" class="form-control" placeholder="Ej: 15" required>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.Ciudad')</label>
                                <input type="text" name="ciudad" class="form-control" placeholder="Ej: Sevilla" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.C_Postal')</label>
                                <input type="number" name="codigo_postal" class="form-control" placeholder="41012" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">@lang('messages.Cancelar')</button>
                        <button type="submit" class="btn btn-primary">@lang('messages.Guardar_direccion')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection