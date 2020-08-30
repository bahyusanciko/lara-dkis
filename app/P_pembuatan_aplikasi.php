<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_pembuatan_aplikasi extends Model
{
    protected $table = 'pengajuan_pembuatan_aplikasi';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}
