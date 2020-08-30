@include('includes.head')
<body id='bg'>
<div id="loginBox">
    <h1>Akses Ditolak</h1>
</div>
</body>
<script>
window.alert("Maaf akun ini tidak memiliki akses untuk mengakses page ini");

@if (Auth::user()->is_admin == 0)
    window.location ='{{ route('home') }}';
@else
    window.location ='{{ route('admin_dashboard') }}';
@endif
</script>