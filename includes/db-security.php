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

/********************************************************/
//  DB Moniter - Cron Schedules, Check & Email Alerts   //
/********************************************************/

add_action('bpsPro_DBM_check', 'bpsPro_DB_Monitor_check');

// DB Monitor Cron schedule checks based on DB options saved
function bpsPro_schedule_DBM_checks() {
$options = get_option('bulletproof_security_options_db_monitor');
$bpsDBMCronCheck = wp_get_schedule('bpsPro_DBM_check');
$killit = '';
	
	if ( ! get_option('bulletproof_security_options_db_monitor' ) || ! $options['bps_db_monitor_cron'] || $options['bps_db_monitor_cron'] == '' ) {
		return $killit;
	}
	
	if ( $options['bps_db_monitor_cron'] == 'On' ) {
	
	if ( $options['bps_db_monitor_cron_frequency'] == '1' ) {
	if ( $bpsDBMCronCheck == 'minutes_5' || $bpsDBMCronCheck == 'minutes_10' || $bpsDBMCronCheck == 'minutes_15' || $bpsDBMCronCheck == 'minutes_30' || $bpsDBMCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled( 'bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_1', 'bpsPro_DBM_check');
	}
	}
	
	if ( $options['bps_db_monitor_cron_frequency'] == '5' ) {
	if ( $bpsDBMCronCheck == 'minutes_1' || $bpsDBMCronCheck == 'minutes_10' || $bpsDBMCronCheck == 'minutes_15' || $bpsDBMCronCheck == 'minutes_30' || $bpsDBMCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_5', 'bpsPro_DBM_check' );
	}
	}
	
	if ( $options['bps_db_monitor_cron_frequency'] == '10' ) {
	if ( $bpsDBMCronCheck == 'minutes_1' || $bpsDBMCronCheck == 'minutes_5' || $bpsDBMCronCheck == 'minutes_15' || $bpsDBMCronCheck == 'minutes_30' || $bpsDBMCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_10', 'bpsPro_DBM_check' );
	}
	}
	
	if ( $options['bps_db_monitor_cron_frequency'] == '15' ) {
	if ( $bpsDBMCronCheck == 'minutes_1' || $bpsDBMCronCheck == 'minutes_5' || $bpsDBMCronCheck == 'minutes_10' || $bpsDBMCronCheck == 'minutes_30' || $bpsDBMCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_15', 'bpsPro_DBM_check' );
	}
	}
	
	if ( $options['bps_db_monitor_cron_frequency'] == '30' ) {
	if ( $bpsDBMCronCheck == 'minutes_1' || $bpsDBMCronCheck == 'minutes_5' || $bpsDBMCronCheck == 'minutes_10' || $bpsDBMCronCheck == 'minutes_15' || $bpsDBMCronCheck == 'minutes_60' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_30', 'bpsPro_DBM_check' );
	}
	}

	if ( $options['bps_db_monitor_cron_frequency'] == '60' ) {
	if ( $bpsDBMCronCheck == 'minutes_1' || $bpsDBMCronCheck == 'minutes_5' || $bpsDBMCronCheck == 'minutes_10' || $bpsDBMCronCheck == 'minutes_15' || $bpsDBMCronCheck == 'minutes_30' ) {
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
	
	if ( ! wp_next_scheduled('bpsPro_DBM_check' ) ) {
		wp_schedule_event( time(), 'minutes_60', 'bpsPro_DBM_check' );
	}
	}

	}
	elseif ( $options['bps_db_monitor_cron'] == 'Off' ) { 
		wp_clear_scheduled_hook('bpsPro_DBM_check');
	}
}

add_action('init', 'bpsPro_schedule_DBM_checks');

// DB Monitor Check: Cron with Time Restriction
// Checks DB Tables by Size, Update Time, new DB Tables created
// IMPORTANT: XAMPP/InnoDB database types do NOT use/have an Update Time column 
// The default format of the bps_update_time Table column is: 0000-00-00 00:00:00
function bpsPro_DB_Monitor_check() {	
global $wpdb;
$DBMoptions = get_option('bulletproof_security_options_db_monitor');
	
	if ( $DBMoptions['bps_db_monitor_cron'] == 'Off' || ! get_option('bulletproof_security_options_db_monitor') ) {
		exit();
	}
	
	if ( time() < $DBMoptions['bps_db_monitor_cron_end'] ) {
		exit();
	
	} else {

$SmonitorOptions = get_option('bulletproof_security_options_monitor');
$DBMoptions = get_option('bulletproof_security_options_db_monitor');
$DBMLogTime = get_option('bulletproof_security_options_DBM_log');
$DBMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";
$DBMRows = '';
$DBMTables = 0;
$size = 0;
$DBMTableRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $DBMtable_name WHERE bps_table_name != %s", $DBMRows ) );
$getDBTables = $wpdb->get_results( $wpdb->prepare( "SHOW TABLE STATUS WHERE Rows >= %d", $DBMTables ) );

$date_format = 'M j, Y @ g:i A';
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsDBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$send_email = '';

	foreach ( $getDBTables as $Tabledata ) {
		
		$table_size = $Tabledata->Data_length + $Tabledata->Index_length;
		
		if ( $Tabledata->Update_time == '' || $Tabledata->Update_time === NULL ) {
			$update_time = 'N/A';
		} else {
			$update_time = $Tabledata->Update_time;
		}

		// Check for new DB Tables created & log them
		if ( $DBMoptions['bps_db_monitor_cron_table_created_check'] == 'On' ) {
				
			// if a db table create time is greater than the db monitor log time
			if ( strtotime( $Tabledata->Create_time ) > strtotime( $DBMLogTime['bps_dbm_log_date_mod'] ) ) {
				
				$log_contents = "\r\n" . '[New DB Table Created - Cron Check Time ' . $timestamp . ']' . "\r\n" . 'New DB Table Created Name: ' . $Tabledata->Name . "\r\n" . 'New DB Table Actual Create Time: ' . $Tabledata->Create_time . "\r\n" . 'DB Monitor Guide: http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/' . "\r\n";

				if ( is_writable( $bpsDBMLog ) ) {
				if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         			exit;
    			}
    			if ( fwrite( $handle, $log_contents) === FALSE ) {
        			exit;
    			}
    			fclose($handle);
				}	
				
				$send_email = 'send';
				
				$BPS_dbm_Options = array( 'bps_dbm_log_date_mod' => date( "F d Y H:i:s", time() + $gmt_offset ) );	
	
				foreach( $BPS_dbm_Options as $key => $value ) {
					update_option('bulletproof_security_options_DBM_log', $BPS_dbm_Options);
				}
			}
		}
		
	foreach ( $DBMTableRows as $key => $value ) {
	
		if ( $value->bps_table_name == $Tabledata->Name ) {
			
			switch ( $value->bps_check ) {
   				case 'dbtables':
					if ( $value->bps_size != $table_size ) {
						$log_contents = "\r\n" . '[DB Table Size Change - Cron Check Time: ' . $timestamp . ']' . "\r\n" . 'DB Table Name: ' . $Tabledata->Name . "\r\n" . 'Previous DB Table Size: ' . $value->bps_size . ' bytes' . "\r\n" . 'Current DB Table Size: '. $table_size . ' bytes' . "\r\n" . 'DB Monitor Guide: http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/' . "\r\n";

						if ( is_writable( $bpsDBMLog ) ) {
						if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         					exit;
    					}
    					if ( fwrite( $handle, $log_contents) === FALSE ) {
        					exit;
    					}
    					fclose($handle);
					}	
					$send_email = 'send';

					$update_dbm_rows = $wpdb->update( $DBMtable_name, array( 'bps_table_name' => $value->bps_table_name, 'bps_check' => $value->bps_check, 'bps_size' => $table_size, 'bps_update_time' => $value->bps_update_time, 'bps_created' => $value->bps_created ), array( 'bps_table_name' => $value->bps_table_name ) );
					}
				break;
    			case 'dbtablessize':
					if ( $value->bps_size != $table_size ) {
						$log_contents = "\r\n" . '[DB Table Size Change - Cron Check Time: ' . $timestamp . ']' . "\r\n" . 'DB Table Name: ' . $Tabledata->Name . "\r\n" . 'Previous DB Table Size: ' . $value->bps_size . ' bytes' . "\r\n" . 'Current DB Table Size: '. $table_size . ' bytes' . "\r\n" . 'DB Monitor Guide: http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/' . "\r\n";

						if ( is_writable( $bpsDBMLog ) ) {
						if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         					exit;
    					}
    					if ( fwrite( $handle, $log_contents) === FALSE ) {
        					exit;
    					}
    					fclose($handle);
					}	
					$send_email = 'send';
					
					$update_dbm_rows = $wpdb->update( $DBMtable_name, array( 'bps_table_name' => $value->bps_table_name, 'bps_check' => $value->bps_check, 'bps_size' => $table_size, 'bps_update_time' => $value->bps_update_time, 'bps_created' => $value->bps_created ), array( 'bps_table_name' => $value->bps_table_name ) );
					}
				break;
    			case 'dbtablesupdate': 
					if ( $value->bps_update_time != $Tabledata->Update_time && !preg_match('/0000-00-00 00:00:00/', $value->bps_update_time, $matches ) ) {
						$log_contents = "\r\n" . '[DB Table Update Time Change - Cron Check Time: ' . $timestamp . ']' . "\r\n" . 'DB Table Name: ' . $Tabledata->Name . "\r\n" . 'Previous DB Table Update Time: ' . $value->bps_update_time . "\r\n" . 'Current DB Table Update Time: '. $update_time . "\r\n" . 'DB Monitor Guide: http://forum.ait-pro.com/forums/topic/database-monitor-dbm-guide/' . "\r\n";

						if ( is_writable( $bpsDBMLog ) ) {
						if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         					exit;
    					}
    					if ( fwrite( $handle, $log_contents) === FALSE ) {
        					exit;
    					}
    					fclose($handle);
					}	
					$send_email = 'send';
					
					$update_dbm_rows = $wpdb->update( $DBMtable_name, array( 'bps_table_name' => $value->bps_table_name, 'bps_check' => $value->bps_check, 'bps_size' => $value->bps_size, 'bps_update_time' => $Tabledata->Update_time, 'bps_created' => $value->bps_created ), array( 'bps_table_name' => $value->bps_table_name ) );					
					}
				break;
		 	} // end switch
		} // end if ( $value->bps_table_name == $Tabledata->Name ) {
	} // end foreach ( $DBMTableRows as $key => $value ) {
	} // end foreach ( $getDBTables as $Tabledata ) {
	
	// ONLY Send 1 email alert if S-Monitor DBM email alerting is set to Send email alerts
	$SMonitor_Email_options = get_option('bulletproof_security_options_email'); 
	
	if ( $send_email != '' && $SMonitor_Email_options['bps_dbm_email'] == 'yes' ) {
		bpsPro_dbm_zip_email_processing();
	}	

	// Resets the new Cron check time - next scheduled check time
	// i may not actually need this - check that theory out.
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '1' ) {
		$dbm_cron_end = time() + 60;	
	}
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '5' ) {
		$dbm_cron_end = time() + 300;	
	}	
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '10' ) {
		$dbm_cron_end = time() + 600;	
	}
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '15' ) {
		$dbm_cron_end = time() + 900;	
	}	
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '30' ) {
		$dbm_cron_end = time() + 1800;	
	}	
	if ( $DBMoptions['bps_db_monitor_cron_frequency'] == '60' ) {
		$dbm_cron_end = time() + 3600;	
	}

	$BPS_Options = array(
	'bps_db_monitor_cron' 						=> $DBMoptions['bps_db_monitor_cron'], 
	'bps_db_monitor_cron_frequency' 			=> $DBMoptions['bps_db_monitor_cron_frequency'], 
	'bps_db_monitor_cron_table_created_check' 	=> $DBMoptions['bps_db_monitor_cron_table_created_check'], 
	//'bps_db_monitor_cron_table_created_check' => 'On', 
	'bps_db_monitor_cron_end' 					=> $dbm_cron_end
	);	
	
		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_monitor', $BPS_Options);
		}
	} // end if ( time() < $DBMoptions['bps_db_monitor_cron_end'] ) {
}

