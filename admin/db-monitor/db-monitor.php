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

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ DB Monitor IDS ~ DB Status & Info', 'bulletproof-security'); ?></h2>

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
function DBDiffSmall() {
	
    var r = confirm("Click OK to create Diff Files and compare those Diff files for differences or click Cancel.");
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
function DBDiffLarge() {
	
    var r = confirm("Click OK to Run the Large Diff Comparison Tool or click Cancel.");
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
			<li><a href="#bps-tabs-1"><?php _e('DB Monitor', 'bulletproof-security'); ?></a></li>			
			<li><a href="#bps-tabs-2"><?php _e('DB Monitor Log', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-3"><?php _e('DB Diff Tool', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-4"><?php _e('DB Status & Info', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-5"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('DB Monitor', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td width="40%" valign="top" class="bps-table_cell_help">
    
<h3 style="margin:0px 0px -2px 0px;"><?php _e('DB Monitor', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('DB Monitor IDS', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('DB Monitor IDS (DBM) Guide: http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/', 'bulletproof-security').'</strong><br><br><strong>'.__('What is the DB Monitor IDS (DBM)?', 'bulletproof-security').'</strong><br>'.__('The DB Monitor (DBM) is an Intrusion Detection System (IDS) that alerts you via email anytime a change/modification occurs in your WordPress database or a new database table is created in your WordPress database. The DB Monitor email alert contains information about what database change/modification occurred and other relevant help info. Your DB Monitor Log also logs any changes/modifications to your WordPress database and other relevant help info.', 'bulletproof-security').'<br><br>'.__('The DBM IDS is similar to the ARQ IDPS where it is the most powerful last line of website security protection defense. If all other outer and inner layers of security protection are penetrated then the most powerful DBM IDS and ARQ IDPS systems kick in and protect your website from attacks/hackers. Even if these powerful security measures are never utilized the most significant benefit is that you know for sure that neither your website files or your WordPress database have been tampered with.', 'bulletproof-security').'<strong><br><br>'.__('How The DB Monitor IDS Works', 'bulletproof-security').'</strong><br>'.__('By default the DB Monitor is automatically setup by BPS Pro when you upgrade BPS Pro or when you run the Setup Wizards. The default DB Monitor settings are: Check for any new DB Tables created in your database every 15 minutes. You can of course choose whether or not you want to monitor any or all of your database tables for any changes/modifications and how often you want the DBM Cron check to run. The DBM Cron check is designed in a way that it does not cause any website performance loss.', 'bulletproof-security').'<br><br><strong>'.__('How to Choose Between Table Size & Update Time in the Dynamic DB Form', 'bulletproof-security').'</strong><br><br><strong>'.__('Update Time: ', 'bulletproof-security').'</strong>'.__('When a particular database table is updated by WordPress, a plugin, a theme or by you, that database Update Time timestamp will be updated with the time the update occurred to any row within that database table. If your MySQL database type updates the Update Time database table then you will see a timestamp for the last time that each database table was updated.', 'bulletproof-security').'<br><br><strong>'.__('Table Size: ', 'bulletproof-security').'</strong>'.__('This is the size of each of your individual database tables. Your database table sizes are displayed in Kilobytes in the Dynamic DB Form, but are checked by bytes, which is a more precise check.', 'bulletproof-security').'<br><br>'.__('The logic for choosing between Table Size & Update Time checks is very simple. You look at the Update Time column in the Dynamic DB Form and if the timestamp date is very recent for a particular database table then you want to click/select the Table Size Radio button for that particular database table. The reason you would choose Table Size and NOT Update Time is that particular database table is updated automatically and frequently and the Update Time will change frequently. The size of the particular database table will probably NOT change.', 'bulletproof-security').'<br><br>'.__('A perfect example is the WordPress xxxxxx_options database table. The WordPress xxxxxx_options database table is updated automatically and very frequently with UNIX timestamps by WordPress itself and WordPress plugins, including BPS Pro. A UNIX timestamp looks like this: 1402070660. It is a 10 digit number. When a UNIX timestamp is updated it will always be a 10 digit number. Example: 1402070660, 1402070661, 1402070662. The size of the UNIX timestamp will always be the same. So what that means is WordPress xxxxxx_options database table size will NOT change when a UNIX timestamp is updated, but the Update Time of WordPress xxxxxx_options database table will change every time a UNIX timestamp is updated. So checking by Table Size for the WordPress xxxxxx_options database table means that you will not be alerted when UNIX timestamps are updated and will ONLY be alerted if the size of the WordPress xxxxxx_options database table changes.', 'bulletproof-security').'<br><br>'.__('After choosing the Table Size Radio button for all database tables that have a recent timestamp in the Update Time column you can then select the Update Time Radio button for all of your other database tables that you want to monitor.', 'bulletproof-security').'<br><br>'.__('You may not want to monitor some database tables, such as the xxxxxx_bpspro_db_backup or the xxxxxx_bpspro_login_security or other plugin\'s top level database tables. That choice is up to you. If you choose to monitor a database table and a change/modification occurs then you will receive a DB Monitor email alert about that database table change/modification. You can of course adjust/change your DB Monitor settings at any time and add or remove database tables that you want to monitor and/or how you want those database tables to be monitored - by size or by update time.', 'bulletproof-security').'<br><br><strong>'.__('How do I change Alerts, Email Alerting Status Display Options?', 'bulletproof-security').'</strong><br>'.__('BPS Pro S-Monitor is the central alerting, email and status display options Core for BPS Pro. All alerting, email and status display options are chosen/selected in S-Monitor for all BPS Pro Core security features.', 'bulletproof-security').'<br><br><strong>'.__('Dynamic DB Form Tips', 'bulletproof-security').'</strong><br>'.__('You only need to choose/click on either a Table Size or Update Time Radio button for each database table that you want to monitor and do not need to click the checkbox for that particular database table. By selecting a Radio button for a particular database table that you want to monitor, you are selecting that database table to be monitored.', 'bulletproof-security').'<br><br><strong>'.__('DB Monitor Status Table', 'bulletproof-security').'</strong><br>'.__('Dynamic DB Form results are displayed immediately after submitting the Dynamic DB Form in the DB Monitor Status Table. The DB Monitor Status Table displays which database tables are being checked by either size or update time, the frequency of those checks and the next scheduled check time.', 'bulletproof-security').'<br><br><strong>'.__('IMPORTANT NOTES:', 'bulletproof-security').'</strong><br>'.__('The Dynamic DB Form Checkboxes and Radio buttons are specifically designed NOT to stay selected. The Dynamic DB Form is similar to a Comment Form. You enter what you want to submit and click the submit button. The results of submitting the Dynamic DB Form are displayed immediately in the DB Monitor Status Table and you Dynamic DB Form Settings are logged in the DB Monitor Log file.', 'bulletproof-security').'<br><br>'.__('The Next Check time shown in the DB Monitor Status Table is literally the next scheduled Cron job time. If you resubmit the Dynamic DB Form in between scheduled Cron jobs then the literal next scheduled Cron job time is displayed and not the time now when you submitted the Dynamic DB Form. The next scheduled Cron job will use whatever form settings are set when the next Cron job runs.', 'bulletproof-security').'<br><br>'.__('Some MySQL database types do not have/use Update Time. If you see N/A under the Dynamic DB Form Update Time column then Update Time is not available for your MySQL Database type (InnoDB, XAMPP, etc) and you can only check your database tables by Table Size. If you choose Update Time and your MySQL database shows N/A under the Update Time column then no DB Monitor database checks will occur for that database table and the DB Monitor Status Table will display N/A - Update Time for the Check By column and N/A for the Frequency and Next Check columns in Red font.', 'bulletproof-security').'<br><br>'.__('If you submit the Dynamic DB Form and you have NOT selected/checked any Table Name checkboxes then this will delete/clear/remove all database tables from being checked by the DB Monitor and the default check for new database tables created will be done if you have selected that option.', 'bulletproof-security').'<br><br>'.__('If you submit the Dynamic DB Form and you ONLY select Table Name checkboxes and do NOT select either a Table Size or Update Time Radio button corresponding to the Table Name checkbox that you checked then a Table Size check will be chosen/selected by default for that database table.', 'bulletproof-security').'<br><br>'.__('If you submit the Dynamic DB Form and and you ONLY select either a Table Size or Update Time Radio button then the Table Name corresponding to that Radio button will be chosen/selected/added and be checked by the DB Monitor.', 'bulletproof-security'); echo $text; ?></p>
</div>

<?php
	
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {	
	
	// Form: DB Monitor Form
	echo '<form name="bpsDBMonitor" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php" method="post">';
	wp_nonce_field('bulletproof_security_db_monitor');

	$DBMoptions = get_option('bulletproof_security_options_db_monitor');
	$DBTables = 0;
	$size = 0;
	$getDBTables = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Rows >= %d", $DBTables ) );

	echo '<h4><font color="#2ea2cc">'.__('Dynamic DB Form Results are displayed in the DB Monitor Status Table', 'bulletproof-security').' =></font></h4>';
	echo '<div id="DBcheckall" style="margin:10px 0px 20px 0px;">';
	echo '<table style="text-align:left;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:20px;font-size:1em;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('All', 'bulletproof-security').'</strong><br><input type="checkbox" class="checkallDB" /></th>';
	echo '<th scope="col" style="width:200px;font-size:1.13em;padding-top:20px;margin-right:20px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Table Name', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:20px;font-size:1em;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('All', 'bulletproof-security').'</strong><br><input type="checkbox" class="checkallDBsize" /></th>';
	echo '<th scope="col" style="width:80px;font-size:1.13em;padding-top:20px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Table Size', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:20px;font-size:1em;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('All', 'bulletproof-security').'</strong><br><input type="checkbox" class="checkallDBupdate" /></th>';
	echo '<th scope="col" style="width:150px;font-size:1.13em;padding-top:20px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Update Time', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';
	
	foreach ( $getDBTables as $Tabledata ) {
		
		$size = $Tabledata->Data_length + $Tabledata->Index_length;
		$bytes = number_format( $size );
		$kbytes = number_format( $size / ( 1024 ) );
		
		if ( $Tabledata->Update_time == '' || $Tabledata->Update_time === NULL ) {
			$update_time = 'N/A';
		} else {
			$update_time = $Tabledata->Update_time;
		}

		echo "<td><input type=\"checkbox\" id=\"dbtables\" name=\"dbm[$Tabledata->Name]\" value=\"dbtables\" class=\"dbtablesALL\" /></td>";
		echo '<td>'.$Tabledata->Name.'</td>';
		echo "<td><input type=\"radio\" id=\"dbtablessize\" name=\"dbm[$Tabledata->Name]\" value=\"dbtablessize\" class=\"dbtablesALLsize\" /></td>";
		echo '<td>'.$kbytes.' KB</td>';
		echo "<td><input type=\"radio\" id=\"dbtablesupdate\" name=\"dbm[$Tabledata->Name]\" value=\"dbtablesupdate\" class=\"dbtablesALLupdate\" /></td>";
		echo '<td>'.$update_time.'</td>';
		echo '</tr>';
	}

	echo '</tbody>';
	echo '</table>';
	echo '</div>'; // jQuery div parent
	
	echo '<label for="bps-dbm">'.__('DB Monitor (DBM) Cron Check Frequency:', 'bulletproof-security').'</label><br>';
	echo '<select name="dbm_cron_frequency" style="width:340px;">';
	echo '<option value="1"'. selected('1', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 1 Minute', 'bulletproof-security').'</option>';
	echo '<option value="5"'. selected('5', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 5 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="10"'. selected('10', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 10 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="15"'. selected('15', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 15 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="30"'. selected('30', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 30 Minutes', 'bulletproof-security').'</option>';
	echo '<option value="60"'. selected('60', $DBMoptions['bps_db_monitor_cron_frequency']).'>'.__('Run DBM Cron Check Every 60 Minutes', 'bulletproof-security').'</option>';
	echo '</select><br><br>';

	echo '<label for="bps-dbm">'.__('New DB Tables Created Check:', 'bulletproof-security').'</label><br>';
	echo '<select name="dbm_cron_create_time" style="width:340px;">';
	echo '<option value="On"'. selected('On', $DBMoptions['bps_db_monitor_cron_table_created_check']).'>'.__('Check For New DB Tables Created', 'bulletproof-security').'</option>';
	echo '<option value="Off"'. selected('Off', $DBMoptions['bps_db_monitor_cron_table_created_check']).'>'.__('Do NOT Check For New DB Tables Created', 'bulletproof-security').'</option>';
	echo '</select><br><br>';

	echo '<label for="bps-dbm">'.__('DB Monitor On or Off:', 'bulletproof-security').'</label><br>';
	echo '<select name="dbm_on_off" style="width:340px;">';
	echo '<option value="On"'. selected('On', $DBMoptions['bps_db_monitor_cron']).'>'.__('Turn On DB Monitor', 'bulletproof-security').'</option>';
	echo '<option value="Off"'. selected('Off', $DBMoptions['bps_db_monitor_cron']).'>'.__('Turn Off DB Monitor', 'bulletproof-security').'</option>';
	echo '</select><br><br>';
	
	echo "<p><input type=\"submit\" name=\"Submit-DB-Monitor\" value=\"".__('Submit Dynamic DB Form', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('IMPORTANT PLEASE READ THIS\n\n-------------------------------------------------------------\n\nIf you have NOT selected/checked any Table Name checkboxes then this will delete/clear/remove all Database Tables from being checked by the DB Monitor\n\n-------------------------------------------------------------\n\nIf you ONLY select Table Name checkboxes and do NOT select either a Table Size or Update Time Radio button then a Table Size check will be chosen/selected by default for that Database Table\n\n-------------------------------------------------------------\n\nIf you ONLY select either a Table Size or Update Time Radio button then the Table Name corresponding to that Radio button will be chosen/selected/added and be checked by the DB Monitor\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel', 'bulletproof-security')."')\" /></p></form>";
	}

?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallDB').click(function() {
		$(this).parents('#DBcheckall:eq(0)').find('.dbtablesALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallDBsize').click(function() {
		$(this).parents('#DBcheckall:eq(0)').find('.dbtablesALLsize:radio').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallDBupdate').click(function() {
		$(this).parents('#DBcheckall:eq(0)').find('.dbtablesALLupdate:radio').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<?php

// Form Processing: Save DB Monitor Form Options
if ( isset( $_POST['Submit-DB-Monitor'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_db_monitor');
	
	$dbm_cron_frequency = $_POST['dbm_cron_frequency'];
	
	if ( $dbm_cron_frequency == '1' ) {
		$dbm_cron_end = time() + 60;	
	}
	if ( $dbm_cron_frequency == '5' ) {
		$dbm_cron_end = time() + 300;	
	}	
	if ( $dbm_cron_frequency == '10' ) {
		$dbm_cron_end = time() + 600;	
	}
	if ( $dbm_cron_frequency == '15' ) {
		$dbm_cron_end = time() + 900;	
	}	
	if ( $dbm_cron_frequency == '30' ) {
		$dbm_cron_end = time() + 1800;	
	}	
	if ( $dbm_cron_frequency == '60' ) {
		$dbm_cron_end = time() + 3600;	
	}

	$DBM_Options = array( 
	'bps_db_monitor_cron' 						=> $_POST['dbm_on_off'], 
	'bps_db_monitor_cron_frequency' 			=> $dbm_cron_frequency, 
	'bps_db_monitor_cron_table_created_check' 	=> $_POST['dbm_cron_create_time'], 
	'bps_db_monitor_cron_end' 					=> $dbm_cron_end
	);
	
		foreach( $DBM_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_monitor', $DBM_Options);
		}
	
	$DBM = $_POST['dbm'];
	$DMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";
	$DBTables_process = 0;
	$size_process = 0;
	$rows = 0;
	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	$bpsDBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
	$log_title = "\r\n" . '[Dynamic DB Form Settings Logged: ' . $timestamp . ']' . "\r\n";
	
	$getTData = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Rows >= %d", $DBTables_process ) );
	$delete_rows = $wpdb->query( $wpdb->prepare( "DELETE FROM $DMtable_name WHERE bps_id >= %d", $rows ) );

	if ( empty( $DBM ) ) {
	if ( $_POST['dbm_on_off'] == 'On' && $_POST['dbm_cron_create_time'] == 'On' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';	
		echo '<strong><font color="green">'.__('DB Monitor has been turned On and new DB Tables Created Check is turned On', 'bulletproof-security').'</font></strong><br>';
			echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
		echo '</p></div>';
	}

	if ( $_POST['dbm_on_off'] == 'On' && $_POST['dbm_cron_create_time'] == 'Off' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';	
		echo '<strong><font color="green">'.__('DB Monitor has been turned On and new DB Tables Created Check is turned Off', 'bulletproof-security').'</font></strong><br>';
			echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
		echo '</p></div>';
	}

	if ( $_POST['dbm_on_off'] == 'Off' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';	
		echo '<strong><font color="green">'.__('DB Monitor has been turned Off', 'bulletproof-security').'</font></strong><br>';
		echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
		echo '</p></div>';
	}
	}
	
	if ( ! empty( $DBM ) ) {
		
		if ( is_writable( $bpsDBMLog ) ) {
		if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
        	exit;
    	}
    	if ( fwrite( $handle, $log_title ) === FALSE ) {
        	exit;
    	}
    	fclose($handle);
		}

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		echo '<strong>'.__('Dynamic DB Form Results are displayed in the DB Monitor Status Table', 'bulletproof-security').'</strong><br>';
		echo '<strong>'.__('Dynamic DB Form Settings Logged in the DB Monitor Log', 'bulletproof-security').'</strong><br>';
		echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';		
		
		foreach ( $DBM as $key => $value ) {

			foreach ( $getTData as $Tdata ) {
		
				if ( $key == $Tdata->Name ) {
				
					$size_process = $Tdata->Data_length + $Tdata->Index_length;
		
				if ( $Tdata->Update_time == '' || $Tdata->Update_time === NULL ) {
					$update_time_process = '';
				} else {
					$update_time_process = $Tdata->Update_time;
				}

					$DBMInsertRows = $wpdb->insert( $DMtable_name, array( 'bps_table_name' => $key, 'bps_check' => $value, 'bps_size' => $size_process, 'bps_update_time' => $update_time_process, 'bps_created' => current_time('mysql') ) );
				
					$text = '<font color="green">'.__('Database table row created for Table Name: ', 'bulletproof-security').$key.'</font><br>';
					echo $text;
				
					if ( $value == 'dbtables' || $value == 'dbtablessize' ) {
						$checkby = __('Table Size', 'bulletproof-security');
					}
					elseif ( $value == 'dbtablesupdate' ) {
						$checkby = __('Update Time', 'bulletproof-security');
					}
					
					//$log_contents = "\r\n" . '[Dynamic DB Form Settings Logged: ' . $timestamp . ']' . "\r\n" . 'Table Name: ' . $key . ' Check By: ' . $checkby . "\r\n";
					$log_contents = 'Table Name: ' . $key . ' | Check By: ' . $checkby . "\r\n";
					
					if ( is_writable( $bpsDBMLog ) ) {
					if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         				exit;
    				}
    				if ( fwrite( $handle, $log_contents ) === FALSE ) {
        				exit;
    				}
    				fclose($handle);
					}				
				}
			}
		}
		echo '</p></div>';
			
		$DBMLog_Options = array( 'bps_dbm_log_date_mod' => bpsPro_DBM_Log_LastMod() );
	
		foreach( $DBMLog_Options as $key => $value ) {
			update_option('bulletproof_security_options_DBM_log', $DBMLog_Options);
		}
	}
}

?>

</td>
    <td width="60%" valign="top" class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('DB Monitor Status Table', 'bulletproof-security'); ?></h3>

<?php
function bpsPro_DB_Monitor_status() {	
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {	

global $wpdb;
$DMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";
$DBMRows = '';
$DBMTableRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $DMtable_name WHERE bps_table_name != %s", $DBMRows ) );
$DBMoptions = get_option('bulletproof_security_options_db_monitor');
$date_format = 'M j, Y @ g:i A';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$DBM_cron_time = wp_next_scheduled( 'bpsPro_DBM_check' );
$actual_cron_schedule_time = date_i18n( get_option('date_format'), strtotime("11/15-1976") ) . ' @ ' . date_i18n( get_option('time_format'), $DBM_cron_time + $gmt_offset );
// this shows the form math, next check time, but it is not synchronized/accurate with the actual wp cron schedule times
//$dbm_form_cron_time = date_i18n( $date_format, $DBMoptions['bps_db_monitor_cron_end'] + $gmt_offset );

	if ( $DBMoptions['bps_db_monitor_cron'] == 'On' && $DBMoptions['bps_db_monitor_cron_table_created_check'] == 'On' ) {
		$db_create_time_check = '<strong><font color="green">'.__('On', 'bulletproof-security').'</font> || '.__('Next Check: ', 'bulletproof-security').'<font color="green">'.$actual_cron_schedule_time.'</font></strong>';
		
	} else {
		$db_create_time_check = '<strong><font color="blue">'.__('Off', 'bulletproof-security').'</font></strong>';
	}

	echo '<div id="DBMStatus" style="margin-top:0px;padding-top:0px;">';
	echo '<h4><font color="#2ea2cc" style="margin:0px;">'.__('Dynamic DB Form Results are displayed below', 'bulletproof-security').'</font></h4>';
	echo '<div id="DBMCreateTableCheck" style="margin:-5px; 0px 0px 0px;padding:0px 0px 0px 5px;"><strong>'.__('New DB Tables Created Check: ', 'bulletproof-security').'</strong>'.$db_create_time_check.'</div>';
	echo '<table style="text-align:left;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:20%;font-size:1.13em;padding-top:13px;margin-right:20px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Table Name', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:10%;font-size:1.13em;padding-top:13px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Check By', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:5%;font-size:1.13em;padding-top:13px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Frequency', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:15%;font-size:1.13em;padding-top:13px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Next Check', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';

	if ( $wpdb->num_rows != 0 ) {

	sort($DBMTableRows);
	
	foreach ( $DBMTableRows as $key => $value ) {
	
		switch ( $value->bps_check ) {
   			case 'dbtables':
					$DBMcheck = __('Table Size', 'bulletproof-security');
			break;
    		case 'dbtablessize':
					$DBMcheck = __('Table Size', 'bulletproof-security');
			break;
    		case 'dbtablesupdate': 
				if ( ! preg_match('/0000-00-00 00:00:00/', $value->bps_update_time, $matches ) ) {
					$DBMcheck = __('Update Time', 'bulletproof-security');
				} else {
					$DBMcheck = __('N/A', 'bulletproof-security');
				}
			break;
		}
		
	if ( $DBMcheck == 'N/A' ) {
		$DBMcheck = '<strong><font color="red">'.__('N/A - Update Time', 'bulletproof-security').'</font></strong>';
		$frequency = '<strong><font color="red">'.__('N/A', 'bulletproof-security').'</font></strong>';
		$next_check = '<strong><font color="red">'.__('N/A', 'bulletproof-security').'</font></strong>';
	} else {
		$frequency = $DBMoptions['bps_db_monitor_cron_frequency'].__(' Minutes', 'bulletproof-security');
		$next_check = $actual_cron_schedule_time;	
	}
	
	echo '<td>'.$value->bps_table_name.'</td>';
	echo '<td>'.$DBMcheck.'</td>';
	echo '<td>'.$frequency.'</td>';		
	echo '<td>'.$next_check.'</td>'; 	
	echo '</tr>';
	}
	}
	
	if ( $wpdb->num_rows == 0 ) {		
	echo '<td>'.__('The DB Monitor checks for any new DB Tables created in your database every 15 minutes by default. Before using the Dynamic DB Form to add any/all DB Tables to be monitored please click the DB Monitor Read Me help button.', 'bulletproof-security').'</td>';
	echo '<td>'.__('N/A', 'bulletproof-security').'</td>';
	echo '<td>'.__('N/A', 'bulletproof-security').'</td>';
	echo '<td>'.__('N/A', 'bulletproof-security').'</td>';		
	echo '</tr>';		
	}

	echo '</tbody>';
	echo '</table>';
	echo '</div>';	
	}
}
bpsPro_DB_Monitor_status();
?>

    </td>
  </tr>
  <tr>
    <td colspan="2" class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-2" class="bps-tab-page">
<h2><?php _e('DB Monitor Log', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('DB Monitor Log', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('DB Monitor Log', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('DB Monitor Log General Information', 'bulletproof-security').'</strong><br>'.__('Your DB Monitor Log file is a plain text static file and not a dynamic file or dynamic display to keep your website resource usage at a bare minimum and keep your website performance at a maximum. Log entries are logged in descending order by Date and Time. You can copy, edit and delete this plain text file. You can choose S-Monitor Email Alerting & Log File Options to automatically email your DB Monitor Log file to you and delete it when it reaches a certain size (256KB, 500KB or 1MB).', 'bulletproof-security').'<strong><br><br>'.__('What is Logged in The DB Monitor Log?', 'bulletproof-security').'</strong><br>'.__('Depending on your DB Monitor settings, log entries will be logged anytime the DB Monitor Cron sees a change or modification to any of your database tables or a new database table is created in your database. The name of the database table, a timestamp and what changed are logged. When you submit the Dynamic DB Form your DB Monitor settings are logged/saved.', 'bulletproof-security').'<strong><br><br>'.__('DB Monitor Log File Size', 'bulletproof-security').'</strong><br>'.__('Displays the size of your DB Monitor Log file. If your log file is larger than 2MB then you will see a Red warning message displayed: The S-Monitor Email Alerting & Log File Options will only send log files up to 2MB in size. Copy and paste the DB Monitor Log file contents into a Notepad text file on your computer and save it. Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'<br><br><strong>'.__('DB Monitor Log Last Modified Time', 'bulletproof-security').'</strong><br>'.__('DB Monitor Log Alerts are displayed when a new DB Monitor log entry (some and not all log entries) is made in your DB Monitor Log file. When this happens your Last Modified Time in File: time stamp will be different than your Last Modified Time in DB: time stamp. In order to clear the DB Monitor Log Alert and synchronize/reset your DB and File time stamps so they are the same, click the Reset Last Modified Time in DB button.', 'bulletproof-security').'<br><br><strong>'.__('Delete Log Button', 'bulletproof-security').'</strong><br>'.__('Clicking the Delete Log button will delete the entire contents of your DB Monitor Log File. If you have setup S-Monitor Email Alerting & Log Options then the only time you would probably need to use the Delete Log button is if your DB Monitor Log file exceeds 2MB in size.', 'bulletproof-security'); echo $text; ?></p>
</div>

<?php

// Get the Current / Last Modifed Date of the DBM Log File
function bpsPro_DBM_Log_LastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset);
	return $last_modified;
	}
}

// String comparison of DBM DB Last Modified Time and Actual File Last Modified Time
function bpsPro_DBM_ModTimeDiff() {
$options = get_option('bulletproof_security_options_DBM_log');
$last_modified_time = bpsPro_DBM_Log_LastMod();
$last_modified_time_db = $options['bps_dbm_log_date_mod'];
	
	if ( $options['bps_dbm_log_date_mod'] == '' ) {
		$text = '<font color="red" style="padding-right:5px;"><strong>'.__('Click the Reset Last Modified Time in DB button', 'bulletproof-security').'<br>'.__('to set the', 'bulletproof-security').'</strong></font>';
		echo $text;
	}
	
	if ( strcmp( $last_modified_time, $last_modified_time_db ) == 0 ) { // 0 is equal
		$text = '<font color="green" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	
	} else {
	
		$text = '<font color="red" style="padding-right:8px;"><strong>'.__('Last Modified Time in DB:', 'bulletproof-security').' </strong></font>';
		echo $text;
	}
}

// Get File Size of the DBM Log File
function bpsPro_DBM_LogSize() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';

if ( file_exists($filename) ) {
	$logSize = filesize($filename);
	
	if ( $logSize < 2097152 ) {
 		$text = '<strong>'. __('DBM Log File Size: ', 'bulletproof-security').'<font color="#2ea2cc">'. round($logSize / 1024, 2) .' KB</font></strong><br><br>';
		echo $text;
	} else {
 		$text = '<strong>'. __('DBM Log File Size: ', 'bulletproof-security').'<font color="red">'. round($logSize / 1024, 2) .' KB<br>'.__('The S-Monitor Email Logging options will only send log files up to 2MB in size.', 'bulletproof-security').'</font></strong><br>'.__('Copy and paste the DBM Log file contents into a Notepad text file on your computer and save it.', 'bulletproof-security').'<br>'.__('Then click the Delete Log button to delete the contents of this Log file.', 'bulletproof-security').'<br><br>';		
		echo $text;
	}
	}
}
bpsPro_DBM_LogSize();

?>

<form name="DBMLogModDate" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_DBM_log'); ?> 
	<?php $DBMLogoptions = get_option('bulletproof_security_options_DBM_log'); ?>
    <label for="QLog"><strong><?php _e('DB Monitor Log Last Modified Time:', 'bulletproof-security'); ?></strong></label><br />
	<label for="QLog"><strong><?php echo bpsPro_DBM_ModTimeDiff(); ?></strong><?php echo $DBMLogoptions['bps_dbm_log_date_mod']; ?></label><br />
	<label for="QLog"><strong><?php _e('Last Modified Time in File:', 'bulletproof-security'); ?></strong></label>
    <input type="text" name="bulletproof_security_options_DBM_log[bps_dbm_log_date_mod]" style="color:#2ea2cc;font-size:13px;width:200px;padding-left:4px;font-weight:bold;border:none;background:none;outline:none;-webkit-box-shadow:none;box-shadow:none;-webkit-transition:none;transition:none;" value="<?php echo bpsPro_DBM_Log_LastMod(); ?>" /><br />
	<input type="submit" name="Submit-DBM-Mod" class="button bps-button" style="margin:10px 0px 0px 0px;" value="<?php esc_attr_e('Reset Last Modified Time in DB', 'bulletproof-security') ?>" />
</form>

<?php
if ( isset($_POST['Submit-Delete-DBM-Log'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_delete_dbm_log' );

$options = get_option('bulletproof_security_options_DBM_log');
$last_modified_time_db = $options['bps_dbm_log_date_mod'];
$time = strtotime($last_modified_time_db); 
$DBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$DBMLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
	
	if ( copy($DBMLogMaster, $DBMLog) ) {
		touch($DBMLog, $time);	
	}
}
?>

<form name="DeleteDBMLogForm" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bulletproof_security_delete_dbm_log'); ?>
<p class="submit">
<input type="submit" name="Submit-Delete-DBM-Log" value="<?php esc_attr_e('Delete Log', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php $text = __('Clicking OK will delete the contents of your DB Monitor Log file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Delete the DB Monitor Log file contents or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</form>

<div id="messageinner" class="updatedinner" style="width:690px;">
<?php

// Get DBM log file contents
//function bps_get_arcm_log() {
function bpsPro_DBM_get_contents() {
	
	if ( current_user_can('manage_options') ) {
$dbm_log = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);

	if ( file_exists($dbm_log) ) {
		$dbm_log = file_get_contents($dbm_log);
		return htmlspecialchars($dbm_log);
	
	} else {
	
	_e('The DB Monitor Log File Was Not Found! Check that the file really exists here - /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/logs/db_monitor_log.txt and is named correctly.', 'bulletproof-security');
	}
	}
}

// Form - ARCM Error Log - Perform File Open and Write test - If append write test is successful write to file
if ( current_user_can('manage_options') ) {
$dbm_log = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$write_test = "";
	
	if ( is_writable($dbm_log) ) {
    if ( ! $handle = fopen($dbm_log, 'a+b' ) ) {
    exit;
    }
    
	if ( fwrite($handle, $write_test) === FALSE ) {
	exit;
    }
	
	$text = '<font color="green"><strong>'.__('File Open and Write test successful! Your DB Monitor Log file is writable.', 'bulletproof-security').'</strong></font><br>';
	echo $text;
	}
	}
	
	if ( isset( $_POST['Submit-DBM-Log'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_save_dbm_log' );
		$newcontentdbm = stripslashes( $_POST['newcontentdbm'] );
	
	if ( is_writable($dbm_log) ) {
		$handle = fopen($dbm_log, 'w+b');
		fwrite($handle, $newcontentdbm);
	$text = '<font color="green"><strong>'.__('Success! Your DB Monitor Log file has been updated.', 'bulletproof-security').'</strong></font><br>';
	echo $text;	
    fclose($handle);
	}
}
$scrolltodbmlog = isset($_REQUEST['scrolltodbmlog']) ? (int) $_REQUEST['scrolltodbmlog'] : 0;
?>
</div>

<div id="QLogEditor">
<form name="DBMLog" id="DBMLog" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-2" method="post">
<?php wp_nonce_field('bulletproof_security_save_dbm_log'); ?>
<div id="DBMLog">
    <textarea class="bps-text-area-600x700" name="newcontentdbm" id="newcontentdbm" tabindex="1"><?php echo bpsPro_DBM_get_contents(); ?></textarea>
	<input type="hidden" name="scrolltodbmlog" id="scrolltodbmlog" value="<?php echo esc_html($scrolltodbmlog); ?>" />
    <p class="submit">
	<input type="submit" name="Submit-DBM-Log" class="button bps-button" value="<?php esc_attr_e('Update File', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#DBMLog').submit(function(){ $('#scrolltodbmlog').val( $('#newcontentdbm').scrollTop() ); });
	$('#newcontentdbm').scrollTop( $('#scrolltodbmlog').val() ); 
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
<h2><?php _e('DB Diff Tool', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('DB Diff Tool', 'bulletproof-security'); ?>  <button id="bps-open-modal3" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
<div id="bps-modal-content3" title="<?php _e('DB Diff Tool', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('DB Diff Tool Guide & Troubleshooting: http://forum.ait-pro.com/forums/topic/db-diff-tool/', 'bulletproof-security').'</strong><br><br><strong>'.__('What is the DB Diff Tool used for?', 'bulletproof-security').'</strong><br>'.__('The DB Diff Tool compares old database tables from DB backups to current database tables and displays any differences in the data/content of those 2 database tables. The DB Diff Tool allows you to check your WordPress Database if you receive a DB Monitor email alert and do not recognize the database table name change/modification. The DB Monitor email alert contains an attached zip file of your DB Monitor Log file. In that attached log file you will see the database name that was changed/modified. Example: DB Table Name: xxxxxx_usermeta. You would enter a DB Backup file name and the DB Table name in the DB Diff Tool Form to compare/check exactly what was changed/modified and click the Run Diff Comparison button to get search comparison results for exactly what was changed/modified in that particular database table. You can of course check your DB Monitor Log file directly by going to the DB Monitor Log tab page.', 'bulletproof-security').'<br><br><strong>'.__('What if the DB Diff Tool finds malicious code or I do not understand or am unsure about the search comparison results?', 'bulletproof-security').'</strong><br>'.__('Remain calm. Most likely the change/modification to your database is legitimate and is NOT something malicious. If you unsure about the search comparison results then post the search comparison results from box 1 and 3 in this Forum Topic:  http://forum.ait-pro.com/forums/topic/db-diff-tool/ and we will let you know what the search comparison results mean. If the change/modification to your database table is malicious then you have the advantage. The hacker does not know that you have been alerted by the BPS Pro DB Monitor IDS. This Forum Topic:  http://forum.ait-pro.com/forums/topic/db-diff-tool/ contains step by step instructions on what steps you need to do. Remain calm. Most likely the change/modification to your database is legitimate and is NOT something malicious.', 'bulletproof-security').'<br><br><strong>'.__('Small Data|File Comparison Tool - Limitations', 'bulletproof-security').'</strong><br>'.__('Max Limitation: 500 DB Rows x 4 = 2000 lines of content/data (sql dump format) compared. See the Large Data|File Comparison Tool - Limitations, Steps & Information help section for limitations and steps for how to use the Large Data|File Comparison Tool.', 'bulletproof-security').'<br><br><strong>'.__('How to read and understand the search comparison results', 'bulletproof-security').'</strong><br>'.__('Two files are created for comparison when you enter the DB Backup file name and the DB Table name that you want to compare for differences in those two files. What is being compared for any differences is an older DB Table to your website\'s current DB Table. The DB Diff Tool takes the contents of the 2 files to compare and puts them into [key] => value Arrays for comparison. This basically creates a "Table of Contents". The keys [1] are the line numbers of the contents of the files and the values are what has changed on that line number of the files.', 'bulletproof-security').'<br><br>'.__('1. Current DB Table Difference (This is what has changed).  This search results box shows the results of comparing the two files for any differences. This is the contents of your current DB Table since the contents of this file are your website\'s current DB Table name that you chose in the DB Diff Tool Form.', 'bulletproof-security').'<br><br>'.__('3. Previous DB Table Difference (This is what existed previously). This search results box shows the results of comparing the two files for any differences. This is the contents of your old DB Table since the contents of this file are your old DB Table name that is extracted from the DB Backup file name that you chose in the DB Diff Tool Form.', 'bulletproof-security').'<br><br>'.__('2. Current DB Table Diff File. This search results box shows the entire contents of the DB Table name that you entered in the DB Diff Tool Form. This is your website\'s current DB Table contents for the DB Table name that you entered in the DB Diff Tool Form.', 'bulletproof-security').'<br><br>'.__('4. Previous DB Table Diff File. This search results box shows the entire contents of the DB Table name that you entered in the DB Diff Tool Form. This is your website\'s older DB Table contents for the DB Table name that you entered in the DB Diff Tool Form. This file is created by extracting your old DB Table name from the DB Backup file name that you entered in the DB Diff Tool Form.', 'bulletproof-security').'<br><br><strong>'.__('Example Usage:', 'bulletproof-security').'</strong><br>'.__('Let\'s say I received a DB Monitor email alert that a database change has occurred and I want to use the DB Diff Tool to find out exactly what was changed/modified in my database. The example DB Table name that was changed/modified in the DB Monitor email alert is: 74ibuq_options.', 'bulletproof-security').'<br><br>'.__('For simplicity sake I will refer to the search results boxes as search box 1, search box 2, etc. I will use an example search result to make this easier to understand. I have made 1 database change and changed 1 value for this example. I have changed the avatar_rating value from G to X in my example database.', 'bulletproof-security').'<br><br>'.__('I enter a DB Backup file name and the DB Table name: 74ibuq_options in the DB Diff Tool Form and click the Run Diff Comparison button to compare an older DB backup file to my current website\'s database. ', 'bulletproof-security').'<br><br>'.__('In search box 1 I have this search result: ', 'bulletproof-security').'[130] =>  VALUES ( 61, \'avatar_rating\', \'X\', \'yes\' ); '.__('This is the new database table value that has been changed/modified.', 'bulletproof-security').'<br>'.__('In search box 3 I have this search result: ', 'bulletproof-security').'[130] =>  VALUES ( 61, \'avatar_rating\', \'G\', \'yes\' ); '.__('This is the old database table value that existed previously.', 'bulletproof-security').'<br><br>'.__('Now to cross reference which DB fields/columns go with these values (you do not necessarily need to cross reference values, but it is good to understand the full intended usage for all search boxes (1,2,3,4):', 'bulletproof-security').'<br><br>'.__('In search box 2 I will look for key [130] or line number [130] and if I look at line number [129] it shows me the DB Table name and the fields/columns that go with these values.', 'bulletproof-security').'<br>[129] => INSERT INTO 74ibuq_options ( option_id, option_name, option_value, autoload )<br>[130] =>  VALUES ( 61, \'avatar_rating\', \'X\', \'yes\' );<br><br>'.__('The DB Table name is: 74ibuq_options', 'bulletproof-security').'<br>'.__('The fields/columns are: option_id, option_name, option_value, autoload', 'bulletproof-security').'<br>'.__('The values that are entered into the fields/columns are: 61, \'avatar_rating\', \'X\', \'yes\'', 'bulletproof-security').'<br>'.__('The value that goes with field/column "option_value" is X.', 'bulletproof-security').'<br><br>'.__('In search box 4 I will look for key [130] or line number [130] and if I look at line number [129] it shows me the DB Table name and the fields/columns that go with these values.', 'bulletproof-security').'<br>[129] => INSERT INTO 74ibuq_options ( option_id, option_name, option_value, autoload )<br>[130] =>  VALUES ( 61, \'avatar_rating\', \'G\', \'yes\' );<br><br><strong>'.__('Large Data|File Comparison Tool - Limitations, Steps & Information', 'bulletproof-security').'</strong><br><br><strong>'.__('Max Limitations Testing (PHP, Server, Memory, etc.):', 'bulletproof-security').'</strong><br>'.__('Overall each line of content/data contained very little data.', 'bulletproof-security').'<br>'.__('25,000 x 2 = 50,000 lines of data/content compared failed. Server ran out of available memory and crashed.', 'bulletproof-security').'<br>'.__('20,000 x 2 = 40,000 lines of data/content compared was successful. Server was able to process and compare the data/content successfully.', 'bulletproof-security').'<br><br><strong>'.__('Max Safe Limits:', 'bulletproof-security').'</strong><br>'.__('Large testing Database Table used in Safe Max Limit testing. Overall each line of content/data contained a large amount of data. No Server memory issues or other problems occurred after extensively stress testing comparing this amount of content/data in numerous/various scenarios and conditions.', 'bulletproof-security').'<br>'.__('PHP Configuration Memory Limit: 128M', 'bulletproof-security').'<br>'.__('Actual large testing DB Table Size: 7.33 MB/7,506 KB', 'bulletproof-security').'<br>'.__('Dump/Extraction DB Table Size in sql Format: 8.2MB', 'bulletproof-security').'<br>'.__('Total content/data compared: 16.4MB (8.2MB x 2 of content/data in each text area box)', 'bulletproof-security').'<br>'.__('Total lines of content/data compared: 24,174 lines of content/data (12,087 x 2 lines of content/data in each text area box)', 'bulletproof-security').'<br><br><strong>'.__('Notes:', 'bulletproof-security').'</strong><br>'.__('- You are comparing a current Database Table to an older Database Table and NOT comparing an entire Database. A Database is made up of several Database Tables within that Database.', 'bulletproof-security').'<br>'.__('- It can take several seconds for a Paste to complete when Copying and Pasting a large amount of data/content into the text area boxes.', 'bulletproof-security').'<br>'.__('- It took 15 seconds for a Paste to complete when Copying and Pasting 8.2MB of data/content into a text area box.', 'bulletproof-security').'<br>'.__('- It took 36 seconds to process & compare: 16.4MB of content/data (8.2MB x 2 of content/data in each text area box) & 24,174 lines of content/data total (12,087 x 2 lines of content/data in each text area box).', 'bulletproof-security').'<br>'.__('- You can make edits to refine the data/content in each text area box if needed before clicking the Run Large Diff Comparison button so that the format/structure matches. In order to compare the content/data successfully, the start and end points of the content/data must match exactly.', 'bulletproof-security').'<br>'.__('- The data/content will remain in the text area boxes after clicking the Run Large Diff Comparison button. You can make edits to the content/data in the text area boxes and run another comparison. If you leave the main DB Monitor page the data/content will no longer be in the text area boxes and you will have to copy and paste new data/content into the text area boxes again.', 'bulletproof-security').'<br>'.__('- This tool could be used to compare other data, but that format/structure of the data/content must match and the data/content would have to prepped first and have \r\n carriage returns/newlines/line breaks added to all the lines of content/data to compare before attempting to compare that data/content. You can use Notepad++ to do that prep work on the data/content and insert/replace line breaks/newlines/carriage returns: http://stackoverflow.com/questions/10668044/how-to-break-lines-at-a-specific-character-in-notepad', 'bulletproof-security').'<br>'.__('- The DB Status & Info page Show Table Status|Size tool displays the total size and rows of each Database Table in your database. The number of Rows x 2 in each DB Table will be the number of lines of content/data that is compared in each text area box. The total number of lines of content/data being compared in both text area boxes would be Rows x 4.', 'bulletproof-security').'<br><br><strong>'.__('Large Data|File Comparison Tool Steps', 'bulletproof-security').'</strong><br>'.__('1. Run the Small to Medium Data|File Comparison tool first to create your files. The Small to Medium Data|File Comparison tool comparison will fail if you are trying to compare too much data/content at one time, but a necessary file is created that you can use to compare data/content in the Large Data|File Comparison tool.', 'bulletproof-security').'<br>'.__('2. Diff Files are created in this folder:  /wp-content/bps-backup/backups_xxxxxxxxx/db-diff/.  Download the Diff files from this folder.', 'bulletproof-security').'<br><br><strong>'.__('Example Diff file name and zip backup file to download:', 'bulletproof-security').'</strong><br>'.__('xxxxx_some_table_name-current.sql - This file contains your current database table that you entered in the "DB Table name" text box in the Small to Medium Data|File Comparison tool form. Download the zip backup file (if you download and save your zip backup files regularly to your computer (recommended) then use that zip file that you already previously downloaded) for the zip backup file name that you entered in the "DB Backup file name" text box in the Small to Medium Data|File Comparison tool form.', 'bulletproof-security').'<br><br>'.__('3. Download and install the Notepad++ free application on your computer:  http://notepad-plus-plus.org/download/. It is a plain text and code editor application that shows line numbers, which makes it easy for you to see how much content/data is in each file that you open in Notepad++, line by line. Open the xxxxx_some_table_name-current.sql file and your zip backup [DB Name].sql file in Notepad++.', 'bulletproof-security').'<br><br>'.__('4. Copy and Paste your data/content to compare into each text area box.', 'bulletproof-security').'<br>'.__('- If you are comparing an entire current DB Table that is 12,000 lines or less - Copy from BEGIN Table xxxxx_some_table_name to END Table xxxxx_some_table_name from the xxxxx_some_table_name-current.sql file and paste it into text area box 1.', 'bulletproof-security').'<br>'.__('- If you are comparing an entire old DB Table that is 12,000 lines or less - Copy from BEGIN Table xxxxx_some_table_name to END Table xxxxx_some_table_name from the zip backup [DB Name].sql file and paste it into text area box 2.', 'bulletproof-security').'<br>'.__('- If you are comparing more than 12,000 lines of content/data per text area box then if you use Notepad++ you can edit your downloaded files and add a placeholder at 12,000 lines of content/data so that after comparing the first 12,000 lines of content/data from each file you can then go back to your placeholder and copy lines 12,001 to lines 24,000 into the text area boxes to compare that data/content. You would do this for both your current database table file and your old database dump file.  An average database table is typically going to have much less than 12,000 lines of content/data.', 'bulletproof-security').'<br><br>'.__('5. Click the Run Large Diff Comparison button.', 'bulletproof-security'); echo $text; ?></p>
</div>

<h3><?php _e('Small to Medium Data|File Comparison', 'bulletproof-security'); ?></h3>

<?php
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {	

	// Universal DB Backup Options GET
	$DBBackupOptions = get_option('bulletproof_security_options_db_backup');

// IMPORTANT: This function MUST be above the DB Diff Tool Form
// DB Diff Tool Dump: Creates the {/db-diff/xxxxxx_options-current.sql} dump file of the current 
// DB Table name that is entered in the Form for comparison with an old DB Backup file that has been extracted.
function bpsPro_db_diff_dump( $db_diff_dump, $tables ) {
global $wpdb;

	$handle = fopen( $db_diff_dump, 'wb' );

	if ( $handle )

	fwrite( $handle, "-- -------------------------------------------\n" );
	fwrite( $handle, "-- BulletProof Security Pro DB Diff Tool\n" );
	fwrite( $handle, "-- Support: http://forum.ait-pro.com/\n" );
	fwrite( $handle, "-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n" );
	fwrite( $handle, "-- THIS IS NOT A DB BACKUP FILE\n" );
	fwrite( $handle, "-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n" );
	fwrite( $handle, "-- -------------------------------------------\n\n" );

	if ( ! empty( $tables ) )

		foreach ( $tables as $table_array ) {
		
			$table = current( $table_array );
			$create = $wpdb->get_var( "SHOW CREATE TABLE " . $table, 1 );
			$myisam = strpos( $create, 'MyISAM' );

			fwrite( $handle, "--\n-- BEGIN Table " . $table . "\n--\n\nDROP TABLE IF EXISTS `" . $table . "`;\n/*!40101 SET @saved_cs_client     = @@character_set_client */;\n/*!40101 SET character_set_client = '" . DB_CHARSET . "' */;\n" . $create . ";\n/*!40101 SET character_set_client = @saved_cs_client */;\n\n" );

			$data = $wpdb->get_results("SELECT * FROM `" . $table . "` LIMIT 1000", ARRAY_A );
		
		if ( ! empty( $data ) ) {
			
			fwrite( $handle, "LOCK TABLES `" . $table . "` WRITE;\n" );
			
			if ( false !== $myisam )
				
				fwrite( $handle, "/*!40000 ALTER TABLE `".$table."` DISABLE KEYS */;\n\n" );

			$offset = 0;
			
			do {
				foreach ( $data as $entry ) {
					foreach ( $entry as $key => $value ) {
						if ( NULL === $value )
							$entry[$key] = "NULL";
						elseif ( "" === $value || false === $value )
							$entry[$key] = "''";
						elseif ( !is_numeric( $value ) )
							$entry[$key] = "'" . esc_sql($value) . "'";
					}
					fwrite( $handle, "INSERT INTO `" . $table . "` ( " . implode( ", ", array_keys( $entry ) ) . " )\n VALUES ( " . implode( ", ", $entry ) . " );\n" );
				}

				$offset += 1000;
				$data = $wpdb->get_results("SELECT * FROM `" . $table . "` LIMIT " . $offset . ",1000", ARRAY_A );
			
			} while ( ! empty( $data ) );

			fwrite( $handle, "\n--\n-- END Table " . $table . "\n--\n" );
			
		if ( false !== $myisam )
			fwrite( $handle, "\n/*!40000 ALTER TABLE `" . $table . "` ENABLE KEYS */;" );
			fwrite( $handle, "\nUNLOCK TABLES;\n\n" );
		}
	}
	fclose( $handle );
}

	echo '<div id="DBD-Diff-Tool-Form" style="float:left;margin:0px 30px 30px 0px;">';

	// Scrollbox: DB Backup Files to choose from for Diff comparison
	$source = $DBBackupOptions['bps_db_backup_folder'];

	if ( is_dir($source) ) {
		
		$iterator = new DirectoryIterator($source);
			
		echo '<strong><font color="#2ea2cc">'.__('DB Backup Files to choose from for Diff comparison:', 'bulletproof-security').'</font></strong>';
		echo '<div id="DB-Diff-1" style="margin:0px 0px 10px 0px;padding:5px;overflow:auto;width:290px;height:100px;border:1px solid black;">';
		
		foreach ( $iterator as $file ) {
			
			if ( $file->isFile() && $file->getFilename() != '.htaccess' ) {
				echo $file->getFilename().'<br>';
			}
		}
		echo '</div>';
	}

	// Form: DB Diff Tool - Small to Medium Data|File Comparison	
	echo '<form name="DBD-Diff-Tool" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_dbd_diff_tool');
	echo '<label for="bps-dbd">'.__('Copy & paste the DB Backup file name from the', 'bulletproof-security').'</label><br>';
	echo '<label for="bps-dbd">'.__('list above (including the .zip extension) to compare:', 'bulletproof-security').'</label><br>';
	echo '<input type="text" name="DBDExtractor" class="regular-text-short-fixed" style="width:300px;margin:0px 0px 10px 0px;" value="" /><br>';
	echo '<label for="bps-dbd">'.__('Enter the DB Table name from the db-monitor-log.zip', 'bulletproof-security').'</label><br>';
	echo '<label for="bps-dbd">'.__('file or your DB Monitor Log file log entry to compare:', 'bulletproof-security').'</label><br>';
	echo '<label for="bps-dbd"><font color="#2ea2cc"><strong>'.__('Example DB Table Name: ', 'bulletproof-security').$wpdb->base_prefix.'options</strong></font></label><br>';
	echo '<input type="text" name="DBDTableName" class="regular-text-short-fixed" style="width:300px;margin:0px 0px 0px 0px;" value="" />';
	echo "<p><input type=\"submit\" name=\"Submit-DBD-Diff-Tool\" value=\"".__('Run Diff Comparison', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"DBDiffSmall()\" /></p></form>";
	echo '</div>';
	
	echo '<div id="DBD-Diff-Tool-Table" style="float:left;width:500px;margin:5px 0px 0px 0px;">';	

	if ( isset( $_POST['Submit-DBD-Diff-Files'] ) || isset( $_POST['Submit-DBD-Diff-Tool'] ) ) {
	
	echo '<div id="DB-Diff-Table-Refresh-Button" style="margin:0px 0px 20px 0px;">';
	echo '<form name="DB-Diff-Table-Refresh" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_db_diff_table_refresh');
	echo "<p><input type=\"submit\" name=\"Submit-DB-Prefix-Table-Refresh\" value=\"".__('Refresh|Reload Table', 'bulletproof-security')."\" class=\"button bps-button\" /></p></form>";
	echo '</div>';	
	
	}
	
	// Form: Delete Diff Files table
	echo '<form name="bpsDBDDeleteDiffFiles" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-3" method="post">';
	wp_nonce_field('bulletproof_security_db_diff_delete_files');

	$source_diff = $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/';
	
	if ( is_dir($source_diff) ) {
		
		$iterator_diff = new DirectoryIterator($source_diff);

	echo '<div id="DBDDeleteDiffFilescheckall" style="margin:0px 0px 20px 0px;float:left;overflow:auto;width:500px;height:200px;border:1px solid black;">';
	echo '<strong><div style="margin:20px 0px -20px 100px;font-size:1.13em;color:#2ea2cc;">'.__('Delete Diff Files Table', 'bulletproof-security').'</div></strong>';	
	echo '<table style="text-align:left;padding:5px;">'; // border-right:1px solid black;
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:10px;font-size:1em;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('All', 'bulletproof-security').'</strong><br><input type="checkbox" class="checkallDeleteDiffFiles" /></th>';
	echo '<th scope="col" style="width:490px;font-size:1.13em;padding-top:20px;border-bottom:1px solid black;background-color:transparent;"><strong>'.__('Diff File', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';		

		$invisible = 'No';
		
		foreach ( $iterator_diff as $diff_file ) {
			
			if ( $diff_file->isFile() ) {
					
				$invisible = 'Yes';
				
				echo "<td><input type=\"checkbox\" id=\"deletedifffile\" name=\"DBDdifffiles[".$diff_file->getFilename()."]\" value=\"deletedifffile\" class=\"deletedifffileALL\" /></td>";
				echo '<th scope="row" style="border-bottom:none;">'.$diff_file->getFilename().'</th>';
				echo '</tr>';			
			}
		}
	
		if ( $invisible == 'No' ) {
			echo '<td></td>';			
			echo '<th scope="row" style="border-bottom:none;">'.__('No Diff Files to delete.', 'bulletproof-security').'</th>';
			echo '</tr>';
		}
	
	echo '</tbody>';
	echo '</table>';
	echo '</div>';		
	}

	echo "<p><input type=\"submit\" name=\"Submit-DBD-Diff-Files\" value=\"".__('Delete Diff Files', 'bulletproof-security')."\" class=\"button bps-button\" onclick=\"return confirm('".__('Click OK to Delete Diff Files or click Cancel', 'bulletproof-security')."')\" /></p></form>";

	echo '</div>';	

?>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
    $('.checkallDeleteDiffFiles').click(function() {
        $(this).parents('#DBDDeleteDiffFilescheckall:eq(0)').find('.deletedifffileALL:checkbox').attr('checked', this.checked);
    });
});
/* ]]> */
</script>

<?php

// Form Processing: Delete Diff Files Form
if ( isset( $_POST['Submit-DBD-Diff-Files'] ) && current_user_can('manage_options') ) {
	check_admin_referer('bulletproof_security_db_diff_delete_files');
	
	$DBD_Diff_Files = $_POST['DBDdifffiles'];

	switch( $_POST['Submit-DBD-Diff-Files'] ) {
		case __('Delete Diff Files', 'bulletproof-security'):
		
		$delete_files = array();
		
		if ( ! empty( $DBD_Diff_Files ) ) {
			
			foreach ( $DBD_Diff_Files as $key => $value ) {
				
				if ( $value == 'deletedifffile' ) {
					$delete_files[] = $key;
					
				}
			}
		}
			
		if ( ! empty( $delete_files ) ) {
			
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

			foreach ( $delete_files as $delete_file ) {
				
				unlink( $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/' . $delete_file );
				$textDelete = '<strong><font color="green">'.__('Diff File: ', 'bulletproof-security').$delete_file.__(' has been deleted successfully.', 'bulletproof-security').'</font><strong><br>';
				echo $textDelete;

			}
				$text = '<p><font color="blue"><strong>'.__('Click the Refresh|Reload Table button to refresh the Delete Diff Files Table.', 'bulletproof-security').'</strong></font></p>';
				echo $text;
			echo '</p></div>';	
		}
		break;
	}
}

// Form Processing: DB Table comparisons - DB Diff Tool Extracts DB Backup zip file table & dumps current table & compares them for differences
if ( isset( $_POST['Submit-DBD-Diff-Tool'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_dbd_diff_tool' );

	$time_start = microtime( true );

	$DBDTableName = trim( $_POST['DBDTableName'] );
	$DBDExtractor = trim( $_POST['DBDExtractor'] );
	$DBDExtractor_str = str_replace( '.zip', "-", $DBDExtractor );
	$previous_backup_zip = $DBBackupOptions['bps_db_backup_folder'] . '/' . $DBDExtractor;	
	$unzipped_file_name = $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/' . DB_NAME . '.sql';
	$renamed_file_name = $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/' . $DBDExtractor_str . $DBDTableName .'-previous.sql';	

	if ( ! preg_match( '/(.*)\.zip/', $DBDExtractor, $matches ) || $DBDExtractor == '' || $DBDTableName == '' ) {
		$text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><font color="red"><strong>'.__('Error: Either you did not enter anything for the DB Backup file name or the DB Table name or you did not include the .zip file extension for the DB Backup file name to compare.', 'bulletproof-security').'</strong></font></p></div>';
		echo $text;	
	
	} else {
	
		echo '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;">';

		if ( class_exists('ZipArchive') ) {	
	
			$DBZip = new ZipArchive;
	
			if ( $DBZip->open( $previous_backup_zip ) === TRUE ) {
 
			if ( $DBZip->extractTo( $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/' ) ) {
				$DBZip->close();
				
				$unzipped_file = file_get_contents($unzipped_file_name);
				$table_contents_header = "-- -------------------------------------------\n-- BulletProof Security Pro DB Diff Tool\n-- Support: http://forum.ait-pro.com/\n-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n-- THIS IS NOT A DB BACKUP FILE\n-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n-- -------------------------------------------\n\n";
				$pattern = "/BEGIN\sTable\s".$DBDTableName."(?s).*END\sTable\s".$DBDTableName."/";
				$table_contents_raw = preg_match( $pattern, $unzipped_file, $table_matches );
				$table_contents = $table_matches[0];
				
				if ( ! $handle = fopen( $renamed_file_name, "wb" ) ) {
       				$text = '<p><font color="red"><strong>'.__('Error: Unable to create file ', 'bulletproof-security').$renamed_file_name.__(' Check that the DB Backup folder exists and that the folder permissions or Ownership allow file writing.', 'bulletproof-security').'</strong></font></p>';
					echo $text;
    			}
    			
				if ( fwrite( $handle, $table_contents_header.$table_contents ) === FALSE ) {
        			$text = '<p><font color="red"><strong>'.__('Error: Unable to write to file ', 'bulletproof-security').$renamed_file_name.__(' Check that the DB Backup folder exists and that the folder permissions or Ownership allow file writing.', 'bulletproof-security').'</strong></font></p>';
					echo $text;
    			}
    			fclose($handle);
				
				$text = '<p><font color="green"><strong>'.__('DB Table: ', 'bulletproof-security').$DBDTableName.__(' Zip Extraction From DB Backup File Successful.', 'bulletproof-security').'<br>'.__('Extracted Diff filename: ', 'bulletproof-security').$renamed_file_name.'</strong></font></p>';
				echo $text;
				
				@unlink($unzipped_file_name);
 	
			} else {
	
				$text = '<p><font color="red"><strong>'.__('Error: DB Table Zip Extraction Failed. Did you enter a correct/valid DB Backup file name?', 'bulletproof-security').'</strong></font></p>';
				echo $text;
			}
			}
		
		} else { // Use PCLZip if ZipArchive class is not installed
		
			define( 'PCLZIP_TEMPORARY_DIR', $DBBackupOptions['bps_db_backup_folder'] . '/' );
			require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
			if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
				$previous_encoding = mb_internal_encoding();
				mb_internal_encoding( 'ISO-8859-1' );
			}	

			$archive = new PclZip( $previous_backup_zip );
  		
			if ( $archive->extract( PCLZIP_OPT_PATH, $DBBackupOptions['bps_db_backup_folder'] . '/db-diff', PCLZIP_OPT_REMOVE_PATH, $DBBackupOptions['bps_db_backup_folder'] . '/db-diff' ) ) {

  				$unzipped_file = file_get_contents($unzipped_file_name);
				$table_contents_header = "-- -------------------------------------------\n-- BulletProof Security Pro DB Diff Tool\n-- Support: http://forum.ait-pro.com/\n-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n-- THIS IS NOT A DB BACKUP FILE\n-- DO NOT IMPORT THIS FILE INTO YOUR DATABASE\n-- -------------------------------------------\n\n";
				$pattern = "/BEGIN\sTable\s".$DBDTableName."(?s).*END\sTable\s".$DBDTableName."/";
				$table_contents_raw = preg_match( $pattern, $unzipped_file, $table_matches );
				$table_contents = $table_matches[0];
				
				if ( ! $handle = fopen( $renamed_file_name, "wb" ) ) {
       				$text = '<p><font color="red"><strong>'.__('Error: Unable to create file ', 'bulletproof-security').$renamed_file_name.__(' Check that the DB Backup folder exists and that the folder permissions or Ownership allow file writing.', 'bulletproof-security').'</strong></font></p>';
					echo $text;
    			}
    			
				if ( fwrite( $handle, $table_contents_header.$table_contents ) === FALSE ) {
        			$text = '<p><font color="red"><strong>'.__('Error: Unable to write to file ', 'bulletproof-security').$renamed_file_name.__(' Check that the DB Backup folder exists and that the folder permissions or Ownership allow file writing.', 'bulletproof-security').'</strong></font></p>';
					echo $text;
    			}
    			fclose($handle);
				
				$text = '<p><font color="green"><strong>'.__('DB Table: ', 'bulletproof-security').$DBDTableName.__(' Zip Extraction From DB Backup File Successful.', 'bulletproof-security').'<br>'.__('Extracted Diff filename: ', 'bulletproof-security').$renamed_file_name.'</strong></font></p>';
				echo $text;
 				
				@unlink($unzipped_file_name);
			
			} else {
	
				$text = '<p><font color="red"><strong>'.__('Error: DB Table Zip Extraction Failed. Did you enter a correct/valid DB Backup file name?', 'bulletproof-security').'</strong></font></p>';
				echo $text;
			}
		} // end if ( class_exists('ZipArchive') ) {

		// DUMP Current DB Table: to {/db-diff/xxxxxx_options-current.sql}
		$build_query = "SHOW TABLES FROM `".DB_NAME."` WHERE `Tables_in_".DB_NAME."` LIKE '".$DBDTableName."'";
		$tables = $wpdb->get_results( $build_query, ARRAY_A );
		$db_diff_dump = $DBBackupOptions['bps_db_backup_folder'] . '/db-diff/' . $DBDTableName . '-current.sql';					
		
		if ( ! file_exists( $db_diff_dump ) ) {
			
			bpsPro_db_diff_dump( $db_diff_dump, $tables );
			
			$text = '<p><font color="green"><strong>'.__('DB Table: ', 'bulletproof-security').$DBDTableName.__(' Dump From Current DB Table Successful.', 'bulletproof-security').'<br>'.__('Dumped Diff filename: ', 'bulletproof-security').$db_diff_dump.'</strong></font></p>';
			echo $text;
		}
	
		$text = '<p><font color="blue"><strong>'.__('After you are done using the DB Diff Tool, click the Refresh|Reload Table button displayed above the Delete Diff Files Table  to check for any Diff Files that need to be deleted. Delete all Diff Files by clicking on the All checkbox and clicking the Delete Diff Files button.', 'bulletproof-security').'</strong></font></p>';
		echo $text;
		echo '</div>';
		
		// Form Results: DB Diff Tool Results based on created files - single for now - multiple maybe later
		if ( file_exists($db_diff_dump) && file_exists($renamed_file_name) ) {	
		
		$previous_backup_contents = file_get_contents($renamed_file_name);
		$current_backup_contents = file_get_contents($db_diff_dump);
		$search_pattern = "/BEGIN\sTable\s".$DBDTableName."(?s).*END\sTable\s".$DBDTableName."/";
		$previous_backup_contents_match = preg_match( $search_pattern, $previous_backup_contents, $previous_matches );
		$current_backup_contents_match = preg_match( $search_pattern, $current_backup_contents, $current_matches );
		$array_previous = preg_split( "/\r\n|\n|\r/", htmlspecialchars($previous_matches[0]) );
		$array_current = preg_split( "/\r\n|\n|\r/", htmlspecialchars($current_matches[0]) );
		$result_current = array_diff( $array_current, $array_previous );
		$result_previous = array_diff( $array_previous, $array_current );
		
		echo '<div id="DBDResults" style="margin-top:19px;float:left;width:100%;">';
		echo '<h3>'.__('DB Diff Tool Comparison Results for DB Table: ', 'bulletproof-security').'<font color="#2ea2cc">'.$DBDTableName.'</font></h3>';
		echo '<h3>'.__('DB Backup file name Used in Comparison: ', 'bulletproof-security').'<font color="#2ea2cc">'.$DBDExtractor.'</font></h3>';
		if ( empty( $result_previous ) && $array_previous[0] == '') {
		echo '<h3><font color="blue">'.__('No comparison results for Previous DB Table Difference. There was too much data/content to compare successfully. Use the Large Data|File Comparison Tool. Click the DB Diff Tool Read Me help button for instructions on how to use the Large Data|File Comparison Tool.', 'bulletproof-security').'</font></h3>';
		} else {		
		echo '<h3><font color="#2ea2cc">'.__('Notes: ', 'bulletproof-security').'</font></h3>';
		echo '<p>'.__('The search comparison results look complicated, but actually they are not. The DB Diff Tool Read Me help button contains help information on how to read and understand the DB Diff Tool search comparison results. The search comparison results are only displayed once after clicking the Run Diff Comparison button. If you leave the main DB Monitor page then you will need to click the Run Diff Comparison button again to get new search comparison results. You can copy and paste search comparison results to a file on your computer and save them if you want to run multiple different search comparisons. By doing that you can compare multiple different search comparison results.', 'bulletproof-security').'</font></p>';
		}
		echo '<table style="text-align:left;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="font-size:1.13em;border-bottom:1px solid black;background-color:transparent;"><strong><font color="#2ea2cc">'.__('1. ', 'bulletproof-security').'</font>'.__('Current DB Table Difference (This is what has changed)', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="font-size:1.13em;border-bottom:1px solid black;background-color:transparent;"><strong><font color="#2ea2cc">'.__('2. ', 'bulletproof-security').'</font>'.__('Current DB Table Diff File', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		echo '<td>';
		echo '<pre style="width:600px;height:200px;">';
		print_r($result_current); // array_filter later possibly
		echo '</pre>';		
		echo '</td>';
		echo '<td>';
		echo '<pre style="width:600px;200px;">';
		print_r($array_current);
		echo '</pre>';		
		echo '</td>';		
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';
		echo '</div>';

		echo '<table style="text-align:left;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="font-size:1.13em;padding-top:10px;border-bottom:1px solid black;background-color:transparent;"><strong><font color="#2ea2cc">'.__('3. ', 'bulletproof-security').'</font>'.__('Previous DB Table Difference (This is what existed previously)', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="font-size:1.13em;padding-top:10px;border-bottom:1px solid black;background-color:transparent;"><strong><font color="#2ea2cc">'.__('4. ', 'bulletproof-security').'</font>'.__('Previous DB Table Diff File', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		echo '<td>';
		echo '<pre style="width:600px;height:200px;">';
		print_r($result_previous);
		echo '</pre>';		
		echo '</td>';
		echo '<td>';
		echo '<pre style="width:600px;200px;">';
		print_r($array_previous);
		echo '</pre>';		
		echo '</td>';		
		echo '</tr>';		
		
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		}
	} // end if ( !preg_match( '/(.*)\.zip/', $DBDExtractor, $matches )...

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}
} // end if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' )...
?>

<h3 style="clear:both;"><?php _e('Large Data|File Comparison', 'bulletproof-security'); ?></h3>

<?php 
$scrolltoDBDiff1 = isset($_REQUEST['scrolltoDBDiff1']) ? (int) $_REQUEST['scrolltoDBDiff1'] : 0;
$scrolltoDBDiff2 = isset($_REQUEST['scrolltoDBDiff2']) ? (int) $_REQUEST['scrolltoDBDiff2'] : 0;

$contentdbdiff1 = ( isset( $_POST['contentdbdiff1'] ) ) ? $_POST['contentdbdiff1'] : '';
$contentdbdiff2 = ( isset( $_POST['contentdbdiff2'] ) ) ? $_POST['contentdbdiff2'] : '';
?>		
  
<div id="QLogEditor">

<form name="DBDiffLarge" id="DBDiffLarge" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bulletproof_security_dbd_large'); ?>
<div id="DBDiffLarge" style="vertical-align:top;">

<table width="100%" border="1">
	<tr>
    <td style="padding:5px;font-weight:bold;width:50%;">
	<?php echo '<font color="#2ea2cc">'.__('1. ', 'bulletproof-security').'</font>'.__('Copy & paste up to a maximum of 12,000 lines of matching DB Table content/data from your xxxxx_some_table_name-current.sql file that you want to compare.', 'bulletproof-security').'<br>'.__('For full instructions on how to use this tool click the DB Diff Tool Read Me help button.', 'bulletproof-security');?>
    </td>
    <td style="padding:5px;font-weight:bold;width:50%;">
	<?php echo '<font color="#2ea2cc">'.__('2. ', 'bulletproof-security').'</font>'.__('Copy & paste up to a maximum of 12,000 lines of matching DB Table content/data from the DB Backup file that you want to compare.', 'bulletproof-security').'<br>'.__('For full instructions on how to use this tool click the DB Diff Tool Read Me help button.', 'bulletproof-security');?>
    </td>
    </tr> 
	<tr>
    <td>
    <textarea class="bps-text-area-db-diff" name="contentdbdiff1" id="contentdbdiff1" tabindex="1"><?php echo $contentdbdiff1; ?></textarea>
    <input type="hidden" name="scrolltoDBDiff1" id="scrolltoDBDiff1" value="<?php echo esc_html($scrolltoDBDiff1); ?>" />
    </td>
    <td>
	<textarea class="bps-text-area-db-diff" name="contentdbdiff2" id="contentdbdiff2" tabindex="2"><?php echo $contentdbdiff2; ?></textarea>
    <input type="hidden" name="scrolltoDBDiff2" id="scrolltoDBDiff2" value="<?php echo esc_html($scrolltoDBDiff2); ?>" />
	</td>
	</tr>
</table>
	<input type="submit" name="Submit-DBD-Diff-Large" class="button bps-button" style="margin:20px 0px 20px 0px;" value="<?php esc_attr_e('Run Large Diff Comparison', 'bulletproof-security') ?>" onclick="DBDiffLarge()" />
</div>
</form>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#DBDiffLarge').submit(function(){ $('#scrolltoDBDiff1').val( $('#contentdbdiff1').scrollTop() ); });
	$('#contentdbdiff1').scrollTop( $('#scrolltoDBDiff1').val() ); 
});
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#DBDiffLarge').submit(function(){ $('#scrolltoDBDiff2').val( $('#contentdbdiff2').scrollTop() ); });
	$('#contentdbdiff2').scrollTop( $('#scrolltoDBDiff2').val() ); 
});
/* ]]> */
</script>
</div>
    
<?php
	if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' ) && current_user_can('manage_options') ) {	

	if ( isset( $_POST['Submit-DBD-Diff-Large'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_dbd_large' );

		$time_start = microtime( true );

		$current_large_contents = $_POST['contentdbdiff1'];
		$previous_large_contents = $_POST['contentdbdiff2'];
		
		// cannot use str_split because i need to match line breaks - str_split($str); is faster
		$array_large_previous = preg_split( "/\r\n|\n|\r/", htmlspecialchars($previous_large_contents) );
		$array_large_current = preg_split( "/\r\n|\n|\r/", htmlspecialchars($current_large_contents) );
		$result_large_current = array_diff( $array_large_current, $array_large_previous );
		$result_large_previous = array_diff( $array_large_previous, $array_large_current );

		echo '<div id="DBDLargeResults" style="margin-top:19px;float:left;width:100%;">';
		//echo '<h3>'.__('DB Diff Tool Results for DB Table: ', 'bulletproof-security').'<font color="blue">'.$DBDTableName.'</font></h3>';
		echo '<h3><font color="blue">'.__('Notes: ', 'bulletproof-security').'</font></h3>';
		echo '<p>'.__('The search comparison results look complicated, but actually they are not. The DB Diff Tool Read Me help button contains help information on how to read and understand the DB Diff Tool search comparison results. The Large Diff Comparison tool leaves the data/content you copied and pasted in the text area boxes if you need to modify the data/content and run another comparison. If you leave the main DB Monitor page then you will need to copy new content/data into the text area boxes and click the Run Large Diff Comparison button again to get new search comparison results. You can copy and paste search comparison results to a file on your computer and save them if you want to run multiple different search comparisons. By doing that you can compare multiple different search comparison results.', 'bulletproof-security').'</font></p>';		
		echo '<table style="text-align:left;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="font-size:1.13em;border-bottom:1px solid black;background-color:transparent;"><strong><font color="blue">'.__('1. ', 'bulletproof-security').'</font>'.__('Current DB Table Difference (This is what has changed)', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="font-size:1.13em;border-bottom:1px solid black;background-color:transparent;"><strong><font color="blue">'.__('2. ', 'bulletproof-security').'</font>'.__('Current DB Table Diff File', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		echo '<td>';
		echo '<pre style="width:600px;height:200px;">';
		print_r($result_large_current); // array_filter later possibly
		echo '</pre>';		
		echo '</td>';
		echo '<td>';
		echo '<pre style="width:600px;200px;">';
		print_r($array_large_current);
		echo '</pre>';		
		echo '</td>';		
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';
		echo '</div>';

		echo '<table style="text-align:left;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="font-size:1.13em;padding-top:10px;border-bottom:1px solid black;background-color:transparent;"><strong><font color="blue">'.__('3. ', 'bulletproof-security').'</font>'.__('Previous DB Table Difference (This is what existed previously)', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="font-size:1.13em;padding-top:10px;border-bottom:1px solid black;background-color:transparent;"><strong><font color="blue">'.__('4. ', 'bulletproof-security').'</font>'.__('Previous DB Table Diff File', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';

		echo '<td>';
		echo '<pre style="width:600px;height:200px;">';
		print_r($result_large_previous);
		echo '</pre>';		
		echo '</td>';
		echo '<td>';
		echo '<pre style="width:600px;200px;">';
		print_r($array_large_previous);
		echo '</pre>';		
		echo '</td>';		
		echo '</tr>';		
		
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
	
		$time_end = microtime( true );
		$run_time = $time_end - $time_start;
		$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		echo bpsPro_memory_resource_usage();
		echo $time_display;
		echo '</p></div>';	
	}
	} // end if ( is_admin() && wp_script_is( 'bps-accordion', $list = 'queue' )...
?>
<br />

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>

<div id="bps-tabs-4" class="bps-tab-page">
<h2><?php _e('DB Status & Info ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('General DB Info is Displayed by Default. The Extensive DB Info Buttons Show Additional DB Info', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('DB Status & Info', 'bulletproof-security'); ?>  <button id="bps-open-modal4" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content4" title="<?php _e('DB Status & Info', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('General DB Info', 'bulletproof-security').'</strong><br>'.__('Shows general help info and status info about your WordPress database at a glance.', 'bulletproof-security').'<br><br><strong>'.__('Extensive DB Info', 'bulletproof-security').'</strong><br>'.__('Clicking each Extensive DB button will display extensive information about your WordPress Database.', 'bulletproof-security').'<strong><br><br>'.__('SHOW PRIVILEGES: http://dev.mysql.com/doc/refman/5.7/en/show-privileges.html', 'bulletproof-security').'</strong><br>'.__('Shows the list of system privileges that the MySQL server supports. The exact list of privileges depends on the version of your server.', 'bulletproof-security').'<br><br><strong>'.__('SHOW TABLE STATUS|SIZE: http://dev.mysql.com/doc/refman/5.7/en/show-table-status.html', 'bulletproof-security').'</strong><br>'.__('Shows extensive info about each DB Table and additionally Table Size has been added to show the size of each DB Table.', 'bulletproof-security').'<strong><br><br>'.__('SHOW STORAGE ENGINES:  http://dev.mysql.com/doc/refman/5.7/en/show-engines.html', 'bulletproof-security').'</strong><br>'.__('Displays status information about the server\'s storage engines. This is particularly useful for checking whether a storage engine is supported, or to see what the default engine is.', 'bulletproof-security').'<strong><br><br>'.__('SHOW FULL PROCESSLIST: http://dev.mysql.com/doc/refman/5.7/en/show-processlist.html', 'bulletproof-security').'</strong><br>'.__('Shows you which threads are running. If you have the PROCESS privilege, you can see all threads. Otherwise, you can see only your own threads (that is, threads associated with the MySQL account that you are using). If you do not use the FULL keyword, only the first 100 characters of each statement are shown in the Info field.', 'bulletproof-security').'<strong><br><br>'.__('SHOW GLOBAL STATUS & SHOW SESSION STATUS: http://dev.mysql.com/doc/refman/5.7/en/show-status.html', 'bulletproof-security').'</strong><br>'.__('Provides server status information. This statement does not require any privilege. It requires only the ability to connect to the server. With the GLOBAL modifier, SHOW STATUS displays the status values for all connections to MySQL. With SESSION, it displays the status values for the current connection. If no modifier is present, the default is SESSION. LOCAL is a synonym for SESSION.', 'bulletproof-security').'<strong><br><br>'.__('SHOW GLOBAL VARIABLES & SHOW SESSION VARIABLES: http://dev.mysql.com/doc/refman/5.7/en/show-variables.html', 'bulletproof-security').'</strong><br>'.__('Shows the values of MySQL system variables. This statement does not require any privilege. It requires only the ability to connect to the server. With the GLOBAL modifier, SHOW VARIABLES displays the values that are used for new connections to MySQL. In MySQL 5.7, if a variable has no global value, no value is displayed. With SESSION, SHOW VARIABLES displays the values that are in effect for the current connection. If no modifier is present, the default is SESSION. LOCAL is a synonym for SESSION.', 'bulletproof-security'); echo $text; ?></p>
</div>

<table width="100%" border="1">
  <tr>
    <td width="60%">
	<?php echo '<h3 style="padding-left:10px;font-weight:bold;">'.__('General DB Info', 'bulletproof-security').'</h3>'; ?></td>
    <td width="40%" colspan="2"><?php echo '<h3 style="padding-left:10px;font-weight:bold;">'.__('Extensive DB Info', 'bulletproof-security').'</h3>'; ?>
    </td>
  </tr>
  <tr>
    <td>

<?php
	// General DB Info
	echo '<div id="IXR-Check" style="float:left;overflow:auto;width:98.2%;height:260px;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	echo '<div id="DB-status-general" style="float:left;padding-right:20px;">';
	$text = '<strong><font color="blue">'.__('General DB Info', 'bulletproof-security').'</font></strong><br>';
	echo $text;
	
	bpsPro_db_total_size();
	
	$sql_version = 'version';
	$sqlversion = $wpdb->get_var( $wpdb->prepare("SELECT VERSION() AS %s", $sql_version ) );
	
	$text = '<font color="black"><strong>'.__('MySQL DB Server Version: ', 'bulletproof-security').'</strong>'.$sqlversion.'<br><strong>'.__('MySQL DB Server: ', 'bulletproof-security').'</strong>'.DB_HOST.'<br><strong>'.__('Your MySQL Database: ', 'bulletproof-security').'</strong>'.DB_NAME.'</font><br>';
	echo $text;
	
	bpsPro_show_global_status_general_info_extended();

	if ( function_exists('mysql_connect') ) {
		$text = '<font color="black"><strong>'.__('MySQL Extension: ', 'bulletproof-security').'</strong>'.__('Installed/Enabled', 'bulletproof-security').'</font><br>';
		echo $text;
	} else {
		$text = '<font color="black"><strong>'.__('MySQL Extension: ', 'bulletproof-security').'</strong>'.__('NOT Installed/Enabled', 'bulletproof-security').'</font><br>';		
		echo $text;
	}
	if ( function_exists('mysqli_connect') ) {
		$text = '<font color="black"><strong>'.__('MySQLi Extension: ', 'bulletproof-security').'</strong>'.__('Installed/Enabled', 'bulletproof-security').'</font><br>';
		echo $text;
	} else {
		$text = '<font color="black"><strong>'.__('MySQLi Extension: ', 'bulletproof-security').'</strong>'.__('NOT Installed/Enabled', 'bulletproof-security').'</font><br>';		
		echo $text;
	}

	echo '</div>';
	
	echo '<div id="DB-status-global" style="float:left;padding-right:20px;">';
	bpsPro_show_global_status_general();
	echo '</div>';
	
	echo '<div id="DB-status-session" style="float:left;">';
	bpsPro_show_session_status_general();
	echo '</div>';
	
	echo '</div>'; 
 
?>    
    
    </td>
    <td align="center">    
    
    <form name="DB-show-privileges" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_privileges'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-privileges" class="button bps-button" value="<?php esc_attr_e('SHOW PRIVILEGES', 'bulletproof-security') ?>" />
	</p>
    </form>  

    <form name="DB-show-engines" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_engines'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-engines" class="button bps-button" value="<?php esc_attr_e('SHOW STORAGE ENGINES', 'bulletproof-security') ?>" />
	</p>
    </form>

    <form name="DB-show-global-status" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_global_status'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-global-status" class="button bps-button" value="<?php esc_attr_e('SHOW GLOBAL STATUS', 'bulletproof-security') ?>" />
	</p>
    </form>

    <form name="DB-show-global-variables" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_global_variables'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-global-variables" class="button bps-button" value="<?php esc_attr_e('SHOW GLOBAL VARIABLES', 'bulletproof-security') ?>" />
	</p>
    </form>

	</td>
    <td align="center">
     
    <form name="DB-show-table-status-size" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_table_status_size'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-table-status-size" class="button bps-button" value="<?php esc_attr_e('SHOW TABLE STATUS|SIZE', 'bulletproof-security') ?>" />
	</p>
    </form>     
     
     <form name="DB-show-full-processlist" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_full_processlist'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-full-processlist" class="button bps-button" value="<?php esc_attr_e('SHOW FULL PROCESSLIST', 'bulletproof-security') ?>" />
	</p>
    </form>  
	
    <form name="DB-show-session-status" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_session_status'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-session-status" class="button bps-button" value="<?php esc_attr_e('SHOW SESSION STATUS', 'bulletproof-security') ?>" />
	</p>
    </form>    
    
    <form name="DB-show-session-variables" action="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bulletproof_security_DB_show_session_variables'); ?>
	<p>
    <input type="submit" name="Submit-DB-show-session-variables" class="button bps-button" value="<?php esc_attr_e('SHOW SESSION VARIABLES', 'bulletproof-security') ?>" />
	</p>
    </form>    
    
    </td>
  </tr>
  <tr>
    <td>
<?php

	// Results: Display Form Titles
	if ( isset( $_POST['Submit-DB-show-global-status'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW GLOBAL STATUS', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-session-status'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW SESSION STATUS', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-engines'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW STORAGE ENGINES', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-table-status-size'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW TABLE STATUS|SIZE', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-global-variables'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW GLOBAL VARIABLES', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-session-variables'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW SESSION VARIABLES', 'bulletproof-security').'</h3>';
	}
	elseif ( isset( $_POST['Submit-DB-show-full-processlist'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW FULL PROCESSLIST', 'bulletproof-security').'</h3>';		
	}
	elseif ( isset( $_POST['Submit-DB-show-privileges'] ) && current_user_can('manage_options') ) {
		echo '<h3 style="padding-left:10px;font-weight:bold;"><font color="#2ea2cc">'.__('Results: ', 'bulletproof-security').'</font>'.__('SHOW PRIVILEGES', 'bulletproof-security').'</h3>';		

	} else { 

		echo '<h4 style="padding-left:10px;font-weight:bold;">'.__('Extensive DB Info Will Be Displayed Here After Clicking Extensive DB Info Buttons', 'bulletproof-security').'</h4>';
	}

?>    
    
    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>
<?php

// Extensive DB Info functions for buttons displayed here border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;
echo '<div id="XDBInfo" style="float:left;overflow:auto;width:100%;max-height:400px;">';
bpsPro_show_table_status_size();
bpsPro_show_global_status();
bpsPro_show_session_status();
bpsPro_show_engines();
bpsPro_show_global_variables();
bpsPro_show_session_variables();
bpsPro_show_full_processlist();
bpsPro_show_privileges();
echo '</div>';
?>    
   
    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<br />
<?php
// Get the DB Total Size in MB & KB
function bpsPro_db_total_size() {
global $wpdb;
	
	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) && preg_match( '/page=bulletproof-security/', $_SERVER['REQUEST_URI'], $matches ) && current_user_can('manage_options') ) {

$rows = 0;
$size = 0;
$result = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Rows >= %d", $rows ) );

	foreach ( $result as $data ) {
		$size += $data->Data_length + $data->Index_length;
	}
	
	$mbytes = number_format( $size / ( 1024 * 1024 ), 2 );
	$kbytes = number_format( $size / ( 1024 ) );
	$text = '<font color="black"><strong>'.__('DB Total Size is: ', 'bulletproof-security').'</strong>'. $mbytes . __(' MB / ', 'bulletproof-security').$kbytes.__(' KB', 'bulletproof-security').'</font><br>';
	echo $text;
	}
}
	
	
// Static Display: General DB Info - Show Global DB status for limited Variable_name variables
// Note: The correct math is Queries / Uptime & NOT Questions / Uptime for BOTH GLOBAL & SESSION
// Questions are client connections ONLY & you always want the total number of queries whether
// you are looking at GLOBAL or SESSION - Questions & Queries will be the same when checking GLOBAL Status
function bpsPro_show_global_status_general() {
global $wpdb;
	
	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) && preg_match( '/page=bulletproof-security/', $_SERVER['REQUEST_URI'], $matches ) && current_user_can('manage_options') ) {

$uptime = 'Uptime';
$threads = 'Threads';
$queries = 'Queries';
$slow_queries = 'Slow_queries';
$questions = 'Questions';
$opened_tables = 'Opened_tables';
$open_tables = 'Open_tables';
$flush_commands = 'Flush_commands';
$queries_avg_sec = 0;
$queries_avg_min = 0;

$result = $wpdb->get_results( $wpdb->prepare( "SHOW GLOBAL STATUS WHERE (Variable_name = %s) OR (Variable_name LIKE %s) OR (Variable_name = %s) OR (Variable_name LIKE %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name LIKE %s)", $uptime, "$threads%", $queries, "%$slow_queries%", $questions, $opened_tables, $open_tables, "%$flush_commands%" ) );

	$text = '<strong><font color="blue">'.__('SHOW GLOBAL DB Status', 'bulletproof-security').'</font></strong><br>';
	echo $text;	

	foreach ( $result as $data ) {

		if ( $data->Variable_name == 'Uptime' ) {
			$Uptime = '<strong>'.$data->Variable_name.': </strong>';
			$uptime_sec = $data->Value;
		}		
		if ( $data->Variable_name == 'Queries' ) {
			$Queries = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
			$queries_sec = $data->Value;
		}
		if ( $data->Variable_name == 'Slow_queries' ) {
			$Slow_queries = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Questions' ) {
			$Questions = '<strong>'.$data->Variable_name.' (clients): </strong>'. $data->Value.'<br>';
		}		
		if ( $data->Variable_name == 'Flush_commands' ) {
			$Flush_commands = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_connected' ) {
			$Threads_connected = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_running' ) {
			$Threads_running = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_created' ) {
			$Threads_created = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_cached' ) {
			$Threads_cached = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Open_tables' ) {
			$Open_tables = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Opened_tables' ) {
			$Opened_tables = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
	}
	
	$queries_avg_sec = number_format( $queries_sec / $uptime_sec, 2 );
	$queries_avg_min = number_format( $queries_sec / $uptime_sec, 2 ) * 60;
	$uptime_hour_min_sec = gmdate("H:i:s", $uptime_sec);
	$text = '<font color="black">'.$Uptime.$uptime_hour_min_sec.'<br>'.$Queries.'<strong>'.__('Queries per Second: ', 'bulletproof-security') .'</strong>'. $queries_avg_sec.'<br><strong>'.__('Queries per Minute: ', 'bulletproof-security') .'</strong>'. $queries_avg_min.'<br>'.$Slow_queries.$Questions.$Flush_commands.$Threads_connected.$Threads_running.$Threads_created.$Threads_cached.$Open_tables.$Opened_tables.'</font>';

	echo $text;
	}
}

// Static Display: SHOW SESSION DB Status - Show SESSION DB status for limited Variable_name variables
// Note: The correct math is Queries / Uptime & NOT Questions / Uptime for BOTH GLOBAL & SESSION
// Questions are client connections ONLY & you always want the total number of queries whether
// you are looking at GLOBAL or SESSION - Questions & Queries will be the same when checking GLOBAL Status
function bpsPro_show_session_status_general() {
global $wpdb;

	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) && preg_match( '/page=bulletproof-security/', $_SERVER['REQUEST_URI'], $matches ) && current_user_can('manage_options') ) {

$uptime = 'Uptime';
$threads = 'Threads';
$queries = 'Queries';
$slow_queries = 'Slow_queries';
$questions = 'Questions';
$opened_tables = 'Opened_tables';
$open_tables = 'Open_tables';
$flush_commands = 'Flush_commands';
$queries_avg_sec = 0;
$queries_avg_min = 0;

$result = $wpdb->get_results( $wpdb->prepare( "SHOW SESSION STATUS WHERE (Variable_name = %s) OR (Variable_name LIKE %s) OR (Variable_name = %s) OR (Variable_name LIKE %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name LIKE %s)", $uptime, "$threads%", $queries, "%$slow_queries%", $questions, $opened_tables, $open_tables, "%$flush_commands%" ) );

	$text = '<strong><font color="blue">'.__('SHOW SESSION DB Status', 'bulletproof-security').'</font></strong><br>';
	echo $text;	

	foreach ( $result as $data ) {

		if ( $data->Variable_name == 'Uptime' ) {
			$Uptime = '<strong>'.$data->Variable_name.': </strong>';
			$uptime_sec = $data->Value;
		}		
		if ( $data->Variable_name == 'Queries' ) {
			$Queries = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
			$queries_sec = $data->Value;
		}
		if ( $data->Variable_name == 'Slow_queries' ) {
			$Slow_queries = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Questions' ) {
			$Questions = '<strong>'.$data->Variable_name.' (clients): </strong>'. $data->Value.'<br>';
		}		
		if ( $data->Variable_name == 'Flush_commands' ) {
			$Flush_commands = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_connected' ) {
			$Threads_connected = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_running' ) {
			$Threads_running = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_created' ) {
			$Threads_created = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Threads_cached' ) {
			$Threads_cached = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Open_tables' ) {
			$Open_tables = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'Opened_tables' ) {
			$Opened_tables = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
	}
	
	$queries_avg_sec = number_format( $queries_sec / $uptime_sec, 2 );
	$queries_avg_min = number_format( $queries_sec / $uptime_sec, 2 ) * 60;
	$uptime_hour_min_sec = gmdate("H:i:s", $uptime_sec);
	$text = '<font color="black">'.$Uptime.$uptime_hour_min_sec.'<br>'.$Queries.'<strong>'.__('Queries per Second: ', 'bulletproof-security') .'</strong>'. $queries_avg_sec.'<br><strong>'.__('Queries per Minute: ', 'bulletproof-security') .'</strong>'. $queries_avg_min.'<br>'.$Slow_queries.$Questions.$Flush_commands.$Threads_connected.$Threads_running.$Threads_created.$Threads_cached.$Open_tables.$Opened_tables.'</font>';

	echo $text;
	}
}

// Static Display: General DB Info - Extended - SHOW GLOBAL VARIABLES DB status for limited Variable_name variables
function bpsPro_show_global_status_general_info_extended() {
global $wpdb;
	
	if ( wp_script_is( 'bps-accordion', $list = 'queue' ) && preg_match( '/page=bulletproof-security/', $_SERVER['REQUEST_URI'], $matches ) && current_user_can('manage_options') ) {

$hostname = 'hostname';
$hostname_ip = '';
$port = 'port';
$max_user_connections = 'max_user_connections';
$max_connections = 'max_connections';
$connect_timeout = 'connect_timeout';
$storage_engine = 'storage_engine';

$result = $wpdb->get_results( $wpdb->prepare( "SHOW GLOBAL VARIABLES WHERE (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s) OR (Variable_name = %s)", $hostname, $port, $max_user_connections, $max_connections, $connect_timeout, $storage_engine ) );

	foreach ( $result as $data ) {

		if ( $data->Variable_name == 'hostname' ) {
			$Hostname = '<strong>'.__('DB ', 'bulletproof-security').$data->Variable_name.': </strong>'. $data->Value.'<br>';
			$hostname_ip = $data->Value;
		}		
		if ( $data->Variable_name == 'port' ) {
			$Port = '<strong>'.__('DB ', 'bulletproof-security').$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'max_user_connections' ) {
			$Max_user_connections = '<strong>'.$data->Variable_name.' (Your Account): </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'max_connections' ) {
			$Max_connections = '<strong>'.$data->Variable_name.' (Server): </strong>'. $data->Value.'<br>';
		}
		if ( $data->Variable_name == 'connect_timeout' ) {
			$Connect_timeout = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}		
		if ( $data->Variable_name == 'storage_engine' ) {
			$Storage_engine = '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';
		}
	}
	
	$Hostname_ip = gethostbyname($hostname_ip);
	$text = '<font color="black">'.$Hostname.'<strong>'.__('DB hostname IP Address: ', 'bulletproof-security') .'</strong>'. $Hostname_ip.'<br>'.$Port.$Max_user_connections.$Max_connections.$Connect_timeout.$Storage_engine.'</font>';

	echo $text;
	}
}

// Form: SHOW TABLE STATUS - Info about all DB Tables & size of each individual DB table in MB/KB
function bpsPro_show_table_status_size() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-table-status-size'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_table_status_size' );

$rows = 0;
$size = 0;
$result = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Rows >= %d", $rows ) );


	echo '<div id="IXR-Check-Extensive" style="color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';

	foreach ( $result as $data ) {
		
		$size = $data->Data_length + $data->Index_length;
		$mbytes = number_format( $size / ( 1024 * 1024 ), 2 );
		$kbytes = number_format( $size / ( 1024 ) );
		
		$text = '<strong>'.__('Table Name: ', 'bulletproof-security').'</strong>'.$data->Name.'<br><strong>'.__('Table Size: ', 'bulletproof-security').'</strong>'.$mbytes.__(' MB / ', 'bulletproof-security').$kbytes.__(' KB', 'bulletproof-security').'<br><strong>'.__('Engine: ', 'bulletproof-security').'</strong>'.$data->Engine.'<br><strong>'.__('Version: ', 'bulletproof-security').'</strong>'.$data->Version.'<br><strong>'.__('Row Format: ', 'bulletproof-security').'</strong>'.$data->Row_format.'<br><strong>'.__('Rows: ', 'bulletproof-security').'</strong>'.$data->Rows.'<br><strong>'.__('Avg Row Length: ', 'bulletproof-security').'</strong>'.$data->Avg_row_length.'<br><strong>'.__('Data Length: ', 'bulletproof-security').'</strong>'.$data->Data_length.'<br><strong>'.__('Max Data Length: ', 'bulletproof-security').'</strong>'.$data->Max_data_length.'<br><strong>'.__('Index Length: ', 'bulletproof-security').'</strong>'.$data->Index_length.'<br><strong>'.__('Data Free: ', 'bulletproof-security').'</strong>'.$data->Data_free.'<br><strong>'.__('Auto Increment: ', 'bulletproof-security').'</strong>'.$data->Auto_increment.'<br><strong>'.__('Create Time: ', 'bulletproof-security').'</strong>'.$data->Create_time.'<br><strong>'.__('Update Time: ', 'bulletproof-security').'</strong>'.$data->Update_time.'<br><strong>'.__('Check Time: ', 'bulletproof-security').'</strong>'.$data->Check_time.'<br><strong>'.__('Collation: ', 'bulletproof-security').'</strong>'.$data->Collation.'<br><strong>'.__('Checksum: ', 'bulletproof-security').'</strong>'.$data->Checksum.'<br><strong>'.__('Create Options: ', 'bulletproof-security').'</strong>'.$data->Create_options.'<br><strong>'.__('Comment: ', 'bulletproof-security').'</strong>'.$data->Comment.'<br><br>';
		
		echo $text;
	}
	echo '</div>';	
	}
}

// Form: SHOW GLOBAL STATUS
function bpsPro_show_global_status() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-global-status'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_global_status' );

$blank = '';
$result = $wpdb->get_results( $wpdb->prepare( "SHOW GLOBAL STATUS WHERE Variable_name != %s", $blank ) );

	echo '<div id="IXR-Check-Extensive" style="color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	foreach ( $result as $data ) {

		echo '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';	
	}
	echo '</div>';
	}
}

// Form: SHOW SESSION STATUS
function bpsPro_show_session_status() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-session-status'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_session_status' );

$blank = '';
$result = $wpdb->get_results( $wpdb->prepare( "SHOW SESSION STATUS WHERE Variable_name != %s", $blank ) );

	echo '<div id="IXR-Check-Extensive" style="color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	foreach ( $result as $data ) {

		echo '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';	
	}
	echo '</div>';
	}
}

// Form: SHOW STORAGE ENGINES
function bpsPro_show_engines() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-engines'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_engines' );

// This is a non-standard MySQL Table - do not use $wpdb->prepare
$result = $wpdb->get_results( "SHOW STORAGE ENGINES" );

	echo '<div id="IXR-Check-Extensive" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	echo '<table style="text-align:left;color:black;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Engine', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Support', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Comment', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';

	foreach ( $result as $data ) {
		echo '<td>'.$data->Engine.'</td>';	
		echo '<td>'.$data->Support.'</td>';	
		echo '<td>'.$data->Comment.'</td>';	
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	}
}

// Form: SHOW GLOBAL VARIABLES
function bpsPro_show_global_variables() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-global-variables'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_global_variables' );

	$blank = '';
	$result = $wpdb->get_results( $wpdb->prepare( "SHOW GLOBAL VARIABLES WHERE Variable_name != %s", $blank ) );

	echo '<div id="IXR-Check-Extensive" style="max-width:800px;color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	foreach ( $result as $data ) {

		echo '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';	
	}
	echo '</div>';
	}
}

// Form: SHOW SESSION VARIABLES
function bpsPro_show_session_variables() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-session-variables'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_session_variables' );

