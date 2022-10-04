<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Place;
use  Redirect, Response, File;
use Validator;
// use App\Document;

class TempatController extends Controller
{
    //get all
    public function get_all_places()
    {
        return response()->json(Place::all(), 200);
    }

    //update confirm kegiatan
    public function update_confirm_kegiatan(Request $request, $id)
    {
        //cek data hela aya ta eweuh na
        $cek_data = Place::firstWhere('id', $id);
        if ($cek_data) {
            //data aya muncul
            $data = Place::find($id);
            $data->description = $request->description;
            $data->image = $request->image;
            $data->latitude_conf = $request->latitude_conf;
            $data->longitude_conf = $request->longitude_conf;
            $data->save();
            return response([
                'status' => 'OK',
                'msg' => 'Data Berhasil Di Simpan',
                'update-data' => $data
            ], 200);
        } else {
            //data eweuh muncul
            return response([
                'status' => 'Not Found',
                'msg' => 'Data Tidak di Temukan'
            ], 400);
        }
    }

    public function upload_image(Request $request)
    {
        if ($files = $request->file('file')) {

            // error_log($request->file);

            //store file into document folder
            $file = $request->file->store('place');

            //store your file into database
            // $document = new Document();
            // $document->title = $file;
            // $document->user_id = $request->user_id;
            // $document->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
        }
    }
}
