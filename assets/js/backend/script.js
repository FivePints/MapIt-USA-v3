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

$('.item-status').click(function(e){
    var $this = $(this);
    var manageUrl = $(this).attr('href');
    var dataContent = $(this).data();
    console.log(status);

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
            throwMessage(d);
        },
        error: function(d, r, xhr){
            throwMessage(r);
        }
    });

    return false;
});

function showLoading(obj, placement){
    //Where to insert the element
    //Where to get the height/width from
    var $object = $(obj);
    var loadingHtml = '<div class="loading"><img src="/images/loader_darkbg.gif" /></div>';

    $object.before(loadingHtml);

    var $height = $object.innerHeight();
    var $loadingImgHeight = $('.loading img').height();
    var $loadingImgMargin = $height/ 2 - $loadingImgHeight;

    var $width =  $object.innerWidth();

    $('.loading').height($height).width($width);
    $('.loading img').css('margin-top', $loadingImgMargin)
    $('.loading').show();

}

function hideLoading(){
    $('.loading').hide();
}

$('.item-delete').click(function(e){
    var $this = $(this);
    var manageUrl = $(this).attr('href');
    var dataContent = $(this).data();
    console.log(status);
    showLoading();
    $.ajax({
        url: manageUrl,
        type: "POST",
        dataType: "JSON",
        data: { "data": dataContent },
        success: function(d, status, jqXHR){
            $this.closest('tr').remove();
            hideLoading();
            throwMessage(d);

        },
        error: function(d, r, xhr){
            hideLoading();
            throwMessage(r);
        }
    });
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