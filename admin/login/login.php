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
// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR);
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );

// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('Login Security & Monitoring ~ JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('Login Security & Monitoring', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'); ?></a></li>
			<!-- <li><a href="#bps-tabs-3"><?php //_e('SQS Brute Force Protection', 'bulletproof-security'); ?></a></li> -->
            <li><a href="#bps-tabs-3"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
         
<div id="bps-tabs-1" class="bps-tab-page" style="">
<h2><?php _e('Login Security & Monitoring (LSM) ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Log All Account Logins or Log Only Account Lockouts ~ Brute Force Login Protection', 'bulletproof-security'); ?></span></h2>

<?php
	$GDMW_options = get_option('bulletproof_security_options_GDMW');
	
	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<h3><strong><span style="font-size:1em;"><font color="blue">'.__('Notice: ', 'bulletproof-security').'</font></span><span style="font-size:.75em;">'.__('The Setup Wizard Go Daddy "Managed WordPress Hosting" option is set to Yes.', 'bulletproof-security').'<br>'.__('If you have Go Daddy "Managed WordPress Hosting" click this link: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/gdmw/" target="_blank" title="Link opens in a new Browser window">'.__('Go Daddy Managed WordPress Hosting', 'bulletproof-security').'</a>.<br>'.__('If you do not have Go Daddy "Managed WordPress Hosting" then change the Go Daddy "Managed WordPress Hosting" Setup Wizard option to No.', 'bulletproof-security').'</span></strong></h3>';
		echo $text;
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help" style="max-width:800px;">

<?php 
	if ( is_multisite() && $blog_id != 1 ) {
		$networkMUText = '';
	} else {
		$networkMUText = '<br><br><strong>'.__('Reset|Clear Login Security Alerts: ', 'bulletproof-security').'</strong><br>'.__('If you choose to have S-Monitor Login Security Alerts displayed to you in your WP Dashboard or BPS Pro pages then to clear the alert you will need to click this button.', 'bulletproof-security');
	}
?>

