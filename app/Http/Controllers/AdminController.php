<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * rekam aktifitas admin
     * @param string nip -> nip admin
     * @param string nama -> nama admin
     * @param string aktifitas -> aktifitas admin
     * 
     */
    public function aktifitas($nip, $nama, $aktifitas)
    {
        DB::table('aktifitas')->insert([
            'nip' => $nip,
            'nama' => $nama,
            'aktifitas' => $aktifitas,
            'tanggal' => Carbon::now()->toRfc850String(),
        ]);
    }
    
    public function index()
    {
        $admins = \App\admin::with('user')->get();
        $users = DB::select('select nip from users');
        return view('adminlist', ['admins' => $admins,  'users' => $users] );
    }

    #Tambah Admin
    public function insertAdmin(Request $data){
        $data->input();
        

        

        // Cek Duplikat
        $checkNip = DB::table('users')
                    ->select('*')
                    ->where('nip', '=', $data['nipIns'])
                    ->count();
        if ($checkNip == 0){
            return redirect()->back()->with('message','NIP tidak ditemukan');
        }  
        $check2 = DB::table('admins')
                ->select('*')
                ->where('nip', '=', $data['nipIns'])
                ->count();
        // Misal udah jadi admin
        if ($check2 == 1){
            return redirect()->back()->with('message','NIP telah menjadi admin');
        }
            
        DB::table('admins')->insert(
            ['nip' => $data['nipIns'], 'is_master' => 0]
        );
        $user = \Auth::user();
        $aktifitas ="Mengangkat NIP {{$data['nipIns']}} sebagai Admin ";
        DB::table('admin_aktifitas')->insert([
            'nip' => $user['nip'],
            'nama' => $user['nama'],
            'aktifitas' => $aktifitas,
            'tanggal' => Carbon::now()->toRfc850String(),
        ]);
        
        DB::table('users')->where('nip', '=', $data['nipIns'])->update(['is_admin' => 1]);
        return redirect()->back()->with('message','Admin Berhasil ditambahkan');
    }

    #delete Admin
    public function deleteAdmin(Request $data){
        $data->input();
        $user = \Auth::user();

        DB::table('admins')
        ->where('nip', '=', $data['nipDel'] )
        ->delete();
        DB::table('users')
        ->where('nip', '=', $data['nipDel'] )
        ->update(['is_admin' => 0]);
        $user = \Auth::user();
        $aktifitas ="Menghapus NIP {{$data['nipDel']}} dari Admin ";
        DB::table('admin_aktifitas')->insert([
            'nip' => $user['nip'],
            'nama' => $user['nama'],
            'aktifitas' => $aktifitas,
            'tanggal' => Carbon::now()->toRfc850String(),
        ]);

        return redirect()->back()->with('message','Data Admin Berhasil dihapus');
    }

    public function aktifitasAdmin() {
        $aktifitass = DB::table('admin_aktifitas')->select('*')->get();
        return view('aktifitasadmin', ['aktifitass' => $aktifitass] );
    }

}
