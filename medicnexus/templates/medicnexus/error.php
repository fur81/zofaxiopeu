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

// Add current user information
$user = JFactory::getUser();

// Logo file
if ($params->get('logoFile'))
{
	$logo = JUri::root() . $params->get('logoFile');
}
else
{
	$logo = $this->baseurl . "/templates/" . $this->template . "/images/logo.png";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<title><?php echo $this->title; ?> <?php echo $this->error->getMessage();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="language" content="<?php echo $this->language; ?>" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/error.css" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<!-- Header -->
			<div class="header">
			<div id="left_header_zone">
				<div id="logo_img">
					<a href="index.php"> <img
						src="<?php echo $this->baseurl;?>/templates/medicnexus/images/medicnexus_logo.gif"
						width="85" height="85" border="0" /> </a>
				</div>
				<h1>
					<span style="color: #81197f;">MEDIC</span>NEXUS
				</h1>
				<h2>
				<?php echo JText::_('TPL_MN_DIRECT_CONNECTION');?>
				</h2>
				<div id="header_newsflash">
					<div class="error_welcome_text">
                    	<span class="title_error_welcome_text"><?php echo JText::_('TPL_MN_ESTIMATED_USER');?></span>
                        <p>
                        	<?php echo JText::_('TPL_MN_ERROR_MESSAGE');?>
                        </p>
                        <span class="footer_error_welcome_text"><?php echo JText::_('TPL_MN_MEDICNEXUS_TEAM');?></span>
                    </div>
				</div>
			</div>
			<div id="right_header_zone">
				<div id="promo_lang_zone">
					<ul>
						<li><?php echo JText::_('TPL_MN_FOLLOW_US_IN');?>:</li>
						<li>
                        	<a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"> 
                            	<img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/fb_icon.gif" border="0" />
                            </a>
						</li>
						<li>
                        	<a href="#">
                            	<img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/tw_icon.gif" border="0" />
                            </a>
						</li>
					</ul>

				</div>

				<div id="searching_zone">
					<table cellpadding="0" cellspacing="0" align="right">
						<tr>
							<td style="padding-bottom: 5px;">
								<ul>
									<li><a href="index.php?option=com_xmap&view=html&id=0"> <?php echo JText::_('TPL_MN_SITE_MAP');?>
									</a>
									</li>
									<li>|</li>
									<li><a href="#"><?php echo JText::_('TPL_MN_USER_REGISTER');?>
									</a>
									</li>
									<li style="margin: 2px 10px 0 5px;"><a href="#"> <img
											src="<?php echo $this->baseurl;?>/templates/medicnexus/images/register_user_icon.gif"
											border="0" /> </a>
									</li>
								</ul>
							</td>
						</tr>
					</table>
				</div>
				<div id="front_img_header"></div>
			</div>
			<!-- end .header -->
		</div>
		<div>
			<jdoc:include type="message" />
		</div>
		<div class="sidebar">
			
			<div id="contact_zone">

				<div class="title_bar content_sidebar title_sidebar_text">
					<div class="box_title_right">
					<?php echo JText::_('TPL_MN_CONTACT_UPPER');?>
					</div>
				</div>

				<div class="contact_title">
				<?php echo JText::_('TPL_MN_ATTEND_SERVICE');?>
				</div>

				<div id="contact_table">
					<table width="90%" cellpadding="1" cellspacing="1" border="0">
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_EMAIL');?>:</td>
							<td style="color: #999; font-size: 11px;">contacto@medicnexus.com</td>
						</tr>
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_PHONE');?>:</td>
							<td style="color: #999; font-size: 11px;">(+34) 66-683-0777</td>
						</tr>
						<tr>
							<td width="40%" style="color: #666; font-size: 11px;"
								align="right"><?php echo JText::_('TPL_MN_FAX');?>:</td>
							<td style="color: #999; font-size: 11px;">(+34) 91-188-6000</td>
						</tr>
					</table>
				</div>

			</div>
			<!-- end .sidebar1 -->
		</div>
		
		
			<div class="row-fluid">
				<div class="content_box">
                    <div id="content" class="span12">
                    
                        <div class="content_boxbar title_bar title_content_text">
                        	<div class="box_title_left"><?php echo JText::_('TPL_MN_ERROR_INFORMATION'); ?></div>
                        </div>
                        <!-- Begin Content -->
                        
                        <div class="well">
                            <div class="row-fluid">
                                <div class="span6">
                                    <h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
                                    <p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
                                    <p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
                                    <ul>
                                        <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
                                        <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
                                    </ul>
                                </div>
                                <div class="span6">
                                    <?php if (JModuleHelper::getModule('search')) : ?>
                                        <p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
                                        <p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
                                        <?php echo $doc->getBuffer('module', 'search'); ?>
                                    <?php endif; ?>
                                    <p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
                                    <p style="border-bottom: 1px solid #333; padding-bottom: 10px;"><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><i class="icon-home"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
                                </div>
                            </div>
                            <p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
                            <blockquote style="color: #333; text-transform: uppercase; margin: 0; padding: 0;">
                                <span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo $this->error->getMessage();?>
                            </blockquote>
                        </div>
                        
                        <!-- End Content -->
                    </div>
                </div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="footer">
			<div id="bottom_menu_site">
				<ul>
					<li><a href="index.php"><?php echo JText::_('TPL_MN_HOME_UPPER');?>
					</a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=9&amp;catid=9&amp;Itemid=112">
						<?php echo JText::_('TPL_MN_NOTICES_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=10&amp;catid=10&amp;Itemid=113">
						<?php echo JText::_('TPL_MN_ARTICLES_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=14&amp;catid=11&amp;Itemid=117">
						<?php echo JText::_('TPL_MN_SERVICES_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=11&amp;catid=12&amp;Itemid=114">
						<?php echo JText::_('TPL_MN_ABOUT_US_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=12&amp;catid=13&amp;Itemid=115">
						<?php echo JText::_('TPL_MN_DOCUMENTATION_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=13&amp;catid=14&amp;Itemid=116">
						<?php echo JText::_('TPL_MN_FAQ_UPPER');?> </a>
					</li>
					<li class="bottom_menu_site_separator">::</li>
					<li><a
						href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109">
						<?php echo JText::_('TPL_MN_CLIENT_ZONE_UPPER');?> </a>
					</li>
				</ul>
			</div>
			<div id="bottom_submenu_site_zone">
				<div id="block_bottom_submenu">
					<h1>
					<?php echo JText::_('TPL_MN_GENERAL_POLITICS_SITE_UPPER');?>
					</h1>
					<ul>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=18&amp;catid=17&amp;Itemid=104">
								- <?php echo JText::_('TPL_MN_PRIVACY_POLITICS');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=19&amp;catid=17&amp;Itemid=104">
								- <?php echo JText::_('TPL_MN_CONDITIONS_TERMS');?> </a>
						</li>
						<li><a href="index.php?option=com_xmap&view=html&id=0"> - <?php echo JText::_('TPL_MN_SITE_MAP');?>
						</a>
						</li>
					</ul>
				</div>
				<div id="bottom_menu_site_separator"></div>
				<div id="block_bottom_submenu">
					<h1>
					<?php echo JText::_('TPL_MN_MEDIC_SERVICES_AVAILABLE_UPPER');?>
					</h1>
					<ul>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=rapid_consultation">
								- <?php echo JText::_('TPL_MN_RAPID_CONSULTATION');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=virtual_consultation">
								- <?php echo JText::_('TPL_MN_VIRTUAL_CONSULTATION');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=second_opinion">
								- <?php echo JText::_('TPL_MN_SECOND_OPINION');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=health_program">
								- <?php echo JText::_('TPL_MN_HEALTH_PROGRAM');?> </a>
						</li>
					</ul>
				</div>
				<div id="bottom_menu_site_separator"></div>
				<div id="block_bottom_submenu">
					<h1>
					<?php echo JText::_('TPL_MN_GENERAL_SERVICES_SITE_UPPER');?>
					</h1>
					<ul>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=9&amp;catid=9&amp;Itemid=112">-
							<?php echo JText::_('TPL_MN_NOTICES');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=10&amp;catid=10&amp;Itemid=113">-
							<?php echo JText::_('TPL_MN_ARTICLES');?> </a>
						</li>
					</ul>
				</div>
				<div id="bottom_menu_site_separator"></div>
				<div id="block_bottom_submenu">
					<h1>
					<?php echo JText::_('TPL_MN_GENERAL_INFORMATION_UPPER');?>
					</h1>
					<ul>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=13&amp;catid=14&amp;Itemid=116">-
							<?php echo JText::_('TPL_MN_FRECUENTLY_QUESTIONS');?> </a>
						</li>
						<li><a
							href="index.php?option=com_content&amp;view=article&amp;id=20&amp;catid=20&amp;Itemid=104">-
							<?php echo JText::_('TPL_MN_GENERAL_MEDICAL_DOCUMENTATION');?> </a>
						</li>
					</ul>
				</div>
				<div id="bottom_menu_site_separator"></div>
				<div id="bottom_social_networks_zone">
					<h1>
					<?php echo JText::_('TPL_MN_SOCIAL_NETWORK_UPPER');?>
					</h1>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr align="right">
							<td><a target="_blank" href="https://twitter.com/Medicnexus"><?php echo JText::_('TPL_MN_TWITTER');?> </a></td>
							<td><a target="_blank" href="https://twitter.com/Medicnexus"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_twitter_icon.gif"
									border="0" /> </a>
							</td>
							<td><a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"><?php echo JText::_('TPL_MN_FACEBOOK');?> </a></td>
							<td><a href="https://www.facebook.com/pages/Medicnexus/473756712691914" target="_blank"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_fb_icon.gif"
									border="0" /> </a>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<h1>
								<?php echo JText::_('TPL_MN_INFORMATION_CHANNELS_UPPER');?>
								</h1>
							</td>
						</tr>
						<tr align="right">
							<td><a href="#"><?php echo JText::_('TPL_MN_YOUTUBE');?> </a></td>
							<td><a href="#"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_youtube_icon.gif"
									border="0" /> </a>
							</td>
							<td><a href="#"><?php echo JText::_('TPL_MN_RSS');?> </a></td>
							<td><a href="#"> <img
									src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_rss_icon.gif"
									border="0" /> </a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- end .footer -->
		<div id="final_site_band">
			<ul>
				<li><span style="color: #81197f;">MEDIC</span>NEXUS 2013</li>
				<li>|</li>
				<li><?php echo JText::_('TPL_MN_ALL_RIGHT_RESERVED_UPPER');?></li>
			</ul>
		</div>
		<div id="health_colleges_site">
			<ul>
				<li><a href="#"> <img
						src="<?php echo $this->baseurl;?>/templates/medicnexus/images/metges_college.gif"
						border="0" /> </a>
				</li>
				<li><a href="#"> <img
						src="<?php echo $this->baseurl;?>/templates/medicnexus/images/web_medica_college.gif"
						border="0" /> </a>
				</li>
			</ul>
		</div>
	<?php echo $doc->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
