<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>后盾人 - houdunren.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="/node_modules/hdjs/css/font-awesome.min.css"
          rel="stylesheet">
    {{--这里的js 是放hdjs的配置--}}
    <script>
        //模块配置项
        var hdjs = {
            //框架目录
            'base': '/node_modules/hdjs',
            //上传文件后台地址
            'uploader': '/component/upload',//后面是发送的路由！给上传路由
            //获取文件列表的后台地址
            'filesLists': '/component/filesLists?',  //在后面需要加个问号？因为到uploader方法中。创建filesLists文件夹后面还需要加上以年月日创建成了文件夹！

            //需要到config文件下的disks里面添加一段代码！在写一个路由！
        };
    </script>
    <script src="/node_modules/hdjs/app/util.js"></script>
    <script src="/node_modules/hdjs/require.js"></script>
    <script src="/node_modules/hdjs/config.js"></script>
    <link href="/css/hdcms.css" rel="stylesheet">
    <script>
        require(['jquery'],function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body class="site">
<div class="container-fluid admin-top">
    <!--导航-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li class="top_menu">
                        <a href="?s=site/entry/home&siteid=18&mark=platform" class="quickMenuLink">
                            <i class="'fa-w fa fa-comments-o"></i> 网站主页 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://houdunwang.com" target="_blank">
                            <i class="'fa-w fa fa-cubes"></i> 实战培训 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://houdunren.com" class="quickMenuLink">
                            <i class="'fa-w fa fa-cubes"></i> 在线视频 </a>
                    </li>
                    <li class="top_menu">
                        <a href="http://bbs.houdunwang.com" class="quickMenuLink">
                            <i class="'fa-w fa fa-cubes"></i> 论坛讨论 </a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="fa fa-w fa-user"></i>
                            {{Auth::guard('adminlogin')->user()->username}} <span class="caret"></span>
                            {{--用全局的Auth调用守卫里面的adminlogin 这个，因为已经实例化了这个模型，相当于拿到登录表里的数据！在 用user获得username名字。就可以显示出来 ！--}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/changePassword">我的帐号</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:;" onclick="loginout()">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        function loginout() {
            require(['util'],function (util) {
                util.confirm('确定退出登录吗?',function(){
                    location.href = '/admin/loginout';
                })
            })
        }
    </script>
    <!--导航end-->
</div>
<!--主体-->
<div class="container-fluid admin_menu">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-lg-2 left-menu">
            <div class="search-menu">
                <input class="form-control input-lg" type="text" placeholder="输入菜单名称可快速查找"
                       onkeyup="search(this)">
            </div>
            <!--扩展模块动作 start-->
            <div class="panel panel-default">
                <!--系统菜单-->
                <div class="panel-heading">
                    <h4 class="panel-title">系统管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="35">
                        <a href="/admin/changePassword">我的资料 </a>
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">分类管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="39">
                        <a href="/admin/category">商品分类 </a>
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">属性管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="39">
                        <a href="/admin/attr">商品属性 </a>
                    </li>
                </ul>
                <div class="panel-heading">
                    <h4 class="panel-title">商品管理</h4>
                    <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                        <i class="fa fa-chevron-circle-down"></i>
                    </a>
                </div>
                <ul class="list-group menus">
                    <li class="list-group-item" id="39">
                        <a href="/admin/goods">商品列表 </a>
                    </li>
                </ul>
                <!----------返回模块列表 start------------>

            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-lg-10">
            @yield('content')
            {{--产生的意思--}}
            {{--放进了内容为  content包裹着的内容！在index.blade 文件中--}}
        </div>
    </div>
</div>
{{--把flash里面的messgae文件引入和公共里面的错误模板引进来--}}
@include('public.message')
@include('flash::message')
<script>
    require(['bootstrap']);
</script>
<!--右键菜单添加到快捷导航-->
<div id="context-menu">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">添加到快捷菜单</a></li>
    </ul>
</div>
<!--右键菜单删除快捷导航-->
<div id="context-menu-del">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#">删除菜单</a></li>
    </ul>
</div>
</body>
<script>
    require(['bootstrap'], function ($) {
        $('#flash-overlay-modal').modal();
    });
</script>
</html>
<style>
    .pagination {
        margin: 0px;
        float: right;
    }
</style>