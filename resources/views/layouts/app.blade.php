<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>


<body class="bg">

    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light" style="z-index: 1;">
        
            <div class="container-fluid" style="width:95%;">
    
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" style="color: white !important; border: none;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon" style="color: white !important;"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <ul class="navbar-nav ml-sm-4">
                        <!-- Role Selection -->
                        <!-- If Else Admin nanti ada disini -->
                        @guest
                        @else
                            @if ( Auth::user()->is_admin != 0)
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ubah Role
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: none !important;">
                                <a class="dropdown-item" href="{{ route('home') }}">User</a>
                                <a class="dropdown-item" href="{{ route('admin_dashboard') }}">Admin</a>
                                </div>
                            </li>
                            
                            @endif
                        @endguest
                    </ul>

                    <ul class="navbar-nav ml-sm-4">
                    <!-- Fitur -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Fitur
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border: none !important;">
                            <a class="dropdown-item" href="{{ url('status-laporan') }}">Status Laporan</a>
                            <a class="dropdown-item" href="{{ url('lupa-password') }}">Layanan Lupa Password</a>
                            <a class="dropdown-item" href="{{ url('laporan-jaringan') }}">Layanan Pengaduan Jaringan</a>
                            <a class="dropdown-item" href="{{ url('layanan-email') }}">Pengajuan Email</a>
                            <a class="dropdown-item" href="{{ url('layanan-aplikasi') }}">Pengajuan Aplikasi</a>
                            <a class="dropdown-item" href="{{ url('layanan-cloud') }}">Pengajuan Cloud</a>
                            <a class="dropdown-item" href="{{ url('layanan-lpse') }}">Pengajuan Layanan PSE</a>
                            <a class="dropdown-item" href="{{ url('layanan-subdomain') }}">Pengajuan Subdomain</a>
                            </div>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-sm-4">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nama }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" style="border: none !important;" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item textProfil">NIP : {{Auth::user()->nip}}</a> 
                                    @if ( Auth::user()->no_hp != null)
                                    <a class="dropdown-item textProfil"><i class="fas fa-phone" style="margin-right:1px;"> </i>&nbsp;&nbsp;&nbsp;: {{Auth::user()->no_hp}} </a>  
                                    @else
                                    <a class="dropdown-item textProfil"><i class="fas fa-phone" style="margin-right:1px;"> </i>&nbsp;&nbsp;&nbsp;: Tambahkan Nomor Telp </a>  
                                    @endif 
                                    <div class="dropdown-divider"></div>
                                    <!-- <button id="btnETelp">asd</button> -->
                                    <a class="dropdown-item" href="#" id="btnETelp"><i class="fas fa-user-edit"></i>&nbsp; Ubah Nomor Telepon</a>
                                    <a class="dropdown-item" href="#" id="btnCPass"><i class="fas fa-pencil-alt" style="margin-right:4px !important;"></i>&nbsp; Ubah Kata Sandi</a>
                                </div>
                            </li>
                            <ul class="navbar-nav ml-sm-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Keluar') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                
                                </li>
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

@guest

@else
        
