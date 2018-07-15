<?php

namespace cache;

use Lolly\Lolly;

class Lyredis{
    private $conn;
    private $conf;
    private $ok;
    public function __construct(){
        $this->conf = require(Lolly . 'app/config/cache.php');
        if(extension_loaded('redis')){
            $this->conn = new \Redis();
            $this->ok = $this->conn->connect($this->conf['RDS_HOST'],$this->conf['RDS_PORT']);
            $this->conn->select($this->conf['RDS_DB']);
        }else{
            $this->ok = false;
            echo 'Redis is not fond';
        }
    }
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

    public function string(){
        if($this->ok) {
            return new string($this->conn);
        }
    }

    public function lists(){
        if($this->ok) {
            return new lists($this->conn);
        }
    }

    public function redis(){
        if($this->ok) {
            return $this->conn;
        }
    }
}
class string{
    private $conn;

    //构造函数
    public function __construct($conn){
        $this->conn = $conn;
    }

    //获取键的值
    public function get($key){
        return $this->conn->get($key);
    }

    //设置键的值
    public function set($key,$val){
        return $this->conn->set($key,$val);
    }

    //删除指定的键
    public function delete(...$key){
        $this->conn->delete($key);
    }
}

class lists{
    private $conn;

    //构造函数
    public function __construct($conn){
        $this->conn = $conn;
    }

    //插入数据
    public function push($key,$val){
        $this->conn->lpush($key,$val);
    }

    //获取值
    public function range($key,$start,$end){
        $this->conn->lrange($key,$start,$end);
    }

    //右侧增加
    public function rpush($key,$val){
        $this->conn->rPush($key,$val);
    }

    //左侧弹出
    public function lpop($key){
        $this->conn->lpop($key);
    }

    //右侧弹出
    public function rpop($key){
        $this->conn->rpop($key);
    }

    //删除数据
    public function remove($key,$val,$count){
        $this->conn->lrem($key,$val,$count);
    }
}