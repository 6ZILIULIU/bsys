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
                $.ajax({
                    type:'post',
                    url:"/bsys/index.php/admin/Manage/getUsersData",
                    success:function(r){
                        $('#dg').datagrid({loadFilter:getfilter}).datagrid({
                        singleSelect:false,
                        toolbar:'#tb',
                        fitColumns:true,
                        pagination:true,
                        fit:true,
                        rownumbers:true,
                        checkOnSelect:true,
                        selectOnCheck:true,
                        striped : true,
                        pageNumber:1, 
                        pageSize:20,       //初始页
                        showFooter: true,
                        nowrap: false,
                        data:r
                    });     
                    },error:function(){
                        console.info('fail to get data');
                    }
                })

            
            function getfilter(data){
                if (typeof data.length == 'number' && typeof data.splice == 'function') {   // is array  
                    data = {  
                        total: data.length,  
                        rows: data  
                    }  
                }
                var dg = $(this);  
                var page = $('#dg').datagrid('getPager');
                var opts = $('#dg').datagrid('options');
                    //设置分页组件参数
                page.pagination({
                    onSelectPage: function (pageNum, pageSize) {
                        opts.pageNumber = pageNum;
                        opts.pageSize = pageSize;
                        page.pagination('refresh', {  
                            pageNumber: pageNum,  
                            pageSize: pageSize  
                        });  
                        dg.datagrid('loadData', data);  
                    }  
                });  
             
                if (!data.originalRows) {  
                    data.originalRows = (data.rows);  
                }  
                var start = (opts.pageNumber - 1) * parseInt(opts.pageSize);  
                var end = start + parseInt(opts.pageSize);  
                data.rows = (data.originalRows.slice(start, end));  
                return data;  
            }

//                 $.ajax({
//                     type:'post',
//                     url:"/bsys/index.php/admin/Manage/getTableData",
//                     success:function(r){
//                         $('#dg').datagrid({ loadFilter: pagerFilter }).datagrid({ 
//                             singleSelect:false,
//                             toolbar:'#tb',
//                             fitColumns:true,
//                             pagination:true,
//                             fit:true,
//                             rownumbers:true,
//                             checkOnSelect:true,
//                             selectOnCheck:true,
//                             striped : true,
//                             pageNumber:1,        //初始页
//                             showFooter: true,
//                             nowrap: false, 
//                             data: r,     //加载数据 
                        
//                         });  
//                     },error:function(){
//                         console.info('fail to get data');
//                     }
//                 })
            
  
// // 分页数据的操作  
//     function pagerFilter(data) {  
//         if (typeof data.length == 'number' && typeof data.splice == 'function') {   // is array  
//             data = {  
//                 total: data.length,  
//                 rows: data  
//             }  
//         }
//         var dg = $(this);  
//         var opts = dg.datagrid('options');  
//         var pager = dg.datagrid('getPager');  
//         pager.pagination({  
//             onSelectPage: function (pageNum, pageSize) {  
//                 opts.pageNumber = pageNum;  
//                 opts.pageSize = pageSize;  
//                 pager.pagination('refresh', {  
//                     pageNumber: pageNum,  
//                     pageSize: pageSize  
//                 });  
//                 dg.datagrid('loadData', data);  
//             }  
//         });  
//         if (!data.originalRows) {  
//             data.originalRows = (data.rows);  
//         }  
//         var start = (opts.pageNumber - 1) * parseInt(opts.pageSize);  
//         var end = start + parseInt(opts.pageSize);  
//         data.rows = (data.originalRows.slice(start, end));  
//         return data;  
//     }  
            

        </script>
    </head>

    <body>
        <table id="dg">
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
    <script>
    // 删除用户
    function removeuser(){
                console.info('removeuser()');
                var $confirmRemove = $("#confirmRemove").dialog({
                    title:'提示',
                    width:300,
                    height:170,
                    modal:true,
                    scrollable:false,
                    buttons: [{text:'删除',handler:function(){
                                //选中的删除
                                var $datagrid_s = $("#dg").datagrid('getSelections');
                                
                                for(var i = 0;i<$datagrid_s.length;i++){
                                    console.info($datagrid_s[i]);
                                    $.ajax({
                                        type:'post',
                                        datatype:'json',
                                        url:'/bsys/index.php/admin/Manage/removeUserById',
                                        data:$datagrid_s[i],
                                        success:function(r){
                                            if(r==true){
                                                console.info(r);
                                                console.info('yes');
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
                    closable: true,
                    title: '新增用户',
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
                                        url:"/bsys/index.php/admin/Login/registerVerify",
                                        data: $('#addUserForm').serialize(),
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
                                                // location.reload();
                                                $.messager.show({title:"提示", msg:"修改</br>成功"});   
                                                setTimeout(function(){window.location.reload();}, 2000);
                                            }else{
                                                $.messager.alert("提示",r);
                                            }
        
                                          
                                        },
                                        error:function(r){console.log('fail');}
                                    });
                                }}

                           ]
                })
            }
    </script>

</html>