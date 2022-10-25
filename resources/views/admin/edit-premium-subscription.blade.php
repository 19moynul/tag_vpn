@extends('layouts.theme')
@section('content')
@php
$days = [1,3,5,7,10,15,30];
$validity = [
    [
        "text"=>"1 month",
        "value"=>"1 month"
    ],
    [
        "text"=>"3 month",
        "value"=>"3 month"
    ],
    [
        "text"=>"6 month",
        "value"=>"6 month"
    ],
    [
        "text"=>"9 month",
        "value"=>"9 month"
    ],
    [
        "text"=>"12 month",
        "value"=>"1 Year"
    ],
    [
        "text"=>"1 year 3 month",
        "value"=>"15 month"
    ],
    [
        "text"=>"1 year 6 month",
        "value"=>"18 month"
    ],
    [
        "text"=>"24 month",
        "value"=>"2 Year"
    ],
    [
        "text"=>"30 month",
        "value"=>"2 Year 6 Month"
    ],
    [
        "text"=>"36 month",
        "value"=>"3 Year"
    ]
];
@endphp
<style>
    label{
        color: #000
    }
</style>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 style="color: black">Edit Subscription Form</h3>
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
                            <label for="exampleInputEmail1" class="form-label">Subscription Name </label>
                            <input type="text" name="name" value="{{ $premium_subscription->name }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('name'))
                                <span class="text-danger ">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Subscription Subtitle </label>
                            <input type="text" name="subtitle" value="{{ $premium_subscription->subtitle }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @if ($errors->has('subtitle'))
                                <span class="text-danger ">{{ $errors->first('subtitle') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Subscription validity </label>
                             <select name="validity" class="form-control">
                                @foreach($validity as $month)
                                <option value="{{$month['value']}}" {{ $premium_subscription->validity == $month['value']?'selected':'' }}>{{ $month['text'] }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('validity'))
                                <span class="text-danger ">{{ $errors->first('validity') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Subscription Free days </label>
                            <select name="free_days" class="form-control">
                                @foreach($days as $day)
                                <option value="{{$day}} day" {{ $premium_subscription->free_days == $day.' day'?'selected':''  }}>{{ $day }} Day</option>
                                @endforeach
                            </select>

                            @if ($errors->has('free_days'))
                                <span class="text-danger ">{{ $errors->first('free_days') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail1" class="form-label">Subscription Price </label>
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
