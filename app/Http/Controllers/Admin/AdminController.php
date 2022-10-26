<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public $model;
    public function __construct()
    {
        $this->model = new Admin();
    }

    public function create()
    {
        return view('admin.users.store');
    }

    public function list()
    {
        $data = Admin::orderBy('id', 'DESC')->get();
        return view('admin.users.list', compact('data'));
    }


    public function edit($id)
    {
        $data = Admin::where('id', $id)->first();
        return view('admin.users.store', compact('data',));
    }


    public function store(AdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = ['name' => $request->name, 'email' => $request->email, 'status' => Constant::USER_STATUS_ACTIVE];
            if($request->has('password')){
                $data['password'] = Hash::make($request->password);
            }
            if ($request->has('id')) {
                Admin::where('id', $request->id)->update($data);
                $text = 'updated';
            } else {
                Admin::insert($data);
                $text = 'created';
            }
            DB::commit();
            return redirect()->back()->with('success', 'users has been ' . $text . ' successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('User -> store : ' . $e->getMessage());
            return redirect()->back()->with('error', serverError());
        }
    }

    public function delete($id)
    {
        Admin::find($id)->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}
