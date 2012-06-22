  <?php Assets::cdn( array('jquery','jqueryui') ); ?>
  <?php Assets::js_group('backend_footer', array('backend/bootstrap.min.js', 'backend/jquery.validate.js', 'backend/bootstrap-dropdown.js', 'backend/bootstrap-tab.js', 'backend/bootstrap-tooltip.js', 'backend/bootstrap-popover.js', 'backend/chosen.jquery.js', 'backend/map.js', 'backend/plugins.js', 'backend/script.js') ); ?>

  <?php Assets::js_group('visualize', array('backend/jquery.visualize.js') ); ?>
  <?php Assets::css_group('visualize', array('backend/jquery.visualize.css') ); ?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->