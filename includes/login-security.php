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

$BPSoptions = get_option('bulletproof_security_options_login_security');
	
	// Priority should be 20 (default priority) for this filter and should not be changed to a higher priority - will break stuff
	if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && isset( $_POST['wp-submit'] ) ) {
		add_filter('authenticate', 'bpspro_wp_authenticate_username_password', 20, 3);
	}

function bpspro_wp_authenticate_username_password( $user, $username, $password ) {
global $wpdb, $blog_id;
$BPSoptions = get_option('bulletproof_security_options_login_security');
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
$options = get_option('bulletproof_security_options_email');
$bpspro_login_table = $wpdb->prefix . "bpspro_login_security";
$ip_address = $_SERVER['REMOTE_ADDR'];
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$request_uri = $_SERVER['REQUEST_URI'];
$login_time = time();
$lockout_time = time() + (60 * $BPSoptions['bps_lockout_duration']); // default is 1 hour/3600 seconds 
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$bps_email_to = $options['bps_send_email_to'];
$bps_email_from = $options['bps_send_email_from'];
$bps_email_cc = $options['bps_send_email_cc'];
$bps_email_bcc = $options['bps_send_email_bcc'];
$justUrl = get_site_url();
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$LSA_Reset_file = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt';
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: $bps_email_from" . "\r\n";
	$headers .= "Cc: $bps_email_cc" . "\r\n";
	$headers .= "Bcc: $bps_email_bcc" . "\r\n";	
	$subject = " BPS Pro Login Security Alert - $timestamp ";

/*
***************************************************************
// Log All Account Logins for valid Users - Good and Bad Logins
***************************************************************
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_logging'] == 'logAll' ) {

	$user = get_user_by( 'login', $username );
	$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %d", $user->ID ) );

		foreach ( $LoginSecurityRows as $row ) {
	
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] && $BPSoptions['bps_login_security_errors'] != 'genericAll' ) { 
				$error = new WP_Error();
				$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
		
				return $error;
			}
			
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] && $BPSoptions['bps_login_security_errors'] == 'genericAll' ) { 
				return new WP_Error('incorrect_password', sprintf(__('<strong>ERROR</strong>: Invalid Entry. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
			}
		}
		
		// CAPTCHA / Bot Trap / DoS/DDos Protection / Brute Force Login Protection - incorrect CAPTCHA entered stops Login processing
		if ( $BPSoptionsJTC['bps_jtc_login_form'] == '1' ) {
			
			if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
				$error = new WP_Error();
				$error->add( 'captcha_error', __('<strong>ERROR</strong>: Incorrect CAPTCHA Entered.', 'bulletproof-security') );
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				
				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {
			
			$log_contents = "\r\n" . '[Login Form - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}		
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Login Form - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";			
			
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
			}
			return $error;
			}
		}
		
		// Good Login - DB Row does NOT Exist - Create it - Email option - Any user logs in
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) ) {
			$status = 'Not Locked';
			$lockout_time = '0';		
			$failed_logins = '0';
		
			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {
			
			if ( file_exists($LSA_Reset_file) ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}			
			
			if ( $options['bps_login_security_email'] == 'anyUserLoginLock' ) {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			
			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator' ) {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} // end if ( is_multisite() && $blog_id != 1
			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...
		
		// Good Login - DB Row Exists - Insert another new DB Row - Only insert a new DB row if any user ID status rows are not Locked
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status != 'Locked' ) {
			$status = 'Not Locked';
			$lockout_time = '0';		
			$failed_logins = '0';		
			
			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			if ( file_exists($LSA_Reset_file) ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}

			if ( $options['bps_login_security_email'] == 'anyUserLoginLock' ) {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			
			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator' ) {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 
				
				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			} // end if ( is_multisite() && $blog_id != 1
			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row does NOT Exist - First bad login attempt = $failed_logins = '1'; - Insert a new Row with Locked status
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && ! wp_check_password($password, $user->user_pass, $user->ID) ) {
			$failed_logins = '1';

			// Insane, but someone will do this... if max bad retries is set to 1
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';

				// Network/Multisite subsites - logging is not used/allowed
				if ( is_multisite() && $blog_id != 1 ) {
					// do nothing
				} else {

				if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock' ) {
					$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
					$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
					$message .=  '<p><strong>If your User Account is locked and you are unable to login to your website:</strong> Use FTP or your web host control panel file manager and rename the /bulletproof-security plugin folder name to /_bulletproof-security. Log into your website. Rename the /_bulletproof-security plugin folder name back to /bulletproof-security. Go to the BPS Login Security page and unlock your User Account.</p>';
					$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
					$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
					$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
					$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
					$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
					$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
					$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
					$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
					$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
					$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
				}
				}
			
			} else {		
				$status = 'Not Locked';			
			}

			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {	

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			if ( file_exists($LSA_Reset_file) ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}			
			}
			} // end $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...	

		// Good Login - DB Row Exists & status is Locked - Reset Only a locked out account on good login if it was locked and the lockout time has expired
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status == 'Locked' && $timeNow > $row->lockout_time ) {				
				$status = 'Not Locked';			
				$lockout_time = '0';
				$failed_logins = '0';

			// 10.2: additional WHERE clause added: 'status' => 'Locked' - Update ONLY the Row that has status of Locked.
			// maybe later version keep this row and reset the status and failed login attempts only and create a new row for the new login - not critical
			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id, 'status' => 'Locked' ) ) ) {	
			
				// Network/Multisite subsites - logging is not used/allowed
				if ( is_multisite() && $blog_id != 1 ) {
					// do nothing
				} else {

				if ( file_exists($LSA_Reset_file) ) {			
					file_put_contents($LSA_Reset_file, "Login Security Alerts");
				}
			
				if ( $options['bps_login_security_email'] == 'anyUserLoginLock' ) {
					$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
					$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
					$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
					$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
					$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
					$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
					$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
					$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
					$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
					$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
				}
				
				// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
				if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator' ) {
					$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
					$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
					$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
					$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
					$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
					$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
					$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
					$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
					$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
					$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
				}
				} // end is_multisite() && $blog_id != 1
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row Exists - Count bad login attempts and Lock Account
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && ! wp_check_password($password, $user->user_pass, $user->ID) ) {

			foreach ( $LoginSecurityRows as $row ) {

				if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
					$error = new WP_Error();
					$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
			
					return $error;
				}
					$failed_logins = $row->failed_logins;

				if ( $row->failed_logins == 0 ) {
					for ($failed_logins = 0; $failed_logins <= 0; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					} 
				} elseif ( $row->failed_logins == 1 ) {
					for ($failed_logins = 1; $failed_logins <= 1; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 2 ) {
					for ($failed_logins = 2; $failed_logins <= 2; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 3 ) {
					for ($failed_logins = 3; $failed_logins <= 3; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 4 ) {
					for ($failed_logins = 4; $failed_logins <= 4; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 5 ) {
					for ($failed_logins = 5; $failed_logins <= 5; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 6 ) {
					for ($failed_logins = 6; $failed_logins <= 6; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 7 ) {
					for ($failed_logins = 7; $failed_logins <= 7; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 8 ) {
					for ($failed_logins = 8; $failed_logins <= 8; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 9 ) {
					for ($failed_logins = 9; $failed_logins <= 9; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				}
			} // end foreach
			
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';	

				// Network/Multisite subsites - logging is not used/allowed
				if ( is_multisite() && $blog_id != 1 ) {
					// do nothing
				} else {

				if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock' ) {
					$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
					$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
					$message .=  '<p><strong>If your User Account is locked and you are unable to login to your website:</strong> Use FTP or your web host control panel file manager and rename the /bulletproof-security plugin folder name to /_bulletproof-security. Log into your website. Rename the /_bulletproof-security plugin folder name back to /bulletproof-security. Go to the BPS Login Security page and unlock your User Account.</p>';					
					$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
					$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
					$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
					$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
					$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
					$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
					$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
					$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
					$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
					$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
				}
				}
				
			} else {	
				$status = 'Not Locked';
			}

			// 10.2: Insert a new row on first bad login attempt. After that update that same row
			if ( $failed_logins == 1 ) {
				
				$insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) );		
					
			} else {
				
				$no_zeros = '0';
				$LSM_zero_filter = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %d AND failed_logins != %d", $user->ID, $no_zeros ) );
				
				$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id, 'failed_logins' => $row->failed_logins ) );

				}

				// 10.2: removed obsolete - delete after using as reference for BPS free
				/*
				// Network/Multisite subsites - logging is not used/allowed
				if ( is_multisite() && $blog_id != 1 ) {
					// do nothing
				} else {

				// 10.2: added condition so that alerts are not displayed: && $status == 'Locked'
				// maybe for logging all logins the alert should be displayed for both locked and not locked?
				//if ( file_exists($LSA_Reset_file) && $status == 'Locked' ) {			
				if ( file_exists($LSA_Reset_file) ) {			
					file_put_contents($LSA_Reset_file, "Login Security Alerts");
				}
				}
			//} // end if ( $update_rows = $wpdb->update...			
			*/
		
		} // end if ( $wpdb->num_rows != 0...
} // end $BPSoptions['bps_login_security_logging'] == 'logAll') {...

