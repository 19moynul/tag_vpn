<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function changePasswordForm()
    {
        return view('admin.change-password.change-password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:20',
            'confirm_password' => 'required|same:new_password|min:8|max:20'
        ]);
        try {
            $user = Admin::where('id', Auth::user()->id)->first();
            if ($user) {
                if (Hash::check($request->old_password, $user->password)) {
                    User::where('id', $user->id)->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                    return redirect()->back()->with('success', 'Password has been changed successfully');
                } else {
                    return redirect()->back()->with('warning', 'Wrong Password ! Please Use Correct Password');
                }
            } else {
                return redirect()->back()->with('error', 'Sorry User Not Found');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->error('error', 'Sorry Something Went Wrong . Please Try later');
        }
    }
}
