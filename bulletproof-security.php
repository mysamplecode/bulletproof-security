<?php
/*
Plugin Name: BulletProof Security Pro
Plugin URI: http://forum.ait-pro.com/forums/forum/bulletproof-security-pro/
Description: <strong>Feature Highlights:</strong> Setup Wizard. ARQ Infinity IDPS: Automatic File AutoRestore and Quarantine. .htaccess and php.ini Website Security. DB Monitor IDS: Database Monitor. DB Backup: Database Backup. DB Diff Tool: Database Difference Comparison Tool. DB Status & Info: Extensive Database Information. Plugin Firewall: Firewall For The plugins Folder. JTC Anti-Spam|Anti-Hacker: Hacker, Spammer, DoS/DDoS & Brute Force Login Protection. Uploads Anti-Exploit Guard (UAEG): WordPress uploads Folder Protection. Login Security|Login Monitoring: Log All Account Logins or Log Only Account Lockouts. F-Lock: File Locking. S-Monitor: Centralized Monitoring Options - Dashboard Status Display & Email Alerting Core. UI Theme Skin: 3 UI Theme Skins. System Info: Extensive System, Server and Security Status Information. Pro-Tools: Base64 Decoder|Encoder, Scheduled Crons, String Finder, String Replacer, DB String Finder, DB Table Cleaner|Remover, DNS Finder, Ping Website, cURL Scan, Website Headers, WP Automatic Update, Plugin Update Check, XML-RPC Exploit Checker...
Text Domain: bulletproof-security
Domain Path: /languages/
Version: 10.2
Author: AITpro | Edward Alexander
Author URI: http://forum.ait-pro.com/forums/forum/bulletproof-security-pro/
*/

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

// Direct calls to this file are Forbidden when core files are not present
if ( !function_exists('add_action') ) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

// BPS Pro variables
define( 'BULLETPROOF_VERSION', '10.2' );
$bpspro_plugin = 'BulletProof Security Pro';
$bpspro_abbr = 'BPS Pro';
$bpspro_last_version = '10.1';
$bpspro_version = '10.2';
// checking 0 in 10
$bpspro_readme_install_ver = '0';
$bpspro_edition = 'Professional Edition';
$bpspro_url = 'http://api.ait-pro.com/';
$bpsPro_api_url = 'http://api.ait-pro.com/';
$plugin_slug = basename(dirname(__FILE__));
$bulletproof_security_arq_db_version = "5.1.8";
$aitpro_bullet = '<img src="'.plugins_url('/bulletproof-security/admin/images/aitpro-bullet.png').'" style="padding:0px 3px 0px 3px;" />';

// pending future dev, but needs to load
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php' );

add_action( 'init', 'bulletproof_security_load_plugin_textdomain' );

// Load i18n Language Translation
function bulletproof_security_load_plugin_textdomain() {
	load_plugin_textdomain('bulletproof-security', FALSE, dirname(plugin_basename(__FILE__)).'/languages/');
}

// BPS functions
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/functions.php' );
	remove_action('wp_head', 'wp_generator');
	
// S-Monitor Dashboard Alerts
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/dashboard-email-alerts.php' );

// BPS HUD Dimiss functions
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/hud-dismiss-functions.php' );

// BPS inpage functions - top of BPS Pro pages - BPS Only display
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/inpage-functions.php' );

// BPS - Zip & Email Log File Cron functions
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/zip-email-cron-functions.php' );

// BPS general functions
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/general-functions.php' );

// BPS Login Security
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/login-security.php' );

// BPS DB Backup & DB Monitor
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/db-security.php' );

// BPS Plugin Firewall AutoPilot
require_once( WP_PLUGIN_DIR . '/bulletproof-security/includes/firewall-autopilot.php' );

// If in WP Dashboard / Admin Panels
if ( is_admin() ) {
    require_once( WP_PLUGIN_DIR . '/bulletproof-security/admin/includes/admin.php' );
	register_activation_hook(__FILE__, 'bulletproof_security_install');
	register_deactivation_hook(__FILE__, 'bulletproof_security_deactivation');
    register_uninstall_hook(__FILE__, 'bulletproof_security_uninstall');

	add_action( 'admin_init', 'bulletproof_security_admin_init' );
    add_action( 'admin_menu', 'bulletproof_security_admin_menu' );

	add_filter( 'http_request_args', 'bpsPro_prevent_wp_update_check', 10, 2 );

function bpsPro_prevent_wp_update_check( $r, $url ) {
global $pagenow;
	
	if ( $pagenow == 'update-core.php' && 0 === strpos( $url, 'https://api.wordpress.org/plugins/update-check/1.1/' ) || 0 === strpos( $url, 'https://api.wordpress.org/plugins/update-check/1.0/' ) ) {
		$bps_plugin = plugin_basename( __FILE__ );
		$plugins = json_decode( $r['body']['plugins'], true );

		unset( $plugins['plugins'][$bps_plugin] );
		$r['body']['plugins'] = json_encode( $plugins );
	}
	return $r;
}
}

// Plugin update check
add_filter('pre_set_site_transient_update_plugins', 'bps_upgrade_check_for_plugin_update');

