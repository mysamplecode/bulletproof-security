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

// S-Monitor - AutoRestore Status display - displayed in BPS Only 
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

// default.htaccess, secure.htaccess, write content for all WP site types
$bps_get_domain_root = bpsGetDomainRoot();
$bps_get_wp_root_default = bps_wp_get_root_folder();
// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );
// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Form: Root BulletProof Mode and Default Mode - copy and rename htaccess files to root folder
if ( isset( $_POST['Submit-Secure-Root'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_root_copy' );
	
	$options = get_option('bulletproof_security_options_autolock');
	$Flockoptions = get_option('bulletproof_security_options_flock'); 
	$DefaultHtaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';
	$RootHtaccess = ABSPATH . '.htaccess';
	$SecureHtaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';
	$htaccessARRoot = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$permsRootHtaccess = @substr(sprintf('%o', fileperms($RootHtaccess)), -4);
	$sapi_type = php_sapi_name();	

	if ( $_POST['bpsecureroot'] == 'bulletproof' ) { 
		
		if ( @substr($sapi_type, 0, 6) != 'apache' && @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777') { // Windows IIS, XAMPP, etc
			@chmod($RootHtaccess, 0644);
		}		
		
		if ( !copy($SecureHtaccess, $RootHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to activate Root Folder BulletProof Mode protection. Your website is NOT protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		
		} else {
			
			if ( @$permsRootHtaccess == '0644' && @substr($sapi_type, 0, 6) != 'apache' && $options['bps_root_htaccess_autolock'] != 'Off' || $Flockoptions['bps_lock_root_htaccess'] == 'yes') {			
				@chmod($RootHtaccess, 0404);
			}
		
			copy($RootHtaccess, $htaccessARRoot);
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Root Folder BulletProof Mode protection activated. Your website is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
    		echo $bps_bottomDiv;

		}
	}
	elseif ( $_POST['bpsecureroot'] == 'default' ) {

		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777') { // Windows IIS, XAMPP, etc
			@chmod($RootHtaccess, 0644);
		}

		if ( !copy($DefaultHtaccess, $RootHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to activate Root Folder BulletProof Mode (Default Mode). Unable to Copy the default.htaccess file to your root folder.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		
		} else {

			if ( @$permsRootHtaccess == '0644' && @substr($sapi_type, 0, 6) != 'apache' && $options['bps_root_htaccess_autolock'] != 'Off' || $Flockoptions['bps_lock_root_htaccess'] == 'yes') {
				@chmod($RootHtaccess, 0404);
			}
			
			copy($RootHtaccess, $htaccessARRoot);
			
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Reminder Warning: Root Folder BulletProof Mode (Default Mode) is activated. Your root folder is not protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
	}
}

// Form: wp-admin BulletProof Mode - copy and rename htaccess file to wp-admin folder
// Do String Replacements for Custom Code AFTER new .htaccess file has been copied to wp-admin
if ( isset( $_POST['Submit-Secure-wpadmin'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_wpadmin_copy' );
	
	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('wp-admin Folder BulletProof Mode was not activated. Either it is disabled on the Security Modes page or you have a Go Daddy Managed WordPress Hosting account. The wp-admin folder is restricted on GDMW hosting account types.', 'bulletproof-security').'</strong></font>';
		echo $text;
   		echo $bps_bottomDiv;		
	return;
	}
	
	$options = get_option('bulletproof_security_options_customcode_WPA');  
	$HtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
	$htaccessARwpadmin = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($wpadminHtaccess)), -4);
	$sapi_type = php_sapi_name();	
	$bpsString1 = "# CCWTOP";
	$bpsString2 = "# CCWPF";
	$bpsString3 = '/#\sBEGIN\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES(.*)#\sEND\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES/s';
	$bpsString4 = '/#\sBEGIN\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS(.*)#\sEND\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS/s';
	$bpsReplace1 = htmlspecialchars_decode($options['bps_customcode_one_wpa'], ENT_QUOTES);
	$bpsReplace2 = htmlspecialchars_decode($options['bps_customcode_two_wpa'], ENT_QUOTES);
	$bpsReplace3 = htmlspecialchars_decode($options['bps_customcode_deny_files_wpa'], ENT_QUOTES);	
	$bpsReplace4 = htmlspecialchars_decode($options['bps_customcode_bpsqse_wpa'], ENT_QUOTES);	
	
	if ( $_POST['bpsecurewpadmin'] == 'bulletproof' ) {

		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
			@chmod($wpadminHtaccess, 0644);
		}		

		if ( !copy($HtaccessMaster, $wpadminHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to activate wp-admin Folder BulletProof Mode protection. Your wp-admin folder is NOT protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
			
		} else {
	
			if ( file_exists($wpadminHtaccess) ) {
				
				if ( @$permsHtaccess != '0666' || @$permsHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
					@chmod($wpadminHtaccess, 0644);
				}				
				
				$bpsBaseContent = file_get_contents($wpadminHtaccess);
		
			if ( $options['bps_customcode_deny_files_wpa'] != '') {        
				$bpsBaseContent = preg_replace('/#\sBEGIN\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES(.*)#\sEND\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES/s', $bpsReplace3, $bpsBaseContent);
			}
			
			if ( $options['bps_customcode_bpsqse_wpa'] != '') {        
				$bpsBaseContent = preg_replace('/#\sBEGIN\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS(.*)#\sEND\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS/s', $bpsReplace4, $bpsBaseContent);
			}
				
				$bpsBaseContent = str_replace($bpsString1, $bpsReplace1, $bpsBaseContent);
				$bpsBaseContent = str_replace($bpsString2, $bpsReplace2, $bpsBaseContent);
				
				file_put_contents( $wpadminHtaccess, $bpsBaseContent );
				copy($wpadminHtaccess, $htaccessARwpadmin);
				echo $bps_topDiv;
				$text = '<font color="green"><strong>'.__('wp-admin Folder BulletProof Mode protection activated. Your wp-admin folder is now protected.', 'bulletproof-security').'</strong></font>';
				echo $text;
				echo $bps_bottomDiv;
			}
		}
	}
	elseif ( $_POST['bpsecurewpadmin'] == 'default' ) {

		@unlink($wpadminHtaccess);
	
	if ( file_exists($wpadminHtaccess) ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('Failed to delete the wp-admin htaccess file! The file does not exist. It may have been deleted or renamed already.', 'bulletproof-security').'</strong></font>';
		echo $text;
   		echo $bps_bottomDiv;
	
	} else {
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('wp-admin Folder BulletProof Mode deactivated. The wp-admin htaccess file has been deleted. If you are testing or troubleshooting then be sure to activate wp-admin BulletProof Mode when you are done testing.', 'bulletproof-security').'</strong></font><br><font color="red"><strong>'.__('Your wp-admin folder is no longer protected.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}
	}
}

// Form: Plugin Firewall BulletProof Mode & delete /plugins/.htaccess
if ( isset( $_POST['submit-Plugins-Lock'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_plugins_htaccess_copy' );
	
	$PluginsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins.htaccess';
	$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
	$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
	$PluginsHtaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins.htaccess';

	if ( $_POST['bpssecurepfw'] == 'bulletproof' ) { 
		
		if ( file_exists($PluginsHtaccessMaster) ) {
			copy($PluginsHtaccessMaster, $PluginsHtaccess);
			@copy($PluginsHtaccess, $PluginsHtaccessARQ);
			@copy($PluginsHtaccess, $PluginsHtaccessARQplugins);

			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Plugin Firewall BulletProof Mode plugins folder protection activated. Your /', 'bulletproof-security').$bps_plugin_dir.__(' folder is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
		
		if ( !copy($PluginsHtaccessMaster, $PluginsHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Error: Failed to activate Plugin Firewall BulletProof Mode. Unable to Copy and Rename the plugins.htaccess file to /plugins/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
		}
		elseif ( $_POST['bpssecurepfw'] == 'default' ) {
			$bpsRemovePluginsLock = 'checked';
		
		if ( file_exists($PluginsHtaccess) ) {
			@unlink($PluginsHtaccess);
			@unlink($PluginsHtaccessARQplugins);
		}
		
		if ( file_exists($PluginsHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to delete the /plugins/.htaccess file. The file does not exist. It may have been deleted already.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;

		} else {
		
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Plugin Firewall BulletProof Mode deactivated. If you are testing or troubleshooting then be sure to activate Plugin Firewall BulletProof Mode for your Plugins folder when you are done testing or troubleshooting.', 'bulletproof-security').'</strong></font><br><font color="red"><strong> '.__('Your plugins folder is no longer protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
	}
}

// Form: Uploads Folder BulletProof Mode (UAEG) & delete /uploads/.htaccess - if MU delete /blogs.dir/.htaccess
// Rename Master .htaccess file to prevent automatic creation of Uploads LockDown .htaccess files
if ( isset( $_POST['submit-Uploads-Lock'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_uploads_htaccess_copy' );

	$bps_Uploads_Dir = wp_upload_dir();	
	$UploadsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/uploads.htaccess';
	$UploadsHtaccessRenamed = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/manual_uploads.htaccess';
	$UploadsHtaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/uploads.htaccess';
	$UploadsHtaccessARQRenamed = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/manual_uploads.htaccess';
	$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder
	$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess';	// for MU Only - is the /blogs.dir folder
	
	if ( $_POST['bpsuaeg'] == 'bulletproof' ) {
		
		if ( file_exists($UploadsHtaccessMaster) && !file_exists($UploadsHtaccessRenamed) ) {
			copy($UploadsHtaccessMaster, $UploadsHtaccess);

		if ( !copy($UploadsHtaccessMaster, $UploadsHtaccess )) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to activate UAEG BulletProof Mode uploads folder protection. Unable to Copy and Rename the uploads.htaccess file to /uploads/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
 	
		if ( file_exists($UploadsHtaccess) ) {
			@copy($UploadsHtaccess, $UploadsHtaccessARQ);
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('UAEG BulletProof Mode uploads folder protection activated. Your /uploads folder is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}

		if ( is_multisite() && is_dir( ABSPATH . @UPLOADBLOGSDIR ) && !file_exists($UploadsHtaccessBlogsDir) ) {
		if ( !copy( $UploadsHtaccessMaster, $UploadsHtaccessBlogsDir ) ) {
			echo $bps_topDiv;
			$text = '<br><font color="red"><strong>'.__('Failed to activate UAEG BulletProof Mode blogs.dir folder protection. Unable to Copy and Rename the uploads.htaccess file to /blogs.dir/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
 	
		if ( file_exists($UploadsHtaccessBlogsDir) ) {
			@copy($UploadsHtaccessBlogsDir, $UploadsHtaccessARQ);
			echo $bps_topDiv;
			$text = '<br><font color="green"><strong>'.__('UAEG BulletProof Mode blogs.dir folder protection activated. Your /blogs.dir folder is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		} 
		} // end if MU
		} // end if file uploads.htaccess file exists
		elseif ( !file_exists($UploadsHtaccessMaster) && file_exists($UploadsHtaccessRenamed) ) {
  	
		if ( !copy($UploadsHtaccessRenamed, $UploadsHtaccess ) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to activate UAEG BulletProof Mode. Unable to Copy and Rename the manual_uploads.htaccess file to /uploads/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}

		if ( file_exists($UploadsHtaccess) ) {
			@copy($UploadsHtaccess, $UploadsHtaccessARQ); // copies /uploads/.htaccess to ARQ and renames the file to uploads.htaccess 
			rename($UploadsHtaccessRenamed, $UploadsHtaccessMaster); // renames the manual_uploads.htaccess file to uploads.htacces in /htaccess folder
			@unlink($UploadsHtaccessARQRenamed); // deletes the manual_uploads.htaccess from ARQ

			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('UAEG BulletProof Mode uploads folder protection activated. Your /uploads folder is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
		
		// if /uploads folder exists and the uploads/htaccess file was added in previous if condition
		// then the master file will be named uploads.htaccess again instead of manual_uploads.htaccess at this point
		
		if ( is_multisite() && is_dir( ABSPATH . @UPLOADBLOGSDIR ) && !file_exists($UploadsHtaccessBlogsDir) ) {
		if ( file_exists($UploadsHtaccessRenamed) ) {
		if ( !copy( $UploadsHtaccessRenamed, $UploadsHtaccessBlogsDir ) ) {
			echo $bps_topDiv;
			$text = '<br><font color="red"><strong>'.__('Failed to activate UAEG BulletProof Mode blogs.dir folder protection. Unable to Copy and Rename the manual_uploads.htaccess file to /blogs.dir/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
		}
		
		if ( file_exists($UploadsHtaccessMaster) ) {
		if ( !copy( $UploadsHtaccessMaster, $UploadsHtaccessBlogsDir ) ) {
			echo $bps_topDiv;
			$text = '<br><font color="red"><strong>'.__('Failed to activate UAEG BulletProof Mode blogs.dir folder protection. Unable to Copy and Rename the uploads.htaccess file to /blogs.dir/.htaccess', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}		
		}
	
		if ( file_exists($UploadsHtaccessBlogsDir) ) {
			@copy($UploadsHtaccessBlogsDir, $UploadsHtaccessARQ);
		
		if ( file_exists($UploadsHtaccessRenamed) ) {
			@rename($UploadsHtaccessRenamed, $UploadsHtaccessMaster); // renames the manual_uploads.htaccess file to uploads.htacces in /htaccess folder if it exists
			@unlink($UploadsHtaccessARQRenamed); // deletes the manual_uploads.htaccess from ARQ if it exists

		}
			echo $bps_topDiv;
			$text = '<br><font color="green"><strong>'.__('UAEG BulletProof Mode blogs.dir folder activated. Your /blogs.dir folder is now protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		} // end if blogs.dir .htaccess file exists
		} // end if MU
		} // end if file manual_uploads.htaccess file exists
		} // end if $selected_radio == 'bpsUploadsLock'
		elseif ( $_POST['bpsuaeg'] == 'default' ) {
		
		if ( file_exists($UploadsHtaccessMaster) ) {	
			@copy($UploadsHtaccessMaster, $UploadsHtaccessRenamed); // makes a copy of uploads.htaccess named manual_uploads.htaccess
			@copy($UploadsHtaccessRenamed, $UploadsHtaccessARQRenamed); // copies the manual_uploads.htaccess file to ARQ
			@unlink($UploadsHtaccess); // deletes /uploads/.htaccess
			@unlink($UploadsHtaccessMaster); // deletes /htaccess/uploads.htaccess
			@unlink($UploadsHtaccessARQ); // deletes the uploads.htaccess file in ARQ
		}
		
		if ( file_exists($UploadsHtaccess) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to delete the UAEG /uploads/.htaccess file! The file does not exist. It may have been deleted already.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('UAEG BulletProof Mode has been deactivated. If you are testing or troubleshooting then be sure to activate UAEG BulletProof Mode for your uploads folder when you are done testing or troubleshooting.', 'bulletproof-security').'</strong></font><br><font color="red"><strong>'.__('Your uploads folder is no longer protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		} // end if /uploads/.htaccess file exists
		
		if ( is_multisite() ) {
		if ( is_dir( ABSPATH . @UPLOADBLOGSDIR ) && file_exists($UploadsHtaccessMaster) ) {
			@copy($UploadsHtaccessMaster, $UploadsHtaccessRenamed); // makes a copy of uploads.htaccess named manual_uploads.htaccess if it exists
			@copy($UploadsHtaccessRenamed, $UploadsHtaccessARQRenamed); // copies the manual_uploads.htaccess file to ARQ if it exists
			@unlink($UploadsHtaccessMaster); // deletes /htaccess/uploads.htaccess if it exists
			@unlink($UploadsHtaccessARQ); // deletes the uploads.htaccess file in ARQ if it exists	
		}
		
		if ( file_exists($UploadsHtaccessBlogsDir) ) {
		if ( @!unlink($UploadsHtaccessBlogsDir) ) { // deletes /blogs.dir/.htaccess file		
			echo $bps_topDiv;
			$text = '<br><font color="red"><strong>'.__('Failed to delete the UAEG /blogs.dir/.htaccess file! The file does not exist. It may have been deleted already.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;
			$text = '<br><font color="green"><strong>'.__('The UAEG blogs.dir uploads folder htaccess file has been deleted. If you are testing or troubleshooting then be sure to activate UAEG BulletProof Mode for your uploads folder when you are done testing or troubleshooting.', 'bulletproof-security').'</strong></font><br><font color="red"><strong>'.__('Your blogs.dir uploads folder is no longer htaccess protected.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		} // end if unlink successful or failed
		} // end if /blogs.dir/.htaccess file exists
		} // end if is MU	
	} // end if $selected_radio == 'bpsRemoveUploadsLock'
}

// Form: BPS Master htaccess folder - copy Deny All htaccess file 
if ( isset( $_POST['Submit-Master-Folder'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_denyall_master' );
	
	$bps_rename_htaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/deny-all.htaccess';
	$bps_rename_htaccess_renamed = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/.htaccess';
	
	if ( $_POST['bpssecuremaster'] == 'bulletproof' ) { 

		if ( !copy($bps_rename_htaccess, $bps_rename_htaccess_renamed) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to Activate Master htaccess BulletProof Mode. Your BPS Master htaccess folder is NOT Protected with Deny All htaccess folder protection.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		} else {
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Master htaccess BulletProof Mode Activated. Your BPS Master htaccess folder is Now Protected with Deny All htaccess folder protection.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
	}
}

// Form: BPS backup folder - copy Deny All htaccess file 
if ( isset( $_POST['Submit-Backup-Folder'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_denyall_bpsbackup' );
	
	$bps_rename_htaccess_backup = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/deny-all.htaccess';
	$bps_rename_htaccess_backup_online = WP_CONTENT_DIR . '/bps-backup/.htaccess';
	
	if ( $_POST['bpssecurebackup'] == 'bulletproof' ) { 
		
		if ( !copy($bps_rename_htaccess_backup, $bps_rename_htaccess_backup_online) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to Activate BPS Backup BulletProof Mode. Your BPS /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder is NOT Protected with Deny All htaccess folder protection!', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		} else {
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('BPS Backup BulletProof Mode Activated. Your BPS /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder is Now Protected with Deny All htaccess folder protection.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
	}
}

// Form: Backup htaccess files
if ( isset( $_POST['Submit-Backup-htaccess-Files'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_backup_active_htaccess_files' );
	
	$old_backroot = ABSPATH . '.htaccess';
	$new_backroot = WP_CONTENT_DIR . '/bps-backup/master-backups/root.htaccess';
	$old_backwpadmin = ABSPATH . 'wp-admin/.htaccess';
	$new_backwpadmin = WP_CONTENT_DIR . '/bps-backup/master-backups/wpadmin.htaccess';
	
	if ( $_POST['bpsbackuphtaccessfiles'] == 'backup-htaccess-files' ) { 
	
		if ( !file_exists($old_backroot) ) { 
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('You do not currently have an .htaccess file in your Root folder to backup.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} else {	
		
		if ( !copy($old_backroot, $new_backroot) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to Backup Your Root .htaccess File. File copy function failed. Check the folder permissions for the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder. Folder permissions should be set to 755.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Your currently active Root .htaccess file has been backed up successfully.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		}
		}
		
		if ( !file_exists($old_backwpadmin) ) { 
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('You do not currently have an htaccess file in your wp-admin folder to backup.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
		
		if ( !copy($old_backwpadmin, $new_backwpadmin) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to Backup Your wp-admin htaccess File. File copy function failed. Check the folder permissions for the /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup folder. Folder permissions should be set to 755.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo $bps_bottomDiv;
		
		} else {
			
			echo $bps_topDiv;
			$text = '<font color="green"><strong>'.__('Your currently active wp-admin htaccess file has been backed up successfully.', 'bulletproof-security').'</strong></font><br>';
			echo $text;
			echo $bps_bottomDiv;
		}
		}
	}
}

// Form: Restore backed up htaccess files
if ( isset( $_POST['Submit-Restore-htaccess-Files'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_restore_active_htaccess_files' );
	
	$Flockoptions = get_option('bulletproof_security_options_flock');
	$old_restoreroot = WP_CONTENT_DIR . '/bps-backup/master-backups/root.htaccess';
	$new_restoreroot = ABSPATH . '.htaccess';
	$old_restorewpadmin = WP_CONTENT_DIR . '/bps-backup/master-backups/wpadmin.htaccess';
	$new_restorewpadmin = ABSPATH . 'wp-admin/.htaccess';
	$htaccessARRoot = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$htaccessARWpadmin = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$permsRootHtaccess = @substr(sprintf('%o', fileperms($new_restoreroot)), -4);
	$sapi_type = php_sapi_name();		

	if ( $_POST['bpsrestorehtaccessfiles'] == 'restore-htaccess-files' ) { 
		
		if ( file_exists($old_restoreroot) ) { 
		
			if ( @substr($sapi_type, 0, 6) != 'apache' && @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($new_restoreroot, 0644);
			}	
		
		if ( !copy($old_restoreroot, $new_restoreroot) ) {
			echo $bps_topDiv;
			echo '<font color="red"><strong>'.__('Failed to Restore Your Root htaccess File. Either you DO NOT currently have a Backed up Root htaccess file or your current active Root htaccess file permissions do not allow the file to be replaced/restored.', 'bulletproof-security').'</strong></font>';
   			echo $bps_bottomDiv;
		
		} else {
			
			if ( copy($new_restoreroot, $htaccessARRoot) ) {
			
				if ( @substr($sapi_type, 0, 6) != 'apache' && $options['bps_root_htaccess_autolock'] != 'Off' || $Flockoptions['bps_lock_root_htaccess'] == 'yes') {			
					@chmod($new_restoreroot, 0404);
				}
			
			echo $bps_topDiv;
			$textRoot = '<font color="green"><strong>'.__('Your Root htaccess file has been Restored successfully.', 'bulletproof-security').'</strong></font>';
			echo $textRoot;
			echo $bps_bottomDiv;
			}
		}
		}
		
		if ( file_exists($old_restorewpadmin) ) { 	
		if ( !copy($old_restorewpadmin, $new_restorewpadmin) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('Failed to Restore Your wp-admin htaccess File. Either you DO NOT currently have a Backed up wp-admin htaccess file or your current active wp-admin htaccess file permissions do not allow the file to be replaced/restored.', 'bulletproof-security').'</strong></font>';
			echo $text;
   			echo $bps_bottomDiv;
		
		} else {
			
			copy($old_restorewpadmin, $htaccessARWpadmin);
			echo $bps_topDiv;
			$textWpadmin = '<font color="green"><strong>'.__('Your wp-admin htaccess file has been Restored successfully.', 'bulletproof-security').'</strong></font>';
			echo $textWpadmin;
			echo $bps_bottomDiv;
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

require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/core/core-help-text.php' );
require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/core/core-htaccess-code.php' );

$bpsSpacePop = '-------------------------------------------------------------';

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<!-- Begin inline CSS for WP Filesystem API Errors -->
<style type="text/css">
div.error {margin-left:220px;}
</style>
<!-- End inline CSS for WP Filesystem API Errors -->

<h2 style="margin-left:220px;"><?php _e('B-Core ~ Htaccess Core Security', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
    <div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('Security Modes', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-2"><?php _e('Security Status', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-5"><?php _e('Backup &amp; Restore', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-6"><?php _e('htaccess File Editor', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-7"><?php _e('Custom Code', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-8"><?php _e('My Notes', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-9"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">

<h2><?php _e('htaccess File Security Modes ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Root Folder BulletProof Mode, wp-admin Folder BulletProof Mode, Plugin Firewall Bulletproof Mode & UAEG BulletProof Mode', 'bulletproof-security'); ?></span></h2>

<table id="test1" width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help" style="">

    <h2 style="margin:-15px 0px 5px 0px;border-bottom:1px solid #999999;"><?php _e('AutoMagic Buttons ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Click the', 'bulletproof-security'); echo '<strong>'; _e(' AutoMagic, Setup Steps & Other Help Info', 'bulletproof-security'); echo '</strong>'; _e(' Read Me help button below for setup steps', 'bulletproof-security'); ?></span></h2>

<h3><?php _e('AutoMagic, Setup Steps & Other Help Info', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Setup Steps & AutoMagic', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content1; ?></p>
</div>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<div id="AutoMagic-buttons" style="">

<?php if ( ! is_multisite() ) { ?>

<form name="bps-auto-write-default" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
	<?php wp_nonce_field('bulletproof_security_auto_write_default'); ?>
	<input type="hidden" name="filename" value="bps-auto-write-default_write" />
	<div id="AutoMagic-buttons" style="float:left;padding-left:10px;padding-right:5px;">
	<input type="submit" name="bps-auto-write-default" value="<?php _e('Create default.htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php 
$text = __('Clicking OK will create a new customized default.htaccess Master file for your website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('This is only creating a Master file and NOT activating it. To activate Master files go to the Activate Security Modes section below.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('NOTE: Default Mode should ONLY be activated for Testing and Troubleshooting.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Create your new default.htaccess Master file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
	</div>
</form>

<form name="bps-auto-write-secure-root" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
	<?php wp_nonce_field('bulletproof_security_auto_write_secure_root'); ?>
	<input type="hidden" name="filename" value="bps-auto-write-secure_write" />
	<div id="AutoMagic-buttons" style="float:left;padding-left:10px;">
	<input type="submit" name="bps-auto-write-secure-root" value="<?php _e('Create secure.htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will create a new customized secure.htaccess Master file for your website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('This is only creating a Master file and NOT activating it. To activate Master files go to the Activate Security Modes section below.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Create your new secure.htaccess Master file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
	</div>
</form>

<?php } else { ?>

<form name="bps-auto-write-default-MUSDir" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
	<?php wp_nonce_field('bulletproof_security_auto_write_default_MUSDir'); ?>
	<input type="hidden" name="filename" value="bps-auto-write-default_write-MUSDir" />
	<div id="AutoMagic-buttons" style="float:left;padding-left:10px;">
	<input type="submit" name="bps-auto-write-default-MUSDir" value="<?php _e('Create default.htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will create a new customized default.htaccess Master file for your Network / Multisite website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('This is only creating a Master file and NOT activating it. To activate Master files go to the Activate Security Modes section below.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('NOTE: Default Mode should ONLY be activated for Testing and Troubleshooting.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Create your new default.htaccess Master file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
	</div>
</form>

<form name="bps-auto-write-secure-root-MUSDir" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
	<?php wp_nonce_field('bulletproof_security_auto_write_secure_root_MUSDir'); ?>
	<input type="hidden" name="filename" value="bps-auto-write-secure_write_MUSDir" />
	<div id="AutoMagic-buttons" style="float:left;padding-left:10px;">
	<input type="submit" name="bps-auto-write-secure-root-MUSDir" value="<?php _e('Create secure.htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will create a new customized secure.htaccess Master file for your Network/Multisite website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('This is only creating a Master file and NOT activating it. To activate Master files go to the Activate Security Modes section below.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Create your new secure.htaccess Master file or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
	</div>
</form>

<?php } ?>

</div>
<div style="clear:left;"></div>

<?php } ?>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

    <h2 style="border-bottom:1px solid #999999;"><?php _e('Activate|Deactivate Security Modes', 'bulletproof-security'); ?></h2>

    <h3><?php _e('Activate|Deactivate Root Folder BulletProof Mode (RBM)', 'bulletproof-security'); ?></h3>

<div id="WBM-Link"></div>

<div id="root-bulletproof-mode" style="padding-left:10px;border-bottom:1px solid #999999;">

<?php $bps_secureroot = ( isset( $_POST['Submit-Secure-Root'] ) ) ? $_POST['Submit-Secure-Root'] : ''; ?>

<form name="BulletProof-Root" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_root_copy'); ?>
	<label for="root-bulletproof-mode">
    <input name="bpsecureroot" type="radio" value="bulletproof" class="tog" <?php checked( $bps_secureroot ); ?> /> 
	<?php $text = __('Activate Root Folder BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br /><br />
 	<label for="root-bulletproof-mode">
    <input name="bpsecureroot" type="radio" value="default" class="tog" <?php checked( $bps_secureroot ); ?> />
	<?php $text = '<font color="red">'.__('Deactivate Root Folder BulletProof Mode (Default Mode) CAUTION: ', 'bulletproof-security').'</font>'.__('Use Default Mode for Testing, Troubleshooting or BPS removal.', 'bulletproof-security').'<br>'; echo $text; ?></label>
	<input type="submit" name="Submit-Secure-Root" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate|Deactivate', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminders:', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Did you create your Master htaccess files using the AutoMagic buttons?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Did you backup your existing htaccess files?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Do you have any custom htaccess code in your Root htaccess file that you want to save before Activating BulletProof Mode?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Clicking OK will overwrite your existing Root htaccess file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Activate BulletProof Mode for your Root folder or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

</div>

<h3><?php _e('Activate|Deactivate wp-admin Folder BulletProof Mode (WBM)', 'bulletproof-security'); ?></h3>

<div id="PFWScan-Menu-Link"></div>

<div id="wpadmin-bulletproof-mode" style="padding-left:10px;border-bottom:1px solid #999999;">

<?php $bps_securewpadmin = ( isset( $_POST['Submit-Secure-wpadmin'] ) ) ? $_POST['Submit-Secure-wpadmin'] : ''; ?>

<form name="BulletProof-WPadmin" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_wpadmin_copy'); ?>
	<label for="wpadmin-bulletproof-mode">
    <input name="bpsecurewpadmin" type="radio" value="bulletproof" class="tog" <?php checked( $bps_securewpadmin ); ?> /> 
	<?php $text = __('Activate wp-admin Folder BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br /><br />
	<label for="wpadmin-bulletproof-mode">
    <input name="bpsecurewpadmin" type="radio" value="default" class="tog" <?php checked( $bps_securewpadmin ); ?> /> 
	<?php $text = '<font color="red">'.__('Deactivate wp-admin Folder BulletProof Mode CAUTION: ', 'bulletproof-security').'</font>'.__('Deactivate for Testing, Troubleshooting or BPS removal.', 'bulletproof-security').'<br>'; echo $text; ?></label>
	<input type="submit" name="Submit-Secure-wpadmin" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate|Deactivate', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminders:', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Did you backup your existing htaccess files?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Do you have any custom htaccess code in your wp-admin htaccess file that you want to save before Activating BulletProof Mode?', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Clicking OK will overwrite your existing wp-admin htaccess file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Activate BulletProof Mode for your wp-admin folder or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

<form name="wpadminEnableDisable" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_htaccess_res'); ?> 
	<?php $BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res'); ?>
	<strong><label for="wpadmin-res"><?php _e('Enable|Disable wp-admin BulletProof Mode (GDMW Hosting):', 'bulletproof-security'); ?></label></strong><br />
	<strong><label for="wpadmin-res" style="color:#2ea2cc;"> <?php _e('This is a custom option (not required). Click the Read Me help button above.', 'bulletproof-security'); ?></label></strong><br />
<select name="bulletproof_security_options_htaccess_res[bps_wpadmin_restriction]" style="width:280px;margin-top:5px;">
<option value="enabled" <?php selected('enabled', $BPS_wpadmin_Options['bps_wpadmin_restriction']); ?>><?php _e('Enable wp-admin BulletProof Mode', 'bulletproof-security'); ?></option>
<option value="disabled" <?php selected('disabled', $BPS_wpadmin_Options['bps_wpadmin_restriction']); ?>><?php _e('Disable wp-admin BulletProof Mode', 'bulletproof-security'); ?></option>
</select>
<input type="submit" name="Submit-Enable-Disable-wpadmin" class="button bps-button" style="margin:5px 0px 10px 0px;" value="<?php esc_attr_e('Enable|Disable', 'bulletproof-security') ?>" />
</form>

</div>

    <h3><?php _e('Activate|Deactivate Plugin Firewall (PFW) BulletProof Mode', 'bulletproof-security'); ?>  <button id="bps-open-modal4" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content4" title="<?php _e('Plugin Firewall (PFW) BulletProof Mode', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content4; ?></p>
</div>

<?php bpsPFWWhitelistRulesCheck(); ?>

<div id="PFW-Messages" style="position:relative;top:40px;left:235px;margin:0px 0px 0px 0px;">

<?php 

// Plugin Firewall - Create Firewall Master File Form
if ( isset( $_POST['bpsPFW-Master-Submit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_PFW_Master' );

$options = get_option('bulletproof_security_options_pfirewall');
$PluginsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins.htaccess';
$PluginsHtaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins.htaccess';
$PluginsHtaccessARQDir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/';
$pluginsHtaccessMasterTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins-htaccess-master.txt';
$pluginsHtaccessMasterTXTARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins-htaccess-master.txt';
$bps_get_domain_root = bpsGetDomainRoot();
$bps_get_server_ip = bps_get_server_ip_address();
$bps_get_public_ip = bpsPro_get_proxy_real_ip_address();

	if ( file_exists($PluginsHtaccessMaster) ) {

		$bps_js_scripts = array( "/bulletproof-security/admin/js/bulletproof-security-admin-5.js, ", "/bulletproof-security/admin/js/bulletproof-security-admin-4.js, ","/bulletproof-security/admin/js/bulletproof-security-admin-3.js, ", "/bulletproof-security/admin/js/bulletproof-security-admin-2.js, ", "/bulletproof-security/admin/js/bulletproof-security-admin.js, ", "/bulletproof-security/admin/js/bps-tabs.js, ", "/bulletproof-security/admin/js/bps-accordion.js, ", "/bulletproof-security/admin/js/bps-dialog.js, " );		
		
		$bps_pfw_whitelist = array_filter( explode(', ', str_replace( $bps_js_scripts, "", trim( $options['bps_pfw_whitelist'], ", \t\n\r") ) ) );
	
		if ( empty($bps_pfw_whitelist) ) {
			file_put_contents($pluginsHtaccessMasterTXT, "");
		
		} else {
		
			$whiteList = array();
		
			foreach ( $bps_pfw_whitelist as $Key => $Value ) {
				$whiteList[] = 'SetEnvIf Request_URI "'.$Value.'$" whitelist'."\n";
				file_put_contents($pluginsHtaccessMasterTXT, $whiteList);
			}
		}
		
		$whiteListMaster = file_get_contents($pluginsHtaccessMasterTXT);
		$stringReplace = file_get_contents($PluginsHtaccessMaster);
		$stringReplace = preg_replace('/BEGIN WHITELIST(.*)END WHITELIST/s', "BEGIN WHITELIST: Frontend Loading Website Plugin scripts/files\nSetEnvIf Request_URI \"/bulletproof-security/400.php\$\" whitelist\nSetEnvIf Request_URI \"/bulletproof-security/403.php\$\" whitelist\n".$whiteListMaster."# END WHITELIST", $stringReplace);
		
		file_put_contents($PluginsHtaccessMaster, $stringReplace);

	if ( $options['bps_pfw_paypal'] == '1' ) {
		$payPal = "\n".'Allow from paypal.com';
	} else {
		$payPal = '';
	}
	
	if ( $options['bps_pfw_google'] == '1' ) {
		$google = "\n".'Allow from google.com';
	} else {
		$google = '';
	}

	if ( $options['bps_pfw_amazon'] == '1' ) {
		$amazon = "\n".'Allow from amazon.com';
	} else {
		$amazon = '';
	}

	if ( $options['bps_pfw_authorizenet'] == '1' ) {
		$authorizeNet = "\n".'Allow from authorize.net';
	} else {
		$authorizeNet = '';
	}

	//$stringReplace = file_get_contents($PluginsHtaccessMaster);
	$stringReplace = preg_replace('/<FilesMatch(.*)FilesMatch>/s', "<FilesMatch ".'"'."\.(7z|as|bat|bin|cgi|chm|chml|class|cmd|com|command|dat|db|db2|db3|dba|dll|DS_Store|exe|gz|hta|htaccess|htc|htm|html|html5|htx|idc|ini|ins|isp|jar|jav|java|js|jse|jsfl|json|jsp|jsx|lib|lnk|out|php|phps|php5|php4|php3|phtml|phpt|pl|py|pyd|pyc|pyo|rar|shtm|shtml|sql|swf|sys|tar|taz|tgz|tpl|txt|vb|vbe|vbs|war|ws|wsf|xhtml|z|zip)$".'"'.">\nOrder Allow,Deny\nAllow from env=whitelist\nAllow from $bps_get_domain_root\nAllow from $bps_get_server_ip\n# BEGIN PUBLIC IP\nAllow from $bps_get_public_ip\n# END PUBLIC IP$payPal$google$amazon$authorizeNet\n</FilesMatch>", $stringReplace);
		
		file_put_contents($PluginsHtaccessMaster, $stringReplace);
		
		/** Allow from Whitelist Rules **/
		$Allow_options = get_option('bulletproof_security_options_pfirewall_allow');
		$pluginsAllowFromTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins-allow-from.txt';
		$pluginsAllowFromTXTARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins-allow-from.txt';
		
		if ( $Allow_options['bps_pfw_allow_from'] != '' ) {	
	
			$pfw_allow_from = array_filter( explode(', ', trim( $Allow_options['bps_pfw_allow_from'], ", \t\n\r" ) ) );
			$allow_whiteList = array();
		
			foreach ( $pfw_allow_from as $allow_Key => $allow_Value ) {
				$allow_whiteList[] = $allow_Value."\n";
				file_put_contents($pluginsAllowFromTXT, $allow_whiteList);
			}

			$AllowFromRules = file_get_contents($pluginsAllowFromTXT);
			$stringReplace = file_get_contents($PluginsHtaccessMaster);
			$stringReplace = preg_replace('/#\sEND\sPUBLIC\sIP/', "# END PUBLIC IP\n# BEGIN ADDITIONAL ALLOW FROM RULES\n".$AllowFromRules."# END ADDITIONAL ALLOW FROM RULES", $stringReplace);			
			
			file_put_contents($PluginsHtaccessMaster, $stringReplace);
		
			if ( is_dir($PluginsHtaccessARQDir) ) {
				@copy($PluginsHtaccessMaster, $PluginsHtaccessARQ);
				@copy($pluginsHtaccessMasterTXT, $pluginsHtaccessMasterTXTARQ);
				@copy($pluginsAllowFromTXT, $pluginsAllowFromTXTARQ);
			}
		}

		if ( is_dir($PluginsHtaccessARQDir) && !$Allow_options['bps_pfw_allow_from'] || $Allow_options['bps_pfw_allow_from'] == '' ) {
			@copy($PluginsHtaccessMaster, $PluginsHtaccessARQ);
			@copy($pluginsHtaccessMasterTXT, $pluginsHtaccessMasterTXTARQ);
		}
	}
}

$scrolltoPFW = isset($_REQUEST['scrolltoPFW']) ? (int) $_REQUEST['scrolltoPFW'] : 0; 
$scrolltoAllowFrom = isset($_REQUEST['scrolltoAllowFrom']) ? (int) $_REQUEST['scrolltoAllowFrom'] : 0;

echo '<div id="pfw-inpage-messages" style="margin:0px 0px 6px 120px;">';

	if ( @$_GET['settings-updated'] == true )  { 
		echo '<div id="pfw-inpage-messages" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin-bottom:5px;max-width:600px;">';
		$text = '<font color="blue"><strong>'.__('Reminder: After clicking the Save Whitelist Data button, click the Create Firewall Master File button.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	}

	if ( isset( $_POST['bpsPFW-Master-Submit'] ) ) {
		$PluginsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins.htaccess';
		$pluginsHtaccessMasterTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins-htaccess-master.txt';	
	if ( is_writable($pluginsHtaccessMasterTXT) && is_writable($PluginsHtaccessMaster ) ) {
		echo '<div id="pfw-inpage-messages" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin-bottom:5px;max-width:600px;">';
		$text = '<font color="blue"><strong>'.__('Success! Your Plugin Firewall Master File has been created.', 'bulletproof-security').'<br>'.__('Select the Activate Plugin Firewall BulletProof Mode Radio button and click the Activate|Deactivate button to activate the Plugin Firewall.', 'bulletproof-security').'</strong></font>'; 
		echo $text; 
		echo '</div>';
	}
	elseif ( ! is_writable($pluginsHtaccessMasterTXT) || !is_writable($PluginsHtaccessMaster) ) {
		echo '<div id="pfw-inpage-messages" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin-bottom:5px;max-width:600px;">';
		$text = '<strong><font color="red">'.__('Error: Failed to Create the Plugin Firewall Master File.', 'bulletproof-security').'</font><br>'.__('Check the file and folder permissions for these files.', 'bulletproof-security').'</strong><br>'.$pluginsHtaccessMasterTXT.'<br>'.$PluginsHtaccessMaster; 
		echo $text; 
		echo '</div>';
	}
	}
echo '</div>';

?> 
</div>

<div id="bps-accordion-1" class="bps-accordian-main-3">

<h3><?php _e('Plugin Firewall Whitelist Tools', 'bulletproof-security'); ?></h3>
<div id="mmode-accordian-inner">

<?php echo '<div style="color:#2ea2cc;margin:-15px 0px 10px 0px;font-weight:bold;">'.__('Click the Read Me help button for help information about the Plugin Firewall Whitelist Tools', 'bulletproof-security').'</div>'; ?>

<form name="PFW-Form" action="options.php#PFWScan-Menu-Link" method="post">
    <?php settings_fields('bulletproof_security_options_pfirewall'); ?>
	<?php $options = get_option('bulletproof_security_options_pfirewall'); ?>
    
<div id="PFW2" style="position:relative;top:0px;left:0px;float:left;margin:0px 15px 0px 0px;">
    
    <strong><label><?php _e('Plugins Script|File Whitelist Text Area', 'bulletproof-security'); ?></label></strong><br />
    <!-- important note: when using code in a text area you cannot leave whitespace in that code or that whitespace will be echoed -->
    <textarea class="PFW-Whitelist-Text-Area" name="bulletproof_security_options_pfirewall[bps_pfw_whitelist]" style="font-size:1.13em;margin-top:5px;" tabindex="1"><?php echo trim( $options['bps_pfw_whitelist'], ", \t\n\r"); ?></textarea>
	<input type="hidden" name="scrolltoPFW" id="scrolltoPFW" value="<?php echo $scrolltoPFW; ?>" />
	<input type="hidden" name="PFWSWD" value="PFWSWD" />
</div>

<div id="PFW3" style="padding:0px 10px 0px 10px;">
    <label><strong><?php _e('Payment Providers', 'bulletproof-security'); ?></strong></label><br />
    <input type="checkbox" name="bulletproof_security_options_pfirewall[bps_pfw_paypal]" style="margin-top:5px;" value="1" <?php checked( $options['bps_pfw_paypal'], 1 ); ?> /><label><?php _e(' PayPal', 'bulletproof-security'); ?></label><br /><br />
	<input type="checkbox" name="bulletproof_security_options_pfirewall[bps_pfw_google]" value="1" <?php checked( $options['bps_pfw_google'], 1 ); ?> /><label><?php _e(' Google Checkout', 'bulletproof-security'); ?></label><br /><br />    
	<input type="checkbox" name="bulletproof_security_options_pfirewall[bps_pfw_amazon]" value="1" <?php checked( $options['bps_pfw_amazon'], 1 ); ?> /><label><?php _e(' Amazon Checkout', 'bulletproof-security'); ?></label><br /><br />  
	<input type="checkbox" name="bulletproof_security_options_pfirewall[bps_pfw_authorizenet]" value="1" <?php checked( $options['bps_pfw_authorizenet'], 1 ); ?> /><label><?php _e(' Authorize.net', 'bulletproof-security'); ?></label><br />  
</div>

<div id="PFW5">
	<input type="submit" name="bpsPFW-Submit" class="button bps-button" value="<?php esc_attr_e('Save Whitelist Data', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Clicking the Save Whitelist Data button saves the plugins Whitelist data to your WordPress Database.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('You can make changes or add and remove plugin script/file names manually in the Plugins Script|File Whitelist Text Area at any time and resave your changes.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('After you have saved your Whitelist Data click the Create Firewall Master File button next and then activate the Plugin Firewall.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your database options or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>
</div>
</form>
<br /><br />

<form name="PFW-Form-Master" action="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" method="post">
	<?php wp_nonce_field('bulletproof_security_PFW_Master'); ?>
	<input type="submit" name="bpsPFW-Master-Submit" class="button bps-button" style="margin-top:20px;" value="<?php esc_attr_e('Create Firewall Master File', 'bulletproof-security') ?>"   onclick="return confirm('<?php $text = __('Clicking the Create Firewall Master File button creates your Plugin Firewall Master .htaccess file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('After you have created your Plugin Firewall Master .htaccess file you can then select the Plugin Firewall BulletProof Mode Radio Button and click the Activate button to activate the Plugin Firewall.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to create your Plugin Firewall Master .htaccess file or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>  
</form>


<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#PFW-Form').submit(function(){ $('#scrolltoPFW').val( $('#bulletproof_security_options_pfirewall[bps_pfw_whitelist]').scrollTop() ); });
	$('#bulletproof_security_options_pfirewall[bps_pfw_whitelist]').scrollTop( $('#scrolltoPFW').val() );
});
/* ]]> */
</script> 

</div>
  
  <h3><?php _e('Plugin Firewall AutoPilot Mode', 'bulletproof-security'); ?></h3>
  <div id="mmode-accordian-inner">

<?php echo '<div style="color:#2ea2cc;margin:-15px 0px 10px 0px;font-weight:bold;">'.__('Click the Read Me help button for help information about Plugin Firewall AutoPilot Mode', 'bulletproof-security').'</div>'; ?>

<div id="PFW13" style="position:relative;top:10px;left:0px;float:left;margin:0px 0px 0px 0px;">
    
<?php

// Form Processing: Save Plugin Firewall AutoPilot Form Options
if ( isset( $_POST['Submit-PFW-AutoPilot'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_pfw_autopilot');

	$autopilot_cron_frequency = $_POST['autopilot_cron_frequency'];
	
	if ( $autopilot_cron_frequency == '1' ) {
		$autopilot_cron_end = time() + 60;	
	}
	if ( $autopilot_cron_frequency == '5' ) {
		$autopilot_cron_end = time() + 300;	
	}	
	if ( $autopilot_cron_frequency == '10' ) {
		$autopilot_cron_end = time() + 600;	
	}
	if ( $autopilot_cron_frequency == '15' ) {
		$autopilot_cron_end = time() + 900;	
	}	
	if ( $autopilot_cron_frequency == '30' ) {
		$autopilot_cron_end = time() + 1800;	
	}	
	if ( $autopilot_cron_frequency == '60' ) {
		$autopilot_cron_end = time() + 3600;	
	}

	$PFWAP_Options = array( 
	'bps_pfw_autopilot_cron' 			=> $_POST['autopilot_on_off'], 
	'bps_pfw_autopilot_cron_frequency' 	=> $autopilot_cron_frequency, 
	'bps_pfw_autopilot_cron_end' 		=> $autopilot_cron_end
	);
	
		foreach( $PFWAP_Options as $key => $value ) {
			update_option('bulletproof_security_options_pfw_autopilot', $PFWAP_Options);
		}

	if ( $_POST['autopilot_on_off'] == 'On' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';	
		echo '<strong><font color="green">'.__('Plugin Firewall AutoPilot Mode has been turned On. The BPS Pro Dashboard Status Display will display: PFW: AutoPilot : 00 Min : 00:00 AM when AutoPilot Mode is turned On', 'bulletproof-security').'</font></strong><br>';
		echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
		echo '</p></div>';
	}

	if ( $_POST['autopilot_on_off'] == 'Off' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';	
		echo '<strong><font color="green">'.__('Plugin Firewall AutoPilot Mode has been turned Off. The BPS Pro Dashboard Status Display will display: PFW: On if the Plugin Firewall is Turned On.', 'bulletproof-security').'</font></strong><br>';
		echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
		echo '</p></div>';
	}
}
	
	// Form: Plugin Firewall AutoPilot Form
	echo '<form name="bpsPFWAutoPilot" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">';
	wp_nonce_field('bulletproof_security_pfw_autopilot');

	$AutoPilot_options = get_option('bulletproof_security_options_pfw_autopilot');
	
	echo '<label for="bps-autopilot">'.__('AutoPilot Mode Cron Check Frequency:', 'bulletproof-security').'</label><br>';
	echo '<select name="autopilot_cron_frequency" style="width:340px;">';
	echo '<option value="1"'. selected('1', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 1 Minute', 'bulletproof-security').'</option>';
	echo '<option value="5"'. selected('5', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 5 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="10"'. selected('10', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 10 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="15"'. selected('15', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 15 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="30"'. selected('30', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 30 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="60"'. selected('60', $AutoPilot_options['bps_pfw_autopilot_cron_frequency']).'>'.__('Run AutoPilot Cron Check Every 60 Minutes', 'bulletproof-security').'</option>';
	echo '</select><br><br>';

	echo '<label for="bps-autopilot">'.__('AutoPilot Mode On or Off:', 'bulletproof-security').'</label><br>';
	echo '<select name="autopilot_on_off" style="width:340px;">';
	echo '<option value="On"'. selected('On', $AutoPilot_options['bps_pfw_autopilot_cron']).'>'.__('Turn On AutoPilot Mode', 'bulletproof-security').'</option>';
	echo '<option value="Off"'. selected('Off', $AutoPilot_options['bps_pfw_autopilot_cron']).'>'.__('Turn Off AutoPilot Mode', 'bulletproof-security').'</option>';
	echo '</select>';
	
	echo "<p><input type=\"submit\" name=\"Submit-PFW-AutoPilot\" value=\"".__('Save AutoPilot Options', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('Plugin Firewall AutoPilot Mode will automatically detect and create Plugin Firewall whitelist rules in real-time when AutoPilot Mode is turned On\n\n-------------------------------------------------------------\n\nThe BPS Pro Dashboard Status Display will display: PFW: AutoPilot : 00 Min : 00:00 AM when AutoPilot Mode is turned On\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" /></p></form>";

?>

</div>
</div>

  <h3><?php _e('Plugin Firewall cURL Scanner', 'bulletproof-security'); ?></h3>
  <div id="mmode-accordian-inner">

<div id="PFW13" style="position:relative;top:0px;left:0px;float:left;margin:0px 15px 0px 0px;font-size:1.13em;">
<?php $text = '<strong><font color="#2ea2cc">'.__('Pro-Tools cURL Multi Page Scanner: ', 'bulletproof-security').'</font><a href="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-12" class="button bps-button" style="margin-top:-5px;">'.__('Click Here', 'bulletproof-security').'</a></strong>'; echo $text; ?>
</div>

</div>

  <h3><?php _e('Plugin Firewall Additional Whitelist Tools', 'bulletproof-security'); ?></h3>
  <div id="mmode-accordian-inner">

<?php echo '<div style="color:#2ea2cc;margin:-15px 0px 10px 0px;font-weight:bold;">'.__('Click the Read Me help button for help information about the Plugin Firewall Additional Whitelist Tools', 'bulletproof-security').'</div>'; ?>

<div id="PFWCustomScan" style="position:relative; top:0px; left:0px; float:left; margin:0px 15px 0px 0px;">

<form name="PFW-Allow-From-Form" action="options.php#PFWScan-Menu-Link" method="post">
    <?php settings_fields('bulletproof_security_options_pfirewall_allow'); ?>
	<?php $options = get_option('bulletproof_security_options_pfirewall_allow'); ?>

<div id="PFW8" style="position:relative;top:0px;left:0px;float:left;margin:0px 15px 0px 0px;">

	<strong><label><?php _e('"Allow from" Whitelist rules (See Read Me Help Button):', 'bulletproof-security'); ?></label></strong><br />
    <?php $text = '<div style="allow-from-small-text">'.__('Whitelist rules are separated by a comma and a space.', 'bulletproof-security').'<br>'.__('Example: Allow from example.com, Allow from 100.99.88.77', 'bulletproof-security').'</div>';	echo $text;	?>
    <textarea class="PFW-Allow-From-Text-Area" name="bulletproof_security_options_pfirewall_allow[bps_pfw_allow_from]" style="margin-top:5px;" tabindex="1"><?php echo trim( $options['bps_pfw_allow_from'], ", \t\n\r"); ?></textarea>
	<input type="hidden" name="scrolltoAllowFrom" id="scrolltoAllowFrom" value="<?php echo $scrolltoAllowFrom; ?>" />

<div id="PFW7" style="position:relative;top:0px;left:0px;margin:10px 0px 10px 0px;border-bottom:1px solid #999999;">

	<input type="submit" name="bpsPFW-Allow-From-Submit" class="button bps-button" style="margin-bottom:20px;" value="<?php esc_attr_e('Save Additional Allow from Rules', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This option is for adding additional - Allow from - whitelist rules to whitelist additional domain names or IP addresses in your Plugin Firewall .htaccess file. Example whitelist rules: Allow from example.com will whitelist the example.com domain. Allow from 100.99.88.77 will whitelist IP address 100.99.88.77. Whitelist rules are separated by a comma and a space. Example: Allow from example.com, Allow from 100.99.88.77', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('After clicking the Save Additional Allow from Rules button, click the Create Firewall Master File button, select the Plugin Firewall BulletProof Mode Radio Button and click the Activate button to activate the Plugin Firewall.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your Additional Whitelist rules or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>

</div>
</div>
</form>

</div>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#PFW-Allow-From-Form').submit(function(){ $('#scrolltoAllowFrom').val( $('#bulletproof_security_options_pfirewall_allow[bps_pfw_allow_from]').scrollTop() ); });
	$('#bulletproof_security_options_pfirewall_allow[bps_pfw_allow_from]').scrollTop( $('#scrolltoAllowFrom').val() );
});
/* ]]> */
</script>

<div id="PFW10" style="position:relative;top:0px;left:0px;float:left;margin:0px 15px 0px 0px;">

<div id="PFW12" style="position:relative;top:2px;left:0px;margin:0px 0px 0px 0px;">

<form name="PFW-Roles-Form" action="options.php#PFWScan-Menu-Link" method="post">
    <?php settings_fields('bulletproof_security_options_pfirewall_roles'); ?>
	<?php $options = get_option('bulletproof_security_options_pfirewall_roles'); ?>
    
    <label><strong><?php _e('Additional Roles IP Whitelist', 'bulletproof-security'); ?></strong></label><br />
    <input type="checkbox" name="bulletproof_security_options_pfirewall_roles[bps_pfw_administrator]" style="margin-top:5px;" value="1" <?php checked( $options['bps_pfw_administrator'], 1 ); ?> /><label><?php _e(' Administrator', 'bulletproof-security'); ?></label><br /><br />
    <input type="checkbox" name="bulletproof_security_options_pfirewall_roles[bps_pfw_editor]" value="1" <?php checked( $options['bps_pfw_editor'], 1 ); ?> /><label><?php _e(' Editor', 'bulletproof-security'); ?></label><br /><br />
	<input type="checkbox" name="bulletproof_security_options_pfirewall_roles[bps_pfw_author]" value="1" <?php checked( $options['bps_pfw_author'], 1 ); ?> /><label><?php _e(' Author', 'bulletproof-security'); ?></label><br /><br />    
	<input type="checkbox" name="bulletproof_security_options_pfirewall_roles[bps_pfw_contributor]" value="1" <?php checked( $options['bps_pfw_contributor'], 1 ); ?> /><label><?php _e(' Contributor', 'bulletproof-security'); ?></label><br />
	<input type="submit" name="bpsPFW-Submit-Roles" class="button bps-button"  style="margin-top:10px;" value="<?php esc_attr_e('Save Additional Roles Options', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This option is for folks who have additional Administrators, Editors, Authors and Contributors who log into the website to create Posts or perform other website tasks.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Clicking the Save Additional Roles Options button will enable automatic Plugin Firewall IP Address Whitelisting for the Additional Roles that you have selected.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('When a person with the Role capabilities that you have selected logs into the website their IP address will be automatically added to the Plugin Firewall Whitelist.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your Additional Roles Options or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>
</form>
</div>  
</div>
</div>
</div>

<div id="pfw-bulletproof-mode" style="padding-left:10px;font-weight:bold;border-bottom:1px solid #999999;">

<?php $bps_securepfw = ( isset( $_POST['submit-Plugins-Lock'] ) ) ? $_POST['submit-Plugins-Lock'] : ''; ?>

<form name="BulletProof-Plugins-Folder" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
	<?php wp_nonce_field('bulletproof_security_plugins_htaccess_copy'); ?>
	<label for="pfw-bulletproof-mode">
    <input name="bpssecurepfw" type="radio" value="bulletproof" class="tog" <?php checked( $bps_securepfw ); ?> /> 
	<?php $text = __('Activate Plugin Firewall BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br /><br />
	<label for="pfw-bulletproof-mode">
    <input name="bpssecurepfw" type="radio" value="default" class="tog" <?php checked( $bps_securepfw ); ?> />
	<?php $text = '<font color="red">'.__('Deactivate Plugin Firewall BulletProof Mode CAUTION: ', 'bulletproof-security').'</font>'.__('Deactivate for Testing or Troubleshooting.', 'bulletproof-security'); echo $text; ?></label>

<div id="UAEG-Menu-Link"></div>

	<input type="submit" name="submit-Plugins-Lock" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate|Deactivate', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminders:', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Reminder: The Read Me Help button contains extensive help information.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>

</div>    
    
<h3><?php _e('Activate|Deactivate Uploads Anti-Exploit Guard (UAEG) BulletProof Mode', 'bulletproof-security'); ?>  <button id="bps-open-modal5" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content5" title="<?php _e('UAEG BulletProof Mode', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content5; ?></p>
</div>

<div id="uaeg-bulletproof-mode" style="padding-left:10px;font-weight:bold;border-bottom:1px solid #999999;">

<?php $bps_secureuaeg = ( isset( $_POST['submit-Uploads-Lock'] ) ) ? $_POST['submit-Uploads-Lock'] : ''; ?>

<form name="BulletProof-Uploads-Folder" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_uploads_htaccess_copy'); ?>
	<label for="uaeg-bulletproof-mode">
    <input name="bpsuaeg" type="radio" value="bulletproof" class="tog" <?php checked( $bps_secureuaeg ); ?> /> 
	<?php $text = __('Activate UAEG BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br /><br />
	<label for="uaeg-bulletproof-mode">
    <input name="bpsuaeg" type="radio" value="default" class="tog" <?php checked( $bps_secureuaeg ); ?> /> 
	<?php $text = '<font color="red">'.__('Deactivate UAEG BulletProof Mode CAUTION: ', 'bulletproof-security').'</font>'.__('Deactivate for Testing or Troubleshooting.', 'bulletproof-security'); echo $text; ?></label><br />
	<input type="submit" name="submit-Uploads-Lock" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate|Deactivate', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Reminders:', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('The Read Me Help button contains help information.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('If you delete the uploads htaccess file using this manual control then this turns Off automatic creation of the /uploads/.htaccess file and you will need to use this manual control to activate BulletProof Mode again to turn automatic creation of the /uploads/.htaccess file back On again.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel to exit.', 'bulletproof-security'); echo $text; ?>')" />
</form>

</div>

    <h2><?php _e('Additional (Automated) BulletProof Modes ~ Manual Controls', 'bulletproof-security'); ?></h2>

    <?php $text = __('These additional automated BulletProof Modes are activated automatically.', 'bulletproof-security').'<br>'.__('Use these manual controls if your Server type does not allow these files to be created automatically.', 'bulletproof-security').'<br>'.__('Click the Read Me help button below for additional help information.', 'bulletproof-security');
	echo $text;
	?>
	
<h3><?php _e('Additional (Automated) BulletProof Modes', 'bulletproof-security'); ?>  <button id="bps-open-modal6" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content6" title="<?php _e('Additional (Automated) BulletProof Modes', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content6; ?></p>
</div>

<div id="uaeg-bulletproof-mode" style="padding-left:10px;">

<?php $bps_secure_master_folder = ( isset( $_POST['Submit-Master-Folder'] ) ) ? $_POST['Submit-Master-Folder'] : ''; ?>

<form name="BulletProof-deny-all-htaccess" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_denyall_master'); ?>
	<label for="denyall-bulletproof-mode">
    <input name="bpssecuremaster" type="radio" value="bulletproof" class="tog" <?php checked( $bps_secure_master_folder ); ?> /> 
	<?php $text = __('Activate Master htaccess BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br />
	<input type="submit" name="Submit-Master-Folder" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate', 'bulletproof-security') ?>" />
</form>

<?php $bps_secure_backup_folder = ( isset( $_POST['Submit-Backup-Folder'] ) ) ? $_POST['Submit-Backup-Folder'] : ''; ?>

<form name="BulletProof-deny-all-backup" action="admin.php?page=bulletproof-security/admin/core/options.php" method="post">
<?php wp_nonce_field('bulletproof_security_denyall_bpsbackup'); ?>
	<label for="denyall-bulletproof-mode">
	<input name="bpssecurebackup" type="radio" value="bulletproof" class="tog" <?php checked( $bps_secure_backup_folder ); ?> /> 
	<?php $text = __('Activate BPS Backup BulletProof Mode', 'bulletproof-security'); echo $text; ?></label><br />
	<input type="submit" name="Submit-Backup-Folder" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Activate', 'bulletproof-security') ?>" />
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
            
<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('htaccess Files Security Status ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('& Additional Website Security Measures', 'bulletproof-security'); ?></span></h2>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-status_table">
  <tr>
    <td width="49%" class="bps-table_title"><?php _e('Activated BulletProof Security htaccess Files', 'bulletproof-security'); ?></td>
    <td width="2%">&nbsp;</td>
    <td width="49%" class="bps-table_title"><?php _e('Additional Website Security Measures','bulletproof-security'); ?></td>
  </tr>
  <tr>
    <td class="bps-table_cell_status">

<?php 
	echo bps_root_htaccess_status();
	echo bps_denyall_htaccess_status_master();
	echo bps_denyall_htaccess_status_backup();
	echo bps_wpadmin_htaccess_status();
	echo bps_plugins_htaccess_status();
	echo bps_uploads_htaccess_status();
	if ( is_multisite() && is_super_admin() ) {	
		echo bps_blogsdir_htaccess_status();
	}
?>
    <td>&nbsp;</td>
    <td class="bps-table_cell_status">
<?php 
	echo bps_wpdb_errors_off();
	echo bps_wp_remove_version();
	echo bps_check_admin_username();
	echo bps_filesmatch_check_readmehtml();
	echo bps_filesmatch_check_installphp();
	echo bpsPro_sysinfo_message();
?>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
<br />
</div>
            
<div id="bps-tabs-5" class="bps-tab-page">
<h2><?php _e('htaccess File Backup & Restore ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Backup htaccess Files & Restore htaccess Files', 'bulletproof-security'); ?></span></h2>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Backup & Restore htaccess Files', 'bulletproof-security'); ?> <button id="bps-open-modal12" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content12" title="<?php _e('Backup & Restore htaccess Files', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content12; ?></p>
</div>

<?php $bps_backup_htaccess_files = ( isset( $_POST['Submit-Backup-htaccess-Files'] ) ) ? $_POST['Submit-Backup-htaccess-Files'] : ''; ?>

<form name="BulletProof-Backup" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-5" method="post">
<?php wp_nonce_field('bulletproof_security_backup_active_htaccess_files'); ?>
	<label for="backup-htaccess-files" style="font-size:1.13em;">
    <input name="bpsbackuphtaccessfiles" type="radio" value="backup-htaccess-files" class="tog" <?php checked( $bps_backup_htaccess_files ); ?> />
	<?php _e('Backup htaccess Files', 'bulletproof-security'); ?></label><br />
	<input type="submit" name="Submit-Backup-htaccess-Files" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Backup htaccess Files', 'bulletproof-security') ?>" />
</form>

<?php $bps_restore_htaccess_files = ( isset( $_POST['Submit-Restore-htaccess-Files'] ) ) ? $_POST['Submit-Restore-htaccess-Files'] : ''; ?>

<form name="BulletProof-Restore" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-5" method="post">
	<?php wp_nonce_field('bulletproof_security_restore_active_htaccess_files'); ?>
	<label for="restore-htaccess-files" style="font-size:1.13em;">
    <input name="bpsrestorehtaccessfiles" type="radio" value="restore-htaccess-files" class="tog" <?php checked( $bps_restore_htaccess_files ); ?> />
	<?php _e('Restore htaccess Files', 'bulletproof-security'); ?></label><br />
	<input type="submit" name="Submit-Restore-htaccess-Files" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Restore htaccess Files', 'bulletproof-security') ?>" />
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>

</div>
        
<div id="bps-tabs-6" class="bps-tab-page">
<h2><?php _e('htaccess File Editor ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Edit BPS Master htaccess Files & Currently Active htaccess Files', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell">    
    
<h3 style="margin:0px 0px 5px 5px;"><?php _e('htaccess File Editing', 'bulletproof-security'); ?>  <button id="bps-open-modal16" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content16" title="<?php _e('htaccess File Editing', 'bulletproof-security'); ?>">  
	<p><?php echo $bps_modal_content16; ?></p>
</div>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0">
  <tr>
    <td colspan="2">
    
    <div id="bps_file_editor" class="bps_file_editor_update">

<?php
echo bps_secure_htaccess_file_check();
echo bps_default_htaccess_file_check();
echo bps_wpadmin_htaccess_file_check();

// Perform File Open and Write test first by appending a literal blank space
// or nothing at all to end of the htaccess files.
// If append write test is successful file is writable on submit
if ( current_user_can('manage_options') ) {
$secure_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';
$write_test = "";
	
	if ( is_writable($secure_htaccess_file) ) {
    if ( ! $handle = fopen($secure_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! The secure.htaccess Master file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($secure_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$secure_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit1'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_1' );
	$newcontent1 = stripslashes($_POST['newcontent1']);
	
	if ( is_writable($secure_htaccess_file) ) {
		$handle = fopen($secure_htaccess_file, 'w+b');
		fwrite($handle, $newcontent1);
	$text = '<font color="green"><strong>'.__('Success! The secure.htaccess Master file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
    fclose($handle);
	}
	$htaccess = WP_PLUGIN_DIR .'/bulletproof-security/admin/htaccess/secure.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';
	@copy($htaccess, $htaccessAR);
}

if ( current_user_can('manage_options') ) {
$default_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/default.htaccess';
$write_test = "";
	
	if ( is_writable($default_htaccess_file) ) {
    if ( !$handle = fopen($default_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! The default.htaccess Master file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($default_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$default_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit2'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_2' );
	$newcontent2 = stripslashes($_POST['newcontent2']);
	
	if ( is_writable($default_htaccess_file) ) {
		$handle = fopen($default_htaccess_file, 'w+b');
		fwrite($handle, $newcontent2);
	$text = '<font color="green"><strong>'.__('Success! The default.htaccess Master file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
    fclose($handle);
	}
	$htaccess = WP_PLUGIN_DIR .'/bulletproof-security/admin/htaccess/default.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/default.htaccess';
	@copy($htaccess, $htaccessAR);
}

if ( current_user_can('manage_options') ) {
$wpadmin_htaccess_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
$write_test = "";

	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<strong>'.__('wpadmin-secure.htaccess file writing is disabled.', 'bulletproof-security').'</strong><br>';
		echo $text;
	
	} else {

	if ( is_writable($wpadmin_htaccess_file) ) {
    if ( !$handle = fopen($wpadmin_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! The wpadmin-secure.htaccess Master file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$wpadmin_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	}

	if ( isset( $_POST['submit4'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_4' );
	$newcontent4 = stripslashes($_POST['newcontent4']);
	
	if ( is_writable($wpadmin_htaccess_file) ) {
		$handle = fopen($wpadmin_htaccess_file, 'w+b');
		fwrite($handle, $newcontent4);
	$text = '<font color="green"><strong>'.__('Success! The wpadmin-secure.htaccess Master file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
	$htaccess = WP_PLUGIN_DIR .'/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	@copy($htaccess, $htaccessAR);
}

// Do not need special handling/renaming of this file in /bps-backup - it already blocks all important plugins files
if ( current_user_can('manage_options') ) {
$plugins_htaccess_file = WP_PLUGIN_DIR . '/.htaccess';
$write_test = "";
	
	if ( is_writable($plugins_htaccess_file) ) {
    if ( !$handle = fopen($plugins_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your currently active Plugins htaccess file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($plugins_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$plugins_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit-plugins-bps'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_plugins' );
	$newcontent5 = stripslashes($_POST['newcontent5']);
	
	if ( is_writable($plugins_htaccess_file) ) {
		$handle = fopen($plugins_htaccess_file, 'w+b');
		fwrite($handle, $newcontent5);
	$text = '<font color="green"><strong>'.__('Success! Your currently active Plugins htaccess file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
	$htaccess = WP_PLUGIN_DIR .'/.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
	@copy($htaccess, $htaccessAR);
}

// Do not to send a copy of the file to /bps-backup - the /uploads folder is ignored by default
if ( current_user_can('manage_options') ) {
$bps_Uploads_Dir = wp_upload_dir();
$uploads_htaccess_file = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder
$write_test = "";
	
	if ( is_writable($uploads_htaccess_file) ) {
    if ( !$handle = fopen($uploads_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your currently active Uploads htaccess file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($uploads_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$uploads_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit-uploads-bps'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_uploads' );
	$newcontent6 = stripslashes($_POST['newcontent6']);
	
	if ( is_writable($uploads_htaccess_file) ) {
		$handle = fopen($uploads_htaccess_file, 'w+b');
		fwrite($handle, $newcontent6);
	$text = '<font color="green"><strong>'.__('Success! Your currently active Uploads htaccess file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
}

// Do not to send a copy of the file to /bps-backup - the /blogs.dir folder is ignored by default
if ( is_multisite() && is_super_admin() ) {	
if ( current_user_can('manage_options') ) {
$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess'; // for MU Only - is the /blogs.dir folder
$write_test = "";
	
	if ( is_writable($UploadsHtaccessBlogsDir) ) {
    if ( !$handle = fopen($UploadsHtaccessBlogsDir, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your currently active blogs.dir htaccess file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($UploadsHtaccessBlogsDir) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$UploadsHtaccessBlogsDir . '</strong></font><br>';
		echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit-blogsdir-bps'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_blogsdir' );
	$newcontentBdir = stripslashes($_POST['newcontentBdir']);
	
	if ( is_writable($UploadsHtaccessBlogsDir) ) {
		$handle = fopen($UploadsHtaccessBlogsDir, 'w+b');
		fwrite($handle, $newcontentBdir);
	$text = '<font color="green"><strong>'.__('Success! Your currently active blogs.dir htaccess file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
	}
}

if ( current_user_can('manage_options') ) {
$root_htaccess_file = ABSPATH . '.htaccess';
$write_test = "";
	
	if ( is_writable($root_htaccess_file) ) {
    if ( !$handle = fopen($root_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your currently active root htaccess file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;

	} else {
	
	if ( file_exists($root_htaccess_file) ) {
		$text = '<font color="green"><strong>'.__('Your root htaccess file is Locked with Read Only Permissions.', 'bulletproof-security').'<br>'.__('Use the Lock and Unlock buttons below to Lock or Unlock your root htaccess file for editing.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	
	} else {
	
	$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$root_htaccess_file . '</strong></font><br>';
	echo $text;
	}
	}
	}
	
	if ( isset( $_POST['submit7'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_7' );
	$newcontent7 = stripslashes($_POST['newcontent7']);
	
	if ( !is_writable($root_htaccess_file) ) {
	$text = '<font color="red"><strong>'.__('Error: Unable to write to the Root htaccess file. If your Root htaccess file is locked you must unlock first.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	}	
	
	if ( is_writable($root_htaccess_file) ) {
		$handle = fopen($root_htaccess_file, 'w+b');
		fwrite($handle, $newcontent7);
	$text = '<font color="green"><strong>'.__('Success! Your currently active root htaccess file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
    fclose($handle);
	}
	$htaccess = ABSPATH.'.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	@copy($htaccess, $htaccessAR);
}

if ( current_user_can('manage_options') ) {
$current_wpadmin_htaccess_file = ABSPATH . 'wp-admin/.htaccess';
$write_test = "";

	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<font color="green"><strong>'.__('wp-admin active htaccess file writing is disabled.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	
	} else {

	if ( is_writable($current_wpadmin_htaccess_file) ) {
    if ( !$handle = fopen($current_wpadmin_htaccess_file, 'a+b') ) {
	    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	    exit;
    }
		$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your currently active wp-admin htaccess file is writable.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
	
	if ( file_exists($current_wpadmin_htaccess_file) ) {
		$text = '<font color="red"><strong>'.__('Cannot write to file: ', 'bulletproof-security').$current_wpadmin_htaccess_file . '</strong></font><br>';
		echo $text;
	}
	}
	}
	}
	
	if ( isset( $_POST['submit8'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_8' );
	$newcontent8 = stripslashes($_POST['newcontent8']);
	
	if ( is_writable($current_wpadmin_htaccess_file) ) {
		$handle = fopen($current_wpadmin_htaccess_file, 'w+b');
		fwrite($handle, $newcontent8);
	$text = '<font color="green"><strong>'.__('Success! Your currently active wp-admin htaccess file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
    fclose($handle);
	}
	$htaccess = ABSPATH.'wp-admin/.htaccess';
	$htaccessAR = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	@copy($htaccess, $htaccessAR);
}

// Lock and Unlock Root .htaccess file 
if ( isset( $_POST['submit-ProFlockLock'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_flock_lock' );

	$bpsRootHtaccessOL = ABSPATH . '.htaccess';
	
	if ( file_exists($bpsRootHtaccessOL) ) {
		@chmod($bpsRootHtaccessOL, 0404);
		$text = '<font color="green"><strong><br>'.__('Your Root htaccess file has been Locked.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="red"><strong><br>'.__('Unable to Lock your Root htaccess file.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}
	
if ( isset( $_POST['submit-ProFlockUnLock'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_flock_unlock' );
	
	$bpsRootHtaccessOL = ABSPATH . '.htaccess';
		
	if ( file_exists($bpsRootHtaccessOL) ) {
		@chmod($bpsRootHtaccessOL, 0644);
		$text = '<font color="green"><strong><br>'.__('Your Root htaccess file has been Unlocked.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	} else {
		$text = '<font color="red"><strong><br>'.__('Unable to Unlock your Root htaccess file.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
}

?>
</div>

</td>
    <td width="33%" align="center" valign="top"></td>
  </tr>
  <tr>
    <td width="22%">

<?php // Detect the SAPI - display form submit button only if sapi is cgi
	$sapi_type = php_sapi_name();
	if ( @substr($sapi_type, 0, 6) != 'apache') {	
?>    
 
 	<div style="margin:5px;">  
<form name="bpsFlockLockForm" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_flock_lock'); ?>
	<input type="submit" name="submit-ProFlockLock" value="<?php _e('Lock htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Click OK to Lock your Root htaccess file or click Cancel.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Note: The File Open and Write Test window will still display the last status of the file as Unlocked. To see the current status refresh your browser.', 'bulletproof-security'); echo $text; ?>')" />
</form>
<br />

<form name="bpsRootAutoLock-On" action="options.php#bps-tabs-6" method="post">
    <?php settings_fields('bulletproof_security_options_autolock'); ?>
	<?php $options = get_option('bulletproof_security_options_autolock'); ?>
<input type="hidden" name="bulletproof_security_options_autolock[bps_root_htaccess_autolock]" value="On" />
<input type="submit" name="submit-RootHtaccessAutoLock-On" value="<?php _e('Turn On AutoLock', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Turning AutoLock On will allow BPS Pro to automatically lock your Root .htaccess file. For some folks this causes a problem because their Web Hosts do not allow the Root .htaccess file to be locked. For most folks allowing BPS Pro to AutoLock the Root .htaccess file works fine.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Turn AutoLock On or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />

<?php 
if ( $options['bps_root_htaccess_autolock'] == '' || $options['bps_root_htaccess_autolock'] == 'On' ) { echo '<div id="autolock_status">'.__('On', 'bulletproof-security').'</div>'; } ?>
</form>

</div>

<?php } ?>

</td>
    <td width="45%">

<?php // Detect the SAPI - display form submit button only if sapi is cgi
	$sapi_type = php_sapi_name();
	
	if ( @substr($sapi_type, 0, 6) != 'apache' ) { ?>        

	<div style="margin:5px;">    
<form name="bpsFlockUnLockForm" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_flock_unlock'); ?>

	<input type="submit" name="submit-ProFlockUnLock" value="<?php _e('Unlock htaccess File', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Click OK to Unlock your Root htaccess file or click Cancel.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Note: The File Open and Write Test window will still display the last status of the file as Locked. To see the current status refresh your browser.', 'bulletproof-security'); echo $text; ?>')" />
</form>
<br />

<form name="bpsRootAutoLock-Off" action="options.php#bps-tabs-6" method="post">
    <?php settings_fields('bulletproof_security_options_autolock'); ?>
	<?php $options = get_option('bulletproof_security_options_autolock'); ?>
	<input type="hidden" name="bulletproof_security_options_autolock[bps_root_htaccess_autolock]" value="Off" />
	<input type="submit" name="submit-RootHtaccessAutoLock-Off" value="<?php _e('Turn Off AutoLock', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Turning AutoLock Off will prevent BPS Pro from automatically locking your Root .htaccess file. For some folks this is necessary because their Web Hosts do not allow the Root .htaccess file to be locked. For most folks allowing BPS Pro to AutoLock the Root .htaccess file works fine.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Turn AutoLock Off or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />

<?php if ( $options['bps_root_htaccess_autolock'] == 'Off') { echo '<div id="autolock_status">'.__('Off', 'bulletproof-security').'</div>'; } ?>
</form>
</div>

<?php } ?>

</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    
    <!-- jQuery UI File Editor Tab Menu -->
<div id="bps-edittabs" class="bps-edittabs-class">
		<ul>
			<li><a href="#bps-edittabs-1"><?php _e('secure.htaccess', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-edittabs-2"><?php _e('default.htaccess', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-edittabs-4"><?php _e('wpadmin-secure.htaccess', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-edittabs-5"><?php _e('Your Current Plugins htaccess File', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-edittabs-6"><?php _e('Your Current Uploads htaccess File', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-edittabs-7"><?php _e('Your Current Root htaccess File', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-edittabs-8"><?php _e('Your Current wp-admin htaccess File', 'bulletproof-security'); ?></a></li>
			<?php if ( is_multisite() && is_super_admin() ) { ?>
            <li><a href="#bps-edittabs-9"><?php _e('Your Current blogs.dir htaccess File', 'bulletproof-security'); ?></a></li>
			<?php } ?>
        </ul>
       
<?php 
$scrollto1 = isset($_REQUEST['scrollto1']) ? (int) $_REQUEST['scrollto1'] : 0; 
$scrollto2 = isset($_REQUEST['scrollto2']) ? (int) $_REQUEST['scrollto2'] : 0;
$scrollto4 = isset($_REQUEST['scrollto4']) ? (int) $_REQUEST['scrollto4'] : 0;
$scrollto5 = isset($_REQUEST['scrollto5']) ? (int) $_REQUEST['scrollto5'] : 0;
$scrollto6 = isset($_REQUEST['scrollto6']) ? (int) $_REQUEST['scrollto6'] : 0;
$scrollto7 = isset($_REQUEST['scrollto7']) ? (int) $_REQUEST['scrollto7'] : 0;
$scrollto8 = isset($_REQUEST['scrollto8']) ? (int) $_REQUEST['scrollto8'] : 0;
$scrollto9 = isset($_REQUEST['scrollto9']) ? (int) $_REQUEST['scrollto9'] : 0;
?>

<div id="bps-edittabs-1" class="bps-edittabs-page-class">
<form name="template1" id="template1" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_1'); ?>
    <div>
    <textarea class="bps-text-area-600x700" name="newcontent1" id="newcontent1" tabindex="1"><?php echo bps_get_secure_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($secure_htaccess_file) ?>" />
	<input type="hidden" name="scrollto1" id="scrollto1" value="<?php echo $scrollto1; ?>" />
    <p class="submit">
	<input type="submit" name="submit1" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template1').submit(function(){ $('#scrollto1').val( $('#newcontent1').scrollTop() ); });
	$('#newcontent1').scrollTop( $('#scrollto1').val() ); 
});
/* ]]> */
</script>     
</div>

<div id="bps-edittabs-2" class="bps-edittabs-page-class">
<form name="template2" id="template2" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_2'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent2" id="newcontent2" tabindex="2"><?php echo bps_get_default_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($default_htaccess_file) ?>" />
	<input type="hidden" name="scrollto2" id="scrollto2" value="<?php echo $scrollto2; ?>" />
    <p class="submit">
	<input type="submit" name="submit2" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template2').submit(function(){ $('#scrollto2').val( $('#newcontent2').scrollTop() ); });
	$('#newcontent2').scrollTop( $('#scrollto2').val() );
});
/* ]]> */
</script>     
</div>

<div id="bps-edittabs-4" class="bps-edittabs-page-class">
<form name="template4" id="template4" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_4'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent4" id="newcontent4" tabindex="4"><?php echo bps_get_wpadmin_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($wpadmin_htaccess_file) ?>" />
	<input type="hidden" name="scrollto4" id="scrollto4" value="<?php echo $scrollto4; ?>" />
    <p class="submit">
	<input type="submit" name="submit4" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template4').submit(function(){ $('#scrollto4').val( $('#newcontent4').scrollTop() ); });
	$('#newcontent4').scrollTop( $('#scrollto4').val() );
});
/* ]]> */
</script>     
</div>

<div id="bps-edittabs-5" class="bps-edittabs-page-class">
<form name="template-plugins-bps" id="template-plugins-bps" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_plugins'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent5" id="newcontent5" tabindex="5"><?php echo bps_get_plugins_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($plugins_htaccess_file) ?>" />
	<input type="hidden" name="scrollto5" id="scrollto5" value="<?php echo $scrollto5; ?>" />
    <p class="submit">
	<input type="submit" name="submit-plugins-bps" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template-plugins-bps').submit(function(){ $('#scrollto5').val( $('#newcontent5').scrollTop() ); });
	$('#newcontent5').scrollTop( $('#scrollto5').val() );
});
/* ]]> */
</script>     
</div>

<div id="bps-edittabs-6" class="bps-edittabs-page-class">
<form name="template-uploads-bps" id="template-uploads-bps" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_uploads'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent6" id="newcontent6" tabindex="6"><?php echo bps_get_uploads_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($uploads_htaccess_file) ?>" />
	<input type="hidden" name="scrollto6" id="scrollto6" value="<?php echo $scrollto6; ?>" />
    <p class="submit">
	<input type="submit" name="submit-uploads-bps" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template-uploads-bps').submit(function(){ $('#scrollto6').val( $('#newcontent6').scrollTop() ); });
	$('#newcontent6').scrollTop( $('#scrollto6').val() );
});
/* ]]> */
</script>     
</div>

<?php
// File Editor Root .htaccess file Lock check with pop up Confirm message
function bpsStatusRHE() {
clearstatcache();
$filename = ABSPATH . '.htaccess';
$perms = @substr(sprintf('%o', fileperms($filename)), -4);
$sapi_type = php_sapi_name();
	
	if ( file_exists($filename) && @substr($sapi_type, 0, 6) != 'apache') {	
	return $perms;
	}
}
?>

<div id="bps-edittabs-7" class="bps-edittabs-page-class">
<form name="template7" id="template7" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_7'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent7" id="newcontent7" tabindex="7"><?php echo bps_get_root_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($root_htaccess_file) ?>" />
	<input type="hidden" name="scrollto7" id="scrollto7" value="<?php echo $scrollto7; ?>" />
    <p class="submit">
<?php if ( @bpsStatusRHE($perms) == '0404' ) { ?>
	<input type="submit" name="submit7" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('YOUR ROOT HTACCESS FILE IS LOCKED.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('YOUR FILE EDITS / CHANGES CANNOT BE SAVED.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click Cancel, copy the file editing changes you made to save them and then click the Unlock htaccess File button to unlock your Root htaccess file. After your Root htaccess file is unlocked paste your file editing changes back into your Root htaccess file and click this Update File button again to save your file edits/changes.', 'bulletproof-security'); echo $text; ?>')" />
	<?php } else { ?>
	<input type="submit" name="submit7" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
<?php } ?>
</div>
</form>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template7').submit(function(){ $('#scrollto7').val( $('#newcontent7').scrollTop() ); });
	$('#newcontent7').scrollTop( $('#scrollto7').val() );
});
/* ]]> */
</script>     
</div>

<div id="bps-edittabs-8" class="bps-edittabs-page-class">
<form name="template8" id="template8" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_8'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontent8" id="newcontent8" tabindex="8"><?php echo bps_get_current_wpadmin_htaccess_file(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($current_wpadmin_htaccess_file) ?>" />
	<input type="hidden" name="scrollto8" id="scrollto8" value="<?php echo $scrollto8; ?>" />
    <p class="submit">
	<input type="submit" name="submit8" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template8').submit(function(){ $('#scrollto8').val( $('#newcontent8').scrollTop() ); });
	$('#newcontent8').scrollTop( $('#scrollto8').val() );
});
/* ]]> */
</script>     
</div>

<?php if ( is_multisite() && is_super_admin() ) { ?>

<div id="bps-edittabs-9" class="bps-edittabs-page-class">
<form name="template-blogsdir-bps" id="template-blogsdir-bps" action="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_save_settings_blogsdir'); ?>
	<div>
    <textarea class="bps-text-area-600x700" name="newcontentBdir" id="newcontentBdir" tabindex="6"><?php echo bps_get_blogsdir_htaccess(); ?></textarea>
	<input type="hidden" name="action" value="update" />
    <input type="hidden" name="filename" value="<?php echo esc_attr($UploadsHtaccessBlogsDir) ?>" />
	<input type="hidden" name="scrollto9" id="scrollto9" value="<?php echo $scrollto9; ?>" />
    <p class="submit">
	<input type="submit" name="submit-blogsdir-bps" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template-blogsdir-bps').submit(function(){ $('#scrollto9').val( $('#newcontentBdir').scrollTop() ); });
	$('#newcontentBdir').scrollTop( $('#scrollto9').val() );
});
/* ]]> */
</script>     
</div>

<?php } // if is multisite ?>
</div>
</td>
  </tr>
</table>
<?php } // if current user can ?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
</div>

<div id="bps-tabs-7" class="bps-tab-page">
<h2><?php _e('htaccess File Custom Code ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Save Custom htaccess Code for your Root and wp-admin htaccess Files', 'bulletproof-security'); ?> <br /> <span class="cc-read-me-text"><?php _e('* Click the Read Me help button for Custom Code Setup Steps', 'bulletproof-security'); ?></span></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Add Custom htaccess Code For Your Root and wp-admin htaccess Files', 'bulletproof-security'); ?>  <button id="bps-open-modal18" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content18" title="<?php _e('Custom Code', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content18; ?></p>
</div>

<h3><?php $text = '<strong><a href="http://forum.ait-pro.com/video-tutorials/" target="_blank" title="Link opens in a new Browser window">'.__('Custom Code Video Tutorial', 'bulletproof-security').'</a></strong>'; echo $text; ?></h3>
<h3><?php $text = '<strong><a href="http://forum.ait-pro.com/read-me-first/" target="_blank" title="Link opens in a new Browser window">'.__('BulletProof Security Pro Forum', 'bulletproof-security').'</a></strong>'; echo $text; ?></h3>

<?php 
if ( !current_user_can('manage_options') ) { 
	_e('Permission Denied', 'bulletproof-security'); 
	
	} else { 

	require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/core/core-custom-code.php' );
}
?>
<br />

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-8" class="bps-tab-page">
<h2><?php _e('My Notes ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Save Personal Notes and htaccess Code Notes to your WordPress Database', 'bulletproof-security'); ?></span></h2>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
	<?php $scrolltoNotes = isset( $_REQUEST['scrolltoNotes'] ) ? (int) $_REQUEST['scrolltoNotes'] : 0; ?>

<form name="myNotes" action="options.php#bps-tabs-8" method="post">
	<?php settings_fields('bulletproof_security_options_mynotes'); ?>
	<?php $options = get_option('bulletproof_security_options_mynotes'); ?>
<div>
    <textarea class="bps-text-area-600x700" name="bulletproof_security_options_mynotes[bps_my_notes]" tabindex="1"><?php echo $options['bps_my_notes']; ?></textarea>
    <input type="hidden" name="scrolltoNotes" value="<?php echo $scrolltoNotes; ?>" />
    <p class="submit">
	<input type="submit" name="myNotes_submit" class="button bps-button" value="<?php esc_attr_e('Save My Notes', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#myNotes').submit(function(){ $('#scrolltoNotes').val( $('#bulletproof_security_options_mynotes[bps_my_notes]').scrollTop() ); });
	$('#bulletproof_security_options_mynotes[bps_my_notes]').scrollTop( $('#scrolltoNotes').val() ); 
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

<div id="bps-tabs-9" class="bps-tab-page">
<h2><?php _e('Help & FAQ', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links">
    <a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php" target="_blank"><?php _e('Whats New in ', 'bulletproof-security'); echo BULLETPROOF_VERSION; ?></a></td>
    <td class="bps-table_cell_help_links">
    <a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links">
    <a href="http://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links">
    <a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Custom Code Video Tutorial', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links">
    <a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links">
    <a href="http://www.ait-pro.com/aitpro-blog/2304/wordpress-tips-tricks-fixes/permalinks-wordpress-custom-permalinks-wordpress-best-wordpress-permalinks-structure/" target="_blank"><?php _e('WP Permalinks - Custom Permalink Structure Help Info', 'bulletproof-security'); ?></a></td>
  </tr>
 <tr>
    <td class="bps-table_cell_help_links">
    <a href="http://forum.ait-pro.com/forums/topic/plugin-firewall-read-me-first-troubleshooting/" target="_blank"><?php _e('Plugin Firewall Guide & Troubleshooting', 'bulletproof-security'); ?></a></td>
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