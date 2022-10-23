<?php

namespace App\Http\Controllers\Api;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Models\PremiumSubscription;
use Illuminate\Http\Request;

class PremiumSubscriptionController extends Controller
{
    public function list(){
        $data = PremiumSubscription::select('id','name','subtitle','price','validity','free_days')->where('status',Constant::SUBSCRIPTION_ACTIVE)->get();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
