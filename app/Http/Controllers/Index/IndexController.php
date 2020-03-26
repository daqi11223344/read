<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QRcode;
use App\Model\Read;

class IndexController extends Controller
{
    public function ewm()
    {
        $url = storage_path('app/public/phpqrcode.php');
        include($url);
        $uid = uniqid();
//        dd($uid);
        $obj = new QRcode();
        //区分是谁登录的

        $uri = "http://qq.wangzhimo.top/oauth?uid=".$uid;
//        echo $uri;die;

        $obj -> png($uri,storage_path('app/public/1.png'));
//        echo $obj;
    }

    public function oauth()
    {
        $uid = $_GET['uid'];
//        dd($uid);
        $id = "wx92b4938777947dcd";
        $uri = urldecode("http://qq.wangzhimo.top/logi");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$id&redirect_uri=$uri&response_type=code&scope=snsapi_base&state=$uid#wechat_redirect";
        header("location:$url");
    }



    public function aouth()
    {
        return view('index/aouth');
    }

    public function logi(){
        $code=$_GET['code'];
        $appid='wx92b4938777947dcd';
        $se='85a648b9aab288da647c4252d3396683';
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$se.'&code='.$code.'&grant_type=authorization_code';
        $get=file_get_contents($url);
        $arr=json_decode($get,true);
        $token=$arr['access_token'];
        $openid=$arr['openid'];
        $user_url='https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
        $user_get=file_get_contents($user_url);
        $user_arr=json_decode($user_get,true);
//        $this->ajaxre($user_arr);
//        return view('index.loglist');
        echo "<img src=".$user_arr['headimgurl'].">";
    }
    //微信接口
    public function wx(){
        echo $_GET['echostr'];
    }


    public function index()
    {
//        dd(121213);
        return view('index/index');
    }

    public function login()
    {
        return view('login/login');
    }

    public function dologin()
    {
        $pwd=request()->input('pwd');
        $tel=request()->input('tel');
        $res=Read::where('tel','=',$tel)->first();
        // dd($res['user_pwd']);
        if($res){
            if($res['pwd']==$pwd){
                session(['tel'=>$tel]);
                echo '<b style="color:darkgreen">登陆成功，正在为您跳转。。。。。。》</b>';
                header("refresh:2,url='/'");
            }else{
                echo '<b style="color:red">密码不正确请您重新填写,正在为您跳转。。。。。</b>';
                header("refresh:2,url='login");
                die;

            }
        }else{
            echo '<b style="color:red">手机号不正确请您重新填写,正在为您跳转。。。。。</b>';
            header("refresh:2,url='login");
            die;
        }
    }

}
