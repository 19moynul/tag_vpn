@extends('layouts.theme')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 style="color: black">Add new subscription</h3>
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
                            <label for="exampleInputEmail" class="form-label" style="color:black">Subscription
                                Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Subscription
                                Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('subtitle'))
                                <span class="text-danger">{{ $errors->first('subtitle') }}</span>
                            @endif
                        </div>
                    </div>

                     <div class="row">
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Free Days
                                </label>

                            <select name="free_days" class="form-control">
                                <option value="1 day">1 Day</option>
                                <option value="3 day">3 Day</option>
                                <option value="5 day">5 Day</option>
                                <option value="7 day">7 Day</option>
                                <option value="15 day">15 Day</option>
                                <option value="30 day">30 Day</option>
                            </select>
                            @if ($errors->has('free_days'))
                                <span class="text-danger">{{ $errors->first('free_days') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Subscription Price</label>
                            <input type="text" name="price" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" />
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                             <div class="mb-3 col-6">
                            <label for="exampleInputEmail" class="form-label" style="color:black">Subscription Price
                                validity</label>
                                <select name="validity" id="validity" class="form-control">
                                    <option value="1 month">1 Month</option>
                                    <option value="3 month">3 Month</option>
                                    <option value="6 month">6 Month</option>
                                    <option value="9 month">9 Month</option>
                                    <option value="12 month">1 Year</option>
                                    <option value="15 month">1 Year 3 Month</option>
                                    <option value="18 month">1 Year 6 Month</option>
                                    <option value="24 month">2 Year</option>
                                    <option value="30 month">2 Year 6 Month</option>
                                    <option value="36 month">3 Year</option>
                                </select>
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
