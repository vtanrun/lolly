<?php

/*
 * 自动加载文件
 */

namespace Lolly\Loader;

$config = require(Lolly . 'app/config/loader.php');

foreach($config['LOADER_PATH'] as $path){
    @include_once($path);
}
