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

// If the WordPress Zip installer was used to install BPS - leaves copies of BPS in the /wp-content/uploads/ folder
// This function deletes any bulletproof-security.zip files in the uploads folder - delete performed when Get Key Request is made
// may generate a one time php error on some web hosts
function bpsRemoveZipFiles() {
$wp_upload_dir = wp_upload_dir();
	foreach ( glob( $wp_upload_dir['basedir'].'/bulletproof-security*.zip' ) as $filename ) {
		if ( file_exists($filename) ) {
    		//@unlink($filename);
		}
	}
}

// Activation - API URL, API Key and BPS Plugin Slug
if ( defined('BPS_API_KEY') ) {
	$bps_api_key = constant('BPS_API_KEY');
	} else {
	$bps_api_key = '';
}	
$bps_api_url = 'http://api.ait-pro.com/';
$plugin_slug = 'bulletproof-security';

function bps_api_init() {
	global $bps_api_key, $bps_api_host, $bps_api_port;
	$options = get_option('bulletproof_security_options_activation');  
	$options['bps_api_key'] == $options['delete_paypal_email'];
	if ( $bps_api_key )
		$bps_api_host = $bps_api_key . '.api.ait-pro.com';
	else
		$bps_api_host = $options['bps_api_key'] . '.api.ait-pro.com';

	$bps_api_port = 80;
}

function bps_get_key() {
	global $bps_api_key;
	$options = get_option('bulletproof_security_options_activation');
	$options['bps_api_key'] == $options['delete_paypal_email'];
	if ( !empty($bps_api_key) )
		return $bps_api_key;
	return $options['bps_api_key'];
}

function bps_verify_key( $key, $ip = null ) {
	global $bps_api_host, $bps_api_port, $bps_api_key;
	$blog = urlencode( get_option('home') );
	if ( $bps_api_key )
		$key = $bps_api_key;
	$response = bps_http_post("key=$key&blog=$blog", 'api.ait-pro.com', '/1.1/verify-key', $bps_api_port, $ip);
	if ( !is_array($response) || !isset($response[1]) || $response[1] != 'valid' && $response[1] != 'invalid' )
		return 'failed';
	return $response[1];
}

// Debug / Test Mode - server-side - bps_auto_check_data()
function bps_test_mode() {
	if ( defined('BPS_TEST_MODE') && BPS_TEST_MODE )
		return true;
	return false;
}

// Returns array with headers and body response
function bps_http_post($request, $host, $path, $port = 80, $ip=null) {
	global $wp_version;

	$bps_ua = "WordPress/{$wp_version} | "; // sends WordPress/3.x.x
	$bps_ua .= 'BPS/' . constant( 'BULLETPROOF_VERSION' ); // sends BPS/5.0

	$content_length = strlen( $request );

	$http_host = $host;
	// use a specific IP if provided
	// needed by bps_check_server_connectivity()
	if ( $ip && long2ip( ip2long( $ip ) ) ) {
		$http_host = $ip;
	} else {
		$http_host = $host;
	}
	
	// use the WP HTTP class if it is available
	if ( function_exists( 'wp_remote_post' ) ) {
		$http_args = array(
			'body'					=> $request,
			'headers'				=> array(
				'Content-Type'		=> 'application/x-www-form-urlencoded; ' . 'charset=' . get_option( 'blog_charset' ),
				'Host'				=> $host,
				'User-Agent'		=> $bps_ua
			),
			'httpversion'	=> '1.0',
			'timeout'		=> 15
		);
		$bps_url = "http://{$http_host}{$path}";
		$response = wp_remote_post( $bps_url, $http_args );
		if ( is_wp_error( $response ) )
			return '';

		return array( $response['headers'], $response['body'] );
	} else {
		$http_request  = "POST $path HTTP/1.0\r\n";
		$http_request .= "Host: $host\r\n";
		$http_request .= 'Content-Type: application/x-www-form-urlencoded; charset=' . get_option('blog_charset') . "\r\n";
		$http_request .= "Content-Length: {$content_length}\r\n";
		$http_request .= "User-Agent: {$bps_ua}\r\n";
		$http_request .= "\r\n";
		$http_request .= $request;
		
		$response = '';
		if( false != ( $fs = @fsockopen( $http_host, $port, $errno, $errstr, 10 ) ) ) {
			fwrite( $fs, $http_request );

			while ( !feof( $fs ) )
				$response .= fgets( $fs, 1160 ); // One TCP-IP packet
			fclose( $fs );
			$response = explode( "\r\n\r\n", $response, 2 );
		}
		return $response;
	}
}

