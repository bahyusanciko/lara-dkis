<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * input laporan jaringan
     * 
     */
    function LaporJaringan(Request $data)
    {
        // validate the image from the layanan view
        $this->validate($data, [
            'fimage' => 'image|max:1999'
        ]);

        // handle file upload
        if ($data->hasFile('fimage')){
            // get filename with extension
            $nameWithExt = $data->file('fimage')->getClientOriginalName();
            // get filename only
            $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
            // get extension only
            $extension = $data->file('fimage')->getClientOriginalExtension();
            // file name that will be stored
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $data->file('fimage')->storeAs('public/foto_laporan', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        // get user's input
        $details = $data->input();

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Laporan Jaringan',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        // insert to database laporan jaringan
        DB::table('pengajuan_laporan_jaringan')->insert([
            'laporan_id' => $id,
            'nama_SKPD' => $details['SKPD'],
            'deskripsi' => $details['fdeskripsi'],
            'attachment' => $fileNameToStore,
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        // return ke dashboard user
        return redirect(route('home'))->with('status','Laporan jaringan berhasil di input');
    }

    /**
     * input laporan lupa password
     * 
     */
    function LupaPassword(Request $data)
    {
        // get user's input
        $details = $data->input();

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Lupa Password',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        // insert to database laporan lupa password
        DB::table('pengajuan_lupa_password')->insert([
            'laporan_id' => $id,
            'nama_aplikasi' => $details['faplikasi'],
            'deskripsi' => $details['fdeskripsi'],
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        // return ke dashboard user
        return redirect(route('home'))->with('status','Laporan Lupa Password berhasil di input');
    }

    /**
     * input laporan LPSE
     * 
     */
    function LPSE(request $data)
    {
        $this->validate($data, [
            'fLPSE' => 'required|max:2048'
        ]);
    
        // get filename with extension
        $nameWithExt = $data->file('fLPSE')->getClientOriginalName();
        // get filename only
        $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
        // get extension only
        $extension = $data->file('fLPSE')->getClientOriginalExtension();
        // file name that will be stored
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // upload image
        $path = $data->file('fLPSE')->storeAs('public/LPSE', $fileNameToStore);

        // get user's input
        $details = $data->input();

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan LPSE',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        // insert to database laporan lpse
        DB::table('pengajuan_lpse')->insert([
            'laporan_id' => $id,
            'attachment' => $fileNameToStore,
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        return redirect(route('home'))->with('status', 'pengajuan LPSE berhasil di input');
    }

    /**
     * input laporan Subdomain
     * 
     */
    function SubDomain(request $data)
    {
        // get user's input
        $details = $data->input();
        
        $this->validate($data, [
            'fSurat1' => 'required|max:4096',
            'fSurat2' => 'required|max:4096',
            'fKPE' => 'required|max:4096',
        ]);

        // get extension only
        $extension_fSurat1 = $data->file('fSurat1')->getClientOriginalExtension();
        $extension_fSurat2 = $data->file('fSurat2')->getClientOriginalExtension();
        $extension_fKPE = $data->file('fKPE')->getClientOriginalExtension();

        // file name that will be stored
        $fileNameToStore_fSurat1 = 'surat pengajuan_'.$data->femailpejabat.'.'.$extension_fSurat1;
        $fileNameToStore_fSurat2 = 'surat tugas_'.$data->femailpejabat.'.'.$extension_fSurat2;
        $fileNameToStore_fKPE = 'surat KPE_'.$data->femailpejabat.'.'.$extension_fKPE;

        // upload image
        $path_fSurat1 = $data->file('fSurat1')->storeAs('public/SubDomain/'.$data->femailpejabat, $fileNameToStore_fSurat1);
        $path_fSurat2 = $data->file('fSurat2')->storeAs('public/SubDomain/'.$data->femailpejabat, $fileNameToStore_fSurat2);
        $path_fKPE = $data->file('fKPE')->storeAs('public/SubDomain/'.$data->femailpejabat, $fileNameToStore_fKPE);

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Subdomain',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);
        
        // insert to database subdomain
        DB::table('pengajuan_subdomain')->insert([
            'laporan_id' => $id,
            'email_domain' => $data->femailpejabat,
            'surat_pengajuan' => $fileNameToStore_fSurat1,
            'surat_tugas' => $fileNameToStore_fSurat2,
            'surat_kpe' => $fileNameToStore_fKPE,
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        return redirect(route('home'))->with('status', 'pengajuan SubDomain berhasil di input');

    }

    /**
     * input laporan akun cloud
     * 
     */
    public function akun_cloud(Request $data)
    {
        // get user's input
        $details = $data->input();

        // insert to database
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Akun Cloud',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        DB::table('pengajuan_akun_cloud')->insert([
            'laporan_id' => $id,
            'deskripsi' => $details['fdeskripsi'],
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        // return ke dashboard user
        return redirect(route('home'))->with('status','Pengajuan pembuatan akun cloud berhasil di input');

    }

    /**
     * input laporan pembuatan email
     * 
     */
    public function email(Request $data)
    {
        $this->validate($data, [
            'fsurat_permohonan' => 'required|max:4096',
        ]);

        // get filename with extension
        $nameWithExt = $data->file('fsurat_permohonan')->getClientOriginalName();
        // get filename only
        $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
        // get extension only
        $extension = $data->file('fsurat_permohonan')->getClientOriginalExtension();
        // file name that will be stored
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // upload image
        $path = $data->file('fsurat_permohonan')->storeAs('public/permohonan_email', $fileNameToStore);

        // get user's input
        $details = $data->input();

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Pembuatan Email',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        // insert to database laporan pembuatan email
        DB::table('pengajuan_pembuatan_email')->insert([
            'laporan_id' => $id,
            'nama_SKPD' => $details['SKPD'],
            'attachment' => $fileNameToStore,
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        // return ke dashboard user
        return redirect(route('home'))->with('status','Pengajuan pembuatan email berhasil di input');
    }

    /**
     * input laporan pembuatan aplikasi
     * 
     */
    public function aplikasi(Request $data)
    {

        $this->validate($data, [
            'fAplikasi' => 'required|max:2048'
        ]);
    
        // get filename with extension
        $nameWithExt = $data->file('fAplikasi')->getClientOriginalName();
        // get filename only
        $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
        // get extension only
        $extension = $data->file('fAplikasi')->getClientOriginalExtension();
        // file name that will be stored
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // upload image
        $path = $data->file('fAplikasi')->storeAs('public/permohonan_aplikasi', $fileNameToStore);

        // get user's input
        $details = $data->input();

        // insert to database laporan
        $id = DB::table('laporan')->insertGetId([
            'nip'=> \Auth::User()->nip,
            'nama' => $details['fnama'],
            'no_hp' => $details['fno_hp'],
            'jenis_pengajuan' => 'Pengajuan Pembuatan Aplikasi',
            'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
        ]);

        // insert to database laporan pembuatan aplikasi
        DB::table('pengajuan_pembuatan_aplikasi')->insert([
            'laporan_id' => $id,
            'deskripsi' => $details['fdeskripsi'],
            'attachment' => $fileNameToStore,
        ]);

        // send mail to insert_alamat@email.disini, lokasi email ada di new lokasi\format\email(isi email)
        //\Mail::to('insert_alamat@email.disini')->send(new \App\Mail\MailLayananApp($details));

        // return ke dashboard user
        return redirect(route('home'))->with('status','Pengajuan pembuatan aplikasi berhasil di input');
    }

    /**
     * update no hp
     * 
     */
    public function updateHp(Request $data)
    {
        $data->input();
        $noHp = $data['telpFut'];
        $nip = \Auth::User()->nip;
        DB::table('users')->where('nip', '=', $nip )->update(['no_hp' => $data['telpFut']]);    
        return redirect((route('home')))->with('status','Data Berhasil Diubah');
    } 

    /**
     * update password
     * 
     */
    public function ubah_password(Request $data)
    {
        // return "abcls";
        $this->validate($data, [
            'passFut1' => 'required|min:8',
            'passFut2' => 'required|min:8',
        ]);


        
         // check password now
         if (\Hash::check($data['passNow'], \Auth::user()->password))
         {
             // check inputed password
             if ($data['passFut1'] == $data['passFut2'])
             {
                 $new_pass = \Hash::make($data['passFut1']);
                 DB::table('users')->where('nip', '=', \Auth::user()->nip )->update(['password' => $new_pass]);    
                 
                 // success to update password
                 return redirect(route('home'))->with('status','Password Berhasil Diubah');
             }
             else{
                return redirect(route('home'))->with('status','Validasi password baru salah');
             }
         }
         else{
            return redirect(route('home'))->with('status','Password awal salah');
         }
         return redirect(route('home'))->with('status','Proses gagal');
    }
}