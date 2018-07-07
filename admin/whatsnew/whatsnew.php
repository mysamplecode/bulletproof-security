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

// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR);
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('Whats New and General Help Info & Tips', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
            <li><a href="#bps-tabs-1"><?php _e('Whats New and General Help Info & Tips', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1">

<h2><?php $text = __('Whats New in ', 'bulletproof-security'). BULLETPROOF_VERSION .__(' and General Help Info & Tips', 'bulletproof-security'); echo $text; ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-whats_new_table">
  <tr>
   <td width="1%" class="bps-table_title_no_border">&nbsp;</td>
   <td width="99%" class="bps-table_title_no_border">&nbsp;</td>
  </tr>

  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h2><strong>'.__('General Help Info & Tips:', 'bulletproof-security').'</strong></h2>'; echo $text; ?></td>
  </tr>
   <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('BPS Pro Video Tutorials|Setup Wizard: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/video-tutorials/" target="_blank" title="BPS Pro Video Tutorials">BPS Pro Video Tutorials</a></strong>'; echo $text; ?></td>
  </tr>   
   <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('Troubleshooting Steps & The BPS Pro Security Log: ', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/read-me-first-pro/#bps-pro-general-troubleshooting" target="_blank" title="BPS Pro Troubleshooting Steps">Troubleshooting Steps</a></strong><br>'.__('All BPS Pro plugin features can be turned Off/On individually to confirm, eliminate or isolate a problem or issue that may or may not be caused by BPS Pro. ', 'bulletproof-security').'<br><strong><a href="http://forum.ait-pro.com/video-tutorials/#security-log-firewall" target="_blank" title="BPS Pro Security Log Video Tutorial">Security Log Video Tutorial</a></strong><br>'.__('The BPS Pro Security Log is a primary troubleshooting tool. If BPS Pro is blocking something legitimate in another plugin or theme then a Security Log entry will be logged for exactly what is being blocked. A whitelist rule can then be created to allow a plugin or theme to do what it needs to do without being blocked.', 'bulletproof-security').'<br><strong><a href="http://forum.ait-pro.com/forums/forum/bulletproof-security-pro/" target="_blank" title="BPS Pro Security Forum">BPS Pro Security Forum</a></strong><br>'.__('Search the Forum site to see if a known issue or problem is already posted with a solution/whitelist rule in the Forum.', 'bulletproof-security'); echo $text; ?></td>
  </tr>   
   <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('Real Time Alerts|Self-Healing|Wizards: ', 'bulletproof-security').'</strong>'.__('BPS Pro checks everything in real time so there is no need to worry about forgetting to set something up or setting something up incorrectly. If something is not set up or is set up incorrectly you will see an alert or warning about what needs to be done to correct the problem. Displayed alerts and warnings have a Click Here link to take you to the page that needs attention. BPS Pro also has self-healing capability to automatically correct issues/problems. The Pre-Installation Wizard and Setup Wizard can be re-run again at any time.', 'bulletproof-security'); echo $text; ?></td>
  </tr>
   <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
   <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('BPS Pro Updates|Upgrades: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-bps-pro-upgrade-installation-methods/" target="_blank" title="BPS Pro Upgrade Installation Methods">Upgrade Installation Methods</a></strong><br>'.__('. When upgrading BPS Pro, BPS Pro plugin files are updated/upgraded & some database settings may be updated if necessary in some BPS Pro version releases. BPS Pro updates/upgrades do not change any of your personal settings. ', 'bulletproof-security'); echo $text; ?></td>
  </tr>
   <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('ini_set Options|php.ini Files: ', 'bulletproof-security').'</strong>'.__('The ini_set Options can be used as an alternative to creating a custom php.ini file or .user.ini file (if your PHP version is PHP5.3.x or above) or in addition to creating a custom php.ini file or .user.ini file (if your PHP version is PHP5.3.x or above).', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('PHP Errors|PHP Error Log: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/how-to-troubleshoot-php-errors-php-errors-in-your-php-error-log/" target="_blank" title="How to Troubleshoot PHP Errors">How to Troubleshoot PHP Errors</a></strong><br>'.__('. PHP Errors are a normal thing that can occur on all websites intermittently. PHP errors may have been already occurring on your website before you installed BPS Pro, but you were not being alerted about them. BPS logs PHP errors in a static PHP error log text file and you are alerted about these PHP errors when they occur. It is recommended that you contact plugin and theme authors about PHP errors that are occurring in those plugins and themes and being logged by BPS. If you do not want to be alerted about PHP errors then you can turn PHP error log alerts off on the S-Monitor page by setting this Option: ', 'bulletproof-security').'<strong>'.__('PHP Error Log: New Errors in The PHP Error Log Alerts', 'bulletproof-security').'</strong>'.__(' to Turn Off Displayed Alerts.', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('S-Monitor Recommendations: ', 'bulletproof-security').'</strong>'.__('It is recommended that you choose to display all alerts in your WP Dashboard instead of displaying alerts only in BPS pages with the exception of: ', 'bulletproof-security').'<strong>'.__('Security Log: New Log Entry Has Been Logged Alerts', 'bulletproof-security').'</strong>,'.__(' which should be set to Turned Off or display in BPS Pro pages only. These days an average site is attacked at least once per minute. BPS Pro is already handling blocking attacks so you do not need to see Security Log alerts all day long to tell you that BPS Pro is doing its job. You can turn the Security Log alerts On as needed for troubleshooting purposes and then turn Security Log alerts Off after you are done troubleshooting.', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('AutoRestore|Quarantine (ARQ IDPS) ARQ Guide Link & General Tips: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/autorestore-quarantine-guide-read-me-first/" target="_blank" title="AutoRestore|Quarantine Guide">AutoRestore|Quarantine Guide</a></strong><br>'.__('AutoRestore|Quarantine Intrusion Detection and Prevention System (ARQ IDPS) is a real time file monitor that monitors all of your website files for any changes or modifications and will autorestore and/or quarantine if file changes are detected. ARQ IDPS is completely automated and seamless when upgrading WordPress, Plugins or Themes from within your WordPress Dashboard. See the AutoRestore|Quarantine Guide link above for procedural steps when manually modifying files or folders or installing files or folders from a remote location/3rd party application. ARQ needs to be turned Off when working with files or folders manually or remotely. When working with files or folders manually see the ', 'bulletproof-security').'<strong>'.__('AutoRestore|Quarantine Correct Usage', 'bulletproof-security').'</strong>'.__(' help section in the ARQ Guide link above. ARQ does not monitor your WordPress Database so that means creating Posts, Pages and Comments are not monitored by ARQ. ARQ does not monitor your WordPress /uploads folder. Your WordPress uploads folder is protected by the Uploads Anti-Exploit Guard (UAEG).', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('BPS Pro Affiliate Program: ', 'bulletproof-security').'<a href="http://affiliates.ait-pro.com/" target="_blank" title="BPS Pro Affiliate Program">'.__('BPS Pro Affiliate Program', 'bulletproof-security').'</a></strong><br>'.__('BPS Pro has an Affiliate Program. Affiliate commission payout is 25% of each referral sale. Payouts are made in a rolling 30 day period.', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<strong>'.__('BPS Pro Version Release Dates &amp; Whats New: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank" title="BPS Pro Version Release Dates &amp; Whats New">'.__('Version Release Dates &amp; Whats New', 'bulletproof-security').'</a></strong><br>'.__('View BPS Pro version release dates, history and Whats New changelog for all BPS Pro version releases.', 'bulletproof-security'); echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h2><strong>'.__('Whats New in BPS Pro ', 'bulletproof-security').$bpspro_version.'</strong></h2>'; echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Core Improvements|Enhancements: AutoRestore (ARQ) Automation', 'bulletproof-security').'</strong></h3>'.__('The Core functionality of ARQ Automation is still the same. Improvements|Enhancements and additional Theme upgrade and installation automation handling were added for both standard single site and Network|Multisite installations of WordPress. The displayed BPS Pro AutoRestore (ARQ) Automatic Shutdown & Backup Notice has been changed. The ARQ successful completion Notice has been changed. WordPress Automatic update Security Log logging minor format|text changes.', 'bulletproof-security').'<br><br>'.__('&bull; WordPress Automatic updates: AutoRestore automatically handles background WordPress Automatic updates seamlessly. No further action is required by you.<br>&bull; Manually upgrading WordPress by clicking the update now link on the WordPress Updates page: AutoRestore automatically handles this seamlessly. No further action is required by you.<br>&bull; Manually upgrading or installing a Theme on the WordPress Updates page or Themes page: Requires one click by you to allow ARQ Automation to continue and complete.<br>&bull; Manually upgrading a Plugin on the WordPress Updates page: Requires one click by you to allow ARQ Automation to continue and complete.', 'bulletproof-security').'<h3><strong>'.__('10.2 BPS Pro AutoRestore (ARQ) Automatic Shutdown & Backup Notice displayed on the WordPress Updates page', 'bulletproof-security').'</strong></h3>'; echo $text; ?>
	<img src="<?php echo plugins_url('/bulletproof-security/admin/images/arq-shutdown-backup-notice.png'); ?>" style="" />
   <?php $text = '<h3><strong>'.__('10.2 BPS Pro ARQ successful completion Notice on the WordPress About page', 'bulletproof-security').'</strong></h3>'; echo $text; ?>
    <img src="<?php echo plugins_url('/bulletproof-security/admin/images/arq-backup-complete-notice.png'); ?>" style="" />
</td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Login Security New Option and Core Functionality Improvements', 'bulletproof-security').'</strong></h3>'.__('<strong>New Option Attempts Remaining:</strong> You can choose to display a "Login Attempts Remaining X" message when an incorrect password is entered. X is the total number of login attempts left/remaining before the User Account is locked. This new option is enabled by default during BPS Pro upgrades and new installations.', 'bulletproof-security').'<br><br>'.__('<strong>Core Functionality Improvements:</strong> When a User Account is locked out and previous User Account logins were logged|stored in the DB, those previously logged logins and data for those DB Rows is not changed|updated and instead a new DB Row is inserted. This allows for better chronological login tracking and monitoring. Affects both Logging Options - Log All Account Logins and Log Only Account Lockouts options and allows for switching between these Logging Options without affecting functionality or causing issues/problems.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Bonus Custom Code|Bonus Custom Code Dismiss Notice function Consolidation', 'bulletproof-security').'</strong></h3>'.__('<strong>Bonus Custom Code Dismiss Notice Consolidation:</strong> Combined|consolidated all Bonus Custom Code Notices into 1 Bonus Custom Code Notice function with 1 displayed Notice message instead of having several different displayed Notices. Each Bonus Custom Code contains a link to the Bonus Custom Code and a Dismiss Notice link.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/block-referer-spammers-semalt-kambasoft-ranksonic-buttons-for-website/" target="_blank" title="Referer Spammers|Phishing Protection">'.__('Referer Spammers|Phishing Protection', 'bulletproof-security').'</a><br><a href="http://forum.ait-pro.com/forums/topic/mime-sniffing-data-sniffing-content-sniffing-drive-by-download-attack-protection/" target="_blank" title="Mime Sniffing, Data Sniffing, Content Sniffing, Drive-by Download Attack Protection">'.__('Mime Sniffing, Data Sniffing, Content Sniffing, Drive-by Download Attack Protection', 'bulletproof-security').'</a><br><a href="http://forum.ait-pro.com/forums/topic/rssing-com-good-or-bad/" target="_blank" title="External iFrame and Clickjacking Protection">'.__('External iFrame and Clickjacking Protection', 'bulletproof-security').'</a>'; echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Core Addition:  New Heads Up Static Alert Checks: /plugins/index.php Code Injection file check &  /uploads/index.php file check', 'bulletproof-security').'</strong></h3>'.__('These are known common hacking attack vectors. Both of these attack vectors are already protected against by UAEG and the Plugin Firewall. These additional checks are more for detection|EP|EW|alerting purposes. Checks the /uploads folder for an index.php file. The /uploads folder does not have an index.php by default. Check the /plugins folder index.php file for Code Injections.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('BugFixes|Code Corrections|Enhancements|Misc|CSS|Visual|Other:', 'bulletproof-security').'</strong></h3>'.__('&bull; System Info page conditional check added for: gc_enabled & gc_collect_cycles functions.<br>&bull; WP Toolbar Functionality In BPS Plugin Pages: Default Network/Multisite menu items (nodes) added.<br>&bull; DB Backup: Backup Files Download|Delete Form scrollable table added and additional Read Me help information added.<br>&bull; POST Forms Undefined index php errors in BPS Pro Status Display function.<br>&bull; Undefined offset php error in P-Security Diagnostic Checks.<br>&bull; WP 4.2 Bug Reported|Ticket created with POC and solution provided: ', 'bulletproof-security').'<a href="https://core.trac.wordpress.org/ticket/31758" target="_blank" title="WP 4.2 hash anchor Bug">'.__('WP 4.2 hash anchor Bug', 'bulletproof-security').'</a>'.__(' Hash anchors were being stripped of URI\'s. Solution provided to WP folks. Solution implemented by WP folks. No other issues or problems found with WP 4.2 and BPS Pro versions.<br>&bull; WP flush_rewrite_rules function added to BPS Pro plugin uninstall function. Creates new default generic WP root htaccess file on BPS Pro plugin uninstall.<br>&bull; Dismiss Notice link correction when basename == wp-admin on first Dashboard login.<br>&bull; Setup Wizard:  Additional Activation Key valid|invalid check (CSS|js) Error message with animated arrow gif.', 'bulletproof-security'); echo $text; ?>
     </td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h2><strong>'.__('Whats New in BPS Pro 10.1', 'bulletproof-security').'</strong></h2>'; echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('BugFixes|Code Corrections|Enhancements|Misc|CSS|Visual|Other:', 'bulletproof-security').'</strong></h3>'.__('&bull; Dismiss Notice button element problem in Firefox and IE. Dismiss Notice buttons/links not being processed. Replaced button element code with pseudo button code.<br>&bull; System Info file and folder permissions recommendations correction.<br>&bull; System Info additional Read Me help text added for Script Owner User ID (UID)|File Owner User ID.<br>&bull; Plugin Firewall error check text correction.', 'bulletproof-security'); echo $text; ?>
     </td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h2><strong>'.__('Whats New in BPS Pro 10', 'bulletproof-security').'</strong></h2>'; echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h2><strong>'.__('Primary Technical Focus: ', 'bulletproof-security').'</strong><br><span style="font-size:14px;font-weight:bold;">'.__('Performance Optimization|Enhancements | Plugin Impact|Footprint Reduction | Increased Automation | UI|UX Visual Enhancements|Visual Uniformity', 'bulletproof-security').'</span><br><strong>'.__('Plain English: ', 'bulletproof-security').'</strong><br><span style="font-size:14px;font-weight:bold;">'.__('BPS Pro 10 performs faster overall, has less overall impact on memory usage and resources, has new additional automated self-repairing|self-configuring functionality and is visually more appealing.', 'bulletproof-security').'</span></h2>'; echo $text; ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Setup Wizard:  Visual|Functionality Enhancements | New Tab Page: Setup Wizard Options', 'bulletproof-security').'</strong></h3>'.__('New Processing Spinner with Cancel button displayed during setup processing. Memory usage and script completion time displayed on completion of processing. The Setup Wizard options have been moved from the main Setup Wizard page to a new Tab page. Success|Fail|Notice verifications for the Pre-Installation Wizard and Setup Wizard are displayed in scrollable tables. Pre-Installation Wizard default cURL scan change from 250 Posts/Pages to 50 Posts/Pages. Inpage help text moved to a new Pre-Installation Wizard & Setup Wizard Read Me help button.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Plugin Firewall: Increased Automation', 'bulletproof-security').'</strong></h3>'.__('Additional automated self-healing|self-repairing|self-configuring capabilities added. The Plugin Firewall will automatically detect whitelist rule errors, attempt to correct those errors automatically and if they are not correctable the Plugin Firewall will display an error message that whitelist rules need to be corrected and automatically deactivate itself to prevent any website problems. Your saved whitelist rules will not be deleted. An error message will be displayed with an exact description of what the problem is with the whitelist rule or rules that need to be corrected. Accordion button names, Title, Form Labels, CSS and HTML structure improvements.
', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Features|Functionality|Visual Enhancements: S-Monitor Dashboard Status Display', 'bulletproof-security').'</strong></h3>'.__('New image bullets have been added to the Dashboard Status Display as spacers instead of the previous pipe operators. Visually this is much more appealing. The Dashboard Status Display performs checks and displays the status of BPS Pro features, options and your site security in real-time. The Dashboard Status Display automatically turns itself off when a Form is submitted using POST and displays a Reload BPS Pro Status Display button. Automatically turning off the Status Display during Form processing is a performance enhancement|optimization. Clicking the Reload BPS Pro Status Display button reloads|displays the Dashboard Status Display again. Pre-existing functionality: Display individual status checks or all status checks in your WP Dashboard, BPS Pro plugin pages only or turned off.', 'bulletproof-security'); echo $text;	?>
	<img src="<?php echo plugins_url('/bulletproof-security/admin/images/dashboard-status-display.png'); ?>" style="" />
</td>
  </tr>  
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Features|Options|Visual Enhancements: UI|UX|Theme Skin | Processing Spinner | WP Toolbar', 'bulletproof-security').'</strong></h3>'.__('Overall UI|UX visual enhancements throughout BPS Pro 10 have been made. The 3 Theme Skins in BPS Pro 10 are now uniform (CSS and HTML) and visually much more appealing.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Feature|Option: Turn On|Off The Processing Spinner', 'bulletproof-security').'</strong></h3>'.__('The Processing Spinner is displayed during processing of the Forms listed below. The Processing Spinner includes a Cancel button to cancel the Form processing. The Processing Spinner can be turned off if you do not want to see it. If the Processing Spinner is not displaying correctly or at all then either your theme or another plugin is interfering with it. Since the Processing Spinner is just a visual enhancement it is not critical that it is being displayed.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('Forms That Display The Processing Spinner', 'bulletproof-security').'</strong></h3>'.__('Pre-Installation Wizard, Setup Wizard, DB Backup Job Processing, DB Table Names & Character Length Table, DB Table Prefix Changer, Quarantine Restore or Delete Files, DB Diff Small to Medium Data|File Comparison, DB Diff Large Data|File Comparison, Upload Zip Install: File Upload, P-Security Diagnostic Checks|Recommendations, AutoRestore: All Backup Files Forms, All Delete Files Forms, All Restore Files Forms, All Show Backup Files Forms and All Show Website Files Forms, Pro-Tools: String|Function Finder, String Replacer|Remover, DB String Finder and cURL Scan.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Feature|Option: WP Toolbar Functionality In BPS Plugin Pages', 'bulletproof-security').'</strong></h3>'.__('This option affects the WP Toolbar in BPS plugin pages ONLY and does not affect the WP Toolbar anywhere else on your site. WP Toolbar additional menu items (nodes) added by other plugins and themes can cause problems for BPS when the WP Toolbar is loaded in BPS plugin pages. This option allows you to load only the default WP Toolbar without any additional menu items (nodes) loading/displayed on BPS plugin pages or to load the WP Toolbar with any/all other menu items (nodes) that have been added by other plugins and themes.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Feature: Memory Usage and Script Completion Time Check|Display', 'bulletproof-security').'</strong></h3>'.__('Displays the total memory used and script completion time for the Forms|Pages listed below.', 'bulletproof-security').'<br>'.__('Peak Memory Usage: 20.85MB|21,354KB', 'bulletproof-security').'<br>'.__('Initial Memory in Use: 20.46MB|20,947KB', 'bulletproof-security').'<br>'.__('Total Memory Used: 0.40MB|407KB', 'bulletproof-security').'<br>'.__('Backup Job Completion Time: 0.04 Seconds', 'bulletproof-security').'<br><br><strong>'.__('Forms|Pages: ', 'bulletproof-security').'</strong>'.__('System Info, Setup Wizard: Pre-Installation Wizard, Setup Wizard, DB Backup:  DB Backup Job Processing, DB Table Names & Character Length Table, DB Table Prefix Changer, Quarantine:  Restore or Delete Files, DB Montitor: DB Diff Small to Medium Data|File Comparison, DB Diff Large Data|File Comparison, Upload Zip Install: File Upload, P-Security: Diagnostic Checks|Recommendations, AutoRestore: All Backup Files Forms, All Delete Files Forms, All Restore Files Forms, All Show Backup Files Forms and All Show Website Files Forms, Pro-Tools: String|Function Finder, String Replacer|Remover, DB String Finder and cURL Scan.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Features|Options|Visual Enhancements: DB Backup & Security', 'bulletproof-security').'</strong></h3>'.__('Overall UI|UX visual enhancements. New table created for Create Backup Jobs option settings. Download buttons are now displayed for downloadable zip backup files instead of plain links. The new Processing Spinner and memory usage and script completion time check is displayed when performing backups, creating a new DB Table Prefix and when processing the DB Table Names & Character Length Table Form. Memory usage and script completion time logged in the DB Backup Log. Backup Job Name logged in the DB Backup Log.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Feature|Option: Create Backup Jobs: Rename|Create|Reset Tool', 'bulletproof-security').'</strong></h3>'.__('Allows you to change/rename the DB Backup folder name.  You can either use the automated randomly generated new DB Backup folder name or create your own folder name.  If you have DB Backup files they will not be affected/changed. The DB Backup File Download Link|URL path will also be changed and have the new DB Backup folder name in the URL path. The Rename|Create|Reset Tool can also be used for troubleshooting problems with the automatic BPS DB Backup folder creation.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('System Info: New Check Added | Changes', 'bulletproof-security').'</strong></h3>'.__('DSO|CGI folder|file permission checks moved from B-Core Security Status page. Additional folder checks added. Additional Script Owner User ID (UID) and File Owner User ID checks added. MISC Additional Checks removed (obsolete). Check Headers Tool removed (redundant - Website Headers tool exists in Pro-Tools). New Garbage Collector On|Off and Cycles check added. Memory usage and script completion time check and display. The Dashboard Status Display is automatically turned Off by default on the System Info page.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('B-Core: Security Status Page Changes', 'bulletproof-security').'</strong></h3>'.__('DSO|CGI folder|file permission checks moved to System Info page. General BulletProof Security File Checks removed (obsolete).', 'bulletproof-security'); echo $text; ?>
</td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('BPS Pro Submenu Name Change:', 'bulletproof-security').'</strong></h3>'.__('UI Theme Skin submenu name has been changed to: UI|UX|Theme Skin | Processing Spinner | WP Toolbar', 'bulletproof-security'); echo $text; ?>
</td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('New Dismiss Notice: LiteSpeed Server|Plugin Firewall Notice', 'bulletproof-security').'</strong></h3>'.__('LiteSpeed servers do not support the Apache SetEnvIf directive that is used in the Plugin Firewall .htaccess code at this time. The Plugin Firewall will not work correctly on LiteSpeed servers at this time and needs to be Turned Off/Deactivated. LiteSpeed is planning on adding support for this directive in the future. When LiteSpeed has added support for this directive we will add a new LiteSpeed Dismiss Notice that will be displayed to you in the next version release of BPS Pro to let you know that you can now use the Plugin Firewall on your LiteSpeed Server.', 'bulletproof-security'); echo $text; ?>
</td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&bull;</td>
    <td class="bps-table_cell_no_border"><?php $text = '<h3><strong>'.__('BugFixes|Code Corrections|Enhancements|Misc|CSS|Visual|Other:', 'bulletproof-security').'</strong></h3>'.__('&bull; New BulletProof Security Pro Installation, Activation & Setup Wizard Video Tutorial created for BPS Pro 10.<br>&bull; AutoRestore page size reduction. Additional new files created. Code/functions moved to new files.<br>&bull; Quarantine read me help text addition. Select All Checkbox clarification.<br>&bull; P-Security Diagnostics Checks results displayed in scrollable table.<br>&bull; Dismiss Notices button/link reload current page based on Request URI or Query String.<br>&bull; Optimization|Performance:  functions.php, inpage-functions.php, general-functions.php, dashboard-email-alerts.php, db-security.php, firewall-autopilot.php, login-security.php, zip-email-cron-functions.php, hud-dimiss-functions.php, admin.php<br>&bull; Pro-Tools Base64 tools: Reset Base64 tool option button created. inpage help text clarification on deletion and resetting these tools.<br>&bull; DB Diff Tool: backticks added to DB Query build.<br>&bull; Obsolete functions/code removed/deleted.<br>&bull; Plugin Firewall: Additional correction step added to Minor Plugin Firewall Code Correction Needed error check.<br>&bull; Automated GMT Daylight Savings time synchronization adjustment for Log file DB timestamps and alerts.<br>&bull; Plugin Firewall BPS plugin js script whitelist filter removed (obsolete).<br>&bull; Setup Wizard base Plugin Firewall file creation correction when cURL Scan option is set to Off.<br>&bull; Quarantine Root files not displayed in the Quarantine Dynamic table: string replace path slashes for: XAMPP, MAMP, WAMP, LAMP.<br>&bull; BPS plugin register scripts|styles | Enqueue scripts|styles | Dequeue plugin|theme scripts|styles loading in BPS plugin pages combined into one function. Additionally eliminated bloated individual load settings page code.<br>&bull; Additional variable check for conflicting|contradictory Automatic Update message/alert issue.', 'bulletproof-security'); echo $text; ?>
     </td>
  </tr> 
  <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
    <tr>
    <td class="bps-table_cell_no_border">&nbsp;</td>
    <td class="bps-table_cell_no_border">&nbsp;</td>
  </tr>
</table>
</div>
        
<div id="AITpro-link">BulletProof Security Pro <?php echo BULLETPROOF_VERSION; ?> Plugin by <a href="http://forum.ait-pro.com/" target="_blank" title="AITpro Website Security">AITpro Website Security</a>
</div>
</div>
</div>
</div>