// General all purpose "Settings Saved." message for forms - /includes/class.php
if ( current_user_can('manage_options') && wp_script_is( 'bps-accordion', $list = 'queue' ) ) {
if ( @$_GET['settings-updated'] == true ) {
	$text = '<p style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:5px;margin:0px;"><font color="green"><strong>'.__('Settings Saved', 'bulletproof-security').'</strong></font></p>';
	echo $text;
	} else {
	// Do not use this generic error messages function 
	// The Activation page uses custom API Server connectivity error messaging/checks instead
	// echo '<font color="red"><strong>'.bps_cuser_errorrs().'</strong></font>';
	}
}

// Http_post check connectivity - IP & Port
function bps_check_server_connectivity() {
	global $bps_api_host, $bps_api_port, $bps_api_key;
	
	$test_host = 'api.ait-pro.com';
	
	if ( !function_exists('fsockopen') || !function_exists('gethostbynamel') )
		return array();
	
	$ips = gethostbynamel($test_host);
	if ( !$ips || !is_array($ips) || !count($ips) )
		return array();
		
	$servers = array();
	foreach ( $ips as $ip ) {
		$response = bps_verify_key( bps_get_key(), $ip );
		// even if the key is invalid, at least we know we have connectivity
		if ( $response == 'valid' || $response == 'invalid' )
			$servers[$ip] = true;
		else
			$servers[$ip] = false;
	}

	return $servers;
}

//function bps_microtime() {
//	$mtime = explode( ' ', microtime() );
//	return $mtime[1] + $mtime[0];
//}

//function bps_cmp_time( $a, $b ) {
//	return $a['time'] > $b['time'] ? -1 : 1;
//}

