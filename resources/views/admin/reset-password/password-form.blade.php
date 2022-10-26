<!DOCTYPE html>
<html lang="en" data-theme="mi-dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI DESIGN</title>

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <input type="hidden" name="params" id="_params" value="{{ json_encode(request()->request->all()) }}">
</head>


<div class="mi-loader d-none">
    <div class="loader m-auto"></div>
</div>

<body>
@include('theme.header')
@include('theme.toaster')
<div class="mi-content">
    <div class="row w-100">
        <div class="col-sm-5 m-auto">
            <div class="mi-card">
                <div class="mi-header success">CHANGER  MOT DE PASSE</div>
                <form onsubmit="return loader()" action="{{ route('reset-password.reset') }}" method="POST">
                    <div class="mi-body">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="otp" value="{{ $otp }}">
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
                                <button type="submit" class="butn success w-100">RESET PASSWORD</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
