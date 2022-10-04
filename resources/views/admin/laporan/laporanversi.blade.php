@extends('tamplate.layout')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <x:notify-messages />
                <div class="card-header">Pengajuan Kegiatan</div>
                <div class="card-body">
                    <div class="form-group col-md-4">
                        <label>Seller</label>            
                       <select class="form-control select2" id="seller2" style="width: 200px" data-style="btn btn-outline-primary">
                         <option value="">--Semua--</option>
                        @foreach ($anggotas as $seller)    
            {{-- data jamak dijadikan satu  --}}
            {{-- dibawah ini yg td diedit --}}
            
            <option value="{{$seller->anggota_id}}">{{$seller->nama}}</option>
            @endforeach
                           
                        </select>
                        </div>
                    {{-- <div class="row"> --}}
                        {{-- <div class="col-md-4 form-group">
                        <label for="heard">Nama Anggota</label>
                        <select name="anggota_id" class="form-control">
                            @foreach ($anggotas as $row)
                                <option value="{{ $row->user_id }}">{{ $row->user->name}}</option>
                            @endforeach
                        </select>
                        </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="row"> --}}
                            {{-- <div class="col-md-4 form-group">
                            <label for="heard">Bulan</label>
                                <select id="heard" class="form-control" required>
                                    <option value="">~Bulan~</option>
                                    <option value="press">Press</option>
                                    <option value="net">Internet</option>
                                    <option value="mouth">Word of mouth</option>
                                </select>
                            </div> --}}
                            {{-- </div> --}}
                            
                            {{-- <a href="#" class="printPage btn-primary btn-sm float-right">Cetak</a> --}}
                    {{-- <a href="{{ route('places.create') }}" class="btn btn-primary btn-sm float-right">Tambah</a> --}}
                    {{-- <div id="printarea"> --}}
                        {{-- <style type="text/css">
                                    
                            @media print {
                                .jangan_print, #jangan_print, #jangan_print2 { visibility: hidden;  }
                                #printarea { display:block !important; -webkit-print-color-adjust: exact; }
                            
                            
                            
                               .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4,.col-sm-4s, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                                    float: left;
                               }
                               .col-sm-12 {
                                    width: 100%;
                               }
                               .col-sm-11 {
                                    width: 91.66666667%;
                               }
                               .col-sm-10 {
                                    width: 83.33333333%;
                               }
                               .col-sm-9 {
                                    width: 75%;
                               }
                               .col-sm-8 {
                                    width: 66.66666667%;
                               }
                               .col-sm-7 {
                                    width: 58.33333333%;
                               }
                               .col-sm-6 {
                                    width: 50%;
                               }
                               .col-sm-5 {
                                    width: 41.66666667%;
                               }
                               .col-sm-4 {
                                    width:75mm;
                                    height:38mm;
                               }
                               .col-sm-4s {
                                    width:75mm;
                                    height:38mm;
                               }   
                               .col-sm-3 {
                                    width: 25%;
                               }
                               .col-sm-2 {
                                    width: 16.66666667%;
                               }
                               .col-sm-1 {
                                    width: 8.33333333%;
                               }
                            
                            
                            }
                            </style> --}}
                    <table class="table table-hovered" id="tablePlace">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Nama Kegiatan</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Deskripsi</th>
                                <th>Status Kegiatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<form action="" method="post" id="deleteForm">
    @csrf
    @method("DELETE")
    <input type="submit" value="Hapus" style="display:none">
</form>
@endsection

@push('DataTables')
<link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('/vendor/datatables/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('scripts')
<script src="{{asset('/vendor/datatables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/vendor/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        // $(function(){
        //     $('#tablePlace').DataTable({
        //         processing:true,
        //         serverSide:true,
        //         ajax: '{{ route('place.data') }}',
        //         columns:[
        //             {data: 'DT_RowIndex',orderable:false,searchable:false},
        //             {data: 'place_name'},
        //             {data: 'tanggal_kegiatan'},
        //             {data: 'nama'},
        //             {data: 'action'}
        //         ]
        //     })
        // });

        $(document).ready(function(){
        load_data();
    })
    $('#seller2').change(function(){
    var seller = $(this).val()
    if(seller !== ""){
     load_data();
    }
     
    })
    function load_data(){
        $('#tablePlace').DataTable().destroy();
        
        $('#tablePlace').DataTable( {
            dom: 'Bfrtip',
            buttons: ['pdf', 'print'],
         "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{url('/place/datatable')}}",
            "type": "POST",
            
            "data":{'_token':$("input[name='_token']").val(),'seller':$('#seller2 :selected').val()}
        },
        "columns":[ { "data": null,"sortable": false, 
       render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
    },
                 
                 {data: 'nama'},
                 {data: 'place_name'},
                 {data: 'tanggal_kegiatan'},
                 {data: 'description'},
                 {data: 'status_kegiatan'},
                 
                 { data: null, render: function ( data, type, row ) {
    let urledit = "{{URL::to('/')}}/barang/edit/"+data['product_id'];
    let urldetail = "{{URL::to('/')}}/barang/detail/"+data['product_id'];
    return '<a href="'+urldetail+'" class=""/></a> '
    +'<a href="'+urledit+'" class=""/></a> '
    +"<a href='javascript:void(0)' onclick='delete_id("+data['product_id']+")' class=''></a>";    
           } },  
            ],
            "oLanguage": {
                
         "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page PAGE of PAGES",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  MENU",
            },
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50,100,500],
            "pageLength": 5 
            
            
        });
    }

    function cetak(){
        window.print();
    }
    $('a.printPage').click(function(){
    
    
     newWin= window.open();
             var divToPrint = document.getElementById('printarea');
             newWin.document.write(divToPrint.innerHTML);
             newWin.document.close();
             newWin.focus();
             newWin.print();
           
            return false;
 });
    </script>
@endpush
