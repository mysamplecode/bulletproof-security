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

<?php if ( 'about.php' != $pagenow ) { ?>

<script type="text/javascript">
/* <![CDATA[ */
var bpsActTimeOut = setTimeout(function(){ bpsProActKey() }, 2000);

function bpsProActKey() {
	
	var msg = document.getElementById("bps-act-key");
	msg.style.visibility = "visible";
	
}
/* ]]> */
</script>

<div id="bps-act-key" style="visibility:hidden;position:absolute;top:450px;left:220px;width:480px;z-index:-1;border:2px solid #999999;padding:5px;background-color:#ffffe0;font-weight:bold;"><img id="bps-act-error-gif" src="<?php echo plugins_url('/bulletproof-security/admin/images/act-error.gif'); ?>" style="float:left;margin:3px 5px 0px 0px;padding:0px 0px 0px 0px;" />
<?php 
echo '<strong><font color="red">'.__('Error: Invalid|Incorrect BPS Pro Activation Key', 'bulletproof-security').'</font><br>'.__('Go to the BPS Pro Activation page and enter a valid Activation Key for this website and click the Save Activation Key button.', 'bulletproof-security').'</strong>';
?>
</div>

<?php } ?>

<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#000;">

<?php
// Obsolete file cleanup / deletion
//echo bpsRemoveObs();

// Manually runs real-time BPS Pro version update check - for testing ONLY
// echo bpsPro_update_checks();
// Manually runs PHP Error Log cron function - for testing ONLY
// echo bps_smonitor_ELogModTimeDiff_wp_email();

$bpsSpacePop = '-------------------------------------------------------------';

function bpsPro_network_domain_check_wizard() {
	global $wpdb;
	if ( $wpdb->get_var( "SHOW TABLES LIKE '$wpdb->site'" ) )
		return $wpdb->get_var( "SELECT domain FROM $wpdb->site ORDER BY id ASC LIMIT 1" );
	return false;
}

function bpsPro_get_clean_basedomain_wizard() {
	if ( $existing_domain = bpsPro_network_domain_check_wizard() )
		return $existing_domain;
	$domain = preg_replace( '|https?://|', '', get_option( 'siteurl' ) );
	if ( $slash = strpos( $domain, '/' ) )
		$domain = substr( $domain, 0, $slash );
	return $domain;
}

// Pre-installation Setup Wizard - Create Secure Root .htaccess file
function bpsSetupWizardCreateRootHtaccess() {
global $bpspro_version;
// secure.htaccess fwrite content for all WP site types
$bps_get_domain_root = bpsGetDomainRoot();
$bps_get_wp_root_default = bps_wp_get_root_folder();
// Replace ABSPATH = wp-content/plugins
$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR );
// Replace ABSPATH = wp-content
$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
// Replace ABSPATH = wp-content/uploads
$wp_upload_dir = wp_upload_dir();
$bps_uploads_dir = str_replace( ABSPATH, '', $wp_upload_dir['basedir'] );
	
	if ( is_multisite() ) {
	
	$hostname          = bpsPro_get_clean_basedomain_wizard();
	$slashed_home      = trailingslashit( get_option( 'home' ) );
	$base              = parse_url( $slashed_home, PHP_URL_PATH );
	$document_root_fix = str_replace( '\\', '/', realpath( $_SERVER['DOCUMENT_ROOT'] ) );
	$abspath_fix       = str_replace( '\\', '/', ABSPATH );
	$home_path         = 0 === strpos( $abspath_fix, $document_root_fix ) ? $document_root_fix . $base : get_home_path();
	$wp_siteurl_subdir = preg_replace( '#^' . preg_quote( $home_path, '#' ) . '#', '', $abspath_fix );
	$rewrite_base      = ! empty( $wp_siteurl_subdir ) ? ltrim( trailingslashit( $wp_siteurl_subdir ), '/' ) : '';
	$subdomain_install = is_subdomain_install();
	$subdir_match          = $subdomain_install ? '' : '([_0-9a-zA-Z-]+/)?';
	$subdir_replacement_01 = $subdomain_install ? '' : '$1';
	$subdir_replacement_12 = $subdomain_install ? '$1' : '$2';
		
		$ms_files_rewriting = '';
		if ( is_multisite() && get_site_option( 'ms_files_rewriting' ) ) {
			$ms_files_rewriting = "\n# uploaded files\nRewriteRule ^";
			$ms_files_rewriting .= $subdir_match . "files/(.+) {$rewrite_base}wp-includes/ms-files.php?file={$subdir_replacement_12} [L]" . "\n";
		}
	}

$BPSCustomCodeOptions = get_option('bulletproof_security_options_customcode');;
$bps_get_wp_root_secure = bps_wp_get_root_folder();
$bps_auto_write_secure_file = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/secure.htaccess';
$bps_auto_write_secure_file_root = ABSPATH . '.htaccess';
$bps_auto_write_secure_file_rootARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
$bps_auto_write_secure_fileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/secure.htaccess';

$bpsSuccessMessageSec = '<font color="green"><strong>'.__('Pass! secure.htaccess Root Master file htaccess creation.', 'bulletproof-security').'<br>'.__('Pass! Root Folder BulletProof Mode activation.', 'bulletproof-security').'</strong></font><br>';

$bpsFailMessageSec = '<font color="red"><strong>'.__('Error: Your BulletProof Security Root Master htaccess file cannot be created.', 'bulletproof-security').'</strong></font><br><strong>'.__('If your Server configuration is DSO you must first make some one-time manual changes to your website before running the Setup Wizard. Please click this Forum Link for instructions: ', 'bulletproof-security').' <a href="http://forum.ait-pro.com/forums/topic/dso-setup-steps/" target="_blank" title="Link opens in a new Browser window">'.__('DSO Setup Steps', 'bulletproof-security').'</a></strong><br>';

if ( ! is_multisite() && $BPSCustomCodeOptions['bps_customcode_wp_rewrite_start'] != '' ) {        
$bpsBeginWP = "# CUSTOM CODE WP REWRITE LOOP START\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_wp_rewrite_start'], ENT_QUOTES ) . "\n\n";
} else {
$bpsBeginWP = "# WP REWRITE LOOP START
RewriteEngine On
RewriteBase $bps_get_wp_root_default
RewriteRule ^index\.php$ - [L]\n";
}

// Network/Multisite all site types and versions
if ( is_multisite() ) {
if ( $BPSCustomCodeOptions['bps_customcode_wp_rewrite_start'] != '' ) {    
$bpsMUSDirTop = "# CUSTOM CODE WP REWRITE LOOP START\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_wp_rewrite_start'], ENT_QUOTES ) . "\n\n";
} else {
$bpsMUSDirTop = "# WP REWRITE LOOP START
RewriteEngine On
RewriteBase $bps_get_wp_root_default
RewriteRule ^index\.php$ - [L]\n
{$ms_files_rewriting}
# add a trailing slash to /wp-admin
RewriteRule ^{$subdir_match}wp-admin$ {$subdir_replacement_01}wp-admin/ [R=301,L]\n\n";
}

// Network/Multisite all site types and versions
if ( $BPSCustomCodeOptions['bps_customcode_wp_rewrite_end'] != '' ) {    
$bpsMUSDirBottom = "# CUSTOM CODE WP REWRITE LOOP END\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_wp_rewrite_end'], ENT_QUOTES ) . "\n\n";
} else {
$bpsMUSDirBottom = "RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^ - [L]
RewriteRule ^{$subdir_match}(wp-(content|admin|includes).*) {$rewrite_base}{$subdir_replacement_12} [L]
RewriteRule ^{$subdir_match}(.*\.php)$ {$rewrite_base}$subdir_replacement_12 [L]
RewriteRule . index.php [L]
# WP REWRITE LOOP END\n";
}
}

$bps_secure_content_top = "#   BULLETPROOF PRO $bpspro_version SECURE .HTACCESS          \n\n";

if ( $BPSCustomCodeOptions['bps_customcode_one'] != '' ) {
$bps_secure_phpini_cache = "# CUSTOM CODE TOP PHP/PHP.INI HANDLER/CACHE CODE\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_one'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_phpini_cache = "# PHP/PHP.INI HANDLER/CACHE CODE
# Use BPS Custom Code to add php/php.ini Handler and Cache htaccess code and to save it permanently.
# Most Hosts do not have/use/require php/php.ini Handler htaccess code\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_server_signature'] != '' ) {
$bps_server_signature = "# CUSTOM CODE TURN OFF YOUR SERVER SIGNATURE\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_server_signature'], ENT_QUOTES ) . "\n\n";
} else {
$bps_server_signature = "# TURN OFF YOUR SERVER SIGNATURE
# Suppresses the footer line server version number and ServerName of the serving virtual host
ServerSignature Off\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_directory_index'] != '' ) {        
$bps_secure_directory_list_index = "# CUSTOM CODE DIRECTORY LISTING/DIRECTORY INDEX\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_directory_index'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_directory_list_index = "# DO NOT SHOW DIRECTORY LISTING
# Disallow mod_autoindex from displaying a directory listing
# If a 500 Internal Server Error occurs when activating Root BulletProof Mode 
# copy the entire DO NOT SHOW DIRECTORY LISTING and DIRECTORY INDEX sections of code 
# and paste it into BPS Custom Code and comment out Options -Indexes 
# by adding a # sign in front of it.
# Example: #Options -Indexes
Options -Indexes\n
# DIRECTORY INDEX FORCE INDEX.PHP
# Use index.php as default directory index file. index.html will be ignored.
# If a 500 Internal Server Error occurs when activating Root BulletProof Mode 
# copy the entire DO NOT SHOW DIRECTORY LISTING and DIRECTORY INDEX sections of code 
# and paste it into BPS Custom Code and comment out DirectoryIndex 
# by adding a # sign in front of it.
# Example: #DirectoryIndex index.php index.html /index.php
DirectoryIndex index.php index.html /index.php\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_server_protocol'] != '' ) {        
$bps_secure_brute_force_login = "# CUSTOM CODE BRUTE FORCE LOGIN PAGE PROTECTION\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_server_protocol'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_brute_force_login = "# BRUTE FORCE LOGIN PAGE PROTECTION
# PLACEHOLDER ONLY
# Use BPS Custom Code to add Brute Force Login protection code and to save it permanently.
# See this link: http://forum.ait-pro.com/forums/topic/protect-login-page-from-brute-force-login-attacks/
# for more information.\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_error_logging'] != '' ) {        
$bps_secure_error_logging = "# CUSTOM CODE ERROR LOGGING AND TRACKING\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_error_logging'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_error_logging = "# BPS PRO ERROR LOGGING AND TRACKING
# Use BPS Custom Code to modify/edit/change this code and to save it permanently.
# BPS Pro has premade 403 Forbidden, 400 Bad Request and 404 Not Found files that are used 
# to track and log 403, 400 and 404 errors that occur on your website. When a hacker attempts to
# hack your website the hackers IP address, Host name, Request Method, Referering link, the file name or
# requested resource, the user agent of the hacker and the query string used in the hack attempt are logged.
# All BPS Pro log files are htaccess protected so that only you can view them. 
# The 400.php, 403.php and 404.php files are located in /$bps_plugin_dir/bulletproof-security/
# The 400 and 403 Error logging files are already set up and will automatically start logging errors
# after you install BPS Pro and have activated BulletProof Mode for your Root folder.
# If you would like to log 404 errors you will need to copy the logging code in the BPS Pro 404.php file
# to your Theme's 404.php template file. Simple instructions are included in the BPS Pro 404.php file.
# You can open the BPS Pro 404.php file using the WP Plugins Editor or by using the BPS Pro File Manager.
# NOTE: By default WordPress automatically looks in your Theme's folder for a 404.php Theme template file.\n
ErrorDocument 400 " . $bps_get_wp_root_secure . $bps_plugin_dir . "/bulletproof-security/400.php
ErrorDocument 401 default
ErrorDocument 403 " . $bps_get_wp_root_secure . $bps_plugin_dir . "/bulletproof-security/403.php
ErrorDocument 404 " . $bps_get_wp_root_secure . "404.php\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_deny_dot_folders'] != '' ) {        
$bps_secure_dot_server_files = "# CUSTOM CODE DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_deny_dot_folders'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_dot_server_files = "# DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS
# Use BPS Custom Code to modify/edit/change this code and to save it permanently.
# Files and folders starting with a dot: .htaccess, .htpasswd, .errordocs, .logs
RedirectMatch 403 \.(htaccess|htpasswd|errordocs|logs)$\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_admin_includes'] != '' ) {        
$bps_secure_content_wpadmin = "# CUSTOM CODE WP-ADMIN/INCLUDES\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_admin_includes'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_content_wpadmin = "# WP-ADMIN/INCLUDES
# Use BPS Custom Code to remove this code permanently.
RewriteEngine On
RewriteBase $bps_get_wp_root_secure
RewriteRule ^wp-admin/includes/ - [F]
RewriteRule !^wp-includes/ - [S=3]
RewriteRule ^wp-includes/[^/]+\.php$ - [F]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F]
RewriteRule ^wp-includes/theme-compat/ - [F]\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_request_methods'] != '' ) {        
$bps_secure_request_methods = "# CUSTOM CODE REQUEST METHODS FILTERED\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_request_methods'], ENT_QUOTES)."\n\n";
} else {
$bps_secure_request_methods = "\n# REQUEST METHODS FILTERED
# If you want to allow HEAD Requests use BPS Custom Code and 
# remove/delete HEAD| from the Request Method filter.
# Example: RewriteCond %{REQUEST_METHOD} ^(TRACE|DELETE|TRACK|DEBUG) [NC]
# The TRACE, DELETE, TRACK and DEBUG Request methods should never be removed.
RewriteCond %{REQUEST_METHOD} ^(HEAD|TRACE|DELETE|TRACK|DEBUG) [NC]
RewriteRule ^(.*)$ - [F]\n\n";
}

$bps_secure_begin_plugins_skip_rules_text = "# PLUGINS/THEMES AND VARIOUS EXPLOIT FILTER SKIP RULES
# To add plugin/theme skip/bypass rules use BPS Custom Code.
# The [S] flag is used to skip following rules. Skip rule [S=12] will skip 12 following RewriteRules.
# The skip rules MUST be in descending consecutive number order: 12, 11, 10, 9...
# If you delete a skip rule, change the other skip rule numbers accordingly.
# Examples: If RewriteRule [S=5] is deleted than change [S=6] to [S=5], [S=7] to [S=6], etc.
# If you add a new skip rule above skip rule 12 it will be skip rule 13: [S=13]\n\n";

// AutoMagic - Plugin/Theme skip/bypass rules
$bps_secure_plugins_themes_skip_rules = '';
if ( $BPSCustomCodeOptions['bps_customcode_two'] != '' ) {
$bps_secure_plugins_themes_skip_rules = "# CUSTOM CODE PLUGIN/THEME SKIP/BYPASS RULES\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_two'], ENT_QUOTES ) . "\n\n";
}

$bps_secure_default_skip_rules = "# Adminer MySQL management tool data populate
RewriteCond %{REQUEST_URI} ^" . $bps_get_wp_root_secure . $bps_plugin_dir . "/adminer/ [NC]
RewriteRule . - [S=12]
# Comment Spam Pack MU Plugin - CAPTCHA images not displaying 
RewriteCond %{REQUEST_URI} ^". $bps_get_wp_root_secure . $bps_wpcontent_dir . "/mu-plugins/custom-anti-spam/ [NC]
RewriteRule . - [S=11]
# Peters Custom Anti-Spam display CAPTCHA Image
RewriteCond %{REQUEST_URI} ^" . $bps_get_wp_root_secure . $bps_plugin_dir . "/peters-custom-anti-spam-image/ [NC] 
RewriteRule . - [S=10]
# Status Updater plugin fb connect
RewriteCond %{REQUEST_URI} ^" . $bps_get_wp_root_secure . $bps_plugin_dir . "/fb-status-updater/ [NC] 
RewriteRule . - [S=9]
# Stream Video Player - Adding FLV Videos Blocked
RewriteCond %{REQUEST_URI} ^" . $bps_get_wp_root_secure . $bps_plugin_dir . "/stream-video-player/ [NC]
RewriteRule . - [S=8]
# XCloner 404 or 403 error when updating settings
RewriteCond %{REQUEST_URI} ^" . $bps_get_wp_root_secure . $bps_plugin_dir . "/xcloner-backup-and-restore/ [NC]
RewriteRule . - [S=7]
# BuddyPress Logout Redirect
RewriteCond %{QUERY_STRING} action=logout&redirect_to=http%3A%2F%2F(.*) [NC]
RewriteRule . - [S=6]
# redirect_to=
RewriteCond %{QUERY_STRING} redirect_to=(.*) [NC]
RewriteRule . - [S=5]
# Login Plugins Password Reset And Redirect 1
RewriteCond %{QUERY_STRING} action=resetpass&key=(.*) [NC]
RewriteRule . - [S=4]
# Login Plugins Password Reset And Redirect 2
RewriteCond %{QUERY_STRING} action=rp&key=(.*) [NC]
RewriteRule . - [S=3]\n\n";

if ( $BPSCustomCodeOptions['bps_customcode_timthumb_misc'] != '' ) {        
$bps_secure_timthumb_misc = "# CUSTOM CODE TIMTHUMB FORBID RFI and MISC FILE SKIP/BYPASS RULE\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_timthumb_misc'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_timthumb_misc = "# TIMTHUMB FORBID RFI and MISC FILE SKIP/BYPASS RULE
# Use BPS Custom Code to modify/edit/change this code and to save it permanently.
# Remote File Inclusion (RFI) security rules
# Note: Only whitelist your additional domains or files if needed - do not whitelist hacker domains or files
RewriteCond %{QUERY_STRING} ^.*(http|https|ftp)(%3A|:)(%2F|/)(%2F|/)(w){0,3}.?(blogger|picasa|blogspot|tsunami|petapolitik|photobucket|imgur|imageshack|wordpress\.com|img\.youtube|tinypic\.com|upload\.wikimedia|kkc|start-thegame).*$ [NC,OR]
RewriteCond %{THE_REQUEST} ^.*(http|https|ftp)(%3A|:)(%2F|/)(%2F|/)(w){0,3}.?(blogger|picasa|blogspot|tsunami|petapolitik|photobucket|imgur|imageshack|wordpress\.com|img\.youtube|tinypic\.com|upload\.wikimedia|kkc|start-thegame).*$ [NC]
RewriteRule .* index.php [F]
# 
# Example: Whitelist additional misc files: (example\.php|another-file\.php|phpthumb\.php|thumb\.php|thumbs\.php)
RewriteCond %{REQUEST_URI} (timthumb\.php|phpthumb\.php|thumb\.php|thumbs\.php) [NC]
# Example: Whitelist additional website domains: RewriteCond %{HTTP_REFERER} ^.*(YourWebsite.com|AnotherWebsite.com).*
RewriteCond %{HTTP_REFERER} ^.*" . $bps_get_domain_root . ".*
RewriteRule . - [S=1]\n\n";
}

