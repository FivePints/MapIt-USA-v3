<?php echo $this->sprinkle->output('js'); ?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

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

