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
if ( !function_exists ('add_action') ) {
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

// Check Exclude DB Table for the PHP Error Log path
function bps_ExcludePHPELogDB() {
global $wpdb, $bulletproof_security_arq_db_version;
$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
$options = get_option('bulletproof_security_options2');
$phpELogExclude = $options['bps_error_log_location'];
	
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Etable_name ) ) == $Etable_name && $phpELogExclude != '' ) {	

		$getExcludeRows = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $Etable_name WHERE arq_exclude_source = %s", $phpELogExclude) );
	
		foreach ($getExcludeRows as $row) {
			if ($row->arq_exclude_source == $phpELogExclude) {
				return $row->arq_exclude_source;
			}
		}
	}
}

function bulletproof_security_admin_init() {
// As of 3.1 the register_activation_hook is not called when a plugin is updated
global $wpdb, $bpspro_version, $wp_version, $blog_id, $bulletproof_security_arq_db_version;

	if ( is_multisite() && $blog_id != 1 ) {

	$Ltable_name = $wpdb->prefix . "bpspro_login_security";

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Ltable_name ) ) != $Ltable_name ) {	

	$sql = "CREATE TABLE $Ltable_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  status VARCHAR(60) DEFAULT '' NOT NULL,
  user_id VARCHAR(60) DEFAULT '' NOT NULL,
  username VARCHAR(60) DEFAULT '' NOT NULL,
  public_name VARCHAR(250) DEFAULT '' NOT NULL,
  email VARCHAR(100) DEFAULT '' NOT NULL,
  role VARCHAR(15) DEFAULT '' NOT NULL,
  human_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  login_time VARCHAR(10) DEFAULT '' NOT NULL,
  lockout_time VARCHAR(10) DEFAULT '' NOT NULL,
  failed_logins VARCHAR(2) DEFAULT '' NOT NULL,
  ip_address VARCHAR(45) DEFAULT '' NOT NULL,
  hostname VARCHAR(60) DEFAULT '' NOT NULL,
  request_uri VARCHAR(255) DEFAULT '' NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}	

	} else {
		
	$Qtable_name = $wpdb->prefix . "bpspro_arq_quarantine";
	$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
	$Stable_name = $wpdb->prefix . "bpspro_seclog_ignore";
	$Ltable_name = $wpdb->prefix . "bpspro_login_security";
	$DBBtable_name = $wpdb->prefix . "bpspro_db_backup";
	$DMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Qtable_name ) ) != $Qtable_name ) {	
	
	$sql = "CREATE TABLE $Qtable_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  arq_quarantine_source text default '' NOT NULL,
  arq_quarantine_backup text default '' NOT NULL,
  arq_quarantine_qpath text default '' NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Etable_name ) ) != $Etable_name ) {	
	
	$sql = "CREATE TABLE $Etable_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  arq_exclude_source text default '' NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Stable_name ) ) != $Stable_name ) {	
	
	$sql = "CREATE TABLE $Stable_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  user_agent_bot text default '' NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $Ltable_name ) ) != $Ltable_name ) {	
	
	$sql = "CREATE TABLE $Ltable_name (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  status VARCHAR(60) DEFAULT '' NOT NULL,
  user_id VARCHAR(60) DEFAULT '' NOT NULL,
  username VARCHAR(60) DEFAULT '' NOT NULL,
  public_name VARCHAR(250) DEFAULT '' NOT NULL,
  email VARCHAR(100) DEFAULT '' NOT NULL,
  role VARCHAR(15) DEFAULT '' NOT NULL,
  human_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  login_time VARCHAR(10) DEFAULT '' NOT NULL,
  lockout_time VARCHAR(10) DEFAULT '' NOT NULL,
  failed_logins VARCHAR(2) DEFAULT '' NOT NULL,
  ip_address VARCHAR(45) DEFAULT '' NOT NULL,
  hostname VARCHAR(60) DEFAULT '' NOT NULL,
  request_uri VARCHAR(255) DEFAULT '' NOT NULL,
  UNIQUE KEY id (id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	// last job, next job is updated by the cron - job size is the total size of all tables selected in that job
	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $DBBtable_name ) ) != $DBBtable_name ) {	
	
	$sql = "CREATE TABLE $DBBtable_name (
  bps_id bigint(20) NOT NULL auto_increment,
  bps_table_name text default '' NOT NULL,
  bps_desc text default '' NOT NULL,
  bps_job_type varchar(9) default '' NOT NULL,
  bps_frequency varchar(7) default '' NOT NULL,
  bps_last_job varchar(30) default '' NOT NULL,
  bps_next_job varchar(30) default '' NOT NULL,
  bps_next_job_unix varchar(10) default '' NOT NULL,  
  bps_email_zip varchar(10) default '' NOT NULL,
  bps_job_created datetime default '0000-00-00 00:00:00' NOT NULL,
  UNIQUE KEY bps_id (bps_id)
    );";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $DMtable_name ) ) != $DMtable_name ) {	
	
	$sql = "CREATE TABLE $DMtable_name (
  bps_id bigint(20) NOT NULL auto_increment,
  bps_table_name varchar(64) default '' NOT NULL,
  bps_check varchar(20) default '' NOT NULL,
  bps_size varchar(64) default '' NOT NULL,  
  bps_update_time datetime default '0000-00-00 00:00:00' NOT NULL,
  bps_created datetime default '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY  (bps_id),
  UNIQUE KEY bps_table_name (bps_table_name)
    );";
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option("bulletproof_security_arq_db_version", $bulletproof_security_arq_db_version);
	// Delete Old BPS free transient content
	delete_transient( 'bulletproof-security_info' );
	}
	
	}

	$phpELogOptions = get_option('bulletproof_security_options2');
	$phpELogExclude = $phpELogOptions['bps_error_log_location'];

	// ONLY Insert PHP Error Log path into Exclude DB Table if php error log path is not /bps-backups/logs
	// Delete php error log row from the arq exclude DB Table if it points to the /bps-backups/logs folder
	$ELogExcludeDB = bps_ExcludePHPELogDB(); // ONLY returns an error log path if the DB Row matches the error log location option and is not blank
	$LogsExcludePath = '/bps-backup\/logs/';
	// if the error log path DOES NOT contain bps-backup/logs in the path and the DB Row does not exist then add the Row in the DB.
	// also checks that the bps_error_log_location DB option is not blank otherwise blank rows would be created.
	if ( ! preg_match( $LogsExcludePath, $phpELogExclude, $matches ) && $ELogExcludeDB == '' && $phpELogExclude != '' ) {
		$QExcludeInsertRows = $wpdb->insert( $Etable_name, array( 'time' => current_time('mysql'), 'arq_exclude_source' => $phpELogExclude ) );
	}
	// if the error log path DOES contain bps-backups/logs in the ARQ Exclude DB Table then delete the DB Row
	if ( preg_match( $LogsExcludePath, $phpELogExclude, $matches ) ) {
		$bps_delete_row = $wpdb->query( $wpdb->prepare( "DELETE FROM $Etable_name WHERE arq_exclude_source = %s", $phpELogExclude));
	}
	
	// Copy & Touch master backup class.php file - overwrite class.php and synchronize last modifed time
	// The ARQ Cron will not run if the timestamps do not match. Does not need to be GMT time
	$bpsClassFile = WP_PLUGIN_DIR . '/bulletproof-security/includes/class.php';
	$bpsClassFileARQMB = WP_CONTENT_DIR . '/bps-backup/master-backups/class.php';
	$bpsClassFileARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/plugins/bulletproof-security/includes/class.php';
	
	if ( file_exists($bpsClassFileARQMB) && filemtime($bpsClassFileARQMB) != filemtime($bpsClassFile) ) {
		
		@copy($bpsClassFileARQMB, $bpsClassFile);
		@copy($bpsClassFileARQMB, $bpsClassFileARQ);
		@touch($bpsClassFile);
		@touch($bpsClassFileARQMB);
	}

