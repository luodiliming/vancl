@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="/admin/category">分类列表</a></li>
        <li class="active"><a href="/admin/category/create">添加分类</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加分类</h3>
        </div>
        <div class="panel-body">
                            {{--还是发送这个资源控制器路由！会自动找到存储方法！上--}}
            <form action="/admin/category" method="post" role="form" class="form-horizontal">
                {{--增删改都需要令牌  而显示不用。不需要操作--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">父级分类</label>
                    <div class="col-sm-10">
                        <select name="pid" id="inputID" class="form-control">
                            <option value="0">顶级分类</option>
                            @foreach($data as $v)
                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection