@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Add New Admin</div>
                <div class="card-body">
                    <a href="{{ route('anggotas.create') }}" class="btn btn-primary btn-sm float-right">Add New Admin</a>
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Pangkat</th>
                                <th>NRP</th>
                                <th>Jabatan</th>
                                <th>Desa</th>
                                <th>Foto</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $anggota)

                            <tr>

                            <td>{{ $anggota->anggota_id }}</td>

                            <td>{{$anggota->user->name}}</td>
                            <td>{{$anggota->pangkat}}</td>
                            <td>{{$anggota->nrp}}</td>
                            <td>{{$anggota->jabatan}}</td>
                            <td>{{$anggota->desa}}</td>
                            <td>{{ $anggota->foto }}</td>


                                <td>
                                    <form action="{{ route('anggotas.destroy',$anggota->anggota_id) }}" method="POST">

                                        <a class="btn btn-info" href="{{ route('anggotas.show',$anggota->anggota_id) }}">Show</a>

                                        <a class="btn btn-primary" href="{{ route('anggotas.edit',$anggota->anggota_id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">Delete</button>
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
