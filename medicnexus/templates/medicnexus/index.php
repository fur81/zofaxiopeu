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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <jdoc:include type="head" />
  <link rel="stylesheet" type="text/css" href="css/template.css"/>
  <script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/medicnexus.js"></script>
  <script type="text/javascript" src="<?php echo $this->baseurl;?>/templates/medicnexus/js/template.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>MEDICNEXUS</title>
</head>

<body onload="MM_preloadImages('<?php echo $this->baseurl;?>/templates/medicnexus/images/g_quick_consult_service_icon.gif',
	'<?php echo $this->baseurl;?>/templates/medicnexus/images/virtual_consult_service_icon_new.gif',
	'<?php echo $this->baseurl;?>/templates/medicnexus/images/second_opinion_service_icon.gif')" >
  <div class="container">
    <div class="header">
    <div id="left_header_zone">
      <div id="logo_img">
          <a href="#">
            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/medicnexus_logo.gif" width="85" height="85" border="0"/>
          </a> 
        </div>
        <h1><span style="color: #81197f;">MEDIC</span>NEXUS</h1>
        <h2><?php echo JText::_('TPL_MN_DIRECT_CONNECTION');?></h2>
        <div id="header_newsflash">
        	<jdoc:include type="modules" name="newsflash" style="xhtml" />
          <!--Zona de las noticias rápidas de la portada del sitio-->
        </div>  
    </div>
    <div id="right_header_zone">
      <div id="promo_lang_zone">
          <ul>
              <li><?php echo JText::_('TPL_MN_FoLLOW_US_IN');?>:</li>
                <li>
                  <a href="#">
                      <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/fb_icon.gif" border="0" />
                    </a>
                </li>
                <li>
                  <a href="#">
                      <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/tw_icon.gif" border="0" />
                    </a>
                </li>
                <li>
                  <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/promo_lang_separator.gif" border="0" />
                </li>		
            </ul>
			
        </div>
		
		<div id="language_flag_zone">
			<jdoc:include type="modules" name="position-0" style="xhtml" />
		</div>
		
        <div id="searching_zone">
          <table cellpadding="0" cellspacing="0" align="right" >
              <tr>
                  <td style="padding-bottom: 5px;">
                      <ul>
                            <li>
                                <a href="index.php?option=com_xmap&view=html&id=0">
                                	<?php echo JText::_('TPL_MN_SITE_MAP');?></a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#"><?php echo JText::_('TPL_MN_USER_REGISTER');?></a>
                            </li>
                            <li style="margin: 2px 10px 0 5px;">
                              <a href="#">
                                    <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/register_user_icon.gif" border="0" />
                                </a>
                            </li>
                        </ul>
                    </td>
                    <td align="right" style="padding-bottom: 7px;">
                      <jdoc:include type="modules" name="general-search" style="xhtml" />
                      <!--<input name="" type="text" />-->  
                    </td>
                    <!--<td align="left" style="padding-bottom: 3px;">
                      <a href="#">
                        <img src="<?php //echo $this->baseurl;?>/templates/medicnexus/images/tbsearch_bg.gif" border="0" />
                        </a>
                    </td>-->
                </tr>
            </table>
        </div>
        <div id="top_menu">
        	<!--Zona del menú principal del sitio-->
            <jdoc:include type="modules" name="position-1" style="xhtml" /> 
        </div>
        <div id="front_img_header"></div>
    </div>
     <!-- end .header --></div>    
    <div id="sitemap_zone">
      <jdoc:include type="modules" name="position-2" style="none" />
    </div>
    <div><jdoc:include type="message" /></div>
  <div class="sidebar">
  	<jdoc:include type="modules" name="position-8" style="xhtml" />
  	<div class="side_box">
      <div class="title_bar content_sidebar title_sidebar_text">
        <!--<h1>AUTENTICACIÓN</h1>-->
        <jdoc:include type="modules" name="position-7" style="xhtml" />
      </div>
    </div>
    <div id="contact_zone">   
      
      <div class="title_bar content_sidebar title_sidebar_text">
      	<div class="box_title_right"><?php echo JText::_('TPL_MN_CONTACT_UPPER');?></div>
      </div>
      
      <div class="contact_title">
      	<?php echo JText::_('TPL_MN_ATTEND_SERVICE');?>
      </div>
           
      <div id="contact_table">
      	<table width="90%" cellpadding="1" cellspacing="1" border="0">
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right"><?php echo JText::_('TPL_MN_EMAIL');?>:</td>
                <td style="color: #999; font-size: 11px;">contacto@medicnexus.com</td>
            </tr>
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right"><?php echo JText::_('TPL_MN_PHONE');?>:</td>
                <td style="color: #999; font-size: 11px;">(+34) 66-683-0777</td>
            </tr>
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right"><?php echo JText::_('TPL_MN_FAX');?>:</td>
                <td style="color: #999; font-size: 11px;">(+34) 91-188-6000</td>
            </tr>
          </table>	
      </div>
   
    </div>
    <!-- end .sidebar1 --></div>
    
    <div class="content_box">
        <!--<div id="box_title">
        	<h1>BIENVENIDOS A MEDICNEXUS</h1>
        </div>-->
    
    	<main id="content" role="main" class="<?php echo $span;?>">
          <!-- Begin Content -->
          <jdoc:include type="modules" name="position-3" style="xhtml" />
          <div class="content_boxbar title_bar title_content_text">
          <!--<jdoc:include type="message" />-->
          </div>
          <jdoc:include type="component" />
          
          
          <!-- End Content -->
        </main>

    
    <!--<jdoc:include type="modules" name="position-3" style="xhtml" />-->
    <!--Info cambiante-->
     
  	</div>
    
    <!--<jdoc:include type="modules" name="articles-preview" style="general_info" />-->
    
    <!--<div id="news-article_zone">
        <div id="box_title">
        	<h1>INFORMACIÓN GENERAL</h1>
            <div id="articles_zone">
                <h1>ARTÍCULOS</h1>
                <div id="articles">
                	<jdoc:include type="modules" name="articles-preview" style="xhtml" />
                </div>
            </div>
            <div id="articles-news_separator"></div>
            <div id="articles_zone">
                <h1>NOTICIAS</h1>
                <div id="articles">
                	<jdoc:include type="modules" name="articles-preview" style="xhtml" />
                </div>
            </div>
        </div>
    </div>-->
    
  <div class="footer">
    <div id="bottom_menu_site">
    <ul>
        <li>
            <a href="index.php"><?php echo JText::_('TPL_MN_HOME_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=9&amp;catid=9&amp;Itemid=112">
            	<?php echo JText::_('TPL_MN_NOTICES_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=10&amp;catid=10&amp;Itemid=113">
            	<?php echo JText::_('TPL_MN_ARTICLES_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=14&amp;catid=11&amp;Itemid=117">
            	<?php echo JText::_('TPL_MN_SERVICES_UPPER');?></a>
            </li> 
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=11&amp;catid=12&amp;Itemid=114">
            	<?php echo JText::_('TPL_MN_ABOUT_US_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=12&amp;catid=13&amp;Itemid=115">
            	<?php echo JText::_('TPL_MN_DOCUMENTATION_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=13&amp;catid=14&amp;Itemid=116">
            	<?php echo JText::_('TPL_MN_FAQ_UPPER');?></a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109">
            	<?php echo JText::_('TPL_MN_CLIENT_ZONE_UPPER');?></a>
            </li>
        </ul>
    </div>
    <div id="bottom_submenu_site_zone">
    <div id="block_bottom_submenu">
        <h1><?php echo JText::_('TPL_MN_GENERAL_POLITICS_SITE_UPPER');?></h1>
            <ul>
            <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=18&amp;catid=17&amp;Itemid=104">
                	- <?php echo JText::_('TPL_MN_PRIVACY_POLITICS');?></a>
                </li>
                <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=19&amp;catid=17&amp;Itemid=104">
                	- <?php echo JText::_('TPL_MN_CONDITIONS_TERMS');?></a>
                </li>
                <li>
                <a href="index.php?option=com_xmap&view=html&id=0">
                	- <?php echo JText::_('TPL_MN_SITE_MAP');?></a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1><?php echo JText::_('TPL_MN_MEDIC_SERVICES_AVAILABLE_UPPER');?></h1>
            <ul>
            <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=rapid_consultation">
                	- <?php echo JText::_('TPL_MN_RAPID_CONSULTATION');?></a>
                </li>
                <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=virtual_consultation">
                	- <?php echo JText::_('TPL_MN_VIRTUAL_CONSULTATION');?></a>
                </li>
                <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=second_opinion">
                	- <?php echo JText::_('TPL_MN_SECOND_OPINION');?></a>
                </li>
                <li>
                <a href="index.php?option=com_content&amp;view=article&amp;id=3&amp;catid=2&amp;Itemid=109&rd=health_program">
                	- <?php echo JText::_('TPL_MN_HEALTH_PROGRAM');?></a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1><?php echo JText::_('TPL_MN_GENERAL_SERVICES_SITE_UPPER');?></h1>
            <ul>
            <li>
                <a href="#">- <?php echo JText::_('TPL_MN_NOTICES');?></a>
                </li>
                <li>
                <a href="#">- <?php echo JText::_('TPL_MN_ARTICLES');?></a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1><?php echo JText::_('TPL_MN_GENERAL_INFORMATION_UPPER');?></h1>
            <ul>
            <li>
                <a href="#">- <?php echo JText::_('TPL_MN_FRECUENTLY_QUESTIONS');?></a>
                </li>
                <li>
                <a href="#">- <?php echo JText::_('TPL_MN_GENERAL_MEDICAL_DOCUMENTATION');?></a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="bottom_social_networks_zone">
        <h1><?php echo JText::_('TPL_MN_SOCIAL_NETWORK_UPPER');?></h1>
            <table width="100%" cellpadding="0" cellspacing="0">
            <tr align="right">
                <td><a href="#"><?php echo JText::_('TPL_MN_TWITTER');?></a></td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_twitter_icon.gif" border="0" />
                        </a>
                    </td>
                    <td><a href="#"><?php echo JText::_('TPL_MN_FACEBOOK');?></a></td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_fb_icon.gif" border="0" />
                        </a>
                    </td>
                </tr>
                <tr>
                <td colspan="4">
                    <h1><?php echo JText::_('TPL_MN_INFORMATION_CHANNELS_UPPER');?></h1>
                    </td>
                </tr>
                <tr align="right">
                <td><a href="#"><?php echo JText::_('TPL_MN_YOUTUBE');?></a></td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_youtube_icon.gif" border="0" />
                        </a>
                    </td>
                    <td><a href="#"><?php echo JText::_('TPL_MN_RSS');?></a></td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_rss_icon.gif" border="0" />
                        </a>
                    </td>
                </tr>
            </table>
          <!--
            <ul>
            <li>Twitter</li>
                <li>
                <a href="#">
                    <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_twitter_icon.gif" border="0" />
                    </a>
                </li>
            </ul> -->
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
        <li>
            <a href="#">
                <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/metges_college.gif" border="0" />
                </a>
            </li>
            <li>
            <a href="#">
                <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/web_medica_college.gif" border="0" />
                </a>
            </li>
        </ul>
    </div> 
  
</body>
</html>
