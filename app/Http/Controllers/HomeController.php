<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Aplikasi;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function view_lupa_password()
    {
        $value = Auth::user();
        $jApk = Aplikasi::all();
        return view('lupapassword',['val' => $value, 'apks' => $jApk]);
    }

    public function view_laporan_jaringan()
    {
        $value = Auth::user();
        return view('laporanjaringan',['val' => $value]);
    }

    public function view_lpse()
    {
        $value = Auth::user();
        return view('lpse',['val' => $value]);
    }

    public function view_subdomain(Request $data)
    { 
        $value = Auth::user();
        return view('subdomain',['val' => $value]);
    }

    public function view_aplikasi(Request $data)
    { 
        $value = Auth::user();
        return view('pembuatanaplikasi',['val' => $value]);
    }

    public function view_email(Request $data)
    { 
        $value = Auth::user();
        return view('pembuatanemail',['val' => $value]);
    }

    public function view_cloud(Request $data)
    { 
        $value = Auth::user();
        return view('akuncloud',['val' => $value]);
    }
}
