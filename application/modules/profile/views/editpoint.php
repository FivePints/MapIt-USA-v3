<?php    
/**
 * Form Field attribute settings
 * @author Mike DeVita
 */
$companyname = array(
	'name'	=> 'companyname',
	'placeholder' => 'Enter Your Companies Name',
	'id'	=> 'companyname',
	'value'	=> $points['pointFields']['companyname']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);
$contactname = array(
	'name'	=> 'contactname',
	'placeholder' => 'Enter The Name Of A Contact At Your Company',
	'id'	=> 'contactname',
	'value'	=> $points['pointFields']['contactname']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);

$phone1 = array(
	'name'	=> 'phone1',
	'placeholder' => 'xxx-xxx-xxxx',
	'id'	=> 'phone1',
	'value'	=> $points['pointFields']['phone1']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);
$phone2 = array(
	'name'	=> 'phone2',
	'placeholder' => 'xxx-xxx-xxxx',
	'id'	=> 'phone2',
	'value'	=> $points['pointFields']['phone2']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);
$fax = array(
	'name'	=> 'fax',
	'id'	=> 'fax',
	'value'	=> $points['pointFields']['fax']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);


$streetaddress = array(
	'name'	=> 'streetaddress',
	'placeholder' => 'Enter Your Street Address',
	'id'	=> 'streetaddress',
	'value'	=> $points['pointFields']['address1']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);
$address2 = array(
	'name'	=> 'address2',
	'placeholder' => 'Enter Apt or Suite Number', 
	'id'	=> 'address2',
	'value'	=> $points['pointFields']['address2']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);
$city = array(
	'name'	=> 'city',
	'id'	=> 'city',
	'placeholder' => 'Enter Your City',
	'maxlength'	=> 80,
	'size'	=> 30
);
$state = array(
	'name'	=> 'state',
	'id'	=> 'state',
	'maxlength'	=> 80,
	'size'	=> 30
);

if ($mapConfig->lock_city){
	$city['readonly'] = 'readonly';
}
if( $mapConfig->default_city ) {
	$default_cities = explode(',', $mapConfig->default_city);
	if( count($default_cities) <= 1){
		$city['value'] = $points['pointFields']['city']->uf_fieldvalue;
		$city['class'] = ' locked-field';
	}
}
$state = array(
	'name'	=> 'state',
	'id'	=> 'state',
	'maxlength'	=> 80,
	'size'	=> 30
);
if( $mapConfig->lock_state == 1 && $mapConfig->default_state){
	$state['readonly'] = 'readonly';
	$state['value'] = $points['pointFields']['state']->uf_fieldvalue;
	$state['class'] = ' locked-field';
}




$zipcode = array(
	'name'	=> 'zipcode',
	'id'	=> 'zipcode',
	'value'	=> $points['pointFields']['zip']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
);

$category = array(
	'name'	=> 'category',
	'id'	=> 'category',
	'class' => 'chzn-select',
	'maxlength'	=> 80,
	'size'	=> 30
);

$chamber_member = array(
	'name'	=> 'chamber_member',
	'id'	=> 'chamber_member',
	'value' => $points['pointData']->p_chamber
);

$showonmap = array(
	'name'	=> 'showonmap',
	'id'	=> 'showonmap',
	'value'	=> $points['pointData']->p_show_on_map
);
$homebusiness = array(
	'name'	=> 'homebusiness',
	'id'	=> 'homebusiness',
	'value'	=> $points['pointData']->p_home_business
);

$website = array(
	'name'	=> 'website',
	'id'	=> 'website',
	'placeholder' => 'http://www.yourwebsite.com',
	'value'	=> $points['pointFields']['website']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30	
	);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'placeholder' => 'your@email.com',
	'value'	=> $points['pointFields']['email']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$logo = array(
	'name'	=> 'logo',
	'id'	=> 'logo',
	'value'	=> '',
	'maxlength'	=> 80,
	'size'	=> 30
	);
$image1 = array(
	'name'	=> 'image1',
	'id'	=> 'image1',
	'value'	=> '',
	'maxlength'	=> 80,
	'size'	=> 30
	);
$image2 = array(
	'name'	=> 'image2',
	'id'	=> 'image2',
	'value'	=> '',
	'maxlength'	=> 80,
	'size'	=> 30
	);

