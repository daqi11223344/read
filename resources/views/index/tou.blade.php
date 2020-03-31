<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>打赏页面</title>
</head>
<body>
<h1 style="color:darkgreen">请打赏</h1>
<form action="{{url('alipay')}}" method="get">
    <input type="radio" name="amount" value="1"><b style="color:darkgreen">1个月票☝</b><br>
    <input type="radio" name="amount" value="10"><b style="color:darkgreen">10个月票☝</b><br>
    <input type="radio" name="amount" value="20"><b style="color:darkgreen">20个月票☝</b><br>
    <input type="radio" name="amount" value="30"><b style="color:darkgreen">30个月票☝</b><br>
    <input type="radio" name="amount" value="40"><b style="color:darkgreen">40个月票☝</b><br>
    <input type="radio" name="amount" value="50"><b style="color:darkgreen">50个月票☝</b><br>
    <input type="radio" name="amount" value="100"><b style="color:darkgreen">100个月票♔</b><br>
    <input type="submit" value="点击打赏">
</form>
</body>
</html>