@extends('tamplate.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Manajemen Pengguna</div>
                <div class="card-body">
                    <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Nama</label>
                                    <input type="text" maxlength="50" name="name" id="name" class="form-control @error ('name') is-invalid @enderror" placeholder="Admin name here...">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Role</label>
                                    <select class="form-control" id="role" name="role">

                                        @foreach ($roles as $role)

                                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>


                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" placeholder="Email here...">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Passowrd</label>
                                    <input type="text" maxlength="10" name="password" id="password" maxlength="12" class="form-control @error ('password') is-invalid @enderror" placeholder="Password here...">
                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  


                            </div>



                        </div>
                        <div class="container" id="mapid"></div>
                        <div class="form-group float-right mt-4">
                            <a href="javascript:void" class="btn btn-primary" id="saveButton">Save</a>
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
    $("#saveButton").click(function () {

formData = {
    'id': $("#id").val(),
    'email': $("#email").val(),
    'name': $("#name").val(),

    'password': $("#password").val(),
    'role_id': $("#role").val(),

    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{route('admins.store')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function (response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
            window.location = "/admins"
        } else {
            alert("Gagal Menyimpan Data");
        }
    },
    error: function (error) {
        alert("Terjadi Kesalahan");
    }
        });
});
        </script>

@endpush