if ( $BPSCustomCodeOptions['bps_customcode_bpsqse'] != '' ) {        
$bps_secure_BPSQSE = "# CUSTOM CODE BPSQSE BPS QUERY STRING EXPLOITS\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_bpsqse'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_BPSQSE = "# BEGIN BPSQSE BPS QUERY STRING EXPLOITS
# The libwww-perl User Agent is forbidden - Many bad bots use libwww-perl modules, but some good bots use it too.
# Good sites such as W3C use it for their W3C-LinkChecker. 
# Use BPS Custom Code to add or remove user agents temporarily or permanently from the 
# User Agent filters directly below or to modify/edit/change any of the other security code rules below.
RewriteCond %{HTTP_USER_AGENT} (havij|libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} (%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{HTTP_USER_AGENT} (;|<|>|'|".'"'."|\)|\(|%0A|%0D|%22|%27|%28|%3C|%3E|%00).*(libwww-perl|wget|python|nikto|curl|scan|java|winhttp|HTTrack|clshttp|archiver|loader|email|harvest|extract|grab|miner) [NC,OR]
RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\s+|%20+\\\\s+|\\\\s+%20+|\\\\s+%20+\\\\s+)HTTP(:/|/) [NC,OR]
RewriteCond %{THE_REQUEST} etc/passwd [NC,OR]
RewriteCond %{THE_REQUEST} cgi-bin [NC,OR]
RewriteCond %{THE_REQUEST} (%0A|%0D|\\"."\\"."r|\\"."\\"."n) [NC,OR]
RewriteCond %{REQUEST_URI} owssvr\.dll [NC,OR]
RewriteCond %{HTTP_REFERER} (%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{HTTP_REFERER} \.opendirviewer\. [NC,OR]
RewriteCond %{HTTP_REFERER} users\.skynet\.be.* [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=http:// [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=(\.\.//?)+ [NC,OR]
RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=/([a-z0-9_.]//?)+ [NC,OR]
RewriteCond %{QUERY_STRING} \=PHP[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12} [NC,OR]
RewriteCond %{QUERY_STRING} (\.\./|%2e%2e%2f|%2e%2e/|\.\.%2f|%2e\.%2f|%2e\./|\.%2e%2f|\.%2e/) [NC,OR]
RewriteCond %{QUERY_STRING} ftp\: [NC,OR]
RewriteCond %{QUERY_STRING} http\: [NC,OR] 
RewriteCond %{QUERY_STRING} https\: [NC,OR]
RewriteCond %{QUERY_STRING} \=\|w\| [NC,OR]
RewriteCond %{QUERY_STRING} ^(.*)/self/(.*)$ [NC,OR]
RewriteCond %{QUERY_STRING} ^(.*)cPath=http://(.*)$ [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*script.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^s]*s)+cript.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*embed.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^e]*e)+mbed.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*object.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^o]*o)+bject.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (\<|%3C).*iframe.*(\>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} (<|%3C)([^i]*i)+frame.*(>|%3E) [NC,OR] 
RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) [NC,OR]
RewriteCond %{QUERY_STRING} base64_(en|de)code[^(]*\([^)]*\) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>|%3c|%3e).* [NC,OR]
RewriteCond %{QUERY_STRING} ^.*(\\x00|\\x04|\\x08|\\x0d|\\x1b|\\x20|\\x3c|\\x3e|\\x7f).* [NC,OR]
RewriteCond %{QUERY_STRING} (NULL|OUTFILE|LOAD_FILE) [OR]
RewriteCond %{QUERY_STRING} (\.{1,}/)+(motd|etc|bin) [NC,OR]
RewriteCond %{QUERY_STRING} (localhost|loopback|127\.0\.0\.1) [NC,OR]
RewriteCond %{QUERY_STRING} (<|>|'|%0A|%0D|%27|%3C|%3E|%00) [NC,OR]
RewriteCond %{QUERY_STRING} concat[^\(]*\( [NC,OR]
RewriteCond %{QUERY_STRING} union([^s]*s)+elect [NC,OR]
RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]
RewriteCond %{QUERY_STRING} \-[sdcr].*(allow_url_include|allow_url_fopen|safe_mode|disable_functions|auto_prepend_file) [NC,OR]
RewriteCond %{QUERY_STRING} (;|<|>|'|".'"'."|\)|%0A|%0D|%22|%27|%3C|%3E|%00).*(/\*|union|select|insert|drop|delete|update|cast|create|char|convert|alter|declare|order|script|set|md5|benchmark|encode) [NC,OR]
RewriteCond %{QUERY_STRING} (sp_executesql) [NC]
RewriteRule ^(.*)$ - [F]
# END BPSQSE BPS QUERY STRING EXPLOITS\n";
}

$bps_secure_wp_rewrite_loop_end = "RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . " . $bps_get_wp_root_secure . "index.php [L]
# WP REWRITE LOOP END\n";

if ( $BPSCustomCodeOptions['bps_customcode_deny_files'] != '' ) {        
$bps_secure_deny_browser_access = "# CUSTOM CODE DENY BROWSER ACCESS TO THESE FILES\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_deny_files'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_deny_browser_access = "\n# DENY BROWSER ACCESS TO THESE FILES 
# Use BPS Custom Code to modify/edit/change this code and to save it permanently.
# wp-config.php, bb-config.php, php.ini, php5.ini, readme.html
# Replace 88.77.66.55 with your current IP address and remove the  
# pound sign # in front of the Allow from line of code below to be able to access
# any of these files directly from your Browser.\n
<FilesMatch ".'"'."^(wp-config\.php|php\.ini|php5\.ini|readme\.html|bb-config\.php)".'"'.">
Order Allow,Deny
Deny from all
#Allow from 88.77.66.55
</FilesMatch>\n\n";
}

// AutoMagic - CUSTOM CODE BOTTOM
$bps_secure_bottom_misc_code = '';
if ( $BPSCustomCodeOptions['bps_customcode_three'] != '' ) {
$bps_secure_bottom_misc_code = "# CUSTOM CODE BOTTOM HOTLINKING/FORBID COMMENT SPAMMERS/BLOCK BOTS/BLOCK IP/REDIRECT CODE\n" . htmlspecialchars_decode( $BPSCustomCodeOptions['bps_customcode_three'], ENT_QUOTES ) . "\n\n";
} else {
$bps_secure_bottom_misc_code = "# HOTLINKING/FORBID COMMENT SPAMMERS/BLOCK BOTS/BLOCK IP/REDIRECT CODE
# PLACEHOLDER ONLY
# Use BPS Custom Code to add custom code and save it permanently here.\n";
}

	$permsRootHtaccess = @substr(sprintf('%o', fileperms($bps_auto_write_secure_file_root)), -4);
	$sapi_type = php_sapi_name();
	
	if 	( file_exists($bps_auto_write_secure_file_root) && @$permsRootHtaccess == '0404') {
		$lock = '0404';			
	}
	
	if ( file_exists($bps_auto_write_secure_file_root) && @substr($sapi_type, 0, 6) != 'apache' && @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777') { 
		@chmod($bps_auto_write_secure_file_root, 0644);
	}	

// Single/Standard WordPress site type: Create secure.htaccess Master File
if ( !is_multisite() ) {

	$stringReplace = file_get_contents($bps_auto_write_secure_file);

	if ( file_exists($bps_auto_write_secure_file) ) {
		$stringReplace = $bps_secure_content_top.$bps_secure_phpini_cache.$bps_server_signature.$bps_secure_directory_list_index.$bps_secure_brute_force_login.$bps_secure_error_logging.$bps_secure_dot_server_files.$bps_secure_content_wpadmin.$bpsBeginWP.$bps_secure_request_methods.$bps_secure_begin_plugins_skip_rules_text.$bps_secure_plugins_themes_skip_rules.$bps_secure_default_skip_rules.$bps_secure_timthumb_misc.$bps_secure_BPSQSE.$bps_secure_wp_rewrite_loop_end.$bps_secure_deny_browser_access.$bps_secure_bottom_misc_code;		
		
		if ( file_put_contents( $bps_auto_write_secure_file, $stringReplace ) ) {
			@copy($bps_auto_write_secure_file, $bps_auto_write_secure_file_root);
			@copy($bps_auto_write_secure_file, $bps_auto_write_secure_fileARQ);
    		
			echo $bpsSuccessMessageSec;
		
		} else {
		
    		echo $bpsFailMessageSec;
		}
	}

	if ( $lock == '0404') {	
		@chmod($bps_auto_write_secure_file_root, 0404);
	}
}

// Network site type: Create secure.htaccess Master File
if ( is_multisite() && is_super_admin() ) { 

		$stringReplace = file_get_contents($bps_auto_write_secure_file);

	if ( file_exists($bps_auto_write_secure_file) ) {
		$stringReplace = $bps_secure_content_top.$bps_secure_phpini_cache.$bps_server_signature.$bps_secure_directory_list_index.$bps_secure_brute_force_login.$bps_secure_error_logging.$bps_secure_dot_server_files.$bpsMUSDirTop.$bps_secure_request_methods.$bps_secure_begin_plugins_skip_rules_text.$bps_secure_plugins_themes_skip_rules.$bps_secure_default_skip_rules.$bps_secure_timthumb_misc.$bps_secure_BPSQSE.$bpsMUSDirBottom.$bps_secure_deny_browser_access.$bps_secure_bottom_misc_code;		
		
		if ( file_put_contents( $bps_auto_write_secure_file, $stringReplace ) ) {
			@copy($bps_auto_write_secure_file, $bps_auto_write_secure_file_root);
			@copy($bps_auto_write_secure_file, $bps_auto_write_secure_fileARQ);
    		
			echo $bpsSuccessMessageSec;
		
		} else {
		
    		echo $bpsFailMessageSec;
		}
	}
	
	if ( $lock == '0404') {	
		@chmod($bps_auto_write_secure_file_root, 0404);
	}
}
}

// Pre-installation Setup Wizard - Create wp-admin htaccess file
function bpsSetupWizardCreateWpadminHtaccess() {
$options = get_option('bulletproof_security_options_customcode_WPA');  

$bpsSuccessMessageSec = '<font color="green"><strong>'.__('Pass! wp-admin BulletProof Mode activation.', 'bulletproof-security').'</strong></font><br>';
$bpsFailMessageSec = '<br><font color="red"><strong>'.__('Error: wp-admin BulletProof Mode cannot be activated.', 'bulletproof-security').'</strong></font><br><strong>'.__('If your Server configuration is DSO you must first make some one-time manual changes to your website before running the Setup Wizard. Please click this Forum Link for instructions: ', 'bulletproof-security').' <a href="http://forum.ait-pro.com/forums/topic/dso-setup-steps/" target="_blank" title="Link opens in a new Browser window">'.__('DSO Setup Steps', 'bulletproof-security').'</a></strong><br>';

	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		$text = '<font color="blue"><strong>'.__('Go Daddy Managed WordPress Hosting option is set to Yes or wp-admin BulletProof Mode is disabled on the Security Modes page. GDMW hosting does not allow wp-admin htaccess files.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	return;
	}

	$wpadminMasterHtaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/wpadmin-secure.htaccess';
	$wpadminActiveHtaccess = ABSPATH . 'wp-admin/.htaccess';
	$wpadminARQHtaccess = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($wpadminActiveHtaccess)), -4);
	$sapi_type = php_sapi_name();
	$bpsString1 = "# CCWTOP";
	$bpsString2 = "# CCWPF";
	$bpsString3 = '/#\sBEGIN\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES(.*)#\sEND\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES/s';
	$bpsString4 = '/#\sBEGIN\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS(.*)#\sEND\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS/s';
	$bpsReplace1 = htmlspecialchars_decode($options['bps_customcode_one_wpa'], ENT_QUOTES);
	$bpsReplace2 = htmlspecialchars_decode($options['bps_customcode_two_wpa'], ENT_QUOTES);
	$bpsReplace3 = htmlspecialchars_decode($options['bps_customcode_deny_files_wpa'], ENT_QUOTES);	
	$bpsReplace4 = htmlspecialchars_decode($options['bps_customcode_bpsqse_wpa'], ENT_QUOTES);	
	
	if ( @substr($sapi_type, 0, 6) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
		@chmod($wpadminActiveHtaccess, 0644);
	}

	if ( @copy($wpadminMasterHtaccess, $wpadminActiveHtaccess) ) {
		echo $bpsSuccessMessageSec;
	} else {
		echo $bpsFailMessageSec;	
	}
	
	if ( file_exists($wpadminActiveHtaccess) ) {
		$bpsBaseContent = @file_get_contents($wpadminActiveHtaccess);
		if ( $options['bps_customcode_deny_files_wpa'] != '') {        
			$bpsBaseContent = preg_replace('/#\sBEGIN\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES(.*)#\sEND\sBPS\sWPADMIN\sDENY\sACCESS\sTO\sFILES/s', $bpsReplace3, $bpsBaseContent);
		}
		if ( $options['bps_customcode_bpsqse_wpa'] != '') {        
			$bpsBaseContent = preg_replace('/#\sBEGIN\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS(.*)#\sEND\sBPSQSE-check\sBPS\sQUERY\sSTRING\sEXPLOITS\sAND\sFILTERS/s', $bpsReplace4, $bpsBaseContent);
		}
		$bpsBaseContent = str_replace($bpsString1, $bpsReplace1, $bpsBaseContent);
		$bpsBaseContent = str_replace($bpsString2, $bpsReplace2, $bpsBaseContent);
		@file_put_contents($wpadminActiveHtaccess, $bpsBaseContent);
		@copy($wpadminActiveHtaccess, $wpadminARQHtaccess);
	}
}

// Setup Wizard - Add ini_set options to wp-config.php - wp-config.php will be locked by the Wizard later in the Setup process
function bpsSetupWizardIniSetOptions() {
	
	if ( current_user_can('manage_options') ) {

	$SWflockPreCheck = get_option('bulletproof_security_options_setup_wizard_flock');
	$options = get_option('bulletproof_security_options_iniSet');
	$filename = ABSPATH . 'wp-config.php';
	$permswpconfig = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();
	$wpconfigBackup = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';
	$subject = file_get_contents($filename);
	$pattern = '/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s';
	$pattern2 = '/\* That\'s all, stop editing! Happy blogging. \*/';	

	$replacement = "/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/";

	$successTextBegin = '<font color="green"><strong>';
	$successTextEnd = '</strong></font><br>';
	$failTextBegin = '<font color="red"><strong>';
	$failTextEnd = '</strong></font><br>';	

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files' ) ) {
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/autorestore/root-files'.__(' Folder created Successfully!', 'bulletproof-security').$successTextEnd;	
	
	} else {
	
	if ( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files' ) ) {
		mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/', 0755 );
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/autorestore/root-files'.__(' Folder created Successfully!', 'bulletproof-security').$successTextEnd;
	}
	}

	if ( !file_exists($filename) ) {
		echo '<br>'.$failTextBegin.__('Error: A wp-config.php file was NOT found in your website root folder.', 'bulletproof-security').$failTextEnd.__('If you have moved your wp-config.php file to another folder location then you will need to add the BPS Pro ini_set code to your wp-config.php file manually.', 'bulletproof-security').'<br>'.__('The BPS ini_set code can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config. Setup instructions are included in the file.', 'bulletproof-security').'<br>';
	}

	// This writes the ini_set code again if the Setup Wizard is run again and the old ini_set code already exists - English or non-English Versions of WP
	if ( file_exists($filename) && preg_match($pattern, $subject, $matches) && $options['bps_iniSet_ErrorLog'] != '' && $options['bps_iniSet_LogErrorsMaxLen'] != '' && $options['bps_iniSet_MemoryLimit'] != '' && $options['bps_iniSet_MaxExecutionTime'] != '' && $options['bps_iniSet_MysqlConnectTimeout'] != '') {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}		
		
		$stringReplace = @file_get_contents($filename);
		$stringReplace = preg_replace('/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s', $replacement, $stringReplace);
		
		if ( file_put_contents($filename, $stringReplace) ) {		
			@copy($filename, $wpconfigBackup);	
			echo $successTextBegin.__(' ini_set Options created in wp-config.php Successfully!', 'bulletproof-security').$successTextEnd;
			echo $successTextBegin.$wpconfigBackup.__(' copied to AutoRestore Backup Successfully!', 'bulletproof-security').$successTextEnd;
			
			// checking the DB value for the root .htaccess is correct and not a mistake
			if ( $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'yes') {
				@chmod($filename, 0400);
			}		
		}
	}

	// This writes new ini_set code if it does NOT exist and the * That's all, stop editing! Happy blogging. * text exists - English WP Version
	if ( file_exists($filename) && !preg_match($pattern, $subject, $matches) && preg_match($pattern2, $subject, $matches) && $options['bps_iniSet_ErrorLog'] != '' && $options['bps_iniSet_LogErrorsMaxLen'] != '' && $options['bps_iniSet_MemoryLimit'] != '' && $options['bps_iniSet_MaxExecutionTime'] != '' && $options['bps_iniSet_MysqlConnectTimeout'] != '') {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}	
		
		$stringReplace = @file_get_contents($filename);

$stringReplace = str_replace("/* That's all, stop editing! Happy blogging. */", "/* That's all, stop editing! Happy blogging. */\n
/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/
", $stringReplace);
		
		if ( file_put_contents($filename, $stringReplace) ) {
			@copy($filename, $wpconfigBackup);	
			echo $successTextBegin.__(' ini_set Options created in wp-config.php Successfully!', 'bulletproof-security').$successTextEnd;
			echo $successTextBegin.$wpconfigBackup.__(' copied to AutoRestore Backup Successfully!', 'bulletproof-security').$successTextEnd;
			
			if ( $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'yes') {
				@chmod($filename, 0400);
			}			
		}
	}

	// This writes new ini_set code if it does NOT exist and the * That's all, stop editing! Happy blogging. * text does NOT exist - non-English version of WP
	if ( file_exists($filename) && !preg_match($pattern, $subject, $matches) && !preg_match($pattern2, $subject, $matches) && $options['bps_iniSet_ErrorLog'] != '' && $options['bps_iniSet_LogErrorsMaxLen'] != '' && $options['bps_iniSet_MemoryLimit'] != '' && $options['bps_iniSet_MaxExecutionTime'] != '' && $options['bps_iniSet_MysqlConnectTimeout'] != '') {
		
		if ( @substr($sapi_type, 0, 6) != 'apache' || @$permswpconfig != '0666' || @$permswpconfig != '0777') { // Windows IIS, XAMPP, etc
			@chmod($filename, 0644);
		}	
		
		$stringReplace = @file_get_contents($filename);

$stringReplace = preg_replace('/define(.*)\((.*)WPLANG(.*)\);/', "define('WPLANG', '".WPLANG."');\n
/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','".$options['bps_iniSet_session_cookie_httponly']."');
@ini_set('session.use_only_cookies','".$options['bps_iniSet_session_use_only_cookies']."');
@ini_set('session.cookie_secure','".$options['bps_iniSet_session_cookie_secure']."');
@ini_set('ignore_repeated_errors','".$options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/
", $stringReplace);
		
		if ( file_put_contents($filename, $stringReplace) ) {
			@copy($filename, $wpconfigBackup);	
			echo $successTextBegin.__(' ini_set Options created in wp-config.php Successfully!', 'bulletproof-security').$successTextEnd;
			echo $successTextBegin.$wpconfigBackup.__(' copied to AutoRestore Backup Successfully!', 'bulletproof-security').$successTextEnd;
			
			if ( $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'yes') {
				@chmod($filename, 0400);
			}			
		}
	}
	}
}

