<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WhiteList extends Model
{
    
    protected $table = 'white_list';

    protected $fillable = [
                'numero',
                'tronco',
     ];

 }
