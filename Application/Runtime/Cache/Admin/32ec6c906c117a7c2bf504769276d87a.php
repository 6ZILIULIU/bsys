<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <title>MyDashboard</title>
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/static/css/common.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>


        <script>

            //点击侧边栏显示对应的tab栏
            $(function(){
                $('#sideBar').tree({
                    onClick: function(node){
                    if(node.attributes.url){
                        // console.info(node.attributes.text,node.attributes.url);
                        addTab(node.attributes.text,node.attributes.url);
                        // console.info(getiframe());
                    }else
                        $('.easyui-tree').tree('expand',node.target);
                        }
                    });


                    // var iID=setInterval(setref, 180000); //三分钟

            });


            //改密码 

            function changePassword(){
                // var userName = '<?php echo ($userName); ?>';
                // var oldPassword = $('#oldPassword').val();
                var newPassword = $('#newPassword').val();
                var reNewPassword = $('#reNewPassword').val();
                // console.info(newPassword,reNewPassword);
                if(newPassword === reNewPassword){
                    $.ajax({
                        type:'post',
                        url:'/bsys/index.php/Admin/Login/changePassword',
                        data:$("#fm").serialize(),
                        // data:{userName:userName,oldPassword:oldPassword},
                        // dataType:'json',
                        success:function(r){
                            // console.info(r);
                            if(r){
                                $.messager.show({title:"提示", msg:"修改成功"});
                                $('#win').window('close');  
                                $('#fm input').val("");
                            }else{
                                $.messager.alert('提示','密码错误','warning')
                            }
                        },
                        error:function(r){
                            console.info('error');
                        }
                    })
                }else{$.messager.alert('warning',"两次密码不一致！请重新输入","warning");}
            }   
               
        </script>

        <style>
        .logo{
            float: left;
            margin-left: 200px;
            width: 350px;
            height: 44px;
        }
        .logo a{
            font-size: 35px;
            font-style: italic;
            line-height: 44px;
            color: blue;
            font-weight: bold;
        }
        .logo span{
            color:red;
            font-weight:bold;
            font-style: italic;
        }
        </style>
</head>

