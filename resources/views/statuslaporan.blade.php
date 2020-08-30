@extends('layouts.app')

@section('content')


@include('includes.header') 

<div class="container-fluid" style="background-color: #F5F5F5; padding  :10px; margin-top:50px; width: 95%;">
<a href="{{ route('home') }}">
    <button  style="background-color: #1f317f;" type="button" class="btn btn-primary btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
</a>
<br><br>
    <div class="row">
        <div class="col-sm">
            <div class="card">
              <h5 class="card-header"> <strong> Semua Laporan: {{ $cLaporans[4] }} </strong> </h5>
              <div class="card-body">
                <br>
                <div class="btn-group" style="width : 90%;">
                  <button type="button" class="btn btnPengajuan btn-md dropdown-toggle" style="background-color: #1f317f; color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    Pilih Laporan
                  </button>
                  <div class="dropdown-menu" style="width : 100%;">
                    <a class="dropdown-item" href="{{ url('status-laporan') }}">Semua Laporan</a>
                    <a class="dropdown-item" href="{{ url('status-laporan/lupa-password') }}">Laporan Pengaduan Lupa Password</a>
                    <a class="dropdown-item" href="{{ url('status-laporan/jaringan') }}">Laporan Pengaduan Jaringan </a>
                    <a class="dropdown-item" href="{{ url('status-laporan/lpse') }}">Layanan Pengajuan LPSE </a>
                    <a class="dropdown-item" href="{{ url('status-laporan/subdomain') }}">Layanan Pengajuan Subdomain </a>
                    <a class="dropdown-item" href="{{ url('status-laporan/email') }}">Layanan Pengajuan Email </a>
                    <a class="dropdown-item" href="{{ url('status-laporan/aplikasi') }}">Layanan Pengajuan Pembuatan Aplikasi </a>
                    <a class="dropdown-item" href="{{ url('status-laporan/akun-cloud') }}">Layanan Pengajuan Akun Cloud </a>
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
            <h3><strong>Semua Pengajuan</strong></h3>
            <h6>Untuk informasi lebih lengkap, silahkan buka berdasarkan jenis laporan</h6>
            <br>
            @if (count($laporans) == 0)

                <div class="contentDbAdmin" style=" padding-bottom:50px;  padding-top:50px;  justify-content:center; margin: auto; text-align: center;">
                    <h1><strong>Tidak ada pengajuan yang diajukan</strong></h1>
                </div>

            @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tabelLaporan">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nomor Tiket</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jenis Laporan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Feedback</th>
                        </tr>
                    </thead>
                    <tbody id="laporanUser">
                        @foreach ($laporans as $laporan)
                        <tr>
                            <th scope="col" class="idLaporan">{{ $laporan->id }}</th>
                            <th scope="col">{{ $laporan->tanggal_pengajuan }}</th>
                            <th scope="col">{{ $laporan->jenis_pengajuan }}</th>
                            <th scope="col" class="status">{{ $laporan  ->status }}</th>
                            @if ($laporan->feedback == NULL)
                            <th scope="col">Tidak ada Feedback</th>
                            @else
                            <th scope="col">{{ $laporan->feedback }}</th>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>     
            </div>
            {{-- {{ $laporans->links("pagination::bootstrap-4") }} --}}
            @endif
        </div>
    </div>
    
</div>


<script>
    $("a.grouped_elements").fancybox();
}

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

