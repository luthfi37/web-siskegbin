<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Roles extends Model
{
    protected $table = "roles";
    protected $primaryKey='role_id';
    public $timestamp = true;


    protected $fillable = ['role_name','updated_at','created_at'];



    static function get_all(){
        $data = DB::table('roles')->get();
        return $data;

    }
    static function role_get_by_id($role_id){
        $data = DB::table("roles")->where('role_id',$role_id)->get();
        return $data;

    }
    static function role_delete_by_id($role_id){
        $delete = DB::DELETE("DELETE FROM roles WHERE role_id ='".$role_id."' ");
        return $delete;
    }

}
