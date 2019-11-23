<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <title>影视圈</title>
    <link rel="icon" href="/bsys/Public/static/ico/favicon-20191016105036978.ico">
    <link rel="icon" href="/bsys/Public/static/css/icon.css">
    <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
    <!-- <script src="/bsys/Public/static/js/vue.js"></script> -->
    <script>
    </script>  
    <link href="https://vjs.zencdn.net/7.6.5/video-js.css" rel="stylesheet">

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src='https://vjs.zencdn.net/7.6.5/video.js'></script>
    <script>
        $(function(){
            $.ajax({
                type:post,
                dataType:JSON,
                url:"/bsys/index.php/Home/",
                success:function(r){
                    
                }
            })
        })

        function show_in(event){
            console.log($("#"+event.target.id));
            $(event.target).children("ul").eq(0).css("display","block");
        }
        function show_out(event){
            console.log($("#"+event.target.id));
            $(event.target).children("ul").eq(0).css("display","none");
        }
    </script>
    <style>
        *{padding: 0;margin: 0;}
        a{text-decoration: none;color: black;}
        ul,li{ padding:0;margin:0;list-style:none}
        .header{
            position: relative;
            background: rgba(red, green, blue, 0);
            width: calc(100%-50px);
            height:50px;
            line-height: 50px;
            background: #2a2a2a;
            padding: 25px 50px 75px;
            /* margin-bottom: 50px; */
        }
        .logo{
            margin-left: 40px;
            float: left;
        }
        .primary_menu_nav{
            margin-right: 40px;
            float: right;
        }
        .primary_menu_nav ul li.nav{
            /* width: 70px; */
            float: left;
            padding: 0px 15px;
            margin: 0 auto;
            font-size: 20px;
            font-weight: bold;
        }
        .primary_menu_nav ul li.nav a{
            padding: 0 5px;
            text-align: center;
            color: #3a8fb7;
        }
        #tag ul{
            background: #fff;
        }
        .subnav a{
            display: block;
            font-size: 14px;
            margin: 0 auto;
            text-align: center;
            color: #000;
        }
        .subnav a:hover{
            background: #000;
            color: #fff;
        }
        .subnav{
            /* padding: 0 10px; */
            height: 25px;
        }
          
    </style>
</head>
<body >
    <section class="header">
        <div class="main">

            <div class="logo">
                <a href="index"><img src="/bsys/Public/static/img/logo_icon.png" alt="" height="50">
                </a>
            </div>

            <div class="primary_menu_nav">
                <ul>
                    <li class="nav"><a href="#">热映中</a></li>
                    <li class="nav"><a href="#">站长推荐</a></li>
                    <li class="nav"><a href="#">剧集</a></li>
                    <li class="nav"><a href="#">电影</a></li>
                    <li class="nav"><a href="#">动画</a></li>
                    <li class="nav" id="tag" 
                    onmouseenter="show_in(event)" 
                    onmouseleave="show_out(event)" ><a href="#">类型</a><div class="bottom"></div>
                        <ul  style="display: none;width: 100px;" >
                            <li class="subnav"><a href="#">动作</a></li>
                            <li class="subnav"><a href="#">喜剧</a></li>
                            <li class="subnav"><a href="#">爱情</a></li>
                            <li class="subnav"><a href="#">科幻</a></li>
                            <li class="subnav"><a href="#">犯罪</a></li>
                            <li class="subnav"><a href="#">悬疑</a></li>
                            <li class="subnav"><a href="#">恐怖</a></li>
                            <li class="subnav"><a href="#">NSFW</a></li>
                        </ul>
                    </li>
                    <li class="nav"><a href="#">其他</a></li>
                    <li class="nav"><a>搜索</a></li>
                </ul>
            </div>

            
        </div>
    </section>
        
        
      
        

<script>
     
</script>
<div class="wrapper" style="background-color: #2a2a2a;">
    <div style="margin: 0 auto;width: 1200px;">
        <section id="video_content" style="background: #fff;width:1200px;margin: 0 auto;padding: 10px 0;"> 
                <video id='my-video' class='video-js' controls preload='auto' height="630" width="1180" 
                poster='MY_VIDEO_POSTER.jpg' data-setup='{}' style="margin: 0 auto;">
                    <source src='/bsys/upload/hotspot/av1571158997247866034.mp4' type='video/mp4'>
                    <source src='MY_VIDEO.webm' type='video/webm'>
                </video>
                <ul class="episode" style="padding-top: 10px;" >
                    <li style="padding: 2px 14px;border-bottom:1px solid #ccc ;"><a href="#"> 1.第一集01</a></li>
                    <li style="padding: 2px 14px;border-bottom:1px solid #ccc ;"><a href="#"> 2.第二集02</a></li>
                    <li style="padding: 2px 14px;border-bottom:1px solid #ccc ;"><a href="#"> 3.第三集03</a></li>
                    <li style="padding: 2px 14px;border-bottom:1px solid #ccc ;"><a href="#"> 4.第四集04</a></li>
                </ul>
        </section>
        
        
        <div id="last_update_time" style="font-size:18px;padding: 30px 0;color: #fff;">
            <p style="">最后更新于<span>2019-10-16 02:04</span></p>
        </div>


        <section class="detail" style="max-height: 465px; padding: 30px; border: 1px solid #999;margin: 0 auto;background: #fff;">
            <div style="height: 405px; width: 270px;background: #000;">
                <img src="/bsys/Public/static/img/logo_icon.png" 
                 class="cover" width="270" height="405"/>
            </div>
            <dl style="position: relative;top:-405px;left: 270px; margin-left: 30px; width: 800px;">
                <dt><a href="#">浪子神探</a></dt>
                <dd>原文片名: Prodigal Son</dd>
                <dd>又名: 不肖子神探 / 忤逆子神探 / 不肖之子 / 回头浪子</dd>
                <dd>导演: 李·杜兰·克里格</dd>
                <dd>演员: 麦克·辛 / 汤姆·佩恩 / 贝拉米·扬 / 卢·戴蒙德·菲利普斯</dd>
                <dd>类型: 犯罪 / 悬疑</dd>
                <dd>制片国家/地区: 美国</dd>
                </br>
                <dd>简介: 最好的犯罪心理学家之一：马尔科姆·布莱特，利用他的天赋异禀来帮助纽约警局破案。</dd>
            </dl>
            
        </section>
    </div>
</div>


    <section class="footer">
        <center>
            <a href="#"><img src="/bsys/Public/static/img/1571233493_867616.png" width="580" height="150" alt=""></a>
        </center>
    </section>
</body>
    <style>
        .footer{
            position: absolute;
            padding-top: 20px;
            height: 180px;
            width: 100%;
            background: #2a2a2a;
        }
    </style>
</html>