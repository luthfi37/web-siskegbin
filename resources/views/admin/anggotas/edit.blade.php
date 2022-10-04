@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Edit Data Anggota</div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-row mb-2">

                                <div class="col">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{$data['anggotas']->nama}}">
                                    {{-- <select class="form-control" id="nama" name="nama">

                                        @foreach ($data['users'] as $user)

                                        <option value="{{$user->id}}" @if ($data['anggotas']->user_id == $user->id )

                                            selected

                                             @endif> {{$user->name}}</option>

                                        @endforeach
                                    </select> --}}
                                </div>
                                <div class="col">
                                    <label for="">Pangkat</label>
                                    <input type="hidden" name="anggota_id" id="anggota_id" class="form-control" value="{{$data['anggotas']->anggota_id}}" >
                                    <input type="text" name="pangkat" id="pangkat" class="form-control @error ('pangkat') is-invalid @enderror" value="{{$data['anggotas']->pangkat}}" >
                                    @error('pangkat')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">NRP</label>
                                    <input type="text" name="nrp" id="nrp" class="form-control @error ('nrp') is-invalid @enderror" value="{{$data['anggotas']->nrp}}">
                                    @error('nrp')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control @error ('jabatan') is-invalid @enderror" value="{{$data['anggotas']->jabatan}}" >
                                    @error('jabatan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Desa</label>
                                    <input type="text" name="desa" id="desa" class="form-control" value="{{$data['anggotas']->desa}}" >

                                </div>
                                <div class="col">
                                   
                                </div>



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
    'anggota_id': $("#anggota_id").val(),
    'pangkat': $("#pangkat").val(),
    'jabatan': $("#jabatan").val(),
    'desa': $("#desa").val(),
    'foto': $("#image").val(),
    'nrp': $("#nrp").val(),
    'nama': $("#nama").val(),

    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{url('/anggotas-update')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function (response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
            // window.location = "/roles"
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
