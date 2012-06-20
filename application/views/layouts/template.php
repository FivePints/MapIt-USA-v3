<?php $this->load->view('admin/templates/header'); ?>
<aside id="sidebar">
	<?php $this->load->view('admin/templates/sidebar'); ?>
</aside>

<div id="main" role="main">
	<!-- Begin of titlebar/breadcrumbs -->
	<div id="title-bar">
		<ul id="breadcrumbs">
			<li><a href="<?php echo site_url('admin/index'); ?>" title="Home"><span id="bc-home"></span></a></li>
			<li class="no-hover"><?php print_r($page['page_breadcrumb']); ?></li>
		</ul>
	</div> <!--! end of #title-bar -->
	<div class="shadow-bottom shadow-titlebar"></div>
	<div id="main-content">
		<div class="container_12">	
			<div class="grid_12">				
				<h1><?php print_r($page['page_title']); ?></h1>
				<p><?php print_r($page['page_description']); ?></p>	
				<?php if ($page['announcements'] != FALSE){
					foreach ($page['announcements'] as $announcements): ?>
						<?php if ($announcements->admin_viewable == 1): ?>
							<div class="admin-notice alert <?= $announcements->message_type; ?>">
								<?php if ($announcements->hideable != 0): ?><span class="hide">x</span><?php endif; ?>
								<?php if ($announcements->title != ''): ?><strong><?= $announcements->title; ?>:</strong> <?php endif;?>
								<?= $announcements->message; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php }else{ ?>
					<div class="alert success">no current announcements</div>
				<?php } ?>
				<?php $this->load->view('admin/'.$page['page_section'].'/'.$page['page_file']); ?>
			
			</div>
		</div><!-- end container_12 -->
		<div class="clear height-fix"></div>	
	</div><!-- end main-content -->
</div><!-- end main -->

<footer id="footer"><div class="container_12">
	<div class="grid_12">
		<div class="footer-icon align-center"><a class="top" href="#top"></a></div>
	</div>
</div></footer>
</div> <!--! end of #container -->

</body>
<?php $this->load->view('admin/templates/absfooter'); ?>
<script type="text/javascript" src="http://tinymce.moxiecode.com/js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="http://tinymce.moxiecode.com/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" >
tinyMCE.init({
    theme : "advanced",
    mode : "textareas",
    editor_selector : "mceEditor"
});
</script >
<?php if (isset($page['customJs'])){
	echo '<script type="text/javascript">';
	foreach ($page['customJs'] as $customJsKey => $customJsValue){
		echo '$().ready(function() {';
		echo $customJsValue;
		echo '});';
	}
	echo '</script>';
} ?>
</html>