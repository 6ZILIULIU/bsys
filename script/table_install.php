<?php


$dbname = "bsys";
$host = "localhost";
$username = "liuzi";
$password = "123456";



try{
    $db = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    echo '连接成功'."\n\n";
    
    if($db->query('show tables like "ysq_video"')){
        $sql = "CREATE TABLE ysq_series (
            `series_id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
            `id` INT(11) UNSIGNED NOT NULL,
            `series_created_timestamp` TIMESTAMP NOT NULL,
            `video_coverpath` VARCHAR(1000) NOT NULL,
            `video_title` VARCHAR(100) NOT NULL,
            `video_partition` VARCHAR(10) NOT NULL,
            `video_label` VARCHAR(20) NOT NULL,
            `video_profile` VARCHAR(300) DEFAULT '...' NOT NULL,
            CONSTRAINT pk_series_id PRIMARY KEY (series_id)
        );";
    }

    if($db->query($sql)){
        echo "创建成功"."\n";
    }else{
        echo "表已存在"."\n";
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}

CREATE DATABASE IF NOT EXISTS ysq;

CREATE TABLE IF NOT EXISTS ysq_series  (
    `series_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
     `id` INT(11) UNSIGNED NOT NULL,
    `series_created_timestamp` TIMESTAMP NOT NULL,
    `series_coverpath` VARCHAR(200) NOT NULL,
    `series_partition` VARCHAR(16) NOT NULL,
    `series_title` VARCHAR(30) NOT NULL,
    `series_tag` VARCHAR(50) NOT NULL,
    `series_profile` VARCHAR(500) NOT NULL,
    `series_status`  BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT pk_series_id PRIMARY KEY (series_id)
);

CREATE TABLE ysq_users  (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `register_timestamp` TIMESTAMP NOT NULL,
    `userName` VARCHAR(16) NOT NULL,
    `password` VARCHAR(16) NOT NULL,
    `phone` VARCHAR(11) NOT NULL,
    `email` VARCHAR(20) NOT NULL,
    `status`  BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT pk_id PRIMARY KEY (id)
);


