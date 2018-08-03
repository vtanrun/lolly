<?php $vars = json_decode('{"page":"\u4e3b\u9875"}',true); ?>
<?php foreach($vars as $k => $v){ ?>
<?php $$k = $v; ?>
<?php } ?>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>易诗|<?php echo $page; ?></title>
    <link rel="stylesheet" href="<?php echo(__PUBLIC__); ?>static/layui/css/layui.css">
    <link rel="stylesheet" href="<?php echo(__PUBLIC__); ?>static/semantic/semantic.min.css">
    <link rel="stylesheet" href="<?php echo(__PUBLIC__); ?>static/layx/layx.min.css">
    <script src="<?php echo(__PUBLIC__); ?>static/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo(__PUBLIC__); ?>static/layui/layui.js"></script>
    <script src="<?php echo(__PUBLIC__); ?>static/semantic/semantic.min.js"></script>
    <script src="<?php echo(__PUBLIC__); ?>static/layx/layx.min.js"></script>
    <script src="<?php echo(__PUBLIC__); ?>static/vue/vue.js"></script>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
    }
    .big-div{
        padding: 15px;
        max-width: 1000px;
        margin: auto;
    }
</style>

<body>

<ul class="layui-nav layui-bg-green" lay-filter="">
    <div class="">
        <li class="layui-nav-item"><a href="#" style="font-size:22px">易诗</a></li>
        <li class="layui-nav-item layui-this"><a href="">主页</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">分类</a>
            <dl class="layui-nav-child">
                <dd><a href="">移动模块</a></dd>
                <dd><a href="">后台模版</a></dd>
                <dd><a href="">电商平台</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item" style="float:right;"><a href="">注册</a></li>
        <li class="layui-nav-item" style="float:right;"><a href="">登录</a></li>
    </div>
</ul>

<script>
    layui.use('element', function(){
        var element = layui.element;
    });
</script>

<div class="big-div">
    <div class="layui-container">
        <div class="layui-row">
            <div class="layui-col-md8">

                <div id="recommend">
                    <div class="ui card" style="width:100%;" v-for="poem in poems">
                        <div class="content">
                            <div class="header"><a href="" style="color:black;">{{ poem.title }}</a></div>
                            <div class="meta">
                                <span>2 天前</span>
                                <a>{{ poem.author }}</a>
                            </div>
                            <img class="ui Tiny right floated image" :src="poem.image">
                            {{ poem.content }}
                        </div>
                        <div class="extra content">
                            <span class="left floated like"><i class="like icon"></i> Like </span>
                            <span class="right floated star"><i class="star icon"></i> Favorite </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="layui-col-md4">
                你的内容 3/12
            </div>
        </div>
    </div>
</div>

<script>
    var recommend = new Vue({
        el:'#recommend',
        data:{
            poems:[
                {
                    title:'鹅',
                    content:'鹅鹅鹅鹅鹅鹅鹅，一鹅一鹅又一鹅。',
                    author:'张子雍',
                    image:'http://img.bz1111.com/JueSe/159/159376-13.jpg'
                },
                {
                    title:'泰山',
                    content:'远看泰山黑乎乎，上边细来下边粗。有朝一日到过来，下边细来上边粗。',
                    author:'张子雍',
                    image:'http://img.bz1111.com/JueSe/159/159376-13.jpg'
                }
            ],
            products:[]
        },
        created(){
            fetch('http://api.myjson.com/bins/74l63')
                .then(response => response.json())
                .then(json => {
                    this.products = json.products
                })
        }
    });
</script>

</body>
</html>