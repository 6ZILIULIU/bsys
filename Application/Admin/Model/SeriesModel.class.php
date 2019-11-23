<?php

namespace Admin\Model;

use Think\Model;

class SeriesModel extends Model 
{
    //数据表
    protected $tablePrefix = 'ysq_';
    protected $tableName = 'series';

    //主键
    protected $pk = 'series_id';

    //字段
    // protected $fields = [
    //     'userName',
    //     'password',
    //     'phone',
    //     'email',
    //     'status'  
    // ];

    //连接数据库的配置,这里采用配置文件中的db_blog,
    //也可以在模型中自定义一个配置数组和配置文件中一样
    protected $connection = 'db_blog1';

    // protected $_validate = [
    //     ['userName','/^[\d\w]{8,12}$/','请以8-12位数字大小写字母作为用户名'],
    //     ['password','/^[\d\w]{8,16}$/','密码以8-16位的数字大小写字母组成'],
    //     ['phone','/^1[3-9][0-9][\d]{8}$/','电话号码有误'],
    //     ['email','/^[a-zA-Z0-9]{8,12}@[\w\d]{2,7}.com$/','邮箱填写错误'],
    // ];
}