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
        $g_smtp_host            = 'mail.medicnexus.com';
        $g_smtp_username        = MN_JOOMLA_EMAIL_FROM;
        $g_smtp_password        = MN_JOOMLA_EMAIL_PASSWORD_FROM;
        $g_smtp_connection_mode = 'ssl';
        $g_smtp_port            = 465;
        $g_administrator_email  = MN_JOOMLA_EMAIL_FROM;
        $g_webmaster_email      = MN_JOOMLA_EMAIL_FROM;
        $g_from_name            = 'Medicnexus';
        $g_from_email           = MN_JOOMLA_EMAIL_FROM;
        $g_return_path_email    = MN_JOOMLA_EMAIL_FROM;
		
		#$g_validate_email
		#se utiliza para validar los correos, tener en cuenta si incluirlos o no
		
        # --- date format --- #
        $g_short_date_format = 'd/m/Y H:i';
        $g_normal_date_format = 'd/m/Y H:i';
        $g_complete_date_format = 'd/m/Y H:i';
        
        # --- Attachments / File Uploads ---
		$g_allow_file_upload	= ON;
		$g_file_upload_method	= DATABASE;
		$g_max_file_size		= MN_MANTIS_FILE_MAX_SIZE;	# in bytes
		
        # --- branding --- #
        $g_window_title         = 'Medicnexus';
?>
