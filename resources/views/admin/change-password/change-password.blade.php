@extends('layouts.theme')
@section('content')
<div class="row">
    <div class="col-sm-6 m-auto">
        <div class="mi-card">
            <div class="mi-header success">CHANGE PASSWORD</div>
            <form onsubmit="return loader()" action="{{ route('password.change') }}" method="POST">
                <div class="mi-body">
                    @csrf
                    <div class="form-group">
                        <label for="">OLD PASSWORD <b class="text-danger">*</b></label>
                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="OLD PASSWORD">
                    </div>
                    <div class="form-group">
                        <label for="">NEW PASSWORD <b class="text-danger">*</b></label>
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="NEW PASSWORD">
                    </div>
                    <div class="form-group">
                        <label for="">CONFIRM PASSWORD <b class="text-danger">*</b></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="CONFIRM PASSWORD">
                    </div>

                </div>
                <div class="mi-footer">
                    <div class="row">
                        <div class="col-sm-6 m-auto">
                            <button type="submit" class="butn success">CHANGE PASSWORD</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
