<?= $template['partials']['header']; ?>
<div class="hero-unit">
	<h1>Successfully Installed!</h1>
	<p>You did it, MapIt is installed. Store the following credentials in a safe place. You will need them!</p>
<pre>
Frontend URL: <?= base_url(); ?>

Admin URL: <?= base_url(); ?>admin/index
username: <?= $username; ?> 
password: <?= $password; ?> 
</pre>

<h2>However, There are still a few things to take care of</h2>
<p>Visit the <a href="#" target="_blank">Configuration</a> documentation for tips on what is left to do!</p>
	<a href="<?= base_url(); ?>admin/index" target="_blank" class="btn btn-success">Login Now</a>
	<a href="<?= base_url(); ?>" target="_blank" class="btn btn-primary">Visit Frontend</a>
	<a href="https://github.com/gorelative/MapIt-USA/blob/master/README.md" target="_blank" class="btn btn-info">View Readme</a>
</div>
<?= $template['partials']['footer']; ?>