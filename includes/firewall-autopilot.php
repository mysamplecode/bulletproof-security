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


// Plugin Firewall Whitelist Rule checks - Automatically delete the /plugins/.htaccess file if invalid whitelist rules exist
// to prevent website problems until the whitelist rule(s) is corrected
function bpsPro_PFW_auto_delete() {

	if ( current_user_can('manage_options') ) {

		$options = get_option('bulletproof_security_options_pfirewall'); 
		$pattern1 = '/(\/(.*)\s{2}\/|\/(.*)\s{3}\/|\/(.*)\s{4}\/|\/(.*)\s{5}\/|\/(.*),\/|\n|\r)/';		
		$pattern2 = '/(\bver=\b|\bpage=\b|\bsrc=\b|\bwww\b|\bhttp\b|\bhttps\b|\bhref\b|\b\.com\b|\b\.net\b|\b\.org\b\b\.biz\b|\b\.info\b|\b\.gov\b|\b\.edu\b)/';
		$pattern3 = '/[\%\"\'\&\;\<\>]/';
		//$pattern4 = '/(\/bulletproof-security\/admin\/js\/\(\.\*\)\.js|\/bulletproof-security\/)/';
		$pattern4 = '/\/bulletproof-security\/admin\/js\/(.*)\.js/';
		//$pattern5 = '/(\/themes\/|\/plugins\/|\/wp-content\/|\/wp-includes\/|\/uploads\/)/';
		$pattern5 = '/(\/plugins\/|\/wp-content\/|\/wp-includes\/)/';

		$error = '0';

		// additional/extra whitespaces, line breaks/new lines after your whitelist rules or no space after the comma
		if ( preg_match( $pattern1, $options['bps_pfw_whitelist'], $matches ) ) {
			$error = '1';
		}
		// ver=, page=, src=, www, http, https, href, .com, .net, .org, .biz, .info, .gov, .edu
		if ( preg_match( $pattern2, $options['bps_pfw_whitelist'], $matches ) ) {
			$error = '2';
		}
		// invalid characters: %, ", \', &, <, > or ;
		if ( preg_match( $pattern3, $options['bps_pfw_whitelist'], $matches ) ) {
			$error = '3';
		}
		// /bulletproof-security/admin/js/ scripts
		if ( preg_match( $pattern4, $options['bps_pfw_whitelist'], $matches ) ) {
			$error = '4';
		}
		// invalid paths: /plugins/ or /wp-content/ or /wp-includes/
		if ( preg_match( $pattern5, $options['bps_pfw_whitelist'], $matches ) ) {
			$error = '5';
		}
		if ( $error != '0' ) {
		
			$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
			$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
			@unlink($PluginsHtaccess);
			@unlink($PluginsHtaccessARQplugins);
		}
	}
}

