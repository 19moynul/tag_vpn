<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;
    public $table = 'tbl_admin';

     public static function login($request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                if ($user->status == 1) {
                    Auth::login($user);
                    return ["success" => true];
                } else {
                    Auth::logout();
                    return ["error" => true, "message" => "Your account is not active"];
                }
            } else {
                return ["error" => true, "message" => "Incorrect email or password"];
            }
        } else {
            return ["error" => true, "message" => "Incorrect email mobile or password "];
        }
    }
}