function bps_auto_check_data( $bpsData ) {
	global $bps_api_host, $bps_api_port;

	$bpsInput = $bpsData;
	$bpsInput['user_ip']    = $_SERVER['REMOTE_ADDR'];
	$bpsInput['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	$bpsInput['referrer']   = $_SERVER['HTTP_REFERER'];
	$bpsInput['blog']       = get_option('home');
	$bpsInput['blog_lang']  = get_locale();

	if ( bps_test_mode() )
		$bpsInput['is_test'] = 'true';
		
	foreach ($_POST as $key => $value ) {
		if ( is_string($value) )
			$bpsInput["POST_{$key}"] = $value;
	}

	$ignore = array( 'HTTP_COOKIE', 'HTTP_COOKIE2', 'PHP_AUTH_PW' );

	foreach ( $_SERVER as $key => $value ) {
		if ( !	in_array( $key, $ignore ) && is_string($value) )
			$bpsInput["$key"] = $value;
		else
			$bpsInput["$key"] = '';
	}

	$query_string = '';
	foreach ( $bpsInput as $key => $data )
		$query_string .= $key . '=' . urlencode( stripslashes($data) ) . '&';
		
	$bpsData['data_submitted'] = $bpsInput;

	$response = bps_http_post($query_string, $bps_api_host, '/1.1/bps-check', $bps_api_port);
	$bpsData['bps_result'] = $response[1];
	if ( 'true' == $response[1] ) {
		return 'true';
	}
	
	if ( 'true' != $response[1] && 'false' != $response[1] ) {
		return 'null';
	}
	return $bpsData;
}

function bps_conf() {
	global $bps_api_key;
	$options = get_option('bulletproof_security_options_activation');
	$options['bps_api_key'] == $options['delete_paypal_email'];  
	if ( isset($_POST['Submit-SaveKey']) ) {
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			die(__('Cheatin&#8217; uh?'));

		$home_url = parse_url( get_bloginfo('url') );

		if ( empty($key) ) {
			$key_status = 'empty';
			$ms[] = 'new_key_empty';
			delete_option('bps_api_key');
		} elseif ( empty($home_url['host']) ) {
			$key_status = 'empty';
			$ms[] = 'bad_home_url';
		} else {
			$key_status = bps_verify_key( $key );
		} 

		if ( $key_status == 'valid' ) {
			update_option('bps_api_key', $key);
			$ms[] = 'new_key_valid';
		} else if ( $key_status == 'invalid' ) {
			$ms[] = 'new_key_invalid';
		} else if ( $key_status == 'failed' ) {
			$ms[] = 'new_key_failed';
		} 

	} elseif ( isset($_POST['check']) ) {
		bps_get_server_connectivity(0);
	}

	if ( empty( $key_status) ||  $key_status != 'valid' ) {
		$key = $options['bps_api_key'];
		
		if ( empty( $key ) ) {
			if ( empty( $key_status ) || $key_status != 'failed' ) {
				if ( bps_verify_key( '888tttxxxx444' ) == 'failed' )
					$ms[] = 'no_connection';
				else
					$ms[] = 'key_empty';
			} 
			$key_status = 'empty';
		} else {
			$key_status = bps_verify_key( $key );
		} 
		if ( $key_status == 'valid' ) {
			$ms[] = 'key_valid';
		} else if ( $key_status == 'invalid' ) {
			delete_option('bps_api_key');
			$ms[] = 'key_empty';
		} else if ( !empty($key) && $key_status == 'failed' ) {
			$ms[] = 'key_failed';
		}
	} 

	$messages = array(
		'key_failed' 	=> array('text' => __('key_failed')),
		'no_connection' => array('text' => __('no_connection')),
	);
}

// BPS Pro version check
function bps_check_for_plugin_update($checked_data) {
	global $bps_api_url, $plugin_slug;
	$options = get_option('bulletproof_security_options_activation'); 
	$options['bps_api_key'] == $options['delete_paypal_email'];
	$options['bps_pro_key'] == $options['bps_api_key'];
	
	if (empty($checked_data->checked))
		return $checked_data;
	
	$request_args = array(
		'slug' 		=> $plugin_slug,
		'version' 	=> $checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php'],
		'bpskey' 	=> $options['bps_pro_key'],  
	);
	
	$request_string = bps_prepare_request('basic_check', $request_args);
	
	// Start checking for an update
	$raw_response = wp_remote_post($bps_api_url, $request_string);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
	
	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;
	
	return $checked_data;
}

// API Call
function bps_plugin_api_call($action, $args) {
	global $plugin_slug, $bps_api_url;
	$options = get_option('bulletproof_security_options_activation');
	$options['bps_api_key'] == $options['delete_paypal_email'];
	$options['bps_pro_key'] == $options['bps_api_key'];
	
	if ( $args->slug != $plugin_slug )
		return false;
		
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
	$args->version = $current_version;
	$args->bpskey = $options['bps_pro_key'];
		
	$request_string = bps_prepare_request($action, $args);
	
	$request = wp_remote_post($bps_api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('Error Code 1: An Unexpected HTTP Error occurred during the API request.', 'bulletproof-security').'<p><a href="?" onclick="document.location.reload(); return false;">'.__('Try again', 'bulletproof-security').'</a></p>', $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('Error Code 2: Plugins API request failed.', 'bulletproof-security'), $request['body']);
	}
	
	return $res;
}

