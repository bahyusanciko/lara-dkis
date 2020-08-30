<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_lpse extends Model
{
    protected $table = 'pengajuan_lpse';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}