// Pre-installation Setup Wizard - cURL Scanner checks - cURL Extension is Loaded & disable_functions directive checks
function bpsSetupWizardcURLCheck() {
	if (current_user_can('manage_options')) {
	
	if ( !extension_loaded('curl') ) {
		$text = '<br><strong><font color="red">'.__('The cURL Extension is Not Loaded/Installed on your website/Server.', 'bulletproof-security').'</font><br>'.__('The scanner uses cURL to scan your website for plugin scripts/files to add to the Firewall Whitelist. You will either have to add plugin script/file names manually or Load/add/install the cURL extension on your Server.', 'bulletproof-security').'</strong><br>';
		echo $text;
	} else {
		$text = '<strong><font color="green">'.__('Pass! The cURL Extension is Loaded/Installed on your website/Server.', 'bulletproof-security').'</font></strong><br>';
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

// Pre-installation Setup Wizard - Check if php.ini handler code exists in root .htaccess file, but not in Custom Code
// The bpsSetupWizardCreateRootHtaccess() function will ensure that Custom Code DB options already exist if a php.ini handler is found in the root .htaccess file
// This additional insurance check is needed in cases where users re-run the wizard at a later time & for making error/troubleshooting simpler
function bpsSetupWizardPhpiniHandlerCheck() {
$options = get_option('bulletproof_security_options_customcode');	
$file = ABSPATH . '.htaccess';
$file_contents = @file_get_contents($file);
$successTextBegin = '<font color="green"><strong>';
$successTextEnd = '</strong></font><br>';
$failTextBegin = '<font color="red"><strong>';
$failTextEnd = '</strong></font><br>';	

	if ( file_exists($file) ) {		

		preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $file_contents, $matches);
		preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $options['bps_customcode_one'], $DBmatches);
		
		if ( !$matches[0] ) {
		echo $successTextBegin.__('Pass! PHP/php.ini handler htaccess code check: Not in use, required or needed for your website/Server', 'bulletproof-security').$successTextEnd;
		return;
		}
	
		if ( $matches[0] && $DBmatches[0] ) {
		echo $successTextBegin.__('Pass! PHP/php.ini handler htaccess code was found in your root .htaccess file AND in BPS Pro Custom Code', 'bulletproof-security').$successTextEnd;
		}
		
		if ( $matches[0] && !$DBmatches[0] ) {
			echo '<br>'.$failTextBegin.__('Error: PHP/php.ini handler htaccess code check', 'bulletproof-security').$failTextEnd.'<br>'.__('PHP/php.ini handler htaccess code was found in your root .htaccess file, but was NOT found in BPS Pro Custom Code. Do NOT click the Setup Wizard button yet and instead click this Forum Link ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/pre-installation-wizard-checks-phpphp-ini-handler-htaccess-code-check/" target="_blank" title="Link opens in a new Browser window"><strong>'.__('Add php.ini handler htaccess code to BPS Pro Custom Code', 'bulletproof-security').'</a></strong>'.__(' for instructions on how to copy your PHP/php.ini handler htaccess code to BPS Pro Custom Code before running the Setup Wizard.', 'bulletproof-security').'<br><br>';	
		}
	}
}

// Pre-installation Setup Wizard - Scans up to 50 Page & Posts - includes Home & Login page for Plugin Scripts to Whitelist
// and saves to DB Options. Setup Wizard will later use these DB Options to create the Plugin Firewall .htaccess file
function bpsSetupWizardPluginFirewall_DB() {
global $wpdb;

?>

<script type="text/javascript">
/* <![CDATA[ */
	var img = document.getElementById("bps-spinner");
	
	if ( img.style.visibility == "visible" ) {
		clearInterval(SpinInterval);
		SpinInterval = 0;
		img.style.visibility = "hidden";
	}
/* ]]> */
</script>

<?php	
	
	if ( current_user_can('manage_options') ) {

	$CURLoptions = get_option('bulletproof_security_options_wizard_curl');
	
	if ( $CURLoptions['bps_wizard_curl_scan'] == 'Off' ) {
		
		echo '<strong><font color="blue">'.__('Plugin Firewall cURL Scanning is Turned Off. No cURL Scans were performed by the Wizard.', 'bulletproof-security').'</font></strong><br>';		
	}	
	
	if ( $CURLoptions['bps_wizard_curl_scan'] != 'Off' ) {

		$posts_table = $wpdb->prefix . "posts";
		$post_type = "p";
		$post_status = "publish";

		$getPostsPages = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $posts_table WHERE post_type LIKE %s AND post_status = %s LIMIT 50", "%$post_type%", $post_status) );

		$nodes = array();

		if ( $getPostsPages ) {

			foreach ( $getPostsPages as $PostsPages ) {
				$nodes[] = $PostsPages->guid;
			}
		}

		$array1 = array( 1 => get_site_url(), 2 => site_url('/wp-login.php') );
		$merged = array_merge($array1, $nodes);
		$node_count = count($merged);


		echo '<strong><font color="green">'.__('Plugin Firewall cURL Scanner Successfully Scanned: ', 'bulletproof-security').'</font><font color="blue">'.$node_count.__(' Pages & Posts', 'bulletproof-security').'</font></strong><br>';

		$curl_arr = array();
		$master = curl_multi_init();

		for( $i = 0; $i < $node_count; $i++ )	{
    		$url = $merged[$i];
    		$curl_arr[$i] = curl_init($url);
			curl_setopt($curl_arr[$i], CURLOPT_USERAGENT, 'BPS Pro Setup Wizard');    
			curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_arr[$i], CURLOPT_CONNECTTIMEOUT, 15);
			@curl_setopt($curl_arr[$i], CURLOPT_FOLLOWLOCATION, true);	
    		curl_multi_add_handle($master, $curl_arr[$i]);
		}

		do {
    		curl_multi_exec($master, $running);
		} while($running > 0);

		for( $i = 0; $i < $node_count; $i++ )	{
    
		$results = curl_multi_getcontent( $curl_arr[$i] ); 
		$filterPattern1 = '/\/ga\/inpage_linkid\.js/';	
		$domainName = bpsGetDomainRoot();

		if ( ! is_multisite() ) { 
			preg_match_all("/https?:\/\/(.*)$domainName(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/", $results, $matches);
		}
	
		if ( is_multisite() ) { 
			preg_match_all('/https?:\/\/(.*)\/plugins\/(.*)(\.js|\.php|\.swf)/', $results, $matches);
		}	

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
//$pattern5 = '/(\/themes\/|\/plugins\/|\/wp-content\/|\/wp-includes\/|\/uploads\/)/';
$pattern5 = '/(\/plugins\/|\/wp-content\/|\/wp-includes\/)/';

$error_message = '<br><font color="red"><strong>'.__('Error: One or more of your Plugin Firewall Whitelist rules are not valid', 'bulletproof-security').'</font><br>'.__('Click this link: ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" target="_blank" title="Link opens in a new Browser Window">'.__('Fix Plugin Firewall Whitelist rules', 'bulletproof-security').'</a>'.__(' Click on the Firewall Whitelist Tools accordian tab and edit your whitelist rules based on any errors that you see displayed to you.', 'bulletproof-security').'<br>'.__('The error message will explain what is invalid and what needs to be fixed.', 'bulletproof-security').'</strong><br>';

	if ( preg_match($pattern2, $NoDupes, $matches) ) {
		echo $error_message;
	}
	if ( preg_match($pattern3, $NoDupes, $matches) ) {
		echo $error_message;
	}
	if ( preg_match($pattern5, $NoDupes, $matches) ) {
		echo $error_message;
	}
	
	} // end if ( $CURLoptions['bps_wizard_curl_scan'] != 'Off' ) {

	// Save Plugin Firewall DB Options
	$successTextBegin = '<font color="green"><strong>';
	$successTextEnd = '</strong></font><br>';
	$successMessage8 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	$options = get_option('bulletproof_security_options_pfirewall');
	$bps_option_name8 = 'bulletproof_security_options_pfirewall';
	
	if ( $options['bps_pfw_paypal'] == '1') {
		$bps_new_value8 = '1';
	} else {
		$bps_new_value8 = '0';
	}
	
	if ( $options['bps_pfw_google'] == '1') {
		$bps_new_value8_1 = '1';
	} else {
		$bps_new_value8_1 = '0';
	}
	
	if ( $options['bps_pfw_amazon'] == '1') {
		$bps_new_value8_2 = '1';
	} else {
		$bps_new_value8_2 = '0';
	}

	if ( $options['bps_pfw_authorizenet'] == '1') {
		$bps_new_value8_3 = '1';
	} else {
		$bps_new_value8_3 = '0';
	}

	if ( $CURLoptions['bps_wizard_curl_scan'] != 'Off' ) {

		$string1 = $options['bps_pfw_whitelist'];
		$string2 = $NoDupes;
		$stringMerge = $string1 . ', ' . $string2;
		$stringMergeUnique = implode( ', ', array_unique( explode( ', ', trim( $stringMerge, ", \t\n\r" ) ) ) );
		$bps_new_value8_4 = $stringMergeUnique;
	
	} else {
		
		$bps_new_value8_4 = '';
	}

	$BPS_Options8 = array(
	'bps_pfw_paypal' 		=> $bps_new_value8, 
	'bps_pfw_google' 		=> $bps_new_value8_1, 
	'bps_pfw_amazon' 		=> $bps_new_value8_2, 
	'bps_pfw_authorizenet' 	=> $bps_new_value8_3, 
	'bps_pfw_whitelist' 	=> $bps_new_value8_4
	);

	if ( !get_option( $bps_option_name8 ) ) {	
		
		foreach( $BPS_Options8 as $key => $value ) {
			update_option('bulletproof_security_options_pfirewall', $BPS_Options8);
			echo $successTextBegin.'Plugin Firewall '.$key.$successMessage8.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options8 as $key => $value ) {
			update_option('bulletproof_security_options_pfirewall', $BPS_Options8);
			echo $successTextBegin.'Plugin Firewall '.$key.$successMessage8.$successTextEnd;	
		}
	}	
	
	$Allow_options = get_option('bulletproof_security_options_pfirewall_allow');
	$bps_option_name9 = 'bulletproof_security_options_pfirewall_allow';
	
	if ( !get_option('bulletproof_security_options_pfirewall_allow') || $Allow_options['bps_pfw_allow_from'] == '' ) {
		$bps_new_value9 = '';
	} else {
		$bps_new_value9 = $Allow_options['bps_pfw_allow_from'];	
	}
	
	$BPS_Options9 = array( 'bps_pfw_allow_from' => $bps_new_value9 );
	
	if ( !get_option( $bps_option_name9 ) ) {	
		
		foreach( $BPS_Options9 as $key => $value ) {
			update_option('bulletproof_security_options_pfirewall_allow', $BPS_Options9);
			echo $successTextBegin.'Plugin Firewall '.$key.$successMessage8.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options9 as $key => $value ) {
			update_option('bulletproof_security_options_pfirewall_allow', $BPS_Options9);
			echo $successTextBegin.'Plugin Firewall '.$key.$successMessage8.$successTextEnd;	
		}
	}
	}
}

// Setup Wizard - Create the Plugin Firewall .htaccess file using whitelist DB option values saved during Pre-Installation Wizard
function bpsSetupWizardPluginFirewall_File() {
	
	if ( current_user_can('manage_options') ) {

	$CURLoptions = get_option('bulletproof_security_options_wizard_curl');

	if ( $CURLoptions['bps_wizard_curl_scan'] == 'Off' ) {
		echo '<strong><font color="blue">'.__('Plugin Firewall cURL Scanning is Turned Off. No cURL Scans were performed by the Wizard.', 'bulletproof-security').'</font></strong><br>';	
	}

	$options = get_option('bulletproof_security_options_pfirewall');
	$successTextBegin = '<font color="green"><strong>';
	$successTextEnd = '</strong></font><br>';
	
	// create the Plugin Firewall .htaccess file
	$PluginsHtaccessMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins.htaccess';
	$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
	$PluginsHtaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins.htaccess';
	$PluginsHtaccessARQplugins = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/.htaccess';
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
		
			echo $successTextBegin.__('Plugin Firewall Whitelist Rules created or updated - no whitelist rules were found.', 'bulletproof-security').$successTextEnd;	

		} else {

			$whiteList = array();
			$whiteListMasterU = @file_get_contents($pluginsHtaccessMasterTXT);		
		
			foreach ( $bps_pfw_whitelist as $Key => $Value ) {
				$whiteList[] = 'SetEnvIf Request_URI "'.$Value.'$" whitelist'."\n";
			
				echo $successTextBegin.'SetEnvIf Request_URI "'.$Value.'$" whitelist'.__(' - Plugin Firewall Whitelist Rule created or updated Successfully!', 'bulletproof-security').$successTextEnd;			
			
				$uniqueRules = array_unique($whiteList);
						
				foreach ( $uniqueRules as $uniqueRule ) {

					if ( $uniqueRule != '' ) {
						file_put_contents($pluginsHtaccessMasterTXT, $uniqueRules);
					}			
				}
			}
		}
		
		// IMPORTANT! do not combine or use the same variable for $whiteListMaster & $whiteListMasterU - they MUST be separate/unique
		$whiteListMaster = @file_get_contents($pluginsHtaccessMasterTXT);
		$stringReplace = @file_get_contents($PluginsHtaccessMaster);
		$stringReplace = preg_replace('/BEGIN WHITELIST(.*)END WHITELIST/s', "BEGIN WHITELIST: Frontend Loading Website Plugin scripts/files\nSetEnvIf Request_URI \"/bulletproof-security/400.php\$\" whitelist\nSetEnvIf Request_URI \"/bulletproof-security/403.php\$\" whitelist\n".$whiteListMaster."# END WHITELIST", $stringReplace);
		file_put_contents($PluginsHtaccessMaster, $stringReplace);

	if ( $options['bps_pfw_paypal'] == '1') {
		$payPal = "\n".'Allow from paypal.com';
	} else {
		$payPal = '';
	}
	
	if ( $options['bps_pfw_google'] == '1') {
		$google = "\n".'Allow from google.com';
	} else {
		$google = '';
	}

	if ( $options['bps_pfw_amazon'] == '1') {
		$amazon = "\n".'Allow from amazon.com';
	} else {
		$amazon = '';
	}

	if ( $options['bps_pfw_authorizenet'] == '1') {
		$authorizeNet = "\n".'Allow from authorize.net';
	} else {
		$authorizeNet = '';
	}

	$stringReplace = @file_get_contents($PluginsHtaccessMaster);
	$stringReplace = preg_replace('/<FilesMatch(.*)FilesMatch>/s', "<FilesMatch ".'"'."\.(7z|as|bat|bin|cgi|chm|chml|class|cmd|com|command|dat|db|db2|db3|dba|dll|DS_Store|exe|gz|hta|htaccess|htc|htm|html|html5|htx|idc|ini|ins|isp|jar|jav|java|js|jse|jsfl|json|jsp|jsx|lib|lnk|out|php|phps|php5|php4|php3|phtml|phpt|pl|py|pyd|pyc|pyo|rar|shtm|shtml|sql|swf|sys|tar|taz|tgz|tpl|txt|vb|vbe|vbs|war|ws|wsf|xhtml|z|zip)$".'"'.">\nOrder Allow,Deny\nAllow from env=whitelist\nAllow from $bps_get_domain_root\nAllow from $bps_get_server_ip\n# BEGIN PUBLIC IP\nAllow from $bps_get_public_ip\n# END PUBLIC IP$payPal$google$amazon$authorizeNet\n</FilesMatch>", $stringReplace);
		
		/** Allow from Whitelist Rules **/
		$Allow_options = get_option('bulletproof_security_options_pfirewall_allow');
		$pluginsAllowFromTXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/plugins-allow-from.txt';
		$pluginsAllowFromTXTARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/admin/htaccess/plugins-allow-from.txt';
		$allow_pattern = '/#\sBEGIN\sADDITIONAL\sALLOW\sFROM\sRULES\s*(Allow from(.*)\s*){1,}#\sEND\sADDITIONAL\sALLOW\sFROM\sRULES/';
		
		if ( $Allow_options['bps_pfw_allow_from'] != '' ) {	
	
			$pfw_allow_from = array_filter( explode(', ', trim( $Allow_options['bps_pfw_allow_from'], ", \t\n\r") ) );
			$allow_whiteList = array();
		
			foreach ( $pfw_allow_from as $allow_Key => $allow_Value ) {
				$allow_whiteList[] = $allow_Value."\n";
				file_put_contents($pluginsAllowFromTXT, $allow_whiteList);
			}

				$AllowFromRules = file_get_contents($pluginsAllowFromTXT);
				$stringReplace = file_get_contents($PluginsHtaccessMaster);
				
				if ( preg_match( $allow_pattern, $stringReplace, $matches ) ) {
					$stringReplace = preg_replace('/#\sBEGIN\sADDITIONAL\sALLOW\sFROM\sRULES\s*(Allow from(.*)\s*){1,}#\sEND\sADDITIONAL\sALLOW\sFROM\sRULES/', "# BEGIN ADDITIONAL ALLOW FROM RULES\n".$AllowFromRules."# END ADDITIONAL ALLOW FROM RULES", $stringReplace);
				
				} else {
					
					$stringReplace = preg_replace('/#\sEND\sPUBLIC\sIP/', "# END PUBLIC IP\n# BEGIN ADDITIONAL ALLOW FROM RULES\n".$AllowFromRules."# END ADDITIONAL ALLOW FROM RULES", $stringReplace);			
				}
			
			if ( file_put_contents($PluginsHtaccessMaster, $stringReplace) ) {
				@copy($PluginsHtaccessMaster, $PluginsHtaccess);
				@copy($PluginsHtaccessMaster, $PluginsHtaccessARQ);
				@copy($PluginsHtaccessMaster, $PluginsHtaccessARQplugins);	
				@copy($pluginsHtaccessMasterTXT, $pluginsHtaccessMasterTXTARQ);
				@copy($pluginsAllowFromTXT, $pluginsAllowFromTXTARQ);
				echo $successTextBegin.__(' Plugin Firewall Activation, Copy & Backup to ARQ Successful!', 'bulletproof-security').$successTextEnd;
			}
		}

		if ( !$Allow_options['bps_pfw_allow_from'] || $Allow_options['bps_pfw_allow_from'] == '' ) {
		
			if ( file_put_contents($PluginsHtaccessMaster, $stringReplace) ) {
				@copy($PluginsHtaccessMaster, $PluginsHtaccess);
				@copy($PluginsHtaccessMaster, $PluginsHtaccessARQ);	
				@copy($PluginsHtaccessMaster, $PluginsHtaccessARQplugins);	
				@copy($pluginsHtaccessMasterTXT, $pluginsHtaccessMasterTXTARQ);
				echo $successTextBegin.__(' Plugin Firewall Activation, Copy & Backup to ARQ Successful!', 'bulletproof-security').$successTextEnd;
			}
		}
	}	
	}
}

// Setup Wizard - DB Backup is setup in admin.php on BPS Pro installation & upgrades
// but if someone uninstalls BPS Pro and runs the setup wizard again then the db options need to be updated
// with the db backup folder and db backup download URL
function bpsSetupWizard_dbbackup_folder_check() {
$successTextBegin = '<font color="green"><strong>';
$dbb_successMessage = __(' DB Option created or updated Successfully!', 'bulletproof-security');
$successMessage2 = __(' Folder created Successfully!', 'bulletproof-security');
$successTextEnd = '</strong></font><br>';
$failTextBegin = '<font color="red"><strong>';
$failTextEnd = '</strong></font><br>';

	if ( current_user_can('manage_options') ) {

		$DBBoptions = get_option('bulletproof_security_options_db_backup');
	
	if ( $DBBoptions['bps_db_backup_folder'] != '' ) {	
		
		$DBB_Options = array(
		'bps_db_backup' 						=> $DBBoptions['bps_db_backup'], 
		'bps_db_backup_description' 			=> $DBBoptions['bps_db_backup_description'], 
		'bps_db_backup_folder' 					=> $DBBoptions['bps_db_backup_folder'], 
		'bps_db_backup_download_link' 			=> $DBBoptions['bps_db_backup_download_link'], 
		'bps_db_backup_job_type' 				=> $DBBoptions['bps_db_backup_job_type'], 
		'bps_db_backup_frequency' 				=> $DBBoptions['bps_db_backup_frequency'], 
		'bps_db_backup_start_time_hour' 		=> $DBBoptions['bps_db_backup_start_time_hour'], 
		'bps_db_backup_start_time_weekday' 		=> $DBBoptions['bps_db_backup_start_time_weekday'],  
		'bps_db_backup_start_time_month_date' 	=> $DBBoptions['bps_db_backup_start_time_month_date'], 
		'bps_db_backup_email_zip' 				=> $DBBoptions['bps_db_backup_email_zip'], 
		'bps_db_backup_delete' 					=> $DBBoptions['bps_db_backup_delete'], 
		'bps_db_backup_status_display' 			=> $DBBoptions['bps_db_backup_status_display'] 
		);
		
		echo $successTextBegin.$DBBoptions['bps_db_backup_folder'].$successMessage2.$successTextEnd;	
		
		foreach( $DBB_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_backup', $DBB_Options);
			echo $successTextBegin.$key.$dbb_successMessage.$successTextEnd;	
		}		
	
	} else {

		$source = WP_CONTENT_DIR . '/bps-backup';

		if ( is_dir($source) ) {
		
			$iterator = new DirectoryIterator($source);
			
			foreach ( $iterator as $folder ) {
			
				if ( $folder->isDir() && !$folder->isDot() && preg_match( '/backups_[a-zA-Z0-9]/', $folder ) ) {

					$bps_db_backup_folder = addslashes($source.DIRECTORY_SEPARATOR.$folder);
					$bps_db_backup_download_link = content_url( '/bps-backup/' ) . $folder . '/';
			
					$DBB_Options = array( 
					'bps_db_backup' 						=> 'On', 
					'bps_db_backup_description' 			=> $DBBoptions['bps_db_backup_description'], 
					'bps_db_backup_folder' 					=> $bps_db_backup_folder, 
					'bps_db_backup_download_link' 			=> $bps_db_backup_download_link, 
					'bps_db_backup_job_type' 				=> $DBBoptions['bps_db_backup_job_type'], 
					'bps_db_backup_frequency' 				=> $DBBoptions['bps_db_backup_frequency'], 
					'bps_db_backup_start_time_hour' 		=> $DBBoptions['bps_db_backup_start_time_hour'], 
					'bps_db_backup_start_time_weekday' 		=> $DBBoptions['bps_db_backup_start_time_weekday'], 
					'bps_db_backup_start_time_month_date' 	=> $DBBoptions['bps_db_backup_start_time_month_date'], 
					'bps_db_backup_email_zip' 				=> $DBBoptions['bps_db_backup_email_zip'], 
					'bps_db_backup_delete' 					=> $DBBoptions['bps_db_backup_delete'], 
					'bps_db_backup_status_display' 			=> $DBBoptions['bps_db_backup_status_display'] 
					);
	
					echo $successTextBegin.$bps_db_backup_folder.$successMessage2.$successTextEnd;

					foreach( $DBB_Options as $key => $value ) {
						update_option('bulletproof_security_options_db_backup', $DBB_Options);
						echo $successTextBegin.$key.$dbb_successMessage.$successTextEnd;	
					}			
				}
			}
		}
	}
	}
}

// Pre-installation Setup Wizard - wp-content Exclude folders $FILTERS from file type checks for automatic ARQ Exclude rule creation
class BPSWPCSourceExcludeRecursiveFilterIterator extends RecursiveFilterIterator {

	public static $FILTERS = array('plugins', 'mu-plugins', 'themes', 'upgrade', 'uploads', 'blogs.dir', 'bps-backup', 'cache', 'w3tc');
	
	public function accept() {
		return !in_array( $this->getSubPathName(), self::$FILTERS, true );
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

// Pre-installation Setup Wizard - Create ARQ Exclude DB options/rules for plugins, mu-plugins & other folders that contain backups, other media types or files over 5MB
// Prevent root /wp-content folder rule - do not check /mu-plugins folder if it exists & create a mu-plugins folder exclude rule - excluded in Class filter
function bpsSetupWizardARQExcludeDB() {
$fileTypesMedia = array('png', 'jpg', 'jpeg', 'gif', 'bmp', 'swf', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'odt', 'xls', 'xlsx', 'mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv', 'avi', 'mpg', 'mpeg', 'mpe', 'ogv', '3gp', '3g2', 'ttf', 'ttc', 'woff', 'flv');

$fileTypesBackupCache = array('gz', '7z', 'htm', 'html', 'html5', 'xhtml', 'shtm', 'shtml', 'mht', 'mhtml', 'sql', 'zip', 'rar', 'ini', 'csv', 'xml', 'tar', 'tgz', 'bz2');

//$fileSize = array();
$filePath = array();
$path = WP_CONTENT_DIR;
$dirItr = new RecursiveDirectoryIterator($path);
$filterItr = new BPSWPCSourceExcludeRecursiveFilterIterator($dirItr);
$objects = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST); 

	foreach ( $objects as $files ) {
		if ( $files->isFile() ) {
		
			$path_parts = pathinfo($files);
			$path_parts_ext = $path_parts['extension'];
		
			if ( filesize($files) > 5242880 ) {
				//$fileSize[] = $files->getSize();
				$filePath[] = $files->getPathname();
			}
			
			if ( in_array($path_parts_ext, $fileTypesMedia) || in_array($path_parts_ext, $fileTypesBackupCache ) ) {

				$filePath[] = $files->getPathname();
			}
		}	
	}

	$path_parts_base = array();
	$wp_content_filter = array( 'wp-content' );
	$mu_plugins_dir = array( 'mu-plugins', 'plugins' );
	$plugins_dir = array( 'plugins' );	
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);
	
	foreach ( $filePath as $baseFolder ) {
		
		$path_parts = pathinfo($baseFolder);
		
		if ( is_dir( WP_CONTENT_DIR .'/'. basename($path_parts['dirname']) ) ) {
			$path_parts_base[] = basename($path_parts['dirname']);
		}

		if ( is_dir( WP_CONTENT_DIR .'/'. basename(dirname(dirname($path_parts['dirname']))) )) {
			$path_parts_base[] .= basename(dirname(dirname($path_parts['dirname'])));
		}

		if ( is_dir( WP_CONTENT_DIR .'/'. basename(dirname(dirname(dirname($path_parts['dirname'])))) )) {
			$path_parts_base[] .= basename(dirname(dirname(dirname($path_parts['dirname']))));
		}

		if ( is_dir( WP_CONTENT_DIR .'/'. basename(dirname(dirname(dirname(dirname($path_parts['dirname']))))) )) {
			$path_parts_base[] .= basename(dirname(dirname(dirname(dirname($path_parts['dirname'])))));
		}

		if ( is_dir( WP_CONTENT_DIR .'/'. basename(dirname(dirname(dirname(dirname(dirname($path_parts['dirname'])))))) )) {
			$path_parts_base[] .= basename(dirname(dirname(dirname(dirname(dirname($path_parts['dirname']))))));
		}
	}

/*	
	//Testing/Troubleshooting
	echo '<pre>';
	print_r($path_parts_base);
	echo '</pre>';
*/

	$mu_plugins_dir_path = WP_CONTENT_DIR . '/mu-plugins';

	if ( is_dir($mu_plugins_dir_path) ) {
		$uniqueDirs = array_unique(array_diff($path_parts_base, $wp_content_filter));
		$uniqueDirs = array_merge($uniqueDirs, $mu_plugins_dir);
		sort($uniqueDirs);
	} else {
		$uniqueDirs = array_unique(array_diff($path_parts_base, $wp_content_filter));		
		$uniqueDirs = array_merge($uniqueDirs, $plugins_dir);
		sort($uniqueDirs);
	}

/*	
	Testing/Troubleshooting
	echo '<pre>';
	print_r($uniqueDirs);
	echo '</pre>';
*/
	$ARQExcludeOptions = get_option('bulletproof_security_options_exclude_folder');
	$ExcludeRulesArray = array();

	if ( is_array( $ARQExcludeOptions ) ) {

		foreach ( $ARQExcludeOptions as $key => $value ) {
			if ( !preg_match('/_label/', $key, $matches ) && $value != '' ) {
				$ExcludeRulesArray[] = $value;
			}
		}
	}
	
	$Merged = array_unique(array_merge($ExcludeRulesArray, $uniqueDirs));
	sort($Merged);

/*	Testing/Troubleshooting
	echo '<pre>';
	print_r($Merged);
	echo '</pre>';
*/
	// Populate the ARQ DB Options array values
	$bps_option_name = 'bulletproof_security_options_exclude_folder';
	$BPS_Options = array(
	'bpsexclude_input_1'  => $Merged[0], 
	'bpsexclude_input_2'  => $Merged[1], 
	'bpsexclude_input_3'  => $Merged[2], 
	'bpsexclude_input_4'  => $Merged[3], 
	'bpsexclude_input_5'  => $Merged[4], 
	'bpsexclude_input_6'  => $Merged[5], 
	'bpsexclude_input_7'  => $Merged[6], 
	'bpsexclude_input_8'  => $Merged[7], 
	'bpsexclude_input_9'  => $Merged[8], 
	'bpsexclude_input_10' => $Merged[9], 
	'bpsexclude_input_11' => $Merged[10], 
	'bpsexclude_input_12' => $Merged[11], 
	'bpsexclude_input_13' => $Merged[12], 
	'bpsexclude_input_14' => $Merged[13], 
	'bpsexclude_input_15' => $Merged[14], 
	'bpsexclude_input_16' => $Merged[15], 
	'bpsexclude_input_17' => $Merged[16], 
	'bpsexclude_input_18' => $Merged[17], 
	'bpsexclude_input_19' => $Merged[18], 
	'bpsexclude_input_20' => $Merged[19], 
	'bpsexclude_input_1_label'  => 'Exclude '.$Merged[0].' Folder', 
	'bpsexclude_input_2_label'  => 'Exclude '.$Merged[1].' Folder', 
	'bpsexclude_input_3_label'  => 'Exclude '.$Merged[2].' Folder', 
	'bpsexclude_input_4_label'  => 'Exclude '.$Merged[3].' Folder', 
	'bpsexclude_input_5_label'  => 'Exclude '.$Merged[4].' Folder', 
	'bpsexclude_input_6_label'  => 'Exclude '.$Merged[5].' Folder', 
	'bpsexclude_input_7_label'  => 'Exclude '.$Merged[6].' Folder', 
	'bpsexclude_input_8_label'  => 'Exclude '.$Merged[7].' Folder', 
	'bpsexclude_input_9_label'  => 'Exclude '.$Merged[8].' Folder', 
	'bpsexclude_input_10_label' => 'Exclude '.$Merged[9].' Folder', 
	'bpsexclude_input_11_label' => 'Exclude '.$Merged[10].' Folder', 
	'bpsexclude_input_12_label' => 'Exclude '.$Merged[11].' Folder', 
	'bpsexclude_input_13_label' => 'Exclude '.$Merged[12].' Folder', 
	'bpsexclude_input_14_label' => 'Exclude '.$Merged[13].' Folder', 
	'bpsexclude_input_15_label' => 'Exclude '.$Merged[14].' Folder', 
	'bpsexclude_input_16_label' => 'Exclude '.$Merged[15].' Folder', 
	'bpsexclude_input_17_label' => 'Exclude '.$Merged[16].' Folder', 
	'bpsexclude_input_18_label' => 'Exclude '.$Merged[17].' Folder', 
	'bpsexclude_input_19_label' => 'Exclude '.$Merged[18].' Folder', 
	'bpsexclude_input_20_label' => 'Exclude '.$Merged[19].' Folder'
	);

	if ( ! get_option( $bps_option_name ) ) {
		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_exclude_folder', $BPS_Options);

			if ( ! preg_match('/_label/', $key, $matches ) && $value != '' ) {
				
				$text = '<strong><font color="green">'.__('AutoRestore|Quarantine ', 'bulletproof-security').$value.__(' folder Exclude Rule DB Option saved or updated Successfully!', 'bulletproof-security').'</font></strong><br>';
				echo $text;
			}		
		}
	
	} else {

		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_exclude_folder', $BPS_Options);

			if ( ! preg_match('/_label/', $key, $matches ) && $value != '' ) {
				
				$text = '<strong><font color="green">'.__('AutoRestore|Quarantine ', 'bulletproof-security').$value.__(' folder Exclude Rule DB Option saved or updated Successfully!', 'bulletproof-security').'</font></strong><br>';
				echo $text;
			}		
		}	
	}
}

