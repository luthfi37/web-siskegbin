<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Anggotas extends Model
{
    protected $table = "anggotas";
    protected $primaryKey='anggota_id';
    public $timestamp = true;
    

    protected $fillable = ['nama','email','password','pangkat','nrp','jabatan','desa','foto','user_id','updated_at','created_at'];



    static function get_all(){
        $data = DB::table('anggotas')->get();
        return $data;

    }
    static function get_by_id($anggota_id){
        $data = DB::table("anggotas")->where('anggota_id',$anggota_id)->get();
        return $data;

    }
    static function anggota_delete_by_id($id){
        $delete = DB::DELETE("DELETE FROM anggotas WHERE id ='".$id."' ");
        return $delete;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
