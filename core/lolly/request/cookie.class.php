<?php

namespace Lolly\Request;

class cookie{
    private	$time;

    //构造函数
    public function __construct()
    {
        $this->time	= time() + 1800;
    }

    //设置cookie
    function set($name, $val = '' , $time = '', $httponly = false, $path = '', $domain = '', $secure = false){
        if($time == '' || !is_numeric($time)){
            $time = $this->time;
        }else{
            $time = time()+$time;
        }
        if($name != ''){
            setcookie($name,$val,$time,$path,$domain,$secure,$httponly);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //获取cookie
    function get($name){
        if($name != ''){
            return empty($_COOKIE[$name])? '' : $_COOKIE[$name];
        }else{
            return '';
        }
    }

    //删除cookie
    function remove($name){
        if($name != ''){
            $this->set($name, '',0);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //清除所有cookie
    public function cleanAll(){
        if(isset($_COOKIE)){
            unset($_COOKIE);
        }

    }
}