<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QRcode;
use App\Model\Read;
use App\Model\Book;

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
        $data=Book::orderBy('cs','desc')->take(5)->get();
        $datas=Book::orderBy('cs','desc')->take(10)->get();
        $yue=Book::orderBy('yue','desc')->take(10)->get();
        return view('index/index',['data'=>$data,'datas'=>$datas,'yue'=>$yue]);
    }

//    public function inde()
//    {
////        dd(121213);
//        return view('index/inde');
//    }

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

    public function reg()
    {
        return view('login/reg');
    }

    public function doreg()
    {
        $str = session('str');
        $code = $_POST['code'];
        $tel = $_POST['tel'];
        $pwd = $_POST['pwd'];
        $pwds = $_POST['pwds'];
        $arr = [
            'tel' => $tel,
            'pwd' => $pwd
        ];

        if ($str != $code) {
            echo '您的验证码不正确,正在为您跳转。。。';
            header("refresh:2,url='reg'");
            die;
        }
        if ($pwd != $pwds) {
            echo '<b style="color:red">两次密码不正确请您重新填写,正在为您跳转。。。。。</b>';
            header("refresh:2,url='reg'");
            die;
        }
        $res = Read::insert($arr);
        if ($res) {
            echo '<b style="color:darkgreen">注册成功，正在为您跳转。。。。。。》</b>';
            header("refresh:2,url='login'");
        }
    }

    //注册验证码
    public function code(){
        $tel=request()->input('tel');
        $str = rand(1000,9999);
        session(['str'=>$str]);
            $host = "http://dingxin.market.alicloudapi.com";
            $path = "/dx/sendSms";
            $method = "POST";
            $appcode = "48fa2af8f54d4a6fada4e7ec7f5df15a";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            $querys = "mobile=$tel&param=code%3A$str&tpl_id=TP1711063";
            $bodys = "";
            $url = $host . $path . "?" . $querys;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            if (1 == strpos("$".$host, "https://"))
            {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            }
            echo curl_exec($curl);
        }

    public function list()
    {
        $name = $_GET['name'];
        $data = Book::where('name','=',$name)->first();
        if($data==null){
            $data = Book::where('zuozhe','=',$name)->first();
            if($data==null){
                echo "<b style='color:red'>不好意思您搜索的作者或书籍不存在，请您确认过后重新搜索</b>";
                header("refresh:2,url='/'");
                die;
            }
        }

        if($data){
            Book::where('id','=',$data->id)->increment('cs',1);
        }
        return view('index/list',['data'=>$data]);
    }

    //月票投票
    public function yue(){
        $yue=$_GET['yue'];
//        dd($yue);
        $res=Book::where('id','=',$yue)->increment('yue');
//        dd($res);
        if($res){
            echo '<h2 style="color:firebrick">投票成功，感谢你的支持，正在为您跳转页面</h2>';
            header("refresh:2,url='/'");
        }
    }

    public function tou()
    {
        return view('index/tou');
    }

    public function alipay()
    {

        $ali_gateway = 'https://openapi.alipaydev.com/gateway.do';  //支付网关
//        dd($ali_gateway);
        // 公共请求参数
        $appid = '2016101300676944';
        $method = 'alipay.trade.page.pay';
        $charset = 'utf-8';
        $signtype = 'RSA2';
        $sign = '';
        $timestamp = date('Y-m-d H:i:s');
        $version = '1.0';
        $return_url = 'http://qq.wangzhimo.top/return';       // 支付宝同步通知
        $notify_url = 'http://qq.wangzhimo.top/notify';        // 支付宝异步通知地址
        $biz_content = '';
        //请求参数
        $out_trade_no = time() . rand(1111,9999);       //商户订单号
        $product_code = 'FAST_INSTANT_TRADE_PAY';
        $total_amount = $_GET['amount']??"";
        if($total_amount==''){
            echo '请您至少选择一个商品';
            die;
        }
        $subject = '月票订单' . $out_trade_no;

        $request_param = [
            'out_trade_no'  => $out_trade_no,
            'product_code'  => $product_code,
            'total_amount'  => $total_amount,
            'subject'       => $subject
        ];

        $param = [
            'app_id'        => $appid,
            'method'        => $method,
            'charset'       => $charset,
            'sign_type'     => $signtype,
            'timestamp'     => $timestamp,
            'version'       => $version,
            'notify_url'    => $notify_url,
            'return_url'    => $return_url,
            'biz_content'   => json_encode($request_param)
        ];

        ksort($param);

        $str = "";
        foreach($param as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');

        //jisuanqianming
        $key = storage_path('keys/app_priv');
        $priKey = file_get_contents($key);
        $res = openssl_get_privatekey($priKey);
        openssl_sign($str, $sign, $res, OPENSSL_ALGO_SHA256);
        // dd($res);
        $sign = base64_encode($sign);
        $param['sign'] = $sign;
        $param_str = '?';
        foreach($param as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $param_str = rtrim($param_str,'&');
        $ali_gateway = $ali_gateway . $param_str;
        //发送GET请求
        //echo $url;die;
        header("Location:".$ali_gateway);

    }

    //支付同步跳转
    public function return(){
//        dd(qqq);
        echo "支付成功 同步跳转";
    }

    //支付宝异步跳转
    public function notify(){
        // 1 接收 支付宝的POST数据
        //$data1 = file_get_contents("php://input");
        $data2 = json_encode($_POST);
        //$log1 = date('Y-m-d H:i:s') . ' >>> ' .$data1 . "\n";
        $log2 = date('Y-m-d H:i:s') . ' >>> ' .$data2 . "\n";
        //file_put_contents('alipay.log',$log1,FILE_APPEND);
        file_put_contents('logs/alipay.log',$log2,FILE_APPEND);
        $data = $_POST;
        $sign = base64_decode($data['sign']);
        unset($data['sign_type']);
        unset($data['sign']);
        //echo '<pre>';print_r($data);echo '</pre>';
        $d = [];
        // 2 url_decode
        foreach($data as $k=>$v){
            $d[$k] = urldecode($v);
        }
        //echo '<pre>';print_r($d);echo '</pre>';die;
        ksort($d);
        $str = "";
        foreach($d as $k=>$v){
            $str .= $k . '=' . $v . '&';
        }
        //带签名字符串
        $str = rtrim($str,'&');
        //读取公钥文件
        $pubKey = file_get_contents(storage_path('keys/ali_pub'));
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        // 验证签名
        $result = (bool)openssl_verify($str, $sign, $res, OPENSSL_ALGO_SHA256);
        //释放资源
        openssl_free_key($res);
        if($result){
            $log = date('Y-m-d H:i:s') . ' >>> 验签通过 1' . "\n\n";
            file_put_contents("logs/alipay.log",$log,FILE_APPEND);
        }else{
            $log = date('Y-m-d H:i:s') . ' >>> 验签失败 0' . "\n\n";
            file_put_contents("logs/alipay.log",$log,FILE_APPEND);
        }
        echo 'success';
    }

    protected function verify($data, $sign) {
        //读取公钥文件
        $pubKey = file_get_contents(storage_path('keys/ali_pub'));
        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);
        $result = (bool)openssl_verify($data, $sign, $res, OPENSSL_ALGO_SHA256);
        //释放资源
        openssl_free_key($res);
        var_dump($result);
        return $result;
    }
}


