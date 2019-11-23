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
                    data:{table:'article_easyui'},
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
    <!-- ,url:'/tp5_Blog/public/admin/Userportal/userData' -->
    <body>
        <table class="easyui-datagrid" data-options="singleSelect:false,toolbar:'#tb',
                        fitColumns:true,pagination:true,fit:true,rownumbers:true,
                        checkOnSelect:true,selectOnCheck:true">
            <thead>  
                <tr>  
                    <th data-options="field:'ck',checkbox:true"></th>
                    <th field="article_id" width="100" align="left" sortable="true" >id</th>
                    <th field="userName" width="200" align="left" sortable="true">上传用户</th>
                    <th field="title" width="220" align="left" sortable="true">文章标题</th>
                    <th field="content" width="220" align="left" sortable="true">内容</th>
                    <th field="timestamp" width="220" align="left" sortable="true">上传时间</th>
                </tr>  
            </thead>  
        </table>
        <div id="tb" style="line-height:30px;">
            <a id="addbtn" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newuser();">增加用户</a>
            <a id="delbtn" href="#" class="easyui-linkbutton" iconCls="icon-cut" plain="true" onclick="removeuser();">删除用户</a>
            <a id="editbtn" href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="edituser();">修改用户</a> 
        </div>
    </body>

</html>