// Automated Plugins Folder BulletProof Mode
// Note: if using XAMPP then your Server IP & Public IP will be the same 127.0.0.1 which means
// the strpos check string check will see 127.0.0.1 for Server Address and not change the public ip address
// BugFix: BPS Pro 9.2 to correct issues with getting the server ip address, domain root & user's ip address in cases where a Proxy is used
// the Error message also now checks for a pre-existing problem with the domain root
// Since frontloading plugin scripts should be whitelisted already then this should be Admin only.
// Automatically deletes the /plugins/.htaccess file if whitelist rule(s) are invalid
function bps_Plugins_Folder_Lockdown() {

	if ( current_user_can('manage_options') ) {
		
	// New installations - BPS Pro has NOT been activated or S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( !get_option('bulletproof_security_options_activation') || !get_option('bulletproof_security_options_monitor') ) {
		return;
	}
	
	if ( !get_option('bulletproof_security_options_pfirewall') ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('The Plugin Firewall Needs To Be Activated', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Plugin Firewall to create your Plugin Firewall Whitelist and then Activate the Plugin Firewall.', 'bulletproof-security').'<br>'.__('If you do not want to setup or use the Plugin Firewall then click the Plugin Firewall Whitelist Tools tab and click the ', 'bulletproof-security').'<font color="blue">'.__('Save Whitelist Data', 'bulletproof-security').'</font>'.__(' button to remove/clear this message/notification.', 'bulletproof-security').'</div>';
		echo $text;
	}

	// Automatically delete the /plugins/.htaccess file if invalid whitelist rules exist
	bpsPro_PFW_auto_delete();

	$bps_get_domain_root = bpsGetDomainRoot();
	$bps_get_server_ip = bps_get_server_ip_address();
	$bps_get_public_ip = bpsPro_get_proxy_real_ip_address();
	$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
	$check_string = @file_get_contents($PluginsHtaccess);

	// Error Checking display on BPS Pro pages only - this affects all site types: Network/Single - display unconditionally
	// Since these 2 checks are done on BPS Pro pages only then resource usage is only impacted while on BPS Pro pages
	if ( preg_match( '/page=bulletproof-security/', $_SERVER['REQUEST_URI'], $bps_matches ) ) {		
	
		if ( file_exists($PluginsHtaccess) ) {
			
			$root_htaccess_file = ABSPATH . '.htaccess';
			$root_check_string = @file_get_contents($root_htaccess_file);
			$root_pattern = '/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';
			$pfwap_options = get_option('bulletproof_security_options_pfw_autopilot');

			if ( @file_exists($root_htaccess_file) && preg_match($root_pattern, $root_check_string, $root_matches) && $pfwap_options['bps_pfw_autopilot_cron'] == 'On' ) {
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';				
				$text = '<strong><font color="red">'.__('Plugin Firewall AutoPilot Mode Alert', 'bulletproof-security').'</font><br>'.__('Security Logging MUST be turned On in order for AutoPilot Mode to work. Either turn On Security Logging or turn Off AutoPilot Mode to make this Alert go away.', 'bulletproof-security').'</strong><br>';
				echo $text;
				echo '</p></div>';			
			}

			$pattern = '/Order\sAllow,Deny\s*Allow\sfrom\senv=whitelist\s*Allow\sfrom\s'.$bps_get_domain_root.'\s*Allow\sfrom\s(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-zA-Z]+:){1,}[0-9a-zA-Z]{1,})\s*#\sBEGIN\sPUBLIC\sIP\s*Allow\sfrom\s(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-zA-Z]+:){1,}[0-9a-zA-Z]{1,})\s*#\sEND\sPUBLIC\sIP/';
			$pattern2 = '/Order\sAllow,Deny\s*Allow\sfrom\senv=whitelist(\s(.*)){1,}#\sEND\sPUBLIC\sIP/';			
			
			if ( ! preg_match( $pattern, $check_string, $good_matches ) ) {
		
				preg_match( $pattern2, $check_string, $bad_matches );
		
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$text = '<strong><font color="red">'.__('Error: Minor Plugin Firewall Code Correction Needed.', 'bulletproof-security').'</font><br>'.__('To correct the Plugin Firewall code, do the Plugin Firewall setup steps below.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Plugin Firewall Setup area.', 'bulletproof-security').'<br>'.__('1. Select the Deactivate Plugin Firewall BulletProof Mode Radio button and click the Activate|Deactivate button.', 'bulletproof-security').'<br>'.__('2. Click the Save Whitelist Data button.', 'bulletproof-security').'<br>'.__('3. Click the Create Firewall Master File button.', 'bulletproof-security').'<br>'.__('4. Select the Activate Plugin Firewall BulletProof Mode Radio button.', 'bulletproof-security').'<br>'.__('5. Click the Activate|Deactivate button to activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('6. Click the Refresh Status button below.', 'bulletproof-security').'<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>'.__('If you are still seeing this error message after doing the steps above, copy and paste the code below into an email and send it to info@ait-pro.com.', 'bulletproof-security').'</strong><br>';
				echo $text;
				echo '<pre>';
				echo $bad_matches[0];
				echo '</pre>';
				echo '</p></div>';
			}
		}
	}

	// This rest of this function ONLY applies to BEGIN PUBLIC IP change - Additional Roles are handled separately
	// Network/MU sites work differently - Additional Roles does not work on MU
	if ( is_multisite() && !is_super_admin() ) {
		return;
	}

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore' ) ) {
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/', 0755 );
	}	
	}

	if ( file_exists($PluginsHtaccess) ) {
	
	if ( strpos($check_string, $bps_get_public_ip) ) {	
		return;
	}
		
	$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
	$PluginsHtaccessARQDir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins';

	if ( !strpos( $check_string, $bps_get_public_ip ) && is_dir( $PluginsHtaccessARQDir ) ) {
		
		$stringReplace = @file_get_contents($PluginsHtaccess);
		$stringReplace = preg_replace('/BEGIN PUBLIC IP\s*(.*)END PUBLIC IP/s', "BEGIN PUBLIC IP\nAllow from $bps_get_public_ip\n# END PUBLIC IP", $stringReplace);
		// comment out both lines below for testing
		file_put_contents($PluginsHtaccess, $stringReplace);
		@copy($PluginsHtaccess, $PluginsHtaccessARQplugins);
	}
	} 
	}
}
add_action('admin_notices', 'bps_Plugins_Folder_Lockdown');

