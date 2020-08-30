@extends('layouts.app')

@section('content')

<body class="bg">

@include('includes.header')
<div class="container-fluid" style="background-color: #F5F5F5; padding-top:10px; width: 90%;">

  <h1><strong> Daftar Admin </strong></h1>
  <div class="row">
    <div class="col-sm-2">
      <a href="#"  class="btn btn-primary cAdmin" id="tAdmin"  data-toggle="modal" data-target="#modalAdmin" style="width: 100%; margin-bottom:20px; background-color: #1f317f">
        <i class="fas fa-plus"></i>
        Tambah Admin
      </a>
    </div>
    <div class="col-sm">  
      @if (\Session::has('message'))
        <div class="alert alert-success">
          <h5 style="text-align:center;">{!! \Session::get('message') !!}</h5>
        </div>
      @endif
    </div>
    <div class="col-sm-2"></div>
  </div>


  <div class="row">
    <div class="col-sm">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>

          <tbody>
          @foreach ($admins as $admin)
            <tr>
              <th scope="col" class="nip" >{{ $admin->nip  }}</th>
              <th scope="col">{{ $admin->user->nama }}</th>
              <th scope="col" style="text-align: center; width:10%;">
                <button class="actionButton tDelete dAdmin" id="tDelete"  data-toggle="modal" data-target="#modalAdmin"> <i class="fas fa-trash-alt" style="font-size:16px;"></i></button>
              </th>
            </tr>
          @endforeach
          </tbody>
          
        </table>
      </div>

    </div>
  </div>

</div>

<!-- Modal -->
<div id="modalAdmin" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
    </div>

    <!-- Tambah -->
    <div class="modal-body modal-bodyC" id="modal-bodyC">
      <h2><strong>Tambah Admin</strong></h2>
      <form method="post" action="{{ action ('AdminController@insertAdmin') }}">
        @csrf
        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <label for="NIP" ><strong>NIP</strong></label>
              <input id="color" list="listNip" class="form-control" name="nipIns" autocomplete="off">
              <datalist id="listNip">
                  @foreach ($users as $user)
                      <option value="{{ $user->nip }}">
                  @endforeach
              </datalist>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1 form-group">
              <button type="submit" class="btn btn-primary" style="width:45%; background-color:#1f317f;">Konfirmasi</button>
            </div>
        </div>
      </form>
    </div>
    <!-- End Tambah Content -->

    <!-- Edit -->
    <div class="modal-body modal-bodyE" id="modal-bodyE">

    </div>
    <!-- End Edit Content -->

    <!-- Delete -->
    <div class="modal-body modal-bodyD" id="modal-bodyD">
      <h2><strong>Delete Admin</strong></h2>
      <form method="post" action="{{ action ('AdminController@deleteAdmin') }}">
        @csrf
        <div class="row">
          <div class="col-md-10 offset-md-1 form-group">
            <label for="NIP">NIP</label>
            <input class="form-control" type="text" name="nipDel" id="deleteAdminFNip" readonly>
          </div>
        </div>

    
        <div class="row">
          <div class="col-md-10 offset-md-1 form-group">
            <button type="submit" class="btn btn-danger" style="width:45%;">Hapus</button>
          </div>
        </div>
      </form>
    </div>
    <!-- End Delete -->

  </div>
  <!-- modal-content -->
  </div>
  <!-- Modal Dialog -->
</div>
<!-- End Modal -->


<div style="padding-bottom:2em;">
  <br>
</div>
</body>

<script>



$(".cAdmin").click(function() {
    document.getElementById("modal-bodyC").style.display  = "block";
    document.getElementById("modal-bodyE").style.display  = "none";
    document.getElementById("modal-bodyD").style.display  = "none";

});


$(".dAdmin").click(function() {
    document.getElementById("modal-bodyC").style.display  = "none";
    document.getElementById("modal-bodyE").style.display  = "none";
    document.getElementById("modal-bodyD").style.display  = "block";
    var $row = $(this).closest("tr");    // Find the row
    var $text1 = $row.find(".nip").text(); // Find the text
    var $text2 = $row.find(".peran").text(); // Find the text
    var $idx;
    document.getElementById("deleteAdminFNip").value = $text1;
    document.getElementById("deleteAdminFNip").innerHTML = $text1;
    document.getElementById("deleteAdminFRole").value = $text2;
    document.getElementById("deleteAdminFRole").innerHTML = $text2;
});
</script>



<style>

.btn-stats {
    background-color: #1f317f;
    border: none;
    color: #F5F5F5;
    width: 90%;
    text-decoration: none;
    border-radius: 16px;
    justify-content: center;
    align-items: center;
    position: relative;
}


/* The Modal (background) */
.ModalAdminList {
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
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;

}


#contentTAdmin, #contentEAdmin, #contentDAdmin{
    display: none;
}

/* The closeNumber Button */
.closeModal {
  color: black;
  /* float: right !important; */
  left: 0;
  font-size: 28px;
  font-weight: bold;
}

.closeModal:hover,
.closeModal:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


.actionButton{
            width: 40px;
            height: 40px;
            border: none;
            display: inline-block;
            background-color: #1f317f;
            color: #F5F5F5;
            margin-bottom: 4px;
            border-radius: 50%;
        }
</style>




<!-- End -->


@endsection
