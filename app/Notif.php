<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = "notif";
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $guarded = [];


    protected $fillable = ['anggota_id', 'token', 'updated_at', 'created_at'];

    static function get_all()
    {
        $data = DB::table('notif')->get();
        return $data;
    }
}
