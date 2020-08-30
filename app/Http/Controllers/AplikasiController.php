<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aplikasi extends Controller
{
    /**
     * buat nambah aplikasi
     * 
     */
    public function add_aplikasi(Request $data)
    {
        DB::table('aplikasi')->insert([
            'nama' => $data->nama,
        ]);
    }

    /**
     * buat delete aplikasi
     * 
     */
    public function delete_aplikasi(Request $data)
    {
        DB::table('aplikasi')->delete('nama', '=', $data->nama);
    }
}
