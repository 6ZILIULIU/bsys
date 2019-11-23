<?php

namespace Admin\Model;

use Think\Model;

class VideosModel extends Model 
{
    //数据表
    protected $tablePrefix = 'ysq_';
    protected $tableName = 'videos';
    //主键
    protected $pk = 'video_id';

    //字段
    // protected $fields = [];

    //连接数据库的配置,这里采用配置文件中的db_blog,
    //也可以在模型中自定义一个配置数组和配置文件中一样
    protected $connection = 'db_blog1';

    // protected $_validate = [
    //     ['userName','/^[\d\w]{8,12}$/','请以8-12位数字大小写字母作为用户名'],
    //     ['article_title','/[\u4e00-\u9fa5\d\w]{1,255}/','标题太长'],
    //     ['article_content','//[\u4e00-\u9fa5\d\w]{1,}/','内容太大'],
    //     ['article_timestamp','',''],
    // ];
}