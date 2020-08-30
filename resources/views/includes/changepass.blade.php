<!DOCTYPE html>
<html>
<head>
@include('includes.head')

</head>
<body>

<!-- Trigger/Open The Modal -->
<button class="btn btn-primary" id="cPass" style="margin-left: 15px;">Ubah Password</button>

<!-- The Modal -->
<div id="myModalcPass" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Ubah Password</h2>
    <form action="">
        <div class ="form-group row fgantiPass">
            <div class="col-sm">
                <label for="password" class="col-form-label text-md-right"><strong>{{ __('Password Lama') }}</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            </div> 
        </div>
        <div class ="form-group row fgantiPass">
            <div class="col-sm">
                <label for="password" class="col-form-label text-md-right"><strong>{{ __('Password Baru') }}</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            </div> 
        </div>
        <div class ="form-group row fgantiPass">
            <div class="col-sm">
                <label for="password" class="col-form-label text-md-right"><strong>{{ __('Verifikasi Password Baru') }}</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            </div> 
        </div>
        <div class="form-group row fgantiPass" style="justify-content:left;">
                <button type="submit" class="btn btn-primary" id="#btnLogin" style="justify-content:center; margin-left:15px; width:40%;">
                    {{ __('Ubah Password') }}
                </button>   
        </div>

    
    </form>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModalcPass");

// Get the button that opens the modal
var btn = document.getElementById("cPass");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>


<style>


body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
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


/* The Close Button */
.close {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>


</html>
