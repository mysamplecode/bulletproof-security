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
	
// Root ARQ Backup - Copy Root files to autorestore/root-files folder - rename .htaccess to auto_.htaccess
function bps_arcm_nonrecursive_copy_root($source, $dest) {
	if ( isset( $_POST['Submit-ARCM-RootNR'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ARCM_RootNR' );
		set_time_limit(300); // 250 + 30 = 280 leaving a 20 second buffer		
	
	$time_start = microtime( true );
	
	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/', 0755 );
	}

	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );
	$source = ABSPATH;
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files';
	
	if ( is_dir($source) ) {
		$iterator = new DirectoryIterator($source);

		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	
	// Code Contribution by Hansjörg Schwarz hansjoerg-schwarz@nefkom.net
	// Fixes a problem with open_basedir root directory restrictions
	// PHP Fatal error: Uncaught exception 'RuntimeException' with message 'SplFileInfo::isFile(): open_basedir restriction in effect.
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

	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
	
	$text = '<strong><font color="green">'.__('Your Root files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/root-files successfully.', 'bulletproof-security').'</font></strong>';
	echo $text;

	} else {

	$text = '<strong><font color="green">'.__('Your Root files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/root-files successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file backups to speed up file backups.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
	echo $text;
	}
	
	echo '</p></div>';
	
	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';	
	
	} // end is_dir
	}
}

// wp-admin ARQ Backup - Copy wp-admin folders and files to autorestore folder - maintain exact directory structure - rename .htaccess to wpadmin.htaccess
function bps_arcm_recursive_copy_wpadmin($source, $dest) {
	
	if ( isset( $_POST['Submit-ARCM-Wpadmin'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_ARCM_wpadmin' );
		set_time_limit(300); // 250 + 30 = 280 leaving a 20 second buffer	
	
	$time_start = microtime( true );

	if( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/', 0755 );
	}

	$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="blue"><strong>'.__('No wp-admin files or folders were backed up. Go Daddy Managed WordPress hosting does not allow you to edit files in the wp-admin folder. The wp-admin folders and files are already protected on Go Daddy Managed WordPress Hosting so ARQ does not need to check the wp-admin folder.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		return;
	}	

	$source = ABSPATH.'wp-admin';
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/';
	$htaccessARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/.htaccess';
	$htaccessARQRename = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );

	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);	
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		
		foreach ( $iterator as $file ) {
			if ( $file->isDir() ) {
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}
	
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		
	$text = '<strong><font color="green">'.__('Your wp-admin files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-admin successfully.', 'bulletproof-security').'</font></strong>';
	echo $text;

	} else {		
		
		$text = '<strong><font color="green">'.__('Your wp-admin files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-admin successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file backups to speed up file backups.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
	}
		
		echo '</p></div>';
	
	} else {
		copy($source, $dest);
	} // end is_dir
	
	if (file_exists($htaccessARQ)) {
		rename($htaccessARQ, $htaccessARQRename);
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

// wp-includes ARQ Backup - Copy wp-includes folders and files to autorestore folder - maintain exact directory structure
function bps_arcm_recursive_copy_wpincludes($source, $dest) {
	
	if ( isset( $_POST['Submit-ARCM-Wpincludes'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_ARCM_wpincludes' );
		set_time_limit(300); // 250 + 30 = 280 leaving a 20 second buffer		
	
	$time_start = microtime( true );

	if ( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/', 0755 );
	}

	$GDMW_options = get_option('bulletproof_security_options_GDMW');

	if ( $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="blue"><strong>'.__('No wp-includes files or folders were backed up. Go Daddy Managed WordPress hosting does not allow you to edit files in the wp-includes folder. The wp-includes folders and files are already protected on Go Daddy Managed WordPress Hosting so ARQ does not need to check the wp-includes folder.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</p></div>';
		return;
	}	

	$source = ABSPATH.'wp-includes';
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-includes/';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR );	
	
	if ( is_dir($source) ) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isDir() ) {
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}
		
	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		
	$text = '<strong><font color="green">'.__('Your wp-includes files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-includes successfully.', 'bulletproof-security').'</font></strong>';
	echo $text;

	} else {		
		
		$text = '<strong><font color="green">'.__('Your wp-includes files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-includes successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file backups to speed up file backups.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
	}		
		
		echo '</p></div>';
	
	} else {
		copy($source, $dest);
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

// wp-content ARQ Backup - Copy wp-content folders and files to autorestore folder - maintain exact directory structure
// Exclude: /bps-backup, /uploads, /upgrade & /blogs.dir
function bps_arcm_recursive_copy_wpcontent($source, $dest) {
	
	if ( isset( $_POST['Submit-ARCM-Wpcontent'] ) && current_user_can('manage_options') ) {
		check_admin_referer( 'bulletproof_security_ARCM_wpcontent' );
		set_time_limit(300); // 250 + 30 = 280 leaving a 20 second buffer	
		
	$time_start = microtime( true );

	if ( !is_dir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content' ) ) {
		@mkdir( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content', 0755, true );
		@chmod( WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/', 0755 );
	}

	$source = WP_CONTENT_DIR;
	$dest = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-content/';
	$bps_wpcontent_dir = str_replace( ABSPATH, '', WP_CONTENT_DIR);	
	
	if ( is_dir($source) ) {
		$dirItr    = new RecursiveDirectoryIterator($source);		
		$filterItr = new BPSCopyWPCRecursiveFilterIterator($dirItr);
		$iterator  = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST); 
		
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';

		foreach ( $iterator as $file ) {
			if ( $file->isDir() ) {
				@mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			} else {
				@copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
			}
		}

	$ARQoptions = get_option('bulletproof_security_options_ARCM');
	
	if ( $ARQoptions['bps_autorestore_cron_filecheck'] == 'Off' ) {
		
	$text = '<strong><font color="green">'.__('Your wp-content files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-content successfully.', 'bulletproof-security').'</font></strong>';
	echo $text;

	} else {		
		
		$text = '<strong><font color="green">'.__('Your wp-content files have been backed up to /', 'bulletproof-security').$bps_wpcontent_dir.__('/bps-backup/autorestore/wp-content successfully.', 'bulletproof-security').'</font><br>'.__('The Backup Date and Total Backup Files checks are turned off during file backups to speed up file backups.', 'bulletproof-security').'<br>'.__('Click the Refresh Status button to show your current updated Backup Date and Total Backup Files count.', 'bulletproof-security').'</strong><div class="bps-message-button" style="width:90px;"><a href="admin.php?page=bulletproof-security/admin/autorestore/autorestore.php">'.__('Refresh Status', 'bulletproof-security').'</a></div>';
		echo $text;
	}		
		
		echo '</p></div>';
	
	} else {
		@copy($source, $dest);
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