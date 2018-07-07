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

// S-Monitor Display HUD Alerts in WP Dashboard Only if wpOn
function bps_HUD_WP_Dashboard() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_HUD_alerts'] == 'wpOn') { 
		echo bps_check_php_version_error();
		echo bps_check_safemode();
		echo bps_check_permalinks_error();
		echo bps_check_iis_supports_permalinks();
		echo bps_hud_check_bpsbackup();
		echo bps_hud_check_bpsbackup_master();
		echo bps_hud_check_public_username();
		echo bps_hud_check_sucuri();
		echo bps_hud_check_wordpress_firewall2();
		echo bps_hud_broken_link_checker();
		echo bps_hud_PFW_Roles();
		echo bps_hud_PhpiniHandlerCheck();
		echo bps_hud_jtc_antispam_feature_notice();
		echo bps_hud_pfw_litespeed_notice();
		echo bpsPro_bonus_custom_code_dismiss_notices();
		//echo bps_speed_boost_cache_notice();
		//echo bps_author_enumeration_notice();
		//echo bps_xmlrpc_ddos_notice();
		echo bps_hud_BPSQSE_old_code_check();
		echo @bps_w3tc_htaccess_check($plugin_var);
		echo @bps_wpsc_htaccess_check($plugin_var);
		echo bpsPro_hud_index_files_check();
	}
}
add_action('admin_notices', 'bps_HUD_WP_Dashboard');

// S-Monitor Display HUD Alerts in BPS Only if bpsOn
function bps_HUD_bps_only() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_HUD_alerts'] == 'bpsOn') { 
		echo bps_check_php_version_error();
		echo bps_check_safemode();
		echo bps_check_permalinks_error();
		echo bps_check_iis_supports_permalinks();
		echo bps_hud_check_bpsbackup();
		echo bps_hud_check_bpsbackup_master();
		echo bps_hud_check_public_username();
		echo bps_hud_check_sucuri();
		echo bps_hud_check_wordpress_firewall2();
		echo bps_hud_broken_link_checker();
		echo bps_hud_PFW_Roles();
		echo bps_hud_PhpiniHandlerCheck();
		echo bps_hud_jtc_antispam_feature_notice();
		echo bps_hud_pfw_litespeed_notice();
		echo bpsPro_bonus_custom_code_dismiss_notices();
		//echo bps_speed_boost_cache_notice();
		//echo bps_author_enumeration_notice();
		//echo bps_xmlrpc_ddos_notice();
		echo bps_hud_BPSQSE_old_code_check();
		echo @bps_w3tc_htaccess_check($plugin_var);
		echo @bps_wpsc_htaccess_check($plugin_var);
		echo bpsPro_hud_index_files_check();
	}
}

// S-Monitor - BPS Pro upgrade: updates/saves any new S-Monitor options, log options & other new db options
// can be used to display one time New Feature Notification or not.
// for BPS Pro 10.2: saving the new Login Security Attempts Remaining DB option & NOT displaying a Dismiss Notice
// saving the new bulletproof_security_options_ARQ_upgrade DB option for WP and theme upgrades
// to reuse and if displaying a Dismiss Notice change the nag name. use the BPS version number: bps_ignore_new_feature_notice_102 and delete the old meta option
function bpsPro_new_feature_notification() {
	
	if ( current_user_can('manage_options') ) {
	
	// uncomment if using the Dismiss Notice
	//global $bpspro_version, $current_user;
	//$user_id = $current_user->ID;
	
	// return on new installations ONLY - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( ! get_option('bulletproof_security_options_activation') || ! get_option('bulletproof_security_options_monitor') ) {
		return;
	}	
	
/*	

	if ( !get_user_meta( $user_id, 'bps_ignore_new_feature_notice' ) ) {
		
	if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
		$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
	} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
		$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
	} else {
		$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
	}		
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Pro 9.0 Major Version Release New Feature Notifications', 'bulletproof-security').'</font><br>'.__('BPS Pro 9.0 includes DB Backup and a new concept in Database Security: DB Monitor.', 'bulletproof-security').'<br>'.__('The DB Monitor is automatically setup with default settings during BPS Pro upgrades or new installations.', 'bulletproof-security').'<br>'.__('Significant changes have been made to AutoRestore|Quarantine in BPS Pro 9.0 - See Recommended new settings on the Whats New & AutoRestore pages.', 'bulletproof-security').'<br>'.__('3 New ini_set Options automatically added to the wp-config.php file: session.cookie_httponly, session.cookie_secure & session.use_only_cookies.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Pro Whats New page to find out more about these and other new Features & Options.', 'bulletproof-security').'<br><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bpsPro_new_feature_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
		echo $text;	
	}
*/
	
	// add the most current db option added to BPS Pro here which means the option has already been updated/saved once
	// and this function should do a return and not proceed any further
	// 10.2 new Login Security Attempts Remaining option added
	// 10.2 new bulletproof_security_options_ARQ_upgrade DB option for WP and theme upgrades
	// bps_first_launch needs to be checked so that this function does not fire before the Setup Wizard is run
	$SMonitorOptions = get_option('bulletproof_security_options_monitor');
	$BPS_LSM_Options = get_option('bulletproof_security_options_login_security');
	
	if ( $SMonitorOptions['bps_first_launch'] && $BPS_LSM_Options['bps_login_security_remaining'] ) {
		return;	
	}	
	
	$bps_option_name8 = 'bulletproof_security_options_login_security';
	$bps_new_value8   = '3';
	$bps_new_value8_1 = '60';	
	$bps_new_value8_2 = '60';
	$bps_new_value8_3 = '';
	$bps_new_value8_4 = 'On';
	$bps_new_value8_5 = 'logLockouts';
	$bps_new_value8_6 = 'wpErrors';
	$bps_new_value8_7 = 'On';
	$bps_new_value8_8 = 'enable';
	$bps_new_value8_9 = 'ascending';
	
	$BPS_Options8 = array(
	'bps_max_logins' 				=> $bps_new_value8, 
	'bps_lockout_duration' 			=> $bps_new_value8_1, 
	'bps_manual_lockout_duration' 	=> $bps_new_value8_2, 
	'bps_max_db_rows_display' 		=> $bps_new_value8_3, 
	'bps_login_security_OnOff' 		=> $bps_new_value8_4, 
	'bps_login_security_logging' 	=> $bps_new_value8_5, 
	'bps_login_security_errors' 	=> $bps_new_value8_6, 
	'bps_login_security_remaining' 	=> $bps_new_value8_7, 
	'bps_login_security_pw_reset' 	=> $bps_new_value8_8,  
	'bps_login_security_sort' 		=> $bps_new_value8_9 
	);

	if ( ! get_option( $bps_option_name8 ) ) {	
		
		foreach( $BPS_Options8 as $key => $value ) {
			update_option('bulletproof_security_options_login_security', $BPS_Options8);
		}
	
	} else {

		$BPS_Options8 = array(
		'bps_max_logins' 				=> $BPS_LSM_Options['bps_max_logins'], 
		'bps_lockout_duration' 			=> $BPS_LSM_Options['bps_lockout_duration'], 
		'bps_manual_lockout_duration' 	=> $BPS_LSM_Options['bps_manual_lockout_duration'], 
		'bps_max_db_rows_display' 		=> $BPS_LSM_Options['bps_max_db_rows_display'], 
		'bps_login_security_OnOff' 		=> $BPS_LSM_Options['bps_login_security_OnOff'], 
		'bps_login_security_logging' 	=> $BPS_LSM_Options['bps_login_security_logging'], 
		'bps_login_security_errors' 	=> $BPS_LSM_Options['bps_login_security_errors'], 
		'bps_login_security_remaining' 	=> 'On', 
		'bps_login_security_pw_reset' 	=> $BPS_LSM_Options['bps_login_security_pw_reset'],  
		'bps_login_security_sort' 		=> $BPS_LSM_Options['bps_login_security_sort'] 
		);
	
		foreach( $BPS_Options8 as $key => $value ) {
			update_option('bulletproof_security_options_login_security', $BPS_Options8);
		}	
	}	

	// 10.2 new bulletproof_security_options_ARQ_upgrade DB option for WP and theme upgrades
	$arq_upgrade = 'bulletproof_security_options_ARQ_upgrade';
	$BPS_ARQ_upgrade = array( 'bps_arq_upgrade' => 'no' );	
	
	if ( ! get_option( $arq_upgrade ) ) {	
		
		foreach( $BPS_ARQ_upgrade as $key => $value ) {
			update_option('bulletproof_security_options_ARQ_upgrade', $BPS_ARQ_upgrade);
		}
	
	} else {

		foreach( $BPS_ARQ_upgrade as $key => $value ) {
			update_option('bulletproof_security_options_ARQ_upgrade', $BPS_ARQ_upgrade);
		}
	}

	// Plugin Firewall AutoPilot Mode
	$PFWAP_options = get_option('bulletproof_security_options_pfw_autopilot');	
	
	if ( $SMonitorOptions['bps_first_launch'] && $PFWAP_options['bps_pfw_autopilot_cron'] ) {
		return;	
	}

	// BPS Pro Upgrade - automatically save any new S-Monitor or other options for older version upgrades
	if ( $SMonitorOptions['bps_first_launch'] && ! $SMonitorOptions['bps_dbm_status'] ) {
		
	$bps_dbm_options = 'bulletproof_security_options_db_monitor';
	$dbm_cron_end = time() + 900;
	
	$DBM_Options = array( 
	'bps_db_monitor_cron' 						=> 'On', 
	'bps_db_monitor_cron_frequency' 			=> '15', 
	'bps_db_monitor_cron_table_created_check' 	=> 'On', 
	'bps_db_monitor_cron_end' 					=> $dbm_cron_end
	);
	
	if ( ! get_option( $bps_dbm_options ) ) {	
		
		foreach( $DBM_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_monitor', $DBM_Options);
		}
	
	} else {

		foreach( $DBM_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_monitor', $DBM_Options);
		}
	}	

		$BPS_Options6 = array(
		'bps_first_launch' 				=> $SMonitorOptions['bps_first_launch'], 
		'bps_security_status' 			=> $SMonitorOptions['bps_security_status'], 
		'bps_SecLog_entry' 				=> $SMonitorOptions['bps_SecLog_entry'], 
		'bps_autorestore_status' 		=> $SMonitorOptions['bps_autorestore_status'], 
		'bps_plugin_firewall_status' 	=> $SMonitorOptions['bps_plugin_firewall_status'], 
		'bps_UAEG_status' 				=> $SMonitorOptions['bps_UAEG_status'], 
		'bps_login_security_status' 	=> $SMonitorOptions['bps_login_security_status'], 
		'bps_flock_status' 				=> $SMonitorOptions['bps_flock_status'], 
		'bps_HUD_alerts' 				=> $SMonitorOptions['bps_HUD_alerts'], 
		'bps_PHP_ELogLoc_set' 			=> $SMonitorOptions['bps_PHP_ELogLoc_set'], 
		'bps_PHP_ELog_error' 			=> $SMonitorOptions['bps_PHP_ELog_error'], 
		'bps_phpini_created' 			=> $SMonitorOptions['bps_phpini_created'], 
		'bps_login_security_alerts' 	=> $SMonitorOptions['bps_login_security_alerts'], 
		'bps_jtc_antispam_status' 		=> $SMonitorOptions['bps_jtc_antispam_status'], 
		'bps_dbm_status' 				=> 'wpOn', 
		'bps_dbm_alerts' 				=> 'wpOn', 
		'bps_dbb_status' 				=> 'wpOn' 
		);

			foreach( $BPS_Options6 as $key => $value ) {
				update_option('bulletproof_security_options_monitor', $BPS_Options6);
			}	
		
		$SMonitorOptionsEmail = get_option('bulletproof_security_options_email');
		
		$BPS_Options7 = array(
		'bps_error_log_email' 		=> $SMonitorOptionsEmail['bps_error_log_email'], 
		'bps_upgrade_email' 		=> $SMonitorOptionsEmail['bps_upgrade_email'], 
		'bps_autorestore_email' 	=> $SMonitorOptionsEmail['bps_autorestore_email'], 
		'bps_security_log_email' 	=> $SMonitorOptionsEmail['bps_security_log_email'], 
		'bps_send_email_to' 		=> $SMonitorOptionsEmail['bps_send_email_to'], 
		'bps_send_email_from' 		=> $SMonitorOptionsEmail['bps_send_email_from'], 
		'bps_send_email_cc' 		=> $SMonitorOptionsEmail['bps_send_email_cc'], 
		'bps_send_email_bcc' 		=> $SMonitorOptionsEmail['bps_send_email_bcc'], 
		'bps_arq_log_size' 			=> $SMonitorOptionsEmail['bps_arq_log_size'], 
		'bps_security_log_size' 	=> $SMonitorOptionsEmail['bps_security_log_size'], 
		'bps_php_log_size' 			=> $SMonitorOptionsEmail['bps_php_log_size'], 
		'bps_arq_log_email' 		=> $SMonitorOptionsEmail['bps_arq_log_email'], 
		'bps_security_log_emailL' 	=> $SMonitorOptionsEmail['bps_security_log_emailL'], 
		'bps_php_log_email' 		=> $SMonitorOptionsEmail['bps_php_log_email'], 
		'bps_login_security_email' 	=> $SMonitorOptionsEmail['bps_login_security_email'], 
		'bps_dbm_email' 			=> 'yes', 
		'bps_dbm_log_email' 		=> 'email', 
		'bps_dbm_log_size' 			=> '500KB', 
		'bps_dbb_log_email' 		=> 'email', 
		'bps_dbb_log_size' 			=> '500KB'
		);

			foreach( $BPS_Options7 as $key => $value ) {
				update_option('bulletproof_security_options_email', $BPS_Options7);
			}
	
	$bps_option_name_dbm = 'bulletproof_security_options_DBM_log';
	$bps_new_value_dbm = bpsPro_DBM_LogLastMod_wp_secs();
	$BPS_Options_dbm = array( 'bps_dbm_log_date_mod' => $bps_new_value_dbm );

	if ( ! get_option( $bps_option_name_dbm ) ) {	
		
		foreach( $BPS_Options_dbm as $key => $value ) {
			update_option('bulletproof_security_options_DBM_log', $BPS_Options_dbm);
		}
	}	
	
	$bps_option_name_dbb = 'bulletproof_security_options_DBB_log';
	$bps_new_value_dbb = bpsPro_DBB_LogLastMod_wp_secs();
	$BPS_Options_dbb = array( 'bps_dbb_log_date_mod' => $bps_new_value_dbb );

	if ( ! get_option( $bps_option_name_dbb ) ) {	
		
		foreach( $BPS_Options_dbb as $key => $value ) {
			update_option('bulletproof_security_options_DBB_log', $BPS_Options_dbb);
		}
	}	
	} // end if ( $SMonitorOptions['bps_first_launch'] && ! $SMonitorOptions['bps_dbm_status'] ) {
		
	// Save newest Plugin Firewall AutoPilot Mode DB options and turn on AutoPilot Mode on upgrade
	if ( $SMonitorOptions['bps_first_launch'] && ! $PFWAP_options['bps_pfw_autopilot_cron'] ) {
		
		$pfwap_options = 'bulletproof_security_options_pfw_autopilot';

		$BPS_PFWAP_Options = array( 
		'bps_pfw_autopilot_cron' 			=> 'On',  
		'bps_pfw_autopilot_cron_frequency' 	=> '15',  	
		'bps_pfw_autopilot_cron_end' 		=> time() + 900 
		);

		if ( ! get_option( $pfwap_options ) ) {	
		
			foreach( $BPS_PFWAP_Options as $key => $value ) {
				update_option('bulletproof_security_options_pfw_autopilot', $BPS_PFWAP_Options);
			}
		}		
	}
	}
}
add_action('admin_notices', 'bpsPro_new_feature_notification');

//add_action('admin_init', 'bpsPro_new_feature_nag_ignore');

function bpsPro_new_feature_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset( $_GET['bpsPro_new_feature_nag_ignore'] ) && '0' == $_GET['bpsPro_new_feature_nag_ignore'] ) {
		add_user_meta( $user_id, 'bps_ignore_new_feature_notice', 'true', true );
	}
}

// Heads Up Display - Check PHP version - top error message new activations / installations
function bps_check_php_version_error() {

	if ( version_compare(PHP_VERSION, '5.0.0', '>=') ) {
		return;
	}
	
	if ( version_compare(PHP_VERSION, '5.0.0', '<') ) {
	
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_HUD_alerts'] == 'bpsOn') {
    	$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS requires at least PHP5 to function correctly. Your PHP version is:', 'bulletproof-security').' '.PHP_VERSION.'</font><br><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45#bulletproof-security-issues-problems" target="_blank" title="Link opens in a new Browser window">'.__('BPS Guide - PHP5 Solution', 'bulletproof-security').'</a></div>';
		echo $text;
	}
	elseif ( $options['bps_HUD_alerts'] == 'wpOn') {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS requires at least PHP5 to function correctly. Your PHP version is: ', 'bulletproof-security').PHP_VERSION.'</font><br><a href="http://www.ait-pro.com/aitpro-blog/1166/bulletproof-security-plugin-support/bulletproof-security-plugin-guide-bps-version-45#bulletproof-security-issues-problems" target="_blank" title="Link opens in a new Browser window">'.__('BPS Guide - PHP5 Solution', 'bulletproof-security').'</a></div>';
		echo $text;
	}
	}
}

// Heads Up Display - Check if PHP Safe Mode is Enabled - Display in BPS and WP Dashboard if S-Monitor is not set to Off
// This check checks if safe_mode is enabled not 0 = On or 1 = Off
function bps_check_safemode() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( $options['bps_HUD_alerts'] == 'Off' ) { 
		return;
	}
	
	if (ini_get('safe_mode') == 1) {
	if ($options['bps_HUD_alerts'] == 'bpsOn') {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS has detected that Safe Mode is set to On in your php.ini file.', 'bulletproof-security').'</font><br>'.__('If you see errors that BPS was unable to automatically create the backup folders this is probably the reason why.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
		echo $text;
	}
	elseif ($options['bps_HUD_alerts'] == 'wpOn') {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS has detected that Safe Mode is set to On in your php.ini file.', 'bulletproof-security').'</font><br>'.__('If you see errors that BPS was unable to automatically create the backup folders this is probably the reason why.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
		echo $text;
	}
	}
}

// Heads Up Display w/ Dismiss - Check if Permalinks are enabled - top error message new activations / installations
function bps_check_permalinks_error() {
	
	if ( get_option('permalink_structure') == '' ) { 
	
		global $current_user;
		$user_id = $current_user->ID;		
		$options = get_option('bulletproof_security_options_monitor');	
		
		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_Permalinks_notice') ) {
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}
		
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('HUD Check: Custom Permalinks are NOT being used.', 'bulletproof-security').'</font><br>'.__('It is recommended that you use Custom Permalinks: ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2304/wordpress-tips-tricks-fixes/permalinks-wordpress-custom-permalinks-wordpress-best-wordpress-permalinks-structure/" target="_blank" title="Link opens in a new Browser window">'.__('How to setup Custom Permalinks', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_Permalinks_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		elseif ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_Permalinks_notice')) { 
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('HUD Check: Custom Permalinks are NOT being used.', 'bulletproof-security').'</font><br>'.__('It is recommended that you use Custom Permalinks: ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2304/wordpress-tips-tricks-fixes/permalinks-wordpress-custom-permalinks-wordpress-best-wordpress-permalinks-structure/" target="_blank" title="Link opens in a new Browser window">'.__('How to setup Custom Permalinks', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_Permalinks_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_Permalinks_nag_ignore');

function bps_Permalinks_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_Permalinks_nag_ignore']) && '0' == $_GET['bps_Permalinks_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_Permalinks_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - Check if this is a Windows IIS server and if IIS7 supports permalink rewriting
function bps_check_iis_supports_permalinks() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( $options['bps_HUD_alerts'] == 'Off') { 
		return;
	}

	global $wp_rewrite, $is_IIS, $is_iis7, $current_user;
	$user_id = $current_user->ID;

	if ( $is_IIS && ! iis7_supports_permalinks() ) {
	if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_iis_notice')) {
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
		
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS has detected that your Server is a Windows IIS Server that does not support htaccess rewriting.', 'bulletproof-security').'</font><br>'.__('Do NOT activate BulletProof Modes unless you know what you are doing.', 'bulletproof-security').'<br>'.__('Your Server Type is: ', 'bulletproof-security').$_SERVER['SERVER_SOFTWARE'].'<br><a href="http://codex.wordpress.org/Using_Permalinks" target="_blank" title="This link will open in a new browser window.">'.__('WordPress Codex - Using Permalinks - see IIS section', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_iis_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}
	elseif ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_iis_notice') ) { 
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS has detected that your Server is a Windows IIS Server that does not support htaccess rewriting.', 'bulletproof-security').'</font><br>'.__('Do NOT activate BulletProof Modes unless you know what you are doing.', 'bulletproof-security').'<br>'.__('Your Server Type is: ', 'bulletproof-security').$_SERVER['SERVER_SOFTWARE'].'<br><a href="http://codex.wordpress.org/Using_Permalinks" target="_blank" title="This link will open in a new browser window.">'.__('WordPress Codex - Using Permalinks - see IIS section', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_iis_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}
	}
}

add_action('admin_init', 'bps_iis_nag_ignore');

function bps_iis_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_iis_nag_ignore']) && '0' == $_GET['bps_iis_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_iis_notice', 'true', true);
	}
}

// Heads Up Display - mkdir and chmod errors are suppressed on activation - check if /bps-backup folder exists
function bps_hud_check_bpsbackup() {
$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_HUD_alerts'] == 'Off' ) { 
		return;
	}

	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup' ) ) {
		
		$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

		if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder manually via FTP. The folder permissions for the bps-backup folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
			echo $text;
		}
		elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder manually via FTP. The folder permissions for the bps-backup folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
			echo $text;
		}
	}
}

