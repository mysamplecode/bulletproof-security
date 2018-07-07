<?php session_cache_limiter('nocache'); ?>
<?php session_start(); ?>
<?php error_reporting(0); ?>
<?php session_destroy(); ?>
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>400 Bad Request</title>
<style type="text/css">
<!--
body { 
	/* If you want to add a background image uncomment the CSS properties below */
	/* background-image:url(http://www.example.com/wp-content/plugins/bulletproof-security/abstract-blue-bg.jpg); /*
	/* background-repeat:repeat; */
	background-color:#CCCCCC;
	line-height: normal;
}

#bpsMessage {
	text-align:center; 
	background-color: #F7F8F9; 
	border:5px solid #000000; 
	padding:10px;
}

p {
    font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
}
-->
</style>
</head>

<body>
<div id="bpsMessage">
	<p><?php $bps_hostname = $_SERVER['SERVER_NAME']; 
	$bps_hostname = str_replace('www.', '', $bps_hostname); 
	echo $bps_hostname; ?> 400 Bad Request Error Page</p>
	<p>If you arrived here due to a search or clicking on a link click your Browser's back button to return to the previous page. Thank you.</p>
</div>

<?php 
if ( file_exists( dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php' ) ) {
	require_once('../../../wp-load.php');
}

// NOTE: fwrite is faster in benchmark tests than file_put_contents for successive writes
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	
	if ( !get_option( 'gmt_offset' ) ) {
		$timestamp = date("F j, Y g:i a", time() );
	} else {
		$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	}

		$event = 'The request could not be understood by the server due to malformed syntax.';
		$solution = 'N/A - Malformed Request - Not an Attack';	
	
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

@$log_contents = "\r\n" . '[400 POST Bad Request: ' . $timestamp . ']' . "\r\n" . 'Event Code: ' . $event . "\r\n" . 'Solution: ' . $solution . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

	if ( is_writable( $bpsProLog ) ) {

	if ( !$handle = fopen( $bpsProLog, 'a' ) ) {
         exit;
    }

    if ( fwrite( $handle, $log_contents) === FALSE ) {
        exit;
    }

    fclose($handle);
	}
	}

	if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
	
@$log_contents = "\r\n" . '[400 GET Bad Request: ' . $timestamp . ']' . "\r\n" . 'Event Code: ' . $event . "\r\n" . 'Solution: ' . $solution . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

	if ( is_writable( $bpsProLog ) ) {

	if ( !$handle = fopen( $bpsProLog, 'a' ) ) {
         exit;
    }

    if ( fwrite( $handle, $log_contents) === FALSE ) {
        exit;
    }

    fclose($handle);
	}
	}

?>
</body>
</html>