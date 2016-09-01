@extends('admin.common.master')

@section('title','首页')

@section('content')
<body class="skin-blue">
	@include('admin.common.login')
	<div class="wrapper row-offcanvas row-offcanvas-left">
		@include('admin.common.menu')
		<aside class="right-side">
			<section class="content invoice">
				<div class="row">
					<div class="col-xs-12">
						<div class="box box-primary container">
							<div class="box-body">
								<div class="row">
									<div class="mailbox row">
										<div class="col-xs-12">
											<div class="box box-solid">
												<div class="box-body">
													<div class="row">
														<div class="col-md-3 col-sm-4" style="border: 1px solid #ddd;width:100%;">
															<div style="margin-top: 15px;" class="can">
																<ul class="nav nav-pills nav-stacked">
																	<table class='table table-mailbox'>
																		<tbody>
																			<tr class="unread">
																				<td style="color: rebeccapurple;font-weight: 600;">推送文章列表：</td>
																				<td></td>
																				<td style="color: rebeccapurple;font-weight: 600;">用户登录记录：</td>
																			</tr>
																			<tr class="unread">
																				<td>
																					<table class='table table-mailbox'>
																						<tbody>
																						<tr class="unread">
																							<td>信息标题</td>
																							<td>推送时间</td>
																						</tr>
																						@foreach($data AS $data)
																							<tr class="unread">
																								<td>
																									<li class="message" data-email-id="{{$data->email_id}}">
																										@can('/admin/message/messageRoleHistoryRead')
																											<a  style="text-decoration:underline" href="javascript:void(0);" data-url="/admin/message/messageRoleHistoryRead/{{$data->email_id}}" class="fa editform" title="{{$data->title}}">
																												{{$data->email_id}}、{{$data->title}}
																											</a>
																										@endcan
																									</li>
																								</td>
																								<td>
																									{{$data->created_at}}
																								</td>
																							</tr>
																						@endforeach
																						</tbody>
																					</table>
																				</td>
																				<td></td>
																				<td>
																					<table class='table table-mailbox'>
																						<tbody>
																						<tr class="unread">
																							<td>用户姓名</td>
																							<td>登录ip</td>
																							<td>登录时间</td>
																						</tr>
																						@foreach($user AS $user)
																							<tr class="unread">
																								<td>{{$user->nickname}}</td>
																								<td style="color: blue;">{{$user->last_login_ip}}</td>
																								<td>{{$user->last_login_time}}</td>
																							</tr>
																						@endforeach
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
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