<?php

namespace App;

// nanti di model user harus di kasih must verify email sama notifiable
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    // di taro ini di notifiable nya
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     * ini nanti buat di isi ke database, nanti dia bakal nge override data base nya. soalnya ke connect.
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'password', 'nip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * ini hashing dari bawaan laravel gatau pake tipe apaan
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * ini wajib di taro di model user.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'nip';

    public function admin()
    {
        return $this->hasOne(Admin::class, 'nip');
    }

    public function laporan()
    {
        return $this->hasMany(laporan::class, 'nip');
    }

    public function aplikasi()
    {
        return $this->belongsToMany(aplikasi::class, 'user_details', 'nip', 'id_aplikasi');
    }
}
