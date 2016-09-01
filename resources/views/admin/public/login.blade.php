@extends('admin.common.master')
@section('title','登录')
@section('content')
<body class="skin-blue" style="background:#000;">
	<div class="form-box" id="login-box">
		<div class="header">登录</div>
		<form action="" method="post" id="form">
			{!! csrf_field() !!}
			<div class="body bg-gray">
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="用户名"/>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="密码"/>
				</div>
				<div class="form-group">
					<input type="text" class="form-control col-md-6 v-c-input" placeholder="验证码" name="validate_code" style="width:50%;">
					&nbsp;&nbsp;&nbsp;
					<img style="height:34px;border:1px solid green;" src="/service/validate_code/create"  title="看不清？单击此处刷新" onclick="this.src+='?rand='+Math.random();"  style="cursor: pointer; vertical-align: middle;"/>
				</div>
			</div>
			<div class="footer">                                                               
				<input type="submit" class="btn bg-olive btn-block" value="登录">
			</div>
		</form>

	</div>

@endsection
@section('my-js')
<script type="text/javascript">
$(function(){
	$("#form").validate({
		debug: false,
		rules: {
			username: {required: true,},
			validate_code: {required: true,},
			password: {required: true},
		},
		messages: {
			username: {required: '请输入登录名称',},
			validate_code: {required: '请输入验证码',},
			password: {required: '请输入登录密码',},
		},
		submitHandler: function (form) {
			commonAjaxSubmit();
			return false;
		}
	});
});
</script>
@endsection