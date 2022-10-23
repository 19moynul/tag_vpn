@extends('layouts.theme')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 style="color: black">Premium Subscription Form</h3>
            <div>
                <a href="{{ route('indexPremiumSubscription') }}"><button class="btn btn-danger">Back</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="example">
                <form action="{{ route('storePremiumSubscription') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Subscription
                                Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Subscription
                                Sub title</label>
                            <input type="text" name="subtitle" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('subtitle'))
                                <span class="text-danger">{{ $errors->first('subtitle') }}</span>
                            @endif
                        </div>
                    </div>

                     <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Free Days 
                                </label>
                            <input type="text" name="free_days" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('free_days'))
                                <span class="text-danger">{{ $errors->first('free_days') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Subscription Price
                                Name</label>
                            <input type="text" name="price" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                             <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Subscription Price
                                validity</label>
                            <input type="text" name="validity" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('validity'))
                                <span class="text-danger">{{ $errors->first('validity') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <button type="submit" class="btn btn-primary ml-3">Submit</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
