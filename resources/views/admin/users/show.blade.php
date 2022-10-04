@extends('tamplate.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">Add New Admins</div>
                <div class="card-body">
                    <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control @error ('name') is-invalid @enderror" value="{{$data['users']->name}}">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="">Role</label>
                                    <select class="form-control" id="role" name="role" >
                                        @foreach ($data['roles'] as $role)

                                        <option value="{{$role->role_id}}" @if ($data['users']->role_id == $role->role_id )

                                            selected

                                             @endif> {{$role->role_name}}</option>

                                        @endforeach

                                        {{-- @foreach ($roles as $role)

                                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>


                                        @endforeach --}}
                                    </select>
                                </div>


                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="">Email</label>
                                    <input type="text" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" value="{{$data['users']->email}}">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                  
                                </div>


                            </div>



                        </div>
                        <div class="container" id="mapid"></div>
                        <div class="form-group float-right mt-4">
                            <a href="{{route('admins.index')}}" class="btn btn-primary">Kembali</a>
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
</script>
@endpush
