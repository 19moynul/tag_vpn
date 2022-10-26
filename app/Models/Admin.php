<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use HasFactory;
    public $table = 'tbl_admin';

     protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



     public static function login($request)
    {

        $user = Admin::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                if ($user->status == 1) {
                    Auth::login($user,false);
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