/*********************************************************/
//  Plugin Firewall AutoPilot - Cron Schedules & Check   //
/*********************************************************/

add_action('bpsPro_PFWAP_check', 'bpsPro_firewall_autopilot_mode');

// Plugin Firewall AutoPilot Cron schedule checks based on DB options saved
function bpsPro_schedule_PFWAP_check() {
$options = get_option('bulletproof_security_options_pfw_autopilot');
$bpsPFWAPCronCheck = wp_get_schedule('bpsPro_PFWAP_check');
$killit = '';
	
	if ( ! get_option('bulletproof_security_options_pfw_autopilot' ) || ! $options['bps_pfw_autopilot_cron'] || $options['bps_pfw_autopilot_cron'] == '' ) {
		return $killit;
	}
	
	if ( $options['bps_pfw_autopilot_cron'] == 'On' ) {
	
	if ( $options['bps_pfw_autopilot_cron_frequency'] == '1' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_5' || $bpsPFWAPCronCheck == 'minutes_10' || $bpsPFWAPCronCheck == 'minutes_15' || $bpsPFWAPCronCheck == 'minutes_30' || $bpsPFWAPCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled( 'bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_1', 'bpsPro_PFWAP_check');
	}
	}
	
	if ( $options['bps_pfw_autopilot_cron_frequency'] == '5' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_1' || $bpsPFWAPCronCheck == 'minutes_10' || $bpsPFWAPCronCheck == 'minutes_15' || $bpsPFWAPCronCheck == 'minutes_30' || $bpsPFWAPCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_5', 'bpsPro_PFWAP_check' );
	}
	}
	
	if ( $options['bps_pfw_autopilot_cron_frequency'] == '10' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_1' || $bpsPFWAPCronCheck == 'minutes_5' || $bpsPFWAPCronCheck == 'minutes_15' || $bpsPFWAPCronCheck == 'minutes_30' || $bpsPFWAPCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_10', 'bpsPro_PFWAP_check' );
	}
	}
	
	if ( $options['bps_pfw_autopilot_cron_frequency'] == '15' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_1' || $bpsPFWAPCronCheck == 'minutes_5' || $bpsPFWAPCronCheck == 'minutes_10' || $bpsPFWAPCronCheck == 'minutes_30' || $bpsPFWAPCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_15', 'bpsPro_PFWAP_check' );
	}
	}
	
	if ( $options['bps_pfw_autopilot_cron_frequency'] == '30' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_1' || $bpsPFWAPCronCheck == 'minutes_5' || $bpsPFWAPCronCheck == 'minutes_10' || $bpsPFWAPCronCheck == 'minutes_15' || $bpsPFWAPCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_30', 'bpsPro_PFWAP_check' );
	}
	}

	if ( $options['bps_pfw_autopilot_cron_frequency'] == '60' ) {
	if ( $bpsPFWAPCronCheck == 'minutes_1' || $bpsPFWAPCronCheck == 'minutes_5' || $bpsPFWAPCronCheck == 'minutes_10' || $bpsPFWAPCronCheck == 'minutes_15' || $bpsPFWAPCronCheck == 'minutes_30' ) {
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_PFWAP_check' ) ) {
		wp_schedule_event( time(), 'minutes_60', 'bpsPro_PFWAP_check' );
	}
	}

	}
	elseif ( $options['bps_pfw_autopilot_cron'] == 'Off' ) { 
		wp_clear_scheduled_hook('bpsPro_PFWAP_check');
	}
}