/* 
*******************************************************************************************************************
// Log Only Account Lockouts for valid Users
// X failed attempts in any X amount of time = account is locked period - Duration/threshold is totally unnecessary
*******************************************************************************************************************
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && $BPSoptions['bps_login_security_logging'] == 'logLockouts' ) {

	$user = get_user_by( 'login', $username );
	$LoginSecurityRows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %d", $user->ID ) );

		foreach ( $LoginSecurityRows as $row ) {
	
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] && $BPSoptions['bps_login_security_errors'] != 'genericAll' ) { 
				$error = new WP_Error();
				$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
		
				return $error;
			}
			
			if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] && $BPSoptions['bps_login_security_errors'] == 'genericAll' ) { 
				return new WP_Error('incorrect_password', sprintf(__('<strong>ERROR</strong>: Invalid Entry. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
			}
		}

		// CAPTCHA / Bot Trap / DoS/DDos Protection / Brute Force Login Protection - incorrect CAPTCHA entered stops Login processing
		if ( $BPSoptionsJTC['bps_jtc_login_form'] == '1' ) {
			
			if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
				$error = new WP_Error();
				$error->add( 'captcha_error', __('<strong>ERROR</strong>: Incorrect CAPTCHA Entered.', 'bulletproof-security') );
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Login Form - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Login Form - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
			return $error;
			}
		}		
		
		// Bad Login - DB Row does NOT Exist - First bad login attempt = $failed_logins = '1';
		if ( $wpdb->num_rows == 0 && $user->ID != 0 && ! wp_check_password($password, $user->user_pass, $user->ID) ) {
			$failed_logins = '1';

			// Insane, but someone will do this... if max bad retries is set to 1
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock' ) {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .=  '<p><strong>If your User Account is locked and you are unable to login to your website:</strong> Use FTP or your web host control panel file manager and rename the /bulletproof-security plugin folder name to /_bulletproof-security. Log into your website. Rename the /_bulletproof-security plugin folder name back to /bulletproof-security. Go to the BPS Login Security page and unlock your User Account.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			}
			
			} else {		
				$status = 'Not Locked';			
			}

			if ( $insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) ) ) {	

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {
			
			if ( file_exists($LSA_Reset_file) ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}
			}
			} // end if ( $insert_rows = $wpdb->insert...
		} // end if ( $wpdb->num_rows == 0...	

			// 10.2: Good Login - DB Row Exists - Status == Not Locked - Reset lockout time and failed logins to 0
			// Update all rows for the user id on good login
			if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status == 'Not Locked' ) {				

				$update_rows = $wpdb->update( $bpspro_login_table, array( 'lockout_time' => '0', 'failed_logins' => '0' ), array( 'user_id' => $row->user_id ) );		
			}
			
			// Good Login - DB Row Exists & status is Locked - Reset Only a locked out account on good login if it was locked and the lockout time has expired
			if ( $wpdb->num_rows != 0 && $user->ID != 0 && wp_check_password($password, $user->user_pass, $user->ID) && $row->status == 'Locked' && $timeNow > $row->lockout_time ) {				
				$status = 'Not Locked';			
				$lockout_time = '0';
				$failed_logins = '0';

			//if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id ) ) ) {	
			
			if ( $update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id, 'status' => 'Locked' ) ) ) {	

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			if ( file_exists($LSA_Reset_file) ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}
			
			if ( $options['bps_login_security_email'] == 'anyUserLoginLock' ) {
				$message = '<p><font color="blue"><strong>A User Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>';

				wp_mail($bps_email_to, $subject, $message, $headers);
			}

			// Option adminLoginOnly - Send Email Alert if an Administrator Logs in
			if ( $options['bps_login_security_email'] == 'adminLoginOnly' || $options['bps_login_security_email'] == 'adminLoginLock' && $user->roles[0] == 'administrator' ) {
				$message = '<p><font color="blue"><strong>An Administrator Has Logged in</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}			
			}
			} // end if ( $update_rows = $wpdb->update...
		} // end if ( $wpdb->num_rows != 0...

		// Bad Login - DB Row Exists - Count bad login attempts and Lock Account
		if ( $wpdb->num_rows != 0 && $user->ID != 0 && ! wp_check_password($password, $user->user_pass, $user->ID) ) {

			foreach ( $LoginSecurityRows as $row ) {

				if ( $row->status == 'Locked' && $timeNow < $row->lockout_time && $row->failed_logins >= $BPSoptions['bps_max_logins'] ) { // greater > for testing
					$error = new WP_Error();
					$error->add('locked_account', __('<strong>ERROR</strong>: This user account has been locked until <strong>'.date_i18n(get_option('date_format').' '.get_option('time_format'), $row->lockout_time + $gmt_offset).'</strong> due to too many failed login attempts. You can login again after the Lockout Time above has expired.'));
			
					return $error;
				}
					$failed_logins = $row->failed_logins;

				if ( $row->failed_logins == 0 ) {
					for ($failed_logins = 0; $failed_logins <= 0; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					} 
				} elseif ( $row->failed_logins == 1 ) {
					for ($failed_logins = 1; $failed_logins <= 1; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 2 ) {
					for ($failed_logins = 2; $failed_logins <= 2; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 3 ) {
					for ($failed_logins = 3; $failed_logins <= 3; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 4 ) {
					for ($failed_logins = 4; $failed_logins <= 4; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 5 ) {
					for ($failed_logins = 5; $failed_logins <= 5; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 6 ) {
					for ($failed_logins = 6; $failed_logins <= 6; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 7 ) {
					for ($failed_logins = 7; $failed_logins <= 7; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 8 ) {
					for ($failed_logins = 8; $failed_logins <= 8; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				} elseif ( $row->failed_logins == 9 ) {
					for ($failed_logins = 9; $failed_logins <= 9; $failed_logins++) {
    					$failed_logins;
						$remaining = $BPSoptions['bps_max_logins'] - $failed_logins - 1;
					}
				}
			} // end foreach
			
			if ( $failed_logins >= $BPSoptions['bps_max_logins'] ) {
				$status = 'Locked';
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			if ( $options['bps_login_security_email'] == 'lockoutOnly' || $options['bps_login_security_email'] == 'anyUserLoginLock' || $options['bps_login_security_email'] == 'adminLoginLock' ) {
				$message = '<p><font color="red"><strong>A User Account Has Been Locked</strong></font></p>';
				$message .=  '<p>To take further action go to the BPS Pro Login Security page. If no action is taken then the User will be able to try and login again after the Lockout Time has expired. If you do not want to receive further email alerts go to S-Monitor and change or turn off Login Security Email Alerts.</p>';
				$message .=  '<p><strong>If your User Account is locked and you are unable to login to your website:</strong> Use FTP or your web host control panel file manager and rename the /bulletproof-security plugin folder name to /_bulletproof-security. Log into your website. Rename the /_bulletproof-security plugin folder name back to /bulletproof-security. Go to the BPS Login Security page and unlock your User Account.</p>';
				$message .= '<p><strong>Username:</strong> '.$user->user_login.'</p>'; 
				$message .= '<p><strong>Status:</strong> '.$status.'</p>'; 
				$message .= '<p><strong>Role:</strong> '.$user->roles[0].'</p>'; 
				$message .= '<p><strong>Email:</strong> '.$user->user_email.'</p>'; 
				$message .= '<p><strong>Lockout Time:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $login_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>Lockout Time Expires:</strong> '.date_i18n(get_option('date_format').' '.get_option('time_format'), $lockout_time + $gmt_offset).'</p>'; 
				$message .= '<p><strong>User IP Address:</strong> '.$ip_address.'</p>'; 
				$message .= '<p><strong>User Hostname:</strong> '.$hostname.'</p>'; 
				$message .= '<p><strong>Request URI:</strong> '.$request_uri.'</p>'; 
				$message .= '<p><strong>Site:</strong> '.$justUrl.'</p>'; 

				wp_mail($bps_email_to, $subject, $message, $headers);
			}
			}
			
			} else {	
				$status = 'Not Locked';
			}
			
			
			// 10.2: Insert a new row on first bad login attempt. After that update that same row
			if ( $failed_logins == 1 ) {
				
				$insert_rows = $wpdb->insert( $bpspro_login_table, array( 'status' => $status, 'user_id' => $user->ID, 'username' => $user->user_login, 'public_name' => $user->display_name, 'email' => $user->user_email, 'role' => $user->roles[0], 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $ip_address, 'hostname' => $hostname, 'request_uri' => $request_uri ) );		
					
			} else {
				
				$no_zeros = '0';
				$LSM_zero_filter = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $bpspro_login_table WHERE user_id = %d AND failed_logins != %d", $user->ID, $no_zeros ) );
				
				$update_rows = $wpdb->update( $bpspro_login_table, array( 'status' => $status, 'user_id' => $row->user_id, 'username' => $row->username, 'public_name' => $row->public_name, 'email' => $row->email, 'role' => $row->role, 'human_time' => current_time('mysql'), 'login_time' => $login_time, 'lockout_time' => $lockout_time, 'failed_logins' => $failed_logins, 'ip_address' => $row->ip_address, 'hostname' => $row->hostname, 'request_uri' => $row->request_uri ), array( 'user_id' => $row->user_id, 'failed_logins' => $row->failed_logins ) );

			}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			// 10.2: correction: condition: alerts are only displayed when $status == 'Locked'
			if ( file_exists($LSA_Reset_file) && $status == 'Locked' ) {			
				file_put_contents($LSA_Reset_file, "Login Security Alerts");
			}		
			}
		} // end if ( $wpdb->num_rows != 0...
} // end $BPSoptions['bps_login_security_logging'] == 'logLockouts') {...

/*
****************************************************
// WordPress Standard Authentication Processing Code
// with Generic Error Message display options
****************************************************
*/
if ( $BPSoptions['bps_login_security_OnOff'] == 'On' && isset( $_POST['wp-submit'] ) ) {

	// if a user does not set/save this option then default to WP Errors
	if ( !$user && !$BPSoptions['bps_login_security_errors'] ) {
		return new WP_Error('invalid_username', sprintf(__('<strong>ERROR</strong>: Invalid username. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
	}

	if ( !$user && $BPSoptions['bps_login_security_errors'] == 'wpErrors' ) {
		return new WP_Error('invalid_username', sprintf(__('<strong>ERROR</strong>: Invalid username. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
	}
	
	if ( !$user && $BPSoptions['bps_login_security_errors'] == 'generic' ) {
		return new WP_Error('invalid_username', sprintf(__('<strong>ERROR</strong>: Invalid Entry. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
	}
	
	if ( !$user && $BPSoptions['bps_login_security_errors'] == 'genericAll' ) {
		return new WP_Error('invalid_username', sprintf(__('<strong>ERROR</strong>: Invalid Entry. <a href="%s" title="Password Lost and Found">Lost your password</a>?'), wp_lostpassword_url()));
	}

	$user = apply_filters('wp_authenticate_user', $user, $password);
	if ( is_wp_error($user) ) 
		return $user;

	// if a user does not set/save this option then default to WP Errors
	if ( !wp_check_password($password, $user->user_pass, $user->ID) && !$BPSoptions['bps_login_security_errors'] ) {
		
		return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ), $username, wp_lostpassword_url() ) );		
	}

	if ( !wp_check_password($password, $user->user_pass, $user->ID) && $BPSoptions['bps_login_security_errors'] == 'wpErrors' ) {
		
		if ( $BPSoptions['bps_login_security_remaining'] == 'On' ) {
		
			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s" title="Password Lost and Found">Lost your password</a>? Login Attempts Remaining <strong>%3$d</strong>' ), $username, wp_lostpassword_url(), $remaining ) );		
		
		} else {

			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ), $username, wp_lostpassword_url() ) );

		}
	}
	
	if ( !wp_check_password($password, $user->user_pass, $user->ID) && $BPSoptions['bps_login_security_errors'] == 'generic' ) {	

		if ( $BPSoptions['bps_login_security_remaining'] == 'On' ) {

			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: Invalid Entry. <a href="%2$s" title="Password Lost and Found">Lost your password</a>? Login Attempts Remaining <strong>%3$d</strong>' ), $username, wp_lostpassword_url(), $remaining ) );
		
		} else {	
		
			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: Invalid Entry. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ), $username, wp_lostpassword_url() ) );	
		
		}
	}
	
	if ( !wp_check_password($password, $user->user_pass, $user->ID) && $BPSoptions['bps_login_security_errors'] == 'genericAll' ) {	

		if ( $BPSoptions['bps_login_security_remaining'] == 'On' ) {

			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: Invalid Entry. <a href="%2$s" title="Password Lost and Found">Lost your password</a>? Login Attempts Remaining <strong>%3$d</strong>' ), $username, wp_lostpassword_url(), $remaining ) );

		} else {

			return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: Invalid Entry. <a href="%2$s" title="Password Lost and Found">Lost your password</a>?' ), $username, wp_lostpassword_url() ) );		
		
		}
	}

	return $user;
}
}

