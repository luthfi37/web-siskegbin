<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Api\ActivateNotification;
use App\Place;
use Illuminate\Http\Request;
use App\User;
use App\Anggotas;
use App\Notif;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Place $place)
    {
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();
        $kegiatan = Place::all();
        return view('admin.places.index',compact('data', 'anggotas','kegiatan'));
        // return view('admin.places.index');
    }
    public function printKegiatan(Place $place)
    {
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();
        $kegiatan = Place::all();
        return view('admin.laporan.laporanversi',compact('data', 'anggotas','kegiatan'));
        // return view('admin.places.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['anggotas'] = Anggotas::get_all();
        // // $data = User::get_all();
        // $data['users'] = User::get_all();
        // return view('places.create')->with('data',$data);
        // // return view('places.create');
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();
        return view('admin.places.create',compact('data', 'anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'place_name' => 'required|min:3',
        //     'address'   => 'required|min:10',
        //     'description' => 'required|min:10',
        //     'anggota_id'   => 'required',
        //     'image'   => 'mimes:png,jpg,jpeg',
        //     'tanggal_kegiatan'   => 'required',
        //     'longitude'  => 'required',
        //     'latitude'  => 'required'
        // ]);
        // $data['image'] = $request->file('image')->store('place');
        // Place::create([
        //     'place_name' => $request->place_name,
        //     'address'  => $request->address,
        //     'description' => $request->description,
        //     'anggota_id' => $request->anggota_id,
        //     'tanggal_kegiatan' => $request->tanggal_kegiatan,
        //     'image' => $request->image,
        //     'longitude' => $request->longitude,
        //     'latitude' => $request->latitude,
        // ]);
        // notify()->success('Place has been created');
        // return redirect()->route('places.index');

        $this->validate($request, [
            'place_name' => 'required|min:3',
            'address'   => 'required|min:10',
            'description' => 'required|min:10',
            'anggota_id'   => 'required',
            // 'image'   => 'mimes:png,jpg,jpeg',
            'tanggal_kegiatan'   => 'required',
            'longitude'  => 'required',
            'latitude'  => 'required'
        ]);
        $data = $request->all();
        // $data['image'] = $request->file('image')->store('place');


        Place::create($data);
        
        $notif = Notif::where("anggota_id", $request->anggota_id)->first();

        $response = Http::post("https://exp.host/--/api/v2/push/send", [
            "to" => $notif->token,
            "title" => "Kegiatan",
            "body" => "Anda menerima kegiatan baru!"
        ])->json();
        Log::info($response);
        notify()->success('Place has been created');
        return redirect()->route('places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        // $anggotas = Anggotas::get_all();
        // return view('admin.places.detail', [
        //     'place' => $place,
        // ])->with('anggotas',$anggotas);
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();
        return view('admin.places.detail', ['place' => $place, ])->with('data',$data)->with('anggotas',$anggotas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();
        return view('admin.places.edit', ['place' => $place, ])->with('data',$data)->with('anggotas',$anggotas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $place = Place::find($id);
        $this->validate($request, [
            'place_name' => 'required|min:3',
            'address'   => 'required|min:10',
            'description' => 'required|min:10',
            'longitude'  => 'required',
            'latitude'  => 'required',
            'anggota_id'   => 'required',
            
            'tanggal_kegiatan'   => 'required'
        ]);

        $place->update([
            'place_name' => $request->place_name,
            'address'  => $request->address,
            'description' => $request->description,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'anggota_id' => $request->anggota_id,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            
        ]);

        notify()->info('Place has been updated');
        return redirect()->route('places.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        notify()->warning('Place has been deleted');
        return redirect()->route('places.index');
    }
    //modifi

    public function keg_delete($id){
        $delete = Place::place_delete($id);
        return redirect()->route('places.index');
    }

    public function keg_edit($id){
        $place = Place::get_by_id($id);
        // $data['sellers'] = Seller::get_data_id($data['barang']->seller_id)[0]; 
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();   
        // return view('seller_barang.selbrg_edit')->with('data',$data);
        return view('admin.places.edit')->with( 'place', $place[0])->with('data',$data)->with('anggotas',$anggotas);
    }

    public function keg_show($id){
        $place = Place::get_by_id($id);
        // $data['sellers'] = Seller::get_data_id($data['barang']->seller_id)[0]; 
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();   
        // return view('seller_barang.selbrg_edit')->with('data',$data);
        return view('admin.places.detail')->with( 'place', $place[0])->with('data',$data)->with('anggotas',$anggotas);
    }

    public function conf_place($id){
        $place = Place::get_by_id($id);
        // $data['sellers'] = Seller::get_data_id($data['barang']->seller_id)[0]; 
        $anggotas = Anggotas::all();
        $data = Anggotas::with('user')->latest()->get();   
        // return view('seller_barang.selbrg_edit')->with('data',$data);
        return view('admin.places.confplace')->with( 'place', $place[0])->with('data',$data)->with('anggotas',$anggotas);
    }

    public function confir(Request $request)
    {
        $konfir = Place::where('id',$request->get('id'))->firstOrFail();
        
        
        $konfir->konfirmasi = $request->get('conf');
        $result = $konfir->save();

         if($result){
             return json_encode(array('msg'=>'Simpan Data Berhasil', 'content'=>$result, 'success'=>TRUE));
        }else{
             return json_encode(array('msg'=>'Gagal Menyimpan Data', 'content'=>$result, 'success'=>FALSE));
        }
        // dd($request->all());
        // $place = Place::find($id);
        // $this->validate($request, [
           
        //     'conf' => 'required',
           
        // ]);

        // $place->update([
            
        //     'conf' => $request->konfirmasi,
            
            
        // ]);

        // notify()->info('Place has been updated');
        // return redirect()->route('places.index');
    }

    //endmodifi

    public function sampleMap()
    {
        return view('sample');
    }
}
