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

// S-Monitor & AutoRestore Status display - displayed in  BPS Only 
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
$bpsSpacePop = '-------------------------------------------------------------';

// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ File Lock', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('File Lock', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('File Lock', 'bulletproof-security'); ?></h2>

<?php

	$GDMW_options = get_option('bulletproof_security_options_GDMW');
	
	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<h3><strong><span style="font-size:1em;"><font color="blue">'.__('Notice: ', 'bulletproof-security').'</font></span><span style="font-size:.75em;">'.__('The Setup Wizard Go Daddy "Managed WordPress Hosting" option is set to Yes.', 'bulletproof-security').'<br>'.__('If you have Go Daddy "Managed WordPress Hosting" click this link: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/gdmw/" target="_blank" title="Link opens in a new Browser window">'.__('Go Daddy Managed WordPress Hosting', 'bulletproof-security').'</a>.<br>'.__('If you do not have Go Daddy "Managed WordPress Hosting" then change the Go Daddy "Managed WordPress Hosting" Setup Wizard option to No.', 'bulletproof-security').'</span></strong></h3>';
		echo $text;
	}

// Detect the SAPI - php_sapi_name returns lower case string by default
$sapi_type = php_sapi_name();
	
	if ( @substr($sapi_type, 0, 6) != 'apache') {		
		$text = '<font color="green"><strong>'.__('Server API: ', 'bulletproof-security').$sapi_type.' - '.__('Your Host Server is using CGI. Use the CGI File Lock and Unlock options.', 'bulletproof-security').'</strong></font>';
		echo $text;
	} else {
    	$text = '<font color="black"><strong>'.__('Server API: ', 'bulletproof-security').$sapi_type.' - '.__('Your Server Configuration is DSO. Files cannot be locked on a DSO Server. Choose/Select - Turn Off Checking & Alerts - for all F-Lock option settings.', 'bulletproof-security').'</strong></font>';
		echo $text;
}
	
