<?php
/*
 * 定义了一些可以在模板引擎中直接调用到函数
 */

use Lytpl\Lytpl;

class GlobalFun{
    public static function extend($path,$var){
        echo Lytpl::render_tpl($path,$var);
    }
}