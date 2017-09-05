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

            {{--修改之后会自动psot到资源控制器里面的更新方法中update--}}
            <form action="/admin/category/{{$data['id']}}" method="post" role="form" class="form-horizontal">
                {{--增删改都需要令牌  而显示不用。不需要操作--}}
                {{csrf_field()}}
                {{--在 资源控制器中如果需要编辑修改或者删除的话，需要在页面中加入伪造表单{{method_field(‘PUT’)}} 文档中有！--}}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$data['name']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">父级分类</label>
                    <div class="col-sm-10">
                        <select name="pid" id="inputID" class="form-control">
                            <option value="0">顶级分类</option>
                            {{--意思是说value的值呢，是要通过三元判断的。所有数据里面的id  等于 修改那条数据的id 的话  就自动显示属于哪条父级分类！--}}
                            @foreach($category as $value)
                                <option value="{{$value['id']}}" {{$value['id'] == $data['pid']?'selected':'' }} >{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection