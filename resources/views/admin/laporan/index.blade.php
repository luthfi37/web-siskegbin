@extends('tamplate.layout')

@section('content')

        <div class="container-fluid py-4">
            <div class="row min-vh-80 h-100">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Laporan Transaksi</h3>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <p style="text-center">Tanggal Awal</p>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label"></label>                                    
                                <input type="date" class="form-control" id="tglawal" name="tglawal">
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <p style="text-center">Tanggal Akhir</p>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label"></label>
                                    <input type="date" class="form-control" id="tglakhir" name="tglakhir">
                                </div>
                                </div>
                            </div>
                            <div>.</div>                         
                            <a href="" onclick="this.href='/cetak/'+ document.getElementById('tglawal').value +
                            '/'+ document.getElementById('tglakhir').value" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
@endsection