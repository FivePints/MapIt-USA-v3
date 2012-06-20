/**
 * Event Date Variable
 */
var selectedEventDate;
/**
 * infoBubble Variable
 * This variable is globally defined for defaults that are loaded.
 */
var infoBubbles = [];
/**
 * array of all of the markers that are on the map
 *
 * @type {Array}
 * @author Mike DeVita
 * @copyright 2011 MapIT USA
 * @category map_Js
 */
var markersArray = [];
/**
 * array of all of the sidebar items for all of the markers on the map
 *
 * @type {Array}
 * @author Mike DeVita
 * @copyright 2011 MapIT USA
 * @category map_Js
 */
var sidebarHtmlArray = [];
var latLngList = [];
var tabCount = 0;
/**
 * setPoints(locations)
 *
 * sets the marker, infoBubble and sidebarItem based on the locations
 * that were returned from the JSON query.
 *
 * @param {array} locations array of all of the points, and their settings/htmlf
 *
 * @author Mike DeVita
 * @author Google Maps API
 * @copyright 2011 MapIT USA
 * @category map_js
 */
function setPoints(locations){
    infoBubble = new InfoBubble({
        map: map,
        content: 'placeholder',
        disableAutoPan: false,
        hideCloseButton: false,
        arrowPosition: 30,
        arrowStyle: 0,
        backgroundColor: 'transparent',
        backgroundClassName: 'popupClass',
        tabClassName: 'tabClass',
        borderWidth: 0,
        borderRadius: 4,
        padding: 0,
        tabPadding: 12,
        arrowSize: 10,
        borderColor: '#AB2424',
        activeTabClassName: 'activeTabClass'
    });
    for (var i = 0; i < locations.length; i++) {
        /** @type {array} reassigns locations array to be point, isolates it to the setPoints() function */
        var point = locations;

        if (point[i].home_business == 1){
            point[i].lat += 30;
            point[i].lng += 30;
        }

        /** @type {google} generates Googles API form of the lat lng passed from var point */
        var myLatLng = new google.maps.LatLng(point[i].lat, point[i].lng);

        latLngList.push(myLatLng);

        /**
         * marker variable, stores all of the information pertaining to a specific marker
         * this variable creates the marker, places it on the map and then also sets some
         * custom options for the infoBubbles.
         *
         * @type {google}
         */
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: point[i].marker_icon,
            infoBubble_minWidth: point[i].min_width,
            infoBubble_maxWidth: point[i].max_width,
            infoBubble_minHeight: point[i].min_height,
            infoBubble_maxHeight: point[i].max_height,
            infoBubble_tabs: point[i].tabs
        });
        /** push the marker to the markersArray to delete or show the overlays */
        markersArray.push(marker);

        var sidebarItem = point[i].sidebarHtmlView;
        sidebarHtmlArray.push(sidebarItem);
        /**
         * add the listeners for the markerClicks and the sideBarClicks
         *
         * @type {google}
         * @todo eventDomListener does not work yet, this is the click listener of the sidebar item's
         */
        google.maps.event.addListener(marker, 'click', function(){
            var pan = -70;
            map.panBy(0,pan);
            /** remove all of the tabs from the infobubble, early prototype */
            if (tabCount > 0){
                for (var i = 0; i < tabCount; i++){
                    infoBubble.removeTab(0);
                }
                tabCount = 0;
            }

            /** setup the min/max width and heights for the bubble */
            infoBubble.setMinWidth(this.infoBubble_minWidth);
            infoBubble.setMaxWidth(this.infoBubble_maxWidth);
            infoBubble.setMinHeight(this.infoBubble_minHeight);
            infoBubble.setMaxHeight(this.infoBubble_maxHeight);

            var tabs = this.infoBubble_tabs;

            /** @type {Number} set the counter to 1, since tab index starts at 1 */
            for (var ii = 0; ii < tabs.length; ii++) {
                infoBubble.addTab(tabs[ii].tabTitle, tabs[ii].tabContent);
                /** count the amount of tabs there are */
                tabCount++;
            }
            /** open the infoBubble */
            infoBubble.open(map, this);
        });
    }
    var bounds = new google.maps.LatLngBounds();
    //  Go through each...
    for (i = 0, LtLgLen = latLngList.length; i < LtLgLen; i++){
      //  And increase the bounds to take this point
      bounds.extend (latLngList[i]);
    }
    //  Fit these bounds to the map
    map.fitBounds (bounds);
    var listener = google.maps.event.addListener(map, "idle", function() {
      if (map.getZoom() > 16) map.setZoom(16);
      google.maps.event.removeListener(listener);
    });
}
/**
 * open the infobubble specificed when called.
 * This is used it external Map areas such as
 * the right sidebar.
 * @param  {integer} x the index key to interact with
 */
