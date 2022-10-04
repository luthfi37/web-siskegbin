<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Anggotas;
use App\Notif;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;


class UserController extends Controller
{
    //login
    function login(Request $req)
    {
        $output = new ConsoleOutput();

        $user = Anggotas::where('email', $req->email)->first();
        if (Hash::check($req->password, $user->password)) {
            return $user;
        }

        $output->writeln($user);

        return response([
            'error' => ["Email dan Password yang anda masukan salah"],
            'tes' => Hash::check('123', '$2y$10$IfBHrFk.lgVVwF1uSUdVS.zw0WC2bQPg48rVPxfQB.G5YCbHKRi..')
        ]);
    }

    public function get_notif_token(Request $req)
    {
        $user = Notif::where('anggota_id', $req->anggota_id)->first();

        if (!$user) {
            return response([
                'error' => ["User tidak ditemukan"],
            ]);
        }

        return response([
            'success' => ["User ditemukan"],
            'data' => $user
        ]);
    }

    public function set_notif_token(Request $req)
    {
        $notif = new Notif();
        $notif->anggota_id = $req->anggota_id;
        $notif->token = $req->token;
        $notif->save();

        if (!$notif) {
            return response([
                'error' => ["Gagal menyimpan"],
            ]);
        }

        return response([
            'success' => ["Berhasil menyimpan"],
            'data' => $req->anggota_id
        ]);
    }

    public function update_notif_token(Request $req)
    {
        // $notif = Notif::find($req->id);
        $notif = Notif::where('anggota_id', $req->anggota_id)->first();
        // $notif->anggota_id = $req->anggota_id;
        $notif->token = $req->token;
        $notif->save();


        // $notif = DB::table('notif')
        //     ->where('anggota_id', $anggota_id)
        //     ->update(['token' => $req->token]);

        if (!$notif) {
            return response([
                'error' => ["Gagal menyimpan"],
            ]);
        }

        return response([
            'success' => ["Berhasil menyimpan"],
            'data' => $req->token
        ]);
    }
}
