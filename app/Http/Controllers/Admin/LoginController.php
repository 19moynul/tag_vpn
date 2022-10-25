<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
        public function pass(){
        $pass = Hash::make('12345');
        dd($pass);
    }

      public function adminLoginIndex(){
        $user =Auth::user();
        return view('admin/login');
    }
    public function adminLogout()
    {
        $user = Auth::logout();
        return view('admin/login');
    }


      public function adminLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = Admin::login($request);


            if (isset($user["success"])) {
                return redirect("/admin/dashboard")->withSuccess('You have Successfully logged in');
            }
            return redirect("/admin/login")->with('error',$user["message"]);
        } catch(\Exception $e) {
            Log::emergency("Can't login" . $e->getMessage());
            return $e;
            return redirect("/admin/login")->with('error','login please ');
        }
    }
    }
