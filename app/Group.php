<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
            'name',
            'status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function to_form_select($key=null){
        $res = $this->where('status','!=','0')->get();
        $arr = array();
        foreach ($res as $key => $value) {
            $arr[$value->id] = $value->name;
        }
        return $arr;
    }
}
 