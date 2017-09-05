@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="/admin/attr">属性列表</a></li>
        <li class="active"><a href="/admin/attr/create">添加属性</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加属性</h3>
        </div>
        <div class="panel-body">
            {{--一直有个小疑问知道了。为什么在修改页面中还要给form表带参数呢。是因为修改完成后，还要进行走更新方法这里需要--}}
            <form action="/admin/attr/{{$attr['id']}}" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                {{--伪照表单--}}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{$attr['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">父级分类</label>
                    <div class="col-sm-10">
                        <select name="pid" id="inputID" class="form-control">
                            <option value="0">顶级分类</option>
                            @foreach($data as $v)
                                <option value="{{$v['id']}}" {{$v['id'] == $attr['pid']?'selected':'' }} >{{$v['title']}}</option>
                            @endforeach
                            {{--意思遍历所有数据时 三元判断！ $v的id 对应着这条数据的pid 就显示出来  否者就空--}}
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection