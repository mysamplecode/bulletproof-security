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
if ( !function_exists('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}
 
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
?>

<div class="wrap">

<?php
// S-Monitor HUD - Heads Up Display - Warnings and Error messages - displayed in BPS Only
echo bps_HUD_bps_only();

// S-Monitor BPS Security Status for Root and wp-admin (wp-admin only if problem) - displayed in BPS Only
echo bps_security_status_bps_only();
echo bps_security_status_wpadmin_bps_only();

// S-Monitor & AutoRestore Status display - displayed in BPS Only 
echo bps_ARCM_admin_notice_status_bps();

// S-Monitor - DB Monitor Status display - BPS pages ONLY
echo bps_DBM_admin_notice_status_bps();

// S-Monitor - DB Backup Status display - BPS pages ONLY
echo bps_DBB_admin_notice_status_bps();

// S-Monitor - Plugin Firewall Status display - BPS pages ONLY
echo bps_PFWAP_admin_notice_status_bps();

// S-Monitor - Uploads Anti-Exploit Guard Status display - BPS pages ONLY
echo bps_UAEG_admin_notice_status_bps();

// S-Monitor - Login Security Status display - BPS pages ONLY
echo bps_Login_Security_admin_notice_status_bps();

// S-Monitor - JTC Anti-Spam Status display - BPS pages ONLY
echo bps_jtc_antispam_admin_notice_status_bps();

// S-Monitor - Login Security Alerts - BPS pages ONLY
echo bps_smonitor_LoginSecurityResetModTimeDiff_bps();

// S-Monitor PHP Error Log - New PHP Errors - displayed in BPS Only
echo bps_smonitor_ELogModTimeDiff_bps();

// S-Monitor Security Log - New Log Entry Has Been Logged - displayed in BPS Only
echo bps_smonitor_SecurityLogModTimeDiff_bps();

// S-Monitor - PHP Error Log Set & valid path, ini_set Options Checks & auto-update wp-config.php - BPS pages ONLY
echo bps_smonitor_phpini_bps();

// S-Monitor F-Lock - Check if F-Lock options saved - F-Lock Lock / Unlock File Status & actual file permissions 404 or 400
echo bps_smonitor_flock_bps();

?>

<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#000;">

<?php
// Obsolete file cleanup / deletion
//echo bpsRemoveObs();

// Manually runs real-time BPS Pro version update check - for testing ONLY
// echo bpsPro_update_checks();
// Manually runs PHP Error Log cron function - for testing ONLY
// echo bps_smonitor_ELogModTimeDiff_wp_email();

// General all purpose "Settings Saved." message for forms - /includes/class.php
if ( current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
if ( @$_GET['settings-updated'] == true ) {
	$text = '<p style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:5px;margin:0px;"><font color="green"><strong>'.__('Settings Saved', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	} else {
	echo '<font color="red"><strong>'.bps_cuser_errors().'</strong></font>';
	}
}
?>

</div>

<?php
// Simple email test for the PHP mail()
function bpsEmailTest() {
	if ( isset( $_POST['bpsEmailTestSubmit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_email_test' );	  

	if ( ! class_exists( 'WP_Http' ) )
	  include_once( ABSPATH . WPINC. '/class-http.php' );

$request = new WP_Http;
$url = plugins_url('/bulletproof-security/admin/test/bps-email-check.php');
$response = $request->request( $url, array( 'method' => 'POST', 'header' => $header, 'body' => $body ) );

	if ( is_wp_error( $response ) ) {
		_e('Unable to connect to ',  'bulletproof-security'); echo $url;
	
	} else {

$admin_email = get_option('admin_email');
$bps_email = $_POST['bpsEmail'];
$justUrl = get_site_url();
$mail_To = "$bps_email";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: $bps_email";
$mail_Subject = " BPS Pro Email Test ";

$mail_message = '<p>Email Test for the PHP mail() function: </p>';
$mail_message .= '<p>Site: '."$justUrl".'</p>'; 

$bpsString = print_r($response, TRUE);
//echo $bpsString; //for testing
$mail_message .= '<pre>'."$bpsString".'</pre>';

	mail($mail_To, $mail_Subject, $mail_message, $headers);
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Test Email Sent to ', 'bulletproof-security').$bps_email.__(' Please wait at least 15 minutes to receive the test email.', 'bulletproof-security').'</p></div>';
		echo $text;
	}
	}
}

// Reset/Recheck Dismiss Notices
function bpsDeleteUserMetaDismiss() {
	if ( isset( $_POST['bpsResetDismissSubmit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_reset_dismiss_notices' );	  

	global $current_user;
	$user_id = $current_user->ID;

/*
	if ( !delete_user_meta($user_id, 'bps_ignore_new_feature_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The BPS Pro 9.0 Major Version Release New Feature Notification Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The BPS Pro 9.0 Major Version Release New Feature Notification is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}
*/

	if ( !delete_user_meta($user_id, 'bps_ignore_iis_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Windows IIS Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Windows IIS check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_ignore_public_username_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The username/user account Public Display Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The username/user account Public Display check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}
	
	if ( !delete_user_meta($user_id, 'bps_ignore_PFW_roles_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Plugin Firewall Additional Roles IP Whitelist Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Plugin Firewall Additional Roles IP Whitelist check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	
	
	if ( !delete_user_meta($user_id, 'bps_ignore_sucuri_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Sucuri 1-click Hardening wp-content .htaccess file Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Sucuri 1-click Hardening wp-content .htaccess file check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	

	if ( !delete_user_meta($user_id, 'bps_ignore_wpfirewall2_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The WordPress Firewall 2 Plugin Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The WordPress Firewall 2 Plugin check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	

	if ( !delete_user_meta($user_id, 'bps_ignore_BLC_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Broken Link Checker plugin HEAD Request Method filter Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Broken Link Checker plugin HEAD Request Method filter check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	

	if ( !delete_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The PHP|php.ini handler htaccess code check Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The PHP|php.ini handler htaccess code check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	

	if ( !delete_user_meta($user_id, 'bps_ignore_Permalinks_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Custom Permalinks HUD Check Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Custom Permalinks HUD Check is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}	

	if ( !delete_user_meta($user_id, 'bps_ignore_JTC_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The JTC Anti-Spam Feature Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The JTC Anti-Spam Feature Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_ignore_PFW_litespeed_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The LiteSpeed Server|Plugin Firewall Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The LiteSpeed Server|Plugin Firewall Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_brute_force_login_protection_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: Brute Force Login Protection Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: Brute Force Login Protection Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_speed_boost_cache_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: Speed Boost Cache Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: Speed Boost Cache Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_author_enumeration_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: Author Enumeration BOT Probe Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: Author Enumeration BOT Probe Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_xmlrpc_ddos_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: XML-RPC DDoS Protection Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: XML-RPC DDoS Protection Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_referer_spam_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: Referer Spam|Phishing Protection Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: Referer Spam|Phishing Protection Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_sniff_driveby_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: Mime Sniffing|Drive-by Download Attack Protection Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: Mime Sniffing|Drive-by Download Attack Protection Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}

	if ( !delete_user_meta($user_id, 'bps_iframe_clickjack_notice') ) {
		$text = '<div id="message" class="updated fade" style="color:#000000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('The Bonus Custom Code: External iFrame|Clickjacking Protection Code Dismiss Notice is NOT set. Nothing to reset.', 'bulletproof-security').'</p></div>';
		echo $text;
	} else {
		$text = '<div id="message" class="updated fade" style="color:#008000; font-weight:bold; border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.__('Success! The Bonus Custom Code: External iFrame|Clickjacking Protection Code Notice is reset.', 'bulletproof-security').'</p><div class="bps-message-button" style="width:90px;margin-bottom:9px;"><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div></div>';
		echo $text;
	}
	}
}

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?> 

<h2 style="margin-left:220px;"><?php _e('S-Monitor ~ Security Monitoring and Alerting', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('Options', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">

<h2><?php _e('Monitoring and Alerting Options', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Monitoring and Alerting Options', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
   
   <div id="bps-modal-content1" title="<?php _e('Monitoring and Alerting Options', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Dashboard Status Display', 'bulletproof-security').'</strong><br>'.__('The Heads Up Dashboard Status Display displays at the top of all WordPress pages by default and displays the current BPS Pro version installed & clickable links to pages: Root Folder BulletProof Mode (RBM), wp-admin Folder BulletProof Mode (WBM), AutoRestore (ARQ), Database Monitor (DBM), Database Backup (DBB), Plugin Firewall (PFW), Uploads Anti-Exploit Guard (UAEG), Login Security & Monitoring (LSM) and JTC Anti-Spam|Anti-Hacker (JTC). It is recommended that you choose Display Status in WP Dashboard for all of these mission critical BPS Pro security features.', 'bulletproof-security').'<br><br><strong>'.__('Dashboard Status Display Functionality', 'bulletproof-security').'</strong><br>'.__('The Dashboard Status Display performs checks and displays the status of BPS Pro features, options and your site security in real-time. The Dashboard Status Display automatically turns itself off when a Form is submitted using POST and displays a Reload BPS Pro Status Display button. Automatically turning off the Status Display during Form processing is a performance enhancement|optimization. Clicking the Reload BPS Pro Status Display button reloads|displays the Dashboard Status Display.', 'bulletproof-security').'<br><br><strong>'.__('Reset|Recheck Dismiss Notices:', 'bulletproof-security').'</strong><br>'.__('Clicking this button resets ALL Dismiss Notices such as Bonus Code Dismiss Notices and ALL other Dismiss Notices. If you previously dismissed a Dismiss Notice and want to display it again at a later time click this button.', 'bulletproof-security').'<br><br><strong>'.__('Security Status: BPS Pro Version, RBM, WBM & Alerts', 'bulletproof-security').'</strong><br>'.__('Displays the currently installed BPS Pro version, RBM, WBM & more importantly critical security alerts in your WP Dashboard. It is recommended that you choose: Display Status & Alerts in WP Dashboard. RBM stands for Root BulletProof Mode & displays On or Off, WBM stands for wp-admin BulletProof Mode & displays On or Off.', 'bulletproof-security').'<br><br><strong>'.__('Security Log: New Log Entry Has Been Logged Alerts', 'bulletproof-security').'</strong><br>'.__('When new Security Log entries are logged in your Security Log file you are alerted by BPS that you have a new log entry. You can choose to have Security Log Alerts displayed in your WP Dashboard, in BPS pages Only or turn Alerts Off. You can also choose to have Security Log Alerts and log files emailed to you with Email Alerting & Log File Options. The Security Log Alert contains a link to the B-Core Security Log page. Security Log Alerts can be turned On or Off as needed. The Security Log is a primary troubleshooting tool in BPS Pro, but Security Log alerts will occur all day, every day and can be irritating.', 'bulletproof-security').'<br><br><strong>'.__('AutoRestore|Quarantine: ARQ Status', 'bulletproof-security').'</strong><br>'.__('The ARQ Status Display displays whether AutoRestore is On or Off, the ARQ Cron Frequency & the time the next ARQ Cron job will be run. Display options: in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the ARQ Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Database Monitor: DBM Status', 'bulletproof-security').'</strong><br>'.__('The DBM Status Display displays whether the Database Monitor is On or Off, the DBM Cron Frequency & the time the next DBM Cron job will be run. Display options: in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the DBM Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Database Monitor: DBM Alerts', 'bulletproof-security').'</strong><br>'.__('The DB Monitor alerts you via email anytime a change/modification occurs in your WordPress database or a new database table is created in your WordPress database based on your DBM Email Alerting & Log file options for DBM. Your DB Monitor Log also logs any changes/modifications to your WordPress database and other relevant help info. You can choose to have DBM Alerts displayed in your WP Dashboard, in BPS pages Only or turn Alerts Off.', 'bulletproof-security').'<br><br><strong>'.__('Database Backup: DBB Status', 'bulletproof-security').'</strong><br>'.__('The DBB Status Display displays either No DB Backups, Backup Job Created or the last successful Database Backup timestamp. Display options: Last Backup time in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the DBB Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Plugin Firewall: Firewall Status', 'bulletproof-security').'</strong><br>'.__('Displays On or Off status of the Plugin Firewall in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the PFW Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Uploads Anti-Exploit Guard: UAEG Status', 'bulletproof-security').'</strong><br>'.__('Displays On or Off status of UAEG in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the UAEG Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Login Security: Login Security Status', 'bulletproof-security').'</strong><br>'.__('Displays On or Off status of Login Security in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the LSM Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('Login Security: Login Security Alerts', 'bulletproof-security').'</strong><br>'.__('Displays Login Security Alerts in your WP Dashboard, BPS Pages Only or turn this status display Off. Choosing Turn Off Displayed Alerts turns Off Login Security Alerts. You can choose email alerting options instead if you do not want to see the WP Dashboard or BPS Pages Only Alerts.', 'bulletproof-security').'<br><br><strong>'.__('JTC Anti-Spam|Anti-Hacker: JTC Status', 'bulletproof-security').'</strong><br>'.__('Displays On or Off status of JTC Anti-Spam|Anti-Hacker in your WP Dashboard, BPS Pages Only or turn this status display Off. It is recommended that you choose to display the JTC Status in your WP Dashboard.', 'bulletproof-security').'<br><br><strong>'.__('F-Lock: File Lock|Unlock Alerts', 'bulletproof-security').'</strong><br>'.__('Checks file permissions for Mission Critical files in real time. If your Host Server is using CGI as the php handler and if your Server API is CGI displayed properly then this check works perfectly to determine your file permissions locked or unlocked status. If your Host is using DSO mod_php you may see error messages that the files are not locked depending on how your Host Servers are configured. If your Host Server is definitely using DSO mod_php then you can turn this S-monitor option off. DSO file permissions should be 644 and cannot be set more restrictive because of the way DSO works. File permissions for CGI and DSO are managed on the F-Lock page.', 'bulletproof-security').'<br><br><strong>'.__('HUD Alerts: BPS Error, Problem and Warning Alerts', 'bulletproof-security').'</strong><br>'.__('Heads Up Display - HUD Alerts are important and it is recommended that you choose to display these Alerts in your WordPress Dashboard. HUD Alerts will alert you to any serious problems with BPS or any other problem or issues that need to be corrected right away.', 'bulletproof-security').'<br><br><strong>'.__('PHP Error Log: Check if Folder Location Has Been Set & Correct', 'bulletproof-security').'</strong><br>'.__('Checks if your php error log file path has been set and that the path is correct. A php error log is a good thing to have in general to check for website problems and it is important in website security monitoring as well.', 'bulletproof-security').'<br><br><strong>'.__('PHP Error Log: New Errors in The PHP Error Log Alerts', 'bulletproof-security').'</strong><br>'.__('When new PHP errors occur on your website they are logged in your PHP Error Log and you are alerted by BPS that you have a new PHP error in your error log. You can choose to have PHP Error Log Alerts displayed in your WP Dashboard, in BPS pages Only or turn Alerts Off. You can also choose to have PHP Error Log Alerts and log files emailed to you with Email Alerting & Log File Options. The PHP Error Log Alert contains a link to the P-Security PHP Error Log page.', 'bulletproof-security').'<br><br><strong>'.__('Php.ini|ini_set: Error Checks & Alerts', 'bulletproof-security').'</strong><br>'.__('Various checks for possible issues or problems with php.ini files, ini_set options, Loaded Configuration file checks, PHP error log Set To Location matches the error log path seen by the Server, etc. For additional Status checking of individual directives see the Php.ini Security Status page. NOTE: As of PHP5.3.x adding a custom php.ini file for your website has become very complicated and problematic. It is recommended that you use the ini_set Options as an alternative to creating a custom php.ini file for your website if your PHP version is 5.3.x or greater.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<div id="ResetDismissNotices">
<form name="bpsResetDismissNotices" action="admin.php?page=bulletproof-security/admin/monitor/monitor.php" method="post">
<?php wp_nonce_field('bulletproof_security_reset_dismiss_notices'); ?>
    <h3><?php _e('Reset|Recheck Dismiss Notices: ', 'bulletproof-security'); ?>
<input type="hidden" name="bpsRDN" value="bps-RDN" />
<input type="submit" name="bpsResetDismissSubmit" class="button bps-button" style="margin-top:-5px;" value="<?php esc_attr_e('Reset|Recheck', 'bulletproof-security') ?>" />
</h3>
<?php echo bpsDeleteUserMetaDismiss(); ?>
</form>
</div>
    
    <form name="bps-monitor-options" action="options.php" method="post">
<?php settings_fields('bulletproof_security_options_monitor'); ?>
<?php $options = get_option('bulletproof_security_options_monitor'); ?>
<strong><label for="bps-monitor-options"><?php _e('Security Status: BPS Pro Version, RBM, WBM & Alerts', 'bulletproof-security'); ?></label></strong><br />       
<select name="bulletproof_security_options_monitor[bps_security_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_security_status']); ?>><?php _e('Display Status & Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_security_status']); ?>><?php _e('Display Status & Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_security_status']); ?>><?php _e('Turn Off Displayed Status & Alerts', 'bulletproof-security'); ?></option>
        </select>        
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Security Log: New Log Entry Has Been Logged Alerts', 'bulletproof-security'); ?></label></strong><br />       
<select name="bulletproof_security_options_monitor[bps_SecLog_entry]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_SecLog_entry']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_SecLog_entry']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_SecLog_entry']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>        
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('AutoRestore|Quarantine: ARQ Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_autorestore_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_autorestore_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_autorestore_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_autorestore_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Database Monitor: DBM Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_dbm_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_dbm_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_dbm_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_dbm_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Database Monitor: DBM Alerts', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_dbm_alerts]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_dbm_alerts']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_dbm_alerts']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_dbm_alerts']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Database Backup: DBB Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_dbb_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_dbb_status']); ?>><?php _e('Display Last Backup Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_dbb_status']); ?>><?php _e('Display Last Backup Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_dbb_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Plugin Firewall: Firewall Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_plugin_firewall_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_plugin_firewall_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_plugin_firewall_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_plugin_firewall_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Uploads Anti-Exploit Guard: UAEG Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_UAEG_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_UAEG_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_UAEG_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_UAEG_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Login Security: Login Security Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_login_security_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_login_security_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_login_security_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_login_security_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Login Security: Login Security Alerts', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_login_security_alerts]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_login_security_alerts']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_login_security_alerts']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_login_security_alerts']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('JTC Anti-Spam|Anti-Hacker: JTC Status', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_jtc_antispam_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_jtc_antispam_status']); ?>><?php _e('Display Status in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_jtc_antispam_status']); ?>><?php _e('Display Status in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_jtc_antispam_status']); ?>><?php _e('Turn Off Displayed Status', 'bulletproof-security'); ?></option>
        </select>  
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('F-Lock: File Lock|Unlock Alerts', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_flock_status]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', @$options['bps_flock_status']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', @$options['bps_flock_status']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', @$options['bps_flock_status']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('HUD Alerts: BPS Error, Problem and Warning Alerts', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_HUD_alerts]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_HUD_alerts']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_HUD_alerts']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_HUD_alerts']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('PHP Error Log: Check if Folder Location Has Been Set & Correct', 'bulletproof-security'); ?></label></strong><br />    
<select name="bulletproof_security_options_monitor[bps_PHP_ELogLoc_set]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_PHP_ELogLoc_set']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_PHP_ELogLoc_set']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_PHP_ELogLoc_set']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('PHP Error Log: New Errors in The PHP Error Log Alerts', 'bulletproof-security'); ?></label></strong><br />    
<select name="bulletproof_security_options_monitor[bps_PHP_ELog_error]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_PHP_ELog_error']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_PHP_ELog_error']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_PHP_ELog_error']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>        
<br /><br />
<strong><label for="bps-monitor-options"><?php _e('Php.ini|ini_set: Error Checks & Alerts', 'bulletproof-security'); ?></label></strong><br />  
<select name="bulletproof_security_options_monitor[bps_phpini_created]" style="width:340px;">
<option value="wpOn"<?php selected('wpOn', $options['bps_phpini_created']); ?>><?php _e('Display Alerts in WP Dashboard', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_phpini_created']); ?>><?php _e('Display Alerts in BPS Only', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_phpini_created']); ?>><?php _e('Turn Off Displayed Alerts', 'bulletproof-security'); ?></option>
        </select>
<p class="submit">
<input type="submit" name="bps-monitor-values_submit" class="button bps-button" value="<?php esc_attr_e('Save Options', 'bulletproof-security') ?>" />
</p>
<!-- form option is obsolete but the option itself is still used - defaults to Off -->
<label style="visibility:hidden;" for="bps-monitor-options"><?php _e('First Install|Launch S-Monitor Notification (Static Alert)', 'bulletproof-security'); ?></label>
<select name="bulletproof_security_options_monitor[bps_first_launch]" style="width:340px; visibility:hidden;">
<option value="Off"<?php selected('Off', $options['bps_first_launch']); ?>><?php _e('Turn Off Static Displayed Alert (For Testing)', 'bulletproof-security'); ?></option>
<option value="wpOn"<?php selected('wpOn', $options['bps_first_launch']); ?>><?php _e('Display Static Alert in WP Dashboard (For Testing)', 'bulletproof-security'); ?></option>
<option value="bpsOn"<?php selected('bpsOn', $options['bps_first_launch']); ?>><?php _e('Display Static Alert in BPS Only (For Testing)', 'bulletproof-security'); ?></option>
</select>
</form>
	</td>
    <td width="50%" valign="top" class="bps-table_cell_help">

<h3 style="margin:0px 0px 15px 0px;"><?php _e('Email Alerting & Log File Options', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content2" title="<?php _e('Email Alerting & Log File Options', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('The Email Alerting & Log File options work independently of the S-Monitor Monitoring and Alerting Options for displayed Status & Alerts.', 'bulletproof-security').'</strong><br><br>'.__('The email address fields To, From, Cc and Bcc can be email addresses for your hosting account, your WordPress Administrator email address or 3rd party email addresses like gmail or yahoo email. If you are sending emails to multiple email recipients then separate the email addresses with a comma. Example: someone@somewhere.com, someoneelse@somewhereelse.com. You can add a space or not add a space after the comma between email addresses.', 'bulletproof-security').'<br><br><strong>'.__('Login Security: Send Email Alerts When...', 'bulletproof-security').'</strong><br>'.__('There are 5 different email options. Choose to have email alerts sent when a User Account is locked out, An Administrator Logs in, An Administrator Logs in and when a User Account is locked out, Any User logs in and when a User Account is locked out or Do Not Send Email Alerts.', 'bulletproof-security').'<br><br>'.__('The email alerts contain the action that occurred with Timestamp and these fields: Username, Status, Role, Email, Lockout Time, Lockout Time Expires, User IP Address, User Hostname, Request URI and URL link for the website where the action occurred.', 'bulletproof-security').'<br><br><strong>'.__('DBM: When A Database Change|Modification Occurs...', 'bulletproof-security').'</strong><br>'.__('Choose whether or not to have email alerts sent when the Database Monitor has detected a change/modification to any of your database tables.', 'bulletproof-security').'<br><br><strong>'.__('DB Monitor Email|Delete Log File:', 'bulletproof-security').'</strong><br>'.__('Select the maximum Log File size that you want to allow for your DB Monitor Log File and then select the option that you want when your log file reaches that maximum size. Choose to either automatically Email the Log file to you and delete it or just delete it without emailing the log file to you first.', 'bulletproof-security').'<br><br><strong>'.__('ARQ: When A File Has Been AutoRestored|Quarantined', 'bulletproof-security').'</strong><br>'.__('Choose whether or not to have email alerts sent when a file has been AutoRestored or Quarantined.', 'bulletproof-security').'<br><br><strong>'.__('AutoRestore|Quarantine Email|Delete Log File:', 'bulletproof-security').'</strong><br>'.__('Select the maximum Log File size that you want to allow for your Quarantine Log File and then select the option that you want when your log file reaches that maximum size. Choose to either automatically Email the Log file to you and delete it or just delete it without emailing the log file to you first.', 'bulletproof-security').'<br><br><strong>'.__('Security Log: New Log Entry Has Been Logged', 'bulletproof-security').'</strong><br>'.__('Choose whether or not to have email alerts sent when a new security entry has been logged in your Security Log file.', 'bulletproof-security').'<br><br><strong>'.__('Security Log File Email|Delete Log File:', 'bulletproof-security').'</strong><br>'.__('Select the maximum Log File size that you want to allow for your Security Log File and then select the option that you want when your log file reaches that maximum size. Choose to either automatically Email the Log file to you and delete it or just delete it without emailing the log file to you first.', 'bulletproof-security').'<br><br><strong>'.__('PHP Error Log: New Errors in The PHP Error Log', 'bulletproof-security').'</strong><br>'.__('Choose whether or not to have email alerts sent when a new PHP Error has been logged in your PHP Error Log file.', 'bulletproof-security').'<br><br><strong>'.__('PHP Error Log File Email|Delete Log File:', 'bulletproof-security').'</strong><br>'.__('Select the maximum Log File size that you want to allow for your PHP Error Log File and then select the option that you want when your log file reaches that maximum size. Choose to either automatically Email the Log file to you and delete it or just delete it without emailing the log file to you first.', 'bulletproof-security').'<br><br><strong>'.__('DB Backup Log File Email|Delete Log File:', 'bulletproof-security').'</strong><br>'.__('Select the maximum Log File size that you want to allow for your DB Backup Log File and then select the option that you want when your log file reaches that maximum size. Choose to either automatically Email the Log file to you and delete it or just delete it without emailing the log file to you first.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Upgrade Notification', 'bulletproof-security').'</strong><br>'.__('Choose whether or not to have email alerts sent when a new version of BPS Pro is available. BPS Pro upgrade notifications are displayed just like any other plugin upgrade notification in your WP Dashboard. You can also manually check for a BPS Pro upgrade on the WordPress Plugins page by clicking the BulletProof Security Pro Manual Upgrade Check link. NOTE: If you are not receiving upgrade notifications then try adding a From email address. If you are still not receiving email notifications then your Host is blocking the BPS Pro version upgrade check so you will not receive upgrade notification emails.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

    <h3 style="margin:0px 0px 20px 0px;"><?php _e('Simple Email Test for the PHP mail() Function', 'bulletproof-security'); ?>  <button id="bps-open-modal3" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content3" title="<?php _e('Simple Email Test', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Simple Email Test to check the PHP mail() Function', 'bulletproof-security').'</strong><br>'.__('This Email Test is checking if your Server has the PHP mail() function enabled and set up as a default php mailer on your Server and that your default email settings are already working for the php mail() function.', 'bulletproof-security').'<br><br>'.__('Your WordPress Administrator email address from the WordPress Settings Panel in General Options is displayed in the ', 'bulletproof-security').'<strong>'.__('Send A Test Email', 'bulletproof-security').'</strong>'.__(' window. You can use this email address to send a test email or type in a a different email address and click the', 'bulletproof-security').' <strong>'.__('Send Test Email', 'bulletproof-security').'</strong> '.__('button. The email address can be another email address under your hosting account or a gmail, yahoo or other 3rd party email address. The Test Email could take up to 15 minutes to be received by you.', 'bulletproof-security').'<br><br><strong>'.__('Php.ini mail Directives Testing', 'bulletproof-security').'</strong><br>'.__('If you are testing to see if you need to add any mail directives settings in your php.ini file, send a test email and if you receive the BPS Test Email then you do not need to add any mail directives settings to your php.ini file. If you want to find out what your default mail() and php.ini settings are for handling mail on your server then use the BPS Phpinfo viewer to find and view those PHP Server configuration mail settings.', 'bulletproof-security').'<br><br><strong'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php $admin_email = get_option('admin_email'); ?>

<form name="bpsEmailTest" action="admin.php?page=bulletproof-security/admin/monitor/monitor.php" method="post">
<?php wp_nonce_field('bulletproof_security_email_test'); ?>
<strong><label for="bps-email-test"><?php _e('Send a Test Email To:', 'bulletproof-security'); ?> </label></strong><br />
<input name="bpsEmail" type="text" value="<?php echo $admin_email; ?>" class="regular-text" />
<input type="hidden" name="bpsET" value="bps-ET" />
<input type="submit" name="bpsEmailTestSubmit" class="button bps-button" style="margin:0px 0px 37px 0px;" value="<?php esc_attr_e('Send Test Email', 'bulletproof-security') ?>" />
<?php echo bpsEmailTest(); ?>
</form>

<form name="bpsEmailAlerts" action="options.php" method="post">
    <?php settings_fields('bulletproof_security_options_email'); ?>
	<?php $options = get_option('bulletproof_security_options_email'); ?>
<strong><label for="bps-monitor-email"><?php _e('Send Email Alerts & Log Files To:', 'bulletproof-security'); ?> </label></strong><br />
<input name="bulletproof_security_options_email[bps_send_email_to]" type="text" value="<?php echo $options['bps_send_email_to']; ?>" class="regular-text" /><br />
<strong><label for="bps-monitor-email"><?php _e('Send Email Alerts & Log Files From:', 'bulletproof-security'); ?> </label></strong><br />
<input name="bulletproof_security_options_email[bps_send_email_from]" type="text" value="<?php echo $options['bps_send_email_from']; ?>" class="regular-text" /><br />
<strong><label for="bps-monitor-email"><?php _e('Send Email Alerts & Log Files Cc:', 'bulletproof-security'); ?> </label></strong><br />
<input name="bulletproof_security_options_email[bps_send_email_cc]" type="text" value="<?php echo $options['bps_send_email_cc']; ?>" class="regular-text" /><br />
<strong><label for="bps-monitor-email"><?php _e('Send Email Alerts & Log Files Bcc:', 'bulletproof-security'); ?> </label></strong><br />
<input name="bulletproof_security_options_email[bps_send_email_bcc]" type="text" value="<?php echo $options['bps_send_email_bcc']; ?>" class="regular-text" /><br />
<input type="hidden" name="bpsEMA" value="bps-EMA" /><br />

<strong><label for="bps-monitor-email"><?php _e('Login Security: Send Email Alerts When...', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_login_security_email]" style="width:340px;">
<option value="lockoutOnly" <?php selected( $options['bps_login_security_email'], 'lockoutOnly'); ?>><?php _e('A User Account Is Locked Out', 'bulletproof-security'); ?></option>
<option value="adminLoginOnly" <?php selected( $options['bps_login_security_email'], 'adminLoginOnly'); ?>><?php _e('An Administrator Logs In', 'bulletproof-security'); ?></option>
<option value="adminLoginLock" <?php selected( $options['bps_login_security_email'], 'adminLoginLock'); ?>><?php _e('An Administrator Logs In & A User Account is Locked Out', 'bulletproof-security'); ?></option>
<option value="anyUserLoginLock" <?php selected( $options['bps_login_security_email'], 'anyUserLoginLock'); ?>><?php _e('Any User Logs In & A User Account is Locked Out', 'bulletproof-security'); ?></option>
<option value="no" <?php selected( $options['bps_login_security_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-monitor-email"><?php _e('DBM: When A Database Change|Modification Occurs...', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_dbm_email]" style="width:340px;">
<option value="yes" <?php selected( $options['bps_dbm_email'], 'yes'); ?>><?php _e('Send Email Alerts', 'bulletproof-security'); ?></option>
<option value="no" <?php selected( $options['bps_dbm_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email-log"><?php _e('DB Monitor Email|Delete Log File:', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_dbm_log_size]" style="width:80px;">
<option value="500KB" <?php selected( $options['bps_dbm_log_size'], '500KB' ); ?>><?php _e('500KB', 'bulletproof-security'); ?></option>
<option value="256KB" <?php selected( $options['bps_dbm_log_size'], '256KB'); ?>><?php _e('256KB', 'bulletproof-security'); ?></option>
<option value="1MB" <?php selected( $options['bps_dbm_log_size'], '1MB' ); ?>><?php _e('1MB', 'bulletproof-security'); ?></option>
</select>
<select name="bulletproof_security_options_email[bps_dbm_log_email]" style="width:255px;">
<option value="email" <?php selected( $options['bps_dbm_log_email'], 'email' ); ?>><?php _e('Email Log & Then Delete Log File', 'bulletproof-security'); ?></option>
<option value="delete" <?php selected( $options['bps_dbm_log_email'], 'delete' ); ?>><?php _e('Delete Log File', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-monitor-email"><?php _e('ARQ: When A File Has Been AutoRestored|Quarantined', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_autorestore_email]" style="width:340px;">
<option value="yes" <?php selected( $options['bps_autorestore_email'], 'yes'); ?>><?php _e('Send Email Alerts', 'bulletproof-security'); ?></option>
<option value="no" <?php selected( $options['bps_autorestore_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email-log"><?php _e('AutoRestore|Quarantine Email|Delete Log File:', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_arq_log_size]" style="width:80px;">
<option value="500KB" <?php selected( $options['bps_arq_log_size'], '500KB' ); ?>><?php _e('500KB', 'bulletproof-security'); ?></option>
<option value="256KB" <?php selected( $options['bps_arq_log_size'], '256KB'); ?>><?php _e('256KB', 'bulletproof-security'); ?></option>
<option value="1MB" <?php selected( $options['bps_arq_log_size'], '1MB' ); ?>><?php _e('1MB', 'bulletproof-security'); ?></option>
</select>
<select name="bulletproof_security_options_email[bps_arq_log_email]" style="width:255px;">
<option value="email" <?php selected( $options['bps_arq_log_email'], 'email' ); ?>><?php _e('Email Log & Then Delete Log File', 'bulletproof-security'); ?></option>
<option value="delete" <?php selected( $options['bps_arq_log_email'], 'delete' ); ?>><?php _e('Delete Log File', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email"><?php _e('Security Log: New Log Entry Has Been Logged', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_security_log_email]" style="width:340px;">
<option value="no" <?php selected( $options['bps_security_log_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
<option value="yes" <?php selected( $options['bps_security_log_email'], 'yes'); ?>><?php _e('Send Email Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email-log"><?php _e('Security Log File Email|Delete Log File:', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_security_log_size]" style="width:80px;">
<option value="500KB" <?php selected( $options['bps_security_log_size'], '500KB' ); ?>><?php _e('500KB', 'bulletproof-security'); ?></option>
<option value="256KB" <?php selected( $options['bps_security_log_size'], '256KB'); ?>><?php _e('256KB', 'bulletproof-security'); ?></option>
<option value="1MB" <?php selected( $options['bps_security_log_size'], '1MB' ); ?>><?php _e('1MB', 'bulletproof-security'); ?></option>
</select>
<select name="bulletproof_security_options_email[bps_security_log_emailL]" style="width:255px;">
<option value="email" <?php selected( $options['bps_security_log_emailL'], 'email' ); ?>><?php _e('Email Log & Then Delete Log File', 'bulletproof-security'); ?></option>
<option value="delete" <?php selected( $options['bps_security_log_emailL'], 'delete' ); ?>><?php _e('Delete Log File', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email"><?php _e('PHP Error Log: New Errors in The PHP Error Log', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_error_log_email]" style="width:340px;">
<option value="no" <?php selected( $options['bps_error_log_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
<option value="yes" <?php selected( $options['bps_error_log_email'], 'yes'); ?>><?php _e('Send Email Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email-log"><?php _e('PHP Error Log File Email|Delete Log File:', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_php_log_size]" style="width:80px;">
<option value="500KB" <?php selected( $options['bps_php_log_size'], '500KB' ); ?>><?php _e('500KB', 'bulletproof-security'); ?></option>
<option value="256KB" <?php selected( $options['bps_php_log_size'], '256KB'); ?>><?php _e('256KB', 'bulletproof-security'); ?></option>
<option value="1MB" <?php selected( $options['bps_php_log_size'], '1MB' ); ?>><?php _e('1MB', 'bulletproof-security'); ?></option>
</select>
<select name="bulletproof_security_options_email[bps_php_log_email]" style="width:255px;">
<option value="email" <?php selected( $options['bps_php_log_email'], 'email' ); ?>><?php _e('Email Log & Then Delete Log File', 'bulletproof-security'); ?></option>
<option value="delete" <?php selected( $options['bps_php_log_email'], 'delete' ); ?>><?php _e('Delete Log File', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email-log"><?php _e('DB Backup Log File Email|Delete Log File:', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_dbb_log_size]" style="width:80px;">
<option value="500KB" <?php selected( $options['bps_dbb_log_size'], '500KB' ); ?>><?php _e('500KB', 'bulletproof-security'); ?></option>
<option value="256KB" <?php selected( $options['bps_dbb_log_size'], '256KB'); ?>><?php _e('256KB', 'bulletproof-security'); ?></option>
<option value="1MB" <?php selected( $options['bps_dbb_log_size'], '1MB' ); ?>><?php _e('1MB', 'bulletproof-security'); ?></option>
</select>
<select name="bulletproof_security_options_email[bps_dbb_log_email]" style="width:255px;">
<option value="email" <?php selected( $options['bps_dbb_log_email'], 'email' ); ?>><?php _e('Email Log & Then Delete Log File', 'bulletproof-security'); ?></option>
<option value="delete" <?php selected( $options['bps_dbb_log_email'], 'delete' ); ?>><?php _e('Delete Log File', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-monitor-email"><?php _e('BPS Pro Upgrade Notification', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_email[bps_upgrade_email]" style="width:340px;">
<option value="yes" <?php selected( $options['bps_upgrade_email'], 'yes'); ?>><?php _e('Send Email Alerts', 'bulletproof-security'); ?></option>
<option value="no" <?php selected( $options['bps_upgrade_email'], 'no'); ?>><?php _e('Do Not Send Email Alerts', 'bulletproof-security'); ?></option>
</select>
<p class="submit">
<input type="submit" name="bpsEmailAlertSubmit" class="button bps-button" value="<?php esc_attr_e('Save Options', 'bulletproof-security') ?>" /></p>
</form>

</td>
  </tr>
  <tr>
    <td colspan="2" class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://www.ait-pro.com/aitpro-blog/2845/bulletproof-security-pro/bulletproof-security-pro-hover-tooltips/" target="_blank"><?php _e('Read Me Help Buttons Posted As Text For Language Translation', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links">&nbsp;</td>
    <td class="bps-table_cell_help_links">&nbsp;</td>
  </tr>
   <tr>
    <td colspan="2" class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>
        
<div id="AITpro-link">BulletProof Security Pro <?php echo BULLETPROOF_VERSION; ?> Plugin by <a href="http://forum.ait-pro.com/" target="_blank" title="AITpro Website Security">AITpro Website Security</a>
</div>
</div>
</div>
</div>