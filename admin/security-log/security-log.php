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

// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR);
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );

$bpsSpacePop = '-------------------------------------------------------------';

// Manually runs real-time BPS Pro version update check - for testing ONLY
// echo bpsPro_update_checks();
// Manually runs PHP Error Log cron function - for testing ONLY
// echo bps_smonitor_ELogModTimeDiff_wp_email();

// Form - Security Log page - Turn Error Logging Off
if ( isset( $_POST['Submit-Error-Log-Off'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-error-log-off' );
	
	$Flockoptions = get_option('bulletproof_security_options_flock');
	$AutoLockoptions = get_option('bulletproof_security_options_autolock');	
	$filename = ABSPATH . '.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();	
	$pattern1 = '/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';
	$pattern2 = '/ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';
	$bps_get_wp_root_secure = bps_wp_get_root_folder();		
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';	
	$stringReplace = file_get_contents($filename);
	
	// need to get the $lock value first because permissions are cached
	if 	( file_exists($filename) && @$permsHtaccess == '0404' ) {
		$lock = '0404';			
	}

	if ( file_exists($filename) && preg_match($pattern1, $stringReplace, $matches) ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}		
		
		$stringReplace = preg_replace('/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s', "ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\n#ErrorDocument 401 default\n#ErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\n#ErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);
		
		if ( ! file_put_contents($filename, $stringReplace ) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to turn Logging Off. Either the root .htaccess file is not writable, it does not exist or the ErrorDocument .htaccess code does not exist in your Root .htaccess file. Check that the root .htaccess file exists, the code exists and that file permissions allow writing.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			if ( $lock == '0404' || $AutoLockoptions['bps_root_htaccess_autolock'] == 'On' || $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {			
				@chmod($filename, 0404);
			}			
			copy($filename, $htaccessARQ);
		}
	}

	if ( file_exists($filename) && preg_match($pattern2, $stringReplace, $matches) ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}		

		$stringReplace = preg_replace('/ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s', "#ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\n#ErrorDocument 401 default\n#ErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\n#ErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);
		
		if ( ! file_put_contents($filename, $stringReplace ) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to turn Logging Off. Either the root .htaccess file is not writable, it does not exist or the ErrorDocument .htaccess code does not exist in your Root .htaccess file. Check that the root .htaccess file exists, the code exists and that file permissions allow writing.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			if ( $lock == '0404' || $AutoLockoptions['bps_root_htaccess_autolock'] == 'On' || $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {	
				@chmod($filename, 0404);
			}	

			copy($filename, $htaccessARQ);
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Logging has been turned Off', 'bulletproof-security').'</strong></font>';
			echo $text;		
			echo $bps_bottomDiv;
		}
	}
}

// Form - Security Log page - Turn Error Logging On
if ( isset( $_POST['Submit-Error-Log-On'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-error-log-on' );
$Flockoptions = get_option('bulletproof_security_options_flock');
$AutoLockoptions = get_option('bulletproof_security_options_autolock');	

	$filename = ABSPATH . '.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();
	$pattern1 = '/ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';	
	$pattern2 = '/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';
	$bps_get_wp_root_secure = bps_wp_get_root_folder();
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$stringReplace = file_get_contents($filename);
	
	// need to get the $lock value first because permissions are cached
	if 	( file_exists($filename) && @$permsHtaccess == '0404' ) {
		$lock = '0404';			
	}

	// This factors in the scenario of #ErrorDocument 403 being commented out if other ErrorDocument directives are NOT commented out
	// Create a new ErrorDocument .htaccess block of code with all ErrorDocument directives uncommented
	if ( file_exists($filename) && preg_match($pattern1, $stringReplace, $matches) ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}	

		$stringReplace = preg_replace('/ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s', "ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\nErrorDocument 401 default\nErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\nErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);		
		
		if ( ! file_put_contents($filename, $stringReplace ) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to turn Logging On. Either the root .htaccess file is not writable, it does not exist or the ErrorDocument .htaccess code does not exist in your Root .htaccess file. Check that the root .htaccess file exists, the code exists and that file permissions allow writing.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			if ( $lock == '0404' || $AutoLockoptions['bps_root_htaccess_autolock'] == 'On' || $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {			
				@chmod($filename, 0404);
			}			
			
			copy($filename, $htaccessARQ);		
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Logging has been turned On', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		}
	}
	
	if ( file_exists($filename) && preg_match($pattern2, $stringReplace, $matches) ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}
		
		$stringReplace = preg_replace('/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s', "ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\nErrorDocument 401 default\nErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\nErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);
		
		if ( ! file_put_contents($filename, $stringReplace ) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to turn Logging On. Either the root .htaccess file is not writable, it does not exist or the ErrorDocument .htaccess code does not exist in your Root .htaccess file. Check that the root .htaccess file exists, the code exists and that file permissions allow writing.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			if ( $lock == '0404' || $AutoLockoptions['bps_root_htaccess_autolock'] == 'On' || $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {
				@chmod($filename, 0404);
			}				
			copy($filename, $htaccessARQ);
		}
	}
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

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Security Log', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('Security Log', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            

<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('Security Log ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Logs Blocked Hackers, Spammers, Scrapers, Bots, etc ~ JTC Anti-Spam Logging ~ HTTP 400, 403 & 404 Logging ~ Troubleshooting Tool', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('Security Log', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Security Log', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Security Log General Information', 'bulletproof-security').'</strong><br>'.__('Your Security Log file is a plain text static file and not a dynamic file or dynamic display to keep your website resource usage at a bare minimum and keep your website performance at a maximum. Log entries are logged in descending order by Date and Time. You can copy, edit and delete this plain text file. You can setup S-Monitor Email Alerting & Log File Options to automatically email your Security Log file to you and delete it when it reaches a certain size (256KB, 500KB or 1MB). ', 'bulletproof-security').'<br><br>'.__('If a particular User Agent|Bot is generating excessive log entries you can add it to Add User Agents|Bots to Ignore|Not Log tool and that User Agent|Bot will no longer be logged. See the Ignoring|Not Logging User Agents|Bots help section.', 'bulletproof-security').'<strong><br><br>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('JTC Anti-Spam|Anti-Hacker Logging is turned On or Off with the JTC Logging option setting on the JTC Anti-Spam|Anti-Hacker page.', 'bulletproof-security').'<strong><br><br>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('The S-Monitor Email Alerting & Log File Options will only send log files up to 2MB in size. 500KB is the recommend maximum size setting that you should use for when to automatically email your Security Log File to you.', 'bulletproof-security').'<strong><br><br>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('BPS logs all 403 errors, but a 403 error may not necessarily be caused by BPS. Use the troubleshooting steps in this link: http://forum.ait-pro.com/forums/topic/read-me-first-pro/#bps-pro-general-troubleshooting to confirm or eliminate that the 403 error is being caused by BPS.', 'bulletproof-security').'<br><br>'.__('The Security Log logs 400 and 403 HTTP Response Status Codes by default. You can also log 404 HTTP Response Status Codes by opening this BPS Pro 404 Template file - /bulletproof-security/404.php and copying the logging code into your Theme\'s 404 Template file. When you open the BPS Pro 404.php file you will see simple instructions on how to add the 404 logging code to your Theme\'s 404 Template file.', 'bulletproof-security').'<br><br><strong>'.__('HTTP Response Status Codes', 'bulletproof-security').'</strong><br>'.__('400 Bad Request - The request could not be understood by the server due to malformed syntax.', 'bulletproof-security').'<br><br>'.__('403 Forbidden - The Server understood the request, but is refusing to fulfill it.', 'bulletproof-security').'<br><br>'.__('404 Not Found - The server has not found anything matching the Request-URI/URL. No indication is given of whether the condition is temporary or permanent.', 'bulletproof-security').'<br><br><strong>'.__('Security Log File Size', 'bulletproof-security').'</strong><br>'.__('Displays the size of your Security Log file. If your log file is larger than 2MB then you will see a Red warning message displayed: The S-Monitor Email Alerting & Log File Options will only send log files up to 2MB in size. Copy and paste the Security Log file contents into a Notepad text file on your computer and save it. Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'<br><br><strong>'.__('Security Log Status', 'bulletproof-security').'</strong><br>'.__('Displays either Logging is Turned On or Logging is Turned Off.', 'bulletproof-security').'<br><br><strong>'.__('Security Log Last Modified Time:', 'bulletproof-security').'</strong><br>'.__('Security Log Alerts are displayed when a new security log entry is made in your Security Log file. When this happens your Last Modified Time in File: time stamp will be different than your Last Modified Time in DB: time stamp. In order to clear the Security Log Alert and synchronize/reset your DB and File time stamps so they are the same, click the Reset Last Modified Time in DB button.', 'bulletproof-security').'<br><br><strong>'.__('Turn Off Logging', 'bulletproof-security').'</strong><br>'.__('Turns Off HTTP 400, 403 & 404 Security Logging. NOTE: JTC Anti-Spam|Anti-Hacker Logging is turned On or Off with the JTC Logging option setting on the JTC Anti-Spam|Anti-Hacker page.', 'bulletproof-security').'<br><br><strong>'.__('Turn On Logging', 'bulletproof-security').'</strong><br>'.__('Turns On HTTP 400, 403 & 404 Security Logging. NOTE: JTC Anti-Spam|Anti-Hacker Logging is turned On or Off with the JTC Logging option setting on the JTC Anti-Spam|Anti-Hacker page.', 'bulletproof-security').'<br><br><strong>'.__('Delete Log Button', 'bulletproof-security').'</strong><br>'.__('Clicking the Delete Log button will delete the entire contents of your Security Log File. If you have setup S-Monitor Email Alerting & Log Options then the only time you would probably need to use the Delete Log button is if your Security Log file exceeds 2MB in size.', 'bulletproof-security').'<br><br><strong>'.__('Ignoring|Not Logging User Agents|Bots - Allowing|Logging User Agents|Bots', 'bulletproof-security').'</strong><br>'.__('Adding or Removing User Agents|Bots adds or removes User Agents|Bots to your Database and also writes new code to the 403.php Security Logging template. The 403.php Security Logging file is where the check occurs whether or not to log or not log a User Agent/Bot. It would be foolish and costly to website performance to have your WordPress database handle the task/function/burden of checking which User Agents/Bots to log or not log. WordPress database queries are the most resource draining function of a WordPress website. The more database queries that are happening at the same time on your website the slower your website will perform and load. For this reason the Security Logging check is done from code in the 403.php Security Logging file.', 'bulletproof-security').'<br><br>'.__('If a particular User Agent/Bot is being logged excessively in your Security Log file you can Ignore/Not Log that particular User Agent/Bot based on the HTTP_USER_AGENT string in your Security Log. Example User Agent strings: Mozilla/5.0 (compatible; 008/0.85; http://www.80legs.com/webcrawler.html) Gecko/2008032620 and facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php). You could enter 008 or 80legs or webcrawler to Ignore/Not Log the 80legs User Agent/Bot. You could enter facebookexternalhit or facebook or externalhit_uatext to Ignore/Not Log the facebook User Agent/Bot.', 'bulletproof-security').'<br><br><strong>'.__('Add User Agents|Bots to Ignore|Not Log', 'bulletproof-security').'</strong><br>'.__('Add the User Agent/Bot names you would like to Ignore/Not Log in your Security Log.', 'bulletproof-security').'<br><br><strong>'.__('Removing User Agents|Bots to Allow|Log', 'bulletproof-security').'</strong><br>'.__('To search for ALL User Agents/Bots to remove/delete from your database leave the text box blank and click the Remove|Allow button. You will see a Dynamically generated Radio Button Form that will display the User Agents/Bots in the BPS User Agent/Bot database Table, Remove or Do Not Remove Radio buttons and the Timestamp when the User Agent/Bot was added to your DB. Select the Remove Radio buttons for the User Agents/Bots you want to remove/delete from your database and click the Remove button. Removing/deleting User Agents/Bots from your database means that you want to have these User Agents/Bots logged again in your Security Log.', 'bulletproof-security'); echo $text; ?></p>
</div>

<?php
// Get the Current / Last Modifed Date of the Security Log File
function bps_getSecurityLogLastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( @file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// String comparison of Security Log DB Last Modified Time and Actual File Last Modified Time
function bps_SecurityLogModTimeDiff() {
$options = get_option('bulletproof_security_options_Security_log');
$last_modified_time = bps_getSecurityLogLastMod();
$last_modified_time_db = $options['bps_security_log_date_mod'];
	
	if ($options['bps_security_log_date_mod'] == '') {
		$text = '<font color="red" style="padding-right:5px;"><strong>'.__('Click the Reset Last Modified Time in DB button', 'bulletproof-security').'<br>'.__('to set the', 'bulletproof-security').'</strong></font>';
		echo $text;
	}
	
	if (strcmp($last_modified_time, $last_modified_time_db) == 0) { // 0 is equal
		$text = '<font color="green" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	} else {
		$text = '<font color="red" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	}
}

// Get File Size of the Security Log File
function bps_getSecurityLogSize() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

if ( @file_exists($filename) ) {
	$logSize = filesize($filename);
	
	if ($logSize < 2097152) {
 		$text = '<strong>'. __('Security Log File Size: ', 'bulletproof-security').'<font color="#2ea2cc">'. round($logSize / 1024, 2) .' KB</font></strong><br>';
		echo $text;
	} else {
 		$text = '<strong>'. __('Security Log File Size: ', 'bulletproof-security').'<font color="red">'. round($logSize / 1024, 2) .' KB<br>'.__('Your Security Log file is larger than 2MB. It appears that BPS is unable to automatically zip, email and delete your Security Log file.', 'bulletproof-security').'</font></strong><br>'.__('Check your S-Monitor Email Alerting & Log File Options.', 'bulletproof-security').'<br>'.__('You can manually delete the contents of this log file by clicking the Delete Log button.', 'bulletproof-security').'<br>';		
		echo $text;
	}
	}
}
bps_getSecurityLogSize();

// Echo Error Logging On or Off
function bpsErrorLoggingOnOff() {
$filename = ABSPATH . '.htaccess';
$check_string = @file_get_contents($filename);
$pattern = '/#ErrorDocument\s400(.*)ErrorDocument\s404\s(.*)\/404\.php/s';	

	if ( @file_exists($filename) && preg_match($pattern, $check_string, $matches) ) {
		$text = '<strong>'.__('Security Log Status: ', 'bulletproof-security').'<font color="#2ea2cc">'.__('Logging is Turned Off', 'bulletproof-security').'</font></strong><br><br>';
		echo $text;
	} else {
		$text = '<strong>'.__('Security Log Status: ', 'bulletproof-security').'<font color="#2ea2cc">'.__('Logging is Turned On', 'bulletproof-security').'</font></strong><br><br>';
		echo $text;		
	}
}
echo bpsErrorLoggingOnOff();

// Form - Delete Security Log file
if (isset($_POST['Submit-Delete-Log']) && current_user_can('manage_options')) {
	check_admin_referer( 'bps-delete-security-log' );

$options = get_option('bulletproof_security_options_Security_log');
$last_modified_time_db = $options['bps_security_log_date_mod'];
$time = strtotime($last_modified_time_db); 
$SecurityLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$SecurityLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt'; 
	
	if ( copy($SecurityLogMaster, $SecurityLog) ) {
		@touch($SecurityLog, $time);	
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Success! Your Security Log file has been deleted and replaced with a new blank Security Log file.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;
	}
}

// Security Log Form - Add User Agents to DB and write them to the 403.php template
if (isset($_POST['Submit-UserAgent-Ignore']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_useragent_ignore' );   
		
$userAgent = trim(stripslashes($_POST['user-agent-ignore']));
$table_name = $wpdb->prefix . "bpspro_seclog_ignore";
$blankFile = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
$userAgentMaster = WP_CONTENT_DIR . '/bps-backup/master-backups/UserAgentMaster.txt';
$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';
$bps403FileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/403.php';
$ARQdir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/';
$search = '';		

	// characters that are not allowed: / and |
	if ( $userAgent != '' && !preg_match ('#/#', $userAgent) || !preg_match ('#|#', $userAgent) ) {
		
		echo $bps_topDiv;
		$rows_affected = $wpdb->insert( $table_name, array( 'time' => current_time('mysql'), 'user_agent_bot' => $userAgent ) );
		$text = '<font color="green"><strong>'.__('Success! ', 'bulletproof-security').$userAgent.__(' User Agent/Bot has been added to your DB. ', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		
	} else {
		
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('Error: ', 'bulletproof-security').$userAgent.__(' User Agent/Bot was not successfully added. Click the Read Help button for examples of valid User Agent/Bot names.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;		
	}

	if ( !file_exists($bps403File) ) {
			$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps403File.__(' does not exist.', 'bulletproof-security').'</strong></font>';
			echo $text;		
	}
	
	if ( file_exists($blankFile) ) {
		copy($blankFile, $userAgentMaster);
	}

	$getSecLogTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE user_agent_bot LIKE %s", "%$search%") );
	$UserAgentRules = array();
		
	if ( $wpdb->num_rows != 0 ) {	
		
		foreach ($getSecLogTable as $row) {
			$UserAgentRules[] = "(.*)".$row->user_agent_bot."(.*)|";
			file_put_contents($userAgentMaster, $UserAgentRules);
		}
	
	$UserAgentRulesT = file_get_contents($userAgentMaster);
	$stringReplace = file_get_contents($bps403File);

			$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/".trim($UserAgentRulesT, "|")."/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);
		
		if ( !file_put_contents($bps403File, $stringReplace) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to write to file ', 'bulletproof-security').$bps403File.__('. Check that file permissions allow writing to this file. If you have a DSO Server check file and folder Ownership.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		
		} else {
			
			if ( is_dir($ARQdir) ) {
				copy($bps403File, $bps403FileARQ);
			}
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Success! The BPS 403.php Security Logging template file has been updated. This User Agent/Bot will be no longer be logged in your Security Log.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		}
	}
}
?>

<form name="SecurityLogModDate" action="options.php" method="post">
<?php settings_fields('bulletproof_security_options_Security_log'); ?> 
<?php $options = get_option('bulletproof_security_options_Security_log'); ?>
    <label for="SecLog"><strong><?php _e('Security Log Last Modified Time:', 'bulletproof-security'); ?></strong></label><br />
	<label for="SecLog"><strong><?php echo bps_SecurityLogModTimeDiff(); ?></strong><?php echo $options['bps_security_log_date_mod']; ?></label><br />
	<label for="SecLog"><strong><?php _e('Last Modified Time in File:', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options_Security_log[bps_security_log_date_mod]" style="color:#2ea2cc;font-size:13px;width:200px;padding-left:4px;font-weight:bold;border:none;background:none;outline:none;-webkit-box-shadow:none;box-shadow:none;-webkit-transition:none;transition:none;" value="<?php echo bps_getSecurityLogLastMod(); ?>" /><br />
	<input type="submit" name="Submit-SecLog-Mod" class="button bps-button"  style="margin-top:10px;" value="<?php esc_attr_e('Reset Last Modified Time in DB', 'bulletproof-security') ?>" />
</form>

<div id="SecurityLogTable" style="position:relative; top:0px; left:0px; margin:15px 0px 15px -3px;">
<table width="500" border="0">
  <tr>
    <td>
<form name="BPSErrorLogOff" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bps-error-log-off'); ?>
<input type="submit" name="Submit-Error-Log-Off" value="<?php esc_attr_e('Turn Off Logging', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('NOTE: JTC Anti-Spam|Anti-Hacker Logging is turned On or Off with the JTC Logging option setting on the JTC Anti-Spam|Anti-Hacker page.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Turn Off 400, 403 & 404 Logging or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</td>
    <td>
<form name="BPSErrorLogOn" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bps-error-log-on'); ?>
<input type="submit" name="Submit-Error-Log-On" value="<?php esc_attr_e('Turn On Logging', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('NOTE: JTC Anti-Spam|Anti-Hacker Logging is turned On or Off with the JTC Logging option setting on the JTC Anti-Spam|Anti-Hacker page.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Turn On 400, 403 & 404 Logging or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</td>
    <td>
<form name="DeleteLogForm" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bps-delete-security-log'); ?>
<input type="submit" name="Submit-Delete-Log" value="<?php esc_attr_e('Delete Log', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will delete the contents of your Security Log file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Delete the Log file contents or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</td>
  </tr>
</table>
</div>

<div id="bpsUserAgent1" style="margin:0px 0px 0px 0px;">
<form action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bulletproof_security_useragent_ignore'); ?>
    <strong><label for="UA-ignore"><?php _e('Add User Agents|Bots to Ignore|Not Log', 'bulletproof-security'); ?></label></strong><br />
    <strong><label for="UA-ignore"><?php _e('Click the Read Me Help button for examples', 'bulletproof-security'); ?></label></strong><br />    
    <input type="text" name="user-agent-ignore" class="regular-text" style="width:320px;" value="" />
    <input type="submit" name="Submit-UserAgent-Ignore" value="<?php esc_attr_e('Add|Ignore', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will Add the User Agent/Bot name you have entered to your DB and the 403.php Security Logging template.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Security logging checks are done by the 403.php Security Logging file and not by DB Queries.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('To remove User Agents/Bots from being ignored/not logged use the Remove|Allow tool.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<?php
/**************************************/
//  BEGIN Dynamic Security Log Form   //
/**************************************/

	// Initial User Agent/Bot Search Form - hands off to Dynamic Radio Button Form
	echo '<form name="bpsDB-UA-Search" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">';
	wp_nonce_field('bulletproof_security_seclog_db_search');
	echo '<strong>'.__('Remove User Agents|Bots to Allow|Log', 'bulletproof-security').'</strong><br>';
	echo '<input type="text" name="userAgentSearchRemove" class="regular-text" style="width:320px;" value="" />';
	echo '<input type="submit" name="Submit-SecLog-Search" value="'.esc_attr('Remove|Allow', 'bulletproof-security').'" class="button bps-button" style="margin-left:4px;" onclick="return confirm('."'".__('Clicking OK will search your database and display User Agent/Bot DB search results in a Dynamic Radio button Form.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('To search for ALL User Agents/Bots to remove/delete from your database leave the text box blank and click the Remove|Allow button.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security')."'".')" />';
	echo '</form><br><br>';

// Get the Search Post variable for processing other search/remove Forms 
if (isset($_POST['Submit-SecLog-Search']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_seclog_db_search' );
	
$search = $_POST['userAgentSearchRemove'];
$bpspro_seclog_table = $wpdb->prefix . "bpspro_seclog_ignore";
$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';
$bps403FileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/403.php';
$ARQdir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/';
$searchAll = '';
$stringReplace = file_get_contents($bps403File);

		if ( !file_exists($bps403File) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps403File.__(' does not exist.', 'bulletproof-security').'</strong></font>';
			echo $text;		
			echo $bps_bottomDiv;
		}

			$getSecLogTableSearch = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_seclog_table WHERE user_agent_bot LIKE %s", "%$searchAll%") );
			
		if ($wpdb->num_rows == 0) { // if no rows exist in DB add the BPSUserAgentPlaceHolder back into the 403.php security logging template
			
			$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/BPSUserAgentPlaceHolder/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);		
		
		if ( !file_put_contents($bps403File, $stringReplace) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to write to file ', 'bulletproof-security').$bps403File.__('. Check that file permissions allow writing to this file. If you have a DSO Server check file and folder Ownership.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		} else {
			if ( is_dir($ARQdir) ) {
				copy($bps403File, $bps403FileARQ);
			}
		}		
		} // end if ($wpdb->num_rows == 0) { // No database rows
}
		
// Remove User Agents/Bots Dynamic Radio button Form proccessing code
if (isset($_POST['Submit-SecLog-Remove']) && current_user_can('manage_options')) {
	check_admin_referer('bulletproof_security_seclog_db_remove');
	
$removeornot = $_POST['removeornot'];
$bpspro_seclog_table = $wpdb->prefix . "bpspro_seclog_ignore";
$userAgentMaster = WP_CONTENT_DIR . '/bps-backup/master-backups/UserAgentMaster.txt';
$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';
$bps403FileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/403.php';
$ARQdir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/';
$searchALLD = '';

	switch( $_POST['Submit-SecLog-Remove'] ) {
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
			$donotremove = substr($donotremove, 2);
		
		if ( ! empty($remove_rows) ) {
			
			foreach ( $remove_rows as $remove_row ) {
				if ( ! $delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_seclog_table WHERE user_agent_bot = %s", $remove_row) )) {
					$textSecLogRemove = '<font color="red"><strong>'.sprintf(__('%s unable to delete row from your DB.', 'bulletproof-security'), $remove_row).'</strong></font><br>';			
				} else {
					$textSecLogRemove = '<font color="green"><strong>'.sprintf(__('%s has been deleted from your DB.', 'bulletproof-security'), $remove_row).'</strong></font><br>';
	
					$getSecLogTableRemove = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_seclog_table WHERE user_agent_bot LIKE %s", "%$searchALLD%") );
					$UserAgentRules = array();		

					foreach ( $getSecLogTableRemove as $row ) {
						$UserAgentRules[] = "(.*)".$row->user_agent_bot."(.*)|";
						file_put_contents($userAgentMaster, $UserAgentRules);
					}
				} // end if ( !$delete_row
			} // foreach ($remove_rows as $remove_row) {

			// Important these variables MUST BE HERE inside the switch
			$UserAgentRulesT = file_get_contents($userAgentMaster);
			$stringReplace = file_get_contents($bps403File);
					
			$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/".trim($UserAgentRulesT, "|")."/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);

		if ( !file_put_contents($bps403File, $stringReplace) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Unable to write to file ', 'bulletproof-security').$bps403File.__('. Check that file permissions allow writing to this file. If you have a DSO Server check file and folder Ownership.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		
		} else {

			// need to run the Query again just in case there are 0 DB rows
			$getSecLogTableRemove = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_seclog_table WHERE user_agent_bot LIKE %s", "%$searchAll%") );
			
		if ($wpdb->num_rows == 0) { // if no rows exist in DB add the BPSUserAgentPlaceHolder back into the 403.php security logging template
			
			$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/BPSUserAgentPlaceHolder/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);
			file_put_contents($bps403File, $stringReplace);		
		}
			
		if ( is_dir($ARQdir) ) {
			copy($bps403File, $bps403FileARQ);
		}
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Success! The BPS 403.php Security Logging template file has been updated. This User Agent/Bot will be logged again in your Security Log.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		}
		} // end if (!empty($remove_rows)) { // no rows selected to delete
		
		if (!empty($donotremove)) {
		// do nothing here - do not echo a message because it would be repeated X times
		//$textDB = '<font color="green">'.sprintf(__('DB Rows %s Not Removed', 'bulletproof-security'), $donotremove).'</font>';
		}
		break;
	} // end switch
}
			
if ( !empty($textSecLogRemove) ) { 
echo '<!-- Last Action --><div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>'.$textSecLogRemove.'</p></div>'; 
}
?>

<!-- Dynamic User Agent/Bot Radio Button Remove Form -->
<form name="bpsSecLogRadio" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bulletproof_security_seclog_db_remove'); ?>
<?php	
	
	$bpspro_seclog_table = $wpdb->prefix . "bpspro_seclog_ignore";
	$search = @$_POST['userAgentSearchRemove'];

	if ( isset($_POST['Submit-SecLog-Search']) ) {

	$getSecLogTableSearchForm = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_seclog_table WHERE user_agent_bot LIKE %s", "%$search%") );
		
		echo '<h3>'.__('Search Results For User Agents|Bots To Remove', 'bulletproof-security').'</h3>';	
		echo '<table class="widefat" style="margin-bottom:20px;width:675px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('User Agents|Bots in DB', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><strong>'.__('Do Not<br>Remove', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Time Added<br>To DB', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ($getSecLogTableSearchForm as $row) {
		
		echo '<th scope="row" style="border-bottom:none;">'.$row->user_agent_bot.'</th>';
		echo "<td><input type=\"radio\" id=\"remove\" name=\"removeornot[$row->user_agent_bot]\" value=\"remove\" /></td>";
		echo "<td><input type=\"radio\" id=\"donotremove\" name=\"removeornot[$row->user_agent_bot]\" value=\"donotremove\" checked /></td>";
		echo '<td>'.$row->time.'</td>'; 
		echo '</tr>';			
		}
		echo '</tbody>';
		echo '</table>';	
		if ($wpdb->num_rows != 0) {		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="green"><strong>'.__('Your DB Search Results For User Agents|Bots To Remove are displayed below the Remove|Allow Search tool.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		} else {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="blue"><strong>'.__('You do not have any User Agents|Bots in your DB To Remove. An empty/blank dynamic radio button form is displayed below the Remove|Allow Search tool since you do not have any User Agents|Bot to remove.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
		}
	echo '</p></div>';

?>
<input type="submit" name="Submit-SecLog-Remove" value="<?php _e('Remove', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will Remove the User Agent|Bot DB entries for any Remove Radio button selections you have made. User Agents|Bots will also be removed from the 403.php Security Logging template.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('To add a User Agent|Bot, use the Add|Ignore tool.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form><br />
<?php } 
/*************************************/
//   END Dynamic Security Log Form   //
/*************************************/
?>

<div id="messageinner" class="updatedinner" style="width:690px;">

<?php
// Get BPS Security log file contents
function bps_get_security_log() {
if (current_user_can('manage_options')) {
$bps_sec_log = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);

	if ( file_exists($bps_sec_log) ) {
		$bps_sec_log = file_get_contents($bps_sec_log);
	return esc_html($bps_sec_log);
	} else {
	echo $bps_topDiv;
	_e('The Security Log File Was Not Found! Check that the file really exists here - /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/logs/http_error_log.txt and is named correctly.', 'bulletproof-security');
	echo $bps_bottomDiv;
	}
	}
}

// Form - Security Log - Perform File Open and Write test - If append write test is successful write to file
if (current_user_can('manage_options')) {
$bps_sec_log = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$write_test = "";
	if (is_writable($bps_sec_log)) {
    if (!$handle = fopen($bps_sec_log, 'a+b')) {
	    exit;
    }
    if (fwrite($handle, $write_test) === FALSE) {
		exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your Security Log file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	}
	
	if (isset($_POST['submit-security-log']) && current_user_can('manage_options')) {
	check_admin_referer( 'bulletproof_security_save_security_log' );
	$newcontentSecLog = stripslashes($_POST['newcontentSecLog']);
	if ( is_writable($bps_sec_log) ) {
		$handle = fopen($bps_sec_log, 'w+b');
		fwrite($handle, $newcontentSecLog);
	$text = '<font color="green"><strong>'.__('Success! Your Security Log file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
}
$scrolltoSecLog = isset($_REQUEST['scrolltoSecLog']) ? (int) $_REQUEST['scrolltoSecLog'] : 0;
?>
</div>

<div id="SecLogEditor">
<form name="bpsSecLog" id="bpsSecLog" action="admin.php?page=bulletproof-security/admin/security-log/security-log.php" method="post">
<?php wp_nonce_field('bulletproof_security_save_security_log'); ?>
<div id="bpsSecLog">
    <textarea class="bps-text-area-600x700" name="newcontentSecLog" id="newcontentSecLog" tabindex="1"><?php echo bps_get_security_log(); ?></textarea>
	<input type="hidden" name="scrolltoSecLog" id="scrolltoSecLog" value="<?php echo esc_html($scrolltoSecLog); ?>" />
    <p class="submit">
	<input type="submit" name="submit-security-log" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#bpsSecLog').submit(function(){ $('#scrolltoSecLog').val( $('#newcontentSecLog').scrollTop() ); });
	$('#newcontentSecLog').scrollTop( $('#scrolltoSecLog').val() ); 
});
/* ]]> */
</script>
</div>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

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
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/security-log-http-error-log-read-me-first/" target="_blank"><?php _e('Security|HTTP Error Log Guide & Troubleshooting', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links">&nbsp;</td>
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