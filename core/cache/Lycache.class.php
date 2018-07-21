<?php

namespace cache;

use Lolly\Lolly;

class Lycache{
    private $conn;
    private $conf;
    private $ok;

    //获取Redis连接
    public static function Redis(){
        $conf = require(Lolly . 'app/config/cache.php');

        //判断redis是否加载
        if(extension_loaded('redis')){

            //连接redis服务器并选择默认数据库
            $conn = new \Redis();
            $conn->connect($conf['RDS_HOST'],$conf['RDS_PORT']);
            $conn->select($conf['RDS_DB']);
            return $conn;
        }else{
            return false;
        }
    }

    //构造函数
    public function __construct(){

        //加载缓存的配置文件
        $this->conf = require(Lolly . 'app/config/cache.php');

        //判断redis是否加载
        if(extension_loaded('redis')){

            //连接redis服务器并选择默认数据库
            $this->conn = new \Redis();
            $this->ok = $this->conn->connect($this->conf['RDS_HOST'],$this->conf['RDS_PORT']);
            $this->conn->select($this->conf['RDS_DB']);
        }else{
            $this->ok = false;
            echo 'Redis is not fond';
        }
    }

    //测试连接是否成功
    public function ping(){
        if($this->ok){
            if($this->conn->ping() == '+PONG'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //存放数据
    public function set($key,$val){
        if(is_string($key)){
            if(is_string($val)){
                $this->conn->set($key,$val);
                return true;
            }elseif(is_array($val)){
                $this->conn->set($key,json_encode($val));
                return true;
            }
        }
        return false;
    }

    //获取数据
    public function get($key){
        if(is_string($key)){
            $str = $this->conn->get($key);
            if($this->is_json($str)){
                $ret = json_decode($str,true);
            }else{
                $ret = $str;
            }
        }else{
            return false;
        }
        return $ret;
    }

    //删除数据
    public function del($key){
        if(is_string($key)){
            if($this->conn->get($key)) {
                $this->conn->del($key);
                return true;
            }
        }
        return false;
    }

    //清除数据库所有数据
    public function clean($key){
        if(is_string($key)){
            $this->conn->flushDB();
        }
        return false;
    }

    //
    private function is_json($str){
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}