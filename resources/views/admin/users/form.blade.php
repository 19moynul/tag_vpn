@extends('layouts.theme')
@section('content')
<div class="row">
    <div class="col-sm-6 m-auto">
        <div class="mi-card">
            <!--start of mi-fc-card-->
            <div class="mi-header {{ $status }} ">
                <!--mi card header started-->{{ $title }} ADMIN
            </div>
            <!--end of mi card header-->
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                <div class="mi-body">
                    <!--mi-card body started--> <input name="_token" type="hidden" value="{{ csrf_token() }}"> @if(isset($data)) <input name="id" type="hidden" value="{{ $data->id }}"> @endif <div class="row">
                        <div class="form-group col-sm-"><label>NAME <b class="text-danger">*</b> </label><input type="text" placeholder="NAME" name="name" id="name" class="form-control" value="{{ isset($data)?$data->name:old('name') }}" required> </div>
                        <div class="form-group col-sm-"><label>EMAIL <b class="text-danger">*</b> </label><input type="text" placeholder="EMAIL" name="email" id="email" class="form-control" value="{{ isset($data)?$data->email:old('email') }}" required> </div>
                        @if(!isset($data))
                        <div class="form-group col-sm-"><label>PASSWORD <b class="text-danger">*</b> </label><input type="text" placeholder="PASSWORD" name="password" id="password" class="form-control" value="{{ isset($data)?$data->password:old('password') }}" required> </div>
                        @endif
                    </div>
                </div>
                <!--end of mi-card-body-->
                <div class="mi-footer">
                    <!--mi-card footer started-->
                    <div class="row">
                        <div class="col-sm-4 m-auto"> <button type="submit" class="butn {{ $status }} w-100"> {{ $button_name }} </button> </div>
                    </div>
                </div>
                <!--end of mi-card-footer-->
            </form>
        </div>
        <!--end of mi-fc-card-->
    </div>
</div>
@endsection
