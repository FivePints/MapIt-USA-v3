<?php echo $this->sprinkle->output('js'); ?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
</script>

<?php if($user['last_login'] == NULL || $user['last_login'] == ''): ?>
	<div class="first-visit-user-container">
		<div class="first-visit-user-content">
			<div class="first-visit-user-close"><a href="javascript:void(0)">x</a></div>
			<div class="first-visit-user-text">
				<h3>Welcome to MapIt USA</h3>
				<p>Since this is your first time visiting your profile, we have automatically opened the add map point form. Please feel free to fill it out to begin the process of getting your business mapped!</p>
			</div>
		</div>
	</div>
	<script>
		$().ready(function(){
			if ($.cookie("first-login-closed") != 'true'){
				$('.first-visit-user-close').click(function(){
					$('.first-visit-user-container').remove();
					$.cookie("first-login-closed", true);
				});	
			}else{
				$('.first-visit-user-container').remove();
				$('#addmap .block-header span').click();
			}
		});
	</script>
<?php endif; ?>
<script type="text/javascript">
	<?php if( $this->session->flashdata('messages') ): ?> 
		var messages =  <?= json_encode( $this->session->flashdata('messages') );  ?>;
		showResponseForm(messages);
	<?php endif; ?>
	/**
	 * wrapper function to show the 
	 * jGrowl notices on the top right.
	 * This is used in admin/profile and front-end.
	 */
	function showResponseForm(data){
		for (var i = data.length - 1; i >= 0; i--) {
			$.jGrowl(data[i].message, { theme: data[i].type });		
		};
	}
</script>