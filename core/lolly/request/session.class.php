<?php

class session{

    //session初始化
    function __construct(){
        session_start();
    }

    //设置Session
    function set($key,$val){
        return $_SESSION[$key] = $val;
    }

     //获取Session
    function get($name){
        return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
    }

    //删除一个session
    function remove($name){
        if(isset($name)) {
            unset($_SESSION[$name]);
            return TRUE;
        }
        return False;
    }

    //清除所有session
    function cleanAll(){
        if(isset($_SESSION)) {
            session_unset();
        }
    }
}