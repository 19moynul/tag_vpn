<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;


class ServerController extends Controller
{
    public function serverList(){
        $data = Server::get();
        return response()->json(['data'=>$data]);
    }

    public function serverDetails($id){
        $data = Server::where('id',$id)->first();
        return response()->json(['data'=>$data]);
    }
}
