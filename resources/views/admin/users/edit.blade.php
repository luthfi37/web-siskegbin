@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Update Role</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Nama</label>
                                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ $data['users']->id }}">
                                    <input type="hidden" name="anggota_id" id="anggota_id" class="form-control" value="{{ $data['users']->anggota_id }}">
                                    <input type="text" name="name" id="name" class="form-control @error ('name') is-invalid @enderror" value="{{$data['users']->name}}">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Role</label>
                                    <select class="form-control" id="role_id" name="role_id" >
                                        @foreach ($data['roles'] as $role)

                                        <option value="{{$role->role_id}}" @if ($data['users']->role_id == $role->role_id )

                                            selected

                                             @endif> {{$role->role_name}}</option>

                                        @endforeach

                                        {{-- @foreach ($roles as $role)

                                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>


                                        @endforeach --}}
                                    </select>
                                </div>


                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" value="{{$data['users']->email}}">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Passowrd</label>
                                    <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror" value="{{$data['users']->password}}">
                                    {{-- <span class="fas fa-eye-slash view_password"></span> --}}
                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>



                        </div>
                        <div class="container" id="mapid"></div>
                        <div class="form-group float-right mt-4">
                            <a href="javascript:void" class="btn btn-primary" id="saveButton">Simpan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#saveButton").click(function(){
        formData = {
            'user_id':$("#user_id").val(),
            'anggota_id':$("#anggota_id").val(),
            'name':$("#name").val(),
            'email':$("#email").val(),
            'password':$("#password").val(),
            'role_id':$("#role_id").val(),

            '_token':$("input[name='_token']").val()
        }


         $.ajax({
                    url:"{{url('/admins-update')}}",
                    method: 'POST',
                    data: formData,
                    cache: false,
                    success: function(response) {
                       response = JSON.parse(response);
                       if(response.success == true){
                        alert('Simpan Data Berhasil');
                        window.location = "/admins"
                       }else{
                        alert("Gagal Menyimpan Data");
                       }
                    },error: function (error) {
                         alert("Terjadi Kesalahan");
                    }
               });
    });
        </script>
@endpush



