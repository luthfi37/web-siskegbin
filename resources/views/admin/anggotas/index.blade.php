@extends('tamplate.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Data Anggota</div>
                <div class="card-body">
                    <a href="{{ route('anggotas.create') }}" class="btn btn-primary btn-sm float-right">Tambah</a>
                    <a href="{{ route('show_import') }}" class="btn btn-primary btn-sm float-right">Import</a>
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Pangkat</th>
                                <th>NRP</th>
                                <th>Jabatan</th>
                                <th>Desa</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no =1;
                            @endphp
                            @foreach ($data as $key => $anggota)

                            <tr>
                                <td>{{$no++}} </td>
                                <td hidden>{{ $anggota->anggota_id }}</td>

                                <td>{{$anggota->nama}}</td>
                                <td>{{$anggota->pangkat}}</td>
                                <td>{{$anggota->nrp}}</td>
                                <td>{{$anggota->jabatan}}</td>
                                <td>{{$anggota->desa}}</td>
                                
                                <td><img src=" {{ asset('uploads/' . $anggota->foto) }} " width="150"></td>


                                <td>
                                    <form action="{{ route('anggotas.destroy',$anggota->anggota_id) }}" method="POST">

                                        <a class="btn btn-info" href="{{ route('anggotas.show',$anggota->anggota_id) }}">Detail</a>

                                        <a class="btn btn-primary" href="{{ route('anggotas.edit',$anggota->anggota_id) }}">Ubah</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="" method="post" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>
@endsection
