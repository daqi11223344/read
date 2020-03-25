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

        $uri = "http://www.read.com/oauth?uid=".$uid;
        echo $uri;die;

        $obj -> png($uri,storage_path('app/public/1.png'));
    }

    public function oauth()
    {
        $uid = $_GET['uid'];
//        dd($uid);
        $id = "wx92b4938777947dcd";
        $uri = urldecode("http://www.read.com/logi");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$id&redirect_uri=$uri&response_type=code&scope=snsapi_base&state=$uid#wechat_redirect";
        header("location:$url");
    }



    public function aouth()
    {
        return view('index/aouth');
    }

    public function logi(){
        echo $_GET['code'];
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
                header("refresh:2,url='index");
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
