<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    
        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nip';
    
    public $table = "admins";
    
    public function user()
    {
    	return $this->belongsTo(User::class, 'nip');
    }
}
