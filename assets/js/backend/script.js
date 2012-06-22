/** Main top navigation dropdown handler */
$('.dropdown-toggle').dropdown();

/** The close function for the dashboard graphs */
$('#graph-hero-container .close').click(function(){
    if( $('#graph-hero-container').height() > '10' ){
        $('.graph-centering').hide();
        $('#graph-hero-container').animate({
            height: '30px'
        });
    }else{
        $('#graph-hero-container').animate({
            height: '317px'
        });
        $('.graph-centering').show();
    }
});

/** The popup for the thumbnail preview for advertisement images in the backend */
$('.advertisement-preview').popover();


function showLoading(obj){
    //Where to insert the element
    //Where to get the height/width from
    var $object = obj;
    var loadingHtml = '<div class="loading"><img src="/images/loader_darkbg.gif" /></div>';

    $object.before(loadingHtml);

    var $height = $object.innerHeight();
    var $loadingImgHeight = $('.loading img').height() / 2;
    var $loadingImgMargin = $height/ 2 - $loadingImgHeight;
    var $width =  $object.innerWidth();

    $('.loading').height($height).width($width);
    $('.loading img').css('margin-top', $loadingImgMargin);
    $('.loading').show();
}

function hideLoading(){
    $('.loading').remove();
}

$.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
} );
/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
    return {
        "iStart":         oSettings._iDisplayStart,
        "iEnd":           oSettings.fnDisplayEnd(),
        "iLength":        oSettings._iDisplayLength,
        "iTotal":         oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
        "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
    };
}

/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function( oSettings, nPaging, fnDraw ) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function ( e ) {
                e.preventDefault();
                if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                    fnDraw( oSettings );
                }
            };

            $(nPaging).addClass('pagination').append(
                '<ul>'+
                    '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                    '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                '</ul>'
            );
            var els = $('a', nPaging);
            $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
            $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
        },

        "fnUpdate": function ( oSettings, fnDraw ) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

            if ( oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if ( oPaging.iPage <= iHalf ) {
                iStart = 1;
                iEnd = iListLength;
            } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                // Remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                // Add the new list items and their event handlers
                for ( j=iStart ; j<=iEnd ; j++ ) {
                    sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                    $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                        .insertBefore( $('li:last', an[i])[0] )
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                            fnDraw( oSettings );
                        } );
                }

                // Add / remove disabled classes from the static elements
                if ( oPaging.iPage === 0 ) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }

                if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
} );
var oTable = $('.dataTable').dataTable( {
    "sDom": "<'row-fluid dataTable_topBar'<'span9'l><'span3'f>r>t<'row-fluid'<'span9'i><'span3'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
        "sLengthMenu": "_MENU_ records per page"
    }
} );



$('.item-status').click(function(e){
    var $this = $(this);
    var manageUrl = $(this).attr('href');
    var dataContent = $(this).data();
    console.log(status);

    showLoading( $this.closest('tr') );
    setTimeout(function(){
            $.ajax({
            url: manageUrl,
            type: "POST",
            dataType: "JSON",
            data: { "data": dataContent },
            success: function(d, status, jqXHR){
                if( dataContent.status == 1 ){
                    $this.removeClass('status-link-deactivate');
                    $this.addClass('status-link-activate');
                    $this.data('status', '0');
                }else{
                    $this.removeClass('status-link-activate');
                    $this.addClass('status-link-deactivate');
                    $this.data('status', '1');
                }
                hideLoading();
                throwMessage(d);
            },
            error: function(d, r, xhr){
                hideLoading();
                throwMessage(r);
            }
        });
    }, '500');
    return false;
});

$('.item-delete').click(function(e){
    var $this = $(this);
    var manageUrl = $(this).attr('href');
    var dataContent = $(this).data();

    showLoading( $this.closest('tr') );
    setTimeout(function(){
        $.ajax({
            url: manageUrl,
            type: "POST",
            dataType: "JSON",
            data: { "data": dataContent },
            success: function(d, status, jqXHR){
                $this.closest('tr').remove();

                var pos = $this.closest("tr").get(0);
                var aPos = oTable.fnGetPosition( pos );
                oTable.fnDeleteRow( aPos );

                hideLoading();

            },
            error: function(d, r, xhr){
                hideLoading();
            }
        });
    }, '500');
    return false;
});

$('.nav-notice-button').toggle(function(){
  $('.notice-container').slideDown(100);
}, function(){
  $('.notice-container').slideUp(100);
});

$('.notice-remove').live( "click", function(){
    $(this).hide();
    $(this).parent('li').animate({
        width: "0"
    }, 'fast', '',
    function(){
        $(this).remove();
    });
    var str = $('.notice-container-list').html();
    if( $.trim(str) === "" ){
        log('Closing the Notice');
        $('.nav-notice-button').click();
    }
});