$blank = '';
$result = $wpdb->get_results( $wpdb->prepare( "SHOW SESSION VARIABLES WHERE Variable_name != %s", $blank ) );

	echo '<div id="IXR-Check-Extensive" style="max-width:800px;color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	foreach ( $result as $data ) {

		echo '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'<br>';	
	}
	echo '</div>';
	}
}

// Form: SHOW FULL PROCESSLIST
function bpsPro_show_full_processlist() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-full-processlist'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_full_processlist' );

// This is a non-standard MySQL Table - do not use $wpdb->prepare
$result = $wpdb->get_results( "SHOW FULL PROCESSLIST" );

	echo '<div id="IXR-Check-Extensive" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	echo '<table style="text-align:left;color:black;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Id', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('User', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Host', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('db', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Command', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Time', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('State', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:12.5%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Info', 'bulletproof-security').'</strong></th>';

	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';

	foreach ( $result as $data ) {
		echo '<td>'.$data->Id.'</td>';	
		echo '<td>'.$data->User.'</td>';	
		echo '<td>'.$data->Host.'</td>';	
		echo '<td>'.$data->db.'</td>';	
		echo '<td>'.$data->Command.'</td>';	
		echo '<td>'.$data->Time.'</td>';	
		echo '<td>'.$data->State.'</td>';	
		echo '<td>'.$data->Info.'</td>';	
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
	}
}

