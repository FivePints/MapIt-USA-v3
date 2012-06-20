<!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<head>
<title><?php echo $mapConfig->site_title; ?></title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<?php if(ENVIRONMENT == 'stage' || ENVIRONMENT == 'development'): ?>
  <div class="environment"><?= ENV_NOTICE; ?></div>
<?php endif; ?>
  <!-- preload the openhand cursor to fix a bug with chrome/firefox -->
  <img src="https://maps.gstatic.com/mapfiles/openhand_8_8.cur" style="display:none; visibility:none;" border="0" />
	<div class="container_12">