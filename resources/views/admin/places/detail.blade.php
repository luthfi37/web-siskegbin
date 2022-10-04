@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Detail Place</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr><td>Nama Kegiatan</td><td>{{ $place->place_name }}</td></tr>
                            <tr><td>Tanggal Kegiatan</td><td>{{ $place->tanggal_kegiatan }}</td></tr>
                            <tr><td>Alamat</td><td>{{ $place->address }}</td></tr>
                            <tr><td>Deskripsi</td><td>{{ $place->description }}</td></tr>
                            <td><img src=" {{ asset('uploads/' . $place->image) }} " width="500"></td>
                            
                            <tr><td>Nama</td><td><select name="anggota_id" class="form-control" disabled>
                                @foreach ($anggotas as $row)
                                    <option value="{{ $row->anggota_id }}">{{ $row->nama}}</option>
                                @endforeach
                            </select></td></tr>
                            <tr><td>Konfirmasi Titik</td><td>{{ $place->konfirmasi }}</td></tr>
                        </tbody>
                        <td><a href="{{ route('places.index') }}" class="btn btn-secondary">Kembali</a></td>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Detail Place Conf</div>
                <div id="mapconf"></div>
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Detail Place</div>
                <div class="card-body" id="mapid"></div>
                
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
      #mapconf { min-height: 500px; }
    </style>
@endsection



@push('scripts')

<!-- Leaflet JavaScript -->
      <!-- Make sure you put this AFTER Leaflet's CSS -->
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>

<script>
   var map = L.map('mapid').setView([{{ $place->latitude }},{{ $place->longitude}}],{{ config('leafletsetup.detail_zoom_level') }});
    
   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $place->latitude }},{{ $place->longitude }}]).addTo(map)

    axios.get('{{ route('api.places.index') }}')
    .then(function (response) {
        //console.log(response.data);
        L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
            return ('<div class="my-2"><strong>Place Name</strong> :<br>'+layer.feature.properties.place_name+'</div> <div class="my-2"><strong>Description</strong>:<br>'+layer.feature.properties.description+'</div><div class="my-2"><strong>Address</strong>:<br>'+layer.feature.properties.address+'</div>');
        }).addTo(map);
        console.log(response.data);
    })
    .catch(function (error) {
        console.log(error);
    });

//map confir

var map = L.map('mapconf').setView([{{ $place->latitude_conf }},{{ $place->longitude_conf}}],{{ config('leafletsetup.detail_zoom_level') }});
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map);
 
     L.marker([{{ $place->latitude_conf }},{{ $place->longitude_conf }}]).addTo(map)
 
     axios.get('{{ route('api.places.index') }}')
     .then(function (response) {
         //console.log(response.data);
         L.geoJSON(response.data,{
             pointToLayer: function(geoJsonPoint,latlng) {
                 return L.marker(latlng);
             }
         })
         .bindPopup(function(layer) {
             //return layer.feature.properties.map_popup_content;
             return ('<div class="my-2"><strong>Place Name</strong> :<br>'+layer.feature.properties.place_name+'</div> <div class="my-2"><strong>Description</strong>:<br>'+layer.feature.properties.description+'</div><div class="my-2"><strong>Address</strong>:<br>'+layer.feature.properties.address+'</div>');
         }).addTo(map);
         console.log(response.data);
     })
     .catch(function (error) {
         console.log(error);
     });
   
</script>
@endpush

