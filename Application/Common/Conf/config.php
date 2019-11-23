<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置1
	'db_blog1' => array(
		'db_type'   => 'mysql',
		'db_user'   => 'root',
		'db_pwd'    => '',
		'db_host'   => 'localhost',
		'db_port'   => '3306',
		'db_name'   => 'ysq',
		'db_charset'=> 'utf8',
		//查询的字段不修改成小写
		'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
	),

	'db_blog2' => array(
		'db_type'   => 'mysql',
		'db_user'   => 'root',
		'db_pwd'    => '654soga+sql',
		'db_host'   => 'localhost',
		'db_port'   => '3306',
		'db_name'   => 'ysq',
		'db_charset'=> 'utf8',
		//查询的字段不修改成小写
		'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
	),
	//数据库配置2
	// 'DB_CONFIG2' => 'mysql://root:1234@localhost:3306/thinkphp#utf8'
	
	//扩展配置
	'LOAD_EXT_CONFIG' => ['mailer'], 
	
);