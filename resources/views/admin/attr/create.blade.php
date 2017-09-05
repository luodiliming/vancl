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
            <form action="/admin/attr" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">属性名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">父级属性</label>
                    <div class="col-sm-10">
                        <select name="pid" id="inputID" class="form-control">
                            <option value="0">顶级属性</option>
                            @foreach($data as $v)
                                <option value="{{$v['id']}}">{{$v['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection