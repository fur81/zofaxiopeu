<?php
class JConfig {
	public $offline = '0';
	public $offline_message = 'Este sitio está cerrado por tareas de mantenimiento.<br /> Por favor, inténtelo nuevamente más tarde.';
	public $display_offline_message = '1';
	public $offline_image = '';
	public $sitename = 'Medicnexus';
	public $editor = 'jckeditor';
	public $captcha = 'recaptcha';
	public $list_limit = '20';
	public $access = '1';
	public $debug = '0';
	public $debug_lang = '0';
	public $dbtype = 'mysql';
	public $host = 'mysql.medicnexus.com';
	public $user = 'cero_mn';
	public $password = 'MedicnexuS2013';
	public $db = 'cero_mn';
	public $dbprefix = 'cero_';
	public $live_site = '';
	public $secret = 'aDtDIwo3OSlv2woP';
	public $gzip = '0';
	public $error_reporting = 'default';
	public $helpurl = 'http://help.joomla.org/proxy/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'Europe/Madrid';
	public $mailer = 'smtp';
	public $mailfrom = 'no-reply@medicnexus.com';
	public $fromname = 'Medicnexus';
	public $sendmail = '/usr/sbin/sendmail';
	public $smtpauth = '1';
	public $smtpuser = 'no-reply@medicnexus.com';
	public $smtppass = 'nonono';
	public $smtphost = 'mail.medicnexus.com';
	public $smtpsecure = 'ssl';
	public $smtpport = '465';
	public $caching = '0';
	public $cache_handler = 'file';
	public $cachetime = '15';
	public $MetaDesc = 'Medicnexus';
	public $MetaKeys = '';
	public $MetaTitle = '1';
	public $MetaAuthor = '1';
	public $MetaVersion = '0';
	public $robots = '';
	public $sef = '1';
	public $sef_rewrite = '0';
	public $sef_suffix = '1';
	public $unicodeslugs = '1';
	public $feed_limit = '10';
	public $log_path = '/home/medicnexus/www/logs';
	public $tmp_path = '/home/medicnexus/www/tmp';
	public $lifetime = '15';
	public $session_handler = 'database';
	public $MetaRights = '';
	public $sitename_pagetitles = '2';
	public $force_ssl = '0';
	public $feed_email = 'author';
	public $cookie_domain = '';
	public $cookie_path = '';
}