function launchInfoWindow(x) {
    google.maps.event.trigger(markersArray[x], "click");
}
/**
 * addSidebarItem(sidebarItem, i)
 *
 * appends a div of the point's html to the right hand
 * sidebar.
 *
 * @param {html} sidebarItem html string that was generated by the controller
 * @param {numerical} i numerical index to link the sidebarItem with the map point
 */
function addSidebarItem(sidebarItem, i){
    $('#map_items').append('<tr><td id="point_'+i+'" onClick="google.maps.event.trigger(markersArray['+i+'], \'click\');" class="item">'+sidebarItem+'</td></tr>');
}
/**
 * showOverlays()
 *
 * display the Overlays that are in markersArray, infoBubbles, sidebarHtmlArray
 *
 * @author Mike DeVita
 * @author Google API
 * @copyright 2011 MapIT USA
 * @category map_js
 *
 * @todo add display of infoBUbbles
 */
function showOverlays() {
    /** show the markers on the map */
    if (markersArray) {
        for (var i in markersArray) {
            markersArray[i].setMap(map);
        }
    }
    /** show the side bar items */
    if (sidebarHtmlArray) {
        for (var i in sidebarHtmlArray){
            var sidebarItem = sidebarHtmlArray[i];
            addSidebarItem(sidebarItem, i);
        }
    }
}
/**
 * deleteOverlays()
 *
 * delete all of the Overlays that are in markersArray, infoBubbles, sidebarHtmlArray
 *
 * @author Mike DeVita
 * @author Google API
 * @copyright 2011 MapIT USA
 * @category map_js
 */
function deleteOverlays() {
    /** if markersArray is set, remove the marker off the map, and set it to length 0 */
    if (markersArray) {
        for (var i in markersArray) {
            markersArray[i].setMap(null);
            infoBubble.close();
        }
        markersArray.length = 0;
    }
    /** if sidebarHtmlArray is set, set it to length 0 */
    if (sidebarHtmlArray){
        sidebarHtmlArray.length = 0;
        $('#map_items .item').detach();
    }
}
/**
 * showLoading()
 *
 * shows the loading animation for the sidebar and map points
 * this helps to notify the user that the content they are trying
 * to load is indeed loading.
 *
 * @author Jonathan Sampson
 */
function showLoading() {
    $("#loading").show();
    $("#sidebar-loading").show();
}
/**
 * hideLoading()
 *
 * hides the loading animation for the sidebar and map points
 * this helps to notify the user that the content they are trying to load
 * has been loaded.
 *
 * @author Jonathan Sampson
 */
function hideLoading() {
    $("#loading").hide();
    $("#sidebar-loading").hide();
}
/**
 * Setup the map, add points, click the legend
 * button closed, Show the points on the map,
 * and then finally hide the loading screen.
 *
 * @param  {array} points array of points
 */
