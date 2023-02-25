<?php
namespace App\Controllers;


class BannerController  {

    function index() {
        include "./resources/views/home.php";
    }

    function imageBanner() {
        $pageTitle = "Image Banner";
        include "./resources/views/image-banner.php";
    }
}


?>