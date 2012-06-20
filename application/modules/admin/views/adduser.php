<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => 'username',
		'class' => 'required',
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> 'email',
	'maxlength'	=> 80,
	'size'	=> 30,
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => 'password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => 'confirm_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$firstname = array(
	'name' => 'firstname',
	'id' => 'firstname',
	'value' => 'firstname',
	'size' => 30
);
$lastname = array(
	'name' => 'lastname',
	'id' => 'lastname',
	'value' => 'lastname',
	'size' => 30
);
$avatar = array(
	'name'	=> 'avatar',
	'id'	=> 'avatar',
	'value'	=> 'avatar',
	'maxlength'	=> 80,
	'size'	=> 30
	);
$level = array(
	'name' => 'level',
	'id'	=> 'level',
	'value'	=> 'level',
	'maxlength'	=> 80,
	'size'	=> 30
	);
$welcome_flag = array(
	'name' => 'welcome_flag',
	'id'	=> 'welcome_flag',
	'value'	=> 1,
	'checked' => FALSE
	);
$activate = array(
	'name' => 'activate',
	'id'	=> 'activate',
	'value'	=> 1,
	'checked' => TRUE
	);
?>
<div class="block-border">
	<div class="block-header"><h1><?= $template['title']; ?></h1></div>
	<?php $formAttributes = array( 'id' => 'validate-form', 'class' => 'block-content form');
	echo form_open_multipart($this->uri->uri_string(), $formAttributes); ?>
	<div class="_50">
		<div class="_100">
			<p><?php echo form_label('Username', $username['id']); ?><?php echo form_input($username); ?></p>
		</div>
		<div class="_100">
			<p><?php echo form_label('Email Address', $email['id']); ?><?php echo form_input($email); ?></p>
		</div>
		<div class="_100">
			<p><?php echo form_label('Password', $password['id']); ?><?php echo form_password($password); ?></p>
		</div>

		<div class="_100">
			<p><?php echo form_label('Confirm Password', $confirm_password['id']); ?><?php echo form_password($confirm_password); ?></p>
		</div>
		<div class="_100">
			<p><?php echo form_label('First Name', $firstname['id']); ?><?php echo form_input($firstname); ?></p>
		</div>
		<div class="_100">
			<p><?php echo form_label('Last Name', $lastname['id']); ?><?php echo form_input($lastname); ?></p>
		</div>
	</div>
	<div class="_50">
		<p><?php echo form_label('Avatar', $avatar['id']); ?><?php echo form_upload($avatar); ?></p>
		<?php echo form_error($avatar['id']); ?>
		<p><?= form_label('User Level', $level['id']); ?>
			<select name="level" id="level" >
				<option value="1" selected="selected">User</option>
				<option value="2">Administrator</option>
				<option value="3">Super Administrator</option>
			</select></p>
		<?= form_error($level['id']); ?>
		<p><?= form_label('Send Welcome Email?', $welcome_flag['id'], array('class' => '_75')); ?><?= form_checkbox($welcome_flag); ?></p>
		<p><?= form_label('Pre Activate?', $activate['id'], array('class' => '_75')); ?><?= form_checkbox($activate); ?></p>
	</div>

	<div class="clear"></div>
	<div class="block-actions">
		<ul class="actions-left">
			<li><a class="button red" id="reset-validate-form" href="javascript:void(0);">Reset</a></li>
		</ul>
		<ul class="actions-right">
			<li><input type="submit" class="button" value="Click here to validate the form!"></li>
		</ul>
	</div>
	<?php echo form_close(); ?>
</div>