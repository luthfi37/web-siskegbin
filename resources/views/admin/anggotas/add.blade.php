@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Tambah Data Anggota</div>
                <div class="card-body">
                    <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-row mb-2">

                                <div class="col">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" id="nama" maxlength="50" class="form-control @error ('nama') is-invalid @enderror" placeholder="Isi nama...">
                                    @error('nama')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Pangkat</label>
                                    <input type="text" name="pangkat" id="pangkat" maxlength="50" class="form-control @error ('pangkat') is-invalid @enderror" placeholder="Isi Pangkat...">
                                    @error('pangkat')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">NRP</label>
                                    <input type="text" name="nrp" id="nrp" class="form-control @error ('nrp') is-invalid @enderror" placeholder="Isi NRP">
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
                                    <input type="text" name="jabatan" id="jabatan" maxlength="50" class="form-control @error ('jabatan') is-invalid @enderror" placeholder="Isi Jabatan...">
                                    @error('jabatan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Desa</label>
                                    <input type="text" name="desa" id="desa" maxlength="50" class="form-control" placeholder="Isi Desa...">

                                </div>
                                <div class="col">
                                    <label for="">Foto</label>
                                    <input type="file" id="image"name="foto" required class="form-control @error('foto') is-invalid @enderror">
                                        @error('foto')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
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
                                    <input type="text" name="password" id="password" maxlength="12" class="form-control @error ('password') is-invalid @enderror" placeholder="Password here...">
                                    @error('password')
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
    $("#saveButton").click(function () {

formData = {
    'anggota_id': $("#anggota_id").val(),
    'pangkat': $("#pangkat").val(),
    'jabatan': $("#jabatan").val(),
    'desa': $("#desa").val(),
    'foto': $("#image").val(),
    'nrp': $("#nrp").val(),
    'nama': $("#nama").val(),
    'email': $("#email").val(),
    'password': $("#passowrd").val(),

    '_token': $("input[name='_token']").val()
}


$.ajax({
    url: "{{route('anggotas.store')}}",
    method: 'POST',
    data: formData,
    cache: false,
    success: function (response) {
        response = JSON.parse(response);
        if (response.success == true) {
            alert('Simpan Data Berhasil');
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