// Heads Up Display - mkdir and chmod errors are suppressed on activation - check if /bps-backup/master-backups folder exists
function bps_hud_check_bpsbackup_master() {
$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_HUD_alerts'] == 'Off' ) {
		return;	
	}
	
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/master-backups' ) ) {
	
		$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );	
		
		if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder manually via FTP. The folder permissions for the master-backups folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
			echo $text;
		}
		elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) { 
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING! BPS was unable to automatically create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder.', 'bulletproof-security').'</font><br>'.__('You will need to create the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/master-backups folder manually via FTP. The folder permissions for the master-backups folder need to be set to 755 in order to successfully perform permanent online backups.', 'bulletproof-security').'<br>'.__('To remove this message permanently click ', 'bulletproof-security').'<a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank" title="Link opens in a new Browser window">'.__('HERE.', 'bulletproof-security').'</a></div>';
			echo $text;
		}
	}
}

// Heads Up Display w/ Dismiss - check if Admin, Author, Editor & Contributor username is the same as publicly displayed name
// crap i had the wrong nag ignore for wpOn - fixed
function bps_hud_check_public_username() {
global $current_user;
$options = get_option('bulletproof_security_options_monitor');
$blogusers = get_users('who=authors');
$user_id = $current_user->ID;
$text = '';

	if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_public_username_notice') ) {

		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}	
	
	foreach ( $blogusers as $user ) {
		if ( $user->user_login == $user->display_name )
        	$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><li><font color="red">'.__('This username/user account: ', 'bulletproof-security').'</font><font color="blue">' . $user->user_login . '</font><font color="red">'.__(' is displayed Publicly as: ', 'bulletproof-security').'</font><font color="blue">' . $user->display_name . '</font><br>'.__('It is highly recommended that you edit the Profile for this user account and change the "Display name publicly as" setting to a different name.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_public_username_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></li></div>';
			echo $text;
    	}
	}
	
	if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_public_username_notice') ) {
	
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}
	
	foreach ( $blogusers as $user ) {
		if ( $user->user_login == $user->display_name )
        	$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><li><font color="red">'.__('This username/user account: ', 'bulletproof-security').'</font><font color="blue">' . $user->user_login . '</font><font color="red">'.__(' is displayed Publicly as: ', 'bulletproof-security').'</font><font color="blue">' . $user->display_name . '</font><br>'.__('It is highly recommended that you edit the Profile for this user account and change the "Display name publicly as" setting to a different name.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_public_username_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></li></div>';
			echo $text;
    	}
	}
}

add_action('admin_init', 'bps_public_username_nag_ignore');

function bps_public_username_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_public_username_nag_ignore']) && '0' == $_GET['bps_public_username_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_public_username_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - Sucuri 1-click Hardening wp-content .htaccess file problem - breaks BPS and lots of other stuff
function bps_hud_check_sucuri() {
$filename = WP_CONTENT_DIR . '/.htaccess';
$plugin_var = 'sucuri-scanner/sucuri.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins') ) );

	if ( $return_var == 1 && ! file_exists($filename) ) { // 1 equals active
		return;	
	}
	
	$check_string = @file_get_contents($filename);

	if ( $return_var == 1 && file_exists($filename) && strpos( $check_string, "deny from all" ) ) { // 1 equals active	
	
		global $current_user;
		$options = get_option('bulletproof_security_options_monitor');
		$user_id = $current_user->ID;

		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_sucuri_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Sucuri 1-click Hardening wp-content .htaccess file problem detected', 'bulletproof-security').'</font><br>'.__('Using the Sucuri 1-click Hardening wp-content .htaccess file will cause several BPS Pro features not to work correctly.', 'bulletproof-security').'<br>'.__('To fix this issue delete the Sucuri .htaccess file in your wp-content folder.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_sucuri_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		
		if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_sucuri_notice') ) { 
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Sucuri 1-click Hardening wp-content .htaccess file problem detected', 'bulletproof-security').'</font><br>'.__('Using the Sucuri 1-click Hardening wp-content .htaccess file will cause several BPS Pro features not to work correctly.', 'bulletproof-security').'<br>'.__('To fix this issue delete the Sucuri .htaccess file in your wp-content folder.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_sucuri_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;		
		}
	}
}

add_action('admin_init', 'bps_sucuri_nag_ignore');

