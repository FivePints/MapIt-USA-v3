/** Main top navigation dropdown handler */
$('.dropdown-toggle').dropdown();

$('.btnToggle').click(function(){
    var $this = $(this);
    var curValue = $this.val();
    if( $this.hasClass('active') ){
        if( $this.data('toggle') == 'button'){
            $this.removeClass('btn-success active');
            $this.closest('.controls').find('.btnField').val( "" );
        }else if($this.data('toggle') =='buttons-radio' ){
            $this.removeClass('btn-success active');
            $this.siblings().removeClass('btn-success active');
            $this.closest('.controls').find('.btnField').val( "" );
        }
    }else{
        if( $this.hasClass('radio') == 'button'){
            $this.addClass('btn-success active');
            $this.closest('.controls').find('.btnField').val( curValue );
        }else{
            $this.siblings().removeClass('btn-success active');
            $this.addClass('btn-success active');
            $this.closest('.controls').find('.btnField').val( curValue );
        }
    }
    return false;
});

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

