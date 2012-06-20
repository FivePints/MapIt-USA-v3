<ul class="nav nav-list">
	<li class="nav-header">Navigation</li>
	<li><a class="current" href="<?php echo site_url('/admin/index'); ?>">Home</a></li>
	<div class="divider"></div>

	<li class="nav-header">User Management</li>
		<li><a href="<?php echo site_url('/admin/user/index'); ?>">Manage Users</a></li>
		<li><a href="<?php echo site_url('/admin/user/adduser'); ?>">Add New User</a></li>
	<div class="divider"></div>

	<li class="nav-header">Map Management</li>
		<li><a href="<?php echo site_url('/admin/map/addpoint'); ?>">Add New Map Points</a></li>
		<li><a href="<?php echo site_url('/admin/map/index'); ?>">Manage Map Points</a></li>
	<div class="divider"></div>

	<?php if( $mapConfig->events == 1 ): ?>
	<li class="nav-header">Event Management</li>
		<li><a href="<?php echo site_url('/admin/events/add'); ?>">Add New Event</a></li>
		<li><a href="<?php echo site_url('/admin/events/index'); ?>">Manage Events</a></li>
		<div class="divider"></div>
	<?php endif; ?>

	<li class="nav-header">Category Management</li>
	<li><a href="<?php echo site_url('/admin/categories/add'); ?>">Add Categories</a></li>
	<li><a href="<?php echo site_url('/admin/categories/index'); ?>">Manage Categories</a></li>
	<div class="divider"></div>

	<li class="nav-header">Communication</li>
		<li><a href="<?php echo site_url('/admin/email'); ?>">Send Email By Category</a></li>
		<li><a href="<?php echo site_url('/admin/email'); ?>">Send Email By Business Name</a></li>
	<li class="nav-header">Notices</li>
		<li><a href="<?php echo site_url('/admin/notices/add'); ?>">Add Notice</a></li>
	<div class="divider"></div>

	<li class="nav-header">Advertisement Management</li>
		<li><a href="<?php echo site_url('/admin/advertisements/index'); ?>">Manage Advertisements</a></li>
		<li><a href="<?php echo site_url('/admin/advertisements/add'); ?>">Add Advertisement</a></li>

	<?php if ( $this->ion_auth->in_group('superadmin') ): ?>
	<div class="divider"></div>
	<li class="nav-header">Administration</li>
		<li><a href="<?php echo site_url('/admin/config'); ?>">Configuration</a></li>
		<li><a href="<?php echo site_url('/admin/developer/db'); ?>">Database Management</a></li>
	<?php endif; ?>
</ul>