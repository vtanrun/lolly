<?php
/*
 * lolly入口文件
 *
 */

use Lolly\Lolly;

define('Lolly',dirname(__FILE__) . '/');

//引用自动加载文件
require_once(Lolly . 'vendor/autoload.php');

$lolly = new Lolly();

$lolly->routeConf();

$lolly->run();