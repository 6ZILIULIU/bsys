<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <!-- <title>blogBackstage</title> -->
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>

        <script>

            

            //获取指定数据库的数据
            $(function(){
           
            })
        </script>
    </head>

    <body>
        <form enctype="multipart/form-data" action="/bsys/index.php/Admin/Manage" method="POST">
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <!-- Name of input element determines name in $_FILES array -->
            Send this file: <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </form>
    </body>
    <script>
   
    </script>

</html>