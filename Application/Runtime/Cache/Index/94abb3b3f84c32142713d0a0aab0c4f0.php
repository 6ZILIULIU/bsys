<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>后台管理系统</title>
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/static/css/common.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>


        <script>
            
            $(function(){
                var $LoginAndRegdialog = $('#LoginAndRegdialog').dialog({
                    closed: false,
                    draggable:false,
                    height: '400px',
                    width: '700px',
                    closable: false,
                    title: '用户登录',
                    modal: 'true',
                    buttons:[{ text:'我要注册' , handler:function()
                                    {
                                    //注册
                                    $(location).attr('href','register')
                                    }},
                            { text:'登录',handler:function(){
                                    //登录
                                    $.ajax({
                                        type :"post",
                                        dataType:'json',
                                        url:"loginVerify",
                                        data: $('#loginInputForm').serialize(),
                                        success:function(r){
                                            // r = $.parseJSON(r);
                                            console.info(r);
                                            if(r){
                                                // $LoginAndRegdialog.dialog('close');
                                                // $.messager.show({title:'提示',msg:'登陆成功'})
                                                $(location).attr('href',r)
                                            }else 
                                            {
                                                $.messager.alert('提示','用户名或密码错误');
                                            } 
                                        },
                                        error:function(r){console.log('fail');}
                                    });
                                        
                                    }
                                }

                            ]
                });
            }) 


               
        </script>
</head>

<!-- easyui-layout  -->   
<body class="easyui-layout c6">
    
    <!-- 登录窗口 -->
    <div id="LoginAndRegdialog" class="c4">
        <form id="loginInputForm" method="POST" style="padding: 30px 0 0 30px;">
            <div style="margin-top:20px;"></div>
            <table >    
                <tr style="height: 70px; font-size:20px;line-height: 70px;">
                    <th>用户名</th>
                    <td><input class="easyui-textbox" data-options=" width:'300px',height:'40px' " name="userName" id="userName" value=""></td>
                </tr>
                <tr style="height: 70px; font-size:20px;line-height: 70px;">
                    <th>密码</th>
                    <td><input class="easyui-passwordbox" data-options=" width:'300px',height:'40px'" name="password" id="password" value=""></td>
                </tr>
            </table>
        </form>
    </div>
    <!-- 登录窗口end -->

</body>

</html>