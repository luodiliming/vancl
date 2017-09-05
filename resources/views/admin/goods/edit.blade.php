@extends('public.father')

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="/admin/goods">商品列表</a></li>
        <li class="active"><a href="/admin/goods/create">添加商品</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">添加商品</h3>
        </div>
        <div class="panel-body">
            <form action="/admin/goods/{{$data['id']}}" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商品名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" value="{{$data['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">列表图片</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="listimg" readonly="" value="">
                            <div class="input-group-btn">
                                <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            {{--asset框架自带方法。是自带引入静态文件的方法！--}}
                            <img src="{{$data['listimg']}}" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                    <script>
                        //上传图片
                        function upImage(obj) {
                            require(['util'], function (util) {
                                options = {
                                    multiple: false,//是否允许多图上传
                                };
                                util.image(function (images) {
                                    //上传成功的图片，数组类型
                                    $("[name='listimg']").val(images[0]);
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }

                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src', 'resource/images/nopic.jpg');
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label for=""  class="col-sm-2 control-label">所属分类</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="inputID" class="form-control">
                            <option value="">请选择</option>
                            @foreach($category as $value)
                                <option value="{{$value['id']}}" {{$data['category_id'] == $value['id'] ? 'selected' : ''}}>{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">市场价格</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shichangprice" value="{{$data['shichangprice']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商城价格</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shangchengprice" value="{{$data['shangchengprice']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">浏览次数</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="click" value="{{$data['click']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商品属性</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            @foreach($attr as $v)
                                <label>
                                    {{--在解释一下吧！通了就简单了。就是value的$v[‘id’] 是哪个呢！我们就通过三元判断吧！搜索遍历属性表的id在 被切割成数组的商品表里面的数组找！有的话就默认勾选，没有则为空！！--}}
                                             {{--in_array() 函数搜索数组中是否存在指定的值。  explode()方法是把字符串组成数组！因为在数据库里属性是字符串的形式。展示不了！                                --}}
                                    <input type="checkbox" name="attrs[]" value="{{$v['id']}}" {{in_array($v['id'],explode(',',$data['attrs'])) ? 'checked' : ''}}> {{$v['title']}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商品描述</label>
                    <div class="col-sm-10">
                        <textarea name="desc" class="form-control" rows="5" style="resize: none;">{{$data['desc']}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">商品详情</label>
                    <div class="col-sm-10">
                        <textarea id="container" style="height:300px;width:100%;">{{$data['content']}}</textarea>
                        <script>
                            util.ueditor('container', {hash:2,data:'hd'}, function (editor) {
                                //这是回调函数 editor是百度编辑器实例
                            });
                        </script>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>

@endsection