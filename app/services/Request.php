<?php
namespace App\Request;

final class Request {
    private $body;

    function __construct()
    {
        $this->body = $_REQUEST;
    }

    function get($key) {
        if(array_key_exists($key, $_REQUEST)) {
            return $_REQUEST[$key];
        }
    }
}