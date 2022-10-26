@extends('layouts.theme')
                @section('content')
@include('admin.admin.form',getFormInfo(isset($data)?true:false))
@endsection
