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

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ UI Theme Skin|Processing Spinner|WP Toolbar', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('Skin|Spinner|Toolbar', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>

<div id="bps-tabs-1" class="bps-tab-page">

<h2><?php _e('UI Theme Skin|Processing Spinner|WP Toolbar ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Blue|Grey|Black UI Theme Skins, Processing Spinner On|Off, WP Toolbar Display', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('UI Theme Skin|Processing Spinner|WP Toolbar', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('UI Theme Skin|Processing Spinner|WP Toolbar', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Select a UI Theme Skin', 'bulletproof-security').'</strong><br>'.__('Select a UI Theme Skin and click the Save Skin button.', 'bulletproof-security').'<br><br><strong>'.__('Notes:', 'bulletproof-security').'</strong><br>&bull; '.__('All elements and CSS properties should automatically be refreshed when you select and save your Theme Skin. If some Theme Skin elements or properties are not displaying correctly, Refresh your Browser.', 'bulletproof-security').'<br><br>&bull; '.__('The Black and Grey UI Theme Skins require WordPress 3.8 or higher. If you have an older version of WordPress (3.7 or below) then ONLY the Blue UI Theme Skin is available.', 'bulletproof-security').'<br><br><strong>'.__('Turn On|Off The Processing Spinner:', 'bulletproof-security').'</strong><br>'.__('The Processing Spinner is displayed during processing of the Forms listed below. The Processing Spinner includes a Cancel button to cancel the Form processing. The Processing Spinner can be turned off if you do not want to see it. If the Processing Spinner is not displaying correctly or at all then either your theme or another plugin is interfering with it. Since the Processing Spinner is just a visual enhancement it is not critical that it is being displayed.', 'bulletproof-security').'<br><br><strong>'.__('Forms That Display The Processing Spinner:', 'bulletproof-security').'</strong><br>'.__('Pre-Installation Wizard, Setup Wizard, DB Backup Job Processing, DB Table Names & Character Length Table, DB Table Prefix Changer, Quarantine Restore or Delete Files, DB Diff Small to Medium Data|File Comparison, DB Diff Large Data|File Comparison, Upload Zip Install: File Upload, P-Security Diagnostic Checks|Recommendations, AutoRestore: All Backup Files Forms, All Delete Files Forms, All Restore Files Forms, All Show Backup Files Forms and All Show Website Files Forms, Pro-Tools: String|Function Finder, String Replacer|Remover, DB String Finder and cURL Scan.', 'bulletproof-security').'<br><br><strong>'.__('WP Toolbar Functionality In BPS Plugin Pages:', 'bulletproof-security').'</strong><br>'.__('This option affects the WP Toolbar in BPS plugin pages ONLY and does not affect the WP Toolbar anywhere else on your site. WP Toolbar additional menu items (nodes) added by other plugins and themes can cause problems for BPS when the WP Toolbar is loaded in BPS plugin pages. This option allows you to load only the default WP Toolbar without any additional menu items (nodes) loading/displayed on BPS plugin pages or to load the WP Toolbar with any/all other menu items (nodes) that have been added by other plugins and themes. The default setting is: Load Only The Default WP Toolbar (without loading any additional menu items (nodes) from other plugins or themes). If the BPS Processing Spinner is not working/displaying correctly then set this option to the default setting: Load Only The Default WP Toolbar.', 'bulletproof-security'); echo $text; ?></p>
</div>

<div id="UI-Theme-Skin" style="width:340px;">
<form name="ui-theme-skin-form" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_theme_skin'); ?> 
	<?php $UIoptions = get_option('bulletproof_security_options_theme_skin'); ?>

	<label for="UI-Skin"><?php _e('Select a UI Theme Skin:', 'bulletproof-security'); ?></label>
<select name="bulletproof_security_options_theme_skin[bps_ui_theme_skin]" style="width:265px;">
<option value="blue" <?php selected('blue', $UIoptions['bps_ui_theme_skin']); ?>><?php _e('Blue|Light Blue|White UI Theme', 'bulletproof-security'); ?></option>
<option value="black" <?php selected('black', $UIoptions['bps_ui_theme_skin']); ?>><?php _e('Black|Dark Grey|Silver UI Theme', 'bulletproof-security'); ?></option>
<option value="grey" <?php selected('grey', $UIoptions['bps_ui_theme_skin']); ?>><?php _e('Grey|Light Grey|Silver|White UI Theme', 'bulletproof-security'); ?></option>
</select>
<input type="submit" name="Submit-UI-Theme-Skin-Options" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Save Skin', 'bulletproof-security') ?>" />
</form>
</div>

<div id="UI-Spinner" style="width:340px;">
<form name="ui-spinner-form" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_spinner'); ?> 
	<?php $UISpinneroptions = get_option('bulletproof_security_options_spinner'); ?>

	<label for="UI-Spinner"><?php _e('Turn On|Off The Processing Spinner:', 'bulletproof-security'); ?></label>
<select name="bulletproof_security_options_spinner[bps_spinner]" style="width:265px;">
<option value="On" <?php selected('On', $UISpinneroptions['bps_spinner']); ?>><?php _e('Turn On Processing Spinner', 'bulletproof-security'); ?></option>
<option value="Off" <?php selected('Off', $UISpinneroptions['bps_spinner']); ?>><?php _e('Turn Off Processing Spinner', 'bulletproof-security'); ?></option>
</select>
<input type="submit" name="Submit-UI-Spinner" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Save Option', 'bulletproof-security') ?>" />
</form>
</div>

<div id="UI-WP-Toolbar" style="width:340px;">
<form name="ui-wp-toolbar-form" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_wpt_nodes'); ?> 
	<?php $UIWPToptions = get_option('bulletproof_security_options_wpt_nodes'); ?>

	<label for="UI-WP-Toolbar"><?php _e('WP Toolbar Functionality In BPS Plugin Pages:', 'bulletproof-security'); ?></label><br />
	<label for="UI-WP-Toolbar" style="color:#2ea2cc;"><?php _e('Click the Read Me help button for information', 'bulletproof-security'); ?></label><br />
<select name="bulletproof_security_options_wpt_nodes[bps_wpt_nodes]" style="width:265px;">
<option value="wpnodesonly" <?php selected('wpnodesonly', $UIWPToptions['bps_wpt_nodes']); ?>><?php _e('Load Only The Default WP Toolbar', 'bulletproof-security'); ?></option>
<option value="allnodes" <?php selected('allnodes', $UIWPToptions['bps_wpt_nodes']); ?>><?php _e('Load WP Toolbar With All Menu Items', 'bulletproof-security'); ?></option>
</select>
<input type="submit" name="Submit-UI-WP-Toolbar" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Save Option', 'bulletproof-security') ?>" />
</form>
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
    <td class="bps-table_cell_help_links">&nbsp;</td>
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