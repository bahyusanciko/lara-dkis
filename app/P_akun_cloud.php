<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_akun_cloud extends Model
{
    protected $table = 'pengajuan_akun_cloud';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}