// Whitelist BPS DB options: total 43 
register_setting('bulletproof_security_options', 'bulletproof_security_options', 'bulletproof_security_options_validate');
register_setting('bulletproof_security_options2', 'bulletproof_security_options2', 'bulletproof_security_options_validate2');
register_setting('bulletproof_security_options_GMT', 'bulletproof_security_options_GMT', 'bulletproof_security_options_validate_GMT');
register_setting('bulletproof_security_options_ARCM', 'bulletproof_security_options_ARCM', 'bulletproof_security_options_validate_ARCM');
register_setting('bulletproof_security_options_DBM_log', 'bulletproof_security_options_DBM_log', 'bulletproof_security_options_validate_DBM_log');
register_setting('bulletproof_security_options_DBB_log', 'bulletproof_security_options_DBB_log', 'bulletproof_security_options_validate_DBB_log');
register_setting('bulletproof_security_options_ARCM_log', 'bulletproof_security_options_ARCM_log', 'bulletproof_security_options_validate_ARCM_log');
register_setting('bulletproof_security_options_autolock', 'bulletproof_security_options_autolock', 'bulletproof_security_options_validate_autolock');
register_setting('bulletproof_security_options_b64_tools', 'bulletproof_security_options_b64_tools', 'bulletproof_security_options_validate_b64_tools');
register_setting('bulletproof_security_options_pfirewall', 'bulletproof_security_options_pfirewall', 'bulletproof_security_options_validate_pfirewall');
register_setting('bulletproof_security_options_customcode', 'bulletproof_security_options_customcode', 'bulletproof_security_options_validate_customcode');
register_setting('bulletproof_security_options_wizard_curl', 'bulletproof_security_options_wizard_curl', 'bulletproof_security_options_validate_wizard_curl');
register_setting('bulletproof_security_options_Security_log', 'bulletproof_security_options_Security_log', 'bulletproof_security_options_validate_Security_log');
register_setting('bulletproof_security_options_pfw_autopilot', 'bulletproof_security_options_pfw_autopilot', 'bulletproof_security_options_validate_pfw_autopilot');
register_setting('bulletproof_security_options_upgrade_email', 'bulletproof_security_options_upgrade_email', 'bulletproof_security_options_validate_upgrade_email');
register_setting('bulletproof_security_options_exclude_folder', 'bulletproof_security_options_exclude_folder', 'bulletproof_security_options_validate_exclude_folder');
register_setting('bulletproof_security_options_login_security', 'bulletproof_security_options_login_security', 'bulletproof_security_options_validate_login_security');
register_setting('bulletproof_security_options_pfirewall_roles', 'bulletproof_security_options_pfirewall_roles', 'bulletproof_security_options_validate_pfirewall_roles');
register_setting('bulletproof_security_options_preinstallation', 'bulletproof_security_options_preinstallation', 'bulletproof_security_options_validate_preinstallation');
register_setting('bulletproof_security_options_login_security_jtc', 'bulletproof_security_options_login_security_jtc', 'bulletproof_security_options_validate_login_security_jtc');
register_setting('bulletproof_security_options_setup_wizard_flock', 'bulletproof_security_options_setup_wizard_flock', 'bulletproof_security_options_validate_setup_wizard_flock');	
register_setting('bulletproof_security_options_pfirewall_allow', 'bulletproof_security_options_pfirewall_allow', 'bulletproof_security_options_validate_pfirewall_allow');
register_setting('bulletproof_security_options_upgrade_notice', 'bulletproof_security_options_upgrade_notice', 'bulletproof_security_options_validate_upgrade_notice');
register_setting('bulletproof_security_options_customcode_WPA', 'bulletproof_security_options_customcode_WPA', 'bulletproof_security_options_validate_customcode_WPA');
register_setting('bulletproof_security_options_wp_autoupdate', 'bulletproof_security_options_wp_autoupdate', 'bulletproof_security_options_validate_wp_autoupdate');
register_setting('bulletproof_security_options_login_alerts', 'bulletproof_security_options_login_alerts', 'bulletproof_security_options_validate_login_alerts');
register_setting('bulletproof_security_options_htaccess_res', 'bulletproof_security_options_htaccess_res', 'bulletproof_security_options_validate_htaccess_res');
register_setting('bulletproof_security_options_ARQ_upgrade', 'bulletproof_security_options_ARQ_upgrade', 'bulletproof_security_options_validate_ARQ_upgrade');
register_setting('bulletproof_security_options_db_monitor', 'bulletproof_security_options_db_monitor', 'bulletproof_security_options_validate_db_monitor');
register_setting('bulletproof_security_options_maint_mode', 'bulletproof_security_options_maint_mode', 'bulletproof_security_options_validate_maint_mode');
register_setting('bulletproof_security_options_theme_skin', 'bulletproof_security_options_theme_skin', 'bulletproof_security_options_validate_theme_skin');
register_setting('bulletproof_security_options_activation', 'bulletproof_security_options_activation', 'bulletproof_security_options_validate_activation');
register_setting('bulletproof_security_options_wp_version', 'bulletproof_security_options_wp_version', 'bulletproof_security_options_validate_wp_version');
register_setting('bulletproof_security_options_db_backup', 'bulletproof_security_options_db_backup', 'bulletproof_security_options_validate_db_backup');
register_setting('bulletproof_security_options_wpt_nodes', 'bulletproof_security_options_wpt_nodes', 'bulletproof_security_options_validate_wpt_nodes');
register_setting('bulletproof_security_options_spinner', 'bulletproof_security_options_spinner', 'bulletproof_security_options_validate_spinner');
register_setting('bulletproof_security_options_monitor', 'bulletproof_security_options_monitor', 'bulletproof_security_options_validate_monitor');
register_setting('bulletproof_security_options_mynotes', 'bulletproof_security_options_mynotes', 'bulletproof_security_options_validate_mynotes');
register_setting('bulletproof_security_options_iniSet', 'bulletproof_security_options_iniSet', 'bulletproof_security_options_validate_iniSet');
register_setting('bulletproof_security_options_flock', 'bulletproof_security_options_flock', 'bulletproof_security_options_validate_flock');
register_setting('bulletproof_security_options_email', 'bulletproof_security_options_email', 'bulletproof_security_options_validate_email');
register_setting('bulletproof_security_options_elog', 'bulletproof_security_options_elog', 'bulletproof_security_options_validate_elog');
register_setting('bulletproof_security_options_GDMW', 'bulletproof_security_options_GDMW', 'bulletproof_security_options_validate_GDMW');

	// Create BPS Backup Folder
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/', 0755 );
	}
	
	// Create master backups folder
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/master-backups' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/master-backups', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/master-backups/', 0755 );
	}

	// Create the BPS Backup folder Deny all .htaccess file - recursive will protect all /bps-backup subfolders
	// Create /master-backups .htaccess file for "allow from" download IP address writing
	$bps_denyall_htaccess = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/deny-all.htaccess';
	$bps_ARHtaccess = WP_CONTENT_DIR . '/bps-backup/.htaccess';
	$bps_ARHtaccessM = WP_CONTENT_DIR . '/bps-backup/master-backups/.htaccess';
	
	if ( ! file_exists($bps_ARHtaccess) ) {
		@copy($bps_denyall_htaccess, $bps_ARHtaccess);
	}
	if ( ! file_exists($bps_ARHtaccessM) ) {
		@copy($bps_denyall_htaccess, $bps_ARHtaccessM);
	}

	// Create autorestore folder
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/', 0755 );
	}
	
	// Create quarantine folder
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/quarantine' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/quarantine', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/quarantine/', 0755 );
	}
	
	// Create logs folder
	if ( ! is_dir( WP_CONTENT_DIR . '/bps-backup/logs' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/logs', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/logs/', 0755 );
	}

	// Create backups folder with randomly generated folder name, create the db-diff folder & save the backups folder name to the DB
	bpsPro_create_db_backup_folder();

	// Create AutoRestore/Quarantine - ARQ Log
	$bps_AutoRestore_Log = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/autorestore_log.txt';
	$bps_AutoRestore_LogARQ = WP_CONTENT_DIR . '/bps-backup/logs/autorestore_log.txt';
	
	if ( ! file_exists($bps_AutoRestore_LogARQ) ) {
		@copy($bps_AutoRestore_Log, $bps_AutoRestore_LogARQ);
	}	
	
	// Create Pro-Tools B64.zip and bps_b64_decode.txt in /logs
	$bpsB64TXT = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/bps_b64_decode.txt';
	$bpsB64Zip = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/B64.zip';	
	$bpsB64TXTARQ = WP_CONTENT_DIR . '/bps-backup/logs/bps_b64_decode.txt';
	$bpsB64ZipARQ = WP_CONTENT_DIR . '/bps-backup/logs/B64.zip';	
	
	if ( ! file_exists($bpsB64TXTARQ) ) {
		@copy($bpsB64TXT, $bpsB64TXTARQ);
	}
	if ( ! file_exists($bpsB64ZipARQ) ) {
		@copy($bpsB64Zip, $bpsB64ZipARQ);
	}	

	// Automatically delete the Pro-Tools B64 Decoder/Encoder files
	bpsPro_delete_b64_tools();

	// Create the String Replacer log file in /logs
	$bpsStringReplaceLog = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/string_replacer_log.txt';
	$bpsStringReplaceLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/string_replacer_log.txt';	
	
	if ( ! file_exists($bpsStringReplaceLogARQ) ) {
		@copy($bpsStringReplaceLog, $bpsStringReplaceLogARQ);
	}	
	
	// Create the Security / HTTP error log in /logs
	$bpsProLog = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/http_error_log.txt';
	$bpsProLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
	
	if ( ! file_exists($bpsProLogARQ) ) {
		@copy($bpsProLog, $bpsProLogARQ);
	}		

	// Create the PHP error log in /logs - the PHP Error Log file location can be changed by users, but create this file by default
	$bpsProPHPELog = WP_PLUGIN_DIR . '/bulletproof-security/admin/php/bps_php_error_master.log';
	$bpsProPHPELogARQ = WP_CONTENT_DIR . '/bps-backup/logs/bps_php_error.log';
	
	if ( ! file_exists($bpsProPHPELogARQ) ) {
		@copy($bpsProPHPELog, $bpsProPHPELogARQ);
	}		

	// Create the DB Monitor log in /logs
	$bpsProDBMLog = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_monitor_log.txt';
	$bpsProDBMLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/db_monitor_log.txt';
	
	if ( ! file_exists($bpsProDBMLogARQ) ) {
		@copy($bpsProDBMLog, $bpsProDBMLogARQ);
	}

	// Create the DB Backup log in /logs
	$bpsProDBBLog = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/db_backup_log.txt';
	$bpsProDBBLogARQ = WP_CONTENT_DIR . '/bps-backup/logs/db_backup_log.txt';
	
	if ( ! file_exists($bpsProDBBLogARQ) ) {
		@copy($bpsProDBBLog, $bpsProDBBLogARQ);
	}

	// Copy and rename the blank.txt file to /master-backups - used for resetting the Login Security alert/timestamp
	$BPSblank = WP_PLUGIN_DIR . '/bulletproof-security/admin/htaccess/blank.txt';
	$SecurityLogReset = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
	
	if ( ! file_exists($SecurityLogReset) ) {
		@copy($BPSblank, $SecurityLogReset);
	}
}

