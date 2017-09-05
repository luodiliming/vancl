@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/admin/category">分类列表</a></li>
        <li><a href="/admin/category/create">添加分类</a></li>
    </ul>
    {{--增删改都需要令牌  显示不需要操作所以不需要！--}}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">商品分类管理</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>分类名称</th>
                    <th>顶级分类</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['name']}}</td>
                    <td>@if($v['pid'] == 0) 是顶级分类 @else 不是顶级分类 @endif</td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/category/{{$v['id']}}/edit" type="button" class="btn btn-default">编辑</a>
                            <a href="javascript:;" onclick="del({{$v['id']}})" type="button" class="btn btn-default">删除</a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    {{--展示分页，就必须放置这段代码。光调用方法还不行！--}}
    {{ $data->links() }}
    <script>
        function del(id){
            alert(id);
            require(['util'], function (util) {
                util.confirm('确定删除吗?',function(){
                    $.ajax({
                        url:'/admin/category/'+id,
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