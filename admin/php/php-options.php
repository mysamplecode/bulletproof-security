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

// S-Monitor BPS Security Status for Root and wp-admin (only if problem) - displayed in BPS Only
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
$bpsSpacePop = '-------------------------------------------------------------';

// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Obsolete file cleanup / deletion
//echo bpsRemoveObs();

// Manually runs real-time BPS Pro version update check - for testing ONLY
// echo bpsPro_update_checks();
// Manually runs PHP Error Log cron function - for testing ONLY
// echo bps_smonitor_ELogModTimeDiff_wp_email();

// Create the PHPinfo Deny All .htaccess file with users current IP address on page load
// and send a copy to ARQ backup
function bpsPhpinfoDenyAll() {
	$bps_get_IP = $_SERVER['REMOTE_ADDR'];
	$bps_denyall_content = "order deny,allow\ndeny from all\nallow from $bps_get_IP";
	$denyall_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/.htaccess';
	
	if ( is_writable($denyall_htaccess_file) ) {
	if ( !$handle = fopen($denyall_htaccess_file, 'w+b') ) {
         exit;
    }
    if ( fwrite($handle, $bps_denyall_content) === FALSE ) {
		 exit;
    }
    fclose($handle);
	}
	
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/php/.htaccess';
	@copy($denyall_htaccess_file, $htaccessARQ);
}
echo bpsPhpinfoDenyAll();

