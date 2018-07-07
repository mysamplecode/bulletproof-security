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
	
// Form Processing: Rename|Create|Reset DB Backup Folder Location and DB Backup File Download Link|URL
function bpsPro_reset_db_backup_folder() {
	
	if ( isset( $_POST['Submit-DBB-Reset'] ) && current_user_can('manage_options') ) {
		check_admin_referer('bulletproof_security_db_backup_reset');

		$source = WP_CONTENT_DIR . '/bps-backup';

		if ( is_dir($source) ) {
		
			$options = get_option('bulletproof_security_options_db_backup');
			$new_db_backup_folder = $_POST['DBBFolderReset'];
	
			if ( $options['bps_db_backup_folder'] != '' ) {
		
				$db_backup_folder_name = preg_match( '/[a-zA-Z0-9-_]{1,}$/', $options['bps_db_backup_folder'], $matches );
				
				if ( ! rename( WP_CONTENT_DIR . '/bps-backup/' . $matches[0], WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder ) ) {
					
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<strong><font color="red">'.__('Error: Unable to rename the DB Backup folder.', 'bulletproof-security').'</font><br>'.__('Did you enter a valid DB Backup folder name? Valid folder naming characters are: Letters A to Z upper or lowercase. Numbers 0 to 9. A dash "-" or an underscore "_". Did you manually change the old DB Backup folder name using FTP?', 'bulletproof-security').'</strong>';
					echo $text;
					echo '</p></div>';
				
				} else {
		
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<font color="green"><strong>'.__('The DB Backup folder name has been renamed to: ', 'bulletproof-security').$new_db_backup_folder.'</strong></font><br>';
					
				
					echo $text;
					echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';					
					echo '</p></div>';
					
					$dbb_options = 'bulletproof_security_options_db_backup';
					$bps_db_backup_folder = addslashes( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder );
					$bps_db_backup_download_link = content_url( '/bps-backup/' ) . $new_db_backup_folder . '/';
		
					$DBB_Options = array(
					'bps_db_backup' 						=> $options['bps_db_backup'], 
					'bps_db_backup_description' 			=> $options['bps_db_backup_description'], 
					'bps_db_backup_folder' 					=> $bps_db_backup_folder, 
					'bps_db_backup_download_link' 			=> $bps_db_backup_download_link, 
					'bps_db_backup_job_type' 				=> $options['bps_db_backup_job_type'], 
					'bps_db_backup_frequency' 				=> $options['bps_db_backup_frequency'], 		 
					'bps_db_backup_start_time_hour' 		=> $options['bps_db_backup_start_time_hour'], 
					'bps_db_backup_start_time_weekday' 		=> $options['bps_db_backup_start_time_weekday'], 
					'bps_db_backup_start_time_month_date' 	=> $options['bps_db_backup_start_time_month_date'], 
					'bps_db_backup_email_zip' 				=> $options['bps_db_backup_email_zip'], 
					'bps_db_backup_delete' 					=> $options['bps_db_backup_delete'], 
					'bps_db_backup_status_display' 			=> $options['bps_db_backup_status_display'] 
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
			
			} else {

				if ( ! @mkdir( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder, 0755, true ) ) {
				
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<strong><font color="red">'.__('Error: Unable to create the DB Backup folder.', 'bulletproof-security').'</font><br>'.__('Go to the BPS System Info page File|Folder Permissions & UID checks table. Check the /wp-content/bps-backup/ folder permissions. The folder permissions should be 755 or 705. The Script Owner ID and File Owner ID should be the same matching ID. All of your other WordPress folders should also have the same matching ID\'s.', 'bulletproof-security').'</strong>';
					echo $text;
					echo '</p></div>';
				
				} else {
				
					echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
					$text = '<font color="green"><strong>'.__('The DB Backup folder: ', 'bulletproof-security').$new_db_backup_folder.__(' was created successfully.', 'bulletproof-security').'</strong></font>';
					echo $text;
					echo '<div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/db-backup-security/db-backup-security.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';	
					echo '</p></div>';
				
					@chmod( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder . '/', 0755 );
					@mkdir( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder . '/db-diff', 0755, true );
					@chmod( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder . '/db-diff/', 0755 );

					$dbb_options = 'bulletproof_security_options_db_backup';
					$bps_db_backup_folder = addslashes( WP_CONTENT_DIR . '/bps-backup/' . $new_db_backup_folder );
					$bps_db_backup_download_link = content_url( '/bps-backup/' ) . $new_db_backup_folder . '/';
		
					$DBB_Options = array(
					'bps_db_backup' 						=> $options['bps_db_backup'], 
					'bps_db_backup_description' 			=> $options['bps_db_backup_description'], 
					'bps_db_backup_folder' 					=> $bps_db_backup_folder, 
					'bps_db_backup_download_link' 			=> $bps_db_backup_download_link, 
					'bps_db_backup_job_type' 				=> $options['bps_db_backup_job_type'], 
					'bps_db_backup_frequency' 				=> $options['bps_db_backup_frequency'], 		 
					'bps_db_backup_start_time_hour' 		=> $options['bps_db_backup_start_time_hour'], 
					'bps_db_backup_start_time_weekday' 		=> $options['bps_db_backup_start_time_weekday'], 
					'bps_db_backup_start_time_month_date' 	=> $options['bps_db_backup_start_time_month_date'], 
					'bps_db_backup_email_zip' 				=> $options['bps_db_backup_email_zip'], 
					'bps_db_backup_delete' 					=> $options['bps_db_backup_delete'], 
					'bps_db_backup_status_display' 			=> $options['bps_db_backup_status_display'] 
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
		}
	}
}

?>