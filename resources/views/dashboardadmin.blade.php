@extends('layouts.app')

@section('content')

<body class="bg">

@include('includes.header')
<div class="container-fluid" style="background-color: #F5F5F5; padding-top:20px; width: 98%; padding-bottom:20px;" >
<!-- Start top -->
  <div class="row">

    <div class="col-sm">
      <div class="card">
        <h5 class="card-header"> <strong> Ubah Jenis Laporan </strong> </h5>
        <div class="card-body">
          <br>
          <div class="btn-group" style="width : 90%;">
            <button type="button" class="btn btnPengajuan btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              Pilih Laporan
            </button>
            <div class="dropdown-menu" style="width : 100%;">
              <a class="dropdown-item" href="{{ url('dashboardadmin') }}">Semua Laporan</a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/lupa-password') }}">Laporan Pengaduan Lupa Password</a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/lpse') }}">Layanan Pengajuan LPSE </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/subdomain') }}">Layanan Pengajuan Subdomain </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/jaringan') }}">Laporan Pengajuan Jaringan </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/email') }}">Layanan Pengajuan Email </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/aplikasi') }}">Layanan Pengajuan Pembuatan Aplikasi </a>
              <a class="dropdown-item" href="{{ url('dashboardadmin/akun-cloud') }}">Layanan Pengajuan Akun Cloud </a>
            </div>
          </div>

        </div>
      </div>
    </div>


    <div class="col-sm">
      <!-- <div class="card"> -->
        <h5 class="card-header"> <strong> <i class="far fa-bell"></i> Laporan Baru: {{ $cLaporan[0] }} </strong> </h5>
        <br>
        <h5 class="card-header bg-info"> <strong> <i class="far fa-circle"></i> Laporan Dalam Proses: {{ $cLaporan[1] }} </strong> </h5>
        <br>
        
      <!-- </div> -->
    </div>
    <div class="col-sm">

      <h5 class="card-header bg-success "> <strong> <i class="fas fa-check"></i> Laporan Selesai: {{ $cLaporan[2] }} </strong> </h5>
      <br>
      <h5 class="card-header bg-danger"> <strong> <i class="fas fa-times"></i> Laporan Tertolak: {{ $cLaporan[3] }} </strong> </h5>

    </div>



  </div>
<!-- end Top -->

<div class="row">
<div class="col-sm">  
@if (\Session::has('message'))
    <div class="alert alert-success">
            <h5 style="text-align:center;">{!! \Session::get('message') !!}</h5>
    </div>
@endif
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
                <th scope="col">Jenis Laporan</th>
                <th scope="col">Feedback</th>
                <th scope="col">Lampiran</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($laporans as $laporan)
              <tr>
                <th scope="col" class="noTiket">{{ $laporan->id }}</th>
                <th scope="col">{{ $laporan->tanggal_pengajuan }}</th>
                <th scope="col">{{ $laporan->nip }}</th>
                <th scope="col">{{ $laporan->jenis_pengajuan }}</th>
                @if ($laporan->feedback == NULL)
                  <th scope="col">Tidak ada Feedback</th>
                @else
                  <th scope="col">{{ $laporan->feedback }}</th>
                @endif
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
                <th scope="col" style="text-align: center;" >

                  <button id="" class="eLaporan actionButton" data-toggle="modal" data-target="#modalLaporan"><i class="fas fa-pencil-alt" style="font-size:16px;"></i></button>
              

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
    </div>
  </div>
@endif
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
      <div class="modal-body modal-bodyE">

      <!-- edit -->
      <div class="modal-body modal-bodyE">
      <h2 style="text-align: center;"><strong>Edit Status Laporan</strong></h2>
      <br>
        <form action="{{ action ('LaporanController@editStatusLaporan') }}" method="POST" id="editLaporan">
          @csrf
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <label for="NIP">No Tiket Laporan</label>
              <input class="form-control" type="text" name="noTiket" id="noTiket" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <label for="Status">Status</label>
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
        <label for="Feedback">Feedback (Opsional)</label>
          <textarea class="form-control" rows="4" cols="42" name="feedback" form="editLaporan">Masukan Feedback</textarea>
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
    var $text1 = $row.find(".noTiket").text(); // Find the text
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

  .actionButton{
    width: 28px !important;
    height: 38px !important;
    border: none;
    display: inline-block;
    background-color: #1f317f;
    color: #F5F5F5;
    border-radius: 50%;
    
  }


</style>



@endsection

