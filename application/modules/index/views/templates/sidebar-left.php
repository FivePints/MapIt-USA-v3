<div id="map_sidebar_controls_container">
	<!-- START LEFT SIDEBAR CONTAINERS -->
	<div class="containerWrapper">
		<!-- START BROWSE DIRECTORY CONTAINER -->
		<div id="browse-directory-container" class="left_sidebar_control">
			<section id="search-sidebar">
				<div class="title-container">
					<div id="directory_title_step1" class="directory-titles_sprite"></div>
					<h1>Search By Business Name</h1>
					<p>If you know the business name you are searching for, type it in the text field below and press the enter key</p>
				</div>
				<div style="clear:both;"></div>
				<form id="search-directory-form" method="post" action="#">
					<input type="hidden" name="search-by-companyname-list_id" id="search-by-companyname-list_id" />
					<!-- <input type="text" name="search-by-companyname" id="search-by-companyname" value="" placeholder="Search By Company Name..."> -->
					<div id="companyname-list">
						<input type="text" class="chzn-select" id="search-by-companyname-list"placeholder="Enter A Business Name..." />
					</div>
				</form>
			</section>
			<hr class="or-seperator" />
			<section id="browse-by-category">
				<form id="categoryList" method="post">
					<div class="title-container">
						<div id="directory_title_step2" class="directory-titles_sprite"></div>
						<h1>Search By Category</h1>
						<p>Pick a business category from the list below to see all businesses in your area</p>
					</div>
					<div style="clear:both;"></div>
					<ul>
						<?php foreach ($categories as $c): ?>
							<li><input type="checkbox" name="category-<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>" placeholder="" id="category-<?php echo $c['id']; ?>" class="category"> <?php echo $c['category_name']; ?></li>
						<?php endforeach; ?>
					</ul>
				</form>
			</section>
			<div class="sidebar-search-buttons">
				<input type="reset" name="reset" value="Reset The Map" id="reset" class="btn-yellow" />
			</div>
		</div>
		<!-- END BROWSE DIRECTORY CONTAINER -->
		<?php if ($mapConfig->events == 1): ?>
		<!-- START EVENT DIRECTORY CONTAINER -->
		<div id="event-guru-container" class="left_sidebar_control">
			<section>
				<div style="height: 615px;">
				<div class="title-container">
					<div id="events_title-step1" class="events-titles_sprite"></div>
					<h1>Select Date(s)</h1>
					<p>Pick when you would like to goto an event, you can select multiple days by dragging. Use the color scale to determine the number of events per day.</p>
				</div>
				<div style="clear:both;"></div>
				<form id="search-events-form" method="post" action="index/process/events.html">
					<input type="hidden" name="date-picked" id="date-picked" />
					<div id="eventdate"></div>
					<div id="event-date-slider">
						<!-- <img src="<?= base_url(); ?>images/events_gradient_slider.png"> -->
					</div>
						<div class="title-container">
							<div id="events_title-step2" class="events-titles_sprite"></div>
							<h1>Pick An Event Category</h1>
							<p>Pick one or more event categories, by first selecting a parenty category.</p>
						</div>
						<div style="clear:both;"></div>
					<div class="companyname-list">
						<ul name="events-categories" id="events-categories">
							<li><input type="checkbox" value="" placeholder="" id="events-check-all">CHECK ALL</li>
							<?php foreach ($event_categories as $ec): ?>
								<li><input type="checkbox" name="category-events" value="<?php if( isset($ec['children']) && !empty($ec['children']) ): echo $ec['id']; endif; ?>" placeholder="" id="category-<?php echo $ec['id']; ?>" class="events-category"> <?php echo $ec['category_name']; ?>
									<?php if( isset($ec['children']) && !empty($ec['children']) ): ?>
									<ul class="event-children">
										<li><input type="checkbox" name="child-category-all" value="" class="events-child-category-all">ALL</li>
										<?php foreach($ec['children'] as $children): ?>
										<li><input type="checkbox" name="child-category-<?= $children['id']; ?>" value="<?= $children['id']; ?>" id="child-category-<?= $children['id']; ?>" class="child events-child-category"><?= $children['category_name']; ?></li>
										<?php endforeach; ?>
									</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="sidebar-search-buttons">
						<input type="submit" name="event-submit" id="event-submit" value="Submit Search" class="btn-green" />
					</div>
				</form>
				</div>
			</section>
		</div>
		<!-- END EVENT DIRECTORY CONTAINER -->
		<?php endif; ?>
		<?php if ($mapConfig->deals == 1): ?>
		<!-- START DEALS DIRECTORY CONTAINER -->
		<div id="deals-container" class="left_sidebar_control">
			<section id="search-sidebar">
				<div class="title-container">
					<div id="deals_title-step1" class="directory-titles_sprite"></div>
					<h1>Search By Business Name</h1>
					<p>If you know the business name you are searching for, type it in the text field below and press the enter key</p>
				</div>
				<div style="clear:both;"></div>

				<form id="search-deals-form" method="post" action="#">
					<input type="hidden" name="search-by-companyname-list_id" id="search-by-companyname-list_id" />
					<!-- <input type="text" name="search-by-companyname" id="search-by-companyname" value="" placeholder="Search By Company Name..."> -->
					<div class="companyname-list">
						<input type="text" class="chzn-select" id="search-by-deals-list" />
					</div>
				</form>
			</section>
			<hr class="or-seperator" />
			<section id="deals-browse-by-category">
				<form id="deals-categoryList" method="post">
					<div class="title-container">
						<div id="deals_title-step2" class="directory-titles_sprite"></div>
						<h1>Search For Deals By Category</h1>
						<p>Pick a business category from the list below to see all businesses in your area that currently have deals.</p>
					</div>
					<div style="clear:both;"></div>

					<ul>
						<?php foreach ($deal_categories as $c): ?>
							<li><input type="checkbox" name="category-<?php echo $c['id']; ?>" value="<?php echo $c['id']; ?>" placeholder="" id="category-<?php echo $c['id']; ?>" class="deals-category"> <?php echo $c['category_name']; ?></li>
						<?php endforeach; ?>
					</ul>
				</form>
			</section>
			<div class="sidebar-search-buttons">
				<input type="reset" name="reset" value="Reset The Map" id="reset" class="btn-yellow" />
			</div>
		</div>
		<!-- END DEALS DIRECTORY CONTAINER -->
		<?php endif; ?>
		<!-- START INFO DIRECTORY CONTAINER -->
		<!-- END INFO DIRECTORY CONTAINER -->
	</div>
	<!-- END LEFT SIDEBAR CONTAINERS -->
	<div class="buttontWrapper">
		<!-- START BROWSE DIRECTORY BUTTON -->
		<div id='directory-button-container' class='left_sidebar_button_container'>
			<img src="<?= base_url(); ?>/images/map_buttons/directory-directory.png" class="button" id="directory-directory" />
		</div>
		<!-- END BROWSE DIRECTORY BUTTON -->

		<?php if ($mapConfig->events == 1): ?>
		<!-- START EVENTS DIRECTORY BUTTON -->
		<div id='event-guru-button-container' class="left_sidebar_button_container">
			<img src="<?= base_url(); ?>/images/map_buttons/directory-events.png" class="button" id="directory-events" />
		</div>
		<!-- END EVENTS DIRECTORY BUTTON -->
		<?php endif; ?>

		<?php if ($mapConfig->deals == 1): ?>
		<!-- START DEALS DIRECTORY BUTTON -->
		<div id='deals-button-container' class="left_sidebar_button_container">
			<img src="<?= base_url(); ?>/images/map_buttons/directory-deals.png" class="button" id="directory-deals" />
		</div>
		<!-- END DEALS DIRECTORY BUTTON -->
		<?php endif; ?>

		<div id="info-button-container" class="left_sidebar_button_container">
			<img src="<?= base_url(); ?>/images/map_buttons/directory-information.png" class="read-more-popup" id="directory-information" />

		</div>
	</div>
</div>