// Automatically Deactivate the Envato WordPress Toolkit plugin when a BPS Pro upgrade is available
// Displays a Warning message about the Envato coding mistake that breaks BPS Pro upgrades
function bpsPro_envato_warning_deactivate() {
$plugin_var = 'envato-wordpress-toolkit-master/index.php';
$return_var = in_array( $plugin_var, apply_filters('active_plugins', get_option('active_plugins')));

	if ( $return_var != 1 ) { // 1 equals active
		return;	
	}
	
	if ( $return_var == 1 ) { // 1 equals active	
	
		deactivate_plugins( $plugin_var );
		
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('WARNING!!! The Envato WordPress Toolkit plugin is installed', 'bulletproof-security').'</font><br>'.__('The Envato WordPress Toolkit plugin has been automatically deactivated to prevent it from causing the BPS Pro upgrade to fail catastrophically.', 'bulletproof-security').'<br>'.__('There is a coding mistake in the Envato WordPress Toolkit plugin that causes BPS Pro upgrades to fail catastrophically.', 'bulletproof-security').'<br>'.__('After upgrading BPS Pro you can activate the Envato WordPress Toolkit plugin again.', 'bulletproof-security').'</div>';
		echo $text;		
	}	
}

function bps_upgrade_check_for_plugin_update($checked_data) {
	global $bpsPro_api_url, $plugin_slug, $pagenow;

	if ( $pagenow == 'update-core.php' )
		return $checked_data;
	
	if ( empty( $checked_data->checked ) )
		return $checked_data;
	
	$request_args = array(
		'slug' 		=> $plugin_slug,
		'version' 	=> $checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php'],
	);
	
	$request_string = bps_upgrade_prepare_request( 'basic_check', $request_args );
	
	// Start checking for an update
	$raw_response = wp_remote_post($bpsPro_api_url, $request_string);
	

	
	if ( !is_wp_error($raw_response) && ($raw_response['response']['code'] == 200) )
		$response = @unserialize($raw_response['body']);

	if ( is_object($response) && !empty($response) ) // Feed the update data into WP updater
		$checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;
	
		bpsPro_envato_warning_deactivate();	

	return $checked_data;
}

// Plugin API call & info screen
add_filter('plugins_api', 'bps_upgrade_plugin_api_call', 10, 3);

function bps_upgrade_plugin_api_call($def, $action, $args) {
	global $plugin_slug, $bpsPro_api_url, $pagenow;
	
	if ( $args->slug != $plugin_slug )
		return false;
	
	// Start to get the current version
	if ( $pagenow == 'update-core.php' )
		return false;
	
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = bps_upgrade_prepare_request($action, $args);
	
	$request = wp_remote_post($bpsPro_api_url, $request_string);
	
	if ( is_wp_error($request) ) {
		$res = new WP_Error('plugins_api_failed', __('An HTTP Error occurred during the API request', 'bulletproof-security').'</p> <p><a href="?" onclick="document.location.reload(); return false;">'.__('Try again', 'bulletproof-security').'</a>', $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		bpsPro_envato_warning_deactivate();	

		if ( $res === false )
			$res = new WP_Error('plugins_api_failed', __('API Server Call failed', 'bulletproof-security'), $request['body']);
	}
	
	return $res;
}

function bps_upgrade_prepare_request($action, $args) {
	global $wp_version, $pagenow;
	
	if ( $pagenow != 'update-core.php' )

	return array(
		'body' => array(
			'action' 		=> $action, 
			'request' 		=> serialize($args),
			'bps-url' 		=> get_bloginfo('url'),
			'bps-api-key' 	=> 'jKBeLZuVRwOQxTcy'
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
	);	
}

function bps_plugin_actlinks( $links, $file ){
	// "Settings" link on Plugins Options Page 
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ){
	$settings_link = '<a href="admin.php?page=bulletproof-security/admin/core/options.php">' . __('Settings', 'bulletproof-security') . '</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
}

add_filter( 'plugin_action_links', 'bps_plugin_actlinks', 10, 2 );

//add links on plugins page
function bps_plugin_extra_links($links, $file) {
	static $this_plugin;
	if ( ! current_user_can('install_plugins') )
		return $links;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ) {
		$links[2] = '<a href="http://forum.ait-pro.com/forums/topic/bulletproof-security-pro-version-release-dates/" target="_blank" title="BulletProof Security Pro Version Release Dates and Whats New">' . __('Version Release Dates|Whats New', 'bulleproof-security').'</a>';
		$links[] = '<a href="http://forum.ait-pro.com/" target="_blank" title="BulletProof Security Pro Forum">' . __('Forum|Support', 'bulleproof-security').'</a>';
		$links[] = '<a href="admin.php?page=bulletproof-security/admin/tools/tools.php#bps-tabs-15" title="Pro Tools Plugin Update Check tool">' . __('Manual Upgrade Check', 'bulleproof-security') . '</a>';

/*	echo '<pre>';
	print_r($links);
	echo '</pre>';
*/	
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'bps_plugin_extra_links', 10, 2);

?>