// CGI and DSO Dropdown List Form Options - CHMOD files
function bps_flock_pro() {
$options = get_option('bulletproof_security_options_flock');
$bpsRootHtaccess = ABSPATH . '.htaccess';
$bpsWpConfig = ABSPATH . 'wp-config.php';
$bpsIndexPhp = ABSPATH . 'index.php';
$bpsWpBlogHeader = ABSPATH . 'wp-blog-header.php';
$bpsRootHtaccessDR = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
$bpsIndexPhpDR = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
$bpsRootHtaccessGWIOD = dirname(ABSPATH) . '/.htaccess';
$bpsIndexPhpGWIOD = dirname(ABSPATH) . '/index.php';
	
if ( current_user_can('manage_options') ) {

	if ( $options['bps_lock_root_htaccess'] == 'yes' ) { 	
		if ( file_exists($bpsRootHtaccess) ) {
			@chmod($bpsRootHtaccess, 0404);
		}
	}

	if ($options['bps_lock_root_htaccess'] == 'no') { 	
		if (file_exists($bpsRootHtaccess)) {
			@chmod($bpsRootHtaccess, 0644);
		}
	}
	
	if ($options['bps_lock_root_htaccess'] == 'dso') { 	
		if (file_exists($bpsRootHtaccess)) {
			@chmod($bpsRootHtaccess, 0644);
		}
	}

	if ($options['bps_lock_wpconfig'] == 'yes') { 	
		if (file_exists($bpsWpConfig)) {
			@chmod($bpsWpConfig, 0400);
		}
	}

	if ($options['bps_lock_wpconfig'] == 'no') { 	
		if (file_exists($bpsWpConfig)) {
			@chmod($bpsWpConfig, 0644);
		}
	}

	if ($options['bps_lock_wpconfig'] == 'dso') { 	
		if (file_exists($bpsWpConfig)) {
			@chmod($bpsWpConfig, 0644);
		}
	}
	
	if ($options['bps_lock_index_php'] == 'yes') { 	
		if (file_exists($bpsIndexPhp)) {
			@chmod($bpsIndexPhp, 0400);
		}
	}

	if ($options['bps_lock_index_php'] == 'no') { 	
		if (file_exists($bpsIndexPhp)) {
			@chmod($bpsIndexPhp, 0644);
		}
	}

	if ($options['bps_lock_index_php'] == 'dso') { 	
		if (file_exists($bpsIndexPhp)) {
			@chmod($bpsIndexPhp, 0644);
		}
	}
	
	if ($options['bps_lock_wpblog_header'] == 'yes') { 	
		if (file_exists($bpsWpBlogHeader)) {
			@chmod($bpsWpBlogHeader, 0400);
		}
	}

	if ($options['bps_lock_wpblog_header'] == 'no') { 	
		if (file_exists($bpsWpBlogHeader)) {
			@chmod($bpsWpBlogHeader, 0644);
		}
	}

	if ($options['bps_lock_wpblog_header'] == 'dso') { 	
		if (file_exists($bpsWpBlogHeader)) {
			@chmod($bpsWpBlogHeader, 0644);
		}
	}	

	if ($options['bps_lock_root_htaccess_dr'] == 'yes') { 	
		if (file_exists($bpsRootHtaccessDR)) {
			@chmod($bpsRootHtaccessDR, 0404);
		}
	}

	if ($options['bps_lock_root_htaccess_dr'] == 'no') { 	
		if (file_exists($bpsRootHtaccessDR)) {
			@chmod($bpsRootHtaccessDR, 0644);
		}
	}

	if ($options['bps_lock_root_htaccess_dr'] == 'dso') { 	
		if (file_exists($bpsRootHtaccessDR)) {
			@chmod($bpsRootHtaccessDR, 0644);
		}
	}

	if ($options['bps_lock_index_php_dr'] == 'yes') { 	
		if (file_exists($bpsIndexPhpDR)) {
			@chmod($bpsIndexPhpDR, 0400);
		}
	}

	if ($options['bps_lock_index_php_dr'] == 'no') { 	
		if (file_exists($bpsIndexPhpDR)) {
			@chmod($bpsIndexPhpDR, 0644);
		}
	}

	if ($options['bps_lock_index_php_dr'] == 'dso') { 	
		if (file_exists($bpsIndexPhpDR)) {
			@chmod($bpsIndexPhpDR, 0644);
		}
	}

	if ($options['bps_lock_root_htaccess_gwiod'] == 'yes') { 	
		if (file_exists($bpsRootHtaccessGWIOD)) {
			@chmod($bpsRootHtaccessGWIOD, 0404);
		}
	}

	if ($options['bps_lock_root_htaccess_gwiod'] == 'no') { 	
		if (file_exists($bpsRootHtaccessGWIOD)) {
			@chmod($bpsRootHtaccessGWIOD, 0644);
		}
	}

	if ($options['bps_lock_root_htaccess_gwiod'] == 'dso') { 	
		if (file_exists($bpsRootHtaccessGWIOD)) {
			@chmod($bpsRootHtaccessGWIOD, 0644);
		}
	}


	if ($options['bps_lock_index_php_gwiod'] == 'yes') { 	
		if (file_exists($bpsIndexPhpGWIOD)) {
			@chmod($bpsIndexPhpGWIOD, 0400);
		}
	}

	if ($options['bps_lock_index_php_gwiod'] == 'no') { 	
		if (file_exists($bpsIndexPhpGWIOD)) {
			@chmod($bpsIndexPhpGWIOD, 0644);
		}
	}
	
	if ($options['bps_lock_index_php_gwiod'] == 'dso') { 	
		if (file_exists($bpsIndexPhpGWIOD)) {
			@chmod($bpsIndexPhpGWIOD, 0644);
		}
	}
}
}

// CGI Permissions and Status Table functions - Get file permissions and display status only if SAPI is CGI
function bps_flock_pro_statusRH() {
clearstatcache();
$file = ABSPATH . '.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_root_htaccess'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('Site Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		
		if ($perms == '0404') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
	} else {
		$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		}
	}
}

function bps_flock_pro_statusWPC() {
clearstatcache();
$file = ABSPATH . 'wp-config.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_wpconfig'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_wpconfig'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The wp-config.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}	
		if ($perms == '0400') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		}
	}
}

