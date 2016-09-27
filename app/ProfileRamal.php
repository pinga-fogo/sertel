<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileRamal extends Model
{
    protected $table = 'profiles_ramais';

    protected $fillable = [
            'name',
            'group_capture',
            'group_captured',
            'receives_ddr',
            'receives',
            'collect_call',
            'send_identification_ddr',
            'status'
    ];

    public function ramal(){
        return $this->belongsTo('App\Ramal');
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
