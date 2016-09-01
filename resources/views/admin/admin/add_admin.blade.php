@extends('admin.common.master')
@section('title','添加管理员')
@section('content')
<body class="skin-blue">
<form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
    {!! csrf_field() !!}
    <div class="modal-body">
        <div class="form-group">
            <div class="">
                <span class="input-group-addon">管理员角色</span><br />
                @foreach($role AS $role)
                    <input type="checkbox"  class="checkbox{{$role->name}}" id="checkbox{{$role->name}}" name="roleId[]" onclick="checkbox({{$role->name}})" value="{{$role->name}}"
                    >{{$role->name}}
                    <br /><br />
                    @if(!empty($role->sub))
                        <span style="padding-left:50px;">|—</span>
                        @foreach($role->sub AS $sub)
                            <input type="checkbox" class="checkbox{{$sub->name}}" id="checkbox{{$sub->name}}" name="roleId[]" onclick="checkbox({{$sub->name}})" value="{{$sub->name}}"
                            >{{$sub->name}}&nbsp;&nbsp;
                        @endforeach
                        <br />
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">管理员帐号:</span>
                <input type="text" name="username" class="form-control"  />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">管理员密码:</span>
                <input type="text" name="password" class="form-control" value="123456" readonly/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">管理员邮箱:</span>
                <input type="text" name="email" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">管理员昵称:</span>
                <input type="text" name="nickname" class="form-control" />
            </div>
        </div>

    </div>
    <div class="modal-footer clearfix">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>保存</button>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>取消</button>
    </div>
</form>
@endsection
@section('my-js')
    <script type="text/javascript">
        $(function(){
            $("#form").validate({
                debug: false,
                rules: {
                    username: {required: true,},
                    email: {required: true,email:true},
                    nickname: {required: true},
                },
                messages: {
                    username: {required: '请输入用户名',},
                    email: {required: '请输入用户邮箱',email: "请输入有效的电子邮件地址",},
                    nickname: {required: '请输入用户昵称',},
                },
                submitHandler: function (form) {
                    commonAjaxSubmit();
                    return false;
                }
            });
        });
    </script>
@endsection