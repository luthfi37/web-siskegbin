@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Tambah Pengajuan Kegiatan</div>
                <div class="card-body">
                    <form action="{{ route('places.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Nama Kegiatan</label>
                                    <input type="text" name="place_name" maxlength="50" class="form-control @error ('place_name') is-invalid @enderror" placeholder="Place name here...">
                                    @error('place_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" placeholder="Tanggal here...">

                                </div>
                                <div class="col">
                                    <label for="">Unggah Foto</label>
                                    <input type="file" name="image" class="form-control " placeholder="file image">
                                    <small><strong>**let empty if there is no image to upload</strong></small>

                                </div>
                            </div>
                                <div class="form-row mb-2">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="anggotas">Nama Anggota</label>
                                            <select name="anggota_id" class="form-control">
                                                @foreach ($anggotas as $row)
                                                    <option value="{{ $row->anggota_id }}">{{ $row->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <select class="form-control" name="anggota_id" style="width: 100%;"> --}}
{{--
                                            @foreach ($data['anggotas'] as $anggota)

                                        <option value="{{$anggota->anggota_id  }}">{{$anggota->anggota_id}}</option>


                                        @endforeach --}}
                                            {{-- @foreach ($data as $item)
                                                @if ( old('anggota_id') == $item->id )
                                                    <option value="{{ $item->id }}" selected>{{ $item->user->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('anggota_id')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror --}}
                                    </div>
                                    <div class="col">
                                        <label for=""></label>
                                        <input type="text" name="longitude" id="longitude" readonly class="form-control @error ('longitude') is-invalid @enderror" placeholder="longitude">
                                        @error('longitude')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for=""></label>
                                        <input type="text" name="latitude" id="latitude" readonly class="form-control @error ('latitude') is-invalid @enderror" placeholder="latitude">
                                        @error('latitude')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-2">

                                    <div class="col">
                                        <label for="">Alamat</label>
                                        <textarea name="address" placeholder="Address here..." class="form-control @error ('address') is-invalid @enderror" cols="4" rows="8"></textarea>
                                        @error('address')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <textarea name="description" placeholder="Description here..." class="form-control @error ('description') is-invalid @enderror" cols="4" rows="8"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="container" id="mapid"></div>
                        <div class="form-group float-right mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
    <style>
      #mapid { min-height: 500px; }
    </style>

@push('scripts')

<!-- Leaflet JavaScript -->
      <!-- Make sure you put this AFTER Leaflet's CSS -->
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>

<script>
    var mapCenter = [
            {{ config('leafletsetup.map_center_latitude') }},
            {{ config('leafletsetup.map_center_longitude') }},
    ];
    var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);

    function updateMarker(lat,lng){
        marker
        .setLatLng([lat,lng])
        .bindPopup("Your location :" + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click',function(e) {
        let latitude  = e.latlng.lat.toString().substring(0,15);
        let longitude = e.latlng.lng.toString().substring(0,15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude,longitude);
    });

    var updateMarkerByInputs = function () {
        return updateMarker( $('#latitude').val(), $('#longitude').val());
    }
    $('#latitude').on('input',updateMarkerByInputs);
    $('#longitude').on('input',updateMarkerByInputs);

</script>
@endpush