// Get BPS Pro Activation Key form - Send BPS Key Request
if ( isset( $_POST['Submit-GetKey'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_pro_get_key' );

global $bps_api_url, $plugin_slug;
$options = get_option('bulletproof_security_options_activation');
echo bpsRemoveZipFiles();

	$bps_API_host_Server = gethostbynamel('api.ait-pro.com');
		foreach ( $bps_API_host_Server as $key => $value ) {
			$value = '['.$value.']';
		}

	$domainbase = 'api.ait-pro.com';
	$status = bps_pingDomainActivation($domainbase);
	$api_hostname = gethostbyaddr('173.201.92.1');
	$wordfence = WP_PLUGIN_DIR . '/wordfence/wordfence.php';

	if ( $status == -1 ) { // Site is down == -1 | Site is up != -1
		echo $bps_topDiv;
		$textstatus = '<strong><font color="red">'.__('The AITpro API Server: ', 'bulletproof-security').'http://'.$domainbase.' at IP Address: '.$value.__(' is NOT reachable using fsockopen Port 80.', 'bulletproof-security').'</font><br>'.__('The AITpro API Server IP Address is being blocked by a plugin or your web host is blocking the IP Address.', 'bulletproof-security').'</strong>';
		echo $textstatus;	
		echo $bps_bottomDiv;
	}	
	
	if ( $value == '' ) {
		echo $bps_topDiv;
		$textvalue = '<strong><font color="red">'.__('Unable to get the IPv4 IP Address for the AITpro API Server using gethostbynamel', 'bulletproof-security').'</font></strong>';
		echo $textvalue;	
		echo $bps_bottomDiv;
	}
	
	if ( $api_hostname != 'p3nlhg43c081.shr.prod.phx3.secureserver.net') {
		echo $bps_topDiv;
		$texthostname = '<strong><font color="red">'.__('Unable to get the host name for the AITpro API Server using gethostbyaddr', 'bulletproof-security').'</font></strong>';
		echo $textthostname;	
		echo $bps_bottomDiv;
	}
	
	// Check for the WP_HTTP_BLOCK_EXTERNAL Constant in the wp-config.php file
	$wpconfigfile = ABSPATH . 'wp-config.php';
	$subject = file_get_contents($wpconfigfile);
	$pattern1 = '/define(.*)\((.*)WP_HTTP_BLOCK_EXTERNAL(.*)true(.*)\);/';
	$pattern2 = '/define(.*)\((.*)WP_ACCESSIBLE_HOSTS(.*)ait-pro.com(.*)\);/';

	if ( defined('WP_HTTP_BLOCK_EXTERNAL') && !file_exists($wpconfigfile) && WP_HTTP_BLOCK_EXTERNAL === true ) {
		echo $bps_topDiv;
		$textwpconfig = '<strong><font color="red">'.__('You are using the define( \'WP_HTTP_BLOCK_EXTERNAL\', true ); WordPress Constant in your wp-config.php file. To allow your website to get an Activation Key from the AIT-pro.com API Server, edit your wp-config.php file and add the ait-pro.com domain name to this Constant in your wp-config.php file: define( \'WP_ACCESSIBLE_HOSTS\', \'api.wordpress.org,*.ait-pro.com,*.github.com\' );', 'bulletproof-security').'</font></strong>';
		echo $textwpconfig;
		echo $bps_bottomDiv;
	}

	if ( file_exists($wpconfigfile) && preg_match( $pattern1, $subject, $matches ) && !preg_match( $pattern2, $subject, $matches ) ) {
		echo $bps_topDiv;	
		$textwpconfig = '<strong><font color="red">'.__('The define( \'WP_HTTP_BLOCK_EXTERNAL\', true ); WordPress Constant was found in your wp-config.php file, but the AIT-pro.com API Server has not been added to the this Constant: define( \'WP_ACCESSIBLE_HOSTS\', \'api.wordpress.org,*.github.com\' ); in your wp-config.php file. To allow your website to get an Activation Key from the AIT-pro.com API Server add the ait-pro.com domain name to this Constant: define( \'WP_ACCESSIBLE_HOSTS\', \'api.wordpress.org,*.ait-pro.com,*.github.com\' );', 'bulletproof-security').'</font></strong>';
		echo $textwpconfig;
		echo $bps_bottomDiv;
	}

	// Wordfence check - Wordfence can block Activation Key Requests
	if ( file_exists($wordfence) ) {
		echo $bps_topDiv;
		$textwordfence = '<strong>'.__('Wordfence is installed on this website.', 'bulletproof-security').'<br>'.__('If you do not receive your Activation Key email then check Wordfence settings to see if the AITpro API Server: ', 'bulletproof-security').'http://'.$domainbase.' at IP Address: '.$value.__(' is being blocked by Wordfence.', 'bulletproof-security').'</strong>';
		echo $textwordfence;			
		echo $bps_bottomDiv;
	}
	
	$request_args = array(
		'slug' 		=> $plugin_slug,
		'version' 	=> BULLETPROOF_VERSION,
		'bpskey' 	=> $options['bps_pro_activation'], 
	);
	
	$request_string = bps_prepare_request( 'bps_get_key', $request_args );
	$raw_response = wp_remote_post( $bps_api_url, $request_string );

/* 
		echo '<pre>';
		print_r($raw_response);
		echo '</pre>';
*/

	if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) && $options['bps_pro_activation'] != '' && strlen( $options['bps_pro_activation'] ) == 17 ) {

		echo $bps_topDiv;
		$text2 = '<font color="green"><strong>'.__('BPS Pro Activation Key Request sent. Your Activation Key will be emailed to your PayPal email address.','bulletproof-security').'</strong></font><br><strong>'.__('You should receive your Activation Key within 3 minutes. If you do not receive your Activation Key after 5 minutes, please request your Activation Key again. If you do not receive your Activation Key after 15 minutes please send an email to info@ait-pro.com. Thank you.','bulletproof-security').'</strong>';
		echo $text2;
		echo $bps_bottomDiv;
	
	} else {
		
		echo $bps_topDiv;
		$text2 = '<font color="red"><strong>'.__('Error: BPS Pro Activation Key Request was unsuccessful.','bulletproof-security').'</strong></font><br><strong>'.__('Did you enter a valid Download Key and click the Save button before clicking the Get Key button?','bulletproof-security').'<br>'.__('If this was not the cause of the error then please send an email with any Activation error messages and the Error Response Code that you see to info@ait-pro.com to get your BPS Pro Activation Key. Thank you.','bulletproof-security').'</strong>';
		echo $text2;
		echo $bps_bottomDiv;
	}
}

