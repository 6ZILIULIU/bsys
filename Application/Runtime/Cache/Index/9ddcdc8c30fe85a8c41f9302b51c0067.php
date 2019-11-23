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
    a{
        text-decoration: none;
    }
    .video{
        position: relative;
        float: left;
        margin: 0px 30px 100px;
        /* padding: 5px; */
        display: block;
        /* background: url('/bsys/upload/covers/pic15719230361544739467.jpg') no-repeat;  */
        background-size: 300px 400px;
        overflow: hidden;
    }
    .cover{
        height: 400px;
        width: 300px;
        background: linear-gradient(rgba(0,0,0,0) 50%,rgba(0,0,0,0.8)) no-repeat;
        background-size: 300px 400px;
        transition:  all  2s;
    }
    .cover:hover{
        background: linear-gradient(rgba(211, 162, 162, 0) 30%,rgba(0,0,0,0.8)) no-repeat;
    }
    .detail{
        position: absolute;
        bottom: 20px;
        /* left:  5px; */
        padding: 0 25px;
        color: white;
        font-size: 26px;
        background-color: rgba(0,0,0,0);
        font-weight: bold;
    }


</style>
<script>
    console.log("/bsys/upload");
    // var series_frame = "<dt class='video' style='width: 300px; height: 400px;'></dt>";
    var series_frame = "<dt class='video' style='width: 300px; height: 400px;'> \
                            <a class='cover' href='/bsys/index.php/Index/hotspot/play' style='display: block;background-size: 300px 400px;''></a> \
                            <span class='detail' href='/bsys/index.php/Index/Index/hotspot/play'></span> \
                        </dt>";

    getHotspotList();
    function getHotspotList(){
        // alert(1);
        $.ajax({
            url:"/bsys/index.php/Index/Hotspot/getHotspotList",
            dataType:'json',
            type:'post',
            success:function(r){
                // console.log(r);
                for(var obj in r){
                    console.log(r[obj].cover);
                    console.log(r[obj].title);
                    $("#seriesListWapper").append(series_frame);
                    console.log($("#seriesListWapper").children().eq(obj));
                    var bg = 'url('+"/bsys/upload/"+r[obj].series_coverpath+')'+" no-repeat";
                    console.log(bg);
                    $("#seriesListWapper").children().eq(obj).css('background',bg);
                    $("#seriesListWapper").children().eq(obj).css('background-size','300px 400px');
                    $("#seriesListWapper").children().eq(obj).children().eq(0).attr('href',"/bsys/index.php/Index/hotspot/play?series_id="+r[obj].series_id);
                    $("#seriesListWapper").children().eq(obj).children().eq(1).text(r[obj].series_title);
                }
            }
        })
    }
    // function get

    // function createListView(){

    // }

    
</script>
<section style="background: #2a2a2a; width:100%; height: auto; min-height: 800px; float: left;">
    <div style="height:100%; width: 1450px;margin: 0 auto; padding: 0 20px;">
       <div id="seriesListWapper" style="height:100%; width: 1450px;margin: 0 auto; padding: 0 20px;">
            <!-- <dt class="video" style="width: 300px; height: 400px;">
                <a class="cover" href="/bsys/index.php/Index/hotspot/play" style="display: block;background-size: 300px 400px;"></a>
                <span class="detail" href="/bsys/index.php/Index/hotspot/play">闪电侠第六季</span>
            </dt> -->
           
        </div>
    </div>
</section>



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