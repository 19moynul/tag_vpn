@extends('layouts.theme')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 style="color: black">Edit Premium Subscription Form</h3>
            <div>
                <a href="{{ route('indexPremiumSubscription') }}"><button class="btn btn-danger">Back</button></a>
            </div>
        </div>
        <div class="card-body">
            <div class="example">
                <form method="post" action="{{ route('updatePremiumSubscription') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Premium Subscription Name </label>
                            <input type="text" name="name" value="{{ $premium_subscription->name }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('name'))
                                <span class="text-danger ">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Premium Subscription Subtitle </label>
                            <input type="text" name="subtitle" value="{{ $premium_subscription->subtitle }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('subtitle'))
                                <span class="text-danger ">{{ $errors->first('subtitle') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Premium Subscription validity </label>
                            <input type="text" name="validity" value="{{ $premium_subscription->validity }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('validity'))
                                <span class="text-danger ">{{ $errors->first('validity') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Premium Subscription Free days </label>
                            <input type="text" name="free_days" value="{{ $premium_subscription->free_days }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('free_days'))
                                <span class="text-danger ">{{ $errors->first('free_days') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Premium Subscription Price </label>
                            <input type="text" name="price" value="{{ $premium_subscription->price }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('price'))
                                <span class="text-danger ">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $premium_subscription->id }}">
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
