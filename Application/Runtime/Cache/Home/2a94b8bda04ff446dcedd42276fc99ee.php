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
        
        
      
        

<style>

    .video{
        display: block;
        background: linear-gradient(rgba(255,255,255,0),rgba(255,255,255,0)) no-repeat;
        background-size: 300px 400px;
    }
    .video a{
        height: 400px;
        width: 300px;
        background: url('/bsys/upload/series/av15712999231461188290.jpg') no-repeat; 
        background-size: 300px 400px;
    }
    .video:hover{
        background: linear-gradient(rgba(255,255,255,0),black) no-repeat;
        background-size: 300px 400px;
    }
</style>
<script>
</script>
<section style="background: #2a2a2a; width:100%; height: 1000px;">
    <div style="height:100%; width: 1450px;margin: 0 auto; padding: 0 20px;">
        <div class="video" style="width: 300px; height: 400px;">
            <a href="/bsys/index.php/Home/index/play" style="display: block;background-size: 300px 400px;"></a>
        </div>
    </div>
</section>


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