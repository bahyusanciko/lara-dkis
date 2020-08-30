<!DOCTYPE html>
<html>
<head>
@include('includes.head')

</head>
<body>

<!-- Trigger/Open The Modal -->
<button class="btn btn-primary" id="cNumber" style="margin-left: 15px; float:right;">
    <i class="fas fa-pen"></i>
</button>

<!-- The Modal -->
<div id="myModalcNumber" class="modalNumber">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="closeNumber">&times;</span>
    <h2>Ubah Nomor Telepon</h2>
    <form action="">
        <div class ="form-group row fgantiPass">
            <div class="col-sm">
                <label for="NomorHP" class="col-form-label text-md-right"><strong>{{ __('Nomor HP') }}</strong></label>
                <input id="hp" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            </div> 
        </div>

        <div class="form-group row fgantiPass" style="justify-content:left;">
                <button type="submit" class="btn btn-primary" id="#btnLogin" style="justify-content:center; margin-left:15px; width:40%;">
                    {{ __('Ubah Nomor Telepon') }}
                </button>   
        </div>

    
    </form>
  </div>

</div>

<script>
// Get the modal
var modalNumber = document.getElementById("myModalcNumber");

// Get the button that opens the modal
var btn = document.getElementById("cNumber");

// Get the <span> element that closeNumbers the modal
var span = document.getElementsByClassName("closeNumber")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modalNumber.style.display = "block";
}

// When the user clicks on <span> (x), closeNumber the modal
span.onclick = function() {
  modalNumber.style.display = "none";
}

// When the user clicks anywhere outside of the modal, closeNumber it
window.onclick = function(event) {
  if (event.target == modalNumber) {
    modalNumber.style.display = "none";
  }
}
</script>

</body>


<style>


body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modalNumber {
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
  width: 40%;
}


/* The closeNumber Button */
.closeNumber {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeNumber:hover,
.closeNumber:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>


</html>