// Form: SHOW PRIVILEGES
function bpsPro_show_privileges() {
global $wpdb;
	
	if ( isset( $_POST['Submit-DB-show-privileges'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_DB_show_privileges' );

// This is a non-standard MySQL Table - do not use $wpdb->prepare
$result = $wpdb->get_results( "SHOW PRIVILEGES" );

	echo '<div id="IXR-Check-Extensive" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px;">';
	
	echo '<table style="text-align:left;color:black;">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Privilege', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Context', 'bulletproof-security').'</strong></th>';
	echo '<th scope="col" style="width:33%;font-size:1em;color:blue;background-color:#ffffe0;"><strong>'.__('Comment', 'bulletproof-security').'</strong></th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	echo '<tr>';

	foreach ( $result as $data ) {
		echo '<td>'.$data->Privilege.'</td>';	
		echo '<td>'.$data->Context.'</td>';	
		echo '<td>'.$data->Comment.'</td>';	
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div>';
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

<div id="bps-tabs-5" class="bps-tab-page">
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
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/" target="_blank"><?php _e('DB Monitor - DBM Guide & Troubleshooting', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/plugin-conflicts-actively-blocked-plugins-plugin-compatibility/" target="_blank"><?php _e('Forum: Search, Troubleshooting Steps & Post Questions For Assistance', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/db-diff-tool/" target="_blank"><?php _e('DB Diff Tool Guide', 'bulletproof-security'); ?></a></td>
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