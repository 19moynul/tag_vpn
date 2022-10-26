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


    if (!function_exists("getFormInfo")) {
    function getFormInfo($isEditInfo, $others = [])
    {
        if ($isEditInfo) {
            $info = ['title' => 'EDIT', 'status' => 'success', 'button_name' => 'UPDATE', 'image_class' => 'edit-input'];
        } else {
            $info = ['title' => 'CREATE', 'status' => 'success', 'button_name' => 'CREATE', 'image_class' => ''];
        }
        return array_merge($info, $others);
    }

    function deviceId(){
        return request()->decoded->device_id;
    }
}
