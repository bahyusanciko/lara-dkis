
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; width:60px !important;" id="mySidebar">
    <div class="biodataUser w3-bar-item">
    <button class="w3-button w3-large"
    onclick="w3_close()" style="        position: absolute;
        display:inline-block;
        top: 0;
        left: 0; background-color: transparent;"><i class="fas fa-times" style="font-size:28px; color: white;  "></i></button>
    <div class="box-fitur" style="margin-bottom: 15px; ">
        <img src="{{ url('/assets/testava.svg') }}" style="width: 100px;height:100px; background-color:white; margin:20px; padding:10px; border-radius: 50%;">
    </div>
    </div>
    <hr style="height: 1px !important; width: 90%;">  
    <a href="#" class="w3-bar-item w3-button sidebar-option" style="margin-top: 5px;">Status Laporan</a>
    <a href="#" class="w3-bar-item w3-button sidebar-option">FaQ</a>
    <a href="#" class="w3-bar-item w3-button sidebar-option">Pengaturan Akun</a>
    <form action="#" method="POST">
        <select name="roleSelection" id="roleSelection" onchange="this.form.submit()">
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
    </form>
    <a href="{{ url('/logout') }}" class="w3-bar-item w3-button w3-red">Keluar</a>
</div>

<div id="main">
  <button id="openNav" class="w3-button w3 w3-xlarge" onclick="w3_open()" >&#9776;</button>
</div>

<script>
    function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
    }
</script>

<style>

    .sidebar-option:hover{
        background-color : #0779e4 !important;
    }
    #openNav{
        position: absolute;
        display:inline-block;
        top: 0;
        left: 0;
    }

    #mySidebar{
        position: absolute;
        top: 0;
    }

</style>