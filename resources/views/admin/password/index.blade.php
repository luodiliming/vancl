@extends('public.father')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">修改密码</h3>
        </div>
        <div class="panel-body">
            <form action="" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">原密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="oldpassword">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                                                            {{--这里的确认name值就必须要填这个了，后面验证的时候需要跟，新密码添加一个字段保持一致--}}
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">修改</button>
            </form>
        </div>
    </div>
@endsection