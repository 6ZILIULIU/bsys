<?php

namespace admin\controller;

use Think\Controller;
use Think\Db;
use Think\Upload;
use Admin\Model\UsersModel;
use Admin\Model\SeriesModel;
use Admin\Model\VideosModel;

class ManageController extends Controller
{
    //欢迎主界面


    public function main()
    {
        $this->display();
    }

    //用户管理
    public function userManage()
    {
        $this->display();
    }

    //视频管理
    public function seriesManage(){

        if($_SESSION['userName']==null)
        {
            echo $_SESSION;
            die('当前无用户登录');
        }else{
            $this->assign('userName',$_SESSION['userName']);
            // echo "文件可上传最大值：".ini_get('upload_max_filesize')."</br>"; 
            $this->display();
        }
    }

    //json格式的数据库信息
    //@param：$_POST['table']
    public function getUsersData()
    {
        // $start = $_POST['start'];
        // $end = $_POST['end'];
        $users = new UsersModel();
        //收集数据集成json
        $data['rows'] = $users->where("status=1")->select();
        $data['total'] = $users->where("status=1")->count();

        // $data['rows']=$user->query("select * from ysq_users where status=0 between $start and $end");
        // $data['total']=$user->query("select count(*) from ysq_users where status=0 between $start and $end");
        // dump(($data));
        $this->ajaxReturn($data);
    }


        //上传管理
    //json格式的数据库信息
    //@param：$_POST['table']
    public function getSeriesData()
    {
        $startTime       = $_POST['startTime'];
        $endTime         = $_POST['endTime'];
        $search_title    = $_POST['search_title'];
        $db_series = new SeriesModel();
        if(!empty($search_title) && !empty($startTime) && !empty($endTime)){
            //收集数据集成json
            $map['series_title'] = ['like','%'.$search_title.'%'];
            $map['series_created_timestamp'] = array(array('gt',$startTime+0),array('lt',$endTime+0));
            $data['rows'] = $db_series->where($map)->where("series_status=1")->select();
            $data['total'] = $db_series->where($map)->where("series_status=1")->count();
        }else if(!empty($search_title)){
            $map['series_title'] = ['like','%'.$search_title.'%'];
            $data['rows'] = $db_series->where($map)->where("series_status=1")->select();
            $data['total'] = $db_series->where($map)->where("series_status=1")->count();
        }else if(!empty($startTime) && !empty($endTime)){
            $map['series_created_timestamp'] = array(array('gt',$startTime+0),array('lt',$endTime+0));
            $data['rows'] = $db_series->where($map)->where("series_status=1")->select();
            $data['total'] = $db_series->where($map)->where("series_status=1")->count();
        }else{
            $data['rows'] = $db_series->where($map)->where("series_status=1")->select();
            $data['total'] = $db_series->where($map)->where("series_status=1")->count();
        }
        
        // var_dump($data);
        // $type = gettype($startTime);
        // $this->ajaxReturn($data);
        $this->ajaxReturn($data);
    }

    //删除指定id的数据
    //@param：$_POST['id']
    public function removeUserById()
    {
        $user = new UsersModel();
        $id = $_POST['id'];
        $data['status'] = 0;
        if($res = $user->where("id = %d",$id)->save($data)){
            // $res = $user->where('id = 1');
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }



    public function create_series(){
        $username = $_POST['userName'];     //用户名
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else if(!isset($_FILES['cover'] ,$_POST['partition'] ,$_POST['title']  ,$_POST['tag'] )){ //检测关键上传内容不为空
            echo "封面：".$_POST['cover'];
            echo "分区：".$_POST['partition'];
            echo "标题：".$_POST['title'];
            echo "标签：".$_POST['tag'];
            die("错误！请检测是否全部‘*’号信息填写完毕，再重新提交");
        }else{
            unset($id); //初始化id

            $db_series = new SeriesModel();
            $condition['series_status'] = 1;
            $condition['series_title']  = $_POST['title'];
            if($db_series->where($condition)->select())
            {
                echo "该剧集已存在";
                header('Location: /bsys/index.php/Admin/Manage/seriesManage');
            }
            try{                                //实例用户表模型
                $db_users = new UsersModel();
                $id = $db_users->where("userName='%s'",$username)->getField('id');    //获取用户名对应id
                echo "用户$id 正在使用上传服务..";
            }catch(PDOException $e){
                echo $e;
                die("非法用户，请重新登陆..");
            }
        }

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize    =   10485760 ;// 设置附件上传大小10M
        $upload->exts       =   array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        // $upload->mimes      =   array('image/*');           // 设置附件上传MIME类型
        $upload->rootPath   =   './upload/'; // 设置附件上传根目录
        $upload->subName    =   'covers'; // 设置附件上传（子）目录
        $upload->saveName   =   'pic'.time().mt_rand();
        //保存文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
                $data['series_id']          = NULL;                 //视频id
                $data['id']                 = $id;                  //用户id
                $data['series_coverpath']   = $info['cover']['savepath'].$info['cover']['savename'];        //剧集封面
                $data['series_tag']         = $_POST['tag'];      //剧集标签
                $data['series_title']       = $_POST['title'];      //剧集标题
                $data['series_profile']     = $_POST['profile'];    //剧集简介
                $data['series_partition']   = $_POST['partition'];   //剧集分区
                $data['series_title']       = $_POST['title'];      //剧集标题

                try{                                //实例视频表模型
                    $db_series = new SeriesModel();
                    $db_series->add($data);
                    // $this->ajaxReturn(true);
                    echo "上传成功";
                    sleep(5);
                    header('Location: /bsys/index.php/Admin/Manage/seriesManage');
                }catch(PDOException $e){
                    // $this->ajaxReturn(false);
                    // die("数据库请求失败，请重试..");
                    sleep(5);
                    echo "数据库请求失败，请重试..";
                    header('Location: /bsys/index.php/Admin/Manage/seriesManage');
                }
                
        }

    }

