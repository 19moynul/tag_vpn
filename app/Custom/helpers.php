<?php

use App\Enums\Constant;
use App\Models\User;

if (!function_exists("sideMenu")) {
    function sideMenu()
    {
        $fileName = 'admin-menu.json';
        $path = base_path() . "/resources/views/layouts/menu/" . $fileName;
        $menu = json_decode(file_get_contents($path), true);
        return $menu;
    }
}
if (!function_exists("serverError")) {
    function serverError()
    {
        return ['success' => false, 'message' => 'Sorry ! Something went wrong with server . please try again'];
    }
}

if (!function_exists("isActive")) {
    function isActive($url)
    {
        $browserUrl = request()->getRequestUri();
        if (strpos($browserUrl, $url)) {
            return 'active';
        }
    }
}

function getUserSubscriptionStatus($status){
    if($status == 0){
        return 'Pending';
    }else if($status == 1){
        return 'Active';
    }else{
        return 'Cancelled';
    }
}


function userId(){
        return request()->decoded->user_id;
    }
