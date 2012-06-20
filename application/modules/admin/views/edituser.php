<?php
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> $userInfo->email,
	'maxlength'	=> 80,
	'size'	=> 30,
);
$firstname = array(
	'name' => 'firstname',
	'id' => 'firstname',
	'value' => $userInfo->firstname,
	'size' => 30
);
$lastname = array(
	'name' => 'lastname',
	'id' => 'lastname',
	'value' => $userInfo->lastname,
	'size' => 30
);
$avatar = array(
	'name'	=> 'avatar',
	'id'	=> 'avatar',
	'value'	=> $userInfo->avatar,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$level = array(
	'name' => 'level',
	'id'	=> 'level',
	'value'	=> $userInfo->user_level,
	'maxlength'	=> 80,
	'size'	=> 30
	);
$welcome_flag = array(
	'name' => 'welcome_flag',
	'id'	=> 'welcome_flag',
	'value'	=> 1,
	'checked' => FALSE
	);
$activated = array(
	'name' => 'activate',
	'id'	=> 'activate',
	'value' => $userInfo->activated
	);
?>
<div class="block-border">
	<div class="block-header"><h1><?= $template['title']; ?></h1></div>
	<?php $formAttributes = array( 'id' => 'validate-form', 'class' => 'block-content form form-submit', 'data-reload' => 'FALSE');
	echo form_open_multipart($this->uri->uri_string(), $formAttributes); ?>
	<div class="_50">
		<div class="_100">
			<p><?php echo form_label('Email Address', $email['id']); ?><?php echo form_input($email); ?></p>
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

				<option value="1" <?php if ($userInfo->user_level == 1): ?>selected="selected"; <?php endif; ?>>User</option>
				<option value="2" <?php if ($userInfo->user_level == 2): ?>selected="selected"; <?php endif; ?>>Administrator</option>
				<option value="3" <?php if ($userInfo->user_level == 3): ?>selected="selected"; <?php endif; ?>>Super Administrator</option>
			</select></p>
		<?= form_error($level['id']); ?>
			<select name="status" id="status">
				<option value="0" <?php if ($userInfo->activated == 0): ?>selected="selected"; <?php endif; ?>>Deactivated</option>
				<option value="1" <?php if ($userInfo->activated == 1): ?>selected="selected"; <?php endif; ?>>Activated</option>
			</select>
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