/************************************************/
// Disable/Enable Password Reset Frontend/Backend
// Independent Password Reset Option added BPS Pro 9.2
// Removes a lot of Cool WP features, but
// if Stealth Mode is desired then oh well
/************************************************/

if ( $BPSoptions['bps_login_security_OnOff'] != 'Off' ) {

if ( $BPSoptions['bps_login_security_OnOff'] == 'pwreset' || $BPSoptions['bps_login_security_OnOff'] == 'On' ) {

	$pw_reset = '1';

} else {

	$pw_reset = '0';
}

switch ( $pw_reset ) {

    case ( $pw_reset == '1' && $BPSoptions['bps_login_security_pw_reset'] == 'disableFrontend' ):
		
		if ( !is_admin() ) {
		
		function bpspro_disable_password_reset() { 
			return false; 
		}
		add_filter( 'allow_password_reset', 'bpspro_disable_password_reset' );

		function bpspro_show_password_fields() { 
			return false; 
		}
		add_filter( 'show_password_fields', 'bpspro_show_password_fields' );

		function bpspro_remove_pw_text($text) {
			return str_replace( array('Lost your password?', 'Lost your password'), '', trim($text, '?') ); 
		}
		add_filter( 'gettext', 'bpspro_remove_pw_text' ); 

		// Replace invalidcombo error - valid user account / invalid user account same exact result 
		function bpspro_login_error_invalidcombo($text) { 
			return str_replace( '<strong>ERROR</strong>: Invalid username or e-mail.', 'Password reset is not allowed for this user', $text ); 
		}
		add_filter ( 'login_errors', 'bpspro_login_error_invalidcombo');

		// Replace invalid_email error - valid email / invalid email same exact result
		function bpspro_login_error_invalid_email($text) { 
			return str_replace( '<strong>ERROR</strong>: There is no user registered with that email address.', 'Password reset is not allowed for this user', $text );
		}
		add_filter ( 'login_errors', 'bpspro_login_error_invalid_email');

		// Removes WP Shake It so that no indication is given of good/bad value/entry
		function bpspro_remove_shake() {
			remove_action( 'login_head', 'wp_shake_js', 12 );	
		}
		add_filter ( 'shake_error_codes', 'bpspro_remove_shake');	
		}	
		break;
    case ( $pw_reset == '1' && $BPSoptions['bps_login_security_pw_reset'] == 'disable' ):
		
		function bpspro_disable_password_reset() { 
			return false; 
		}
		add_filter( 'allow_password_reset', 'bpspro_disable_password_reset' );

		function bpspro_show_password_fields() { 
			return false; 
		}
		add_filter( 'show_password_fields', 'bpspro_show_password_fields' );

		function bpspro_remove_pw_text($text) {
			return str_replace( array('Lost your password?', 'Lost your password'), '', trim($text, '?') ); 
		}
		add_filter( 'gettext', 'bpspro_remove_pw_text' ); 

		// Replace invalidcombo error - valid user account / invalid user account same exact result 
		function bpspro_login_error_invalidcombo($text) { 
			return str_replace( '<strong>ERROR</strong>: Invalid username or e-mail.', 'Password reset is not allowed for this user', $text ); 
		}
		add_filter ( 'login_errors', 'bpspro_login_error_invalidcombo');

		// Replace invalid_email error - valid email / invalid email same exact result
		function bpspro_login_error_invalid_email($text) { 
			return str_replace( '<strong>ERROR</strong>: There is no user registered with that email address.', 'Password reset is not allowed for this user', $text );
		}
		add_filter ( 'login_errors', 'bpspro_login_error_invalid_email');

		// Removes WP Shake It so that no indication is given of good/bad value/entry
		function bpspro_remove_shake() {
			remove_action( 'login_head', 'wp_shake_js', 12 );	
		}
		add_filter ( 'shake_error_codes', 'bpspro_remove_shake');
		break;
 	}
}

