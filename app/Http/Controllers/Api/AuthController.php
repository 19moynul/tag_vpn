<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\JwtRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistrationReqest;

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
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
            ];

            $userId =  User::insertGetId($data);

            $payLoad = [
                'user_id' => $userId,
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
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
}