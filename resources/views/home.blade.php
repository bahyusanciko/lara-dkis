@extends('layouts.app')

@section('content')
    @include('includes.header')
    {{-- <!-- @include('includes.sidebar') --> --}}
    <div class="container-fluid " style="width: 80%;">
        @if (session('status'))
            <div class="alert alert-success" style="justify-content:center; text-align: center;">
                <h5 style="text-align:center;"> {{ session('status') }} </h5>
            </div>
        @endif
        <h1 style="text-align: center;  letter-spacing: 0.1em;"><strong>Helpdesk Portal Layanan DKIS</strong></h1> 
        <div class="row" style="padding: 4% 0;"> 
            <div class="col-md box-fitur" >
                <a href="{{ url('status-laporan') }}">
                    <i class="fas fa-desktop icon"></i>
                    <h3> <strong> Status <br/> Laporan </strong></h3>
                </a>
            </div>
            <div class="col-md box-fitur">
                <a href="{{ url('lupa-password') }}">
                    <i class="fas fa-lock icon"></i>
                    <h3> <strong> Lupa <br/> Password </strong></h3>
                </a>
            </div>
            <div class="col-md box-fitur">
                <a href="{{ url('laporan-jaringan') }}">
                    <i class="fas fa-wifi icon"></i>
                    <h3> <strong> Pengaduan <br/> Jaringan </strong></h3>
                </a>
            </div>
 
            <div class="col-md box-fitur">
                <a href="{{ url('layanan-email') }}">
                    <i class="fas fa-at icon"></i>
                    <h3> <strong> Pengajuan <br/> Email </strong></h3>
                </a>
            </div>

        </div>
        <div class="row" > 


            <div class="col-md box-fitur">
                <a href="{{ url('layanan-aplikasi') }}">
                    <i class="fab fa-google-play icon"></i>
                    <h3> <strong> Pengajuan <br/> Aplikasi </strong></h3>
                </a>
            </div>

            <div class="col-md box-fitur">
                <a href="{{ url('layanan-cloud') }}">
                    <i class="fas fa-cloud icon"></i>
                    <h3> <strong> Pengajuan <br/> Cloud </strong></h3>
                </a>
            </div>

            <div class="col-md box-fitur">
                <a href="{{ url('layanan-lpse') }}">
                    <i class=" fas icon" style="inline;">
                    <img src="{{ url('/assets/logo-pse-putih.png') }}" alt="" width="70px" height="50px" style="inline;">
                    </i>
                    <h3> <strong> Pengajuan <br/> PSE </strong></h3>
                </a>
            </div>

            <div class="col-md box-fitur">
                <a href="{{ url('layanan-subdomain') }}">
                    <i class="fas icon">
                    <img src="{{ url('/assets/logo-subdomain.png') }}" alt="" width="70px" height="50px" style="inline;">
                    
                    </i>
                    
                    <h3> <strong> Pengajuan <br/> Subdomain </strong></h3>
                </a>
            </div>
        </div>

        <br><br>

        <div class="row" style="">
            <div class="col-sm"></div>
                <div class="col-sm-4 box-fitur">
                    <a href="http://dkis.cirebonkota.go.id/"  target="_blank">
                        <button class="button-pill"> <strong> Halaman DKIS </strong></button>
                    </a>
                </div>
            <div class="col-sm"></div>
        </div>
        
        <br><br><br><br>

    </div>
    
    
    
    @include('includes.helpbutton')
    

@endsection