/************************************************/
// SQS Brute Force Protection 
// maybe later - this conflicts with other things
// and would need to be built up sufficiently
// this could also cause a lot of problems for 
// other things if not done well
/************************************************/
/*
// http://aitpro-blog.local/wp-login.php?mySecretString=foobar
function bpsPro_SQS_brute_force_login_protection() {
$QS = '?mySecretString=foobar';
$theRequest = 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'wp-login.php' . '?'. $_SERVER['QUERY_STRING'];
$allowed_hosts = array( 'aitpro-blog.local' );

	if ( !isset( $_SERVER['HTTP_HOST'] ) || !in_array( $_SERVER['HTTP_HOST'], $allowed_hosts ) ) {
    	header( $_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request' );
    	exit;
	}

	if ( site_url('/wp-login.php'.$QS ) == $theRequest ) {
		echo 'Query string matches';
	} else {
		header( 'Location: http://' . $_SERVER['HTTP_HOST'] . '/' );
	}
}
add_action('login_head', 'bpsPro_SQS_brute_force_login_protection');
*/

/********************************************/
// JTC Anti-Spam jQuery ToolTip CAPTCHA
// CAPTCHA Form Field
// SpamBot Trap Form Field
// DoS/DDoS Protection
// Brute Force Login Protection
// CAPTCHA Logging
// pending Token/SESSION
// NextGen Gallery Fix: Disable Resource Manager on Forms
/*********************************************/

