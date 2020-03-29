<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>注册</title>
    <link type="text/css" rel="stylesheet" href="static/css/zhuce.css" />
    <script type="text/javascript" src="static/js/jquery-1.11.1.min.js"></script>
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
            {{--<img src="/static/images/zhuce-image-3.png" class="theimg"/>--}}
            {{--<img src="/static/images/zhuce-image-2.png" class="secimg"/>--}}
            <img style="width: 500px" src="/static/images/2 (1).jpg" class="firimg"/>
        </div>
        <div class="main_right">
            <div class="main_r_up">
                <img src="/static/images/user.png" />
                <div class="pp">注册</div>
            </div>
            <div class="sub"><p>已经注册？<a href="{{url('login')}}"><span class="blue">请登录</span></a></p></div>
            <form action="{{url('doreg')}}" method="post">
            <div class="txt">
                <span style="letter-spacing:10px;">手机号:</span>
                <input name="tel" type="text" id="tel" class="txtphone" placeholder="请输入手机号码"/>
            </div>
            <div class="txt">
                <span style=" float:left;letter-spacing:10px;">验证码:</span>
                <input name="code" type="text" class="txtyzm" placeholder="请输入验证码" id="code"/>
                <img style="float:right" width="42px" src="/static/images/1.jpg" class="btn yan"/>
            </div>
             <div class="txt">
                 <span style="letter-spacing:10px;">密码:</span>
                 <input name="pwd" type="password" class="txtphone" placeholder="请输入密码"/>
             </div>
             <div class="txt">
                 <span style="letter-spacing:10px;">确认密码:</span>
                 <input name="pwds" type="password" class="txtphone" placeholder="请再次输入密码"/>
             </div>
            <button class="xiayibu">下一步 ></button>
            </form>
        </div>
    </div>
</div>


</body>
</html>

<script>
    $(document).on('click','.yan',function(){
        var tel = $('#tel').val();
        if(!(/^1[3456789]\d{9}$/.test(tel))){
            alert("手机号码有误，请重填");
            return false;
        }
        $.ajax({
            url:"{{url('code')}}",
            data:{tel:tel},
            type:'POST',
            dataType:'JSON',
            success:function(res){
                if(res.return_code==00000){
                    alert('ok');
                }
            }
        });
    })
</script>
