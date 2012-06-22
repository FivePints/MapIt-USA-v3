<?php
$identity = array(
	'name'	=> 'identity',
	'id'	=> 'identity',
	'value' => set_value('identity'),
	'class' => 'required login-input',
	'placeholder' => 'Username or Email Address',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => 'required login-input',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
?>
<div class="offset4 span4 login-box">
	<h1 class="h1-title"><?= $template['title']; ?></h1>
	<?php if( $this->session->flashdata('message') || $message != '' ): ?>
		<div class="alert alert-error">
			<button class="close" data-dismiss="alert">×</button>
			<?php echo ( $this->session->flashdata('message') ) ? $this->session->flashdata('message') : $message; ?>
		</div>
	<?php endif; ?>
	<?php $formAttributes = array('class' => 'form well', 'id' => 'login-form', 'method' => 'POST' ); ?>
	<?php echo form_open($this->uri->uri_string(), $formAttributes); ?>
	<fieldset>
		<div class="control-group">
			<label for="identity"><strong>Username:</strong></label>
			<div class="controls">
				<?php echo form_input($identity); ?>
			</div>
		</div>
		<div class="control-group">
			<label for="password"><strong>Password:</strong></label>
	  		<div class="controls">
	  			<?php echo form_password($password); ?>
	  		</div>
	  	</div>
	  	<div class="control-group">
	  		<div class="controls">
	  			<label><?php echo form_checkbox($remember); ?> Remember Me</label>
	  		</div>
	  	</div>
	  	<div class="control-group">
	  		<div class="controls">
	  			<a class="button" name="recover_password" href="<?php echo base_url('/user/forgot_password'); ?>">Recover Password</a></li>
	  		</div>
	  	</div>
	  	<div class="form-actions">
	        <button type="submit" class="btn btn-primary">Login</button>
	        <button class="btn">Cancel</button>
		</div>
	</fieldset>
	</form>
</div>
<div id="powered-by-mapit" class="offset4 span2">
	<p><a href="http://www.mapitusa.com">Powered By <img src="<?php echo base_url(); ?>images/map-it-logo.png" border="0" /></a></p>
</div>