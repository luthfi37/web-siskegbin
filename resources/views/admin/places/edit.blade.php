@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Edit Pengajuan Kegiatan</div>
                <div class="card-body">
                    <form action="/places/update/{{$place->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Nama Kegiatan</label>
                                    <input type="text" name="place_name" class="form-control @error ('place_name') is-invalid @enderror" value="{{ $place->place_name }}">
                                    @error('place_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Tanggal Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ $place->tanggal_kegiatan }}">

                                </div>
                                <div class="col">
                                    <label for="">Unggah Fotoo</label>
                                    
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

                                    </div>
                                    <div class="col">
                                        <label for="">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" readonly class="form-control @error ('longitude') is-invalid @enderror"
                                        value="{{ $place->longitude }}">
                                        @error('longitude')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" readonly class="form-control @error ('latitude') is-invalid @enderror"
                                        value="{{ $place->latitude }}">
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
                                        <textarea name="address" placeholder="Address here..." class="form-control @error ('address') is-invalid @enderror" cols="4" rows="8">{{ $place->address }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <textarea name="description" placeholder="Description here..." class="form-control @error ('description') is-invalid @enderror" cols="4" rows="8">{{ $place->description }}</textarea>
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
            {{ $place->latitude }},
            {{ $place->longitude }},
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
