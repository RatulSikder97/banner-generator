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
    '/banner/generated' => [BannerController::class, 'generatedBanner'],
    '/banner/single-product' => [BannerController::class, 'singleProductBanner']
];

$GLOBALS['routePostControllerMapper'] =  [
    '/banner/image-banner' => [BannerController::class, 'generateImageBanner'],
    '/banner/single-product' => [BannerController::class, 'generateSingleProductBanner'],
];


function postRoute($url) {
    global $routePostControllerMapper;
    $singleton = new $routePostControllerMapper[$url][0];
    $singleton -> {$routePostControllerMapper[$url][1]}();
    unset($singleton);
    return;
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