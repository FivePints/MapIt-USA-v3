<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<head>
<title><?php echo $mapConfig->site_title; ?> | <?= $template['title']; ?></title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<?php echo $this->sprinkle->output('modernizr'); ?>
<?php echo $this->sprinkle->output('out-css'); ?>
<?php echo $this->sprinkle->output('jquery-libs'); ?>
	<style type="text/css">
		body{
			overflow: hidden;
			font-family: arial;
			font-size: 10px;
		}
		#header-bar{
			height: 40px;
			background-color: #2A6F35;
			border-bottom: 7px solid #014C0F;
			z-index: 100;
			line-height: 40px;
			color: white;
			width: 100%;
		}
		#header-content {
			width: 100%;
			margin-left:10px;
			padding-right:16px;
		}
		#return{
			height: 100%;
			position: relative;
		}
		#return a:link, #return a:visited, #return a:active{
			color:#FFFFFF;
			text-decoration: none;
		}
		#closeFrameButton {
			padding: 3px 4px;
			background: #B40000;
			border: 1px solid #E20000;
			margin-right: 0px;
		}
		#closeFrameText {
			padding: 3px 4px;
			background: #333;
			border: 1px solid #484848;
			margin-left: -3px;
			border-left: 0;
		}
		#return a:hover{
			color:#EFEFEF;
		}
		#logo{
			font-size:14px;
			margin-right:14px;
		}
		#logo-container p, #logo-container h2, #logo-container h1{
			display:inline;
		}
		.left{
			height: 100%;
			margin-bottom: 0;
			float: left;
		}
		.center{
			width:300px;
			text-align:center;
		}
		.right{
			float: right;
			left: -20px;
		}
		#preview-frame {
			width: 100%;
			background-color: white;
		}
	</style>
	<script>
	//function to fix height of iframe!
	var calcHeight = function() {
	  var headerDimensions = $('#header-bar').height();
	  $('#preview-frame').height($(window).height() - headerDimensions);
	}

	$(document).ready(function() {
	  calcHeight();
	  $('#header-bar a.close').mouseover(function() {
	    $('#header-bar a.close').addClass('activated');
	  }).mouseout(function() {
	    $('#header-bar a.close').removeClass('activated');
	  });
	});

	$(window).resize(function() {
	  calcHeight();
	}).load(function() {
	  calcHeight();
	});
	</script>

</head>
<body id="name\|o-u-t-p-a-g-e--t-i-t-l-e-">
	<div id="header-bar">
		<div id="header-content">
			<div id="logo-container" class="left"><h1 id="logo"><?= $mapConfig->site_title; ?></h1> <h2><?= $advertisement->title; ?></h2><p> | <?= $advertisement->description; ?></p></div>
			<h3 id="return" class="right"><a href="<?= $advertisement->url ?>" target="_self"><span id="closeFrameButton">X</span>
				<span id="closeFrameText">Remove Frame</span>
			</a></h3>
		</div>
	</div>
	<iframe id="preview-frame" src="<?= $advertisement->url ?>" name="preview-frame" frameborder="0" noresize="noresize">
   </iframe>
</body>
</html>