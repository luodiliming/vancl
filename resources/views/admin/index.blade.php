@extends('public.father')
{{--代表继承public 里面的叫 father模板--}}


{{--下面是包裹着想写的部分开始--}}
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">后台首页</h3>
        </div>
        <div class="panel-body">
            欢迎来到德莱联盟！
        </div>
    </div>
@endsection
{{--结束--}}
{{--还需要放到father 模板里面才能显示呢！ -》 @yield('content')--}}