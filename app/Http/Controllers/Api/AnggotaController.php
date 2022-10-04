<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Anggotas;

class AnggotaController extends Controller
{
    public function get_all_anggota()
    {
        return response()->json(Anggotas::all(), 200);
    }

    public function upload_foto(Request $req)
    {
        if ($files = $req->file('file')) {

            // error_log($request->file);

            //store file into document folder
            $file = $req->file->store('place');

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

    public function update_foto(Request $request, $id)
    {
        //cek data hela aya ta eweuh na
        $cek_data = Anggotas::firstWhere('anggota_id', $id);
        if ($cek_data) {
            //data aya muncul
            $data = Anggotas::find($id);
            $data->foto = $request->foto;
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
}
