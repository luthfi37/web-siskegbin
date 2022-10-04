<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Anggotas;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('role')->latest()->get();
        return view('admin.users.index',compact('data'));

        // $data = ParentModel::category_get_by_id($category_id);
        // return view('users.index')->with('users',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get_all();
        $roles = Roles::get_all();
        return view('admin.users.add')->with('users',$users)->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = New User;
        $add->id= $request->get('id');
        $add->name = $request->get('name');
        $add->email = $request->get('email');

        $add->password = Hash::make($request->get('password')) ;
        $add->role_id = $request->get('role_id');

        $result = $add->save();

        if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['users'] = User::user_get_by_id($id)[0];
        // $data['roles'] = Roles::role_get_by_id($data['users']->role_id)[0];
        $data['roles'] = Roles::get_all();
        return view('admin.users.show')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users'] = User::user_get_by_id($id)[0];
        // $data['roles'] = Roles::role_get_by_id($data['users']->role_id)[0];
        $data['roles'] = Roles::get_all();
        return view('admin.users.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $add = User::where('id',$request->get('id'))->firstOrFail();
        $adf = Anggotas::where('anggota_id', $request->get('anggota_id'))->firstOrFail();
        // $add = User::find($request->get('id'));
        $add->name = $request->get('name');
        $add->email = $request->get('email');
        $add->anggota_id = $request->get('anggota_id');
        $add->role_id = $request->get('role_id');
        $add->password = Hash::make($request->get('password')) ;
        $result = $add->save();

        $adf->nama = $request->get('name');
        $adf->email = $request->get('email');
        $adf->password = Hash::make($request->get('password')) ;
        $updas = $adf->save();

         if($result && $updas){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }
    }

    public function update_admins(Request $request)
    {
        // dd($request->all());
        $add = User::find($request->user_id);
        $adf = Anggotas::where('anggota_id', $request->get('anggota_id'))->firstOrFail();
        // dd($add);
        $add->name = $request->get('name');
        $add->email = $request->get('email');
        $add->anggota_id = $request->get('anggota_id');
        $add->role_id = $request->get('role_id');
        $add->password = Hash::make($request->get('password')) ;
        $result = $add->save();

        $adf->nama = $request->get('name');
        $adf->email = $request->get('email');
        $adf->password = Hash::make($request->get('password')) ;
        $updas = $adf->save();

         if($result && $updas){
            // dd('suc');
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::user_delete_by_id($id);
        return redirect('/admins');
    }
}