@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/admin/goods">商品列表</a></li>
        <li><a href="/admin/goods/create">添加商品</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">商品管理</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>商品名称</th>
                    <th>市场价格</th>
                    <th>商城价格</th>
                    <th>列表图片</th>
                    <th>查看次数</th>
                    <th>货品列表</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($goods as $v)
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['title']}}</td>
                    <td>{{$v['shichangprice']}}</td>
                    <td>{{$v['shangchengprice']}}</td>
                    {{--一般asset（）用于引用静态文件 css js img 等--}}
                    <td><img src="{{asset($v['listimg'])}}" alt="" style="height: 60px;"></td>
                    <td>{{$v['click']}}</td>
                    <td><a href="/admin/goodslist/{{$v['id']}}">货品列表</a></td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/goods/{{$v['id']}}/edit" type="button" class="btn btn-default">编辑</a>
                            <a href="javascript:;" onclick="del({{$v['id']}})" type="button" class="btn btn-default">删除</a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    {{--至于前面的$goods 写什么，取决的在方法里面，分页方法存进哪个变量名中--}}
    {{ $goods->links() }}
    <script>
        function del(id){
            require(['util'], function (util) {
                util.confirm('确定删除吗?',function(){
                    $.ajax({
                        url:'/admin/goods/'+id,
                        method:'DELETE',
                        success:function (res) {
                            util.message(res.message,'refresh');
                        }
                    })
                })
            })
        }
    </script>
@endsection