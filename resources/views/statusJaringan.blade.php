@extends('layouts.app')

@section('content')

@include('includes.header') 

<body class="bg">

<div class="container-fluid" style="background-color: #F5F5F5; padding  :10px; margin-top:50px; width: 95%;">
    @if($keterangan == 'user')
    <a href="{{ route('home') }}">
        <button  style="background-color: #1f317f;" type="button" class="btn btn-primary btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
    </a>
    @else
    <a href="{{ route('admin_dashboard') }}">
        <button type="button" class="btn btn-primary btn-back" style="background-color: #1f317f;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
    </a>
    @endif
    <br><br>
    <div class="row">
        <div class="col-sm">
            <div class="card">
              <h5 class="card-header"> <strong> Semua Laporan Pengaduan Jaringan: {{ $cLaporans[4] }} </strong> </h5>
              <div class="card-body">
                <br>
                <div class="btn-group" style="width : 90%;">
                  <button type="button" class="btn btnPengajuan btn-md dropdown-toggle" style="background-color: #1f317f; color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    Pilih Laporan
                  </button>
                  <div class="dropdown-menu" style="width : 100%;">
                    {{-- kalo laporan user --}}
                    @if($keterangan == 'user')
                            <a class="dropdown-item" href="{{ url('status-laporan') }}">Semua Laporan</a>
                            <a class="dropdown-item" href="{{ url('status-laporan/lupa-password') }}">Laporan Pengaduan Lupa Password</a>
                            <a class="dropdown-item" href="{{ url('status-laporan/jaringan') }}">Laporan Pengaduan Jaringan </a>
                            <a class="dropdown-item" href="{{ url('status-laporan/lpse') }}">Layanan Pengajuan LPSE </a>
                            <a class="dropdown-item" href="{{ url('status-laporan/subdomain') }}">Layanan Pengajuan Subdomain </a>
                            <a class="dropdown-item" href="{{ url('status-laporan/email') }}">Layanan Pengajuan Email </a>
                            <a class="dropdown-item" href="{{ url('status-laporan/aplikasi') }}">Layanan Pengajuan Pembuatan Aplikasi </a>
                            <a class="dropdown-item" href="{{ url('status-laporan/akun-cloud') }}">Layanan Pengajuan Akun Cloud </a>
                            {{-- kalo laporan admin --}}
                            @else
                            <a class="dropdown-item" href="{{ url('dashboardadmin') }}">Semua Laporan</a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/lupa-password') }}">Laporan Pengaduan Lupa Password</a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/lpse') }}">Layanan Pengajuan LPSE </a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/subdomain') }}">Layanan Pengajuan Subdomain </a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/jaringan') }}">Laporan Pengajuan Jaringan </a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/email') }}">Layanan Pengajuan Email </a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/aplikasi') }}">Layanan Pengajuan Pembuatan Aplikasi </a>
                            <a class="dropdown-item" href="{{ url('dashboardadmin/akun-cloud') }}">Layanan Pengajuan Akun Cloud </a>
                            @endif
                  </div>
                </div>
      
              </div>
            </div>
          </div>
          <div class="col-sm">
            <h5 class="card-header"> <strong> <i class="far fa-bell"></i> Laporan Baru: {{ $cLaporans[0] }} </strong> </h5>
            <br>
            <h5 class="card-header bg-info"> <strong> <i class="far fa-circle"></i> Laporan Dalam Proses: {{ $cLaporans[1] }} </strong> </h5>
            <br>
        </div>
        <div class="col-sm">
            <h5 class="card-header bg-success "> <strong> <i class="fas fa-check"></i> Laporan Selesai: {{ $cLaporans[2] }} </strong> </h5>
            <br>
            <h5 class="card-header bg-danger"> <strong> <i class="fas fa-times"></i> Laporan Tertolak: {{ $cLaporans[3] }} </strong> </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-sm" id="laporanContent">
        <h3><strong>Pengaduan Jaringan</strong></h3>
        <br>
            @if (@count($data) == 0)

            <div class="contentDbAdmin" style=" padding-bottom:50px;  padding-top:50px;  justify-content:center; margin: auto; text-align: center;">
            <h1><strong>Tidak ada laporan yang dilaporkan</strong></h1>
            </div>

            @else
            <table class="table table-striped table-bordered table-hover" id="tabelLaporan">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nomor Tiket</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Nama SKPD</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Attachment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Feedback</th>
                        @if($keterangan == 'admin')
                        <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="laporanUser">
                @foreach ($data as $datas)
                    <tr>
                        <th scope="col" class="idLaporan">{{ $datas->id }}</th>
                        <th scope="col">{{ $datas->tanggal_pengajuan }}</th>
                        <th scope="col">{{ $datas->nip }}</th>
                        <th scope="col">{{ $datas->nama }}</th>
                        <th scope="col">{{ $datas->no_hp }}</th>
                        <th scope="col">{{ $datas->jaringan['nama_SKPD'] }}</th>
                        <th scope="col">{{ $datas->jaringan['deskripsi'] }}</th>
                        <th scope="col">
                            @if (is_null($datas->jaringan['attachment']) == 0)
                            <a class="grouped_elements" data-fancybox="" rel="" href=" {{url ('/storage/foto_laporan/'.$datas->jaringan['attachment']) }}" style="color: black;">
                                <div class="">
                                    <img src="/storage/foto_laporan/{{$datas->jaringan['attachment']}}" alt="" style="width: 40px; height:40px;">
                                </div>
                            </a>
                            @else
                                <p>&times;</p>
                            @endif
                        </th>
                        <th scope="col" class="status">{{ $datas->status }}</th>
                        @if ($datas->feedback == NULL)
                          <th scope="col">Tidak ada Feedback</th>
                        @else
                          <th scope="col">{{ $datas->feedback }}</th>
                        @endif
                        @if($keterangan == 'admin')
                        <th scope="col">
                        <button id="actionButton" class="eLaporan" data-toggle="modal" data-target="#modalLaporan"><i class="fas fa-pencil-alt"></i></button>
                        </th>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>
    </div>
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
<!-- End Modal -->

</body>

<style>
    .card-status{
        max-height : 10rem;
        height: auto;
    }    

    #btn-stats {
    background-color: #1f317f;
    border: none;
    color: #F5F5F5;
    width: 90%;
    text-decoration: none;
    border-radius: 16px;
    }

    table{
        text-align: center !important;
        justify-content: center !important;
        align-items: center !important; 
    }


</style>

<script>
  $("a.grouped_elements").fancybox();
</script>

<script>
$(document).ready(function() {
  $('#tabelLaporan').DataTable({
    "language": {
    "search": "<strong>Cari Data:</strong>",
    "sLengthMenu": "<strong>Tampilkan _MENU_ Data </strong>"
  }}
  );
  
});

</script>

<style>
.dataTables_paginate{
    align-content:center !important;
    text-align:center !important;
    justify-content:center !important;
    width: 100%;
    padding-bottom:1%;
  }

  .dataTables_info{
    display: none;
  }
</style>

@endsection