<?php

namespace Lolly\Request;

class Request
{

    //进行初始化
    public static function init()
    {
        session_start();
    }

    //判断一个值是否存在
    public static function has($name, $key){
        switch ($name) {
            case 'get':
                return isset($_GET[$key]);
            case 'post':
                return isset($_POST[$key]);
            case 'request':
                return isset($_REQUEST[$key]);
            case 'server':
                return isset($_SERVER[$key]);
            case 'session':
                return isset($_SESSION[$key]);
            case 'cookie':
                return isset($_COOKIE[$key]);
            case 'env':
                return isset($_ENV[$key]);
            case 'file':
                return isset($_FILES[$key]);
        }
    }

    public static function method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function server(){
        return new server();
    }
}

class server{

    public function domain(){
        return $_SERVER['SERVER_NAME'];
    }

    public function software(){
        return $_SERVER['SERVER_SOFTWARE'];
    }

    public function protocol(){
        return $_SERVER['SERVER_PROTOCOL'];
    }

    public function uri(){
        return $_SERVER['SCRIPT_URI'];
    }

    public function port(){
        return $_SERVER['SERVER_PORT'];
    }

    public function cgi(){
        return $_SERVER['GATEWAY_INTERFACE'];
    }

}