// Get BPS Pro Activation Key form - Prepare the action and args
// The API Server can detect if this code has been changed and WILL Automatically Ban your website.
// httpversion and timeout a new DELETE them if there is a problem
function bps_prepare_request($action, $args) {
global $wp_version;
	
	return array(
		'body' 			=> array(
		'action' 		=> $action, 
		'request' 		=> serialize($args)
		),
		'user-agent' 	=> get_bloginfo('url'),
		'httpversion'	=> '1.1', 
		'timeout'		=> 10 
		);	
}	

// send fsockopen request
function bps_pingDomainActivation($domain){

    $starttime = microtime(true);
    $file      = @fsockopen( $domain, 80, $errno, $errstr, 10 );
    $stoptime  = microtime(true);
    $status    = 0;

    if ( ! $file ) { 
		$status = -1;  // Site is down
	} else {
        fclose($file);
        $status = ( $stoptime - $starttime ) * 1000;
        $status = floor($status);
    }
    return $status;
}

$bpsSpacePop = '-------------------------------------------------------------';

// Local Anti-Piracy check - Fallback 10R
@bpsPro_AP_Check($D8);

?>
</div>

<h2 style="margin-left:220px;"><?php _e('BulletProof Security Pro ~ Activation'); ?></h2>

<!-- jQuery UI Tab Menu -->
<div id="bps-container">
	<div id="bps-tabs" class="bps-menu">
    <div id="bpsHead" style="position:relative; top:0px; left:0px;"><img src="<?php echo plugins_url('/bulletproof-security/admin/images/bps-pro-logo.png'); ?>" style="float:left; padding:0px 8px 0px 0px; margin:-70px 0px 0px 0px;" /></div>
		<ul>
			<li><a href="#bps-tabs-1"><?php _e('BPS Pro Activation', 'bulletproof-security'); ?></a></li>
			<li><a href="#bps-tabs-2"><?php _e('Help &amp; FAQ', 'bulletproof-security'); ?></a></li>
		</ul>
            
<div id="bps-tabs-1" class="bps-tab-page">
<h2><?php _e('BulletProof Security Pro Activation', 'bulletproof-security'); ?></h2>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help">

