<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>后盾人 - houdunren.com</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="/node_modules/hdjs/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/hdcms.css" rel="stylesheet">
</head>
<body class="hdcms-login">
<div class="container logo">
    <div style="background: url('http://www.houdunren.com/resource/images/logo.png') no-repeat; background-size: contain;height: 60px;"></div>
</div>
<div class="container well">
    <div class="row ">
        <div class="col-md-6">
            <form method="post" action="">
                {{csrf_field()}}
                {{--必须加入令牌--}}
                <div class="form-group ">
                    <label>帐号</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-w fa-user"></i></div>
                        <input type="text" name="username" class="form-control input-lg"
                               placeholder="请输入帐号" value="">
                    </div>
                </div>
                <div class="form-group ">
                    <label>密码</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-w fa-key"></i></div>
                        <input type="password" name="password"
                               class="form-control input-lg" placeholder="请输入密码" value="">
                    </div>
                </div>
                {{--在登录验证方法中！错误时  给的with('error','用户名或密码错误！！');  这段就需要作出判断。出现error就显示一段话。报错的话!--}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary btn-lg">登录</button>
            </form>
        </div>
        <div class="col-md-6">
            <div style="background: url('http://www.houdunren.com/resource/images/houdunwang.jpg');background-size:100% ;height:230px;"></div>
        </div>
    </div>
    <div class="copyright">
        Powered by hdcms v2.0 © 2014-2019 www.hdcms.com
    </div>
</div>
</body>
</html>