$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');

// Login Form
// NOTE: The Login Form CAPTCHA Validation, Logging and Errors are processed in bpspro_wp_authenticate_username_password( $user, $username, $password );
// NOTE: DO NOT use - isset( $_POST['wp-submit'] ) here or it will break the BuddyPress /wp-admin redirect to /wp-login.php
if ( $BPSoptionsJTC['bps_jtc_login_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_login() {
	wp_enqueue_script('jquery-ui-tooltip');	
}
add_action( 'login_enqueue_scripts', 'bps_enqueue_tooltip_script_login', 1 );

add_action('login_form', 'bps_captcha_login_form_field');

function bps_captcha_login_form_field() {
global $wp_version;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// SpamBot Trap/Decoy Form Field 
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';

	?>
    <p>
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?><br />
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </p>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:8px;
	width:256px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:256px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}
body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:8px;
	width:246px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:246px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}
body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } }

}

// WordPress Register/Registration Form
if ( $BPSoptionsJTC['bps_jtc_register_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_register() {
	wp_enqueue_script('jquery-ui-tooltip');	
}
add_action( 'login_enqueue_scripts', 'bps_enqueue_tooltip_script_register', 1 );

add_action('register_form', 'bps_captcha_registration_form_field');

function bps_captcha_registration_form_field() {
global $wp_version;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// SpamBot Trap/Decoy Form Field 
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';
	?>
    <p>
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?><br />
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </p>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:260px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:260px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:250px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:250px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width: 2px;
}
-->
</style>

<?php } }

