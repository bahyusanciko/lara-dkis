@extends('layouts.app')

@section('content')

<body class="bg">

@include('includes.header')
<div class="container-fluid" style="background-color: #F5F5F5; padding-top:10px; width: 90%;">

  <h1><strong> Aktifitas Admin </strong></h1>


  <div class="row">
    <div class="col-sm">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabelAktifitas">
          <thead class="thead-dark">
            <tr>
              <th scope="col">id</th>
              <th scope="col">Tanggal</th>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Aktifitas</th>
            </tr>
          </thead>

          <tbody>
          @foreach ($aktifitass as $aktifitas)
            <tr>
              <th scope="col">{{ $aktifitas->id  }}</th>
              <th scope="col">{{ $aktifitas->tanggal  }}</th>
              <th scope="col">{{ $aktifitas->nip  }}</th>
              <th scope="col">{{ $aktifitas->nama }}</th>
              <th scope="col">{{ $aktifitas->aktifitas  }}</th>
            </tr>
          @endforeach
          </tbody>
          
        </table>
      </div>

    </div>
  </div>

</div>



<div style="padding-bottom:2em;">
  <br>
</div>
</body>





<script>
$(document).ready(function() {
  $('#tabelAktifitas').DataTable({
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




<!-- End -->


@endsection
