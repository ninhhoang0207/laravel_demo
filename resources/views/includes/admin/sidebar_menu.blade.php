<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="" class="site_title"><i class="fa fa-paw"></i> <span>System</span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="{{asset('images/user.png')}}" alt="..." class="img img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>XIN CHÀO,</span>
				<h2>Admin</h2>
			</div>
		</div>
		<!-- /menu profile quick info -->

		<br />

		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3></h3>
				<ul class="nav side-menu">
					<li><a><i class="fa fa-cogs"></i>Setting <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="#">General Setting</a></li>
						</ul>
					</li>
					@hasanyrole('admin')
					<li><a><i class="fa fa-users"></i>User <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="{{ route('admin.user.index') }}">Management</a></li>
							<li><a href="{{ route('admin.role.index') }}">Role</a></li>
							<li><a href="{{ route('admin.user.create') }}">New</a></li>
						</ul>
					</li>
					@endhasanyrole
				</ul>
			</div>
			<!-- /sidebar menu -->
		</div>
	</div>
</div>