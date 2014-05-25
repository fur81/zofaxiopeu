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

<body onload="MM_preloadImages('<?php echo $this->baseurl;?>/templates/medicnexus/images/g_quick_consult_service_icon.gif','<?php echo $this->baseurl;?>/templates/medicnexus/images/virtual_consult_service_icon_new.gif','<?php echo $this->baseurl;?>/templates/medicnexus/images/second_opinion_service_icon.gif')" >
  <div class="container">
    <div class="header">
    <div id="left_header_zone">
      <div id="logo_img">
          <a href="#">
            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/medicnexus_logo.gif" width="85" height="85" border="0"/>
          </a> 
        </div>
        <h1><span style="color: #81197f;">MEDIC</span>NEXUS</h1>
        <h2>Conexión directa con tu médico</h2>
        <div id="header_newsflash">
        	<jdoc:include type="modules" name="newsflash" style="xhtml" />
          <!--Zona de las noticias rápidas de la portada del sitio-->
        </div>  
    </div>
    <div id="right_header_zone">
      <div id="promo_lang_zone">
          <ul>
              <li>síguenos en:</li>
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
                                <a href="#">Mapa del sito</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">Registro de usuarios</a>
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
        	<jdoc:include type="modules" name="position-1" style="xhtml" />
            
          <!--Zona del menú principal del sitio-->
        </div>
        <div id="front_img_header"></div>
    </div>
    
    
     <!-- end .header --></div>
     
     
    
  <!--<jdoc:include type="modules" name="banner" style="xhtml" />-->
    
    <div id="sitemap_zone">
      <jdoc:include type="modules" name="position-2" style="none" />
    </div>
  <div class="sidebar">
  <jdoc:include type="modules" name="position-8" style="xhtml" />
    <div id="authentication_zone">
      <div id="box_title_sidebar">
        <!--<h1>AUTENTICACIÓN</h1>-->
        <jdoc:include type="modules" name="position-7" style="xhtml" />
      </div>
    </div>
    <div id="contact_zone">   
      <div id="box_title_sidebar">
        <h1>CONTACTO</h1>  
      </div>
      <h2>le atendemos las 24 horas del día</h2>
      
      <div id="contact_table">
      	<table width="90%" cellpadding="1" cellspacing="1" border="0">
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right">Correo:</td>
                <td style="color: #999; font-size: 11px;">contacto@medicnexus.com</td>
            </tr>
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right">Teléfono:</td>
                <td style="color: #999; font-size: 11px;">(+34) 66-683-0777</td>
            </tr>
            <tr>
                <td width="40%" style="color: #666; font-size: 11px;" align="right">Fax:</td>
                <td style="color: #999; font-size: 11px;">(+34) 91-188-6000</td>
            </tr>
          </table>	
      </div>
   
    </div>
    <!-- end .sidebar1 --></div>
    
    <div class="welcome_site_zone">
        <div id="box_title">
        	<!--<h1>BIENVENIDOS A MEDICNEXUS</h1>-->
        </div>
    
    <main id="content" role="main" class="<?php echo $span;?>">
          <!-- Begin Content -->
          <jdoc:include type="modules" name="position-3" style="xhtml" />
          <jdoc:include type="message" />
          <jdoc:include type="component" />
          
          <!-- End Content -->
        </main>

    
    <!--<jdoc:include type="modules" name="position-3" style="xhtml" />-->
    <!--Info cambiante-->
     
  	</div>
    <div id="news-article_zone">
    <div id="box_title">
    <h1>INFORMACIÓN GENERAL</h1>
        <div id="articles_zone">
        	<h1>ARTÍCULOS</h1>
            <div id="articles">
            
            </div>
        </div>
        <div id="articles-news_separator"></div>
        <div id="articles_zone">
        	<h1>NOTICIAS</h1>
            <div id="articles">
            
            </div>
        </div>
    </div>
    </div>
    
  <div class="footer">
    <div id="bottom_menu_site">
    <ul>
        <li>
            <a href="#">HOME</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">SERVICIOS</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">NOTICIAS</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">ARTICULOS</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">DOCUMENTACION</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">PREGUNTAS FRECUENTES</a>
            </li>
            <li class="bottom_menu_site_separator">::</li>
            <li>
            <a href="#">ZONA CLIENTES</a>
            </li>
        </ul>
    </div>
    <div id="bottom_submenu_site_zone">
    <div id="block_bottom_submenu">
        <h1>POLÍTICAS GENERALES DEL SITIO</h1>
            <ul>
            <li>
                <a href="#">- Políticas de privacidad</a>
                </li>
                <li>
                <a href="#">- Condiciones y términos de uso</a>
                </li>
                <li>
                <a href="#">- Mapa del sitio</a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1>SERVICIOS MÉDICOS DISPONIBLES</h1>
            <ul>
            <li>
                <a href="#">- Consulta rápida</a>
                </li>
                <li>
                <a href="#">- Consulta virtual</a>
                </li>
                <li>
                <a href="#">- Segunda opinión</a>
                </li>
                <li>
                <a href="#">- Programas de salud</a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1>SERVICIOS GENERALES DEL SITIO</h1>
            <ul>
            <li>
                <a href="#">- Noticias</a>
                </li>
                <li>
                <a href="#">- Artículos</a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="block_bottom_submenu">
        <h1>INFORMACIÓN GENERAL</h1>
            <ul>
            <li>
                <a href="#">- Preguntas frecuentes</a>
                </li>
                <li>
                <a href="#">- Documentación médica general</a>
                </li>
            </ul>
        </div>
        <div id="bottom_menu_site_separator"></div>
        <div id="bottom_social_networks_zone">
        <h1>REDES SOCIALES</h1>
            <table width="100%" cellpadding="0" cellspacing="0">
            <tr align="right">
                <td>Twitter</td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_twitter_icon.gif" border="0" />
                        </a>
                    </td>
                    <td>Facebook</td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_fb_icon.gif" border="0" />
                        </a>
                    </td>
                </tr>
                <tr>
                <td colspan="4">
                    <h1>CANALES DE INFORMACIÓN</h1>
                    </td>
                </tr>
                <tr align="right">
                <td>Youtube</td>
                    <td>
                    <a href="#">
                            <img src="<?php echo $this->baseurl;?>/templates/medicnexus/images/big_youtube_icon.gif" border="0" />
                        </a>
                    </td>
                    <td>RSS</td>
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
            <li>TODOS LOS DERECHOS RESERVADOS</li>
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
