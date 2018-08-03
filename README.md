Lolly是一款轻量级、高性能的PHP开发框架，是由小卓于"2018-07-15"发布。

### Lolly的出现:

在开发Lolly之前，我想做一个"我的世界"资源仓库。选择使用PHP来开发！在之前的项目中，我没有用过任何的框架，直到这一次，发现不用框架有些麻烦，写起来太累了。就去看了看"ThinkPHP"的文档，发现东西太多了，懒得去学！就想着自己开发一个框架，可以按照自己的需求来做！

### Lolly的特性

 - 简单易用:你可以在很短的时间内学会它并快速的使用它开发一个Web项目！
 - 开放性强:Lolly不会对功能进行过分的限制，你可以快速的开发出符合需求的项目！
 - MIT协议:你可以使用、复制、修改、合并、出版发行、散布、再授权及贩售项目及项目的副本！
 - 强大功能:内置Composer、Medoo，站在巨人的肩膀上！
 - 长期更新:作者将长期更新本项目，让Lolly越来越实用！
 - 简单配置:几乎为零的配置文件！
 - 快速部署:将代码放置到服务器并修改少量配置文件，即可完成部署

### Lolly的功能

> 当前功能介绍以Lolly2.0.2版本为标准

 - 灵活的路由系统，无任何过分的限制！
 - 轻量级模板引擎:Lytpl or [Wetpl][1]!
 - 简单对Redis缓存系统，封装常用函数！
 - 内置[Medoo][2]数据库访问框架！
 - 小型工具包：配置加载、字符串处理、文件上传...
 - 易于拓展的loader工具，一键引用其他PHP代码！

### 简单的Hello World


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

    //创建一个路由
    $lolly->route('/hello','hello');

    //限制路由Path数量
    $lolly->routePathNum('/hello',1);

    //index函数
    function hello($arg){
        return "hello:" . $arg[0];
    }
    //访问 /hello/name会输出一个 "hello:name" 如果访问的是 /hello/name/XXX 会出现404
    $lolly->run();   


### 项目主页

GitHub:https://github.com/xiaozhuox/lolly

码云:https://gitee.com/mrxzx/lolly

官方博客(持续更新教程):http://blog.wwsg18.com

  [1]: https://gitee.com/mrxzx/Wetpl
  [2]: https://medoo.lvtao.net
