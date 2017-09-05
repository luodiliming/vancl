@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="/admin/goodslist/{{$goods_id}}">货品列表</a></li>
        <li class="active"><a href="/admin/huopin/add/{{$goods_id}}">添加货品</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加货品</h3>
        </div>
        <div class="panel-body">
                                        {{--参数怎么放都行。一定要跟路由或者方法 里面的位置对应--}}
            <form action="/admin/goodslist/{{$goods_id}}/update/{{$huopin_id}}" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                @foreach($newattr as $k => $v)
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">{{$k}}</label>
                        <div class="col-sm-10">
                            <select name="attrs[]" id="inputID" class="form-control">
                                <option value=""> 请选择</option>
                                @foreach($v as $value)
                                    {{--子属性的titile 在被切割成数组的货品属性里有没有！有的话就选中，没有的话先为空！  其实$value['title']也就是$huopin['title']了--}}
                                    <option value="{{$value['title']}}" {{in_array($value['title'],explode(',',$huopin['attrs'])) ? 'selected' : ''}} >{{$value['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">库存数量</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="kucun" value="{{$huopin['kucun']}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection