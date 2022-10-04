<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Anggotas;
use App\Place;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menejemen = Roles::all()->count();
        $data_anggota = Anggotas::all()->count();
        $pengajuan_kegiatan = Place::all()->count();
        $data_pengguna = User::all()->count();


        return view('dasboard')
            ->with('data_anggota', $data_anggota)
            ->with('data_pengguna', $data_pengguna)
            ->with('pengajuan_kegiatan', $pengajuan_kegiatan )
            ->with('menejemen', $menejemen);
    }
}
