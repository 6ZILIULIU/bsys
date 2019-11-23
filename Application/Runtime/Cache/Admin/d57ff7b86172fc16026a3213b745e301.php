<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <title>后台系统注册</title>
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/static/css/common.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>


        <script>
            //注册窗口
            $(document).ready(function () {
                var $LoginAndRegdialog = $('#LoginAndRegdialog').dialog({
                    height: '500px',
                    width: '600px',
                    closable: false,
                    title: '用户注册',
                    modal: 'true',
                    buttons:[{text:'已有帐号',
                                    handler:function(){
                                    //登录
                                        $(location).attr('href','login')
                                    }
                                },{ text:'确认注册' , 
                                handler:function(){
                                    //注册
                                    $.ajax({
                                        type :"post",
                                        // dataType:'text',
                                        url:"registerVerify",
                                        data: $('#loginInputForm').serialize(),
                                        success:function(r){
                                            // console.info(r);
                                            if(r.userName == '_repeated'){
                                                $('#userName').textbox({
                                                    prompt:"用户已存在",
                                                    // iconCls:'icon-no',
                                                }).textbox('clear')
                                            }else if(r.phone =='_repeated'){
                                                $('#phone').textbox({
                                                    prompt:"该号码已注册",
                                                    // iconCls:'icon-no'
                                                }).textbox('clear')
                                            }else if(r.email =='_repeated'){
                                                $('#email').textbox({
                                                    prompt:"邮箱输入错误或可能已注册",
                                                    // iconCls:'icon-no'
                                                }).textbox('clear')
                                            }else if(r===true){
                                                $.messager.alert("提示","注册成功</br>...请稍后");
                                                setTimeout(function(){$(location).attr('href','index');},2000);
                                            }else{
                                                $.messager.alert("提示",r);
                                            }
        
                                          
                                        },
                                        error:function(r){console.log('fail');}
                                    });
                                }}

                            ]
                });
            
            })

        </script>


        <style>
        input{
            height: 40px;
            width: 200px;
            border-radius: 5px;
        }
        </style>
</head>

<body class="easyui-layout c6">
    <div id="LoginAndRegdialog">
        <form id="loginInputForm" method="POST" style="padding: 10px 0 0 50px; font-size:16px;line-height: 70px;">
            <div style="margin-top:20px;"></div>
            <table>    
                <tr style="height: 70px;">
                    <th>用户名</th>
                    <td><input class="easyui-textbox" data-options=" width:'300px',height:'40px', required:true" name="userName" id="userName"></td>
                </tr>
                <tr style="height: 70px;">
                    <th>密码</th>
                    <td><input class="easyui-passwordbox" data-options=" width:'300px',height:'40px', required:true" name="password" id="password"></td>
                </tr>
                <tr style="height: 70px;">
                    <th>手机号</th>
                    <td><input class="easyui-textbox" data-options=" width:'300px',height:'40px', required:true" name="phone" id="phone"></td>
                </tr>
                <tr style="height: 70px;">
                    <th>电子邮箱</th>
                    <td><input class="easyui-textbox" data-options=" width:'300px',height:'40px', required:true,validType:'email'" name="email" id="email"></td>
                </tr>
            </table>
        </form>
    </div>
        
   
        
</body>

</html>