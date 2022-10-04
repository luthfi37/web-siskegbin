<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $primaryKey='id';
    protected $fillable = [
        'name', 'email', 'password','role_id','anggota_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function get_all(){
        $data=DB::table('users')->get();
        return $data;
    }

    static function user_get_by_id($id){
        $data = DB::table("users")->where('id',$id)->get();
        return $data;
    }
    
    static function user_delete_by_id($id){
        $delete = DB::DELETE("DELETE FROM users WHERE id ='".$id."' ");
        return $delete;
    }
    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}
