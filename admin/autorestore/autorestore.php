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
// Manually runs real-time BPS Pro version update check - for testing ONLY
// echo bpsPro_update_checks();
// Manually runs PHP Error Log cron function - for testing ONLY
// echo bps_smonitor_ELogModTimeDiff_wp_email();

// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// PHP Standard PHP Library (SPL) Check - if SPL is not installed / On then AutoRestore/Quarantine Iterators will not work
if ( !is_array(spl_classes() ) ) {
	echo $bps_topDiv;
	$text = '<p><font color="red"><strong>'.__('The PHP Standard PHP Library (SPL) is Not Available - Please send an email to info@ait-pro.com for assistance.', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	echo $bps_bottomDiv;
}

// General all purpose "Settings Saved." message for forms - /includes/class.php
if ( current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
if ( @$_GET['settings-updated'] == true ) {
	$text = '<p style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:5px;margin:0px;"><font color="green"><strong>'.__('Settings Saved', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	} else {
	echo '<font color="red"><strong>'.bps_cuser_errors().'</strong></font>';
	}
}

/*********************************/
/*   ARQ File Counters & MTime   */
/*********************************/

// Master ARQ file counter - Not Used/Not necessary - will count the total # of files in all autorestore directories
// Someone will ask for this eventually so leaving the function here
function bpsFileCounterMaster($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/';
	$count = 0;
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

	foreach ( $iterator as $files ) {
    	if ( $files->isFile() ) {
    	$count++;
		}
	}
	if ( $count <= 0 ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.$count.__(' Files Backed up in the AutoRestore folder and all subdirectories.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	} else {
		echo $bps_topDiv;
		$text = '<span class="arq-backup-files"><strong>'.$count.__(' Files Backed up in the AutoRestore folder and all subdirectories.', 'bulletproof-security').'</strong></span>';
		echo $text;;
		echo $bps_bottomDiv;
	}
	}
}
// echo bpsFileCounterMaster($source, $count);

// Root ARQ file counter & MTime
function bpsFileCounterRoot($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
	$count = 0;
	
	if ( ! is_dir($source) ) {
	$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	}

	if ( isset($_POST['bpsARCMSubmit']) || isset($_POST['Submit-ARCM-RootNR']) || isset($_POST['Submit-ARCM-Wpadmin']) || isset($_POST['Submit-ARCM-Wpincludes']) || isset($_POST['Submit-ARCM-Wpcontent']) || isset($_POST['Submit-ARCM-Root-Delete']) || isset($_POST['Submit-ARCM-Wpadmin-Delete']) || isset($_POST['Submit-ARCM-Wpincludes-Delete']) || isset($_POST['Submit-ARCM-Wpcontent-Delete']) || isset($_POST['Submit-ARCM-Root-Restore']) || isset($_POST['Submit-ARCM-Wpadmin-Restore']) || isset($_POST['Submit-ARCM-Wpincludes-Restore']) || isset($_POST['Submit-ARCM-Wpcontent-Restore']) || isset($_POST['Submit-ARCM-Root-Show-Backup']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Backup']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Backup']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Backup']) || isset($_POST['Submit-ARCM-Root-Show-Website']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Website']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Website']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Website']) || isset($_POST['bps-exclude-filter-creator-copy']) || isset($_POST['bps-exclude-filter-creator-write']) || isset($_POST['Submit-ARQ-Add-Remove']) || isset($_POST['Submit-ARQ-Exclude']) || isset($_POST['submit-arq-top-level-search']) || isset($_POST['submit-arq-all-folders-search']) || isset($_POST['submit-arq-specific-folder-search']) || isset($_POST['submit-arq-db-add-remove-search']) || isset($_POST['submit-arq-db-exlude-remove-search']) || isset($_POST['Submit-ARQ-Remove-Added']) || isset($_POST['Submit-ARQ-Remove-Excluded']) ) {
		return;
	}

	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		$text = __('Backup File Status Check', 'bulletproof-security').'<br>'.__('is Turned Off', 'bulletproof-security');
		echo $text;
		return;
	
	} else {

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

	foreach ( $iterator as $files ) {
    	if ( $files->isFile() ) {
    	$count++;
		$mtime = date("M d Y H:i:s", $files->getMTime());
		}
	}
	
	if ( $count <= 4 ) { // should only be 1 or 2 files, but leaving a buffer
		$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	} else {
		$text = __('Backup: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$mtime.'</strong></span><br>'.__('Total Backup Files: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$count.'</strong></span>';
		echo $text;
	}
	}
	}
}

// wp-admin ARQ file counter & MTime
function bpsFileCounterWpadmin($source, $count) {
$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
$count = 0;
$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<span class="arq-backup-files"><strong>'.__('GDMW Hosting', 'bulletproof-security').'<br>'.__('wp-admin check is Turned Off', 'bulletproof-security').'</strong></span>';
		echo $text;
		return;
	}

	if ( ! is_dir($source) ) {
	$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	}
	
	if ( isset($_POST['bpsARCMSubmit']) || isset($_POST['Submit-ARCM-RootNR']) || isset($_POST['Submit-ARCM-Wpadmin']) || isset($_POST['Submit-ARCM-Wpincludes']) || isset($_POST['Submit-ARCM-Wpcontent']) || isset($_POST['Submit-ARCM-Root-Delete']) || isset($_POST['Submit-ARCM-Wpadmin-Delete']) || isset($_POST['Submit-ARCM-Wpincludes-Delete']) || isset($_POST['Submit-ARCM-Wpcontent-Delete']) || isset($_POST['Submit-ARCM-Root-Restore']) || isset($_POST['Submit-ARCM-Wpadmin-Restore']) || isset($_POST['Submit-ARCM-Wpincludes-Restore']) || isset($_POST['Submit-ARCM-Wpcontent-Restore']) || isset($_POST['Submit-ARCM-Root-Show-Backup']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Backup']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Backup']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Backup']) || isset($_POST['Submit-ARCM-Root-Show-Website']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Website']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Website']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Website']) || isset($_POST['bps-exclude-filter-creator-copy']) || isset($_POST['bps-exclude-filter-creator-write']) || isset($_POST['Submit-ARQ-Add-Remove']) || isset($_POST['Submit-ARQ-Exclude']) || isset($_POST['submit-arq-top-level-search']) || isset($_POST['submit-arq-all-folders-search']) || isset($_POST['submit-arq-specific-folder-search']) || isset($_POST['submit-arq-db-add-remove-search']) || isset($_POST['submit-arq-db-exlude-remove-search']) || isset($_POST['Submit-ARQ-Remove-Added']) || isset($_POST['Submit-ARQ-Remove-Excluded']) ) {
		return;
	}
	
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		$text = __('Backup File Status Check', 'bulletproof-security').'<br>'.__('is Turned Off', 'bulletproof-security');
		echo $text;
		return;
	
	} else {

	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

	foreach ( $iterator as $files ) {
    	if ( $files->isFile() ) {
    	$count++;
		$mtime = date("M d Y H:i:s", $files->getMTime());
		}
	}
	if ( $count <= 4 ) { // should only be 0 files, but leaving a buffer
		$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	} else {
		$text = __('Backup: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$mtime.'</strong></span><br>'.__('Total Backup Files: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$count.'</strong></span>';
		echo $text;
	}
	}
	}
}

// wp-includes ARQ file counter & MTime
function bpsFileCounterWpincludes($source, $count) {
$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
$count = 0;
$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<span class="arq-backup-files"><strong>'.__('GDMW Hosting', 'bulletproof-security').'<br>'.__('wp-includes check is Turned Off', 'bulletproof-security').'</strong></span>';
		echo $text;
		return;
	}	
	
	if ( ! is_dir($source) ) {
	$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	}

	if ( isset($_POST['bpsARCMSubmit']) || isset($_POST['Submit-ARCM-RootNR']) || isset($_POST['Submit-ARCM-Wpadmin']) || isset($_POST['Submit-ARCM-Wpincludes']) || isset($_POST['Submit-ARCM-Wpcontent']) || isset($_POST['Submit-ARCM-Root-Delete']) || isset($_POST['Submit-ARCM-Wpadmin-Delete']) || isset($_POST['Submit-ARCM-Wpincludes-Delete']) || isset($_POST['Submit-ARCM-Wpcontent-Delete']) || isset($_POST['Submit-ARCM-Root-Restore']) || isset($_POST['Submit-ARCM-Wpadmin-Restore']) || isset($_POST['Submit-ARCM-Wpincludes-Restore']) || isset($_POST['Submit-ARCM-Wpcontent-Restore']) || isset($_POST['Submit-ARCM-Root-Show-Backup']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Backup']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Backup']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Backup']) || isset($_POST['Submit-ARCM-Root-Show-Website']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Website']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Website']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Website']) || isset($_POST['bps-exclude-filter-creator-copy']) || isset($_POST['bps-exclude-filter-creator-write']) || isset($_POST['Submit-ARQ-Add-Remove']) || isset($_POST['Submit-ARQ-Exclude']) || isset($_POST['submit-arq-top-level-search']) || isset($_POST['submit-arq-all-folders-search']) || isset($_POST['submit-arq-specific-folder-search']) || isset($_POST['submit-arq-db-add-remove-search']) || isset($_POST['submit-arq-db-exlude-remove-search']) || isset($_POST['Submit-ARQ-Remove-Added']) || isset($_POST['Submit-ARQ-Remove-Excluded']) ) {
		return;
	}

	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		$text = __('Backup File Status Check', 'bulletproof-security').'<br>'.__('is Turned Off', 'bulletproof-security');
		echo $text;
		return;
	
	} else {

	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

	foreach ( $iterator as $files ) {
    	if ( $files->isFile() ) {
    	$count++;
		$mtime = date("M d Y H:i:s", $files->getMTime());
		}
	}
	if ( $count <= 4 ) { // should only be 0 files, but leaving a buffer
		$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	} else {
		$text = __('Backup: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$mtime.'</strong></span><br>'.__('Total Backup Files: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$count.'</strong></span>';
		echo $text;
	}
	}
	}
}

