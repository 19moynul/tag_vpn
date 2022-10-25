
 @extends('layouts.theme')
@section('content')

 <div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title mb-0" style="color: black">Subscribed user</h4>
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
                        <th style="width: 15%;">User Email</th>
                        <th style="width: 15%;">Subscription Name</th>
                        <th style="width: 15%;">activated_at</th>
                        <th style="width: 15%;">deactivated_at</th>
                        <th style="width: 15%;">status</th>
                        <th style="width: 15%;">action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($premium_sub_to_user as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->user_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ date('d M Y',strtotime($data->activated_at)) }}</td>
                        <td>{{ date('d M Y',strtotime($data->deactivated_at)) }}</td>
                        <td>{{ getUserSubscriptionStatus($data->user_subscription_status) }}</td>
                        {{-- <td>{{ $data->free_days	 }}</td> --}}
                        <td>
                            <?php if($data->deactivated_at >= date('Y-m-d h:i:s')){ if($data->user_subscription_status == 0){ ?>
                            <a onclick="confirm('Are you sure to activate this user subscription')" href="{{ route('user_subscription.change_status',['id'=>$data->subscription_to_user_id,'status'=>1]) }}"><button class="btn success">Activate</button></a>
                            <a onclick="confirm('Are you sure to deactivate this user subscription')" href="{{ route('user_subscription.change_status',['id'=>$data->subscription_to_user_id,'status'=>2]) }}"><button class="btn danger">Cancelled</button></a>
                            <?php }else if($data->user_subscription_status == 1){ ?>
                            <a onclick="confirm('Are you sure to deactivate this user subscription')" href="{{ route('user_subscription.change_status',['id'=>$data->subscription_to_user_id,'status'=>2]) }}"><button class="btn danger">Cancelled</button></a>
                            <?php }else if($data->user_subscription_status == 2){ ?>
                            <a onclick="confirm('Are you sure to activate this user subscription')" href="{{ route('user_subscription.change_status',['id'=>$data->subscription_to_user_id,'status'=>1]) }}"><button class="btn success">Activate</button></a>
                            <?php }} ?>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
