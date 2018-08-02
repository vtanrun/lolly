# Lolly

#### 项目介绍

一款轻量级的PHP框架,可快速开发中小型项目

#### 功能介绍

* 内置模板引擎，支持部分语句(if for goto ...)
* 内置强大的Medoo框架，踩上了巨人的肩膀
* 内置Composer，快捷的依赖管理
* 轻量级高性能，节省更多的开销

#### 代码演示

路由设置:

    //设置单个路由
    $lolly->route('/','index');
    
    //设置多个路由
    $lolly->routeList([
        '/' => 'index',
        '/user' => 'user'
    ]);
    
    //直接读取route.php的配置文件
    $lolly->routeConf();
    

模板引擎:

    //输出变量的值
    {{$name}}
    //if语句
    {{if 1 + 1 == 2}}
    //else语句
    {{ else }}
    //elseif语句
    {{elif 1 + 1 == 3 }}
    //for语句
    {{ for $i = 1;i < 10;i++ }}
    //循环遍历
    {{ loop $name($k,$v) }}
    //while
    {{ while true }}
    //结束语句(通用)
    {{ end }}
    
    ......
    
简单的Hello world

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
    
    $lolly->route('/hello','hello');
    
    //index函数
    function hello($arg){
        arg可以获取二级Path
        if(sizeof($arg) > 2){
            return \Lytpl\Lytpl::render_err('404',[]);
        }
        return "hello:" . $arg[1];
    }
    //访问 /hello/name会输出一个 "hello:name" 如果访问的是 /hello/name/XXX 会出现404
    $lolly->run();    
    
模板继承代码:
> index.php

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
    
    $lolly->route('/hello','hello');
    
    function hello(){
        return \Lytpl\Lytpl::render_tpl('index.html',[])
    }
    
> Lolly/view/public/index.html

    {{GlobalFun::extend('head/head.html',['test' => 'test msg'])}}
    
    <p>this is in Lolly/view/public/index.html</p>
    
    </body>
    </html>
    
> Lolly/view/public/head/head.html

    <html>
    <head>
        <title>{{$test}}</title>
    </head>
    <body>
        <p>this is in Lolly/view/public/head/head.html</p>

    
#### siege测试

循环输出10个 hello world

>MBP:~ mrxzx$ siege -c 100 -t 30s localhost/lolly<br>

>Transactions:		       16352 hits<br>
 Availability:		       99.79 %<br>
 Elapsed time:		       29.78 secs<br>
 Data transferred:	        3.53 MB<br>
 Response time:		        0.11 secs<br>
 Transaction rate:	      549.09 trans/sec<br>
 Throughput:		        0.12 MB/sec<br>
 Concurrency:		       60.91<br>
 Successful transactions:       16441<br>
 Failed transactions:	          34<br>
 Longest transaction:	        0.42<br>
 Shortest transaction:	        0.01<br>
 
[Lolly开发教程](https://www.kancloud.cn/mrxzx/lollyfw/698925)

