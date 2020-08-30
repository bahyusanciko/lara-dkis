@extends('layouts.app')

@section('content')

<body class="bg">
    <div class="container-fluid login-form"> 
        <div class="row">
            <div class="col-sm box-img">
                <img src="{{ asset('assets/logo dkis.png') }}" alt="" class="login-img">
                <br><br>
                <p style="font-size: 28px; padding-top: 10px; text-align:center;" id="hideCaption"><strong>Layanan Internal DKIS</strong></p>
            </div>
            <div class="col-sm-1 "></div>
            <div class="col-sm" id="register">
                <form method="post" action="#">
                    @csrf
                    <div class="form-group box-login" >
                    <h3 style="text-align:center; " ><strong>PENDAFTARAN AKUN</strong></h3>
                        <label for="nip" style="display: inline-block !important;"><strong>{{ __('NIP') }}</strong></label>
                        <input type="text" name="nip" class="form-control input-form" id="nip" placeholder="Masukan NIP">
                        <label for="nama" style="display: inline-block !important;"><strong>{{ __('Nama') }}</strong></label>
                        <input type="text" name="nama" class="form-control input-form" id="nama" placeholder="Masukan nama">
                        <label for="email" style="display: inline-block;"><strong>{{ __('Alamat E-mail') }}</strong></label>
                        <input type="email" name="email" class="form-control input-form @error('email') is-invalid @enderror" id="email" placeholder="Masukan Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password" style="display: inline-block;"><strong>{{ __('Password') }}</strong></label>
                        <input type="password" name="password" class="form-control input-form @error('password') is-invalid @enderror" id="password" placeholder="Masukan Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password_confirmation" style="display: inline-block;"><strong>{{ __('Password Konfirmasi') }}</strong></label>
                        <input type="password" name="password_confirmation" class="form-control input-form" id="password_confirmation" placeholder="Masukan Ulang Password">
                        <br><br>
                        <button type="submit" class="btn btn-success" style="width: 100%; letter-spacing: 0.2em;">Daftar</button>
                        <div class="separator">memiliki akun?</div>
                        <!-- <hr> -->
                    </div>
                </form>
                <a href="{{ route('login') }}"> <button class="btn btn-primary button-login" style="width: 100%; letter-spacing: 0.2em; " >Masuk</button></a>
           
                <!-- <p style="text-align:left;">Untuk masuk<a href="{{ route('login')}}" id="hide"> klik disini</a></p> -->
            </div>
        </div>
    </div>

</body>



<style>


@media only screen and (max-width: 600px) {
    /* Login Section */
    .login-form{
        display: flex;
        justify-content: center;
        flex-direction: column;
        border-radius: 10px;
        border-color: #F5F5F5;
        padding: 20px 20px 20px 20px;
        background-color: #F5F5F5;
        min-width: 80%;
    }

    #hideCaption{
        display:none !important;
    }

    .login-img{
        width: 50%;
        height: 50%;
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
        padding: 20px 20px 20px 20px;
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
