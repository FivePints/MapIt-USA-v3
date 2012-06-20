<div class="sidebar-item-container">
	<div class="sidebar-map-icon">
		<img src="<?php echo base_url('/images/client_images/marker_icons'); ?>/<?= $mapsPoint->p_level; ?>_sidebar_marker_icon.png" />
	</div>
	<div class="sidebar-company-container" id="sidebar-company-container-<?= $userfield['companyname']->uf_pointid ?>">
		<div class="sidebar-company-name"><a href="javascript:;"><h3 class="sidebar-company-name"><?= $userfield['companyname']->uf_fieldvalue; ?></a></a></div>
		<div class="sidebar-contact-name"><a href="mailto: <?= $userfield['email']->uf_fieldvalue; ?>"><h3 class="sidebar-contactname-name"><?= $userfield['contactname']->uf_fieldvalue; ?></a></a></div>
		<div class="sidebar-company-phone">
			<li><strong>Tel: </strong> <?= $userfield['phone1']->uf_fieldvalue; ?></li>
			<?php if ($userfield['phone2']->uf_fieldvalue != ''): ?><li><strong>Phone 2: </strong><?= $userfield['phone2']->uf_fieldvalue; ?></li><?php endif; ?>
			<?php if ($userfield['fax']->uf_fieldvalue != ''): ?><li><strong>Fax: </strong><?= $userfield['fax']->uf_fieldvalue; ?></li><?php endif; ?>
		</div>
		<?php if($mapsPoint->p_chamber == 1 && isset($userfield['website']->uf_fieldvalue)): ?>
			<div class="sidebar-website"><a href="<?= $userfield['website']->uf_fieldvalue; ?>" target="_blank"><?= $userfield['website']->uf_fieldvalue; ?></a></div>
		<?php elseif(isset($userfield['website']->uf_fieldvalue)): ?>
			<div class="sidebar-website"><a href="<?= $userfield['website']->uf_fieldvalue; ?>" target="_blank"><?= $userfield['website']->uf_fieldvalue; ?></a></div>
		<?php endif; ?>

	</div>
</div>
<div class="clear"></div>