function bps_sucuri_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_sucuri_nag_ignore']) && '0' == $_GET['bps_sucuri_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_sucuri_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - WordPress Firewall 2 plugin - breaks BPS and lots of other stuff
function bps_hud_check_wordpress_firewall2() {
$plugin_var = 'wordpress-firewall-2/wordpress-firewall-2.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var != 1 ) { // 1 equals active
		return;	
	}
	
	if ( $return_var == 1 ) { // 1 equals active	
	
		global $current_user;
		$options = get_option('bulletproof_security_options_monitor');
		$user_id = $current_user->ID;			
		
		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_wpfirewall2_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('The WordPress Firewall 2 plugin is installed and activated', 'bulletproof-security').'</font><br>'.__('It is recommended that you delete the WordPress Firewall 2 plugin.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/wordpress-firewall-2-plugin-unable-to-save-custom-code/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a>'.__(' for more information.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_wpfirewall2_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		
		if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_wpfirewall2_notice') ) { 
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('The WordPress Firewall 2 plugin is installed and activated', 'bulletproof-security').'</font><br>'.__('It is recommended that you delete the WordPress Firewall 2 plugin.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/wordpress-firewall-2-plugin-unable-to-save-custom-code/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a>'.__(' for more information.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_wpfirewall2_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;		
		}
	}
}

add_action('admin_init', 'bps_wpfirewall2_nag_ignore');

function bps_wpfirewall2_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_wpfirewall2_nag_ignore']) && '0' == $_GET['bps_wpfirewall2_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_wpfirewall2_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - Broken Link Checker plugin - HEAD Request Method filter check
function bps_hud_broken_link_checker() {
$filename = ABSPATH . '.htaccess';
$check_string = @file_get_contents($filename);
$plugin_var = 'broken-link-checker/broken-link-checker.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

    if ( $return_var == 1 && ! strpos( $check_string, "HEAD|TRACE|DELETE|TRACK|DEBUG" ) ) { // 1 equals active
		return;
	}
	
	if ( $return_var == 1 && strpos( $check_string, "HEAD|TRACE|DELETE|TRACK|DEBUG" ) ) {
		
		global $current_user;
		$options = get_option('bulletproof_security_options_monitor');
		$user_id = $current_user->ID;

		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_BLC_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Broken Link Checker plugin HEAD Request Method filter problem detected.', 'bulletproof-security').'</font><br>'.__('To fix this problem ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/broken-link-checker-plugin-403-error/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_BLC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		
		if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_BLC_notice') ) { 
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Broken Link Checker plugin HEAD Request Method filter problem detected.', 'bulletproof-security').'</font><br>'.__('To fix this problem ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/broken-link-checker-plugin-403-error/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a><br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_BLC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_BLC_nag_ignore');

function bps_BLC_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_BLC_nag_ignore']) && '0' == $_GET['bps_BLC_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_BLC_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - Network/Multisite Plugin Firewall Additional Roles
function bps_hud_PFW_Roles() {

	if ( ! is_multisite() ) {
		return;
	}

	$PFWoptions = get_option('bulletproof_security_options_pfirewall_roles');

	if ( is_multisite() && is_super_admin() && ! $PFWoptions['bps_pfw_administrator'] ) {   
	
		global $current_user;
		$options = get_option('bulletproof_security_options_monitor');
		$user_id = $current_user->ID;		
		
		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_PFW_roles_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('Feature Notice: Plugin Firewall Additional Roles IP Whitelist', 'bulletproof-security').'</font><br>'.__('The Plugin Firewall has an additional option setting for folks who have additional Administrators, Editors, Authors and Contributors who log into their Network/Multisite website. This option automatically whitelists additional Roles by IP address.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To go to the Plugin Firewall setup section and click on the Read Me help button for more information about this option.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PFW_roles_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		
		if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_PFW_roles_notice') ) { 
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Feature Notice: Plugin Firewall Additional Roles IP Whitelist', 'bulletproof-security').'</font><br>'.__('The Plugin Firewall has an additional option setting for folks who have additional Administrators, Editors, Authors and Contributors who log into their Network/Multisite website. This option automatically whitelists additional Roles by IP address.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To go to the Plugin Firewall setup section and click on the Read Me help button for more information about this option.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PFW_roles_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}		
	}
}

add_action('admin_init', 'bps_PFW_roles_nag_ignore');

function bps_PFW_roles_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_PFW_roles_nag_ignore']) && '0' == $_GET['bps_PFW_roles_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_PFW_roles_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - Check if php.ini handler code exists in root .htaccess file, but not in Custom Code
function bps_hud_PhpiniHandlerCheck() {
global $current_user;
$user_id = $current_user->ID;
$options = get_option('bulletproof_security_options_monitor');
$file = ABSPATH . '.htaccess';	

	if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice') ) {	

		if ( file_exists($file) ) {		

			$file_contents = @file_get_contents($file);
			$CustomCodeoptions = get_option('bulletproof_security_options_customcode');
			
			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $file_contents, $matches);
			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $CustomCodeoptions['bps_customcode_one'], $DBmatches);
		
			if ( $matches[0] && !$DBmatches[0] ) {
			
			if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
				$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
			} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
				$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
			} else {
				$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
			}			
			
				$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('HUD Check: PHP/php.ini handler htaccess code check', 'bulletproof-security').'</font><br>'.__('PHP/php.ini handler htaccess code was found in your root .htaccess file, but was NOT found in BPS Pro Custom Code.', 'bulletproof-security').'<br>'.__('It is recommended that you copy your PHP/php.ini handler htaccess code in your root htaccess file to BPS Pro Custom Code.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/pre-installation-wizard-checks-phpphp-ini-handler-htaccess-code-check/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a>'.__(' for instructions on how to copy your PHP/php.ini handler htaccess code to BPS Pro Custom Code.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PhpiniHandler_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
				echo $text;			
			}
		}
	}

	if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice') ) { 
	
		if ( file_exists($file) ) {		

			$file_contents = @file_get_contents($file);
			$CustomCodeoptions = get_option('bulletproof_security_options_customcode');

			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $file_contents, $matches);
			preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $CustomCodeoptions['bps_customcode_one'], $DBmatches);
		
			if ( $matches[0] && !$DBmatches[0] ) {
			
			if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
				$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
			} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
				$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
			} else {
				$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
			}		
			
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('HUD Check: PHP/php.ini handler htaccess code check', 'bulletproof-security').'</font><br>'.__('PHP/php.ini handler htaccess code was found in your root .htaccess file, but was NOT found in BPS Pro Custom Code.', 'bulletproof-security').'<br>'.__('It is recommended that you copy your PHP/php.ini handler htaccess code in your root htaccess file to BPS Pro Custom Code.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/pre-installation-wizard-checks-phpphp-ini-handler-htaccess-code-check/" target="_blank" title="Link opens in a new Browser window">'.__('Click Here', 'bulletproof-security').'</a>'.__(' for instructions on how to copy your PHP/php.ini handler htaccess code to BPS Pro Custom Code.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PhpiniHandler_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
				echo $text;			
			}
		}
	}
}

add_action('admin_init', 'bps_PhpiniHandler_nag_ignore');

function bps_PhpiniHandler_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_PhpiniHandler_nag_ignore']) && '0' == $_GET['bps_PhpiniHandler_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice', 'true', true);
	}
}

// Heads Up Display - JTC Anti-Spam Feature Dimiss Notice
function bps_hud_jtc_antispam_feature_notice() {
global $current_user;
$options = get_option('bulletproof_security_options_monitor');
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');	
$user_id = $current_user->ID;

	if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_JTC_notice') ) {
		// BPS Pro Upgraders non-Wizard Setup - new feature notification for existing BPS Pro users	
		if ( $options['bps_first_launch'] && ! get_option('bulletproof_security_options_login_security_jtc') ) {
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}			
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('New Feature Setup Notice: JTC Anti-Spam', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the New JTC Anti-Spam page and choose the JTC Anti-Spam options you would like to use', 'bulletproof-security').'<br>'.__('or just click the Dismiss Notice button below if you do not want to use JTC Anti-Spam.', 'bulletproof-security').'<br>'.__('To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_JTC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}			
		
		// New BPS Pro users Setup Wizard	
		if ( get_option('bulletproof_security_options_login_security_jtc') && $BPSoptionsJTC['bps_jtc_login_form'] != '1' && $BPSoptionsJTC['bps_jtc_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_lostpassword_form'] != '1' && $BPSoptionsJTC['bps_jtc_comment_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] != '1' ) {
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}	
		
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('Feature Setup Notice: JTC Anti-Spam', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the New JTC Anti-Spam page and choose the JTC Anti-Spam options you would like to use', 'bulletproof-security').'<br>'.__('or just click the Dismiss Notice button below if you do not want to use JTC Anti-Spam.', 'bulletproof-security').'<br>'.__('To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_JTC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}				
	}
		
	if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_JTC_notice') ) { 
		// BPS Pro Upgraders non-Wizard Setup - new feature notification for existing BPS Pro users	
		if ( $options['bps_first_launch'] && !get_option('bulletproof_security_options_login_security_jtc') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('New Feature Setup Notice: JTC Anti-Spam', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the New JTC Anti-Spam page and choose the JTC Anti-Spam options you would like to use', 'bulletproof-security').'<br>'.__('or just click the Dismiss Notice button below if you do not want to use JTC Anti-Spam.', 'bulletproof-security').'<br>'.__('To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_JTC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}			
		
		// New BPS Pro users Setup Wizard	
		if ( get_option('bulletproof_security_options_login_security_jtc') && $BPSoptionsJTC['bps_jtc_login_form'] != '1' && $BPSoptionsJTC['bps_jtc_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_lostpassword_form'] != '1' && $BPSoptionsJTC['bps_jtc_comment_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] != '1' ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
		
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Feature Setup Notice: JTC Anti-Spam', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the New JTC Anti-Spam page and choose the JTC Anti-Spam options you would like to use', 'bulletproof-security').'<br>'.__('or just click the Dismiss Notice button below if you do not want to use JTC Anti-Spam.', 'bulletproof-security').'<br>'.__('To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_JTC_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}				
	}
}

add_action('admin_init', 'bps_JTC_nag_ignore');

function bps_JTC_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_JTC_nag_ignore']) && '0' == $_GET['bps_JTC_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_JTC_notice', 'true', true);
	}
}

