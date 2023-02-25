<?php
namespace App\Controllers;

use function App\Services\route;

class BannerController  {

    function index() {
        include "./resources/views/home.php";
    }

    function imageBanner() {
        $pageTitle = "Image Banner";
        include "./resources/views/image-banner.php";
    }

    function generateImageBanner() {
        $bannerImg = $_REQUEST['bannerImg'];
        $bannerLink = $_REQUEST['bannerLink'];
    
    
        $bannerHtml = '<a href="'.$bannerLink.'?ref=img_banner_ad" style="display:block; max-height: 300px; max-width: 1100px; margin: 20px auto;position:relative;"><span style="color: #838383; font-size:10px; position: absolute; right: 10px; bottom: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span><img src="'.$bannerImg.'"  style="width: 100% !important; height: 100%;" alt="revive test banner" /></a>';
        
        $_SESSION['banner'] = $bannerHtml;
        return route('/banner/generated');
    }


    function generatedBanner() {
        include "./resources/views/generated-banner.php";
    }
}


?>