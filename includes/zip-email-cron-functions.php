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
if (!function_exists ('add_action')) {
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

/*********************************************/
//  S-Monitor - Zip & Email Log File Cron    //
/*********************************************/
// 262144 bytes = 256KB = .25MB
// 524288 bytes = 512KB = .5MB
// 1048576 bytes = 1024KB = 1MB
// 2097152 bytes = 2048KB = 2MB - if log file is larger than 2MB do not send

add_action('bpsPro_email_log_files', 'bps_Log_File_Processing');

function bpsPro_schedule_Email_Log_Files() {
	if ( ! wp_next_scheduled( 'bpsPro_email_log_files' ) ) {
		wp_schedule_event(time(), 'hourly', 'bpsPro_email_log_files');
	}
}
add_action('init', 'bpsPro_schedule_Email_Log_Files');

function bpsPro_add_hourly_email_log_cron( $schedules ) {
	$schedules['hourly'] = array('interval' => 3600, 'display' => __('Once Hourly'));
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_add_hourly_email_log_cron');

// S-Monitor - Process Log Files
// FailSafe for log files that exceed the maximum size in a short period of time
function bps_Log_File_Processing() {
$options = get_option('bulletproof_security_options_email');
$options2 = get_option('bulletproof_security_options2'); 
$SecurityLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$SecurityLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt';
$DBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$DBMLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
$DBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$DBBLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';
$ARQLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$ARQLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/autorestore_log.txt';
$PHPLog = $options2['bps_error_log_location'];
$PHPLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error_master.log';

switch ( $options['bps_security_log_size'] ) {
    case "256KB":
		if ( filesize($SecurityLog) >= 262144 && filesize($SecurityLog) < 524288 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($SecurityLog) >= 524288 && filesize($SecurityLog) < 1048576 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($SecurityLog) >= 1048576 && filesize($SecurityLog) < 2097152 || filesize($SecurityLog) > 2097152) {
		if ( $options['bps_security_log_emailL'] == 'email') {
			if ( bps_Zip_Security_Log_File()==TRUE ) {
				bps_Email_Security_Log_File();
			}
		} elseif ( $options['bps_security_log_emailL'] == 'delete') {
			copy($SecurityLogMaster, $SecurityLog);	
		}		
		break;
		}
}

switch ( $options['bps_dbm_log_size'] ) {
    case "256KB":
		if ( filesize($DBMLog) >= 262144 && filesize($DBMLog) < 524288 || filesize($DBMLog) > 2097152) {
		if ( $options['bps_dbm_log_email'] == 'email') {
			if ( bps_Zip_DBM_Log_File()==TRUE ) {
				bps_Email_DBM_Log_File();
			}
		} elseif ( $options['bps_dbm_log_email'] == 'delete') {
			copy($DBMLogMaster, $DBMLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($DBMLog) >= 524288 && filesize($DBMLog) < 1048576 || filesize($DBMLog) > 2097152) {
		if ( $options['bps_dbm_log_email'] == 'email') {
			if ( bps_Zip_DBM_Log_File()==TRUE ) {
				bps_Email_DBM_Log_File();
			}
		} elseif ( $options['bps_dbm_log_email'] == 'delete') {
			copy($DBMLogMaster, $DBMLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($DBMLog) >= 1048576 && filesize($DBMLog) < 2097152 || filesize($DBMLog) > 2097152) {
		if ( $options['bps_dbm_log_email'] == 'email') {
			if ( bps_Zip_DBM_Log_File()==TRUE ) {
				bps_Email_DBM_Log_File();
			}
		} elseif ( $options['bps_dbm_log_email'] == 'delete') {
			copy($DBMLogMaster, $DBMLog);	
		}		
		break;
		}
}

switch ( $options['bps_dbb_log_size'] ) {
    case "256KB":
		if ( filesize($DBBLog) >= 262144 && filesize($DBBLog) < 524288 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($DBBLog) >= 524288 && filesize($DBBLog) < 1048576 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($DBBLog) >= 1048576 && filesize($DBBLog) < 2097152 || filesize($DBBLog) > 2097152) {
		if ( $options['bps_dbb_log_email'] == 'email') {
			if ( bps_Zip_DBB_Log_File()==TRUE ) {
				bps_Email_DBB_Log_File();
			}
		} elseif ( $options['bps_dbb_log_email'] == 'delete') {
			copy($DBBLogMaster, $DBBLog);	
		}		
		break;
		}
}

switch ( $options['bps_arq_log_size'] ) {
    case "256KB":
		if ( filesize($ARQLog) >= 262144 && filesize($ARQLog) < 524288 || filesize($ARQLog) > 2097152) {
		if ( $options['bps_arq_log_email'] == 'email') {
			if ( bps_Zip_ARQ_Log_File()==TRUE ) {
				bps_Email_ARQ_Log_File();
			}
		} elseif ( $options['bps_arq_log_email'] == 'delete') {
			copy($ARQLogMaster, $ARQLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($ARQLog) >= 524288 && filesize($ARQLog) < 1048576 || filesize($ARQLog) > 2097152) {
		if ( $options['bps_arq_log_email'] == 'email') {
			if ( bps_Zip_ARQ_Log_File()==TRUE ) {
				bps_Email_ARQ_Log_File();
			}
		} elseif ( $options['bps_arq_log_email'] == 'delete') {
			copy($ARQLogMaster, $ARQLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($ARQLog) >= 1048576 && filesize($ARQLog) < 2097152 || filesize($ARQLog) > 2097152) {
		if ( $options['bps_arq_log_email'] == 'email') {
			if ( bps_Zip_ARQ_Log_File()==TRUE ) {
				bps_Email_ARQ_Log_File();
			}
		} elseif ( $options['bps_arq_log_email'] == 'delete') {
			copy($ARQLogMaster, $ARQLog);	
		}		
		break;
		}
}

switch ( $options['bps_php_log_size'] ) {
    case "256KB":
		if ( filesize($PHPLog) >= 262144 && filesize($PHPLog) < 524288 || filesize($PHPLog) > 2097152) {
		if ( $options['bps_php_log_email'] == 'email') {
			if ( bps_Zip_PHP_Log_File()==TRUE ) {
				bps_Email_PHP_Log_File();
			}
		} elseif ( $options['bps_php_log_email'] == 'delete') {
			copy($PHPLogMaster, $PHPLog);	
		}
		break;
		}
    case "500KB":
		if ( filesize($PHPLog) >= 524288 && filesize($PHPLog) < 1048576 || filesize($PHPLog) > 2097152) {
		if ( $options['bps_php_log_email'] == 'email') {
			if ( bps_Zip_PHP_Log_File()==TRUE ) {
				bps_Email_PHP_Log_File();
			}
		} elseif ( $options['bps_php_log_email'] == 'delete') {
			copy($PHPLogMaster, $PHPLog);	
		}		
		break;
		}
    case "1MB":
		if ( filesize($PHPLog) >= 1048576 && filesize($PHPLog) < 2097152 || filesize($PHPLog) > 2097152) {
		if ( $options['bps_php_log_email'] == 'email') {
			if ( bps_Zip_PHP_Log_File()==TRUE ) {
				bps_Email_PHP_Log_File();
			}
		} elseif ( $options['bps_php_log_email'] == 'delete') {
			copy($PHPLogMaster, $PHPLog);	
		}		
		break;
		}
}
}

// EMAIL NOTES: You cannot fake a zip file by renaming a file extension 
// The zip file must be a real zip archive or it will not be successfully attached to an email.
// A plain txt file cannot be attached to an email.
// Email Security Log File
function bps_Email_Security_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$SecurityLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$SecurityLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt';
$SecurityLogZip = WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip';
	
	$attachments = array( $SecurityLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro Security Log - $timestamp ";
	$message = '<p><font color="blue"><strong>Security Log File For:</strong></font></p>';
	$message .= '<p>Site: '."$justUrl".'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($SecurityLogZip) ) {
		unlink($SecurityLogZip);
	
	if ( copy($SecurityLogMaster, $SecurityLog) ) {
		$options2 = get_option('bulletproof_security_options_Security_log');
		$last_modified_time_db = $options2['bps_security_log_date_mod'];
		$time = strtotime($last_modified_time_db);
		touch($SecurityLog, $time);	
	}
	}
}

// Email DB Monitor log file
function bps_Email_DBM_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$DBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$DBMLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
$DBMLogZip = WP_CONTENT_DIR . '/bps-backup/logs/db-monitor-log.zip';
	
	$attachments = array( $DBMLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro DB Monitor Log - $timestamp ";
	$message = '<p>This is a regular scheduled automatic log file zip email and is NOT an alert.</p>';	
	$message .= '<p><font color="blue"><strong>DB Monitor Log File is Attached For:</strong></font></p>';
	$message .= '<p>Site: '."$justUrl".'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($DBMLogZip) ) {
		unlink($DBMLogZip);
	
	if ( copy( $DBMLogMaster, $DBMLog ) ) {
		$DBMLogLastModifiedTime = get_option('bulletproof_security_options_DBM_log');
		$time = strtotime( $DBMLogLastModifiedTime['bps_dbm_log_date_mod'] );
		touch( $DBMLog, $time );	
	}
	}
}

// Email DB Backup log file
function bps_Email_DBB_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$DBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$DBBLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';
$DBBLogZip = WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip';
	
	$attachments = array( $DBBLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro DB Backup Log - $timestamp ";
	$message = '<p>This is a regular scheduled automatic log file zip email and is NOT an alert.</p>';	
	$message .= '<p><font color="blue"><strong>DB Backup Log File is Attached For:</strong></font></p>';
	$message .= '<p>Site: '.$justUrl.'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($DBBLogZip) ) {
		unlink($DBBLogZip);
	
	if ( copy( $DBBLogMaster, $DBBLog ) ) {
		$DBBLogLastModifiedTime = get_option('bulletproof_security_options_DBB_log');
		$time = strtotime( $DBBLogLastModifiedTime['bps_dbb_log_date_mod'] );
		touch( $DBBLog, $time );	
	}
	}
}

// Email ARQ Log File
function bps_Email_ARQ_Log_File() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$ARQLog = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
$ARQLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/autorestore_log.txt';
$ARQLogZip = WP_CONTENT_DIR . '/bps-backup/logs/ARQ-log.zip';

	$attachments = array( $ARQLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro ARQ Log - $timestamp ";
	$message = '<p><font color="blue"><strong>AutoRestore|Quarantine Log File For:</strong></font></p>';
	$message .= '<p>Site: '."$justUrl".'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($ARQLogZip) ) {
		unlink($ARQLogZip); 

	if ( copy($ARQLogMaster, $ARQLog) ) {
		$options2 = get_option('bulletproof_security_options_ARCM_log');
		$last_modified_time_db = $options2['bps_arcm_log_date_mod'];
		$time = strtotime($last_modified_time_db);
		touch($ARQLog, $time);	
	}	
	}
}

// PHP Error Log File
function bps_Email_PHP_Log_File() {
$options = get_option('bulletproof_security_options_email');
$options2 = get_option('bulletproof_security_options2');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$PHPLog = $options2['bps_error_log_location'];
$PHPLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error_master.log';
$PHPLogZip = WP_CONTENT_DIR . '/bps-backup/logs/PHP-Error-log.zip';

	$attachments = array( $PHPLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro PHP Error Log - $timestamp ";
	$message = '<p><font color="blue"><strong>PHP Error Log File For:</strong></font></p>';
	$message .= '<p>Site: '."$justUrl".'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($PHPLogZip) ) {
		unlink($PHPLogZip); 

	if ( copy($PHPLogMaster, $PHPLog) ) {
		$options3 = get_option('bulletproof_security_options_elog');
		$last_modified_time_db = $options3['bps_error_log_date_mod'];
		$time = strtotime($last_modified_time_db);
		touch($PHPLog, $time);	
	}
	}
}

// Zip Security Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_Security_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip';
	
	if ( $zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile(WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt', "http_error_log.txt");
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip(WP_CONTENT_DIR . '/bps-backup/logs/security-log.zip');
  		$v_list = $archive->create(WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/');
  	
	return true;

	if ( $v_list == 0) {
		die("Error : ".$archive->errorInfo(true) );
		return false;	
	}
	}
}

// Zip ARQ Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_ARQ_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/ARQ-log.zip';
	
	if ( $zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile(WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt', "autorestore_log.txt");
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip(WP_CONTENT_DIR . '/bps-backup/logs/ARQ-log.zip');
  		$v_list = $archive->create(WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/');
	
	return true;  	

	if ( $v_list == 0) {
		die("Error : ".$archive->errorInfo(true) );
		return false;
	}
	}
}

// Zip the DB Monitor Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_DBM_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/db-monitor-log.zip';
	
	if ( $zip->open( $filename, ZIPARCHIVE::CREATE )!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile( WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt', "db_monitor_log.txt" );
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip( WP_CONTENT_DIR . '/bps-backup/logs/db-monitor-log.zip' );
  		$v_list = $archive->create( WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/' );
  	
	return true;

	if ( $v_list == 0) {
		die("Error : ".$archive->errorInfo(true) );
		return false;	
	}
	}
}

// Zip the DB Backup Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_DBB_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip';
	
	if ( $zip->open( $filename, ZIPARCHIVE::CREATE )!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile( WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt', "db_backup_log.txt" );
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip( WP_CONTENT_DIR . '/bps-backup/logs/db-backup-log.zip' );
  		$v_list = $archive->create( WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt', PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/' );
  	
	return true;

	if ( $v_list == 0) {
		die("Error : ".$archive->errorInfo(true) );
		return false;	
	}
	}
}

// Zip PHP Error Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_PHP_Log_File() {
	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {
	
	$options = get_option('bulletproof_security_options2');
	$zip = new ZipArchive();
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/PHP-Error-log.zip';
	
	if ( $zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile($options['bps_error_log_location'], "bps_php_error.log");
	$zip->close();

	return true;

	} else {

// Use PCLZip
define( 'PCLZIP_TEMPORARY_DIR', WP_CONTENT_DIR . '/bps-backup/logs/' );
require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
  		$archive = new PclZip(WP_CONTENT_DIR . '/bps-backup/logs/PHP-Error-log.zip');
  		$v_list = $archive->create($options['bps_error_log_location'], PCLZIP_OPT_REMOVE_PATH, WP_CONTENT_DIR . '/bps-backup/logs/');
  	
	return true;

	if ( $v_list == 0) {
		die("Error : ".$archive->errorInfo(true) );
		return false;
	}
	}
}
?>