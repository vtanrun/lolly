<?php

/*
 * 模板引擎配置
 */

return [
    //模板引擎选择（目前仅支持Lytpl）
    'TPL_SYSTEM' => 'Lytpl',
    //识别代码的左边符号
    'LEFT_SYM' => '{{',
    //识别代码的右边符号
    'RIGHT_SYM' => '}}',
    //全局变量
    'TPL_VAR' => [
        'static' => Lolly . 'app/view/public/'
    ],
];