@extends('admin.common.master')
@section('title','管理员列表')
@section('content')
<body class="skin-blue">
@include('admin.common.login')
<div class="wrapper row-offcanvas row-offcanvas-left">
	@include('admin.common.menu')
	<aside class="right-side">
		<section class="content-header">
			<h1>
				用户管理
				<small>User management</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">member</li>
			</ol>
		</section>
		<section class="content invoice">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary container">
						<div class="box-body">
							<div class="row">
								<div class="">
									<div class="row pad">
										<div class="col-sm-6">
											<div class="btn-group">
												@can('/admin/admin/addAdmin')
												<button type="button" class="btn btn-primary editform" data-url="/admin/admin/addAdmin" title="添加">添加
												</button>
												@endcan
											</div>
										</div>
										<div class="col-sm-6 search-form">
											<form action="#" class="text-right">
												<div class="input-group">
													<input type="text" class="form-control input-sm" placeholder="Search">
													<div class="input-group-btn">
														<button type="submit" name="q" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
													</div>
												</div>
											</form>
										</div>
									</div>

									<div class="table-responsive">
										<table class="table table-mailbox table-bordered table-striped">
											<thead>
											<tr>
												<th>ID</th>
												<th>用户名</th>
												<th>用户昵称</th>
												<th>用户email</th>
												<th>状态</th>
												<th>添加时间</th>
												<th>操作</th>
											</tr>
											</thead>
											<tbody>
											@foreach($data AS $data)
											<tr class="unread">
												<td class="small-col">{{$data->id}}</td>
												<td class="small-col">{{$data->username}}</td>
												<td class="small-col">{{$data->nickname}}</td>
												<td class="name">{{$data->email}}</td>
												<td class="subject">
													@if($data->status == 1)
														<b style="color:green;">开启</b>
													@else
														<b style="color:red;">关闭</b>
													@endif
												</td>
												<td class="time">{{$data->created_at}}</td>
												<td class="operation">
													@can('/admin/admin/adminStatus')
														@if($data->status == 1)
														<a href="javascript:void(0);" data-url="/admin/admin/adminStatus/{{$data->id}}/2" class="fa fa-hand-o-down ajaxRequest" title="停用" ></a>
														@else
														<a href="javascript:void(0);" data-url="/admin/admin/adminStatus/{{$data->id}}/1" class="fa fa-hand-o-up ajaxRequest" title="启用" ></a>
														@endif
													@endcan

													@can('/admin/admin/editAdmin')
													<a href="javascript:void(0);" class="fa fa-edit editform" data-url="/admin/admin/editAdmin/{{$data->id}}" title="编辑"></a>
													@endcan

													@can('/admin/admin/editAdminPwd')
													<a href="javascript:void(0);" class="fa fa-key editform" data-url="/admin/admin/editAdminPwd/{{$data->id}}" title="修改密码"></a>
													@endcan

													@can('/admin/admin/deleteAdmin')
													<a href="javascript:void(0);" data-url="/admin/admin/deleteAdmin/{{$data->id}}" class="fa fa-trash-o ajaxRequest"  title="删除" ></a>
													@endcan
												</td>
											</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer clearfix">
							<div class="pull-right">
								{{$page}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</aside>
</div>
@endsection
@section('my-js')

@endsection