<?php

namespace App\Http\Controllers\admin;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\MailResetPassword;
use App\Models\ResetPassword;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use DB;

class ForgotPasswordController extends Controller
{
    public function emailForm(){
        return view('admin.reset-password.email-form');
    }

    public function sendForgotPasswordOtp(Request $request){
        DB::beginTransaction();
        $this->validate($request,[
            'email'=>'required|email:rfc,dns',
        ]);
        try {
            $user =  Admin::where('email', $request->email)->first();
            if ($user) {
                $otp = rand(5, 99999);;
                ResetPassword::updateOrCreate(
                    ['email' => $request->email],
                    ['otp' => $otp,'user_type'=>Constant::ADMIN]
                );
                Mail::to($request->email)->send(new MailResetPassword('RESET PASSWORD', $otp));
                DB::commit();
                return view('admin.reset-password.verify-otp',['email'=>$request->email]);
                // return response()->jkson(['success' => true, 'message' => 'We have sent an OTP to your account'], 200);
            } else {
                return redirect()->back()->with('error','Sorry ! Invalid Email');
            }
        } catch (\Exception $e) {
            return $e;
            Log::error('reset password send-mail ' . $e->getMessage());
            return redirect()->back()->with('error','Sorry ! Something went wrong with server . please try again');
        }
    }

    public function verifyForgotPassword(Request $request){
         $this->validate($request,[
            'email'=>'required|email:rfc,dns',
            'otp'=>'required',
        ]);
        if (!is_null($request->otp)) {
            $isOtpValid = ResetPassword::where('email', $request->email)->where('otp', $request->otp)->where('user_type',Constant::ADMIN)->first();
            if ($isOtpValid) {
                return view('admin.reset-password.password-form',['email'=>$request->email,'otp'=>$request->otp]);
            } else {
                return redirect()->back()->with('error','Invalid Otp');
            }
        } else {
            return redirect()->back()->with('error','Invalid Otp');
        }
    }



     public function resetPassword(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'otp' => 'required',
            'new_password' => 'required|min:8|max:20',
            'confirm_password' => 'required|same:new_password|min:8|max:20'
        ]);
        DB::beginTransaction();
        try {
            Admin::where('email', $request->email)->update(['password' => Hash::make($request->new_password)]);
            ResetPassword::where('email', $request->email)->where('user_type',Constant::ADMIN)->delete();
            DB::commit();
            return redirect('admin/login');
        } catch (\Exception $e) {
            Log::error('reset-password' . $e->getMessage());
            return redirect()->back()->with('error','Sorry ! Something went wrong with server . please try again');
        }
    }
}
