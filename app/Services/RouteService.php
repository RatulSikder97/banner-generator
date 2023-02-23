<?php

namespace App\Services;

class RouteService {
    static $server;


    function __construct()
    {
        $this->server = $_SERVER;
    }

    public static function __callStatic($name, $arguments)
    {
        echo $name;
        die();
        return call_user_func_array($name, $arguments);
    }

    public static function initServer() {
        return 'Cll  me';
    }
}
?>