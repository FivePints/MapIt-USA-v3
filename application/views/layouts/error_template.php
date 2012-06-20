<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <!-- DNS prefetch -->
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $mapConfig->site_title; ?> | <?= $template['title']; ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <?php echo $this->sprinkle->output('backend-css'); ?>
  <?php echo $this->sprinkle->output('modernizr'); ?>
  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  
  <!-- JavaScript at the bottom for fast page loading -->
  
</head>
<body class="special-page">

  <!-- Begin of #container -->
<div class="container_12">
	<?= $template['body']; ?>
</div>
</body>
</html>