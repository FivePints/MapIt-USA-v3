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

  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <?php Assets::js_group('header', array('shared/modernizr.min.js') ); ?>
<!-- CSS: implied media=all -->
  <?php Assets::css( array('backend/bootstrap.min.css', 'backend/font-awesome.css', 'backend/app.css') ); ?>
</head>

<body>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="#"><img src="<?= base_url('images/logo.png'); ?>" width="60px" /></a>

        <div class="btn-group pull-right">
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-user"></i> <?= $user['username']; ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('auth/change_password'); ?>">Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?= base_url('/auth/logout'); ?>">Sign Out</a></li>
          </ul>
        </div>
        <?php if ($map['announcements'] ): ?>
        <div class="btn-group pull-right nav-notice">
          <span class="badge badge-info nav-notice-button"><?php echo count($page['announcements']); ?></span>
          <div class="notice-container">
            <span class="notice-arrow"></span>
            <ul class="notice-container-list">
              <?php foreach($page['announcements'] as $a): ?>
              <li><span class="label label-<?= $a->message_type; ?>"><?= $a->message_type; ?></span><span class="notice-message"> <strong><?= $a->title; ?></strong> <span class="notice-description"><?= $a->message; ?></span></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>
        <div class="nav-collapse">
          <ul class="nav">
            <li class="active"><a href="<?= base_url('/admin/index'); ?>">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('/admin/user/index'); ?>">Manage Users</a></li>
                <li><a href="<?php echo site_url('/admin/user/adduser'); ?>">Add New User</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Points<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('/admin/map/addpoint'); ?>">Add New Map Points</a></li>
                <li><a href="<?php echo site_url('/admin/map/index'); ?>">Manage Map Points</a></li>
              </ul>
            </li>
            <?php if( $mapConfig->events == 1 ): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Events<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('/admin/events/add'); ?>">Add New Event</a></li>
                <li><a href="<?php echo site_url('/admin/events/index'); ?>">Manage Events</a></li>
              </ul>
            </li>
            <?php endif; ?>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <a href="<?php echo site_url('/admin/categories/add'); ?>">Add Categories</a></li>
                <li><a href="<?php echo site_url('/admin/categories/index'); ?>">Manage Categories</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Communication<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('/admin/email'); ?>">Send Email By Category</a></li>
                <li><a href="<?php echo site_url('/admin/email'); ?>">Send Email By Business Name</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Advertisements<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('/admin/advertisements/index'); ?>">Manage Advertisements</a></li>
                <li><a href="<?php echo site_url('/admin/advertisements/add'); ?>">Add Advertisement</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>