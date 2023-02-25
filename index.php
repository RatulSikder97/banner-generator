<?php
session_start();
if (session_status() > 0) {
    session_unset();
    session_destroy();
}
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Config/constant.php';
require_once __DIR__.'/app/services/Route.php';

?>