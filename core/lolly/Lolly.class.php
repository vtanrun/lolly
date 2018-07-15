<?php

namespace Lolly;

use Lytpl\Lytpl;

/*
 * Lolly核心代码
 */

class Lolly{
    private $config;
    private $urls = Array();

    public function __construct(){
        //获取到核心配置文件到内容
        $this->config = require_once(Lolly . 'app/config/core.php');
    }

    //程序开始运行
    public function run(){

        //判断是否开启debug模式
        if ($this->config["APP_DEBUG"] === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }

        //开始解析url
        $url = $_SERVER["REQUEST_URI"];
        $pos = strpos($url,'?');
        $url = $pos === false ? $url : substr($url, 0, $pos);
        $url = trim($url,'/');

        $urlList = explode('/',$url);

        if($this->config['SECONDARY_PATH']){
            array_shift($urlList);
        }

        @$route_path = "/" . $urlList[0];
        $param = $urlList ? $urlList : array();

        if(isset($this->urls[$route_path])){

            echo @call_user_func($this->urls[$route_path],$param);
        }else{
            die(Lytpl::render_err('404',[]));
        }

    }

    //增加单条路由
    public function route($path,$vers){
        if(is_string($path) && is_array($vers)){
            $this->urls[$path] = $vers;
        }
    }

    //增加多条路由
    public function routeList($list){
        if(is_array($list)){
            foreach($list as $k => $v){
                $this->urls[$k] = $v;
            }
        }
    }

    //程序自动读取route.php配置文件
    public function routeConf(){
        @$conf = require(Lolly . 'app/config/route.php');
        if(is_array($conf)){
            foreach($conf as $k => $v){
                $this->urls[$k] = $v;
            }
        }
    }
}