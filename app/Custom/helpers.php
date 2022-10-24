<?php
    if (!function_exists("serverError")) {
        function serverError()
        {
            return ['success' => false, 'message' => 'Sorry ! Something went wrong with server . please try again'];
        }
    }


    function userId(){
        request()->decoded->user_id;
    }

?>
