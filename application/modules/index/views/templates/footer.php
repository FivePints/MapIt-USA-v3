    </div> <!-- END CONTAINER_12 -->
</div>
<!-- START Membership Info Popup -->
<div class="membership-info-bg">
    <div class="membership-info-container">
        <span><a href="javascript:void(0)">x</a></span>
        <div class="membership-info-content">
            <div id="membershipinfo-template">
                <div id="youtube-container">
                    <object style="height: 165px; width: 240px"><param name="movie" value="https://www.youtube.com/v/g_5wek90KQs?version=3&feature=player_embedded"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="https://www.youtube.com/v/g_5wek90KQs?version=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="240" height="165"></object>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Membership Info Popup -->
<?php Assets::cdn( array('jquery', 'jqueryui', 'jquery-cycle') ); ?>
<?php Assets::js_group('footer', array('shared/jquery.form.js', 'shared/infobubble.js', 'frontend/script.js', 'frontend/mapit.js', 'shared/jquery.notifications.js', 'shared/shared-script.js') ); ?>
<?php if($mapConfig->events == 1): Assets::js_group('events', array('frontend/events.js') ); endif; ?>
<!-- Start Google Maps API Intialization -->
<script>
/**
 * async loading of the maps API,
 * this prevents blocking of the rest of the page.
 */
function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = '//maps.googleapis.com/maps/api/js?sensor=false&callback=init';
    document.body.appendChild(script);
}
window.onload = loadScript;

/**
 * init()
 *
 * generates the google map, sets the options and
 * centers based on default_lat, default_lng
 *
 * @author Mike DeVita
 * @copyright 2011 MapIT USA
 * @category map_Js
 */
var map;
function init(){
    /** @type {Object} stores the options for the map, the options are set via PHP */
    var myOptions = {
        zoom: <?= $mapConfig->default_zoom; ?>,
        center: new google.maps.LatLng(<?= $mapConfig->default_lat; ?>, <?= $mapConfig->default_lng; ?>),
        mapTypeId: google.maps.MapTypeId.<?= $mapConfig->default_map_type; ?>
    }
    map = new google.maps.Map(document.getElementById("<?= $mapConfig->default_map_id; ?>"), myOptions);
}//END init()
</script>
<!-- END Google Maps API Intialization -->
</html>