// Heads Up Display w/ Dismiss - LiteSpeed Server / Plugin Firewall notice
// LiteSpeed does not support the Apache SetEnvIf directive used in the Plugin Firewall htaccess code
// they will eventually support this directive. Will notify users by creating a new Dismiss notice when that happens.
function bps_hud_pfw_litespeed_notice() {

    if ( @substr($sapi_type, 0, 9) != 'litespeed' ) {
		return;
	}
	
	if ( @substr($sapi_type, 0, 9) == 'litespeed' ) {
		
		global $current_user;
		$user_id = $current_user->ID;
		$options = get_option('bulletproof_security_options_monitor');

		if ( $options['bps_HUD_alerts'] == 'bpsOn' && !get_user_meta($user_id, 'bps_ignore_PFW_litespeed_notice') ) {
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}		
			
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('LiteSpeed Server|Plugin Firewall Notice', 'bulletproof-security').'</font><br>'.__('LiteSpeed servers do not support the Apache SetEnvIf directive that is used in the Plugin Firewall .htaccess code at this time. The Plugin Firewall will not work correctly on LiteSpeed servers at this time and needs to be Turned Off/Deactivated. LiteSpeed is planning on adding support for this directive in the future. When LiteSpeed has added support for this directive we will add a new LiteSpeed Dismiss Notice that will be displayed to you in the next version release of BPS Pro to let you know that you can now use the Plugin Firewall on your LiteSpeed Server.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PFW_litespeed_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
		
		if ( $options['bps_HUD_alerts'] == 'wpOn' && !get_user_meta($user_id, 'bps_ignore_PFW_litespeed_notice') ) { 
			
		if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
		} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
			$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
		}	
			
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('LiteSpeed Server|Plugin Firewall Notice', 'bulletproof-security').'</font><br>'.__('LiteSpeed servers do not support the Apache SetEnvIf directive that is used in the Plugin Firewall .htaccess code at this time. The Plugin Firewall will not work correctly on LiteSpeed servers at this time and needs to be Turned Off/Deactivated. LiteSpeed is planning on adding support for this directive in the future. When LiteSpeed has added support for this directive we will add a new LiteSpeed Dismiss Notice that will be displayed to you in the next version release of BPS Pro to let you know that you can now use the Plugin Firewall on your LiteSpeed Server.', 'bulletproof-security').'<br>'.__('To Dismiss this Notice click the Dismiss Notice button below. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br><div style="float:left;margin:3px 0px 3px 0px;padding:2px 6px 2px 6px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'bps_PFW_litespeed_nag_ignore=0'.'" style="text-decoration:none;font-weight:bold;">'.__('Dismiss Notice', 'bulletproof-security').'</a></div></div>';
			echo $text;
		}
	}
}

add_action('admin_init', 'bps_PFW_litespeed_nag_ignore');

function bps_PFW_litespeed_nag_ignore() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_PFW_litespeed_nag_ignore']) && '0' == $_GET['bps_PFW_litespeed_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_ignore_PFW_litespeed_notice', 'true', true);
	}
}

