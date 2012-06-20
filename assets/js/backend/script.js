$('.dropdown-toggle').dropdown();
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