<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    protected $table = 'laporan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lpse()
    {
        return $this->hasOne(P_lpse::class);
    }

    public function subdomain()
    {
        return $this->hasOne(P_subdomain::class);
    }

    public function jaringan()
    {
        return $this->hasOne(P_lapor_jaringan::class);
    }

    public function akun_cloud()
    {
        return $this->hasOne(P_akun_cloud::class);
    }

    public function lupa_password()
    {
        return $this->hasOne(P_lupa_password::class);
    }

    public function pembuatan_aplikasi()
    {
        return $this->hasOne(P_pembuatan_aplikasi::class);
    }

    public function pembuatan_email()
    {
        return $this->hasOne(P_pembuatan_email::class);
    }
}
