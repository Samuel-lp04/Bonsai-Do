@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    ✉️ Verifica tu correo electrónico
                </div>

                <div class="card-body p-4 text-center">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Te hemos enviado un nuevo enlace de verificación a tu correo.
                        </div>
                    @endif

                    <h5 class="mb-3">¡Casi hemos terminado!</h5>
                    <p class="text-muted">Antes de poder continuar explorando nuestros bonsáis, por favor revisa tu correo electrónico para encontrar el enlace de verificación.</p>
                    <p class="text-muted">Si no has recibido el correo electrónico, puedes solicitar otro a continuación.</p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-success mt-2">Hacer clic aquí para enviar otro enlace</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection