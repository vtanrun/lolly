<?php

$tools = [
    'String.class.php',
    'Upload.class.php'
];

foreach($tools as $path){
    @require_once($path);
}