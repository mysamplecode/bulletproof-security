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
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
$bpsSpacePop = '-------------------------------------------------------------';
$bps_topDiv = '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
$bps_bottomDiv = '</p></div>';

// Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Pro Tools', 'bulletproof-security'); ?></h2>

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
function StringFinder() {
	
    var r = confirm("Clicking OK will search for the Search String and the Search Path that you entered.\n\n-------------------------------------------------------------\n\nNote: For faster and better search results, search specific folders. Example: /website-root-path/wp-content/plugins/ \n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function StringReplacerPreview() {
	
    var r = confirm("Clicking OK will replace the string you entered in the Search String text box with the string you entered in the Replacement String text box.\n\n-------------------------------------------------------------\n\nNote: The string replacement that is performed in Preview Mode is only visually replacing the string and is not actually changing or writing a new string.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function StringReplacerWrite() {
	
    var r = confirm("Clicking OK will replace the string you entered in the Search String text box with the string you entered in the Replacement String text box.\n\n-------------------------------------------------------------\n\nNote: If a mistake occurs or something goes wrong there is a log file here /wp-content/bps-backup/logs/string_replacer_log.txt that logs a timestamp, the Search Path, the Search String, the Replacement String, the Original Content before being modified and the File Path and Code Line that was modified.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function DBStringFinder() {
	
    var r = confirm("Clicking OK will search your entire database for the string (text or code) that you entered in the DB Search String text box.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function cURLScanUnlimited() {
	
    var r = confirm("Clicking OK will scan the total number of Posts and Pages that you entered in the Limit Number Of Pages To Scan text box. The default scan is set to scan 50 Pages/Posts\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function cURLScanTwenty() {
	
    var r = confirm("Clicking OK will scan the Post and Page URL's that you entered in the text boxes.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
function cURLScanTen() {
	
    var r = confirm("Clicking OK will scan the Post and Page URL's that you entered using the Search String that you entered.\n\n-------------------------------------------------------------\n\nClick OK to proceed or click Cancel.");
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
			<li><a href="#bps-tabs-1"><?php _e('Online Base64 Decoder', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-2"><?php _e('Offline Base64 Decode|Encode', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-3"><?php _e('Mcrypt Decrypt|Encrypt', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-4"><?php _e('Crypt Encryption', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-5"><?php _e('Scheduled Crons', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-6"><?php _e('String|Function Finder', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-7"><?php _e('String Replacer|Remover', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-8"><?php _e('DB String Finder', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-9"><?php _e('DB Table Cleaner|Remover', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-10"><?php _e('DNS Finder', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-11"><?php _e('Ping Website', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-12"><?php _e('cURL Scan', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-13"><?php _e('Website Headers', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-14"><?php _e('WP Automatic Update', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-15"><?php _e('Plugin Update Check', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-16"><?php _e('XML-RPC Exploit Checker', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-17"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
        </ul>
            
<div id="bps-tabs-1" class="bps-tab-page">

<h2><?php _e('Online Safe - Base64 Decode|Decompress ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('base64_decode, gzinflate, gzuncompress, str_rot13, strrev', 'bulletproof-security'); ?></span></h2>

<?php 
if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { 

    if ( isset( $_POST['Submit-Delete-B64-Online'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_b64_online_delete' );
		$b64_decoder_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php';
		$B64_options = get_option('bulletproof_security_options_b64_tools');  		

		$B64_options_array = array(
		'bps_b64_offline_decoder' 	=> $B64_options['bps_b64_offline_decoder'], 
		'bps_b64_online_decoder' 	=> 'delete'
		);				
		
			foreach( $B64_options_array as $key => $value ) {
				update_option('bulletproof_security_options_b64_tools', $B64_options_array);
			}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The delete Online Base64 Decode Tool database option has been saved or updated.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;

		if ( file_exists($b64_decoder_file) ) {
			unlink($b64_decoder_file);
			
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The Online Base64 Decode Tool has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		
		}
	}

if ( isset( $_POST['Submit-Reset-B64-Online'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_b64_online_reset' );
		
		delete_option('bulletproof_security_options_b64_tools');
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The Online Base64 Decode Tool database option has been reset. Upload the b64-online-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-online-decoder.php to add and use this tool.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}

// Writes current IP Address to .htaccess file on page access / launch if the b64-online-decoder.php file exists
if ( file_exists( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php' ) ) {

// Enable File Downloading for /tools folder - writes a new denyall htaccess file with the current IP address
function bpsToolsHtaccessIP() {
if ( current_user_can('manage_options') ) {
	
	$bps_get_IP2 = $_SERVER['REMOTE_ADDR'];
	$denyall_htaccess_file_tools = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/.htaccess';
	$bps_denyall_content_tools = "order deny,allow\ndeny from all\nallow from $bps_get_IP2";
	
	if ( is_writable($denyall_htaccess_file_tools) ) {
	if ( !$handle = fopen($denyall_htaccess_file_tools, 'w+b') ) {
         exit;
    }
    if ( @fwrite($handle, $bps_denyall_content_tools) === FALSE ) {
        exit;
    }
    $text = '<font color="green"><strong>'.__('Downloading of the B64.zip Archive file is enabled for your IP address only', 'bulletproof-security').' === '. $bps_get_IP2 .'</strong></font>';
	echo $text;
    fclose($handle);
	} else {
    $text = '<div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p><br><strong>'.__('The Tools folder htaccess file', 'bulletproof-security').' >>> <font color="red"> ' . $denyall_htaccess_file_tools . '</font>'.__(' does not exist.', 'bulletproof-security').'</strong></p></div>';
	echo $text;
	}
	}
}
echo bpsToolsHtaccessIP();
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<?php 

	// Delete b64-online-decoder.php file Form: deletes the file and updates the db option with value of "delete" 
	echo '<div id="B64DeleteOnline" style="position:relative;top:0px;left:0px;margin:0px 0px 10px 0px;">';
	echo '<form name="B64DeleteOnlineForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php" method="post">';
	wp_nonce_field('bulletproof_security_b64_online_delete');
	echo '<label for="B64Delete" style="padding-right:5px;font-size:1.2em;font-weight:bold;">'.__('Delete the Online Base64 Decoder Tool:', 'bulletproof-security').'</label>';
	echo '<input type="submit" name="Submit-Delete-B64-Online" style="margin-bottom:-5px;" value="'.esc_attr('Delete', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

	// Reset b64-online-decoder.php file Form: deletes the bulletproof_security_options_b64_tools db option
	echo '<div id="B64DeleteOnline" style="position:relative;top:0px;left:0px;margin:0px 0px 10px 0px;">';
	echo '<form name="B64ResetOnlineForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php" method="post">';
	wp_nonce_field('bulletproof_security_b64_online_reset');
	echo '<label for="B64Delete" style="padding-right:11px;font-size:1.2em;font-weight:bold;">'.__('Reset the Online Base64 Decoder Tool:', 'bulletproof-security').'</label>';
	echo '<input type="submit" name="Submit-Reset-B64-Online" style="margin-bottom:-5px;" value="'.esc_attr('Reset', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

	$B64_options = get_option('bulletproof_security_options_b64_tools');

	if ( $B64_options['bps_b64_online_decoder'] != 'delete' && ! file_exists( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php' ) ) { 
		$text = '<div style="color:#2ea2cc;font-size:16px;margin:20px 0px 20px 0px;">'.__('The Online Base64 Decoder Tool is not included in BPS Pro Pro-Tools by default. The reason for this is a lot of web host scanners, including our own host Go Daddy, falsely detect malicious code in this tool. Please send an email to info@ait-pro.com with the email Subject line "Request for Online/Offline Base64 Decoder/Encoder Tools" to request that the Decoder/Encoder Pro-Tools be sent to you via email. If you want to use/install this tool click the Reset the Online Base64 Decoder Tool: Reset button and then upload the b64-online-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-online-decoder.php.', 'bulletproof-security').'</div>';
		echo $text;
	
	} elseif ( $B64_options['bps_b64_online_decoder'] == 'delete' && ! file_exists( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php' ) ) { 
		$text = '<div style="color:#2ea2cc;font-size:18px;margin:20px 0px 20px 0px;">'.__('The Online Base64 Decoder Tool has been deleted. If you want to use/install this tool click the Reset the Online Base64 Decoder Tool: Reset button and then upload the b64-online-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-online-decoder.php.', 'bulletproof-security').'</div>';
		echo $text;
	
	} else {

		require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php' );
	}
?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>

<div id="bps-tabs-2" class="bps-tab-page">

<h2><?php _e('Offline Safe - Base64 Decode|Encode|Compress|Decompress', 'bulletproof-security'); ?><br /><span style="font-size:.75em;"><?php _e('base64_decode, base64_encode, gzinflate, gzdeflate, gzuncompress, gzcompress, str_rot13, strrev', 'bulletproof-security'); ?></span></h2>

<?php 
if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { 

    if ( isset( $_POST['Submit-Delete-B64-Offline'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_b64_offline_delete' );
		$b64_decoder_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-offline-decoder.php';
		$B64_options = get_option('bulletproof_security_options_b64_tools');  		

		$B64_options_array = array(
		'bps_b64_offline_decoder' 	=> 'delete', 
		'bps_b64_online_decoder' 	=> $B64_options['bps_b64_online_decoder']
		);				
		
			foreach( $B64_options_array as $key => $value ) {
				update_option('bulletproof_security_options_b64_tools', $B64_options_array);
			}

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The delete Offline Base64 Decoder|Encoder Tool database option has been saved or updated.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;

		if ( file_exists($b64_decoder_file) ) {
			unlink($b64_decoder_file);
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The Offline Base64 Decoder|Encoder Tool has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		
		}
	}

if ( isset( $_POST['Submit-Reset-B64-Offline'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_b64_offline_reset' );
		
		delete_option('bulletproof_security_options_b64_tools');
		
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The Offline Base64 Decoder|Encoder Tool database option has been reset. Upload the b64-offline-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-offline-decoder.php to add and use this tool.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<?php 
	// Delete b64-offline-decoder.php file Form: deletes the file and updates the db option with value of "delete"
	echo '<div id="B64DeleteOffline" style="position:relative;top:0px;left:0px;margin:0px 0px 10px 0px;">';
	echo '<form name="B64DeleteOfflineForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php" method="post">';
	wp_nonce_field('bulletproof_security_b64_offline_delete');
	echo '<label for="B64Delete" style="padding-right:5px;font-size:1.2em;font-weight:bold;">'.__('Delete the Offline Base64 Decoder|Encoder Tool:', 'bulletproof-security').'</label>';
	echo '<input type="submit" name="Submit-Delete-B64-Offline" style="margin-bottom:-5px;" value="'.esc_attr('Delete', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

	// Reset b64-offline-decoder.php file Form: deletes the bulletproof_security_options_b64_tools db option
	echo '<div id="B64DeleteOffline" style="position:relative;top:0px;left:0px;margin:0px 0px 10px 0px;">';
	echo '<form name="B64ResetOfflineForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php" method="post">';
	wp_nonce_field('bulletproof_security_b64_offline_reset');
	echo '<label for="B64Delete" style="padding-right:11px;font-size:1.2em;font-weight:bold;">'.__('Reset the Offline Base64 Decoder|Encoder Tool:', 'bulletproof-security').'</label>';
	echo '<input type="submit" name="Submit-Reset-B64-Offline" style="margin-bottom:-5px;" value="'.esc_attr('Reset', 'bulletproof-security').'" class="button bps-button" />';
	echo '</form>';
	echo '</div>';

	if ( $B64_options['bps_b64_offline_decoder'] != 'delete' && ! file_exists( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-offline-decoder.php' ) ) { 
		$text = '<div style="color:#2ea2cc;font-size:16px;margin:20px 0px 20px 0px;">'.__('The Offline Base64 Decoder|Encoder Tool is not included in BPS Pro Pro-Tools by default. The reason for this is a lot of web host scanners, including our own host Go Daddy, falsely detect malicious code in this tool. Please send an email to info@ait-pro.com with the email Subject line "Request for Online/Offline Base64 Decoder/Encoder Tools" to request that the Decoder/Encoder Pro-Tools be sent to you via email. If you want to use/install this tool click the Reset the Offline Base64 Decoder|Encoder Tool: Reset button and then upload the b64-offline-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-offline-decoder.php.', 'bulletproof-security').'</div>';
		echo $text;
	
	} elseif ( $B64_options['bps_b64_offline_decoder'] == 'delete' && ! file_exists( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-offline-decoder.php' ) ) { 
		$text = '<div style="color:#2ea2cc;font-size:18px;margin:20px 0px 20px 0px;">'.__('The Offline Base64 Decoder|Encoder Tool has been deleted. If you want to use/install this tool click the Reset the Offline Base64 Decoder|Encoder Tool: Reset button and then upload the b64-offline-decoder.php file to this folder: /bulletproof-security/admin/tools/b64-offline-decoder.php.', 'bulletproof-security').'</div>';
		echo $text;

	} else {

		require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-offline-decoder.php' );
	}

?>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>
            
<div id="bps-tabs-3" class="bps-tab-page">
<h2><?php _e('Mycrypt ~ Decrypt|Encrypt', 'bulletproof-security'); ?></h2>

<?php if ( !current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Mcrypt ~ Decrypt', 'bulletproof-security'); ?>  <button id="bps-open-modal3" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content3" title="<?php _e('Mcrypt|Decrypt Encryption', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('mcrypt_encrypt and mcrypt_decrypt functions', 'bulletproof-security').'</strong><br><br><strong>'.__('Mcrypt Cipher:', 'bulletproof-security').'</strong> '.__('MCRYPT_RIJNDAEL_256', 'bulletproof-security').'<br><strong>'.__('Block Algorithm|Cipher Mode:', 'bulletproof-security').'</strong> '.__('MCRYPT_MODE_CBC', 'bulletproof-security').'<br><strong>'.__('Salt and String:', 'bulletproof-security').'</strong> '.__('md5 hashed and base64 encoded/decoded', 'bulletproof-security').'<br><br>'.__('To decrypt paste or type the salt into the salt window and paste mcrypt encrypted code into the Decrypt window and click the Decrypt button to decrypt it. To encrypt text or code paste or type the salt into the salt window and paste or type text or code into the Encrypt window and click the Encrypt button.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
// Form - mcrypt_decrypt
if (isset($_POST['Submit-Mcrypt-Decrypt']) && current_user_can('manage_options')) {
	check_admin_referer( 'bpsProMcryptDecrypt' );
	$bpsMcryptSaltPassD = $_POST['bpsMcryptSaltPassD'];
	$bpsMcryptDecryptString = $_POST['bpsMcryptDecryptString'];
	$bpsMcryptDecrypt = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($bpsMcryptSaltPassD), base64_decode($bpsMcryptDecryptString), MCRYPT_MODE_CBC, md5(md5($bpsMcryptSaltPassD))), "\0");
	//echo '<strong>Mycrypt_decrypt:</strong> '. $bpsMcryptDecrypt;
}

// Form - mcrypt_encrypt
if (isset($_POST['Submit-Mcrypt-Encrypt']) && current_user_can('manage_options')) {
	check_admin_referer( 'bpsProMcryptEncrypt' );
	$bpsMcryptSaltPassE = $_POST['bpsMcryptSaltPassE'];
	$bpsMcryptEncryptString = $_POST['bpsMcryptEncryptString'];
	if ($bpsMcryptEncryptString != '') {
	$bpsMcryptEncrypt = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($bpsMcryptSaltPassE), $bpsMcryptEncryptString, MCRYPT_MODE_CBC, md5(md5($bpsMcryptSaltPassE))));
	//echo '<strong>Mycrypt_encrypt:</strong> '. $bpsMcryptEncrypt;
	}
}
$scrolltoMcryptE = isset($_REQUEST['scrolltoMcryptE']) ? (int) $_REQUEST['scrolltoMcryptE'] : 0;
$scrolltoMcryptD = isset($_REQUEST['scrolltoMcryptD']) ? (int) $_REQUEST['scrolltoMcryptD'] : 0;
?>

<form name="bpsMcryptDecryptForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bpsProMcryptDecrypt'); ?>
<div><label for="bpsMcrypt"><strong><?php _e('Salt|Password:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsMcryptSaltPassD" value="" size="98"/><br />
    <label for="bpsMcrypt"><strong><?php _e('Paste Text or Code to Decrypt Here:', 'bulletproof-security').' '; ?></strong></label><br />
    <textarea class="bps-pro-tools" name="bpsMcryptDecryptString" tabindex="1"></textarea>
	<input type="hidden" name="scrolltoMcryptD" value="<?php echo $scrolltoMcryptD; ?>" />
    <p class="submit">
	<input type="submit" name="Submit-Mcrypt-Decrypt" class="button bps-button" value="<?php esc_attr_e('Decrypt', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#bpsMcryptDecryptForm').submit(function(){ $('#scrolltoMcryptD').val( $('#bpsMcryptDecryptString').scrollTop() ); });
	$('#bpsMcryptDecryptString').scrollTop( $('#scrolltoMcryptD').val() ); 
});
/* ]]> */
</script>

<div id="bpsCodeView">

<table width="100%" border="0" class="widefat">
  <tr>
    <td><?php $text = '<strong><font color="#2ea2cc">'.__('Decrypted (Safe Raw Code Output):', 'bulletproof-security').'</font> '. @stripslashes(htmlspecialchars($bpsMcryptDecrypt)) .'</strong>'; echo $text; ?></td>
  </tr>
  <tr>
    <td><?php $text = '<strong><font color="#2ea2cc">'.__('Encrypted Output:', 'bulletproof-security').'</font>  '. @$bpsMcryptEncrypt .'</strong>'; echo $text; ?>
    </td>
  </tr>
</table>

</div>

<h3><?php _e('Mcrypt ~ Encrypt', 'bulletproof-security'); ?></h3>
<form name="bpsMcryptEncryptForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-3" method="post">
<?php wp_nonce_field('bpsProMcryptEncrypt', 'bulletproof-security'); ?>
<div><label for="bpsMcrypt"><strong><?php _e('Salt|Password:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsMcryptSaltPassE" value="" size="98"/><br />
    <label for="bpsMcrypt"><strong><?php _e('Paste Text or Code to Encrypt Here:', 'bulletproof-security').' '; ?></strong></label><br />
    <textarea class="bps-pro-tools" name="bpsMcryptEncryptString" tabindex="2"></textarea>
	<input type="hidden" name="scrolltoMcryptE" value="<?php echo $scrolltoMcryptE; ?>" />
    <p class="submit">
	<input type="submit" name="Submit-Mcrypt-Encrypt" class="button bps-button" value="<?php esc_attr_e('Encrypt', 'bulletproof-security') ?>" /></p>
</div>
</form>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#bpsMcryptEncryptForm').submit(function(){ $('#scrolltoMcryptE').val( $('#bpsMcryptEncryptString').scrollTop() ); });
	$('#bpsMcryptEncryptString').scrollTop( $('#scrolltoMcryptE').val() ); 
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
            
<div id="bps-tabs-4" class="bps-tab-page">
<h2><?php _e('Crypt', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Crypt one-way string hashing', 'bulletproof-security'); ?>  <button id="bps-open-modal4" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content4" title="<?php _e('Crypt one-way string hashing', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('The crypt function', 'bulletproof-security').'</strong><br><br>'.__('The crypt function will return a hashed string using the algorithms listed in the Choose Encryption Algorithm drop down list. Your system may not support all of the available Algorithms. You will see an error message if your system does not support a particular Algorithm that you have selected. There is no decrypt function for the crypt function. The crypt() function uses a one-way algorithm. Practical uses for crypt would be hashing/encrypting sensitive information like passwords, credit card numbers or creating a key that cannot be decrypted. The hash string can be accessible/viewable publicly and the hashed/encrypted string will match data stored in a private database that is not publicly accessible. Example: When a user creates a password and the password is encrypted with the crypt() function, the encrypted version of this password is saved to the database. The next time the user logs in their password is encrypted again and compared against the already saved (encrypted) password in the database. If the encrypted password is some how intercepted it will be the encrypted version of the password instead of the actual password. The encrypted password will not work to log in with because it will be encrypted again and will not match any encrypted passwords stored in the database.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<strong><?php _e('Hashed|Encrypted String:', 'bulletproof-security'); ?></strong>
<div id="bpsCodeWhite" style="color:black;border:1px solid #999999;background-color:#fff;width:100%;padding:0px 0px 0px 5px;margin:0px 0px 20px 0px;">

<?php
// Form - Encrypt using crypt function with selected Alogorithm
if ( !isset( $_POST['Submit-Crypt'] ) )
    $chosen = array(0);
    else
    if ( isset( $_POST['Submit-Crypt'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bpsProCryptEncrypt' );   
	    $chosen = $_POST['bpsCryptAlgo'];
		
		$bpsCryptEncryptSalt = $_POST['bpsCryptEncryptSalt'];
		$bpsCryptEncryptString = $_POST['bpsCryptEncryptString'];
		$replacement = '';
		
		if ($_POST['bpsCryptAlgo'] == array(1)) {
		if (CRYPT_STD_DES == 1) {
	$filter = $bpsCryptEncryptSalt;
	$string = crypt($bpsCryptEncryptString, $bpsCryptEncryptSalt) . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('Standard DES Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_STD_DES. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}
		if ($_POST['bpsCryptAlgo'] == array(2)) {
		if (CRYPT_EXT_DES == 1) {
	$filter = '_'.$bpsCryptEncryptSalt;
	$string = crypt($bpsCryptEncryptString, '_'.$bpsCryptEncryptSalt) . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('Extended DES Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_EXT_DES. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}   
		if ($_POST['bpsCryptAlgo'] == array(3)) {
		if (CRYPT_MD5 == 1) {
	$filter = '$1$'.$bpsCryptEncryptSalt.'$';
	$string = crypt($bpsCryptEncryptString, '$1$'.$bpsCryptEncryptSalt.'$') . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('MD5 Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_MD5. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}
		if ($_POST['bpsCryptAlgo'] == array(4)) {
		if (CRYPT_BLOWFISH == 1) {
	$filter = '$2a$09$'.$bpsCryptEncryptSalt.'$';
	$string = crypt($bpsCryptEncryptString, '$2a$09$'.$bpsCryptEncryptSalt.'$') . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('Blowfish Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_BLOWFISH. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}
		if ($_POST['bpsCryptAlgo'] == array(5)) {
		if (CRYPT_SHA256 == 1) {
	$filter = '$5$rounds=5000$'.$bpsCryptEncryptSalt.'$';
	$string = crypt($bpsCryptEncryptString, '$5$rounds=5000$'.$bpsCryptEncryptSalt.'$') . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('SHA-256 Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_SHA256. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}
		if ($_POST['bpsCryptAlgo'] == array(6)) {
		if (CRYPT_SHA512 == 1) {
	$filter = '$6$rounds=5000$'.$bpsCryptEncryptSalt.'$';
	$string = crypt($bpsCryptEncryptString, '$6$rounds=5000$'.$bpsCryptEncryptSalt.'$') . "\n";
	$key = str_replace($filter, $replacement, $string);
		$text = '<strong><font color="blue">'.__('SHA-512 Hashed String:', 'bulletproof-security').'</font> '.$key.'</strong>';
		echo $text;
   		} else {
		$text = '<font color="red"><strong>'.__('Your system and/or server does not support CRYPT_SHA512. Select a different encryption algorithm.', 'bulletproof-security').'</strong></font>';
		echo $text;
		}
		}
}

// Form - Dropdown list array for crypt alogorithms	
function bps_showOptionsDrop3($array, $active, $echo=true){
	$string = '';
	foreach( $array as $k => $v ){
	if ( is_array($active) )
	$s = ( in_array($k, $active) ) ? ' selected="selected"' : '';
	else
	$s = ( $active == $k ) ? ' selected="selected"' : '';
	$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}
	if($echo)   echo $string;
	else        return $string;
}

$bpsCryptAlgo = array(' Select Encryption Algorithm:', 'CRYPT_STD_DES', 'CRYPT_EXT_DES', 'CRYPT_MD5', 'CRYPT_BLOWFISH', 'CRYPT_SHA256', 'CRYPT_SHA512');

?>
</div>

<form name="bpsCryptEncryptForm" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-4" method="post">
<?php wp_nonce_field('bpsProCryptEncrypt'); ?>
	<strong><label for="bps-crypt"><?php _e('Choose the Encryption Algorithm:', 'bulletproof-security'); ?> </label></strong><br />
	<select name="bpsCryptAlgo[]" id="bpsCryptAlgo">
	<?php echo bps_showOptionsDrop3($bpsCryptAlgo, $chosen, true); ?>
	</select><br /><br />
    <label for="bps-crypt"><strong><?php _e('Salt|Password:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsCryptEncryptSalt" value="" size="100"/><br />
	<label for="bps-crypt"><strong><?php _e('String|Text to Hash|Encrypt:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsCryptEncryptString" value="" size="100"/>
    <p class="submit">
	<input type="submit" name="Submit-Crypt" class="button bps-button" value="<?php esc_attr_e('Create Hash|Encrypt', 'bulletproof-security') ?>" /></p>
</form>


<div id="bpsCodeWhite2">
<?php $text = 
'<p>&#9632; <strong>CRYPT_STD_DES - </strong>'.__('Use a 2 character salt using only characters A-Z and 0-9. Using invalid characters in the salt will cause crypt() to fail.', 'bulletproof-security').'</p>
<p>&#9632; <strong>CRYPT_EXT_DES - </strong>'.__('Use an 8 character salt using only characters A-Z and 0-9. Using invalid characters in the salt will cause crypt() to fail. A valid Extended DES salt requires a 9 character salt starting with an underscore. The underscore salt prefix required for Extended DES hashing has already been included in the BPS form function.', 'bulletproof-security').'</p>
<p>&#9632; <strong>CRYPT_MD5 - </strong>'.__('Use an 8 character salt using characters A-Z and 0-9 as well any special characters. A valid MD5 salt requires a 12 character salt starting with $1$. The $1$ salt prefix required for MD5 hashing has already been included in the form function and a trailing $ salt character has also been added.', 'bulletproof-security').'</p> 
<p>&#9632; <strong>CRYPT_BLOWFISH - </strong>'.__('Use a 20 character salt using only characters A-Z and 0-9. Using characters outside of this range in the salt will cause crypt() to return a zero-length string. A valid Blowfish salt requires a 22 character salt starting with $2a$ followed by a two digit cost parameter and another $ sign. The BPS form function already contains this Blowfish salt prefix: $2a$09$ and a trailing $ salt character has also been added. The two digit cost parameter is the base-2 logarithm of the iteration count for the underlying Blowfish-based hashing algorithm and must be in range 04-31 (09 was chosen randomly for this BPS form function), values outside this range will cause crypt() to fail.', 'bulletproof-security').'</p> 
<p>&#9632; <strong>CRYPT_SHA256 - </strong>'.__('Use a 16 character salt using characters A-Z and 0-9 as well any special characters. A valid SHA-256 salt requires a 16 character salt starting with $5$. The $5$ salt prefix required for SHA-256 hashing and the default of 5000 rounds (rounds=&lt;N&gt;$) prefix and a trailing $ salt character have already been included in the BPS form function. The numeric value of N is used to indicate how many times the hashing loop should be executed, much like the cost parameter on Blowfish. The default number of rounds is 5000, there is a minimum of 1000 and a maximum of 999,999,999. Any selection of N outside this range will be truncated to the nearest limit.', 'bulletproof-security').'</p> 
<p>&#9632; <strong>CRYPT_SHA512 - </strong>'.__('Use a 16 character salt using characters A-Z and 0-9 as well any special characters. A valid SHA-512 salt requires a 16 character salt starting with $6$. The $6$ salt prefix required for SHA-512 hashing and the default of 5000 rounds (rounds=&lt;N&gt;$) prefix and a trailing $ salt character have already been included in the BPS form function. The numeric value of N is used to indicate how many times the hashing loop should be executed, much like the cost parameter on Blowfish. The default number of rounds is 5000, there is a minimum of 1000 and a maximum of 999,999,999. Any selection of N outside this range will be truncated to the nearest limit.', 'bulletproof-security').'</p>';
	echo $text;
?>
</div>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>
           
<div id="bps-tabs-5" class="bps-tab-page">
<h2><?php _e('Scheduled Cron Jobs', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php $text = __('Cron jobs that are currently scheduled to run on your website.', 'bulletproof-security').'<br>'.__('BPS Pro Cron jobs are removed when you deactivate BPS Pro. To reset, unschedule and reschedule BPS Pro Cron jobs, deactivate BPS Pro and then activate BPS Pro again. This does not remove your website security and only unschedules and reschedules BPS Pro Cron jobs.', 'bulletproof-security'); echo $text; ?></h3>
<table class="widefat" style="margin-bottom:20px;">
<thead>
	<tr>
	<th scope="col"><?php _e('Last|Next Run Date', 'bulletproof-security')?></th>
	<th scope="col"><?php _e('Frequency', 'bulletproof-security')?></th>
	<th scope="col"><?php _e('Hook Name', 'bulletproof-security')?></th>
	</tr>
</thead>
<tbody>
<?php
	$cron = _get_cron_array();
	$schedules = wp_get_schedules();
	$date_format = 'M j, Y @ g:i A';
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	foreach ( $cron as $timestamp => $cronhooks ) {
	foreach ( (array) $cronhooks as $hook => $events ) {
	foreach ( (array) $events as $key => $event ) {
	$cron[ $timestamp ][ $hook ][ $key ][ 'date' ] = date_i18n( $date_format, $timestamp + $gmt_offset );
	}
	}
}
?>
<?php foreach ( $cron as $timestamp => $cronhooks ) { ?>
<?php foreach ( (array) $cronhooks as $hook => $events ) { ?>
<?php foreach ( (array) $events as $event ) { ?>
<tr>
	<th scope="row"><?php echo $event[ 'date' ]; ?></th>
	<td>
<?php 
	if ( $event[ 'schedule' ] ) {
	echo $schedules [ $event[ 'schedule' ] ][ 'display' ]; 
	} else {
	?><em><?php _e('One-off event', 'bulletproof-security')?></em><?php
	}
	?>
	</td>
	<td><?php echo $hook; ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php } ?>
</tbody>
</table>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>
        
<div id="bps-tabs-6" class="bps-tab-page">
<h2><?php _e('String|Function Finder', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('String|Function Finder Usage', 'bulletproof-security'); ?>  <button id="bps-open-modal5" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content5" title="<?php _e('String|Function Finder Usage', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('String|Function Finder ', 'bulletproof-security').'</strong><br>'.__('The String|Function can find any string (name of a function, code, text, etc) in any files anywhere within your hosting account. The Finder will search starting from the folder path you enter and search all files in that folder and all subfolders of that folder path. You can search for PHP function names or any string pattern. The Finder is not searching your WordPress Database. Use the DB String Finder if you want to search your database instead of your files. ', 'bulletproof-security').'<br><br>'.__('The Finder search results will display the full paths and the code line numbers where the string you are searching for was found. The string search term is highlighted in the returned search results.', 'bulletproof-security').'<br><br>'.__('The string search is case sensitive so the string you enter must match exactly. Capital and lowercase letters must match exactly. A string search could contain several words in the string you are searching for, but the Finder is not designed to search for different instances of strings such as a search for and/or string searches, it is designed to find an exact string match, whether the string is one word or several words or HTML characters or PHP code or whatever else you are searching for. The Finder is looking for an exact match for whatever string search term you enter into the Search String window. If the search term you enter is part of a word or a longer string then the entire word or string is returned in the search results with your exact string search term highlighted.', 'bulletproof-security').'<br><br><strong>'.__('Important Note:', 'bulletproof-security').'</strong><br>'.__('For faster and better search results, search specific folders. Example: /website-root-path/wp-content/plugins/ or /website-root-path/wp-content/themes/. If you try to search starting from the /website-root-path/wp-content/ folder then the String Finder will probably hang and not complete due to checking too many files at the same time. It is better and faster to perform several different specific folder searches vs trying to search too many files at the same time.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
// String Finder
class BPSFileSystemStringSearch { 
    var $_searchPath; 
    var $_searchString; 
    var $_searchResults; 

function BPSFileSystemStringSearch($searchPath, $searchString) { 
	$this->_searchPath = $searchPath; 
	$this->_searchString = $searchString; 
	$this->_searchResults = array(); 
} 

function isValidPath() { 
	if ( file_exists($this->_searchPath ) ) { 
	return true; 
	} else { 
	return false; 
	} 
} 

function searchPathIsFile() { 
	if ( substr($this->_searchPath, -1, 1 )=='/' || substr( $this->_searchPath, -1, 1 )=='\\') { 
	return false; 
	} else { 
	return true; 
	} 
} 

function searchFileForString($file) { 
$fileLines = file($file); 
$lineNumber = 1; 
	foreach( $fileLines as $line ) { 
	$searchCount = substr_count($line, $this->_searchString); 
	if($searchCount > 0) { 
	$this->addResult($file, $line, $lineNumber, $searchCount); 
	} 
	$lineNumber++; 
	} 
} 

function addResult($filePath, $lineContents, $lineNumber, $searchCount) { 
	$this->_searchResults[] = array('filePath' => $filePath, 'lineContents' => $lineContents, 'lineNumber' => $lineNumber, 'searchCount' => $searchCount); 
    } 

function highlightSearchTerm($string) { 
	return str_replace($this->_searchString, '<span style="background-color:#FFFF99"><strong>'.$this->_searchString.'</strong></span>', $string); 
} 

function scanDirectoryForString($dir) { 
	$subDirs = array(); 
	$dirFiles = array(); 
         
	$dh = opendir($dir); 
	while(($node = readdir($dh)) !== false) { 
	if(!($node=='.' || $node=='..')) { 
	if(is_dir($dir.$node)) { 
	$subDirs[] = $dir.$node.'/'; 
	} else { 
	$dirFiles[] = $dir.$node; 
	} 
	} 
} 

foreach($dirFiles as $file) { 
	$this->searchFileForString($file); 
} 

	if ( count($subDirs) > 0 ) { 
	foreach( $subDirs as $subDir ) { 
	$this->scanDirectoryForString($subDir); 
	} 
	} 
} 

function run() { 
	if ($this->isValidPath()) { 
	if ($this->searchPathIsFile()) { 
	$this->searchFileForString($this->_searchPath); 
	} else { 
	$this->scanDirectoryForString($this->_searchPath); 
	} 
          
	} else { 
	$text = __('BPSFileSystemStringSearch Error: File/Directory does not exist', 'bulletproof-security');
	die("$text"); 
	} 
} 

function getResults() { 
	 return $this->_searchResults; 
} 
     
function getResultCount() { 
	$count = 0; 
	foreach($this->_searchResults as $result) { 
	$count += $result['searchCount']; 
 	} 
	return $count; 
} 
     
function getSearchPath() { 
	return $this->_searchPath; 
} 
     
function getSearchString() { 
	return $this->_searchString; 
    } 
}  

if ( !isset($_POST['bpsStringFinder'])) {
$bps_max_execution_time = ini_get('max_execution_time'); 
	$text = '<strong>'.__('Current Max Script Execution Time:', 'bulletproof-security').' </strong>'.$bps_max_execution_time.' '.__('seconds', 'bulletproof-security').'<br><strong>'.__('String Search Max Script Execution Time:', 'bulletproof-security').' </strong> '.__('Set to a 280 second Maximum', 'bulletproof-security').'<br><br>';
	echo $text;
	}

// Find strings based on user input
function bpsStringFinder() {
if ( isset( $_POST['bpsStringFinder'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_string_finder' );
	set_time_limit(250); // 250 + 30 = 280 leaving a 20 second buffer

	$time_start = microtime( true );	
	
	$bpsStringPath = $_POST['bpsStringPath'];
	$bpsString = $_POST['bpsString'];
	$searcher = new BPSFileSystemStringSearch("$bpsStringPath", "$bpsString"); 
	$searcher->run(); 

	if ( $searcher->getResultCount() > 0 ) { 
    	echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>Search string found <strong>'.$searcher->getResultCount().' times.</strong></p>'; 
    	echo '<div class="StringFinder" style="background:#fff;">';
		echo '<ul style="background:#fff;color:black;">'; 
        
		foreach( $searcher->getResults() as $result ) { 
			 echo '<li><font color="blue"><em>'.$result['filePath'].', line '.$result['lineNumber'].'</em></font><br />'.$searcher->highlightSearchTerm(htmlspecialchars($result['lineContents'])).'</li>'; 
        } 
    	
		echo '</ul>';
		echo '</div>'; 
	
	} else { 
    
		echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>No results returned</p>'; 
	}

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

<?php $text = '<strong>'.__('Website Root Path:', 'bulletproof-security').' </strong>'. ABSPATH . '<br><strong>'.__('Document Root Path:', 'bulletproof-security').' </strong>'. esc_html($_SERVER['DOCUMENT_ROOT']); echo $text; ?><br /><br />

<form name="bpsStringFinder" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-6" method="post">
<?php wp_nonce_field('bulletproof_security_string_finder'); ?>
<strong><label for="bps-string-finder"><?php _e('Find Strings|Functions:', 'bulletproof-security'); ?> </label></strong><br />
<label for="bps-string-finder"><strong><?php _e('Search String:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsString" value="" size="100"/><br />
<label for="bps-string-finder"><strong><?php _e('Search Path:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringPath" value="" size="100"/>
<input type="hidden" name="bpsIF3" value="bps-string-finder3" />
<p class="submit">
<input type="submit" name="bpsStringFinder" value="<?php esc_attr_e('Find String', 'bulletproof-security') ?>" class="button bps-button" onclick="StringFinder()" /></p>
<?php echo bpsStringFinder(); ?>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-7" class="bps-tab-page">
<h2><?php _e('String Replacer|Remover ~ Preview Mode &amp; Write Mode', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Preview Mode', 'bulletproof-security'); ?>  <button id="bps-open-modal6" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content6" title="<?php _e('BPS String Replacer Preview Mode', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('BPS String Replacer|Remover ~ Preview Mode', 'bulletproof-security').'</strong><br><br>'.__('The String Replacer|Remover Preview Mode allows you to preview the string replacement or string removal you want to perform before you use the Replacer|Remover ~ Write Mode to actually write the new string or remove the string. The string replacement that is performed in Preview Mode is only visually replacing the string and is not actually changing or writing a new string.', 'bulletproof-security').'<br><br><strong>'.__('Using the Replacer|Remover ~ Preview Mode', 'bulletproof-security').'</strong><br>&bull; '.__('Enter the string you want to search for in the', 'bulletproof-security').' <strong>'.__('Search String:', 'bulletproof-security').'</strong> '.__('window. The string search is case sensitive so the string you enter must match exactly. Capital and lowercase letters must match exactly.', 'bulletproof-security').'<br>&bull; '.__('Enter the string you want to replace your Search String with in the', 'bulletproof-security').' <strong>'.__('Replacement String:', 'bulletproof-security').'</strong> '.__('window.', 'bulletproof-security').'<br>&bull; '.__('Enter the folder path where you want to search in the', 'bulletproof-security').' <strong>'.__('Search Path:', 'bulletproof-security').'</strong> '.__('window. This will search all files in the folder path that you add including all subfolders of this folder path.', 'bulletproof-security').'<br><br>'.__('There is a test file in this folder: /website-root-path/wp-content/plugins/bulletproof-security/admin/test/ that you can use for both the Preview Mode and the Write Mode String Replacement testing. Enter ', 'bulletproof-security').'<strong>'.__('bpsBogusString', 'bulletproof-security').'</strong>'.__(' in the ', 'bulletproof-security').'<strong>'.__('Search String:', 'bulletproof-security').'</strong>'.__(' window - The string search is case sensitive so the string you enter must match exactly. Capital and lowercase letters must match exactly, Enter', 'bulletproof-security').' <strong>'.__('TestString', 'bulletproof-security').'</strong>'.__(' in the ', 'bulletproof-security').'<strong>'.__('Replacement String:', 'bulletproof-security').'</strong>'.__(' window, enter the folder path to your WordPress Plugins folder: /website-root-path/wp-content/plugins/ in the ', 'bulletproof-security').'<strong>'.__('Search Path:', 'bulletproof-security').'</strong>'.__(' window and click the Replace Strings button. You should see that the search string ', 'bulletproof-security').'<strong>'.__('bpsBogusString', 'bulletproof-security').'</strong>'.__(' was found and replaced 9 times with ', 'bulletproof-security').'<strong>'.__('TestString', 'bulletproof-security').'</strong>'.__(' and that will also include this help file as well because the string exists in this help file.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
if ( ! isset( $_POST['bpsStringReplacerFP'] ) ) {
$bps_max_execution_time = ini_get('max_execution_time'); 
	$text = '<strong>'.__('Current Max Script Execution Time:', 'bulletproof-security').' </strong>'.$bps_max_execution_time.' '.__('seconds', 'bulletproof-security').'<br><strong>'.__('String Replacer Max Script Execution Time:', 'bulletproof-security').' </strong> '.__('Set to a 280 second Maximum', 'bulletproof-security').'<br><br>';
	echo $text;
	}

// PREVIEW MODE - Replace all instances of search string with user input string
function bpsStringReplacer() {
if ( isset( $_POST['bpsStringReplacer'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_string_replacer' );
	set_time_limit(250); // 250 + 30 = 280 leaving a 20 second buffer
	
	$time_start = microtime( true );

	$bpsStringPath = $_POST['bpsStringPath'];
	$bpsString = $_POST['bpsString'];
	$bpsStringReplacement = $_POST['bpsStringReplacement'];
	$searcher = new BPSFileSystemStringSearch("$bpsStringPath", "$bpsString");
	$searcher->run(); 

	if ( $searcher->getResultCount() > 0 ) { 
    	echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>Search string found and replaced <strong>'.$searcher->getResultCount().' times.</strong></p>'; 
    	echo '<div class="StringFinder" style="background:#fff;">';
		echo '<ul style="background:#fff;color:black;">'; 
        
		foreach( $searcher->getResults() as $result ) { 
			echo'<li><font color="blue"><em>'.$result['filePath'].', line '.$result['lineNumber'].'</em></font><br />'.$searcher->highlightSearchTerm(stripslashes(str_replace($bpsString, '<span style=\"background-color:#FFFF99\"><strong>'.htmlspecialchars($bpsStringReplacement).'</strong></span>', htmlspecialchars($result['lineContents'])))).'</li>';
        } 
    
		echo '</ul>';
		echo '</div>'; 
	
	} else { 
    
		echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>No results returned</p>'; 
	}

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

<?php $text = '<strong>'.__('Website Root Path:', 'bulletproof-security').' </strong>'. ABSPATH .'<br><strong>'.__('Document Root Path:', 'bulletproof-security').' </strong>'. esc_html($_SERVER['DOCUMENT_ROOT']); echo $text; ?><br /><br />

<form name="bpsStringReplacer" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-7" method="post">
<?php wp_nonce_field('bulletproof_security_string_replacer'); ?>
<strong><label for="bps-string-replacer"><?php _e('Find Strings|Functions:', 'bulletproof-security'); ?> </label></strong><br />
<label for="bps-string-replacer"><strong><?php _e('Search String:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsString" value="" size="100"/><br />
<label for="bps-string-replacer"><strong><?php _e('Replacement String:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringReplacement" value="" size="100"/><br />
<label for="bps-string-replacer"><strong><?php _e('Search Path:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringPath" value="" size="100"/>
<input type="hidden" name="bpsIF3" value="bps-string-finder3" />
<p class="submit">
<input type="submit" name="bpsStringReplacer" value="<?php esc_attr_e('Replace String', 'bulletproof-security') ?>" class="button bps-button" onclick="StringReplacerPreview()" /></p>
<?php echo bpsStringReplacer(); ?>
</form>

<?php
// REPLACE / WRITE MODE - Replace all instances of search string with user input string
function bpsStringReplacerFP() {
	if ( isset( $_POST['bpsStringReplacerFP'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_string_replacerFP' );

	$time_start = microtime( true );

	$bpsStringPathFP = $_POST['bpsStringPathFP'];
	$bpsStringFP = $_POST['bpsStringFP'];
	$bpsStringReplacementFP = $_POST['bpsStringReplacementFP'];
	$searcher = new BPSFileSystemStringSearch("$bpsStringPathFP", "$bpsStringFP");
	$searcher->run(); 

	if( $searcher->getResultCount() > 0 ) { 
    	echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>Search string found and replaced <strong>'.$searcher->getResultCount().' times.</strong></p>'; 
    	echo '<div class="StringFinder" style="background:#fff;">';
		echo '<ul style="background:#fff;color:black;">'; 

		
		foreach( $searcher->getResults() as $result ) { 
			echo '<li><font color="blue"><em>'.$result['filePath'].', line '.$result['lineNumber'].'</em></font><br />'.$searcher->highlightSearchTerm(stripslashes(str_replace($bpsStringFP, '<span style=\"background-color:#FFFF99\"><strong>'.htmlspecialchars($bpsStringReplacementFP).'</strong></span>', htmlspecialchars($result['lineContents'])))).'</li>';
			$content = file_get_contents($result['filePath']); 
			$content = str_replace($bpsStringFP, stripslashes($bpsStringReplacementFP), $content); 
			file_put_contents($result['filePath'],$content); 
        
			$bpsStringReplaceLog = WP_CONTENT_DIR . '/bps-backup/logs/string_replacer_log.txt';
			//$timestamp = '['.date('m/d/Y g:i A').']'; 
			$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));	
			$fh = fopen($bpsStringReplaceLog, 'a');
 			fwrite($fh, "\r\n*********** BPS String Replacer Log Entry - $timestamp ************\r\n");
 			fwrite($fh, 'Search Path: '.$bpsStringPathFP."\r\n");
 			fwrite($fh, 'Search String: '.$bpsStringFP.' --- Replacement String: '.$bpsStringReplacementFP."\r\n");
 			fwrite($fh, 'Original Content: '.$result['lineContents']."\r\n");
 			fwrite($fh, 'File Path and Code Line: '.$result['filePath'].', line '.$result['lineNumber']."\r\n");
 			fclose($fh);
		} 
    
		echo '</ul>';
		echo '</div>';
	
	} else { 
    
		echo '<p>Searched "'.$searcher->getSearchPath().'" for string <strong>"'.$searcher->getSearchString().'":</strong></p>'; 
    	echo '<p>No results returned</p>'; 
	}
	
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

<h2><?php _e('String Replacer|Remover ~ Write Mode', 'bulletproof-security'); ?></h2>

<div id="bpsReplacer" style="border-top:1px solid #999999;">
<h3><?php _e('Write Mode', 'bulletproof-security'); ?>  <button id="bps-open-modal7" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
<div id="bps-modal-content7" title="<?php _e('BPS String Replacer Write Mode', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('BPS String Replacer|Remover ~ Write Mode', 'bulletproof-security').'</strong><br><br>'.__('The String Replacer|Remover Write Mode allows you to search and replace or remove strings throughout all of your files. Use Preview Mode first to make sure the string replacement you want to do is exactly what you want. The string replacement that is performed in Write Mode is permanent. You could of course reverse the process if you are doing a string replacement, but if you are doing a string removal and you replace a string with a blank space then you will not be able to reverse the string replacement. A log file entry is written to the String Replacer Log file each time you perform a string replacement or removal. See below for more information.', 'bulletproof-security').'<br><br><strong>'.__('Using the Replacer|Remover ~ Write Mode', 'bulletproof-security').'</strong><br>&bull; '.__('Enter the string you want to search for in the ', 'bulletproof-security').'<strong>'.__('Search String:', 'bulletproof-security').'</strong>'.__(' window. The string search is case sensitive so the string you enter must match exactly. Capital and lowercase letters must match exactly.', 'bulletproof-security').'<br>&bull; '.__('Enter the string you want to replace your Search String with in the ', 'bulletproof-security').'<strong>'.__('Replacement String:', 'bulletproof-security').'</strong>'.__(' window. If you want to remove or permanently delete a string then leave the ', 'bulletproof-security').'<strong>'.__('Replacement String: ', 'bulletproof-security').'</strong>'.__('window blank.', 'bulletproof-security').'<br>&bull; '.__('Enter the folder path where you want to search in the ', 'bulletproof-security').'<strong>'.__('Search Path:', 'bulletproof-security').'</strong>'.__(' window. This will search all files in the folder path that you add including all subfolders of this folder path.', 'bulletproof-security').'<br><br>'.__('There is a test file in this folder: /website-root-path/wp-content/plugins/bulletproof-security/admin/test/ that you can use for both the Preview Mode and the Write Mode String Replacement testing. Enter ', 'bulletproof-security').'<strong>'.__('bpsBogusString', 'bulletproof-security').'</strong>'.__(' in the ', 'bulletproof-security').'<strong>'.__('Search String: ', 'bulletproof-security').'</strong>'.__('window - The string search is case sensitive so the string you enter must match exactly. Capital and lowercase letters must match exactly, Enter ', 'bulletproof-security').'<strong>'.__('TestString', 'bulletproof-security').'</strong>'.__(' in the ', 'bulletproof-security').'<strong>'.__('Replacement String:', 'bulletproof-security').'</strong>'.__(' window, enter full path to the BPS Test folder /your-website-root-path-goes-here/', 'bulletproof-security').$bps_plugin_dir.__('/bulletproof-security/admin/test/ in the ', 'bulletproof-security').'<strong>'.__('Search Path: ', 'bulletproof-security').'</strong>'.__('window and click the Replace Strings button. You should see that the search string ', 'bulletproof-security').'<strong>'.__('bpsBogusString', 'bulletproof-security').'</strong>'.__(' was found and replaced 4 times with ', 'bulletproof-security').'<strong>'.__('TestString', 'bulletproof-security').'</strong>.'.__(' In Write Mode these strings have been permanently replaced so this test will only work once unless you reverse the process and replace the string ', 'bulletproof-security').'<strong>'.__('TestString', 'bulletproof-security').'</strong>'.__(' with ', 'bulletproof-security').'<strong>'.__('bpsBogusString', 'bulletproof-security').'</strong>.<br><br><strong>'.__('BPS Pro String Replacer|Remover Log', 'bulletproof-security').'</strong><br>'.__('Each time you perform a string replacement or removal a log entry is made into the BPS Pro String Replacer Log file. The log file is here /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/logs/string_replacer_log.txt. The log file entry adds a timestamp, the Search Path, the Search String, the Replacement String, the Original Content before being modified and the File Path and Code Line that was modified. You can add the path to the Replacer Log file to an available slot in the Php.ini File Manager and use the Php.ini Editor to view the Log file online or you can download it via FTP. Adding the Log file path to the Php.ini File Manager will allow you to view the Replacer Log file at any time. The Log file is htaccess protected and cannot be viewed using a browser unless you open the file with your browser via FTP.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<form name="bpsStringReplacerFP" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-7" method="post">
<?php wp_nonce_field('bulletproof_security_string_replacerFP'); ?>
<strong><label for="bps-string-replacer"><?php _e('Find Strings|Functions:', 'bulletproof-security'); ?> </label></strong><br />
<label for="bps-string-replacer"><strong><?php _e('Search String:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringFP" value="" size="100"/><br />
<label for="bps-string-replacer"><strong><?php _e('Replacement String:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringReplacementFP" value="" size="100"/><br />
<label for="bps-string-replacer"><strong><?php _e('Search Path:', 'bulletproof-security').' '; ?></strong></label><br />
<input type="text" name="bpsStringPathFP" value="" size="100"/>
<input type="hidden" name="bpsIF4" value="bps-string-finder4" />
<p class="submit">
<input type="submit" name="bpsStringReplacerFP" value="<?php esc_attr_e('Replace|Remove String', 'bulletproof-security') ?>" class="button bps-button" onclick="StringReplacerWrite()" /></p>
<?php echo bpsStringReplacerFP(); ?>
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

<div id="bps-tabs-8" class="bps-tab-page">

<h2><?php _e('WordPress Database String Finder', 'bulletproof-security'); ?></h2>

<div id="bpsDBFinder" style="padding-left:10px;border-left:1px solid black;border-right:1px solid black;">
<div class="bps-table_title" style="width:100%;height:18px;position:relative;left:-11px;top:0px;padding-right:5px;"></div>

<h3><?php _e('DB String Finder', 'bulletproof-security'); ?>  <button id="bps-open-modal8" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content8" title="<?php _e('DB String Finder', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('DB String Finder', 'bulletproof-security').'</strong><br>'.__('You can use the DB String Finder Tool to quickly search your entire database for a string (text or code). The DB String Finder searches your entire WordPress Database (all Database Tables) for the string search term you enter in the DB Search String: window. The string search is not case sensitive. The string search will return search results for all or part of the search term you enter. If a large amount of data is returned in your search results use the horizontal scroller located at the bottom of the search results window to scroll and view all the table data.', 'bulletproof-security').'<br><br><strong>'.__('Examples:', 'bulletproof-security').'</strong><br>'.__('If you searched for bulletproof_security you would get search results with instances of the string bulletproof_security highlighted and on a separate line using a line break to isolate only your string search term for easier visual identification. If you searched for Bulletproof_security with a capital B then you would get the same exact search results. If you searched for bullet you would get search results with instances of the string bullet highlighted and on a separate line for easier visual identification.', 'bulletproof-security').'<br><br>'.__('Running a DB search may generate this php warning message in your php error log ', 'bulletproof-security').'<strong>'.__('PHP Warning:  Unknown: 1 result set(s) not freed. Use mysql_free_result to free result sets which were requested using mysql_query() in Unknown on line 0.', 'bulletproof-security').'</strong>'.__(' You can disregard this warning. It is a known issue that is common when performing this method of searching your database.', 'bulletproof-security').'<br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
// Credit Where Credit Is Due - Bonus Code:
// The following AnyWhereInDB bonus code does not make up the core coding of BulletProof Security Pro and is not 
// included in the price of BulletProof Security Pro as this is a free code script, snippet or example code and
// is added as a bonus feature to BulletProof Security Pro.
// Adapted, modified and recoded to work for WordPress and BPS Pro
// Note: Needs a complete code rewrite/overhaul and use mysqli instead of mysql - pending for 9.4
/***********************************************************************
* @name  AnyWhereInDB
* @author Nafis Ahmad 
* @abstract This project is to find out a part of string from anywhere in database
* @version 0.22  
* @package anywhereindb
*************************************************************************/

if ( !isset( $_POST['bpsDBStringFinder9'] ) ) {
$bps_max_execution_time = ini_get('max_execution_time');
		$text = '<strong>'.__('Current Max Script Execution Time: ', 'bulletproof-security').'</strong>'.$bps_max_execution_time.__(' seconds', 'bulletproof-security').'<br><strong>'.__('DB String Finder Max Script Execution Time: ', 'bulletproof-security').'</strong>'.__(' Set to a 280 second Maximum', 'bulletproof-security').'<br><br>';
	echo $text;
	}

if ( isset( $_POST['bpsDBStringFinder9'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_db_string_finder9' );
	set_time_limit(250); // 250 + 30 = 280 leaving a 20 second buffer
	
	$time_start = microtime( true );

	$server = DB_HOST;
	$dbuser = DB_USER;
	$dbpass = DB_PASSWORD;
	$dbname = DB_NAME;
	
	$link = @mysql_connect($server, $dbuser, $dbpass);

	if ( !$link ) {  
	_e('Cannot Connect to DB Server', 'bulletproof-security');
	}
	
	if ( !@mysql_select_db($dbname, $link) ) { 
	_e('Database Not Found', 'bulletproof-security');
	}

	
	bps_html_header(); //  @link  html_head will printed here!! 
	
	if ( !empty( $_POST['search_text'] ) ) {

		$search_text = @mysql_real_escape_string( $_POST['search_text'] );
		$result_in_tables = 0;
		
		$text = '<a href="javascript:bps_hide_all()">'.__('Collapse All Result', 'bulletproof-security').'</a> | <a href="javascript:bps_show_all()">'.__('Expand All Result', 'bulletproof-security').'</a><h4>'.__('DB String Search Results for: ', 'bulletproof-security').'<i>'.$search_text.'</i></h4>';
		echo $text;
		
		// @abstract  table count in the database
		$sql = 'show tables';
		$res = mysql_query($sql);
		//@abstract  get all table information in row tables
		$tables = bps_fetch_array($res);
        //$tables = array(array('album'));
		//endof table count
	
	   for( $i=0;$i<sizeof($tables);$i++ )
	   // @abstract  for each table of the db seaching text
	   {
			//@abstract querry bliding of each table
			$sql = 'select count(*) from '.$tables[$i]['Tables_in_'.$dbname];
			$res = mysql_query($sql);
			
			if ( mysql_num_rows($res)>0 ) {
				//@abstract Buliding search Querry, search

				//@abstract taking the table data type information
				$sql = 'desc '.$tables[$i]['Tables_in_'.$dbname]; 
				$res = mysql_query($sql);
				$collum = bps_fetch_array($res);
				
				$search_sql = 'select * from '.$tables[$i]['Tables_in_'.$dbname].' where ';
				$no_varchar_field = 0;
				
				for( $j=0;$j<sizeof($collum);$j++ )
				// @abstract only finding each row information
 				{
						## we are searching all the fields in this table
						
						//if(substr($collum[$j]['Type'],0,7)=='varchar'|| substr($collum[$j]['Type'],0,7)=='text')
						// @abstractonly type selection part of query buliding
						// @todo seach all field in the data base put a 1 in if(1)
						// @example if(1) 
						//{
							//echo $collum[$j]->Field .'<br />';
							if($no_varchar_field!=0){$search_sql .= ' or ' ;}
							$search_sql .= '`'.$collum[$j]['Field'] .'` like \'%'.$search_text.'%\' ';			
							$no_varchar_field++;
						//} // endof type selection part of query bulidingtype selection part
						
				}//@endof for |buliding search query
				
				if ( $no_varchar_field>0 ) {
				// @abstract only main searching part showing the data

					$res = mysql_query($search_sql);
					$search_result = bps_fetch_array($res);
					if(sizeof($search_result)) {
					// @abstract found search data showing it! 

						$result_in_tables++;
		

$text = '<div class="table_name">&nbsp;&nbsp; Table : ' . $tables[$i]['Tables_in_'.$dbname] .' &nbsp;&nbsp;</div> 
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
		'<span class="number_result">'.__(' Total DB String Search Results for ', 'bulletproof-security').'<i>"'.$search_text .'"</i>: '.mysql_affected_rows().'</span>
		<br/>
		
		<div class="link_wrapper"><a href="javascript:bps_toggle(\''.$tables[$i]['Tables_in_'.$dbname].'_sql'.'\')">SQL</a></div>
		<div id="'.$tables[$i]['Tables_in_'.$dbname].'_sql" class="sql keys"><i>'.$search_sql.'</i></div>
		
		<div class="link_wrapper"><a href="javascript:bps_toggle(\''.$tables[$i]['Tables_in_'.$dbname].'_wrapper'.'\')">Result</a></div>
		<script language="JavaScript">
		table_id.push("'.$tables[$i]['Tables_in_'.$dbname].'_wrapper");
		</script>
		<div class="wrapper" id="'.$tables[$i]['Tables_in_'.$dbname].'_wrapper">'.bps_table_arrange($search_result).'</div><br/><br/>';
			
						echo $text;
						
							
						//bps_table_arrange($search_result); - moved into $text above
						//echo '</div><br/><br/>'; - moved into $text above
					}// @endof showing found search  
					
				}//@endof  main searching 
			}//@endof  querry building and searching 
	   }
	   
	   if ( !$result_in_tables ) {
	   // @abstract if result is not found
			$text = '<p style="color:red;">'.__('Search String', 'bulletproof-security').' <i>'.$search_text.'</i> '.__('was not found in your WordPress Database', 'bulletproof-security').' ('.$dbname.') !</p>';
			echo $text;
	   }
	}
	mysql_close($link); 

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}
// @abstract common footer
?>

<div id="bpsDBSFForm">
<form action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-8" method="POST">
    <?php wp_nonce_field('bulletproof_security_db_string_finder9'); ?>
	<label for="search_text"> Searching Database <strong><?php echo $dbname ?></strong></label><br /><br />
    <label for="search_text"><strong><?php _e('DB Search String:', 'bulletproof-security').' '; ?></strong></label><br />
	<input type="text" name="search_text" size="100" <?php if(!empty($_POST['search_text'])) echo 'value="'.$_POST['search_text'].'"';  ?> />
	<p class="submit">
<input type="submit" name="bpsDBStringFinder9" value="<?php esc_attr_e('Find DB String', 'bulletproof-security') ?>" class="button bps-button" onclick="DBStringFinder()" /></p>
</form>
</div>
<!-- </div> -->

<?php
echo '</body>';
echo '</html>';
//@endof common footer

//*********************
//* PHP functions 
//*********************
function bps_fetch_array($res) {
// @method    bps_fetch_array
// @abstract taking the mySQL $resource id and fetch and return the result array
// @param   string| MySQL resouser 
// @return  array  
   $data = array();	
	
	while ( $row = mysql_fetch_assoc($res) ) 
	{
		$data[] = $row;
	}
	return $data;
} //@endof  function bps_fetch_array


function bps_table_arrange($array) {
// @method  bps_table_arrange
// @abstract taking the mySQL the result array and return html Table in a string. showing the search content in a diffrent css class.
// @param  array 
// @post_data  search_text
// @return  string | html table 
	
	$table_data = ''; // @abstract  returning table
	
	$max = 0; // @abstract  max lenth of a row
	
	$max_i = 0; // @abstract  number of the row which is maximum max lenth of a row
	
	$search_text = $_POST["search_text"];
	
	for( $i=0;$i<sizeof($array);$i++ )
	{
		//@abstract table row 
		$table_data .= '<tr class='.(($i&1)?'"odd_row"':'"even_row"') .' >';
		//
		$j=0;
		
		foreach( $array[$i] as $key => $data ) {
			
			//@abstract a class around the search text 
			$data = preg_replace("|($search_text)|Ui" , "<pre class=\"search_text\"><b>$1</b></pre>" , htmlspecialchars($data));
			$table_data .= '<td>'. $data .' &nbsp;</td>';
			$j++;
		}
		
		if ( $max<$j) {
			$max = $j;
			$max_i = $i;
		}
		$table_data .= '</tr>'."\n";
	}
	$table_data .= '</table></div>';
	unset($data);
	// @endof html table
	//@abstract populating the table head
	
	// @varname $data_a
	//@abstract  taking the highest sized array and printing the key name.
	$data_a = $array[$max_i];
	
	
	$table_head =  '<tr>';
		foreach( $data_a as $key => $value ) {
			$table_head .= '<td class="keys">'. $key.'</td>';
		}
			
	$table_head .= '</tr>'."\n";
	//@endof populating the table head
	
	// @abstract printing the table data
	echo '<div class="table_bor">
					<table cellspacing="0" cellpadding="3" border="0" class="data_table">'.$table_head.$table_data;
}//@endof  function bps_table_arrange

function bps_html_header() {
// @method  html_header
// @abstract showing the html header of the instance. 
// @result prints the html header
?>

<?php  
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head>'; 
?>
<!--
//----------------------------------------------------------------------------------------------------------------------//
* @name  AnyWhereInDB
* @author Nafis Ahmad happy56[at]gmail.com // http://twitter.com/happy56
* @abstract This project is to find out a part of string from anywhere in database
* @version 0.22
* @package anywhereindb
//----------------------------------------------------------------------------------------------------------------------//
-->
<!-- <title>Any where In DB || AnyWhereInDB.php</title> -->
<!-- <script language="JavaScript"> -->
<script type="text/javascript">
/* <![CDATA[ */
	//@var array| initilazed 
	var table_id =new Array();

	function bps_hide_all()
	// @method  bps_hide_all
	// @abstract hideing all the result tables
	
	{
		for(i=0;i<table_id.length;i++){
			document.getElementById(table_id[i]).style.display = 'none';
		}
	} //@endof function bps_hide_all
	
	function bps_show_all()
	// @method  bps_show_all
	// @abstract showing all the result tables
	
	{
		for(i=0;i<table_id.length;i++){
			document.getElementById(table_id[i]).style.display = 'block';
		}
	}//@endof function bps_show_all
	
	function bps_toggle(id)
	// @method  toggle
	// @abstract hide/showing a html contianer 
	
	{
		
		if(bps_get_style(id,'display') =='block')
		{
			document.getElementById(id).style.display = 'none';
		}else {

			document.getElementById(id).style.display = 'block';
		
		}
		
	}//@endof function bps_show_all
	
	function bps_get_style(el,styleProp)
	// @method  bps_get_style
	// @abstract making life easier to Get CSS properties from that table.  
	{
		var x = document.getElementById(el);
		if (x.currentStyle)
			var y = x.currentStyle[styleProp];
		else if (window.getComputedStyle)
			var y = document.defaultView.getComputedStyle(x,null).getPropertyValue(styleProp);
		return y;
	}// @endof function bps_get_style
/* ]]> */
</script>

<?php 
echo '</head>';
echo '<body>'; 

}// @endof  function html_head
//---------------------------//
// @endof file anywhereindb.php
// @note if you have querry, need, idea, help; fell free to contact happy56[at]gmail.com
?>

<div class="bps-table_cell_bottom" style="width:100%;height:18px;position:relative;left:-11px;top:0px;padding-right:5px;"></div>
</div>
</div>

<div id="bps-tabs-9" class="bps-tab-page">
<h2><?php _e('WordPress Database Table Cleaner|Remover', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('DB Table Cleaner|Remover', 'bulletproof-security'); ?>  <button id="bps-open-modal9" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>
    
    <div id="bps-modal-content9" title="<?php _e('DB Table Cleaner|Remover', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('BPS DB Table Cleaner|Remover', 'bulletproof-security').'</strong><br><br>'.__('EMPTYING a table means all the rows in the table will be deleted.', 'bulletproof-security').' <strong>'.__('CAUTION!!! THIS ACTION IS NOT REVERSIBLE.', 'bulletproof-security').'</strong><br><br>'.__('DROPPING a table means deleting the table.', 'bulletproof-security').'<strong>'.__('CAUTION!!! THIS ACTION IS NOT REVERSIBLE.', 'bulletproof-security').'</strong><br><br><strong>'.__('BPS Pro Video Tutorial links can be found in the Help & FAQ pages.', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php
// Credit Where Credit Is Due - Bonus Code:
// The following DB Table Cleaner / Remover bonus code does not make up the core coding of BulletProof Security Pro and is 
// not included in the price of BulletProof Security Pro as this is a free code script, snippet or example code and is added
// as a bonus feature to BulletProof Security Pro.
// Code Written By:																	
// - Lester "GaMerZ" Chan															
// - http://lesterchan.net															
### Check Whether User Can Manage Database
//if(!current_user_can('manage_options')) {
//	die('Access Denied');
//}

### Form Processing 
if(@$_POST['bpsDBCleaner-Submit']) {
	// Lets Prepare The Variables
	$emptydrop = $_POST['emptydrop'];

	// Decide What To Do
	switch( $_POST['bpsDBCleaner-Submit'] ) {
		case __('Empty|Drop', 'bulletproof-security'):
			check_admin_referer('bulletproof_security_db_cleaner');
			$empty_tables = array();
			if ( ! empty($emptydrop) ) {
				foreach( $emptydrop as $key => $value ) {
					if ( $value == 'empty' ) {
						$empty_tables[] = $key;
					} elseif ( $value == 'drop' ) {
						$drop_tables .=  ', '.$key;
					}
				}
			} else {
				$textDB = '<font color="red">'.__('No Tables Selected.', 'bulletproof-security').'</font>';
			}
			$drop_tables = substr($drop_tables, 2);
			if ( ! empty($empty_tables) ) {
				foreach( $empty_tables as $empty_table ) {
					$empty_query = $wpdb->query("TRUNCATE $empty_table");
					$textDB .= '<font color="green">'.sprintf(__('Table \'%s\' Emptied', 'bulletproof-security'), $empty_table).'</font><br />';
				}
			}
			if ( ! empty($drop_tables) ) {
				$drop_query = $wpdb->query("DROP TABLE $drop_tables");
				$textDB = '<font color="green">'.sprintf(__('Table(s) \'%s\' Dropped', 'bulletproof-security'), $drop_tables).'</font>';
			}
			break;
	}
}

$tables = $wpdb->get_col("SHOW TABLES");
?>

<?php 
if ( ! empty($textDB) ) { 
echo '<!-- Last Action --><div id="message" class="updated fade" style="border:1px solid #999999; margin-left:220px;background-color:#ffffe0;"><p>'.$textDB.'</p></div>'; } 
?>

<form name="bpsDBCleaner" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-9" method="post">
<?php wp_nonce_field('bulletproof_security_db_cleaner'); ?>
	<h2><?php _e('Empty|Drop Tables', 'bulletproof-security'); ?></h2>	
	<br style="clear" />

<table class="widefat">
	<thead>
		<tr>
		<th style="width:30%;"><?php _e('Tables', 'bulletproof-security'); ?></th>
		<th style="width:30%;"><?php _e('Empty', 'bulletproof-security'); ?> <sup><?php _e('1', 'bulletproof-security'); ?></sup></th>
		<th style="width:30%;"><?php _e('Drop', 'bulletproof-security'); ?> <sup><?php _e('2', 'bulletproof-security'); ?></sup></th>
		</tr>
	</thead>
<?php
	foreach( $tables as $table_name ) {
		
		if ( @$no%2 == 0 ) {
			$style = '';							
		} else {
			$style = ' class="alternate"';
		}
			@$no++;
	
	echo "<tr $style><th align=\"left\" scope=\"row\">$table_name</th>\n";
	echo "<td><input type=\"radio\" id=\"$table_name-empty\" name=\"emptydrop[$table_name]\" value=\"empty\" />&nbsp;<label for=\"$table_name-empty\">".__('Empty', 'bulletproof-security').'</label></td>';
	echo "<td><input type=\"radio\" id=\"$table_name-drop\" name=\"emptydrop[$table_name]\" value=\"drop\" />&nbsp;<label for=\"$table_name-drop\">".__('Drop', 'bulletproof-security').'</label></td></tr>';
					}
				?>
	<tr>
		<td colspan="3">
		<?php $text = __('1. EMPTYING a table means all the rows in the table will be deleted.', 'bulletproof-security').' <strong>'.__('CAUTION!!! THIS ACTION IS NOT REVERSIBLE.', 'bulletproof-security').'</strong><br>'.__('2. DROPPING a table means deleting the table.', 'bulletproof-security').' <strong>'.__('CAUTION!!! THIS ACTION IS NOT REVERSIBLE.', 'bulletproof-security').'</strong>';
		echo $text; ?>
	</td>
	</tr>
	<tr>
	<td colspan="3" align="center"><input type="submit" name="bpsDBCleaner-Submit" value="<?php _e('Empty|Drop', 'bulletproof-security'); ?>" class="button bps-button" onclick="return confirm('<?php $text = __('You Are About To Empty Or Drop The Selected Database Tables.', 'bulletproof-security').'\n\n'.__('This Action Is Not Reversible.', 'bulletproof-security').'\n\n'.__('Choose Cancel or click Ok to delete.', 'bulletproof-security'); echo $text; ?>')" />&nbsp;&nbsp;<input type="button" name="cancel" value="<?php _e('Cancel', 'bulletproof-security'); ?>" class="button bps-button" onclick="javascript:history.go(-1)" /></td>
	</tr>
</table>
</form>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>

<div id="bps-tabs-10" class="bps-tab-page">
<h2><?php _e('Find DNS Records By Domain Name', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Get DNS Records with DNS_ALL', 'bulletproof-security'); ?></h3>
<form name="bpsNetwork" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-10" method="post">
<?php wp_nonce_field('bpsNetworkTools'); ?>
<div><label for="bpsNetwork"><strong><?php _e('Enter Domain Name - Example: ait-pro.com:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsNetworkHost" value="" size="50"/> <br />
    <p class="submit">
	<input type="submit" name="Submit-Network" class="button bps-button" value="<?php esc_attr_e('Get Info', 'bulletproof-security') ?>" /></p>
</div>
</form>

<?php 
// Request "ALL" DNS records - create $authns and $addtl arrays
if ( isset( $_POST['Submit-Network'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bpsNetworkTools' );
	$site = trim($_POST['bpsNetworkHost']);
	$result = dns_get_record($site, DNS_ALL, $authns, $addtl);

	echo "<div class=\"iniFinderStyle\">";
	echo "<pre>";
	echo "Result = ";
	print_r($result);
	echo "Auth NS = ";
	print_r($authns);
	echo "Additional = ";
	print_r($addtl);
	echo "</pre>";
	echo "</div>";
}
?>

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Get DNS Records with DNS_ANY', 'bulletproof-security'); ?></h3>

<form name="bpsNetworkAny" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-10" method="post">
<?php wp_nonce_field('bpsNetworkToolsAny'); ?>
<div><label for="bpsNetwork"><strong><?php _e('Enter Domain Name - Example: ait-pro.com:', 'bulletproof-security').' '; ?></strong></label><br />
    <input type="text" name="bpsNetworkHostAny" value="" size="50"/> <br />
    <p class="submit">
	<input type="submit" name="Submit-Network-Any" class="button bps-button" value="<?php esc_attr_e('Get Info', 'bulletproof-security') ?>" /></p>
</div>
</form>

<?php 
// Request "ANY" DNS records - create $authns and $addtl arrays
if (isset($_POST['Submit-Network-Any']) && current_user_can('manage_options')) {
	check_admin_referer( 'bpsNetworkToolsAny' );
	$site = trim($_POST['bpsNetworkHostAny']);
	$result = dns_get_record($site, DNS_ANY, $authns, $addtl);

	echo "<div class=\"iniFinderStyle\">";
	echo "<pre>";
	echo "Result = ";
	print_r($result);
	echo "Auth NS = ";
	print_r($authns);
	echo "Additional = ";
	print_r($addtl);
	echo "</pre>";
	echo "</div>";
}
?>
</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>

<div id="bps-tabs-11" class="bps-tab-page">
<h2><?php _e('Ping a Website Domain Name', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Check if a website domain is Up/Down or Blocking your website/Server IP Address', 'bulletproof-security'); ?></h3>
<?php

// Function to check response time
function bps_pingDomain($domain){

    $starttime = microtime(true);
    $file      = @fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) { 
		$status = -1;  // Site is down
	
	} else {
        
		fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}

// Check whether the form was submitted
if ( isset( $_POST['Submit-Ping'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bpsPingTools' );

	$domainbase = ( isset( $_POST['domainname'] ) ) ? $_POST['domainname'] : '';
	$domainbase = str_replace( array( "http://", "https://"), "", strtolower($domainbase) );

	$status = bps_pingDomain($domainbase);

	if ($status != -1) { // Site is down
		echo '<strong><font color="green">'.$domainbase.__(' is reachable using fsockopen Port 80. Response Time: ', 'bulletproof-security').$status.__(' milliseconds', 'bulletproof-security').'</font></strong><br><br>';
	} else { 
		echo '<strong><font color="red">'.$domainbase.__(' is NOT reachable using fsockopen Port 80.', 'bulletproof-security').'<br>'.__('Either this website domain does not exist, the website domain is down, your Server is blocking communication with this website or your website/Server IP Address: ', 'bulletproof-security').$_SERVER['SERVER_ADDR'].__(' is being blocked by this website domain/Web Host. ', 'bulletproof-security').'</font></strong><br><br>';
	}
}
?>

<form name="bpsPing" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-11" method="post">
<?php wp_nonce_field('bpsPingTools'); ?>
<div><label for="bpsPing"><strong><?php _e('Enter Website Domain Name - Example: ait-pro.com:', 'bulletproof-security'); ?></strong></label><br />
    <input type="text" name="domainname" value="" size="50"/> <br />
    <p class="submit">
	<input type="submit" name="Submit-Ping" class="button bps-button" value="<?php esc_attr_e('Ping Website Domain', 'bulletproof-security') ?>" /></p>
</div>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>

<div id="bps-tabs-12" class="bps-tab-page">
<h2><?php _e('cURL Scan', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<?php
// cURL Scanner checks - cURL Extension is Loaded & disable_functions directive checks
function bpscURLScannerChecks() {
	if (current_user_can('manage_options')) {
	
	if ( !extension_loaded('curl') ) {
		$text = '<br><strong><font color="red">'.__('The cURL Extension is Not Loaded/Installed on your website/Server.', 'bulletproof-security').'</font><br>'.__('The scanner uses cURL to scan your website for plugin scripts/files to add to the Firewall Whitelist. You will either have to add plugin script/file names manually or Load/add/install the cURL extension on your Server.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
 	
	$disabled = explode(',', ini_get('disable_functions'));	
   	
	if ( in_array('curl_init', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_init function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_init function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}

	if ( in_array('curl_multi_init', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_multi_init function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_multi_init function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}

	if ( in_array('curl_exec', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_exec function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_exec function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}

	if ( in_array('curl_multi_exec', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_multi_exec function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_multi_exec function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}

	if ( in_array('curl_setopt', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_setopt function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_setopt function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	
	if ( in_array('curl_multi_getcontent', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_multi_getcontent function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_multi_getcontent function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}

	if ( in_array('curl_multi_add_handle', $disabled) ) {	
    	$text = '<br><strong><font color="red">'.__('The curl_multi_add_handle function is disabled in the disable_functions directive in your php.ini file. The cURL scanner cannot scan your website.', 'bulletproof-security').'</font><br>'.__('You will either need to remove the curl_multi_add_handle function from the disable_functions directive in your php.ini file or add plugin scripts/paths manually to your Plugin Firewall Whitelist Text Area. See the Plugin Firewall Read Me help button for instructions on how to add plugin scripts/paths manually.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	}
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<?php bpscURLScannerChecks(); ?>

<h4 style="margin:0px 0px 5px 0px;"><?php $text = '<font color="#2ea2cc">'.__('IMPORTANT NOTE: ', 'bulletproof-security').'</font>'.__('The cURL Scanner performs error checking for invalid whitelist scripts/paths. In some cases the cURL Scanner cannot retrieve only valid plugin scripts/paths and may retrieve additional invalid scripts/paths due to minifying plugins or other plugins or themes that embed code into your website\'s source code. If the cURL Scanner finds invalid scripts/paths in the Scan Results then you will see Scan Errors displayed in ', 'bulleproof-security').'<font color="red">'.__('Red Font ', 'bulletproof-security').'</font>'.__('with a description of what is not valid. You can then make the necessary corrections to the invalid portion of the scan results after you copy the scan results to your Plugin Firewall Whitelist Text Area. The Plugin Firewall Whitelist Text area also performs the same error checking for invalid whitelist scripts/paths and also performs additional error checking for other possible errors/invalid scripts/paths and typos.', 'bulletproof-security'); echo $text; ?></h4>

<div id="CMPS1" style="border-top:3px solid #999999;">

<?php $text = '<h3>'.__('Multi Page|Post cURL Scanner (The default scan is already set to scan up to 50 Pages/Posts)', 'bulletproof-security').'</h3><h4>'.__('This cURL Scanner will scan the total number of Pages and Posts that you enter in the ', 'bulletproof-security').'<font color="#2ea2cc">'.__('Limit Number Of Pages To Scan', 'bulletproof-security').'</font>'.__(' text box below. The default scan is already set to scan up to 50 Pages/Posts. This scanner is designed to look for plugin scripts to add to the Plugin Firewall Whitelist. This scanner has been tested up to scanning 1500 Pages & Posts simultaneously. It works, but your WP Dashboard will temporarily display broken after the scan completes. If your WP Dashboard displays broken after running this scan then click your Browser\'s Back button and click any link in your WP Dashboard and it will display normally again.', 'bulletproof-security').'</h4>'; echo $text; ?></h3>

<?php
// cURL Multi page scanner - Scans all published pages & posts by GUID and includes Home and Login page - Plugin Scripts to Whitelist
if ( isset( $_POST['bpsMulti-Scan-All-Pages-Submit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_Multi_Scan_All_Pages' );
	set_time_limit(300);

	$time_start = microtime( true );

	if ( $_POST['DBLimit'] == '' ) {
		$db_row_limit = '50';
	} else {
		$db_row_limit = $_POST['DBLimit'];
	}

$posts_table = $wpdb->prefix . "posts";
$post_type = "p";
$post_status = "publish";

	$getPostsPages = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $posts_table WHERE post_type LIKE %s AND post_status = %s LIMIT $db_row_limit", "%$post_type%", $post_status) );

	if ( $getPostsPages ) {

		$nodes = array();

		foreach ( $getPostsPages as $PostsPages ) {
			$nodes[] = $PostsPages->guid;
		}
	}

$array1 = array( 1 => get_site_url(), 2 => site_url('/wp-login.php') );
$merged = array_merge($array1, $nodes);
$node_count = count($merged);

echo '<h3><strong>'.__('Total Number of Pages & Posts Scanned: ', 'bulletproof-security').'<font color="#2ea2cc">'.$node_count.'</font>'.__(' including your Home & Login pages', 'bulletproof-security').'</strong></h3>';
echo '<strong>'.__('Clickable Page & Post Links below. Links open in a new Browser Window: ', 'bulletproof-security').'</strong><br>';

		echo '<div id="cURL-Scan-Scroll" style="border:ridge;background-color:#f4f9ff;height:200px;width:600px;overflow:scroll;padding:5px;">';

	foreach ( $merged as $key => $value ) {
		$link = $value;
		echo '<strong><a href="'.$link.'" target="_blank" title="Link Opens in a new Browser Window">'.$link.'</a></strong><br>';	
	}
		echo '</div>';

$curl_arr = array();
$master = curl_multi_init();

	for($i = 0; $i < $node_count; $i++)	{
    $url = $merged[$i];
    $curl_arr[$i] = curl_init($url);
    //curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_arr[$i], CURLOPT_USERAGENT, 'BPS Pro');   
    curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_arr[$i], CURLOPT_CONNECTTIMEOUT, 15);
	@curl_setopt($curl_arr[$i], CURLOPT_FOLLOWLOCATION, true);	
    curl_multi_add_handle($master, $curl_arr[$i]);
	}

	do {
    curl_multi_exec($master, $running);
	} while($running > 0);

	for($i = 0; $i < $node_count; $i++)	{
    
	$results = curl_multi_getcontent( $curl_arr[$i] ); 
	$filterPattern1 = '/\/ga\/inpage_linkid\.js/';
	$domainName = bpsGetDomainRoot();

	if ( !is_multisite() ) { 
		preg_match_all("/https?:\/\/(.*)$domainName(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/", $results, $matches);
	}
	
	if ( is_multisite() ) { 
		preg_match_all('/https?:\/\/(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/', $results, $matches);
	}

		$pathValue = array();		
		
		foreach ( $matches[0] as $Key => $Value ) {
			// Filters
			if ( !preg_match($filterPattern1, $Value ) ) {	

				$pathValue[] = preg_replace('/https?:\/\/(.*)\/plugins/', '', $Value);
				$comma_separated = implode(', ', $pathValue);	
				$NoDupes = implode(', ', array_unique(explode(', ', $comma_separated)));
			}
		}
	}

$pattern2 = '/(\bver=\b|\bpage=\b|\bsrc=\b|\bwww\b|\bhttp\b|\bhttps\b|\bhref\b|\b.com\b|\b.net\b|\b.org\b\b.biz\b|\b.info\b|\b.gov\b|\b.edu\b)/';
$pattern3 = '/[\%\"\'\&\;\<\>]/';
//$pattern5 = '/(\/themes\/|\/plugins\/|\/wp-content\/|\/wp-includes\/|\/uploads\/)/';
$pattern5 = '/(\/plugins\/|\/wp-content\/|\/wp-includes\/)/';

		$text = '<br><strong><font color="#2ea2cc">'.__('IMPORTANT: Check that all the plugin script paths below are separated by a comma and a space.', 'bulletproof-security').'<br>'.__('If they are not separated by a comma and a space then add a comma and a space between them after you copy them to your Plugin Firewall Whitelist Text Area.', 'bulletproof-security').'<br><br>'.__('IMPORTANT: The cURL Multi Page Scanner will attempt to remove any duplicate plugin script paths.', 'bulletproof-security').'<br>'.__('If you see any duplicate plugin script paths then delete the duplicate plugin script paths after you copy them to your Plugin Firewall Whitelist Text Area.', 'bulletproof-security').'<br><br>'.__('TIP/HINT: You can use Regular Expressions code to condense plugin script whitelist rules.', 'bulletproof-security').'</font><br>'.__('If you see a lot of plugin script rules for the same plugin or the plugin script js file names are versioned (/js/my_script-5.js) then use this Regular Expressions code: (.*) shown in the example below.', 'bulletproof-security').'<br><br><font color="#2ea2cc">'.__('Example cURL scan Results & using Regular Expressions Code:', 'bulletproof-security').'</font><br>'.__('These 4 example plugin scripts are all for the same example plugin - pluginA: /plugin-A/js/pluginA-script-1.js, /pluginA/js/pluginA-script-2.js, /pluginA/js/pluginA-script-3.js, /pluginA/js/pluginA-script-4.js. These 4 example plugin script whitelist rules can be condensed into this 1 whitelist rule using Regular Expressions code: /plugin-A/js/(.*).js  The (.*) Regular Expressions code means to match anything. This one example whitelist rule: /plugin-A/js/(.*).js will now match all 4 example plugin script rules above.', 'bulletproof-security').'</strong><br>';
		echo $text;

	if ( preg_match($pattern2, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules are not valid', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and correct whitelist rules that contain any of these invalid things: ver=, page=, src=, www, http, https, href, .com, .net, .org, .biz, .info, .gov, .edu and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	if ( preg_match($pattern3, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid characters: %, ", \', &, <, > or ;', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and edit them to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	if ( preg_match($pattern5, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid paths: /plugins/ or /wp-content/ or /wp-includes/', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and edit them to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	
	echo '<h3><strong>'.__('cURL Scan Results|Plugin Firewall Whitelist Rules:', 'bulletproof-security').'</strong></h3>';		
	echo '<div id="message" style="color:black;background-color:#ffffe0;border:1px solid #999999; margin-top:9px;padding:0px 10px 0px 10px;"><p>';		
	echo htmlspecialchars($NoDupes);
	echo '</p></div><br>';

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}

?>

<form name="bpsMultiScanAllPages" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-12" method="post">
<?php wp_nonce_field('bulletproof_security_Multi_Scan_All_Pages'); ?>
<div>
    
<label for="bpsMultiScan" style="color:#2ea2cc;"><strong><?php _e('Limit Number Of Pages To Scan:', 'bulletproof-security'); ?></strong></label><br />    
<strong><?php _e('The default scan is set to scan 50 Pages/Posts', 'bulletproof-security'); ?></strong></label><br />    
    <input type="text" name="DBLimit" value="" size="50"/> <br />
    <p class="submit">
	<input type="submit" name="bpsMulti-Scan-All-Pages-Submit" value="<?php esc_attr_e('Scan', 'bulletproof-security') ?>" class="button bps-button" onclick="cURLScanUnlimited()" /></p>
</div>
</form>
</div>

<div id="CMPS1" style="border-top:3px solid #999999;">
<h3><?php _e('Multi 20 Page|Post cURL Scanner (20 Posts or Pages) - Scans up to 20 of your website Pages or Posts simultaneously for plugin scripts to add to the Plugin Firewall Whitelist', 'bulletproof-security'); ?></h3>

<?php
// cURL Multi page scanner 20 page scanner Pages or Posts - Plugin Scripts to Whitelist
if ( isset( $_POST['bpsMulti-Scan-Plugins-Submit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_Multi_Scan_Plugins' );
	set_time_limit(300);

$time_start = microtime( true );

$node1 = $_POST['node1'];
$node2 = $_POST['node2'];
$node3 = $_POST['node3'];
$node4 = $_POST['node4'];
$node5 = $_POST['node5'];
$node6 = $_POST['node6'];
$node7 = $_POST['node7'];
$node8 = $_POST['node8'];
$node9 = $_POST['node9'];
$node10 = $_POST['node10'];
$node11 = $_POST['node11'];
$node12 = $_POST['node12'];
$node13 = $_POST['node13'];
$node14 = $_POST['node14'];
$node15 = $_POST['node15'];
$node16 = $_POST['node16'];
$node17 = $_POST['node17'];
$node18 = $_POST['node18'];
$node19 = $_POST['node19'];
$node20 = $_POST['node20'];

$nodes = array($node1, $node2, $node3, $node4, $node5, $node6, $node7, $node8, $node9, $node10, $node11, $node12, $node13, $node14, $node15, $node16, $node17, $node18, $node19, $node20); 
$node_count = count($nodes);

$curl_arr = array();
$master = curl_multi_init();

	for($i = 0; $i < $node_count; $i++)	{
    $url = $nodes[$i];
    $curl_arr[$i] = curl_init($url);
    //curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_arr[$i], CURLOPT_CONNECTTIMEOUT, 15);
	@curl_setopt($curl_arr[$i], CURLOPT_FOLLOWLOCATION, true);	
    curl_multi_add_handle($master, $curl_arr[$i]);
	}

	do {
    curl_multi_exec($master,$running);
	} while($running > 0);

	for($i = 0; $i < $node_count; $i++)	{
    
	$results = curl_multi_getcontent( $curl_arr[$i] ); 
	$filterPattern1 = '/\/ga\/inpage_linkid\.js/';
	//$domainName = bpsGetDomainRoot();

	//if ( !is_multisite() ) { 
	//	preg_match_all("/http:\/\/(.*)$domainName(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/", $results, $matches);
	//}
	
	//if ( is_multisite() ) { 
		preg_match_all('/https?:\/\/(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/', $results, $matches);
	//}

		$pathValue = array();		
		
		foreach ( $matches[0] as $Key => $Value ) {
			// Filters
			if ( ! preg_match($filterPattern1, $Value ) ) {	

				$pathValue[] = preg_replace('/https?:\/\/(.*)\/plugins/', '', $Value);
				$comma_separated = implode(', ', $pathValue);	
				$NoDupes = implode(', ', array_unique(explode(', ', $comma_separated)));
			}
		}
	}

$pattern2 = '/(\bver=\b|\bpage=\b|\bsrc=\b|\bwww\b|\bhttp\b|\bhttps\b|\bhref\b|\b.com\b|\b.net\b|\b.org\b\b.biz\b|\b.info\b|\b.gov\b|\b.edu\b)/';
$pattern3 = '/[\%\"\'\&\;\<\>]/';
$pattern5 = '/(\/plugins\/|\/wp-content\/|\/wp-includes\/)/';
//$pattern5 = '/(\/themes\/|\/plugins\/|\/wp-content\/|\/wp-includes\/|\/uploads\/)/';		
		
		$text = '<br><strong><font color="#2ea2cc">'.__('IMPORTANT: Check that all the plugin script paths below are separated by a comma and a space.', 'bulletproof-security').'<br>'.__('If they are not separated by a comma and a space then add a comma and a space between them after you copy them to your Plugin Firewall Whitelist Text Area.', 'bulletproof-security').'<br><br>'.__('IMPORTANT: The cURL Multi Page Scanner will attempt to remove any duplicate plugin script paths.', 'bulletproof-security').'<br>'.__('If you see any duplicate plugin script paths then delete the duplicate plugin script paths after you copy them to your Plugin Firewall Whitelist Text Area.', 'bulletproof-security').'<br><br>'.__('TIP/HINT: You can use Regular Expressions code to condense plugin script whitelist rules.', 'bulletproof-security').'</font><br>'.__('If you see a lot of plugin script rules for the same plugin or the plugin script js file names are versioned (/js/my_script-5.js) then use this Regular Expressions code: (.*) shown in the example below.', 'bulletproof-security').'<br><br><font color="#2ea2cc">'.__('Example cURL scan Results & using Regular Expressions Code:', 'bulletproof-security').'</font><br>'.__('These 4 example plugin scripts are all for the same example plugin - pluginA: /plugin-A/js/pluginA-script-1.js, /pluginA/js/pluginA-script-2.js, /pluginA/js/pluginA-script-3.js, /pluginA/js/pluginA-script-4.js. These 4 example plugin script whitelist rules can be condensed into this 1 whitelist rule using Regular Expressions code: /plugin-A/js/(.*).js  The (.*) Regular Expressions code means to match anything. This one example whitelist rule: /plugin-A/js/(.*).js will now match all 4 example plugin script rules above.', 'bulletproof-security').'</strong><br>';
		echo $text;

	if ( preg_match($pattern2, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules are not valid', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and correct whitelist rules that contain any of these invalid things: ver=, page=, src=, www, http, https, href, .com, .net, .org, .biz, .info, .gov, .edu and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	if ( preg_match($pattern3, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid characters: %, ", \', &, <, > or ;', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and edit them to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	if ( preg_match($pattern5, $NoDupes, $matches) ) {
		$text = '<br><font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid paths: /plugins/ or /wp-content/ or /wp-includes/', 'bulletproof-security').'</font><br>'.__('Edit your Whitelist rules after copying them to the Plugin Firewall Whitelist Text Area and edit them to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	}
	
	echo '<h3><strong>'.__('cURL Scan Results|Plugin Firewall Whitelist Rules:', 'bulletproof-security').'</strong></h3>';		
	echo '<div id="message" style="color:black;background-color:#ffffe0;border:1px solid #999999; margin-top:9px;padding:0px 10px 0px 10px;"><p>';		
	echo htmlspecialchars($NoDupes);
	echo '</p></div><br>';

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}
?>

<form name="bpsMultiScanPlugins" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-12" method="post">
<?php wp_nonce_field('bulletproof_security_Multi_Scan_Plugins'); ?>
<div><label for="bpsMultiScanPlugins"><strong><?php $text = __('Example Website URL Paths to Scan', 'bulletproof-security').'<br><br>'.__('Home Page: http://www.ait-pro.com/', 'bulletproof-security').'<br>'.__('Contact Form Page: http://www.ait-pro.com/contact/', 'bulletproof-security').'<br>'.__('Login Page: http://www.ait-pro.com/wp-login.php', 'bulletproof-security').'<br>'.__('Comments Form Page: http://www.ait-pro.com/full-URL-path-to-any-website-page-that-has-a-comment-form/#show-comments', 'bulletproof-security').'<br>'.__('Multisite subdomain sites: Scan each subdomain site by adding the URL path to the subdomain site below.', 'bulletproof-security'); echo $text; ?></strong></label><br /><br />
    <input type="text" name="node1" value="" size="100"/> <br />
    <input type="text" name="node2" value="" size="100"/> <br />
    <input type="text" name="node3" value="" size="100"/> <br />
    <input type="text" name="node4" value="" size="100"/> <br />
    <input type="text" name="node5" value="" size="100"/> <br />
    <input type="text" name="node6" value="" size="100"/> <br />
    <input type="text" name="node7" value="" size="100"/> <br />
    <input type="text" name="node8" value="" size="100"/> <br />
    <input type="text" name="node9" value="" size="100"/> <br />
    <input type="text" name="node10" value="" size="100"/> <br />
    <input type="text" name="node11" value="" size="100"/> <br />
    <input type="text" name="node12" value="" size="100"/> <br />
    <input type="text" name="node13" value="" size="100"/> <br />
    <input type="text" name="node14" value="" size="100"/> <br />
    <input type="text" name="node15" value="" size="100"/> <br />
    <input type="text" name="node16" value="" size="100"/> <br />
    <input type="text" name="node17" value="" size="100"/> <br />
    <input type="text" name="node18" value="" size="100"/> <br />
    <input type="text" name="node19" value="" size="100"/> <br />
    <input type="text" name="node20" value="" size="100"/> <br />
<p class="submit">
	<input type="submit" name="bpsMulti-Scan-Plugins-Submit" value="<?php esc_attr_e('Scan', 'bulletproof-security') ?>" class="button bps-button" onclick="cURLScanTwenty()" /></p>
</div>
</form>
</div>

<?php
// cURL Multi page scanner - Search for Any Text or Any Code
if ( isset( $_POST['bpsMulti-Scan-Submit'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_Multi_Scan' );

$time_start = microtime( true );

$node1 = $_POST['node1'];
$node2 = $_POST['node2'];
$node3 = $_POST['node3'];
$node4 = $_POST['node4'];
$node5 = $_POST['node5'];
$node6 = $_POST['node6'];
$node7 = $_POST['node7'];
$node8 = $_POST['node8'];
$node9 = $_POST['node9'];
$node10 = $_POST['node10'];
$nodes = array($node1, $node2, $node3, $node4, $node5, $node6, $node7, $node8, $node9, $node10); 
$node_count = count($nodes);

$curl_arr = array();
$master = curl_multi_init();

	for($i = 0; $i < $node_count; $i++)	{
    $url = $nodes[$i];
    $curl_arr[$i] = curl_init($url);
    //curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_arr[$i], CURLOPT_CONNECTTIMEOUT, 15);
	@curl_setopt($curl_arr[$i], CURLOPT_FOLLOWLOCATION, true);	
    curl_multi_add_handle($master, $curl_arr[$i]);
	}

	do {
    curl_multi_exec($master,$running);
	} while($running > 0);

	for($i = 0; $i < $node_count; $i++)	{
    
	$results = curl_multi_getcontent( $curl_arr[$i] ); 

	$searchString = '\''.$_POST['searchString'].'\'';	

		echo '<div id="message" style="color:black;background-color:#ffffe0;border:1px solid #999999; margin-top:9px;padding:0px 10px 0px 10px;"><p>';	
		
		if ( !preg_match_all($searchString, $results, $matches) ) {
			
			echo _e('No Matches Found', 'bulletproof-security').'<br>';		
		
		} else {
		
		foreach ( $matches[0] as $Key => $Value ) {
			echo '<pre>';			
			echo _e('Match Found in Source Code: ', 'bulletproof-security').$Key.': '.htmlspecialchars($Value);
			echo '<pre>';
		}
		}
		echo '</p></div><br>';
	}

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
}
?>

<div id="CMPS1" style="border-top:3px solid #999999;">
<h3><?php _e('Multi page cURL Scan (10 Posts or Pages) - Scans up to 10 website Pages or Posts Source Code simultaneously for any Text or Code', 'bulletproof-security'); ?></h3>

<form name="bpsMultiScanPlugins" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-12" method="post">
<?php wp_nonce_field('bulletproof_security_Multi_Scan'); ?>
<div><label for="bpsMultiScan"><strong><?php $text = __('The search string can be plain text or code or a combination of both text and code, but limit the search string to as little text or code as possible in your search - See the Example below.', 'bulletproof-security').'<br>'.__('You can search outputted website pages Source code and internal js and php scripts. The Pro-Tools String Finder tool is better for searching internal scripts and will also show you the code line in the search results.', 'bulletproof-security').'<br><br>'.__('Example: Search for the eval or base64_decode functions in website pages Source code or frontloading js scripts or php scripts.', 'bulletproof-security').'<br><br>'.__('Enter A Search String', 'bulletproof-security'); echo $text; ?></strong></label><br />
 	<input type="text" name="searchString" value="" size="50"/> <br /><br />
<label for="bpsMultiScan"><strong><?php $text = __('Enter URL Paths to Scan', 'bulletproof-security'); echo $text; ?></strong></label><br />
    <input type="text" name="node1" value="" size="100"/> <br />
    <input type="text" name="node2" value="" size="100"/> <br />
    <input type="text" name="node3" value="" size="100"/> <br />
    <input type="text" name="node4" value="" size="100"/> <br />
    <input type="text" name="node5" value="" size="100"/> <br />
    <input type="text" name="node6" value="" size="100"/> <br />
    <input type="text" name="node7" value="" size="100"/> <br />
    <input type="text" name="node8" value="" size="100"/> <br />
    <input type="text" name="node9" value="" size="100"/> <br />
    <input type="text" name="node10" value="" size="100"/> <br />
    <p class="submit">
	<input type="submit" name="bpsMulti-Scan-Submit" value="<?php esc_attr_e('Scan', 'bulletproof-security') ?>" class="button bps-button" onclick="cURLScanTen()" /></p>
</div>
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

<div id="bps-tabs-13" class="bps-tab-page">
<h2><?php _e('Website Headers', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Check your website Headers or another website\'s Headers by making a GET Request', 'bulletproof-security'); ?></h3>

<?php
// Form - get_headers Headers check - GET Request Method
function bps_sysinfo_get_headers_protools_get() {
	if (isset($_POST['Submit-Headers-Check-Get']) && current_user_can('manage_options')) {
		check_admin_referer( 'bpsHeaderCheckGet' );

	$url = ( isset($_POST['bpsURLGET']) ) ? $_POST['bpsURLGET'] : '';
	$response = wp_remote_get( $url );

	if ( !is_wp_error( $response ) ) {	

	echo '<strong>'.__('GET Request Headers: ', 'bulletproof-security').'</strong>'.$url.'<br>';
	echo '<pre>';
	echo 'HTTP Status Code: ';
	print_r($response['response']['code']);
	echo ' ';
	print_r($response['response']['message']);
	echo '<br><br>';
	echo 'Headers: ';
	print_r($response['headers']);
	echo '</pre>';	

	} else {
		
		$text = '<font color="red"><strong>'.__('Error: The WordPress wp_remote_get function is not available or is blocked on your website/server.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	}
}
?>

<form name="bpsHeadersGet" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-13" method="post">
<?php wp_nonce_field('bpsHeaderCheckGet'); ?>
<div><label for="bpsHeaders"><strong><?php _e('Enter a Website URL - Example: http://www.ait-pro.com/', 'bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bpsURLGET" value="" size="50" /> <br />
    <p class="submit">
	<input type="submit" name="Submit-Headers-Check-Get" class="button bps-button" value="<?php esc_attr_e('Check Headers GET Request', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This Headers check makes a GET Request using the WordPress wp_remote_get function.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('You can use the Check Headers HEAD Request tool to check headers using HEAD instead of GET.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</div>
<?php bps_sysinfo_get_headers_protools_get(); ?>
</form>

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Check your website Headers or another website\'s Headers by making a HEAD Request', 'bulletproof-security'); ?></h3>

<?php
// Form - cURL Headers check - HEAD Request Method
function bps_sysinfo_get_headers_protools_head() {
	if (isset($_POST['Submit-Headers-Check-Head']) && current_user_can('manage_options')) {
		check_admin_referer( 'bpsHeaderCheckHead' );

	$disabled = explode(',', ini_get('disable_functions'));	

	if ( extension_loaded('curl') && !in_array('curl_init', $disabled) && !in_array('curl_exec', $disabled) && !in_array('curl_setopt', $disabled) ) {

		$url = ( isset($_POST['bpsURL']) ) ? $_POST['bpsURL'] : '';
		$useragent = 'BPS Headers Check';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_FILETIME, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true); // HEAD Request method
		$ce = curl_exec($ch);
		curl_close($ch);

		echo '<strong>'.__('HEAD Request Headers: ', 'bulletproof-security').'</strong>'.$url.'<br>';
		echo '<pre>';
		print_r($ce);
		echo '</pre>';
	
	} else {
		
		$text = '<font color="red"><strong>'.__('Error: The cURL Headers Check does not work on your website. Either the cURL Extension is not loaded or one of these functions is disabled in your php.ini file: curl_init, curl_exec and/or curl_setopt.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	}
}
?>

<form name="bpsHeadersHead" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-13" method="post">
<?php wp_nonce_field('bpsHeaderCheckHead'); ?>
<div><label for="bpsHeaders"><strong><?php _e('Enter a Website URL - Example: http://www.ait-pro.com/', 'bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bpsURL" value="" size="50" /> <br />
    <p class="submit">
	<input type="submit" name="Submit-Headers-Check-Head" class="button bps-button" value="<?php esc_attr_e('Check Headers HEAD Request', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This cURL Headers check makes a HEAD Request and you will see HTTP/1.1 403 Forbidden displayed if you are blocking HEAD Requests in your BPS root .htaccess file on your website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Use the Check Headers GET Request tool to check your headers using GET instead of HEAD. This tool can also be used to check that your Security Log is working correctly and will generate a Security Log entry when you make a HEAD Request using this tool if you are blocking HEAD Requests in your BPS root .htaccess file on your website.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</div>
<?php bps_sysinfo_get_headers_protools_head(); ?>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-14" class="bps-tab-page">
<h2><?php _e('WP Automatic Update', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Check & Turn On|Off WordPress Automatic Updates', 'bulletproof-security'); ?></h3>

<?php
		echo '<table class="widefat" style="margin-bottom:20px;">';
		echo '<thead>';
		echo '<tr>';
		echo '<th scope="col" style="width:20%;"><strong>'.__('WordPress Constant', 'bulletproof-security').'</strong></th>';
		echo '<th scope="col" style="width:80%;"><strong>'.__('What the WordPress Constant Does Depending on Which Value Is Used', 'bulletproof-security').'</strong></th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		echo '<tr>';
		
		echo '<th scope="row" style="border-bottom:none;">'.__('WP_AUTO_UPDATE_CORE', 'bulletproof-security').'</th>';
		echo '<td>'.__('define( \'WP_AUTO_UPDATE_CORE\', false ); Disables all core updates: A Constant Value of false means Development, minor and major automatic updates are all disabled.', 'bulletproof-security').'<br>'.__('define( \'WP_AUTO_UPDATE_CORE\', true ); Enables all core updates, including minor and major: A Constant Value of true means Development, minor and major automatic updates are all enabled.', 'bulletproof-security').'<br>'.__('define( \'WP_AUTO_UPDATE_CORE\', minor ); Enables core updates for minor releases (default): A Constant Value of minor means minor automatic updates are enabled. Development and major automatic updates are disabled.', 'bulletproof-security').'<br><strong>'.__('NOTE: If this Constant does NOT exist in your wp-config.php file then the default for WP Automatic updates is: minor automatic updates are enabled. Development and major automatic updates are disabled.', 'bulletproof-security').'</strong></td>';
		echo '</tr>';
		echo '<th scope="row" style="border-bottom:none;">'.__('AUTOMATIC_UPDATER_DISABLED', 'bulletproof-security').'</th>';
		echo '<td>'.__('define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Disables all types of WP automatic updates, core or otherwise: A Constant Value of true means Development, minor and major automatic updates are all disabled.', 'bulletproof-security').'<br>'.__('define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Enables WP automatic updates for minor releases: A Constant Value of false means minor automatic updates are enabled. Development and major automatic updates are disabled.', 'bulletproof-security').'<br><strong>'.__('NOTE: If this Constant does NOT exist in your wp-config.php file then the default for WP Automatic updates is: minor automatic updates are enabled. Development and major automatic updates are disabled.', 'bulletproof-security').'</strong></td>';
		echo '</tr>';			
		echo '</tbody>';
		echo '</table>';	


function bpsPro_wp_autoupdate_status_check() {

if (isset($_POST['Submit-WPAutoupdate-Check']) && current_user_can('manage_options')) {
	check_admin_referer( 'bpsWPAutoupdateCheck' );

$filename = ABSPATH . 'wp-config.php';
$subject = file_get_contents($filename);
$patternA = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)false(.*)\);/';
$patternB = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)true(.*)\);/';
$patternC = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)minor(.*)\);/';
$patternD = '/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)true(.*)\);/';
$patternE = '/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)false(.*)\);/';	
	
	if ( !file_exists($filename) ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('A wp-config.php file was NOT found in your root folder.', 'bulletproof-security').'</strong></font><br>'.__('If you have moved your wp-config.php file to a protected Server folder then you cannot use this tool to Turn WordPress Automatic Updates On or Off. You will need to manually add the WordPress Constant code in your wp-config.php file.', 'bulletproof-security');
		echo $text;
		echo '</p></div>';
	}

	if ( file_exists($filename) ) {
		
		if ( preg_match($patternA, $subject, $matches) ) {

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', false ); Constant & Value code was found in your wp-config.php file. Development, minor and major automatic updates are all disabled on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
	
		} else {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', false ); Constant & Value code was NOT found in your wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}
	
		if ( preg_match($patternB, $subject, $matches) ) {

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', true ); Constant & Value code was found in your wp-config.php file. Development, minor and major automatic updates are all enabled on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
	
		} else {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', true ); Constant & Value code was NOT found in your wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	

		if ( preg_match($patternC, $subject, $matches) ) {

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', minor ); Constant & Value code was found in your wp-config.php file. Minor automatic updates are enabled on your website. Development and major automatic updates are disabled.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
	
		} else {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', minor ); Constant & Value code was NOT found in your wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	

		if ( preg_match($patternD, $subject, $matches) ) {

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Constant & Value code was found in your wp-config.php file. Minor, major and Develpment automatic updates are all disabled on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
	
		} else {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Constant & Value code was NOT found in your wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	

		if ( preg_match($patternE, $subject, $matches) ) {

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Constant & Value code was found in your wp-config.php file. Minor automatic updates are enabled on your website. Development and major updates are disabled.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
	
		} else {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Constant & Value code was NOT found in your wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	
	} // end if ( file_exists($filename) ) {
	} // end if (isset($_POST['Submit-WPAutoupdate-Check']) && current_user_can('manage_options')) {
}

// Add or Removes WordPress Constants from the wp-config.php file to turn on or off WP autoupdates
function bpsPro_wp_autoupdate_add_remove() {

if (isset($_POST['Submit-WPAutoupdate-Add-Remove']) && current_user_can('manage_options')) {
	check_admin_referer( 'bpsWPAutoupdateAddRemove' );

$BPSoptionsWPAU = get_option('bulletproof_security_options_wp_autoupdate');
$Flockoptions = get_option('bulletproof_security_options_flock');
$filename = ABSPATH . 'wp-config.php';
$wpconfigARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
$permswpconfig = @substr(sprintf('%o', fileperms($filename)), -4);
$sapi_type = php_sapi_name();
$subject = file_get_contents($filename);
$patternA = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)false(.*)\);/';
$patternB = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)true(.*)\);/';
$patternC = '/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)minor(.*)\);/';
$patternD = '/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)true(.*)\);/';
$patternE = '/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)false(.*)\);/';	

	if ( !file_exists($filename) ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('A wp-config.php file was NOT found in your root folder.', 'bulletproof-security').'</strong></font><br>'.__('If you have moved your wp-config.php file to a protected Server folder then you cannot use this tool to Add or Remove WP Constants from your wp-config.php file. You will need to manually add or remove WordPress Constants code in your wp-config.php file.', 'bulletproof-security');
		echo $text;
		echo '</p></div>';
	}

	if ( !get_option('bulletproof_security_options_wp_autoupdate') ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('ERROR: You have not clicked the 1. Save Options button first before clicking this button. You must save the option settings you want first before clicking this button.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';				
	return;
	}

	if ( file_exists($filename) && get_option('bulletproof_security_options_wp_autoupdate') ) {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}

		$stringReplace = @file_get_contents($filename);
		
		if ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_false'] == '1' && !preg_match($patternA, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\ndefine( 'WP_AUTO_UPDATE_CORE', false );", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', false ); Constant has been added to the wp-config.php file successfully. Development, minor and major automatic updates are all disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} elseif ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_false'] == '1' && preg_match($patternA, $subject, $matches) ) {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', false ); Constant already exists in the wp-config.php file or has already been added to the wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		

		} else {
		
		if ( preg_match($patternA, $subject, $matches) ) {
			
			$stringReplace = preg_replace('/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)false(.*)\);/', "", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', false ); Constant has been removed from the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		}
		}
		
		if ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_true'] == '1' && !preg_match($patternB, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\ndefine( 'WP_AUTO_UPDATE_CORE', true );", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', true ); Constant has been added to the wp-config.php file successfully. Development, minor and major automatic updates are all enabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} elseif ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_true'] == '1' && preg_match($patternB, $subject, $matches) ) {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', true ); Constant already exists in the wp-config.php file or has already been added to the wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		

		} else {
		
		if ( preg_match($patternB, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)true(.*)\);/', "", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', true ); Constant has been removed from the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	
		}
		
		if ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_minor'] == '1' && !preg_match($patternC, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\ndefine( 'WP_AUTO_UPDATE_CORE', minor );", $stringReplace);

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', minor ); Constant has been added to the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} elseif ( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_minor'] == '1' && preg_match($patternC, $subject, $matches) ) {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', minor ); Constant already exists in the wp-config.php file or has already been added to the wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		

		} else {
		
		if ( preg_match($patternC, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WP_AUTO_UPDATE_CORE(.*)minor(.*)\);/', "", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'WP_AUTO_UPDATE_CORE\', minor ); Constant has been removed from the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';	
		}	
		}
		
		if ( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_true'] == '1' && !preg_match($patternD, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\ndefine( 'AUTOMATIC_UPDATER_DISABLED', true );", $stringReplace);

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Constant has been added to the wp-config.php file successfully. All WP automatic updates are disabled. Development, minor and major automatic updates are all disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} elseif ( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_true'] == '1' && preg_match($patternD, $subject, $matches) ) {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Constant already exists in the wp-config.php file or has already been added to the wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';			

		} else {
		
		if ( preg_match($patternD, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)true(.*)\);/', "", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', true ); Constant has been removed from the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';	
		}	
		}
		
		if ( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_false'] == '1' && !preg_match($patternE, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\ndefine( 'AUTOMATIC_UPDATER_DISABLED', false );", $stringReplace);

			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Constant has been added to the wp-config.php file successfully. minor automatic updates are enabled on your website. Development and major updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';
		
		} elseif ( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_false'] == '1' && preg_match($patternE, $subject, $matches) ) {
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="blue"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Constant already exists in the wp-config.php file or has already been added to the wp-config.php file.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';	

		} else {
		
		if ( preg_match($patternE, $subject, $matches) ) {

			$stringReplace = preg_replace('/define(.*)\((.*)AUTOMATIC_UPDATER_DISABLED(.*)false(.*)\);/', "", $stringReplace);
		
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<font color="green"><strong>'.__('The define( \'AUTOMATIC_UPDATER_DISABLED\', false ); Constant has been removed from the wp-config.php file successfully. minor automatic updates are enabled. Development and major automatic updates are disabled now on your website.', 'bulletproof-security').'</strong></font>';
			echo $text;
			echo '</p></div>';		
		}	
		}
		
		file_put_contents($filename, $stringReplace);

			if ( $Flockoptions['bps_lock_wpconfig'] == 'yes') {			
				@chmod($filename, 0400);
			}
			
		@copy($filename, $wpconfigARQ);	
	
	} // end if ( file_exists($filename) ) {
	} // end if (isset($_POST['Submit-WPAutoupdate-Check']) && current_user_can('manage_options')) {
}

?>

<div id="WPAutoupdate1" style="position:relative;top:4px;left:0px;margin:0px 0px 0px 0px;">
<form name="LoginSecurityJTC" action="options.php#bps-tabs-14" method="post">
	<?php settings_fields('bulletproof_security_options_wp_autoupdate'); ?> 
	<?php $BPSoptionsWPAU = get_option('bulletproof_security_options_wp_autoupdate'); ?>
    
 <h3><?php _e('Turn On|Off WordPress Automatic Updates', 'bulletproof-security'); ?></h3>   
    
<label><strong><?php _e('See the WordPress Constant Table above for a description of what each of these Constants and Values do.', 'bulletproof-security'); ?></strong></label><br />
<label><strong><?php _e('After saving your option settings & clicking the Add|Remove WP Constants button click the WP Automatic Update Check button to double check that your settings are the correct settings that you want for your website.', 'bulletproof-security'); ?></strong></label><br />
<label><strong><i><?php _e('Check to Add a Constant to your wp-config.php file. Uncheck to Remove a Constant from your wp-config.php file.', 'bulletproof-security'); ?></i></strong></label><br /><br />
    <input type="checkbox" name="bulletproof_security_options_wp_autoupdate[bps_WP_AUTO_UPDATE_CORE_false]" value="1" <?php checked( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_false'], 1 ); ?> /><label><?php _e(' define( \'WP_AUTO_UPDATE_CORE\', false );', 'bulletproof-security'); ?></label><br />
    <input type="checkbox" name="bulletproof_security_options_wp_autoupdate[bps_WP_AUTO_UPDATE_CORE_true]" value="1" <?php checked( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_true'], 1 ); ?> /><label><?php _e(' define( \'WP_AUTO_UPDATE_CORE\', true );', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_wp_autoupdate[bps_WP_AUTO_UPDATE_CORE_minor]" value="1" <?php checked( $BPSoptionsWPAU['bps_WP_AUTO_UPDATE_CORE_minor'], 1 ); ?> /><label><?php _e(' define( \'WP_AUTO_UPDATE_CORE\', minor );', 'bulletproof-security'); ?></label><br />    
<input type="checkbox" name="bulletproof_security_options_wp_autoupdate[bps_AUTOMATIC_UPDATER_DISABLED_true]" value="1" <?php checked( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_true'], 1 ); ?> /><label><?php _e(' define( \'AUTOMATIC_UPDATER_DISABLED\', true );', 'bulletproof-security'); ?></label><br />
<input type="checkbox" name="bulletproof_security_options_wp_autoupdate[bps_AUTOMATIC_UPDATER_DISABLED_false]" value="1" <?php checked( $BPSoptionsWPAU['bps_AUTOMATIC_UPDATER_DISABLED_false'], 1 ); ?> /><label><?php _e(' define( \'AUTOMATIC_UPDATER_DISABLED\', false );', 'bulletproof-security'); ?></label><br /><br />

<input type="submit" name="Submit-WP-Autoupdate-Save" class="button bps-button"  style="margin-top:5px;" value="<?php esc_attr_e('1. Save Options', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Clicking OK saves the option settings you have checked or unchecked to your WordPress Database. After saving your options click the 2. Add|Remove WP Constants button to Add or Remove WP Constants in your wp-config.php file.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')"/>
</form>
<br />
</div>

<div id="WPAutoupdate2" style="position:relative; top:-42px; left:140px; margin:0px 0px 0px 0px; width:200px;">
<form name="bpsWPAutoupdateAddRemove" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-14" method="post">
<?php wp_nonce_field('bpsWPAutoupdateAddRemove'); ?>
<?php bpsPro_wp_autoupdate_add_remove(); ?>
<div>
<?php //bpsPro_wp_autoupdate_status_check(); ?>
	<input type="submit" name="Submit-WPAutoupdate-Add-Remove" class="button bps-button" value="<?php esc_attr_e('2. Add|Remove WP Constants', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Clicking OK Adds or Removes the WordPress Constant\'s code in your wp-config.php file based on the options settings you saved by clicking the 1. Save Options button.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</div>
</form>
</div>  

<form name="bpsWPAutoupdateCheck" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-14" method="post">
<?php wp_nonce_field('bpsWPAutoupdateCheck'); ?>
<div>
<?php bpsPro_wp_autoupdate_status_check(); ?>
<label for="bpsWPAutoupdateCheck"><strong><?php _e('The WP Automatic Update Check button checks your wp-config.php file for the WordPress WP_AUTO_UPDATE_CORE and AUTOMATIC_UPDATER_DISABLED Constant\'s that are used to Turn On or Turn Off WP Automatic Updates. The check will also display whether or not your website currently allows WordPress automatic updates to be installed or not.', 'bulletproof-security'); ?></strong></label><br />
    <p class="submit">
	<input type="submit" name="Submit-WPAutoupdate-Check" class="button bps-button" value="<?php esc_attr_e('WP Automatic Update Check', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This WP Automatic Update Check checks your wp-config.php file for any of the WordPress Constants code used to Turn On or Turn Off WP Automatic Updates and will display the Constant code found in your wp-config.php file and whether or not your website allows or does not allow WordPress automatic updates to be installed.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</div>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-15" class="bps-tab-page">
<h2><?php _e('Force A Plugin Update Check', 'bulletproof-security'); ?></h2>
<?php if (!current_user_can('manage_options')) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<?php 
$text = '<h3 style="margin:0px 0px 5px 0px;">'.__('Clicking the Force Plugin Update Check button will delete the _site_transient_update_plugins option value from your database so that WordPress will do another Plugin update check. The AITpro API Server will also do an update check for a newer version of BPS Pro. After clicking the Force Plugin Update Check button, click the Click Here link in the displayed message to go to the WordPress Plugins page and Refresh your Browser.', 'bulletproof-security').'</h3>'; 
echo $text; 

if ( isset($_POST['Submit-Manual-Upgrade-Check']) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_manual_upgrade_check' );
	
$wp_options = $wpdb->prefix . "options";
$blank_value = '';

	if ( $plugin_update_recheck = $wpdb->query( $wpdb->prepare( "UPDATE $wp_options SET option_value = %s WHERE option_name = '_site_transient_update_plugins'", $blank_value ) ) ) {

		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('Success! ', 'bulletproof-security').'<a href="plugins.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the WordPress Plugins page and then Refresh your Browser. You will see new plugin updates if any are available.', 'bulletproof-security').'</strong></font>';
		echo $text;
    	echo $bps_bottomDiv;
	
	} else {
		
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('Error: Unable to delete the _site_transient_update_plugins option value from your database.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;
	}
}

?>

<form name="ManualUpgradeCheck" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-15" method="post">
<?php wp_nonce_field('bulletproof_security_manual_upgrade_check'); ?>
<div>
	<p class="submit">
	<input type="submit" name="Submit-Manual-Upgrade-Check" class="button bps-button" value="<?php esc_attr_e('Force Plugin Update Check', 'bulletproof-security') ?>" />
    </p>
</div>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>
<?php } ?>
</div>

<div id="bps-tabs-16" class="bps-tab-page">
<h2><?php _e('XML-RPC Exploit Checker', 'bulletproof-security'); ?></h2>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied', 'bulletproof-security'); } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 5px 0px;"><?php _e('Check your WordPress xmlrpc.php file|XML-RPC Server to see if is protected or exploitable.', 'bulletproof-security'); ?></h3>

<?php $text = __('XML-RPC is a protocol for remote procedure calls, which uses XML for the data exchange and it mostly uses HTTP for the actual call. In laymans terms WordPress XML-RPC allows you to create Posts and Pages remotely with a Weblog Client to your website without being logged into your website. The XML-RPC protocol is known to be exploitable via DDoS attack methods.', 'bulletproof-security').'<br><br><font color="#2ea2cc"><strong>'.__('IMPORTANT NOTE: ', 'bulletproof-security').'</strong></font>'.__('If you are checking your xmlrpc.php file on your website and have whitelisted your IP address using "Allow from x.x.x." in your Root .htaccess file then you will see "the WordPress xmlrpc.php file is NOT protected and is exploitable" when running this check. You can disregard this since your have whitelisted your IP address. The XML-RPC Server/Protocol/xmlrpc.php file is allowed for your IP address ONLY.', 'bulletproof-security').'<br><br>'; echo $text; ?>

<?php
// Form - Incutio XML-RPC Protocol - IXR Client/Server Check Response/Exploit Tester
function bpsPro_ixr_xmlrpc_client_exploit_checker() {
	if ( isset($_POST['Submit-XMLRPC-Check']) && current_user_can('manage_options') ) {
		check_admin_referer( 'bpsXMLRPCCheck' );

include_once(ABSPATH . 'wp-admin/includes/admin.php');
include_once(ABSPATH . WPINC . '/class-IXR.php');
include_once(ABSPATH . WPINC . '/class-wp-xmlrpc-server.php');

	$url = ( isset($_POST['bpsXMLRPC']) ) ? $_POST['bpsXMLRPC'] : '';
	$client = new IXR_ClientMulticall($url);
	$client->addCall('demo.sayHello');
	
	echo '<div id="IXR-Check" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px 0px 10px 0px;">';
	
	if ( $client->query() ) {
    
	$text = '<h2 style="color:black;">'.__('Incutio XML-RPC - IXR Client|Server Response', 'bulletproof-security').'</h2><h3 style="color:black;">'.__('URL Checked: ', 'bulletproof-security').'<font color="blue">'.$url.'</font><br><br><font color="blue">'.__('Important Note: ', 'bulletproof-security').'</font><span style="color:black;">'.__('If your IP address is whitelisted/added in the XML-RPC DDoS PROTECTION code in your Root .htaccess file then the xmlrpc.php file is still protected.', 'bulletproof-security').'<br><br>'.__('WordPress xmlrpc.php Protected Yes|No: ', 'bulletproof-security').'</span><font color="red">'.__('No, the WordPress xmlrpc.php file is NOT protected and is exploitable.', 'bulletproof-security').'</font></strong><br><br><font color="red">'.__('The Hello! Response below is a bad thing, which confirms the xmlrpc.php file & Server are NOT protected.', 'bulletproof-security').'</font></strong></h3><br>';
	$response = $client->getResponse();
	echo $text;
	
	} else {
    
	//echo '<div id="IXR-Check" style="border:2px solid black;background-color:#ffffe0;padding:5px;margin:0px 0px 10px 0px;">';
	$text = '<h2 style="color:black;">'.__('Incutio XML-RPC - IXR Client|Server Response', 'bulletproof-security').'</h2><h3 style="color:black;">'.__('URL Checked: ', 'bulletproof-security').'<font color="blue">'.$url.'</font><br><br><span style="color:black;">'.__('WordPress xmlrpc.php Protected Yes|No: ', 'bulletproof-security').'</span><font color="green">'.__('Yes, the WordPress xmlrpc.php file is protected and is NOT exploitable.', 'bulletproof-security').'</font><br><br><font color="green">'.__('The Transport Error below is a good thing, which confirms the xmlrpc.php file & Server are protected.', 'bulletproof-security').'</font><br>'.__('XML-RPC Client Query Response: ', 'bulletproof-security').$client->getErrorCode().':'.$client->getErrorMessage().'</h3><br>';
	echo $text;
	}

	if ( ! empty( $response ) ) {
	echo '<pre>';
	print_r($response);
	echo '</pre><br><br>';
	}
	echo '</div>';

	echo '<div id="IXR-Check-WP" style="color:black;border:2px solid black;background-color:#ffffe0;padding:5px;margin:10px 0px 10px 0px;">';
	$text = '<h2 style="color:black;">'.__('WordPress wp_remote_get function Headers Check', 'bulletproof-security').'</h2>';
	echo $text;
	echo bps_xmlrpc_protools_check();
	echo '</div>';
	}
}

// WP remote GET check to check the Headers/Status Response Code
function bps_xmlrpc_protools_check() {
	if ( isset($_POST['Submit-XMLRPC-Check']) && current_user_can('manage_options') ) {
		check_admin_referer( 'bpsXMLRPCCheck' );

	$url = ( isset($_POST['bpsXMLRPC']) ) ? $_POST['bpsXMLRPC'] : '';
	$response = wp_remote_get( $url );

	if ( !is_wp_error( $response ) ) {	

	if ( 403 == $response['response']['code'] ) {
		$text = '<strong>'.__('HTTP Response Status Code: ', 'bulletproof-security').'<font color="green">'.$response['response']['code'].__(' Forbidden means the xmlrpc.php file & Server are protected and are NOT exploitable.', 'bulletproof-security').'</font></strong><br>';
		echo $text;
	}
	elseif ( 404 == $response['response']['code'] ) {
		$text = '<strong>'.__('HTTP Response Status Code: ', 'bulletproof-security').'<font color="green">'.$response['response']['code'].__(' Not Found means the xmlrpc.php file has been deleted or renamed & the XML-RPC Server is protected and is NOT exploitable.', 'bulletproof-security').'</font></strong><br>';
		echo $text;	
	
	} else {
		$text = '<strong><font color="blue">'.__('Important Note: ', 'bulletproof-security').'</font>'.__('If your IP address is whitelisted/added in the XML-RPC DDoS PROTECTION code in your Root .htaccess file then the xmlrpc.php file is still protected.', 'bulletproof-security').'<br>'.__('HTTP Response Status Code: ', 'bulletproof-security').'<font color="red">'.$response['response']['code'].__(' means the xmlrpc.php file & Server are NOT protected and are exploitable.', 'bulletproof-security').'</font></strong><br>';		
		echo $text;
	}
	
	echo '<strong>'.__('GET Request Headers: ', 'bulletproof-security').'</strong>'.$url.'<br>';
	echo '<pre>';
	echo 'HTTP Status Code: ';
	print_r($response['response']['code']);
	echo ' ';
	print_r($response['response']['message']);
	echo '<br><br>';
	echo 'Headers: ';
	print_r($response['headers']);
	echo '</pre><br><br>';	

	} else {
		
		$text = '<font color="red"><strong>'.__('Error: The WordPress wp_remote_get function is not available or is blocked on your website/server.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}
	}
}

?>

<form name="bpsXMLRPCGet" action="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-16" method="post">
<?php wp_nonce_field('bpsXMLRPCCheck'); ?>
<div><label for="bpsXMLRPC"><strong><?php $text = __('Enter the URL to the WP xmlrpc.php file that you want to check<br>Example: ', 'bulletproof-security').site_url('/xmlrpc.php'); echo $text; ?></strong></label><br />
    <input type="text" name="bpsXMLRPC" value="" size="50" /> <br />
    <p class="submit">
	<input type="submit" name="Submit-XMLRPC-Check" class="button bps-button" value="<?php esc_attr_e('Check XMLRPC', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('This XMLRPC exploit checker tool uses the IXR_ClientMulticall Client class to query the WP XML-RPC Server and also makes a GET Request using the WordPress wp_remote_get function to check the Headers.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to proceed or click Cancel.', 'bulletproof-security'); echo $text; ?>')" /></p>
</div>
<?php bpsPro_ixr_xmlrpc_client_exploit_checker(); ?>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

<?php } ?>
</div>

<div id="bps-tabs-17" class="bps-tab-page">
<div id="bps_tools_help_table">
<h2><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td colspan="2" class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="admin.php?page=bulletproof-security/admin/whatsnew/whatsnew.php" target="_blank"><?php _e('Whats New in ', 'bulletproof-security'); echo BULLETPROOF_VERSION; ?></a></td>
    <td class="bps-table_cell_help_links">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/video-tutorials/" target="_blank"><?php _e('Video Tutorials', 'bulletproof-security'); ?></a></td>
    <td class="bps-table_cell_help_links"><a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank"><?php _e('BPS Pro Features & Version Release Dates', 'bulletproof-security'); ?></a></td>
  </tr>
  <tr>
    <td class="bps-table_cell_help_links"><a href="http://www.ait-pro.com/aitpro-blog/2845/bulletproof-security-pro/bulletproof-security-pro-hover-tooltips/" target="_blank"><?php _e('Read Me Help Buttons Posted As Text For Language Translation', 'bulletproof-security'); ?></a></td>
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