<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ramal extends Model
{
    protected $table = 'ramais';

    protected $fillable = [
            'name',
            'profile_ramal_id'
    ];
}
