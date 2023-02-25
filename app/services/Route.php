<?php
namespace App\Services;

use App\Controllers\BannerController;

$server = $_SERVER;

$url = parse_url($server['REQUEST_URI'])['path'];
$queryParams = parse_url($server['REQUEST_URI'])['query'];
$requestMethod = $server['REQUEST_METHOD'];


$GLOBALS['routeGetControllerMapper'] =  [
    '/' => [BannerController::class, 'index'],
    '/banner'=> [BannerController::class, 'index'],
    '/banner/image-banner'=>[BannerController::class, 'imageBanner'],
    '/banner/generated' => [BannerController::class, 'generatedBanner']
];


function postRoute($url) {
    $singleton = new BannerController();

    $singleton->generateImageBanner(); 
}

function getRoute($url) {

}

function route($url, $method = 'GET') {
    global $routeGetControllerMapper;


    // Wildcard Route
    if(!array_key_exists($url, $routeGetControllerMapper)) {
        header('Location: /', $response_code=302);
        route('/');
        return;
    }

    if($method == 'POST') {
        postRoute($url);
        return;
    }

    $singleton = new $routeGetControllerMapper[$url][0];
    $singleton -> {$routeGetControllerMapper[$url][1]}();
    unset($singleton);
    return;
}

route($url, $requestMethod);
die();


?>