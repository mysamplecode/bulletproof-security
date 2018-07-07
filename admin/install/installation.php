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
// Manually runs Email Logs cron function - for testing ONLY
// echo bps_Log_File_Processing();

// Top div echo & bottom div echo
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

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
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Upload Zip Install', 'bulletproof-security'); ?></h2>

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
function ZipUpload() {
	
    var r = confirm("Clicking OK will upload the bulletproof-security.zip file. After the zip file upload has completed click the Install Zip Now button.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
			<li><a href="#bps-tabs-1"><?php _e('Upload Zip Install', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">

<h2><?php _e('Upload Zip Installer', 'bulletproof-security'); ?></h2>

<?php
// bulletproof-security.zip file upload - will only accept filename = bulletproof-security.zip
if ( isset( $_POST['submit-bps-zip-install'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_zip_installer' );
	
	$time_start = microtime( true );

	$bpsZipFilename = 'bulletproof-security.zip';
	$bps_tmp_file = $_FILES['bps_file_zip']['tmp_name'];
	$zip_folder_path = WP_PLUGIN_DIR.'/';
	$bps_uploaded_zip = str_replace('//','/', $zip_folder_path) . $_FILES['bps_file_zip']['name'];
	$bpsZipzUploadFail = $_FILES['bps_file_zip']['name'];
		
	if ( ! empty($_FILES) ) {
	if ( $_FILES['bps_file_zip']['name'] == $bpsZipFilename ) {
		move_uploaded_file($bps_tmp_file, $bps_uploaded_zip);
		
		$text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><font color="green"><strong>'.__('Zip File Upload Successful. ', 'bulletproof-security').'</strong></font><br>'.__('Click the Install Zip Now button to install BulletProof Security Pro.', 'bulletproof-security').'<br></p></div>';
		echo $text;
		
		} else {
		
		$text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><font color="red"><strong>'.__('Zip File Upload Error. ', 'bulletproof-security').'</strong></font><font color="black"><strong>'.__('Either a bulletproof-security.zip file has not been selected yet for upload or the file ', 'bulletproof-security').$bpsZipzUploadFail.__(' is not a valid bulletproof-security.zip file. The zip uploader only allows the bulletproof-security.zip file to be uploaded.', 'bulletproof-security').'</strong></font><br></p></div>';
	echo $text;
	}
	}

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}

// Extracts zip files from uploaded zip and then deletes the uploaded zip file
if ( isset( $_POST['submit-bps-zip-install2'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_zip_installer2' );

		$ARQoptions = get_option('bulletproof_security_options_ARCM');
		
		$BPS_Options = array(
		'bps_autorestore_cron_frequency' 	=> $ARQoptions['bps_autorestore_cron_frequency'], 
		'bps_autorestore_cron' 				=> 'Off', 
		'bps_autorestore_cron_override' 	=> $ARQoptions['bps_autorestore_cron_override'], 
		'bps_autorestore_cron_filecheck' 	=> $ARQoptions['bps_autorestore_cron_filecheck'], 
		'bps_autorestore_cron_forced' 		=> $ARQoptions['bps_autorestore_cron_forced'], 
		'bps_autorestore_cron_end' 			=> $ARQoptions['bps_autorestore_cron_end']
		);	

			foreach( $BPS_Options as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options);
			}

	$bpsZip = new ZipArchive;
	
	if ( $bpsZip->open( WP_PLUGIN_DIR . '/bulletproof-security.zip') === TRUE ) {
    	$bpsZip->extractTo( WP_PLUGIN_DIR . '/bulletproof-security/' );
    	$bpsZip->close();
    	
		$text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><font color="green"><strong>'.__('BPS Pro Zip Installation Successful.', 'bulletproof-security').'</strong></font><br>'.__('The uploaded bulletproof-security.zip file has been deleted automatically. To reinstall BPS Pro again please upload another bulletproof-security.zip file and click the Install Zip Now button.', 'bulletproof-security').'<br><br><strong>'.__('AutoRestore is turned Off during upload zip installations.', 'bulletproof-security').'</strong><br><strong><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Click Here', 'bulletproof-security').'</a></strong>'.__(' to go to the AutoRestore page and turn the ARQ Cron back On. If you need to backup files first then click the Backup Files buttons before turning the ARQ Cron back On.', 'bulletproof-security').'</p></div>';
		echo $text;
	
	unlink(WP_PLUGIN_DIR . '/bulletproof-security.zip');
	
	echo bpsPro_update_checks();
	
	} else {
	
	unlink(WP_PLUGIN_DIR . '/bulletproof-security.zip');    
		
		$text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><font color="red"><strong>'.__('BPS Pro Zip Installation Failed.', 'bulletproof-security').'</strong></font><br><font color="black"><strong>'.__('An uploaded bulletproof-security.zip file was not found. Please upload a bulletproof-security.zip file and click the Install Zip Now button. If the zip installation fails after uploading the bulletproof-security.zip file please send an email to info@ait-pro.com so that we can assist you to correct the issue or problem.', 'bulletproof-security').'</strong></font><br></p></div>';
		echo $text;
	}
}

if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Upload Zip & Install Zip', 'bulletproof-security'); ?> <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Upload Zip Install', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Upload Zip', 'bulletproof-security').'</strong><br>'.__('Click on the Choose File or Browse button. Navigate/browse/go to the folder on your computer where the bulletproof-security.zip file is located and select it and then click the Open button. You should now see the bulletproof-security.zip file name displayed in the File Upload window. Click the Upload Zip File button and you should see this message', 'bulletproof-security').' - <strong>'.__('Zip File Upload Successful. Click the Install Now button to install BulletProof Security Pro', 'bulletproof-security').'</strong> - '.__('when the Zip file upload is completed.', 'bulletproof-security').'<br><br><strong>'.__('Install Zip', 'bulletproof-security').'</strong><br>'.__('Click the Install Zip Now button. The zip installer is designed to overwrite all the existing BPS Pro plugin files. Your currently active htaccess files will be automatically updated and php.ini files are not affected in any way. Your website security status is not affected or changed when performing an upload zip installation. All options settings are saved to your WordPress database and are not affected and changed when performing upload zip installations.', 'bulletproof-security'); echo $text; ?></p>
</div>

<form name="BPS-Zip-Uploader" action="admin.php?page=bulletproof-security/admin/install/installation.php" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('bulletproof_security_zip_installer'); ?>
<p class="submit">
<input type="file" name="bps_file_zip" id="bps_file_zip"  />
<input type="submit" name="submit-bps-zip-install" value="<?php esc_attr_e('Upload Zip File', 'bulletproof-security'); ?>" class="button bps-button" onclick="ZipUpload()" />
</p>
</form>

<form name="BPS-Zip-Installer" action="admin.php?page=bulletproof-security/admin/install/installation.php" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('bulletproof_security_zip_installer2'); ?>
<p class="submit">
<input type="submit" name="submit-bps-zip-install2" value="<?php _e('Install Zip Now', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text= __('Clicking OK will ONLY install BPS Pro plugin files. Your htaccess files will be automatically updated. Your custom php.ini file will NOT be overwritten or changed in any way.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to install BPS Pro now or click Cancel to cancel the installation.', 'bulletproof-security'); echo $text; ?>')" />
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

<div id="bps-tabs-2" class="bps-tab-page">
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
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-bps-pro-upgrade-installation-methods/" target="_blank"><?php _e(' Upgrade Installation Methods', 'bulletproof-security'); ?></a></td>
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
<style>
<!--
.bps-spinner {visibility:hidden;}
-->
</style>
</div>