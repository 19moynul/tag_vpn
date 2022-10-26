<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToUser;
use App\Models\PremiumSubscriptionToUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function logout(){
        try{
            $deviceToUser = DeviceToUser::where('id',deviceId())->first();
            if($deviceToUser->delete()){
                return response()->json(['success'=>true,'message'=>'You logout successfully'],200);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>'Sorry ! Server error , please try again after sometime'],200);
        }


    }

    public function home(){
        $country = request('country');
        $checkSubscriptionExist =  PremiumSubscriptionToUser::where('user_id',userId())->whereDate('activated_at', '<=', Carbon::now())->whereDate('deactivated_at', '>=', Carbon::now())->where('status',1)->first();
        $canAccessPrimiumSubscription = false;
        if($checkSubscriptionExist){
            $canAccessPrimiumSubscription = true;
        }else{
            if($country == 'USA' || $country == 'BD'){
                 $canAccessPrimiumSubscription = true;
            }else{
                $canAccessPrimiumSubscription = false;
            }

        }


        return response()->json(['success'=>true,'data'=>['can_access_premium_plans'=>$canAccessPrimiumSubscription]]);
    }
}
