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

框架主页:https://xiaozhuox.github.io/lolly/