function setupMap(points){
    /** setup the points, infobubbles, and sidebar */
    setPoints(points);
    /** generate the click event to show the map Legend */
    legendClickEval();
    /** display the overlays (sidebar, infobbubles, markers) */
    showOverlays();
    /** throw a class on every odd row of the sidebar */
    $('.item:odd').addClass('sidebarAltRow');
    /** everythings done, hide the loading notice */
    hideLoading();
}
/**
 * evaluate that the map legend is opened,
 * close it if it isnt'.
 */
function legendClickEval(){
    if ($('#map-legend-content').height() > 0 ){
        $('#map-legend-button').click();
    }
}
/**
 * Reset MapIt Function
 *
 * Onclick of #reset, deleteOverlays, clear textboxes, and
 * uncheck all checkboxes.
 *
 * @return {none}
 */
$('#reset').click(function(){
    $('#categoryList').find('input[type=checkbox]:checked').removeAttr('checked');
    $('#search-directory-form').clearForm();
    deleteOverlays();
});
/**
 * JSON/AJAX Submit for Events
 */
$('#search-events-form').ajaxForm({
    dataType: "json",
    beforeSerialize: function(){
        var eventDate = $('#eventdate');
        /** make sure the checkbox that was clicked is checked, dont want to submit nothing, now do we? */
        var eventItems = eventDate.datepicker( "getDate" );
        $('#date-picked').val( $.datepicker.formatDate('yy-mm-dd', eventItems) );
        /** delete the overlays from the map, effectively starts fresh */
        deleteOverlays();
        $(this).toggleSidebar();
        /** just in case were loading a crap ton of points, throw up a loading notice */
        showLoading();
    },
    error: function(data){
        /** hide the loading notice */
        hideLoading();
        $(this).toggleSidebar();
        /** There was an error, so show it! */
        showResponseForm(jQuery.parseJSON( data.responseText ));
        /** generate the click event to show the map Legend */
        legendClickEval();
    },
    success: function(data){
        /** @type {object} the returned point's information, set it to something more related */
        setupMap(data);
    }
});
/**
 * JSON/AJAX Submit for Deal Categories
 *
 * On submit of #submit JSON query site/process controller
 * returns json encoded arrays of points and their lat/lng, html and sidebarHtml
 *
 * @return {json_array}
 *
 * @author Mike DeVita
 * @author Google API
 * @copyright 2011 MapIT USA
 * @category map_js
 */
$('.deals-category').click(function(){
    /** make sure the checkbox that was clicked is checked, dont want to submit nothing, now do we? */
    var items = $('#deals-categoryList').serialize();
    /** delete the overlays from the map, effectively starts fresh */
    deleteOverlays();
    /** just in case were loading a crap ton of points, throw up a loading notice */
    showLoading();
    /** set a timeout of 275ms, this is so the sidebar collapses first.. adds to the ui magic */
    setTimeout(function(){
        /** ajax post call to the controller */
        $(this).ajaxSubmit({
            data: { "items" : items },
            dataType: "json",
            type: "POST",
            url: "index/process/deals-categorylist.html",
            error: function(data){
                /** hide the loading notice */
                hideLoading();
                $(this).toggleSidebar();
                /** There was an error, so show it! */
                showResponseForm(jQuery.parseJSON( data.responseText ));
                /** generate the click event to show the map Legend */
                legendClickEval();
            },
            success: function(data){
                /** @type {object} the returned point's information, set it to something more related */
                setupMap(data);
            }
        });
        return false;
    }, 275); //END TIMEOUT
}); //END SUBMIT CLICK FOR AJAX

/**
 * JSON/AJAX Submit for Categories
 *
 * On submit of #submit JSON query site/process controller
 * returns json encoded arrays of points and their lat/lng, html and sidebarHtml
 *
 * @return {json_array}
 *
 * @author Mike DeVita
 * @author Google API
 * @copyright 2011 MapIT USA
 * @category map_js
 */