<h3 style="margin:0px 0px 10px 0px;"><?php _e('Login Security & Monitoring', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Login Security & Monitoring', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Click the Save Options button to save the best pre-selected Login Security settings or choose your own Login Security option settings.', 'bulletproof-security').'</strong><br><br><strong>'.__('What to do if your User Account is locked and you are unable to login to your website', 'bulletproof-security').'</strong><br>'.__('Use FTP or your web host control panel file manager and rename the /bulletproof-security plugin folder name to /_bulletproof-security. Log into your website. Rename the /_bulletproof-security plugin folder name back to /bulletproof-security. Go to the BPS Login Security page and unlock your User Account.', 'bulletproof-security').'<br><br><strong>'.__('Max Login Attempts: ', 'bulletproof-security').'</strong><br>'.__('Type in the maximum number of failed login attempts allowed before a User Account is automatically Locked out. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('The Max Login Attempts setting range is from 1 - 10. Minimum is 1 failed login attempt - Maximum is 10 failed login attempts. Setting this to 1 failed login attempt is NOT recommended. The default is 3 failed login attempts before locking the User Account.', 'bulletproof-security').'<br><br><strong>'.__('Automatic Lockout Time: ', 'bulletproof-security').'</strong><br>'.__('Type in the number of minutes that you would like the User Account to be locked out for when the maximum number of failed login attempts have been made. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Manual Lockout Time: ', 'bulletproof-security').'</strong><br>'.__('Type in the number of minutes that you would like the User Account to be locked out for when you manually lock a User Account using Lock checkbox options in the Dynamic Login Security form. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Max DB Rows To Show: ', 'bulletproof-security').'</strong><br>'.__('Type in the maximum number of database rows that you would like to display in the Dynamic Login Security form. Leaving this text box blank means display all database rows. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Turn On|Turn Off: ', 'bulletproof-security').'</strong><br>'.__('Turn On Login Security or Turn Off Login Security or Turn Off Login Security and Use the Password Reset Option ONLY. The Turn Off Login Security|Use Password Reset Option ONLY setting means that all Login Security features are turned Off except for the Password Reset Option, which can be used independently by itself. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Logging Options: ', 'bulletproof-security').'</strong><br>'.__('You can choose to Log All User Account Logins or Log Only User Account Lockouts. Recommended Setting: Log Only Account Lockouts. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Error Messages: ', 'bulletproof-security').'</strong><br><br><strong>'.__('Standard WP Login Errors: ', 'bulletproof-security').'</strong>'.__('will display the normal WP login errors. Example1: ERROR: The password you entered for the username X is incorrect. BPS Example2: ERROR: This user account has been locked until May 14, 2013 9:31 am due to too many failed login attempts. You can login again after the Lockout Time above has expired.', 'bulletproof-security').'<br><br><strong>'.__('User|Pass Invalid Entry Error: ', 'bulletproof-security').'</strong>'.__('will display a generic Invalid Entry error message instead of displaying normal WP login errors for incorrect username or incorrect password, but if a user account is locked out then the BPS timestamp and Lockout Time error message will be displayed. Example: ERROR: Invalid Entry for either incorrect username or incorrect password. BPS Example2: ERROR: This user account has been locked until May 14, 2013 9:31 am due to too many failed login attempts. You can login again after the Lockout Time above has expired.', 'bulletproof-security').'<br><br><strong>'.__('User|Pass|Lock Invalid Entry Error: ', 'bulletproof-security').'</strong>'.__('will display a generic Invalid Entry error message instead of displaying normal WP login errors for incorrect username, incorrect password and when the user account is locked out - the BPS Lockout Time error message will NOT be displayed. ', 'bulletproof-security').'<br><strong>'.__('CAUTION: ', 'bulletproof-security').'</strong>'.__('If the user account is locked out then no indication will be given that the user account is locked out and only a generic ERROR: Invalid Entry message will be displayed.', 'bulletproof-security').'<br><br><strong>'.__('Attempts Remaining: ', 'bulletproof-security').'</strong><br>'.__('You can choose to display a "Login Attempts Remaining X" message when an incorrect password is entered. X is the number of login attempts left/remaining before the User Account is locked. After making any setting changes click the Save Options button to save your new option settings.', 'bulletproof-security').'<br><br><strong>'.__('Password Reset: ', 'bulletproof-security').'</strong><br>'.__('The Enable Password Reset option will allow the normal WP Lost Password link to be displayed and allow locked out users to reset their passwords. The Disable Password Reset Frontend Only option disables the WP Login reset password feature and displays this error message - Password reset is not allowed for this user. This error message is displayed for valid or invalid user accounts or email addresses. In other words, there is no indication of whether or not a valid username or email address is being entered. This of course disables a lot of cool WordPress login features, but if you want complete Login Stealth Mode then this is the option for you. Disable Password Reset Frontend & Backend disables password reset on the frontend and backend (WP Dashboard) of your website.', 'bulletproof-security').'<br><br><strong>'.__('Sort DB Rows: ', 'bulletproof-security').'</strong><br>'.__('The Ascending Show Oldest Login First option displays logins from the oldest logins to your site to the newest logins to your site. The Descending Show Newest Login First option displays logins from the newest logins to your site to the oldest logins to your site. Example usage: Enter 50 for the Max DB Rows To Show option, which will show a maximum of 50 database rows/logins to your site and set Sort DB Rows option to Descending Show Newest Login First. You will see the last 50 most current/newest logins to your site in descending order.', 'bulletproof-security').$networkMUText.'<br><br><strong>'.__('Search feature: ', 'bulletproof-security').'</strong><br>'.__('The search feature allows you to search all of the Login Security database rows. To search for all Locked User accounts enter Locked, to search for a username enter that username, to search for an IP address enter that IP address, etc.', 'bulletproof-security').'<br><br><strong>'.__('The Dynamic Login Security Form: ', 'bulletproof-security').'</strong><br>'.__('You have 3 options: Lock, Unlock or Delete database rows. The Login Security database table is hooked into the WordPress Users database table, but they are 2 completely separate database tables. If you lock a User Account then BPS Pro will enforce that lock on that User Account and the User will not be able to log in. If you unlock a User Account then the User will be able to login. Deleting database rows in the Login Security database table does NOT delete the User Account from the WordPress Users database table. When you delete a User Account it is pretty much the same thing as unlocking a User Account. To delete actual User Accounts you would go to the WordPress Users page and delete that User Account.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else {

	// DB Login Security Search Form - search all DB values/fields - top was 240px - was 360px
	echo '<div id="LoginSecuritySearch" style="float:right;margin:370px 120px 0px 0px;">';
	echo '<form name="LoginSecuritySearchForm" action="admin.php?page=bulletproof-security/admin/login/login.php" method="post">';
	wp_nonce_field('bulletproof_security_login_security_search');
	echo '<input type="text" name="LSSearch" class="regular-text-short-fixed" style="margin: 0px 5px 0px 0px; "value="" />';
	echo '<input type="submit" name="Submit-Login-Security-search" value="'.esc_attr('Search', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

// Get the Current / Last Modifed Date of the Login Security Reset File
function bps_getLoginSecurityResetFileLastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}
?>

<form name="LoginSecurityOptions" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_login_security'); ?> 
	<?php $BPSoptions = get_option('bulletproof_security_options_login_security'); ?>
 
<table border="0">
  <tr>
    <td><label for="LSLog"><?php _e('Max Login Attempts:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security[bps_max_logins]" class="regular-text-50-fixed" value="<?php if ( $BPSoptions['bps_max_logins'] != '' ) { echo $BPSoptions['bps_max_logins']; } else { echo '3'; } ?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Automatic Lockout Time:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security[bps_lockout_duration]" class="regular-text-50-fixed" value="<?php if ( $BPSoptions['bps_lockout_duration'] != '' ) { echo $BPSoptions['bps_lockout_duration']; } else { echo '60'; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px;"><strong><?php _e('Minutes', 'bulletproof-security'); ?></strong></label></td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Manual Lockout Time:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security[bps_manual_lockout_duration]" class="regular-text-50-fixed" value="<?php if ( $BPSoptions['bps_manual_lockout_duration'] != '' ) { echo $BPSoptions['bps_manual_lockout_duration']; } else { echo '60'; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px;"><strong><?php _e('Minutes', 'bulletproof-security'); ?></strong></label></td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Max DB Rows To Show:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security[bps_max_db_rows_display]" class="regular-text-50-fixed" value="<?php if ( $BPSoptions['bps_max_db_rows_display'] != '' ) { echo $BPSoptions['bps_max_db_rows_display']; } else { echo ''; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px;"><strong><?php _e('Blank = Show All Rows', 'bulletproof-security'); ?></strong></label></td>
  </tr>
</table>
<br />
<table border="0">
  <tr>
    <td><label for="LSLog"><?php _e('Turn On|Turn Off:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_OnOff]" style="width:220px;">
<option value="On" <?php selected('On', $BPSoptions['bps_login_security_OnOff']); ?>><?php _e('Turn On Login Security', 'bulletproof-security'); ?></option>
<option value="Off" <?php selected('Off', $BPSoptions['bps_login_security_OnOff']); ?>><?php _e('Turn Off Login Security', 'bulletproof-security'); ?></option>
<option value="pwreset" <?php selected('pwreset', $BPSoptions['bps_login_security_OnOff']); ?>><?php _e('Turn Off Login Security|Use Password Reset Option ONLY', 'bulletproof-security'); ?></option>
</select>
	</td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Logging Options:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_logging]" style="width:220px;">
<option value="logLockouts" <?php selected('logLockouts', $BPSoptions['bps_login_security_logging']); ?>><?php _e('Log Only Account Lockouts', 'bulletproof-security'); ?></option>
<option value="logAll" <?php selected('logAll', $BPSoptions['bps_login_security_logging']); ?>><?php _e('Log All Account Logins', 'bulletproof-security'); ?></option>
</select>
	</td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Error Messages:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_errors]" style="width:220px;">
<option value="wpErrors" <?php @selected('wpErrors', $BPSoptions['bps_login_security_errors']); ?>><?php _e('Standard WP Login Errors', 'bulletproof-security'); ?></option>
<option value="generic" <?php @selected('generic', $BPSoptions['bps_login_security_errors']); ?>><?php _e('User|Pass Invalid Entry Error', 'bulletproof-security'); ?></option>
<option value="genericAll" <?php @selected('genericAll', $BPSoptions['bps_login_security_errors']); ?>><?php _e('User|Pass|Lock Invalid Entry Error', 'bulletproof-security'); ?></option>
</select>
	</td>
  <tr>
    <td><label for="LSLog"><?php _e('Attempts Remaining:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_remaining]" style="width:220px;">
<option value="On" <?php @selected('On', $BPSoptions['bps_login_security_remaining']); ?>><?php _e('Show Login Attempts Remaining', 'bulletproof-security'); ?></option>
<option value="Off" <?php @selected('Off', $BPSoptions['bps_login_security_remaining']); ?>><?php _e('Do Not Show Login Attempts Remaining', 'bulletproof-security'); ?></option>
</select>
	</td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Password Reset:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_pw_reset]" style="width:220px;">
<option value="enable" <?php @selected('enable', $BPSoptions['bps_login_security_pw_reset']); ?>><?php _e('Enable Password Reset', 'bulletproof-security'); ?></option>
<option value="disableFrontend" <?php @selected('disableFrontend', $BPSoptions['bps_login_security_pw_reset']); ?>><?php _e('Disable Password Reset Frontend Only', 'bulletproof-security'); ?></option>
<option value="disable" <?php @selected('disable', $BPSoptions['bps_login_security_pw_reset']); ?>><?php _e('Disable Password Reset Frontend & Backend', 'bulletproof-security'); ?></option>
</select>
	</td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('Sort DB Rows:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security[bps_login_security_sort]" style="width:220px;">
<option value="ascending" <?php @selected('ascending', $BPSoptions['bps_login_security_sort']); ?>><?php _e('Ascending - Show Oldest Login First', 'bulletproof-security'); ?></option>
<option value="descending" <?php @selected('descending', $BPSoptions['bps_login_security_sort']); ?>><?php _e('Descending - Show Newest Login First', 'bulletproof-security'); ?></option>
</select>
	</td>
  </tr>
</table>

<input type="submit" name="Submit-Security-Log-Options" class="button bps-button" style="margin:15px 0px 0px 0px;" value="<?php esc_attr_e('Save Options', 'bulletproof-security') ?>" />
</form>

<?php if ( is_multisite() && $blog_id != 1 ) { echo '<div style="margin:6px 0px 0px 0px;"></div>'; } else { ?>

<div id="LoginSecurityResetButton" style="max-width:300px;">
<form name="LoginSecurityAlertReset" action="options.php" method="post">
<?php settings_fields('bulletproof_security_options_login_alerts'); ?> 
<?php $LSAlertsoptions = get_option('bulletproof_security_options_login_alerts'); ?>
    <input type="hidden" name="bulletproof_security_options_login_alerts[bps_login_security_db_mod_time]" value="<?php echo bps_getLoginSecurityResetFileLastMod(); ?>" /><br />
    <input type="submit" name="Submit-Reset-Login-Security-Alerts" class="button bps-button" style="margin:6px 0px 0px 8px;;" value="<?php esc_attr_e('Reset|Clear Login Security Alerts', 'bulletproof-security') ?>" />
</form>
</div>

<?php } ?>

<?php
function bpsDBRowCount() {
global $wpdb;
$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
$id = '0';
$DB_row_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $bpspro_login_table WHERE id != %d", $id ) );
$BPSoptions = get_option('bulletproof_security_options_login_security');
$Max_db_rows = $BPSoptions['bps_max_db_rows_display'];

	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) ) {

	echo '<div id="LoginSecurityDBRowCount" style="position:relative;left:0px;bottom:5px;color:#2ea2cc;font-weight:bold;font-size:14px;">';
	
		if ( $BPSoptions['bps_max_db_rows_display'] != '' ) {
			$text = $Max_db_rows.__(' out of ', 'bulletproof-security')."{$DB_row_count}".__(' Database Rows are currently being displayed', 'bulletproof-security');
			echo $text;
		} else {
			$text = __('Total number of Database Rows is: ', 'bulletproof-security')."{$DB_row_count}";
			echo $text;	
		}
	echo '</div>';
	}
}
echo bpsDBRowCount();

// Login Security Search Form
if ( isset( $_POST['Submit-Login-Security-search'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_login_security_search');
	
	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) ) {

		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
		$search = $_POST['LSSearch'];

		$getLoginSecurityTable = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE (status = %s) OR (user_id = %s) OR (username LIKE %s) OR (public_name LIKE %s) OR (email LIKE %s) OR (role LIKE %s) OR (ip_address LIKE %s) OR (hostname LIKE %s) OR (request_uri LIKE %s)", $search, $search, "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%" ) );

		echo '<form name="bpsLoginSecuritySearchDBRadio" action="admin.php?page=bulletproof-security/admin/login/login.php" method="post">';
		wp_nonce_field('bulletproof_security_login_security_search');

		echo '<div id="LoginSecurityCheckall" style="max-height:600px;">';
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:10%;font-size:16px;"><strong>'.__('Login Status', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallLock" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Lock', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallUnlock" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Unlock', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallDelete" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Delete', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('User ID', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Username', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Display Name', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Email', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Role', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Login Time', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Lockout Expires', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('IP Address', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Hostname', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Request URI', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getLoginSecurityTable as $row ) {

		if ( $wpdb->num_rows != 0 ) {
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			
			if ( $row->status == 'Locked' ) {
				echo '<th scope="row" style="border-bottom:none;color:red;font-weight:bold;">'.$row->status.'</th>';
			} else {
				echo '<th scope="row" style="border-bottom:none;">'.$row->status.'</th>';
			}
		
		echo "<td><input type=\"checkbox\" id=\"lockuser\" name=\"LSradio[$row->user_id]\" value=\"lockuser\" class=\"lockuserALL\" /><br><span style=\"font-size:10px;\">".__('Lock', 'bulletproof-security')."</span></td>";
		echo "<td><input type=\"checkbox\" id=\"unlockuser\" name=\"LSradio[$row->user_id]\" value=\"unlockuser\" class=\"unlockuserALL\" /><br><span style=\"font-size:10px;\">".__('Unlock', 'bulletproof-security')."</span></td>";
		echo "<td><input type=\"checkbox\" id=\"deleteuser\" name=\"LSradio[$row->user_id]\" value=\"deleteuser\" class=\"deleteuserALL\" /><br><span style=\"font-size:10px;\">".__('Delete', 'bulletproof-security')."</span></td>";
		echo '<td>'.$row->user_id.'</td>';
		echo '<td>'.$row->username.'</td>';
		echo '<td>'.$row->public_name.'</td>';	
		echo '<td>'.$row->email.'</td>';	
		echo '<td>'.$row->role.'</td>';
		echo '<td>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->login_time + $gmt_offset ).'</td>';
		
		if ( $row->lockout_time == 0 ) { 
			echo '<td>'.__('NA', 'bulletproof-security').'</td>';
		} else {
			echo '<td>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset ).'</td>';
		}
		
		echo '<td>'.$row->ip_address.'</td>';	
		echo '<td>'.$row->hostname.'</td>';
		echo '<td>'.$row->request_uri.'</td>';	
		echo '</tr>';			
		}
		} 
		
		if ( $wpdb->num_rows == 0 ) {		
		echo '<th scope="row" style="border-bottom:none;">'.__('No Logins/Locked', 'bulletproof-security').'</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '<td></td>';
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '</tr>';		
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';	

		echo "<input type=\"submit\" name=\"Submit-Login-Search-Radio\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('Locking and Unlocking a User is reversible, but Deleting a User is not.\n\n-------------------------------------------------------------\n\nWhen you delete a User you are deleting that User database row from the BPS Login Security Database Table and not from the WordPress User Database Table.\n\n-------------------------------------------------------------\n\nTo delete a User Account from your WordPress website use the standard/normal WordPress Users page.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" />&nbsp;&nbsp;<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"javascript:history.go(0)\" /></form>";
	}
	
	} else {

	// standard form
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {
	
		echo '<form name="bpsLoginSecurityDBRadio" action="admin.php?page=bulletproof-security/admin/login/login.php" method="post">';
		wp_nonce_field('bulletproof_security_login_security');

		$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
		$searchAll = ''; // return all rows
		$BPSoptions = get_option('bulletproof_security_options_login_security');
	
		if ( ! $BPSoptions['bps_login_security_sort'] || $BPSoptions['bps_login_security_sort'] == 'ascending' ) {
			$sorting = 'ASC';
		} else {
			$sorting = 'DESC';
		}
	
		if ( $BPSoptions['bps_max_db_rows_display'] != '' ) {
			$db_row_limit = 'LIMIT '. $BPSoptions['bps_max_db_rows_display'];
			$getLoginSecurityTable = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE login_time != %s ORDER BY login_time $sorting $db_row_limit", "%$searchAll%" ) );
	
		} else {
			$getLoginSecurityTable = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE login_time != %s ORDER BY login_time $sorting", "%$searchAll%" ) );	
		}

		echo '<div id="LoginSecurityCheckall" style="max-height:600px;">';
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:10%;font-size:16px;"><strong>'.__('Login Status', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallLock" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Lock', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallUnlock" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Unlock', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><input type="checkbox" class="checkallDelete" style="text-align:left;margin-left:2px;" /><br><strong>'.__('Delete', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('User ID', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Username', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Display Name', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Email', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Role', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Login Time', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Lockout Expires', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('IP Address', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Hostname', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:5%;font-size:12px;"><strong>'.__('Request URI', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getLoginSecurityTable as $row ) {

		if ( $wpdb->num_rows != 0 ) {
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			
			if ( $row->status == 'Locked' ) {
				echo '<th scope="row" style="border-bottom:none;color:red;font-weight:bold;">'.$row->status.'</th>';
			} else {
				echo '<th scope="row" style="border-bottom:none;">'.$row->status.'</th>';
			}
		
		echo "<td><input type=\"checkbox\" id=\"lockuser\" name=\"LSradio[$row->user_id]\" value=\"lockuser\" class=\"lockuserALL\" /><br><span style=\"font-size:10px;\">".__('Lock', 'bulletproof-security')."</span></td>";
		echo "<td><input type=\"checkbox\" id=\"unlockuser\" name=\"LSradio[$row->user_id]\" value=\"unlockuser\" class=\"unlockuserALL\" /><br><span style=\"font-size:10px;\">".__('Unlock', 'bulletproof-security')."</span></td>";
		echo "<td><input type=\"checkbox\" id=\"deleteuser\" name=\"LSradio[$row->user_id]\" value=\"deleteuser\" class=\"deleteuserALL\" /><br><span style=\"font-size:10px;\">".__('Delete', 'bulletproof-security')."</span></td>";
		echo '<td>'.$row->user_id.'</td>';
		echo '<td>'.$row->username.'</td>';
		echo '<td>'.$row->public_name.'</td>';	
		echo '<td>'.$row->email.'</td>';	
		echo '<td>'.$row->role.'</td>';	
		echo '<td>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->login_time + $gmt_offset).'</td>';
		if ( $row->lockout_time == 0 ) { 
		echo '<td>'.__('NA', 'bulletproof-security').'</td>';
		} else {
		echo '<td>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</td>';
		}
		echo '<td>'.$row->ip_address.'</td>';	
		echo '<td>'.$row->hostname.'</td>';
		echo '<td>'.$row->request_uri.'</td>';	
		echo '</tr>';			
		}
		} 
		
		if ( $wpdb->num_rows == 0 ) {		
		echo '<th scope="row" style="border-bottom:none;">'.__('No Logins/Locked', 'bulletproof-security').'</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '<td></td>';
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '</tr>';		
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';

		echo "<input type=\"submit\" name=\"Submit-Login-Security-Radio\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('Locking and Unlocking a User is reversible, but Deleting a User is not.\n\n-------------------------------------------------------------\n\nWhen you delete a User you are deleting that User database row from the BPS Login Security Database Table and not from the WordPress User Database Table.\n\n-------------------------------------------------------------\n\nTo delete a User Account from your WordPress website use the standard/normal WordPress Users page.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" />&nbsp;&nbsp;<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"javascript:history.go(0)\" /></form>";
	}
	}
?>
<br />

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
//jQuery(function() {
    $('.checkallLock').click(function() {
        $(this).parents('#LoginSecurityCheckall:eq(0)').find('.lockuserALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
//jQuery(function() {
    $('.checkallUnlock').click(function() {
        $(this).parents('#LoginSecurityCheckall:eq(0)').find('.unlockuserALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
//jQuery(function() {
    $('.checkallDelete').click(function() {
        $(this).parents('#LoginSecurityCheckall:eq(0)').find('.deleteuserALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<?php 
// Standard Visible Login Security form proccessing - Lock, Unlock or Delete user login status from DB
if ( isset( $_POST['Submit-Login-Security-Radio'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_login_security');
	
	$LSradio = $_POST['LSradio'];
	$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";

	switch( $_POST['Submit-Login-Security-Radio'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$delete_users = array();
		$unlock_users = array();
		$lock_users = array();		
		
		if ( ! empty($LSradio) ) {
			
			echo $checked;
			
			foreach ( $LSradio as $key => $value ) {
				
				if ( $value == 'deleteuser' ) {
					$delete_users[] = $key;
				
				} elseif ( $value == 'unlockuser' ) {
					$unlock_users[] = $key;
				
				} elseif ( $value == 'lockuser' ) {
					$lock_users[] = $key;
				}
			}
		}
			
		if ( ! empty($delete_users) ) {
			
			foreach ( $delete_users as $delete_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %s", $delete_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_login_table WHERE user_id = %s", $delete_user ) );
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textDelete = '<font color="green">'.$row->username.__(' has been deleted from the Login Security Database Table.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textDelete;
				echo '</p></div>';	
				}
			}
		}
		
		if ( ! empty($unlock_users) ) {
			
			foreach ( $unlock_users as $unlock_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_login_table WHERE user_id = %s", $unlock_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$NLstatus = 'Not Locked';
					$lockout_time = '0';		
					$failed_logins ='0';

					$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $NLstatus, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $row->login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) );
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textUnlock = '<font color="green">'.$row->username.__(' has been Unlocked.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textUnlock;
				echo '</p></div>';	
				}			
			}
		}

		if ( ! empty($lock_users) ) {
			
			foreach ( $lock_users as $lock_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %s", $lock_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$Lstatus = 'Locked';
					$manual_lockout_time = time() + (60 * $BPSoptions['bps_manual_lockout_duration']); // default is 1 hour/3600 seconds
					$BPSoptions = get_option('bulletproof_security_options_login_security');
					$failed_logins = $BPSoptions['bps_max_logins'];	

					$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $Lstatus, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $row->login_time, 'lockout_time' => $manual_lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) );

				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textLock = '<font color="green">'.$row->username.__(' has been Locked.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textLock;
				echo '</p></div>';
				}			
			}
		}
		break;
	} // end Switch
}

// Search Form - Login Security form proccessing - Lock, Unlock or Delete user login status from DB
if ( isset( $_POST['Submit-Login-Search-Radio'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_login_security_search');
	
	$LSradio = $_POST['LSradio'];
	$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
	
	switch( $_POST['Submit-Login-Search-Radio'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$delete_users = array();
		$unlock_users = array();
		$lock_users = array();		
		
		if ( ! empty($LSradio) ) {
			
			foreach ( $LSradio as $key => $value ) {
				
				if ( $value == 'deleteuser' ) {
					$delete_users[] = $key;
				
				} elseif ( $value == 'unlockuser' ) {
					$unlock_users[] = $key;
				
				} elseif ( $value == 'lockuser' ) {
					$lock_users[] = $key;
				}
			}
		}
			
		if ( ! empty($delete_users) ) {
			
			foreach ( $delete_users as $delete_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %s", $delete_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_login_table WHERE user_id = %s", $delete_user ) );
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textDelete = '<font color="green">'.$row->username.__(' has been deleted from the Login Security Database Table.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textDelete;
				echo '</p></div>';	
				}
			}
		}
		
		if ( ! empty($unlock_users) ) {
			
			foreach ( $unlock_users as $unlock_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %s", $unlock_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$NLstatus = 'Not Locked';
					$lockout_time = '0';		
					$failed_logins ='0';						
					
					$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $NLstatus, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $row->login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) );
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textUnlock = '<font color="green">'.$row->username.__(' has been Unlocked.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textUnlock;
				echo '</p></div>';	
				}			
			}
		}

		if ( ! empty($lock_users) ) {
			
			foreach ( $lock_users as $lock_user ) {
				$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %s", $lock_user ) );
			
				foreach ( $LoginSecurityRows as $row ) {
					$Lstatus = 'Locked';
					$manual_lockout_time = time() + (60 * $BPSoptions['bps_manual_lockout_duration']); // default is 1 hour/3600 seconds 	
					$BPSoptions = get_option('bulletproof_security_options_login_security');
					$failed_logins = $BPSoptions['bps_max_logins'];

					$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $Lstatus, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $row->login_time, 'lockout_time' => $manual_lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) );

				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textLock = '<font color="green">'.$row->username.__(' has been Locked.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textLock;
				echo '</p></div>';
				}			
			}
		}
		break;
	} // end Switch
}
} // end if current_user_can('manage_options') - forms are not displayed to non-administrators
?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('jQuery ToolTip CAPTCHA (JTC) ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Anti-Spam Protection ~ Anti-Hacker Protection ~ Brute Force Login Protection ~ DoS|DDoS Protection', 'bulletproof-security'); ?></span><br /><span style="font-size:.75em;font-weight:bold;"><?php _e('Note: ', 'bulletproof-security'); ?></span><span style="font-size:.563em;"><?php _e('If you are still seeing spam comments after enabling JTC then click the Read Me help button below and read this help section:  Trackback|Pingback Spam', 'bulletproof-security'); ?></span></h2>
	
<?php
	$GDMW_options = get_option('bulletproof_security_options_GDMW');
	
	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<h3><strong><span style="font-size:1em;"><font color="blue">'.__('Notice: ', 'bulletproof-security').'</font></span><span style="font-size:.75em;">'.__('The Setup Wizard Go Daddy "Managed WordPress Hosting" option is set to Yes.', 'bulletproof-security').'<br>'.__('If you have Go Daddy "Managed WordPress Hosting" click this link: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/gdmw/" target="_blank" title="Link opens in a new Browser window">'.__('Go Daddy Managed WordPress Hosting', 'bulletproof-security').'</a>.<br>'.__('If you do not have Go Daddy "Managed WordPress Hosting" then change the Go Daddy "Managed WordPress Hosting" Setup Wizard option to No.', 'bulletproof-security').'</span></strong></h3>';
		echo $text;
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<?php 
if ( is_multisite() && $blog_id != 1 ) {
$networkMUJTCText = '';
} else {
$networkMUJTCText = '<br><br><strong>'.__('JTC Logging: ', 'bulletproof-security').'</strong><br>'.__('Turn On or Turn Off JTC Anti-Spam logging. JTC Anti-Spam log entries are logged in the BPS Pro Security Log file. The JTC Anti-Spam log entries include the Form name for whichever Form the CAPTCHA was not successfully entered, CAPTCHA value that was entered, BOT/HUMAN value, Username/Display Name (Comment Form only) and all the other standard Security Log entry values/fields.', 'bulletproof-security');
}
?>


<h3 style="margin:0px 0px 5px 0px;"><?php _e('JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('JTC Anti-Spam|Anti-Hacker Setup Steps', 'bulletproof-security').'</strong><br>'.__('1. Enter a user friendly CAPTCHA in the JTC CAPTCHA text box.', 'bulletproof-security').'<br>'.__('2. Copy and paste the CAPTCHA you entered in the JTC CAPTCHA text box into the JTC ToolTip text box.', 'bulletproof-security').'<br>'.__('3. Either keep this default text "Hover or click the text box below" that will be displayed on all your forms or edit this text and add the message you want to add.', 'bulletproof-security').'<br>'.__('4. Select Turn On JTC Anti-Spam Logging if you would like to log blocked attempts by spammers and hackers.', 'bulletproof-security').'<br>'.__('5. Choose the forms where you want your CAPTCHA displayed.', 'bulletproof-security').'<br><br><strong>'.__('General Info about JTC Anti-Spam|Anti-Hacker', 'bulletproof-security').'</strong><br>'.__('JTC Anti-Spam|Anti-Hacker provides website security protection as well as website Anti-Spam protection. JTC Anti-Spam|Anti-Hacker is user friendly Anti-Spam/Anti-Hacker Protection. You can customize and personalize your JTC ToolTip message and CAPTCHA to match your website concept.', 'bulletproof-security').'<br><br><strong><font color="blue">'.__('JTC Anti-Spam|Anti-Hacker Security/Spammer Protection:', 'bulletproof-security').'<br>&bull;'.__(' Hacker Protection', 'bulletproof-security').'<br>&bull;'.__(' Spammer Protection', 'bulletproof-security').'<br>&bull;'.__(' DoS/DDoS Attack Protection', 'bulletproof-security').'<br>&bull;'.__(' Brute Force Login Attack Protection', 'bulletproof-security').'<br>&bull;'.__(' SpamBot Trap', 'bulletproof-security').'<br><br>'.__('Hacker, Spammer, DoS/DDoS & Brute Force Login Protection Explained', 'bulletproof-security').'</font></strong><br>'.__('JTC Anti-Spam|Anti-Hacker is specifically designed to stop all Form processing if an invalid CAPTCHA is entered or the SpamBot Trap is triggered.', 'bulletproof-security').'<br><br>'.__('What this means is auto-posting Hacker/HackerBot and Spammer/SpamBot programs/software/applications/user agents cannot overload your Website with Brute Force Login attacks, DoS/DDoS attacks or other Request attacks auto-posted to Forms on your website since HackerBot/SpamBot Requests are stopped before Form processing is allowed to continue to connect to your WordPress Database and process the Form Request - the HackerBot/SpamBot Request resource usage would be insignificant and would not negatively impact your Website resources.', 'bulletproof-security').'<br><br><strong><font color="blue">'.__('NOTES: ', 'bulletproof-security').'</font></strong><br>'.__('JTC Anti-Spam|Anti-Hacker is not designed or intended to be a replacement for Akismet\'s capability to catch human spammer spam comments. 95% or more of all comment spam is automated using SpamBots and is not done by human spammers. JTC Anti-Spam|Anti-Hacker is an additional Anti-Spam/Anti-Hacker security feature to stop Hacker/HackerBot and Spammer/SpamBot Registrations, Logins & Commenting on your website.', 'bulletproof-security').'<br><br>'.__('JTC Anti-Spam|Anti-Hacker is the predecessor to these Brute Force Login Protection options/code posted in this Forum Topic: http://forum.ait-pro.com/forums/topic/protect-login-page-from-brute-force-login-attacks/. You can of course continue to use those additional Brute Force Login Protection options/code, but JTC Anti-Spam offers all of the same protection options already and much more. For folks who do not want or allow anyone else to log into their websites - See the Additional Brute Force CAPTCHA Option help section.', 'bulletproof-security').'<br><br><strong>'.__('Additional Brute Force CAPTCHA Option for folks who do not want to allow anyone else to be able to log into their website: ', 'bulletproof-security').'</strong><br>'.__('See the Additional Brute Force CAPTCHA Option help section.', 'bulletproof-security').'<br><br><strong>'.__('Trackback/Pingback Spam: ', 'bulletproof-security').'</strong><br>'.__('The WordPress Trackback feature allows someone to post a comment directly to your website from another website without registering or logging into your website or using your comment form, even if you require that all user\'s have to register and login to your website in order to post comments. Since Trackbacks do not use any of the WordPress Forms and are posted directly to your site then JTC cannot prevent Trackback Spam comments that are directly posted to your website. We have created a solution for Trackback Spam here: http://forum.ait-pro.com/forums/topic/wordpress-xml-rpc-ddos-protection-protect-xmlrpc-php-block-xmlrpc-php-forbid-xmlrpc-php/#trackback. NOTE: If you are using JetPack then you may still get Trackback Spam even after using the Bonus Custom Code. This is not 100% confirmed, but it looks like that is the case. You can either choose to ignore the Trackback Spam or you can delete the wp-trackback.php file. The wp-trackback.php file only does one thing: allows Trackback comments to be directly posted to your website.', 'bulletproof-security').'<br><br><strong>'.__('JTC CAPTCHA: ', 'bulletproof-security').'</strong><br>'.__('This is the CAPTCHA that users will enter to Register, Login or post Comments on your website. You can use any numbers or characters and spaces in the CAPTCHA. You can even use HTML code characters except for these HTML code characters:  < > \' " &. You can use a phrase for the CAPTCHA or it can be a single word or you can use your own original combination of words, numbers and HTML characters.', 'bulletproof-security').'<br><br><strong>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('It is recommended that you make your CAPTCHA user friendly, simple, clear and easy to understand for your users.', 'bulletproof-security').'<br><br><strong>'.__('Example CAPTCHA\'s: ', 'bulletproof-security').'</strong><br>'.__('B4today, Jack and Jill, $$$Money$$$, (-)^(-), ***Your Website Name***, Xfactor, spam free zone, spammers suck, etc.', 'bulletproof-security').'<br><br><strong>'.__('Examples of CAPTCHA\'s that you should not use: ', 'bulletproof-security').'</strong><br>'.__('A mathematical number or a common word in the dictionary. Spambots are designed to try numbers and common words in a dictionary. You could of course use a common word in the dictionary and add a number to it - blue88, which would make this a very random CAPTCHA, but still very user friendly.', 'bulletproof-security').'<br><br><strong>'.__('JTC ToolTip: ', 'bulletproof-security').'</strong><br>'.__('This is the jQuery ToolTip message that is displayed to users when they hover or click on the CAPTCHA text box. This is where you will tell your users what they need to enter for the CAPTCHA. It can be a phrase, complete this sentence, a Hint or simply just Type/Enter: xxxxx or you can get as creative as you want to get with your jQuery ToolTip. Randomness is what makes a CAPTCHA very effective. JTC Anti-Spam is designed with CAPTCHA randomness capability as one of its primary features.', 'bulletproof-security').'<br><br><strong>'.__('JTC Title|Text: ', 'bulletproof-security').'</strong><br>'.__('This is the text that is displayed to users above the CAPTCHA text box/Form Field.', 'bulletproof-security').$networkMUJTCText.'<br><br><strong>'.__('Enable|Disable JTC Anti-Spam For These Forms: ', 'bulletproof-security').'</strong><br>'.__('Checking a Form checkbox will display a CAPTCHA on that Form to all users. Unchecking a Form checkbox will remove the CAPTCHA on that Form for all users. The Comment Form is a special case and the CAPTCHA can be displayed based on the User Roles that you choose. See the Comment Form help section below.', 'bulletproof-security').'<br><br><strong>'.__('Comment Form: (only applies if Comment Form CAPTCHA is enabled/checked) ', 'bulletproof-security').'<br>'.__('Enable|Disable JTC Anti-Spam For These Registered/Logged In User Roles:', 'bulletproof-security').'</strong><br>'.__('Users must be logged into your website for the Comment Form User Roles to work. If you do not require that users are registered and logged in to post comments on your website then these JTC Anti-Spam options will not have any effect. These options are ONLY for registered and logged in users and ONLY for your Comment Form if you are using this WordPress Discussion setting: Users must be registered and logged in to comment.', 'bulletproof-security').'<br><br>'.__('Checking a User Role checkbox will display a CAPTCHA to all users with that User Role on your website\'s Comment Form. Unchecking a User Role checkbox will remove the CAPTCHA from displaying to users with that User Role on your website\'s Comment Form.', 'bulletproof-security').'<br><br><strong>'.__('Comment Form CAPTCHA Error message:', 'bulletproof-security').'</strong><br>'.__('The Default JTC Anti-Spam Comment Form CAPTCHA error message is: <strong>ERROR</strong>: Incorrect JTC CAPTCHA Entered. Click your Browser\'s back button and re-enter the JTC CAPTCHA. You can change or add to the default error message. This error message only applies to the Comment Form CAPTCHA error message and does not affect or change any of the other Form CAPTCHA error messages.', 'bulletproof-security').'<br><br><strong>'.__('Comment Form: CSS Styling', 'bulletproof-security').'</strong><br>'.__('You can position the JTC Title|Text Form label and the JTC CAPTCHA Form Input text box by editing the CSS in these text boxes. By default the position of the JTC Title|Text label and the JTC CAPTCHA Form Input text box is below your Comment Form submit button. For CSS code styling examples go to this Forum Topic: http://forum.ait-pro.com/forums/topic/jtc-anti-spam-read-me-first/', 'bulletproof-security').'<br><br><strong>'.__('Comment Form Label:', 'bulletproof-security').'</strong><br>'.__('This is the JTC Title|Text label above the Form Input text box.', 'bulletproof-security').'<br><strong>'.__('Comment Form Input Text Box:', 'bulletproof-security').'</strong><br>'.__('This is the JTC CAPTCHA Form Input text box.', 'bulletproof-security').'<br><br><strong>'.__('Additional Brute Force CAPTCHA Option: ', 'bulletproof-security').'</strong><br>'.__('If you do not allow anyone else to log into your website then here is an example of how JTC Anti-Spam|Anti-Hacker could be used as an additional Brute Force Login Protection feature.', 'bulletproof-security').'<br><br>'.__('Example: You create a JTC CAPTCHA: My Example CAPTCHA, you either leave the JTC ToolTip: text box blank or you create a Hint for yourself - JTC ToolTip: My Example Hint. If your JTC ToolTip: text box is blank then the CAPTCHA will not be displayed - only you will know what the CAPTCHA is. If you create a personal Hint for yourself then only you will know what the answer to the Hint is.', 'bulletproof-security').'<br><br>'.__('If you forget what the CAPTCHA is and cannot login to your website then you will need to FTP to your website and rename the /bulletproof-security plugin folder to /__bulletproof-security temporarily so that you can log into your website. After you have logged into your website then rename the /__bulletproof-security plugin folder back to its original folder name.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else {
?>

<div id="LoginSecurityJTC" style="position:relative; top:0px; left:0px; margin:0px 0px 0px 0px;">
<form name="LoginSecurityJTC" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_login_security_jtc'); ?> 
	<?php $BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc'); ?>
    
 <h3><?php _e('jQuery ToolTip CAPTCHA Anti-Spam Settings', 'bulletproof-security'); ?></h3>   
    
<table border="0">
  <tr>
    <td><label for="LSLog"><?php _e('JTC CAPTCHA:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security_jtc[bps_tooltip_captcha_key]" class="regular-text-short-fixed" style="width:250px;" value="<?php if ( $BPSoptionsJTC['bps_tooltip_captcha_key'] != '' ) { echo $BPSoptionsJTC['bps_tooltip_captcha_key']; } else { echo ''; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px; font-style:italic;"><?php _e('MyCAPTCHA', 'bulletproof-security'); ?></label></td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('JTC ToolTip:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security_jtc[bps_tooltip_captcha_hover_text]" class="regular-text-short-fixed" style="width:250px;" value="<?php if ( $BPSoptionsJTC['bps_tooltip_captcha_hover_text'] != '' ) { echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; } else { echo 'Type/Enter:  '; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px; font-style:italic;"><?php _e('Type/Enter:  MyCAPTCHA', 'bulletproof-security'); ?></label></td>
  </tr>
  <tr>
    <td><label for="LSLog"><?php _e('JTC Title|Text:', 'bulletproof-security'); ?></label></td>
    <td><input type="text" name="bulletproof_security_options_login_security_jtc[bps_tooltip_captcha_title]" class="regular-text-short-fixed" style="width:250px;" value="<?php if ( $BPSoptionsJTC['bps_tooltip_captcha_title'] != '' ) { echo $BPSoptionsJTC['bps_tooltip_captcha_title']; } else { echo 'Hover or click the text box below'; } ?>" /></td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px; font-style:italic;"><?php _e('Enter a blank space for no text', 'bulletproof-security'); ?></label></td>
  </tr>


<?php if ( is_multisite() && $blog_id != 1 ) { echo '<div style="margin:0px 0px 0px 0px;"></div>'; } else { ?>

  <tr>
    <td><label for="LSLog"><?php _e('JTC Logging:', 'bulletproof-security'); ?></label></td>
    <td><select name="bulletproof_security_options_login_security_jtc[bps_tooltip_captcha_logging]" style="width:250px;">
<option value="Off" <?php selected('Off', $BPSoptionsJTC['bps_tooltip_captcha_logging']); ?>><?php _e('Turn Off JTC Anti-Spam Logging', 'bulletproof-security'); ?></option>
<option value="On" <?php selected('On', $BPSoptionsJTC['bps_tooltip_captcha_logging']); ?>><?php _e('Turn On JTC Anti-Spam Logging', 'bulletproof-security'); ?></option>
</select>
	</td>
    <td><label for="LSLog" style="margin:0px 0px 0px 5px; font-style:italic;"><?php _e('Logged in the Security Log', 'bulletproof-security'); ?></label></td>
  </tr>

<?php } ?>
<!-- Important: </table> needs to come after the closing php tag above for Network subsites -->
</table>
<br />

   <label><strong><?php _e('Enable|Disable JTC Anti-Spam For These Forms: ', 'bulletproof-security'); ?></strong></label><br />
   <label><strong><i><?php _e('Check to Enable. Uncheck to Disable.', 'bulletproof-security'); ?></i></strong></label><br /><br />
    <input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_login_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_login_form'], 1 ); ?> /><label><?php _e(' Login Form', 'bulletproof-security'); ?></label><br />
    <input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_register_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_register_form'], 1 ); ?> /><label><?php _e(' Register Form', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_lostpassword_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_lostpassword_form'], 1 ); ?> /><label><?php _e(' Lost Password Form', 'bulletproof-security'); ?></label><br />    
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_comment_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_comment_form'], 1 ); ?> /><label><?php _e(' Comment Form', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_buddypress_register_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_buddypress_register_form'], 1 ); ?> /><label><?php _e(' BuddyPress Register Form', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_buddypress_sidebar_form]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'], 1 ); ?> /><label><?php _e(' BuddyPress Sidebar Login Form', 'bulletproof-security'); ?></label><br /><br />

    <label><strong><?php _e('Comment Form: (only applies if Comment Form CAPTCHA is enabled/checked)', 'bulletproof-security'); ?></strong></label><br />
    <label><strong><?php _e('Enable|Disable JTC Anti-Spam For These Registered/Logged In User Roles: ', 'bulletproof-security'); ?></strong></label><br />  
  <label><strong><i><?php _e('Check to Enable. Uncheck to Disable.', 'bulletproof-security'); ?></i></strong></label><br /><br />
    <input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_administrator]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_administrator'], 1 ); ?> /><label><?php _e(' Administrator', 'bulletproof-security'); ?></label><br />
    <input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_editor]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_editor'], 1 ); ?> /><label><?php _e(' Editor', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_author]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_author'], 1 ); ?> /><label><?php _e(' Author', 'bulletproof-security'); ?></label><br />    
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_contributor]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_contributor'], 1 ); ?> /><label><?php _e(' Contributor', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_login_security_jtc[bps_jtc_subscriber]" value="1" <?php checked( $BPSoptionsJTC['bps_jtc_subscriber'], 1 ); ?> /><label><?php _e(' Subscriber', 'bulletproof-security'); ?></label><br /><br />

    <label for="LSLog13"><?php _e('Comment Form: CAPTCHA Error message', 'bulletproof-security'); ?></label><br />
    <input type="text" name="bulletproof_security_options_login_security_jtc[bps_jtc_comment_form_error]" class="regular-text-short-fixed" style="width:75%;" value="<?php if ($BPSoptionsJTC['bps_jtc_comment_form_error'] != '') { echo $BPSoptionsJTC['bps_jtc_comment_form_error']; } else { echo '<strong>ERROR</strong>: Incorrect JTC CAPTCHA Entered. Click your Browser\'s back button and re-enter the JTC CAPTCHA.'; } ?>" /><br /><br />
    
    <label><strong><?php _e('Comment Form: CSS Styling (Click the Read Me help button for more help info)', 'bulletproof-security'); ?></strong></label><br />
    <label><strong><?php _e('Comment Form Label: <i>The JTC Title|Text above the Form Input text box</i>', 'bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bulletproof_security_options_login_security_jtc[bps_jtc_comment_form_label]" class="regular-text-short-fixed" style="width:75%;" value="<?php if ($BPSoptionsJTC['bps_jtc_comment_form_label'] != '') { echo $BPSoptionsJTC['bps_jtc_comment_form_label']; } else { echo 'position:relative;top:0px;left:0px;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;'; } ?>" /><br />
    <label><strong><?php _e('Comment Form Input Text Box: <i>The JTC CAPTCHA Form Input text box</i>', 'bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bulletproof_security_options_login_security_jtc[bps_jtc_comment_form_input]" class="regular-text-short-fixed" style="width:75%;" value="<?php if ($BPSoptionsJTC['bps_jtc_comment_form_input'] != '') { echo $BPSoptionsJTC['bps_jtc_comment_form_input']; } else { echo 'position:relative;top:0px;left:0px;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;'; } ?>" /><br /><br />

<input type="submit" name="Submit-Security-Log-Options-JTC" class="button bps-button"  style="margin-top:5px;" value="<?php esc_attr_e('Save Options', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Click OK to Proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>
</form><br />
</div>  

<?php } ?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-3" class="bps-tab-page">
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