// Heads Up Display - Bonus Custom Code with Dismiss Notices
function bpsPro_bonus_custom_code_dismiss_notices() {
global $current_user;
$user_id = $current_user->ID;	
	
	if ( current_user_can('manage_options') ) { 
	$text = '';
	
	if ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) != 'wp-admin' ) {
		$bps_base = basename(esc_html($_SERVER['REQUEST_URI'])) . '?';
	} elseif ( esc_html($_SERVER['QUERY_STRING']) == '' && basename(esc_html($_SERVER['REQUEST_URI'])) == 'wp-admin' ) {
		$bps_base = basename( str_replace( 'wp-admin', 'index.php?', esc_html($_SERVER['REQUEST_URI'])));
	} else {
		$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) ) . '&';
	}
		
	if ( !get_user_meta($user_id, 'bps_brute_force_login_protection_notice') || !get_user_meta($user_id, 'bps_speed_boost_cache_notice') || !get_user_meta($user_id, 'bps_author_enumeration_notice') || !get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') || !get_user_meta($user_id, 'bps_referer_spam_notice') || !get_user_meta($user_id, 'bps_sniff_driveby_notice') || !get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) { 		
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Bonus Custom Code:', 'bulletproof-security').'</font><br>'.__('Click the links below to get Bonus Custom Code or click the Dismiss Notice link. To Reset Dismiss Notices click the Reset|Recheck Dismiss Notices button on the S-Monitor page.', 'bulletproof-security').'<br>';
		
	}
		
	if ( !get_user_meta($user_id, 'bps_brute_force_login_protection_notice') ) { 	
		
		$text .= '<div id="BC1" style="">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/protect-login-page-from-brute-force-login-attacks/" title="Additional Protection for the Login Page from Brute Force Login Attacks" target="_blank">'.__('Brute Force Login Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_brute_force_login_protection_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( !get_user_meta($user_id, 'bps_speed_boost_cache_notice') ) { 	

		$text .= '<div id="BC2" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/htaccess-caching-code-speed-boost-cache-code/" title="Speed up your website performance with Browser Cache code" target="_blank">'.__('Speed Boost Cache Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_speed_boost_cache_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( !get_user_meta($user_id, 'bps_author_enumeration_notice') ) { 

		$text .= '<div id="BC3" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/wordpress-author-enumeration-bot-probe-protection-author-id-user-id/" title="Protects against hacker and spammer bots finding Author names & User names on your website" target="_blank">'.__('Author Enumeration BOT Probe Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_author_enumeration_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}
		
	if ( !get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') ) { 		

		$text .= '<div id="BC4" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/wordpress-xml-rpc-ddos-protection-protect-xmlrpc-php-block-xmlrpc-php-forbid-xmlrpc-php/" title="Protects against the XML Quadratic Blowup Attack, DDoS Attacks as well as other various XML-RPC exploits" target="_blank">'.__('XML-RPC DDoS Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_xmlrpc_ddos_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}

	if ( !get_user_meta($user_id, 'bps_referer_spam_notice') ) {

		$text .= '<div id="BC5" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/block-referer-spammers-semalt-kambasoft-ranksonic-buttons-for-website/" title="Protects against Referer Spamming and Phishing" target="_blank">'.__('Referer Spam|Phishing Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_referer_spam_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
		
	}

	if ( !get_user_meta($user_id, 'bps_sniff_driveby_notice') ) {		
		
		$text .= '<div id="BC6" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/mime-sniffing-data-sniffing-content-sniffing-drive-by-download-attack-protection/" title="Protects against Mime Sniffing, Data Sniffing, Content Sniffing and Drive-by Download Attacks" target="_blank">'.__('Mime Sniffing|Drive-by Download Attack Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_sniff_driveby_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
	}

	if ( !get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) {		
		
		$text .= '<div id="BC7" style="margin-top:2px;">'.__('Get ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/rssing-com-good-or-bad/" title="Protects against external websites displaying your website pages or Feeds in iFrames and Clickjacking Protection" target="_blank">'.__('External iFrame|Clickjacking Protection Code', 'bulletproof-security').'</a>'.__(' or ', 'bulletproof-security').'<span style=""><a href="'.$bps_base.'bps_iframe_clickjack_nag_ignore=0'.'" style="">'.__('Dismiss Notice', 'bulletproof-security').'</a></span></div>';
	}

		echo $text;
		
		if ( !get_user_meta($user_id, 'bps_brute_force_login_protection_notice') || !get_user_meta($user_id, 'bps_speed_boost_cache_notice') || !get_user_meta($user_id, 'bps_author_enumeration_notice') || !get_user_meta($user_id, 'bps_xmlrpc_ddos_notice') || !get_user_meta($user_id, 'bps_referer_spam_notice') || !get_user_meta($user_id, 'bps_sniff_driveby_notice') || !get_user_meta($user_id, 'bps_iframe_clickjack_notice') ) { 	
		echo '</div>';
		}
	}
}

add_action('admin_init', 'bpsPro_bonus_custom_code_nag_ignores');

function bpsPro_bonus_custom_code_nag_ignores() {
global $current_user;
$user_id = $current_user->ID;
        
	if ( isset($_GET['bps_brute_force_login_protection_nag_ignore']) && '0' == $_GET['bps_brute_force_login_protection_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_brute_force_login_protection_notice', 'true', true);
	}

	if ( isset($_GET['bps_speed_boost_cache_nag_ignore']) && '0' == $_GET['bps_speed_boost_cache_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_speed_boost_cache_notice', 'true', true);
	}

	if ( isset($_GET['bps_author_enumeration_nag_ignore']) && '0' == $_GET['bps_author_enumeration_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_author_enumeration_notice', 'true', true);
	}

	if ( isset($_GET['bps_xmlrpc_ddos_nag_ignore']) && '0' == $_GET['bps_xmlrpc_ddos_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_xmlrpc_ddos_notice', 'true', true);
	}

	if ( isset($_GET['bps_referer_spam_nag_ignore']) && '0' == $_GET['bps_referer_spam_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_referer_spam_notice', 'true', true);
	}

	if ( isset($_GET['bps_sniff_driveby_nag_ignore']) && '0' == $_GET['bps_sniff_driveby_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_sniff_driveby_notice', 'true', true);
	}

	if ( isset($_GET['bps_iframe_clickjack_nag_ignore']) && '0' == $_GET['bps_iframe_clickjack_nag_ignore'] ) {
		add_user_meta($user_id, 'bps_iframe_clickjack_notice', 'true', true);
	}
}

// Heads Up Dispay - Check for older BPS Query String Exploits code saved to BPS Custom Code
function bps_hud_BPSQSE_old_code_check() {
$CustomCodeoptions = get_option('bulletproof_security_options_customcode');	

	if ( $CustomCodeoptions['bps_customcode_bpsqse'] == '') {
		return;
	}
	
	$subject = $CustomCodeoptions['bps_customcode_bpsqse'];	
	$pattern1 = '/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/';
	$pattern2 = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern3 = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	
	if ( $CustomCodeoptions['bps_customcode_bpsqse'] != '' && preg_match($pattern1, $subject, $matches) || preg_match($pattern2, $subject, $matches) || preg_match($pattern3, $subject, $matches) ) {

		$options = get_option('bulletproof_security_options_monitor');

		if ( $options['bps_HUD_alerts'] == 'bpsOn') {
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="blue">'.__('Notice: BPS Query String Exploits Code Changes', 'bulletproof-security').'</font><br>'.__('Older BPS Query String Exploits code was found in BPS Custom Code.', 'bulletproof-security').'<br>'.__('Copy the new Query String Exploits section of code from your root .htaccess file and paste it into this BPS Custom Code text box: CUSTOM CODE BPSQSE BPS QUERY STRING EXPLOITS and click the Save Root Custom Code button.', 'bulletproof-security').'<br>'.__('This Notice will go away once you have copied the new Query String Exploits code to BPS Custom Code and clicked the Save Root Custom Code button.', 'bulletproof-security').'</div>';
			echo $text;
		}
		elseif ( $options['bps_HUD_alerts'] == 'wpOn') {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('Notice: BPS Query String Exploits Code Changes', 'bulletproof-security').'</font><br>'.__('Older BPS Query String Exploits code was found in BPS Custom Code.', 'bulletproof-security').'<br>'.__('Copy the new Query String Exploits section of code from your root .htaccess file and paste it into this BPS Custom Code text box: CUSTOM CODE BPSQSE BPS QUERY STRING EXPLOITS and click the Save Root Custom Code button.', 'bulletproof-security').'<br>'.__('This Notice will go away once you have copied the new Query String Exploits code to BPS Custom Code and clicked the Save Root Custom Code button.', 'bulletproof-security').'</div>';
			echo $text;
		}
	}
}

// Heads Up Display - Check if W3TC is active or not and check root htaccess file for W3TC htaccess code 
function bps_w3tc_htaccess_check($plugin_var) {
$options = get_option('bulletproof_security_options_monitor');	
	
	if ( $options['bps_HUD_alerts'] == 'Off' ) {
		return;
	}
	
	$plugin_var = 'w3-total-cache/w3-total-cache.php';
    $return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var == 1 || is_plugin_active_for_network( 'w3-total-cache/w3-total-cache.php' )) { // checks if W3TC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}

		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);	

		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( ! strpos( $string, "W3TC" ) ) {
				if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
					$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('W3 Total Cache is activated, but W3TC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('W3TC needs to be redeployed by clicking either the W3TC auto-install or deploy buttons. Your Root htaccess file must be temporarily unlocked so that W3TC can write to your Root htaccess file. Click to ', 'bulletproof-security').'<a href="admin.php?page=w3tc_general">'.__('Redeploy W3TC.', 'bulletproof-security').'</a><br>'.__('Turn Off AutoRestore before Redeploying W3TC. After Redeploying W3TC go to AutoRestore and click the 4 Backup Files buttons and then turn AutoRestore back On again. You can copy W3TC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy W3TC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
					echo $text;
				} 
				elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) {
					$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('W3 Total Cache is activated, but W3TC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('W3TC needs to be redeployed by clicking either the W3TC auto-install or deploy buttons. Your Root htaccess file must be temporarily unlocked so that W3TC can write to your Root htaccess file. Click to ', 'bulletproof-security').'<a href="admin.php?page=w3tc_general">'.__('Redeploy W3TC.', 'bulletproof-security').'</a><br>'.__('Turn Off AutoRestore before Redeploying W3TC. After Redeploying W3TC go to AutoRestore and click the 4 Backup Files buttons and then turn AutoRestore back On again. You can copy W3TC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy W3TC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
					echo $text;
				}
			}
		}
	}
	elseif ( $return_var != 1 || ! is_plugin_active_for_network( 'w3-total-cache/w3-total-cache.php' )) { // checks if W3TC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}

		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);			
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( strpos( $string, "W3TC" ) ) {
				if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
					$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('W3 Total Cache is deactivated and W3TC .htaccess code was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate W3TC. If you are planning on uninstalling W3TC the W3TC htaccess code will be automatically removed from your root htaccess file when you uninstall W3TC. Your Root htaccess file must be temporarily unlocked so that W3TC can remove the W3TC Root htaccess code. If you manually edit your root htaccess file then refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'</div>';
					echo $text;
				}
				elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) {
					$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('W3 Total Cache is deactivated and W3TC htaccess code was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate W3TC. If you are planning on uninstalling W3TC the W3TC htaccess code will be automatically removed from your root htaccess file when you uninstall W3TC. Your Root htaccess file must be temporarily unlocked so that W3TC can remove the W3TC Root htaccess code. If you manually edit your root htaccess file then refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'</div>';
					echo $text;
				}
			} 
		}
	}
}

// Heads Up Display - Check if WPSC is active or not and check root htaccess file for WPSC htaccess code 
function bps_wpsc_htaccess_check($plugin_var) {
$options = get_option('bulletproof_security_options_monitor');	
	
	if ( $options['bps_HUD_alerts'] == 'Off' ) { 
		return;
	}
	
	$plugin_var = 'wp-super-cache/wp-cache.php';
    $return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var == 1 || is_plugin_active_for_network( 'wp-super-cache/wp-cache.php' ) ) { // checks if WPSC is active for Single site or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}
		
		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);		
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( ! strpos($string, "WPSuperCache" ) ) { 
				if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
					$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WP Super Cache is activated, but either you are not using WPSC mod_rewrite to serve cache files or the WPSC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If you are not using WPSC mod_rewrite then copy this: # WPSuperCache to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'<br>'.__('If you are using WPSC mod_rewrite and the WPSC htaccess code is not in your root htaccess file then unlock your Root htaccess file temporarily then click this ', 'bulletproof-security').'<a href="options-general.php?page=wpsupercache&tab=settings">'.__('Update WPSC link', 'bulletproof-security').'</a>'.__(' to go to the WPSC Settings page and click the Update Mod_Rewrite Rules button.', 'bulletproof-security').'<br>'.__('If you have put your site in Default Mode then disregard this Alert and DO NOT update your Mod_Rewrite Rules. Refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'<br>'.__('Turn Off AutoRestore before you click the WPSC Update Mod_Rewrite Rules button. After updating WPSC go to AutoRestore and click the 4 Backup Files buttons and then turn AutoRestore back On again. You can copy WPSC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy WPSC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
					echo $text;
				} 
				elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) {
					$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WP Super Cache is activated, but either you are not using WPSC mod_rewrite to serve cache files or the WPSC htaccess code was NOT found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If you are not using WPSC mod_rewrite then copy this: # WPSuperCache to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'<br>'.__('If you are using WPSC mod_rewrite and the WPSC htaccess code is not in your root htaccess file then unlock your Root htaccess file temporarily then click this ', 'bulletproof-security').'<a href="options-general.php?page=wpsupercache&tab=settings">'.__('Update WPSC link', 'bulletproof-security').'</a>'.__(' to go to the WPSC Settings page and click the Update Mod_Rewrite Rules button.', 'bulletproof-security').'<br>'.__('If you have put your site in Default Mode then disregard this Alert and DO NOT update your Mod_Rewrite Rules. Refresh your browser to perform a new htaccess file check.', 'bulletproof-security').'<br>'.__('Turn Off AutoRestore before you click the WPSC Update Mod_Rewrite Rules button. After updating WPSC go to AutoRestore and click the 4 Backup Files buttons and then turn AutoRestore back On again. You can copy WPSC .htaccess code from your Root .htaccess file to BPS Custom Code to save it permanently so that you will not have to do these steps in the future.', 'bulletproof-security').'<br>'.__('Copy WPSC .htaccess code to this BPS Custom Code text box: CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE, click the Save Root Custom Code button, go to the BPS Security Modes page, click the Create secure.htaccess File AutoMagic button and activate Root folder BulletProof Mode again.', 'bulletproof-security').'</div>';
					echo $text;
				}
			}
		}
	}
	elseif ( $return_var != 1 || ! is_plugin_active_for_network( 'wp-super-cache/wp-cache.php' )) { // checks if WPSC is NOT active for Single or Network
		
		if ( ! is_multisite() ) {
			$bpsSiteUrl = get_option('siteurl');
			$bpsHomeUrl = get_option('home');
		} else {
			$bpsSiteUrl = get_site_option('siteurl');
			$bpsHomeUrl = network_site_url();		
		}
		
		$filename = ABSPATH . '.htaccess';
		$string = file_get_contents($filename);				
		
		if ( $bpsSiteUrl == $bpsHomeUrl ) {
			if ( strpos($string, "WPSuperCache" ) ) {
				if ( $options['bps_HUD_alerts'] == 'bpsOn' ) {
					$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('WP Super Cache is deactivated and WPSC htaccess code - # BEGIN WPSuperCache # END WPSuperCache - was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate WPSC. You will need to set up and reconfigure WPSC again when you reactivate WPSC. Your Root htaccess file must be temporarily unlocked if you are planning on uninstalling WPSC. The WPSC htaccess code will be automatically removed from your root htaccess file when you uninstall WPSC. If you added a commented out line of code in anywhere in your root htaccess file - # WPSuperCache - then delete it and refresh your browser. If you added WPSC code to BPS Custom Code then delete it if you are removing WPSC permanently.', 'bulletproof-security').'</div>';
					echo $text;
				}
				elseif ( $options['bps_HUD_alerts'] == 'wpOn' ) {
					$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WP Super Cache is deactivated and WPSC htaccess code - # BEGIN WPSuperCache # END WPSuperCache - was found in your root htaccess file.', 'bulletproof-security').'</font><br>'.__('If this is just temporary then this warning message will go away when you reactivate WPSC. You will need to set up and reconfigure WPSC again when you reactivate WPSC. Your Root htaccess file must be temporarily unlocked if you are planning on uninstalling WPSC. The WPSC htaccess code will be automatically removed from your root htaccess file when you uninstall WPSC. If you added a commented out line of code in anywhere in your root htaccess file - # WPSuperCache - then delete it and refresh your browser. If you added WPSC code to BPS Custom Code then delete it if you are removing WPSC permanently.', 'bulletproof-security').'</div>';
					echo $text;
				}
			} 
		}
	}
}

