		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<ul class="sidebar-menu">
					@foreach($menu AS $menu)
						@can($menu->name)
					<li class="treeview
					@if($now_menu == $menu->name)
							active
					@endif
					">
						<a href="javascript:void(0);">
							<i class="fa {{$menu->icon}}"></i> <span>{{$menu->display_name}}</span><i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							@foreach($menu->sub AS $sub)
								@can($sub->name)
							<li @if($sub_menu == $sub->name)
								class="active"
								@endif
							><a href="{{$sub->name}}"><i class="fa fa-angle-double-right"></i>{{$sub->display_name}}</a></li>
								@endcan
							@endforeach
						</ul>
					</li>
						@endcan
					@endforeach

					<li class="treeview">
						<a href="javascript:void(0);">
							<i class="fa fa-gears"></i> <span>系统管理</span><i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li><a href="/admin/public/logout"><i class="fa fa-angle-double-right"></i>退出</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>