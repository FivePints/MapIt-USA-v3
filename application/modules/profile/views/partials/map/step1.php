<?php    
/**
 * Form Field attribute settings
 * @author Mike DeVita
 */
$companyname = array(
	'name'	=> 'companyname',
	'placeholder' => 'Enter Your Companies Name',
	'id'	=> 'companyname',
	'value'	=> set_value('companyname'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$contactname = array(
	'name'	=> 'contactname',
	'placeholder' => 'Enter The Name Of A Contact At Your Company',
	'id'	=> 'contactname',
	'value'	=> set_value('contactname'),
	'maxlength'	=> 80,
	'size'	=> 30
);

$phone1 = array(
	'name'	=> 'phone1',
	'placeholder' => '(xxx)xxx-xxxx',
	'id'	=> 'phone1',
	'value'	=> set_value('phone1'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$phone2 = array(
	'name'	=> 'phone2',
	'placeholder' => '(xxx)xxx-xxxx',
	'id'	=> 'phone2',
	'value'	=> set_value('phone2'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$fax = array(
	'name'	=> 'fax',
	'id'	=> 'fax',
	'value'	=> set_value('fax'),
	'maxlength'	=> 80,
	'size'	=> 30
);


$streetaddress = array(
	'name'	=> 'streetaddress',
	'placeholder' => 'Enter Your Street Address',
	'id'	=> 'streetaddress',
	'value'	=> set_value('streetaddress'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$address2 = array(
	'name'	=> 'address2',
	'placeholder' => 'Enter Apt or Suite Number', 
	'id'	=> 'address2',
	'value'	=> set_value('address2'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$city = array(
	'name'	=> 'city',
	'id'	=> 'city',
	'placeholder' => 'Enter Your City',
	'value'	=> set_value('city'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$state = array(
	'name'	=> 'state',
	'id'	=> 'state',
	'value'	=> set_value('state'),
	'maxlength'	=> 80,
	'size'	=> 30
);
$zipcode = array(
	'name'	=> 'zipcode',
	'id'	=> 'zipcode',
	'value'	=> set_value('zipcode'),
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
$user = array(
	'name'	=> 'user',
	'id'	=> 'user',
	'class' => 'chzn-select',
	'maxlength'	=> 80,
	'size'	=> 30
);
$level = array(
	'name'	=> 'level',
	'id'	=> 'level',
	'class' => 'chzn-select',
	'maxlength'	=> 80,
	'size'	=> 30
);
$showonmap = array(
	'name'	=> 'showonmap',
	'id'	=> 'showonmap',
	'value'	=> 1,
	'checked' => TRUE
);
$homebusiness = array(
	'name'	=> 'homebusiness',
	'id'	=> 'homebusiness',
	'value'	=> 1,
	'checked' => FALSE
);
$active = array(
	'name'	=> 'active',
	'id'	=> 'active',
	'value'	=> 1,
	'checked' => TRUE
);

$website = array(
	'name'	=> 'website',
	'id'	=> 'website',
	'placeholder' => 'http://www.yourwebsite.com',
	'value'	=> set_value('website'),
	'maxlength'	=> 80,
	'size'	=> 30	
	);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'placeholder' => 'your@email.com',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$logo = array(
	'name'	=> 'logo',
	'id'	=> 'logo',
	'value'	=> set_value('logo'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$image1 = array(
	'name'	=> 'image1',
	'id'	=> 'image1',
	'value'	=> set_value('image1'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$image2 = array(
	'name'	=> 'image2',
	'id'	=> 'image2',
	'value'	=> set_value('image2'),
	'maxlength'	=> 80,
	'size'	=> 30
	);

$twitter = array(
	'name'	=> 'twitter',
	'id'	=> 'twitter',
	'placeholder' => 'Enter Your Twitter Username',
	'value'	=> set_value('twitter'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$facebook = array(
	'name'	=> 'facebook',
	'id'	=> 'facebook',
	'placeholder' => 'Enter Your Facebook Url',
	'value'	=> set_value('facebook'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$linkedin = array(
	'name'	=> 'linkedin',
	'id'	=> 'linkedin',
	'placeholder' => 'Enter Your LinkedIn Url',
	'value'	=> set_value('linkedin'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$youtube = array(
	'name'	=> 'youtube',
	'id'	=> 'youtube',
	'placeholder' => 'Enter Your Youtube Channel Url',
	'value'	=> set_value('youtube'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$youtubevideo = array(
	'name'	=> 'youtubevideo',
	'id'	=> 'youtubevideo',
	'placeholder' => 'Enter Your Youtube Video ID',
	'value'	=> set_value('youtubevideo'),
	'maxlength'	=> 80,
	'size'	=> 30
	);
$tab1_title = array(
	'name' => 'tab1_title',
	'id' => 'tab1_title',
	'placeholder' => 'Promotions',
	'value' => set_value('tab1_title')
);
$facebookFeed = array(
	'name' => 'facebook_feed',
	'id' => 'facebook_feed',
	'placeholder' => 'http://facebook.com/mapitusa',
	'value' => set_value('facebook_feed')
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
<!--
<div id="admin-info-container">
	<div id="admin-info-level-1">
		<div class="admin-info-button" id="admin-info-button-level-1">Level 1</div>
		<div class="admin-info-content" id="admin-info-content-level-1">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
		</div>
	</div>
	<div id="admin-info-level-2">
		<div class="admin-info-button" id="admin-info-button-level-2">Level 2</div>
		<div class="admin-info-content">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
		</div>
	</div>
	<div id="admin-info-level-3">
		<div class="admin-info-button" id="admin-info-button-level-3">Level 3</div>
		<div class="admin-info-content">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
		</div>
	</div>
	<div id="admin-info-level-4">
		<div class="admin-info-button" id="admin-info-button-level-4">Level 4</div>
		<div class="admin-info-content">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
		</div>
	</div>
</div>
-->
<div class="block-border" id="addmap">
	<div class="block-header"><h1>Add New Map Point</h1><span></span></div>
	<form method="POST" action="<?php echo $this->uri->uri_string(); ?>" id="addmap-form" class="block-content form" enctype="multipart/form-data">
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
				<select name="category" id="category" class="chzn-select">
				<?php 
				foreach ($categories as $cK => $cV){
					echo "<option value='$cK'>".$cV."</option>";
				}
				?>
				</select></p>
				<?php echo form_error($category['id']); ?>
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
				<p><?php echo form_label('City', $city['id']); ?><?php echo form_input($city); ?></p>
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
				<div class="_50">
					<p><?php echo form_label('Logo', $logo['id']); ?><?php echo form_upload($logo); ?></p>
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
					<p>Enter in any content that you wish to appear on the Promotions tab of your map popup</p>
					<textarea id="tab1" name="tab1" class="textarea mceEditor"></textarea>
				</div>
				<div class="_100">
					<h2>Facebook Feed</h2>
					<p>Enter in the URL to your facebook page, we will automatically create the feed for you</p>
					<p><?php echo form_input($facebookFeed); ?></p>
					<?php echo form_error($facebookFeed['id']); ?>
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
				<li><a class="close-toolbox button red" href="javascript:void(0);">Reset</a></li>
			</ul>
			<ul class="actions-right">
				<li><input id="addmap-submit" type="submit" class="button" value="Checkout"></li>
			</ul>
		</div>
	<?php echo form_close(); ?>
</div>