// DB Monitor process zip and email functions or log an error to the DBM Log file
function bpsPro_dbm_zip_email_processing() {
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsDBMLog = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';	

	if ( bps_Zip_DBM_Log_File_alert()==TRUE ) {
		bps_Email_DBM_Log_File_alert();
	
		$log_contents = "\r\n" . '[DB Monitor Log File Zip and Email Successful: ' . $timestamp . ']' . "\r\n" . 'Your DB Monitor Log file has been successfully zipped and emailed to you' . "\r\n";

		if ( is_writable( $bpsDBMLog ) ) {
		if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         	exit;
    	}
    	if ( fwrite( $handle, $log_contents) === FALSE ) {
        	exit;
    	}
    	fclose($handle);
		}	
	
	} else {
		
		$log_contents = "\r\n" . '[DB Monitor Log File Zip and Email Error: ' . $timestamp . ']' . "\r\n" . 'Unable to zip and email the DB Monitor Log file' . "\r\n";

		if ( is_writable( $bpsDBMLog ) ) {
		if ( ! $handle = fopen( $bpsDBMLog, 'a' ) ) {
         	exit;
    	}
    	if ( fwrite( $handle, $log_contents) === FALSE ) {
        	exit;
    	}
    	fclose($handle);
		}	
	}
}

