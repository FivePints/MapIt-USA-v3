<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>MapIt USA Installer</title>

	<link rel="stylesheet" href="<?= base_url(); ?>assets/installer/css/bootstrap.min.css" media="screen">
		<link rel="stylesheet" href="<?= base_url(); ?>assets/installer/css/bootstrap-responsive.min.css" media="screen">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/installer/css/style.css" media="screen">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/installer/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="<?= base_url(); ?>assets/installer/js/bootstrap-tooltip.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?= base_url(); ?>assets/installer/js/bootstrap-popover.js" type="text/javascript" charset="utf-8"></script>
	<!--[if lt IE 9]>
		<style>
			aside, nav, footer, header, section { display:block } 
		</style>
		<link rel="stylesheet" href="/css/iefix.css">
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<style type="text/css">
	body {
		padding-top:60px;
		padding-bottom: 40px;
	}
	.input-prepend .add-on, .input-prepend .btn {
		margin-right: -5px;
		margin-top: -8px;
	}
</style>
</head>
<body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">MapIt USA Installer</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
	<?php if( $this->session->flashdata('validation_errors') ): ?>
		<?= $this->session->flashdata('validation_errors'); ?>
	<?php endif; ?>
	<?php if( $this->session->flashdata('message') ): ?>
		<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">Error!</h4>
			<?= $this->session->flashdata('message'); ?>
		</div>
	<?php endif; ?>