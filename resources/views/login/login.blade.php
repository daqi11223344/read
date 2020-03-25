<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<body>
    <h2 style="color:royalblue">登录</h2>
    <form action="{{url('dologin')}}" method="post">
        <input type="tel" name="tel" placeholder="请输入手机号"><br>
        <input type="password" name="pwd" placeholder="请输入密码"><br>
        <button>登录</button>
    </form>
</body>
</html>