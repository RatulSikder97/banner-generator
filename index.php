<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Config/constant.php';

$config= new App\Controllers\BannerController();
$config->index();

?>