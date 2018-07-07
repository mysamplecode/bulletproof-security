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
 
if ( !current_user_can('manage_options') ) { 
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

// ini_set Form - 2. Enable Options button - create ini_set code in wp-config.php
// do not use clearstatcache(); it is buggy
if ( isset( $_POST['bps-iniset-wpconfig'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-iniset-wpconfig-check' );

	$options = get_option('bulletproof_security_options_iniSet');
	$Flockoptions = get_option('bulletproof_security_options_flock');
	$filename = ABSPATH . 'wp-config.php';
	$permswpconfig = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();
	$wpconfigBackup = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
	$bpsPHPElog = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error.log';
	$bpsPHPElogFolder = WP_CONTENT_DIR . '/bps-backup/logs/bps_php_error.log';
	$subject = file_get_contents($filename);
	$pattern = '/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s';
	$pattern2 = '/\* That\'s all, stop editing! Happy blogging. \*/';
	$successText = '<font color="green"><strong>'.__('Your ini_set Options have been Enabled successfully. Click the Refresh Status button below and then go to the PHP Error Log tab page if you are not automatically redirected to the PHP Error Log page and copy the Error Log Path Seen by Server: file path to the PHP Error Log Location Set To: text box and click the Set Error Log Location button.', 'bulletproof-security').'</strong></font><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5" onclick="location.reload(true)">'.__('Refresh Status', 'bulletproof-security').'</a></div>';

	$replacement = "/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/";

	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/', 0755 );
	}

	if ( $options['bps_iniSet_IgnoreRepeatedErrors'] == '' && $options['bps_iniSet_IgnoreRepeatedSource'] == '' ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('You need to click the 1. Save Options button first before clicking the 2. Enable Options button.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo $bps_bottomDiv;
	}
	
	if ( $options['bps_iniSet_ErrorLog'] == '' || $options['bps_iniSet_LogErrorsMaxLen'] == '' || $options['bps_iniSet_MemoryLimit'] == '' || $options['bps_iniSet_MaxExecutionTime'] == '' || $options['bps_iniSet_MysqlConnectTimeout'] == '' ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('You cannot have blank values in any text boxes. A blank value in any text box will cause your website to crash.', 'bulletproof-security').'</font><br>'.__('Check these ini_set options text boxes and make sure that none of them have blank values: Error Log Location Set To, Log Errors Max Length, Memory Limit, Max Execution Time and MySQL Connect Timeout. The script has exited so that your website will not crash. Click on the BPS Pro P-Security menu link, go back to the ini_set Options tab page and add values in any text boxes that are blank.', 'bulletproof-security').'</strong>';
		echo $text;	
		echo $bps_bottomDiv;	
	return;	
	}

	if ( ! file_exists($filename) ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('A wp-config.php file was NOT found in your root folder.', 'bulletproof-security').'</strong></font><br>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to add the BPS Pro ini_set coding to your wp-config.php file manually.', 'bulletproof-security').'<br>'.__('The BPS ini_set coding can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
		
	} else {
	
	// This writes the new ini_set code if old ini_set code already exists - English or non-English Versions of WP
	if ( file_exists($filename) && preg_match($pattern, $subject, $matches) && $options['bps_iniSet_IgnoreRepeatedErrors'] != '' && $options['bps_iniSet_IgnoreRepeatedSource'] != '' ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}
		
		$stringReplace = @file_get_contents($filename);
		$stringReplace = preg_replace('/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s', $replacement, $stringReplace);
		file_put_contents($filename, $stringReplace);		
		copy($filename, $wpconfigBackup);	
		copy($bpsPHPElog, $bpsPHPElogFolder);
		
		echo $bps_topDiv;
		echo $successText;
		echo $bps_bottomDiv;
		
		if ( $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {	
			@chmod($filename, 0400);		
		}	
	}
	
	// This writes new ini_set code if it does NOT exist and the * That's all, stop editing! Happy blogging. * text exists - English WP Version
	if ( file_exists($filename) && !preg_match($pattern, $subject, $matches) && preg_match($pattern2, $subject, $matches) && $options['bps_iniSet_IgnoreRepeatedErrors'] != '' && $options['bps_iniSet_IgnoreRepeatedSource'] != '' ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}		
		
		$stringReplace = @file_get_contents($filename);
$stringReplace = str_replace("/* That's all, stop editing! Happy blogging. */", "/* That's all, stop editing! Happy blogging. */\n
/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/
", $stringReplace);
		
		file_put_contents($filename, $stringReplace);
		copy($filename, $wpconfigBackup);	
		copy($bpsPHPElog, $bpsPHPElogFolder);
	
		echo $bps_topDiv;
		echo $successText;
		echo $bps_bottomDiv;
		
		if ( $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {	
			@chmod($filename, 0400);		
		}
	}

	// This writes new ini_set code if it does NOT exist and the * That's all, stop editing! Happy blogging. * text does NOT exist - non-English version of WP
	if ( file_exists($filename) && !preg_match($pattern, $subject, $matches) && !preg_match($pattern2, $subject, $matches) && $options['bps_iniSet_IgnoreRepeatedErrors'] != '' && $options['bps_iniSet_IgnoreRepeatedSource'] != '' ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}		
		
		$stringReplace = @file_get_contents($filename);
$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\n
/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/
", $stringReplace);
		
		file_put_contents($filename, $stringReplace);
		copy($filename, $wpconfigBackup);	
		copy($bpsPHPElog, $bpsPHPElogFolder);
	
		echo $bps_topDiv;
		echo $successText;
		echo $bps_bottomDiv;

		if ( $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {	
			@chmod($filename, 0400);		
		}
	}
}
}

// ini_set Form - delete ini_set coding in wp-config.php and delete saved DB Options
if ( isset( $_POST['Submit-bps-iniset-wpconfig-remove'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-iniset-wpconfig-remove' );
	
	$Flockoptions = get_option('bulletproof_security_options_flock');
	$filename = ABSPATH . 'wp-config.php';
	$wpconfigBackup = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';	
	$permswpconfig = @substr( sprintf('%o', fileperms($filename) ), -4);
	$sapi_type = php_sapi_name();
	
	if ( !file_exists($filename) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('A wp-config.php file was NOT found in your root folder.', 'bulletproof-security').'</font><br>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to manually delete the BPS Pro ini_set coding from your wp-config.php file.', 'bulletproof-security').'</div>';
		echo $text;
		
	} else {
	
	if ( file_exists($filename) ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}				
		
		$stringReplace = @file_get_contents($filename);
		$stringReplace = preg_replace('/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s', '', $stringReplace);
		file_put_contents($filename, $stringReplace);
		copy($filename, $wpconfigBackup);	
		
		delete_option('bulletproof_security_options_iniSet');
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Your ini_set Saved Options and ini_set code have been Deleted successfully.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		
		if ( $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {	
			@chmod($filename, 0400);		
		}
	}
}
}

?>
