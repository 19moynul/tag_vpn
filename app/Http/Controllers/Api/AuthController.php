<?php

namespace App\Http\Controllers\Api;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationReqest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SocialLoginRequest;
use App\Mail\MailResetPassword;
use App\Models\DeviceToUser;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\JwtRepository;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;

class AuthController extends Controller
{
    public $jwtRepo;

    public function __construct(JwtRepository $jwtRepo)
    {
        $this->jwtRepo = $jwtRepo;
    }


    public function register(RegistrationReqest $request){
        DB::beginTransaction();
        try{
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ];

            $userId =  User::insertGetId($data);

            $payLoad = [
                'user_id' => $userId,
                'name'=>$request->name,
                'email'=>$request->email,
            ];
            $token = $this->jwtRepo->setJwtToken($payLoad);

            DB::commit();
            return response()->json([
                'success'=>true,
                'message'=>'User accont registered successfully',
                'data'=>$payLoad,
                'token'=>$token
            ]);


        }catch(\Exception $e){
            return $e;
            Log::error('error in registration api : '.$e->getMessage());
            return response()->json(serverError(),500);
        }
    }


    public function login(LoginRequest $request){
        try{
             $user=User::where('email',$request->email)->first();
             if($user){
                if(Hash::check($request->password,$user->password)){
                    if($user->status == Constant::USER_STATUS_ACTIVE){
                        $numberofConnectedDevice = DeviceToUser::where('user_id',$user->id)->where('uid','!=',$request->uid)->count();
                        if($numberofConnectedDevice >= 5){
                           return response()->json(['success'=>false,'message'=>'Sorry ! max 5 user can use this account'],409);
                        }

                        $device = DeviceToUser::updateOrCreate([
                            'user_id'=>$user->id,'uid'=>$request->uid
                        ],[
                            'device_name'=>$request->device_name,
                            'uid'=>$request->uid
                        ]);

                         $payLoad = [
                            'user_id' => $user->id,
                            'name'=>$user->name,
                            'email'=>$user->email,
                            'device_id'=>$device->id
                        ];
                        $token = $this->jwtRepo->setJwtToken($payLoad);
                        return response()->json([
                            'success'=>true,
                            'token'=>$token,
                            'data'=>$payLoad,
                            'message'=>'You are logged in successfully'
                        ]);
                    }else{
                        return response()->json(['success'=>false,'message'=>'Sorry ! your account has been deactivated'],409);
                    }
                }else{
                    return response()->json(['success'=>false,'message'=>'Invalid email or password address'],409);
                }
             }else{
                return response()->json(['success'=>false,'message'=>'Invalid email or password address'],409);
             }
        }catch(\Exception $e){
            Log::error('error in login api : '.$e->getMessage());
            return response()->json(serverError(),500);
        }
    }


    public function sendForgotPasswordOtp(ForgotPasswordRequest $request){
        DB::beginTransaction();
        try {

            $user =  User::where('email', $request->email)->first();
            if ($user) {
                $otp = rand(5, 99999);;
                ResetPassword::updateOrCreate(
                    ['email' => $request->email],
                    ['otp' => $otp,'user_type'=>Constant::USER]
                );
                Mail::to($request->email)->send(new MailResetPassword('RESET PASSWORD', $otp));
                DB::commit();
                return response()->json(['success' => true, 'message' => 'We have sent an OTP to your account'], 200);
            } else {
                return response()->json(['success' => true, 'message' => 'Sorry ! Invalid Email'], 400);
            }
        } catch (\Exception $e) {
            return $e;
            Log::error('reset password send-mail ' . $e->getMessage());
            return response()->json(serverError(), 500);
        }
    }

    public function verifyForgotPassword(Request $request){
        if (!is_null($request->otp)) {
            $isOtpValid = ResetPassword::where('email', $request->email)->where('otp', $request->otp)->where('user_type',$request->user_type)->first();
            if ($isOtpValid) {
                return ['success' => true,'message'=>'Otp validated successfully'];
            } else {
                return ['success' => false, 'message' => "Invalid Otp"];
            }
        } else {
            return ['success' => false, 'message' => "Invalid Otp"];
        }
    }



     public function resetPassword(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            User::where('email', $request->email)->update(['password' => Hash::make($request->new_password)]);
            ResetPassword::where('email', $request->email)->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Password Reseted Successfully'], 200);
        } catch (\Exception $e) {
            Log::error('reset-password' . $e->getMessage());
            return response()->json(serverError());
        }
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', optional($request->decoded)->user_id)->first();
            if($user){
                $user->update(['password' => Hash::make($request->new_password)]);
                return response()->json(['status' => true, 'message' => 'Password has been changed successfully'], 200);
            }else{
                return response()->json(['status' => false, 'message' => 'Sorry we cant find your account. please logout and login than try again'], 200);
            }
        } catch (\Exception $e) {
            Log::error('change-password' . $e->getMessage());
            return response()->json(serverError());
        }
    }


    public function socialLogin(SocialLoginRequest $request)
    {
        $user =  Socialite::driver($request->type)->userFromToken($request->token);
        if ($user) {
            $userInfo = User::where('email', $user->getEmail())->where('auth_id',$user->getId())->first();

            $numberofConnectedDevice = DeviceToUser::where('user_id',$userInfo->id)->where('uid','!=',$request->uid)->count();
            if($numberofConnectedDevice >= 5){
                return response()->json(['success'=>false,'message'=>'Sorry ! max 5 user can use this account'],409);
            }

            $device = DeviceToUser::updateOrCreate([
                'user_id'=>$userInfo->id,'uid'=>$request->uid
            ],[
                'device_name'=>$request->device_name,
                'uid'=>$request->uid
            ]);

            if (!$userInfo) {
                $data = [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'account_type'=>$request->type,
                    'auth_id'=>$user->getId()
                ];

                $userId =  User::insertGetId($data);
                $payLoad = [
                    'user_id' => $userId,
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'device_id'=>$device->id
                ];
            }else{
                $payLoad = [
                    'user_id' => $userInfo->id,
                    'name' => $userInfo->name,
                    'email' => $userInfo->email,
                    'device_id'=>$device->id
                ];
            }



            $token = $this->jwtRepo->setJwtToken($payLoad);

            return response()->json([
                'success' => true,
                'token' => $token,
                'data' => $payLoad,
                'message' => 'Successfully logged in.',
            ], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry , Cant\'t login , please try again']);
        }
    }
}
