@extends('tamplate.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Manajemen Role</div>
                <div class="card-body">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Tambah</a>
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no =1;
                            @endphp
                            @foreach ($roles as $role)

                            <tr>
                                <td>{{$no++}} </td>
                                <td hidden>{{$role->role_id}}</td>
                                <td>{{$role->role_name}}</td>

                                <td>
                                    <form action="{{ route('roles.destroy',$role->role_id) }}" method="POST">

                                        {{-- <a class="btn btn-info" href="{{ route('roles.show',$role->role_id) }}">Show</a> --}}

                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->role_id) }}">Ubah</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" >Hapus</button>
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

@push('DataTables')
<link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('scripts')
<script src="{{asset('/vendor/datatables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

@endpush