// Zip the DB Monitor Log File - If ZipArchive Class is not available use PCLZip
function bps_Zip_DBM_Log_File_alert() {
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

// Send the DB Monitor Alert with the zipped DB Montitor Log File attached
function bps_Email_DBM_Log_File_alert() {
$options = get_option('bulletproof_security_options_email');
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), strtotime($date));
$DBMLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
$DBMLogMaster = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
$DBMLogZip = WP_CONTENT_DIR . '/bps-backup/logs/db-monitor-log.zip';
	
	$attachments = array( $DBMLogZip );
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro Alert: DB Monitor Has Detected a Database Change - $timestamp ";
	$message = '<p>The change detected to your database is most likely a completely legitimate automated update done by WordPress, a Plugin, a Theme or by you installing, updating or deleting something on your website.</p>';	
	$message .= '<p>The attached DB Monitor Log file contains the database changes that were detected and logged by the DB Monitor. If you recognize the DB changes that were made then you do not need to do anything further. If you do not recognize the DB changes in the attached log file or you are not sure if something needs to be done then login to your website, go to the BPS Pro DB Monitor page, click on the DB Diff Tool tab and click the DB Diff Tool Read Me help button. The BPS Pro DB Diff Tool allows you to compare old database backup files to your current database tables to see exactly what has changed in your database.</p>';
	$message .= '<p><font color="blue"><strong>DB Monitor Log File db-monitor-log.zip is Attached For:</strong></font></p>';
	$message .= '<p>Site: '.$justUrl.'</p>'; 
		
	$mailed = wp_mail($bps_email_to, $subject, $message, $headers, $attachments);

	if ( $mailed && file_exists($DBMLogZip) ) {
		unlink($DBMLogZip);
	}
}

