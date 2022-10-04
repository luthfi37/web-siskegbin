<?php

namespace App\Http\Controllers;

use App\Anggotas;
use Illuminate\Http\Request;
use App\User;
use App\Imports\AnggotasImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Anggotas::with('user')->latest()->get();
        return view('admin.anggotas.index',compact('data'));

        // $data['anggotas'] = Anggotas::get_all();
        // $data['users'] = User::get_all();
        // return view('anggotas.index')->with('data',$data);

        // $data = ParentModel::category_get_by_id($category_id);
        // return view('anggotas.index')->with('anggotas',$data);
    }
    public function show_import()
    {
        $data = Anggotas::with('user')->latest()->get();
        return view('admin.anggotas.add_import',compact('data'));
        
    }
    public function import(Request $request) 
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        Excel::import(new AnggotasImport, request()->file('import_file'));
        return back()->with('success', 'Contacts imported successfully.');

        // Excel::import(new AnggotasImport,request()->file('file'));
           
        // return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_id',2)->get();
        $anggotas = Anggotas::get_all();
        return view('admin.anggotas.add')->with('users',$users)->with('anggotas',$anggotas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anggota = new Anggotas;
        $anggota->nama = $request->get('nama');
        $anggota->jabatan = $request->get('jabatan');
        $anggota->pangkat = $request->get('pangkat');
        $anggota->desa = $request->get('desa');
        $anggota->nrp = $request->get('nrp');
        // $anggota = $request->file('foto')->store('place');
        $anggota->foto = $request->get('foto');
        $anggota->email = $request->get('email');
        $anggota->password = Hash::make($request->get('password')) ;
        $simpang = $anggota->save();
        if($simpang){
            $ads= new User;
            $ads->anggota_id = $anggota->anggota_id;
            $ads->name = $anggota->nama;
            $ads->email = $request->get('email');
            $ads->role_id = '2';
            $ads->password = Hash::make($request->get('password')) ;
            $result = $ads->save();
        }

        

        if($simpang && $result){
             return json_encode(array('redirect'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }

        if($result){
            return redirect('admin.anggotas.index');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggotas  $anggotas
     * @return \Illuminate\Http\Response
     */
    public function show($anggota_id)
    {
        $data['anggotas'] = Anggotas::get_by_id($anggota_id)[0];
        // $data['roles'] = Roles::role_get_by_id($data['users']->role_id)[0];
        $data['users'] = User::get_all();
        return view('admin.anggotas.detail')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggotas  $anggotas
     * @return \Illuminate\Http\Response
     */
    public function edit($anggota_id)
    {
        $data['anggotas'] = Anggotas::get_by_id($anggota_id)[0];
        // $data['roles'] = Roles::role_get_by_id($data['users']->role_id)[0];
        $data['users'] = User::get_all();
        return view('admin.anggotas.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggotas  $anggotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $anggota = Anggotas::where('anggota_id',$request->get('anggota_id'))->firstOrFail();
        
        $anggota->jabatan = $request->get('jabatan');
        $anggota->pangkat = $request->get('pangkat');
        $anggota->desa = $request->get('desa');
        $anggota->nrp = $request->get('nrp');
        $anggota->foto = $request->get('foto');
        $anggota->nama = $request->get('nama');
        $result = $anggota->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }
    }
    public function anggota_update(Request $request)
    {
        $anggota = Anggotas::where('anggota_id',$request->get('anggota_id'))->firstOrFail();
        $ads = User::where('anggota_id',$request->get('anggota_id'))->firstOrFail();
        $anggota->jabatan = $request->get('jabatan');
        $anggota->pangkat = $request->get('pangkat');
        $anggota->desa = $request->get('desa');
        $anggota->nrp = $request->get('nrp');
        
        $anggota->nama = $request->get('nama');
        $result = $anggota->save();

        $ads->name = $request->get('nama');
        $upas = $ads->save();

         if($result && $upas){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggotas  $anggotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($anggota_id)
    {
        // dd('ad');
        $anggota = Anggotas::find($anggota_id);
        $anggota->delete();
        // $delete = Anggotas::anggota_delete_by_id($anggota_id);
        return redirect('/anggotas');
    }
}
