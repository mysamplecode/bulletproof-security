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
	
// Root ARQ Delete - Delete AutoRestore Root files
function bps_rmdirRoot($source) {
if ( isset( $_POST['Submit-ARCM-Root-Delete'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ARCM_root_delete' );
	
	$time_start = microtime( true );	
	
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';

	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		
		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				@unlink($source.DIRECTORY_SEPARATOR.$file->getFilename());
			}
		}
	$text = '<strong><font color="green">'.__('The AutoRestore Root files have been deleted successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file delete to speed up file deletion.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'<br>'.__('IMPORTANT NOTE: Root Files should be backed again before turning the AutoRestore Cron back On.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
		echo '</p></div>';
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

// wp-admin ARQ Delete - Delete AutoRestore wp-admin directory and files
function bps_rmdirWpadmin($source) {
if ( isset( $_POST['Submit-ARCM-Wpadmin-Delete'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ARCM_wpadmin_delete' );
	
	$time_start = microtime( true );	
	
	$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="blue"><strong>'.__('No wp-admin files or folders were deleted. Go Daddy Managed WordPress hosting does not allow you to edit files in the wp-admin folder. The wp-admin folders and files are already protected on Go Daddy Managed WordPress Hosting so ARQ does not need to check the wp-admin folder.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		return;
	}

	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);		
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		
		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				@unlink($file);
			} else {
			if ( $file->isDir() )	{
				@rmdir($source);
			}
		}
	}
	$text = '<strong><font color="green">'.__('The AutoRestore wp-admin files have been deleted successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file delete to speed up file deletion.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'<br>'.__('IMPORTANT NOTE: wp-admin Files should be backed again before turning the AutoRestore Cron back On.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
		echo '</p></div>';
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

// wp-includes ARQ Delete - Delete AutoRestore wp-includes directory and files
function bps_rmdirWpincludes($source) {
if ( isset( $_POST['Submit-ARCM-Wpincludes-Delete'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ARCM_wpincludes_delete' );
	
	$time_start = microtime( true );

	$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="blue"><strong>'.__('No wp-includes files or folders were deleted. Go Daddy Managed WordPress hosting does not allow you to edit files in the wp-includes folder. The wp-includes folders and files are already protected on Go Daddy Managed WordPress Hosting so ARQ does not need to check the wp-includes folder.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		return;
	}

	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);	

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				@unlink($file);
			} else {
			if ( $file->isDir() ) {
				@rmdir($source);
			}
		}
	}
	$text = '<strong><font color="green">'.__('The AutoRestore wp-includes files have been deleted successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file delete to speed up file deletion.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'<br>'.__('IMPORTANT NOTE: wp-includes Files should be backed again before turning the AutoRestore Cron back On.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
		echo '</p></div>';
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

// wp-content ARQ Delete - Delete AutoRestore wp-content directory and files
function bps_rmdirWpcontent($source) {
if ( isset( $_POST['Submit-ARCM-Wpcontent-Delete'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ARCM_wpcontent_delete' );
	
	$time_start = microtime( true );	
	
	$source = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);	
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isFile() ) {
				@unlink($file);
			} else {
			if ( $file->isDir() ) {
				@rmdir($source);
			}
		}
	}
	$text = '<strong><font color="green">'.__('The AutoRestore wp-content files have been deleted successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file delete to speed up file deletion.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'<br>'.__('IMPORTANT NOTE: wp-content Files should be backed again before turning the AutoRestore Cron back On.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
		echo '</p></div>';
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