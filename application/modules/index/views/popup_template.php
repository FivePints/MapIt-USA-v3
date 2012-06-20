<?php if($mapsPoint->p_chamber == 1): ?>
<div class="popupChamber">
	<span class="popupChamberClick">
		<div class="popupChamberIcon" onclick="chamberClickFunction();">
			>
		</div>
	</span>
	<div class="chamberLogo">
		<div class="chamber-logo chamber-logo_level<?= $mapsPoint->p_level; ?>" style="background: url(<?php echo base_url('images/client_images/'); ?>/chamber-logo.png) no-repeat; height:64px; margin-left:16px;"></div>
	</div>
</div>
<?php endif; ?>

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
					<a href="<?= $userfield['youtube']->uf_fieldvalue; ?>" target="_blank"><img src="<?php echo base_url('images/'); ?>/youtube.png" border="0"/></a>
				<?php endif; ?>
				<?php if ($userfield['facebook']->uf_fieldvalue != '') : ?>
					<a href="<?= $userfield['facebook']->uf_fieldvalue; ?>" target="_blank"><img src="<?php echo base_url('images/'); ?>/facebook.png" border="0"/></a>
				<?php endif; ?>
				<?php if ($userfield['twitter']->uf_fieldvalue != '') : ?>
					<a href="<?= $userfield['twitter']->uf_fieldvalue; ?>" target="_blank"><img src="<?php echo base_url('images/'); ?>/twitter.png" border="0"/></a>
				<?php endif; ?>
				<?php if ($userfield['linkedin']->uf_fieldvalue != '') : ?>
					<a href="<?= $userfield['linkedin']->uf_fieldvalue; ?>" target="_blank"><img src="<?php echo base_url('images/'); ?>/linkedin.png" border="0"/></a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="company-container company-container_level<?= $mapsPoint->p_level; ?>" id="company-container-<?= $userfield['companyname']->uf_pointid ?>">
		<?php if (isset($userfield["youtubevideo"]) && $userfield["youtubevideo"]->uf_fieldvalue != '') : ?>
			<div class="company-youtubevideo">
				<?= $userfield['youtubevideo']->uf_html; ?>
			</div>
		<?php endif; ?>
		<div class="company-name company-name_level<?= $mapsPoint->p_level; ?>">
			<?= $userfield['companyname']->uf_html; ?>
		</div>
		<div class="contact-name contact-name_level<?= $mapsPoint->p_level; ?>">
			<?= $userfield['contactname']->uf_html; ?>
		</div>
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
		<div class="contact-email contact-email_level<?= $mapsPoint->p_level; ?>">
			<strong>Email:</strong> <?= $userfield['email']->uf_html; ?>
		</div>
		<?php if (isset($userfield['website']->uf_fieldvalue) && $userfield['website']->uf_html != '') : ?>
			<div class="website website_level<?= $mapsPoint->p_level; ?>">
				<strong>Website:</strong> <?= $userfield['website']->uf_html; ?>
			</div>
		<?php endif;  ?>
	</div>
</div>