    public function remove_series(){
        
        $username = $_POST['userName'];     //用户名
        $series_id = $_POST['series_id'];

        $data['series_status'] = 0; 
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            $db_series = new SeriesModel();
            if($db_series->where("series_id=".$series_id)->save($data)) //提交更新
            {
                // echo "删除成功";
                $this->ajaxReturn(true);
            }
        }
    }

    //@param：$_POST['table']
    public function getVideosData()
    {
        $username = $_POST['userName'];     //用户名
        $series_id = $_POST['series_id'];
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            $db_videos = new VideosModel();
            $series_id = $_POST['series_id'];
            $condition['series_id'] = $series_id;
            $condition['video_status'] = 1;
            $series_title = $db_videos->table('ysq_series')->where("series_id=".$series_id)->getField('series_title');
            $data['rows'] = $db_videos->where($condition)->select();
            $data['total'] = $db_videos->where($condition)->count();
            $data['series_title'] = $series_title;
            $this->ajaxReturn($data);
        }
        
    }
    // else if(!isset($_FILES['video'] )){ //检测关键上传内容不为空
    //     // echo $_FILES['video']['name'];
    //     die("错误！请检测是否全部‘*’号信息填写完毕，再重新提交");
    // }
    public function add_video(){
        // echo 123111111111111111111111111111;
        $username   = $_POST['userName'];  
        $series_id  = $_POST['series_id'];
        // var_dump($_POST);
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{ 
            unset($id); //初始化id
            try{                                //实例用户表模型
                $db_users = new UsersModel();
                
                $id = $db_users->where("userName=".$username)->getField('id');    //获取用户名对应id
                // echo "用户$id 正在使用上传服务..";
            }catch(PDOException $e){
                die("非法用户，请重新登陆..");
            }
        }

        
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize    =   6442450944 ;// 设置附件上传大小6G
        $upload->exts       =   array('mp4', 'mkv', 'avi', 'flv');// 设置附件上传类型
        // $upload->mimes      =   array('image/*');           // 设置附件上传MIME类型
        $upload->rootPath   =   './upload/'; // 设置附件上传根目录
        $upload->subName    =   'videos'; // 设置附件上传（子）目录
        $upload->saveName   =   'av'.time().mt_rand();
        //保存文件 
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功 获取上传文件信息
                $data['video_id']           = NULL;                 //视频id
                $data['id']                 = $id;                  //用户id
                $data['video_size']         = $info['video']['size'];;       //视频尺寸
                $data['video_name']         = pathinfo($info['video']['savename'],PATHINFO_FILENAME);    //视频保存名字
                $data['video_mime']         = $info['video']['type'];        //视频MIME类型
                $data['video_filepath']     = $info['video']['savepath'].$info['video']['savename'];    //视频保存名字
                $data['video_ext']          = $info['video']['ext'];        //视频后缀
                $data['series_id']          = $series_id;
                $data['video_episode']      = $_POST['video_episode'];
                $data['video_title']        = $_POST['video_title'];

                // echo "剧集集数为：".$_POST['episode']."</br>";
                try{                                //实例视频表模型
                $db_videos = new VideosModel();
                $db_series = new SeriesModel();
                $db_videos->add($data);
                // $db_videos->where("series_id=".$series_id)->setInc('series_total_episode');

                // $series_id = $db_videos->where("video_id=".$video_id)->getField('series_id');
                unset($data);
                $condition['series_id'] =  $series_id;
                $condition['video_status'] = 1; 
                $data['series_total_episode'] = $db_videos->where($condition)->count();
                // var_dump($series_id);
                $db_series->where("series_id=".$series_id)->save($data);
                    //post方式
                    // header('Location: /bsys/index.php/Admin/Manage/seriesManage');
                    //ajax上传方式
                    $this->ajaxReturn(true);
                }catch(PDOException $e){
                    // die("数据库请求失败，请重试..");
                    // sleep(5);
                    // echo "数据库请求失败，请重试..";
                    // header('Location: /bsys/index.php/Admin/Manage/seriesManage');

                    //ajax方式
                    // $this->ajaxReturn(false);
                }
                
        }
     } 


     public function remove_video(){
        
        $username = $_POST['userName'];     //用户名
        $video_id = $_POST['video_id'];
        // $series_id = $_POST['series_id'];
        // $username = 11111111;     //用户名
        // $video_id = 6;
        // $condition['video_status'] = 1;
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            try{
                $db_videos = new VideosModel();
                $db_series = new SeriesModel();
                $data['video_status'] = 0;
                $db_videos->where("video_id=".$video_id)->save($data); //提交更新
                //更新集数
                $series_id = $db_videos->where("video_id=".$video_id)->getField('series_id');
                unset($data);
                $condition['series_id'] =  $series_id;
                $condition['video_status'] = 1;
                $data['series_total_episode'] = $db_videos->where($condition)->count();
                $db_series->where("series_id=".$series_id)->save($data);
                $this->ajaxReturn(true);
            }catch(Exception $e){
                // header('Location: /bsys/index.php/Admin/Manage/seriesManage');
            }
            
        }
     } 


     public function updateInfo(){
        $username = $_POST['userName'];       //用户名
        $series_id = $_POST['series_id'];
        // $username = 11111111;       //用户名
        // $series_id = 1;


        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            try{
                $db_videos = new VideosModel();
                $db_series = new SeriesModel();
                //更新总集数
                unset($data);
                $condition['series_id'] =  $series_id;
                $condition['video_status'] =  1;
                $data['series_total_episode'] = $db_videos->where($condition)->count();

                $db_series->where("series_id='%d'",$series_id)->save($data);
                // dump($data);
                $this->ajaxReturn(true);
            }catch(Exception $e){
            }
            
        }
    }

    function changeCover(){
        $username = $_POST['userName'];       //用户名
        $series_id = $_POST['series_id'];
        // $username = 11111111;       //用户名
        // $series_id = 1;
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
                $upload = new \Think\Upload();
                $upload->size       = 10485760; //10M
                $upload->exts       = ['jpg','png','gif','jpeg'];
                // $upload->mimes      = ['image/jpg'];
                $upload->rootPath   = './upload/';
                $upload->subName    = 'covers';
                $upload->saveName   = 'pic'.time().mt_rand();
                //保存文件
                $info = $upload->upload();
                if(!$info){
                    $this->error($upload->getError());
                }else{
                    unset($data);
                    $data['series_coverpath']   = $info['newCover']['savepath'].$info['newCover']['savename'];
                    
                    try{
                        $db_series = new SeriesModel();
                        //更新总集数
                        
                        $condition['series_id'] =  $series_id;
                        $db_series->where("series_id=".$series_id)->save($data);
                        // dump($data);
                        $this->ajaxReturn(true);
                    }catch(Exception $e){
                    }
                }
            
            
        }
    }

    function change_shelves(){
        $username = $_POST['userName'];       //用户名
        $series_id = $_POST['series_id'];
        // $username = 11111111;       //用户名
        // $series_id = 1;
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            $db_series = new SeriesModel;
            $condition['series_id'] = $series_id;
            $is_on_shelves = $db_series->where('series_id='.$series_id)->getField('is_on_shelves');
            // var_dump($is_on_shelves);
            if($is_on_shelves){
                $data['is_on_shelves'] = false;
                $db_series->where('series_id='.$series_id)->save($data);
            }else{
                $data['is_on_shelves'] = true;
                $db_series->where('series_id='.$series_id)->save($data);
            }

            $this->ajaxReturn(true);
        }
    }
     
    function change_title(){
        $username = $_POST['userName'];       //用户名
        $series_id = $_POST['series_id'];
        $series_title = $_POST['newTitle'];
        // $username = 11111111;       //用户名
        // $series_id = 1;
        if(!isset( $username )){            //检测用户合法性
            die("登录已过期，请登录后重试");
        }else{
            $db_series = new SeriesModel;
            $condition['series_id'] = $series_id;
            $data['series_title'] = $series_title;
            $db_series->where('series_id='.$series_id)->save($data);
            $this->ajaxReturn(true);
        }
    }
    
}
