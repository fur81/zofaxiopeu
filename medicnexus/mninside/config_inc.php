<?php
	$g_hostname = MN_HOST;
	$g_db_type = 'mysql';
	$g_database_name = MN_MANTIS_DATABASE;
	$g_db_username = MN_MANTIS_ROOT_USERNAME;
	$g_db_password = MN_MANTIS_ROOT_PASSWORD;
	
	# --- language --- #
        $g_default_language = 'spanish';
	
	# --- email --- #
		#$g_enable_email_notification = OFF;
        $g_phpMailer_method     = PHPMAILER_METHOD_SMTP;
        $g_smtp_host            = 'smtp.gmail.com';
        $g_smtp_username        = 'no-reply@medicnexus.com';
        $g_smtp_password        = '040320131';
        $g_smtp_connection_mode = 'ssl';
        $g_smtp_port            = 465;
        $g_administrator_email  = 'info@medicnexus.com';
        $g_webmaster_email      = 'info@medicnexus.com';
        $g_from_name            = 'Medicnexus';
        $g_from_email           = 'no-reply@medicnexus.com';
        $g_return_path_email    = 'info@medicnexus.com';
		
		#$g_validate_email
		#se utiliza para validar los correos, tener en cuenta si incluirlos o no
		
        # --- date format --- #
        $g_short_date_format = 'd/m/Y H:i';
        $g_normal_date_format = 'd/m/Y H:i';
        $g_complete_date_format = 'd/m/Y H:i';
		
        # --- branding --- #
        $g_window_title         = 'Medicnexus';
?>
