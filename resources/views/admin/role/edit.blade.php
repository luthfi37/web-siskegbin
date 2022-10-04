@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Update Role</div>
                <div class="card-body">
                    <form action="{{ route('roles.update',$roles->role_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Role Name</label>
                                    <input type="hidden" name="role_id" id="role_id" class="form-control" value="{{ $roles->role_id }}">
                                    <input type="text" name="role_name" id="role_name" class="form-control @error ('role_name') is-invalid @enderror" value="{{ $roles->role_name }}">
                                    @error('role_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
// alert('add');
        formData = {
            'role_id':$("#role_id").val(),
            'role_name':$("#role_name").val(),

            '_token':$("input[name='_token']").val()
        }


         $.ajax({
                    url:"{{url('/roles-update')}}",
                    method: 'POST',
                    data: formData,
                    cache: false,
                    success: function(response) {
                       response = JSON.parse(response);
                       if(response.success == true){
                        alert('Simpan Data Berhasil');
                        window.location = "/roles"
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