// Heads Up display: checks the uploads folder for an index.php file
// checks the plugins folder index.php file for code injections
function bpsPro_hud_index_files_check() {
	
	$plugins_index_file = WP_PLUGIN_DIR . '/index.php';
	$plugins_index_pattern = '/[$=\';]/';
	$check_string = @file_get_contents($plugins_index_file);

	if ( preg_match( $plugins_index_pattern, $check_string, $matches ) ) {
	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Possible Code Injection in the /plugins/index.php file', 'bulletproof-security').'</font><br>'.__('Additional code was found in your /plugins/index.php file that should not be there.', 'bulletproof-security').'<br>'.__('Download the /plugins/index.php file and send the index.php file to info@ait-pro.com so that we can take a look at it.', 'bulletproof-security').'</div>';
		echo $text;
	}

	$bps_Uploads_Dir = wp_upload_dir();	
	$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/index.php'; // for both single and Multisite is the standard /uploads folder

	if ( file_exists($UploadsHtaccess) ) {
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('Possible Hacker File: /uploads/index.php file', 'bulletproof-security').'</font><br>'.__('An index.php file was found in your /uploads/ folder that should not be there.', 'bulletproof-security').'<br>'.__('Download the /uploads/index.php file and send the index.php file to info@ait-pro.com so that we can take a look at it.', 'bulletproof-security').'</div>';
		echo $text;
	}
}


?>