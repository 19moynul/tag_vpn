 
 @extends('layouts.theme')
@section('content')
  
 <div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title mb-0" style="color: black"> Premium Subscription To User</h4>
            </div>
            <div>
                {{-- <a href="{{ route('indexAddPremiumSubToUser') }}"><button class="btn btn-primary">Add Premium Subscription To User</button></a> --}}
            </div>
        </div>
        <div style="margin-top: 40px;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">#</th>
                        <th style="width: 15%;">User Name</th>
                        <th style="width: 15%;">Subscription Name</th>
                        <th style="width: 15%;">activated_at</th>
                        <th style="width: 15%;">deactivated_at</th>
                        <th style="width: 15%;">free_days</th>
                        <th style="width: 15%;">free_day</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premium_sub_to_user as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->user_name }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->activated_at }}</td>
                        <td>{{ $data->deactivated_at }}</td>
                        <td>{{ $data->free_days	 }}</td>
                        <td> <select> 
                          <option value="">  {{ explode(",", $data->free_day)[0]   }} Days</option>
                            <option> {{ explode(",", $data->free_day)[1]   }} Days</option>
                            <option> {{ explode(",", $data->free_day)[2]   }} Days</option>
                            <option> {{ explode(",", $data->free_day)[3]   }} Days</option>
                            <option> {{ explode(",", $data->free_day)[4]   }} Days</option>
                        </select>
                        

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection