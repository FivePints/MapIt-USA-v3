  <?php Assets::cdn( array('jquery','jqueryui') ); ?>
  <?php Assets::js_group('bootstrap_footer', array('backend/bootstrap.min.js', 'backend/jquery.validate.js', 'backend/bootstrap-dropdown.js', 'backend/bootstrap-tab.js', 'backend/bootstrap-tooltip.js', 'backend/bootstrap-popover.js', 'backend/bootstrap-button.js') ); ?>

  <?php
  foreach ( $assets as $a ):
    if( isset($a['group']) && $a['group'] === TRUE ):
        $type = $a['type'].'_group';
        Assets::$type($a['group_name'], $a['assets'] );
      else:
        Assets::$a['type']( $a['assets'] );
    endif;
  endforeach;
  ?>

  <?php Assets::js_group('backend_footer', array('backend/map.js', 'backend/plugins.js', 'backend/script.js') ); ?>
<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->