add_filter('registration_errors', 'bps_captcha_registration_form_validation', 10, 3);

// WordPress Register/Registration Form
function bps_captcha_registration_form_validation($errors, $sanitized_user_login, $user_email) {
global $blog_id;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

	// Incorrect CAPTCHA or SpamBot Trap entered stops Register processing
	if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
		$errors->add( 'captcha_error', __('<strong>ERROR</strong>: Incorrect CAPTCHA Entered.', 'bulletproof-security') );
	
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[WP Register Form - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[WP Register Form - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
	}
	return $errors;
}
}

// Lost Password Form
if ( $BPSoptionsJTC['bps_jtc_lostpassword_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_lost_password() {
	wp_enqueue_script('jquery-ui-tooltip');	
}
add_action( 'login_enqueue_scripts', 'bps_enqueue_tooltip_script_lost_password', 1 );

add_action('lostpassword_form', 'bps_captcha_lostpassword_form_field');

function bps_captcha_lostpassword_form_field() {
global $wp_version;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// Decoy - NOT the actual CAPTCHA variable  
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';
	?>
    <p>
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?><br />
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </p>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:8px;
	width:256px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:256px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:8px;
	width:246px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:246px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } }

add_action('lostpassword_post', 'bps_captcha_lostpassword_form_validation');

// WordPress Lost Password Form
function bps_captcha_lostpassword_form_validation() {
global $wpdb, $blog_id;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

	//ONLY do CAPTCHA processing if WP is done processing  
	
	if ( strpos( $_POST['user_login'], '@' ) ) {
		$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
	} else {
		$login = trim( $_POST['user_login'] );
		$user_data = get_user_by('login', $login);
	}
			
	if ( empty( $_POST['user_login'] ) ) {
 		return;
	} elseif ( !empty( $_POST['user_login'] ) && empty( $user_data ) ) {
 		return;
	} elseif ( !empty( $_POST['user_login'] ) && !empty( $user_data ) && $_POST['reference'] == $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['captcha'] == '' ) {
 		return;	
	
	} else {
	
	// // Incorrect CAPTCHA or SpamBot Trap entered stops Lost Password processing
	if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
			
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Lost Password Form - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
		}
		
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Lost Password Form - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
		}
	} 
	wp_die( __('<strong>ERROR</strong>: Incorrect JTC CAPTCHA Entered. Click your Browser\'s back button and re-enter the JTC CAPTCHA.', 'bulletproof-security'));
	} 
}
}

// Comment Form
if ( $BPSoptionsJTC['bps_jtc_comment_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_comment_form() {
	wp_enqueue_script('jquery-ui-tooltip');	
}
add_action( 'wp_enqueue_scripts', 'bps_enqueue_tooltip_script_comment_form', 1 );

add_action('comment_form', 'bps_captcha_comment_form_field', 1);

function bps_captcha_comment_form_field() {
global $current_user, $wp_version;
get_currentuserinfo();
$user_info = get_userdata($current_user->ID);
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// Decoy - NOT the actual CAPTCHA variable  
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';
	
	if ( ! $BPSoptionsJTC['bps_jtc_comment_form_label'] || $BPSoptionsJTC['bps_jtc_comment_form_label'] == '' ) {
		$comment_form_label = 'position:relative;top:0px;left:0px;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;';
	} else {
		$comment_form_label = $BPSoptionsJTC['bps_jtc_comment_form_label'];
	}
	if ( ! $BPSoptionsJTC['bps_jtc_comment_form_input'] || $BPSoptionsJTC['bps_jtc_comment_form_input'] == '' ) {
		$comment_form_input = 'position:relative;top:0px;left:0px;padding:0px 0px 0px 0px;margin:0px 0px 0px 0px;';
	} else {
		$comment_form_input = $BPSoptionsJTC['bps_jtc_comment_form_input'];
	}	
	
	// CAPTCHA is not displayed if username, email or registration is not required
	if ( is_user_logged_in() ) {
		if ( $user_info->user_level == 10 && $BPSoptionsJTC['bps_jtc_administrator'] == '1' || $user_info->user_level == 7 && $BPSoptionsJTC['bps_jtc_editor'] == '1' || $user_info->user_level == 2 && $BPSoptionsJTC['bps_jtc_author'] == '1' || $user_info->user_level == 1 && $BPSoptionsJTC['bps_jtc_contributor'] == '1' || $user_info->user_level == 0 && $BPSoptionsJTC['bps_jtc_subscriber'] == '1' ) {
	?>
    <p>
    <?php echo "<div id=\"bps-jtc-comment-form-label\" style=\"" . $comment_form_label . "\">"; ?>
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?></label>
    </div>
    <?php echo "<div id=\"bps-jtc-comment-form-input\" style=\"" . $comment_form_input . "\">"; ?>
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" />
    </div>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </p>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:250px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:250px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:250px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:250px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } } }

if ( !is_user_logged_in() && get_option('require_name_email') == '1' ) {

	?>
    <p>
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?><br />
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </p>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:250px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:250px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:250px;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:250px;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } }

}

