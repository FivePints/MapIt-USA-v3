<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>
<?php $formAttributes = array('class' => 'block-content form form-submit', 'id' => 'reset-password-form'); ?>
<?php echo form_open($this->uri->uri_string(), $formAttributes); ?>
	<div class="_100">
		<p>
			<?php echo form_label($login_label, $login['id']); ?>
			<?php echo form_input($login); ?>
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
		</p>
	</div>

<div class="clear"></div>

<!-- Begin of #block-actions -->
	<div class="block-actions">
	<ul class="actions-left">
		<li><a class="button red" id="reset-login" href="javascript:void(0);">Cancel</a></li>
	</ul>
	<ul class="actions-right">
		<li><input type="submit" class="button" value="Login"></li>
	</ul>
</div> <!--! end of #block-actions -->
<?php echo form_close(); ?>