<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
            'user_id',
            'lastname'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
