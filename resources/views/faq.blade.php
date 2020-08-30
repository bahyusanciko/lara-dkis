@extends('layouts.app')

@section('content')
<button id="actionButton" class="cAdmin" data-toggle="modal" data-target="#modalAdmin"><i class="fas fa-pencil-alt"></i></button>
<button id="actionButton" class="eAdmin" data-toggle="modal" data-target="#modalAdmin"><i class="fas fa-pencil-alt"></i></button>
<button id="actionButton" class="dAdmin" data-toggle="modal" data-target="#modalAdmin"><i class="fas fa-pencil-alt"></i></button>


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
                <!-- <input class="form-control" type="text" name="nipIns"> -->
                <!-- Testing dulu gan -->
                <input id="color" list="listNip" class="form-control" name="nipIns" autocomplete="off">
                <datalist id="listNip">
                    @foreach ($users as $user)
                        <option value="{{ $user->nip }}">
                    @endforeach
                </datalist>
                <!-- End testnya gan -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 offset-md-1 form-group">
                <label for="Role"><strong>Peran</strong></label>
                <select class="form-control" id="sRole" name="nRoles">
                @foreach ($roles as $role)
                <option value="{{ $role->role_id }}">{{ $role->nama_role }}</option>
                @endforeach
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

          <!-- Edit -->

        <div class="modal-body modal-bodyE" id="modal-bodyE">
            <h2><strong>Edit</strong></h2>
            <form method="post" action="{{ action ('AdminController@editAdmin') }}">
                @csrf
                <div class="row">
                    <div class="col-md-10 offset-md-1 form-group">
                    <label for="NIP">NIP</label>
                    <input class="form-control" type="text" id="nipAdmin" name="nipEdit" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1 form-group">    
                    <label for="Role">Peran</label>
                    <select class="form-control" id="eRole" name="nRoles">
                        @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}">{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-1 form-group">
                    <button type="submit" class="btn btn-primary" style="width:45%;">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete -->

        <div class="modal-body modal-bodyD" id="modal-bodyD">
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
                    <label for="Role">Peran</label>
                    <input class="form-control" type="text" name="roleDel" id="deleteAdminFRole" readonly>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group">
                    <button type="submit" class="btn btn-primary" style="width:45%;">Submit</button>
                </div>
            </div>
        </form>
        </div>

    </div>
</div>
</div>
</div>
<!-- End Modal -->

<script>

$(".cAdmin").click(function() {
    document.getElementById("modal-bodyC").style.display  = "block";
    document.getElementById("modal-bodyE").style.display  = "none";
    document.getElementById("modal-bodyD").style.display  = "none";
    var $row = $(this).closest("tr");    // Find the row
    var $text1 = $row.find(".idLaporan").text(); // Find the text
    var $text2 = $row.find(".status").text(); // Find the text
    var $idx;
    document.getElementById("noTiket").value = $text1;
    document.getElementById("noTiket").innerHTML = $text1;
    document.getElementById("cStatus").selectedIndex = $idx;
});

$(".eAdmin").click(function() {
    document.getElementById("modal-bodyC").style.display  = "none";
    document.getElementById("modal-bodyE").style.display  = "block";
    document.getElementById("modal-bodyD").style.display  = "none";
    var $row = $(this).closest("tr");    // Find the row
    var $text1 = $row.find(".idLaporan").text(); // Find the text
    var $text2 = $row.find(".status").text(); // Find the text
    var $idx;
    document.getElementById("noTiket").value = $text1;
    document.getElementById("noTiket").innerHTML = $text1;
    document.getElementById("cStatus").selectedIndex = $idx;
});

$(".dAdmin").click(function() {
    document.getElementById("modal-bodyC").style.display  = "none";
    document.getElementById("modal-bodyE").style.display  = "none";
    document.getElementById("modal-bodyD").style.display  = "block";
    var $row = $(this).closest("tr");    // Find the row
    var $text1 = $row.find(".idLaporan").text(); // Find the text
    var $text2 = $row.find(".status").text(); // Find the text
    var $idx;
    document.getElementById("noTiket").value = $text1;
    document.getElementById("noTiket").innerHTML = $text1;
    document.getElementById("cStatus").selectedIndex = $idx;
});
</script>

@endsection
