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

// General all purpose "Settings Saved." message for forms - /includes/class.php
if ( current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
if ( @$_GET['settings-updated'] == true ) {
	$text = '<p style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:5px;margin:0px;"><font color="green"><strong>'.__('Settings Saved', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	} else {
	echo '<font color="red"><strong>'.bps_cuser_errors().'</strong></font>';
	}
}

// Jetpack Quarantine check
function bps_jetpack_check() {
$filename = WP_CONTENT_DIR . '/bps-backup/quarantine/jetpack.php';
$plugin_var = 'jetpack/jetpack.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

    if ( $return_var == 1 ) { // 1 equals active

	if ( !file_exists($filename) ) {
		return;
	}
	
	if ( file_exists($filename) ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('WARNING!!! Jetpack plugin files have been detected in Quarantine. DO NOT restore Jetpack plugin files from Quarantine. Restoring Jetpack plugin files from Quarantine will crash your website. Delete the Jetpack plugin files from Quarantine and reinstall the Jetpack plugin.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}
	}
}
echo bps_jetpack_check();

$bpsSpacePop = '-------------------------------------------------------------';
// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR);
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Quarantine', 'bulletproof-security'); ?></h2>

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
function QSortSearch() {

    var r = confirm("View File Option: Selecting the View File Checkbox Form option will display the contents of the quarantined file that you have selected to view.\n\n-------------------------------------------------------------\n\nRestore File Option: Selecting the Restore File Checkbox Form option does 3 things: 1. Copies the quarantined file to the autorestore backup folder and overwrites the backed up copy of the file. 2. Moves the file out of quarantine to the original source path where the file was quarantined from and overwrites the file that was autorestored. 3. Deletes the database entry for the quarantined file.\n\n-------------------------------------------------------------\n\nDelete File Option: Selecting the Delete File Checkbox Form option does 2 things: 1. Deletes the file permanently from the Quarantine folder. 2. Deletes the database entry for the quarantined file.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function QStandard() {
	
    var r = confirm("View File Option: Selecting the View File Checkbox Form option will display the contents of the quarantined file that you have selected to view.\n\n-------------------------------------------------------------\n\nRestore File Option: Selecting the Restore File Checkbox Form option does 3 things: 1. Copies the quarantined file to the autorestore backup folder and overwrites the backed up copy of the file. 2. Moves the file out of quarantine to the original source path where the file was quarantined from and overwrites the file that was autorestored. 3. Deletes the database entry for the quarantined file.\n\n-------------------------------------------------------------\n\nDelete File Option: Selecting the Delete File Checkbox Form option does 2 things: 1. Deletes the file permanently from the Quarantine folder. 2. Deletes the database entry for the quarantined file.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
			<li><a href="#bps-tabs-1"><?php _e('Quarantine', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-2"><?php _e('Quarantine Log', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-3"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('Quarantine', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Quarantine', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Quarantine', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Quarantine General Concept', 'bulletproof-security').'</strong><br>'.__('The Quarantine folder is located in an isolated .htaccess protected directory that cannot be accessed by anyone other than you. When a file has been autorestored by the ARQ Cron, a copy of that modified file that was autorestored is sent to Quarantine before it was autorestored. This allows you to restore the modified file that is in quarantine and overwrite the autorestored file. Or in other words restoring a file from Quarantine is an Undo.', 'bulletproof-security').'<br><br><font color="red"><strong>'.__('A file has been sent to Quarantine: ', 'bulletproof-security').'</strong></font><br>'.__('If you received a BPS Pro Quarantine email Alert and have confirmed that a hacker\'s file was quarantined then you need to change all of your passwords as quickly as possible. See the help section below: Steps To Take When a Hacker\'s File Has Been Quarantined. If you do not know whether or not a file in Quarantine is a hacker file or not then select the Quarantine View File Checkbox Form option for that file and click the Submit button. Copy the contents of the file you are viewing into an email and send it to info@ait-pro.com with "Quarantine Help - is this hacker code?" in the Subject line of the email.', 'bulletproof-security').'<br><br><font color="blue"><strong>'.__('Important Note: ', 'bulletproof-security').'</strong></font><br>'.__('If you use a Select All checkbox for any table column (either Restore File or Delete File) then all files in Quarantine will use that Select All checkbox setting.  If you want to restore and delete files at the same time DO NOT use the Select All checkbox for either of the table columns and instead check individual checkboxes. Example scenario: you have 1 file in Quarantine that you want to restore and you want to delete all the other files in Quarantine. The best way to do this would be to restore the file you want to restore first and then after that file is restored you can click the Select All checkbox for the Delete Files table column. You can of course restore and delete files at the same time as long as a Select All checkbox is not checked for either table column.', 'bulletproof-security').'<br><br><font color="blue"><strong>'.__('Steps To Take When a Hacker\'s File Has Been Quarantined: ', 'bulletproof-security').'</strong></font><br>'.__('Change your WordPress password first, next change your FTP password, next change your WordPress Database password. To change your WordPress database password you will need to change the DB password in 2 places: your web host control panel using phpMyAdmin and also in your wp-config.php file. For good measure it is also recommended that you change your web host control panel login password.', 'bulletproof-security').'<br><br><strong>'.__('NOTES: ', 'bulletproof-security').'</strong>'.__('If a new file is uploaded to your website and a copy of that uploaded file does not exist in backup then that file is sent to Quarantine. If there are no files in Quarantine the Quarantine Checkbox Form will display an empty table with this displayed message - No Files in Quarantine. If there are files in Quarantine the Quarantine Checkbox Form will display the file name, the time the file was quarantined, the source path where the file was quarantined from and Checkbox Form options: 1. View File, 2. Restore File or 3. Delete File. The Restore File option allows you to quickly and easily restore a file if it needs to be restored. Restore File and Delete File have Select All Checkboxes located above the Restore File and Delete File Column text.', 'bulletproof-security').'<br><br><strong>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('The Quarantine Log logs the specific details about the action that was taken when a file is sent to Quarantine. View the Quarantine Log Read Me button for specific details about the Quarantine Log.', 'bulletproof-security').'<br><br><strong>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('It is recommended that you first use the View File Checkbox Form option before choosing to restore or delete a file in Quarantine.', 'bulletproof-security').'<br><br><strong>'.__('Sort|Search: ', 'bulletproof-security').'<br>'.__('See this Forum Topic for examples of how to use the Sort|Search feature: ', 'bulletproof-security').'http://forum.ait-pro.com/forums/topic/autorestore-quarantine-guide-read-me-first/#quarantine-sort</strong><br>'.__('The Quarantine Sort|Search feature allows you to sort files by plugin folder name or theme folder name or other folder name and either restore or delete all of these files. If the total number of files in Quarantine exceeds 200, an error message will be displayed with a link to forum help information. The reason this new Sort|Search feature is necessary is that when trying to restore or delete an extremely large number of files from Quarantine all at the same time (all plugin files/all theme files/WordPress Core files) the restore or delete may or may not complete successfully. What will ALWAYS complete successfully every time is using the Sort|Search feature to restore or delete files by folder name.', 'bulletproof-security').'<br><br><strong>'.__('View File Option: ', 'bulletproof-security').'</strong><br>'.__('Selecting the View File Checkbox Form option will display the contents of the quarantined file that you have selected to view.', 'bulletproof-security').'<br><br><strong>'.__('Restore File Option: ', 'bulletproof-security').'</strong><br>'.__('Selecting the Restore File Checkbox Form option does 3 things: 1. Copies the quarantined file to the autorestore backup folder and overwrites the backed up copy of the file. 2. Moves the file out of quarantine to the original source path where the file was quarantined from and overwrites the file that was autorestored. 3. Deletes the database entry for the quarantined file.', 'bulletproof-security').'<br><br><strong>'.__('NOTE: ', 'bulletproof-security').'</strong>'.__('If you create a new folder with new files or upload a new folder with files in it to your website then using the Restore File option will NOT create that new folder in your autorestore backup folder for security reasons. You can restore the file, but the file or files in that new folder will continue to be quarantined because they will be seen as illegitimate website files based on the fact that the folder name does not exist in autorestore backup. To correct this issue turn Off the ARQ Cron, add your new folder and upload your new files and then click the appropriate Backup Files button on the AutoRestore|Quarantine Settings page if this new folder and files are WordPress files. Or if this new folder and files are non-WordPress files then use Add Folders & Files form on the AutoRestore Add|Exclude Files page to add this new folder and files to backup, then turn the ARQ Cron back On.', 'bulletproof-security').'<br><br><strong>'.__('Delete File Option: ', 'bulletproof-security').'</strong><br>'.__('Selecting the Delete File Checkbox Form option does 2 things: 1. Deletes the file permanently from the Quarantine folder. 2. Deletes the database entry for the quarantined file.', 'bulletproof-security'); echo $text; ?></p>
</div>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { 

function bpsQDBRowCount() {
global $wpdb;
$bpspro_Qtable = $wpdb->prefix . "bpspro_arq_quarantine";
$id = '0';
//$DB_row_count = $wpdb->get_var( "SELECT COUNT(*) FROM $bpspro_Qtable" );
$DB_row_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $bpspro_Qtable WHERE id != %d", $id ) );

	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {

	echo '<div id="QuarantineDBRowCount" style="position:relative;left:0px;top:25px;color:#2ea2cc;font-weight:bold;font-size:14px;width:40%;">';

	if ( isset( $_POST['Submit-Quarantine-Search'] ) ) {
		
		$search_string = $_POST['QSearch'];
		$DB_row_count_search = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $bpspro_Qtable WHERE arq_quarantine_source LIKE %s", "%$search_string%" ) );
		$text = "{$DB_row_count_search}".__(' out of ', 'bulletproof-security')."{$DB_row_count}".__(' Quarantined files are currently being displayed', 'bulletproof-security');
		echo $text;
	
	} else {
	
		if ( !isset( $_POST['Submit-Quarantine-Search-Radio'] ) ) {
		
			if ( $DB_row_count > 200 ) {
				
				$text = '<font color="red">'.__('Total number of Quarantined Files: ', 'bulletproof-security')."{$DB_row_count}".'</font><br>'.__('If 200+ files have been sent to Quarantine this usually means that an error or problem occurred and all plugin or theme files have been quarantined. If this is the problem that occurred click the link below for step by step instructions on how to fix this using the Quarantine Sort|Search feature.', 'bulletproof-security').'<br><a href="http://forum.ait-pro.com/forums/topic/autorestore-quarantine-guide-read-me-first/#quarantine-sort" target="_blank" title="Link opens in a new Browser window" style="color:#2ea2cc;">'.__('Using the Quarantine Sort/Search feature to Restore Files in Quarantine', 'bulletproof-security').'</a>';
				echo $text;				

			} else {
		
				$text = __('Total number of Quarantined Files: ', 'bulletproof-security')."{$DB_row_count}";
				echo $text;	
			}
		}
	}
	echo '</div>';
	}
}
echo bpsQDBRowCount();

	// DB Quarantine Sort/Search Form - search all DB values/fields - top was 240px
	echo '<div id="QSortSearch" style="float:right; margin: 0px 110px 15px 0px;">';
	echo '<form name="QuarantineSearchForm" action="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php" method="post">';
	wp_nonce_field('bulletproof_security_quarantine_search');
	echo '<input type="text" name="QSearch" class="regular-text-short-fixed" style="margin: 0px 5px 0px 0px; "value="" />';
	echo '<input type="submit" name="Submit-Quarantine-Search" value="'.esc_attr('Sort|Search', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

// Quarantine Sort/Search Form
if ( isset( $_POST['Submit-Quarantine-Search'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_quarantine_search');
	
	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) ) {

	$bpspro_arq_quarantine_table = $wpdb->prefix . "bpspro_arq_quarantine";
	$search_string = $_POST['QSearch'];
	$getQuarantineTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source LIKE %s", "%$search_string%") );
	
	echo '<form name="bpsQuarantineDBRadioSearch" action="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php" method="post">';
	wp_nonce_field('bulletproof_security_quarantine_search');

		echo '<div id="ARQcheckall">';
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Filename', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><br><strong>'.__('View<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallRestore" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Restore<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallDelete" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Delete<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:49%;"><strong>'.__('Source Path - File was Quarantined from this location', 'bulletproof-security').'</strong><br>'.__('The file will be restored to this location if Restore File is selected').'</th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Quarantine<br>Time', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getQuarantineTable as $row ) {
    		$path_parts = pathinfo($row->arq_quarantine_qpath);
			$filename = $path_parts['basename'];
		
		if ( $filename != '' ) {
		
		echo '<th scope="row" style="border-bottom:none;">'.$filename.'</th>';
		echo "<td><input type=\"checkbox\" id=\"viewfile\" name=\"qradio[$row->arq_quarantine_qpath]\" value=\"viewfile\" /></td>";
		echo "<td><input type=\"checkbox\" id=\"restorefile\" name=\"qradio[$row->arq_quarantine_source]\" value=\"restorefile\" class=\"restorefileALL\" /></td>";
		echo "<td><input type=\"checkbox\" id=\"deletefile\" name=\"qradio[$row->arq_quarantine_qpath]\" value=\"deletefile\" class=\"deletefileALL\" /></td>";
		echo '<td>'.$row->arq_quarantine_source.'</td>';		
		echo '<td>'.$row->time.'</td>'; 
		echo '</tr>';			
		}
		} 
		
		if ( @$filename == '' ) {		
		echo '<th scope="row" style="border-bottom:none;">No Files in Quarantine</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '</tr>';		
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';	

		echo "<input type=\"submit\" name=\"Submit-Quarantine-Search-Radio\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"QSortSearch()\" />&nbsp;&nbsp;<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"javascript:history.go(0)\" /></form>";
	}
	
	} else {

	if ( !isset( $_POST['Submit-Quarantine-Search-Radio'] ) && !isset( $_POST['Submit-ARQ-Quarantine-Radio'] ) ) {
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {
	
	echo '<form name="bpsQuarantineDBRadio" action="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php" method="post">';
	wp_nonce_field('bulletproof_security_arq_quarantine');
	
	$bpspro_arq_quarantine_table = $wpdb->prefix . "bpspro_arq_quarantine";
	$forward_slash = '/'; // return all rows with a forward slash in them or in other words all rows
	$getQuarantineTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source LIKE %s", "%$forward_slash%") );
	
		echo '<div id="ARQcheckall">';
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('Filename', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><br><strong>'.__('View<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallRestore" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Restore<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:7%;"><input type="checkbox" class="checkallDelete" style="text-align:left; margin-left:2px;" /><br><strong>'.__('Delete<br>File', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:49%;"><strong>'.__('Source Path - File was Quarantined from this location', 'bulletproof-security').'</strong><br>'.__('The file will be restored to this location if Restore File is selected').'</th>';
		echo '<th scope="col" style="width:10%;"><strong>'.__('Quarantine<br>Time', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		foreach ( $getQuarantineTable as $row ) {
    		$path_parts = pathinfo($row->arq_quarantine_qpath);
			$filename = $path_parts['basename'];
		
		if ( $filename != '' ) {
		
		echo '<th scope="row" style="border-bottom:none;">'.$filename.'</th>';
		echo "<td><input type=\"checkbox\" id=\"viewfile\" name=\"qradio[$row->arq_quarantine_qpath]\" value=\"viewfile\" /></td>";
		echo "<td><input type=\"checkbox\" id=\"restorefile\" name=\"qradio[$row->arq_quarantine_source]\" value=\"restorefile\" class=\"restorefileALL\" /></td>";
		echo "<td><input type=\"checkbox\" id=\"deletefile\" name=\"qradio[$row->arq_quarantine_qpath]\" value=\"deletefile\" class=\"deletefileALL\" /></td>";
		echo '<td>'.$row->arq_quarantine_source.'</td>';		
		echo '<td>'.$row->time.'</td>'; 
		echo '</tr>';			
		}
		} 
		
		if ( @$filename == '' ) {		
		echo '<th scope="row" style="border-bottom:none;">No Files in Quarantine</th>';
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo '<td></td>';		
		echo '<td></td>'; 
		echo '</tr>';		
		}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';	

		echo "<input type=\"submit\" name=\"Submit-ARQ-Quarantine-Radio\" value=\"".__('Submit', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"QStandard()\" />&nbsp;&nbsp;<input type=\"button\" name=\"cancel\" value=\"".__('Clear|Refresh', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"javascript:history.go(0)\" /></form>";
	}
	}
	}
?>
<br />

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
//jQuery(function() {  $('.checkallRestore').click(function() {
    $('.checkallRestore').click(function() {
		$(this).parents('#ARQcheckall:eq(0)').find('.restorefileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
//jQuery(function() {
    $('.checkallDelete').click(function() {
        $(this).parents('#ARQcheckall:eq(0)').find('.deletefileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<?php 
// Quarantine Standard/Default Form Proccessing - View, Restore or Delete Files
if ( isset( $_POST['Submit-ARQ-Quarantine-Radio'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_arq_quarantine');
	
	$time_start = microtime( true );

	$qradio = $_POST['qradio'];
	$bpspro_arq_quarantine_table = $wpdb->prefix . "bpspro_arq_quarantine";
	
	switch( $_POST['Submit-ARQ-Quarantine-Radio'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$delete_files = array();
		$restore_files = array();
		$view_files = array();		
		
		if ( ! empty($qradio) ) {
			
			foreach ( $qradio as $key => $value ) {
				
				if ( $value == 'deletefile' ) {
					$delete_files[] = $key;
				
				} elseif ( $value == 'restorefile' ) {
					$restore_files[] = $key;
				
				} elseif ( $value == 'viewfile' ) {
					$view_files[] = $key;
				}
			}
		}
			
		if ( ! empty($delete_files) ) {
			
			foreach ( $delete_files as $delete_file ) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $delete_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					
					@unlink($row->arq_quarantine_qpath);
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $delete_file));
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textDelete = '<font color="green">'.$filename.__(' has been deleted from Quarantine.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textDelete;
				echo '</p></div>';	
				}
			}
		}
		
		if ( ! empty($restore_files) ) {
			
			foreach ( $restore_files as $restore_file ) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source = %s", $restore_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					// A php error will be displayed if user is fubar - most likely user mistake is that the backup folder will not already exist
					@copy($row->arq_quarantine_qpath, $row->arq_quarantine_backup);				
					@rename($row->arq_quarantine_qpath, $row->arq_quarantine_source);
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source = %s", $restore_file));
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textRestore = '<font color="green">'.$filename.__(' has been restored to ', 'bulletproof-security').$row->arq_quarantine_source.'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textRestore;
				echo '</p></div>';	
				}			
			}
		}

		if ( ! empty($view_files) ) {
			
			foreach ( $view_files as $view_file ) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $view_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					$Qcontents = file_get_contents($row->arq_quarantine_qpath);

				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textViewClose = '<font color="green">'.__('Close File: ', 'bulletproof-security').$filename.__(' and show files in Quarantine', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Close File', 'bulletproof-security').'</a></div>';
				echo $textViewClose;
				echo '</p></div>';
				
				echo '<div id="message" style="background-color:#ffffe0;border:1px solid #999999;margin:9px 0px 15px 0px;padding:0px 10px 0px 10px;"><p>';
				$textView = '<font color="green">'.__('Viewing File: ', 'bulletproof-security').$filename.'</font><br><br><pre>'.htmlspecialchars($Qcontents).'</pre>';
				echo $textView;
				echo '</p></div>';	
				}			
			}
		}
		break;
	} // end Switch

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}

// Quarantine Sort/Search Form Processing - View, Restore or Delete Files
if ( isset( $_POST['Submit-Quarantine-Search-Radio'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_quarantine_search');
	
	$time_start = microtime( true );

	$qradio = $_POST['qradio'];
	$bpspro_arq_quarantine_table = $wpdb->prefix . "bpspro_arq_quarantine";
	
	switch( $_POST['Submit-Quarantine-Search-Radio'] ) {
		case __('Submit', 'bulletproof-security'):
		
		$delete_files = array();
		$restore_files = array();
		$view_files = array();		
		
		if ( ! empty($qradio) ) {
			
			foreach ( $qradio as $key => $value ) {
				
				if ( $value == 'deletefile' ) {
					$delete_files[] = $key;
				
				} elseif ( $value == 'restorefile' ) {
					$restore_files[] = $key;
				
				} elseif ( $value == 'viewfile' ) {
					$view_files[] = $key;
				}
			}
		}
			
		if ( ! empty($delete_files) ) {
			
			foreach ( $delete_files as $delete_file ) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $delete_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					
					@unlink($row->arq_quarantine_qpath);
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $delete_file));
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textDelete = '<font color="green">'.$filename.__(' has been deleted from Quarantine.', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textDelete;
				echo '</p></div>';	
				}
			}
		}
		
		if ( ! empty($restore_files) ) {
			
			foreach ($restore_files as $restore_file) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source = %s", $restore_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					// A php error will be displayed if user is fubar - most likely user mistake is that the backup folder will not already exist
					@copy($row->arq_quarantine_qpath, $row->arq_quarantine_backup);				
					@rename($row->arq_quarantine_qpath, $row->arq_quarantine_source);
					$delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_source = %s", $restore_file));
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textRestore = '<font color="green">'.$filename.__(' has been restored to ', 'bulletproof-security').$row->arq_quarantine_source.'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
				echo $textRestore;
				echo '</p></div>';	
				}			
			}
		}

		if ( !empty($view_files) ) {
			
			foreach ($view_files as $view_file) {
				
				$QuarantineRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $bpspro_arq_quarantine_table WHERE arq_quarantine_qpath = %s", $view_file) );
			
				foreach ( $QuarantineRows as $row ) {
					$path_parts = pathinfo($row->arq_quarantine_qpath);
					$filename = $path_parts['basename'];
					$Qcontents = file_get_contents($row->arq_quarantine_qpath);
				
				echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
				$textViewClose = '<font color="green">'.__('Close File: ', 'bulletproof-security').$filename.__(' and show files in Quarantine', 'bulletproof-security').'</font><br><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php">'.__('Close File', 'bulletproof-security').'</a></div>';
				echo $textViewClose;
				echo '</p></div>';

				echo '<div id="message" style="background-color:#ffffe0;border:1px solid #999999;margin:9px 0px 15px 0px;padding:0px 10px 0px 10px;"><p>';
				$textView = '<font color="green">'.__('Viewing File: ', 'bulletproof-security').$filename.'</font><br><br><pre>'.htmlspecialchars($Qcontents).'</pre>';
				echo $textView;
				echo '</p></div>';	
				}			
			}
		}
		break;
	} // end Switch

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}
}

?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('Quarantine Log', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('Quarantine Log', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('Quarantine Log', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Quarantine Log General Information', 'bulletproof-security').'</strong><br>'.__('The Quarantine Log logs specific information about what action was taken so that you can quickly visually identify exactly what action occurred. See the example Quarantine Log Entries below for the different types of Log entries you may see. The Quarantine Log entries will tell you what Top Level folder the file was quarantined from, the original source path of where the quarantined file was quarantined from, the file name of the quarantined file, a timestamp, whether the file was AutoRestored or just Quarantined, the Quarantine folder location and if a file already exists in Quarantine then the file will be renamed using a Timestamp so that it does not overwrite the existing quarantined file.', 'bulletproof-security').'<br><br>'.__('When a file has been quarantined you will see an AutoRestore|Quarantine Alert. To remove that alert from being displayed you will need to click the Reset Last Modified Time in DB button. This synchronizes the last modified time of the actual Quarantine Log file with the timestamp stored in your WordPress database for the last time the Quarantine Log file was modified. Every time a new log entry is made in the Quarantine Log the last modified time of the Quarantine Log file will change.', 'bulletproof-security').'<br><br>'.__('Your ARQ Log file is a plain text static file and not a dynamic file or dynamic display to keep your website resource usage at a bare minimum and keep your website performance at a maximum. Log entries are logged in descending order by Date and Time.  You can copy, edit and delete this plain text file. You can setup S-Monitor Email Alerting & Log File Options to automatically email your ARQ Log file to you and delete it when it reaches a certain size (256KB, 500KB or 1MB). NOTE: The S-Monitor Email Alerting & Log File Options will only send log files up to 2MB in size. 500KB is the recommend maximum size setting that you should use for when to automatically email your ARQ Log File to you.', 'bulletproof-security').'<br><br><strong>'.__('Example Quarantine Log Entries', 'bulletproof-security').'</strong><br><br><strong>'.__('A WordPress wp-includes file named atomlib.php was AutoRestored and Quarantined', 'bulletproof-security').'</strong><br>'.__('[WP-includes File AutoRestore Logged - January 14, 2013 - 8:38 am]', 'bulletproof-security').'<br>'.__('Quarantined File: atomlib.php', 'bulletproof-security').'<br>'.__('Quarantine Folder: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/', 'bulletproof-security').'<br>'.__('AutoRestored File: /xxxxx/xxxxx/wp-includes/atomlib.php', 'bulletproof-security').'<br>'.__('Quarantined From/Restore Path: /xxxxx/xxxxx/wp-includes/atomlib.php', 'bulletproof-security').'<br><br><strong>'.__('A non-WordPress Added file named testsubfolderfile.txt was AutoRestored and Quarantined', 'bulletproof-security').'</strong><br>'.__('[non-WordPress Added File AutoRestore Logged - January 14, 2013 - 8:38 am]', 'bulletproof-security').'<br>'.__('Quarantined File: testsubfolderfile.txt', 'bulletproof-security').'<br>'.__('Quarantine Folder: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/', 'bulletproof-security').'<br>'.__('AutoRestored File: /xxxxx/xxxxx/testfolder/testsubfolder/testsubfolderfile.txt', 'bulletproof-security').'<br>'.__('Quarantined From/Restore Path: /xxxxx/xxxxx/testfolder/testsubfolder/testsubfolderfile.txt', 'bulletproof-security').'<br><br><strong>'.__('A file named hacker-file.txt was Quarantined from the wp-includes folder', 'bulletproof-security').'</strong><br>'.__('[WP-includes File Quarantine Logged - January 14, 2013 - 8:38 am]', 'bulletproof-security').'<br>'.__('Quarantined File: hacker-file.txt', 'bulletproof-security').'<br>'.__('Quarantine Folder: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/', 'bulletproof-security').'<br>'.__('Quarantined From/Restore Path: /xxxxx/xxxxx/wp-includes/js/hacker-file.txt', 'bulletproof-security').'<br><br><strong>'.__('A file named hacker-file-test-500.php was Quarantined from a non-WordPress Added folder named orangesub', 'bulletproof-security').'</strong><br>'.__('[non-WordPress Added File Quarantine Logged - January 14, 2013 - 8:38 am]', 'bulletproof-security').'<br>'.__('Quarantined File: hacker-file-test-500.php', 'bulletproof-security').'<br>'.__('Quarantine Folder: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/', 'bulletproof-security').'<br>'.__('Quarantined From/Restore Path: /xxxxx/xxxxx/orange/orangesub/hacker-file-test-500.php', 'bulletproof-security').'<br><br><strong>'.__('A file named hacker-file-test-500.php was Quarantined from a non-WordPress Added folder named orangesub and was renamed with a Timestamp because a duplicate file name already exists in Quarantine', 'bulletproof-security').'</strong><br>'.__('[non-WordPress Added File Quarantine Logged - Duplicate File Renamed - January 14, 2013 - 8:38 am]', 'bulletproof-security').'<br>'.__('Quarantined File: hacker-file-test-500.php', 'bulletproof-security').'<br>'.__('Quarantine Folder: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/', 'bulletproof-security').'<br>'.__('Quarantined From/Restore Path: /xxxxx/xxxxx/orange/orangesub/hacker-file-test-500.php', 'bulletproof-security').'<br>'.__('Renamed To: /xxxxx/xxxxx/', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/quarantine/Jun-26-2012--19-25-48--hacker-file-test-500.php', 'bulletproof-security'); echo $text; ?></p>
</div>

<?php

// Get the Current / Last Modifed Date of the ARQ Infinity Log File
function bps_getARCMLogLastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if (file_exists($filename)) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// String comparison of ARQ Infinity DB Last Modified Time and Actual File Last Modified Time
function bps_ARCMModTimeDiff() {
$options = get_option('bulletproof_security_options_ARCM_log');
$last_modified_time = bps_getARCMLogLastMod();
$last_modified_time_db = $options['bps_arcm_log_date_mod'];
	
	if ($options['bps_arcm_log_date_mod'] == '') {
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

// Get File Size of the Quarantine Log File
function bps_getARQLogSize() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';

if (file_exists($filename)) {
	$logSize = filesize($filename);
	if ($logSize < 2097152) {
 		$text = '<strong>'. __('ARQ Log File Size: ', 'bulletproof-security').'<font color="#2ea2cc">'. round($logSize / 1024, 2) .' KB</font></strong><br><br>';
		echo $text;
	} else {
 		$text = '<strong>'. __('ARQ Log File Size: ', 'bulletproof-security').'<font color="red">'. round($logSize / 1024, 2) .' KB<br>'.__('The S-Monitor Email Logging options will only send log files up to 2MB in size.', 'bulletproof-security').'</font></strong><br>'.__('Copy and paste the ARQ Log file contents into a Notepad text file on your computer and save it.', 'bulletproof-security').'<br>'.__('Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'<br><br>';		
		echo $text;
	}
	}
}
bps_getARQLogSize();
?>

<form name="QLogModDate" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_ARCM_log'); ?> 
	<?php $options = get_option('bulletproof_security_options_ARCM_log'); ?>
    <label for="QLog"><strong><?php _e('Quarantine Log Last Modified Time:', 'bulletproof-security'); ?></strong></label><br />
	<label for="QLog"><strong><?php echo bps_ARCMModTimeDiff(); ?></strong><?php echo $options['bps_arcm_log_date_mod']; ?></label><br />
	<label for="QLog"><strong><?php _e('Last Modified Time in File:', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options_ARCM_log[bps_arcm_log_date_mod]" style="color:#2ea2cc;font-size:13px;width:200px;padding-left:4px;font-weight:bold;border:none;background:none;outline:none;-webkit-box-shadow:none;box-shadow:none;-webkit-transition:none;transition:none;" value="<?php echo bps_getARCMLogLastMod(); ?>" /><br />
	<input type="submit" name="Submit-ARCM-Mod" class="button bps-button" style="margin:10px 0px 0px 0px;" value="<?php esc_attr_e('Reset Last Modified Time in DB', 'bulletproof-security') ?>" />
</form>

<?php
if (isset($_POST['Submit-Delete-ARQ-Log']) && current_user_can('manage_options')) {
	check_admin_referer( 'bps-delete-arq-log' );

$options = get_option('bulletproof_security_options_ARCM_log');
$last_modified_time_db = $options['bps_arcm_log_date_mod'];
$time = strtotime($last_modified_time_db); 
$ARQLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$ARQLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/autorestore_log.txt';
	
	if ( copy($ARQLogMaster, $ARQLog) ) {
		touch($ARQLog, $time);	
	}
}
?>

<form name="DeleteLogForm" action="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bps-delete-arq-log'); ?>
<p class="submit">
<input type="submit" name="Submit-Delete-ARQ-Log" value="<?php esc_attr_e('Delete Log', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will delete the contents of your ARQ Log file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Delete the Log file contents or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</form>

<div id="messageinner" class="updatedinner" style="width:690px;">
<?php

// Get BPS ARCM log file contents 
function bps_get_arcm_log() {
if ( current_user_can('manage_options') ) {
	
$bps_arcm_log = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( file_exists($bps_arcm_log) ) {
		$bps_arcm_log = file_get_contents($bps_arcm_log);
		return htmlspecialchars($bps_arcm_log);
	
	} else {
	
	_e('The AutoRestore Log File Was Not Found! Check that the file really exists here - /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/logs/autorestore_log.txt and is named correctly.', 'bulletproof-security');
	}
	}
}

// Form - ARCM Error Log - Perform File Open and Write test - If append write test is successful write to file
if ( current_user_can('manage_options') ) {
$bps_arcm_log = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$write_test = "";
	
	if ( is_writable($bps_arcm_log) ) {
    if ( !$handle = fopen($bps_arcm_log, 'a+b') ) {
    exit;
    }
    if ( fwrite($handle, $write_test) === FALSE ) {
	exit;
    }
	$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your AutoRestore Log file is writable.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	}
	}
	
	if ( isset($_POST['submit-arcm-log'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_arcm_log' );
	$newcontentarcm = stripslashes($_POST['newcontentarcm']);
	if ( is_writable($bps_arcm_log) ) {
		$handle = fopen($bps_arcm_log, 'w+b');
		fwrite($handle, $newcontentarcm);
	$text = '<font color="green"><strong>'.__('Success! Your AutoRestore Log file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
}
$scrolltoarcmlog = isset($_REQUEST['scrolltoarcmlog']) ? (int) $_REQUEST['scrolltoarcmlog'] : 0;
?>
</div>

<div id="QLogEditor">
<form name="bpsARCMLog" id="bpsARCMLog" action="admin.php?page=bulletproof-security/admin/quarantine/quarantine.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bulletproof_security_save_arcm_log'); ?>
<div id="bpsARCMLog">
    <textarea class="bps-text-area-600x700" name="newcontentarcm" id="newcontentarcm" tabindex="1"><?php echo bps_get_arcm_log(); ?></textarea>
	<input type="hidden" name="scrolltoarcmlog" id="scrolltoarcmlog" value="<?php echo esc_html($scrolltoarcmlog); ?>" />
    <p class="submit">
	<input type="submit" name="submit-arcm-log" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#bpsARCMLog').submit(function(){ $('#scrolltoarcmlog').val( $('#newcontentarcm').scrollTop() ); });
	$('#newcontentarcm').scrollTop( $('#scrolltoarcmlog').val() ); 
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