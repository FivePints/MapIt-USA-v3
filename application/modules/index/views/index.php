<div id="mapit-total-container">
	<div id="mapit-box-shadow">
		<div id="toolbar">
			<?php if ($user != FALSE): ?>
			<div class="grid_9 alpha omega">
				<p class="toolbar-align-left"><?php if ($user['old_last_login'] == ''): ?>Welcome <?php else: ?> Welcome Back<?php endif; ?><strong> <?php echo $user['first_name']; ?></strong></p>
				<ul>
					<li><a href="<?php echo base_url(); ?>profile/index.html" target="_blank">Your Profile</a></li>
					<li><a href="<?php echo base_url(); ?>user/logout.html" target="_blank">Logout</a></li>
				</ul>
			</div>
			<?php else: ?>
			<div class="grid_9 alpha omega">
				<p class="toolbar-align-left">Welcome To <?= $mapConfig->site_name; ?></p>
				<ul>
					<li><a href="<?php echo base_url(); ?>user/login.html" target="_blank">Login</a></li>
					<li><a href="<?php echo base_url(); ?>user/register.html" target="_blank">Register</a></li>
				</ul>
			</div>
			<?php endif; ?>
			<div class="grid_3 alpha omega"><h2 id="advertisements-title">Advertisement</h2></div>
		</div>
		<div id="map_directory_sidebar" class="left-sidebar">
			<?php $this->load->view('index/templates/sidebar-left'); ?>
		</div>
			<div id="map_container" class="grid_9 alpha">
				<div id="loading">
					<div id="loading-box"><img src="<?php echo base_url(); ?>/images/loader.gif"><h3>Loading, Please Wait... </h3></div>
				</div>
				<a href="http://www.mapitusa.com" target="_blank" id="mapit-map-logo"><img src="<?= base_url('/images'); ?>/map-it-logo.png" /></a>
				<div id="map_canvas" style="width:719px; height:615px"></div>
			</div>
		<div id="map_sidebar" class="grid_3 omega">
			<?php $this->load->view('index/templates/sidebar-right'); ?>
		</div>
	</div>
</div>