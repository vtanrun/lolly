<?php

namespace Lolly;

use Lytpl\Lytpl;

/*
 * Lolly核心代码
 */

class Lolly{
    private $config;
    private $urls = Array();
    private $statics = Array();
    private $nlimit = Array();
    private $p404 = Array();

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

        $param = $urlList;
        array_shift($param);


        if(substr($_SERVER["REQUEST_URI"],-1) == '/' &&  isset($urlList[0])){
            array_push($param,'');
        }

        $sym = str_repeat('../',sizeof($param));
        define('__PUBLIC__',$sym);

        if(isset($this->urls[$route_path])){
            if(isset($this->nlimit[$route_path])){
                if($this->nlimit[$route_path] < sizeof($param)){
                    @die(Lytpl::render_err('404',$this->p404));
                }
            }
            echo @call_user_func($this->urls[$route_path],$param);

        }elseif(isset($this->statics[$route_path])){
            $dir = Lolly . 'app/view/public' . $this->statics[$route_path];
            if(is_file($dir .  implode('/',$param))){
                echo @file_get_contents($dir .  implode('/',$param));
            }
        }else{
            @die(Lytpl::render_err('404',$this->p404));
        }

    }

    //增加单条路由
    public function route($path,$vers,$num=null){
        if(is_string($path) && is_string($vers)){
            $this->urls[$path] = $vers;
            if(is_int($num)){
                $this->nlimit[$path] = $num;
            }
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

    //增加静态文件的别名
    public function addStaticAlias($alias,$path){
        if(is_string($alias) && is_string($path)){
            $this->statics[$alias] = $path;
        }
    }

    //限制二级目录长度
    public function routePathNum($path,$num){
        if(is_string($path) && is_int($num)){
            if(isset($this->urls[$path])){
                $this->nlimit[$path] = $num;
            }
        }
    }

    //404传入的值
    public function paramTo404($list){
        if(is_array($list)){
            $this->p404 = $list;
        }
    }
}
