<?php

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
   <jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>templates/system/css/system.css" type="text/css" />

<link rel="stylesheet" href="<?php echo $this->baseurl; ?>templates/system/css/general.css" type="text/css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl;?>/templates/mobiletemplate/css/docs.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl;?>/templates/mobiletemplate/css/mmenu.css" />
   	<style type="text/css">
			#page
			{
				padding-top: 40px;
			}
			#header
			{
				margin-left: 0px;
				position: fixed;
				top: 0;
				left: 0%;
				width: 100%;

				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;

				-webkit-transition: left 0.5s ease, right 0.5s ease, margin 0.5s ease;
				-moz-transition: left 0.5s ease, right 0.5s ease, margin 0.5s ease;
				transition: left 0.5s ease, right 0.5s ease, margin 0.5s ease;
			}
			html.mmenu-opened #header
			{
				margin-left: 0px;
				left: 0%;
			}
			html.mmenu-opening #header
			{
				margin-left: -65px;
				left: 100%;
			}
			@media all and (min-width: 500px) {
				html.mmenu-opening #header
				{
					left: 500px;
				}
			}
				.mmenu
			{
				background: <?php echo $this->params->get('tpl_color','#333');?>;
			}
		</style>


		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/mobiletemplate/js/jquery.mmenu.min.js"></script>
          <script language="javascript" type="text/javascript">jQuery.noConflict();</script>

		<script type="text/javascript">

			jQuery(function() {
				jQuery('nav#menu').mmenu({
					configuration: {
						//	For some odd reason, the header won't stay "fixed"
						//	when using hardware acceleration
						hardwareAcceleration: false
					}
					
				});
			});


			
		</script>


</head>



