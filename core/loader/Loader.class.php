<?php
/*
 * 自动加载文件类
 */

namespace Lolly;

class Loader{
    public static function import($path){
        $path = preg_replace('/\./','/',$path);
        @require_once(Lolly . 'app/program/' . $path . '.php');
    }
}