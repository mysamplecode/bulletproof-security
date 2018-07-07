<?php
#  ________         ____________      _____ ________                       ________      
#  ___  __ )____  _____  /___  /_____ __  /____  __ \______________ ______ ___  __/      
#  __  __  |_  / / /__  / __  / _  _ \_  __/__  /_/ /__  ___/_  __ \_  __ \__  /_        
#  _  /_/ / / /_/ / _  /  _  /  /  __// /_  _  ____/ _  /    / /_/ // /_/ /_  __/        
#  /_____/  \__,_/  /_/   /_/   \___/ \__/  /_/      /_/     \____/ \____/ /_/           
#  ________                             _____ _____              ________                
#  __  ___/_____ ___________  _____________(_)__  /______  __    ___  __ \______________ 
#  _____ \ _  _ \_  ___/_  / / /__  ___/__  / _  __/__  / / /    __  /_/ /__  ___/_  __ \
#  ____/ / /  __// /__  / /_/ / _  /    _  /  / /_  _  /_/ /     _  ____/ _  /    / /_/ /
#  /____/  \___/ \___/  \__,_/  /_/     /_/   \__/  _\__, /      /_/      /_/     \____/ 
#                                                   /____/                               
# 42756C6C657450726F6F66 5365637572697479 50726F 
#
// Direct calls to this file are Forbidden when core files are not present 
if ( !function_exists ('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

/*	The Copyright, AITpro Software Products License Information and Credit Where Credit Is Due information below must remain
	intact or all BulletProof Security Pro warranties, guarantees, liabilities are void.
	
	Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com. All rights reserved.

	AITpro Software Products License Information:
	BY DOWNLOADING, INSTALLING, COPYING, ACCESSING, OR USING BulletProof Security Pro YOU AGREE TO THE TERMS OF THIS AGREEMENT. 
	IF YOU 	ARE ACCEPTING THESE TERMS ON BEHALF OF ANOTHER PERSON OR A COMPANY OR OTHER LEGAL ENTITY, YOU REPRESENT AND WARRANT
	THAT YOU HAVE FULL AUTHORITY TO BIND THAT PERSON, COMPANY, OR LEGAL ENTITY TO THESE TERMS. IF YOU DO NOT AGREE TO THESE TERMS,
	* DO NOT DOWNLOAD, INSTALL, COPY, ACCESS, OR USE BulletProof Security Pro; AND
	* PROMPTLY RETURN BulletProof Security Pro TO THE PARTY FROM WHOM YOU ACQUIRED IT. IF YOU DOWNLOADED BulletProof Security Pro
	FROM THE AITPRO WEBSITE, CONTACT AITPRO FOR A REFUND IF APPLICABLE.
	
	AITpro Software Products License Information continued:
	You agree to keep the AITpro Software Products License for BulletProof Security Pro, unmodified or altered in any way,
	with the original copy of BulletProof Security Pro that you have and any and all copies or partial copies of BulletProof
	Security Pro that You make. 

	Credit Where Credit Is Due:
	Bonus Code:
	The following bonus code scripts, snippets or example code do not make up the core coding of BulletProof Security Pro 
	and are not included in the price of BulletProof Security Pro as they are free code scripts, snippets or example code 
	and are added as Bonus Code features to BulletProof Security Pro. Bonus Code has been adapted, modified and recoded 
	to work for WordPress and BPS Pro where necessary.

	DB String Finder code - AnyWhereInDB - author Nafis Ahmad
	DB Table Cleaner/Remover code - Copyright (c) 2009 Lester "GaMerZ" Chan
*/

// Displays Initial, Peak and Total Memory usage
function bpsPro_memory_resource_usage() {
	
	if ( is_admin() && current_user_can('manage_options') ) {

	$memory_usage_peak = memory_get_peak_usage();
	$mbytes_peak = number_format( $memory_usage_peak / ( 1024 * 1024 ), 2 );
	$kbytes_peak = number_format( $memory_usage_peak / ( 1024 ) );	
	
	$memory_usage = memory_get_usage();
	$mbytes = number_format( $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes = number_format( $memory_usage / ( 1024 ) );
	
	$mbytes_total = number_format( $memory_usage_peak / ( 1024 * 1024 ) - $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes_total = number_format( $memory_usage_peak / ( 1024 ) - $memory_usage / ( 1024 ) );	
	
	$usage = '<strong>'.__('Peak Memory Usage: ', 'bulletproof-security').'</strong>'. $mbytes_peak . __('MB|', 'bulletproof-security').$kbytes_peak.__('KB', 'bulletproof-security').'<br><strong>'.__('Initial Memory in Use: ', 'bulletproof-security').'</strong>'. $mbytes . __('MB|', 'bulletproof-security').$kbytes.__('KB', 'bulletproof-security').'<br><strong>'.__('Total Memory Used: ', 'bulletproof-security').'</strong>'. $mbytes_total . __('MB|', 'bulletproof-security').$kbytes_total.__('KB', 'bulletproof-security').'<br>';

	return $usage;
	}
}

// Logs Initial, Peak and Total Memory usage
function bpsPro_memory_resource_usage_logging() {
	
	$memory_usage_peak = memory_get_peak_usage();
	$mbytes_peak = number_format( $memory_usage_peak / ( 1024 * 1024 ), 2 );
	$kbytes_peak = number_format( $memory_usage_peak / ( 1024 ) );	
	
	$memory_usage = memory_get_usage();
	$mbytes = number_format( $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes = number_format( $memory_usage / ( 1024 ) );
	
	$mbytes_total = number_format( $memory_usage_peak / ( 1024 * 1024 ) - $memory_usage / ( 1024 * 1024 ), 2 );
	$kbytes_total = number_format( $memory_usage_peak / ( 1024 ) - $memory_usage / ( 1024 ) );	
	
	$usage = __('Peak Memory Usage: ', 'bulletproof-security'). $mbytes_peak . __('MB|', 'bulletproof-security').$kbytes_peak.__('KB', 'bulletproof-security')."\r\n".__('Initial Memory in Use: ', 'bulletproof-security'). $mbytes . __('MB|', 'bulletproof-security').$kbytes.__('KB', 'bulletproof-security')."\r\n".__('Total Memory Used: ', 'bulletproof-security'). $mbytes_total . __('MB|', 'bulletproof-security').$kbytes_total.__('KB', 'bulletproof-security');

	return $usage;
}

// S-Monitor - PHP Error Log Path/Location Check - Check if the php error log path is valid - WP Only
// ini_set Options Checks & auto-update wp-config.php & add the 3 new ini_set options.
function bps_smonitor_phpini_wp() {

	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');
	$options3 = get_option('bulletproof_security_options2');	
	$ElogPathSet = $options3['bps_error_log_location'];	
	
	if ( $options['bps_PHP_ELogLoc_set'] == 'wpOn' && $ElogPathSet != '' ) { 
	
	$ElogPathServer = ini_get('error_log');
	$ElogPathServerXampp = addslashes( ini_get('error_log') );	
	
	if ( strcmp($ElogPathServer, $ElogPathSet) != 0 && strcmp($ElogPathServerXampp, $ElogPathSet) != 0 ) { // 0 is equal - != 0 means that the paths do not match
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('PHP Error Log Path Does Not Match', 'bulletproof-security').'</font><br>'.__('The PHP Error Log Location Set To: folder path does not match the Error Log Path Seen by Server: folder path.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the PHP Error Log page and click the Htaccess Protected Secure PHP Error Log Read Me button for troubleshooting steps.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}

	if ( $options['bps_phpini_created'] == 'wpOn' ) { 
	
	//$options2 = get_option('bulletproof_security_options');
	$ini_set_options = get_option('bulletproof_security_options_iniSet');

	if ( ! $ini_set_options['bps_iniSet_ErrorReporting'] ) { 
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('ini_set Options Need To Be Saved & The PHP Error Log Path/Location Needs To Be Set', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the P-Security ini_set Options page and click the 1. Save Options button, click the 2. Enable Options button, click the Refresh Status button and go to the PHP Error Log tab page.', 'bulletproof-security').'<br>'.__('Copy the Error Log Path Seen by Server: file path to the PHP Error Log Location Set To: text box and click the Set Error Log Location button.', 'bulletproof-security').'<br>'.__('Click the Read Me Help buttons if you need additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}

	$wpconfig = ABSPATH . 'wp-config.php';
	$wpconfigARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';

	// automatic ini_set update if the wp-config.php file exists in the root folder & display a one time New Feature notification
	if ( file_exists($wpconfig) && ! $ini_set_options['bps_iniSet_session_cookie_httponly'] ) {
		$sapi_type = php_sapi_name();
		$permsWpconfig = @substr( sprintf('%o', fileperms($wpconfig) ), -4);
		$Flockoptions = get_option('bulletproof_security_options_flock');
		$subject = file_get_contents($wpconfig);
		$pattern = '/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s';
		
		$replacement = "/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$ini_set_options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$ini_set_options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$ini_set_options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$ini_set_options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$ini_set_options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','On');
@ini_set('session.use_only_cookies','On');
@ini_set('session.cookie_secure','Off');
@ini_set('ignore_repeated_errors','".$ini_set_options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$ini_set_options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$ini_set_options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$ini_set_options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$ini_set_options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$ini_set_options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$ini_set_options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$ini_set_options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$ini_set_options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$ini_set_options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$ini_set_options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$ini_set_options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/";		
		
		if ( preg_match($pattern, $subject, $matches) && $ini_set_options['bps_iniSet_ErrorLog'] != '' && $ini_set_options['bps_iniSet_LogErrorsMaxLen'] != '' && $ini_set_options['bps_iniSet_MemoryLimit'] != '' && $ini_set_options['bps_iniSet_MaxExecutionTime'] != '' && $ini_set_options['bps_iniSet_MysqlConnectTimeout'] != '') {
		
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpconfig != '0666' || @$permsWpconfig != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpconfig, 0644);
			}
		
			$stringReplace = @file_get_contents($wpconfig);
			$stringReplace = preg_replace('/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s', $replacement, $stringReplace);
		
			if ( file_put_contents($wpconfig, $stringReplace) ) {		
				@copy($wpconfig, $wpconfigARQ);	

					$BPS_Options5 = array(
					'bps_iniSet_ErrorReporting' 			=> $ini_set_options['bps_iniSet_ErrorReporting'], 
					'bps_iniSet_LogErrors' 					=> $ini_set_options['bps_iniSet_LogErrors'], 
					'bps_iniSet_ErrorLog' 					=> $ini_set_options['bps_iniSet_ErrorLog'], 
					'bps_iniSet_LogErrorsMaxLen' 			=> $ini_set_options['bps_iniSet_LogErrorsMaxLen'], 
					'bps_iniSet_MemoryLimit' 				=> $ini_set_options['bps_iniSet_MemoryLimit'], 
					'bps_iniSet_session_cookie_httponly' 	=> 'On', 
					'bps_iniSet_session_use_only_cookies' 	=> 'On', 
					'bps_iniSet_session_cookie_secure' 		=> 'Off', 
					'bps_iniSet_IgnoreRepeatedErrors' 		=> $ini_set_options['bps_iniSet_IgnoreRepeatedErrors'], 
					'bps_iniSet_IgnoreRepeatedSource' 		=> $ini_set_options['bps_iniSet_IgnoreRepeatedSource'], 
					'bps_iniSet_AllowUrlInclude' 			=> $ini_set_options['bps_iniSet_AllowUrlInclude'], 
					'bps_iniSet_DefineSyslogVar' 			=> $ini_set_options['bps_iniSet_DefineSyslogVar'], 
					'bps_iniSet_DisplayErrors' 				=> $ini_set_options['bps_iniSet_DisplayErrors'], 
					'bps_iniSet_DisplayStartupErrors' 		=> $ini_set_options['bps_iniSet_DisplayStartupErrors'], 
					'bps_iniSet_ImplicitFlush' 				=> $ini_set_options['bps_iniSet_ImplicitFlush'], 
					'bps_iniSet_MagicQuotesRuntime' 		=> $ini_set_options['bps_iniSet_MagicQuotesRuntime'], 
					'bps_iniSet_MaxExecutionTime' 			=> $ini_set_options['bps_iniSet_MaxExecutionTime'], 
					'bps_iniSet_MysqlConnectTimeout' 		=> $ini_set_options['bps_iniSet_MysqlConnectTimeout'], 
					'bps_iniSet_MysqlTraceMode' 			=> $ini_set_options['bps_iniSet_MysqlTraceMode'], 
					'bps_iniSet_ReportMemleaks' 			=> $ini_set_options['bps_iniSet_ReportMemleaks'] 
					);
					
					foreach( $BPS_Options5 as $key => $value ) {
						update_option('bulletproof_security_options_iniSet', $BPS_Options5);
					}				
				
				if ( substr($sapi_type, 0, 6) != 'apache' && @$permsWpconfig == '0644' || $Flockoptions['bps_lock_wpconfig'] == 'yes') {			
					@chmod($wpconfig, 0400);
				}		
			}
		}
	}
	}
	}
}
add_action('admin_notices', 'bps_smonitor_phpini_wp');

// ARQ Deactivate FailSafe - checks that class.php backup files exists - if not ARQ DB option is set to Off
function bpsClassBackup() {

	if ( current_user_can('manage_options') ) {
	
	$bps_classphp = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';
	
	if ( ! file_exists($bps_classphp) ) {
		
		$options = get_option('bulletproof_security_options_exclude_folder');
		$ARQoptions = get_option('bulletproof_security_options_ARCM');

		if ( $options['bpsexclude_input_1'] != '' || $options['bpsexclude_input_2'] != '' || $options['bpsexclude_input_3'] != '' || $options['bpsexclude_input_4'] != '' || $options['bpsexclude_input_5'] != '' || $options['bpsexclude_input_6'] != '' || $options['bpsexclude_input_7'] != '' || $options['bpsexclude_input_8'] != '' || $options['bpsexclude_input_9'] != '' || $options['bpsexclude_input_10'] != '' || $options['bpsexclude_input_11'] != '' || $options['bpsexclude_input_12'] != '' || $options['bpsexclude_input_13'] != '' || $options['bpsexclude_input_14'] != '' || $options['bpsexclude_input_15'] != '' || $options['bpsexclude_input_16'] != '' || $options['bpsexclude_input_17'] != '' || $options['bpsexclude_input_18'] != '' || $options['bpsexclude_input_19'] != '' || $options['bpsexclude_input_20'] != '') {
			
		$bps_option_name = 'bulletproof_security_options_ARCM';
	
		if ( ! $ARQoptions['bps_autorestore_cron_frequency'] ) {
			$bps_new_value_1 = '2';	
		} else {
			$bps_new_value_1 = $ARQoptions['bps_autorestore_cron_frequency'];
		}	
	
		$bps_new_value_2 = 'Off';
		$bps_new_value_3 = 'Off';

		if ( ! $ARQoptions['bps_autorestore_cron_filecheck'] ) {
			$bps_new_value_3a = 'On';	
		} else {
			$bps_new_value_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
		}

		if ( ! $ARQoptions['bps_autorestore_cron_forced'] ) {
			$bps_new_value_4 = '1';	
		} else {
			$bps_new_value_4 = $ARQoptions['bps_autorestore_cron_forced'];
		}	
	
		if ( ! $ARQoptions['bps_autorestore_cron_end'] ) {
			$bps_new_value_5 = '';	
		} else {
			$bps_new_value_5 = $ARQoptions['bps_autorestore_cron_end'];
		}

		$BPS_Options = array(
		'bps_autorestore_cron_frequency' 	=> $bps_new_value_1, 
		'bps_autorestore_cron' 				=> $bps_new_value_2, 
		'bps_autorestore_cron_override' 	=> $bps_new_value_3, 
		'bps_autorestore_cron_filecheck' 	=> $bps_new_value_3a, 
		'bps_autorestore_cron_forced' 		=> $bps_new_value_4, 
		'bps_autorestore_cron_end' 			=> $bps_new_value_5
		);	
	
		if ( ! get_option( $bps_option_name ) ) {	
		
			foreach( $BPS_Options as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options);
			}
	
		} else {

			foreach( $BPS_Options as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options);
			}	
		}

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('ARQ FailSafe Procedural Shutdown', 'bulletproof-security').'</font><br>'.__('This procedural ARQ FailSafe Shutdown happens when ARQ is turned On and you are creating Exclude Rules.', 'bulletproof-security').'<br>'.__('This FailSafe ensures that no files are accidentally sent to Quarantine while you are creating your Exclude Rules.', 'bulletproof-security').'<br>'.__('Once you have completed creating your Exclude Rules you can turn ARQ back On by selecting your Cron Check Frequency, selecting Turn On ARQ Cron and clicking the Save ARQ Cron Options button.', 'bulletproof-security').'<br>'.__('If you are going to manually modify any of your website files be sure to click the appropriate ARQ Backup Files button before turning ARQ back On.', 'bulletproof-security').'</div>';
			echo $text;
		}
	}
	}
}
add_action( 'admin_notices', 'bpsClassBackup' );

// Automated Uploads Folder BulletProof Mode
// Note: A copy of the .htaccess file does not need to be copied to bps-backup since the /uploads is not checked by ARQ
// MU Notes: file will be copied to both uploads and blogs.dir folders if they exist. If the UPLOADS Constant has 
// been used in wp-config.php then user will have to manually add the uploads.htaccess file.
// there is 1+ year debate about the UPLOADS constant and there are other issues as well - not going there
function bps_Uploads_Folder_Lockdown() {

	if ( current_user_can('update_core') ) {

		$bps_Uploads_Dir = wp_upload_dir();
		$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder

		if ( ! is_multisite() && is_dir( $bps_Uploads_Dir['basedir'] ) && file_exists($UploadsHtaccess) ) {
			return;
		}

		$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess'; // for MU Only - is the /blogs.dir folder		
		
		if ( is_multisite() && is_dir( $bps_Uploads_Dir['basedir'] ) && file_exists($UploadsHtaccess) && is_dir( ABSPATH . @UPLOADBLOGSDIR ) && file_exists($UploadsHtaccessBlogsDir) ) {
			return;
		}

		$UploadsHtaccessRenamed = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/manual_uploads.htaccess';
		$UploadsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/uploads.htaccess';
		$bps_uploads_dir = str_replace( ABSPATH, '', $bps_Uploads_Dir['basedir'] );
		$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );		

		if ( is_dir( $bps_Uploads_Dir['basedir'] ) && ! file_exists($UploadsHtaccess) && ! file_exists($UploadsHtaccessRenamed ) ) {
		if ( @!copy($UploadsHtaccessMaster, $UploadsHtaccess )) {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Failed to Activate Uploads Folder BulletProof Mode', 'bulletproof-security').'</font><br>'.__('Unable to automatically Copy and Rename the /bulletproof-security/admin/htaccess/uploads.htaccess file to /', 'bulletproof-security').$bps_uploads_dir.__('/.htaccess.', 'bulletproof-security').'<br>'.__('If your Server API is DSO and not CGI/suPHP then you will have to manually activate the Uploads Folder BulletProof Mode on the Security Modes page.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the B-Core Security Modes page.', 'bulletproof-security').'</div>';
			echo $text;		
		} else {
			@copy($UploadsHtaccessMaster, $UploadsHtaccess);	
		}
		}
	
	if ( is_multisite() ) {
		if ( is_dir( $bps_Uploads_Dir['basedir'] ) && ! file_exists($UploadsHtaccess) && ! file_exists($UploadsHtaccessRenamed ) ) {
		if ( @!copy($UploadsHtaccessMaster, $UploadsHtaccess )) {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Failed to Activate Uploads Folder BulletProof Mode', 'bulletproof-security').'</font><br>'.__('Unable to automatically Copy and Rename the /bulletproof-security/admin/htaccess/uploads.htaccess file to /', 'bulletproof-security').$bps_uploads_dir.__('/.htaccess.', 'bulletproof-security').'<br>'.__('If your Server API is DSO and not CGI/suPHP then you will have to manually activate the Uploads Folder BulletProof Mode on the Security Modes page.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the B-Core Security Modes page.', 'bulletproof-security').'</div>';
			echo $text;		
		} else {
			@copy($UploadsHtaccessMaster, $UploadsHtaccess);	
		}
		}	
	
		if ( is_dir( ABSPATH . @UPLOADBLOGSDIR ) && ! file_exists($UploadsHtaccessBlogsDir) && ! file_exists($UploadsHtaccessRenamed ) ) {
		if ( @!copy($UploadsHtaccessMaster, $UploadsHtaccessBlogsDir ) ) {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Failed to Activate /blogs.dir Uploads Folder BulletProof Mode', 'bulletproof-security').'</font><br>'.__('Unable to automatically Copy and Rename the /bulletproof-security/admin/htaccess/uploads.htaccess file to /', 'bulletproof-security').$bps_wpcontent_dir.__('/blogs.dir/.htaccess.', 'bulletproof-security').'<br>'.__('If your Server API is DSO and not CGI/suPHP then you will have to manually activate the Uploads Folder BulletProof Mode on the Security Modes page.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the B-Core Security Modes page.', 'bulletproof-security').'</div>';
			echo $text;		
		} else {		
			@copy($UploadsHtaccessMaster, $UploadsHtaccessBlogsDir);	
		}
		}
	} // end is multisite
	} // end if user can update core
}
add_action('admin_notices', 'bps_Uploads_Folder_Lockdown');

// BPS Master htaccess File Editing - file checks and get contents for editor
function bps_get_secure_htaccess() {
$secure_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';

	if ( file_exists($secure_htaccess_file) ) {
		$bpsString = file_get_contents($secure_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The secure.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the secure.htaccess file exists and is named secure.htaccess.', 'bulletproof-security');
	}
}

function bps_get_default_htaccess() {
$default_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';

	if ( file_exists($default_htaccess_file) ) {
		$bpsString = file_get_contents($default_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The default.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the default.htaccess file exists and is named default.htaccess.', 'bulletproof-security');
	}
}

function bps_get_plugins_htaccess() {
$file = WP_PLUGIN_DIR . '/.htaccess';
	
	if ( file_exists($file) ) {
		$bpsString = file_get_contents($file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('An htaccess file was not found in your /', 'bulletproof-security').$bps_plugin_dir.__(' folder.', 'bulletproof-security');
	}
}

function bps_get_uploads_htaccess() {
$bps_Uploads_Dir = wp_upload_dir();
$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder
	
	if ( file_exists($UploadsHtaccess) ) {
		$bpsString = file_get_contents($UploadsHtaccess);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your /uploads folder.', 'bulletproof-security');
	}
}

function bps_get_blogsdir_htaccess() {
$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess'; // for MU Only - is the /blogs.dir folder
	
	if ( is_multisite() && is_super_admin() ) {	
	if ( file_exists($UploadsHtaccessBlogsDir) ) {
		$bpsString = file_get_contents($UploadsHtaccessBlogsDir);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your /blogs.dir folder.', 'bulletproof-security');
	}
	}
}

function bps_get_wpadmin_htaccess() {
$wpadmin_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';

	if ( file_exists($wpadmin_htaccess_file) ) {
		$bpsString = file_get_contents($wpadmin_htaccess_file);
		echo $bpsString;
	} else {
		$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
		_e('The wpadmin-secure.htaccess file either does not exist or is not named correctly. Check the /', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/htaccess/ folder to make sure the wpadmin-secure.htaccess file exists and is named wpadmin-secure.htaccess.', 'bulletproof-security');
	}
}

// The current active root htaccess file - file check
function bps_get_root_htaccess() {
$root_htaccess_file = ABSPATH . '.htaccess';
	
	if ( file_exists($root_htaccess_file) ) {
		$bpsString = file_get_contents($root_htaccess_file);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your website root folder.', 'bulletproof-security');
	}
}

// The current active wp-admin htaccess file - file check
function bps_get_current_wpadmin_htaccess_file() {
$current_wpadmin_htaccess_file = ABSPATH . 'wp-admin/.htaccess';
	
	if ( file_exists($current_wpadmin_htaccess_file) ) {
		$bpsString = file_get_contents($current_wpadmin_htaccess_file);
		echo $bpsString;
	} else {
		_e('An htaccess file was not found in your wp-admin folder.', 'bulletproof-security');
	}
}

// File write checks for editor
function bps_secure_htaccess_file_check() {
$secure_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';
	
	if ( ! is_writable($secure_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the secure.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_default_htaccess_file_check() {
$default_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';
	
	if ( ! is_writable($default_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the default.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_wpadmin_htaccess_file_check() {
$wpadmin_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	
	if ( ! is_writable($wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the wpadmin-secure.htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_root_htaccess_file_check() {
$root_htaccess_file = ABSPATH . '.htaccess';
	
	if ( ! is_writable($root_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the Root htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// File write checks for editor
function bps_current_wpadmin_htaccess_file_check() {
$current_wpadmin_htaccess_file = ABSPATH . 'wp-admin/.htaccess';
	
	if ( ! is_writable($current_wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to the wp-admin htaccess file. Cause: file Permission or file Ownership problem.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// B-Core Security Status inpage display - Root .htaccess
function bps_root_htaccess_status() {

	$filename = ABSPATH . '.htaccess';
	
	if ( ! file_exists($filename) ) {
		$text = '<font color="red">'.__('ERROR: An htaccess file was NOT found in your root folder', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</font><br><br>';
		echo $text;
	
	} else {
	
	global $bpspro_version, $bpspro_last_version;	
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);
	$check_string = @file_get_contents($filename);	
	
	if ( file_exists($filename) ) {
		$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your root folder is:', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	print($section);

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( ! strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			$text = '<font color="red"><br><br><strong>'.__('BPS may be in the process of updating the version number in your root htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to click the AutoMagic buttons and activate all BulletProof Modes again.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {		
			$text = '<font color="green"><strong><br><br>&radic; '.__('wp-config.php is htaccess protected by BPS', 'bulletproof-security').'<br>&radic; '.__('php.ini and php5.ini are htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		break;
		}
    case $bpspro_version:
		if ( ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			$text = '<font color="red"><br><br><strong>'.__('BPS may be in the process of updating the version number in your root htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to click the AutoMagic buttons and activate all BulletProof Modes again.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ) ) {		
			$text = '<font color="green"><strong><br><br>&radic; '.__('wp-config.php is htaccess protected by BPS', 'bulletproof-security').'<br>&radic; '.__('php.ini and php5.ini are htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
			echo $text;
		break;
		}
	default:
		$text = '<font color="red"><br><br><strong>'.__('ERROR: Either a BPS htaccess file was NOT found in your root folder or you have not activated BulletProof Mode for your Root folder yet, Default Mode is activated or the version of the BPS Pro htaccess file that you are using is not the most current version or the BPS QUERY STRING EXPLOITS code does not exist in your root htaccess file. Please view the Read Me Help button above.', 'bulletproof-security').'<br><br>'.__('wp-config.php is NOT htaccess protected by BPS', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
}}}}

// B-Core Security Status inpage display - wp-admin .htaccess
function bps_wpadmin_htaccess_status() {
	
	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<font color="blue"><strong>'.__('wp-admin BulletProof Mode is disabled on the Security Modes page or you have a Go Daddy Managed WordPress Hosting account type.', 'bulletproof-security').'</strong></font>';
		echo $text;
	return;
	}

	$filename = ABSPATH . 'wp-admin/.htaccess';

	if ( ! file_exists($filename) ) {
		$text = '<font color="red"><strong>'.__('ERROR: An htaccess file was NOT found in your wp-admin folder.', 'bulletproof-security').'<br>'.__('BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	
	} else {
	
	global $bpspro_version, $bpspro_last_version;
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);
	$check_string = @file_get_contents($filename);	

	if ( file_exists($filename) ) {

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( ! strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			$text = '<font color="red"><strong><br><br>'.__('BPS may be in the process of updating the version number in your wp-admin htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your wp-admin htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to activate BulletProof Mode for your wp-admin folder again.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {		
			$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your wp-admin folder is:', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		print($section);
		break;
		}
    case $bpspro_version:
		if ( ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			$text = '<font color="red"><strong><br><br>'.__('BPS may be in the process of updating the version number in your wp-admin htaccess file. Refresh your browser to display your current security status and this message should go away. If the BPS QUERY STRING EXPLOITS code does not exist in your wp-admin htaccess file then the version number update will fail and this message will still be displayed after you have refreshed your Browser. You will need to activate BulletProof Mode for your wp-admin folder again.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {		
			$text = '<font color="green"><strong>'.__('The htaccess file that is activated in your wp-admin folder is:', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		print($section);
		break;
		}
	default:
	$text = '<font color="red"><strong><br><br>'.__('ERROR: A valid BPS htaccess file was NOT found in your wp-admin folder. Either you have not activated BulletProof Mode for your wp-admin folder yet or the version of the wp-admin htaccess file that you are using is not the most current version. BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'</strong></font><br><br>';
	echo $text;
}}}}

// B-Core Security Status inpage status display - /plugins/.htaccess
function bps_plugins_htaccess_status() {
$filename = WP_PLUGIN_DIR . '/.htaccess';

	if ( ! file_exists($filename) ) {
		$text = '<font color="red"><strong><br><br>'.__('An htaccess file was NOT found in your plugins folder.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	
	if ( file_exists($filename) ) {
	
	$section = @file_get_contents($filename, NULL, NULL, 2, 45);
	$check_string = @file_get_contents($filename);	

	if ( ! strpos( $check_string, "BULLETPROOF PRO .HTACCESS PLUGIN FIREWALL" ) ) {
		$text = '<font color="red"><strong><br><br>'.__('ERROR: The htaccess file that was found in your plugins folder does not appear to be a valid BPS .htaccess file. Go to the htaccess File Editor Tab page and check the Your Current Plugins htaccess File with the BPS file editor.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	
	if ( strpos( $check_string, "BULLETPROOF PRO .HTACCESS PLUGIN FIREWALL" ) ) {
		$text = '<font color="green"><strong><br><br>'.__('The htaccess file that is activated in your plugins folder is:', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	print($section);
	}
	}
}

// B-Core Security Status inpage display - /uploads/.htaccess
function bps_uploads_htaccess_status() {
$bps_Uploads_Dir = wp_upload_dir();
$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder

	if ( ! file_exists($UploadsHtaccess) ) {
		$text = '<font color="red"><strong><br><br>'.__('ERROR: An htaccess file was NOT found in your uploads folder.', 'bulletproof-security').'<br>'.__('The /uploads/.htaccess file is created automatically unless your Server type requires that you create this file manually. If you need to create the Uploads Folder BulletProof Mode manually you can do this on the Security Modes page.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	
	$check_string = @file_get_contents($UploadsHtaccess);		
	
	if ( file_exists($UploadsHtaccess) && ! strpos( $check_string, "BULLETPROOF PRO UPLOADS FOLDER .HTACCESS" ) ) {
		$text = '<font color="red"><strong><br><br>'.__('ERROR: The htaccess file that was found in your uploads folder does not appear to be a valid BPS .htaccess file. Go to the htaccess File Editor Tab page and check the Your Current Uploads htaccess File with the BPS file editor.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	if ( file_exists($UploadsHtaccess) && strpos( $check_string, "BULLETPROOF PRO UPLOADS FOLDER .HTACCESS" ) ) {
		$text = '<font color="green"><strong><br><br>'.__('The htaccess file that is activated in your uploads folder is:', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		$section = @file_get_contents($UploadsHtaccess, NULL, NULL, 2, 45);
	print($section);
	}
}

// B-Core Security Status inpage display - MU ONLY /blogs.dir/.htaccess
function bps_blogsdir_htaccess_status() {

	if ( is_multisite() && is_super_admin() && is_dir( ABSPATH . @UPLOADBLOGSDIR ) ) {
	
	$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess'; // for MU Only - is the /blogs.dir folder	
	
	if ( ! file_exists($UploadsHtaccessBlogsDir) ) {
		$text = '<font color="red"><strong><br><br>'.__('ERROR: An htaccess file was NOT found in your blogs.dir uploads folder.', 'bulletproof-security').'<br>'.__('The /blogs.dir/.htaccess file is created automatically unless your Server type requires that you create this file manually. If you need to create the blogs.dir Uploads Folder BulletProof Mode manually you can do this on the Security Modes page.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	
	$check_string = @file_get_contents($UploadsHtaccessBlogsDir);	
	
	if ( file_exists($UploadsHtaccessBlogsDir) && !strpos($check_string, "BULLETPROOF PRO UPLOADS FOLDER .HTACCESS")) {
		$text = '<font color="red"><strong><br><br>'.__('ERROR: The htaccess file that was found in your blogs.dir uploads folder does not appear to be a valid BPS .htaccess file. Go to the htaccess File Editor Tab page and check the Your Current blogs.dir htaccess File with the BPS file editor.', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
	if ( file_exists($UploadsHtaccessBlogsDir) && strpos($check_string, "BULLETPROOF PRO UPLOADS FOLDER .HTACCESS")) {
		$text = '<font color="green"><strong><br><br>'.__('The htaccess file that is activated in your blogs.dir uploads folder is:', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		$section = @file_get_contents($UploadsHtaccessBlogsDir, NULL, NULL, 2, 45);	
	print($section);
	}
	}
}

// Check for WP readme.html file and if valid BPS .htaccess file is activated
// section: offset 3 get 46 characters
// check_string: start check from character 17 for 0 == character 18
// #   BULLETPROOF PRO 10 SECURE .HTACCESS
function bps_filesmatch_check_readmehtml() {
$htaccess_filename = ABSPATH . '.htaccess';

	if ( file_exists($htaccess_filename) ) {
	
	global $bpspro_readme_install_ver;		
	$section = @file_get_contents( $htaccess_filename, NULL, NULL, 3, 46 );
	$check_string = @strpos( $section, $bpspro_readme_install_ver, 17 );

		$filename = ABSPATH . 'readme.html';

		if ( ! file_exists($filename) ) {
			$text = '<font color="green"><strong>&radic; '.__('The WP readme.html file does not exist', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		
		} else {
		
			$check_stringBPSQSE = @file_get_contents($htaccess_filename);

			if ( $check_string == "18" && strpos( $check_stringBPSQSE, "BPSQSE") ) {
				$text = '<font color="green"><strong>&radic; '.__('The WP readme.html file is htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			} else {
				$text = '<font color="red"><strong>'.__('ERROR: The WP readme.html file is not htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			}
		}
	}
}

// Check for WP /wp-admin/install.php file and if valid BPS .htaccess file is activated
// section: offset 3 get 46 characters
// check_string: start check from character 17 for 0 == character 18
// #   BULLETPROOF PRO 10 WP-ADMIN SECURE .HTACCESS
function bps_filesmatch_check_installphp() {
$htaccess_filename = ABSPATH . 'wp-admin/.htaccess';

	if ( file_exists($htaccess_filename) ) {
		
	global $bpspro_readme_install_ver;
	$section = @file_get_contents( $htaccess_filename, NULL, NULL, 3, 46 );
	$check_string = @strpos( $section, $bpspro_readme_install_ver, 17 );		
	
		$filename = ABSPATH . 'wp-admin/install.php';		
		
		if ( ! file_exists($filename) ) {
			$text = '<font color="green"><strong>&radic; '.__('The WP /wp-admin/install.php file does not exist', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		
		} else {
		
			$check_stringBPSQSE = @file_get_contents($htaccess_filename);
			
			if ( $check_string == "18" && strpos( $check_stringBPSQSE, "BPSQSE-check" ) ) {
				$text = '<font color="green"><strong>&radic; '.__('The WP /wp-admin/install.php file is htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			} else {
				$text = '<font color="red"><strong>'.__('ERROR: The WP /wp-admin/install.php file is not htaccess protected', 'bulletproof-security').'</strong></font><br>';
				echo $text;
			}
		}
	}
}

// Check if BPS Deny ALL htaccess file is activated for the BPS Master htaccess folder
function bps_denyall_htaccess_status_master() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/.htaccess';
	
	if ( file_exists($filename) ) {
    	$text = '<font color="green"><strong>&radic; '.__('Deny All protection activated for BPS Master /htaccess folder', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
    	$text = '<font color="red"><strong>'.__('ERROR: Deny All protection NOT activated for BPS Master /htaccess folder', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// Check if BPS Deny ALL htaccess file is activated for the /wp-content/bps-backup folder
function bps_denyall_htaccess_status_backup() {
$filename = WP_CONTENT_DIR . '/bps-backup/.htaccess';
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( file_exists($filename) ) {
    	$text = '<font color="green"><strong>&radic; '.__('Deny All protection activated for /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	} else {
    	$text = '<font color="red"><strong>'.__('ERROR: Deny All protection NOT activated for /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder', 'bulletproof-security').'</strong></font><br><br>';
		echo $text;
	}
}

// File and Folder Permission Checking
function bps_check_perms($path, $perm) {
clearstatcache();
$current_perms = @substr(sprintf('%o', fileperms($path)), -4);
$stat = stat($path);

	echo '<table style="width:100%;background-color:#fff;">';
	echo '<tr>';
    echo '<td style="background-color:#fff;padding:2px;width:40%;">' . $path . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:15%;">' . $perm . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:15%;">' . $current_perms . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:15%;">' . $stat['uid'] . '</td>';
    echo '<td style="background-color:#fff;padding:2px;width:15%;">' . @fileowner( $path ) . '</td>';
    echo '</tr>';
	echo '</table>';
}

// Check if Permalinks are enabled
function bps_check_permalinks() {
$permalink_structure = get_option('permalink_structure');	
	
	if ( get_option('permalink_structure') == '' ) { 
		$text = __('Custom Permalinks:', 'bulletproof-security').'<font color="red"><strong>'.__('WARNING! Custom Permalinks are NOT in use', 'bulletproof-security').'<br>'.__('It is recommended that you use Custom Permalinks', 'bulletproof-security').'</strong></font>';
		echo $text;
	} else {
		$text = __('Custom Permalinks:', 'bulletproof-security').' <font color="green"><strong>&radic; '.__('Custom Permalinks are in use', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
}

// Check PHP version
function bps_check_php_version() {
	
	if ( version_compare(PHP_VERSION, '5.0.0', '>=') ) {
    	$text = __('PHP Version Check:', 'bulletproof-security').' <font color="green"><strong>&radic; '.__('Running PHP5', 'bulletproof-security').'</strong></font><br>';
		echo $text;
}
	if ( version_compare(PHP_VERSION, '5.0.0', '<') ) {
    	$text = '<font color="red"><strong>'.__('WARNING! BPS requires PHP5 to function correctly. Your PHP version is:', 'bulletproof-security').' '. PHP_VERSION . '</strong></font><br>';
		echo $text;
	}
}

// Display Root or Subfolder Installation Type
function bps_wp_get_root_folder_display_type() {
$site_root = parse_url(get_option('siteurl'));
	if ( isset( $site_root['path'] ) )
		$site_root = trailingslashit($site_root['path']);
	else
		$site_root = '/';
	if ( preg_match('/[a-zA-Z0-9]/', $site_root) ) {
		echo '<strong>'.__('Subfolder Installation', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('Root Folder Installation', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for GWIOD
function bps_gwiod_site_type_check() {
$WordPress_Address_url = get_option('home');
$Site_Address_url = get_option('siteurl');
	
	if ( $WordPress_Address_url == $Site_Address_url ) {
		echo '<strong>'.__('Standard WP Site Type', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('GWIOD WP Site Type', 'bulletproof-security').'</strong><br>';
		echo '<strong>'.__('WordPress Address (URL): ', 'bulletproof-security').$WordPress_Address_url.'</strong><br>';
		echo '<strong>'.__('Site Address (URL): ', 'bulletproof-security').$Site_Address_url.'</strong>';
	}	
}

// System Info page - Check for BuddyPress
function bps_buddypress_site_type_check() {

	if ( function_exists('bp_is_active') ) {
		echo '<strong>'.__('BuddyPress is installed/enabled', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('BuddyPress is not installed/enabled', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for bbPress
function bps_bbpress_site_type_check() {

	if ( function_exists('is_bbpress') ) {
		echo '<strong>'.__('bbPress is installed/enabled', 'bulletproof-security').'</strong>';
	} else {
		echo '<strong>'.__('bbPress is not installed/enabled', 'bulletproof-security').'</strong>';
	}
}

// System Info page - Check for Multisite/Subdirectory/Subdomain
function bps_multisite_check() {  
	
	if ( ! is_multisite() ) { 
		$text = ' <strong>'.__('Network/Multisite is not installed/enabled', 'bulletproof-security').'</strong>';
		echo $text;	
	
	} else {
		
		if ( ! is_subdomain_install() ) {
			$text = ' <strong>'.__('Subdirectory Site Type', 'bulletproof-security').'</strong>';
			echo $text;
		} else {
			$text = ' <strong>'.__('Subdomain Site Type', 'bulletproof-security').'</strong>';
			echo $text;			
		}
	}
}

// Check if username Admin is being used as an Administrator User Account/Role
function bps_check_admin_username() {
global $wpdb;
$user_login = 'admin';	
$user = get_user_by( 'login', $user_login );
$username = $wpdb->get_var( $wpdb->prepare( "SELECT user_login FROM $wpdb->users WHERE user_login = %s", $user_login ) );
	
	if ( 'admin' == $username && 'administrator' == $user->roles[0] ) {
		$text = '<font color="red"><strong>'.__('Recommended Security Change: Username '.'"'.'admin'.'"'.' is being used for an Administrator User Account. It is recommended that you create a new unique administrator User Account name and delete the old "admin" User Account.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="green"><strong>&radic; '.__('The Default Admin username '.'"'.'admin'.'"'.' is not being used for an Administrator User Account.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// BPS Pro see System Info Tab - message only
function bpsPro_sysinfo_message() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-options.php';
	
	if ( file_exists($filename) ) {
    	$text = '<font color="green"><strong>&radic; '.__('Additional BPS Pro Security Status information is displayed on the System Info page under BPS Pro Security Modules Info', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
    	$text =  '<font color="red"><strong>'.__('The /php/php-options.php file was not found or the folder is not accessible.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// Get SQL Mode from WPDB
function bps_get_sql_mode() {
global $wpdb;
$sql_mode_var = 'sql_mode';
$mysqlinfo = $wpdb->get_results( $wpdb->prepare( "SHOW VARIABLES LIKE %s", $sql_mode_var ) );	
	
	if ( is_array( $mysqlinfo ) ) { 
		$sql_mode = $mysqlinfo[0]->Value;
		if ( empty( $sql_mode ) ) { 
			$sql_mode = __('Not Set', 'bulletproof-security');
		} else {
			$sql_mode = __('Off', 'bulletproof-security');
		}
	}
}

// Show DB errors should already be set to false in /includes/wp-db.php
// Extra function insurance show_errors = false
function bps_wpdb_errors_off() {
global $wpdb;
$wpdb->show_errors = false;
	
	if ( $wpdb->show_errors != false ) {
		$text = '<font color="red"><strong>'.__('WARNING! WordPress DB Show Errors Is Set To: true! DB errors will be displayed', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="green"><strong>&radic; '.__('WordPress DB Show Errors Function Is Set To:', 'bulletproof-security').' </strong></font><font color="black"><strong>'.__('false', 'bulletproof-security').'</strong></font><br><font color="green"><strong>&radic; '.__('WordPress Database Errors Are Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}	
}

// Hide / Remove WordPress Version Meta Generator Tag - echo only for remove_action('wp_head', 'wp_generator');
function bps_wp_remove_version() {
global $wp_version;
	$text = '<font color="green"><strong>&radic; '.__('WordPress Meta Generator Tag Removed', 'bulletproof-security').'<br>&radic; '.__('WordPress Version Is Not Displayed|Not Shown', 'bulletproof-security').'</strong></font><br>';
	echo $text;
}

// Return Nothing For WP Version Callback
function bps_wp_generator_meta_removed() {
	if ( ! is_admin() ) {
		global $wp_version;
		$wp_version = '';
	}
}

// AutoRestore Cron Off displayed message on AutoRestore page
function bpsProAutoRestoreOff() {
$options = get_option('bulletproof_security_options_ARCM');
	
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		$text = '<font color="blue"><strong>'.__('AutoRestore|Quarantine Override is Turned On', 'bulletproof-security').'<br>'.__('ARQ is turned Off.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	return;
	}

	if ( $options['bps_autorestore_cron'] == 'Off' ) {
		$text = '<font color="red"><strong>'.__('AutoRestore|Quarantine Cron is Turned Off', 'bulletproof-security').'<br>'.__('and Scheduled Cron Jobs Have Been Removed.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

// AutoRestore Cron On displayed message on AutoRestore page
function bpsProAutoRestoreOn() {
	
	if ( ! get_option('bulletproof_security_options_ARCM') ) {
		$text = '<font color="red"><strong>'.__('You have not selected your ARQ Cron Options', 'bulletproof-security').'<br>'.__('and clicked Save ARQ Cron Options yet.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	
	} else {
	
	$options = get_option('bulletproof_security_options_ARCM');
	
	if ( $options['bps_autorestore_cron'] == 'On' && $options['bps_autorestore_cron_override'] != 'On' ) {
	
	$date_format = 'g:i A';
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$bpsCronCheck = wp_get_schedule( 'bpsPro_AutoRestore_check' );
	$ARQ_cron_time = wp_next_scheduled( 'bpsPro_AutoRestore_check' );
	$arq_next_check = date_i18n( $date_format, $ARQ_cron_time + $gmt_offset );	

	if ( $bpsCronCheck == 'minutes_1' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 60 seconds. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}
	
	if ( $bpsCronCheck == 'minutes_2' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 2 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}

	if ( $bpsCronCheck == 'minutes_3' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 3 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}

	if ( $bpsCronCheck == 'minutes_4' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 4 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}

	if ( $bpsCronCheck == 'minutes_5' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 5 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;	
	}
	
	if ( $bpsCronCheck == 'minutes_10' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 10 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}
	
	if ( $bpsCronCheck == 'minutes_15' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 15 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_30' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 30 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_60' ) {
		$text = '<font color="green"><strong>'.__('AutoRestore|Quarantine ARQ Cron is On', 'bulletproof-security').'<br>'.__('Check files every 60 minutes. Next Check: ', 'bulletproof-security').$arq_next_check.'</strong></font><br>';
		echo $text;
	}
	}
	}
}

// Plugin Firewall - Additional Roles IP Addresses added
// Will not work accurately on XAMPP because the Local IP address will be found 127.0.0.1 in the plugins .htaccess file
// Network/MU sites work differently - Additional Roles may not work on MU - pending additional testing
function bps_pfw_roles() {

	if ( ! get_option('bulletproof_security_options_pfirewall_roles') ) {
		return;
	}

	global $current_user;
	get_currentuserinfo();
	$user_info = get_userdata($current_user->ID);
	
	// If user level is greater than a Subscriber and is not the Site Administrator with User ID 1
	if ( $user_info->user_level > 0 && $current_user->ID != 1) {
	
		$options = get_option('bulletproof_security_options_pfirewall_roles');	
		$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
		$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
		$PluginsHtaccessARQDir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins';
		$bps_get_public_ip = $_SERVER['REMOTE_ADDR'];
		$check_string = @file_get_contents($PluginsHtaccess);	
		$pattern = '/#\sBEGIN\sADDITIONAL\sROLES\sIP/s';

		// If the ip address already exists return and do not add it again
		if ( file_exists($PluginsHtaccess) && strpos($check_string, $bps_get_public_ip) ) {
		return;
		}

		if ( $options['bps_pfw_administrator'] == '1' && $user_info->user_level == 10) {
			$administrator = "\n".'Allow from '. $bps_get_public_ip;
		} else {
			$administrator = '';
		}

		if ( $options['bps_pfw_editor'] == '1' && $user_info->user_level == 7) {
			$editor = "\n".'Allow from '. $bps_get_public_ip;
		} else {
			$editor = '';
		}
	
		if ( $options['bps_pfw_author'] == '1' && $user_info->user_level == 2) {
			$author = "\n".'Allow from '. $bps_get_public_ip;
		} else {
			$author = '';
		}

		if ( $options['bps_pfw_contributor'] == '1' && $user_info->user_level == 1) {
			$contributor = "\n".'Allow from '. $bps_get_public_ip;
		} else {
			$contributor = '';
		}
	
		if ( file_exists($PluginsHtaccess) && ! strpos($check_string, $bps_get_public_ip) && is_dir($PluginsHtaccessARQDir)) {
		
			if ( ! preg_match($pattern, $check_string, $matches) ) {
				$stringReplace = @file_get_contents($PluginsHtaccess);
				$stringReplace = preg_replace('/<\/FilesMatch>/', "# BEGIN ADDITIONAL ROLES IP$administrator$editor$author$contributor\n# END ADDITIONAL ROLES IP\n</FilesMatch>", $stringReplace);
				file_put_contents($PluginsHtaccess, $stringReplace);
				@copy($PluginsHtaccess, $PluginsHtaccessARQplugins);
			} else {
				$stringReplace = @file_get_contents($PluginsHtaccess);
				$stringReplace = preg_replace('/#\sBEGIN\sADDITIONAL\sROLES\sIP/s', "# BEGIN ADDITIONAL ROLES IP$administrator$editor$author$contributor", $stringReplace);
				file_put_contents($PluginsHtaccess, $stringReplace);
				@copy($PluginsHtaccess, $PluginsHtaccessARQplugins);	
			}
		} // end if file exists, ip already exists and ARQ plugin folder exists
	} // end if user is at least a Contributor but is not an Admin
}
add_action('admin_notices', 'bps_pfw_roles');

// F-Lock - Check if F-Lock options saved - F-Lock Lock / Unlock File Status & actual file permissions 404 or 400 - WP Only
function bps_smonitor_flock_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_flock_status'] == 'Off' ) {
		return;
	}

	if ( ! get_option('bulletproof_security_options_flock') ) {
	if ( $options['bps_flock_status'] == 'wpOn' ) { 
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('BPS Pro F-Lock Notification', 'bulletproof-security').'<br>'.__('F-Lock options have not been saved yet.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the F-Lock page to choose and save your File Lock|Unlock options.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}

	if ( @$options['bps_flock_status'] == 'wpOn' ) { 

		clearstatcache();

		$fileRH = ABSPATH . '.htaccess';
		$fileWPC = ABSPATH . 'wp-config.php';
		$fileRI = ABSPATH . 'index.php';
		$fileBH = ABSPATH . 'wp-blog-header.php';
		$fileDRH = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
		$fileDRI = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
		$fileHGWIOD = dirname(ABSPATH) . '/.htaccess';
		$fileIGWIOD = dirname(ABSPATH) . '/index.php';

		$permsRH = @substr(sprintf('%o', fileperms($fileRH)), -4);
		$permsWPC = @substr(sprintf('%o', fileperms($fileWPC)), -4);
		$permsRI = @substr(sprintf('%o', fileperms($fileRI)), -4);
		$permsBH = @substr(sprintf('%o', fileperms($fileBH)), -4);
		$permsDRH = @substr(sprintf('%o', fileperms($fileDRH)), -4);
		$permsDRI = @substr(sprintf('%o', fileperms($fileDRI)), -4);
		$permsHGWIOD = @substr(sprintf('%o', fileperms($fileHGWIOD)), -4);
		$permsIGWIOD = @substr(sprintf('%o', fileperms($fileIGWIOD)), -4);

		$options2 = get_option('bulletproof_security_options_flock'); 
		$GDMW_options = get_option('bulletproof_security_options_GDMW');

		if ( $options2['bps_lock_root_htaccess'] == 'off' || !$options2['bps_lock_root_htaccess'] ) { 
			echo '';
		}	
		elseif ( $options2['bps_lock_root_htaccess'] == 'no' || $permsRH != '0404' ) {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your Root htaccess File is not Locked', 'bulletproof-security').'</font><br>'.__('To Lock your Root htaccess file ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>.</div>';
			echo $text;
		}
		if ( $options2['bps_lock_wpconfig'] == 'off' || !$options2['bps_lock_wpconfig'] ) {
			echo '';
		}
		elseif ( $options2['bps_lock_wpconfig'] == 'no' || $permsWPC != '0400' && file_exists($fileWPC) ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your wp-config.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your wp-config.php file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_index_php'] == 'off' || !$options2['bps_lock_index_php'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
			echo '';
		}	
		elseif ( $options2['bps_lock_index_php'] == 'no' || $permsRI != '0400' ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your WP Root index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your WP Root index.php file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_wpblog_header'] == 'off' || !$options2['bps_lock_wpblog_header'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
			echo '';
		}
		elseif ( $options2['bps_lock_wpblog_header'] == 'no' || $permsBH != '0400' ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your wp-blog-header.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your wp-blog-header.php file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_root_htaccess_dr'] == 'off' || !$options2['bps_lock_root_htaccess_dr'] ) { 
			echo '';
		}
		elseif ( $options2['bps_lock_root_htaccess_dr'] == 'no' || $permsDRH != '0404' && file_exists($fileDRH) ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your DR Root htaccess File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your DR Root htaccess file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_index_php_dr'] == 'off' || !$options2['bps_lock_index_php_dr'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
			echo '';
		}
		elseif ( $options2['bps_lock_index_php_dr'] == 'no' || $permsDRI != '0400' && file_exists($fileDRI) ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your DR WP index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your DR WP index.php file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_root_htaccess_gwiod'] == 'off' || !$options2['bps_lock_root_htaccess_gwiod'] ) { 
			echo '';
		}
		elseif ( $options2['bps_lock_root_htaccess_gwiod'] == 'no' || $permsHGWIOD != '0404' && file_exists($fileHGWIOD) ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your GWIOD Root htaccess File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your GWIOD Root htaccess file.', 'bulletproof-security').'</div>';
			echo $text;
		}
		if ( $options2['bps_lock_index_php_gwiod'] == 'off' || !$options2['bps_lock_index_php_gwiod'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
		echo '';
		}
		elseif ( $options2['bps_lock_index_php_gwiod'] == 'no' || $permsIGWIOD != '0400' && file_exists($fileIGWIOD) ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Your GWIOD WP index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your GWIOD WP index.php file.', 'bulletproof-security').'</div>';
			echo $text;
		}
	}
	}
}
add_action('admin_notices', 'bps_smonitor_flock_wp');

// Maintenance Mode On Dashboard Alert
function bpsPro_mmode_dashboard_alert() {

if ( current_user_can('manage_options') ) {

	$MMoptions = get_option('bulletproof_security_options_maint_mode');

	if ( ! is_multisite() ) {
		
	if ( ! get_option('bulletproof_security_options_maint_mode') || $MMoptions['bps_maint_on_off'] == 'Off' ) {
	return;
	}	
	
		$indexPHP = ABSPATH . 'index.php';
		$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
		$check_string_index = @file_get_contents($indexPHP);
		$check_string_wpadmin = @file_get_contents($wpadminHtaccess);

		if ( $MMoptions['bps_maint_on_off'] == 'On' && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {	
	
			if ( strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( ! strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( strpos( $check_string_index, "BEGIN BPS MAINTENANCE MODE IP" ) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}
		}
	}
	
	if ( is_multisite() ) {
		global $current_blog, $blog_id;
		$root_folder_maintenance_values = ABSPATH . 'bps-maintenance-values.php';
		$check_string_values = @file_get_contents($root_folder_maintenance_values);			
		$indexPHP = ABSPATH . 'index.php';
		$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
		$check_string_index = @file_get_contents($indexPHP);
		$check_string_wpadmin = @file_get_contents($wpadminHtaccess);
	
		if ( $blog_id == 1 && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {

			if ( strpos( $check_string_values, '$all_sites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for The Primary Site and All Subsites.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}
		
			if ( strpos( $check_string_values, '$all_subsites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for All Subsites, but Not The Primary Site.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}	
	
		if ( $MMoptions['bps_maint_on_off'] == 'On' ) {

			if ( strpos( $check_string_index, '$primary_site_status = \'On\';' ) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( !strpos($check_string_index, '$primary_site_status = \'On\';') && strpos($check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP") ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( strpos($check_string_index, '$primary_site_status = \'On\';') && strpos($check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP") ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}
		}
		}
	
		if ( $blog_id != 1 ) {
		
			if ( is_subdomain_install() ) {
		
				$subsite_remove_slashes = str_replace( '.', "-", $current_blog->domain );	
	
			} else {
	
				$subsite_remove_slashes = str_replace( '/', "", $current_blog->path );
			}			
			
			$subsite_maintenance_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/bps-maintenance-'.$subsite_remove_slashes.'.php';		

			if ( strpos( $check_string_values, '$all_sites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for The Primary Site and All Subsites.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}
		
			if ( strpos( $check_string_values, '$all_subsites = \'1\';' ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On for All Subsites, but Not The Primary Site.', 'bulletproof-security').'</font></div>';
				echo $text;	
			}		
		
		if ( $MMoptions['bps_maint_on_off'] == 'On' && $MMoptions['bps_maint_dashboard_reminder'] == '1' ) {

			if ( file_exists($subsite_maintenance_file) && ! strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			} elseif ( ! file_exists($subsite_maintenance_file) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Backend Maintenance Mode is Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;	
			} elseif ( file_exists($subsite_maintenance_file) && strpos( $check_string_wpadmin, "BEGIN BPS MAINTENANCE MODE IP" ) ) {
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Reminder: Frontend & Backend Maintenance Modes are Turned On.', 'bulletproof-security').'</font></div>';
				echo $text;				
			}		
		}
		}
	} // end is multisite
}
}

add_action('admin_notices', 'bpsPro_mmode_dashboard_alert');

// Login Security Disable Password Reset notice: Displays a message that backend password reset has been disabled
function bpsPro_login_security_password_reset_disabled_notice() {

	if ( current_user_can( 'update_core' ) )
	
	global $pagenow;	

	if ( $pagenow == 'profile.php' || $pagenow == 'user-edit.php' || $pagenow == 'user-new.php' ) {
		
		$BPSoptions = get_option('bulletproof_security_options_login_security');		
		
		if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_pw_reset'] == 'disable' ) {
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Login Security Disable Password Reset Frontend & Backend is turned On.', 'bulletproof-security').'</font><br>'.__('Backend Password Reset has been disabled. To enable Backend Password Reset click ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('here', 'bulletproof-security').'</a></div>';
			echo $text;
		}
	}
}

add_action('admin_notices', 'bpsPro_login_security_password_reset_disabled_notice');

// One time manual htaccess code update added in BPS Pro 9.8
// NOTE: Instead of automating this, this needs to be done manually by users
// "Always On" flush_rewrite_rules code correction: Unfortunately this needs to be an "Always On" check in order for it to be 100% effective
function bpsPro_htaccess_manual_update_notice() {
	
	if ( current_user_can('manage_options') ) {

		$filename = ABSPATH . '.htaccess';
		$filename_ARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';		
		
		if ( file_exists($filename) ) {

			$check_string = @file_get_contents($filename);
			$pattern = '/#\sBEGIN\sWordPress\s*<IfModule\smod_rewrite\.c>\s*RewriteEngine\sOn\s*RewriteBase(.*)\s*RewriteRule(.*)\s*RewriteCond((.*)\s*){2}RewriteRule(.*)\s*<\/IfModule>\s*#\sEND\sWordPress/';

			if ( preg_match( $pattern, $check_string, $flush_matches ) ) {
				$stringReplace = preg_replace('/\n#\sBEGIN\sWordPress\s*<IfModule\smod_rewrite\.c>\s*RewriteEngine\sOn\s*RewriteBase(.*)\s*RewriteRule(.*)\s*RewriteCond((.*)\s*){2}RewriteRule(.*)\s*<\/IfModule>\s*#\sEND\sWordPress\n/s', "", $check_string);
				
				if ( file_put_contents($filename, $stringReplace) ) {
					@copy($filename, $filename_ARQ);
				}
			}				
		
			global $pagenow;

			if ( $pagenow == 'plugins.php' || preg_match( '/page=bulletproof-security\/admin\/core\/options\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {

				$pos = strpos( $check_string, 'IMPORTANT!!! DO NOT DELETE!!! - B E G I N Wordpress' );
			
				if ( $pos === false ) {
    		
					return;
			
				} else {
    		
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<strong><font color="blue">'.__('BPS Pro Notice: One-time Update Steps Required', 'bulletproof-security').'</font><br>'.__('Significant changes were made to the root and wp-admin htaccess files that require doing the one-time Update Steps below.', 'bulletproof-security').'<br>'.__('All future BPS upgrades will not require these one-time Update Steps to be performed.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/root-and-wp-admin-htaccess-file-significant-changes/" target="_blank" title="Link opens in a new Browser window" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' If you would like to know what changes were made to the root and wp-admin htaccess files.', 'bulletproof-security').'<br>'.__('This Notice will go away automatically after doing all of the steps below.', 'bulletproof-security').'<br><br><a href="admin.php?page=bulletproof-security/admin/core/options.php" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Pro Security Modes page.', 'bulletproof-security').'<br>'.__('1. Click the "Create secure.htaccess File" AutoMagic button.', 'bulletproof-security').'<br>'.__('2. Activate Root Folder BulletProof Mode.', 'bulletproof-security').'<br>'.__('3. Activate wp-admin Folder BulletProof Mode.', 'bulletproof-security').'</strong>';
					echo $text;
					echo '</p></div>';	
				}
			}
		}
	}
}

add_action('admin_notices', 'bpsPro_htaccess_manual_update_notice');

?>