<h3 style="margin:0px 0px 10px 0px;"><?php _e('Troubleshooting Activation Problems &amp; Errors', 'bulletproof-security'); ?>  <button id="bps-open-modal1" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content1" title="<?php _e('Troubleshoot Activation Problems &amp; Errors', 'bulletproof-security'); ?>">
	<p><?php $text = '<strong>'.__('This Read Me Help window is draggable (top) and resizable (bottom right corner)', 'bulletproof-security').'</strong><br><br><strong>'.__('The BPS Pro plugin pages will display blank/white if BPS Pro is not successfully Activated on a website except for this Activation page. The BPS Pro plugin pages will also display blank/white if any one of the following issues below occur:', 'bulletproof-security').'</strong><br><br><strong>'.__('Entering/Saving the BPS Pro Download-Request Key in the BPS Pro Activation Key text box', 'bulletproof-security').'</strong><br>'.__('Your Download-Request Key should ONLY be entered in text box/step 1. Enter your BPS Pro Download-Request Key in text box 1. and click the Save Download-Request Key button. After saving your Download-Request Key click the Get Activation Key button in step 2. After receiving your unique Activation Key for this specific website, copy and paste it into text box 3 and click the Save Activation Key button.', 'bulletproof-security').'<br><br><strong>'.__('Entering a unique BPS Pro Activation Key for another website on this website', 'bulletproof-security').'</strong><br>'.__('Activation Keys are unique to each website. For each website that you have you will need to request a unique Activation Key for that website by entering your Download-Request Key, clicking the Save Download-Request Key button and then clicking the Get Activation Key button.', 'bulletproof-security').'<br><br><strong>'.__('Entering an invalid or incorrect Activation Key', 'bulletproof-security').'</strong><br>'.__('Some Activation Keys contain dots (.) in the encrypted Activation Key. If your Activation Key contains any dots then copy the entire Activation Key including any dots into the Activation Key text box 3. and resave your Activation Key by clicking the Save Activation Key button.', 'bulletproof-security').'<br><br><strong>'.__('IMPORTANT NOTES: ', 'bulletproof-security').'</strong><br>'.__('Each website only needs to have BPS Pro Activated once on that website. The unique Activation Key for each will always be the same Activation Key as long as your Domain name/URL, www or non-www prefix, HTTP or HTTPS/SSL does not change.', 'bulletproof-security').'<br><br>'.__('If you change anything about your Domain name/URL for your website then request a new unique BPS Pro Activation Key by following the 3 step Activation Key request process again to get a new unique Activation Key for your website.', 'bulletproof-security').'<br><br>'.__('BPS Pro Activation Keys are automatically created by the AITpro API Server when you click the Get Activation Key button and emailed to your PayPal email address.', 'bulletproof-security').'<br><br><strong>'.__('Help & FAQ Links can be found on the Help & FAQ tab page', 'bulletproof-security').'</strong>'; echo $text; ?></p>
</div>

<?php 
$text = '<font color="#2ea2cc" style="font-size:1.13em;font-weight:bold;">'.__('BPS Pro Activation Steps: ', 'bulletproof-security').'</font><br><span style="font-size:13px;">'.__('1. Enter the BPS Pro Download-Request Key that was emailed to you when you purchased BPS Pro into the Save Download-Request Key text box and click the Save Download-Request Key button.', 'bulletproof-security').'<br>'.__('2. Click the Get Activation Key button to get your BPS Pro Activation Key. Your Activation Key will be emailed to your PayPal email address that you used to purchase BPS pro with.', 'bulletproof-security').'<br>'.__('3. Copy and Paste the BPS Pro Activation Key that was emailed to your PayPal email address into the Save Activation Key text box and click the Save Activation Key button.', 'bulletproof-security').'</span><br><br><font color="#2ea2cc" style="font-size:1.13em;font-weight:bold;">'.__('IMPORTANT NOTES: ', 'bulletproof-security').'</font><br><span style="font-size:13px;">&bull; '.__('Some Activation Keys contain dots (.) as part of the encrypted Activation Key. If your Activation Key contains a dot at the end of your Activation Key it is not a period and is part of the Activation Key. Copy the entire Activation Key including any dots (.) into the Save Activation Key text box and click the Save Activation Key button.', 'bulletproof-security').'<br>&bull; '.__('Each website requires its own unique BPS Pro Activation Key. Do the BPS Pro Activation Steps below on each of your websites.', 'bulletproof-security').'<br>&bull; '.__('If you change your domain URL in any way then request a new BPS Pro Activation Key. Domain URL changes would be changing your domain name, moving your website to a new folder/URL, changing HTTP to HTTPS, changing your Domain prefix from www to non-www or vice versa.', 'bulletproof-security').'</span>';
echo $text;
?>

