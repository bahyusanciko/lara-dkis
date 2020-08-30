@extends('layouts.app')

@section('content')

<div class="container-fluid login-form">
    <div class="row">
        
        <div class="col-md box-img">
            <img src="{{ asset('assets/logo dkis.png') }}" alt="" class="login-img">
            <br><br>
            <h1 style="font-size: 28px; padding-top: 10px; text-align:center;" id="hideCaption"><strong>Layanan Internal DKIS</strong></h1>
        </div>

        <div class="col-md-1 "></div>
        
        <div class="col-md" id="login">
            @if (session('status'))
                <div class="alert alert-danger " style="width: 90%; text-align:center; display:inline-block;">
                    {{ session('status') }}
                </div>
            @endif
            <h3 style="text-align:center; " ><strong>MASUK LAYANAN</strong></h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group box-login">
                    <label for="NIP"><strong>NIP</strong></label>
                    <input id="nip" type="text" class="form-control input-form @error('nip') is-invalid @enderror" name="nip" placeholder="Masukan NIP" value="{{ old('nip') }}"style="display: inline;" required autocomplete="nip" autofocus>
                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="Password" style="display: inline-block;"><strong>Password</strong></label>
                    <input id="password" type="password" class="form-control input-form @error('password') is-invalid @enderror" name="password" placeholder="Masukan Password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br><br>
                        <button type="submit" class="btn btn-primary button-login" style="float: bottom;">Masuk</button>
                        <div class="separator">atau</div>
                        
                   
                </div>
                
            </form>
            <a href="{{ route('register') }}"> <button class="btn btn-success" style="width: 100%; letter-spacing: 0.2em;" href="">Daftar</button></a>
           
        </div>
    </div>
</div>



<style>

@media only screen and (max-width: 600px) {
    /* Login Section */
    .login-form{
        display: flex;
        justify-content: center;
        flex-direction: column;

        border-radius: 10px;
        border-color: #F5F5F5;
        padding: 40px 20px 40px 20px;
        background-color: #F5F5F5;
        min-width: 80%;
    }

    #hideCaption{
        display:none !important;
    }

}

@media only screen and (max-width: 768px) {
    /* Login Section */
    .login-form{
        display: flex;
        justify-content: center;
        flex-direction: column;

        border-radius: 10px;
        border-color: #F5F5F5;
        padding: 40px 20px 40px 20px;
        background-color: #F5F5F5;
        min-width: 80%;
    }

}


.separator {
    display: flex;
    align-items: center;
    text-align: center;
}
.separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #000;
}
.separator::before {
    margin-right: .25em;
}
.separator::after {
    margin-left: .25em;
}
</style>

@endsection