// wp-content ARQ file counter & MTime
function bpsFileCounterWpcontent($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$count = 0;
	
	if ( ! is_dir($source) ) {
	$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	}

	if ( isset($_POST['bpsARCMSubmit']) || isset($_POST['Submit-ARCM-RootNR']) || isset($_POST['Submit-ARCM-Wpadmin']) || isset($_POST['Submit-ARCM-Wpincludes']) || isset($_POST['Submit-ARCM-Wpcontent']) || isset($_POST['Submit-ARCM-Root-Delete']) || isset($_POST['Submit-ARCM-Wpadmin-Delete']) || isset($_POST['Submit-ARCM-Wpincludes-Delete']) || isset($_POST['Submit-ARCM-Wpcontent-Delete']) || isset($_POST['Submit-ARCM-Root-Restore']) || isset($_POST['Submit-ARCM-Wpadmin-Restore']) || isset($_POST['Submit-ARCM-Wpincludes-Restore']) || isset($_POST['Submit-ARCM-Wpcontent-Restore']) || isset($_POST['Submit-ARCM-Root-Show-Backup']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Backup']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Backup']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Backup']) || isset($_POST['Submit-ARCM-Root-Show-Website']) || isset($_POST['Submit-ARCM-Wpadmin-Show-Website']) || isset($_POST['Submit-ARCM-Wpincludes-Show-Website']) || isset($_POST['Submit-ARCM-Wpcontent-Show-Website']) || isset($_POST['bps-exclude-filter-creator-copy']) || isset($_POST['bps-exclude-filter-creator-write']) || isset($_POST['Submit-ARQ-Add-Remove']) || isset($_POST['Submit-ARQ-Exclude']) || isset($_POST['submit-arq-top-level-search']) || isset($_POST['submit-arq-all-folders-search']) || isset($_POST['submit-arq-specific-folder-search']) || isset($_POST['submit-arq-db-add-remove-search']) || isset($_POST['submit-arq-db-exlude-remove-search']) || isset($_POST['Submit-ARQ-Remove-Added']) || isset($_POST['Submit-ARQ-Remove-Excluded']) ) {
		return;
	}

	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		$text = __('Backup File Status Check', 'bulletproof-security').'<br>'.__('is Turned Off', 'bulletproof-security');
		echo $text;
		return;
	
	} else {

	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
	
	foreach ( $iterator as $files ) {
    	if ( $files->isFile() ) {
    	$count++;
		$mtime = date("M d Y H:i:s", $files->getMTime());
		}
	}
	if ( $count <= 0 ) { // should only be 0 files
		$text = '<font color="red"><strong>'.__('File Backup Required', 'bulletproof-security').'<br>'.__('Total Backup Files: ', 'bulletproof-security').$count.'</strong></font>';
		echo $text;
	
	} elseif ( $count > 1500 ) {
	
		$text = __('Backup: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$mtime.'</strong></span><br>'.__('Total Backup Files: ', 'bulletproof-security').'<font color="red"><strong>'.$count.'<br>'.__('The total number of backup files is excessive ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/autorestore-the-total-number-of-backup-files-is-excessive/" target="_blank" title="Link opens in a new Browser window" style="font-size:12px;color:#2ea2cc;">'.__('Click Here', 'bulletproof-security').'</a></strong></font>';
		echo $text;	
	
	} else {
		
		$text = __('Backup: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$mtime.'</strong></span><br>'.__('Total Backup Files: ', 'bulletproof-security').'<span class="arq-backup-files"><strong>'.$count.'</strong></span>';
		echo $text;
	}
	}
	}
}

// FailSafe ARQ Cron Checks - onConfirm popup on Submit checks / messages
if ( current_user_can('manage_options') ) {
$bpsARQFailSafeRoot = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/index.php';
$bpsARQFailSafeWpadmin = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/admin.php';
$bpsARQFailSafeWpincludes = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/functions.php';
$bpsARQFailSafeWpcontent = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/index.php';
$bpsSpacePop = '-------------------------------------------------------------';

	if ( ! file_exists($bpsARQFailSafeRoot) ) {
	$BPSrootFSC = __('Root Files Need To Be Backed Up', 'bulletproof-security');
	} else {
	$BPSrootFSC = '';
	}
	
	if ( ! file_exists($bpsARQFailSafeWpadmin) ) {
	$BPSwpadminFSC = __('wp-admin Files Need To Be Backed Up', 'bulletproof-security');
	} else {
	$BPSwpadminFSC = '';
	}

	if ( ! file_exists($bpsARQFailSafeWpincludes) ) {
	$BPSwpincludesFSC = __('wp-includes Files Need To Be Backed Up', 'bulletproof-security');
	} else {
	$BPSwpincludesFSC = '';
	}
	
	if ( ! file_exists($bpsARQFailSafeWpcontent) ) {
	$BPSwpcontentFSC = __('wp-content Files Need To Be Backed Up', 'bulletproof-security');
	} else {
	$BPSwpcontentFSC = '';
	}
}

// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/autorestore-help-text.php' );
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/arq-backup-files.php' );
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/arq-delete-files.php' );
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/arq-restore-files.php' );

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ AutoRestore|Quarantine ~ ARQ Infinity', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" />
    
<style>
<!--
.bps-spinner {
    visibility:visible;
	position:fixed;
    top:7%;
    left:45%;
 	width:240px;
	background:#fff;
	border:4px solid black;
	padding:2px 0px 4px 8px;   
	z-index:99999;
}
-->
</style> 

    <div id="bps-spinner" class="bps-spinner" style="visibility:hidden;">
    	<img id="bps-img-spinner" src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-spinner.gif'); ?>" style="float:left;margin:0px 20px 0px 0px;" />
        <div id="bps-spinner-text-btn" style="padding:20px 0px 26px 0px;font-size:14px;">Processing...<br><button style="margin:10px 0px 0px 10px;" onclick="javascript:history.go(-1)">Cancel</button>
		</div>
    </div> 
    