// Setup Wizard - Create/Recreate the User Agent filters in the 403.php file
function bpsSetupWizard_autoupdate_useragent_filters() {		
global $wpdb;
$table_name = $wpdb->prefix . "bpspro_seclog_ignore";
$blankFile = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
$userAgentMaster = WP_CONTENT_DIR . '/bps-backup/master-backups/UserAgentMaster.txt';
$bps403File = WP_PLUGIN_DIR . '/bulletproof-security/403.php';
$bps403FileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/403.php';
$ARQdir = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/';
$search = '';		

	if ( !file_exists($bps403File) ) {
		return;
	}
	
	if ( file_exists($blankFile) ) {
		copy($blankFile, $userAgentMaster);
	}

	$getSecLogTable = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE user_agent_bot LIKE %s", "%$search%") );
	$UserAgentRules = array();
	
	if ( $wpdb->num_rows == 0 ) {
		$text = '<strong><font color="green">'.__('Security Log User Agent Filter Check Successful! 0 User Agent Filters to update.', 'bulletproof-security').'</font></strong><br>';
		echo $text;	
	}
	
	if ( $wpdb->num_rows != 0 ) {

		foreach ( $getSecLogTable as $row ) {
			$UserAgentRules[] = "(.*)".$row->user_agent_bot."(.*)|";
			file_put_contents($userAgentMaster, $UserAgentRules);
		
			$text = '<strong><font color="green">'.__('Security Log User Agent Filter ', 'bulletproof-security').$row->user_agent_bot.__(' created or updated Successfully!', 'bulletproof-security').'</font></strong><br>';
			echo $text;
		}
	
	$UserAgentRulesT = file_get_contents($userAgentMaster);
	$stringReplace = file_get_contents($bps403File);

	$stringReplace = preg_replace('/# BEGIN USERAGENT FILTER(.*)# END USERAGENT FILTER/s', "# BEGIN USERAGENT FILTER\nif ( !preg_match('/".trim($UserAgentRulesT, "|")."/', \$_SERVER['HTTP_USER_AGENT']) ) {\n# END USERAGENT FILTER", $stringReplace);
		
	file_put_contents($bps403File, $stringReplace);
		
	if ( is_dir($ARQdir) ) {
		copy($bps403File, $bps403FileARQ);
	}
	}
}

// Setup Wizard - Create ARQ Exclude rules for sitemap.xml and sitemap.xml.gz if they exist
function bpsSetupWizardExcludeSitemap() {
global $wpdb;
$sitemap = ABSPATH . 'sitemap.xml';
$sitemapgz = ABSPATH . 'sitemap.xml.gz';
$sitemapDB = 'sitemap.xml';
$successTextBegin = '<font color="green"><strong>';
$successTextEnd = '</strong></font><br>';
$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
$getExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $Etable_name WHERE arq_exclude_source LIKE %s", "%$sitemapDB%") );	

	foreach ( $getExcludeRows as $row ) {
		if ( $row->arq_exclude_source == $sitemap || $row->arq_exclude_source == $sitemapgz ) {		
			echo $successTextBegin.__('AutoRestore|Quarantine Sitemap Exclude Rule already exists.', 'bulletproof-security').$successTextEnd;	
			return;
		}
	}

	if ( file_exists($sitemap) || file_exists($sitemapgz) ) {	
	
		if ( $ExcludeSitemap = $wpdb->insert( $Etable_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $sitemap ) ) ) {
			echo $successTextBegin.__('AutoRestore|Quarantine Exclude Rule created Successfully for sitemap file: ', 'bulletproof-security').ABSPATH . 'sitemap.xml'.$successTextEnd;	
		}
		if ( $ExcludeSitemapgz = $wpdb->insert( $Etable_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $sitemapgz ) ) ) {
			echo $successTextBegin.__('AutoRestore|Quarantine Exclude Rule created Successfully for sitemap file: ', 'bulletproof-security').ABSPATH . 'sitemap.xml.gz'.$successTextEnd;			
		}
	}
}

// Setup Wizard - Create ARQ Exclude rule for WPEngine mysql.sql file if it exists
function bpsSetupWizardExcludeWPEnginesql() {
global $wpdb;
$wpenginesql = WP_CONTENT_DIR . '/mysql.sql';
$wpenginedir = WP_CONTENT_DIR . '/mu-plugins/wpengine-common';
$wpengineDB = 'mysql.sql';
$successTextBegin = '<font color="green"><strong>';
$successTextEnd = '</strong></font><br>';
$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
$getExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $Etable_name WHERE arq_exclude_source LIKE %s", "%$wpengineDB%") );			
	
	if ( is_dir( $wpenginedir ) && file_exists($wpenginesql) ) {

		foreach ( $getExcludeRows as $row ) {
			if ( $row->arq_exclude_source == $wpenginesql ) {		
				echo $successTextBegin.__('AutoRestore|Quarantine WPEngine mysql.sql Exclude Rule already exists.', 'bulletproof-security').$successTextEnd;	
				return;
			}
		}

	if ( $ExcludeWpenginesql = $wpdb->insert( $Etable_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $wpenginesql ) ) ) {
		echo $successTextBegin.__('AutoRestore|Quarantine Exclude Rule created Successfully for WPEngine file: ', 'bulletproof-security').$wpenginesql.$successTextEnd;	
	}
	}
}

