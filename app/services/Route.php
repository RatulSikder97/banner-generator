<?php
namespace App\Services;

use App\Controllers\BannerController;

$server = $_SERVER;

$url = parse_url($server['REQUEST_URI'])['path'];
$queryParams = parse_url($server['REQUEST_URI'])['query'];


$GLOBALS['routeControllerMapper'] =  [
    '/' => [BannerController::class, 'index'],
    '/banner'=> [BannerController::class, 'index'],
    '/banner/image-banner'=>[BannerController::class, 'index'],
];



function route($url) {
    global $routeControllerMapper;


    // Wildcard Route
    if(!array_key_exists($url, $routeControllerMapper)) {
        header('Location: /', $response_code=302);
        route('/');
        return;
    }

    $singleton = new $routeControllerMapper[$url][0];
    $singleton -> {$routeControllerMapper[$url][1]}();
    unset($singleton);
    return;
}

route($url);
die();


?>