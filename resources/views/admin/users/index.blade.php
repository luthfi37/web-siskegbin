@extends('tamplate.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Data Pengguna</div>
                <div class="card-body">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm float-right">Tambah</a>
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no =1;
                            @endphp
                            @foreach ($data as $key => $user)

                            <tr>
                                <td>{{$no++}}</td>
                                <td hidden>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_id}}</td>

                                <td>
                                    <form action="{{ route('admins.destroy',$user->id) }}" method="POST">

                                        <a class="btn btn-info" href="{{ route('admins.show',$user->id) }}">Detail</a>

                                        <a class="btn btn-primary" href="{{ route('admins.edit',$user->id) }}">Ubah</a>

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
