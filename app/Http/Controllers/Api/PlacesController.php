<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Place;

class PlacesController extends Controller
{
    public function get_all_places(){
        return response()->json(Place::all(), 200);
    }

    public function insert_kegiatan(Request $request){
        $insert_kegiatan = new Place;
        $insert_kegiatan->place_name = $request->placeName;
        $insert_kegiatan->address = $request->address;
        $insert_kegiatan->description = $request->description;
        $insert_kegiatan->image = $request->image;
        $insert_kegiatan->longitude = $request->longitude;
        $insert_kegiatan->latitude = $request->latitude;
        $insert_kegiatan->anggota_id = $request->anggotaId;
        $insert_kegiatan->tanggal_kegiatan = $request->tanggalKegiatan;

        $insert_kegiatan->save();
        return response([
            'status' => 'OK',
            'message' => 'Barang Disimpan',
            'data' => $insert_kegiatan
        ], 200);

    }

}
