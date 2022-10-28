<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PremiumSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\PremiumSubscriptionToUser;
use App\Http\Requests\PremiumSubscriptionToUserRequest;

class PremiumSubscriptionToUserController extends Controller
{
    public function index()
    {
        $premium_sub_to_user  = DB::table('tbl_premium_subscription_to_user')
            ->leftJoin('tbl_user', 'tbl_premium_subscription_to_user.user_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_premium_subscription',
             'tbl_premium_subscription_to_user.subscription_id', '=', 'tbl_premium_subscription.id')->
             select('tbl_user.name as user_name','tbl_user.email', 'tbl_premium_subscription_to_user.*','tbl_premium_subscription_to_user.id as subscription_to_user_id','tbl_premium_subscription_to_user.status as user_subscription_status','tbl_premium_subscription_to_user.free_days as free_days_left', 'tbl_premium_subscription.name',)
            ->get();

        return view('admin/premium-sub-to-user', compact('premium_sub_to_user'));
    }

    public function indexAddPremiumSubToUser()
    {
        $premium_subscription = PremiumSubscription::all();
        return view('admin/add-premium-sub-to-user',compact('premium_subscription'));
    }

    public function storePremiumSubToUser(PremiumSubscriptionToUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $adminInfo = Auth::user();
            $premium_subscription = new PremiumSubscriptionToUser();
            $premium_subscription->name = $request->name;
            $premium_subscription->subtitle = $request->subtitle;
            $premium_subscription->validity = $request->validity;
            $premium_subscription->status = 1;
            $premium_subscription->price = $request->price;
            $premium_subscription->free_days = $request->free_days;
            $premium_subscription->deleted_at =  $adminInfo->username;

            if ($premium_subscription->save()) {
                DB::commit();
                return redirect('admin/premium-sub-to-user');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function indexEditPremiumSubToUser($id)
    {
        $data['premium_subscription_to_user'] = PremiumSubscriptionToUser::where('id', $id)->first();
        return view('admin/edit-premium-subscription', $data);
    }

    public function updatePremiumSubToUser(PremiumSubscriptionToUserRequest $request)
    {
        try {
            PremiumSubscriptionToUser::where('id', $request->id)->update([
                'name' => $request->name,
                'subtitle' => $request->subtitle,
                'validity' => $request->validity,
                'price' => $request->price

            ]);
            return redirect('admin/premium-sub-to-user');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deletePremiumSubToUser($id)
    {
        PremiumSubscriptionToUser::findOrFail($id)->delete();
        return redirect('admin/premium-sub-to-user');
    }

    public function changeStatus($id,$status){
        PremiumSubscriptionToUser::where('id',$id)->update(['status'=>$status]);
        return redirect()->back()->with('success','account activated successfully');
    }
}