add_filter( 'preprocess_comment', 'bps_captcha_comment_form_validation' );	

// Comment Form
function bps_captcha_comment_form_validation( $commentdata ) {
global $current_user, $blog_id;
get_currentuserinfo();
$user_info = get_userdata($current_user->ID);
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';

	// ONLY do CAPTCHA processing if WP is done processing 

	$user = wp_get_current_user();
	
	if ( get_option('comment_registration') == '1' && !is_user_logged_in() ) {
 		return $commentdata;	
	} 

	if ( is_user_logged_in() ) {

 	if ( $_POST['reference'] === null ) {
		return $commentdata;
	}

	if ( $user->exists() && empty( $_POST['comment'] ) ) {
		return $commentdata;
	} 	
	
	if ( $user->exists() && !empty( $_POST['comment'] ) && $_POST['reference'] == $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['captcha'] == '' ) {
		return $commentdata;
	} 	

	// Incorrect CAPTCHA or SpamBot Trap entered stops Comment processing
	if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
			
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Comment Form User Is Logged In - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
		}			
			
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Comment Form User Is Logged In - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
		}		
	
		if ( ! $BPSoptionsJTC['bps_jtc_comment_form_error'] || $BPSoptionsJTC['bps_jtc_comment_form_error'] == '' ) {
			wp_die( __('<strong>ERROR</strong>: Incorrect JTC CAPTCHA Entered. Click your Browser\'s back button and re-enter the JTC CAPTCHA.', 'bulletproof-security'));		
		} else {
			wp_die( __($BPSoptionsJTC['bps_jtc_comment_form_error']) );			
		}
	}	
	
	} else {
	
	if ( get_option('require_name_email') == '1' && empty( $_POST['author'] ) || empty( $_POST['email'] ) || empty( $_POST['comment'] ) ) {
		return $commentdata;
	}		
	
	if ( get_option('require_name_email') == '1' && !empty( $_POST['author'] ) && !empty( $_POST['email'] ) && !empty( $_POST['comment'] ) && $_POST['reference'] == $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['captcha'] == '' ) {
		return $commentdata;
	}
	
	// If a username, email or registration is not required on the site then obviously spam is ok too
	// No additional checks will be added for those conditions unless someone can give me a good reason to add those conditions

	// Incorrect CAPTCHA or SpamBot Trap entered stops Comment processing
	if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
			
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Comment Form User NOT Logged In - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
		}			
			
		if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[Comment Form User NOT Logged In - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

			if ( is_writable( $bpsProLog ) ) {

			if ( !$handle = fopen( $bpsProLog, 'a' ) ) {
         		exit;
    		}

    		if ( fwrite( $handle, $log_contents ) === FALSE ) {
       			exit;
    		}

    		fclose($handle);
			}
			}
		}		
	
		if ( ! $BPSoptionsJTC['bps_jtc_comment_form_error'] || $BPSoptionsJTC['bps_jtc_comment_form_error'] == '' ) {
			wp_die( __('<strong>ERROR</strong>: Incorrect JTC CAPTCHA Entered. Click your Browser\'s back button and re-enter the JTC CAPTCHA.', 'bulletproof-security'));		
		} else {
			wp_die( __($BPSoptionsJTC['bps_jtc_comment_form_error']) );
		}	
	}
	}
}
}

// BuddyPress Register/Registration Form
if ( function_exists('bp_is_active') && $BPSoptionsJTC['bps_jtc_buddypress_register_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_buddypress_register() {
	wp_enqueue_script('jquery-ui-tooltip');	
}

add_filter('wp_enqueue_scripts', 'bps_enqueue_tooltip_script_buddypress_register');

add_action('bp_signup_validate', 'bps_captcha_buddypress_register_form_validation');

function bps_captcha_buddypress_register_form_validation() {	
global $bp, $blog_id;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
$hostname = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
$timeNow = time();
$gmt_offset = get_option( 'gmt_offset' ) * 3600;
$timestamp = date_i18n(get_option('date_format'), strtotime("11/15-1976")) . ' - ' . date_i18n(get_option('time_format'), $timeNow + $gmt_offset);
$bpsProLog = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';
	
	// Incorrect CAPTCHA or SpamBot Trap entered stops Register processing
	if ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] || $_POST['captcha'] != '' ) {
		
		$bp->signup->errors['reference'] = __('ERROR: Incorrect CAPTCHA Entered.', 'buddypress');
	
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}
			
			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {
			
			$log_contents = "\r\n" . '[BuddyPress Register Form - POST Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}
			
			if ( $BPSoptionsJTC['bps_tooltip_captcha_logging'] == 'On' && $_SERVER['REQUEST_METHOD'] != 'POST' ) {

				if ( $_POST['captcha'] != '' ) {
					$spambot = 'Confirmed SpamBot - Bot Trap Value Entered: '.$_POST['captcha'];
				}
				elseif ( $_POST['reference'] == '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a SpamBot';
				}	
				elseif ( $_POST['reference'] != $BPSoptionsJTC['bps_tooltip_captcha_key'] && $_POST['reference'] != '' && $_POST['captcha'] == '' ) {
					$spambot = 'Most Likely a Human But Could Be a SpamBot';
				}

			// Network/Multisite subsites - logging is not used/allowed
			if ( is_multisite() && $blog_id != 1 ) {
				// do nothing
			} else {

			$log_contents = "\r\n" . '[BuddyPress Register Form - GET, HEAD, OTHER Request Logged: ' . $timestamp . ']' . "\r\n" . 'CAPTCHA Entered: ' . $_POST['reference'] . "\r\n" . 'BOT/HUMAN: ' . $spambot . "\r\n" . 'REMOTE_ADDR: '.$_SERVER['REMOTE_ADDR']."\r\n" . 'Host Name: ' . $hostname . "\r\n" . 'SERVER_PROTOCOL: '.$_SERVER['SERVER_PROTOCOL']."\r\n" . 'HTTP_CLIENT_IP: '.$_SERVER['HTTP_CLIENT_IP']."\r\n" . 'HTTP_FORWARDED: '.$_SERVER['HTTP_FORWARDED']."\r\n" . 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR']."\r\n" . 'HTTP_X_CLUSTER_CLIENT_IP: '.$_SERVER['HTTP_X_CLUSTER_CLIENT_IP']."\r\n" . 'REQUEST_METHOD: '.$_SERVER['REQUEST_METHOD']."\r\n" . 'HTTP_REFERER: '.$_SERVER['HTTP_REFERER']."\r\n" . 'REQUEST_URI: '.$_SERVER['REQUEST_URI']."\r\n" . 'QUERY_STRING: '.$_SERVER['QUERY_STRING']."\r\n" . 'HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT']."\r\n";

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
			}		
	}
	return;
}

