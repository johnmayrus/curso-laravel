@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">falta pouco!, precisamos que você valide seu e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Reenviamos o e-mail com o link de validação.
                        </div>
                    @endif

                        Antes de prosseguir, verifique seu e-mail para obter um link de verificação.
                        <br>
                        Se você não recebeu o e-mail,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para solicitar outro}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
