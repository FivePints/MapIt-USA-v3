<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<?php $formAttributes = array('class' => 'block-content form form-submit', 'id' => 'login-form'); ?>
<?php echo form_open($this->uri->uri_string(), $formAttributes); ?>
	<p class="inline-small-label">
	<!-- <label for="username">Username</label> -->
  <?php echo form_label($login_label, $login['id']); ?>
  <?php echo form_input($login); ?>
  <!-- <input type="text" name="username" value="" class="required"> -->
</p>
<p class="inline-small-label">
	<!-- <label for="password">Password</label> -->
  <?php echo form_label('Password', $password['id']); ?>
  <?php echo form_password($password); ?>
	<!-- <input type="password" name="password" value="" class="required"> -->
</p>
	<p>
	<label><!-- <input type="checkbox" name="keep_logged" /> --><?php echo form_checkbox($remember); ?> Auto-login in future.</label>
</p>

<div class="clear"></div>

<!-- Begin of #block-actions -->
	<div class="block-actions">
	<ul class="actions-left">
		<li>
    		<a class="button" name="recover_password" href="<?php echo base_url('/user/forgot_password'); ?>">Recover Password</a></li>
		<li class="divider-vertical"></li>
		<li><a class="button red" id="reset-login" href="<?php echo base_url(); ?>">Cancel</a></li>
	</ul>
	<ul class="actions-right">
		<li><input type="submit" class="button" value="Login"></li>
	</ul>
</div> <!--! end of #block-actions -->
</form>