// Pre-installation Setup Wizard - Create the ARQ exclude filters in class.php & copy class.php to the /master-backups folder
// Create a new class.php file from class-BAK.php first so that exclude rules will be created correctly
function bpsSetupWizardARQExcludeFile() {
	if (current_user_can('manage_options')) {
$options = get_option('bulletproof_security_options_exclude_folder'); 
$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
$bpsClassBAKFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class-BAK.php';
$bpsClassFileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/includes/class.php';		
$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';		

	if ( file_exists($bpsClassBAKFile) ) {	
		
		if ( copy($bpsClassBAKFile, $bpsClassFile ) ) {
			
			$stringReplace = @file_get_contents($bpsClassFile);
	
		if ( $options['bpsexclude_input_1'] != '' ) {
			$stringReplace = str_replace("bps-hard-exclude001", $options['bpsexclude_input_1'], $stringReplace);
		}
		if ( $options['bpsexclude_input_2'] != '' ) {
			$stringReplace = str_replace("bps-hard-exclude002", $options['bpsexclude_input_2'], $stringReplace);
		}
		if ( $options['bpsexclude_input_3'] != '' ) {
			$stringReplace = str_replace("bps-hard-exclude003", $options['bpsexclude_input_3'], $stringReplace);
		}
		if ( $options['bpsexclude_input_4'] != '' ) {		
			$stringReplace = str_replace("bps-hard-exclude004", $options['bpsexclude_input_4'], $stringReplace);
		}
		if ( $options['bpsexclude_input_5'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude005", $options['bpsexclude_input_5'], $stringReplace);
		}
		if ( $options['bpsexclude_input_6'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude006", $options['bpsexclude_input_6'], $stringReplace);
		}
		if ( $options['bpsexclude_input_7'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude007", $options['bpsexclude_input_7'], $stringReplace);
		}
		if ( $options['bpsexclude_input_8'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude008", $options['bpsexclude_input_8'], $stringReplace);
		}
		if ( $options['bpsexclude_input_9'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude009", $options['bpsexclude_input_9'], $stringReplace);
		}
		if ( $options['bpsexclude_input_10'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude010", $options['bpsexclude_input_10'], $stringReplace);
		}
		if ( $options['bpsexclude_input_11'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude011", $options['bpsexclude_input_11'], $stringReplace);
		}
		if ( $options['bpsexclude_input_12'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude012", $options['bpsexclude_input_12'], $stringReplace);
		}
		if ( $options['bpsexclude_input_13'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude013", $options['bpsexclude_input_13'], $stringReplace);
		}
		if ( $options['bpsexclude_input_14'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude014", $options['bpsexclude_input_14'], $stringReplace);
		}
		if ( $options['bpsexclude_input_15'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude015", $options['bpsexclude_input_15'], $stringReplace);
		}
		if ( $options['bpsexclude_input_16'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude016", $options['bpsexclude_input_16'], $stringReplace);
		}
		if ( $options['bpsexclude_input_17'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude017", $options['bpsexclude_input_17'], $stringReplace);
		}
		if ( $options['bpsexclude_input_18'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude018", $options['bpsexclude_input_18'], $stringReplace);
		}
		if ( $options['bpsexclude_input_19'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude019", $options['bpsexclude_input_19'], $stringReplace);
		}
		if ( $options['bpsexclude_input_20'] != '' ) {	
			$stringReplace = str_replace("bps-hard-exclude020", $options['bpsexclude_input_20'], $stringReplace);
		}
		}

			if ( ! file_put_contents($bpsClassFile, $stringReplace) ) {
				$text = '<br><strong><font color="red">'.__('Error: Unable to write to /bulletproof-security/includes/class.php file to create ARQ Exclude Rules.', 'bulletproof-security').'</font></strong><br>';
				echo $text;	
   			} else {
				@copy($bpsClassFile, $bpsClassFileARQ);
				@copy($bpsClassFile, $bpsClassFileARQMB);
				
				foreach( $options as $key => $value ) {
					
					if ( ! preg_match('/_label/', $key, $matches ) && $value != '' ) {
					
						$text1 = '<strong><font color="green">'.__('AutoRestore|Quarantine ', 'bulletproof-security').$value.__(' folder Exclude Rule created or updated Successfully!', 'bulletproof-security').'</font></strong><br>';
						echo $text1;
					}
				}
				$text2 = '<strong><font color="green">'.$bpsClassFile.__(' File created or updated Successfully!', 'bulletproof-security').'<br>'.$bpsClassFileARQMB.__(' File copied to backup Successfully!', 'bulletproof-security').'<br>'.$bpsClassFileARQ.__(' File copied to ARQ backup Successfully!', 'bulletproof-security').'</font></strong><br>';
				echo $text2;	
			}	
	}
	}
}

/****************************************/
// BEGIN BPS Pro Pre-Installation Wizard
/****************************************/

// Setup Wizard - Pre-Installation Wizard
function bpsSetupWizardPrechecks() {

if ( isset( $_POST['Submit-Setup-Wizard-Preinstallation'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bps_setup_wizard_preinstallation' );
		set_time_limit(300);

global $wp_version;

$time_start = microtime( true );

$successTextBegin = '<font color="green"><strong>';
$successMessage = __(' DB Table created Successfully!', 'bulletproof-security');
$successTextEnd = '</strong></font><br>';
$failTextBegin = '<font color="red"><strong>';
$failMessage = __('Error: Unable to create DB Table ', 'bulletproof-security');
$failTextEnd = '</strong></font><br>';
$sapi_type = php_sapi_name();
$wpconfig = ABSPATH . 'wp-config.php';
$rootHtaccess = ABSPATH . '.htaccess';
$rootHtaccessContents = @file_get_contents($rootHtaccess);
$rootHtaccessBackup = WP_CONTENT_DIR . '/bps-backup/master-backups/root.htaccess';
$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
$wpadminHtaccessBackup = WP_CONTENT_DIR . '/bps-backup/master-backups/wpadmin.htaccess';
$RootCustomCode = get_option('bulletproof_security_options_customcode');
$ARQoptions = get_option('bulletproof_security_options_ARCM');

	$bps_option_name11 = 'bulletproof_security_options_ARCM';
	
	if ( ! $ARQoptions['bps_autorestore_cron_frequency'] ) {
		$bps_new_value11_1 = '2';	
	} else {
		$bps_new_value11_1 = $ARQoptions['bps_autorestore_cron_frequency'];
	}	
	
	$bps_new_value11_2 = 'Off';
	$bps_new_value11_3 = 'Off';
	
	if ( ! $ARQoptions['bps_autorestore_cron_filecheck'] ) {
		$bps_new_value11_3a = 'On';	
	} else {
		$bps_new_value11_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
	}

	if ( ! $ARQoptions['bps_autorestore_cron_forced'] ) {
		$bps_new_value11_4 = '1';	
	} else {
		$bps_new_value11_4 = $ARQoptions['bps_autorestore_cron_forced'];
	}	
	
	if ( ! $ARQoptions['bps_autorestore_cron_end'] ) {
		$bps_new_value11_5 = '';	
	} else {
		$bps_new_value11_5 = $ARQoptions['bps_autorestore_cron_end'];
	}	

	$BPS_Options11 = array(
	'bps_autorestore_cron_frequency' 	=> $bps_new_value11_1, 
	'bps_autorestore_cron' 				=> $bps_new_value11_2, 
	'bps_autorestore_cron_override' 	=> $bps_new_value11_3, 
	'bps_autorestore_cron_filecheck' 	=> $bps_new_value11_3a, 
	'bps_autorestore_cron_forced' 		=> $bps_new_value11_4, 
	'bps_autorestore_cron_end' 			=> $bps_new_value11_5
	);
	
		if ( ! get_option( $bps_option_name11 ) ) {	
		
			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
			}
	
		} else {

			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
			}	
		}

	$bps_option_preinstall = 'bulletproof_security_options_preinstallation';
	$bps_new_value_preinstall = 'yes';
	$bps_new_value_preinstall_61 = 'yes';
	
	$BPS_Options_preinstall = array(
	'bps_wizard_preinstallation' 	=> $bps_new_value_preinstall, 
	'bps_wizard_preinstallation_61' => $bps_new_value_preinstall_61
		);

	if ( ! get_option( $bps_option_preinstall ) ) {	
		update_option('bulletproof_security_options_preinstallation', $BPS_Options_preinstall);
	} else {
		update_option('bulletproof_security_options_preinstallation', $BPS_Options_preinstall);
	}	

	// Update BPS DB option - WP version matches the current version of WP & reset the last modified time in DB
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$versionphp = ABSPATH . 'wp-includes/version.php';	
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
	$bps_option_name12 = 'bulletproof_security_options_wp_version';
	$bps_new_value12 = $wp_version;	
	$bps_new_value12_1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);	
			
	$BPS_Options12 = array( 'bps_wp_version' => $bps_new_value12, 'bps_wp_version_last_modified_time' => $bps_new_value12_1 );	
	
	if ( ! get_option( $bps_option_name12 ) ) {	
		
		foreach( $BPS_Options12 as $key => $value ) {
			update_option('bulletproof_security_options_wp_version', $BPS_Options12);
		}
			
	} else {

		foreach( $BPS_Options12 as $key => $value ) {
			update_option('bulletproof_security_options_wp_version', $BPS_Options12);
		}	
	}

	echo '<h3>'.__('Pre-Installation Wizard Checks|Scans|Settings have completed:', 'bulletproof-security').'</h3><div style="font-size:12px;margin:-10px 0px 10px 0px;font-weight:bold;">'.__('If you see all green font messages displayed below, scroll down and click the Setup Wizard button.', 'bulletproof-security').'<br>'.__('If you see any red font or blue font messages displayed below, click the Read Me help button above and read the "Notes" help section before clicking the Setup Wizard button.', 'bulletproof-security').'</div>';   
	echo '<div id="Wizard-background" style="max-height:250px;width:85%;overflow:auto;margin:0px;padding:10px;border:2px solid black;background-color:#ffffe0;">';
	
	if ( @substr($sapi_type, 0, 6) != 'apache' && get_filesystem_method() == 'direct') {
		echo $successTextBegin.__('Pass! Compatible Server Configuration: Server API: CGI | WP Filesystem API Method: direct.', 'bulletproof-security').$successTextEnd;
	}
	elseif ( @substr($sapi_type, 0, 6) == 'apache' && preg_match('#\\\\#', ABSPATH, $matches) && get_filesystem_method() == 'direct') {
		echo $successTextBegin.__('Pass! Compatible Server Configuration: Server Type Apache: XAMPP, WAMP, MAMP or LAMP | WP Filesystem API Method: direct.', 'bulletproof-security').$successTextEnd;	
	}
	elseif ( @substr($sapi_type, 0, 6) == 'apache' && !preg_match('#\\\\#', ABSPATH, $matches) && get_filesystem_method() == 'direct') {
		echo $successTextBegin.__('Pass! Compatible Server Configuration: Server API: DSO | WP Filesystem API Method: direct.', 'bulletproof-security').$successTextEnd;		
	}
	elseif ( @substr($sapi_type, 0, 6) == 'apache' && get_filesystem_method() != 'direct') {
		echo $failTextBegin.__('Server API: Apache DSO Server Configuration | WP Filesystem API Method: ', 'bulletproof-security').get_filesystem_method().$failTextEnd.'<br>'.__('Your Server type is DSO and the WP Filesystem API Method is NOT "direct". You can use the Setup Wizard, but you must first make some one-time manual changes to your website before running the Setup Wizard. Please click this Forum Link for instructions: ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/dso-setup-steps/" target="_blank" title="Link opens in a new Browser window"><strong>'.__('DSO Setup Steps', 'bulletproof-security').'</a></strong><br><br>';			
	}
	
	$memoryLimitM = get_cfg_var('memory_limit');
	$memoryLimit = str_replace('M', '', $memoryLimitM);

	if ( $memoryLimit == '' || !$memoryLimitM ) {
		echo '<strong><font color="blue">'.__('Unable to get the PHP Configuration Memory Limit value from the Server. The ini_set Options memory limit setting will be set to 128M automatically by the Setup Wizard to prevent problems or errors with the BPS Pro Setup.', 'bulletproof-security').'</font></strong><br>';

	} else {

switch ( $memoryLimit ) {
    case $memoryLimit >= '128':
		echo $successTextBegin.__('Pass! PHP Configuration Memory Limit is set to: ', 'bulletproof-security').$memoryLimit.'M'.$successTextEnd;		
		break;
    case $memoryLimit >= '64' && $memoryLimit < '128':
		echo $successTextBegin.__('Pass! PHP Configuration Memory Limit is set to: ', 'bulletproof-security').$memoryLimit.'M. '.__('It is recommended that you increase your memory limit to at least 128M.', 'bulletproof-security').$successTextEnd;
		break;
    case $memoryLimit > '0' && $memoryLimit < '64':
		echo '<br>'.$failTextBegin.__('Error: Your PHP Configuration Memory Limit is set to: ', 'bulletproof-security').$memoryLimit.'M. '.__('WordPress needs a bare minimum Memory Limit setting of 64M to perform well. The Setup Wizard may or may not be able to complete the BPS Pro setup successfully until you increase your memory limit to at least 64M. Most Web Host\'s allow your memory limit to be set to at least 128M. Contact your Web Host and ask them to increase your memory limit to the maximum memory limit setting allowed by your Host.', 'bulletproof-security').$failTextEnd.'<br>';	
		break;
 	}
	}

	if ( !file_exists($wpconfig) ) {
		echo '<br>'.$failTextBegin.__('Error: A wp-config.php file was NOT found in your website root folder.', 'bulletproof-security').$failTextEnd.__('If you have moved your wp-config.php file to another folder location then you will need to add the BPS Pro ini_set code to your wp-config.php file manually.', 'bulletproof-security').'<br>'.__('The BPS ini_set code can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config. Setup instructions are included in the file.', 'bulletproof-security').'<br>';
	}
	
	// Create .htaccess files if they do not exist else Backup existing htaccess files first and then create new .htaccess files.
	if ( !file_exists($rootHtaccess) ) {
		bpsSetupWizardCreateRootHtaccess();
	
	} else {
		
		preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $rootHtaccessContents, $Rootmatches);
		preg_match_all('/AddHandler|SetEnv PHPRC|suPHP_ConfigPath|Action application/', $RootCustomCode['bps_customcode_one'], $DBmatches);
		
		if ( $Rootmatches[0] && !$DBmatches[0] ) {
			echo '<br>'.$failTextBegin.__('Error: PHP/php.ini handler htaccess code check', 'bulletproof-security').$failTextEnd.'<br>'.__('PHP/php.ini handler htaccess code was found in your root .htaccess file, but was NOT found in BPS Pro Custom Code. Do NOT click the Setup Wizard button yet and instead click this Forum Link ', 'bulletproof-security').'<a href="http://forum.ait-pro.com/forums/topic/pre-installation-wizard-checks-phpphp-ini-handler-htaccess-code-check/" target="_blank" title="Link opens in a new Browser window"><strong>'.__('Add php.ini handler htaccess code to BPS Pro Custom Code', 'bulletproof-security').'</a></strong>'.__(' for instructions on how to copy your PHP/php.ini handler htaccess code to BPS Pro Custom Code before running the Setup Wizard.', 'bulletproof-security').'<br><br>';	
		}		
		
		copy($rootHtaccess, $rootHtaccessBackup);	
		echo $successTextBegin.__('Pass! Root .htaccess file backup Successful!', 'bulletproof-security').$successTextEnd;		
		
		// Create the new Root .htaccess file ONLY if there is not a php.ini handler in the root .htaccess file OR
		// if there is a php.ini handler that exists in BOTH the root .htaccess file and Custom Code
		if ( !$Rootmatches[0] || $Rootmatches[0] && $DBmatches[0] ) {
			bpsSetupWizardCreateRootHtaccess();
		}
	}

	if ( !file_exists($wpadminHtaccess) ) {
		bpsSetupWizardCreateWpadminHtaccess();
	} else {
		copy($wpadminHtaccess, $wpadminHtaccessBackup);
		bpsSetupWizardCreateWpadminHtaccess();		
		echo $successTextBegin.__('Pass! wp-admin .htaccess file backup Successful!', 'bulletproof-security').$successTextEnd;
	}

		// F-Lock CGI file permission Check - Save DB values based on existing root htaccess file permissions
		// The actual final F-Lock DB values will be updated in the Setup Wizard
		$permsRootHtaccess = @substr(sprintf('%o', fileperms($rootHtaccess)), -4); // 0644 / 0404

		if ( @substr($sapi_type, 0, 6) != 'apache' && $permsRootHtaccess != '0404') {
		
			$bps_option_name_pc = 'bulletproof_security_options_setup_wizard_flock';
			$bps_new_value1_pc = 'no';
			$bps_new_value2_pc = 'no';
			$bps_new_value3_pc = 'no';
			$bps_new_value4_pc = 'no';
			
			$BPS_Options_pc = array(
			'bps_wizard_root_htaccess_flock' 	=> $bps_new_value1_pc, 
			'bps_wizard_wpconfig_flock' 		=> $bps_new_value2_pc, 
			'bps_wizard_index_flock' 			=> $bps_new_value3_pc, 
			'bps_wizard_wpblogheader_flock' 	=> $bps_new_value4_pc
			);

			if ( ! get_option( $bps_option_name_pc ) ) {	
			
				foreach( $BPS_Options_pc as $key => $value ) {
					update_option('bulletproof_security_options_setup_wizard_flock', $BPS_Options_pc);
				}
	
			} else {

				foreach( $BPS_Options_pc as $key => $value ) {
					update_option('bulletproof_security_options_setup_wizard_flock', $BPS_Options_pc);
				}
			}
			echo '<strong><font color="blue">'.__('Your current Root .htaccess file is not locked. In order to ensure that the Setup Wizard completes successfully your files will NOT be locked by BPS Pro F-Lock. Your F-Lock settings will be set to "Turn Off Checking & Alerts".', 'bulletproof-security').'</font></strong><br>';		
		}
	
		if ( @substr($sapi_type, 0, 6) != 'apache' && $permsRootHtaccess == '0404') {
		
			$bps_option_name_pc = 'bulletproof_security_options_setup_wizard_flock';
			$bps_new_value1_pc = 'yes';
			$bps_new_value2_pc = 'yes';
			$bps_new_value3_pc = 'yes';
			$bps_new_value4_pc = 'yes';
			
			$BPS_Options_pc = array(
			'bps_wizard_root_htaccess_flock' 	=> $bps_new_value1_pc, 
			'bps_wizard_wpconfig_flock' 		=> $bps_new_value2_pc, 
			'bps_wizard_index_flock' 			=> $bps_new_value3_pc, 
			'bps_wizard_wpblogheader_flock' 	=> $bps_new_value4_pc
			);

			if ( ! get_option( $bps_option_name_pc ) ) {	
			
				foreach( $BPS_Options_pc as $key => $value ) {
					update_option('bulletproof_security_options_setup_wizard_flock', $BPS_Options_pc);
				}
	
			} else {

				foreach( $BPS_Options_pc as $key => $value ) {
					update_option('bulletproof_security_options_setup_wizard_flock', $BPS_Options_pc);
				}
			}	
			echo $successTextBegin.__('Pass! F-Lock check. The Root .htaccess file can be locked.', 'bulletproof-security').$successTextEnd;
		} 

	// Plugin Firewall cURL pre-check - Check if cURL is enabled and cURL functions are not disabled
	bpsSetupWizardcURLCheck();
	
	// PHP/php.ini htaccess code pre-check - Check if root .htaccess file has php.ini handler code and if that code has been added to BPS Pro Custom Code
	bpsSetupWizardPhpiniHandlerCheck();
	
	// AutoRestore/Quarantine pre-check - Create /wp-includes/version.php ARQ exclude rule if it does not exist
	bps_wp_versionphp_exclude_rule();
	
	// AutoRestore/Quarantine pre-check - Create ARQ exclude DB options: plugins, mu-plugins & other wp-content folders that should be excluded: backup folders, etc.
	bpsSetupWizardARQExcludeDB();

	// AutoRestore/Quarantine pre-check - Create the ARQ exclude filters in class.php & copy class.php to the /master-backups folder
	bpsSetupWizardARQExcludeFile();
	
	// AutoRestore/Quarantine pre-check - Check for sitemap.xml and sitemap.xml.gz if they exist
	if ( file_exists(ABSPATH . 'sitemap.xml') ) {	
		echo $successTextBegin.__('Pass! ARQ Exclude Rule will be created for sitemap file: ', 'bulletproof-security').ABSPATH . 'sitemap.xml'.$successTextEnd;	
	}
	if ( file_exists(ABSPATH . 'sitemap.xml.gz') ) {	
		echo $successTextBegin.__('Pass! ARQ Exclude Rule will be created for sitemap file: ', 'bulletproof-security').ABSPATH . 'sitemap.xml.gz'.$successTextEnd;	
	}	
	
	// Plugin Firewall cURL Scan - scan up to 250 Pages & Posts - Save Plugin Firewall whitelist rules to DB
	bpsSetupWizardPluginFirewall_DB();
	
	$time_end = microtime( true );
	$wizard_run_time = $time_end - $time_start;
	$wizard_time_display = '<strong>Pre-Installation Wizard Completion Time: </strong>'. round( $wizard_run_time, 2 ) . ' Seconds';
	
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<strong><font color="green">'.__('The Pre-Installation Wizard Checks|Scans|Settings have completed.', 'bulletproof-security').'<br>'.__('Scroll down and click the Setup Wizard button if you do not see any errors or displayed messages for things that need to be corrected first before running the Setup Wizard.', 'bulletproof-security').'</font></strong><br>';
		echo $text;
		echo '</p></div>';
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		echo bpsPro_memory_resource_usage();
		echo $wizard_time_display;
		echo '</p></div>';
	echo '</div>';
	}
}
/****************************************/
// END BPS Pro Pre-Installation Wizard
/****************************************/

/****************************************/
# BEGIN AutoRestore File Backup functions
/****************************************/

// Setup Wizard - Root ARQ Backup - Copy Root files to autorestore/root-files folder & rename root .htaccess to auto_.htaccess
function bpsSetupWizard_ARQ_root_backup($source, $dest) {
	
	if ( current_user_can('manage_options') ) {
	
	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files' ) ) {
		mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/', 0755 );
	}

	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
	$source = ABSPATH;
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

	foreach ( $iterator as $file ) {
		try {
			if ( $file->isFile() ) {
			if ( $file->getFilename() == '.htaccess' ) {
				copy($file->getPathname(), $dest.DIRECTORY_SEPARATOR.'auto_'.$file->getFilename());
			} else {
				copy($file->getPathname(), $dest.DIRECTORY_SEPARATOR.$file->getFilename());
			}
			}
		} catch (RuntimeException $e) {}
	}		

	$text = '<strong><font color="green">'.__('ARQ Root File Backup - files backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/root-files Successfully!', 'bulletproof-security').'</font></strong><br>';
	echo $text;
	}
	}
}

// Setup Wizard - wp-admin ARQ Backup
// Copy wp-admin folders and files to autorestore folder - maintain exact directory structure - rename .htaccess to wpadmin.htaccess
function bpsSetupWizard_ARQ_wpadmin_backup($source, $dest) {
	if ( current_user_can('manage_options') ) {
	
	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin' ) ) {
		mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/', 0755 );
	}

	$source = ABSPATH.'wp-admin';
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/.htaccess';
	$htaccessARQRename = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);	
		
		foreach ( $iterator as $file ) {
			if ( $file->isDir() )	{
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}
	$text = '<strong><font color="green">'.__('ARQ wp-admin File Backup - files backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-admin Successfully!', 'bulletproof-security').'</font></strong><br>';
	echo $text;

	} else {
		copy($source, $dest);
	} // end is_dir
	
	if (file_exists($htaccessARQ)) {
		rename($htaccessARQ, $htaccessARQRename);
	}
	}
}

// Setup Wizard - wp-includes ARQ Backup
// Copy wp-includes folders and files to autorestore folder - maintain exact directory structure
function bpsSetupWizard_ARQ_wpincludes_backup($source, $dest) {
	if ( current_user_can('manage_options') ) {
	
	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes' ) ) {
		mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/', 0755 );
	}

	$source = ABSPATH.'wp-includes';
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);	
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
		
		foreach ( $iterator as $file ) {
			if ( $file->isDir() )	{
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}
	$text = '<strong><font color="green">'.__('ARQ wp-includes File Backup - files backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-includes Successfully!', 'bulletproof-security').'</font></strong><br>';
	echo $text;
	} else {
		copy($source, $dest);
	}
	}
}

// Setup Wizard - wp-content ARQ Backup
// Copy wp-content folders and files to autorestore folder - maintain exact directory structure
// Exclude: 'uploads', 'upgrade', 'blogs.dir', 'bps-backup', 'w3tc', 'cache', 'plugins/si-captcha-for-wordpress/captcha/temp', 'plugins/jetpack', 'plugins',
function bpsSetupWizard_ARQ_wpcontent_backup($source, $dest) {
	if ( current_user_can('manage_options') ) {
		
	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content' ) ) {
		mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/', 0755 );
	}

	$source = WP_CONTENT_DIR;
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);	
	
	if ( is_dir($source) ) {
		$dirItr    = new RecursiveDirectoryIterator($source);		
		$filterItr = new BPSCopyWPCRecursiveFilterIterator($dirItr);
		$iterator  = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST); 
		
		foreach ( $iterator as $file ) {
			if ( $file->isDir() ) {
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				@copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}
	$text = '<strong><font color="green">'.__('ARQ wp-content File Backup - files backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-content Successfully!', 'bulletproof-security').'</font></strong><br>';
	echo $text;
	} else {
		@copy($source, $dest);
	}
	}
}

// ARQ Root Backup file counter
function bpsSetupWizardFileCounterRootARQ($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
	$count = 0;
	
	if ( ! is_dir($source) ) {
		$text = '<br><font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$source.__(' folder does NOT exist.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// Root website file counter
function bpsSetupWizardFileCounterRoot($source, $count) {
	$source = ABSPATH;
	$count = 0;
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// ARQ wp-admin Backup file counter
// ONLY count the total number of files in the root wp-admin directory & NOT all folders and files
function bpsSetupWizardFileCounterWpadminARQ($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	$count = 0;
	
	if ( ! is_dir($source) ) {
		$text = '<br><font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$source.__(' folder does NOT exist.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// wp-admin root folder website file counter
function bpsSetupWizardFileCounterWpadmin($source, $count) {
	$source = ABSPATH . 'wp-admin';
	$count = 0;
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// ARQ wp-includes Backup file counter
// ONLY count the total number of files in the root wp-includes directory & NOT all folders and files
function bpsSetupWizardFileCounterWpincludesARQ($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	$count = 0;
	
	if ( ! is_dir($source) ) {
		$text = '<br><font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$source.__(' folder does NOT exist.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// wp-includes root folder website file counter
function bpsSetupWizardFileCounterWpincludes($source, $count) {
	$source = ABSPATH . 'wp-includes';
	$count = 0;
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// ARQ wp-content Backup file counter
// ONLY count the total number of files in the root wp-content directory & NOT all folders and files
function bpsSetupWizardFileCounterWpcontentARQ($source, $count) {
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$count = 0;
	
	if ( ! is_dir($source) ) {
		$text = '<br><font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$source.__(' folder does NOT exist.', 'bulletproof-security').'</strong></font><br>';
		echo $text;
	}

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}

// wp-content root folder website file counter
function bpsSetupWizardFileCounterWpcontent($source, $count) {
	$source = WP_CONTENT_DIR;
	$count = 0;
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		foreach ( $iterator as $files ) {
    		if ( $files->isFile() ) {
    			$count++;
			}
		}
	}
}
/****************************************/
# END AutoRestore File Backup functions
/****************************************/

// Get the Current / Last Modifed Date of the Login Security Reset File
function bps_SWLoginSecurityResetFileLastMod() {
$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date("F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

/**************************/
// BPS Pro Setup Wizard
/**************************/

// BPS Pro Setup Wizard - Fail message
function bpsSetupWizardFail() {
	if ( isset($_POST['Submit-Setup-Wizard'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bps_setup_wizard' );
	
	$PreInstallOptions = get_option('bulletproof_security_options_preinstallation');  

		if ( !$PreInstallOptions['bps_wizard_preinstallation'] || $PreInstallOptions['bps_wizard_preinstallation'] != 'yes' || $PreInstallOptions['bps_wizard_preinstallation_61'] != 'yes') {
			echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
			$text = '<strong><font color="red">'.__('The Run Pre-Installation Wizard Checks button must be clicked first before you can Run the Setup Wizard.', 'bulletproof-security').'</font></strong><br>';
			echo $text;
			echo '</p></div>';
		}
	}
}

// BPS Pro Setup Wizard - Magically Delicious :)
function bpsSetupWizard() {

if ( isset( $_POST['Submit-Setup-Wizard'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bps_setup_wizard' );
		set_time_limit(300);

global $wpdb, $wp_version, $bpspro_version;
//global $bulletproof_security_arq_db_version;

$time_start = microtime( true );

$Qtable_name = $wpdb->prefix . "bpspro_arq_quarantine";
$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
//$Ptable_name = $wpdb->prefix . "bpspro_pfw_override";
$Stable_name = $wpdb->prefix . "bpspro_seclog_ignore";
$Ltable_name = $wpdb->prefix . "bpspro_login_security";
$DMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";
$DBBtable_name = $wpdb->prefix . "bpspro_db_backup";

$successTextBegin = '<font color="green"><strong>';
$successMessage = __(' DB Table created Successfully!', 'bulletproof-security');
$successTextEnd = '</strong></font><br>';
$failTextBegin = '<font color="red"><strong>';
$failMessage = __('Error: Unable to create DB Table ', 'bulletproof-security');
$failTextEnd = '</strong></font><br>';

	$PreInstallOptions = get_option('bulletproof_security_options_preinstallation');  

	if ( ! $PreInstallOptions['bps_wizard_preinstallation'] || $PreInstallOptions['bps_wizard_preinstallation'] != 'yes' || $PreInstallOptions['bps_wizard_preinstallation_61'] != 'yes') {
	
	} else {
	
	echo '<h3>'.__('BPS Pro Setup Verification & Error Checks', 'bulletproof-security').'</h3>';
	echo '<div style="font-size:12px;margin:-10px 0px 10px 0px;font-weight:bold;">'.__('If you see all green font messages displayed below, the Setup Wizard setup completed successfully.', 'bulletproof-security').'<br>'.__('If you see any red font or blue font messages displayed below, click the Read Me help button above and read the "Notes" help section.', 'bulletproof-security').'</div>';
	echo '<div id="Wizard-background" style="max-height:250px;width:85%;overflow:auto;margin-bottom:20px;padding:10px;border:2px solid black;background-color:#ffffe0;">';
	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Synchronize WordPress Version', 'bulletproof-security').'</div>';
	echo '<div id="SWWPVersion" style="border-top:3px solid #999999;margin-top:-10px;"><p>';
	// Update BPS DB option - WP version matches the current version of WP & reset the last modified time in DB
	$successMessageWPV = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$versionphp = ABSPATH . 'wp-includes/version.php';	
	$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
	$bps_option_name_wpv = 'bulletproof_security_options_wp_version';
	$bps_new_value_wpv = $wp_version;	
	$bps_new_value_wpv1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);		
	
	$BPS_Options_wpv = array( 'bps_wp_version' => $bps_new_value_wpv, 'bps_wp_version_last_modified_time' => $bps_new_value_wpv1 );	
	
	if ( ! get_option( $bps_option_name_wpv ) ) {	
		
		foreach( $BPS_Options_wpv as $key => $value ) {
			update_option('bulletproof_security_options_wp_version', $BPS_Options_wpv);
			echo $successTextBegin.$key.$successMessageWPV.$successTextEnd;
		}
	
	} else {

		foreach( $BPS_Options_wpv as $key => $value ) {
			update_option('bulletproof_security_options_wp_version', $BPS_Options_wpv);
			echo $successTextBegin.$key.$successMessageWPV.$successTextEnd;
		}	
	}
	
	// ARQ upgrade checking option - no need to echo this
	$arq_upgrade = 'bulletproof_security_options_ARQ_upgrade';
	$BPS_ARQ_upgrade = array( 'bps_arq_upgrade' => 'no' );	
	
	if ( ! get_option( $arq_upgrade ) ) {	
		
		foreach( $BPS_ARQ_upgrade as $key => $value ) {
			update_option('bulletproof_security_options_ARQ_upgrade', $BPS_ARQ_upgrade);
		}
	
	} else {

		foreach( $BPS_ARQ_upgrade as $key => $value ) {
			update_option('bulletproof_security_options_ARQ_upgrade', $BPS_ARQ_upgrade);
		}
	}	
	
	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Database Tables Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWDBTables" style="border-top:3px solid #999999;margin-top:-10px;"><p>';
	
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Qtable_name ) ) == $Qtable_name ) {
		echo $successTextBegin.$Qtable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$Qtable_name.$failTextEnd;	
	}
	
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Etable_name ) ) == $Etable_name ) {
		echo $successTextBegin.$Etable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$Etable_name.$failTextEnd;	
	}
	
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Stable_name ) ) == $Stable_name ) {
		echo $successTextBegin.$Stable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$Stable_name.$failTextEnd;	
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Ltable_name ) ) == $Ltable_name ) {
		echo $successTextBegin.$Ltable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$Ltable_name.$failTextEnd;	
	}

	/*
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Ptable_name ) ) == $Ptable_name ) {
		echo $successTextBegin.$Ptable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$Ptable_name.$failTextEnd;	
	}
	*/	
	
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $DMtable_name ) ) == $DMtable_name ) {
		echo $successTextBegin.$DMtable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$DMtable_name.$failTextEnd;	
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $DBBtable_name ) ) == $DBBtable_name ) {
		echo $successTextBegin.$DBBtable_name.$successMessage.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage.$DBBtable_name.$failTextEnd;	
	}

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Core Folders Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWFolders" style="border-top:3px solid #999999;margin-top:-10px;"><p>';
	
	$successMessage2 = __(' Folder created Successfully!', 'bulletproof-security');
	$failMessage2 = __('Error: Unable to create Folder ', 'bulletproof-security');

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup' ) ) {	
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup'.$successMessage2.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage2.WP_CONTENT_DIR . '/bps-backup'.$failTextEnd;	
	}	

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup' ) ) {	
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/master-backups'.$successMessage2.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage2.WP_CONTENT_DIR . '/bps-backup/master-backups'.$failTextEnd;	
	}
	
	if ( is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore' ) ) {	
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/autorestore'.$successMessage2.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage2.WP_CONTENT_DIR . '/bps-backup/autorestore'.$failTextEnd;	
	}

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup/quarantine' ) ) {	
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/quarantine'.$successMessage2.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage2.WP_CONTENT_DIR . '/bps-backup/quarantine'.$failTextEnd;	
	}

	if ( is_dir( WP_CONTENT_DIR . '/bps-backup/logs' ) ) {	
		echo $successTextBegin.WP_CONTENT_DIR . '/bps-backup/logs'.$successMessage2.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage2.WP_CONTENT_DIR . '/bps-backup/logs'.$failTextEnd;	
	}

	echo '</p></div>';
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Core Files Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWFiles" style="border-top:3px solid #999999;margin-top:-10px;"><p>';

	$successMessage3 = __(' File created or updated Successfully!', 'bulletproof-security');
	$failMessage3 = __('Error: Unable to create or update File ', 'bulletproof-security');	
	// add Deny All .htaccess files just for show - deny all .htaccess files are already in folders at installation
	
	$bps_ARHtaccess = WP_CONTENT_DIR . '/bps-backup/.htaccess';	
	$bps_ARHtaccessM = WP_CONTENT_DIR . '/bps-backup/master-backups/.htaccess';	
	$bps_AutoRestore_LogARQ = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';	
	$bpsStringReplaceLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/string_replacer_log.txt';
	$bpsProSecLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
	$bpsProPHPELogARQ = WP_CONTENT_DIR . '/bps-backup/logs/bps_php_error.log';
	$bpsProDBMLog = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
	$SecurityLogReset = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
	// NOTE: class.php is a special case handle it later

	if ( file_exists($bps_ARHtaccess) ) {
		echo $successTextBegin.$bps_ARHtaccess.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bps_ARHtaccess.$failTextEnd;	
	}
		
	if ( file_exists($bps_ARHtaccessM) ) {
		echo $successTextBegin.$bps_ARHtaccessM.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bps_ARHtaccessM.$failTextEnd;	
	}

	if ( file_exists($bps_AutoRestore_LogARQ) ) {
		echo $successTextBegin.$bps_AutoRestore_LogARQ.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bps_AutoRestore_LogARQ.$failTextEnd;	
	}	

	if ( file_exists($bpsStringReplaceLogARQ) ) {
		echo $successTextBegin.$bpsStringReplaceLogARQ.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bpsStringReplaceLogARQ.$failTextEnd;	
	}	

	if ( file_exists($bpsProSecLogARQ) ) {
		echo $successTextBegin.$bpsProSecLogARQ.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bpsProSecLogARQ.$failTextEnd;	
	}

	if ( file_exists($bpsProPHPELogARQ) ) {
		echo $successTextBegin.$bpsProPHPELogARQ.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bpsProPHPELogARQ.$failTextEnd;	
	}

	if ( file_exists($SecurityLogReset) ) {
		echo $successTextBegin.$SecurityLogReset.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$SecurityLogReset.$failTextEnd;	
	}	
	
	if ( file_exists($bpsProDBMLog) ) {
		echo $successTextBegin.$bpsProDBMLog.$successMessage3.$successTextEnd;
	} else {
		echo $failTextBegin.$failMessage3.$bpsProDBMLog.$failTextEnd;	
	}

	echo '</p></div>';
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security DB Monitor Setup', 'bulletproof-security').'</div>';
	echo '<div id="DBMonitor" style="border-top:3px solid #999999;margin-top:-10px;"><p>';

	$DBMoptions = get_option('bulletproof_security_options_wizard_curl');
	
	if ( $DBMoptions['bps_wizard_dbm_settings'] == 'Off' ) {
		echo '<strong><font color="blue">'.__('Keep Existing DB Monitor Settings option is selected. DB Monitor settings were not changed.', 'bulletproof-security').'</font></strong><br>';
	} else {
	
		$dbm_successMessage = __(' DB Option created or updated Successfully!', 'bulletproof-security');	
		$bps_dbm_options = 'bulletproof_security_options_db_monitor';
	
		$DBM_Options = array( 
		'bps_db_monitor_cron' 						=> 'On', 
		'bps_db_monitor_cron_frequency' 			=> '15', 
		'bps_db_monitor_cron_table_created_check' 	=> 'On', 
		'bps_db_monitor_cron_end' 					=> time() + 900
		);
	
		if ( ! get_option( $bps_dbm_options ) ) {	
		
			foreach( $DBM_Options as $key => $value ) {
				update_option('bulletproof_security_options_db_monitor', $DBM_Options);
				echo $successTextBegin.$key.$dbm_successMessage.$successTextEnd;	
			}
	
		} else {

			$BPS_DBM_options = get_option('bulletproof_security_options_db_monitor');
		
			$DBM_Options = array( 
			'bps_db_monitor_cron' 						=> $BPS_DBM_options['bps_db_monitor_cron'], 
			'bps_db_monitor_cron_frequency' 			=> $BPS_DBM_options['bps_db_monitor_cron_frequency'], 
			'bps_db_monitor_cron_table_created_check' 	=> $BPS_DBM_options['bps_db_monitor_cron_table_created_check'], 
			'bps_db_monitor_cron_end' 					=> $BPS_DBM_options['bps_db_monitor_cron_end']
			);

			foreach( $DBM_Options as $key => $value ) {
				update_option('bulletproof_security_options_db_monitor', $DBM_Options);
				echo $successTextBegin.$key.$dbm_successMessage.$successTextEnd;	
			}
		}	
		echo $successTextBegin.__('DB Monitor DB Options created or updated Successfully!', 'bulletproof-security').$successTextEnd;
	}
	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security DB Backup Setup', 'bulletproof-security').'</div>';
	echo '<div id="DBBackup" style="border-top:3px solid #999999;margin-top:-10px;"><p>';

	bpsSetupWizard_dbbackup_folder_check();
	
	echo '</p></div>';
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Uploads Anti-Exploit Guard (UAEG) Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWUAEG" style="border-top:3px solid #999999;margin-top:-10px;"><p>';

	$bps_Uploads_Dir = wp_upload_dir();
	$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder
	$successMessageU = __(' File created or updated Successfully!', 'bulletproof-security');
	$failMessageU = __('Error: Unable to create or update File ', 'bulletproof-security');	

	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {

		$text = '<font color="blue"><strong>'.__('Go Daddy Managed WordPress Hosting requires that you manually activate the BPS Pro Uploads Anti-Exploit Guard (UAEG) on the B-Core Security Modes page.', 'bulletproof-security').'</strong></font>';
		echo $text;
	
	} else {

		if ( is_dir( $bps_Uploads_Dir['basedir'] ) && file_exists($UploadsHtaccess) ) {
			echo $successTextBegin.$UploadsHtaccess.$successMessageU.$successTextEnd;
		} else {
			echo $failTextBegin.$failMessageU.$UploadsHtaccess.$failTextEnd;	
		}	
	}
	
	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Security Log User Agent Filter Setup', 'bulletproof-security').'</div>';
	echo '<div id="SLuserAgentFilter" style="border-top:3px solid #999999;margin-top:-10px;"><p>';
	bpsSetupWizard_autoupdate_useragent_filters();
	echo '</p></div>';
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Log Files Database Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWDBOptions" style="border-top:3px solid #999999;margin-top:-10px;"><p>';
	// NOTE: The update_option incorporates add_option and will add the DB option if it does not already exist
	// $failMessage4 = __('Error: Unable to create or update DB Option ', 'bulletproof-security');	
	
	$successMessage4 = __(' DB Option created or updated Successfully!', 'bulletproof-security');

	$bps_option_name1 = 'bulletproof_security_options_ARCM_log';
	$bps_new_value1 = bps_getARCMLogLastMod_wp_secs();
	$BPS_Options1 = array( 'bps_arcm_log_date_mod' => $bps_new_value1 );

	if ( ! get_option( $bps_option_name1 ) ) {	
		update_option('bulletproof_security_options_ARCM_log', $BPS_Options1);
		echo $successTextBegin.$bps_option_name1.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_ARCM_log', $BPS_Options1);
		echo $successTextBegin.$bps_option_name1.$successMessage4.$successTextEnd;
	}	

	$bps_option_name2 = 'bulletproof_security_options_Security_log';
	$bps_new_value2 = bps_getSecurityLogLastMod_secs();
	$BPS_Options2 = array('bps_security_log_date_mod' => $bps_new_value2);

	if ( ! get_option( $bps_option_name2 ) ) {	
		update_option('bulletproof_security_options_Security_log', $BPS_Options2);
		echo $successTextBegin.$bps_option_name2.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_Security_log', $BPS_Options2);
		echo $successTextBegin.$bps_option_name2.$successMessage4.$successTextEnd;
	}

	$bps_option_name3 = 'bulletproof_security_options2';
	$bps_new_value3 = addslashes(WP_CONTENT_DIR . '/bps-backup/logs/bps_php_error.log');
	$BPS_Options3 = array('bps_error_log_location' => $bps_new_value3);

	if ( ! get_option( $bps_option_name3 ) ) {	
		update_option('bulletproof_security_options2', $BPS_Options3);
		echo $successTextBegin.$bps_option_name3.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options2', $BPS_Options3);
		echo $successTextBegin.$bps_option_name3.$successMessage4.$successTextEnd;
	}
	
	$bps_option_name4 = 'bulletproof_security_options_elog';
	$bps_new_value4 = bps_getPhpELogLastMod_smonitor();
	$BPS_Options4 = array('bps_error_log_date_mod' => $bps_new_value4);

	if ( ! get_option( $bps_option_name4 ) ) {	
		update_option('bulletproof_security_options_elog', $BPS_Options4);
		echo $successTextBegin.$bps_option_name4.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_elog', $BPS_Options4);
		echo $successTextBegin.$bps_option_name4.$successMessage4.$successTextEnd;
	}
	
	$bps_option_name_dbm = 'bulletproof_security_options_DBM_log';
	$bps_new_value_dbm = bpsPro_DBM_LogLastMod_wp_secs();
	$BPS_Options_dbm = array( 'bps_dbm_log_date_mod' => $bps_new_value_dbm );

	if ( ! get_option( $bps_option_name_dbm ) ) {	
		update_option('bulletproof_security_options_DBM_log', $BPS_Options_dbm);
		echo $successTextBegin.$bps_option_name_dbm.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_DBM_log', $BPS_Options_dbm);
		echo $successTextBegin.$bps_option_name_dbm.$successMessage4.$successTextEnd;
	}

	$bps_option_name_dbb = 'bulletproof_security_options_DBB_log';
	$bps_new_value_dbb = bpsPro_DBB_LogLastMod_wp_secs();
	$BPS_Options_dbb = array( 'bps_dbb_log_date_mod' => $bps_new_value_dbb );

	if ( ! get_option( $bps_option_name_dbb ) ) {	
		update_option('bulletproof_security_options_DBB_log', $BPS_Options_dbb);
		echo $successTextBegin.$bps_option_name_dbb.$successMessage4.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_DBB_log', $BPS_Options_dbb);
		echo $successTextBegin.$bps_option_name_dbb.$successMessage4.$successTextEnd;
	}

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro ini_set Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWiniSetOptions" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	
	
	$successMessage5 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	
	$bps_option_name5 = 'bulletproof_security_options_iniSet';
	$bps_new_value5 = 'E_ALL|E_STRICT';
	$bps_new_value5_1 = 'On';	
	$bps_new_value5_2 = addslashes( WP_CONTENT_DIR . '/bps-backup/logs/bps_php_error.log' );
	
	if ( ini_get('log_errors_max_len') == '1024') {
		$bps_new_value5_3 = '1024';
	} else {
		$bps_new_value5_3 = '1024';		
	}
	
	if ( get_cfg_var('memory_limit') == '' || !get_cfg_var('memory_limit') ) {
		$bps_new_value5_4 = '128M';
	} else {
		$bps_new_value5_4 = get_cfg_var('memory_limit');
	}
	
	$bps_new_value5_4a = 'On';
	$bps_new_value5_4b = 'On';
	$bps_new_value5_4c = 'Off';	
	$bps_new_value5_5 = 'On';
	$bps_new_value5_6 = 'Off';
	$bps_new_value5_7 = 'Off';
	$bps_new_value5_8 = 'Off';
	$bps_new_value5_9 = 'Off';
	$bps_new_value5_10 = 'Off';
	$bps_new_value5_11 = 'Off';
	$bps_new_value5_12 = 'Off';
	$bps_new_value5_13 = '30'; // ini_get('max_execution_time')
	$bps_new_value5_14 = '30'; // ini_get('mysql.connect_timeout')
	$bps_new_value5_15 = 'Off';
	$bps_new_value5_16 = 'On';

	$BPS_Options5 = array(
	'bps_iniSet_ErrorReporting' 			=> $bps_new_value5, 
	'bps_iniSet_LogErrors' 					=> $bps_new_value5_1, 
	'bps_iniSet_ErrorLog' 					=> $bps_new_value5_2, 
	'bps_iniSet_LogErrorsMaxLen' 			=> $bps_new_value5_3, 
	'bps_iniSet_MemoryLimit' 				=> $bps_new_value5_4, 
	'bps_iniSet_session_cookie_httponly' 	=> $bps_new_value5_4a, 
	'bps_iniSet_session_use_only_cookies' 	=> $bps_new_value5_4b, 
	'bps_iniSet_session_cookie_secure' 		=> $bps_new_value5_4c, 
	'bps_iniSet_IgnoreRepeatedErrors' 		=> $bps_new_value5_5, 
	'bps_iniSet_IgnoreRepeatedSource' 		=> $bps_new_value5_6, 
	'bps_iniSet_AllowUrlInclude' 			=> $bps_new_value5_7, 
	'bps_iniSet_DefineSyslogVar' 			=> $bps_new_value5_8, 
	'bps_iniSet_DisplayErrors' 				=> $bps_new_value5_9, 
	'bps_iniSet_DisplayStartupErrors' 		=> $bps_new_value5_10, 
	'bps_iniSet_ImplicitFlush' 				=> $bps_new_value5_11, 
	'bps_iniSet_MagicQuotesRuntime' 		=> $bps_new_value5_12, 
	'bps_iniSet_MaxExecutionTime' 			=> $bps_new_value5_13, 
	'bps_iniSet_MysqlConnectTimeout' 		=> $bps_new_value5_14, 
	'bps_iniSet_MysqlTraceMode' 			=> $bps_new_value5_15, 
	'bps_iniSet_ReportMemleaks' 			=> $bps_new_value5_16 
	);

	if ( ! get_option( $bps_option_name5 ) ) {	
		
		foreach( $BPS_Options5 as $key => $value ) {
			update_option('bulletproof_security_options_iniSet', $BPS_Options5);
			echo $successTextBegin.$key.$successMessage5.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options5 as $key => $value ) {
			update_option('bulletproof_security_options_iniSet', $BPS_Options5);
			echo $successTextBegin.$key.$successMessage5.$successTextEnd;	
		}
	}	

	$wpconfig = ABSPATH . 'wp-config.php';
	
	if ( !file_exists($wpconfig) ) {
		echo '<br>'.$failTextBegin.__('A wp-config.php file was NOT found in your website root folder.', 'bulletproof-security').$failTextEnd.__('If you have moved your wp-config.php file to another folder location then you will need to add the BPS Pro ini_set code to your wp-config.php file manually.', 'bulletproof-security').'<br>'.__('The BPS ini_set code can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config. Setup instructions are included in the file.', 'bulletproof-security').'<br>';
	} else {
		bpsSetupWizardIniSetOptions();
	}

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro S-Monitor Monitoring and Alerting Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWSmonitor" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	
	
	$successMessage6 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	
	$bps_option_name6 = 'bulletproof_security_options_monitor';
	$bps_new_value6 = 'Off';
	$bps_new_value6_1 = 'wpOn';	
	$bps_new_value6_2 = 'wpOn';
	$bps_new_value6_3 = 'wpOn';
	$bps_new_value6_4 = 'wpOn';
	$bps_new_value6_5 = 'wpOn';
	$bps_new_value6_6 = 'wpOn';
	$bps_new_value6_7 = 'wpOn';
	$bps_new_value6_8 = 'wpOn';
	$bps_new_value6_9 = 'wpOn';
	$bps_new_value6_10 = 'wpOn';
	$bps_new_value6_11 = 'wpOn';
	$bps_new_value6_12 = 'wpOn';
	$bps_new_value6_13 = 'wpOn';	
	$bps_new_value6_14 = 'wpOn';
	$bps_new_value6_15 = 'wpOn';
	$bps_new_value6_16 = 'wpOn';	

	$BPS_Options6 = array(
	'bps_first_launch' 				=> $bps_new_value6, 
	'bps_security_status' 			=> $bps_new_value6_1, 
	'bps_SecLog_entry' 				=> $bps_new_value6_2, 
	'bps_autorestore_status' 		=> $bps_new_value6_3, 
	'bps_plugin_firewall_status' 	=> $bps_new_value6_4, 
	'bps_UAEG_status' 				=> $bps_new_value6_5, 
	'bps_login_security_status' 	=> $bps_new_value6_6, 
	'bps_flock_status' 				=> $bps_new_value6_7, 
	'bps_HUD_alerts' 				=> $bps_new_value6_8, 
	'bps_PHP_ELogLoc_set' 			=> $bps_new_value6_9, 
	'bps_PHP_ELog_error' 			=> $bps_new_value6_10, 
	'bps_phpini_created' 			=> $bps_new_value6_11, 
	'bps_login_security_alerts' 	=> $bps_new_value6_12, 
	'bps_jtc_antispam_status' 		=> $bps_new_value6_13, 
	'bps_dbm_status' 				=> $bps_new_value6_14, 
	'bps_dbm_alerts' 				=> $bps_new_value6_15, 
	'bps_dbb_status' 				=> $bps_new_value6_16
	);

	if ( ! get_option( $bps_option_name6 ) ) {	
		
		foreach( $BPS_Options6 as $key => $value ) {
			update_option('bulletproof_security_options_monitor', $BPS_Options6);
			echo $successTextBegin.$key.$successMessage6.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options6 as $key => $value ) {
			update_option('bulletproof_security_options_monitor', $BPS_Options6);
			echo $successTextBegin.$key.$successMessage6.$successTextEnd;	
		}
	}

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro S-Monitor Email Alerting & Log File Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWSmonitor" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	
	
	$admin_email = get_option('admin_email');
	$successMessage7 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	
	$bps_option_name7 = 'bulletproof_security_options_email';
	$bps_new_value7 = $admin_email;
	$bps_new_value7_1 = $admin_email;	
	$bps_new_value7_2 = '';
	$bps_new_value7_3 = '';
	$bps_new_value7_4 = 'lockoutOnly';
	$bps_new_value7_5 = 'yes';
	$bps_new_value7_6 = '500KB';
	$bps_new_value7_7 = 'email';
	$bps_new_value7_8 = 'no';
	$bps_new_value7_9 = '500KB';
	$bps_new_value7_10 = 'email';
	$bps_new_value7_11 = 'no';
	$bps_new_value7_12 = '500KB';
	$bps_new_value7_13 = 'email';
	$bps_new_value7_14 = 'yes';
	$bps_new_value7_15 = 'yes';
	$bps_new_value7_16 = 'email';
	$bps_new_value7_17 = '500KB';
	$bps_new_value7_18 = 'email';
	$bps_new_value7_19 = '500KB';	

	$BPS_Options7 = array(
	'bps_send_email_to' 		=> $bps_new_value7, 
	'bps_send_email_from' 		=> $bps_new_value7_1, 
	'bps_send_email_cc' 		=> $bps_new_value7_2, 
	'bps_send_email_bcc' 		=> $bps_new_value7_3, 
	'bps_login_security_email' 	=> $bps_new_value7_4, 
	'bps_autorestore_email' 	=> $bps_new_value7_5, 
	'bps_arq_log_size' 			=> $bps_new_value7_6, 
	'bps_arq_log_email' 		=> $bps_new_value7_7, 
	'bps_security_log_email' 	=> $bps_new_value7_8, 
	'bps_security_log_size' 	=> $bps_new_value7_9, 
	'bps_security_log_emailL' 	=> $bps_new_value7_10, 
	'bps_error_log_email' 		=> $bps_new_value7_11,  
	'bps_php_log_size' 			=> $bps_new_value7_12, 
	'bps_php_log_email' 		=> $bps_new_value7_13,  
	'bps_upgrade_email' 		=> $bps_new_value7_14,  
	'bps_dbm_email' 			=> $bps_new_value7_15, 
	'bps_dbm_log_email' 		=> $bps_new_value7_16, 
	'bps_dbm_log_size' 			=> $bps_new_value7_17,  
	'bps_dbb_log_email' 		=> $bps_new_value7_18, 
	'bps_dbb_log_size' 			=> $bps_new_value7_19 

	);

	if ( ! get_option( $bps_option_name7 ) ) {	
		
		foreach( $BPS_Options7 as $key => $value ) {
			update_option('bulletproof_security_options_email', $BPS_Options7);
			echo $successTextBegin.$key.$successMessage7.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options7 as $key => $value ) {
			update_option('bulletproof_security_options_email', $BPS_Options7);
			echo $successTextBegin.$key.$successMessage7.$successTextEnd;	
		}
	}

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Login Security & Monitoring Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWLoginSecurity" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	
	
	$successMessage8 = __(' DB Option created or updated Successfully!', 'bulletproof-security');

	$bps_option_name8 = 'bulletproof_security_options_login_security';
	$bps_new_value8 = '3';
	$bps_new_value8_1 = '60';	
	$bps_new_value8_2 = '60';
	$bps_new_value8_3 = '';
	$bps_new_value8_4 = 'On';
	$bps_new_value8_5 = 'logLockouts';
	$bps_new_value8_6 = 'wpErrors';
	$bps_new_value8_7 = 'On';
	$bps_new_value8_8 = 'enable';
	$bps_new_value8_9 = 'ascending';
	
	$BPS_Options8 = array(
	'bps_max_logins' 				=> $bps_new_value8, 
	'bps_lockout_duration' 			=> $bps_new_value8_1, 
	'bps_manual_lockout_duration' 	=> $bps_new_value8_2, 
	'bps_max_db_rows_display' 		=> $bps_new_value8_3, 
	'bps_login_security_OnOff' 		=> $bps_new_value8_4, 
	'bps_login_security_logging' 	=> $bps_new_value8_5, 
	'bps_login_security_errors' 	=> $bps_new_value8_6, 
	'bps_login_security_remaining' 	=> $bps_new_value8_7, 
	'bps_login_security_pw_reset' 	=> $bps_new_value8_8,  
	'bps_login_security_sort' 		=> $bps_new_value8_9 
	);

	if ( ! get_option( $bps_option_name8 ) ) {	
		
		foreach( $BPS_Options8 as $key => $value ) {
			update_option('bulletproof_security_options_login_security', $BPS_Options8);
			echo $successTextBegin.$key.$successMessage8.$successTextEnd;	
		}
	
	} else {

	$BPS_LSM_Options = get_option('bulletproof_security_options_login_security');
		
	$BPS_Options_lsm = array(
	'bps_max_logins' 				=> $BPS_LSM_Options['bps_max_logins'], 
	'bps_lockout_duration' 			=> $BPS_LSM_Options['bps_lockout_duration'], 
	'bps_manual_lockout_duration' 	=> $BPS_LSM_Options['bps_manual_lockout_duration'], 
	'bps_max_db_rows_display' 		=> $BPS_LSM_Options['bps_max_db_rows_display'], 
	'bps_login_security_OnOff' 		=> $BPS_LSM_Options['bps_login_security_OnOff'], 
	'bps_login_security_logging' 	=> $BPS_LSM_Options['bps_login_security_logging'], 
	'bps_login_security_errors' 	=> $BPS_LSM_Options['bps_login_security_errors'], 
	'bps_login_security_remaining' 	=> $BPS_LSM_Options['bps_login_security_remaining'], 
	'bps_login_security_pw_reset' 	=> $BPS_LSM_Options['bps_login_security_pw_reset'],  
	'bps_login_security_sort' 		=> $BPS_LSM_Options['bps_login_security_sort'] 
	);

		foreach( $BPS_Options_lsm as $key => $value ) {
			update_option('bulletproof_security_options_login_security', $BPS_Options_lsm);
			echo $successTextBegin.$key.$successMessage8.$successTextEnd;	
		}
	}	
	
	$bps_option_name9 = 'bulletproof_security_options_login_alerts';
	$bps_new_value9 = bps_SWLoginSecurityResetFileLastMod();
	$BPS_Options9 = array('bps_login_security_db_mod_time' => $bps_new_value9);

	if ( ! get_option( $bps_option_name9 ) ) {	
		update_option('bulletproof_security_options_login_alerts', $BPS_Options9);
		echo $successTextBegin.$bps_option_name9.$successMessage8.$successTextEnd;
	} else {
		update_option('bulletproof_security_options_login_alerts', $BPS_Options9);
		echo $successTextBegin.$bps_option_name9.$successMessage8.$successTextEnd;
	}	
	
	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro JTC Anti-Spam|Anti-Hacker Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWJTC-Anti-Spam" style="border-top:3px solid #999999;margin-top:-10px;"><p>';

	$successMessage9b = __(' DB Option created or updated Successfully!', 'bulletproof-security');

	$bps_option_name9b = 'bulletproof_security_options_login_security_jtc';
	$bps_new_value9b = '';
	$bps_new_value9b_1 = 'Type/Enter:  ';	
	$bps_new_value9b_2 = 'Hover or click the text box below';
	$bps_new_value9b_3 = 'Off';
	$bps_new_value9b_4 = '0';
	$bps_new_value9b_5 = '0';
	$bps_new_value9b_6 = '0';
	$bps_new_value9b_7 = '0';
	$bps_new_value9b_8 = '0';
	$bps_new_value9b_9 = '0';
	$bps_new_value9b_10 = '0';	
	$bps_new_value9b_11 = '0';	
	$bps_new_value9b_12 = '0';
	$bps_new_value9b_13 = '0';
	$bps_new_value9b_14 = '0';
	$bps_new_value9b_15 = '';
	
	$BPS_Options9b = array(
	'bps_tooltip_captcha_key' 			=> $bps_new_value9b, 
	'bps_tooltip_captcha_hover_text' 	=> $bps_new_value9b_1, 
	'bps_tooltip_captcha_title' 		=> $bps_new_value9b_2, 
	'bps_tooltip_captcha_logging' 		=> $bps_new_value9b_3, 
	'bps_jtc_login_form' 				=> $bps_new_value9b_4, 
	'bps_jtc_register_form' 			=> $bps_new_value9b_5, 
	'bps_jtc_lostpassword_form' 		=> $bps_new_value9b_6, 
	'bps_jtc_comment_form' 				=> $bps_new_value9b_7, 
	'bps_jtc_buddypress_register_form' 	=> $bps_new_value9b_8, 
	'bps_jtc_buddypress_sidebar_form' 	=> $bps_new_value9b_9, 
	'bps_jtc_administrator' 			=> $bps_new_value9b_10, 
	'bps_jtc_editor' 					=> $bps_new_value9b_11, 
	'bps_jtc_author' 					=> $bps_new_value9b_12, 
	'bps_jtc_contributor' 				=> $bps_new_value9b_13, 
	'bps_jtc_subscriber' 				=> $bps_new_value9b_14, 
	'bps_jtc_comment_form_error' 		=> $bps_new_value9b_15
	);

	if ( ! get_option( $bps_option_name9b ) ) {	
		
		foreach( $BPS_Options9b as $key => $value ) {
			update_option('bulletproof_security_options_login_security_jtc', $BPS_Options9b);
			echo $successTextBegin.$key.$successMessage9b.$successTextEnd;	
		}
	
	} else {

	$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
		
	$BPS_Options9b = array(
	'bps_tooltip_captcha_key' 			=> $BPSoptionsJTC['bps_tooltip_captcha_key'], 
	'bps_tooltip_captcha_hover_text' 	=> $BPSoptionsJTC['bps_tooltip_captcha_hover_text'], 
	'bps_tooltip_captcha_title' 		=> $BPSoptionsJTC['bps_tooltip_captcha_title'], 
	'bps_tooltip_captcha_logging' 		=> $BPSoptionsJTC['bps_tooltip_captcha_logging'], 
	'bps_jtc_login_form' 				=> $BPSoptionsJTC['bps_jtc_login_form'], 
	'bps_jtc_register_form' 			=> $BPSoptionsJTC['bps_jtc_register_form'], 
	'bps_jtc_lostpassword_form' 		=> $BPSoptionsJTC['bps_jtc_lostpassword_form'], 
	'bps_jtc_comment_form' 				=> $BPSoptionsJTC['bps_jtc_comment_form'], 
	'bps_jtc_buddypress_register_form' 	=> $BPSoptionsJTC['bps_jtc_buddypress_register_form'], 
	'bps_jtc_buddypress_sidebar_form' 	=> $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'], 
	'bps_jtc_administrator' 			=> $BPSoptionsJTC['bps_jtc_administrator'], 
	'bps_jtc_editor' 					=> $BPSoptionsJTC['bps_jtc_editor'], 
	'bps_jtc_author' 					=> $BPSoptionsJTC['bps_jtc_author'], 
	'bps_jtc_contributor' 				=> $BPSoptionsJTC['bps_jtc_contributor'], 
	'bps_jtc_subscriber' 				=> $BPSoptionsJTC['bps_jtc_subscriber'], 
	'bps_jtc_comment_form_error' 		=> $BPSoptionsJTC['bps_jtc_comment_form_error']
	);

		foreach( $BPS_Options9b as $key => $value ) {
			update_option('bulletproof_security_options_login_security_jtc', $BPS_Options9b);
			echo $successTextBegin.$key.$successMessage9b.$successTextEnd;	
		}
	}
	
	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro F-Lock Options Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWFlock" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	
	
	$successMessage10 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	$sapi_type = php_sapi_name();	
	$bps_option_name10 = 'bulletproof_security_options_flock';
	$bps_option_name10A = 'bulletproof_security_options_autolock';
	
	$SWflockPreCheck = get_option('bulletproof_security_options_setup_wizard_flock');

	if ( @substr($sapi_type, 0, 6) == 'apache' || $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'no') {

	$bps_new_value10 = 'off';
	$bps_new_value10_1 = 'off';	
	$bps_new_value10_2 = 'off';
	$bps_new_value10_3 = 'off';
	$bps_new_value10_4 = 'off';
	$bps_new_value10_5 = 'off';
	$bps_new_value10_6 = 'off';
	$bps_new_value10_7 = 'off';
	
	$BPS_Options10 = array(
	'bps_lock_root_htaccess' 		=> $bps_new_value10, 
	'bps_lock_wpconfig' 			=> $bps_new_value10_1, 
	'bps_lock_index_php' 			=> $bps_new_value10_2, 
	'bps_lock_wpblog_header' 		=> $bps_new_value10_3, 
	'bps_lock_root_htaccess_dr' 	=> $bps_new_value10_4, 
	'bps_lock_index_php_dr' 		=> $bps_new_value10_5, 
	'bps_lock_root_htaccess_gwiod' 	=> $bps_new_value10_6, 
	'bps_lock_index_php_gwiod' 		=> $bps_new_value10_7 
	);

	if ( ! get_option( $bps_option_name10 ) ) {	
		
		foreach( $BPS_Options10 as $key => $value ) {
			update_option('bulletproof_security_options_flock', $BPS_Options10);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options10 as $key => $value ) {
			update_option('bulletproof_security_options_flock', $BPS_Options10);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	}	
	
	// AutoLock turned Off
	$bps_new_value10A = 'Off';	
	$BPS_Options10A = array( 'bps_root_htaccess_autolock' => $bps_new_value10A );

	if ( ! get_option( $bps_option_name10A ) ) {	
		
		foreach( $BPS_Options10A as $key => $value ) {
			update_option('bulletproof_security_options_autolock', $BPS_Options10A);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options10A as $key => $value ) {
			update_option('bulletproof_security_options_autolock', $BPS_Options10A);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	}	
	} // end if ( @substr($sapi_type, 0, 6) == 'apache' || $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'no') {

	if ( @substr($sapi_type, 0, 6) != 'apache' && $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'yes') {

	$bps_new_value10 = 'yes';
	$bps_new_value10_1 = 'yes';	
	$bps_new_value10_2 = 'yes';
	$bps_new_value10_3 = 'yes';
	$bps_new_value10_4 = 'off';
	$bps_new_value10_5 = 'off';
	$bps_new_value10_6 = 'off';
	$bps_new_value10_7 = 'off';
	
	$BPS_Options10 = array(
	'bps_lock_root_htaccess' 		=> $bps_new_value10, 
	'bps_lock_wpconfig' 			=> $bps_new_value10_1, 
	'bps_lock_index_php' 			=> $bps_new_value10_2, 
	'bps_lock_wpblog_header' 		=> $bps_new_value10_3, 
	'bps_lock_root_htaccess_dr' 	=> $bps_new_value10_4, 
	'bps_lock_index_php_dr' 		=> $bps_new_value10_5, 
	'bps_lock_root_htaccess_gwiod' 	=> $bps_new_value10_6, 
	'bps_lock_index_php_gwiod' 		=> $bps_new_value10_7 
	);

	if ( ! get_option( $bps_option_name10 ) ) {	
		
		foreach( $BPS_Options10 as $key => $value ) {
			update_option('bulletproof_security_options_flock', $BPS_Options10);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options10 as $key => $value ) {
			update_option('bulletproof_security_options_flock', $BPS_Options10);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	}	
	
	// AutoLock turned On
	$bps_new_value10A = 'On';	
	$BPS_Options10A = array( 'bps_root_htaccess_autolock' => $bps_new_value10A );

	if ( ! get_option( $bps_option_name10A ) ) {	
		
		foreach( $BPS_Options10A as $key => $value ) {
			update_option('bulletproof_security_options_autolock', $BPS_Options10A);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	
	} else {

		foreach( $BPS_Options10A as $key => $value ) {
			update_option('bulletproof_security_options_autolock', $BPS_Options10A);
			echo $successTextBegin.$key.$successMessage10.$successTextEnd;	
		}
	}	
	} // end if ( @substr($sapi_type, 0, 6) != 'apache' && $SWflockPreCheck['bps_wizard_root_htaccess_flock'] == 'yes') {

	echo '</p></div>';	
	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro Plugin Firewall Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWPluginFirewall" style="border-top:3px solid #999999;margin-top:-10px;"><p>';	

		$successMessage10B = __(' DB Option created or updated Successfully!', 'bulletproof-security');
		$pfwap_options = 'bulletproof_security_options_pfw_autopilot';
	
		$BPS_PFWAP_Options = array( 
		'bps_pfw_autopilot_cron' 			=> 'On',  
		'bps_pfw_autopilot_cron_frequency' 	=> '15',  	
		'bps_pfw_autopilot_cron_end' 		=> time() + 900 
		);

	if ( ! get_option( $pfwap_options ) ) {	
		
		foreach( $BPS_PFWAP_Options as $key => $value ) {
			update_option('bulletproof_security_options_pfw_autopilot', $BPS_PFWAP_Options);
			echo $successTextBegin.$key.$successMessage10B.$successTextEnd;	
		}
	
	} else {

		$PFWAP_options = get_option('bulletproof_security_options_pfw_autopilot');
		
		$BPS_PFWAP_Options = array( 
		'bps_pfw_autopilot_cron' 			=> $PFWAP_options['bps_pfw_autopilot_cron'],  
		'bps_pfw_autopilot_cron_frequency' 	=> $PFWAP_options['bps_pfw_autopilot_cron_frequency'],  	
		'bps_pfw_autopilot_cron_end' 		=> $PFWAP_options['bps_pfw_autopilot_cron_end'] 
		);

		foreach( $BPS_PFWAP_Options as $key => $value ) {
			update_option('bulletproof_security_options_pfw_autopilot', $BPS_PFWAP_Options);
			echo $successTextBegin.$key.$successMessage10B.$successTextEnd;	
		}
	}	
	
	echo $successTextBegin.__('Plugin Firewall AutoPilot Mode DB Options created or updated Successfully!', 'bulletproof-security').$successTextEnd;
	
	bpsSetupWizardPluginFirewall_File();

	echo '</p></div>';	

	// the double strong issue does not occur above this point

	echo '<div style="color:black;font-size:1.13em;font-weight:bold;margin-bottom:15px;">'.__('BulletProof Security Pro AutoRestore|Quarantine Final Setup', 'bulletproof-security').'</div>';
	echo '<div id="SWAutoRestore" style="border-top:3px solid #999999;margin-top:-10px;"><p>';		

	echo $successTextBegin.__('AutoRestore|Quarantine DB Options created or updated Successfully!', 'bulletproof-security').$successTextEnd;
	
	bpsSetupWizardExcludeSitemap();	
	bpsSetupWizardExcludeWPEnginesql();
	bps_wp_versionphp_exclude_rule();
	bpsSetupWizard_ARQ_root_backup($source, $dest);
	bpsSetupWizard_ARQ_wpadmin_backup($source, $dest);
	bpsSetupWizard_ARQ_wpincludes_backup($source, $dest);
	bpsSetupWizard_ARQ_wpcontent_backup($source, $dest);	

	if ( bpsSetupWizardFileCounterRootARQ($source, $count) == bpsSetupWizardFileCounterRoot($source, $count) && bpsSetupWizardFileCounterWpadminARQ($source, $count) == bpsSetupWizardFileCounterWpadmin($source, $count) && bpsSetupWizardFileCounterWpincludesARQ($source, $count) == bpsSetupWizardFileCounterWpincludes($source, $count) && bpsSetupWizardFileCounterWpcontentARQ($source, $count) == bpsSetupWizardFileCounterWpcontent($source, $count) ) {
	
	$successMessage11 = __(' DB Option created or updated Successfully!', 'bulletproof-security');
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	$bps_option_name11 = 'bulletproof_security_options_ARCM';
	
	if ( !$ARQoptions['bps_autorestore_cron_frequency'] ) {
		$bps_new_value11_1 = '2';	
	} else {
		$bps_new_value11_1 = $ARQoptions['bps_autorestore_cron_frequency'];
	}	
	
	$bps_new_value11_2 = 'On';
	$bps_new_value11_3 = 'Off';
	
	if ( !$ARQoptions['bps_autorestore_cron_filecheck'] ) {
		$bps_new_value11_3a = 'On';	
	} else {
		$bps_new_value11_3a = $ARQoptions['bps_autorestore_cron_filecheck'];
	}

	if ( !$ARQoptions['bps_autorestore_cron_forced'] ) {
		$bps_new_value11_4 = '1';	
	} else {
		$bps_new_value11_4 = $ARQoptions['bps_autorestore_cron_forced'];
	}	
	
	if ( !$ARQoptions['bps_autorestore_cron_end'] ) {
		$bps_new_value11_5 = '';	
	} else {
		$bps_new_value11_5 = $ARQoptions['bps_autorestore_cron_end'];
	}	
	
	$BPS_Options11 = array(
	'bps_autorestore_cron_frequency' 	=> $bps_new_value11_1, 
	'bps_autorestore_cron' 				=> $bps_new_value11_2, 
	'bps_autorestore_cron_override' 	=> $bps_new_value11_3, 
	'bps_autorestore_cron_filecheck' 	=> $bps_new_value11_3a, 
	'bps_autorestore_cron_forced' 		=> $bps_new_value11_4, 
	'bps_autorestore_cron_end' 			=> $bps_new_value11_5
	);
	
		if ( ! get_option( $bps_option_name11 ) ) {	
		
			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
				echo $successTextBegin.$key.$successMessage11.$successTextEnd;	
			}
	
		} else {

			foreach( $BPS_Options11 as $key => $value ) {
				update_option('bulletproof_security_options_ARCM', $BPS_Options11);
				echo $successTextBegin.$key.$successMessage11.$successTextEnd;	
			}	
		}

		echo $successTextBegin.__('ARQ Root File Backup Verified', 'bulletproof-security').$successTextEnd;
		echo $successTextBegin.__('ARQ wp-admin File Backup Verified', 'bulletproof-security').$successTextEnd;
		echo $successTextBegin.__('ARQ wp-includes File Backup Verified', 'bulletproof-security').$successTextEnd;
		echo $successTextBegin.__('ARQ wp-content File Backup Verified', 'bulletproof-security').$successTextEnd;
		echo $successTextBegin.__('The AutoRestore Cron has been turned On', 'bulletproof-security').$successTextEnd;

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<strong><font color="green">'.__('The Setup Wizard has completed BPS Pro Setup.', 'bulletproof-security').'<br>'.__('Check the "BPS Pro Setup Verification & Error Checks" section below for any errors in Red Font. If you see any errors send an email to info@ait-pro.com and copy and paste the entire "BPS Pro Setup Verification & Error Checks" section below in your email.', 'bulletproof-security').'</font></strong><br>';
		echo $text;
		echo '</p></div>';

	} else {

		echo $failTextBegin.__('Error: ARQ File Backup Failed', 'bulletproof-security').$failTextEnd;	
		echo $failTextBegin.__('The AutoRestore Cron has NOT been turned On', 'bulletproof-security').$failTextEnd;	

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<strong><font color="green">'.__('The Setup Wizard has completed BPS Pro Setup.', 'bulletproof-security').'<br>'.__('Check the "BPS Pro Setup Verification & Error Checks" section below for any errors in Red Font. If you see any errors send an email to info@ait-pro.com and copy and paste the entire "BPS Pro Setup Verification & Error Checks" section below in your email.', 'bulletproof-security').'</font></strong><br>';
		echo $text;
		echo '</p></div>';
	} // end if ( bpsSetupWizardFileCounterRootARQ($source, $count)...
	
	echo '</p></div>';	
	} // end if ( !$PreInstallOptions['bps_wizard_preinstallation'] || $PreInstallOptions['bps_wizard_preinstallation'] != 'yes') {

	$time_end = microtime( true );
	$wizard_run_time = $time_end - $time_start;
	$wizard_time_display = '<strong>'.__('Setup Wizard Completion Time: ', 'bulletproof-security').'</strong>'. round( $wizard_run_time, 2 ) . ' Seconds';	
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $wizard_time_display;
	echo '</p></div>';

	echo '</div>';
	} // end if (isset($_POST['Submit-Setup-Wizard'])
}

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Setup Wizard', 'bulletproof-security'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs-wizard" class="bps-menu">
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
function bpsSpinnerPWizard() {
	
	var r = confirm("Reminder: The Pre-Installation Wizard button MUST ALWAYS be clicked first before you click the Setup Wizard button.\n\n-------------------------------------------------------------\n\nThe Pre-Installation Wizard checks for pre-existing website issues or problems and will automatically fix those pre-existing issues or problems if possible.\n\n-------------------------------------------------------------\n\nIf the Pre-Installation Wizard cannot automatically fix an issue or problem then an error message will be displayed with what needs to be done to fix the issue or problem before clicking/running the Setup Wizard button.\n\n-------------------------------------------------------------\n\nThe Pre-Installation Wizard also scans your website for plugin scripts that need to be whitelisted in the Plugin Firewall. It will take longer for the Pre-Installation Wizard to finish scanning on larger websites that have more Pages and Posts.\n\n-------------------------------------------------------------\n\nClick OK to Run the Pre-Installation Wizard or click Cancel.");
	
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
function bpsSpinnerSWizard() {
	
    var r = confirm("Reminder: The Pre-Installation Wizard button MUST ALWAYS be clicked first before clicking the Setup Wizard button.\n\n-------------------------------------------------------------\n\nPlease allow the Setup Wizard to complete the BPS Pro Setup before leaving the Setup Wizard page.\n\n-------------------------------------------------------------\n\nWhen the Setup Wizard has completed successfully you will see this Success message - The Setup Wizard has completed BPS Pro Setup.\n\n-------------------------------------------------------------\n\nYou can re-run the Pre-Installation Wizard and Setup Wizard again at any time. Your existing settings will NOT be overwritten and will be re-saved. Any new or additional settings that the Pre-Installation and Setup Wizards find on your website will be saved/setup.\n\n-------------------------------------------------------------\n\nClick OK to Run the Setup Wizard or click Cancel.");
	
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
            <li><a href="#bps-tabs-1"><?php _e('Setup Wizard', 'bulletproof-security'); ?></a></li>
            <li><a href="#bps-tabs-2"><?php _e('Setup Wizard Options', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1">

<h2><?php _e('Setup Wizards ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Pre-Installation Wizard & Setup Wizard', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Pre-Installation Wizard & Setup Wizard', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Pre-Installation Wizard & Setup Wizard', 'bulletproof-security'); ?>">
    <p><?php $dialog_text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Setup Wizard Steps: ', 'bulletproof-security').'</strong><br>'.__('1. Click the Pre-Installation Wizard button.', 'bulletproof-security').'<br>'.__('2. Click the Setup Wizard button.', 'bulletproof-security').'<br><br><strong>'.__('Notes: ', 'bulletproof-security').'</strong><br>&bull; '.__('If you see any red font error messages or blue font messages after running the Pre-Installation Wizard: correct these issues before clicking the Setup Wizard button. Red and blue font messages are displayed with an exact description of the issue and how to correct it. Some blue font messages are just notices that do not require anything to be corrected. Example blue font notice: Plugin Firewall cURL Scanning is Turned Off.','bulletproof-security' ).'<br><br>&bull; '.__('If the Pre-installation Wizard hangs or does not complete successfully: click on the Setup Wizard Options tab page, select and save the Turn Off cURL Scan option and run the Pre-Installation Wizard again.', 'bulletproof-security').'<br><br>&bull; '.__('Each time you run/re-run the Wizards the Pre-Installation Wizard button MUST ALWAYS be clicked first before clicking the Setup Wizard button.', 'bulletproof-security').'<br><br>&bull; '.__('You can re-run the Pre-Installation Wizard and Setup Wizard again at any time. Your existing settings will NOT be overwritten and will be re-saved (see the DB Monitor: Use Default or Keep Existing Settings help section in the Setup Wizard Options Read Me help button). Any new or additional settings that the Pre-Installation and Setup Wizards find on your website will be saved/setup.', 'bulletproof-security').'<br><br>&bull; '.__('Please allow the Pre-Installation Wizard to finish running before clicking the Setup Wizard button.','bulletproof-security' ).'<br><br>&bull; '.__('When the Pre-Installation Wizard has finished running you will see "The Pre-Installation Wizard Checks|Scans|Settings have completed."','bulletproof-security' ).'<br><br>&bull; '.__('Please allow the Setup Wizard to complete the BPS Pro Setup before leaving the Setup Wizard page.','bulletproof-security' ).'<br><br>&bull; '.__('Estimated Setup Wizard Completion Time: 10 seconds to 1 minute.','bulletproof-security' ).'<br><br>&bull; '.__('When the Setup Wizard has completed you will see "The Setup Wizard has completed BPS Pro Setup."','bulletproof-security' ).'<br><br>&bull; '.__('View this "Setup Wizard Read Me" Forum link after running the Setup Wizard: ','bulletproof-security').'http://forum.ait-pro.com/forums/topic/pre-installation-wizard-and-setup-wizard-read-me-first/'; echo $dialog_text; ?></p>
</div>

<?php
$text = '<span style="font-size:1.13em;font-weight:bold;margin-bottom:20px;"><div class="setup-wizard-video-link" style="margin:0px 0px -10px 0px;"><a href="http://forum.ait-pro.com/video-tutorials/#setup-wizard" target="_blank" title="This link opens in a new Browser window">'.__('Setup Wizard Video Tutorial', 'bulletproof-security').'</a></div><br><div style="margin:0px 0px 5px 0px;">'.__('1. Click the Pre-Installation Wizard button.', 'bulletproof-security').'<br>'.__('2. Click the Setup Wizard button.', 'bulletproof-security').'</div></span>';
echo $text;


?>

<h3 style="border-bottom:1px solid #999999;"><?php _e('Pre-Installation Wizard', 'bulletproof-security'); ?></h3>

<?php echo '<strong><font color="#2ea2cc">'.__('If the Pre-Installation Wizards hangs or does not complete successfully click the Read Me help button above.', 'bulletproof-security').'</font></strong><br>'; ?>

<form name="bpsSetupWizardPreinstallation" action="admin.php?page=bulletproof-security/admin/wizard/wizard.php" method="post">
<?php wp_nonce_field('bps_setup_wizard_preinstallation'); ?>

	<input type="submit"  name="Submit-Setup-Wizard-Preinstallation" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Pre-Installation Wizard', 'bulletproof-security') ?>" class="button bps-button" onclick="bpsSpinnerPWizard()" />

<?php bpsSetupWizardPrechecks(); ?>
</form>

<h3 style="border-bottom:1px solid #999999;"><?php _e('Setup Wizard', 'bulletproof-security'); ?></h3>

<form name="bpsSetupWizard" action="admin.php?page=bulletproof-security/admin/wizard/wizard.php" method="post">
<?php wp_nonce_field('bps_setup_wizard'); $PreInstallOptions = get_option('bulletproof_security_options_preinstallation'); ?>
<?php if ( !$PreInstallOptions['bps_wizard_preinstallation'] || $PreInstallOptions['bps_wizard_preinstallation'] != 'yes' || $PreInstallOptions['bps_wizard_preinstallation_61'] != 'yes') { ?>

    <input type="submit" name="Submit-Setup-Wizard" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Run Setup Wizard', 'bulletproof-security') ?>" class="button bps-button" onclick="return confirm('<?php 
	$text = __('The Pre-Installation Wizard button MUST ALWAYS be clicked first before you click the Setup Wizard button.', 'bulletproof-security').__('Click the Cancel button.', 'bulletproof-security'); echo $text; ?>')" />

<?php bpsSetupWizardFail(); ?>

<?php } else { ?>

<input type="submit" name="Submit-Setup-Wizard" style="margin:10px 0px 20px 0px;" value="<?php esc_attr_e('Setup Wizard', 'bulletproof-security') ?>" class="button bps-button" onclick="bpsSpinnerSWizard()" />

<?php bpsSetupWizard(); ?>
<?php } ?>
</form>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>

</div>
        
<div id="bps-tabs-2" class="bps-tab-page">

<h2><?php _e('Setup Wizard Options ~ ', 'bulletproof-security'); ?><span style="font-size:.75em;"><?php _e('Turn On|Off cURL Scan, DB Monitor: Use Default or Keep Existing Settings, GoDaddy Managed WordPress Hosting (GDMW)', 'bulletproof-security'); ?></span></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">
    
<h3 style="margin:0px 0px 5px 0px;"><?php _e('Setup Wizard Options', 'bulletproof-security'); ?>  <button id="bps-open-modal2" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content2" title="<?php _e('Setup Wizard Options', 'bulletproof-security'); ?>">
    <p><?php $dialog_text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('Setup Wizard Option Settings', 'bulletproof-security').'</strong><br><br><strong>'.__('cURL Scan Option: Turn On|Off cURL Scan', 'bulletproof-security').'</strong><br>'.__('The cURL Scan Option is set to On by default. If the Pre-Installation Wizard is crashing/hanging/not completing then select and save the "Turn Off cURL Scan" option and run the Pre-Installation Wizard again. If you have a VPS or Dedicated Server you may need to reboot your server if the Pre-Installation Wizard cURL Scanner causes your website/server to crash. Plugin Firewall AutoPilot Mode will automatically create any Plugin Firewall whitelist rules in real-time that are needed for your website so cURL scanning is not necessary during Setup Wizard setup.', 'bulletproof-security').'<br><br><strong>'.__('DB Monitor: Use Default or Keep Existing Settings', 'bulletproof-security').'</strong><br>'.__('If you are re-running the Pre-Installation Wizard and Setup Wizard and you have setup the DB Monitor to monitor additional DB Tables then choose the "Keep Existing DB Monitor Settings" option.', 'bulletproof-security').'<br><br><strong>'.__('Go Daddy Managed WordPress Hosting (GDMW):', 'bulletproof-security').'</strong><br>'.__('This option is ONLY for a special type of Go Daddy Hosting account called "Managed WordPress Hosting" and is NOT for regular/standard Go Daddy Hosting account types. Leave the default setting set to No, unless you have a Go Daddy Managed WordPress Hosting account. View this Forum link for more information: ', 'bulletproof-security').'http://forum.ait-pro.com/forums/topic/gdmw/'; echo $dialog_text; ?></p>
</div>

 <form name="SetupWizardcURLOptions" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_wizard_curl'); ?> 
	<?php $CURLoptions = get_option('bulletproof_security_options_wizard_curl'); ?>
    
	<label for="wizard-curl"><?php _e('cURL Scan Option: Turn On|Off cURL Scan', 'bulletproof-security'); ?></label><br />
<select name="bulletproof_security_options_wizard_curl[bps_wizard_curl_scan]" style="width:300px;margin-bottom:10px;">
<option value="On" <?php selected('On', $CURLoptions['bps_wizard_curl_scan']); ?>><?php _e('Turn On cURL Scan', 'bulletproof-security'); ?></option>
<option value="Off" <?php selected('Off', $CURLoptions['bps_wizard_curl_scan']); ?>><?php _e('Turn Off cURL Scan', 'bulletproof-security'); ?></option>
</select><br />
	<label for="wizard-curl"><?php _e('DB Monitor: Use Default or Keep Existing Settings', 'bulletproof-security'); ?></label><br />
<select name="bulletproof_security_options_wizard_curl[bps_wizard_dbm_settings]" style="width:300px;">
<option value="On" <?php selected('On', $CURLoptions['bps_wizard_dbm_settings']); ?>><?php _e('Use Default DB Monitor Settings', 'bulletproof-security'); ?></option>
<option value="Off" <?php selected('Off', $CURLoptions['bps_wizard_dbm_settings']); ?>><?php _e('Keep Existing DB Monitor Settings', 'bulletproof-security'); ?></option>
</select><br />
<input type="submit" name="Submit-Wizard-cURL-Options" class="button bps-button" style="margin:10px 0px 10px 0px;" value="<?php esc_attr_e('Save cURL|DB Monitor Options', 'bulletproof-security') ?>" />
</form>

<form name="SetupWizardGDMW" action="options.php#bps-tabs-2" method="post">
	<?php settings_fields('bulletproof_security_options_GDMW'); ?> 
	<?php $GDMWoptions = get_option('bulletproof_security_options_GDMW'); ?>
    
	<label for="wizard-curl"><?php _e('Go Daddy Managed WordPress Hosting (GDMW):', 'bulletproof-security'); ?></label><br />
<select name="bulletproof_security_options_GDMW[bps_gdmw_hosting]" style="width:300px;">
<option value="no" <?php selected('no', $GDMWoptions['bps_gdmw_hosting']); ?>><?php _e('No (default setting)', 'bulletproof-security'); ?></option>
<option value="yes" <?php selected('yes', $GDMWoptions['bps_gdmw_hosting']); ?>><?php _e('Yes (ONLY if you have Managed WordPress Hosting)', 'bulletproof-security'); ?></option>
</select><br />
<input type="submit" name="Submit-Wizard-GDMW" class="button bps-button" style="margin:10px 0px 20px 0px;" value="<?php esc_attr_e('Save GDMW Option', 'bulletproof-security') ?>" />
</form>    

	</td>
  </tr>
  <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
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