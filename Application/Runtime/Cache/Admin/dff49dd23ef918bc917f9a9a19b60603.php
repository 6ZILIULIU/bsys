<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>
        <!-- <title>blogBackstage</title> -->
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="/bsys/Public/jquery-easyui-1.7.0/themes/color.css">

        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.min.js"></script>
        <script type="text/javascript" src="/bsys/Public/jquery-easyui-1.7.0/jquery.easyui.min.js"></script>
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
        <script>
        var series_id = 0;
        var userName = <?php echo ($userName); ?>;
        // console.log(<?php echo ($userName); ?>);
        
        function transTime(time){
            // console.log(time);
            // var t = time;
            if(time == undefined){
                //
            }else{
                var year    = time.substring(6,10);
                var month   = time.substring(0,2);
                var day     = time.substring(3,5);
                var hour    = time.substring(11,13);
                var min     = time.substring(14,16);
                // var d = new Date();
                var d = (year+month+day+hour+min)*100;
                // console.info(year);
                // console.info(monthAndDay);
                // console.info(hms);
                console.info(d);
                // var timestamp = new Date(d).getTime()/1000;
                // console.info(timestamp);
                return d;
            }
            
        }

        getSeriesData();
        function getSeriesData(){
            var startTime       = transTime($("#startTime").val());
            var endTime         = transTime($("#endTime").val());
            var search_title    = $("#search_title").val();

            console.log(startTime);
            console.log(endTime);
            console.log(search_title);
            $.ajax({
                type:'post',
                url:"/bsys/index.php/Admin/Manage/getSeriesData",
                data:{startTime:startTime,endTime:endTime,search_title:search_title},
                success:function(r){
                    console.log(r);
                    $('#dg').datagrid({loadFilter:getfilter}).datagrid({
                    singleSelect:true,
                    toolbar:'#tb',
                    fitColumns:true,
                    pagination:true,
                    fit:true,
                    rownumbers:true,
                    checkOnSelect:false,
                    selectOnCheck:false,
                    striped : true,
                    pageNumber:1, 
                    pageSize:20,       //初始页
                    showFooter: true,
                    nowrap: false,
                    data:r,
                    onRowContextMenu:function(e,index,row){
                        series_id = row.series_id;
                        e.preventDefault();
                        $('#columnMenu').menu('show', {
                            left:e.pageX,
                            top:e.pageY,
                        });
                    }
                });     
                },error:function(){
                    console.info('fail to get data');
                }
            })
        }
        

            
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
        //添加剧集
        function addDramaSeries(){
            $("#addDramaSeries").dialog({
                title: '新增剧集',
                width: 550,
                height: 600,
            })
        }
        //删除剧集
        function rmSeries(){
            var userName = <?php echo ($userName); ?>;
            console.log(userName);
            $.ajax({
                url:"/bsys/index.php/Admin/Manage/remove_series",
                data:[{series_id:series_id,userName:userName}],
                dataType:JSON,
                success:function(){
                    console.log('good');
                },
                error:function(){
                    console.log('bad');
                }

            })
        }
        //添加视频
        function addVideo(){
            $("#add_video").dialog({
                title: '添加视频',
                width: 550,
                height: 600,
            })
            $('#series_id').val(series_id);
            console.log(series_id);
        }
        //查看详情
        function showDetail(){
            $("#videoDetail").dialog({
                title: '剧集详情',
                width: 550,
                height: 600,
            })
        }
        //更新信息
        function updateInfo(){
            console.info(userName+" and "+series_id);
            $.ajax({
                type:"POST",
                url:"/bsys/index.php/Admin/Manage/updateInfo",
                data:{userName:userName,series_id:series_id},
                dataType:'json',
                success:function(r){
                    // console.log(r);
                    if(r){
                        $(location).attr('href','/bsys/index.php/Admin/Manage/videoManage');
                    }else{
                        $.messager.alert('提示','更新失败');
                    }
                },
                error:function(r){
                    console.log('fail');
                }
            })
        }

        //格式显示是否上架
        function is_on_shelves(value,row,index){
            if(value == 1){
                return '是';
            }else{
                return '否';
            }
        }
        //格式显示封面
        function showCover(value,row,index){
            if(value){
                return "<img src='"+"/bsys/upload/"+value+"'style='height:100px;width:80px;'";
            }else{
                return null;
            }
        }
        </script>
    </head>
    <body>
        <div id="tb" >
            <div style="float: left; margin-right: 50px;">
                <a id="addbtn" href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addDramaSeries()" style="float:left;">新增剧集</a>
            </div>
            <div style="float: left; margin-right: 50px;">
                <input id="startTime" class="easyui-datetimespinner" label="Start Time:" labelPosition="left" style="width:230px;">
                <input id="endTime" class="easyui-datetimespinner" label="End Time:" labelPosition="left" style="width:230px;">
            </div>
            <div style="float: left; margin-right: 50px;">
                <input id="search_title" href="#" class="easyui-textbox" iconCls="icon-search" >
                <a href="#" class="easyui-linkbutton" onclick="getSeriesData()">搜索</a>
            </div>
        </div>
        <table id="dg" class="easyui-datagrid" data-options="singleSelect:false,toolbar:'#tb',
                        fitColumns:true,pagination:true,fit:true,rownumbers:true,
                        checkOnSelect:false,selectOnCheck:false">
            <thead>  
                <tr>  
                    <!-- <th data-options="field:'ck',checkbox:true"></th> -->
                    <th field="series_id" width="50" align="center" sortable="false">剧集ID</th>
                    <th field="is_on_shelves" width="80" align="center" sortable="false" data-options="formatter:is_on_shelves">是否上架</th>
                    <th field="series_title" width="220" align="center" sortable="true">标题</th>
                    <th field="series_coverpath" width="100" align="center" sortable="false" data-options="formatter:showCover">剧集封面</th>
                    <th field="series_partition" width="100" align="center" sortable="false">分区</th>
                    <th field="series_tag" width="220" align="center" sortable="true">标签</th>
                    <th field="series_profile" width="220" align="center" sortable="true">剧集简介</th>
                    <th field="series_created_timestamp" width="220" align="center" sortable="false">上传时间</th>
                    <th field="series_total_episode" width="220" align="center" sortable="false">总集数</th>
                </tr>  
            </thead>  
        </table>

        <!-- 上传窗口 -->
        <section id="addDramaSeries"  style="width:100%;max-width:600px;padding:30px 60px;">
            <form class="fileUpLoad" enctype="multipart/form-data" action="/bsys/index.php/Admin/Manage/create_series" method="POST">
                
                <div style="margin-bottom: 60px;">
                    <input name="userName" type="text" value="<?php echo ($userName); ?>" style="display:none;">
                    <h1><span style="color: red;">*</span>基本信息</h1>
                    选择封面: </br>
                    <input name="cover" class="easyui-filebox"  accept="image/*"/>
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
                            label: 'series',
                            value: '剧集'
                        },{
                            label: 'movie',
                            value: '电影'
                        },{
                            label: 'animation',
                            value: '动漫'
                        },{
                            label: 'newsreel',
                            value: '纪录片'
                        }]" />
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>标题</h1>
                    <input id="title" name="title" onchange="isSeries" type="text" class="easyui-textbox"   style="width:100%"/>
                    <p>ps: 按回车ENTER创建标题</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>标签</h1>
                    <input id="tag" name="tag" class="easyui-tagbox" type="text"   style="width:100%"/>
                    <p>ps: 按回车ENTER创建标签</p>
                </div>

                <div style="margin-bottom: 30px;">
                    <h1><span style="color: red;">*</span>简介</h1>
                    <input id="profile" name="profile" type="text" class="easyui-textbox" labelPosition="top" style="width:100%;height:120px;font-size: 12px;" multiline="true">
                </div>

                
                
                <input class="easyui-linkbutton c6" style="padding: 10px 25px;margin: 30px 0;"  type="submit"  value="确认提交"  />
            </form>
        </section>

        <section id="add_video" style="width:100%;max-width:600px;padding:30px 60px;">
            <form class="fileUpLoad" enctype="multipart/form-data" action="/bsys/index.php/Admin/Manage/add_video" method="POST">
                
                <div style="margin-bottom: 60px;">
                    <h1><span style="color: red;">*</span>视频上传</h1>
                    <input id="userName" name="userName" type="text" value="<?php echo ($userName); ?>" style="display:none;">
                    <input id="series_id" name="series_id" type="text" style="display:none;">
                    选择视频: </br>
                    <input name="video" class="easyui-filebox"  accept="video/*"/>
                </div>
                
                <div id="series" style="margin-bottom: 30px;" >
                    <h1><span style="color: red;">*</span>集数</h1>
                    <input id="episode" name="episode" class="easyui-numberbox" type="text"   style="width:100%"/>
                </div>

                <input class="easyui-linkbutton c6" style="padding: 10px 25px;margin: 30px 0;"  type="submit"  value="确认提交"  />
            </form>
        </section>

        <section id="add_video" style="width:100%;max-width:600px;padding:30px 60px;">
                <form class="fileUpLoad" enctype="multipart/form-data" action="/bsys/index.php/Admin/Manage/add_video" method="POST">
                    
                    <div style="margin-bottom: 60px;">
                        <h1><span style="color: red;">*</span>视频上传</h1>
                        <input id="userName" name="userName" type="text" value="<?php echo ($userName); ?>" style="display:none;">
                        <input id="series_id" name="series_id" type="text" style="display:none;">
                        选择视频: </br>
                        <input name="video" class="easyui-filebox"  accept="video/*"/>
                    </div>
                    
                    <div id="series" style="margin-bottom: 30px;" >
                        <h1><span style="color: red;">*</span>集数</h1>
                        <input id="episode" name="episode" class="easyui-numberbox" type="text"   style="width:100%"/>
                    </div>
    
                    <input class="easyui-linkbutton c6" style="padding: 10px 25px;margin: 30px 0;"  type="submit"  value="确认提交"  />
                </form>
            </section>
            
            <section id="videoDetail" style="width:100%;max-width:600px;padding:30px 60px;">
                <div style="margin-bottom: 60px;">
                    <h1><span style="color: red;">*</span>视频上传</h1>
                    <input id="userName" name="userName" type="text" value="<?php echo ($userName); ?>" style="display:none;">
                    <input id="series_id" name="series_id" type="text" style="display:none;">
                    选择视频: </br>
                    <input name="video" class="easyui-filebox"  accept="video/*"/>
                </div>
                
                <div id="series" style="margin-bottom: 30px;" >
                    <h1><span style="color: red;">*</span>集数</h1>
                    <input id="episode" name="episode" class="easyui-numberbox" type="text"   style="width:100%"/>
                </div>

                <input class="easyui-linkbutton c6" style="padding: 10px 25px;margin: 30px 0;"  type="submit"  value="确认提交"  />
            </form>
        </section>
        <div id="columnMenu" class="easyui-menu" style="width:120px;">
            <div onclick="showDetail()">查看详情</div>
            <div onclick="addVideo()">添加视频</div>
            <div onclick="rmSeries()">删除剧集</div>
            <div onclick="updateInfo()">更新信息</div>
            <!-- <div onclick="javascript:alert('new')"></div> -->
        </div>

    </body>

</html>