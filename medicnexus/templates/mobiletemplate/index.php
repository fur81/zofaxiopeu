<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

$app = JFactory::getApplication();

include_once (dirname(__FILE__).'/blocks/head.php');

?>
    <body>
    	<!-- Header -->
        <div class="container">
            <div class="header row">
                <div class="span12">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <h1>
                                <a class="brand" href="index.html">Andia - a super cool design agency...</a>
                            </h1>
                            <div class="nav-collapse collapse">
                                <ul class="nav pull-right">
                                    <li class="current-page">
                                        <a href="index.php"><i class="icon-home"></i><br />Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->baseurl;?>/templates/mobiletemplate/portfolio.html"><i class="icon-camera"></i><br />Portfolio</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-comments"></i><br />Blog</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->baseurl;?>/templates/mobiletemplate/services.html"><i class="icon-tasks"></i><br />Services</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->baseurl;?>/templates/mobiletemplate/about.html"><i class="icon-user"></i><br />About</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->baseurl;?>/templates/mobiletemplate/contact.html"><i class="icon-envelope-alt"></i><br />Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider -->
        <div class="slider">
            <div class="container">
                <div class="row">
                    <div class="span10 offset1">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/1.jpg">
                                    <img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/1.jpg">
                                    <p class="flex-caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur.</p>
                                </li>
                                <li data-thumb="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/2.jpg">
                                    <img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/2.jpg">
                                    <p class="flex-caption">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                </li>
                                <li data-thumb="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/5.jpg">
                                    <img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/5.jpg">
                                    <p class="flex-caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur.</p>
                                </li>
                                <li data-thumb="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/6.jpg">
                                    <img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/slider/6.jpg">
                                    <p class="flex-caption">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site Description -->
        <div class="presentation container">
            <h2>Bienvenidos a <span class="blue-marine">MEDICNEXUS</span>, tu portal de salud para dispositivos móviles.</h2>
            <p>Estar informado, mantenerte al día y consultar periódicamente con tu medico es la mejor manera de mantener una vida saludable, prevenir lesiones y enfermedades que en el caso de no ser tratadas a tiempo podrían conllevar una pérdida de la calidad de vida.</p>
        </div>

        <!-- Services -->
        <div class="what-we-do container">
            <div class="row">
                <div class="service span3">
                    <!--<div class="icon-awesome">
                        <i class="icon-eye-open"></i>
                    </div>-->
                    <div style="margin-top: 10px;">
                    	<img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/quick_consult_service_icon.png" width="50" height="45">
                    </div>
                    <h4>Consulta Rápida</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
                    <a href="services.html">Read more</a>
                </div>
                <div class="service span3">
                    <!--<div class="icon-awesome">
                        <i class="icon-table"></i>
                    </div>-->
                    <div style="margin-top: 10px;">
                    	<img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/virtual_consult_service_icon.png" width="50" height="45">
                    </div>
                    <h4>Consulta Virtual</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
                    <a href="services.html">Read more</a>
                </div>
                <div class="service span3">
                    <!--<div class="icon-awesome">
                        <i class="icon-magic"></i>
                    </div>-->
                    <div style="margin-top: 10px;">
                    	<img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/second_opinion_service_icon.png" width="50" height="45">
                    </div>
                    <h4>Segunda Opinión</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
                    <a href="services.html">Read more</a>
                </div>
                <div class="service span3">
                    <!--<div class="icon-awesome">
                        <i class="icon-print"></i>
                    </div>-->
                    <div style="margin-top: 10px;">
                    	<img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/health_programs_service_icon.png" width="50" height="45">
                    </div>
                    <h4>Programa de Salud</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
                    <a href="services.html">Read more</a>
                </div>
            </div>
        </div>

        <!-- Latest Work -->
        <div class="portfolio container">
            <div class="portfolio-title">
                <h3>¿Cómo funciona?</h3>
            </div>
            <div class="row">
                <div class="work span3">
                	<div id="service_step_block">
                        <div id="header" style="background: #e1e1e1 url('<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/service_block_header_bg1.gif') no-repeat;">
                        
                            <h2>
                                Seleccionar el servicio
                            </h2>
                        </div>
                        <div id="body">
                            <div id="middle">
                                <img alt="" src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/medical_services_icon.gif" /><br />
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="work span3">
                    <img src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/personal_data_icon.png" alt="">
                    <h4>Datos personales</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor...</p>
                </div>
                <div class="work span3">
                	<div id="service_step_block">
                        <div id="header" style="background: #e1e1e1 url('<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/service_block_header_bg3.gif') no-repeat;">
                        
                            <h2>
                                Realizar la consulta
                            </h2>
                        </div>
                        <div id="body">
                            <div id="middle">
                                <img alt="" src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/medical_consult_icon.gif" /><br />
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="work span3">
                    <div id="service_step_block">
                        <div id="header" style="background: #e1e1e1 url('<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/service_block_header_bg4.gif') no-repeat;">
                        
                            <h2>
                                Esperar respuesta
                            </h2>
                        </div>
                        <div id="body">
                            <div id="middle">
                                <img alt="" src="<?php echo $this->baseurl;?>/templates/mobiletemplate/assets/img/medical_response_icon.gif" /><br />
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="widget span3">
                        <h4>About Us</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                        <p><a href="">Read more...</a></p>
                    </div>
                    <!--<div class="widget span3">
                        <h4>Latest Tweets</h4>
                        <div class="show-tweets"></div>
                    </div>
                    <div class="widget span3">
                        <h4>Flickr Photos</h4>
                        <ul class="flickr-feed"></ul>
                    </div>-->
                    <div class="widget span3">
                        <h4>Contact Us</h4>
                        <p><i class="icon-map-marker"></i> Barcelona, España</p>
                        <p><i class="icon-phone"></i> Teléfono: 0034 333 12 68 347</p>
                        <p><i class="icon-user"></i> Skype: Medicnexus_Skype</p>
                        <p><i class="icon-envelope-alt"></i> Email: <a href="">contacto@medicnexus.com</a></p>
                    </div>
                </div>
                <div class="footer-border"></div>
                <div class="row">
                    <div class="copyright span4">
                        <p>Copyright 2014 Medicnexus - All rights reserved.</p>
                    </div>
                    <div class="social span8">
                        <a class="facebook" href=""></a>
                        <a class="dribbble" href=""></a>
                        <a class="twitter" href=""></a>
                        <a class="pinterest" href=""></a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>