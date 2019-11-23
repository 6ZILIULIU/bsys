<?php

namespace admin\Controller;

use Think\Controller;
use Admin\Model\UserModel;

class MailerController extends Controller {


    /**
     * 邮件发送随机的验证码
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