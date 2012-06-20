
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
</body>
<!-- Start Google Maps API Intialization -->
<script>

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
<?php if ( $mapConfig->default_point_id != 0): ?>
    default_point_lookup();
<?php endif; ?>
</script>
<!-- END Google Maps API Intialization -->
<?php if($mapConfig->events == 1): ?>
<script>
    var months = [],
        days = [],
        counts = [];
    var exampleDate;

    function addDates(date) {
        if (date.getDay() == 0 || date.getDay() == 6) {
            return [true, ""];
        }
        console.log(days.length);
        for (x = 0; x < days.length; x++) {

            if (date.getMonth() == months[x] -1 && date.getDate() == days[x]) {
                console.log("We have An Event(s)! ("+ counts[x] +") "+ months[x] + "/" + days[x]);
                if(counts[x] >= 1 && counts[x] < 5){
                    return [true, "lightRed"];
                }else if(counts[x] >= 5 && counts[x] < 10){
                    return [true, "medRed"];
                }else if(counts[x] <= 10 && counts[x] >= 5){
                    return [true, "darkRed"];
                }
            }
        }
        return [true, ""];
    }
    $.ajax({
        url: "index/process/geteventdates.html",
        type: "POST",
        dataType: "JSON",
        success: function(data){
            for (var i = data.length - 1; i >= 0; i--) {
                months.push(data[i].month);
                days.push(data[i].day);
                counts.push(data[i].count);
                console.log('date is:'+data[i].month+'/'+data[i].day+'. ('+data[i].count+') ');
            };
            var pickerOpts = {
                beforeShowDay: addDates,
                minDate: +1,
                defaultDate: +0
            };
            $("#eventdate").datepicker(pickerOpts); // now I will be run only after the data is returned from the server
        }
    });
</script>
<?php endif; ?>
</html>