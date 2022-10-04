@extends('tamplate.layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- top tiles -->
    <div class="row">


        <div class="col-lg-3 col-xs-6">
            <div class="small-box rounded py-3 px-4" style="background: #69e6b1">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner">
                        <a href="{{ route('roles.index') }}"><h1 class="text-black font-weight-bold" style="color: #000000">{{$menejemen}}</h1> </a>


                        <p style="color: #000000">Manajemen Role</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-list-ul h1" style="color: #000000"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box rounded py-3 px-4" style="background: #69e6b1">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner">
                        <a href="{{ route('admins.index') }}"> <h1 class="text-black font-weight-bold" style="color: #000000">{{$data_pengguna}}</h1> </a>


                        <p style="color: #000000">Data Pengguna</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-lines-fill h1" style="color: #000000"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box rounded py-3 px-4" style="background: #69e6b1">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner">
                        <a href="{{ route('anggotas.index') }}"> <h1 class="text-black font-weight-bold" style="color: #000000">{{$data_anggota}}</h1> </a>


                        <p style="color: #000000">Data Anggota</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-circle h1" style="color: #000000"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box rounded py-3 px-4" style="background: #69e6b1">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner">
                        <a href="{{ route('places.index') }}"> <h1 class="text-black font-weight-bold" style="color: #000000">{{$pengajuan_kegiatan}}</h1> </a>


                        <p style="color: #000000">Pengajuan Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-pencil-square h1" style="color: #000000"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



  @endsection