function bps_flock_pro_statusWPI() {
clearstatcache();
$file = ABSPATH . 'index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_index_php'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The WP Site Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}		
		if ($perms == '400.') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusWPBH() {
clearstatcache();
$file = ABSPATH . 'wp-blog-header.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_wpblog_header'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_wpblog_header'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The wp-blog-header.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ($perms == '0400') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusRH_DR() {
clearstatcache();
$file = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_root_htaccess_dr'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess_dr'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('DR - Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
		if ($perms == '0404') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusWPI_DR() {
clearstatcache();
$file = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_index_php_dr'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php_dr'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('DR - Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
		if ($perms == '0400') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusRH_GWIOD() {
clearstatcache();
$file = dirname(ABSPATH) . '/.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_root_htaccess_gwiod'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess_gwiod'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('GWIOD - Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
		if ($perms == '0404') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
	} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusWPI_GWIOD() {
clearstatcache();
$file = dirname(ABSPATH) . '/index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_index_php_gwiod'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php_gwiod'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('GWIOD - Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;		
		}
		if ($perms == '0400') {
			$text = '<font color="green"><strong>'.$perms.' - '.__('Locked - Read Only', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.$perms.' - '.__('Unlocked or Not Locked', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

// DSO Permissions and Status Table functions - displays only if DSO SAPI is detected
function bps_flock_pro_statusRH_DSO() {
clearstatcache();
$file = ABSPATH . '.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_root_htaccess'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('Site Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;			
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
	}
}

function bps_flock_pro_statusWPC_DSO() {
clearstatcache();
$file = ABSPATH . 'wp-config.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_wpconfig'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_wpconfig'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The wp-config.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}		
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
	}
	}
}

function bps_flock_pro_statusWPI_DSO() {
clearstatcache();
$file = ABSPATH . 'index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_index_php'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The WP Site Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}	
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
		echo $text;	
		}
	}
}

function bps_flock_pro_statusWPBH_DSO() {
clearstatcache();
$file = ABSPATH . 'wp-blog-header.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_wpblog_header'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_wpblog_header'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('The wp-blog-header.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;		
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
	}
}

function bps_flock_pro_statusRH_DR_DSO() {
clearstatcache();
$file = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_root_htaccess_dr'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess_dr'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('DR - Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;			
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
	}
	}
}

function bps_flock_pro_statusWPI_DR_DSO() {
clearstatcache();
$file = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');	

	if ($options['bps_lock_index_php_dr'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php_dr'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('DR - Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		}
	}
}

function bps_flock_pro_statusRH_GWIOD_DSO() {
clearstatcache();
$file = dirname(ABSPATH) . '/.htaccess';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_root_htaccess_gwiod'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_root_htaccess_gwiod'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('GWIOD - Root htaccess file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text; 
		}
	}
}

