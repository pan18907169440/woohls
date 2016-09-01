@extends('admin.common.master')
@section('title','修改密码')
@section('content')
<body class="skin-blue">
    <form style="margin:0px auto;padding:0px auto;" action="" class="admin-info width_60" method="post" id="form">
        {!! csrf_field() !!}
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">密码:</span>
                    <input name="password" type="password" class="form-control" placeholder="请输入原密码">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">新密码:</span>
                    <input name="newpassword" type="password"  id="newpassword" class="form-control" placeholder="请输入新密码">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">确认密码:</span>
                    <input name="checkpassword" type="password" class="form-control" placeholder="请输入确认密码">
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
                password: {required: true,minlength: 5},
                newpassword: {required: true},
                checkpassword: {required: true,minlength: 5,equalTo: "#newpassword"},
            },
            messages: {
                password: {required: '请输入原密码',minlength: "密码长度不能小于 5 个字母"},
                newpassword: {required: '请输入新密码',},
                checkpassword: {required: "请输入确认密码",minlength: "密码长度不能小于 5 个字母",equalTo: "两次密码输入不一致"},
            },
            submitHandler: function (form) {
                commonAjaxSubmit();
                return false;
            }
        });
    });
</script>
@endsection