<?php
/**
 * Form Field attribute settings
 * @author Mike DeVita
 */
$sitetitle = array(
	'name' => 'sitetitle',
	'id' => 'sitetitle',
	'title' => 'This is the title',
	'value' => $mapConfig->site_title,
	'size' => 30
);
$sitename = array(
	'name' => 'sitename',
	'id' => 'sitename',
	'value' => $mapConfig->site_name,
	'size' => 30
);
$markerIcon = array(
	'name' => 'markerIcon',
	'id' => 'markerIcon',
	'value' => $mapConfig->marker_icon,
	'size' => 30
);
$apiKey = array(
	'name' => 'apiKey',
	'id' => 'apiKey',
	'value' => $mapConfig->api_key,
	'size' => 30
);
$tabTitle = array(
	'name' => 'tabTitle',
	'id' => 'tabTitle',
	'value' => $mapConfig->tab_title,
	'size' => 30
);
$defaultZoom = array(
	'name' => 'defaultZoom',
	'id' => 'defaultZoom',
	'value' => $mapConfig->default_zoom,
	'size' => 30
);
$defaultMapId = array(
	'name' => 'defaultMapId',
	'id' => 'defaultMapId',
	'value' => $mapConfig->default_map_id,
	'size' => 30
);
$defaultMapType = array(
	'name' => 'defaultMapType',
	'id' => 'defaultMapType',
	'value' => $mapConfig->default_map_type,
	'size' => 30
);
$default_email_from_name = array(
	'name' => 'default_email_from_name',
	'id' => 'default_email_from_name',
	'value' => $mapConfig->default_send_from_name,
	'size' => 30
);
$default_email_from_address = array(
	'name' => 'default_email_from_address',
	'id' => 'default_email_from_address',
	'value' => $mapConfig->default_send_from_email,
	'size' => 30
);
$defaultLat = array(
	'name' => 'defaultLat',
	'id' => 'defaultLat',
	'value' => $mapConfig->default_lat,
	'size' => 30
);
$defaultLng = array(
	'name' => 'defaultLng',
	'id' => 'defaultLng',
	'value' => $mapConfig->default_lng,
	'size' => 30
);
$activationKey = array(
	'name' => 'activationKey',
	'id' => 'activationKey',
	'value' => $mapConfig->activationkey,
	'size' => 30
);
$enableevents = array(
	'name' => 'enableevents',
	'id' => 'enableevents',
	'value' => $mapConfig->events,
	'size' => 30
);
$enabledeals = array(
	'name' => 'enabledeals',
	'id' => 'enabledeals',
	'value' => $mapConfig->deals,
	'size' => 30
);
$activationKey = array(
	'name' => 'activationKey',
	'id' => 'activationKey',
	'value' => $mapConfig->activationkey,
	'size' => 30
);
?>
	<div class="block-border">
		<div class="block-header"><h1>Edit Configuration</h1></div>
		<form method="POST" action="/admin/config/processconfig.html" id="config-form" class="block-content form">
			<div class="_50">
				<div class="_50">
					<p><?php echo form_label('Site Title', $sitetitle['id']); ?><?php echo form_input($sitetitle); ?></p>
					<?php echo form_error($sitetitle['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Site Name', $sitename['id']); ?><?php echo form_input($sitename); ?></p>
					<?php echo form_error($sitename['id']); ?>	
				</div>
				<div class="_50">
					<p><?php echo form_label('Default Email From Name', $default_email_from_name['id']); ?><?php echo form_input($default_email_from_name); ?></p>
					<?php echo form_error($default_email_from_name['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Default From Email Address', $default_email_from_address['id']); ?><?php echo form_input($default_email_from_address); ?></p>
					<?php echo form_error($default_email_from_address['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Marker Icon', $markerIcon['id']); ?><?php echo form_input($markerIcon); ?></p>
					<?php echo form_error($markerIcon['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Default Zoom', $defaultZoom['id']); ?><?php echo form_input($defaultZoom); ?></p>
					<?php echo form_error($defaultZoom['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Primary Tab Title', $tabTitle['id']); ?><?php echo form_input($tabTitle); ?></p>
					<?php echo form_error($tabTitle['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Default Latitude', $defaultLat['id']); ?><?php echo form_input($defaultLat); ?></p>
					<?php echo form_error($defaultLat['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Default Longitude', $defaultLng['id']); ?><?php echo form_input($defaultLng); ?></p>
					<?php echo form_error($defaultLng['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Map Container ID', $defaultMapId['id']); ?><?php echo form_input($defaultMapId); ?></p>
					<?php echo form_error($defaultMapId['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Default Map Type', $defaultMapType['id']); ?>
					<select name="defaultMapType" id="defaultMapType" class="chzn-select">
						<option value="ROADMAP">ROADMAP</option>
						<option value="SATELLITE">SATELLITE</option>
						<option value="HYBRID">HYBRID</option>
						<option value="TERRAIN">TERRAIN</option>
					</select>					
					</p>
					<?php echo form_error($defaultMapType['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Enable Events', $enableevents['id']); ?></p>
					<p><select name="events" id="enable-events">
						<option value="1" <?php if ($mapConfig->events == 1){ echo 'selected="selected"'; } ?>>Yes</option>
						<option value="0" <?php if ($mapConfig->events == 0){ echo 'selected="selected"'; } ?>>No</option>
					</select></p>
					<?php echo form_error($enableevents['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Enable Deals', $enabledeals['id']); ?></p>
					<p><select name="deals" id="enable-deals">
						<option value="1" <?php if ($mapConfig->deals == 1){ echo 'selected="selected"'; } ?>>Yes</option>
						<option value="0" <?php if ($mapConfig->deals == 0){ echo 'selected="selected"'; } ?>>No</option>
					</select></p>
					<?php echo form_error($enabledeals['id']); ?>
				</div>
			</div>
			<div class="_50">
				<div class="_100">
					<p><?php echo form_label('Google Maps API Key', $apiKey['id']); ?><?php echo form_textarea($apiKey); ?></p>
					<?php echo form_error($apiKey['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('MapIT Activation Key', $activationKey['id']); ?><?php echo form_textarea($activationKey); ?></p>
					<?php echo form_error($activationKey['id']); ?>
				</div>
			</div>
		<div class="clear height-fix"></div>
		<div class="block-actions">
			<ul class="actions-left">
				<li><a class="close-toolbox button red" href="javascript:void(0);">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input id="config-form-submit" type="submit" class="button" value="Save"></li>
			</ul>
		</div>
	</div>	