@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/admin/goodslist/{{$goods_id}}">货品列表</a></li>
        <li><a href="/admin/huopin/add/{{$goods_id}}">添加货品</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">商品：{{$goodsInfo['title']}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>属性组合</th>
                    <th>库存数量</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($huopin as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['attrs']}}</td>
                        <td>{{$v['kucun']}}</td>
                        <td>
                            <div class="btn-group">
                                                            {{--带个商品id,带一个货品id--}}
                                <a href="/admin/huopin/edit/{{$goods_id}}/{{$v['id']}}" type="button" class="btn btn-default">编辑</a>
                                <a href="javascript:;" onclick="del({{$v['id']}})" type="button" class="btn btn-default">删除</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--{{ $data->links() }}--}}
    <script>
        function del(id) {
            require(['util'], function (util) {
                util.confirm('确定删除吗?', function () {
                    $.ajax({
                        url: '/admin/goodslist/delete/' + id,
//                        method: 'DELETE',  资源控制器才用到的方法
                        type: 'get',
//                            普通删除写的type 类型的意思
                        success: function (res) {
                            util.message(res.message, 'refresh');
                        }
                    })
                })
            })
        }
    </script>

    {{--解释了资源控制器为什么自动调转。和any()路由和  type:''get--}}
    {{--27:特大注意：在删除方法里面的点击删除事件有个点击事件！走了下面的资源js！ 资源控制器都知道的。写一个路由不写方法会自动进去哪个方法！其中的删除会自动找到的原因就在js里面的 method：’DELETE’ 这个里面写好的方法，会自动跳转到资源控制的方法！ 如果我们把他改成--}}
    {{--type:’get’这种写法，意思类别是get的！ 如果这样写的话。路由就必须写get()路由了！   如果你还是想写资源路由用method:’DELETE’--}}
    {{--就需要在用any（）路由！可以接受任意的方法路由！！！！！！！！--}}
@endsection