<script type="text/javascript">
/* <![CDATA[ */
function ARQRootBackup() {
	
	var r = confirm("Click OK to backup your Root files or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>     
    
<script type="text/javascript">
/* <![CDATA[ */
function ARQwpadminBackup() {
	
	var r = confirm("Click OK to backup your wp-admin files or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>     

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpincludesBackup() {
	
    var r = confirm("Click OK to backup your wp-includes files or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>  

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpcontentBackup() {
	
    var r = confirm("Click OK to backup your wp-content files or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>  

<script type="text/javascript">
/* <![CDATA[ */
function ARQRootDelete() {
	
    var r = confirm("Clicking OK will delete all of your backed up Root AutoRestore files.\n\n-------------------------------------------------------------\n\nTo create new backed up Root AutoRestore files click the Root Backup Files button.\n\n-------------------------------------------------------------\n\nIf you are upgrading WordPress then click OK to delete your Root AutoRestore files. After you have finished upgrading WordPress click the Root Backup Files button to create new backed up Root AutoRestore files before turning the AutoRestore Cron back On.\n\n-------------------------------------------------------------\n\nClick OK to delete Root AutoRestore files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>  

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpadminDelete() {
	
    var r = confirm("Clicking OK will delete all of your backed up wp-admin AutoRestore files.\n\n-------------------------------------------------------------\n\nTo create new backed up wp-admin AutoRestore files click the wp-admin Backup Files button.\n\n-------------------------------------------------------------\n\nIf you are upgrading WordPress then click OK to delete your wp-admin AutoRestore files. After you have finished upgrading WordPress click the wp-admin Backup Files button to create new backed up wp-admin AutoRestore files before turning the AutoRestore Cron back On.\n\n-------------------------------------------------------------\n\nClick OK to delete wp-admin AutoRestore files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpincludesDelete() {
	
    var r = confirm("Clicking OK will delete all of your backed up wp-includes AutoRestore files.\n\n-------------------------------------------------------------\n\nTo create new backed up wp-includes AutoRestore files click the wp-includes Backup Files button.\n\n-------------------------------------------------------------\n\nIf you are upgrading WordPress then click OK to delete your wp-includes AutoRestore files. After you have finished upgrading WordPress click the wp-includes Backup Files button to create new backed up wp-includes AutoRestore files before turning the AutoRestore Cron back On.\n\n-------------------------------------------------------------\n\nClick OK to delete wp-includes AutoRestore files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpcontentDelete() {
	
    var r = confirm("Clicking OK will delete all of your backed up wp-content AutoRestore files.\n\n-------------------------------------------------------------\n\nTo create new backed up wp-content AutoRestore files click the wp-content Backup Files button.\n\n-------------------------------------------------------------\n\nIf you are upgrading WordPress then you DO NOT need to delete your wp-content Backup Files.\n\n-------------------------------------------------------------\n\nClick OK to delete wp-content AutoRestore files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQRootRestore() {
	
    var r = confirm("Clicking OK will restore all of your backed up Root AutoRestore files to your root directory.\n\n-------------------------------------------------------------\n\nClick OK to restore your Root files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpadminRestore() {
	
    var r = confirm("Clicking OK will restore all of your backed up wp-admin AutoRestore files to /wp-admin.\n\n-------------------------------------------------------------\n\nClick OK to restore your wp-admin files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpincludesRestore() {
	
    var r = confirm("Clicking OK will restore all of your backed up wp-includes AutoRestore files to /wp-includes.\n\n-------------------------------------------------------------\n\nClick OK to restore your wp-includes files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpcontentRestore() {
	
    var r = confirm("Clicking OK will restore all of your backed up wp-content AutoRestore files to wp-content.\n\n-------------------------------------------------------------\n\nClick OK to restore your wp-content files now or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQRootShowBackup() {
	
    var r = confirm("Clicking OK will show all of your backed up Root AutoRestore files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script> 

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpadminShowBackup() {
	
    var r = confirm("Clicking OK will show all of your backed up wp-admin AutoRestore files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpincludesShowBackup() {
	
    var r = confirm("Clicking OK will show all of your backed up wp-includes AutoRestore files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpcontentShowBackup() {
	
    var r = confirm("Clicking OK will show all of your backed up wp-content AutoRestore files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQRootShowWebsite() {
	
    var r = confirm("Clicking OK will show all of your Root folder website files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpadminShowWebsite() {
	
    var r = confirm("Clicking OK will show all of your wp-admin folder website files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpincludesShowWebsite() {
	
    var r = confirm("Clicking OK will show all of your wp-includes folder website files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
function ARQwpcontentShowWebsite() {
	
    var r = confirm("Clicking OK will show all of your wp-content folder website files.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
	var img = document.getElementById("bps-spinner"); 	
	
	if (r == true) {

		img.style.visibility = "visible";
	
	} else {
	
		history.go(-1);
	}
}
/* ]]> */
</script>

    </div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('AutoRestore|Quarantine Settings', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-2"><?php _e('Exclude wp-content Folders', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-3"><?php _e('Add|Exclude Other Folders & Files', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-4"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('AutoRestore|Quarantine - ARQ Infinity IDPS Settings', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title"> </td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 0px 0px;"><?php _e('AutoRestore|Quarantine - ARQ Infinity IDPS Settings Help', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('AutoRestore|Quarantine - ARQ Infinity IDPS', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content1; ?></p>
</div>

    </td>
    </tr>
  <tr>
    <td class="bps-table_cell_help">

<table class="widefat" style="margin-bottom:15px;">
<thead>
	<tr>
	<th scope="col" style="width:40%;"><strong><?php _e('AutoRestore|Quarantine ARQ Cron Status: ', 'bulletproof-security'); ?></strong></th>
	<th scope="col" style="width:60%;"><strong><?php _e('AutoRestore|Quarantine ARQ Cron Settings:', 'bulletproof-security'); ?></strong></th>
    </tr>
</thead>
<tbody>
<tr>
	<th scope="row" style="vertical-align:middle;">
    <div class="autorestore-status-text"><h3>
	<?php echo bpsProAutoRestoreOff(); echo bpsProAutoRestoreOn(); ?><br /><?php $text = '<strong><font color="blue">'.__('Click the Read Me help button for help information', 'bulletproof-security').'<br><br>'.__('Recommend Settings: Run ARQ Cron check every 2 minutes, Standard WP Cron and Turn Off Backup File Status Check. These settings have been extensively tested and do not cause any website performance or Server resource usage issues/problems.', 'bulletproof-security').'</font><br><br><font color="black">'.__('ARQ Cron Check Frequency:', 'bulletproof-security').'<br>'.__('1 Minute: 60 file checks per hour maximum', 'bulletproof-security').'<br>'.__('2 Minutes: 30 file checks per hour maximum', 'bulletproof-security').'<br>'.__('3 Minutes: 20 file checks per hour maximum', 'bulletproof-security').'<br>'.__('4 Minutes: 15 file checks per hour maximum', 'bulletproof-security').'<br>'.__('5 Minutes: 12 file checks per hour maximum', 'bulletproof-security').'<br>'.__('10 Minutes: 6 file checks per hour maximum', 'bulletproof-security').'<br>'.__('15 Minutes: 4 file checks per hour maximum', 'bulletproof-security').'<br>'.__('30 Minutes: 2 file checks per hour maximum', 'bulletproof-security').'<br>'.__('60 Minutes: 1 file checks per hour maximum', 'bulletproof-security').'</font></strong>'; echo $text; ?>
    </h3></div></th>
	<td>

<?php
// AutoRestore Values Form
function bpsPro_autorestore_values_form() {
global $bps_topDiv, $bps_bottomDiv;

	if ( isset( $_POST['bpsARCMSubmit'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bpsAutoRestoreValues' );
		
	if ( $_POST['arq_cron'] == 'Off' ) {
		wp_clear_scheduled_hook('bpsPro_AutoRestore_check');
	}
	
	$arq_cron_frequency = $_POST['arq_cron_frequency'];
	
	if ( $arq_cron_frequency == '1' ) {
		$arq_cron_end = time() + 60;	
	}
	if ( $arq_cron_frequency == '2' ) {
		$arq_cron_end = time() + 120;	
	}
	if ( $arq_cron_frequency == '3' ) {
		$arq_cron_end = time() + 180;	
	}
	if ( $arq_cron_frequency == '4' ) {
		$arq_cron_end = time() + 240;	
	}
	if ( $arq_cron_frequency == '5' ) {
		$arq_cron_end = time() + 300;	
	}	
	if ( $arq_cron_frequency == '10' ) {
		$arq_cron_end = time() + 600;	
	}	
	if ( $arq_cron_frequency == '15' ) {
		$arq_cron_end = time() + 900;	
	}	
	if ( $arq_cron_frequency == '30' ) {
		$arq_cron_end = time() + 1800;	
	}	
	if ( $arq_cron_frequency == '60' ) {
		$arq_cron_end = time() + 3600;	
	}	

	$BPS_Options = array(
	'bps_autorestore_cron' 				=> $_POST['arq_cron'], 
	'bps_autorestore_cron_frequency' 	=> $arq_cron_frequency, 
	'bps_autorestore_cron_forced' 		=> $_POST['arq_cron_forced'], 
	'bps_autorestore_cron_override' 	=> $_POST['arq_cron_override'], 
	'bps_autorestore_cron_filecheck' 	=> $_POST['arq_cron_filecheck'], 
	'bps_autorestore_cron_end' 			=> $arq_cron_end
	);	
	
		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_ARCM', $BPS_Options);
		}	

	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('AutoRestore Option settings saved!', 'bulletproof-security').'</strong></font><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
	echo $text;		
	echo $bps_bottomDiv;
	}
}
?>

<div id="bpsARQCron" style="margin:10px 0px 20px 0px;">
    <form name="bpsAutoRestore" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php 
	wp_nonce_field('bpsAutoRestoreValues'); 
	bpsPro_autorestore_values_form(); 
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
?>

<div style="margin-top:20px;"><strong>
<label for="bps-arcm"><?php _e('ARQ Cron Check Frequency:', 'bulletproof-security'); ?></label></strong>
</div>
<select name="arq_cron_frequency" style="width:340px;">
<option value="1"<?php selected('1', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 1 Minute', 'bulletproof-security'); ?></option>
<option value="2"<?php selected('2', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 2 Minutes', 'bulletproof-security'); ?></option>
<option value="3"<?php selected('3', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 3 Minutes', 'bulletproof-security'); ?></option>
<option value="4"<?php selected('4', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 4 Minutes', 'bulletproof-security'); ?></option>
<option value="5"<?php selected('5', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 5 Minutes', 'bulletproof-security'); ?></option>
<option value="10"<?php selected('10', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 10 Minutes', 'bulletproof-security'); ?></option>
<option value="15"<?php selected('15', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 15 Minutes', 'bulletproof-security'); ?></option>
<option value="30"<?php selected('30', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 30 Minutes', 'bulletproof-security'); ?></option>
<option value="60"<?php selected('60', $ARQoptions['bps_autorestore_cron_frequency']); ?>><?php _e('Run ARQ Cron Check Every 60 Minutes', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-arcm"><?php _e('Standard WP Cron or WP Cron with Time Restriction:', 'bulletproof-security'); ?></label></strong><br />
<select name="arq_cron_forced" style="width:340px;">
<option value="1"<?php selected('1', $ARQoptions['bps_autorestore_cron_forced']); ?>><?php _e('Standard WP Cron', 'bulletproof-security'); ?></option>
<option value="2"<?php selected('2', $ARQoptions['bps_autorestore_cron_forced']); ?>><?php _e('WP Cron with Time Restriction', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-arcm"><?php _e('ARQ Cron Override On|Off: Default Setting is Off', 'bulletproof-security'); ?></label></strong><br />
<select name="arq_cron_override" style="width:340px;">
<option value="Off"<?php selected('Off', $ARQoptions['bps_autorestore_cron_override']); ?>><?php _e('Turn Off ARQ Cron Override', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $ARQoptions['bps_autorestore_cron_override']); ?>><?php _e('Turn On ARQ Cron Override', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-arcm"><?php _e('ARQ Backup File Status Check:', 'bulletproof-security'); ?></label></strong><br />
<select name="arq_cron_filecheck" style="width:340px;">
<option value="On"<?php selected('On', $ARQoptions['bps_autorestore_cron_filecheck']); ?>><?php _e('Turn On Backup File Status Check', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $ARQoptions['bps_autorestore_cron_filecheck']); ?>><?php _e('Turn Off Backup File Status Check', 'bulletproof-security'); ?></option>
</select><br /><br />

<strong><label for="bps-arcm"><?php _e('ARQ Cron Check On|Off (AutoRestore On|Off):', 'bulletproof-security'); ?></label></strong><br />
<select name="arq_cron" style="width:340px;">
<option value="On"<?php selected('On', $ARQoptions['bps_autorestore_cron']); ?>><?php _e('Turn On ARQ Cron', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $ARQoptions['bps_autorestore_cron']); ?>><?php _e('Turn Off ARQ Cron', 'bulletproof-security'); ?></option>
</select><br /><br />

<input type="hidden" name="arq_cron_end" value="<?php echo $ARQoptions['bps_autorestore_cron_frequency']; ?>" />

<?php if ( !file_exists($bpsARQFailSafeRoot) || !file_exists($bpsARQFailSafeWpadmin) || !file_exists($bpsARQFailSafeWpincludes) || !file_exists($bpsARQFailSafeWpcontent) ) { ?>

<input type="submit" name="bpsARCMSubmit" value="<?php esc_attr_e('Save ARQ Cron Options', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('CRITICAL WARNING!!!', 'bulletproof-security').'\n\n'.__('You have NOT Backed Up All of your files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.$BPSrootFSC.'\n\n'.$BPSwpadminFSC.'\n\n'.$BPSwpincludesFSC.'\n\n'.$BPSwpcontentFSC.'\n\n'.$bpsSpacePop.'\n\n'.__('CLICK THE CANCEL BUTTON DO NOT TURN ON THE ARQ CRON CHECK UNTIL AFTER YOU HAVE BACKED UP ALL FILES.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('If you accidentally Turn On the ARQ Cron before backing up files the ARQ Cron will automatically be disabled and you will see the ARQ Cron FailSafe Shutdown message displayed in your WP Dashboard.', 'bulletproof-security'); echo $text; ?>')" />

<?php } else { ?>

<input type="submit" name="bpsARCMSubmit" value="<?php esc_attr_e('Save ARQ Cron Options', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('ARQ Cron Safe Turn On Checklist', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('1. Were you allowing a plugin to temporarily write to WordPress files or create new files?', 'bulletproof-security').'\n\n'.__('2. Were you manually editing WordPress files or folders with FTP or your Web Host Control Panel/cPanel?', 'bulletproof-security').'\n\n'.__('3. Did you upload any new files or folders to your website folders?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('If the answer is Yes or you are not sure about any of the questions above then click the Cancel button to close this pop up window and then click the appropriate Backup Files button: Root Files, wp-admin Files, wp-includes Files or wp-content Files. Or click all 4 Backup Files buttons before turning the ARQ Cron back On if you are not sure which folder files were modified in. When in doubt always click the Backup Files buttons before turning the ARQ Cron Check back On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('If the answer is No to all of the questions above then click OK if you are turning the ARQ Cron back On.', 'bulletproof-security'); echo $text; ?>')" />
<?php } ?>
</form>

</div>

</td>
</tr>
</tbody>
</table>

<table class="widefat" style="margin-bottom:15px;">
<thead>
	<tr>
	<th scope="col"><strong><?php _e('AutoRestore|Quarantine', 'bulletproof-security'); ?><br /><?php _e('Controls & Backup Status', 'bulletproof-security'); ?></strong></th>
	<th scope="col"><strong><?php _e('Root Files', 'bulletproof-security'); ?></strong><br /><?php echo @bpsFileCounterRoot($source, $count); ?></th>
	<th scope="col"><strong><?php _e('wp-admin Files', 'bulletproof-security'); ?></strong><br /><?php echo @bpsFileCounterWpadmin($source, $count); ?></th>
	<th scope="col"><strong><?php _e('wp-includes Files', 'bulletproof-security'); ?></strong><br /><?php echo @bpsFileCounterWpincludes($source, $count); ?></th>	
	<th scope="col"><strong><?php _e('wp-content Files', 'bulletproof-security'); ?></strong><br /><?php echo @bpsFileCounterWpcontent($source, $count); ?></th>	    
    </tr>
</thead>
<tbody>
<tr>
	<th scope="row"><?php _e('Backup Files (Quick Setup)', 'bulletproof-security'); ?></th>
	<td> <?php $BPSProOptions = get_option('bulletproof_security_options_ARCM'); ?>  
    
    <form name="bpsAutoRestoreBackupRoot" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_RootNR'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-RootNR" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Backup your Root files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this Root Backup Files button again to be able to backup your Root files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_nonrecursive_copy_root($source, $dest); ?>

<input type="submit" name="Submit-ARCM-RootNR" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQRootBackup()" />
<?php } ?>
</form>    

</td>
	<td>    
    
    <form name="bpsARCMBackupWpadmin" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpadmin'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpadmin" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Backup your wp-admin files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-admin Backup Files button again to be able to backup your wp-admin files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpadmin($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpadmin" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpadminBackup()" />
<?php } ?>
</form>  

</td>
	<td>    
    
    <form name="bpsARCMBackupWpincludes" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpincludes'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpincludes" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Backup your wp-includes files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-includes Backup Files button again to be able to backup your wp-includes files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpincludes($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpincludes" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpincludesBackup()" />
<?php } ?>
</form>  

</td>
	<td>    
    
    <form name="bpsARCMBackupWpcontent" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpcontent'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpcontent" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Backup your wp-content files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-content Backup Files button again to be able to backup your wp-content files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpcontent($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpcontent" value="<?php esc_attr_e('Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpcontentBackup()" />
<?php } ?>
</form>

</td>
</tr>
<tr>
	<th scope="row"><?php _e('Delete Backup Files', 'bulletproof-security'); ?></strong></th>
	<td>    
    
    <form name="ARCM-Delete-All-Files-Root" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_root_delete'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Root-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Delete your Root AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this Root Delete Backup Files button again to be able to delete your Root AutoRestore Backup Files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_rmdirRoot($source); ?>

<input type="submit" name="Submit-ARCM-Root-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQRootDelete()" />
<?php } ?>
</form>

</td>
	<td> 
    
    <form name="ARCM-Delete-All-Files-Wpadmin" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpadmin_delete'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpadmin-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Delete your wp-admin AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-admin Delete Backup Files button again to be able to delete your wp-admin AutoRestore Backup Files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_rmdirWpadmin($source); ?>

<input type="submit" name="Submit-ARCM-Wpadmin-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpadminDelete()" />
<?php } ?>
</form>

</td>
	<td>    
    
    <form name="ARCM-Delete-All-Files-Wpincludes" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpincludes_delete'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpincludes-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Delete your wp-includes AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-includes Delete Backup Files button again to be able to delete your wp-includes AutoRestore Backup Files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_rmdirWpincludes($source); ?>

<input type="submit" name="Submit-ARCM-Wpincludes-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpincludesDelete()" />
<?php } ?>
</form>

</td>
	<td>    
    
    <form name="ARCM-Delete-All-Files-Wpcontent" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpcontent_delete'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpcontent-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Delete your wp-content AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-content Delete Backup Files button again to be able to delete your wp-content AutoRestore Backup Files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_rmdirWpcontent($source); ?>

<input type="submit" name="Submit-ARCM-Wpcontent-Delete" value="<?php esc_attr_e('Delete Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpcontentDelete()" />
<?php } ?>
</form>

</td>
</tr>
<tr>
	<th scope="row"><?php _e('Restore Backup Files', 'bulletproof-security'); ?></th>
	<td>  
    
    <form name="ARCM-Manual-AutoRestore-Root" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_root_restore'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Root-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Restore your Root AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this Root Restore Backup Files button again to be able to restore your Root files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_nonrecursive_copy_root_restore($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Root-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQRootRestore()" />
<?php } ?>
</form>

</td>
    <td>    
    
    <form name="ARCM-Manual-AutoRestore-Wpadmin" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpadmin_restore'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpadmin-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Restore your wp-admin AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-admin Restore Backup Files button again to be able to restore your /wp-admin files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpadmin_restore($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpadmin-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpadminRestore()" />
<?php } ?>
</form>

</td>
    <td>    
    
    <form name="ARCM-Manual-AutoRestore-Wpincludes" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpincludes_restore'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpincludes-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Restore your wp-includes AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-includes Restore Backup Files button again to be able to restore your /wp-includes files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpincludes_restore($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpincludes-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpincludesRestore()" />
<?php } ?>
</form>

</td>
	<td>    
    
    <form name="ARCM-Manual-AutoRestore-Wpcontent" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpcontent_restore'); ?>

<?php if ( $BPSProOptions['bps_autorestore_cron'] == 'On' ) { ?>

<input type="submit" name="Submit-ARCM-Wpcontent-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('The AutoRestore|Quarantine Cron is On.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The AutoRestore|Quarantine Cron MUST be turned Off before you can Restore your wp-content AutoRestore Backup Files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the Cancel button to close this pop up window, turn Off the AutoRestore Cron and then click this wp-content Restore Backup Files button again to be able to restore your wp-content files.', 'bulletproof-security'); echo $text; ?>')" />

<?php } if ( ! $BPSProOptions['bps_autorestore_cron'] || $BPSProOptions['bps_autorestore_cron'] == 'Off' ) { ?>
<?php bps_arcm_recursive_copy_wpcontent_restore($source, $dest); ?>

<input type="submit" name="Submit-ARCM-Wpcontent-Restore" value="<?php esc_attr_e('Restore Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpcontentRestore()" />
<?php } ?>
</form>

</td>
</tr>
<tr>
	<th scope="row"><?php _e('Show Backup Files', 'bulletproof-security'); ?></th>
	<td>    
    
    <form name="ARCM-Show-root-Backup-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_root_show_backup'); ?>
	<input type="submit" name="Submit-ARCM-Root-Show-Backup" value="<?php esc_attr_e('Show Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQRootShowBackup()" />
</form>

</td>
	<td>
    
    <form name="ARCM-Show-wpadmin-Backup-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpadmin_show_backup'); ?>
	<input type="submit" name="Submit-ARCM-Wpadmin-Show-Backup" value="<?php esc_attr_e('Show Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpadminShowBackup()" />
</form>

</td>
	<td>   
    
    <form name="ARCM-Show-wpincludes-Backup-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpincludes_show_backup'); ?>
	<input type="submit" name="Submit-ARCM-Wpincludes-Show-Backup" value="<?php esc_attr_e('Show Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpincludesShowBackup()" />
</form>

</td>
	<td>    
    
    <form name="ARCM-Show-wpcontent-Backup-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpcontent_show_backup'); ?>
	<input type="submit" name="Submit-ARCM-Wpcontent-Show-Backup" value="<?php esc_attr_e('Show Backup Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpcontentShowBackup()" />
</form>

</td>
</tr>
<tr>
	<th scope="row"><?php _e('Show Website Files', 'bulletproof-security'); ?></th>
	<td>    
    
    <form name="ARCM-Show-root-Website-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_root_show_website'); ?>
	<input type="submit" name="Submit-ARCM-Root-Show-Website" value="<?php esc_attr_e('Show Website Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQRootShowWebsite()" />
</form>

</td>
	<td>    
    
    <form name="ARCM-Show-wpadmin-Website-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpadmin_show_website'); ?>
	<input type="submit" name="Submit-ARCM-Wpadmin-Show-Website" value="<?php esc_attr_e('Show Website Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpadminShowWebsite()" />
</form>

</td>
	<td>    
    
    <form name="ARCM-Show-wpincludes-Website-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpincludes_show_website'); ?>
	<input type="submit" name="Submit-ARCM-Wpincludes-Show-Website" value="<?php esc_attr_e('Show Website Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpincludesShowWebsite()" />
</form>

</td>
	<td>   
    
    <form name="ARCM-Show-wpcontent-Website-Files" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php" method="post">
<?php wp_nonce_field('bulletproof_security_ARCM_wpcontent_show_website'); ?>
	<input type="submit" name="Submit-ARCM-Wpcontent-Show-Website" value="<?php esc_attr_e('Show Website Files', 'bulletproof-security') ?>" class="button bps-button" onclick="ARQwpcontentShowWebsite()" />
</form>

</td>
</tr>
</tbody>
</table>

<?php
if ( isset( $_POST['Submit-ARCM-Root-Show-Backup'] ) || isset( $_POST['Submit-ARCM-Wpadmin-Show-Backup'] ) || isset( $_POST['Submit-ARCM-Wpincludes-Show-Backup'] ) || isset( $_POST['Submit-ARCM-Wpcontent-Show-Backup'] ) ) {
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/arq-show-backup-files.php' );
}

if ( isset( $_POST['Submit-ARCM-Root-Show-Website'] ) || isset( $_POST['Submit-ARCM-Wpadmin-Show-Website'] ) || isset( $_POST['Submit-ARCM-Wpincludes-Show-Website'] ) || isset( $_POST['Submit-ARCM-Wpcontent-Show-Website'] ) ) {
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/autorestore/arq-show-website-files.php' );
}
?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom"> </td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('Exclude wp-content Folders Under The wp-content Folder ONLY', 'bulletproof-security'); ?></h2>

<?php
	// Form - ARQ Exclude Class Filter Creator - step 2 Copy new class.php file
    if ( isset( $_POST['bps-exclude-filter-creator-copy'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_exclude_filter_copy' );
	
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileBAK = WP_PLUGIN_DIR . '/bulletproof-security/includes/class-BAK.php';	
	$bpsClassFileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/includes/class.php';		
	$bpsClassFileARQBAK = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/includes/class-BAK.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';
			
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
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

			$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('ARQ FailSafe Procedural Shutdown', 'bulletproof-security').'</font><br>'.__('This procedural ARQ FailSafe Shutdown happens when ARQ is turned On and you are creating Exclude Rules.', 'bulletproof-security').'<br>'.__('This FailSafe ensures that no files are accidentally sent to Quarantine while you are creating your Exclude Rules.', 'bulletproof-security').'<br>'.__('Once you have completed creating your Exclude Rules you can turn ARQ back On.', 'bulletproof-security').'<br>'.__('If you are going to manually modify any of your website files be sure to click the appropriate ARQ Backup Files button before turning ARQ back On.', 'bulletproof-security').'</div>';
			echo $text;

	if ( file_exists($bpsClassFile) ) {
		@copy($bpsClassFileBAK, $bpsClassFile);		
		@copy($bpsClassFileBAK, $bpsClassFileARQBAK);
	if ( ! copy($bpsClassFileBAK, $bpsClassFile)) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('Error: Failed to Create Filters!', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		echo '</p></div>';
   	} else {
		@copy($bpsClassFile, $bpsClassFileARQ);
		@copy($bpsClassFile, $bpsClassFileARQMB);
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="green"><strong>'.__('Filters Created Successfully. Scroll down and click the 3. Exclude Folders Now button to exclude your folders from being checked by ARQ.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
	}	
	}
	}

	// Form - ARQ Exclude Class Filter Creator - step 3 the String Replace
    if ( isset( $_POST['bps-exclude-filter-creator-write'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_exclude_filter_write' );   
	
	$options = get_option('bulletproof_security_options_exclude_folder');
	$bpsexclude_input_1 = $options['bpsexclude_input_1'];
	$bpsexclude_input_2 = $options['bpsexclude_input_2'];
	$bpsexclude_input_3 = $options['bpsexclude_input_3'];
	$bpsexclude_input_4 = $options['bpsexclude_input_4'];	
	$bpsexclude_input_5 = $options['bpsexclude_input_5'];	
	$bpsexclude_input_6 = $options['bpsexclude_input_6'];	
	$bpsexclude_input_7 = $options['bpsexclude_input_7'];	
	$bpsexclude_input_8 = $options['bpsexclude_input_8'];
	$bpsexclude_input_9 = $options['bpsexclude_input_9'];	
	$bpsexclude_input_10 = $options['bpsexclude_input_10'];		
	$bpsexclude_input_11 = $options['bpsexclude_input_11'];
	$bpsexclude_input_12 = $options['bpsexclude_input_12'];
	$bpsexclude_input_13 = $options['bpsexclude_input_13'];
	$bpsexclude_input_14 = $options['bpsexclude_input_14'];	
	$bpsexclude_input_15 = $options['bpsexclude_input_15'];	
	$bpsexclude_input_16 = $options['bpsexclude_input_16'];	
	$bpsexclude_input_17 = $options['bpsexclude_input_17'];	
	$bpsexclude_input_18 = $options['bpsexclude_input_18'];
	$bpsexclude_input_19 = $options['bpsexclude_input_19'];	
	$bpsexclude_input_20 = $options['bpsexclude_input_20'];		

	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';	

	if ( file_exists($bpsClassFile) ) {
		$stringReplace = @file_get_contents($bpsClassFile);
	if ( $bpsexclude_input_1 != '' ) {
		$stringReplace = str_replace("bps-hard-exclude001", $bpsexclude_input_1, $stringReplace);
	}
	if ( $bpsexclude_input_2 != '' ) {
		$stringReplace = str_replace("bps-hard-exclude002", $bpsexclude_input_2, $stringReplace);
	}
	if ( $bpsexclude_input_3 != '' ) {
		$stringReplace = str_replace("bps-hard-exclude003", $bpsexclude_input_3, $stringReplace);
	}
	if ( $bpsexclude_input_4 != '' ) {		
		$stringReplace = str_replace("bps-hard-exclude004", $bpsexclude_input_4, $stringReplace);
	}
	if ( $bpsexclude_input_5 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude005", $bpsexclude_input_5, $stringReplace);
	}
	if ( $bpsexclude_input_6 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude006", $bpsexclude_input_6, $stringReplace);
	}
	if ( $bpsexclude_input_7 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude007", $bpsexclude_input_7, $stringReplace);
	}
	if ( $bpsexclude_input_8 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude008", $bpsexclude_input_8, $stringReplace);
	}
	if ( $bpsexclude_input_9 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude009", $bpsexclude_input_9, $stringReplace);
	}
	if ( $bpsexclude_input_10 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude010", $bpsexclude_input_10, $stringReplace);
	}
	if ( $bpsexclude_input_11 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude011", $bpsexclude_input_11, $stringReplace);
	}
	if ( $bpsexclude_input_12 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude012", $bpsexclude_input_12, $stringReplace);
	}
	if ( $bpsexclude_input_13 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude013", $bpsexclude_input_13, $stringReplace);
	}
	if ( $bpsexclude_input_14 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude014", $bpsexclude_input_14, $stringReplace);
	}
	if ( $bpsexclude_input_15 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude015", $bpsexclude_input_15, $stringReplace);
	}
	if ( $bpsexclude_input_16 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude016", $bpsexclude_input_16, $stringReplace);
	}
	if ( $bpsexclude_input_17 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude017", $bpsexclude_input_17, $stringReplace);
	}
	if ( $bpsexclude_input_18 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude018", $bpsexclude_input_18, $stringReplace);
	}
	if ( $bpsexclude_input_19 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude019", $bpsexclude_input_19, $stringReplace);
	}
	if ( $bpsexclude_input_20 != '' ) {	
		$stringReplace = str_replace("bps-hard-exclude020", $bpsexclude_input_20, $stringReplace);
	}
		file_put_contents($bpsClassFile, $stringReplace);
		@copy($bpsClassFile, $bpsClassFileARQ);
		@copy($bpsClassFile, $bpsClassFileARQMB);
	if ( ! file_put_contents($bpsClassFile, $stringReplace) ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('Error: Exclude Folders Now Failed!', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		echo '</p></div>';
   	} else {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="green"><strong>'.__('Your Folders Have been Excluded Successfully!', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
	}	
	}
	}
?>
<div id="DynamicExcludeMessage" style="position:relative; top:0px; left:0px; float:left; margin:0px 0px 0px 0px;">
<?php
	if ( @$_GET['settings-updated'] == true ) {
		$text = '<font color="blue"><strong>'.__('After you have clicked the 1. Save to DB button, click the 2. Create Filter button and then click the 3. Exclude Folders Now button.', 'bulletproof-security').'</strong></font>';
		echo $text;
}

// Check if exclude folder path contains wp-content & the folder exists under the wp-content folder
function bpsARQExcludePathWPContentCheck() {
$options = get_option('bulletproof_security_options_exclude_folder');
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);

$ExcludePaths = array( $options['bpsexclude_input_1'], $options['bpsexclude_input_2'], $options['bpsexclude_input_3'], $options['bpsexclude_input_4'], $options['bpsexclude_input_5'], $options['bpsexclude_input_6'], $options['bpsexclude_input_7'], $options['bpsexclude_input_8'], $options['bpsexclude_input_9'], $options['bpsexclude_input_10'], $options['bpsexclude_input_11'], $options['bpsexclude_input_12'], $options['bpsexclude_input_13'], $options['bpsexclude_input_14'], $options['bpsexclude_input_15'], $options['bpsexclude_input_16'], $options['bpsexclude_input_17'], $options['bpsexclude_input_18'], $options['bpsexclude_input_19'], $options['bpsexclude_input_20'] );

	foreach ( $ExcludePaths as $ExcludePath ) {
		$pos = strpos( $ExcludePath, $bps_wpcontent_dir );
		
		if ( $pos !== false ) {
			echo '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><p>';
			$text = '<strong><font color="red">'.__('Error: Exclude paths should not contain ', 'bulletproof-security').$bps_wpcontent_dir.__(' in the exclude path.', 'bulletproof-security').'</font><br>'.$ExcludePath.__(' contains ', 'bulletproof-security').$bps_wpcontent_dir.__(' in the exclude path. Delete ', 'bulletproof-security').$bps_wpcontent_dir.__(' from the exclude path and click the Save To DB button again. Click the Read Me help button to see examples of valid folder exclude paths.', 'bulletproof-security').'</strong><br>';
			echo $text;
			echo '</p></div>';		
		}
	
		if ( ! is_dir( WP_CONTENT_DIR .'/'. $ExcludePath ) ) {	
			echo '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><p>';
			$text = '<strong><font color="red">'.__('Error: Incorrect Folder Exclude rule detected', 'bulletproof-security').'</font><br>'.$ExcludePath.__(' is not a valid folder name/path or does not exist under the wp-content folder.', 'bulletproof-security').'<br>'.__('Click the Read Me help button to see examples of valid folder exclude rules/paths.', 'bulletproof-security').'</strong><br>';
			echo $text;
			echo '</p></div>';			
		}
	}
}
echo bpsARQExcludePathWPContentCheck();

?>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title"> </td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Exclude wp-content Folders', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('Exclude wp-content Folders', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content2; ?></p>         
</div>

<form name="bps-exclude-folders-form-DB" action="options.php#bps-tabs-2" method="post">
			<?php settings_fields('bulletproof_security_options_exclude_folder'); ?>
			<?php $options2 = get_option('bulletproof_security_options_exclude_folder'); ?>

<div id="BPSExcludeTable" style="height:300px;overflow:auto; border-bottom:1px solid black;">

<table class="widefat" style="margin-bottom:15px;">
<thead>
	<tr>
	<th scope="col" style="width:20%;"><strong><?php _e('Label|Description', 'bulletproof-security'); ?></strong></th>
	<th scope="col" style="width:80%;"><strong><?php $text = __('This tool is ONLY designed to exclude folders under the wp-content folder from being checked by ARQ.', 'bulletproof-security').'<br>'.__('Click the Read Me help button above for correct usage and examples.', 'bulletproof-security'); echo $text; ?></strong></th>
    </tr>
</thead>
<tbody>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_1_label]" value="<?php echo $options2['bpsexclude_input_1_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_1]" value="<?php echo trim($options2['bpsexclude_input_1'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_2_label]" value="<?php echo $options2['bpsexclude_input_2_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_2]" value="<?php echo trim($options2['bpsexclude_input_2'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_3_label]" value="<?php echo $options2['bpsexclude_input_3_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_3]" value="<?php echo trim($options2['bpsexclude_input_3'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_4_label]" value="<?php echo $options2['bpsexclude_input_4_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_4]" value="<?php echo trim($options2['bpsexclude_input_4'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_5_label]" value="<?php echo $options2['bpsexclude_input_5_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_5]" value="<?php echo trim($options2['bpsexclude_input_5'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_6_label]" value="<?php echo $options2['bpsexclude_input_6_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_6]" value="<?php echo trim($options2['bpsexclude_input_6'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_7_label]" value="<?php echo $options2['bpsexclude_input_7_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_7]" value="<?php echo trim($options2['bpsexclude_input_7'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_8_label]" value="<?php echo $options2['bpsexclude_input_8_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_8]" value="<?php echo trim($options2['bpsexclude_input_8'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_9_label]" value="<?php echo $options2['bpsexclude_input_9_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_9]" value="<?php echo trim($options2['bpsexclude_input_9'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_10_label]" value="<?php echo $options2['bpsexclude_input_10_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_10]" value="<?php echo trim($options2['bpsexclude_input_10'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr> 
  <tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_11_label]" value="<?php echo $options2['bpsexclude_input_11_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_11]" value="<?php echo trim($options2['bpsexclude_input_11'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_12_label]" value="<?php echo $options2['bpsexclude_input_12_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_12]" value="<?php echo trim($options2['bpsexclude_input_12'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_13_label]" value="<?php echo $options2['bpsexclude_input_13_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_13]" value="<?php echo trim($options2['bpsexclude_input_13'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_14_label]" value="<?php echo $options2['bpsexclude_input_14_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_14]" value="<?php echo trim($options2['bpsexclude_input_14'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_15_label]" value="<?php echo $options2['bpsexclude_input_15_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_15]" value="<?php echo trim($options2['bpsexclude_input_15'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_16_label]" value="<?php echo $options2['bpsexclude_input_16_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_16]" value="<?php echo trim($options2['bpsexclude_input_16'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_17_label]" value="<?php echo $options2['bpsexclude_input_17_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_17]" value="<?php echo trim($options2['bpsexclude_input_17'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_18_label]" value="<?php echo $options2['bpsexclude_input_18_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_18]" value="<?php echo trim($options2['bpsexclude_input_18'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_19_label]" value="<?php echo $options2['bpsexclude_input_19_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_19]" value="<?php echo trim($options2['bpsexclude_input_19'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_20_label]" value="<?php echo $options2['bpsexclude_input_20_label']; ?>" style="width:90%; padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options_exclude_folder[bpsexclude_input_20]" value="<?php echo trim($options2['bpsexclude_input_20'], " \t\n/"); ?>" style="width:400px; background-color:#FFFFFF;padding:4px; margin-top:2px;" /></td>
</tr>
</tbody>
</table>
</div>

<p class="submit" style="float:left; margin:0px 10px 0px 0px;">
    <!-- <input type="hidden" name="custommessage" value="$custommessage" /> -->
    <input type="submit" name="bps-exclude-folders-form-DB" class="button bps-button" value="<?php esc_attr_e('1. Save To DB', 'bulletproof-security') ?>" />
</p>
</form>

<form name="bps-exclude-filter-creator-form-copy" id="bps-exclude-filter-creator-form-copy" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_exclude_filter_copy'); ?>
<p class="submit" style="float:left; margin:0px 25px 0px 0px;">
	<input type="submit" name="bps-exclude-filter-creator-copy" class="button bps-button" value="<?php esc_attr_e('2. Create Filter', 'bulletproof-security') ?>" />
</p>
</form>

<form name="bps-exclude-filter-creator-form-write" id="bps-exclude-filter-creator-form-write" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_exclude_filter_write'); ?>
<p class="submit" style="margin:0px 0px 0px 0px;">
	<input type="submit" name="bps-exclude-filter-creator-write" class="button bps-button" value="<?php esc_attr_e('3. Exclude Folders Now', 'bulletproof-security') ?>" />
</p>
<?php $text = '<div style="padding:0px 0px 10px 0px;"><strong>'.__('NOTE: All 3 buttons must be clicked in order 1, 2 and 3. After clicking button 1 click buttons 2 & 3.', 'bulletproof-security').'</strong></div>'; echo $text; ?>
</form>

    </td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom"> </td>
  </tr>
</table>
</div>

<div id="bps-tabs-3" class="bps-tab-page">
<h2><?php _e('Add|Exclude Other Folders & Files', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title"> </td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Add|Exclude Other Folders & Files', 'bulletproof-security'); ?>  <button id="bps-open-modal3" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content3" title="<?php _e('Add|Exclude Other Folders & Files', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content3; ?></p>
</div>

<table class="widefat" style="margin-bottom:15px;">
<thead>
	<tr>
	<th scope="col"><strong><?php _e('Add & Exclude Uses:', 'bulletproof-security'); ?></strong></th>
	<th scope="col"><strong><?php _e('Add Folders & Files:', 'bulletproof-security'); ?></strong><br /><?php echo '<span class="arq-backup-files">'.__('For non-WordPress Folders & Files (ONLY)', 'bulletproof-security').'</span>'; ?></th>
	<th scope="col"><strong><?php _e('Exclude Folders & Files:', 'bulletproof-security'); ?></strong><br /><?php echo '<span class="arq-backup-files">'.__('For WordPress Folders & Files (ONLY)', 'bulletproof-security').'</span>'; ?></th>
    </tr>
</thead>
<tbody>
<tr>
	<th scope="row"><?php $text = '<strong>'.__('Add Folders & Files Use:', 'bulletproof-security').'</strong><br>'.__('You can add additional non-WordPress folders and files (ONLY) that you want to have checked and protected by the ARQ Infinity Cron. Click the Read Me help button for examples.', 'bulletproof-security').'<br><br><strong>'.__('Exclude Folders & Files Use:', 'bulletproof-security').'</strong><br>'.__('You can exclude WordPress folders and files (ONLY) that you DO NOT want to have checked and protected by the ARQ Infinity Cron. Click the Read Me help button for examples.', 'bulletproof-security'); echo $text; ?></th>
	<td>

<?php
// Create ARQ Add DB Table - as of 3.1 the register_activation_hook is not called when a plugin is updated
function bps_arq_add_table_install() {
global $wpdb;
global $bulletproof_security_arq_db_version;
$table_name = $wpdb->prefix . "bpspro_arq_add";
      
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) ) != $table_name ) {

	$sql = "CREATE TABLE $table_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  arq_add_dir text NOT NULL,
  arq_add_source text NOT NULL,
  arq_add_backup text NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}
}

// Form ARQ Add Folders & Files - Create the /added-files folder, mkdir and copy folders and files - insert Added file paths into DB
if ( ! isset( $_POST['Submit-ARQ-Add-Remove'] ) )
    $chosenARQAdd = array(0);
	else
    if ( isset( $_POST['Submit-ARQ-Add-Remove'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_add_remove' );   
	    $chosenARQAdd = $_POST['arqAddRemove'];
		global $wpdb;
		set_time_limit(300); // 250 + 30 = 280 leaving a 20 second buffer	
    
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/', 0755 );
	}
	
	// Create the ARQ Add Database Table
	bps_arq_add_table_install();

		$source = trim( stripslashes( $_POST['arq-source-path-add'] ) );
		$NewDir = basename( dirname($source . '/.' ) );
		$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/'.$NewDir;
		$table_name = $wpdb->prefix . "bpspro_arq_add";
		
	if ( $_POST['arqAddRemove'] == array(1) ) {
		
		 if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir, 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir, 0755 );
		}
		
		if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isDir() )	{
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				@copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
				$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_add_dir' => $source, 'arq_add_source' => $file, 'arq_add_backup' => $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName() ) );
			}
		}
		$text = '<font color="green">'.$source.__(' has been Added to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/added-files successfully.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		} else {
		copy($source, $dest);
		}		
	}
		
		if ( $_POST['arqAddRemove'] == array(2) ) {
		
		if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir, 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $NewDir, 0755 );
		}

		if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		
		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				copy($file->getPathname(), $dest.DIRECTORY_SEPARATOR.$file->getFilename());
				$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_add_dir' => $source, 'arq_add_source' => $file->getPathname(), 'arq_add_backup' => $dest.DIRECTORY_SEPARATOR.$file->getFilename() ) );
			}
			
		}
		$text = '<font color="green">'.$source.__(' has been Added to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/added-files successfully.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		}	
	}
		
		if ( $_POST['arqAddRemove'] == array(3) ) {
		
		$path_parts = pathinfo($source);
		$filename = $path_parts['basename'];
		// $dirname = $path_parts['dirname']; do not use this otherwise all other files will be quarantined if not added
		$destFile = WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/' . $filename;
		$none = 'NODIRSINGLEFILE';
		
		if ( file_exists($source) && ! file_exists($destFile) ) {
			copy($source, $destFile);
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_add_dir' => $none, 'arq_add_source' => $source, 'arq_add_backup' => $destFile ) );
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green">'.$source.__(' has been Added to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/added-files successfully.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		} else {
		$destFile = WP_CONTENT_DIR . '/bps-backup/autorestore/added-files/'.date("M-d-Y--H-i-s").'--'.$filename;
			copy($source, $destFile);			
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_add_dir' => $none, 'arq_add_source' => $source, 'arq_add_backup' => $destFile ) );	
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green">'.$source.__(' has been Added to: ', 'bulletproof-security').$destFile.__(' successfully. A file with the exact same file name was found in the /added-files backup folder. Your backed up file has been renamed so that it did NOT overwrite the existing backed up file with the same exact file name.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		}
		} // end array 3
} // end if isset

// Dropdown list array for ARQ Add Form		
function bps_showOptionsDropARQ1($array, $active, $echo=true) {
	$string = '';
	foreach ( $array as $k => $v ) {
	if ( is_array($active) )
	$s = ( in_array($k, $active)) ? ' selected="selected"' : '';
	else
	$s = ( $active == $k ) ? ' selected="selected"' : '';
	$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}
	if ($echo)   echo $string;
	else        return $string;
}

$arqAddRemove = array(' Select An Add Option:', 'Add Top Level Folder - All Subfolders & All Files Are Added', 'Add A Specific Folder - All Files In A Specific Folder Are Added', 'Add An Individual File - A Single File Is Added');

// Form ARQ Exclude Folders & Files - Add Excluded WordPress file paths to DB - DB row entry is source path, not backup path
if ( ! isset( $_POST['Submit-ARQ-Exclude'] ) )
    $chosenARQExclude = array(0);
	else
    if ( isset( $_POST['Submit-ARQ-Exclude'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_exclude' );   
	    $chosenARQExclude = $_POST['arqExclude'];
		global $wpdb;

		$source = trim( stripslashes( $_POST['arq-source-path-exclude'] ) );
		$table_name = $wpdb->prefix . "bpspro_arq_exclude";
		
	if ( $_POST['arqExclude'] == array(1) ) {
		
		if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isDir() ) {
				// no need to add directory paths ONLY file paths are needed
			} else {
				$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $file ) );
			}
		}
		$text = '<font color="green">'.$source.__(' folder and all subfolders and files have been Excluded successfully.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		} else {
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="red"><strong>'.$source.__(' is not a valid folder path.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		}	
	}
		
		if ( $_POST['arqExclude'] == array(2) ) {
		
		if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		
		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $source.DIRECTORY_SEPARATOR.$file ) );
			}
			
		}
		$text = '<font color="green">'.$source.__(' folder and all files in this folder have been Excluded successfully.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		} else {
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="red"><strong>'.$source.__(' is not a valid folder path.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		}	
	}
		
		if ( $_POST['arqExclude'] == array(3) ) {
		
		if ( file_exists($source) ) {
			$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $source ) );
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green">'.$source.__(' has been Excluded successfully and will NOT be checked by the ARQ Cron.', 'bulletproof-security').'</font>';
		echo $text;
		echo '</p></div>';
		} else {
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="red"><strong>'.$source.__(' is not a valid file path.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		}
		} // end array 3
} // end if isset

// Dropdown list array for ARQ Exclude Form		
function bps_showOptionsDropARQ2($array, $active, $echo=true) {
	$string = '';
	foreach ( $array as $k => $v ) {
	if ( is_array($active) )
	$s = ( in_array($k, $active) ) ? ' selected="selected"' : '';
	else
	$s = ( $active == $k ) ? ' selected="selected"' : '';
	$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}
	if ($echo)   echo $string;
	else        return $string;
}

$arqExclude = array(' Select An Exclude Option:', 'Exclude Top Level Folder - All Subfolders & All Files Are Excluded', 'Exclude A Specific Folder - All Files In A Specific Folder Are Excluded', 'Exclude An Individual File - A Single File Is Excluded');

?>

<div id="bpsARQCronAdd" style="margin:10px 0px 10px 0px;">

<form name="ARQ-Add-Remove" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_arq_add_remove'); ?>
    <strong><label for="arq-add"><?php _e('Select Folder or File Add Option:', 'bulletproof-security'); ?> </label></strong><br />
	<select name="arqAddRemove[]" id="arqAddRemove" style="width:340px;" >
	<?php echo bps_showOptionsDropARQ1($arqAddRemove, $chosenARQAdd, true); ?>
	</select><br /><br />
    <strong><label for="arq-add"><?php _e('Enter an Add Folder or File Path:', 'bulletproof-security'); ?></label></strong><br />
    <strong><label for="arq-add"><?php _e('Click the Read Me Help button for examples', 'bulletproof-security'); ?></label></strong><br />
    <input type="text" name="arq-source-path-add" class="regular-text" style="width:340px; background-color:#FFFFFF;" value="" /><br /><br />
    <input type="submit" name="Submit-ARQ-Add-Remove" value="<?php esc_attr_e('Add', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('For non-WordPress Folders & Files ONLY', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Clicking OK will copy the non-WordPress folders and files for whatever path you entered in the Enter an Add Folder or File Path text box to the /added-files backup folder and these folders and files will now be checked by the ARQ Cron.', 'bulletproof-security').'\n\n'.__('To remove these files from being checked by the ARQ Cron, use the Remove Added Folders|Files Search tool to search for and remove these files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Add non-WordPress folders or files or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

</div>

</td>
	<td>

<div id="bpsARQCronExclude" style="margin:10px 0px 10px 0px;">

<form name="ARQ-Exclude" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_arq_exclude'); ?>
    <strong><label for="arq-exclude"><?php _e('Select Folder or File Exclude Option:', 'bulletproof-security'); ?> </label></strong><br />
	<select name="arqExclude[]" id="arqExclude" style="width:340px;" >
	<?php echo bps_showOptionsDropARQ2($arqExclude, $chosenARQExclude, true); ?>
	</select><br /><br />
    <strong><label for="arq-exclude"><?php _e('Enter an Exclude Folder or File Path:', 'bulletproof-security'); ?></label></strong><br />
    <strong><label for="arq-add"><?php _e('Click the Read Me Help button for examples', 'bulletproof-security'); ?></label></strong><br />    
    <input type="text" name="arq-source-path-exclude" class="regular-text" style="width:340px; background-color:#FFFFFF;" value="" /><br /><br />
    <input type="submit" name="Submit-ARQ-Exclude" value="<?php esc_attr_e('Exclude', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('For WordPress Folders & Files ONLY', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Clicking OK will exclude any WordPress folders and files for whatever path you entered in the Enter an Exclude Folder or File Path text box from being checked by the ARQ Cron.', 'bulletproof-security').'\n\n'.__('To remove files from being excluded from the ARQ Cron check, use the Remove Excluded Folders|Files Search tool to search for and remove these excluded files.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Exclude WordPress folders or files or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

</div>

</td>
</tr>
</tbody>
</table> 

<?php
	// DB Search Table Forms - DB Remove Added and DB Remove Excluded Search
	echo '<table class="widefat" style="margin-bottom:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:20%;"><strong>'.__('Remove Folders & Files', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:80%;"><strong>'.__('ARQ DB Search For Folder Names or Filenames to Remove From DB:', 'bulletproof-security').'</strong><br>'.__('Hint: A search using only a single forward slash '.'"'.'/'.'"'.' will show all database search results', 'bulletproof-security').'<br>'.__('Hint: A search for the folder or file name '.'"'.'orange'.'"'.' will show all folders and files that are named orange', 'bulletproof-security').'</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	echo '<th scope="row" style="border-bottom:none;">'.__('Remove Added Folders|Files Search', 'bulletproof-security').'</th>';
	echo '<td>';
	echo '<form name="bpsSearchDBAddRemove" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_arq_db_search_added');
	echo '<input type="text" name="arqAddSearch" class="regular-text" style="width:500px; background-color:#FFFFFF;" value="" />';
	echo '<input type="submit" name="submit-arq-db-add-remove-search" value="'.esc_attr('Search', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</td>';
	echo '</tr>';	
	echo '<tr>';
	echo '<th scope="row" style="border-bottom:none;">'.__('Remove Excluded Folders|Files Search', 'bulletproof-security').'</th>';
	echo '<td>';
	echo '<form name="bpsSearchDBExludeRemove" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_arq_db_search_excluded');
	echo '<input type="text" name="arqExcludeSearch" class="regular-text" style="width:500px; background-color:#FFFFFF;" value="" />';
	echo '<input type="submit" name="submit-arq-db-exlude-remove-search" value="'.esc_attr('Search', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';		
	echo '</td>';
	echo '</tr>';	
	echo '</tbody>';
	echo '</table>';	
	echo '</p></div>';

	// File & Folder Search Table Forms - Show Top Level Tables, folders and files
	echo '<table class="widefat" style="margin-bottom:20px;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:20%;"><strong>'.__('Folder & File Search Tool', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:80%;"><strong>'.__('Find Folder Name & File Name Paths:', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	echo '<th scope="row" style="border-bottom:none;">'.__('Show ONLY Top Level Folders', 'bulletproof-security').'</th>';
	echo '<td>';
	echo '<form name="bpsSearchTopLevelFolders" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_arq_top_level_search');
	echo '<input type="submit" name="submit-arq-top-level-search" value="'.esc_attr('Show Folders', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</td>';
	echo '</tr>';	
	echo '<tr>';
	echo '<th scope="row" style="border-bottom:none;">'.__('Show ALL Folders<br>Top Level & Subfolders', 'bulletproof-security').'</th>';
	echo '<td>';
	echo '<form name="bpsSearchAllFolders" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_arq_all_folders_search');
	echo '<input type="submit" name="submit-arq-all-folders-search" value="'.esc_attr('Show Folders', 'bulletproof-security').'" class="button bps-button" style="margin-top:10px;" />';
	echo '</form>';
	echo '</td>';
	echo '</tr>';	
	echo '<tr>';
	echo '<th scope="row" style="border-bottom:none;">'.__('Search a Specific Folder<br>For All Files in That Folder', 'bulletproof-security').'</th>';
	echo '<td>';
	echo '<form name="bpsSearchSpecificFolder" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_arq_specific_folder_search');
    echo '<strong><label for="arq-search">'.__('Example Search: /xxxxx/xxxxx/foldername', 'bulletproof-security').'</label></strong><br>';
	echo '<input type="text" name="arqSpecificFolderSearch" class="regular-text" style="width:500px; background-color:#FFFFFF;" value="" />';
	echo '<input type="submit" name="submit-arq-specific-folder-search" value="'.esc_attr('Search', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';		
	echo '</td>';
	echo '</tr>';	
	echo '</tbody>';
	echo '</table>';	
	echo '</p></div>';
?>

<?php 
// bpsSearchTopLevelFolders Form - Show ONLY Top Level Folders 
if ( isset( $_POST['submit-arq-top-level-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_top_level_search' );
	
	$source = $_SERVER['DOCUMENT_ROOT'];

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);
			
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Top Level Folder Name', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:70%;"><strong>'.__('Top Level Folder Path', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Last Modified', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		foreach ( $iterator as $files ) {
			if ( $files->isDir() && ! $files->isDot() ) {
			echo '<th scope="row" style="border-bottom:none;">'.$files.'</th>';
			echo '<td>'.$files->getPathname().'</td>';
	    	echo '<td>'.date("M d Y H:i:s", $files->getMTime()).'</td>';
			echo '</tr>';	
			}
		}
		echo '</tbody>';
		echo '</table>';	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="green">'.__('Your Search Results are displayed below the Folder & File Search tool.', 'bulletproof-security').'</font><br>';
	echo $text;
	echo '</p></div>';		
	}
}

// bpsSearchAllFolders Form - Show All Folders - Top Level and Subfolders 
if ( isset( $_POST['submit-arq-all-folders-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_all_folders_search' );
	
	$source = $_SERVER['DOCUMENT_ROOT'];
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);		
		
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Folder|Subfolder Name', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:70%;"><strong>'.__('Folder|Subfolder Path', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Last Modified', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $iterator as $files ) {
			if ( $files->isDir() ) {
			echo '<th scope="row" style="border-bottom:none;">'.$iterator->getSubPathName().'</th>';
			echo '<td>'.$files->getPathname().'</td>';
	    	echo '<td>'.date("M d Y H:i:s", $files->getMTime()).'</td>';
			echo '</tr>';	
			}
		}
		echo '</tbody>';
		echo '</table>';	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="green">'.__('Your Search Results are displayed below the Folder & File Search tool.', 'bulletproof-security').'</font><br>';
	echo $text;
	echo '</p></div>';		
	}
}

// bpsSearchSpecificFolder Form - Search a specific folder for all files in that folder 
if ( isset( $_POST['submit-arq-specific-folder-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_specific_folder_search' );
	
	$source = $_POST['arqSpecificFolderSearch'];

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);
			
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Filename', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:60%;"><strong>'.__('Folder Path|', 'bulletproof-security').$source.'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Last Modified', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('File Size|bytes', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		foreach ( $iterator as $files ) {
			if ( $files->isFile() ) {

			echo '<th scope="row" style="border-bottom:none;">'.$files->getFilename().'</th>';
			echo '<td>'.$files->getPathname().'</td>';
	    	echo '<td>'.date("M d Y H:i:s", $files->getMTime()).'</td>';
			echo '<td>'.$files->getSize().' bytes'.'</td>'; 
			echo '</tr>';	
			}
		}
		echo '</tbody>';
		echo '</table>';	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="green">'.__('Your Search Results are displayed below the Folder & File Search tool.', 'bulletproof-security').'</font><br>';
	echo $text;
	echo '</p></div>';		
		} else {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="red"><strong>'.__('You did not enter a valid folder path. Valid Folder Path Example: /xxxxx/xxxxx/foldername', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	echo '</p></div>';	
	}
}

// Get the Search Post variable for processing other ARQ remove Added folders and files forms 
if ( isset( $_POST['submit-arq-db-add-remove-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_db_search_added' );
	
	$bpspro_arq_add_table = $wpdb->prefix . "bpspro_arq_add";
	$search = $_POST['arqAddSearch'];
}

// Remove Added files form proccessing code
if ( isset( $_POST['Submit-ARQ-Remove-Added'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_arq_remove_added');
	
	$removeornot = $_POST['removeornot'];
	$bpspro_arq_add_table = $wpdb->prefix . "bpspro_arq_add";
	
	switch( $_POST['Submit-ARQ-Remove-Added'] ) {
		case __('Remove', 'bulletproof-security'):
		
		$remove_rows = array();
		
		if ( ! empty($removeornot) ) {
			foreach ( $removeornot as $key => $value ) {
				if ( $value == 'remove' ) {
					$remove_rows[] = $key;
				} elseif ( $value == 'donotremove' ) {
					$donotremove .=  ', '.$key;
				}
				}
			}
			$donotremove = substr($donotremove, 2); // add the comma and space from ', '.$key between each donotremove file
		
		if ( ! empty($remove_rows) ) {
			foreach ( $remove_rows as $remove_row ) {
				unlink($remove_row);
				$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_add_table WHERE arq_add_backup = %s", $remove_row));
				$textDBAddRemove = '<font color="green">'.sprintf(__('%s has been deleted from the backup folder and removed from your DB.', 'bulletproof-security'), $remove_row).'</font><br>';
			}
		}
		
		if ( ! empty($donotremove) ) {
		// do nothing here - do not echo a message because it would be repeated X times
		//$textDB = '<font color="green">'.sprintf(__('DB Rows %s Not Removed', 'bulletproof-security'), $donotremove).'</font>';
		}
		break;
	}
}
?>

<?php if ( ! empty($textDBAddRemove) ) { echo '<!-- Last Action --><div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>'.$textDBAddRemove.'</p></div>'; } ?>

<form name="bpsARQDBRadio" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_arq_remove_added'); ?>
<?php	
	$bpspro_arq_add_table = $wpdb->prefix . "bpspro_arq_add";
	$search = @$_POST['arqAddSearch'];
	
	if ( isset( $_POST['submit-arq-db-add-remove-search'] ) && $search != '' ) {

	$getARQAddTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_add_table WHERE arq_add_backup LIKE %s", "%$search%" ) );

		echo '<h3>'.__('Search Results For Added Files To Remove', 'bulletproof-security').'</h3>';	
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Filename in DB', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Do Not<br>Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:56%;"><strong>'.__('The Added File Path in DB|Backed Up File Path', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Time Added<br>To DB', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getARQAddTable as $row ) {
    	$path_parts = pathinfo($row->arq_add_backup);
		$filename = $path_parts['basename'];
		
		echo '<th scope="row" style="border-bottom:none;">'.$filename.'</th>';
		echo "<td><input type=\"radio\" id=\"remove\" name=\"removeornot[$row->arq_add_backup]\" value=\"remove\" /></td>";
		echo "<td><input type=\"radio\" id=\"donotremove\" name=\"removeornot[$row->arq_add_backup]\" value=\"donotremove\" checked /></td>";
		echo '<td>'.$row->arq_add_backup.'</td>';		
		echo '<td>'.$row->time.'</td>'; 
		echo '</tr>';			
		}
		echo '</tbody>';
		echo '</table>';	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="green">'.__('Your DB Search Results For Added Files To Remove are displayed below the DB Search tool.', 'bulletproof-security').'</font><br>';
	echo $text;
	echo '</p></div>';

?>
<input type="submit" name="Submit-ARQ-Remove-Added" value="<?php _e('Remove', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will Remove the DB entry for any Added file where you have selected the Remove Radio button and also delete the Added file that you no longer want checked by the ARQ Cron. ONLY backed up / Added ARQ files are deleted. To add a file or folder back to ARQ Cron checking, use the Add Folders & Files tool.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to remove your Remove choices or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form><br />
<?php } ?>

<?php
// Remove Exluded files from DB - removing files from being excluded will allow the ARQ Cron to check the file again
if ( isset( $_POST['submit-arq-db-exlude-remove-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_arq_db_search_excluded' );
	
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$search = $_POST['arqExcludeSearch'];
}

if ( isset( $_POST['Submit-ARQ-Remove-Excluded'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_arq_remove_excluded');
	
	$removeornot = $_POST['removeornot'];
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	
	switch( $_POST['Submit-ARQ-Remove-Excluded'] ) {
		case __('Remove', 'bulletproof-security'):
		
		$remove_rows = array();
		
		if ( ! empty($removeornot) ) {
			foreach ( $removeornot as $key => $value ) {
				if ( $value == 'remove' ) {
					$remove_rows[] = $key;
				} elseif ( $value == 'donotremove' ) {
					$donotremove .=  ', '.$key;
				}
				}
			}
			$donotremove = substr($donotremove, 2); // add the comma and space from ', '.$key between each donotremove file
		
		if ( ! empty($remove_rows) ) {
			foreach ( $remove_rows as $remove_row ) {
				$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_exclude_table WHERE arq_exclude_source = %s", $remove_row ) );
				$textDBExclude = '<font color="green">'.sprintf(__('%s has been removed from being excluded and will be checked again by the ARQ Cron.', 'bulletproof-security'), $remove_row).'</font><br>';
			}
		}
		if ( ! empty($donotremove) ) {
		// do nothing here - do not echo a message because it would be repeated X times
		//$textDB = '<font color="green">'.sprintf(__('DB Rows %s Not Removed', 'bulletproof-security'), $donotremove).'</font>';
		}
		break;
	}
}
?>

<?php if ( ! empty($textDBExclude) ) { echo '<!-- Last Action --><div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>'.$textDBExclude.'</p></div>'; } ?>

<form name="bpsARQDBRadioExlude" action="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_arq_remove_excluded'); ?>
<?php	
	$bpspro_arq_exclude_table = $wpdb->prefix . "bpspro_arq_exclude";
	$search = @$_POST['arqExcludeSearch'];
	
	if ( isset( $_POST['submit-arq-db-exlude-remove-search'] ) && $search != '' ) {
	//if ($search != '') {
	$getARQExcludeTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_exclude_table WHERE arq_exclude_source LIKE %s", "%$search%" ) );

		echo '<h3>'.__('Search Results For Excluded Files To Remove From DB', 'bulletproof-security').'</h3>';	
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Filename in DB', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Do Not<br>Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:56%;"><strong>'.__('The Excluded File Path in DB', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Time Added<br>To DB', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getARQExcludeTable as $row ) {
    	$path_parts = pathinfo($row->arq_exclude_source);
		$filename = $path_parts['basename'];
		
		echo '<th scope="row" style="border-bottom:none;">'.$filename.'</th>';
		echo "<td><input type=\"radio\" id=\"remove\" name=\"removeornot[$row->arq_exclude_source]\" value=\"remove\" /></td>";
		echo "<td><input type=\"radio\" id=\"donotremove\" name=\"removeornot[$row->arq_exclude_source]\" value=\"donotremove\" checked /></td>";
		echo '<td>'.$row->arq_exclude_source.'</td>';		
		echo '<td>'.$row->time.'</td>'; 
		echo '</tr>';			
		}
		echo '</tbody>';
		echo '</table>';	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	$text = '<font color="green">'.__('Your DB Search Results For Excluded Files To Remove from being excluded are displayed below the DB Search tool.', 'bulletproof-security').'</font><br>';
	echo $text;
	echo '</p></div>';

?>
<input type="submit" name="Submit-ARQ-Remove-Excluded" value="<?php _e('Remove', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will Remove the DB entry for any Excluded files where you have selected the Remove Radio button. By removing the file path from being Excluded you are telling the ARQ Cron to check the file again. To exclude a file or folder again from being checked by the ARQ Cron, use the Exclude Folders & Files tool.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to remove your Remove choices or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form><br />
<?php } ?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom"> </td>
  </tr>
</table>
</div>

<div id="bps-tabs-4" class="bps-tab-page">
<h2><?php _e('Help & FAQ', 'bulletproof-security'); ?></h2>

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
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/autorestore-quarantine-guide-read-me-first/" target="_blank"><?php _e('AutoRestore|Quarantine Guide & Troubleshooting', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"></td>
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

<div id="AITpro-link">BulletProof Security Pro <?php echo BULLETPROOF_VERSION; ?> Plugin by <a href="http://forum.ait-pro.com/" target="_blank" title="AITpro Website Security">AITpro Website Security</a> | 

</div>
</div>
</div>
<style>
<!--
.bps-spinner {visibility:hidden;}
-->
</style>
</div>