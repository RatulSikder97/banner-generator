<?php
namespace App\Controllers;

use App\Services\RouteService;

class BannerController  {

    function index() {
        echo "<pre>";
        print_r(RouteService::$server);
        die();
        include "./resources/views/home.php";
    }
}


?>