function bps_flock_pro_statusWPI_GWIOD_DSO() {
clearstatcache();
$file = dirname(ABSPATH) . '/index.php';
$perms = @substr(sprintf('%o', fileperms($file)), -4);
$options = get_option('bulletproof_security_options_flock');
	
	if ($options['bps_lock_index_php_gwiod'] == 'off') { 	
		$text = '<font color="black"><strong>'.__('Turned Off', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	elseif ($options['bps_lock_index_php_gwiod'] == 'yes' || 'no' || '') { 	
		if (!file_exists($file)) {
			$text = '<font color="black"><strong>'.__('GWIOD - Root index.php file does not exist.', 'bulletproof-security').'</strong></font><br>';
			echo $text;	
		}
		if ($perms == '0644') {
			$text = '<font color="green"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
			echo $text;
		} else {
			$text = '<font color="red"><strong>'.__('DSO - ', 'bulletproof-security').$perms.__(' File Permissions', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		}
	}
}

$gmt_offset = get_option( 'gmt_offset' ) * 3600;

// CGI and DSO File Permissions and Status Tables - File Last Modified Time
function bps_flock_modTimeRH() {
global $gmt_offset;
$file = ABSPATH . '.htaccess';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeWPC() {
global $gmt_offset;
$file = ABSPATH . 'wp-config.php';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeWPI() {
global $gmt_offset;
$file = ABSPATH . 'index.php';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeWPBH() {
global $gmt_offset;
$file = ABSPATH . 'wp-blog-header.php';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeRH_DR() {
global $gmt_offset;
$file = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeWPI_DR() {
global $gmt_offset;
$file = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeRH_GWIOD() {
global $gmt_offset;
$file = dirname(ABSPATH) . '/.htaccess';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
function bps_flock_modTimeWPI_GWIOD() {
global $gmt_offset;
$file = dirname(ABSPATH) . '/index.php';
	
	if ( file_exists($file) ) {
	$last_modified = date("M d Y H:i:s", filemtime($file) + $gmt_offset );
	return $last_modified;
	}
}
?>
<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 10px 0px;"><?php _e('Lock/AutoLock Mission Critical Files Help Info', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('F-Lock', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('What is AutoLock?', 'bulletproof-security').'</strong><br>'.__('AutoLock is automated file locking. When first installing BPS Pro you need only click on the Save Options button to lock all of your files together at one time. Whatever Lock or Unlock file options are selected for each of your files is automatically applied to your files just by accessing the F-Lock page. Manual control of individual file permissions is done by choosing the file you want to Lock or Unlock, selecting Lock or Unlock for that file and then clicking the Save Options button. AutoLock is used for 2 reasons - to make locking files quick and easy and to display real time file permissions status.', 'bulletproof-security').'<br><br><strong>'.__('IMPORTANT - Web Host Server API Info - CGI or DSO Info', 'bulletproof-security').'</strong><br>'.__('BPS Pro checks your Web Hosts Server API and your Web Hosts Server API is displayed in green font right below this Read Me Help button. Most people will have a CGI Server configuration on their Web Hosts and you should see that your Server API is CGI. If your Web Host is using DSO instead of CGI then file locking and unlocking does not pertain to you. Set your file permissions to DSO - 644 File Permissions and then turn off the S-Monitor', 'bulletproof-security').' <strong>'.__('F-Lock: Check File Lock/Unlock Status', 'bulletproof-security').'</strong> '.__('checking option. DSO file ownership permissions are handled in a completely different way then CGI file permissions. The majority of Web Hosts will be using CGI so the rest of this help file pertains to a CGI Server API.', 'bulletproof-security').'<br><br><strong>'.__('Why Lock Mission Critical Files?', 'bulletproof-security').'</strong><br>'.__('Hackers specifically target these files in Mass Code Injection attacks on web hosts. This is done by exploiting the Group Permissions on files located in Root folders for hosts that use CGI. By locking these files with Read Only 400 and 404 permissions the Group Permissions are removed and these files are protected against Mass Code Injection attacks. For hosts using DSO - 644 file permissions are secure because of the different file permission methods used by DSO.', 'bulletproof-security').'<br><br><strong>'.__('Will Locking Files With Read Only Permissions Break WordPress?', 'bulletproof-security').'</strong><br>'.__('No. 400 and 404 files permissions have been tested on several different web hosts using CGI and WordPress performs normally. DSO file permissions should be the standard 644 file permissions. BPS is checking and displaying your Server API. If you see CGI displayed as your Server API then you can use the regular File Lock and Unlock options. If you see something other than CGI or DSO displayed as your Server API then check with your web host to find out what the most restrictive file permissions that you can use are or you can just experiment. If you are experimenting be prepared to FTP to your website and manually change the file permission back to what it was if you see 500 errors. Incorrect file permissions could cause you website to display 500 errors and be down. It is possible but not likely that the Server API could display another interface name such as continuity, embed, isapi, litespeed or other SAPI names instead of DSO or CGI.', 'bulletproof-security').'<br><br><strong>'.__('Will Locking Files With Read Only Permissions Break Plugins?', 'bulletproof-security').'</strong><br>'.__('Locking the files will not interfere with a plugins normal operation but if a plugin needs to write to any of these locked files then the file will temporarily need to be unlocked so that a plugin can write to it. If you are using the B-Core File Editor to edit your root htaccess file you will need to unlock the root htaccess file so that BPS can write to it. A Lock/Unlock button has been added to the BPS htaccess File Editor page. F-Lock allows you to quickly Lock and Unlock files on the fly without having to use FTP or your Control Panel.', 'bulletproof-security').'<br><br><strong>'.__('What is GWIOD - Lock/Unlock?', 'bulletproof-security').'</strong><br>'.__('GWIOD is short for Giving WordPress Its Own Directory. People who are using this type of WordPress site set up will have an additional htaccess file and index.php file in their Site Root folder. This will allow them to lock both their Site Root htaccess file and index.php file as well as the htaccess file and index.php files that exist in their actual WordPress installation folder. If you are not using this type of WordPress set up then these files will either show up as duplicates of your already locked or unlocked files or could generate error messages. If you are not using this type of WordPress set up and you are seeing error messages then turn this check off by selecting the', 'bulletproof-security').' <strong>'.__('Turn Off Checking &amp; Alerts', 'bulletproof-security').'</strong> '.__('dropdown list option. If the file does not really exist then you will see', 'bulletproof-security').' <strong>...'.__('file does not exist', 'bulletproof-security').'</strong> '.__('under Permissions &amp; Status for that file.', 'bulletproof-security').'<br><br><strong>'.__('What is DR - Lock/Unlock?', 'bulletproof-security').'</strong><br>'.__('DR is short for Document Root. This allows you to lock and unlock an htaccess file or index.php file in your Document Root folder. If your WordPress installation is already in your Document Root folder then the DR Permissions & Status information will just be duplicated permissions and status information about your already locked or unlocked files. If you have multiple WordPress sites installed and some are subfolder installations and one is a WordPress Document Root installation then you will be able to lock and unlock the Document Root files from any of your WordPress subfolder websites. If you have a single WordPress installation installed in your Document Root folder then these files will show up as duplicates of your already locked or unlocked files. If you are seeing error messages about these files not being locked because they do not really exist then turn this check off by selecting the', 'bulletproof-security').' <strong>'.__('Turn Off Checking &amp; Alerts', 'bulletproof-security').'</strong> '.__('dropdown list option. If the file does not really exist then you will see', 'bulletproof-security').' <strong>'.__('...file does not exist', 'bulletproof-security').'</strong> '.__('under Permissions &amp; Status for that file. Another possible scenario is that if you have an HTML site in your Document Root folder then you could lock the htaccess file for that HTML site.', 'bulletproof-security').'<br><br><strong>'.__('The Wrong Permissions and Status Table Is Displayed', 'bulletproof-security').'</strong><br>'.__('If BPS detects CGI then you will see the', 'bulletproof-security').' <strong>'.__('CGI Permissions & Status Table', 'bulletproof-security').'</strong> '.__('displayed and you should be able to set permissions to 400 and 404. If BPS detects DSO then you will see the', 'bulletproof-security').' <strong>'.__('DSO Permissions & Status Table', 'bulletproof-security').'</strong> '.__('and should only be able to set permissions to 644. BPS looks at the Server API name that your host has configured to display. If your host is using CGI but they are using another interface name then BPS will not be able to detect that your Server is using CGI and will display the DSO Permissions and Status Table. Please let us know about this by sending us an email. We can then add additional coding to BPS to create an exception for your particular host.', 'bulletproof-security').'<br><br><strong>'.__('Help links are provided on the Help & FAQ page.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>    
    
    <form name="bpsFlock" action="options.php" method="post">
    <?php settings_fields('bulletproof_security_options_flock'); ?>
	<?php $options = get_option('bulletproof_security_options_flock'); ?>
<strong><label for="bps-flock"><?php _e('Lock|Unlock Root htaccess File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_root_htaccess]" style="width:340px;">
<option value="yes"<?php selected('yes', $options['bps_lock_root_htaccess']); ?>><?php _e('CGI|Lock Root htaccess File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_root_htaccess']); ?>><?php _e('CGI|Unlock Root htaccess File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_root_htaccess']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
<option value="off"<?php selected('off', $options['bps_lock_root_htaccess']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('Lock|Unlock wp-config.php File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_wpconfig]" style="width:340px;">
<option value="yes"<?php selected('yes', $options['bps_lock_wpconfig']); ?>><?php _e('CGI|Lock wp-config.php File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_wpconfig']); ?>><?php _e('CGI|Unlock wp-config.php File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_wpconfig']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
<option value="off"<?php selected('off', $options['bps_lock_wpconfig']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('Lock|Unlock WP Root index.php File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_index_php]" style="width:340px;">
<option value="yes"<?php selected('yes', $options['bps_lock_index_php']); ?>><?php _e('CGI|Lock WP Root index.php File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_index_php']); ?>><?php _e('CGI|Unlock WP Root index.php File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_index_php']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
<option value="off"<?php selected('off', $options['bps_lock_index_php']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('Lock|Unlock wp-blog-header.php File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_wpblog_header]" style="width:340px;">
<option value="yes"<?php selected('yes', $options['bps_lock_wpblog_header']); ?>><?php _e('CGI|Lock wp-blog-header.php File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_wpblog_header']); ?>><?php _e('CGI|Unlock wp-blog-header.php File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_wpblog_header']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
<option value="off"<?php selected('off', $options['bps_lock_wpblog_header']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('DR - Lock|Unlock DR htaccess File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_root_htaccess_dr]" style="width:340px;">
<option value="off"<?php selected('off', $options['bps_lock_root_htaccess_dr']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
<option value="yes"<?php selected('yes', $options['bps_lock_root_htaccess_dr']); ?>><?php _e('CGI|Lock DR Root htaccess File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_root_htaccess_dr']); ?>><?php _e('CGI|Unlock DR Root htaccess File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_root_htaccess_dr']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('DR|Lock|Unlock WP DR index.php File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_index_php_dr]" style="width:340px;">
<option value="off"<?php selected('off', $options['bps_lock_index_php_dr']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
<option value="yes"<?php selected('yes', $options['bps_lock_index_php_dr']); ?>><?php _e('CGI|Lock DR WP index.php File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_index_php_dr']); ?>><?php _e('CGI|Unlock DR WP index.php File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_index_php_dr']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('GWIOD|Lock|Unlock Root htaccess File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_root_htaccess_gwiod]" style="width:340px;">
<option value="off"<?php selected('off', $options['bps_lock_root_htaccess_gwiod']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
<option value="yes"<?php selected('yes', $options['bps_lock_root_htaccess_gwiod']); ?>><?php _e('CGI|Lock GWIOD Root htaccess File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_root_htaccess_gwiod']); ?>><?php _e('CGI|Unlock GWIOD Root htaccess File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_root_htaccess_gwiod']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
</select><br /><br />
<strong><label for="bps-flock"><?php _e('GWIOD|Lock|Unlock WP Root index.php File', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_flock[bps_lock_index_php_gwiod]" style="width:340px;">
<option value="off"<?php selected('off', $options['bps_lock_index_php_gwiod']); ?>><?php _e('Turn Off Checking &amp; Alerts', 'bulletproof-security'); ?></option>
<option value="yes"<?php selected('yes', $options['bps_lock_index_php_gwiod']); ?>><?php _e('CGI|Lock GWIOD WP index.php File', 'bulletproof-security'); ?></option>
<option value="no"<?php selected('no', $options['bps_lock_index_php_gwiod']); ?>><?php _e('CGI|Unlock GWIOD WP index.php File', 'bulletproof-security'); ?></option>
<option value="dso"<?php selected('dso', $options['bps_lock_index_php_gwiod']); ?>><?php _e('DSO|644 File Permission', 'bulletproof-security'); ?></option>
</select><br /><br />
<input type="hidden" name="bpsFL" value="bps-FL" />
<?php bps_flock_pro(); ?>
<input type="submit" name="bpsFlockSubmit" class="button bps-button" style="margin:0px 0px 10px 10px;" value="<?php esc_attr_e('Save Options', 'bulletproof-security') ?>"   onclick="return confirm('<?php $text = __('Hint: Most websites will not need to use the DR and GWIOD F-Lock options and these can be set to Turn Off Checking and Alerts. Please read the Read Me help button for more information about what types of WordPress websites use the DR and GWIOD options.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your options or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>
</form>	
    </td>
    <td width="50%" valign="top" class="bps-table_cell_help">
    
    <?php 
	$bpsRootHtaccess = ABSPATH . '.htaccess';
	$bpsWpConfig = ABSPATH . 'wp-config.php';
	$bpsIndexPhp = ABSPATH . 'index.php';
	$bpsWpBlogHeader = ABSPATH . 'wp-blog-header.php';
	$bpsRootHtaccessDR = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
	$bpsIndexPhpDR = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
	$bpsRootHtaccessGWIOD = dirname(ABSPATH) . '/.htaccess';
	$bpsIndexPhpGWIOD = dirname(ABSPATH) . '/index.php';
	
	if ( @substr($sapi_type, 0, 6) != 'apache') {	
	?>

    
    <h3 style="margin:0px 0px 5px 0px;"><?php _e('CGI Permissions &amp; Status Table', 'bulletproof-security'); ?></h3>
    
    <table class="widefat" style="margin-bottom:20px;">
	<thead>
	<tr>
	<th scope="col"><strong><?php _e('Filename', 'bulletproof-security')?></strong></th>
	<th scope="col"><strong><?php _e('Permissions &amp; Status', 'bulletproof-security')?></strong></th>
    <th scope="col"><strong><?php _e('Last Modified', 'bulletproof-security')?></strong></th>
	</tr>
	</thead>

	<tbody>
	<tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH(); ?></td>
    <td><?php echo bps_flock_modTimeRH(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccess; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('wp-config.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPC(); ?></td>
    <td><?php echo bps_flock_modTimeWPC(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsWpConfig; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI(); ?></td>
    <td><?php echo bps_flock_modTimeWPI(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhp; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('wp-blog-header.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPBH(); ?></td>
    <td><?php echo bps_flock_modTimeWPBH(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsWpBlogHeader; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('DR - Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH_DR(); ?></td>
    <td><?php echo bps_flock_modTimeRH_DR(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccessDR; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('DR - WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI_DR(); ?></td>
    <td><?php echo bps_flock_modTimeWPI_DR(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhpDR; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('GWIOD - Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH_GWIOD(); ?></td>
    <td><?php echo bps_flock_modTimeRH_GWIOD(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccessGWIOD; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('GWIOD - WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI_GWIOD(); ?></td>
    <td><?php echo bps_flock_modTimeWPI_GWIOD(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhpGWIOD; ?></td>
    </tr>
</tbody>
</table>

<?php } else { ?>

<h3 style="margin:0px 0px 5px 0px;"><?php _e('DSO Permissions &amp; Status Table', 'bulletproof-security'); ?></h3>
    
    <table class="widefat" style="margin-bottom:20px;">
	<thead>
	<tr>
	<th scope="col"><strong><?php _e('Filename', 'bulletproof-security')?></strong></th>
	<th scope="col"><strong><?php _e('Permissions &amp; Status', 'bulletproof-security')?></strong></th>
    <th scope="col"><strong><?php _e('Last Modified', 'bulletproof-security')?></strong></th>
	</tr>
	</thead>
	
    <tbody>
	<tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeRH(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccess; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('wp-config.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPC_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeWPC(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsWpConfig; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeWPI(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhp; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('wp-blog-header.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPBH_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeWPBH(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsWpBlogHeader; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('DR - Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH_DR_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeRH_DR(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccessDR; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('DR - WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI_DR_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeWPI_DR(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhpDR; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('GWIOD - Root .htaccess', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusRH_GWIOD_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeRH_GWIOD(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff;padding:0px 0px 0px 6px;">
	<?php echo $bpsRootHtaccessGWIOD; ?></td>
    </tr>
    <tr>
	<th scope="row" style="border-bottom:none;">
	<?php _e('GWIOD - WP index.php', 'bulletproof-security')?></th>
	<td><?php echo bps_flock_pro_statusWPI_GWIOD_DSO(); ?></td>
    <td><?php echo bps_flock_modTimeWPI_GWIOD(); ?></td>
	</tr>
    <tr>
	<th scope="row" style="padding:0px;"></th>
    <td colspan="2" style="color:black;background-color:#fff; padding:0px 0px 0px 6px;">
	<?php echo $bpsIndexPhpGWIOD; ?></td>
    </tr>
</tbody>
</table>
<?php } ?>
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
    <td class="bps-table_cell_help_links"><a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php" target="_blank"><?php _e('Whats New in ', 'bulletproof-security'); echo BULLETPROOF_VERSION; ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a></td>
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