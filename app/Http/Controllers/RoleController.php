<?php

namespace App\Http\Controllers;

use App\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Roles::get_all();

        // $data = ParentModel::category_get_by_id($category_id);
        return view('admin.role.index')->with('roles',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required',

        ]);

        Roles::create($request->all());

        return redirect()->route('roles.index')
                        ->with('success','Roles created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show($role_id)
    {
        $data=Roles::role_get_by_id($role_id);


        return view('admin.role.show')->with('roles',$data[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id)
    {
        $data=Roles::role_get_by_id($role_id);


        return view('admin.role.edit')->with('roles',$data[0]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles)
    {
        $request->validate([
            'role_name' => 'required',
            'role_id' => 'required',
        ]);

        $roles->update([
            'role_id' => $request->role_id,
            'role_name' => $request->role_name,

        ]);

        notify()->info('Role has been updated');
        return redirect()->route('roles.index');
    }
    public function grole_update(Request $request){

        $add = Roles::where('role_id',$request->get('role_id'))->firstOrFail();
        $add->role_id = $request->get('role_id');
        $add->role_name = $request->get('role_name');

        $result = $add->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id)
    {
        $delete = Roles::role_delete_by_id($role_id);
        notify()->warning('Place has been deleted');
        return redirect('/roles');
    }
}
