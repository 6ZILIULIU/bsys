<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <title>影视圈</title>
    <link rel="icon" href="/bsys/Public/static/ico/favicon-20191016105036978.ico">
    <link rel="icon" href="/bsys/Public/static/css/icon.css">
    <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
    <!-- <script src="/bsys/Public/static/js/vue.js"></script> -->
    <!-- video.js播放器CDN -->
    <link href="https://vjs.zencdn.net/7.6.5/video-js.css" rel="stylesheet">
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script>

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
            height: 30px;
            line-height: 30px;
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
                <a href="/bsys/index.php/Index/hotspot/list"><img src="/bsys/Public/static/img/logo_icon.png" alt="" height="50">
                </a>
            </div>
            
            <div class="primary_menu_nav">
                <ul>
                    <li class="nav"><a href="/bsys/index.php/Index/hotspot/list">热映中</a></li>
                    <li class="nav"><a href="#">站长推荐</a></li>
                    <li class="nav"><a href="/bsys/index.php/Index/series/list">剧集</a></li>
                    <li class="nav"><a href="/bsys/index.php/Index/movie/list">电影</a></li>
                    <li class="nav"><a href="/bsys/index.php/Index/animation/list">动画</a></li>
                    <li class="nav" id="tag" 
                    onmouseenter="show_in(event)" 
                    onmouseleave="show_out(event)" ><a href="#">类型</a>
                        <ul  style="display: none;width: 100px;height:auto;position:absolute;z-index:5" >
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
    .episode{
        padding: 2px 14px;
        border-bottom:1px solid #ccc ;
    }
    .vjs-big-play-button {
        left: 50% !important;
        top: 50% !important;
        margin-left: -2em;
        margin-top: -1.3em;
    }
</style>
<script>
    // console.log(location.search.substring(1));


    var row = 0;
    var rows = 0;
    var series_id = parseInt(getQueryValue('series_id')[1]);
    // console.log(series_id);
    window.onload = function(){
        $.ajax({
            type:'get',
            dataType:'json',
            url:"/bsys/index.php/Index/Hotspot/getEpisode",
            data:{series_id:series_id},
            success:function(r){
                // console.log(r);
                //标题、最近更新事件、封面 -3
                $("#profile").text(r[r.length-1]);
                $("#title").text(r[r.length-2]);
                if(r[r.length-3]==null){
                    $("#last_update_time").text(" ");
                }else{
                    $("#last_update_time span").text(r[r.length-3]);
                }
                $("#cover").attr('src',"/bsys/upload/"+r[r.length-4]);
                rows = r;
                for(var i=0;i<r.length-4;i++){
                    // console.info(r[i].video_title);
                    var videoList_frame = '<li class="episode"><a href="javascript:void(0)">'+(i+1)+"."+r[i].video_title+'</a></li>';
                    $("#episode_wapper").append(videoList_frame);
                    // $("#episode_wapper").children().eq(i).children().eq(0).text(i+1+"."+r[i].video_title);
                }

                
                
                $(".episode").click(function(){
                    row = $(this).index();
                    // console.info(rows);
                    // console.info(r[row].video_filepath);
                    $('#my-video').children().eq(0).attr('src',"/bsys/upload/"+rows[row].video_filepath);
                    $("#episode_wapper a").css('font-weight','normal');
                    $("#episode_wapper").children().eq(row).children().eq(0).css('font-weight','bold');
                })
                $(".episode").eq(0).trigger('click');
            },
            error:function(r){
                // console.log(r);
                console.log('fail');
            }
        })

        
    }

    function getQueryValue(s){
        var query = location.search.substring(1);
        var strs = query.split('&');
        for(var i=0 ;i<strs.length;i++){
            var str = strs[i].split('=');
            var key = str[0];
            // console.log(key);
            if(key == s){
                // console.log(str);
                return str;
                // break;
            }
        }
    }
</script>
<div class="wrapper" style="background-color: #2a2a2a;">
    <div style="margin: 0 auto;width: 1200px;">
        <section id="video_content" style="background: #fff;width:1200px;margin: 0 auto;padding: 10px 0;"> 
                <video id='my-video' class='video-js' controls preload='auto' height="630" width="1180" 
                poster='http://img.ddrk.me/cover.png' data-setup='{}' style="margin: 0 auto;">
                    <source class="src" src="my_video.mp4" type='video/mp4'>
                    <!-- <source src='MY_VIDEO.webm' type='video/webm'> -->
                </video>
                <script src='https://vjs.zencdn.net/7.6.5/video.js'></script>
                
                <ul id="episode_wapper" style="padding-top: 10px;" >
                    <!-- <li class="episode"><a href="javascript:void(0)"> 1.第一集01</a></li>
                    <li class="episode"><a href="javascript:void(0)"> 2.第二集02</a></li>
                    <li class="episode"><a href="javascript:void(0)"> 3.第三集03</a></li>
                    <li class="episode"><a href="javascript:void(0)"> 4.第四集04</a></li> -->
                </ul>
        </section>
        
        
        <div id="last_update_time" style="font-size:18px;padding: 30px 0;color: #fff;">
            <p style="">最后更新于<span></span></p>
        </div>


        <section class="detail" style="max-height: 465px; padding: 30px; border: 1px solid #999;margin: 0 auto;background: #fff;">
            <div style="height: 405px; width: 270px;background: #000;">
                <img id="cover" src="" 
                 class="cover" width="270" height="405"/>
            </div>
            <dl style="position: relative;top:-405px;left: 270px; margin-left: 30px; width: 800px;">
                <dt><a href="#" id="title" style="font-size: 20px;font-weight: bold;"></a></dt>
                <dd id="profile">简介: 最好的犯罪心理学家之一：马尔科姆·布莱特，利用他的天赋异禀来帮助纽约警局破案。</dd>
            </dl>
            
        </section>
    </div>
</div>
<script>

</script>
<center>本站仅作学习使用，如有侵权，请投邮箱 wldmchen@foxmail.com</center>
    <div class="cls"></div>
    <section class="footer">
            <a href="#"><img src="/bsys/Public/static/img/1571233493_867616.png" width="580" height="150" alt=""></a>
    </section>
</body>
    <style>
        .cls{
            clear:both;
            height: 1px;
            background: #2a2a2a;
        }
        .footer{
            
            padding-top: 20px;
            height: 180px;
            width: 100%;
            background: #2a2a2a;
        }
        .footer a img{
            display: block;
            margin: 0 auto;
        }
    </style>
</html>