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
		<li><a class="current" href="<?php echo site_url('/profile/index'); ?>">Home</a></li>
<!-- 		<li><a href="javascript:void(0);">Map Management</a>
			<ul class="sub">
				<li><a href="<?php echo site_url('/profile/map/addpoint'); ?>">Add New Map Points</a></li>
				<li><a href="<?php echo site_url('/profile/map/index'); ?>">Manage Map Points</a></li>
			</ul>
		</li> -->
	</ul>
	<div style="text-align:center; margin:0 auto;"><object style="height: 200px; width: 240px"><param name="movie" value="https://www.youtube.com/v/g_5wek90KQs?version=3&feature=player_embedded"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="https://www.youtube.com/v/g_5wek90KQs?version=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="240" height="200"></object></div>
</nav> <!--! end of #nav -->