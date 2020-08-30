<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_subdomain extends Model
{
    protected $table = 'pengajuan_subdomain';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}