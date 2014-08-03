<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php
	// Use of Google Font
	if ($this->params->get('googleFont'))
	{
	?>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName');?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName'));?>', sans-serif;
			}
		</style>
	<?php
	}
	?>
	<?php
	// Template color
	if ($this->params->get('templateColor'))
	{
	?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor');?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor');?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor');?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php
	}
	?>
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">					
                    <div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
                    <a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
						<span style="color: #81197f;">MEDIC</span>NEXUS 
                        <h2 class="slogan_site"><?php echo JText::_('TPL_MN_TEMPLATE_PURPOSES');?></h2>
					</a>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
			<nav class="navigation" role="navigation">
				<jdoc:include type="modules" name="position-1" style="none" />
			</nav>
			<?php endif; ?>
			
			<jdoc:include type="modules" name="position-2" style="none" />
			<div class="row-fluid">
				<?php if ($this->countModules('position-8')) : ?>
				<!-- Begin Sidebar -->
				<div id="sidebar" class="span3">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
				<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span;?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="span3">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
				<?php endif; ?>
				<!--<jdoc:include type="modules" name="news-preview-band" style="xhtml" />-->
			</div>
		</div>
	</div>
	<!-- Footer -->
    <footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
	</footer>
    <div id="bottom_social_networks_zone">
					<div class="footer_menu_items_title">
					<?php echo JText::_('TPL_MN_SOCIAL_NETWORK_UPPER');?>
					</div>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr align="right">
							<td><a target="_blank" href="https://twitter.com/Medicnexus"><?php echo JText::_('TPL_MN_TWITTER');?> </a></td>
							<td><a target="_blank" href="https://twitter.com/Medicnexus"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_twitter_icon.gif"
									border="0" alt="<?php echo JText::_('TPL_MN_TW_IMG');?>" /> </a>
							</td>
							<td><a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"><?php echo JText::_('TPL_MN_FACEBOOK');?> </a></td>
							<td><a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_fb_icon.gif"
									border="0" alt="<?php echo JText::_('TPL_MN_FB_IMG');?>" /> </a>
							</td>
						</tr>
                        <tr>
                        	<td colspan="4"></td>
                        </tr>
						<tr>
							<td colspan="4">
								<div class="footer_menu_items_title">
								<?php echo JText::_('TPL_MN_INFORMATION_CHANNELS_UPPER');?>
								</div>
							</td>
						</tr>
						<tr align="right">
							<td><a href="#"><?php echo JText::_('TPL_MN_YOUTUBE');?> </a></td>
							<td><a href="#"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_youtube_icon.gif"
									border="0" alt="<?php echo JText::_('TPL_MN_YT_IMG');?>" /> </a>
							</td>
							<td><a href="#"><?php echo JText::_('TPL_MN_RSS');?> </a></td>
							<td><a href="#"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_rss_icon.gif"
									border="0" alt="<?php echo JText::_('TPL_MN_RSS_IMG');?>" /> </a>
							</td>
						</tr>
					</table>
				</div>
        
                <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
        
                <p class="pull-left"><a href="#top" id="back-top">&copy;&nbsp;<?php echo JText::_('TPL_MN_ALL_RIGHT_RESERVED_UPPER'); ?></a></p>
			<p><?php echo $sitename; ?> <?php echo date('Y');?></p>
            
            <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
            
            <div id="health_colleges_site">
        <ul>
            <li><a href="#"> <img
                    src="<?php echo $this->baseurl;?>/templates/mobiletemplate/images/metges_college.gif"
                    border="0" /> </a>
            </li>
            <li><a href="#"> <img
                    src="<?php echo $this->baseurl;?>/templates/mobiletemplate/images/web_medica_college.gif"
                    border="0" /> </a>
            </li>
        </ul>
	</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
