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
                <form action="{{ route('storePremiumSubToUser') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Premium Subscription
                                Name</label>
                            <input type="text" name="free_days" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('free_days'))
                                <span class="text-danger">{{ $errors->first('free_days') }}</span>
                            @endif
                        </div>
                       <div class="mb-3 col-6">
                            <label for="category_id" class="control-label mb-1">Cateory Name</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option selected>Category Name</option>
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_name'))
                                <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>


                     <div class="row">
                        <div class="mb-3 col-6">
                            <label for="subscription_id" class="control-label mb-1">Sub Scription Name</label>
                            <select id="subscription_id" class="form-control" name="subscription_id">
                                <option selected>Category Name</option>
                                @foreach ($premium_subscription as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
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
