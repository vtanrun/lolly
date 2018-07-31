<?php

/*
 * 配置文件读取类
 */

namespace tools;

class Conf{
    public static function ConfGet($path){
        $path = preg_replace('/\./','/',$path);
        return @require_once(Lolly . 'app/config/' . $path . '.php');
    }
}