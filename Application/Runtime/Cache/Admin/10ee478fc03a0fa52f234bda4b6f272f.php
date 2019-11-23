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
        <section class="easyui-panel" style="width:100%;max-width:600px;padding:30px 60px;">
            <form class="fileUpLoad" enctype="multipart/form-data" action="/bsys/index.php/Admin/Manage/uploadVideo" method="POST">
                
                <div style="margin-bottom: 60px;">
                    <h1><span style="color: red;">*</span>视频上传</h1>
                    <input name="userName" type="text" value="<?php echo ($userName); ?>" style="display:none;">
                    选择视频: </br>
                    <input name="video" type="file" accept="video/*"/>
                </div>
                
                <div style="margin-bottom: 60px;">
                    <h1><span style="color: red;">*</span>基本信息</h1>
                    选择封面: </br>
                    <input name="cover" type="file" accept="image/*"/>
                </div>
                
                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>分区</h1>
                    <input id="partition"  
                        name="partition"  
                        class="easyui-combobox"
                        data-options="
                        valueField: 'label',
                        textField: 'value',
                        editable: false,
                        data: [{
                            label: 'hotspot',
                            value: '热映中'
                        },{
                            label: 'recommend',
                            value: '站长推荐'
                        },{
                            label: 'series',
                            value: '剧集'
                        },{
                            label: 'movie',
                            value: '电影'
                        },{
                            label: 'animation',
                            value: '动漫'
                        }]" />
                </div>
                
                <div id="series" style="margin-bottom: 30px;display: none;" >
                    <h1><span style="color: red;">*</span>季数</h1>
                    <input id="season" name="season" class="easyui-numberbox" type="text"   style="width:100%"/>
                    <h1><span style="color: red;">*</span>集数</h1>
                    <input id="episode" name="episode" class="easyui-numberbox" type="text"   style="width:100%"/>
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>标题</h1>
                    <input id="title" name="title" onchange="isSeries" type="text" class="easyui-tagbox"   style="width:100%"/>
                    <p>ps: 按回车ENTER创建标题</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>标签</h1>
                    <input id="label" name="label" class="easyui-tagbox" type="text"   style="width:100%"/>
                    <p>ps: 按回车ENTER创建标签</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>简介</h1>
                    <input id="profile" name="profile" type="text" class="easyui-textbox" labelPosition="top" style="width:100%;height:120px;font-size: 12px;" multiline="true">
                </div>

                
                
                <input class="easyui-linkbutton c6" style="padding: 10px 25px;margin: 30px 0;"  type="submit"  value="确认提交"  />
            </form>
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