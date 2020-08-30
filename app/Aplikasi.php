<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    //
    protected $primaryKey = 'id_aplikasi';
    
    protected $table = 'aplikasi';

    public function user()
    {
        return $this->belongsToMany(user::class);
    }
}
