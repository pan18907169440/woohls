<header class="header">
	<a href="/admin/index/index" class="logo">
		<span>医互联信息管理</span>
	</a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="dropdown messages-menu">
					@if(!empty($message_count))
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="label label-success">{{$message_count}}</span>
					</a>
					@else
					<a href="/admin/message/messageRoleHistory" class="dropdown-toggle">
						<i class="fa fa-envelope"></i>
					</a>
					@endif
					@if(!empty($message_count))
					<ul class="dropdown-menu">
						<li>
							<ul style="margin-left: 20px;">
								<br />
								@foreach($message_data AS $data)
								<li>&nbsp;&nbsp;&nbsp;
									<a style="text-decoration:underline;color:blue;" href="javascript:void(0);" data-url="/admin/message/messageRoleHistoryRead/{{$data->message_id}}" class="fa editform" title="{{$data->title}}">{{$data->title}}</a>&nbsp;&nbsp;&nbsp;
									<small><i class="fa fa-clock-o"></i> {{$data->created_at}}</small>
								</li>
								<br />
								@endforeach
							</ul>
						</li>
						<li class="footer"><a href="/admin/message/messageRoleHistory" style="text-decoration:underline;color:blue;">查看所有</a></li>
					</ul>
					@endif
				</li>

				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-user"></i>
						<span>
							@if(!empty(session('user')))
								{{session('user')->username}}
							@endif
							<i class="caret"></i></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header bg-light-blue">
							<img src="/admin/img/avatar3.png" class="img-circle" alt="User Image" />
							<p>@if(!empty(session('user')))
									{{session('user')->username}}
							   @endif
							</p>
						</li>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-right">
								<a href="/admin/public/logout" class="btn btn-default btn-flat">退出</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>