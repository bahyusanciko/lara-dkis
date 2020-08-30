<div class="box-fitur" style="margin-bottom: 40px">
    @if (Request::url() == 'http://localhost:8000/dashboardadmin')
    <a class="logo-atas" href="{{ route('admin_dashboard') }}">
    @else
    <a class="logo-atas" href="{{ route('home') }}">
    @endif
        <img src="{{ url('/assets/logo dkis.png') }}" width="42" height="42" class="d-inline align-top logo" alt="" loading="lazy">
    </a>    
</div>