$twitter = array(
	'name'	=> 'twitter',
	'id'	=> 'twitter',
	'placeholder' => 'Enter Your Twitter Username',
	'value'	=> $points['pointFields']['twitter']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$facebook = array(
	'name'	=> 'facebook',
	'id'	=> 'facebook',
	'placeholder' => 'Enter Your Facebook Url',
	'value'	=> $points['pointFields']['facebook']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$linkedin = array(
	'name'	=> 'linkedin',
	'id'	=> 'linkedin',
	'placeholder' => 'Enter Your LinkedIn Url',
	'value'	=> $points['pointFields']['linkedin']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$youtube = array(
	'name'	=> 'youtube',
	'id'	=> 'youtube',
	'placeholder' => 'Enter Your Youtube Channel Url',
	'value'	=> $points['pointFields']['youtube']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$youtubevideo = array(
	'name'	=> 'youtubevideo',
	'id'	=> 'youtubevideo',
	'placeholder' => 'Enter Your Youtube Video ID',
	'value'	=> $points['pointFields']['youtubevideo']->uf_fieldvalue,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$tab1_image = array(
		'name'	=> 'tab1_image',
		'id'	=> 'tab1_image',
		'value'	=> '',
		'maxlength'	=> 80,
		'size'	=> 30
);
$tab1_title = array(
	'name' => 'tab1_title',
	'id' => 'tab1_title',
	'placeholder' => 'Promotions',
	'value' => ''
);
$facebookFeed = array(
	'name' => 'facebook_feed',
	'id' => 'facebook_feed',
	'placeholder' => 'http://facebook.com/mapitusa',
	'value' => urldecode($points['pointFields']['tab2']->uf_fieldvalue)
);
/**
 * Values for dropdown forms elements. 
 * 
 * These are temporary values, which will 
 * eventually pull in from the database.
 * The data here is simply placeholder.
 */
$categories[0] = '----------';
foreach($map['categories'] as $row){
	$categories[$row['id']]=$row['category_name'];
}
$users[0] = '----------';
foreach($map['users'] as $row){
	$users[$row->id]=$row->username;
    }
$levels[0] = '----------';
foreach($map['levels'] as $row){
	$levels[$row['id']]=$row['levelname'];
    }
?>
<div class="block-border" id="addmap">
	<div class="block-header"><h1>Edit A Map Point</h1><span></span></div>
	<form method="POST" action="/profile/map/processEditPoint/<?= $points['pointData']->p_id; ?>.html" id="editpoint-form" class="block-content form" enctype="multipart/form-data">
		<div class="_50">
			<fieldset id="level-1">
				<legend>Level 1</legend>
				<legend id="level-1-cost" class="level-cost">FREE</legend>
				<div class="clear"></div>
				<div class="_100">
					<p><?php echo form_label('Company Name', $companyname['id']); ?><?php echo form_input($companyname); ?></p>
					<?php echo form_error($companyname['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Company Category', $category['id']); ?>
					<select name="category" id="category" class="chzn-select" >
					<?php 
					foreach ($categories as $cK => $cV){
						if ($cK == $points['pointData']->p_type){
							echo "<option value='$cK' selected='selected'>".$cV."</option>";
						}else{
							echo "<option value='$cK'>".$cV."</option>";
						}
					}
					?>
					</select></p>
					<?php echo form_error($category['id']); ?>
				</div>
				<div class="_75">
						<p><?php echo form_label('Are You A Member of The '.$mapConfig->memberQuestion.'?', $chamber_member['id']); ?></p>
					</div>
					<div class="_25">
						<p>
							<select name="chamber_member" id="chamber_member">
								<option value="1" <?php if($points['pointData']->p_chamber == 1): ?> selected="selected"<?php endif; ?>>Yes</option>
								<option value="0" <?php if($points['pointData']->p_chamber == 0): ?> selected="selected"<?php endif; ?>>No</option>
							</select>
						</p>
					</div>
					<div class="_100">
						<p id="chamber_member_notice">Dont Forget! As a chamber member you are entitled to list your <strong>website </strong>for <strong>free!</strong> Make Sure to fill it out under <strong>Level 2</strong>.</p>
					</div>
				<div class="_100">
					<p><?php echo form_label('Contact Name', $contactname['id']); ?><?php echo form_input($contactname); ?></p>
					<?php echo form_error($contactname['id']); ?>
				</div>

				<div class="_100">
					<p><?php echo form_label('Primary Phone Number', $phone1['id']); ?><?php echo form_input($phone1); ?></p>
					<?php echo form_error($phone1['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Secondary Phone Number', $phone2['id']); ?><?php echo form_input($phone2); ?></p>
					<?php echo form_error($phone2['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Fax Number', $fax['id']); ?><?php echo form_input($fax); ?></p>
					<?php echo form_error($fax['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Company Email', $email['id']); ?><?php echo form_input($email); ?></p>
					<?php echo form_error($email['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Street Address', $streetaddress['id']); ?><?php echo form_input($streetaddress); ?></p>
					<?php echo form_error($streetaddress['id']); ?>
				</div>
				<div class="_100">
					<p><?php echo form_label('Suite', $address2['id']); ?><?php echo form_input($address2); ?></p>
					<?php echo form_error($address2['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('City', $city['id']); ?>
						<?php
							if ($mapConfig->lock_city == 1):
								if ( count($default_cities) > 1): ?> 
								<select name="city" id="city-select">
									<?php foreach ($default_cities as $dc): ?>
									<option value="$dc" <?php if($dc == $points['pointFields']['city']->uf_fieldvalue){ echo 'selected="selected"'; } ?>><?= $dc; ?></option>
									<?php endforeach; ?>
								</select>
								<?php
								else:
								echo form_input($city);
								endif;
								?>
							<?php
							else:
								echo form_input($city);
							endif; ?>
					</p>
					<?php echo form_error($city['id']); ?>
				</div>
				<div class="_25">
					<p><?php echo form_label('State', $state['id']); ?><?php echo form_input($state); ?></p>
					<?php echo form_error($state['id']); ?>
				</div>
				<div class="_25">
					<p><?php echo form_label('Zip Code', $zipcode['id']); ?><?php echo form_input($zipcode); ?></p>
					<?php echo form_error($zipcode['id']); ?>
				</div>
				<div class="_50">
					<p><?php echo form_label('Home Based Business?', $homebusiness['id']); ?>
					<select name="homebusiness" id="homebusiness">
						<option value="1" <?php if($points['pointData']->p_home_business == 1): ?> selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if($points['pointData']->p_home_business == 0): ?> selected="selected"<?php endif; ?>>No</option>
					</select></p>
				</div>
				<div class="_50">
					<p id="showonmap-container"><?php echo form_label('Show Exact Location On Map?', $showonmap['id']); ?>
					<select name="showonwmap" id="showonmap">
						<option value="1" <?php if($points['pointData']->p_show_on_map == 1): ?> selected="selected"<?php endif; ?>>Yes</option>
						<option value="0" <?php if($points['pointData']->p_show_on_map == 0): ?> selected="selected"<?php endif; ?>>No</option>
					</select></p>
				</div>
			</fieldset>
		</div>

		<div class="_50">
			<fieldset id="level-2" class="level">
				<legend>Level 2</legend>
				<legend id="level-2-cost" class="level-cost">$250.00</legend>
				<div class="clear"></div>
				<div class="_50">
					<div class="_100">
						<p><?php echo form_label('Company Website', $website['id']); ?><?php echo form_input($website); ?></p>
						<?php echo form_error($website['id']); ?>
					</div>
					<div class="_100">
						<p><?php echo form_label('Twitter', $twitter['id']); ?><?php echo form_input($twitter); ?></p>
						<?php echo form_error($twitter['id']); ?>
					</div>
					<div class="_100">
						<p><?php echo form_label('Facebook', $facebook['id']); ?><?php echo form_input($facebook); ?></p>
						<?php echo form_error($facebook['id']); ?>
					</div>
					<div class="_100">
						<p><?php echo form_label('Linkedin', $linkedin['id']); ?><?php echo form_input($linkedin); ?></p>
						<?php echo form_error($linkedin['id']); ?>
					</div>
				</div>
				<div class="_50">
					<div class="_100">
						<p><?php echo form_label('Youtube', $youtube['id']); ?><?php echo form_input($youtube); ?></p>
						<?php echo form_error($youtube['id']); ?>
					</div>
					<div class="_100">
						<p><?php echo form_label('Logo', $logo['id']); ?>
							Please make sure your logo is a maximum width of 140px, a recommended height is between 136px - 150px.</p>
						<p><?php echo form_upload($logo); ?></p>
						<?php echo form_error($logo['id']); ?>
					</div>
				</div>
			</fieldset>

			<fieldset id="level-3">
				<legend>Level 3</legend>
				<legend id="level-3-cost" class="level-cost">$500.00</legend>
				<div class="clear"></div>
				<div class="_100">
					<div class="_100">
						<h2>Promotions</h2>
						<p>Enter in any content that you wish to appear on the Promotions tab of your MapIt! popup window.
Images should ideally be set to the following PIXEL dimensions: W=425  H=306 (or greater) otherwise images will be re-sized and depending on their ratio, your image may be distorted.</p>
						<p><?php echo form_upload($tab1_image); ?></p>
						<div class="or-seperator"><p>OR</p></div>
						<textarea id="tab1" name="tab1" class="textarea"><?= $points['pointFields']['tab1']->uf_html; ?></textarea>
						<?php echo display_ckeditor($ckeditor); ?>
					</div>
					<div class="_100">
						<h2>Facebook Feed</h2>
						<p>Enter in the URL to your facebook page, we will automatically create the feed for you</p>
						<p><?php echo form_input($facebookFeed); ?></p>
						<?php echo form_error($facebookFeed['id']); ?>
					</div>
				</div>
			</fieldset>
			<fieldset id="level-4">
				<legend>Level 4</legend>
				<legend id="level-4-cost" class="level-cost">$750.00</legend>
				<div class="clear"></div>
				<div class="_100">
					<p><?php echo form_label('Youtube Video', $youtubevideo['id']); ?><?php echo form_input($youtubevideo); ?></p>
					<?php echo form_error($youtubevideo['id']); ?>
				</div>
			</fieldset>
		</div>
		<div class="clear height-fix"></div>
		<div class="block-actions">
			<ul class="actions-left">
				<li><a class="close-toolbox button red" href="javascript:void(0);" id="addpoint-form-reset">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input type="submit" class="close-toolbox button blue" id="editpoint-form-submit" value="Submit Changes" /></li>
			</ul>
		</div>
	<?php echo form_close(); ?>	
</div>