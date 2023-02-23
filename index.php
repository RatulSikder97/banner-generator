<?php

use App\Services\RouteService;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Config/constant.php';


RouteService::initServer();

$config= new App\Controllers\BannerController();
$config->index();

?>