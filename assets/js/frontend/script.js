/**
 * ****** DEVELOPER CODE ************
 * THIS CODE IS USED FOR DEVELOPERS
 * TO TRACK BUGS AND OPTIMIZE CODE
 * YOU CAN IGNORE CODE IN THIS AREA
 */

// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console) {
    arguments.callee = arguments.callee.caller;
    var newarr = [].slice.call(arguments);
    (typeof console.log === 'object' ? log.apply.call(console.log, console, newarr) : console.log.apply(console, newarr));
  }
};
// make it safe to use console.log always
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})((function(){try
{console.log();return window.console;}catch(err){return window.console={};}})());
/**
 * debug function
 * dumps out objects
 * @param  {object} obj object that needs to bee printed to the log
 * @return {string}
 */
function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
}
/**
 * ****** END DEVELOPER CODE **********
 */


/**
 * alternate the right hand sidebar styling by
 * adding a class 'sidebarAltRow'
 */
$(".sidebar-item-container:odd").addClass("sidebarAltRow");

/**
 * Toggle the map legend on the right hand side.
 */
$('#map-legend-button').toggle(function(){
    $('#map-legend-content').animate({height:0});
    $('#map-legend-button').removeClass('icon-chevron-up');
    $('#map-legend-button').addClass('icon-chevron-down');
    $('#map_items').animate({height:387});
}, function(){
    $('#map-legend-content').animate({height:210});
    $('#map-legend-button').removeClass('icon-chevron-down');
    $('#map-legend-button').addClass('icon-chevron-up');
    $('#map_items').animate({height:180});
});
/** the jquery cycle call for the advertisement images. */
$('.advertisement-content').cycle({
    fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
});

/**
 * left sidebar events categories
 * toggle sub categories
 */
$('.events-category').change( function(){
    var c = this.checked;
    var obj = $(this);
    if( c ){
         obj.next('.event-children').slideDown('fast', function() { });
    }else{
        obj.next('.event-children').slideUp('fast', function(){ });
    }
});

$('.events-child-category-all').change( function(){
    $(this).parent().siblings().find(':checkbox').attr('checked', this.checked);
});

$('#events-check-all').change( function(){
    $('.events-child-category').attr('checked', this.checked);
    $('.events-child-category-all').attr('checked', this.checked);
    $('.events-category').attr('checked', this.checked);
});
/**
 * When a left-sidebar button is clicked open
 * its parent container to show the form.
 * @author Francisco Diaz [http://www.picssel.com/]
 * @author Ed Ellsworth @ Five Pints Productions
 * @author Mike DeVita @ Relative Media
 */

lastShownIndex = 0;// global variable to store the last opened panel

//set lastShownIndex to the visible panel (directory)
$(".left_sidebar_control").each(function(index) {
   if($(".left_sidebar_control").eq(index).hasClass('visible')){lastShownIndex = index;}
});// end each

jQuery.fn.toggleSidebar = function(){
    var expanded;

    //determine if any panels are open
    $(".left_sidebar_control").each(function(index) {
       if($(".left_sidebar_control").eq(index).hasClass('visible')){ expanded = true; lastShownIndex = index;} //if a panel is open, set lastShownIndex
    });// end each
    if (expanded){
        //if panel is expanded, collapse
        $(".containerWrapper").animate({'marginLeft':-300},{
            queue:false,
            duration: 'fast',
            complete: function(){
                $(".left_sidebar_control").removeClass('visible');
            }
        });
    }else{
        // if panel is collapsed, expand
        $(".left_sidebar_control").removeClass('visible'); //remove visible class
        $(".containerWrapper").animate({'marginLeft': -300},{
            queue:false,
            duration:'fast',
            complete: function(){
                $(".containerWrapper").animate({'marginLeft':0},{ queue:false, duration:'fast', complete: function(){
                    $(".left_sidebar_control").eq(lastShownIndex).addClass('visible'); //add visible class
                    }});// expand
            } // complete
        }); // animate
    }
}
$(".button").click(function(){
    lastShownIndex = $(".button").index(this);
    if($(".left_sidebar_control").eq(lastShownIndex).hasClass('visible')){
            $(".containerWrapper").animate({'marginLeft':-300},{
                queue:false,
                duration: 'fast',
                complete: function(){
                    $(".left_sidebar_control").removeClass('visible');
                }
            });
        }else{
            $(".containerWrapper").animate({'marginLeft': -300},{
                queue:false,
                duration:'fast',
                complete: function(){
                    $(".left_sidebar_control").removeClass('visible').eq(lastShownIndex).addClass('visible');
                    $(".containerWrapper").animate({'marginLeft':0},{ queue:false, duration:'fast'});
                } // complete
            }); // animate
       } // if else
});//end button.click

/**
 * This opens the sidebar by default
 * on page load after 1200ms.
 */
setTimeout(function(){
    /** timeout to open the sidebar-left. */
     // open first container "browse by directory" by default onload (next two lines optional)
    $(".left_sidebar_control").eq(0).addClass('visible');
    $(".containerWrapper").animate({'marginLeft':0},{ queue:false, duration:'fast'});
    /** Open the map-legend by default on page load **/
    $('#map-legend-content').animate({height:210});
}, 1200);

/**
 * Membership info jquery popup
 * This shows the popup for pricing
 * information
 */
$('.read-more-popup').click(function(){
    $('.membership-info-bg').fadeIn('fast');
});
$('.membership-info-container span > a').click(function(){
    $('.membership-info-bg').fadeOut('fast');
});


function chamberClickFunction(){
    var popupChamberClick = $('.popupChamberClick');
    var popupChamberIcon = $('.popupChamberIcon');
    var popupChamber = popupChamberClick.parent();
    var chamberLogo = $('.chamberLogo');

    popupChamberClick.click(function(){
        if( popupChamber.hasClass('hidden') ){
            /** Show the chamber logo **/
            popupChamber.stop().animate({
                width:'96px',
                left: '-103px'
            }, 'fast');
            popupChamberIcon.html('>');
            popupChamber.removeClass('hidden');
        }else{
            /** hide the chamber logo **/
            popupChamber.stop().animate({
                width:'16px',
                left: '-24px'
            }, 'fast');
            popupChamberIcon.html('<');
            popupChamber.addClass('hidden');
        }
    });
}