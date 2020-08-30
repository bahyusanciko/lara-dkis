<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_lapor_jaringan extends Model
{
    protected $table = 'pengajuan_laporan_jaringan';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}
