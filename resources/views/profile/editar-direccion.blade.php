@extends('layouts.app')

@section('title', 'Editar Dirección - Bonsai Dō')

@section('content')
<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <h3 class="fw-bold mb-4">@lang('messages.Modificar_Direccion')</h3>
                    
                    <form action="{{ route('direccion.actualizar', $direccion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Calle')</label>
                            <input type="text" name="calle" class="form-control" value="{{ $direccion->calle }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">@lang('messages.Numero')</label>
                            <input type="number" name="numero" class="form-control" value="{{ $direccion->numero }}" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.Ciudad')</label>
                                <input type="text" name="ciudad" class="form-control" value="{{ $direccion->ciudad }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted small mb-1">@lang('messages.C_Postal')</label>
                                <input type="number" name="codigo_postal" class="form-control" value="{{ $direccion->codigo_postal }}" required>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('profile.edit') }}" class="btn btn-bonsai">@lang('messages.Cancelar')</a>
                            <button type="submit" class="btn btn-pizarra">@lang('messages.Guardar_Cambios')</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection