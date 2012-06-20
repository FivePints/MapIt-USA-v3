<?= $template['partials']['backend-header']; ?>
<aside id="sidebar">
	<?= $template['partials']['backend-sidebar']; ?>
</aside>

<div id="main" role="main">
	<!-- Begin of titlebar/breadcrumbs -->
	<div id="title-bar">
		<ul id="breadcrumbs">
			<li><a href="<?php echo site_url('profile/index'); ?>" title="Home"><span id="bc-home"></span></a></li>
			<?php foreach ($template['breadcrumbs'] as $b): ?>
				<li><a href="<?= site_url($b['uri']); ?>"><?= $b['name']; ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div> <!--! end of #title-bar -->
	<div class="shadow-bottom shadow-titlebar"></div>
	<div id="main-content">
		<div class="container_12">	
			<div class="grid_12">
				<h1><?= $template['title']; ?></h1>
				<?php if ($page['announcements'] != FALSE){
					foreach ($page['announcements'] as $announcements): ?>
						<div class="admin-notice alert <?= $announcements->message_type; ?>">
							<?php if ($announcements->hideable != 0): ?><span class="hide">x</span><?php endif; ?>
							<?php if ($announcements->title != ''): ?><strong><?= $announcements->title; ?>:</strong> <?php endif;?>
							<?= $announcements->message; ?>
						</div>
					<?php endforeach; ?>
				<?php } ?>
				<?= $template['body']; ?>
			
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
<?= $template['partials']['backend-absfooter']; ?>
<script type="text/javascript">
	<?= $template['metadata']; ?>
	$(".chzn-select").chosen({width: "100%"});
</script>
</html>