<!-- easyui-layout  -->   
<body class="easyui-layout">

    <!-- 北栏 -->
    <div data-options="region:'north'" style="height: 100px;background: rgb(34, 24, 77);padding: 20px 0">
        <div class="logo" >
              <a href="/bsys/index.php/Index/Hotspot/list" >
                ___MyVideo<span>Dashboard____</span>
            </a>  
        </div>
        <div class="topmenu" style="float:right;line-height: 44px;margin-right: 100px;">
            &nbsp;欢迎
            &nbsp;<span id="userName"><a href="http://www.baidu.com"><?php echo ($userName); ?></a></span>
            &nbsp;<a href="javascript:void(0)" onclick="JavaScript:$('#win').window('open')">修改密码</a>
            &nbsp;<a href="login">安全退出</a>
        </div>
    </div>
    
    <!-- 北栏end -->

    <!-- 西栏     -->
    <div data-options="region:'west',title:'导航菜单'" style="width: 200px;">
            <ul id="sideBar" class="easyui-tree">
                <li>    
                    <span id="sideBar_mysite">MyAdmin</span>
                    <ul>
                        <li ><a href="/bsys/index.php/Index/Hotspot/list" style="color: purple;">返回首页</a></li>
                        <li data-options='attributes:{"text":"上传视频","url":"/bsys/index.php/Admin/Manage/dashboardManage"}'>仪表盘</li>
                        <li data-options='attributes:{"text":"用户管理","url":"/bsys/index.php/Admin/Manage/userManage"}'>用户管理</li>
                        <li data-options='attributes:{"text":"视频管理","url":"/bsys/index.php/Admin/Manage/seriesManage"}'>剧集管理</li>
                    </ul>
                </li>
            </ul>
    </div>
    <!-- 西栏 end   -->
        
    <!-- 中心栏 -->
    <div data-options="region:'center'" style="padding:5px;background:#eee;margin-right: 64px;">
        <div id="tt" class="easyui-tabs" data-options="tools:'#tab-tools'" style="width:100%;height:100%;">
            <div title="欢迎使用" data-options="closable:false, content:'<iframe scrolling=auto frameborder=0 name=/bsys/index.php/Admin/Manage/main src=/bsys/index.php/Admin/Manage/main style=width:100%;height:100%;></iframe>'">
            </div>
        </div>
        <div id="tab-tools">  
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-reload'" onclick="reload()" title="刷新"></a>  
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-cancel'" onclick="remove()" title="关闭"></a>
        </div>
        
    </div>
    <!-- 中心栏end     -->
    <!-- 修改密码框 -->
    <!-- <div id="changepw" class="easyui-panel" title="Basic Dialog" data-options="iconCls:'icon-save'" style="width:400px;height:200px;padding:10px">
            The dialog content.
        </div> -->
        <div id="win" class="easyui-window" title="修改密码" style="padding:20px;width:600px;height:400px;font-size: 20px;"
            data-options="iconCls:'icon-save',modal:true,closed:'false',maximizable:'false',minimizable:'false',collapsible:'false',shadow:'true'">
            <div class="formTitle" style="padding:5px;margin-bottom:10px;border-bottom: 1px solid #666;color: #666">用户修改密码</div>
            <form id="fm" style="line-height: 60px;">
                <table>
                    <tr style="display: none">
                        <td>账号</td>
                        <th><input class="easyui-validatebox" name="userName" id="userName" style="width:390px;height: 40px;" value="<?php echo ($userName); ?>"></th>
                    </tr>
                    <tr>
                        <td>原密码</td>
                        <th><input class="easyui-validatebox" data-options="required:'true'" name="oldPassword" id="oldPassword" style="width:390px;height: 40px;"></th>
                    </tr>
                    <tr>
                        <td>新密码</td>
                        <th><input class="easyui-validatebox" data-options="required:'true'" name="newPassword" id="newPassword" style="width:390px;height: 40px;"></th>
                    </tr>
                    <tr>
                        <td>确认密码</td>
                        <th><input class="easyui-validatebox" data-options="required:'true'" name="reNewPassword" id="reNewPassword" style="width:390px;height: 40px;"></th>
                    </tr>
                </table>
            </form>
            <div id="tab-tools" style="float:right;margin:20px 120px 0 0">  
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" style="width: 140px;height:40px;border-radius: 40px;" onclick="changePassword()" title="确定">确定</a>  
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-no'" style="width: 140px;height:40px;border-radius: 40px;" onclick="javascript:$('#win').window('close')" title="取消">取消</a>
                </div>
        </div>
    <!-- 修改密码框end -->
<!-- easyui-layout end -->        
    
    
        <!-- body下的js脚本 -->
        <script>
            function reload(){  
                var currentTab =$('#tt').tabs('getSelected');
                var iframe = $(currentTab.panel('options').content);
                var src = iframe.attr('src');
                $('#tt').tabs('update', {
                    tab: currentTab,
                    options: {
                        content: createFrame(src)
                    }
                })
            }  
            function remove(){  
                var tab = $('#tt').tabs('getSelected');  
                // console.info(tab);
                if (tab){  
                    var index = $('#tt').tabs('getTabIndex', tab);  
                    // console.info(index);
                    $('#tt').tabs('close', index);  
                }  
            }  

            // function getiframe(){
            //     var currentTab =$('#tt').tabs('getSelected');
            //     var iframe = $(currentTab.panel('options').content);

            //     var ifrname = iframe.attr('name');
            //     var ifr_window = window.frames[ifrname];
            //     // return ifr_window;
            //     console.info(ifrname);
            // }

            function addTab(subtitle,url,icon){
                if(!$('#tt').tabs('exists',subtitle)){
                    $('#tt').tabs('add',{
                        title:subtitle,
                        content:createFrame(url),
                        // content:"123",
                        closable:true,
                        icon:icon
                    });
                }else{
                    var t = $('#tt').tabs('select',subtitle);
                    console.info(t);
                }
            }

            function createFrame(url)
            {
                var s = '<iframe scrolling="auto" frameborder="0" name="'+url+'" src="'+url+'" style="width:100%;height:100%;"></iframe>';
                return s;
            }
        </script>
        <!-- body下的js脚本end -->
</body>

</html>