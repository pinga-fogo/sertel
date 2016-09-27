<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RamalSetting extends Model
{
    protected $table = 'ramal_settings';

    protected $fillable = [
            'parent_id',
            'name',
            'type',
            'form_key',
            'sequence',
            'status'
    ];

    public static function getMasters()
    {
        return RamalSetting::where('class','master')->get()->lists('name', 'id');
    }
    public static function getTypes()
    {
        return RamalSetting::where('class','type')->get()->lists('name', 'id');
    }
    public static function getSubtypes($parent_id=false)
    {
        return RamalSetting::where('class','subtype')->where('parent_id',$parent_id)->get();
    }

//    public static function getListRecursive($parent_id=null)
//    {
//        $list = RamalSetting::where('parent_id', '=',$parent_id)->get();
//
//
//        foreach ($list as $key => & $value) {
//            $value->children = RamalSetting::getList($value->id);
//
//        }
//        return $list;
//    }

    public static function to_form_select($res=array()){
        $arr = array();
        foreach ($res as $key => $value) {
            $arr[$value->id] = $value->name;
        }
        return $arr;
    }


}
