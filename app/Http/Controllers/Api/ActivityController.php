<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aplikasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function getListApps()
    {
        $jApk = Aplikasi::all();
        $data = [
            "response" => [
                "status" => true,
                "data" => $jApk,
                "message" => "Data List Aplikasi",
            ],
            "code" => 200
        ];
        return response()->json($data['response'], $data['code']);
    }


    function LupaPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'nama_aplikasi' => 'required|string',
            'deskripsi' => 'required|string',

        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{

            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Lupa Password',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);

            // insert to database laporan lupa password
            DB::table('pengajuan_lupa_password')->insert([
                'laporan_id' => $id,
                'nama_aplikasi' => $request->nama_aplikasi,
                'deskripsi' => $request->deskripsi,
            ]);
            
            $data = [
                "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan Lupa Password",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

     function LaporJaringan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'nama_SKPD' => 'required|string',
            'deskripsi' => 'required|string',

        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{
            // handle file upload
            if ($request->hasFile('image')){
                // get filename with extension
                $nameWithExt = $request->file('image')->getClientOriginalName();
                // get filename only
                $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
                // get extension only
                $extension = $request->file('image')->getClientOriginalExtension();
                // file name that will be stored
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // upload image
                $path = $request->file('image')->storeAs('public/foto_laporan', $fileNameToStore);
            }else{
                $fileNameToStore = 'noimage.jpg';
            }
            // get user's input
            // insert to database laporan
            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Laporan Jaringan',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);
            // insert to database laporan jaringan
            DB::table('pengajuan_laporan_jaringan')->insert([
                'laporan_id' => $id,
                'nama_SKPD' => $request->nama_SKPD,
                'deskripsi' => $request->deskripsi,
                'attachment' => $fileNameToStore,
            ]);
            
            $data = [
                "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan Laporan Jaringan",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'nama_SKPD' => 'required|string',
            'document' => 'required|file',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{
            if ($request->hasFile('document')){
            // get filename with extension
            $nameWithExt = $request->file('document')->getClientOriginalName();
            // get filename only
            $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
            // get extension only
            $extension = $request->file('document')->getClientOriginalExtension();
            // file name that will be stored
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload document
            $path = $request->file('document')->storeAs('public/permohonan_email', $fileNameToStore);
            }else{
                $fileNameToStore = NULL;
            }

            // insert to database laporan
            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Pembuatan Email',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);

            // insert to database laporan pembuatan email
            DB::table('pengajuan_pembuatan_email')->insert([
                'laporan_id' => $id,
                'nama_SKPD' => $request->nama_SKPD,
                'attachment' => $fileNameToStore,
            ]);

        $data = [
            "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan Pembuatan Email",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

        public function aplikasi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'document' => 'required|file',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{
            // get filename with extension
            $nameWithExt = $request->file('document')->getClientOriginalName();
            // get filename only
            $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
            // get extension only
            $extension = $request->file('document')->getClientOriginalExtension();
            // file name that will be stored
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('document')->storeAs('public/permohonan_aplikasi', $fileNameToStore);

            // insert to database laporan
            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Pembuatan Aplikasi',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);

            // insert to database laporan pembuatan aplikasi
            DB::table('pengajuan_pembuatan_aplikasi')->insert([
                'laporan_id' => $id,
                'deskripsi' => $request->deskripsi,
                'attachment' => $fileNameToStore,
            ]);

            $data = [
            "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan Pembuatan Aplikasi",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

    public function akun_cloud(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'deskripsi' => 'required|string',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{
            // insert to database
            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Akun Cloud',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);
    
            DB::table('pengajuan_akun_cloud')->insert([
                'laporan_id' => $id,
                'deskripsi' => $request->deskripsi,
            ]);

            $data = [
            "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan Akun Cloud",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }  
    
    function LPSE(request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'document' => 'required|file',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{ 
                
            // get filename with extension
            $nameWithExt = $request->file('document')->getClientOriginalName();
            // get filename only
            $filename = pathinfo($nameWithExt, PATHINFO_FILENAME);
            // get extension only
            $extension = $request->file('document')->getClientOriginalExtension();
            // file name that will be stored
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('document')->storeAs('public/LPSE', $fileNameToStore);

            // insert to database laporan
            $id = DB::table('laporan')->insertGetId([
                'nip'=> $request->nip,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan LPSE',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);

            // insert to database laporan lpse
            DB::table('pengajuan_lpse')->insert([
                'laporan_id' => $id,
                'attachment' => $fileNameToStore,
            ]);

        $data = [
            "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan LPSE",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }

        function SubDomain(request $request)
    {

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'email_domain' => 'required|string',
            'surat_pengajuan' => 'required|max:4096',
            'surat_tugas' => 'required|max:4096',
            'surat_kpe' => 'required|max:4096',
        ]);
        if($validator->fails()){
            $message = $validator->errors()->toArray();
            $data = [
                "response" => [
                    "status" => false,
                    "data" => null,
                    "message" => $message,
                ],
                "code" => 400
            ];
        }else{ 
            // get extension only
            $extension_surat_pengajuan = $request->file('surat_pengajuan')->getClientOriginalExtension();
            $extension_surat_tugas = $request->file('surat_tugas')->getClientOriginalExtension();
            $extension_surat_kpe = $request->file('surat_kpe')->getClientOriginalExtension();
    
            // file name that will be stored
            $fileNameToStore_surat_pengajuan = 'surat pengajuan_'.$request->femailpejabat.'.'.$extension_surat_pengajuan;
            $fileNameToStore_surat_tugas = 'surat tugas_'.$request->femailpejabat.'.'.$extension_surat_tugas;
            $fileNameToStore_surat_kpe = 'surat KPE_'.$request->femailpejabat.'.'.$extension_surat_kpe;
    
            // upload image
            $path_surat_pengajuan = $request->file('surat_pengajuan')->storeAs('public/SubDomain/'.$request->femailpejabat, $fileNameToStore_surat_pengajuan);
            $path_surat_tugas = $request->file('surat_tugas')->storeAs('public/SubDomain/'.$request->femailpejabat, $fileNameToStore_surat_tugas);
            $path_surat_kpe = $request->file('surat_kpe')->storeAs('public/SubDomain/'.$request->femailpejabat, $fileNameToStore_surat_kpe);
    
            // insert to database laporan
            $id = DB::table('laporan')->insertGetId([
                    'nip'=> $request->nip,
                    'nama' => $request->nama,
                    'no_hp' => $request->no_hp,
                'jenis_pengajuan' => 'Pengajuan Subdomain',
                'tanggal_pengajuan' => Carbon::now()->toRfc850String(),
            ]);
            
            // insert to database subdomain
            DB::table('pengajuan_subdomain')->insert([
                'laporan_id' => $id,
                'email_domain' => $request->email_domain,
                'surat_pengajuan' => $fileNameToStore_surat_pengajuan,
                'surat_tugas' => $fileNameToStore_surat_tugas,
                'surat_kpe' => $fileNameToStore_surat_kpe,
            ]);
            $data = [
            "response" => [
                    "status" => true,
                    "data" => $id,
                    "message" => "Berhasil Melakukan Pengajuan LPSE",
                ],
                "code" => 201
            ];
        }
        return response()->json($data['response'], $data['code']);
    }
}
