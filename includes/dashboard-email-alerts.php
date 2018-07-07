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

/*****************************************/
// S-Monitor Dashboard Alerts
// ARQ, Security Log, PHP Error Log, Login Security
// DB Monitor & DB Backup are in the db-security.php file
/*****************************************/

/*****************************************/
// S-Monitor AutoRestore/Quarantine Alerts
/*****************************************/

// Get the Current / Last Modifed Date of the ARCM Log File - Minutes check
function bps_getARCMLogLastMod_wp() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// Get the Current / Last Modifed Date of the ARCM Log File - Seconds for Display
function bps_getARCMLogLastMod_wp_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// AutoRestore/Quarantine Alert
// WP Dashboard Always On - No option setting to avoid any human error
function bps_ARCMModTimeDiff_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	// New installations - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( ! get_option('bulletproof_security_options_activation') || ! get_option('bulletproof_security_options_monitor') ) {
		return;
	}
	
	$options = get_option('bulletproof_security_options_ARCM_log');

	if ( !$options['bps_arcm_log_date_mod'] ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('The AutoRestore|Quarantine Log Last Modified Time in DB Needs To Be Set', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Quarantine Log page and click the Reset Last Modified Time in DB button.', 'bulletproof-security').'<br>'.__('View the Quarantine Log Read Me Help button for additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}
	
	if ( strcmp( bps_getARCMLogLastMod_wp_secs(), $options['bps_arcm_log_date_mod'] ) != 0 && $options['bps_arcm_log_date_mod'] != '' && strcmp( bps_getARCMLogLastMod_wp(), getBPSInstallTime() ) == 0 ) {

		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$filename = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';

		touch( $filename, strtotime( $options['bps_arcm_log_date_mod'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $options['bps_arcm_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $options['bps_arcm_log_date_mod'] ) - 3600;	
	
	// Prevents BackWPup coding mistake from displaying BPS Pro Dashboard alerts on the BackWPup Backups page
	if ( ! preg_match( '/page=backwpupbackups/', $_SERVER['QUERY_STRING'], $matches ) ) {	
	if ( $options['bps_arcm_log_date_mod'] != '' && strcmp( bps_getARCMLogLastMod_wp_secs(), $options['bps_arcm_log_date_mod'] ) != 0 && $db_timestamp_plus_one != strtotime( bps_getARCMLogLastMod_wp_secs() ) && $db_timestamp_minus_one != strtotime( bps_getARCMLogLastMod_wp_secs() ) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('AutoRestore|Quarantine Alert!!!', 'bulletproof-security').'</font><br>'.__('A file has been Quarantined. ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to Quarantine.', 'bulletproof-security').'<br>'.__('To see exactly what actions were taken view the Quarantine Log.', 'bulletproof-security').'<br>'.__('To remove this alert click the Reset Last Modified Time in DB button on the Quarantine Log page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
}

add_action('admin_notices', 'bps_ARCMModTimeDiff_wp');

//************************************//
// S-Monitor Security Log Alerts      //
//************************************//

// S-Monitor - Get the Last Modifed Date of the Security Log File - Seconds
function bps_getSecurityLogLastMod_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// S-Monitor - Get the Last Modifed Date of the Security Log File - Minutes
function bps_getSecurityLogLastMod_minutes() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// S-Monitor - String comparison of Security Log DB Last Modified Time and Actual File Last Modified Time
// Security Log reset Last Modified Time on upgrade installation - Always On
function bps_SecurityLogModTimeDiff_wp() {

	if ( current_user_can('manage_options') ) {
	
	// New installations - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( !get_option('bulletproof_security_options_activation') || !get_option('bulletproof_security_options_monitor') ) {
		return;
	}
	
	$SecLog_mod_date = get_option('bulletproof_security_options_Security_log');

	if ( !$SecLog_mod_date['bps_security_log_date_mod'] ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('The Security Log Last Modified Time in DB Needs To Be Set', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/security-log/security-log.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Security Log page and click the Reset Last Modified Time in DB button.', 'bulletproof-security').'<br>'.__('View the Security Log Read Me Help button for additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}
	
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_SecLog_entry'] == 'wpOn' ) {
	if ( strcmp( bps_getSecurityLogLastMod_secs(), $SecLog_mod_date['bps_security_log_date_mod'] ) != 0 && $SecLog_mod_date['bps_security_log_date_mod'] != '' && strcmp( bps_getSecurityLogLastMod_minutes(), getBPSInstallTime() ) == 0 ) {

		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

		touch( $filename, strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) - 3600;
	
	// Prevents BackWPup coding mistake from displaying BPS Pro Dashboard alerts on the BackWPup Backups page
	// Daylight Savings: do not display alert when time change occurs
	if ( ! preg_match( '/page=backwpupbackups/', $_SERVER['QUERY_STRING'], $matches ) ) {	
	if ( $SecLog_mod_date['bps_security_log_date_mod'] != '' && strcmp( bps_getSecurityLogLastMod_secs(), $SecLog_mod_date['bps_security_log_date_mod'] ) != 0 && $db_timestamp_plus_one != strtotime( bps_getSecurityLogLastMod_secs() ) && $db_timestamp_minus_one != strtotime( bps_getSecurityLogLastMod_secs() ) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Security Log Alert', 'bulletproof-security').'</font><br>'.__('A New Security Log Entry Has Been Logged. ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/security-log/security-log.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to your Security Log.', 'bulletproof-security').'<br>'.__('To remove this alert click the Reset Last Modified Time in DB button on the Security Log page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
	}
}
add_action('admin_notices', 'bps_SecurityLogModTimeDiff_wp');

/*************************************/
// S-Monitor PHP Error Log Alerts
/*************************************/

// S-Monitor - PHP Error Log new errors - Get the Last Modifed Date of the PHP Error Log File
// This is the file path that is saved to DB - can be another path besides the default BPS log file location
function bps_getPhpELogLastMod_smonitor() {
$options = get_option('bulletproof_security_options2');
$filename = $options['bps_error_log_location'];
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// Get the Last Modifed Date of the Default PHP Error Log File - Minutes check
// IMPORTANT NOTE: This is the default BPS PHP Error log in /admin/ not the active php error log
// filemtime will match for the bulletproof-security.php file and bps_php_error.log
function bps_getPhpELogLastMod_minutes() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error.log';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// S-Monitor - PHP Error Log Alerts
function bps_smonitor_ELogModTimeDiff_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_PHP_ELog_error'] == 'Off' ) {
		return;	
	}
	
	// New installations - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( !get_option('bulletproof_security_options_activation') || !get_option('bulletproof_security_options_monitor') ) {
		return;
	}

	if ( $options['bps_PHP_ELog_error'] == 'wpOn' ) {
	
	$ELog_mod_time = get_option('bulletproof_security_options_elog');	
	
	if ( strcmp( bps_getPhpELogLastMod_smonitor(), $ELog_mod_time['bps_error_log_date_mod'] ) != 0 && $ELog_mod_time['bps_error_log_date_mod'] != '' && strcmp( bps_getPhpELogLastMod_minutes(), getBPSInstallTime() ) == 0 ) {

		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$ELog_location = get_option('bulletproof_security_options2');		
		
		touch( $ELog_location['bps_error_log_location'], strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) - 3600;

	// Prevents BackWPup coding mistake from displaying BPS Pro Dashboard alerts on the BackWPup Backups page
	if ( ! preg_match( '/page=backwpupbackups/', $_SERVER['QUERY_STRING'], $matches ) ) {	
	if ( strcmp( bps_getPhpELogLastMod_smonitor(), $ELog_mod_time['bps_error_log_date_mod'] ) != 0 && $db_timestamp_plus_one != strtotime( bps_getPhpELogLastMod_smonitor() ) && $db_timestamp_minus_one != strtotime( bps_getPhpELogLastMod_smonitor() ) ) { // 0 is equal strings
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('A PHP Error has been logged in your PHP Error Log', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To go to the P-Security PHP Error Log page.', 'bulletproof-security').'<br>'.__('To remove/clear this Alert click on the Reset Last Modified Time in DB button.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
	}
}
add_action('admin_notices', 'bps_smonitor_ELogModTimeDiff_wp');

/*************************************/
// S-Monitor Login Security Alerts
/*************************************/

// S-Monitor - Get the Last Modifed Date of the Login Security Reset File - Seconds
function bps_getLoginSecurityResetFileLastMod_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// S-Monitor - Get the Last Modifed Date of the Login Security Reset File - Minutes
function bps_getLoginSecurityResetFileLastMod_minutes() {
$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// S-Monitor - String comparison of Login Security DB Last Modified Time and Actual File Last Modified Time - WP
// Security Log reset Last Modified Time on upgrade installation - Always On
// this function is probably obsolete and can be deleted
function bps_LoginSecurityResetModTimeDiff_wp() {

	if ( current_user_can('manage_options') ) {
	
	global $blog_id;
	if ( is_multisite() && $blog_id != 1 ) {	
		return;
	}

	// New installations - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( !get_option('bulletproof_security_options_activation') || !get_option('bulletproof_security_options_monitor') ) {
		return;
	}

	$options = get_option('bulletproof_security_options_monitor');
	$LSAlertsoptions = get_option('bulletproof_security_options_login_alerts');  
	$BPSoptions = get_option('bulletproof_security_options_login_security');

	// get the install time and update the option
	// do not display this upgrade notice unless someone forgets to click the Reset/Clear button
	if ( !$LSAlertsoptions['bps_login_security_db_mod_time'] && $BPSoptions['bps_login_security_OnOff'] ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('The Reset|Clear Login Security Alerts button needs to be clicked', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Login Security page and click the Reset|Clear Login Security Alerts button.', 'bulletproof-security').'<br>'.__('View the Login Security & Monitoring  Read Me Help button for additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}

	// Upgrade - new login security alerts option has not been saved yet - update DB and set to wpOn if user has Login Security turned On.
	// this will only update the DB once since the security alerts option will be true/exist after this is run once
	if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $options['bps_login_security_status'] && !$options['bps_login_security_alerts'] ) {
	
	$bps_option_name6 = 'bulletproof_security_options_monitor';
	$bps_new_value6 = 'Off';

	if ( $options['bps_security_status'] == 'wpOn') { $bps_new_value6_1 = 'wpOn'; } 
	elseif ( $options['bps_security_status'] == 'bpsOn') { $bps_new_value6_1 = 'bpsOn';	} else { $bps_new_value6_1 = 'Off';
	}
	if ( $options['bps_SecLog_entry'] == 'wpOn') { $bps_new_value6_2 = 'wpOn'; } 
	elseif ( $options['bps_SecLog_entry'] == 'bpsOn') { $bps_new_value6_2 = 'bpsOn'; } else { $bps_new_value6_2 = 'Off';
	}
	if ( $options['bps_autorestore_status'] == 'wpOn') { $bps_new_value6_3 = 'wpOn'; } 
	elseif ( $options['bps_autorestore_status'] == 'bpsOn') { $bps_new_value6_3 = 'bpsOn'; } else { $bps_new_value6_3 = 'Off';
	}
	if ( $options['bps_plugin_firewall_status'] == 'wpOn') { $bps_new_value6_4 = 'wpOn'; } 
	elseif ( $options['bps_plugin_firewall_status'] == 'bpsOn') { $bps_new_value6_4 = 'bpsOn'; } else { $bps_new_value6_4 = 'Off';
	}
	if ( $options['bps_UAEG_status'] == 'wpOn') { $bps_new_value6_5 = 'wpOn'; } 
	elseif ( $options['bps_UAEG_status'] == 'bpsOn') { $bps_new_value6_5 = 'bpsOn';	} else { $bps_new_value6_5 = 'Off';
	}
	if ( $options['bps_login_security_status'] == 'wpOn') { $bps_new_value6_6 = 'wpOn'; } 
	elseif ( $options['bps_login_security_status'] == 'bpsOn') { $bps_new_value6_6 = 'bpsOn'; } else { $bps_new_value6_6 = 'Off';
	}
	if ( $options['bps_flock_status'] == 'wpOn') { $bps_new_value6_7 = 'wpOn'; } 
	elseif ( $options['bps_flock_status'] == 'bpsOn') { $bps_new_value6_7 = 'bpsOn'; } else { $bps_new_value6_7 = 'Off';
	}
	if ( $options['bps_HUD_alerts'] == 'wpOn') { $bps_new_value6_8 = 'wpOn'; } 
	elseif ( $options['bps_HUD_alerts'] == 'bpsOn') { $bps_new_value6_8 = 'bpsOn'; } else { $bps_new_value6_8 = 'Off';
	}
	if ( $options['bps_PHP_ELogLoc_set'] == 'wpOn') { $bps_new_value6_9 = 'wpOn'; } 
	elseif ( $options['bps_PHP_ELogLoc_set'] == 'bpsOn') { $bps_new_value6_9 = 'bpsOn';	} else { $bps_new_value6_9 = 'Off';
	}	
	if ( $options['bps_PHP_ELog_error'] == 'wpOn') { $bps_new_value6_10 = 'wpOn'; } 
	elseif ( $options['bps_PHP_ELog_error'] == 'bpsOn') { $bps_new_value6_10 = 'bpsOn';	} else { $bps_new_value6_10 = 'Off';
	}	
	if ( $options['bps_phpini_created'] == 'wpOn') { $bps_new_value6_11 = 'wpOn'; } 
	elseif ( $options['bps_phpini_created'] == 'bpsOn') { $bps_new_value6_11 = 'bpsOn';	} else { $bps_new_value6_11 = 'Off';
	}
	
	$bps_new_value6_12 = 'wpOn';
	
	if ( $options['bps_jtc_antispam_status'] == 'wpOn') { $bps_new_value6_13 = 'wpOn'; } 
	elseif ( $options['bps_jtc_antispam_status'] == 'bpsOn') { $bps_new_value6_13 = 'bpsOn'; } else { $bps_new_value6_13 = 'Off';
	}
	if ( $options['bps_dbm_status'] == 'wpOn') { $bps_new_value6_14 = 'wpOn'; } 
	elseif ( $options['bps_dbm_status'] == 'bpsOn') { $bps_new_value6_14 = 'bpsOn';	} else { $bps_new_value6_14 = 'Off';
	}	
	if ( $options['bps_dbm_alerts'] == 'wpOn') { $bps_new_value6_15 = 'wpOn'; } 
	elseif ( $options['bps_dbm_alerts'] == 'bpsOn') { $bps_new_value6_15 = 'bpsOn';	} else { $bps_new_value6_15 = 'Off';
	}	
	
	$BPS_Options6 = array(
	'bps_first_launch' 				=> $bps_new_value6, 
	'bps_security_status' 			=> $bps_new_value6_1, 
	'bps_SecLog_entry' 				=> $bps_new_value6_2, 
	'bps_autorestore_status' 		=> $bps_new_value6_3, 
	'bps_plugin_firewall_status' 	=> $bps_new_value6_4, 
	'bps_UAEG_status' 				=> $bps_new_value6_5, 
	'bps_login_security_status' 	=> $bps_new_value6_6, 
	'bps_flock_status' 				=> $bps_new_value6_7, 
	'bps_HUD_alerts' 				=> $bps_new_value6_8, 
	'bps_PHP_ELogLoc_set' 			=> $bps_new_value6_9, 
	'bps_PHP_ELog_error' 			=> $bps_new_value6_10, 
	'bps_phpini_created' 			=> $bps_new_value6_11,  
	'bps_login_security_alerts' 	=> $bps_new_value6_12, 
	'bps_jtc_antispam_status' 		=> $bps_new_value6_13, 
	'bps_dbm_status' 				=> $bps_new_value6_14,  
	'bps_dbm_alerts' 				=> $bps_new_value6_15
	);

		foreach( $BPS_Options6 as $key => $value ) {
			update_option('bulletproof_security_options_monitor', $BPS_Options6);
		}	
	
	$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('New S-Monitor Login Security: Login Security Alerts option is set to Display Alerts in WP Dashboard', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the S-Monitor page if you would like to change this setting.', 'bulletproof-security').'</div>';
	echo $text;
	}

	if ( $options['bps_login_security_alerts'] == 'wpOn' ) {
	if ( strcmp( bps_getLoginSecurityResetFileLastMod_secs(), $LSAlertsoptions['bps_login_security_db_mod_time'] ) != 0 && $LSAlertsoptions['bps_login_security_db_mod_time'] != '' && strcmp( bps_getLoginSecurityResetFileLastMod_minutes(), getBPSInstallTime() ) == 0 ) {
	
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
		
		touch( $filename, strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) - 3600;	
	
	// Prevents BackWPup coding mistake from displaying BPS Pro Dashboard alerts on the BackWPup Backups page
	if ( ! preg_match( '/page=backwpupbackups/', $_SERVER['QUERY_STRING'], $matches ) ) {	
	if ( $LSAlertsoptions['bps_login_security_db_mod_time'] != '' && strcmp( bps_getLoginSecurityResetFileLastMod_secs(), $LSAlertsoptions['bps_login_security_db_mod_time'] ) != 0 && $db_timestamp_plus_one != strtotime( bps_getLoginSecurityResetFileLastMod_secs() ) && $db_timestamp_minus_one != strtotime( bps_getLoginSecurityResetFileLastMod_secs() ) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Login Security Alert', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Login Security page.', 'bulletproof-security').'<br>'.__('To reset/clear Login Security Alerts click the Reset|Clear Login Security Alerts button on the Login Security page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
	}
}
add_action('admin_notices', 'bps_LoginSecurityResetModTimeDiff_wp');

// Add Action for the Security Log Cron job to check for new log entries
add_action('bpsPro_security_log_check', 'bps_smonitor_SecurityLogModTimeDiff_wp_email');

// The Scheduled Cron Job to check the Security Log hourly
function bpsPro_schedule_SecurityLog_check() {
	if ( !wp_next_scheduled( 'bpsPro_security_log_check' ) ) {
		wp_schedule_event(time(), 'hourly', 'bpsPro_security_log_check');
	}
}
add_action('init', 'bpsPro_schedule_SecurityLog_check');

// Add Security Log Cron to cron_schedules
function bpsPro_add_hourly_security_log_cron( $schedules ) {
	$schedules['hourly'] = array('interval' => 3600, 'display' => __('Once Hourly'));
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_add_hourly_security_log_cron');

// S-Monitor Email Alert - The scheduled Cron function to check the Security Log new log entries
// String comparison of DB Last Modified Time and Actual File Last Modified Time
function bps_smonitor_SecurityLogModTimeDiff_wp_email() {
$options1 = get_option('bulletproof_security_options_Security_log');
$options = get_option('bulletproof_security_options_email');
$last_modified_time_secs = bps_getSecurityLogLastMod_secs();
$last_modified_time_db = $options1['bps_security_log_date_mod'];
	
	if ( strcmp( $last_modified_time_secs, $last_modified_time_db ) != 0 ) { // 0 is equal strings
	if ( $options['bps_security_log_email'] == 'yes' ) {
	
	$bps_email = $options['bps_send_email_to'];
	$bps_email_from = $options['bps_send_email_from'];
	$bps_email_cc = $options['bps_send_email_cc'];
	$bps_email_bcc = $options['bps_send_email_bcc'];
	$justUrl = get_site_url();
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";
	$mail_Subject = " BPS Pro Alert: A New Security Log Entry Has Been Logged ";

	$mail_message = '<p><font color="red"><strong>A New Security Log Entry Has Been Logged in your Security Log File.</strong></font></p>';
	$mail_message .= '<p>Site: '.$justUrl.'</p>'; 
	$mail_message .= '<p>To view the Security Log go to the BPS Security Log page.</p>';
	
	wp_mail( $bps_email, $mail_Subject, $mail_message, $headers );
	
	} elseif ( $options['bps_security_log_email'] == 'no' ) { 
		wp_clear_scheduled_hook('bpsPro_security_log_check');
	}
	}
}

// Add Action for the PHP Error Log Cron job to check for new php errors
add_action('bpsPro_php_elog_check', 'bps_smonitor_ELogModTimeDiff_wp_email');

// The Scheduled Cron Job to check the PHP Error Log hourly
function bpsPro_schedule_Elog_check() {
	if ( !wp_next_scheduled( 'bpsPro_php_elog_check' ) ) {
		wp_schedule_event(time(), 'hourly', 'bpsPro_php_elog_check');
	}
}
add_action('init', 'bpsPro_schedule_Elog_check');

// Add ELog Cron to cron_schedules
function bpsPro_add_hourly_elog_cron( $schedules ) {
	$schedules['hourly'] = array('interval' => 3600, 'display' => __('Once Hourly'));
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_add_hourly_elog_cron');

// S-Monitor Email Alert - The scheduled Cron function to check the PHP Error Log new errors
// String comparison of DB Last Modified Time and Actual File Last Modified Time
function bps_smonitor_ELogModTimeDiff_wp_email() {
$options2 = get_option('bulletproof_security_options_elog');
$options = get_option('bulletproof_security_options_email');
$last_modified_time = bps_getPhpELogLastMod_smonitor();
$last_modified_time_db = $options2['bps_error_log_date_mod'];
	
	if ( strcmp($last_modified_time, $last_modified_time_db) != 0 ) { // 0 is equal strings
	if ( $options['bps_error_log_email'] == 'yes' ) {
	
	$bps_email = $options['bps_send_email_to'];
	$bps_email_from = $options['bps_send_email_from'];
	$bps_email_cc = $options['bps_send_email_cc'];
	$bps_email_bcc = $options['bps_send_email_bcc'];
	$justUrl = get_site_url();
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";
	$mail_Subject = " BPS Pro Alert: A PHP Error has been logged ";

	$mail_message = '<p><font color="red"><strong>A PHP Error has been logged in your PHP Error Log File.</strong></font></p>';
	$mail_message .= '<p>Site: '.$justUrl.'</p>'; 
	$mail_message .= '<p>To view the php error go to the BPS P-Security PHP Error Log page.</p>';
	
	wp_mail( $bps_email, $mail_Subject, $mail_message, $headers );
	
	} elseif ( $options['bps_error_log_email'] == 'no' ) { 
		wp_clear_scheduled_hook('bpsPro_php_elog_check');
	}
	}
}

// S-Monitor AutoRestore Email Alert 
function bps_smonitor_autorestore_email() {
global $wpdb;
$options = get_option('bulletproof_security_options_email');
	
	if ( $options['bps_autorestore_email'] == 'yes' ) {
	
	$timeNow = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
	$timePlusOne = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) + 60 );
	$Qtable = $wpdb->prefix . "bpspro_arq_quarantine";
	$DB_row_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $Qtable WHERE time >= %s AND time <= %s", $timeNow, $timePlusOne ) );

	$bps_email_to = $options['bps_send_email_to'];
	$bps_email_from = $options['bps_send_email_from'];
	$bps_email_cc = $options['bps_send_email_cc'];
	$bps_email_bcc = $options['bps_send_email_bcc'];
	$justUrl = get_site_url();

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro Alert: AutoRestore|Quarantine Has Quarantined A File ";
	
	$message = '<p><font color="red"><strong>A file has been sent to Quarantine</strong></font></p>';
	$message .= '<p><strong>Total Number of Files Quarantined: <font color="blue">'.$DB_row_count.'</font></strong></p>';
	$message .=  '<p>To view the file that was quarantined, log into your website and go to the BPS Pro Quarantine page. Click the Read Me help button on the Quarantine page for instructions on what to do next.</p>';
	$message .= '<p>Site: '.$justUrl.'</p>'; 

	wp_mail( $bps_email_to, $subject, $message, $headers );
	}
}

?>