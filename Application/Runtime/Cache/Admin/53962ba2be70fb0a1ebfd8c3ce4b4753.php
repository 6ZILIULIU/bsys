<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>

    </head>
        <style>
        a{text-decoration: underline;color:rgb(189, 51, 51)}
        ul,li{ padding:0;margin:0;list-style:none}
        td,th{
            padding:5px;
        }
        .content li{
            /* background: yellow; */
            color:orangered;
            padding-bottom: 10px;
            
        }
        .cc{
            margin:20px 0 20px 20px;
        }
        </style>

    <body>
        <h2 class="cc" >欢迎使用___MyVideoDashboard____管理系统</h2>
        <div class="content" style="padding :10px 40px;">
            <h3 class="cc" style="text-decoration: underline">建设日志</h3>
                <table frame="box" rules="all" style="padding: 10px;box-shadow:0 8px 16px 0px rgba(10, 14, 29, 0.04), 0px 8px 64px 0px rgba(10, 14, 29, 0.08);">
                    <tr>
                        <td>20190625</td>
                        <td>登录注册用户新增与删除(包括过滤表单，保存用户状态，CURD操作)</td>
                    </tr>
                    <tr>
                        <td>20190711</td>
                        <td>上传文件</td>
                    </tr>
                    <tr>
                        <td>20190902</td>
                        <td><a href="https://6ziliuliu.github.io" target="_blank">博客迁移至github上</a></td>
                    </tr>
                    <tr>
                        <td>20191027</td>
                        <td>添加剧集、视频上传、管理（包括新增修改标题封面简介等各项信息，尚有未处理完的bug），因采用腾讯学生云服务器带宽太小最大下载速度只有200k而比较卡</br>
                            缺陷:文件最好不要超过1G否则上传时间太长后会失去响应。（具体原因暂时不清）</br>
                            解决问题：上传大小限制（包括nginx.conf、php.ini、html表单上的配置限制。） 
                        </td>
                    </tr>
                </table>
        </div>
        
    </body>

</html>