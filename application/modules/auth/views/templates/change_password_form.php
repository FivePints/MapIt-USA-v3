<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>

<?php $formAttributes = array('class' => 'block-content form form-submit', 'id' => 'reset-password-form'); ?>
<?php echo form_open($this->uri->uri_string(), $formAttributes); ?>
<?php echo form_open($this->uri->uri_string()); ?>
	<div class="_100">
		<p>
			<?php echo form_label('Old Password: ', $old_password['id']); ?>
			<?php echo form_password($old_password); ?>
			<p style="color: red;"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></p>
		</p>
	</div>
	<div class="_100">
		<p>
			<?php echo form_label('New Password: ', $new_password['id']); ?>
			<?php echo form_password($new_password); ?>
			<p style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></p>
		</p>
	</div>
	<div class="_100">
		<p>
			<?php echo form_label('Confirm Password: ', $confirm_new_password['id']); ?>
			<?php echo form_password($confirm_new_password); ?>
			<p style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></p>
		</p>
	</div>
<div class="clear"></div>

<!-- Begin of #block-actions -->
	<div class="block-actions">
	<ul class="actions-left">
		<li><a class="button red" id="reset-login" href="javascript:void(0);">Cancel</a></li>
	</ul>
	<ul class="actions-right">
		<li><input type="submit" class="button" value="Reset Password"></li>
	</ul>
</div> <!--! end of #block-actions -->
<?php echo form_close(); ?>