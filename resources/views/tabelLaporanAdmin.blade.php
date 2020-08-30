@extends('layouts.app')

@section('content')

<body class="bg">

@include('includes.header')
<div class="container-fluid" style="background-color: #F5F5F5; padding-top:10px; width: 98%;">

<div class="row">

<div class="col-sm-2">
    <a href="{{ route('admin_dashboard') }}">
      <button type="button" class="btn btn-primary btn-back" style="background-color: #1f317f;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
    </a>
    <br><br>
    <div class="btn-group">
            <button type="button" class="btn btnPengajuan btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pilih Laporan
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Semua Laporan</a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/lupa_password') }}">Laporan Pengaduan Lupa Password</a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/jaringan') }}">Laporan Pengaduan Jaringan </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/pengajuan_layanan') }}">Laporan Pengajuan Layanan </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/status-LPSE-admin') }}">Layanan Pengajuan LPSE </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/status-subDomain-admin') }}">Layanan Pengajuan Subdomain </a>
              <a class="dropdown-item" href="#">Laporan Pengajuan Jaringan </a>
              <a class="dropdown-item" href="#">Layanan Pengajuan LPSE </a>
            </div>
    </div>
</div>
<div class="col-sm">  
@if (\Session::has('message'))
    <div class="alert alert-success">
            <h5 style="text-align:center;">{!! \Session::get('message') !!}</h5>
    </div>
@endif
</div>
<div class="col-sm-2">

</div>

</div>
<!-- start Table -->
  @if (@count($laporans) == 0)
  <div class="contentDbAdmin" style=" padding-bottom:100px;  padding-top:100px;  justify-content:center; margin: auto; text-align: center;">
    <h1><strong>Tidak Ada Laporan yang Masuk</strong></h1>
    
  </div>
  @else
  <div class="row">
      
    <div class="col-sm" id="laporanContent">
      <div class="contentDbAdmin">
        <!-- <hr style="width: 100% !important;"> -->
        <br>
        <div class= "table-responsive">

        <table class="table table-striped table-bordered table-hover" id="tLaporan">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nomor Tiket</th>
              <th scope="col">Tanggal</th>
              <th scope="col">NIP</th>
              <th scope="col">Jenis Pengajuan</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($laporans as $laporan)
            <tr>
              <th scope="col" class="idLaporan">{{ $laporan->id }}</th>
              <th scope="col">{{ $laporan->tanggal_laporan }}</th>
              <th scope="col">{{ $laporan->nip }}</th>
              <th scope="col">{{ $laporan->jenis_pengajuan }}</th>
              
              <th scope="col">
                @if (is_null($laporan->attachment) == 0)
                <a class="grouped_elements" data-fancybox="" rel="" href=" {{url ('/storage/foto_laporan/'.$laporan->attachment) }}" style="color: black;">
                  <div class="">
                    <img src="/storage/foto_laporan/{{$laporan->attachment}}" alt="" style="width: 40px; height:40px;">
                  </div>
                </a>
                @else
                  <p>&times;</p>
                @endif
              </th>
              <th scope="col" class="status">{{ $laporan->status }}</th>
              <th scope="col" style="text-align: center;">
                <button id="actionButton" class="eLaporan" data-toggle="modal" data-target="#modalLaporan"><i class="fas fa-pencil-alt"></i></button>
              </th>
            </tr>
            @endforeach
          </tbody>
        </table>

        <?php /*
        <!-- Pagination Start -->
            <!-- {{ $laporans->links("pagination::bootstrap-4") }} -->
        <!-- Pagination End -->
        */ ?>
        
      </div>
    </div>
      @endif
  </div>
</div>
</div>
  <div style="padding-bottom:2em;">
    <br>
  </div>
  

<!-- Modal -->
<div id="modalLaporan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ action ('LaporanController@editStatusLaporan') }}" method="POST">
          @csrf
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <label for="NIP">No Tiket Laporan</label>
              <input class="form-control" type="text" name="noTiket" id="noTiket" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <label for="NIP">Status</label>
              <select class="form-control" id="cStatus" name="cStatus">
                <option value="Terkirim">Terkirim</option>
                <option value="Dalam Proses">Dalam Proses</option>
                <option value="Selesai">Selesai</option>
                <option value="Tertolak">Tertolak</option>
              </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <button type="submit" class="btn btn-primary" style="width:45%; background-color:#1f317f;">Konfirmasi</button>
            </div>
        </div>
        </form>
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->


</body>

<script>

$(".eLaporan").click(function() {
    
    var $row = $(this).closest("tr");    // Find the row
    var $text1 = $row.find(".idLaporan").text(); // Find the text
    var $text2 = $row.find(".status").text(); // Find the text
    var $idx;
    if ($text2 == "Terkirim"){
      $idx = 0;
    } else if ($text2 == "Dalam Proses"){
      $idx = 1;
    } else if ($text2 == "Selesai"){
      $idx = 2;
    } else{
      $idx = 3;
    }
    document.getElementById("noTiket").value = $text1;
    document.getElementById("noTiket").innerHTML = $text1;
    document.getElementById("cStatus").selectedIndex = $idx;
});

$(document).ready(function() {
  $('#tLaporan').DataTable({
    "language": {
    "search": "<strong>Cari Data:</strong>",
    "sLengthMenu": "<strong>Tampilkan _MENU_ Data </strong>"
  }}
  );
  
});
</script>


<style>

  #cLaporan{
    border: none;
    background-color: #1f317f;
    color: white;
    padding: 5px;
  }

  option{
    background-color: #F5F5F5;  
    color: black;
  }

  option:hover{
    background-color: #1f317f;
    color: white;
  }

  .btnPengajuan{
    background-color: #1f317f !important;
    color: white !important;
    width: 2000% !important;
  }

  .dataTables_paginate{
    align-content:center !important;
    text-align:center !important;
    justify-content:center !important;
    width: 100%;

  }

  .dataTables_info{
    display: none;
  }
</style>



@endsection