// Enable PHPINFO Viewer - writes a new denyall htaccess file with the users current IP address
if ( isset( $_POST['bps-view-phpinfo'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-view-phpinfo-check' );
	
	$bps_get_IP = $_SERVER['REMOTE_ADDR'];
	$bps_denyall_content = "order deny,allow\ndeny from all\nallow from $bps_get_IP";
	$denyall_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/.htaccess';
	
	if ( is_writable($denyall_htaccess_file) ) {
	if ( ! $handle = fopen($denyall_htaccess_file, 'w+b') ) {
         exit;
    }
    if ( fwrite($handle, $bps_denyall_content) === FALSE ) {
		 exit;
    }
    echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('PHPINFO File viewing is enabled for your IP address only', 'bulletproof-security').' === ' .$bps_get_IP.__(' Your PHPINFO file is htaccess protected.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/php/.htaccess';
	@copy($denyall_htaccess_file, $htaccessARQ);
	
	} else {
    
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('The file ', 'bulletproof-security').$denyall_htaccess_file.__(' is not writable or does not exist.', 'bulletproof-security').'</strong></font><br><strong>'.__('If this is not the problem', 'bulletproof-security').' click <a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank">'.__('here', 'bulletproof-security').'</a> '.__('for more help info.', 'bulletproof-security').'</strong><br>';
	echo $text;
	echo $bps_bottomDiv;
	}
}

// Create the phpinfo-IP.php file - writes a new phpinfo-IP.php file with the users current IP address
if ( isset( $_POST['bps-create-phpinfo-multi'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_phpinfo_create' );
	
$bps_get_IP = $_SERVER['REMOTE_ADDR'];
$phpinfoIPContent = "<?php if ".'($_SERVER['."'".'REMOTE_ADDR'."'".']'." == '$bps_get_IP') { 
phpinfo();
} else {
header(".'"Status: 404 Not Found"'.");
header(".'"HTTP/1.0 404 Not Found"'.");
exit();
}
?>";
	$phpinfoIP = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/phpinfo-IP.php';
	$phpinfoIPARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/php/phpinfo-IP.php';
	
	if ( is_writable($phpinfoIP) ) {
	if ( ! $handle = fopen($phpinfoIP, 'w+b') ) {
         exit;
    }
    if ( fwrite($handle, $phpinfoIPContent) === FALSE ) {
        exit;
    }
    
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('The phpinfo-IP.php file was created successfully with your current IP address', 'bulletproof-security').' === ' . $bps_get_IP.'</strong></font><br>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	@copy($phpinfoIP, $phpinfoIPARQ);
	
	} else {
    
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('The file ', 'bulletproof-security').$phpinfoIP.__(' is not writable or does not exist.', 'bulletproof-security').'</strong></font><br><strong>'.__('If this is not the problem click', 'bulletproof-security').' <a href="http://www.ait-pro.com/aitpro-blog/2566/bulletproof-security-plugin-support/bulletproof-security-error-messages" target="_blank">'.__('here', 'bulletproof-security').'</a> '.__('for more help info.', 'bulletproof-security').'</strong><br>';
	echo $text;
	echo $bps_bottomDiv;
	}
}

// Form - Copy the phpinfo file for the PHP Multi Viewer to the folder path and file name specified by user
// Pass user entered URL string to PHPinfo Multi Viewer
if ( isset( $_POST['bps-copy-phpinfo-multi'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_phpinfo_copy' );
	
	$phpinfoIP = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/phpinfo-IP.php';
	$bpsSaveLocPhpinfo = trim( $_POST['bps-phpinfo-save-path'] );
	$bpsViewPhpinfo = trim( $_POST['bps-phpinfo-url-path'] );
	$bpsViewPhpinfoH = $_POST['bpsViewPhpinfoH'];

	//copy($phpinfoIP, $bpsSaveLocPhpinfo);
	
	if ( ! copy($phpinfoIP, $bpsSaveLocPhpinfo) ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('Failed to copy your phpinfo file to ', 'bulletproof-security').$bpsSaveLocPhpinfo.'<br>'.__('Check that the path you entered is valid and that you have added a valid file name. Minimum folder permissions must be at least 700 in order to copy the file successfully.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
   		echo $bps_bottomDiv;
	
	} else {
	
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Your phpinfo file was copied successfully to ', 'bulletproof-security').$bpsSaveLocPhpinfo.'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}
}

// Get BPS PHP error log
function bps_get_php_error_log() {
	
	if ( current_user_can('manage_options') ) {
		$options = get_option('bulletproof_security_options2');
		$bps_php_error_log = $options['bps_error_log_location'];
	
	if ( file_exists($bps_php_error_log) ) {
		$bps_php_error_log = file_get_contents($bps_php_error_log);
		echo esc_html($bps_php_error_log);
	
	} else {
		
		_e('PHP Error Log File Not Found! Either the PHP Error Log Folder Location has not been set yet or the PHP Error Log Folder Location path that you set is incorrect. Click the Htaccess Protected Secure PHP Error Log Read Me Help button for more info.', 'bulletproof-security');
	}
	}
}

// Get Default BPS PHP error log path
function bps_get_default_php_error_log() {
	
	if ( current_user_can('manage_options') ) {
	$bps_default_php_error_log = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error.log';
	
	if ( file_exists($bps_default_php_error_log) ) {
		echo $bps_default_php_error_log;
	
	} else {
		
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_default_php_error_log.__(' was not found. Check that the file exists and is named correctly.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}
	}
}
	
// Form - php.ini Master File Maker
// CT php.ini file type: copy contents of bpspro-base-phpini.ini to the my-master-phpini.ini file
// SA php.ini file type: copy the servers default php.ini file to the my-master-phpini.ini file
if ( ! isset( $_POST['Submit-MFM'] ) )
    $chosen = array(0);
    
	else
    
	if ( isset( $_POST['Submit-MFM'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_ini_master_maker' );   
	    $chosen = $_POST['iniServerType'];
		
		$bpsServerPath = trim( $_POST['bpsini-server-path'] );
		$newMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/my-master-phpini.ini';
		$newMasterARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/php/my-master-phpini.ini';
		$basePhpini = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bpspro-base-phpini.ini';
		
		if ( $_POST['iniServerType'] == array(1) ) {

		if ( file_exists($bpsServerPath) && file_exists($newMaster) && is_writable($newMaster) ) {
			$Serverdata = file_get_contents($bpsServerPath);

			file_put_contents($newMaster, $Serverdata);
			@copy($newMaster, $newMasterARQ);
		
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Success! Your new Master custom php.ini file ', 'bulletproof-security').$newMaster.__(' was created successfully.', 'bulletproof-security').'<br><br>'.__('Click on the File Manager tab page, copy and paste the Master custom php.ini file path into any empty available File Manager slot, add this Label/Description: Master custom php.ini file and click the Save Changes button.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Failed to get the contents of the ', 'bulletproof-security').$bpsServerPath.__(' for the Default Server php.ini file. Check that the path to the Default Server php.ini file is correct. You must enter the full path including the php.ini filename. Example: /usr/local/lib/php.ini. Or the ', 'bulletproof-security').$newMaster.__(' file does not exist or the folder permissions or Ownership for the /bulletproof-security/admin/php/ folder is incorrect. Your Master php.ini file was NOT created successfully.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
			echo $bps_bottomDiv;
		}
		}
		
		if ( $_POST['iniServerType'] == array(2) ) {
		
		if ( file_exists($basePhpini) && file_exists($newMaster) && is_writable($newMaster) ) {
			$Basedata = file_get_contents($basePhpini);

			file_put_contents($newMaster, $Basedata);
			@copy($newMaster, $newMasterARQ);		

			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Success! Your new Master custom php.ini file ', 'bulletproof-security').$newMaster.__(' was created successfully.', 'bulletproof-security').'<br><br>'.__('Click on the File Manager tab page, copy and paste the Master custom php.ini file/folder path into any empty available File Manager slot, add this Label|Description: Master custom php.ini file and click the Save Changes button.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {

			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Failed to copy the ', 'bulletproof-security').$basePhpini.__(' file contents to the ', 'bulletproof-security').$newMaster.__(' file. Either the files do not exist or have been renamed or the folder permissions or Ownership for the /bulletproof-security/admin/php/ folder is incorrect. Your Master php.ini file was NOT created successfully.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		}
	}
}

// Dropdown list array for phpini Master Maker form - Server Type		
function bps_showOptionsDropMaster( $array, $active, $echo=true ) {
$string = '';
	
	foreach ( $array as $k => $v ) {
	
		if ( is_array($active) )
			$s = ( in_array($k, $active) ) ? ' selected="selected"' : '';
		else
			$s = ( $active == $k ) ? ' selected="selected"' : '';
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}
	
	if ($echo)
	echo $string;
	else
	return $string;
}

$iniServerType = array(' Select Host Server php.ini File Type:', 'Stand Alone php.ini File Type', 'Combined Total php.ini File Type');

// Form Create php.ini File - Copy the my-master-phpini.ini file to folder location entered by user
// The majority of web hosts use a Single php.ini file in the hosting root folder. Not going to do any ARQ backups for Multiple php.ini file Hosts
if ( isset( $_POST['Submit-IC'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ini_creator' );   
	
	$newMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/my-master-phpini.ini';
	$bpsSaveLoc = trim( $_POST['bpsini-save-path'] );
		
	if ( $bpsSaveLoc == $_SERVER['DOCUMENT_ROOT'] . '/php.ini' ) {
		$custom_phpini_ARQ = $_SERVER['DOCUMENT_ROOT'] . '/' . $bps_wpcontent_dir . '/bps-backup/autorestore/root-files/php.ini';
	}
	elseif ( $bpsSaveLoc == $_SERVER['DOCUMENT_ROOT'] . '/php5.ini' ) {
		$custom_phpini_ARQ = $_SERVER['DOCUMENT_ROOT'] . '/' . $bps_wpcontent_dir . '/bps-backup/autorestore/root-files/php5.ini';
	}
	elseif ( $bpsSaveLoc == ABSPATH . 'php.ini' ) {
		$custom_phpini_ARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/php.ini';
	}

	if ( file_exists($newMaster) ) {
		
		if ( ! copy($newMaster, $bpsSaveLoc) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('ERROR: Your custom php.ini file was not created. Failed to copy the Master custom php.ini File to: ', 'bulletproof-security').$bpsSaveLoc.__(' Either the my-master-phpini.ini master file does not exist, the destination folder path you entered is not valid, the file name php.ini was not added in your destination folder/file path /xxxx/xxxx/php.ini or the folder permissions or Ownership for the destination folder are not allowing the file to be copied to that folder.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;				
			$text = '<font color="green"><strong>'.__('Success! Your custom php.ini file was created successfully in this folder: ', 'bulletproof-security').$bpsSaveLoc.'<br><br>'.__('Click on the File Manager tab page, copy and paste your custom php.ini file/folder path into any empty available File Manager slot, add this Label|Description: Custom php.ini file and click the Save Changes button.', 'bulletproof-security').'<br<br>'.__('NOTE: Click the Php.ini File Creator Read Me help button for how to check if your new custom php.ini file is being seen as the loaded configuration file for your website now instead of the Server\'s default php.ini file.', 'bulletproof-security').'</strong></font>';

			if ( is_dir( str_replace( array('php.ini', 'php5.ini'), "", $custom_phpini_ARQ ) ) ) {
				copy($newMaster, $custom_phpini_ARQ);
				$text .= '<br><br><font color="green"><strong>'.__('Your custom php.ini file was backed up to this ARQ Backup folder: ', 'bulletproof-security').$custom_phpini_ARQ.'</strong></font>';			
			}
			
			echo $text;
			echo $bps_bottomDiv;
		}
	}
}

// INI Finder - Finds all files with .ini extension in case php.ini file has been renamed
// will result in additional .ini files being displayed but this is a better option
function bpsiniFinder() {
if ( isset( $_POST['bps-ini-find-submit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_find_ini_files' );
	
	$path = $_SERVER['DOCUMENT_ROOT'] . '/'; // use ABSPATH instead if you only want to search the current site
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	
	foreach ( $objects as $inifile ) {
		if ( $inifile->isFile() ) {
			$ext = strtolower( @substr( $inifile, strlen($inifile)-3 ) );
			
			if ( $ext == 'ini' ) {
				//$fileinfo->getFilename(); // get file name without path
				$fullpath = $inifile->getPathname(); // get the full path
				echo "<div class=\"iniFinderStyle\">$fullpath</div>";
			}
		}
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

require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-diagnostic-checks.php' );
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-help-text.php' );

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('P-Security ~ php.ini Security &amp; Performance', 'bulletproof-security'); ?></h2>

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
function DiagnosticChecks() {
	
    var r = confirm("Runs a Diagnostic Check for all settings that relate to php.ini files, .user.ini files, php handlers, php error log paths and other settings to troubleshoot any issues or problems.\n\n-------------------------------------------------------------\n\nRecommendations are also given based on your PHP version and your type of Hosting (Shared, VPS or Dedicated Hosting).\n\n-------------------------------------------------------------\n\nNOTE: This Diagnostic Check will display the Loaded Configuration File: that this website is using, but the php.ini and .user.ini file check ONLY searches for actual files under the current website that you are running this Diagnostic Check from. If you have multiple websites and this website is a subfolder website then you should also run this Diagnostic Check on your root website if you would like to check for the actual files. Typically php.ini and .user.ini files will be located in the root folder/root website of your Hosting account.\n\n-------------------------------------------------------------\n\nClick OK to Run the Diagnostic Check or click Cancel.");
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
		<li><a href="#bps-tabs-1"><?php _e('PHP.ini Options', 'bulletproof-security'); ?></a></li>
        <li><a href="#bps-tabs-2"><?php _e('ini_set Options', 'bulletproof-security'); ?></a></li> 
        <li><a href="#bps-tabs-3"><?php _e('File Manager', 'bulletproof-security'); ?></a></li>
        <li><a href="#bps-tabs-4"><?php _e('File Editor', 'bulletproof-security'); ?></a></li>
		<li><a href="#bps-tabs-5"><?php _e('PHP Error Log', 'bulletproof-security'); ?></a></li>
		<li><a href="#bps-tabs-6"><?php _e('PHP Info Viewer', 'bulletproof-security'); ?></a></li>
        <li><a href="#bps-tabs-7"><?php _e('Php.ini Security Status', 'bulletproof-security'); ?></a></li>
        <li><a href="#bps-tabs-8"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
	</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('PHP.ini Options ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Custom php.ini File Setup & Tools', 'bulletproof-security'); ?></span></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<form name="bpsDiagCheck1" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-1" method="post">
	<?php wp_nonce_field('bps-diagnostic-check1'); ?>

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Diagnostic Checks|Recommendations', 'bulletproof-security'); ?>
	<input type="submit" name="Submit-diagnostic-check1" value="<?php esc_attr_e('Run Check', 'bulletproof-security') ?>" class="button bps-button" style="margin-top:-5px;" onclick="DiagnosticChecks()" />
</h3>
<?php echo bpsPHPDiagCheck1(); ?>
</form>

<h3><?php _e('PHP.ini Overview', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('PHP.ini Overview', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content1; ?></p>
</div>

<div id="iniMasterMaker">
<h3><?php _e('Php.ini Master File Maker', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('Php.ini Master File Maker', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content2; ?></p>
</div>

<form action="admin.php?page=bulletproof-security/admin/php/php-options.php" method="post">
<?php wp_nonce_field('bulletproof_security_ini_master_maker'); ?>
	<strong><label for="bps-ini-file-creator"><?php $text = '<font color="#2ea2cc">'.__('View the Php.ini Master File Maker Read Me button above FIRST', 'bulletproof-security').'<br>'.__('before Making your new Master php.ini file', 'bulletproof-security').'</font><br>'; echo $text; ?></label></strong><br />
    <strong><label for="bps-ini-file-creator"><?php _e('Choose Your Host Server\'s php.ini File Type:', 'bulletproof-security'); ?> </label></strong><br />
	<select name="iniServerType[]" id="iniServerType">
	
	<?php echo bps_showOptionsDropMaster($iniServerType, $chosen, true); ?>
	
    </select><br /><br />
    <strong><label for="bps-ini-file-creator"><?php $text = __('Add your Server\'s Default php.ini file path: ', 'bulletproof-security').'(<font color="#2ea2cc">'.__('ONLY if your Host Server php.ini File Type is Stand Alone otherwise leave this blank', 'bulletproof-security').'</font>)'; echo $text; ?></label></strong><br />
    <strong><label for="bps-ini-file-creator"><?php $text = '<font color="#2ea2cc">'.__('Click the Php.ini Master File Maker Read Me help button above for how to get the Server\'s Default php.ini file path', 'bulletproof-security').'</font>'; echo $text; ?></label></strong><br />
    <input type="text" name="bpsini-server-path" value="" class="regular-text-medium" />

    <p class="submit">
    <input type="submit" name="Submit-MFM" value="<?php esc_attr_e('Make Master php.ini File', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminder: Click on the Php.ini Master File Maker Read Me help button to view help info.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to create your Master custom php.ini file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
    </p>
</form>
</div>

<div id="inicreator" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">
<h3><?php _e('Php.ini File Creator', 'bulletproof-security'); ?>  <button id="bps-open-modal3" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content3" title="<?php _e('Php.ini File Creator', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content3; ?></p>
</div>

<form action="admin.php?page=bulletproof-security/admin/php/php-options.php" method="post">
<?php wp_nonce_field('bulletproof_security_ini_creator'); ?>
<?php $options = get_option('bulletproof_security_options_ARCM'); ?>
	<strong><label for="bps-ini-file-creator"><?php $text = '<font color="#2ea2cc">'.__('View the Php.ini File Creator Read Me button above FIRST', 'bulletproof-security').'<br>'.__('before creating your custom php.ini file', 'bulletproof-security').'</font><br>'; echo $text; ?></label></strong><br />
    <strong><label for="bps-ini-file-creator"><?php $text = __('Add the full path, including the php.ini filename, where your custom php.ini file will be created:', 'bulletproof-security'); echo $text; ?></label></strong><br />
    <strong><label for="bps-ini-file-creator"><?php $text = __('Example: ', 'bulletproof-security').esc_html( $_SERVER['DOCUMENT_ROOT'] ) . '/php.ini'; echo $text; ?></label></strong><br />
    <strong><label for="bps-ini-file-creator"><?php $text = __('Go Daddy Example: ', 'bulletproof-security').esc_html( $_SERVER['DOCUMENT_ROOT'] ) . '/php5.ini'; echo $text; ?></label></strong><br />
    <input type="text" name="bpsini-save-path" value="" class="regular-text-medium" />

    <p class="submit">
   <input type="submit" name="Submit-IC" value="<?php esc_attr_e('Create php.ini File', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminder: Have you created your Master custom php.ini file FIRST with the Php.ini Master File Maker?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Reminder: Click on the Php.ini File Creator Read Me help button to view help info.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to create a custom php.ini file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</form>
</div>

<h3><?php _e('Php.ini File Finder', 'bulletproof-security'); ?>  <button id="bps-open-modal4" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content4" title="<?php _e('Php.ini File Finder', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content4; ?></p>
</div>

<form name="bpsiniFinder" action="admin.php?page=bulletproof-security/admin/php/php-options.php" method="post">
<?php wp_nonce_field('bulletproof_security_find_ini_files'); ?>
<strong><label for="bps-ini-file-finder"><?php _e('Search for existing php.ini files by clicking the Find php.ini Files button: ', 'bulletproof-security'); ?> </label></strong>

<?php echo bpsiniFinder(); ?>

<input type="hidden" name="bpsIF" value="bps-ini-finder" />
<p class="submit">
<input type="submit" name="bps-ini-find-submit" class="button bps-button" style="position:relative;top:5px;left:0px;" value="<?php esc_attr_e('Find php.ini Files', 'bulletproof-security') ?>" /></p>
</form>

      </td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>
            
<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('ini_set Options', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { 
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-ini-set-options.php' );
?>

<div id="IniSetSaveOptions" style="position:relative; top:0px; left:0px; float:left; margin:0px 0px 0px 0px;">
<?php
	if ( @$_GET['settings-updated'] == true ) {
		$text = '<font color="blue"><strong>'.__('After you have clicked the 1. Save Options button scroll down and click the 2. Enable Options button.', 'bulletproof-security').'</strong></font>';
		echo $text;
}
?>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help"> 

<form name="bpsDiagCheck2" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-2" method="post">
	<?php wp_nonce_field('bps-diagnostic-check2'); ?>

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Diagnostic Checks|Recommendations', 'bulletproof-security'); ?>
	<input type="submit" name="Submit-diagnostic-check2" value="<?php esc_attr_e('Run Check', 'bulletproof-security') ?>" class="button bps-button" style="margin-top:-5px;" onclick="DiagnosticChecks()" />
	</h3>
<?php echo bpsPHPDiagCheck2(); ?>
</form>

<h3><?php _e('ini_set Options', 'bulletproof-security'); ?>  <button id="bps-open-modal5" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content5" title="<?php _e('ini_set Options', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content5; ?></p>	
</div>

<form name="bpsIniSet" action="options.php#bps-tabs-2" method="post">
    <?php settings_fields('bulletproof_security_options_iniSet'); ?>
	<?php $options = get_option('bulletproof_security_options_iniSet'); ?>

    <table width="100%" class="widefat" style="margin-bottom:20px;">
	<thead>
	<tr>
	<th scope="col" style="width:40px;"><strong><?php _e('ini_set Settings', 'bulletproof-security')?></strong></th>
	<th scope="col" style="width:20px;"><strong><?php _e('Status', 'bulletproof-security')?></strong></th>
    <th scope="col" style="width:500px;"><strong><?php _e('Recommended Setting|Description', 'bulletproof-security')?></strong></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	
    <th scope="row">
<?php _e('Error Reporting:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_ErrorReporting]" style="width:340px;">
<option value="E_ALL|E_STRICT"<?php selected('E_ALL|E_STRICT', $options['bps_iniSet_ErrorReporting']); ?>><?php _e('E_ALL|E_STRICT', 'bulletproof-security'); ?></option>
<option value="E_ALL"<?php selected('E_ALL', $options['bps_iniSet_ErrorReporting']); ?>><?php _e('E_ALL', 'bulletproof-security'); ?></option>
<option value="E_ERROR"<?php selected('E_ERROR', $options['bps_iniSet_ErrorReporting']); ?>><?php _e('E_ERROR', 'bulletproof-security'); ?></option>
<option value="E_ERROR|E_WARNING"<?php selected('E_ERROR|E_WARNING', $options['bps_iniSet_ErrorReporting']); ?>><?php _e('E_ERROR|E_WARNING', 'bulletproof-security'); ?></option>
<option value="E_ERROR|E_WARNING|E_PARSE"<?php selected('E_ERROR|E_WARNING|E_PARSE', $options['bps_iniSet_ErrorReporting']); ?>><?php _e('E_ERROR|E_WARNING|E_PARSE', 'bulletproof-security'); ?></option>
</select>   
    </th>
	<td><strong>
<?php if ( $options['bps_iniSet_ErrorReporting'] != '' ) { echo $options['bps_iniSet_ErrorReporting']; } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
	<?php $text = '<strong>'.__('Recommended Setting: E_ALL|E_STRICT ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('E_ALL logs all errors and warnings, except level E_STRICT. E_STRICT logs errors related to code that does meet the new stricter PHP coding standards. E_ERROR logs Fatal run-time errors. E_WARNING logs Warning run-time errors. E_PARSE logs Compile-time Parse errors.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Log PHP Errors:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_LogErrors]" style="width:340px;">
<option value="On"<?php selected('On', $options['bps_iniSet_LogErrors']); ?>><?php _e('Turn On PHP Error Logging', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_iniSet_LogErrors']); ?>><?php _e('Turn Off PHP Error Logging', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('log_errors') == 'On' && $options['bps_iniSet_LogErrors'] == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('log_errors') == 0 && $options['bps_iniSet_LogErrors'] == 'Off' ) { 	
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( $options['bps_iniSet_LogErrors'] == '' ) { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>    
	</td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: On ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Turn PHP Error Logging On or Off.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('ini_set PHP Error Log Location Set To:', 'bulletproof-security'); ?>
<input type="text" name="bulletproof_security_options_iniSet[bps_iniSet_ErrorLog]" value="<?php if ( $options['bps_iniSet_ErrorLog'] != '' ) { echo $options['bps_iniSet_ErrorLog']; } else { echo addslashes( WP_CONTENT_DIR.'/bps-backup/logs/bps_php_error.log' ); } ?>" style="width:340px; padding:2px; margin-left:0px; font-size:11px;" />
    </th>
	<td>
    <strong><?php if ( $options['bps_iniSet_ErrorLog'] != '' ) { _e('Set', 'bulletproof-security'); } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: ', 'bulletproof-security').WP_CONTENT_DIR.'/bps-backup/logs/bps_php_error.log<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('It is recommended that your php error log file location should be in the /bps-backup/logs folder. The BPS Pro logs folder is htaccess protected and can only be accessed by you.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Log Errors Max Length:', 'bulletproof-security'); ?>
<input type="text" name="bulletproof_security_options_iniSet[bps_iniSet_LogErrorsMaxLen]" value="<?php if ( $options['bps_iniSet_LogErrorsMaxLen'] != '' ) { echo $options['bps_iniSet_LogErrorsMaxLen']; } else { echo ini_get('log_errors_max_len'); } ?>" style="width:340px; padding:2px; margin-left:0px;" />    
    </th>
	<td><strong>
<?php if ( $options['bps_iniSet_LogErrorsMaxLen'] != '' ) { echo $options['bps_iniSet_LogErrorsMaxLen']; } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: 1024 ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Set the maximum length of log_errors in bytes. In error_log information about the source is added. The default is 1024 and 0 allows to not apply any maximum length at all. This length is applied to logged errors, displayed errors and also to $php_errormsg. Your current Log Errors Max Length is displayed by default.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Memory Limit:', 'bulletproof-security'); ?>
<input type="text" name="bulletproof_security_options_iniSet[bps_iniSet_MemoryLimit]" value="<?php if ( $options['bps_iniSet_MemoryLimit'] != '' ) { echo $options['bps_iniSet_MemoryLimit']; } else { echo get_cfg_var('memory_limit'); } ?>" style="width:340px; padding:2px; margin-left:0px;" />     
    </th>
	<td><strong>
<?php if ( $options['bps_iniSet_MemoryLimit'] != '' ) { echo $options['bps_iniSet_MemoryLimit']; } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Read Description', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Your current memory limit is displayed/selected by default in the text box. The Memory Limit setting sets the maximum amount of memory in bytes that a script is allowed to allocate. Check your Web Host help pages to find the maximum memory limit setting allowed for your particular Web Host. Do not set the maximum memory limit higher than your Host allows or your website account/hosting account could get suspended.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('HttpOnly:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_session_cookie_httponly]" style="width:340px;">
<option value="On"<?php selected('On', $options['bps_iniSet_session_cookie_httponly']); ?>><?php _e('Turn On HttpOnly', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_iniSet_session_cookie_httponly']); ?>><?php _e('Turn Off HttpOnly', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('session.cookie_httponly') == 'On' && $options['bps_iniSet_session_cookie_httponly'] == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('session.cookie_httponly') == 0 && $options['bps_iniSet_session_cookie_httponly'] == 'Off' ) { 	
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} 
	if ( $options['bps_iniSet_session_cookie_httponly'] == '' ) { 	 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: On ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('session.cookie_httponly marks the cookie as accessible only through the HTTP protocol. This means that the cookie won\'t be accessible by scripting languages, such as JavaScript. This setting can effectively help to reduce identity theft through XSS attacks (As of 2011, 99% of browsers and most web application frameworks do support httpOnly).', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Session Use Only Cookies:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_session_use_only_cookies]" style="width:340px;">
<option value="On"<?php selected('On', $options['bps_iniSet_session_use_only_cookies']); ?>><?php _e('Turn On Session Use Only Cookies', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_iniSet_session_use_only_cookies']); ?>><?php _e('Turn Off Session Use Only Cookies', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('session.use_only_cookies') == 'On' && $options['bps_iniSet_session_use_only_cookies'] == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('session.use_only_cookies') == 0 && $options['bps_iniSet_session_use_only_cookies'] == 'Off' ) { 	
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} 
	if ( $options['bps_iniSet_session_use_only_cookies'] == '' ) { 	 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: On ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('session.use_only_cookies specifies whether the module will only use cookies to store the session id on the client side. Protects against Session Fixation attacks that permit an attacker to hijack a valid user session.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Session Cookie Secure:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_session_cookie_secure]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_session_cookie_secure']); ?>><?php _e('Turn Off Session Cookie Secure', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_session_cookie_secure']); ?>><?php _e('Turn On Session Cookie Secure', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('session.cookie_secure') == 'On' && $options['bps_iniSet_session_cookie_secure'] == 'On' ) { 
		$text = '<font color="blue"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('session.cookie_secure') == 0 && $options['bps_iniSet_session_cookie_secure'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} 
	if ( $options['bps_iniSet_session_cookie_secure'] == '' ) { 	 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br><font color="#2ea2cc">'.__('Description CAUTION: ', 'bulletproof-security').'</font></strong>'.__('This should ONLY be turned to On if your website is 100% HTTPS/SSL. Turning this to On may interfere with other things on your website that are using SESSION. session.cookie_secure specifies whether cookies should only be sent over secure connections. Protects against Session Hijacking AKA Cookie Hijacking.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Ignore Repeated Errors:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_IgnoreRepeatedErrors]" style="width:340px;">
<option value="On"<?php selected('On', $options['bps_iniSet_IgnoreRepeatedErrors']); ?>><?php _e('Turn On Ignore Repeated Errors', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_iniSet_IgnoreRepeatedErrors']); ?>><?php _e('Turn Off Ignore Repeated Errors', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('ignore_repeated_errors') == 'On' && $options['bps_iniSet_IgnoreRepeatedErrors'] == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('ignore_repeated_errors') == 0 && $options['bps_iniSet_IgnoreRepeatedErrors'] == 'Off' ) { 	
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} 
	if ( $options['bps_iniSet_IgnoreRepeatedErrors'] == '' ) { 	 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: On ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Do not log repeated messages. Repeated errors must occur in the same file on the same line unless ignore_repeated_source is set to true/On. This means ignore duplicated error messages, not ignore the error message if the error occurs again', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Ignore Repeated Source:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_IgnoreRepeatedSource]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_IgnoreRepeatedSource']); ?>><?php _e('Turn Off Ignore Repeated Source', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_IgnoreRepeatedSource']); ?>><?php _e('Turn On Ignore Repeated Source', 'bulletproof-security'); ?></option>
</select>    
	</th>
	<td>	
<?php 
	if ( ini_get('ignore_repeated_source') == 'On' && $options['bps_iniSet_IgnoreRepeatedSource'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('ignore_repeated_source') == 0 && $options['bps_iniSet_IgnoreRepeatedSource'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( $options['bps_iniSet_IgnoreRepeatedSource'] == '' ) { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Ignore source of message when ignoring repeated messages. When this setting is On you will not log errors with repeated messages from different files or sourcelines.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Allow URL Include:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_AllowUrlInclude]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_AllowUrlInclude']); ?>><?php _e('Turn Off Allow URL Include', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_AllowUrlInclude']); ?>><?php _e('Turn On Allow URL Include', 'bulletproof-security'); ?></option>
</select>
	</th>
	<td>
<?php 
	if ( ini_get('allow_url_include') == 1 && $options['bps_iniSet_AllowUrlInclude'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('allow_url_include') == 0 && $options['bps_iniSet_AllowUrlInclude'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow include and require statements to open URLs like (http:// or ftp://) as files. Allow or Disallow remote file access via the include and require statements. Include and require are the most common attack points for code injection attempts. Does not affect the remote file access capabilities of the standard file functions.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Define Syslog Variables:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_DefineSyslogVar]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_DefineSyslogVar']); ?>><?php _e('Turn Off Define Syslog Variables', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_DefineSyslogVar']); ?>><?php _e('Turn On Define Syslog Variables', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('define_syslog_variables') == 1 && $options['bps_iniSet_DefineSyslogVar'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('define_syslog_variables') == 0 && $options['bps_iniSet_DefineSyslogVar'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Define or not Define the various syslog variables (e.g. $LOG_PID, $LOG_CRON, etc.). Increased performance by turning this directive off. In runtime, you can define these variables by calling define_syslog_variables().', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Display Errors:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_DisplayErrors]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_DisplayErrors']); ?>><?php _e('Turn Off Display Errors', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_DisplayErrors']); ?>><?php _e('Turn On Display Errors', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('display_errors') == 1 && $options['bps_iniSet_DisplayErrors'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('display_errors') == 0 && $options['bps_iniSet_DisplayErrors'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow PHP output errors, notices and warnings to remote users. The error message content may expose information about your script, web server or database server that may be exploitable for hacking. Sensitive information such as database usernames and passwords could also be leaked out. BPS logs php errors instead of displaying them to remote users. The BPS php error log is htaccess protected.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Display Startup Errors:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_DisplayStartupErrors]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_DisplayStartupErrors']); ?>><?php _e('Turn Off Display Startup Errors', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_DisplayStartupErrors']); ?>><?php _e('Turn On Display Startup Errors', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('display_startup_errors') == 1 && $options['bps_iniSet_DisplayStartupErrors'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('display_startup_errors') == 0 && $options['bps_iniSet_DisplayStartupErrors'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow the display of errors which occur during PHPs startup sequence. Handled separately from the display_errors directive. Useful in debugging configuration problems in a development environment, but should never be set to On for production servers.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Implicit Flush:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_ImplicitFlush]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_ImplicitFlush']); ?>><?php _e('Turn Off Implicit Flush', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_ImplicitFlush']); ?>><?php _e('Turn On Implicit Flush', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('implicit_flush') == 1 && $options['bps_iniSet_ImplicitFlush'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('implicit_flush') == 0 && $options['bps_iniSet_ImplicitFlush'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow PHP to tell the output layer to flush itself automatically after every output block. This is equivalent to calling the PHP function flush() after each and every call to print() or echo() and each and every HTML block. Turning this option On has serious performance implications and is generally recommended for debugging purposes only.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Magic Quotes Runtime:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_MagicQuotesRuntime]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_MagicQuotesRuntime']); ?>><?php _e('Turn Off Magic Quotes Runtime', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_MagicQuotesRuntime']); ?>><?php _e('Turn On Magic Quotes Runtime', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('magic_quotes_runtime') == 1 && $options['bps_iniSet_MagicQuotesRuntime'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('magic_quotes_runtime') == 0 && $options['bps_iniSet_MagicQuotesRuntime'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow magic quotes for runtime-generated data, e.g. data from SQL, from exec(), etc.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('Max Execution Time:', 'bulletproof-security'); ?>
<input type="text" name="bulletproof_security_options_iniSet[bps_iniSet_MaxExecutionTime]" value="<?php if ( $options['bps_iniSet_MaxExecutionTime'] != '' ) { echo $options['bps_iniSet_MaxExecutionTime']; } else { echo ini_get('max_execution_time'); } ?>" style="width:340px; padding:2px; margin-left:0px;" />    
    </th>
	<td><strong>
<?php if ( $options['bps_iniSet_MaxExecutionTime'] != '' ) { echo $options['bps_iniSet_MaxExecutionTime']; } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: 30 ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser. This helps prevent poorly written scripts from tying up the server. The default setting is 30.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('MySQL Connect Timeout:', 'bulletproof-security'); ?>
<input type="text" name="bulletproof_security_options_iniSet[bps_iniSet_MysqlConnectTimeout]" value="<?php if ( $options['bps_iniSet_MysqlConnectTimeout'] != '' ) { echo $options['bps_iniSet_MysqlConnectTimeout']; } else { echo ini_get('mysql.connect_timeout'); } ?>" style="width:340px; padding:2px; margin-left:0px;" />    
    </th>
	<td><strong>
<?php if ( $options['bps_iniSet_MysqlConnectTimeout'] != '' ) { echo $options['bps_iniSet_MysqlConnectTimeout']; } else { _e('Not Set', 'bulletproof-security'); } ?></strong>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: 30 ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Connect timeout in seconds. On Linux this timeout is also used for waiting for the first answer from the server. The default setting is 60. If you are debugging code you should set this to 3-5 seconds.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
	<th scope="row">
<?php _e('MySQL Trace Mode:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_MysqlTraceMode]" style="width:340px;">
<option value="Off"<?php selected('Off', $options['bps_iniSet_MysqlTraceMode']); ?>><?php _e('Turn Off MySQL Trace Mode', 'bulletproof-security'); ?></option>
<option value="On"<?php selected('On', $options['bps_iniSet_MysqlTraceMode']); ?>><?php _e('Turn On MySQL Trace Mode', 'bulletproof-security'); ?></option>
</select>
    </th>
	<td>
<?php 
	if ( ini_get('mysql.trace_mode') == 1 && $options['bps_iniSet_MysqlTraceMode'] == 'On' ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('mysql.trace_mode') == 0 && $options['bps_iniSet_MysqlTraceMode'] == 'Off' ) { 	
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: Off ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Trace mode. When mysql.trace_mode is enabled, warnings for table/index scans, non free result sets, and SQL-Errors will be displayed.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
    <tr>
    <th scope="row">
<?php _e('Report Memleaks:', 'bulletproof-security'); ?>
<select name="bulletproof_security_options_iniSet[bps_iniSet_ReportMemleaks]" style="width:340px;">
<option value="On"<?php selected('On', $options['bps_iniSet_ReportMemleaks']); ?>><?php _e('Turn On Report Memleaks', 'bulletproof-security'); ?></option>
<option value="Off"<?php selected('Off', $options['bps_iniSet_ReportMemleaks']); ?>><?php _e('Turn Off Report Memleaks', 'bulletproof-security'); ?></option>
</select>    
    </th>
	<td>
<?php 
	if ( ini_get('report_memleaks') == 'On' && $options['bps_iniSet_ReportMemleaks'] == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( ini_get('report_memleaks') == 0 && $options['bps_iniSet_ReportMemleaks'] == 'Off' ) { 	
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; 
	}
	if ( $options['bps_iniSet_ReportMemleaks'] == '' ) { 		 
		$text = '<strong>'.__('Not Set', 'bulletproof-security').'</strong>';
		echo $text; 	
	}
?>
    </td>
    <td>
<?php $text = '<strong>'.__('Recommended Setting: On ', 'bulletproof-security').'<br>'.__('Description: ', 'bulletproof-security').'</strong>'.__('Allow or Disallow memory leaks to be logged. This directive only applies to debugging and will only effect a debug compile if error reporting includes E_WARNING in the allowed list.', 'bulletproof-security'); echo $text; ?>
    </td>
	</tr>
</tbody>
</table>

<input type="hidden" name="bpsIniSet" value="bps-IniSet" />
<p class="submit" style="float:left; margin:0px 10px 0px 0px;">
<input type="submit" name="bpsIniSetSubmit" value="<?php esc_attr_e('1. Save Options', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Creating ini_set Options is a 2 step process.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the 1. Save Options button.', 'bulletproof-security').'\n\n'.__('Click the 2. Enable Options button.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your ini_set Options or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</p>
</form>

<form name="bpsIniSetForm" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bps-iniset-wpconfig-check'); ?>
<p class="submit" style="float:left; margin:0px 25px 0px 0px;">
<input type="submit" name="bps-iniset-wpconfig" value="<?php esc_attr_e('2. Enable Options', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Creating ini_set Options is a 2 step process.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click the 1. Save Options button.', 'bulletproof-security').'\n\n'.__('Click the 2. Enable Options button.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('After clicking the Enable Options button go to the PHP Error Log page if you are not automatically redirected to the PHP Error Log page and set your error log location by copying the Error Log Path Seen by Server: file path to the PHP Error Log Location Set To: text box and click the Set Error Log Location button.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Enable ini_set Options or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</p>
</form>

<form name="bpsIniSetRemove" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bps-iniset-wpconfig-remove'); ?>
<p class="submit">
	<input type="submit" name="Submit-bps-iniset-wpconfig-remove" value="<?php esc_attr_e('Reset|Remove Options', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reset|Remove Options deletes your Saved Options and also deletes the ini_set code that was added to your wp-config.php file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to delete your Saved Options and ini_set code or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
<?php $text = '<p><strong>'.__('NOTE: After clicking the 1. Save Options button return to this page and click the 2. Enable Options button.', 'bulletproof-security').'</strong></p>'; echo $text; ?>
</p>
</form>

</td>
  </tr>
   <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-3" class="bps-tab-page">

<h2><?php _e('All Purpose File Manager', 'bulletproof-security'); ?></h2>

<?php require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-file-manager.php' ); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<div id="iniDeleter" style="float:right;margin:20px 20px 10px 0px;">

<form name="iniDeleterForm" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_ini_deleter'); ?>
	<strong><label for="bps-ini-file-deleter"><?php _e('Delete Files:', 'bulletproof-security'); ?> </label></strong>
	<select name="iniDeleter[]" id="iniDeleter">
	
	<?php echo bps_showOptionsDrop3($iniDeleter, $chosen3, true); ?>
	
    </select>
	<input type="submit" name="Submit-IDel" value="<?php _e('Delete', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Are you sure?', 'bulletproof-security').'\n\n'.__('Click OK to delete the file or click Cancel.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('After deleting the file delete the Label and File Path from the File Manager.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<h3 style="margin:0px 0px 10px 0px;"><?php _e('All Purpose File Manager', 'bulletproof-security'); ?>  <button id="bps-open-modal6" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content6" title="<?php _e('All Purpose File Manager', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content6; ?></p>
</div>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<?php
$Master_custom_phpini_file = addslashes( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/my-master-phpini.ini' );
$custom_phpini_file_root = addslashes( $_SERVER['DOCUMENT_ROOT'] . '/php.ini' );
$custom_phpini5_file_root = addslashes( $_SERVER['DOCUMENT_ROOT'] . '/php5.ini' );
$custom_userini_file_root = addslashes( $_SERVER['DOCUMENT_ROOT'] . '/.user.ini' );
$custom_phpini_file_wpdir = addslashes( ABSPATH . 'php.ini' );

	echo '<strong><font color="#2ea2cc" style="font-size:1.25em;">'.__('Master custom php.ini file path: ', 'bulletproof-security').'</font>'.$Master_custom_phpini_file.'</strong><br>';

	if ( file_exists( $custom_phpini5_file_root ) ) {
		echo '<strong><font color="#2ea2cc" style="font-size:1.13em;">'.__('Go Daddy Custom php5.ini file path: ', 'bulletproof-security').'</font>'.$custom_phpini5_file_root.'</strong><br>';
	}
	if ( file_exists( $custom_phpini_file_root ) ) {
		echo '<strong><font color="#2ea2cc" style="font-size:1.13em;">'.__('Custom php.ini file path: ', 'bulletproof-security').'</font>'.$custom_phpini_file_root.'</strong><br>';
	}
	if ( file_exists( $custom_userini_file_root ) ) {
		echo '<strong><font color="blue" style="font-size:1.13em;">'.__('Custom .user.ini file path: ', 'bulletproof-security').'</font>'.$custom_userini_file_root.'</strong><br>';
	}
	if ( file_exists( $custom_phpini_file_wpdir ) ) {
		echo '<strong><font color="#2ea2cc" style="font-size:1.13em;">'.__('Custom php.ini file path: ', 'bulletproof-security').'</font>'.$custom_phpini_file_wpdir.'</strong><br>';
	}
?>

<form name="bps-ini-options" action="options.php#bps-tabs-3" method="post">
			<?php settings_fields('bulletproof_security_options'); ?>
			<?php $options = get_option('bulletproof_security_options'); ?>
            
<div id="php-file-manager">

<table class="widefat" style="">
<thead>
	<tr>
	<th scope="col" style="width:25%;"><strong><?php _e('Label|Description', 'bulletproof-security'); ?></strong></th>
	<th scope="col" style="width:75%;"><strong><?php $text = __('Add File|Folder Paths: To Your php.ini File or Other Files', 'bulletproof-security'); echo $text; ?></strong></th>
    </tr>
</thead>
<tbody>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_1_label]" value="<?php echo $options['bpsinifiles_input_1_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_1]" value="<?php echo $options['bpsinifiles_input_1']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_2_label]" value="<?php echo $options['bpsinifiles_input_2_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_2]" value="<?php echo $options['bpsinifiles_input_2']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_3_label]" value="<?php echo $options['bpsinifiles_input_3_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_3]" value="<?php echo $options['bpsinifiles_input_3']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_4_label]" value="<?php echo $options['bpsinifiles_input_4_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_4]" value="<?php echo $options['bpsinifiles_input_4']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_5_label]" value="<?php echo $options['bpsinifiles_input_5_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_5]" value="<?php echo $options['bpsinifiles_input_5']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_6_label]" value="<?php echo $options['bpsinifiles_input_6_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_6]" value="<?php echo $options['bpsinifiles_input_6']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_7_label]" value="<?php echo $options['bpsinifiles_input_7_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_7]" value="<?php echo $options['bpsinifiles_input_7']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_8_label]" value="<?php echo $options['bpsinifiles_input_8_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_8]" value="<?php echo $options['bpsinifiles_input_8']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_9_label]" value="<?php echo $options['bpsinifiles_input_9_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_9]" value="<?php echo $options['bpsinifiles_input_9']; ?>" class="regular-text-wide" /></td>
</tr>
<tr>
	<th scope="row"><input type="text" name="bulletproof_security_options[bpsinifiles_input_10_label]" value="<?php echo $options['bpsinifiles_input_10_label']; ?>" class="regular-text-label" style="padding:2px;" /></th>
	<td><input type="text" name="bulletproof_security_options[bpsinifiles_input_10]" value="<?php echo $options['bpsinifiles_input_10']; ?>" class="regular-text-wide" /></td>
</tr> 
</tbody>
</table>
</div>			

<p class="submit">
<input type="submit" name="bps-ini-options" class="button bps-button" value="<?php esc_attr_e('Save Changes', 'bulletproof-security') ?>" />
</p>
</form>

</td>
  </tr>
  <td class="bps-table_cell_help">
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-4" class="bps-tab-page">
<h2><?php _e('All Purpose File Editor', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { 
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-file-editor.php' );
$scrolltophp2 = isset( $_REQUEST['scrolltophp2'] ) ? (int) $_REQUEST['scrolltophp2'] : 0;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Editing Php.ini Files or Other Files', 'bulletproof-security'); ?>  <button id="bps-open-modal7" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content7" title="<?php _e('All Purpose File Editor', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content7; ?></p>
</div>

<div id="iniselector">
<form name="iniSelectorForm" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_ini_selector'); ?>
	<select name="iniSelector[]" id="iniSelector">
       
	<?php echo bps_showOptionsDrop2($iniSelector, $chosen2, true); ?>
		
	</select>
	<input type="submit" name="Submit-IS" class="button bps-button" value="<?php esc_attr_e('Select', 'bulletproof-security') ?>" />
</form>
</div>

</td>
  </tr>
  <td class="bps-table_cell_help">

<div id="APfileEditor" style="margin:0px 0px 0px 0px;">
<form name="templatephp2" id="templatephp2" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_php2'); ?>
<div id="bpsPhpIniEditor">
    <textarea class="bps-text-area-600x700" name="newcontentphp2" id="newcontentphp2" tabindex="1"><?php echo bps_get_php_ini_file(); ?></textarea>
	<input type="hidden" name="iniFilename" value="<?php echo esc_html(@$iniFilename); ?>" />
    <input type="hidden" name="scrolltophp2" id="scrolltophp2" value="<?php echo esc_html($scrolltophp2); ?>" />
</div>
	
    <input type="submit" name="submit-php2" class="button bps-button" style="margin:10px 0px 15px 10px;" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" />
</form>
</div>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#templatephp2').submit(function(){ $('#scrolltophp2').val( $('#newcontentphp2').scrollTop() ); });
	$('#newcontentphp2').scrollTop( $('#scrolltophp2').val() ); 
});
/* ]]> */
</script> 

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-5" class="bps-tab-page">
<h2><?php _e('PHP Error Log', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('PHP Error Log', 'bulletproof-security'); ?>  <button id="bps-open-modal8" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content8" title="<?php _e('PHP Error Log', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content8; ?></p>
</div>

<!-- <h3><?php _e('PHP Error Log Location', 'bulletproof-security'); ?></h3> -->

<?php 
// Check if WordPress Debug Logging is turned on and display a message
$bpsPro_error_log_string = ini_get('error_log');
$debug_log_wp = 'debug.log';
$debug_log_pos = strpos( $bpsPro_error_log_string, $debug_log_wp );

	if ( $debug_log_pos !== false ) {
   		echo $bps_topDiv;
		$text = '<strong><font color="blue">'.__('WordPress Debugging/Debug Logging is turned On in your wp-config.php file', 'bulletproof-security').'</font><br>'.__('You are currently using ', 'bulletproof-security').'define(\'WP_DEBUG_LOG\', true)'.__(' in your wp-config.php file to log errors to the WordPress ', 'bulletproof-security').$bpsPro_error_log_string.__(' file instead of the BPS Pro php error log. The "PHP Error Log Path Does Not Match" error message and this message will go away automatically once WordPress Debug Logging is turned Off (set to false) in your wp-config.php file.', 'bulletproof-security').'</strong><br>';
		echo $text;
		echo $bps_bottomDiv; 
	}
?>

<form name="phpErrorLogSetLocation" action="options.php#bps-tabs-5" method="post">
	<?php settings_fields('bulletproof_security_options2'); ?>
	<?php $options = get_option('bulletproof_security_options2'); ?>
	<label for="phpErrorLog"><strong><?php $text = __('ini_set PHP Error Log Location', 'bulletproof-security').'<font color="#2ea2cc">'.__(' (Recommended): ', 'bulletproof-security').'</font>'; echo $text; ?></strong><?php echo addslashes( WP_CONTENT_DIR.'/bps-backup/logs/bps_php_error.log' ); ?></label><br /><br />
    <label for="phpErrorLog"><strong><?php _e('PHP Error Log Location Set To: ', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options2[bps_error_log_location]" value="<?php echo $options['bps_error_log_location']; ?>" class="regular-text-save-path" /><br />
    <label for="phpErrorLog" style="margin-right:5px;"><strong><?php _e('Error Log Path Seen by Server: ', 'bulletproof-security'); ?></strong></label><?php echo addslashes(ini_get('error_log')); ?><br />
	<div id="PHPSetELogLocation" style="float:left; margin:10px 0px 10px 0px;">
    <input type="submit" name="Submit-PELL" class="button bps-button" value="<?php esc_attr_e('Set Error Log Location', 'bulletproof-security') ?>" /> 
</div>
</form>

<div id="PHPTestLog" style="float:left;margin:10px 0px 10px 80px;">
<form name="phpErrorLogTest" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5" method="post">
<?php wp_nonce_field('bps-error-log-test'); ?>
<input type="hidden" name="filename" value="bps-test-error-log" />
<input type="submit" name="phpErrorLogTest" value="<?php esc_attr_e('Test Error Log', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will generate this intentional PHP error below:', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('PHP Warning: copy(): Filename cannot be empty in...', 'bulletproof-security').'\n\n'.__('and the error should be logged in your PHP error log.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Test your Error Log or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<div id="errorLogGeneral2" style="border-top:1px solid #999999; margin:50px 0px 0px 0px;">
<h3><?php _e('PHP Error Log Last Modified Time', 'bulletproof-security'); ?>  <button id="bps-open-modal9" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content9" title="<?php _e('PHP Error Log Last Modified Time', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content9; ?></p>
</div>
</div>

<?php
// Get the Last Modifed Date of the PHP Error Log File
function bps_getPhpELogLastMod() {
$options = get_option('bulletproof_security_options2');
$filename = $options['bps_error_log_location'];
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

	if ( file_exists($filename) ) {
		$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// String comparison of DB Last Modified Time and Actual File Last Modified Time
function bps_ELogModTimeDiff() {
$options = get_option('bulletproof_security_options_elog');
$last_modified_time = bps_getPhpELogLastMod();
$last_modified_time_db = $options['bps_error_log_date_mod'];
	
	if ( strcmp( $last_modified_time, $last_modified_time_db ) == 0 ) { // 0 is equal
		$text = '<font color="green" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB: ', 'bulletproof-security').'</strong></font>';
		echo $text;
	} else {
		$text = '<font color="red" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB: ', 'bulletproof-security').'</strong></font>';
		echo $text;
	}
}

// Get File Size of the PHP Error Log File
function bps_getPHPLogSize() {
$options = get_option('bulletproof_security_options2');
$filename = $options['bps_error_log_location'];

	if ( file_exists($filename) ) {
		$logSize = filesize($filename);
	
		if ( $logSize < 2097152 ) {
 			$text = '<strong>'. __('PHP Error Log File Size: ', 'bulletproof-security').'<font color="#2ea2cc">'. round($logSize / 1024, 2) .' KB</font></strong><br><br>';
			echo $text;
	
		} else {
 		
			$text = '<strong>'. __('PHP Error Log File Size: ', 'bulletproof-security').'<font color="red">'. round($logSize / 1024, 2) .' KB<br>'.__('The S-Monitor Email Logging options will only send log files up to 2MB in size.', 'bulletproof-security').'</font></strong><br>'.__('Copy and paste the PHP Error Log file contents into a Notepad text file on your computer and save it.', 'bulletproof-security').'<br>'.__('Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'<br><br>';		
			echo $text;
		}
	}
}
bps_getPHPLogSize();
?> 

<form name="phpErrorLogModDate" action="options.php#bps-tabs-5" method="post">
	<?php settings_fields('bulletproof_security_options_elog'); ?> 
	<?php $options = get_option('bulletproof_security_options_elog'); ?>
    <label for="phpErrorLog"><strong><?php _e('PHP Error Log Last Modified Time:', 'bulletproof-security'); ?></strong></label><br />	
    <label for="phpErrorLog"><strong><?php echo bps_ELogModTimeDiff(); ?></strong><?php echo $options['bps_error_log_date_mod']; ?></label><br />
	<label for="phpErrorLog"><strong><?php _e('Last Modified Time in File:', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options_elog[bps_error_log_date_mod]" style="color:#2ea2cc;font-size:13px;width:200px;padding-left:4px;font-weight:bold;border:none;background:none;outline:none;-webkit-box-shadow:none;box-shadow:none;-webkit-transition:none;transition:none;" value="<?php echo bps_getPhpELogLastMod(); ?>" />
<div id="PHPELogDBReset" style="margin:10px 0px 10px 0px;">
    <input type="submit" name="Submit-PELMD" class="button bps-button" value="<?php esc_attr_e('Reset Last Modified Time in DB', 'bulletproof-security') ?>" />
</div>
</form>

<div id="PHPELogDelete" style="margin:-38px 0px 0px 250px;">
<form name="DeleteLogForm" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5" method="post">
<?php wp_nonce_field('bps-delete-php-log'); ?>
<input type="submit" name="Submit-Delete-PHP-Log" value="<?php esc_attr_e('Delete Log', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will delete the contents of your PHP Error Log file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Delete the Log file contents or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<?php
if ( isset( $_POST['Submit-Delete-PHP-Log'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-delete-php-log' );
	$options = get_option('bulletproof_security_options_elog');
	$options2 = get_option('bulletproof_security_options2');
	$last_modified_time_db = $options['bps_error_log_date_mod'];
	$time = strtotime($last_modified_time_db); 
	$PHPLog = $options2['bps_error_log_location'];
	$PHPLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error_master.log';
	
	if ( copy($PHPLogMaster, $PHPLog) ) {
		touch($PHPLog, $time);	
	}
}
?>

<div id="messageinner" class="updatedinner" style="width:690px; margin-top:20px;">
<?php
// Form - php.ini Error Log - Perform File Open and Write test - If append write test is successful write to file
if ( current_user_can('manage_options') ) {
$options = get_option('bulletproof_security_options2');
$php_error_log = $options['bps_error_log_location'];
$write_test = "";
	
	if ( is_writable($php_error_log) ) {
    if ( ! $handle = fopen($php_error_log, 'a+b') ) {
    	exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
		exit;
    }
	$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your PHP Error Log file is writable.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	}
	}
	
	if ( isset( $_POST['submit-php1'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_save_settings_php1' );
		$newcontentphp1 = stripslashes( $_POST['newcontentphp1'] );
	if ( is_writable($php_error_log) ) {
		$handle = fopen($php_error_log, 'w+b');
		fwrite($handle, $newcontentphp1);
		$text = '<font color="green"><strong>'.__('Success! Your PHP Error Log file has been updated.', 'bulletproof-security').'</strong></font><br>';
		echo $text;	
    fclose($handle);
	}
}

// Form - PHP Error Log Test
if ( isset( $_POST['phpErrorLogTest'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-error-log-test' );
	$text = '<p><font color="green"><strong>'.__('To Complete the PHP Error Log Test. Click the Refresh Status button below.', 'bulletproof-security').'</strong></font><div class="bps-message-button" style="width:120px;"><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5" onclick="location.reload(true)">'.__('Refresh Status', 'bulletproof-security').'</a></div></p>';
	echo $text;
	copy($nothing, $tonothing);
}

$scrolltophp1 = isset( $_REQUEST['scrolltophp1'] ) ? (int) $_REQUEST['scrolltophp1'] : 0;
?>
</div>

<div id="phpErrorLogEditor">
<form name="templatephp1" id="templatephp1" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_php1'); ?>
<div id="bpsPhpErrorLog">
    <textarea class="bps-text-area-600x700" name="newcontentphp1" id="newcontentphp1" tabindex="1"><?php echo bps_get_php_error_log(); ?></textarea>
	<input type="hidden" name="scrolltophp1" id="scrolltophp1" value="<?php echo esc_html($scrolltophp1); ?>" />
    <p class="submit">
	<input type="submit" name="submit-php1" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#templatephp1').submit(function(){ $('#scrolltophp1').val( $('#newcontentphp1').scrollTop() ); });
	$('#newcontentphp1').scrollTop( $('#scrolltophp1').val() ); 
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

<?php } ?>
</div>
            
<div id="bps-tabs-6" class="bps-tab-page">

<h2><?php _e('PHP Info Viewer ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('View PHP Server Configuration Information Safely And Securely With htaccess Protected phpinfo()', 'bulletproof-security'); ?></span></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Phpinfo Viewer', 'bulletproof-security'); ?>  <button id="bps-open-modal10" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content10" title="<?php _e('Phpinfo Viewer', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content10; ?></p>
</div>
    
<form name="bps-view-phpinfo" method="POST" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="" onSubmit="window.open('<?php echo plugins_url('/bulletproof-security/admin/php/bps-phpinfo.php'); ?>','','scrollbars=yes,menubar=yes,width=800,height=600,resizable=yes,status=yes,toolbar=yes')">
<?php wp_nonce_field('bps-view-phpinfo-check'); ?>
<input type="hidden" name="filename" value="bps-view-phpinfo-secure" />
<p class="submit">
<input type="submit" name="bps-view-phpinfo" class="button bps-button" value="<?php esc_attr_e('View PHPINFO', 'bulletproof-security') ?>" /></p>
</form>

<h2><?php _e('PHP Info Multi Viewer', 'bulletproof-security'); ?></h2>
<div id="phpMultiViewerGeneral" style="border-top:1px solid #999999;border-bottom:1px solid #999999;">

<h3><?php _e('Phpinfo Multi Viewer', 'bulletproof-security'); ?>  <button id="bps-open-modal11" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
<div id="bps-modal-content11" title="<?php _e('Phpinfo Multi Viewer', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content11; ?></p>
</div>

<h3><?php _e('View your PHP server information safely and securely for specific folders', 'bulletproof-security'); ?></h3>
</div>

<div id="phpInfoCreator" style="border-bottom:1px solid #999999;">
<h3><?php _e('Phpinfo Master File Creator', 'bulletproof-security'); ?>  <button id="bps-open-modal12" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content12" title="<?php _e('Phpinfo Master File Creator', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content12; ?></p>
</div>

<form name="bps-create-phpinfo-multi" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_phpinfo_create'); ?>
<strong><label for="bps-ini-file-creator"><?php _e('Click the Create Phpinfo File button to create your new secure phpinfo file:', 'bulletproof-security'); ?></label></strong><br />
<label for="bps-ini-file-creator"><strong><?php _e('Phpinfo File: ', 'bulletproof-security'); ?></strong><span style="color:green;font-weight:bold;"><?php echo @$phpinfoIP; ?></span></label><br />
<input type="hidden" name="bcpms1" value="bps-create-phpinfo-multi-create" />
<p class="submit">
<input type="submit" name="bps-create-phpinfo-multi" class="button bps-button" value="<?php esc_attr_e('Create Phpinfo File', 'bulletproof-security') ?>" /></p>
</form>
</div>

<div id="phpInfoCreatorCopy" style="border-bottom:1px solid #999999;">
<h3><?php _e('Phpinfo File Creator|Copier', 'bulletproof-security'); ?>  <button id="bps-open-modal13" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content13" title="<?php _e('Phpinfo File Creator|Copier', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content13; ?></p>
</div>

<form name="bps-copy-phpinfo-multi" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_phpinfo_copy'); ?>
	<strong><label for="bps-ini-file-creator"><?php _e('Add the folder path where you want your new phpinfo file saved:', 'bulletproof-security'); ?></label></strong><br />
    <label for="bps-ini-file-creator"><strong><?php _e('Name your phpinfo file with a .php file extension. Example:', 'bulletproof-security').' '; ?></strong><?php _e('myphpinfo.php', 'bulletproof-security'); ?></label><br />
    <label for="bps-ini-file-creator"><strong><?php _e('Your Website root folder path is:', 'bulletproof-security').' '; ?></strong><?php echo ABSPATH; ?></label><br />
    <label for="bps-ini-file-creator"><strong><?php _e('File saved to folder:', 'bulletproof-security').' '; ?></strong><span style="color:green; font-weight:bold;"><?php echo @$bpsSaveLocPhpinfo; ?></span></label><br />
    <input type="text" name="bps-phpinfo-save-path" value="Example: <?php echo ABSPATH; ?>some-folder-name/some-unique-file-name.php" class="regular-text-mycrypt" /><br /><br />
    <strong><label for="bps-ini-file-creator"><?php _e('Add the URL path to your new phpinfo file:', 'bulletproof-security'); ?></label></strong><br />
    <label for="bps-ini-file-creator"><strong><?php _e('Hint:', 'bulletproof-security').' '; ?></strong><?php _e('Copy a portion of the folder path above to your URL window. Example: /some-folder-name/some-unique-file-name.php', 'bulletproof-security'); ?></label><br />
 <label for="bps-ini-file-creator"><strong><?php _e('Your Website URL is:', 'bulletproof-security').' '; ?></strong><?php echo get_site_url(); ?></label><br />
 <label for="bps-ini-file-creator"><strong><?php _e('File saved to URL:', 'bulletproof-security').' '; ?></strong><span style="color:green; font-weight:bold;"><?php echo @$bpsViewPhpinfo; ?></span></label><br />
     <input type="text" name="bps-phpinfo-url-path" value="Example: <?php echo get_site_url(); ?>/some-folder-name/some-unique-file-name.php" class="regular-text-mycrypt" />
    <input type="hidden" name="bcpms2" value="bps-create-phpinfo-multi-copy" />
    <p class="submit">
	<input type="submit" name="bps-copy-phpinfo-multi" class="button bps-button" value="<?php esc_attr_e('Save Phpinfo File', 'bulletproof-security') ?>" /></p>
</form>
</div>

<div id="phpMultiViewer">
<h3><?php _e('Phpinfo Multi Viewer', 'bulletproof-security'); ?>  <button id="bps-open-modal14" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content14" title="<?php _e('Phpinfo Multi Viewer', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content14; ?></p>
</div>

<?php
// Delete the phpinfo file at the same time it is opened
if ( isset( $_POST['bps-view-phpinfo-multi'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-view-phpinfo-multi' );
	$bpsSaveLocPhpinfo = $_POST['bpsUnlink'];
	
	if ( file_exists($bpsSaveLocPhpinfo) ) {
		$fh = fopen($bpsSaveLocPhpinfo, 'a');
		fwrite($fh, '<h1>Hello world!</h1>');
		fclose($fh);
		unlink($bpsSaveLocPhpinfo);
	}
}
?>

<form name="bps-view-phpinfo-multi" method="POST" action="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="" onSubmit="window.open('<?php echo @$bpsViewPhpinfo; ?>','','scrollbars=yes,menubar=yes,width=800,height=600,resizable=yes,status=yes,toolbar=yes')">
<?php wp_nonce_field('bps-view-phpinfo-multi'); ?>
 <label for="bps-ini-file-creator"><?php _e('If you see a blank popup window after clicking the View PHPINFO Multi button you have not entered a valid URL and / or file name.', 'bulletproof-security'); ?></label><br />
 <input type="hidden" name="bpsUnlink" value="<?php echo @$bpsSaveLocPhpinfo; ?>" />
 <label for="bps-ini-file-creator"><strong><?php _e('Click the View button to View: ', 'bulletproof-security'); ?></strong><span style="color:green; font-weight:bold;"><?php echo @$bpsViewPhpinfo; ?></span></label>
<p class="submit">
<input type="submit" name="bps-view-phpinfo-multi" class="button bps-button" value="<?php esc_attr_e('View PHPINFO Multi', 'bulletproof-security') ?>" /></p>
</form>

</div>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-7" class="bps-tab-page">
<h2><?php _e('Php.ini Security Status ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('The ini_set Options Page Has Additional PHP Security Status & Settings', 'bulletproof-security'); ?></span></h2>

<?php 
	if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security');
	} else { 
	require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/php/php-security-status.php' ); 
	} 
?>
</div>

<div id="bps-tabs-8" class="bps-tab-page">
<h2><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php" target="_blank"><?php _e('Whats New in ', 'bulletproof-security'); echo BULLETPROOF_VERSION; ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/custom-php-ini-file-setup-php5-3-x/" target="_blank"><?php _e('Custom php.ini File Setup for PHP 5.3.x, PHP 5.4.x or higher versions', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/how-to-troubleshoot-php-errors-php-errors-in-your-php-error-log/" target="_blank"><?php _e('PHP Errors what do they mean and how to troubleshoot them', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://www.ait-pro.com/aitpro-blog/3576/bulletproof-security-pro/custom-php-ini-faq/" target="_blank"><?php _e('Custom php.ini and PHP Errors FAQ', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://www.ait-pro.com/aitpro-blog/3576/bulletproof-security-pro/custom-php-ini-faq#web-hosts-list" target="_blank"><?php _e('php.ini Handler Web Hosts List', 'bulletproof-security'); ?></a></td>
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
<style>
<!--
.bps-spinner {visibility:hidden;}
-->
</style>
</div>