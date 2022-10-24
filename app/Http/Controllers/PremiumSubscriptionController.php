<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PremiumSubscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PremiumSubscriptionRequest;

class PremiumSubscriptionController extends Controller
{
    public function index()
    {
        $premium_subscription = PremiumSubscription::whereNull('deleted_at')->get();
        return view('admin/premium-subscription', compact('premium_subscription'));
    }

    public function indexAddPremiumSubscription()
    {
        return view('admin/add-premium-subscription');
    }

    public function storePremiumSubscription(PremiumSubscriptionRequest $request)
    {
        DB::beginTransaction();
        try {
            $adminInfo = Auth::user();
            $premium_subscription = new PremiumSubscription();
            $premium_subscription->name = $request->name;
            $premium_subscription->subtitle = $request->subtitle;
            $premium_subscription->validity = $request->validity;
            $premium_subscription->status =1;
            $premium_subscription->price = $request->price;
            $premium_subscription->free_days = $request->free_days;
            $premium_subscription->deleted_at =  $adminInfo->username;

            if ($premium_subscription->save()) {
                DB::commit();
                return redirect('admin/premium-subscription');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function indexEditPremiumSubscription($id)
    {
        $data['premium_subscription'] = PremiumSubscription::where('id', $id)->first();
        return view('admin/edit-premium-subscription', $data);
    }

    public function updatePremiumSubscription(PremiumSubscriptionRequest $request)
    {
        try {
            PremiumSubscription::where('id', $request->id)->update([
                'name' => $request->name,
                'subtitle' => $request->subtitle,
                'validity' => $request->validity,
                'price' => $request->price,
                'free_days' => $request->free_days

            ]);
            return redirect('admin/premium-subscription');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deletePremiumSubscription($id)
    {
        PremiumSubscription::findOrFail($id)->update(['deleted_at'=>Carbon::now()]);
        return redirect('admin/premium-subscription');
    }
}
