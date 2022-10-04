@extends('tamplate.layout')

@section('content')
        <div class="container-fluid py-4">
            <div class="row min-vh-80 h-100">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-justify">Laporan Pertanggal</h5>
                            <hr>
                            <table class="table table-hover table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Address</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cetaklaporan as $key => $item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{\Carbon\Carbon::parse($item->tanggal_kegiatan)->isoFormat('D MMMM Y')}}</td>
                                        <td>{{$item->place_name}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->description}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <script type="text/javascript">
                            window.print();
                        </script>
                    </div>
                </div>
            </div>
        </div>
@endsection 