@if ($success = Session::get('success'))
<div class="alert success fade show mi-smart-alert" role="alert">
    <p>{{ $success }}
        <button type="button" class="btn-close ps-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </p>
</div>
@endif

@if ($warning = Session::get('warning'))
<div class="alert warning fade show mi-smart-alert" role="alert">
    <p>{{ $warning }}
        <button type="button" class="btn-close ps-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </p>
</div>
@endif

@if ($error = Session::get('error'))
<div class="alert danger fade show mi-smart-alert" role="alert">
    <p>{{ $error }}
        <button type="button" class="btn-close ps-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </p>
</div>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert danger fade show mi-smart-alert" role="alert">
    <p>{{ $error }}
        <button type="button" class="btn-close ps-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </p>
</div>
@endforeach
@endif
