<?php

namespace App\Http\Controllers\Api;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Models\PremiumSubscription;
use App\Models\PremiumSubscriptionToUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PremiumSubscriptionController extends Controller
{
    public function list(){
        $data = PremiumSubscription::select('id','name','subtitle','price','validity','free_days')->where('status',Constant::SUBSCRIPTION_ACTIVE)->whereNull('deleted_at')->get();
        return response()->json(['success'=>true,'data'=>$data]);
    }


    public function buySubscription($subscription_id){
        try{
            $subscription = PremiumSubscription::where('id',$subscription_id)->first();
            if($subscription){
                $userHasSubscription = PremiumSubscriptionToUser::where('user_id',userId())->whereDate('deactivated_at', '>=', Carbon::now())->whereIn('status',[0,1])->first();
                if(!$userHasSubscription){
                    $activated_at = date('Y-m-d H:i:s');
                    $deactivated_at = date('Y-m-d H:i:s', strtotime("+".$subscription->validity));
                    PremiumSubscriptionToUser::create([
                        'subscription_id'=>$subscription->id,
                        'user_id'=>request()->decoded->user_id,
                        'activated_at'=>$activated_at,
                        'deactivated_at'=>$deactivated_at,
                        'free_days'=>$subscription->free_days,
                        'status'=>0,
                    ]);

                    return response()->json(['success'=>true,'message'=>'Your request for this subscription has been sent sucessfully'],200);
                }else{
                    return response()->json(['success'=>false,'message'=>'Sorry ! You already has a subscription'],409);
                }


            }else{
                return response()->json(['success'=>false,'message'=>'Sorry ! subscription not found'],400);
            }
        }catch(\Exception $e){
            return $e;
            Log::error('error in buy subscrption : '.$e->getMessage());
            return response()->json(serverError(),500);
        }
    }
}
