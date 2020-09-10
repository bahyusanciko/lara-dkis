<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Laporan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Buat nunjukin semua laporan awal pas buka dashboard admin
     * 
     */
    public function index_admin()
    {
        // ambil semua laporan dari database
        $laporans = laporan::all();

        // ngitung semua laporan yang terkirim, selesai, etc
        $cLaporans[0] = $laporans->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $laporans->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $laporans->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $laporans->where('status', '=', 'Tertolak')->count();

        // return view('dashboardadmin',['laporans'=>$laporans, 'cLaporan' => $cLaporans]);
    }

    /**
     * buat laporan lpse admin
     * 
     */
    function stat_lpse_admin()
    {
        // ambil laporan lpse berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan LPSE');

        // count laporan  
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusLPSE',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat laporan subdomain admin
     * 
     */
    function stat_subdomain_admin()
    {
        // ambil laporan subdomain berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Subdomain');

        // count laporan  
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusSubDomain',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat laporan akun cloud admin
     * 
     */
    function stat_akun_cloud_admin()
    {
        // ambil laporan akun cloud berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Akun Cloud');

        // count laporan  
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusAkunCloud',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat laporan jaringan admin
     * 
     */
    function stat_jaringan_admin()
    {
        // ambil laporan jaringan berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Laporan Jaringan');

        // count laporan  
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusJaringan',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    
    }

    /**
     * buat laporan pembuatan email user
     * 
     */
    function stat_Email_admin()
    {
        // ambil laporan pembuatan email berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Pembuatan Email');

        // count laporan
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusPembuatanEmail', ['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat laporan aplikasi admin
     * 
     */
    function stat_aplikasi_admin()
    {
        // ambil laporan aplikasi berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Pembuatan Aplikasi');

        // count laporan
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusPembuatanAplikasi',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat laporan lupa password admin
     * 
     */
    function stat_lupa_password_admin()
    {
        // ambil laporan aplikasi berdasarkan user
        $data = laporan::all()->where('jenis_pengajuan', '=', 'Pengajuan Lupa Password');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusLupaPassword',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'admin']);
    }

    /**
     * buat edit status laporan
     * 
     */
    function editStatusLaporan(Request $data)
    {
        $user = \Auth::user();
        $data->input();
  
        $cek = DB::table('laporan')
                    ->where('id', '=', $data['noTiket'])
                    ->where('status' ,'=', $data['cStatus'])
                    ->where('feedback' ,'=', $data['feedback'])
                    ->count();
        if ($cek){
            return redirect()->back()->with('message','Perubahan Status Gagal Mohon Periksa Kembali Masukan pada Status dan Feedback');
        }

        if ($data['feedback'] == "Masukan Feedback"){
            $aktifitas = "Edit Laporan Nomor Tiket {{$data['noTiket']}} dengan masukan Status = {{$data['cStatus']}} dan Feedback = {} ";
            DB::table('laporan')->where('id', '=', $data['noTiket'])->update(['status' => $data['cStatus']]);
        } else{
            $aktifitas = "Edit Laporan Nomor Tiket {{$data['noTiket']}} dengan masukan Status = {{$data['cStatus']}} dan Feedback = {{$data['feedback']}} ";
            DB::table('laporan')->where('id', '=', $data['noTiket'])->update(['status' => $data['cStatus'], 'feedback' => $data['feedback']]);  
        }
        
        DB::table('admin_aktifitas')->insert([
            'nip' => $user['nip'],
            'nama' => $user['nama'],
            'aktifitas' => $aktifitas,
            'tanggal' => Carbon::now()->toRfc850String(),
        ]);

        return redirect()->back()->with('message','Status Laporan Berhasil Diubah');
    }

    /**
     * Buat tampilan laporan user
     * 
     */
    function index_user($id)
    {
        $laporans = DB::table('laporan')->where('nip',$id)->get();
        $status = ['Terkirim', 'Dalam Proses', 'Selesai','Tertolak' ];
        foreach ($status as $key => $value) {
            $cLaporans[] = [
                'value' => $value,
                'count' => DB::table('laporan')->where([['status', '=', $value],['nip', '=', $id]])->count()
            ];
        }
        $totalLaporan = DB::table('laporan')->where('nip',$id)->count();
        $data = [
            "response" => [
                "status" => true,
                "data" => ['laporans'=>$laporans,'cLaporans'=>$cLaporans] ,'totalLaporan' => $totalLaporan,
                "message" => "Data Users",
            ],
            "code" => 200
        ];

        return response()->json($data['response'], $data['code']);
    }

    /**
     * buat laporan lpse user
     * 
     */
    function stat_lpse_user()
    {
        // ambil laporan lpse berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan LPSE');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusLPSE',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan subdomain user
     * 
     */
    function stat_subdomain_user()
    {
        // ambil laporan subdomain berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Subdomain');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusSubDomain',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan akun cloud user
     * 
     */
    function stat_akun_cloud_user()
    {
        // ambil laporan akun cloud berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Akun Cloud');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusAkunCloud',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan jaringan user
     * 
     */
    function stat_jaringan_user()
    {
        // ambil laporan jaringan berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Laporan Jaringan');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count();

        // return view('statusJaringan',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan pembuatan email user
     * 
     */
    function stat_email_user()
    {
        // ambil laporan pembuatan email berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Pembuatan Email');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusPembuatanEmail', ['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan aplikasi user
     * 
     */
    function stat_aplikasi_user()
    {
        // ambil laporan aplikasi berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Pembuatan Aplikasi');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusPembuatanAplikasi',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }

    /**
     * buat laporan lupa password user
     * 
     */
    function stat_lupa_password_user()
    {
        // ambil laporan aplikasi berdasarkan user
        $data = \Auth::user()->laporan->where('jenis_pengajuan', '=', 'Pengajuan Lupa Password');

        // count laporan user
        $cLaporans[0] = $data->where('status', '=', 'Terkirim')->count();
        $cLaporans[1] = $data->where('status', '=', 'Dalam Proses')->count();
        $cLaporans[2] = $data->where('status', '=', 'Selesai')->count();
        $cLaporans[3] = $data->where('status', '=', 'Tertolak')->count();
        $cLaporans[4] = $data->count(); 

        // return view('statusLupaPassword',['cLaporans'=>$cLaporans, 'data'=>$data, 'keterangan'=>'user']);
    }
}