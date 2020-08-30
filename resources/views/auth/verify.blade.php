@extends('layouts.app')
@include('includes.head')
@section('content')
<body class="bg">

<div class="container verifyBox">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" >
                <h5 class="card-header">{{ __('verifikasi alamat E-mail anda') }}</h5>

                <div class="card-body" style="padding: 30px;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link untuk verifikasi sudah di kirimkan ke alamat E-mail anda.') }}
                        </div>
                    @endif
                    
                    {{ __('Sebelum melanjutkan, silahkan periksa E-mail anda untuk memverifikasi.') }}
                    {{ __('Bila anda tidak menerima E-mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk meminta lagi') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>

<style>
    .verifyBox{
        position: fixed;
        left: 50%;
        top: 50%;   
        transform: translate(-50%, -50%);

    }
</style>
@endsection