$('.category').click(function(){
    /** make sure the checkbox that was clicked is checked, dont want to submit nothing, now do we? */
    var items = $('#categoryList').serialize();
    /** delete the overlays from the map, effectively starts fresh */
    deleteOverlays();
    $(this).toggleSidebar();
    /** just in case were loading a crap ton of points, throw up a loading notice */
    showLoading();
    /** set a timeout of 275ms, this is so the sidebar collapses first.. adds to the ui magic */
    setTimeout(function(){
        /** ajax post call to the controller */
        $(this).ajaxSubmit({
            data: { "items" : items },
            dataType: "json",
            type: "POST",
            url: "index/process/categorylist.html",
            error: function(data){
                /** hide the loading notice */
                hideLoading();
                $(this).toggleSidebar();
                /** There was an error, so show it! */
                showResponseForm(jQuery.parseJSON( data.responseText ));
                /** generate the click event to show the map Legend */
                legendClickEval();
            },
            success: function(data){
                /** @type {object} the returned point's information, set it to something more related */
                setupMap(data);
            }
        });
        return false;
    }, 275); //END TIMEOUT
}); //END SUBMIT CLICK FOR AJAX

/**
 * JSON/AJAX Submit for Company Name
 *
 * on enter keypress, Hide the sidebar, delete everything on the map,
 * show the loading notice, submit the form to index/process/companyname.html
 * pass the serialized form of the input textbox. get the returned json
 * data of the points, set the points up on the map, and show the overlays
 * then alternate the row coloring on the sidebar. and Finally hide the
 * loading notice.
 *
 * @param  {numerical} e ascii keycode id of key that was pressed
 * @return {false}
 */
$("#search-by-companyname-list").autocomplete({
    minLength: 2,
    source: function(req, add){
        $.ajax({
            url: 'index/process/companyname-lookup.html',
            dataType: 'json',
            type: 'POST',
            data: req,
            success: function(data){
                if (data[0].type == 'error'){
                   showResponseForm(jQuery.parseJSON( data.responseText ));
                }else{
                    var companynames = [];
                    $.each(data, function(i, val){
                        companynames.push(val.companyname);
                    });
                    add(companynames);
                    $(".ui-menu-item:odd").addClass("lookupAltRow");
                }
            }
        });
    },
    select: function(e, ui){
        searchCompanyList(ui.item);
    }
});
$("#search-by-deals-list").autocomplete({
    minLength: 2,
    source: function(req, add){
        $.ajax({
            url: 'index/process/deals-lookup.html',
            dataType: 'json',
            type: 'POST',
            data: req,
            success: function(data){
                if (data[0].type == 'error'){
                   showResponseForm(jQuery.parseJSON( data.responseText ));
                }else{
                    var companynames = [];
                    $.each(data, function(i, val){
                        companynames.push(val.companyname);
                    });
                    add(companynames);
                    $(".ui-menu-item:odd").addClass("lookupAltRow");
                }
            }
        });
    },
    select: function(e, ui){
        searchCompanyList(ui.item);
    }
});
/**
 * this is called after AutoComplete returns a valid
 * company name to search by.
 * @param  {string} item full company name in string format
 */
function searchCompanyList(item){
    /** delete the overlays from the map, effectively starts fresh */
    deleteOverlays();
    $(this).toggleSidebar();
    /** just in case were loading a crap ton of points, throw up a loading notice */
    showLoading();
    /** set a timeout of 275ms, this is so the sidebar collapses first.. adds to the ui magic */
    setTimeout(function(){
        /** ajax post call to the controller */
        $(this).ajaxSubmit({
            data: { "items" : item.value },
            dataType: "json",
            type: "POST",
            url: "index/process/companyname.html",
            error: function(data){
                /** hide the loading notice */
                hideLoading();
                $(this).toggleSidebar();
                /** There was an error, so show it! */
                showResponseForm(jQuery.parseJSON( data.responseText ));
                /** generate the click event to show the map Legend */
                legendClickEval();
            },
            success: function(data){
                /** @type {object} the returned point's information, set it to something more related */
                setupMap(data);
            }
        });
        return false;
    }, 275); //END TIMEOUT
}