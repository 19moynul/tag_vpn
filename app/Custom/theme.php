<?php
if (!function_exists("sideMenu")) {
    function sideMenu()
    {
        $fileName = App\Models\User::getSidebarFileName();
        $path = base_path() . "/resources/views/layouts/menu/" . $fileName;
        $menu = json_decode(file_get_contents($path), true);
        return $menu;
    }
}
?>