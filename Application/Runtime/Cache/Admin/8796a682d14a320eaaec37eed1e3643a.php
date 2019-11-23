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
                var $dg = $('.easyui-datagrid');
                var $dgPage = $dg.datagrid('getPager');
                $.ajax({
                    type:'post',
                    // data:{table:'users_easyui'},
                    url:"/bsys/index.php/Admin/Userportal/getTableData",
                    success:function(r){
                        console.info(r);
                        console.info($dgPage);
                        $dg.datagrid({data:r});
                        if($dgPage){
                            $dgPage.pagination({
                                total:2000,
                                pageSize:10
                            });
                        }else(
                            console.info('no pageobj')
                        )
                    },error:function(){
                        console.info('fail to get data');
                    }
                })
                
                
               
            })
        </script>
    </head>

    <body>
        <table class="easyui-datagrid" data-options="singleSelect:false,toolbar:'#tb',
                        fitColumns:true,pagination:true,fit:true,rownumbers:true,
                        checkOnSelect:true,selectOnCheck:true" >
            <thead>  
                <tr>  
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="id" width="100" align="left" sortable="true" >id</th>
                    <th field="userName" width="200" align="left" sortable="true">用户名</th>
                    <th field="phone" width="220" align="left" sortable="true">电话</th>
                    <th field="email" width="220" align="left" sortable="true">邮箱</th>
                    <!-- <th field="price" width="100" align="left" sortable="true">操作</th> -->
                </tr>  
            </thead>  
    
        </table>
        
        <div id="tb" style="line-height:30px;">
            <a id="addbtn" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newuser();">增加用户</a>
            <a id="delbtn" href="#" class="easyui-linkbutton" iconCls="icon-cut" plain="true" onclick="removeuser();">删除用户</a>
            <a id="editbtn" href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edituser();">修改用户</a> 
        </div>
        

        <div id="confirmRemove" style="padding: 20px;display:none;">此操作不可撤回，确认请点确认，返回点取消</div>
        
        <div id="addUser" style="display:none;">
            <form id="addUserForm" method="POST" style="padding: 30px 0 0 50px; font-size:16px;line-height: 50px;">
                <div style="margin-top:20px;"></div>
                <table>    
                    <tr>
                        <th>用户名</th>
                        <td><input type="text"  name="userName" id="userName"></td>
                    </tr>
                    <tr style="height: 50px;">
                        <th>密码</th>
                        <td><input type="password" autocomplete="new-password" name="password" id="password"></td>
                    </tr>
                    <tr style="height: 50px;">
                        <th>手机号</th>
                        <td><input type="text" autocomplete="tel"  name="phone" id="cellphone"></td>
                    </tr>
                    <tr style="height: 50px;">
                        <th>电子邮箱</th>
                        <td><input type="text" autocomplete="email"  name="email" id="email"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
    <script>
    // 删除用户
    function removeuser(){
                var $confirmRemove = $("#confirmRemove").dialog({
                    title:'提示',
                    width:300,
                    height:170,
                    modal:true,
                    buttons: [{text:'删除',handler:function(){
                                //选中的删除
                                var $datagrid_s = $(".easyui-datagrid").datagrid('getSelections');
                                
                                for(var i = 0;i<$datagrid_s.length;i++){
                                    console.info($datagrid_s[i]);
                                    $.ajax({
                                        type:'post',
                                        datatype:'json',
                                        url:'/bsys/index.php/Admin/Userportal/removeUserById',
                                        data:$datagrid_s[i],
                                        success:function(r){
                                            if(r==true){
                                                console.info(r);
                                                $confirmRemove.dialog('close');
                                                location.reload();
                                            }else{console.info(r+'删除失败');}
                                        },
                                        error:function(r){console.info('未成功接收后台数据');}
                                    })
                                }
                                    


                            }},{text:'取消',handler:function(){
                                //关闭窗口
                                $confirmRemove.dialog('close')
                            }}

                            
                    ]   
                })
            }

            // 新增用户
            function newuser(){
                var $dialog_new = $('#addUser').dialog({
                    height: '400px',
                    width: '600px',
                    closable: false,
                    title: '新增用户',
                    modal: 'true',
                    buttons:[{ text:'确认' , 
                                handler:function(){
                                    //注册
                                    $.ajax({
                                        type :"post",
                                        // dataType:'text',
                                        url:"registerVerify",
                                        data: $('#addUserForm').serialize(),
                                        success:function(r){
                                            console.info(r);
                                            location.reload();
                                        },
                                        error:function(r){console.log('fail');}
                                    });
                                }},{text:'取消',
                                    handler:function(){
                                    //登录
                                        $dialog_new.dialog('close');
                                    }
                                }

                            ]
                })
            }
    </script>

</html>