add_action('bp_after_signup_profile_fields', 'bps_captcha_buddypress_register_form_field');

// BuddyPress Register Form
function bps_captcha_buddypress_register_form_field() {
global $wp_version;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// Decoy - NOT the actual CAPTCHA variable  
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';
	?>
    <div id="bps-buddypress-jtc-container-register">
    <h4><label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?></label></h4>
	<?php do_action('bp_reference_errors'); ?>
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </div>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
#bps-buddypress-jtc-container-register { 
	float:left;
	clear:left;
	width:48%;
	margin:12px 0; 
}

#bps-buddypress-jtc-container-register .input { }

.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:40%;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:40%;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
#bps-buddypress-jtc-container-register { 
	float:left;
	clear:left;
	width:48%;
	margin:12px 0; 
}

#bps-buddypress-jtc-container-register .input { }

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:40%;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:40%;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } }

}

// BuddyPress Sidebar Login Form - The Sidebar Form submits/POSTs to the wp-login.php Form automatically
// Sidebar Form validation is already handled without having to create any additional BuddyPress actions
if ( function_exists('bp_is_active') && $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] == '1' ) {

/** NextGen Gallery Fix **/
if ( preg_match( '/wp-login\.php/', $_SERVER['REQUEST_URI'], $matches ) ) {
	if ( ! defined( 'NGG_DISABLE_RESOURCE_MANAGER' ) ) {
		define( 'NGG_DISABLE_RESOURCE_MANAGER', true );
	}
}

function bps_enqueue_tooltip_script_buddypress_sidebar_login() {
	wp_enqueue_script('jquery-ui-tooltip');	
}

add_filter('wp_enqueue_scripts', 'bps_enqueue_tooltip_script_buddypress_sidebar_login');

add_action('bp_sidebar_login_form', 'bps_captcha_buddypress_sidebar_form_field');

function bps_captcha_buddypress_sidebar_form_field() {
global $wp_version;
$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');
    // This is the CAPTCHA Form Field
	$reference = ( isset( $_POST['reference'] ) ) ? $_POST['reference'] : '';
	// Decoy - NOT the actual CAPTCHA variable  
	$captcha = ( isset( $_POST['captcha'] ) ) ? $_POST['captcha'] : '';
	?>
    <div id="bps-buddypress-jtc-container-sidebar">
    <label for="reference"><?php echo $BPSoptionsJTC['bps_tooltip_captcha_title']; ?></label>
	<?php do_action('bp_reference_errors'); ?>
    <input type="text" name="reference" id="reference" class="input" title="<?php echo $BPSoptionsJTC['bps_tooltip_captcha_hover_text']; ?>" value="<?php echo esc_attr(stripslashes($reference)); ?>" /></label>
    <input type="text" name="captcha" id="captcha" class="input" value="<?php echo esc_attr(stripslashes($captcha)); ?>" style="display: none;" />
    </div>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$( "#reference" ).tooltip({ 
		show: 500,
		hide: 500,
		tooltipClass: "bps-custom-tooltip-style",
		position: { 
			my: "left center", 
			at: "left bottom+20",
			//of: "#targetElement",
			collision: "flipfit flip"
		},
      	open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 11 }, 500 );
      	}
	});
});
/* ]]> */
</script>

<?php if ( version_compare( $wp_version, '3.8', '>=' ) ) { ?>

<style>
<!--
#bps-buddypress-jtc-container-sidebar { 
	/* position:relative; top:-50px; left:0px; */
	float:left;
	clear:left;
	width:100%;
	margin:0px 0px 5px 0px;
}

#bps-buddypress-jtc-container-sidebar .input { }

.ui-helper-hidden-accessible{display:none;}

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:10%;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:10%;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } else { ?>

<style>
<!--
#bps-buddypress-jtc-container-sidebar { 
	/* position:relative; top:-50px; left:0px; */
	float:left;
	clear:left;
	width:100%;
	margin:0px 0px 5px 0px;
}

#bps-buddypress-jtc-container-sidebar .input { }

.bps-custom-tooltip-style { 
	color:#000;
	font-weight:bold;
	background-color:#fff;
	padding:6px;
	width:10%;
	position:absolute;left:0px;top:0px;
	z-index:9999;
	max-width:10%;
	-webkit-box-shadow:0 0 5px #aaa;
	box-shadow:0 0 5px #aaa;
}

body .bps-custom-tooltip-style {
	border-width:2px;
}
-->
</style>

<?php } } } ?>