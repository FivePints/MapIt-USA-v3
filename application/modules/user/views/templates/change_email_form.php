<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
?>
<?php $formAttributes = array('class' => 'block-content form form-submit', 'id' => 'reset-password-form'); ?>
<?php echo form_open($this->uri->uri_string(), $formAttributes); ?>
	<div class="_100">
		<p>
			<?php echo form_label('Password', $password['id']); ?>
			<?php echo form_password($password); ?>
			<p style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></p>
		</p>
	</div>
	<div class="_100">
		<p>
			<?php echo form_label('New email address', $email['id']); ?>
			<?php echo form_input($email); ?>
			<p style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></p>
		</p>
	</div>
<div class="clear"></div>

<!-- Begin of #block-actions -->
	<div class="block-actions">
	<ul class="actions-left">
		<li><a class="button red" id="reset-login" href="javascript:void(0);">Cancel</a></li>
	</ul>
	<ul class="actions-right">
		<li><input type="submit" class="button" value="Send Confirmation Email"></li>
	</ul>
</div> <!--! end of #block-actions -->
<?php echo form_close(); ?>