/********************************/
// DB Monitor Dashboard Alert
/********************************/

// Get the Current / Last Modifed time of the DBM Log File - Minutes check
function bpsPro_DBM_LogLastMod_wp() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date( "F d Y H:i", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// Get the Current / Last Modifed time of the DBM Log File - Seconds for Display
function bpsPro_DBM_LogLastMod_wp_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date( "F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// String comparison of DB Monitor DB Last Modified Time and Actual File Last Modified Time
function bpsPro_DBM_ModTimeDiff_wp() {
	
	if ( current_user_can('manage_options') ) {
	
	// New installations - BPS Pro has NOT been activated & S-Monitor Options have not been saved & / or the Setup Wizard has not been run
	if ( ! get_option('bulletproof_security_options_activation') || ! get_option('bulletproof_security_options_monitor') ) {
		return;
	}
	
	$options = get_option('bulletproof_security_options_DBM_log');
	$SmonitorOptions = get_option('bulletproof_security_options_monitor');

	if ( ! $options['bps_dbm_log_date_mod'] ) {

		$BPS_Options = array( 'bps_dbm_log_date_mod' => bpsPro_DBM_LogLastMod_wp_secs() );

		foreach( $BPS_Options as $key => $value ) {
			update_option('bulletproof_security_options_DBM_log', $BPS_Options);
		}
	}
	
	if ( $SmonitorOptions['bps_dbm_alerts'] == 'wpOn' ) {
	if ( strcmp( bpsPro_DBM_LogLastMod_wp_secs(), $options['bps_dbm_log_date_mod'] ) != 0 && $options['bps_dbm_log_date_mod'] != '' && strcmp( bpsPro_DBM_LogLastMod_wp(), getBPSInstallTime() ) == 0 ) {

		$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
		$gmt_offset = get_option( 'gmt_offset' ) * 3600;
		
		touch( $filename, strtotime( $options['bps_dbm_log_date_mod'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $options['bps_dbm_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $options['bps_dbm_log_date_mod'] ) - 3600;	
	
	// Prevents BackWPup coding mistake from displaying BPS Pro Dashboard alerts on the BackWPup Backups page
	if ( ! preg_match( '/page=backwpupbackups/', $_SERVER['QUERY_STRING'], $matches) ) {	
	if ( $options['bps_dbm_log_date_mod'] != '' && strcmp( bpsPro_DBM_LogLastMod_wp_secs(), $options['bps_dbm_log_date_mod'] ) != 0 && $db_timestamp_plus_one != strtotime( bpsPro_DBM_LogLastMod_wp_secs() ) && $db_timestamp_minus_one != strtotime( bpsPro_DBM_LogLastMod_wp_secs() ) ) {
		$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="red">'.__('DB Monitor Alert', 'bulletproof-security').'</font><br>'.__('A new Database Table has been created or an existing Database Table has been modified. ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the DB Monitor Log page.', 'bulletproof-security').'<br>'.__('To remove this alert click the Reset Last Modified Time in DB button on the DB Monitor Log page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
	}
}

add_action('admin_notices', 'bpsPro_DBM_ModTimeDiff_wp');

/********************************/
// DB Backup Job Processing
/********************************/

/** DB Backup Hourly Cron check for any Scheduled Backup Jobs that need to be run **/
// commented out during development so that no processing will occur
add_action('bpsPro_DBB_check', 'bpsPro_DBB_processing');

function bpsPro_DBB_cron( $schedules ) {
$schedules['hourly'] = array( 'interval' => 3600, 'display' => __('Hourly') );
	return $schedules;
}
add_filter('cron_schedules', 'bpsPro_DBB_cron');

// $clock syncs to the exact current UNIX hour - ie 5:00:00, 6:00:00, 7:00:00
function bpsPro_schedule_DBB_checks() {
$bpsDBBCronCheck = wp_get_schedule('bpsPro_DBB_check');
$DBBoptions = get_option('bulletproof_security_options_db_backup');
$clock = mktime( date( "H", time() ), 0, 0, date( "n", time() ), date( "j", time() ), date( "Y", time() ) );
	
	if ( $DBBoptions['bps_db_backup'] == 'On' ) {
	if ( ! wp_next_scheduled('bpsPro_DBB_check') ) {
		wp_schedule_event( $clock, 'hourly', 'bpsPro_DBB_check' );
	}
	}
}
add_action('init', 'bpsPro_schedule_DBB_checks');

// DB Backup Cron Job Processing & delete old Backup Files if that option has been chosen
function bpsPro_DBB_processing() {
global $wpdb;	
	
	$DBBoptions = get_option('bulletproof_security_options_db_backup');	
	
	bpsPro_DBB_delete_old_backup_files();
	
	$DBB_table_name = $wpdb->prefix . "bpspro_db_backup";
	$DBB_Rows = 'Scheduled';
	$DBB_TableRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $DBB_table_name WHERE bps_job_type = %s", $DBB_Rows ) );
	
	$db_backup = $DBBoptions['bps_db_backup_folder'] . '/' . DB_NAME . '.sql';

	foreach ( $DBB_TableRows as $row ) {
			
		if ( time() >= $row->bps_next_job_unix ) {

			$job_name = $row->bps_desc;
			$job_type = $row->bps_job_type;
			$email_zip = $row->bps_email_zip;
					
			$build_query_1 = "SHOW TABLES FROM `".DB_NAME."` WHERE `Tables_in_".DB_NAME."` LIKE '";
			$build_query_2 = str_replace( ', ', "' OR `Tables_in_".DB_NAME."` LIKE '", $row->bps_table_name );
			$build_query_3 = "'";
			$tables = $wpdb->get_results( $build_query_1.$build_query_2.$build_query_3, ARRAY_A );

			bpsPro_db_backup( $db_backup, $tables, $job_name, $job_type, $email_zip );
			
			if ( $row->bps_frequency == 'Hourly' ) {
				$update_rows = $wpdb->update( $DBB_table_name, array( 'bps_next_job_unix' => time() + 3600 ), array( 'bps_id' => $row->bps_id ) );
			}
			if ( $row->bps_frequency == 'Daily' ) {
				$update_rows = $wpdb->update( $DBB_table_name, array( 'bps_next_job_unix' => time() + 86400 ), array( 'bps_id' => $row->bps_id ) );
			}
			if ( $row->bps_frequency == 'Weekly' ) {
				$update_rows = $wpdb->update( $DBB_table_name, array( 'bps_next_job_unix' => time() + 604800 ), array( 'bps_id' => $row->bps_id ) );
			}	
			if ( $row->bps_frequency == 'Monthly' ) {
				$update_rows = $wpdb->update( $DBB_table_name, array( 'bps_next_job_unix' => time() + 2592000 ), array( 'bps_id' => $row->bps_id ) );
			}		
		}
	}
}

// Delete Old Backup files and log the deleted Backup file name in the DB Backup Log
function bpsPro_DBB_delete_old_backup_files() {
$DBBoptions = get_option('bulletproof_security_options_db_backup');
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);	
$bpsDBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';

	if ( $DBBoptions['bps_db_backup_delete'] == 'Never' ) {
		return;
	}

	$no_zips = '';
	$handle = fopen( $bpsDBBLog, 'a' );

	if ( $handle )

	fwrite( $handle, "\r\n[Old Zip Backup File(s) Automatic Deletion: ". $timestamp . "]\n" );
	
	$source = $DBBoptions['bps_db_backup_folder'];
	
	if ( is_dir($source) ) {
		
		$iterator = new DirectoryIterator($source);
		
		foreach ( $iterator as $file ) {
			
			if ( $file->isFile() && $file->getFilename() != '.htaccess' ) {

				$last_modified = filemtime( $source.DIRECTORY_SEPARATOR.$file->getFilename() ); 
				
				if ( $DBBoptions['bps_db_backup_delete'] == '1' && time() - ( $last_modified ) >= 86400 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '5' && time() - ( $last_modified ) >= 432000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '10' && time() - ( $last_modified ) >= 864000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '15' && time() - ( $last_modified ) >= 1296000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '30' && time() - ( $last_modified ) >= 2592000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '60' && time() - ( $last_modified ) >= 5184000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '90' && time() - ( $last_modified ) >= 7776000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} elseif ( $DBBoptions['bps_db_backup_delete'] == '180' && time() - ( $last_modified ) >= 15552000 ) {
					unlink( $source.DIRECTORY_SEPARATOR.$file->getFilename() );
					fwrite( $handle, "Deleted Zip Backup File Name: ". $file->getFilename() . "\n" );
				} else {
					
					$no_zips = "No Zip Backup Files to Delete";
				}
			}
		}
	}
	fwrite( $handle, $no_zips . "\n" );
	fclose( $handle );

	$DBBLog_Options = array( 'bps_dbb_log_date_mod' => bpsPro_DBB_LogLastMod_wp_secs() );
	
	foreach( $DBBLog_Options as $key => $value ) {
		update_option('bulletproof_security_options_DBB_log', $DBBLog_Options);
	}
}

// Get the Current / Last Modifed time of the DB Backup Log File - Seconds - Wizard & formality since no Dashboard alerts
function bpsPro_DBB_LogLastMod_wp_secs() {
$filename = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
$gmt_offset = get_option( 'gmt_offset' ) * 3600;

if ( file_exists($filename) ) {
	$last_modified = date( "F d Y H:i:s", filemtime($filename) + $gmt_offset );
	return $last_modified;
	}
}

// DB Backup: Processes Manual and Scheduled Jobs
// Notes: fwrite is faster in benchmark tests than file_put_contents for successive writes
function bpsPro_db_backup( $db_backup, $tables, $job_name, $job_type, $email_zip ) {
global $wpdb;

$time_start = microtime( true );

	if ( $email_zip == 'Delete' ) {
		$email_zip_log = 'Yes & Delete';
	} else {
		$email_zip_log = $email_zip;
	}
	if ( $email_zip == 'EmailOnly' ) {
		$email_zip_log = 'Send Email Only';
	} else {
		$email_zip_log = $email_zip;
	}

	$timeNow = time();
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
	
	$handle = fopen( $db_backup, 'wb' );
	
	if ( $handle )

	fwrite( $handle, "-- -------------------------------------------\n" );
	fwrite( $handle, "-- BulletProof Security Pro DB Backup\n" );
	fwrite( $handle, "-- Support: http://forum.ait-pro.com/\n" );
	fwrite( $handle, "-- Backup Job Name: ". $job_name . "\n" );
	fwrite( $handle, "-- DB Backup Job Type: ". $job_type . "\n" );
	fwrite( $handle, "-- Email DB Backup: ". $email_zip_log . "\n" );
	fwrite( $handle, "-- DB Backup Time: ". $timestamp . "\n" );
	fwrite( $handle, "-- DB Name: ". DB_NAME . "\n" );		
	fwrite( $handle, "-- DB Table Prefix: ". $wpdb->base_prefix . "\n" );
	fwrite( $handle, "-- Website URL: " . get_bloginfo( 'url' ) . "\n" );
	fwrite( $handle, "-- WP ABSPATH: ". ABSPATH . "\n" );
	fwrite( $handle, "-- -------------------------------------------\n\n" );

	fwrite( $handle, "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n" );
	fwrite( $handle, "/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n" );
	fwrite( $handle, "/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n" );
	fwrite( $handle, "/*!40101 SET NAMES " . DB_CHARSET . " */;\n" );
	fwrite( $handle, "/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n" );
	fwrite( $handle, "/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n" );
	fwrite( $handle, "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n" );
	fwrite( $handle, "/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n\n" );

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
			
			} while ( !empty( $data ) );

			fwrite( $handle, "\n--\n-- END Table " . $table . "\n--\n" );
			
		if ( false !== $myisam )
			fwrite( $handle, "\n/*!40000 ALTER TABLE `" . $table . "` ENABLE KEYS */;" );
			fwrite( $handle, "\nUNLOCK TABLES;\n\n" );
		}
	}

	fwrite( $handle, "/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;\n" );
	fwrite( $handle, "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;\n" );
	fwrite( $handle, "/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;\n" );
	fwrite( $handle, "/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;\n" );
	fwrite( $handle, "/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\n" );
	fwrite( $handle, "/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\n" );
	fwrite( $handle, "/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;\n" );

	fclose( $handle );
	
	if ( file_exists($db_backup) ) {
	
	$DBBoptions = get_option('bulletproof_security_options_db_backup'); 
	//$db_backup = $DBBoptions['bps_db_backup_folder'] . '/' . DB_NAME . '.sql';

	// Use ZipArchive
	if ( class_exists('ZipArchive') ) {

	$zip = new ZipArchive();
	$filename = $DBBoptions['bps_db_backup_folder'] . '/' . date( 'Y-m-d-\t\i\m\e-g-i-s-a', $timeNow + $gmt_offset ) . '.zip';
	
	if ( $zip->open( $filename, ZIPARCHIVE::CREATE )!==TRUE ) {
    	exit("Error: Cannot Open $filename\n");
	}

	$zip->addFile( $db_backup, DB_NAME . ".sql" );
	$zip->close();
	
	@unlink($db_backup);
	
	} else {

	// Use PCLZip
	define( 'PCLZIP_TEMPORARY_DIR', $DBBoptions['bps_db_backup_folder'] . '/' );
	require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php');
	
	if ( ini_get( 'mbstring.func_overload' ) && function_exists( 'mb_internal_encoding' ) ) {
		$previous_encoding = mb_internal_encoding();
		mb_internal_encoding( 'ISO-8859-1' );
	}
 		$filename = $DBBoptions['bps_db_backup_folder'] . '/' . date( 'Y-m-d-\t\i\m\e-g-i-s-a', $timeNow + $gmt_offset ) . '.zip';
  		$archive = new PclZip( $filename );
		$sql_filename = str_replace( $DBBoptions['bps_db_backup_folder'] . '/', "", $db_backup );
		$db_backup = str_replace( array( '\\', '//'), "/", $db_backup );
		$db_backup_folder = str_replace( DB_NAME . '.sql', "", $db_backup );
		$v_list = $archive->create( $db_backup_folder . $sql_filename, PCLZIP_OPT_REMOVE_PATH, $db_backup_folder );
		
		@unlink($db_backup);
	}
	}
	
	$time_end = microtime( true );
	
	$backup_time = $time_end - $time_start;
	$backup_time_log = 'Backup Job Completion Time: '. round( $backup_time, 2 ) . ' Seconds';
	$backup_time_display = '<strong>Backup Job Completion Time: </strong>'. round( $backup_time, 2 ) . ' Seconds';
	$bpsDBBLog = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $backup_time_display;
	echo '</p></div>';

	$log_contents = "\r\n" . '[Backup Job Logged: ' . $timestamp . ']' . "\r\n" . 'Backup Job Name: ' . $job_name .  "\r\n" . 'Backup Job Type: ' . $job_type .  "\r\n" . 'Email DB Backup: ' . $email_zip_log . "\r\n" . $backup_time_log . "\r\n" . bpsPro_memory_resource_usage_logging() . "\r\n" . 'Zip Backup File Name: ' . $filename . "\r\n";
					
	if ( is_writable( $bpsDBBLog ) ) {
	if ( ! $handle = fopen( $bpsDBBLog, 'a' ) ) {
       	exit;
    }
    if ( fwrite( $handle, $log_contents ) === FALSE ) {
       	exit;
    }
    fclose($handle);
	}	
		
	$DBBLog_Options = array( 'bps_dbb_log_date_mod' => bpsPro_DBB_LogLastMod_wp_secs() );
	
	foreach( $DBBLog_Options as $key => $value ) {
		update_option('bulletproof_security_options_DBB_log', $DBBLog_Options);
	}

	$DBB_Backup_Options = array( 
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
	'bps_db_backup_status_display' 			=> $timestamp
	);
	
		foreach( $DBB_Backup_Options as $key => $value ) {
			update_option('bulletproof_security_options_db_backup', $DBB_Backup_Options);
		}
	
	// Send Email last: attaching a large zip file may fail
	if ( $job_type != 'Manual' || $email_zip != 'No' ) {

		$Email_options = get_option('bulletproof_security_options_email');
		$bps_email_to = $Email_options['bps_send_email_to'];
		$bps_email_from = $Email_options['bps_send_email_from'];
		$bps_email_cc = $Email_options['bps_send_email_cc'];
		$bps_email_bcc = $Email_options['bps_send_email_bcc'];
		$justUrl = get_site_url();
	
	if ( $email_zip == 'EmailOnly' ) {
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: $bps_email_from" . "\r\n";
		$headers .= "Cc: $bps_email_cc" . "\r\n";
		$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
		$subject = " BPS Pro DB Backup Completed - $timestamp ";
		$message = '<p><font color="blue"><strong>DB Backup Has Completed For:</strong></font></p>';
		$message .= '<p>Website: '.$justUrl.'</p>';
	
	$mailed = wp_mail( $bps_email_to, $subject, $message, $headers );	
	}

	if ( $email_zip == 'Delete' || $email_zip == 'Yes' ) {
		$attachments = array( $filename );
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: $bps_email_from" . "\r\n";
		$headers .= "Cc: $bps_email_cc" . "\r\n";
		$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
		$subject = " BPS Pro DB Backup Completed - $timestamp ";
		$message = '<p><font color="blue"><strong>DB Backup File is Attached For:</strong></font></p>';
		$message .= '<p>Website: '.$justUrl.'</p>';
	
	$mailed = wp_mail( $bps_email_to, $subject, $message, $headers, $attachments );	
	}

		if ( @$mailed && $email_zip == 'Delete' ) {
			unlink($filename);
		}
	}
} 
?>