<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登录</title>
    <link type="text/css" rel="stylesheet" href="/static/css/login.css" />
    <script type="text/javascript" src="/static/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var height=$(document).height();
            $('.main').css('height',height);
        })
    </script>
</head>

<body>
<div class="main">
    <div class="main0">
        <div class="main_left">
            {{--<img style="width: 400px" src="/static/images/2 (1).jpg" class="theimg"/>--}}
            {{--<img style="width: 400px" src="/static/images/2 (2).jpg" class="secimg"/>--}}
            <img style="width: 500px" src="/static/images/bk-login.png" class="firimg"/>
        </div>
        <div class="main_right">
            <div class="main_r_up">
                <img src="/static/images/user.png" />
                <div class="pp">登录</div>
            </div>
            <div class="sub"><p>还没有账号？<a href="{{url('reg')}}"><span class="blue">立即注册</span></a></p></div>
            <form action="{{url('dologin')}}" method="post">
                <div class="txt">
                    <span style="letter-spacing:8px;">手机号:</span>
                    <input name="tel" type="tel" class="txtphone" placeholder="请输入注册手机号"/>
                </div>
                <div class="txt">
                    <span style="letter-spacing:4px;">登录密码:</span>
                    <input name="pwd" type="password" class="txtphone" placeholder="请输入登录密码"/>
                </div>
                <button class="xiayibu">下一步 ></button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
