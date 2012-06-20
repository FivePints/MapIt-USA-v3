<section id="advertisement">
	<div class="advertisement-content" class="sidebar-container">
		<?php foreach ($advertisement as $a): ?>
			<?= $a; ?>
		<?php endforeach; ?>
	</div>
</section>
	<section id="map-legend-container">
		<div id="map-legend-title">
			<div id="map-legend-button" class="icon-white icon-chevron-up">x</div>
			<h2>Map Legend</h2>
		</div>
		<div id="map-legend-content" class="sidebar-container">
			<div id="legend-level1" class="legend-item">
				<img src="<?php echo base_url(); ?>images/client_images/marker_icons/1_sidebar_marker_icon.png">
				<p class="legend-title"><strong>Starter</strong> (Level 1):</p>
				<a href="#" class="read-more-popup">read more</a>
				<p class="legend-description">Business contact information + e-mail</p>
			</div>
			<div id="legend-level2" class="legend-item">
				<img src="<?php echo base_url(); ?>images/client_images/marker_icons/2_sidebar_marker_icon.png">
				<p class="legend-title"><strong>Standard</strong> (Level 2):</p> 
				<a href="#" class="read-more-popup">read more</a>
				<p class="legend-description">Business contact information + e-mail + web link + logo + Social Media links</p>
			</div>
			<div id="legend-level3" class="legend-item">
				<img src="<?php echo base_url(); ?>images/client_images/marker_icons/3_sidebar_marker_icon.png">
				<p class="legend-title"><strong>Premium</strong> (Level 3):</p> 
				<a href="#" class="read-more-popup">read more</a>
				<p class="legend-description">Business contact information + e-mail + web link + logo + Social Media links + Facebook Feed + Special Offers</p>
			</div>
			<div id="legend-level4" class="legend-item">
				<img src="<?php echo base_url(); ?>images/client_images/marker_icons/4_sidebar_marker_icon.png">
				<p class="legend-title"><strong>Plus</strong> (Level 4):</p>
				<a href="#" class="read-more-popup">read more</a>
				<p class="legend-description">Business contact information + e-mail + web link + logo + Social Media links + Facebook Feed + Special Offers + Video</p>
			</div>
		</div>
	</section>
	<section id="our-members-container">
		<h2>Listings</h2>
		<div id="map_items" class="sidebar-container">
			<div id="sidebar-loading">
				<div id="sidebar-loading-box"><img src="<?php echo base_url(); ?>/images/loader_darkbg.gif"><h3>Loading, Please Wait... </h3></div>
			</div>
		</div>
	</section>