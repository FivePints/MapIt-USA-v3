<div id="search-bar">
</div> <!--! end of #search-bar -->
<!-- Begin of #login-details -->
<section id="login-details">
	<img class="img-left framed" src="<?php if ($user['avatar'] == ''){ echo '/images/avatar_placeholder.gif'; }else{ echo base_url('/uploads/').'/'.$user['avatar']; } ?>" alt="Hello <?php echo $user['firstname']; ?>">
	<h3>Logged in as</h3>
	<h2><a class="user-button" href="javascript:void(0);"><?php echo $user['username']; ?>&nbsp;<span class="arrow-link-down"></span></a></h2>
	<ul class="dropdown-username-menu">
		<li><a href="<?php echo base_url('user/logout'); ?>">Logout</a></li>
	</ul>
	   
	<div class="clearfix"></div>
	</section> <!--! end of #login-details -->

<!-- Begin of Navigation -->
<nav id="nav">
	<ul class="menu collapsible shadow-bottom">
		<li><a class="current" href="<?php echo site_url('/admin/index'); ?>">Home</a></li>
		<li><a href="javascript:void(0);">User Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/user/index'); ?>">Manage Users</a></li>
				<li><a href="<?php echo site_url('/admin/user/adduser'); ?>">Add New User</a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0);">Map Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/map/addpoint'); ?>">Add New Map Points</a></li>
				<li><a href="<?php echo site_url('/admin/map/index'); ?>">Manage Map Points</a></li>
			</ul>
		</li>
		<?php if( $mapConfig->events == 1 ): ?>
		<li><a href="javascript:void(0);">Event Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/events/add'); ?>">Add New Event</a></li>
				<li><a href="<?php echo site_url('/admin/events/index'); ?>">Manage Events</a></li>
			</ul>
		</li>
		<?php endif; ?>
		<li><a href="javascript:void(0);">Category Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/categories/add'); ?>">Add Categories</a></li>
				<li><a href="<?php echo site_url('/admin/categories/index'); ?>">Manage Categories</a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0);">Communication</a>
			<ul class="sub">
				<li><a href="#">Mass Email</a>
					<ul class="sub">
						<li><a href="<?php echo site_url('/admin/email/bycategory'); ?>">By Category</a></li>
					</ul>
				</li>
				<li><a href="#">Notices
					<ul class="sub sub">
						<li><a href="<?php echo site_url('/admin/notices/add'); ?>">Add Notice</a></li>
						<!-- <li><a href="<?php echo site_url('/admin/notices/index'); ?>">Manage Notices</a></li> -->
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="javascript:void(0);">Advertisement Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/advertisements/index'); ?>">Manage Advertisements</a></li>
				<li><a href="<?php echo site_url('/admin/advertisements/add'); ?>">Add Advertisement</a></li>
			</ul>
		</li>
		<?php if ($user['userlevel'] >= 3): ?>
<!-- 		<li><a href="javascript:void(0);">Level Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/levels/index'); ?>">Manage Levels</a></li>
				<li><a href="<?php echo site_url('/admin/levels/addlevel'); ?>">Add Level</a></li>
			</ul>
		</li> -->
		<li><a href="#">Administration</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/admin/config'); ?>">Configuration</a></li>
				<li><a href="<?php echo site_url('/admin/developer'); ?>">Developer Toolbox</a>
					<ul class="sub">
						<li><a href="<?php echo site_url('/admin/developer/db'); ?>">Database Management</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<?php endif; ?>
	</ul>
</nav> <!--! end of #nav -->