<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_lupa_password extends Model
{
    protected $table = 'pengajuan_lupa_password';

    public function laporan(){
        return $this->belongsTo(laporan::class);
    }
}
