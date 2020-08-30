<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_pembuatan_email extends Model
{
    protected $table = 'pengajuan_pembuatan_email';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}
