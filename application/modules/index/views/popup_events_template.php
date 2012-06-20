<div class="popup-container popup-container_level<?= $mapsPoint->p_level; ?>">
	<?php if (isset($userfield['logo']->uf_fieldvalue) && $userfield['logo']->uf_html != '') : ?>
		<div class="logo-container" id="logo-container-<?= $userfield['logo']->uf_pointid ?>">
			<div class="logo">
				<?php if ($userfield['logo']->uf_fieldvalue == 'jquery'): ?>
					<?= $userfield['logo']->uf_html; ?>
				<?php else: ?>
					<img src="<?php echo base_url('/uploads').'/'.$mapsPoint->p_id.'/'.$userfield['logo']->uf_fieldvalue; ?>" border="0"/>
				<?php endif; ?>
			</div>
			<div class="social-media-container social-media-container_level<?= $mapsPoint->p_level; ?>">
				<?php if ($userfield['youtube']->uf_fieldvalue != '') : ?>
					<a href="http://www.youtube.com/user/GilbertFarmersMarket/videos" target="_blank"><img src="<?php echo base_url('images/'); ?>/youtube.png" border="0"/></a>
				<?php endif; ?>
				<?php if ($userfield['facebook']->uf_fieldvalue != '') : ?>
					<a href="http://www.facebook.com/pages/Gilbert-Farmers-Market/148632281837954" target="_blank"><img src="<?php echo base_url('images/'); ?>/facebook.png" border="0"/></a>
				<?php endif; ?>
				<?php if ($userfield['twitter']->uf_fieldvalue != '') : ?>
					<a href="https://twitter.com/GilbertMarket" target="_blank"><img src="<?php echo base_url('images/'); ?>/twitter.png" border="0"/></a>
				<?php endif; ?>
			</div>
			<?php if($mapsPoint->p_level > 3 && $mapsPoint->p_chamber == 1): ?>
				<div class="chamber-logo chamber-logo_level<?= $mapsPoint->p_level; ?>">
					<img src="<?php echo base_url('images/client_images/'); ?>/chamber-logo.png" />
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="event-container">
		<p><strong>Event Name: </strong><?= $mapsPoint->p_event_text_short; ?></p>
		<p><strong>Start Date/Time: </strong><?= $mapsPoint->p_start_time; ?></p>
		<p><strong>End Date/Time: </strong><?= $mapsPoint->p_expire_time; ?></p>
		<p><strong>Description: </strong><?= $mapsPoint->p_event_text_long; ?></p>
	</div>
	<div class="company-container company-container_level<?= $mapsPoint->p_level; ?>" id="company-container-<?= $userfield['companyname']->uf_pointid ?>">
		<?php if (isset($userfield["youtubevideo"]) && $userfield["youtubevideo"]->uf_fieldvalue != '') : ?>
			<div class="company-youtubevideo">
				<div class="youtube-popup">
					<iframe width="246" height="125" src="http://www.youtube.com/embed/lLU0a-6Qp28" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		<?php endif; ?>
			<div class="company-name company-name_level<?= $mapsPoint->p_level; ?>">
				<?= $userfield['companyname']->uf_html; ?>
			</div>
			<div class="float-left">
				<div class="address address_level<?= $mapsPoint->p_level; ?>">
				<address>
				<?php if ($mapsPoint->p_home_business == 0): ?>
					<?= $userfield['address1']->uf_html; ?><br>
					<?php if (isset($userfield['address2']->uf_fieldvalue) && $userfield['address2']->uf_html != ''){ echo $userfield['address2']->uf_html.'<br>'; } ?>
				<?php endif; ?>
					<?= $userfield['city']->uf_html ?>, <?= $userfield['state']->uf_html; ?> <?= $userfield['zip']->uf_html; ?>
				</address>
				</div>
				<div class="company-phone company-phone_level<?= $mapsPoint->p_level; ?>">
					<li><strong>Phone:</strong> <?= $userfield['phone1']->uf_html; ?></li>
					<?php if (isset($userfield['phone2']->uf_fieldvalue) && $userfield['phone2']->uf_html != ''){ echo '<li>
						<strong>Phone 2:</strong> '.$userfield['phone2']->uf_html.'</li>'; } ?>
					<?php if (isset($userfield['fax']->uf_fieldvalue) && $userfield['fax']->uf_html != ''){ echo '<li>
						<strong>Fax:</strong> '.$userfield['fax']->uf_html.'</li>'; } ?>
				</div>
			<div style="clear:both;"></div>
			<div class="contact-email contact-email_level<?= $mapsPoint->p_level; ?>">
				<strong>Email:</strong> <?= $userfield['email']->uf_html; ?>
			</div>
			<?php if (isset($userfield['website']->uf_fieldvalue) && $userfield['website']->uf_html != '') : ?>
				<div class="website website_level<?= $mapsPoint->p_level; ?>">
					<strong>Website:</strong> <?= $userfield['website']->uf_html; ?>
				</div>
			<?php endif;  ?>
		<div class="chamber-directions-container chamber-directions-container_level<?= $mapsPoint->p_level; ?>">
<!-- 			<div class="get-directions get-directions_level<?= $mapsPoint->p_level; ?>">
				<a href="#">Get Directions</a>
			</div> -->
			<?php if($mapsPoint->p_chamber == 1 && $mapsPoint->p_level <= 3): ?>
			<div class="chamber-logo chamber-logo_level<?= $mapsPoint->p_level; ?>">
				<img src="<?php echo base_url('images/client_images/'); ?>/chamber-logo.png" />
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>