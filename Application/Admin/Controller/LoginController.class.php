<?php

namespace admin\Controller;

use Think\Controller;
use Admin\Model\UsersModel;


class LoginController extends Controller {



    public function index(){

        //用cookie方式
        // $userName = Cookie('userName');
        // $this->assign('userName',Cookie('userName'));
        // if($userName)
        // {
        //     $this->display('index');
        // }else
        // {   
        //     //没用户就退回到login
        //     $this->display('login');
        // }
        
        //用session
        $userName = $_SESSION['userName'];
        $this->assign('userName',$_SESSION['userName']);
        
        
        if($_SESSION['userName']==null)
        {
            //没用户就退回到login
            $this->display('login');
        }else
        {   
            // var_dump($_SESSION);
            $this->display('index');
        }
    }

    public function login()
    {
        // $user = new UsersModel();
        // $data = $user->create();
        // dump($data);
        // cookie('userName',null);
        // $_SESSION['userName']=null;
        // var_dump($_SESSION);
        
        session_unset();
        $this->display('login');
    }

    //登出
    public function logout()
    {
        $this->display('login');
    }
    
    public function changePassword(){
        


        $userName      = trim($_POST['userName']);
        $oldPassword   = trim($_POST["oldPassword"]);
        $newPassword   = trim($_POST["newPassword"]);
        $reNewPassword = trim($_POST["reNewPassword"]);



        //获取用户名
        $user = new UsersModel();
        // $data = $user->create();
        $user->password = $newPassword;
        $condition['userName'] = $userName;
        $condition['password'] = $oldPassword;
        if($user->where($condition)->select())
        {
            $user->where($condition)->save();
            $this->ajaxReturn(true);
        }else
        {
            $this->ajaxReturn($data);
        }
        
    }

    //检测传入的字段是否重复，提取最近的一个异常
    private function checkAvailable($data){
        
        $exception = null;
        $user = new UsersModel();

        foreach($data as $key => $value)
        {
            $condition[$key] = $value;
            
            //检测
            if($key == 'password'){
                continue;
            }else if($user->query("select * from ysq_users where $key = '$value'"))
            {
                $exception[$key] = '_repeated';
                break;
            }else
            {
                continue;
            }
        }
        return $exception;
    }



    //注册按键触发
    public function registerVerify()
    {
        // $_POST['userName'] = 'tangchenaa';
        // $_POST['password'] = 'crazydiamand';
        // $_POST['phone'] = '18860141871';
        // $_POST['email'] = '12412511@qq.com';

        $user = new UsersModel();
        //正则过滤合法性
        if(!($data = $user->create())){
            $exception = $user->getError();
            $this->ajaxReturn($exception);
        }else{

        //检查输入是否重复除了密码
            $exception = $this->checkAvailable($data);
            // dump($data);
            // dump($exception);

            //用户名\电话\邮箱必须能用,且密码不为空
            if($exception == null)
            { 
                Cookie('userName',$data['userName'],3600);
                //传入数据库
                $user->add($data);
                $this->ajaxReturn(true);
                // dump($data);
            }else{
                $this->ajaxReturn($exception);
                // dump($data);
            }
        }
        
        
        
    }
    

    //登入按键触发
    public function loginVerify()
    {
        // $data['userName'] = "11111111";
        // $data['password'] = "11111111";
        $users = new UsersModel();
        $data['userName'] = $_POST['userName'];
        $data['password'] = $_POST['password'];

        // $err = null;
        // dump($data);
        foreach($data as $datas){
            $datas=trim($datas);
        }
        
        $condition['userName'] = $data['userName'];
        $condition['password'] = $data['password'];
        $condition['status'] = 1;
        if($users->where($condition)->select())
        {
            // $lifeTime = 24 * 3600;
            //找到对应的账号密码
            //设置cookie 维持1分钟
            
            // Cookie('userName',$data['userName'],3600);
            // $_SESSION['privileges']=1;
            session_start();
            session_cache_expire(1);
            session_set_cookie_params(3600);
            $_SESSION['userName']=$data['userName'];
            // echo session_cache_expire();
            $this->ajaxReturn(true) ;
        }
    }

   


    /**
     * 邮件发送
     */
    public function sendEmail()
    {
 
        $content = 123;
        $tomail = "291695377@qq.com";
        $url = '<a href="http://www.baidu.com" target="_blank" rel="noopener">123</a>';

        // 根据你的内用传入得到相关的参数，在调用我们方才的函数时，传递过去即可。
        $res = sendEmail( $content, $tomail,$url );
       // $res就是sendEmail()返回的值。我们根据返回的相应参数进行处理即可。
       dump($res);
        if ($res) {
          echo 1;
        }else{
          echo 0;
        }
    }
}