<!-- The Modal -->
<div id="myModalApp" class="ModalApp w3-animate-opacity">
  <!-- Modal content -->
  <div class="modal-contentApp">
    <span class="closeModalApp">&times;</span>       
    <div id="contentETelp"> 
    @if ( Auth::user()->no_hp != null)
      <h2><strong>Edit Nomor Telepon</strong></h2>
      <form method="post" action="{{ action ('UsersController@updateHp') }}">
      @csrf
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
          <label for="TelpNow">Nomor Telepon Sekarang</label>
          <input class="form-control" type="text" id="noTelpNow" name="telpNow" value="{{Auth::user()->no_hp}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">    
          <label for="TelpFut">No Telepon Baru</label>
          <input class="form-control" type="text" id="noTelpFut" name="telpFut" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
          <button type="submit" class="btn btn-primary" style="width:45%; background-color: #1f317f !important;">Konfirmasi</button>
        </div>
      </div>
      </form>

      @else
      <h2><strong>Tambah Nomor Telepon</strong></h2>
      <form method="post" action="{{ action ('UsersController@updateHp') }}">
      @csrf
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">    
          <label for="TelpFut">Input No Telp</label>
          <input class="form-control" type="text" id="noTelpFut" name="telpFut" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
          <button type="submit" class="btn btn-primary" style="width:45%; background-color: #1f317f !important;">Konfimasi</button>
        </div>
      </div>
      </form>

      @endif

    </div>

    <div id="contentCPass"> 
      <h2><strong>Ubah Kata Sandi</strong></h2>
      <form method="post" action="{{ action ('UsersController@ubah_password') }}">
      @csrf
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
            <label for="Sandi1">Kata Sandi Sekarang</label>
            <input class="form-control" type="password" id="passNow" name="passNow" required>
            <input type="checkbox" onclick="showPass1()">&nbsp; Lihat Kata Sandi
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
            <label for="Sandi2">Kata Sandi Sekarang</label>
            <input class="form-control" type="password" id="passFut1" name="passFut1" required>
            <input type="checkbox" onclick="showPass2()">&nbsp; Lihat Kata Sandi
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
            <label for="Sandi3">Konfirmasi Kata Sandi Sekarang</label>
            <input class="form-control" type="password" id="passFut2" name="passFut2" required>
            <input type="checkbox" onclick="showPass3()">&nbsp; Lihat Kata Sandi
        </div>
      </div>

      <div class="row">
        <div class="col-md-10 offset-md-1 form-group">
          <button type="submit" class="btn btn-primary" style="width:45%; background-color: #1f317f !important;">Ubah Kata Sandi</button>
        </div>
      </div>
      </form>
    </div>
  </div>

</div>
@endguest



        <main class="">
            @yield('content')
        </main>
    </div>

</body>


<script>
// Get the modal
var ModalApp = document.getElementById("myModalApp");
var contentETelp = document.getElementById("contentETelp");

// Get the button that opens the modal
var btnETelp = document.getElementById("btnETelp");

var btnCPass = document.getElementById("btnCPass");


// Get the <span> element that closeNumbers the modal
var span = document.getElementsByClassName("closeModalApp")[0];


// When the user clicks the button, open the modal 
btnETelp.onclick = function() {
    ModalApp.style.display = "block";
    contentETelp.style.display = "block";
    contentCPass.style.display = "none";
}

btnCPass.onclick = function() {
    ModalApp.style.display = "block";
    contentETelp.style.display = "none";
    contentCPass.style.display = "block";
}


// When the user clicks on <span> (x), closeNumber the modal
span.onclick = function() {
    ModalApp.style.display = "none";
}

// When the user clicks anywhere outside of the modal, closeNumber it
window.onclick = function(event) {
  if (event.target == ModalApp) {
    ModalApp.style.display = "none";
  }

  if (event.target == ModalAdminList) {
    ModalAdminList.style.display = "none";
  }
}

// Show Kata Sandi
function showPass1() {
  var x = document.getElementById("passNow");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function showPass2() {
  var y = document.getElementById("passFut1");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}
function showPass3() {
  var z = document.getElementById("passFut2");
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
}

</script>

<style>
    .navbar, .dropdown-menu{
        background-color: #1f317f;
    }
    .nav-link, .navbar-brand, .nav-item, .dropdown-item{
        color: white !important;
    }

    .dropdown-item:hover{
        text-decoration: none;
        background-color: #1f317f;
        opacity: 0.5;
    }

    .textProfil:hover{
      opacity:1;
      cursor:default;
    }
    
    #app{
        /* position: absolute; */
        top: 0;
    }

    main{
        margin:0 !important;
        padding: 0 !important;
    }

    /* Modal */
    



/* The Modal (background) */
.ModalApp {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-contentApp {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}


/* The closeNumber Button */
.closeModalApp {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeModalApp:hover,
.closeModalApp:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.contentETelp{
    display:none;
}


    /* End Modal */
</style>



</html>
