@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/admin/attr">属性列表</a></li>
        <li><a href="/admin/attr/create">添加属性</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">商品分类管理</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>属性名称</th>
                    <th>父级属性</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['title']}}</td>
                    <td>{{$v['pid'] == 0?'父级属性':$v->parent->title}} </td>
                    {{--需要通过三元表达式才可以！如果 pid==0？的话就属于 父级属性。：否者的话。$v是每条数据->parent调用自关联、—>title得到--}}
                    {{--名字展示出来！--}}
                    <td>
                        <div class="btn-group">
                            <a href="/admin/attr/{{$v['id']}}/edit" type="button" class="btn btn-default">编辑</a>
                            <a href="javascript:;" onclick="del({{$v['id']}})" type="button" class="btn btn-default">删除</a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    {{--{{ $data->links() }}--}}
    <script>
        function del(id){
            alert(id);
            require(['util'], function (util) {
                util.confirm('确定删除吗?',function(){
                    $.ajax({
                        url:'/admin/attr/'+id,
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