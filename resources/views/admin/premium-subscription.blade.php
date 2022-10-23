 
 @extends('layouts.theme')
@section('content')
  
 <div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title mb-0"> Premium Subscription</h4>
            </div>
            <div>
                <a href="{{ route('indexAddPremiumSubscription') }}"><button class="btn btn-primary">Add Premium Subscription</button></a>
            </div>
        </div>
        <div style="margin-top: 40px;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%;">#</th>
                        <th style="width: 10%;">Name</th>
                        <th style="width: 10%;">Subtitle</th>
                        <th style="width: 10%;">Validity</th>
                        <th style="width: 10%;">Free days</th>
                        <th style="width: 10%;">Price</th>
                      
                        <th style="width: 20%; text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premium_subscription as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->subtitle }}</td>
                        <td>{{ $data->validity }}</td>
                        <td>{{ $data->free_days	 }}</td>
                        <td>{{ $data->price	 }}</td>
                        <td style="text-align: center;">
                            <a class="btn btn-info actbtn" title="edit" href="{{ url('admin/premium-subscription/edit/'.$data->id) }}"><i class="fas fa-edit" title="edit"></i></a>
                            <a class="btn btn-danger actbtn" href="{{ url('/admin/premium-subscription/delete/'.$data->id) }}"><i class="fas fa-trash" name="delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection