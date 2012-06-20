<div class="grid_12">
<!-- Begin of error-number-section -->
<section id="error-number">
  <h1><?= $page['errorType']; ?></h1>
</section>
<section id="error-text">
  <div class="error-message">
  	<p><?= $page['errorMessage']; ?></p>
  	<p><a class="button" href="<?php echo base_url('/profile/index'); ?>">&laquo; Back to Dashboard</a></p>
  </div>
</section></div>