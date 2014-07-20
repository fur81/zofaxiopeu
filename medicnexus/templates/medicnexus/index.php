<?php defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}



// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JUri::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</span>';
}
else
{
	$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $this->language; ?>"
	lang="<?php echo $this->language; ?>"
	dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<link rel="stylesheet" type="text/css" href="css/template.css" />
<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/medicnexus.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/template.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/jquery.nicefileinput.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MEDICNEXUS</title>

<!-- GOOGLE ANALYTICS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41157753-1', 'medicnexus.com');
  ga('send', 'pageview');

</script>
</head>

<body
	onload="MM_preloadImages('<?php echo $this->baseurl;?>/templates/medicnexus/images/g_quick_consult_service_icon.gif',
	'<?php echo $this->baseurl;?>/templates/medicnexus/images/virtual_consult_service_icon_new.gif',
	'<?php echo $this->baseurl;?>/templates/medicnexus/images/second_opinion_service_icon.gif')">
	<div class="container">
		<div class="header">
			<div class="left_header_zone">
				<div class="logo_img">
					<a href="index.php"> <img
						src="<?php echo $this->baseurl;?>/templates/medicnexus/images/medicnexus_logo.gif"
						width="85" height="85" border="0" alt="<?php echo JText::_('TPL_MN_LOGO_IMG');?>" /> </a>
				</div>
				<h1 class="logo_title">
					<span style="color: #81197f;">MEDIC</span>NEXUS
				</h1>
				<h2 class="slogan_site">
				<?php echo JText::_('TPL_MN_DIRECT_CONNECTION');?>
				</h2>
				<div class="header_newsflash">
					<jdoc:include type="modules" name="newsflash" style="xhtml" />
					<!--Zona de las noticias rápidas de la portada del sitio-->
				</div>
			</div>
			<div class="right_header_zone">
				<div class="promo_lang_zone">
					<ul>
						<li><?php echo JText::_('TPL_MN_FOLLOW_US_IN');?>:</li>
						<li><a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"> <img
								src="<?php echo $this->baseurl;?>/templates/medicnexus/images/fb_icon.gif"
								border="0" alt="<?php echo JText::_('TPL_MN_FB_IMG');?>" /> </a>
						</li>
						<li><a target="_blank" href="https://twitter.com/Medicnexus"> <img
								src="<?php echo $this->baseurl;?>/templates/medicnexus/images/tw_icon.gif"
								border="0" alt="<?php echo JText::_('TPL_MN_TW_IMG');?>" /> </a>
						</li>
						<li><img
							src="<?php echo $this->baseurl;?>/templates/medicnexus/images/promo_lang_separator.gif"
							border="0" />
						</li>
					</ul>

				</div>

				<div class="language_flag_zone">
					<jdoc:include type="modules" name="position-0" style="xhtml" />
				</div>

				<div class="searching_zone">
					<table cellpadding="0" cellspacing="0" align="right">
						<tr>
							<td style="padding-bottom: 5px;">
								<ul>
									<li><a href="index.php?option=com_xmap&view=html&id=0"> <?php echo JText::_('TPL_MN_SITE_MAP');?>
									</a>
									</li>
									<li>|</li>
									<li><a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"><?php echo JText::_('TPL_MN_USER_REGISTER');?>
									</a>
									</li>
									<li style="margin: 2px 10px 0 5px;"><a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"> <img
											src="<?php echo $this->baseurl;?>/templates/medicnexus/images/register_user_icon.gif"
											border="0" alt="<?php echo JText::_('TPL_MN_REGISTRY_IMG');?>" /> </a>
									</li>
								</ul>
							</td>
							<td align="right" style="padding-bottom: 7px;">
								<jdoc:include type="modules" name="general-search" style="xhtml" />
							</td>
						</tr>
					</table>
				</div>
				<div class="top_menu">
					<!--Zona del menú principal del sitio-->
					<jdoc:include type="modules" name="position-1" style="xhtml" />
				</div>
				<div class="front_img_header"></div>
			</div>
			<!-- end .header -->
		</div>
		<div class="sitemap_zone">
			<jdoc:include type="modules" name="position-2" style="none" />
		</div>
		<div>
			<jdoc:include type="message" />
		</div>
		<div class="sidebar">
			<jdoc:include type="modules" name="position-8" style="xhtml" />
			<div class="side_box">
				<div class="title_bar content_sidebar title_sidebar_text">
					<jdoc:include type="modules" name="position-7" style="xhtml" />
				</div>
			</div>
			<div class="contact_zone">

				<div class="title_bar content_sidebar title_sidebar_text">
					<div class="box_title_right">
					<?php echo JText::_('TPL_MN_CONTACT_UPPER');?>
					</div>
				</div>

				<div class="contact_title">
				<?php echo JText::_('TPL_MN_ATTEND_SERVICE');?><br>
				</div>

				<div class="contact_table">
					<table width="90%" cellpadding="1" cellspacing="1" border="0">
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_EMAIL');?>:</td>
							<td style="color: #999; font-size: 11px;">aclient@medicnexus.com</td>
						</tr>
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_PHONE');?>:</td>
							<td style="color: #999; font-size: 11px;">(+34) 93 321 85 95</td>
						</tr>
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_FAX');?>:</td>
							<td style="color: #999; font-size: 11px;">(+34) 677 51 82 62</td>
						</tr>
					</table>
				</div>

			</div>
			<!-- end .sidebar1 -->
		</div>

		<div class="content_box">
			<main id="content" role="main" class="<?php echo $span;?>"> <!-- Begin Content -->
			<jdoc:include type="modules" name="position-3" style="xhtml" />
			<div class="content_boxbar title_bar title_content_text"></div>
			<jdoc:include type="component" /> <!-- End Content --> </main>
		</div>
		
		<div id="news-article_zone">
            <div class="title_bar content_sidebar title_sidebar_text">
                <div class="box_title_left">
                    <?php echo JText::_('TPL_MN_GENERAL_INFORMATION_UPPER');?>
                </div>
            </div>
            <div class="articles_zone">
                <div class="home_articles_title"><?php echo JText::_('TPL_MN_ARTICLES_UPPER');?></div>
                <div>
                	<jdoc:include type="modules" name="articles-preview" style="xhtml" />
                </div>
            </div>
            <div id="articles-news_separator">&nbsp;</div>
            <div class="articles_zone">
                <div class="home_articles_title"><?php echo JText::_('TPL_MN_NOTICES_UPPER');?></div>
                <div>
                	<jdoc:include type="modules" name="news-preview" style="xhtml" />
                </div>
            </div>
        </div>
	</div>
	<?php include_once 'templates/medicnexus/footer.php';?>
</body>
</html>