<?php if ( ! current_user_can('manage_options') ) { _e('Permission Denied','bulletproof-security'); } else { ?>

<div id="activation-border" style="border-top:1px solid #999999;margin-top:10px;">

<div id="Download-Request-Key" style="margin:15px 0px 10px 10px;">
<form name="bpsProActivation" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_activation'); ?>
	<?php $options = get_option('bulletproof_security_options_activation'); ?>
	
    <label for="proActivate"><strong><?php _e('Save Download-Request Key','bulletproof-security'); ?><br />
	<?php _e('1. Enter Your BPS Pro Download-Request Key and click the Save Download-Request Key button','bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bulletproof_security_options_activation[bps_pro_activation]" value="<?php echo $options['bps_pro_activation']; ?>" class="regular-text-long-fixed" style="margin:5px 10px 0px 0px;" />
    <input type="hidden" name="bpsProKeyCheck" value="<?php echo $options['bps_pro_activation']; ?>" />
	<input type="submit" name="Submit-ProActivate" class="button bps-button" style="margin-top:4px;" value="<?php esc_attr_e('Save Download-Request Key', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Reminder: Only Download-Request Keys should be saved in the Download-Request Key text box. This is not an error message and is just a Reminder.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your Download-Request Key or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<div id="Get-Key-Request" style="margin:10px 0px 10px 10px;">
<form name="bpsProGetKey" action="admin.php?page=bulletproof-security/admin/activation/activation.php" method="post">
<?php wp_nonce_field('bulletproof_security_pro_get_key'); ?>

     <label for="proActivate"><strong><?php _e('Get Activation Key', 'bulletproof-security'); ?><br />
	 <?php _e('2. Get The Unique BPS Pro Activation Key For This Specific Website: ','bulletproof-security'); ?></strong></label><br />
	<input type="submit" name="Submit-GetKey" class="button bps-button" style="margin-top:5px;" value="<?php esc_attr_e('Get Activation Key', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Clicking OK will send a request to the AITpro.com API Server to automatically generate an encrypted BPS Pro Activation Key for this website and email that Activation Key to your PayPal email address.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('You should receive your Activation Key within 3 minutes. Please check your Spam or Junk email folder if you do not see the Activation Key email.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('If you do not receive your Activation Key after 5 minutes, please request your Activation Key again. If you do not receive your Activation Key after 15 minutes please send an email to info@ait-pro.com.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to request a BPS Pro Activation Key for this website or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>

<div id="Enter-Activation-Key" style="margin:10px 0px 10px 10px;">
<form name="bpsProActivation2" action="options.php" method="post">
	<?php settings_fields('bulletproof_security_options_activation'); ?>
	<?php $options = get_option('bulletproof_security_options_activation'); ?>

    <label for="proActivate"><strong><?php _e('Save Activation Key', 'bulletproof-security'); ?><br />
	<?php _e('3. Enter Your BPS Pro Activation Key and click the Save Activation Key button','bulletproof-security'); ?></strong></label><br />
    <input type="text" name="bulletproof_security_options_activation[delete_paypal_email]" value="<?php echo $options['delete_paypal_email']; ?>" class="regular-text-long-fixed" style="margin:5px 10px 0px 0px;" />
    <input type="hidden" name="bpsProKeyCheck2" value="<?php echo $options['bps_api_key']; ?>" />
	<input type="submit" name="Submit-SaveKey" class="button bps-button" style="margin-top:4px;" value="<?php esc_attr_e('Save Activation Key', 'bulletproof-security') ?>" onclick="return confirm('<?php $text = __('Some Activation Keys have dots at the end of the encrypted Key. The dot is part of the encrypted Activation Key and is not a period. Please copy and paste your entire Activation Key including any dots if your Activation Key contains any dots.', 'bulletproof-security').'\n\n'.$bpsSpacePop.'\n\n'.__('Click OK to Save your Activation Key or click Cancel.', 'bulletproof-security'); echo $text; ?>')" />
</form>
</div>
</div>

</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help"></td>
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
</div>