// BPS Menus
function bulletproof_security_admin_menu() {
global $blog_id;

	if ( current_user_can('manage_options') ) {
	
	// Network / Multisite display partial BPS Pro menus
	if ( is_multisite() && $blog_id != 1 ) {

	add_menu_page(__('BulletProof Pro Security Settings', 'bulletproof-security'), __('BPS Pro', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/login/login.php', '', plugins_url('bulletproof-security/admin/images/bps-icon-small.png') );
	add_submenu_page('bulletproof-security/admin/login/login.php', __('Login Security ~ JTC Anti-Spam', 'bulletproof-security'), __('Login Security', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/login/login.php' );
	add_submenu_page('bulletproof-security/admin/login/login.php', __('Login Security ~ JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'), __('JTC Anti-Spam<br>Anti-Hacker', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2' );
	
	// Do not display the Maintenance Mode menu for GDMW hosted sites
	$GDMW_options = get_option('bulletproof_security_options_GDMW');
	if ( $GDMW_options['bps_gdmw_hosting'] != 'yes' ) {	
	add_submenu_page('bulletproof-security/admin/login/login.php', __('Maintenance Mode', 'bulletproof-security'), __('Maintenance Mode', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/maintenance/maintenance.php' );
	}
	
	add_submenu_page('bulletproof-security/admin/login/login.php', __('System Info', 'bulletproof-security'), __('System Info', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/system-info/system-info.php' );
	add_submenu_page('bulletproof-security/admin/login/login.php', __('UI|UX|Theme Skin|Processing Spinner|WP Toolbar', 'bulletproof-security'), __('UI|UX|Theme Skin<br>Processing Spinner<br>WP Toolbar', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/theme-skin/theme-skin.php' );
	add_submenu_page('bulletproof-security/admin/login/login.php', __('Whats New ~ New Features in BPS Pro and General Help Info', 'bulletproof-security'), __('Whats New', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/whatsnew/whatsnew.php' );
	
		} else {

	add_menu_page(__('BulletProof Pro Security Settings', 'bulletproof-security'), __('BPS Pro', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/core/options.php', '', plugins_url('bulletproof-security/admin/images/bps-icon-small.png'));
	add_submenu_page('bulletproof-security/admin/core/options.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('B-Core', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/core/options.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('P-Security ~ BPS Pro php.ini Security and Performance', 'bulletproof-security'), __('P-Security', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/php/php-options.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('S-Monitor ~ BPS Pro Security Monitor and Alerting', 'bulletproof-security'), __('S-Monitor', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/monitor/monitor.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('Pro-Tools ~ BPS Pro Tools', 'bulletproof-security'), __('Pro-Tools', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/tools/tools.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('AutoRestore ~ BPS Pro Automatic File Restore', 'bulletproof-security'), __('AutoRestore', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/autorestore/autorestore.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('Quarantine ~ BPS Pro Automatic File Quarantine', 'bulletproof-security'), __('Quarantine', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/quarantine/quarantine.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('Plugin Firewall', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('Uploads Anti-Exploit Guard (UAEG)', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('Login Security ~ JTC Anti-Spam', 'bulletproof-security'), __('Login Security', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/login/login.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('Login Security ~ JTC Anti-Spam|Anti-Hacker', 'bulletproof-security'), __('JTC Anti-Spam<br>Anti-Hacker', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('DB Backup', 'bulletproof-security'), __('DB Backup', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/db-backup-security/db-backup-security.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('DB Monitor', 'bulletproof-security'), __('DB Monitor', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/db-monitor/db-monitor.php' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('htaccess File Editor', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-6' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('Custom Code', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-7' );
	add_submenu_page('bulletproof-security/admin/core/options.php', __('F-Lock ~ BPS Pro File Lock', 'bulletproof-security'), __('F-Lock', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/lock/flock.php' );

	// Do not display the Maintenance Mode menu for GDMW hosted sites
	$GDMW_options = get_option('bulletproof_security_options_GDMW');
	if ( $GDMW_options['bps_gdmw_hosting'] != 'yes' ) {
	add_submenu_page('bulletproof-security/admin/core/options.php', __('Maintenance Mode', 'bulletproof-security'), __('Maintenance Mode', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/maintenance/maintenance.php' );
	}

	add_menu_page(__('Logs & Info', 'bulletproof-security'), __('Logs & Info', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/security-log/security-log.php', '', plugins_url('bulletproof-security/admin/images/bps-icon-small.png'));	
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('Security Log', 'bulletproof-security'), __('Security Log', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/security-log/security-log.php' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('P-Security ~ BPS Pro php.ini Security and Performance', 'bulletproof-security'), __('PHP Error Log', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('Quarantine ~ BPS Pro Automatic File Quarantine', 'bulletproof-security'), __('Quarantine Log', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/quarantine/quarantine.php#bps-tabs-2' );	
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('DB Backup', 'bulletproof-security'), __('DB Backup Log', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php#bps-tabs-2' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('DB Monitor', 'bulletproof-security'), __('DB Monitor Log', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-2' );	
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('System Info', 'bulletproof-security'), __('System Info', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/system-info/system-info.php' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('P-Security ~ BPS Pro php.ini Security and Performance', 'bulletproof-security'), __('PHP Info', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('DB Monitor', 'bulletproof-security'), __('DB Status & Info', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/db-monitor/db-monitor.php#bps-tabs-4' );		
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('B-Core ~ BPS Pro htaccess Core', 'bulletproof-security'), __('Security Status', 'bulletproof-security'), 'manage_options', 'admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2' );
	add_submenu_page('bulletproof-security/admin/security-log/security-log.php', __('Whats New ~ New Features in BPS Pro and General Help Info', 'bulletproof-security'), __('Whats New', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/whatsnew/whatsnew.php' );
	
	// Setup Menu
	add_menu_page(__('Setup', 'bulletproof-security'), __('Setup', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/wizard/wizard.php', '', plugins_url('bulletproof-security/admin/images/bps-icon-small.png'));
	add_submenu_page('bulletproof-security/admin/wizard/wizard.php', __('Setup Wizard', 'bulletproof-security'), __('Setup Wizard', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/wizard/wizard.php' );
	add_submenu_page('bulletproof-security/admin/wizard/wizard.php', __('Activation', 'bulletproof-security'), __('Activation', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/activation/activation.php' );
	add_submenu_page('bulletproof-security/admin/wizard/wizard.php', __('Upload Zip Install', 'bulletproof-security'), __('Upload Zip Install', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/install/installation.php' );
	add_submenu_page('bulletproof-security/admin/wizard/wizard.php', __('UI|UX|Theme Skin|Processing Spinner|WP Toolbar', 'bulletproof-security'), __('UI|UX|Theme Skin<br>Processing Spinner<br>WP Toolbar', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/theme-skin/theme-skin.php' );	
	
	// Dev Testing page
	//add_submenu_page('bulletproof-security/admin/wizard/wizard.php', __('UI|UX Testing', 'bulletproof-security'), __('UI|UX Testing', 'bulletproof-security'), 'manage_options', 'bulletproof-security/admin/test/ux.php' );	
	}
	}
}

add_action( 'admin_enqueue_scripts', 'bpsPro_register_enqueue_scripts_styles' );

// Register scripts and styles, Enqueue scripts and styles, Dequeue any plugin or theme scripts and styles loading in BPS plugin pages
function bpsPro_register_enqueue_scripts_styles() {
global $wp_scripts, $wp_styles, $bulletproof_security, $wp_version;

	// Register & Load BPS scripts and styles on BPS plugin pages ONLY
	if ( preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches) ) {

		$UIoptions = get_option('bulletproof_security_options_theme_skin');

		// Register BPS Scripts
		wp_register_script( 'bps-tabs', plugins_url( '/bulletproof-security/admin/js/bps-tabs.js' ) );
		wp_register_script( 'bps-dialog', plugins_url( '/bulletproof-security/admin/js/bps-dialog.js' ) );	
		wp_register_script( 'bps-accordion', plugins_url( '/bulletproof-security/admin/js/bps-accordion.js' ) );
	
		// Register BPS Styles
		if ( version_compare( $wp_version, '3.8', '>=' ) ) {
		
			switch ( $UIoptions['bps_ui_theme_skin'] ) {
    			case 'blue':
					wp_register_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-blue-theme.css'));
				break;
    			case 'grey':
					wp_register_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-grey-theme.css'));
				break;
    			case 'black':
					wp_register_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-black-theme.css'));
				break;
			default: 		
					wp_register_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-blue-theme.css'));		
			}
		
		} else {
		
			wp_register_style('bps-css', plugins_url('/bulletproof-security/admin/css/bps-blue-theme-old-wp-versions.css'));
		}

		// Enqueue BPS scripts & script dependencies
		wp_enqueue_script( 'jquery-ui-tabs', plugins_url( '/bulletproof-security/admin/js/bps-tabs.js' ), array( 'jquery' ) );
		wp_enqueue_script( 'jquery-ui-dialog', plugins_url( '/bulletproof-security/admin/js/bps-dialog.js' ), array( 'jquery' ) );
		wp_enqueue_script( 'jquery-effects-blind', plugins_url( '/bulletproof-security/admin/js/bps-dialog.js.js' ), array( 'jquery-effects-core' ) );		
		wp_enqueue_script( 'jquery-effects-explode', plugins_url( '/bulletproof-security/admin/js/bps-dialog.js.js' ), array( 'jquery-effects-core' ) );	
		wp_enqueue_script( 'jquery-ui-accordion', plugins_url( '/bulletproof-security/admin/js/bps-accordion.js' ), array( 'jquery' ) );
		wp_enqueue_script( 'bps-tabs' );
		wp_enqueue_script( 'bps-dialog' );
		wp_enqueue_script( 'bps-accordion' );	

		// Enqueue BPS stylesheets
		if ( version_compare( $wp_version, '3.8', '>=' ) ) {
		
			switch ( $UIoptions['bps_ui_theme_skin'] ) {
    			case 'blue':
					wp_enqueue_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-blue-theme.css'));
				break;
    			case 'grey':
					wp_enqueue_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-grey-theme.css'));;
				break;
    			case 'black':
					wp_enqueue_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-black-theme.css'));
				break;
			default: 		
					wp_enqueue_style('bps-css-38', plugins_url('/bulletproof-security/admin/css/bps-blue-theme.css'));		
			}
		
		} else {
		
			wp_enqueue_style('bps-css', plugins_url('/bulletproof-security/admin/css/bps-blue-theme-old-wp-versions.css'));
		}	

		// Dequeue any other plugin or theme scripts that should not be loading on BPS plugin pages
		$script_handles = array( 'bps-tabs', 'bps-dialog', 'bps-accordion', 'admin-bar', 'jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-dialog', 'jquery-ui-accordion', 'jquery-effects-core', 'jquery-effects-blind', 'jquery-effects-explode', 'common', 'utils', 'svg-painter', 'wp-auth-check', 'debug-bar' );

		$style_handles = array( 'bps-css', 'bps-css-38', 'admin-bar', 'colors', 'ie', 'wp-auth-check', 'debug-bar' );

		foreach( $wp_scripts->queue as $handle ) {
		
			if ( ! in_array( $handle, $script_handles ) ) {
				wp_dequeue_script( $handle );
        		// uncomment line below to see all the script handles that are being blocked on BPS plugin pages
				//echo 'Script Dequeued: ' . $handle . ' | ';
			}
		}
	
		foreach( $wp_styles->queue as $handle ) {
        	
			if ( ! in_array( $handle, $style_handles ) ) {
				wp_dequeue_style( $handle );
				// uncomment line below to see all the style handles that are being blocked on BPS plugin pages
				//echo 'Style Dequeued: ' . $handle . ' | ';
			}	
		}
	}
}

$bpspro_url = 'http://api.ait-pro.com/';

add_action( 'wp_before_admin_bar_render', 'bpsPro_remove_non_wp_nodes_from_toolbar' );

// Removes any/all additional WP Toolbar nodes / menu items added by other plugins and themes
// in BPS plugin pages ONLY. Does NOT remove any of the default WP Toolbar nodes.
// Note: This file is loaded in the WP Dashboard. This function is ONLY processed in BPS plugin pages.
function bpsPro_remove_non_wp_nodes_from_toolbar() {
	
	if ( preg_match( '/page=bulletproof-security/', esc_html($_SERVER['REQUEST_URI']), $matches ) ) {
	
		$UIWPToptions = get_option('bulletproof_security_options_wpt_nodes');
	
		if ( $UIWPToptions['bps_wpt_nodes'] != 'allnodes' ) {
			
			global $wp_admin_bar;
			$all_toolbar_nodes = $wp_admin_bar->get_nodes();

			if ( $all_toolbar_nodes ) {
		
				if ( ! is_multisite() ) {
				
					$wp_default_nodes = array( 'user-actions', 'user-info', 'edit-profile', 'logout', 'menu-toggle', 'my-account', 'wp-logo', 'about', 'wporg', 'documentation', 'support-forums', 'feedback', 'site-name', 'view-site', 'updates', 'comments', 'new-content', 'new-post', 'new-media', 'new-page', 'new-user', 'top-secondary', 'wp-logo-external' );
				
					foreach ( $all_toolbar_nodes as $node ) {
						// For Testing: echo '<br>'; print_r($node->id); 
					
						if ( ! in_array( $node->id, $wp_default_nodes ) ) {
							// For Testing: echo '<br>'; print_r($node->id);
							$wp_admin_bar->remove_node( $node->id );	
						}
					}				
				
				
				} else {
				
					$wp_default_nodes = array( 'user-actions', 'user-info', 'edit-profile', 'logout', 'menu-toggle', 'my-account', 'wp-logo', 'about', 'wporg', 'documentation', 'support-forums', 'feedback', 'site-name', 'view-site', 'updates', 'comments', 'new-content', 'new-post', 'new-media', 'new-page', 'new-user', 'top-secondary', 'wp-logo-external', 'my-sites', 'my-sites-super-admin', 'network-admin', 'network-admin-d', 'network-admin-s', 'network-admin-u', 'network-admin-t', 'network-admin-p', 'my-sites-list', 'edit-site' );
				
					foreach ( $all_toolbar_nodes as $node ) {
						// For Testing: echo '<br>'; print_r($node->id); 
					
						if ( ! in_array( $node->id, $wp_default_nodes ) && ! preg_match( '/blog-[0-9]/', $node->id, $matches ) ) {
							// For Testing: echo '<br>'; print_r($node->id);
							$wp_admin_bar->remove_node( $node->id );	
						}
					}
				}
			}
		}
	}
}

// Create Backup folder with randomly generated folder name and update DB with folder name
function bpsPro_create_db_backup_folder() {
$options = get_option('bulletproof_security_options_db_backup');

	if ( $options['bps_db_backup_folder'] && $options['bps_db_backup_folder'] != '' || $_POST['Submit-DBB-Reset'] == true ) {
		return;	
	}
	
	$source = WP_CONTENT_DIR . '/bps-backup';

	if ( is_dir($source) ) {
		
		$iterator = new DirectoryIterator($source);
			
		foreach ( $iterator as $folder ) {
			if ( $folder->isDir() && !$folder->isDot() && preg_match( '/backups_[a-zA-Z0-9]/', $folder ) ) {
				return;
			}
		}
				
		$str = '1234567890abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVWXYZU3xt8Eb9Qw422hG0yv1LCT2Pzub7';
		$folder_obs = substr( str_shuffle($str), 0, 15 );
		@mkdir( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs, 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs . '/', 0755 );
				
		@mkdir( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs . '/db-diff', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs . '/db-diff/', 0755 );

		$dbb_options = 'bulletproof_security_options_db_backup';
		$bps_db_backup_folder = addslashes( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs );
		//$bps_db_backup_download_link = ( WP_CONTENT_DIR . '/bps-backup/backups_' . $folder_obs );
		$bps_db_backup_download_link = content_url( '/bps-backup/backups_' ) . $folder_obs . '/';
		
		$DBB_Options = array(
		'bps_db_backup' 						=> 'On', 
		'bps_db_backup_description' 			=> '', 
		'bps_db_backup_folder' 					=> $bps_db_backup_folder, 
		'bps_db_backup_download_link' 			=> $bps_db_backup_download_link, 
		'bps_db_backup_job_type' 				=> '', 
		'bps_db_backup_frequency' 				=> '', 		 
		'bps_db_backup_start_time_hour' 		=> '', 
		'bps_db_backup_start_time_weekday' 		=> '', 
		'bps_db_backup_start_time_month_date' 	=> '', 
		'bps_db_backup_email_zip' 				=> '', 
		'bps_db_backup_delete' 					=> '', 
		'bps_db_backup_status_display' 			=> 'No DB Backups' 
		);	
	
		if ( ! get_option( $dbb_options ) ) {	
		
			foreach( $DBB_Options as $key => $value ) {
				update_option('bulletproof_security_options_db_backup', $DBB_Options);
			}
			
		} else {

			foreach( $DBB_Options as $key => $value ) {
				update_option('bulletproof_security_options_db_backup', $DBB_Options);
			}	
		}			
	}
}

// Automatically delete the Pro-Tools B64 Decoder/Encoder files
function bpsPro_delete_b64_tools() {
$options = get_option('bulletproof_security_options_b64_tools');  
$bps_b64_online_decoder = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-online-decoder.php';	
$bps_b64_offline_decoder = WP_PLUGIN_DIR . '/bulletproof-security/admin/tools/b64-offline-decoder.php';	

	if ( $options['bps_b64_offline_decoder'] == 'delete' && file_exists($bps_b64_offline_decoder) ) {
		unlink($bps_b64_offline_decoder);	
	}
	
	if ( $options['bps_b64_online_decoder'] == 'delete' && file_exists($bps_b64_online_decoder) ) {
		unlink($bps_b64_online_decoder);	
	}
}

function bulletproof_security_install() {
global $bulletproof_security, $bpspro_version;
$previous_install = get_option('bulletproof_security_options');
	
	if ( $previous_install ) {
	if ( version_compare($previous_install['version'], $bpspro_version, '<') )
		delete_transient( 'bulletproof-security_info' );
	}
}

// On BPS Plugin Deactivation: remove scheduled Cron jobs except for DB Backup and
// delete DB options: F-Lock, AutoRestore/Quarantine
function bulletproof_security_deactivation() {
	//wp_clear_scheduled_hook('bpsPro_DBB_check');	
	wp_clear_scheduled_hook('bpsPro_php_elog_check');
	wp_clear_scheduled_hook('bpsPro_update_check');
	wp_clear_scheduled_hook('bpsPro_email_log_files');	
	wp_clear_scheduled_hook('bpsPro_PFWAP_check');	
	wp_clear_scheduled_hook('bpsPro_DBM_check');
	wp_clear_scheduled_hook('bpsPro_security_log_check');	

	delete_option('bulletproof_security_options_flock');
	delete_option('bulletproof_security_options_ARCM');
}

// Root and wp-admin .htaccess files are backed up to the /bps-backup folder before deleting them.
// The only thing that is left behind is the /bps-backup folder, which requires manual deletion.
function bulletproof_security_uninstall() {
global $wpdb, $current_user;
$user_id = $current_user->ID;

require_once( ABSPATH . 'wp-admin/includes/plugin.php');

$Atable_name = $wpdb->prefix . "bpspro_arq_add";
$Qtable_name = $wpdb->prefix . "bpspro_arq_quarantine";
$Etable_name = $wpdb->prefix . "bpspro_arq_exclude";
$Ptable_name = $wpdb->prefix . "bpspro_pfw_override";
$Stable_name = $wpdb->prefix . "bpspro_seclog_ignore";
$Ltable_name = $wpdb->prefix . "bpspro_login_security";
$DMtable_name = $wpdb->prefix . "bpspro_dbm_monitor";
$DBBtable_name = $wpdb->prefix . "bpspro_db_backup";
$bps_Uploads_Dir = wp_upload_dir();
$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder
$PluginsHtaccess = WP_PLUGIN_DIR . '/.htaccess';
$UploadsHtaccessBlogsDir = ABSPATH . @UPLOADBLOGSDIR . '/.htaccess'; // for MU Only - is the /blogs.dir folder
$RootHtaccess = ABSPATH . '.htaccess';
$RootHtaccessBackup = WP_CONTENT_DIR . '/bps-backup/master-backups/root.htaccess';
$wpadminHtaccess = ABSPATH . 'wp-admin/.htaccess';
$wpadminHtaccessBackup = WP_CONTENT_DIR . '/bps-backup/master-backups/wpadmin.htaccess';
//$options = get_option('bulletproof_security_options');

	if ( file_exists($RootHtaccess) ) {
		copy($RootHtaccess, $RootHtaccessBackup);
	}
	if ( file_exists($wpadminHtaccess) ) {
		copy($wpadminHtaccess, $wpadminHtaccessBackup);
	}

	delete_option('bulletproof_security_options');
	delete_option('bulletproof_security_options2');
	delete_option('bulletproof_security_options_elog');
	delete_option('bulletproof_security_options_iniSet');
	delete_option('bulletproof_security_options_ARCM_log');
	delete_option('bulletproof_security_options_exclude_folder');	
	delete_option('bulletproof_security_options_customcode');
	delete_option('bulletproof_security_options_customcode_WPA');
	delete_option('bulletproof_security_options_maint');
	delete_option('bulletproof_security_options_maint_mode');
	delete_option('bulletproof_security_options_mynotes');
	delete_option('bulletproof_security_options_activation');
	delete_option('bulletproof_security_options_monitor');
	delete_option('bulletproof_security_options_email');
	delete_option('bulletproof_security_options_autolock');
	delete_option('bulletproof_security_options_pfirewall');
	delete_option('bulletproof_security_options_pfirewall_roles');
	delete_option('bulletproof_security_options_pfirewall_allow');
	delete_option('bulletproof_security_options_pfirewall_TMode');
	delete_option('bulletproof_security_options_Security_log');
	delete_option('bulletproof_security_options_login_security');
	delete_option('bulletproof_security_options_login_alerts');
	delete_option('bulletproof_security_options_preinstallation');
	delete_option('bulletproof_security_options_setup_wizard_flock');
	delete_option('bulletproof_security_options_upgrade_notice');	
	delete_option('bulletproof_security_arq_db_version');
	delete_option('bulletproof_security_options_login_security_jtc'); 
	delete_option('bulletproof_security_options_wp_version');  
	delete_option('bulletproof_security_options_wp_autoupdate');
	delete_option('bulletproof_security_options_upgrade_email');
	delete_option('bulletproof_security_options_theme_skin');
	delete_option('bulletproof_security_options_db_backup');
	delete_option('bulletproof_security_options_db_monitor');
	delete_option('bulletproof_security_options_DBM_log');
	delete_option('bulletproof_security_options_DBB_log');
	delete_option('bulletproof_security_options_wizard_curl');
	delete_option('bulletproof_security_options_pfirewall_plugins');  
	delete_option('bulletproof_security_options_GMT');
	delete_option('bulletproof_security_options_htaccess_res'); 
	delete_option('bulletproof_security_options_net_correction');
	delete_option('bulletproof_security_options_GDMW');
	delete_option('bulletproof_security_options_b64_tools');
	delete_option('bulletproof_security_options_pfw_autopilot');
	delete_option('bulletproof_security_options_spinner');
	delete_option('bulletproof_security_options_wpt_nodes');
	delete_option('bulletproof_security_options_ARQ_upgrade');
	
	$wpdb->query("DROP TABLE IF EXISTS $Atable_name");
	$wpdb->query("DROP TABLE IF EXISTS $Qtable_name");
	$wpdb->query("DROP TABLE IF EXISTS $Etable_name");
	$wpdb->query("DROP TABLE IF EXISTS $Ptable_name");
	$wpdb->query("DROP TABLE IF EXISTS $Stable_name");
	$wpdb->query("DROP TABLE IF EXISTS $Ltable_name");
	$wpdb->query("DROP TABLE IF EXISTS $DMtable_name");
	$wpdb->query("DROP TABLE IF EXISTS $DBBtable_name");
	
	delete_user_meta($user_id, 'bps_ignore_new_feature_notice');
	delete_user_meta($user_id, 'bps_ignore_iis_notice');
	delete_user_meta($user_id, 'bps_ignore_public_username_notice');
	delete_user_meta($user_id, 'bps_ignore_PFW_roles_notice');
	delete_user_meta($user_id, 'bps_ignore_sucuri_notice');
	delete_user_meta($user_id, 'bps_ignore_BLC_notice');
	delete_user_meta($user_id, 'bps_ignore_PhpiniHandler_notice');
	delete_user_meta($user_id, 'bps_ignore_Permalinks_notice');
	delete_user_meta($user_id, 'bps_ignore_JTC_notice');
	delete_user_meta($user_id, 'bps_brute_force_login_protection_notice');
	delete_user_meta($user_id, 'bps_speed_boost_cache_notice');
	delete_user_meta($user_id, 'bps_xmlrpc_ddos_notice');
	delete_user_meta($user_id, 'bps_author_enumeration_notice');
	delete_user_meta($user_id, 'bps_hud_NetworkActivationAlert_notice');
	delete_user_meta($user_id, 'bps_ignore_wpfirewall2_notice');
	delete_user_meta($user_id, 'bpsPro_pfw_new_plugins_notice');
	delete_user_meta($user_id, 'bps_ignore_PFW_litespeed_notice');
	delete_user_meta($user_id, 'bps_referer_spam_notice');
	delete_user_meta($user_id, 'bps_sniff_driveby_notice');
	delete_user_meta($user_id, 'bps_iframe_clickjack_notice');
	
	@unlink($PluginsHtaccess);
	@unlink($UploadsHtaccess);
	@unlink($UploadsHtaccessBlogsDir);
	@unlink($wpadminHtaccess);
	
	if ( @unlink($RootHtaccess) || ! file_exists($RootHtaccess) ) {
		flush_rewrite_rules();
	}
}

// P-Security File Manager 
function bulletproof_security_options_validate($input) {  
	$options = get_option('bulletproof_security_options');  
	$options['bpsinifiles_input_1'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_1']));
	$options['bpsinifiles_input_2'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_2']));
	$options['bpsinifiles_input_3'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_3']));
	$options['bpsinifiles_input_4'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_4']));
	$options['bpsinifiles_input_5'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_5']));
	$options['bpsinifiles_input_6'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_6']));
	$options['bpsinifiles_input_7'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_7']));
	$options['bpsinifiles_input_8'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_8']));
	$options['bpsinifiles_input_9'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_9']));
	$options['bpsinifiles_input_10'] = trim(wp_filter_nohtml_kses($input['bpsinifiles_input_10']));
	$options['bpsinifiles_input_1_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_1_label']);
	$options['bpsinifiles_input_2_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_2_label']); 
	$options['bpsinifiles_input_3_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_3_label']); 
	$options['bpsinifiles_input_4_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_4_label']);
	$options['bpsinifiles_input_5_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_5_label']);
	$options['bpsinifiles_input_6_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_6_label']); 
	$options['bpsinifiles_input_7_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_7_label']); 
	$options['bpsinifiles_input_8_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_8_label']);
	$options['bpsinifiles_input_9_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_9_label']);
	$options['bpsinifiles_input_10_label'] = wp_filter_nohtml_kses($input['bpsinifiles_input_10_label']);
		
	return $options;  
}

// PHP Error Log Folder Location 
function bulletproof_security_options_validate2($input) {  
	$options = get_option('bulletproof_security_options2');  
	$options['bps_error_log_location'] = trim(wp_filter_nohtml_kses($input['bps_error_log_location']));
		
	return $options;  
}

// PHP Error Log Last Modified Time 
function bulletproof_security_options_validate_elog($input) {  
	$options = get_option('bulletproof_security_options_elog');  
	$options['bps_error_log_date_mod'] = wp_filter_nohtml_kses($input['bps_error_log_date_mod']);
		
	return $options;  
}

// Plugin Firewall: options.php, wizard.php
function bulletproof_security_options_validate_pfirewall($input) {  
	$options = get_option('bulletproof_security_options_pfirewall');  
	$options['bps_pfw_paypal'] = wp_filter_nohtml_kses($input['bps_pfw_paypal']);
	$options['bps_pfw_google'] = wp_filter_nohtml_kses($input['bps_pfw_google']);		
	$options['bps_pfw_amazon'] = wp_filter_nohtml_kses($input['bps_pfw_amazon']);
	$options['bps_pfw_authorizenet'] = wp_filter_nohtml_kses($input['bps_pfw_authorizenet']);
	$options['bps_pfw_whitelist'] = wp_filter_nohtml_kses($input['bps_pfw_whitelist']);	
	
	return $options;  
}

// Plugin Firewall AutoPilot Mode: options.php, wizard.php
function bulletproof_security_options_validate_pfw_autopilot($input) {  
	$options = get_option('bulletproof_security_options_pfw_autopilot');  
	$options['bps_pfw_autopilot_cron'] = wp_filter_nohtml_kses($input['bps_pfw_autopilot_cron']);
	$options['bps_pfw_autopilot_cron_frequency'] = wp_filter_nohtml_kses($input['bps_pfw_autopilot_cron_frequency']);
	$options['bps_pfw_autopilot_cron_end'] = wp_filter_nohtml_kses($input['bps_pfw_autopilot_cron_end']);		
	
	return $options;  
}

// Plugin Firewall Roles
function bulletproof_security_options_validate_pfirewall_roles($input) {  
	$options = get_option('bulletproof_security_options_pfirewall_roles');  
	$options['bps_pfw_administrator'] = wp_filter_nohtml_kses($input['bps_pfw_administrator']);
	$options['bps_pfw_editor'] = wp_filter_nohtml_kses($input['bps_pfw_editor']);
	$options['bps_pfw_author'] = wp_filter_nohtml_kses($input['bps_pfw_author']);		
	$options['bps_pfw_contributor'] = wp_filter_nohtml_kses($input['bps_pfw_contributor']);
	
	return $options;  
}

// Plugin Firewall additional Allow from conditions
function bulletproof_security_options_validate_pfirewall_allow($input) {  
	$options = get_option('bulletproof_security_options_pfirewall_allow');  
	$options['bps_pfw_allow_from'] = wp_filter_nohtml_kses($input['bps_pfw_allow_from']);
	
	return $options;  
}

// Security Log Last Modified Time DB
function bulletproof_security_options_validate_Security_log($input) {  
	$options = get_option('bulletproof_security_options_Security_log');  
	$options['bps_security_log_date_mod'] = wp_filter_nohtml_kses($input['bps_security_log_date_mod']);
		
	return $options;  
}

// Root .htaccess file AutoLock 
function bulletproof_security_options_validate_autolock($input) {  
	$options = get_option('bulletproof_security_options_autolock');  
	$options['bps_root_htaccess_autolock'] = wp_filter_nohtml_kses($input['bps_root_htaccess_autolock']);
		
	return $options;  
}

// P-Security ini_set Options 
function bulletproof_security_options_validate_iniSet($input) {  
	$options = get_option('bulletproof_security_options_iniSet');  
	$options['bps_iniSet_ErrorReporting'] = wp_filter_nohtml_kses($input['bps_iniSet_ErrorReporting']);
	$options['bps_iniSet_LogErrors'] = wp_filter_nohtml_kses($input['bps_iniSet_LogErrors']);
	$options['bps_iniSet_ErrorLog'] = trim(wp_filter_nohtml_kses($input['bps_iniSet_ErrorLog']));
	$options['bps_iniSet_LogErrorsMaxLen'] = trim(wp_filter_nohtml_kses($input['bps_iniSet_LogErrorsMaxLen']));
	$options['bps_iniSet_MemoryLimit'] = trim(wp_filter_nohtml_kses($input['bps_iniSet_MemoryLimit']));
	$options['bps_iniSet_session_cookie_httponly'] = wp_filter_nohtml_kses($input['bps_iniSet_session_cookie_httponly']);	
	$options['bps_iniSet_session_use_only_cookies'] = wp_filter_nohtml_kses($input['bps_iniSet_session_use_only_cookies']);
	$options['bps_iniSet_session_cookie_secure'] = wp_filter_nohtml_kses($input['bps_iniSet_session_cookie_secure']);
	$options['bps_iniSet_IgnoreRepeatedErrors'] = wp_filter_nohtml_kses($input['bps_iniSet_IgnoreRepeatedErrors']);
	$options['bps_iniSet_IgnoreRepeatedSource'] = wp_filter_nohtml_kses($input['bps_iniSet_IgnoreRepeatedSource']);
	$options['bps_iniSet_AllowUrlInclude'] = wp_filter_nohtml_kses($input['bps_iniSet_AllowUrlInclude']);
	$options['bps_iniSet_DefineSyslogVar'] = wp_filter_nohtml_kses($input['bps_iniSet_DefineSyslogVar']);
	$options['bps_iniSet_DisplayErrors'] = wp_filter_nohtml_kses($input['bps_iniSet_DisplayErrors']);		
	$options['bps_iniSet_DisplayStartupErrors'] = wp_filter_nohtml_kses($input['bps_iniSet_DisplayStartupErrors']);	
	$options['bps_iniSet_ImplicitFlush'] = wp_filter_nohtml_kses($input['bps_iniSet_ImplicitFlush']);
	$options['bps_iniSet_MagicQuotesRuntime'] = wp_filter_nohtml_kses($input['bps_iniSet_MagicQuotesRuntime']);	
	$options['bps_iniSet_MaxExecutionTime'] = trim(wp_filter_nohtml_kses($input['bps_iniSet_MaxExecutionTime']));	
	$options['bps_iniSet_MysqlConnectTimeout'] = trim(wp_filter_nohtml_kses($input['bps_iniSet_MysqlConnectTimeout']));
	$options['bps_iniSet_MysqlTraceMode'] = wp_filter_nohtml_kses($input['bps_iniSet_MysqlTraceMode']);
	$options['bps_iniSet_ReportMemleaks'] = wp_filter_nohtml_kses($input['bps_iniSet_ReportMemleaks']);
		
	return $options;  
}

// VBPS AutoRestore Cron settings 
function bulletproof_security_options_validate_ARCM($input) {  
	$options = get_option('bulletproof_security_options_ARCM');  
	$options['bps_autorestore_cron'] = wp_filter_nohtml_kses($input['bps_autorestore_cron']);
	$options['bps_autorestore_cron_frequency'] = wp_filter_nohtml_kses($input['bps_autorestore_cron_frequency']);
	$options['bps_autorestore_cron_forced'] = wp_filter_nohtml_kses($input['bps_autorestore_cron_forced']);
	$options['bps_autorestore_cron_override'] = wp_filter_nohtml_kses($input['bps_autorestore_cron_override']);
	$options['bps_autorestore_cron_filecheck'] = wp_filter_nohtml_kses($input['bps_autorestore_cron_filecheck']);	
	$options['bps_autorestore_cron_end'] = wp_filter_nohtml_kses($input['bps_autorestore_cron_end']);
	
	return $options;
}

// ARQ Quarantine Log Last Modified Time DB
function bulletproof_security_options_validate_ARCM_log($input) {  
	$options = get_option('bulletproof_security_options_ARCM_log');  
	$options['bps_arcm_log_date_mod'] = wp_filter_nohtml_kses($input['bps_arcm_log_date_mod']);
		
	return $options;  
}

// ARQ Exclude wp-content Folders 
function bulletproof_security_options_validate_exclude_folder($input) {  
	$options = get_option('bulletproof_security_options_exclude_folder');  
	$options['bpsexclude_input_1'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_1']));
	$options['bpsexclude_input_2'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_2']));
	$options['bpsexclude_input_3'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_3']));
	$options['bpsexclude_input_4'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_4']));
	$options['bpsexclude_input_5'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_5']));
	$options['bpsexclude_input_6'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_6']));
	$options['bpsexclude_input_7'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_7']));
	$options['bpsexclude_input_8'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_8']));
	$options['bpsexclude_input_9'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_9']));
	$options['bpsexclude_input_10'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_10']));
	$options['bpsexclude_input_11'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_11']));
	$options['bpsexclude_input_12'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_12']));
	$options['bpsexclude_input_13'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_13']));
	$options['bpsexclude_input_14'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_14']));
	$options['bpsexclude_input_15'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_15']));
	$options['bpsexclude_input_16'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_16']));
	$options['bpsexclude_input_17'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_17']));
	$options['bpsexclude_input_18'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_18']));
	$options['bpsexclude_input_19'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_19']));
	$options['bpsexclude_input_20'] = trim(wp_filter_nohtml_kses($input['bpsexclude_input_20']));
	$options['bpsexclude_input_1_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_1_label']);
	$options['bpsexclude_input_2_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_2_label']); 
	$options['bpsexclude_input_3_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_3_label']); 
	$options['bpsexclude_input_4_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_4_label']);
	$options['bpsexclude_input_5_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_5_label']);
	$options['bpsexclude_input_6_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_6_label']); 
	$options['bpsexclude_input_7_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_7_label']); 
	$options['bpsexclude_input_8_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_8_label']);
	$options['bpsexclude_input_9_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_9_label']);
	$options['bpsexclude_input_10_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_10_label']);
	$options['bpsexclude_input_11_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_11_label']);
	$options['bpsexclude_input_12_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_12_label']); 
	$options['bpsexclude_input_13_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_13_label']); 
	$options['bpsexclude_input_14_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_14_label']);
	$options['bpsexclude_input_15_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_15_label']);
	$options['bpsexclude_input_16_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_16_label']); 
	$options['bpsexclude_input_17_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_17_label']); 
	$options['bpsexclude_input_18_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_18_label']);
	$options['bpsexclude_input_19_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_19_label']);
	$options['bpsexclude_input_20_label'] = wp_filter_nohtml_kses($input['bpsexclude_input_20_label']);
		
	return $options;  
}

// BPS Root Custom Code
function bulletproof_security_options_validate_customcode($input) {  
	$options = get_option('bulletproof_security_options_customcode');  
	// TOP PHP/PHP.INI HANDLER/CACHE CODE
	$options['bps_customcode_one'] = esc_html($input['bps_customcode_one']);
	$options['bps_customcode_server_signature'] = esc_html($input['bps_customcode_server_signature']);
	$options['bps_customcode_directory_index'] = esc_html($input['bps_customcode_directory_index']);
	// BRUTE FORCE LOGIN PAGE PROTECTION
	$options['bps_customcode_server_protocol'] = esc_html($input['bps_customcode_server_protocol']);	
	$options['bps_customcode_error_logging'] = esc_html($input['bps_customcode_error_logging']);
	$options['bps_customcode_deny_dot_folders'] = esc_html($input['bps_customcode_deny_dot_folders']);	
	$options['bps_customcode_admin_includes'] = esc_html($input['bps_customcode_admin_includes']);
	$options['bps_customcode_wp_rewrite_start'] = esc_html($input['bps_customcode_wp_rewrite_start']);
	$options['bps_customcode_request_methods'] = esc_html($input['bps_customcode_request_methods']);
	// PLUGIN/THEME SKIP/BYPASS RULES
	$options['bps_customcode_two'] = esc_html($input['bps_customcode_two']);
	$options['bps_customcode_timthumb_misc'] = esc_html($input['bps_customcode_timthumb_misc']);
	$options['bps_customcode_bpsqse'] = esc_html($input['bps_customcode_bpsqse']);
	if ( is_multisite() ) {
	$options['bps_customcode_wp_rewrite_end'] = esc_html($input['bps_customcode_wp_rewrite_end']);
	}
	$options['bps_customcode_deny_files'] = esc_html($input['bps_customcode_deny_files']);
	// BOTTOM HOTLINKING/FORBID COMMENT SPAMMERS/BLOCK BOTS/BLOCK IP/REDIRECT CODE
	$options['bps_customcode_three'] = esc_html($input['bps_customcode_three']);

	return $options;  
}

// BPS wp-admin Custom Code
function bulletproof_security_options_validate_customcode_WPA($input) {  
	$options = get_option('bulletproof_security_options_customcode_WPA');  
	$options['bps_customcode_deny_files_wpa'] = esc_html($input['bps_customcode_deny_files_wpa']);
	$options['bps_customcode_one_wpa'] = esc_html($input['bps_customcode_one_wpa']);
	$options['bps_customcode_two_wpa'] = esc_html($input['bps_customcode_two_wpa']);
	$options['bps_customcode_bpsqse_wpa'] = esc_html($input['bps_customcode_bpsqse_wpa']);		
	
	return $options;  
}

// Maintenance Mode Form options
function bulletproof_security_options_validate_maint_mode($input) {  
	$options = get_option('bulletproof_security_options_maint_mode');  
	$options['bps_maint_on_off'] = wp_filter_nohtml_kses($input['bps_maint_on_off']);
	$options['bps_maint_countdown_timer'] = wp_filter_nohtml_kses($input['bps_maint_countdown_timer']);
	$options['bps_maint_countdown_timer_color'] = wp_filter_nohtml_kses($input['bps_maint_countdown_timer_color']);
	$options['bps_maint_time'] = wp_filter_nohtml_kses($input['bps_maint_time']);
	$options['bps_maint_retry_after'] = wp_filter_nohtml_kses($input['bps_maint_retry_after']);
	$options['bps_maint_frontend'] = wp_filter_nohtml_kses($input['bps_maint_frontend']);
	$options['bps_maint_backend'] = wp_filter_nohtml_kses($input['bps_maint_backend']);
	$options['bps_maint_ip_allowed'] = wp_filter_nohtml_kses($input['bps_maint_ip_allowed']);
	$options['bps_maint_text'] = esc_html($input['bps_maint_text']);
	$options['bps_maint_background_images'] = wp_filter_nohtml_kses($input['bps_maint_background_images']);
	$options['bps_maint_center_images'] = wp_filter_nohtml_kses($input['bps_maint_center_images']);
	$options['bps_maint_background_color'] = wp_filter_nohtml_kses($input['bps_maint_background_color']);
	$options['bps_maint_show_visitor_ip'] = wp_filter_nohtml_kses($input['bps_maint_show_visitor_ip']);
	$options['bps_maint_show_login_link'] = wp_filter_nohtml_kses($input['bps_maint_show_login_link']);
	$options['bps_maint_dashboard_reminder'] = wp_filter_nohtml_kses($input['bps_maint_dashboard_reminder']);	
	$options['bps_maint_countdown_email'] = wp_filter_nohtml_kses($input['bps_maint_countdown_email']);
	$options['bps_maint_email_to'] = trim(wp_filter_nohtml_kses($input['bps_maint_email_to']));
	$options['bps_maint_email_from'] = trim(wp_filter_nohtml_kses($input['bps_maint_email_from']));
	$options['bps_maint_email_cc'] = trim(wp_filter_nohtml_kses($input['bps_maint_email_cc']));
	$options['bps_maint_email_bcc'] = trim(wp_filter_nohtml_kses($input['bps_maint_email_bcc']));	
	$options['bps_maint_mu_entire_site'] = wp_filter_nohtml_kses($input['bps_maint_mu_entire_site']);
	$options['bps_maint_mu_subsites_only'] = wp_filter_nohtml_kses($input['bps_maint_mu_subsites_only']);
	
	return $options;  
}

// BPS "My Notes" settings 
function bulletproof_security_options_validate_mynotes($input) {  
	$options = get_option('bulletproof_security_options_mynotes');  
	$options['bps_my_notes'] = esc_html($input['bps_my_notes']);
		
	return $options;  
}

// BPS F-Lock settings 
function bulletproof_security_options_validate_flock($input) {  
	$options = get_option('bulletproof_security_options_flock');  
	$options['bps_lock_root_htaccess'] = wp_filter_nohtml_kses($input['bps_lock_root_htaccess']);
	$options['bps_lock_wpconfig'] = wp_filter_nohtml_kses($input['bps_lock_wpconfig']);
	$options['bps_lock_index_php'] = wp_filter_nohtml_kses($input['bps_lock_index_php']);
	$options['bps_lock_wpblog_header'] = wp_filter_nohtml_kses($input['bps_lock_wpblog_header']);
	$options['bps_lock_root_htaccess_dr'] = wp_filter_nohtml_kses($input['bps_lock_root_htaccess_dr']);
	$options['bps_lock_index_php_dr'] = wp_filter_nohtml_kses($input['bps_lock_index_php_dr']);
	$options['bps_lock_root_htaccess_gwiod'] = wp_filter_nohtml_kses($input['bps_lock_root_htaccess_gwiod']);
	$options['bps_lock_index_php_gwiod'] = wp_filter_nohtml_kses($input['bps_lock_index_php_gwiod']);
		
	return $options;  
}

// Login Security & Monitoring
function bulletproof_security_options_validate_login_security($input) {  
	$BPSoptions = get_option('bulletproof_security_options_login_security');  
	$BPSoptions['bps_max_logins'] = trim(wp_filter_nohtml_kses($input['bps_max_logins']));
	$BPSoptions['bps_lockout_duration'] = trim(wp_filter_nohtml_kses($input['bps_lockout_duration']));
	$BPSoptions['bps_manual_lockout_duration'] = trim(wp_filter_nohtml_kses($input['bps_manual_lockout_duration']));
	$BPSoptions['bps_max_db_rows_display'] = trim(wp_filter_nohtml_kses($input['bps_max_db_rows_display']));
	$BPSoptions['bps_login_security_OnOff'] = wp_filter_nohtml_kses($input['bps_login_security_OnOff']);
	$BPSoptions['bps_login_security_logging'] = wp_filter_nohtml_kses($input['bps_login_security_logging']);
	$BPSoptions['bps_login_security_errors'] = wp_filter_nohtml_kses($input['bps_login_security_errors']);
	$BPSoptions['bps_login_security_remaining'] = wp_filter_nohtml_kses($input['bps_login_security_remaining']);
	$BPSoptions['bps_login_security_pw_reset'] = wp_filter_nohtml_kses($input['bps_login_security_pw_reset']);
	$BPSoptions['bps_login_security_sort'] = wp_filter_nohtml_kses($input['bps_login_security_sort']);

	return $BPSoptions;  
}

// JTC Anti-Spam|Anti-Hacker
function bulletproof_security_options_validate_login_security_jtc($input) {  
	$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');  
	$BPSoptionsJTC['bps_tooltip_captcha_key'] = trim(wp_filter_nohtml_kses($input['bps_tooltip_captcha_key']));	
	$BPSoptionsJTC['bps_tooltip_captcha_hover_text'] = wp_filter_nohtml_kses($input['bps_tooltip_captcha_hover_text']);
	$BPSoptionsJTC['bps_tooltip_captcha_title'] = wp_filter_nohtml_kses($input['bps_tooltip_captcha_title']);	
	$BPSoptionsJTC['bps_tooltip_captcha_logging'] = wp_filter_nohtml_kses($input['bps_tooltip_captcha_logging']);		
	$BPSoptionsJTC['bps_jtc_login_form'] = wp_filter_nohtml_kses($input['bps_jtc_login_form']);
	$BPSoptionsJTC['bps_jtc_register_form'] = wp_filter_nohtml_kses($input['bps_jtc_register_form']);
	$BPSoptionsJTC['bps_jtc_lostpassword_form'] = wp_filter_nohtml_kses($input['bps_jtc_lostpassword_form']);
	$BPSoptionsJTC['bps_jtc_comment_form'] = wp_filter_nohtml_kses($input['bps_jtc_comment_form']);
	$BPSoptionsJTC['bps_jtc_buddypress_register_form'] = wp_filter_nohtml_kses($input['bps_jtc_buddypress_register_form']);
	$BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] = wp_filter_nohtml_kses($input['bps_jtc_buddypress_sidebar_form']);
	$BPSoptionsJTC['bps_jtc_administrator'] = wp_filter_nohtml_kses($input['bps_jtc_administrator']);
	$BPSoptionsJTC['bps_jtc_editor'] = wp_filter_nohtml_kses($input['bps_jtc_editor']);
	$BPSoptionsJTC['bps_jtc_author'] = wp_filter_nohtml_kses($input['bps_jtc_author']);
	$BPSoptionsJTC['bps_jtc_contributor'] = wp_filter_nohtml_kses($input['bps_jtc_contributor']);
	$BPSoptionsJTC['bps_jtc_subscriber'] = wp_filter_nohtml_kses($input['bps_jtc_subscriber']);
	$BPSoptionsJTC['bps_jtc_comment_form_error'] = $input['bps_jtc_comment_form_error'];
	$BPSoptionsJTC['bps_jtc_comment_form_label'] = $input['bps_jtc_comment_form_label'];		
	$BPSoptionsJTC['bps_jtc_comment_form_input'] = $input['bps_jtc_comment_form_input'];	
	//$BPSoptionsJTC['bps_jtc_hide_ghost_text'] = wp_filter_nohtml_kses($input['bps_jtc_hide_ghost_text']);	
	
	return $BPSoptionsJTC;  
}

// Login Security Last Modified Time DB - Reset/Clear alerts
function bulletproof_security_options_validate_login_alerts($input) {  
	$LSAlertsoptions = get_option('bulletproof_security_options_login_alerts');  
	$LSAlertsoptions['bps_login_security_db_mod_time'] = wp_filter_nohtml_kses($input['bps_login_security_db_mod_time']);
		
	return $LSAlertsoptions;  
}

// BPS Pro Activation 
function bulletproof_security_options_validate_activation($input) {  
	$options = get_option('bulletproof_security_options_activation');  
	$options['bps_pro_activation'] = trim(wp_filter_nohtml_kses($input['bps_pro_activation']));
	$options['delete_paypal_email'] = trim(wp_filter_nohtml_kses($input['delete_paypal_email']));
	$options['bps_pro_key'] = trim(wp_filter_nohtml_kses($input['bps_pro_key']));
	$options['bps_api_key'] = trim(wp_filter_nohtml_kses($input['bps_api_key']));
			
	return $options;  
}

// S-Monitor BPS Pro Monitoring and Alerting Options 
function bulletproof_security_options_validate_monitor($input) {  
	$options = get_option('bulletproof_security_options_monitor');  
	$options['bps_first_launch'] = wp_filter_nohtml_kses($input['bps_first_launch']);
	$options['bps_upgrade_notice'] = wp_filter_nohtml_kses($input['bps_upgrade_notice']); // not used anymore leave it
	$options['bps_security_status'] = wp_filter_nohtml_kses($input['bps_security_status']);
	$options['bps_HUD_alerts'] = wp_filter_nohtml_kses($input['bps_HUD_alerts']);
	$options['bps_PHP_ELogLoc_set'] = wp_filter_nohtml_kses($input['bps_PHP_ELogLoc_set']);
	$options['bps_PHP_ELog_error'] = wp_filter_nohtml_kses($input['bps_PHP_ELog_error']);
	$options['bps_phpini_created'] = wp_filter_nohtml_kses($input['bps_phpini_created']);
	$options['bps_flock_status'] = wp_filter_nohtml_kses($input['bps_flock_status']);
	$options['bps_autorestore_status'] = wp_filter_nohtml_kses($input['bps_autorestore_status']);
	$options['bps_plugin_firewall_status'] = wp_filter_nohtml_kses($input['bps_plugin_firewall_status']);
	$options['bps_UAEG_status'] = wp_filter_nohtml_kses($input['bps_UAEG_status']);
	$options['bps_SecLog_entry'] = wp_filter_nohtml_kses($input['bps_SecLog_entry']);
	$options['bps_login_security_status'] = wp_filter_nohtml_kses($input['bps_login_security_status']);
	$options['bps_login_security_alerts'] = wp_filter_nohtml_kses($input['bps_login_security_alerts']);			
	$options['bps_jtc_antispam_status'] = wp_filter_nohtml_kses($input['bps_jtc_antispam_status']);	
	$options['bps_dbm_status'] = wp_filter_nohtml_kses($input['bps_dbm_status']);
	$options['bps_dbm_alerts'] = wp_filter_nohtml_kses($input['bps_dbm_alerts']);
	$options['bps_dbb_status'] = wp_filter_nohtml_kses($input['bps_dbb_status']); // completed: S-Monitor page, wizard - new installs, hud-dismiss for upgraders	

	return $options;  
}

// BPS Pro Upgrade Check email - maybe combine this into S-Monitor Email Alerts later or not
function bulletproof_security_options_validate_upgrade_email($input) {  
	$options = get_option('bulletproof_security_options_upgrade_email');  
	$options['bps_upgrade_check_email'] = wp_filter_nohtml_kses($input['bps_upgrade_check_email']);
			
	return $options;  
}

// S-Monitor Email Alerts / Email Log Files
function bulletproof_security_options_validate_email($input) {  
	$options = get_option('bulletproof_security_options_email');  
	//$options['bps_quarantine_email'] = wp_filter_nohtml_kses($input['bps_quarantine_email']);
	$options['bps_error_log_email'] = wp_filter_nohtml_kses($input['bps_error_log_email']);
	$options['bps_upgrade_email'] = wp_filter_nohtml_kses($input['bps_upgrade_email']);
	$options['bps_autorestore_email'] = wp_filter_nohtml_kses($input['bps_autorestore_email']);
	$options['bps_security_log_email'] = wp_filter_nohtml_kses($input['bps_security_log_email']);
	$options['bps_send_email_to'] = trim(wp_filter_nohtml_kses($input['bps_send_email_to']));
	$options['bps_send_email_from'] = trim(wp_filter_nohtml_kses($input['bps_send_email_from']));
	$options['bps_send_email_cc'] = trim(wp_filter_nohtml_kses($input['bps_send_email_cc']));
	$options['bps_send_email_bcc'] = trim(wp_filter_nohtml_kses($input['bps_send_email_bcc']));
	$options['bps_arq_log_size'] = wp_filter_nohtml_kses($input['bps_arq_log_size']);
	$options['bps_security_log_size'] = wp_filter_nohtml_kses($input['bps_security_log_size']);
	$options['bps_php_log_size'] = wp_filter_nohtml_kses($input['bps_php_log_size']);
	$options['bps_arq_log_email'] = wp_filter_nohtml_kses($input['bps_arq_log_email']);
	$options['bps_security_log_emailL'] = wp_filter_nohtml_kses($input['bps_security_log_emailL']);
	$options['bps_php_log_email'] = wp_filter_nohtml_kses($input['bps_php_log_email']);
	$options['bps_login_security_email'] = wp_filter_nohtml_kses($input['bps_login_security_email']);
	$options['bps_dbm_email'] = wp_filter_nohtml_kses($input['bps_dbm_email']);		
	$options['bps_dbm_log_email'] = wp_filter_nohtml_kses($input['bps_dbm_log_email']);	
	$options['bps_dbm_log_size'] = wp_filter_nohtml_kses($input['bps_dbm_log_size']);
	//$options['bps_dbb_email'] = wp_filter_nohtml_kses($input['bps_dbb_email']); // unnecessary - handled in DB Backup itself
	$options['bps_dbb_log_email'] = wp_filter_nohtml_kses($input['bps_dbb_log_email']);	
	$options['bps_dbb_log_size'] = wp_filter_nohtml_kses($input['bps_dbb_log_size']);	
	
	return $options;  
}

// Setup Wizard Flock Checks 
function bulletproof_security_options_validate_setup_wizard_flock($input) {  
	$options = get_option('bulletproof_security_options_setup_wizard_flock');  
	$options['bps_wizard_root_htaccess_flock'] = wp_filter_nohtml_kses($input['bps_wizard_root_htaccess_flock']);
	$options['bps_wizard_wpconfig_flock'] = wp_filter_nohtml_kses($input['bps_wizard_wpconfig_flock']);
	$options['bps_wizard_index_flock'] = wp_filter_nohtml_kses($input['bps_wizard_index_flock']);
	$options['bps_wizard_wpblogheader_flock'] = wp_filter_nohtml_kses($input['bps_wizard_wpblogheader_flock']);
			
	return $options;  
}

// Setup Wizard Pre-Installation check 
function bulletproof_security_options_validate_preinstallation($input) {  
	$options = get_option('bulletproof_security_options_preinstallation');  
	$options['bps_wizard_preinstallation'] = wp_filter_nohtml_kses($input['bps_wizard_preinstallation']);
	$options['bps_wizard_preinstallation_61'] = wp_filter_nohtml_kses($input['bps_wizard_preinstallation_61']);			
	
	return $options;  
}

// Setup Wizard cURL On/Off or home page scan ONLY & DB Monitor keep settings
function bulletproof_security_options_validate_wizard_curl($input) {  
	$options = get_option('bulletproof_security_options_wizard_curl');  
	$options['bps_wizard_curl_scan'] = wp_filter_nohtml_kses($input['bps_wizard_curl_scan']);
	$options['bps_wizard_dbm_settings'] = wp_filter_nohtml_kses($input['bps_wizard_dbm_settings']);	
	
	return $options;  
}

// Upgrade Notifications - New Features & Options
function bulletproof_security_options_validate_upgrade_notice($input) {  
	$options = get_option('bulletproof_security_options_upgrade_notice');  
	$options['bps_upgrade_notification_wizard'] = wp_filter_nohtml_kses($input['bps_upgrade_notification_wizard']);
			
	return $options;  
}

// WP Automatic Update & manual update WordPress version Check
function bulletproof_security_options_validate_wp_version($input) {  
	$options = get_option('bulletproof_security_options_wp_version');  
	$options['bps_wp_version'] = wp_filter_nohtml_kses($input['bps_wp_version']);
	$options['bps_wp_version_last_modified_time'] = wp_filter_nohtml_kses($input['bps_wp_version_last_modified_time']);			
	
	return $options;  
}

// Pro-Tools WP Automatic Update 
function bulletproof_security_options_validate_wp_autoupdate($input) {  
	$options = get_option('bulletproof_security_options_wp_autoupdate');  
	$options['bps_WP_AUTO_UPDATE_CORE_false'] = wp_filter_nohtml_kses($input['bps_WP_AUTO_UPDATE_CORE_false']);
	$options['bps_WP_AUTO_UPDATE_CORE_true'] = wp_filter_nohtml_kses($input['bps_WP_AUTO_UPDATE_CORE_true']);
	$options['bps_WP_AUTO_UPDATE_CORE_minor'] = wp_filter_nohtml_kses($input['bps_WP_AUTO_UPDATE_CORE_minor']);
	$options['bps_AUTOMATIC_UPDATER_DISABLED_true'] = wp_filter_nohtml_kses($input['bps_AUTOMATIC_UPDATER_DISABLED_true']);
	$options['bps_AUTOMATIC_UPDATER_DISABLED_false'] = wp_filter_nohtml_kses($input['bps_AUTOMATIC_UPDATER_DISABLED_false']);
				
	return $options;  
}

// UI Theme Skin 
function bulletproof_security_options_validate_theme_skin($input) {  
	$options = get_option('bulletproof_security_options_theme_skin');  
	$options['bps_ui_theme_skin'] = wp_filter_nohtml_kses($input['bps_ui_theme_skin']);
			
	return $options;  
}

// DB Backup
function bulletproof_security_options_validate_db_backup($input) {  
	$options = get_option('bulletproof_security_options_db_backup');  
	$options['bps_db_backup'] = wp_filter_nohtml_kses($input['bps_db_backup']);
	$options['bps_db_backup_description'] = trim(wp_filter_nohtml_kses($input['bps_db_backup_description']));		
	$options['bps_db_backup_folder'] = trim(wp_filter_nohtml_kses($input['bps_db_backup_folder']));
	$options['bps_db_backup_download_link'] = trim(wp_filter_nohtml_kses($input['bps_db_backup_download_link']));				
	$options['bps_db_backup_job_type'] = wp_filter_nohtml_kses($input['bps_db_backup_job_type']);	
	$options['bps_db_backup_frequency'] = wp_filter_nohtml_kses($input['bps_db_backup_frequency']);	
	$options['bps_db_backup_start_time_hour'] = wp_filter_nohtml_kses($input['bps_db_backup_start_time_hour']);
	$options['bps_db_backup_start_time_weekday'] = wp_filter_nohtml_kses($input['bps_db_backup_start_time_weekday']);
	$options['bps_db_backup_start_time_month_date'] = wp_filter_nohtml_kses($input['bps_db_backup_start_time_month_date']);
	$options['bps_db_backup_email_zip'] = wp_filter_nohtml_kses($input['bps_db_backup_email_zip']);		
	$options['bps_db_backup_delete'] = wp_filter_nohtml_kses($input['bps_db_backup_delete']);		
	$options['bps_db_backup_status_display'] = wp_filter_nohtml_kses($input['bps_db_backup_status_display']); // hidden form option
	
	return $options;  
}

// DB Monitor Cron
function bulletproof_security_options_validate_db_monitor($input) {  
	$options = get_option('bulletproof_security_options_db_monitor');  
	$options['bps_db_monitor_cron'] = wp_filter_nohtml_kses($input['bps_db_monitor_cron']);
	$options['bps_db_monitor_cron_frequency'] = wp_filter_nohtml_kses($input['bps_db_monitor_cron_frequency']);
	$options['bps_db_monitor_cron_table_created_check'] = wp_filter_nohtml_kses($input['bps_db_monitor_cron_table_created_check']);	
	$options['bps_db_monitor_cron_end'] = wp_filter_nohtml_kses($input['bps_db_monitor_cron_end']);
	
	return $options;  
}

// DB Monitor Log Last Modified Time DB
function bulletproof_security_options_validate_DBM_log($input) {  
	$options = get_option('bulletproof_security_options_DBM_log');  
	$options['bps_dbm_log_date_mod'] = wp_filter_nohtml_kses($input['bps_dbm_log_date_mod']);
		
	return $options;  
}

// DB Backup Log Last Modified Time DB
function bulletproof_security_options_validate_DBB_log($input) {  
	$options = get_option('bulletproof_security_options_DBB_log');  
	$options['bps_dbb_log_date_mod'] = wp_filter_nohtml_kses($input['bps_dbb_log_date_mod']);
		
	return $options;  
}

// GMT timestamp option for synch function on upgrades
function bulletproof_security_options_validate_GMT($input) {  
	$options = get_option('bulletproof_security_options_GMT');  
	$options['bps_gmt_timestamp'] = wp_filter_nohtml_kses($input['bps_gmt_timestamp']);
		
	return $options;  
}

// Hosting that does not allow wp-admin .htaccess files - Go Daddy Managed WordPress hosting
function bulletproof_security_options_validate_htaccess_res($input) {  
	$options = get_option('bulletproof_security_options_htaccess_res');  
	$options['bps_wpadmin_restriction'] = wp_filter_nohtml_kses($input['bps_wpadmin_restriction']);
		
	return $options;  
}

// Go Daddy Managed WordPress hosting
function bulletproof_security_options_validate_GDMW($input) {  
	$options = get_option('bulletproof_security_options_GDMW');  
	$options['bps_gdmw_hosting'] = wp_filter_nohtml_kses($input['bps_gdmw_hosting']);
	
	return $options;  
}

// Pro-Tools Base64 Decoder/Encoder file/tools install and removal
function bulletproof_security_options_validate_b64_tools($input) {  
	$options = get_option('bulletproof_security_options_b64_tools');  
	$options['bps_b64_offline_decoder'] = wp_filter_nohtml_kses($input['bps_b64_offline_decoder']);
	$options['bps_b64_online_decoder'] = wp_filter_nohtml_kses($input['bps_b64_online_decoder']);	
	
	return $options;  
}

// Loading/Processing Spinner On/Off
function bulletproof_security_options_validate_spinner($input) {  
	$options = get_option('bulletproof_security_options_spinner');  
	$options['bps_spinner'] = wp_filter_nohtml_kses($input['bps_spinner']);
	
	return $options;  
}

// WP Toolbar remove or allow all nodes
function bulletproof_security_options_validate_wpt_nodes($input) {  
	$options = get_option('bulletproof_security_options_wpt_nodes');  
	$options['bps_wpt_nodes'] = wp_filter_nohtml_kses($input['bps_wpt_nodes']);
	
	return $options;  
}

// ARQ backup and turn on for manual WP upgrades, new Theme Installations and Theme upgrades
function bulletproof_security_options_validate_ARQ_upgrade($input) {  
	$options = get_option('bulletproof_security_options_ARQ_upgrade');  
	$options['bps_arq_upgrade'] = wp_filter_nohtml_kses($input['bps_arq_upgrade']);
	
	return $options;  
}

?>