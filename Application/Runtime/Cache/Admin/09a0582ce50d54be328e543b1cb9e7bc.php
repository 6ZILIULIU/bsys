<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <!-- <title>blogBackstage</title>  site:ddrk.me 切尔诺贝利 -->
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>

    </head>

    <body>
      <section class="easyui-panel">
        dashboard
      </section>
            
    </body>
    <script>
        function getval(){
            console.log($("#partition").val());
            console.log($("#title").val());
            console.log($("#label").val());
            console.log($("#profile").val());
        }

        $("#partition").combobox({  
            onChange:function(val){
                // alert(1);
                if(val === 'series'){
                    $("#series").show();
                }else{
                    $("#series").hide();
                }
            }
        })
    </script>
    <style>
        .main{
            width: 1000px;
            padding: 24px;
            text-align: center;
            /* margin: 0 auto; */
        }
        form{
            margin: 0;
            float: left;
            /* width:800px; */
            padding: 20px;
            border-bottom:1px solid #ebeef5;
        }
        input{
            float: left;
        }
    </style>
</html>