add_action('init', 'bpsPro_schedule_PFWAP_check');

// Get Domain Root with prefix
function bpsGetDomainRootPrefix() {

	if ( isset( $_SERVER['SERVER_NAME'] ) ) {

		$ServerName = esc_html( $_SERVER['SERVER_NAME'] );
		return $ServerName;		
	
	} else {
		
		$ServerName = esc_html( $_SERVER['HTTP_HOST'] );
		return $ServerName;	
	}
}

// Plugin Firewall AutoPilot Mode Cron with Time Restriction
// Notes: Gets possible Plugin Firewall whitelist rules from Security Log file contents
// Checks that the plugin folder actually really exists
// Does a unique array merge of new whitelist rules	and DB option whitelist rules
// The Master and the Live htaccess files are written to individually instead of copying Master to Live htaccess file after write
// New Plugin Firewall Whitelist rules are logged in the Security Log when detected and created
function bpsPro_firewall_autopilot_mode() {
$PFWAP_options = get_option('bulletproof_security_options_pfw_autopilot');
$bpsProLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

	if ( $PFWAP_options['bps_pfw_autopilot_cron'] == 'Off' || !get_option('bulletproof_security_options_pfw_autopilot') ) {
		exit();
	}
	
	if ( time() < $PFWAP_options['bps_pfw_autopilot_cron_end'] ) {
		exit();
	
	} else {
	
		if ( file_exists($bpsProLogARQ) ) {
	
			$bpsProLogARQ_contents = file_get_contents($bpsProLogARQ);
			$filterPattern1 = '/\/bulletproof-security\/admin\/php\/bps-phpinfo\.php/';
			$filterPattern2 = '/\/bulletproof-security\/403\.php/';
			$filterPattern3 = '/\/bulletproof-security\/admin\/js\/(.*)\.js/';
		
			preg_match_all( '/HTTP_REFERER:\shttps?:\/\/' . bpsGetDomainRootPrefix() . '(.*)\s*REQUEST_URI:(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/', $bpsProLogARQ_contents, $matches );
	
			$pathValue = array();
		
			foreach ( $matches[0] as $Key => $Value ) {
				// Filters
				if ( ! preg_match( $filterPattern1, $Value ) && ! preg_match( $filterPattern2, $Value ) && ! preg_match( $filterPattern3, $Value ) ) {
				
					$dir_check = preg_replace( '/HTTP_REFERER:\shttps?:\/\/' . bpsGetDomainRootPrefix() . '(.*)\s*REQUEST_URI:(.*)\/plugins/', '', $Value );

					if ( is_dir( WP_PLUGIN_DIR . dirname($dir_check) ) ) {	

						$pathValue[] = $dir_check;
						$comma_separated = implode( ', ', $pathValue );	
						$NoDupes = implode( ', ', array_unique( explode( ', ', $comma_separated ) ) );
					}
				}
			}

			$PFW_options = get_option('bulletproof_security_options_pfirewall');

			$string1 = $PFW_options['bps_pfw_whitelist'];
			$string2 = $NoDupes;
			$stringMerge = $string1 . ', ' . $string2;
			$stringMergeUnique = implode( ', ', array_unique( explode( ', ', trim( $stringMerge, ", \t\n\r" ) ) ) );
	
			$NoDupes_array = explode( ', ', $NoDupes );
			$pfw_whitelist_array = explode( ', ', $PFW_options['bps_pfw_whitelist'] );
			$result = array_diff($NoDupes_array, $pfw_whitelist_array);

			$timeNow = time();
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
			$bpsSecLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
			$log_title = "\r\n" . '[Plugin Firewall AutoPilot Mode New Whitelist Rule(s) Created: ' . $timestamp . ']' . "\r\n";

			if ( ! empty($result) && $result[0] != '' ) {
		
				if ( is_writable( $bpsSecLog ) ) {
				if ( ! $handle = fopen( $bpsSecLog, 'a' ) ) {
        			exit;
    			}
    			if ( fwrite( $handle, $log_title ) === FALSE ) {
        			exit;
    			}
    			fclose($handle);
				}


				foreach ( $result as $key => $value ) {
		
					$log_contents = 'Whitelist Rule: ' . $value . "\r\n";
					
					if ( is_writable( $bpsSecLog ) ) {
					if ( ! $handle = fopen( $bpsSecLog, 'a' ) ) {
         				exit;
    				}
    				if ( fwrite( $handle, $log_contents ) === FALSE ) {
        				exit;
    				}
    				fclose($handle);
					}
				}

			$bps_pfw_whitelist = $stringMergeUnique;

			$BPS_PFW_Options = array(
			'bps_pfw_paypal' 		=> $PFW_options['bps_pfw_paypal'], 
			'bps_pfw_google' 		=> $PFW_options['bps_pfw_google'], 
			'bps_pfw_amazon' 		=> $PFW_options['bps_pfw_amazon'], 
			'bps_pfw_authorizenet' 	=> $PFW_options['bps_pfw_authorizenet'], 
			'bps_pfw_whitelist' 	=> $bps_pfw_whitelist
			);

				foreach( $BPS_PFW_Options as $key => $value ) {
					update_option('bulletproof_security_options_pfirewall', $BPS_PFW_Options);
				}
			
			/* for testing: print_r($stringMergeUnique); */
			$PluginsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins.htaccess';
			$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
			$PluginsHtaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins.htaccess';
			$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
			$pluginsHtaccessMasterTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins-htaccess-master.txt';
			$pluginsHtaccessMasterTXTARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins-htaccess-master.txt';

			if ( file_exists($PluginsHtaccessMaster) ) {
		
				// IMPORTANT! Get the new PFW DB Option values again here
				$PFW_options_new = get_option('bulletproof_security_options_pfirewall');
				$bps_pfw_whitelist_filter = array_filter( explode(', ', trim( $PFW_options_new['bps_pfw_whitelist'], ", \t\n\r") )  );				
				
				$whiteList = array();
				$whiteListMasterU = @file_get_contents($pluginsHtaccessMasterTXT);		
		
				foreach ( $bps_pfw_whitelist_filter as $Key => $Value ) {
				
					$whiteList[] = 'SetEnvIf Request_URI "'.$Value.'$" whitelist'."\n";
					$uniqueRules = array_unique($whiteList);
						
					foreach ( $uniqueRules as $uniqueRule ) {

						if ( $uniqueRule != '' ) {
							file_put_contents($pluginsHtaccessMasterTXT, $uniqueRules);
						}			
					}
				}
		
				// IMPORTANT! do not combine or use the same variable for $whiteListMaster & $whiteListMasterU - they MUST be separate/unique
				$whiteListMaster = @file_get_contents($pluginsHtaccessMasterTXT);
				$PluginsHtaccessMaster_contents = @file_get_contents($PluginsHtaccessMaster);
				$stringReplace = preg_replace('/BEGIN WHITELIST(.*)END WHITELIST/s', "BEGIN WHITELIST: Frontend Loading Website Plugin scripts/files\nSetEnvIf Request_URI \"/bulletproof-security/400.php\$\" whitelist\nSetEnvIf Request_URI \"/bulletproof-security/403.php\$\" whitelist\n".$whiteListMaster."# END WHITELIST", $PluginsHtaccessMaster_contents);

				if ( file_put_contents($PluginsHtaccessMaster, $stringReplace) ) {
					@copy($PluginsHtaccessMaster, $PluginsHtaccessARQ);
					@copy($pluginsHtaccessMasterTXT, $pluginsHtaccessMasterTXTARQ);
				}	
		
				if ( file_put_contents($PluginsHtaccess, $stringReplace) ) {
					@copy($PluginsHtaccess, $PluginsHtaccessARQplugins);
				}
			}
			} // end if ( ! empty($result) && $result[0] != '' ) {
		}
	}
}

?>