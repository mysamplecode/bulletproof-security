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
// Direct calls to this file are Forbidden when wp core files are not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

/*	The Copyright, AITpro Software Products License Information and Credit Where Credit Is Due information below must remain
	intact or all BulletProof Security Pro warranties, guarantees, liabilities are void.
	
	Copyright (C) 2011-2013 Edward Alexander, AIT-pro.com. All rights reserved.

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

// Pending - BPS Class for future versions of BPS Pro
if ( !class_exists('Bulletproof_Security') ) :
	class Bulletproof_Security {
	var $hook 		= 'bulletproof-security';
	var $filename	= 'bulletproof-security/bulletproof-security.php';
	var $longname	= 'BulletProof Security Settings';
	var $shortname	= 'BulletProof Security';
	var $optionname = 'BulletProof';
	var $options;
	var $errors;
}
$bpspro_url = 'http://api.ait-pro.com/';

function bulletproof_save_options() {
	return update_option('bulletproof_security', $this->options);
}

function bulletproof_set_error($code = '', $error = '', $data = '') {
	if ( empty($code) )
		$this->errors = new WP_Error();
	elseif ( is_a($code, 'WP_Error') )
		$this->errors = $code;
	elseif ( is_a($this->errors, 'WP_Error') )
		$this->errors->add($code, $error, $data);
	else
		$this->errors = new WP_Error($code, $error, $data);
}

function bulletproof_get_error($code = '') {
	if ( is_a($this->errors, 'WP_Error') )
	return $this->errors->get_error_message($code);
	return false;
	}

function bps_cuser_errorrs() {
	$bps_settings_updated = __('An Error has occurred. Your Settings were not saved.', 'bulletproof-security');
	return $bps_settings_updated;
	}
/*
function __eBPSNotUsed() {
	$language = '';
	$translation = '';
	$text = '';
	return $text;
}
*/
endif;

// wp-content ARQ Backup - filter out folders from being copied / backed up
class BPSCopyWPCRecursiveFilterIterator extends RecursiveFilterIterator {

	public static $FILTERS = array('uploads', 'upgrade', 'blogs.dir', 'bps-backup', 'w3tc', 'cache', 'plugins/si-captcha-for-wordpress/captcha/temp', 'plugins/jetpack', 'plugins', 'w3tc-config', 'w3tc-config/', 'bps-hard-exclude004', 'bps-hard-exclude005', 'bps-hard-exclude006', 'bps-hard-exclude007', 'bps-hard-exclude008', 'bps-hard-exclude009', 'bps-hard-exclude010', 'bps-hard-exclude011', 'bps-hard-exclude012', 'bps-hard-exclude013', 'bps-hard-exclude014', 'bps-hard-exclude015', 'bps-hard-exclude016', 'bps-hard-exclude017', 'bps-hard-exclude018', 'bps-hard-exclude019', 'bps-hard-exclude020');

	public function accept() {
		return !in_array( $this->getSubPathName(), self::$FILTERS, true );
	}
}

// wp-content Source Hardcoded ARQ Cron Exclude filters - temp or cache files hard excluded here
class BPSWPCSourceCronRecursiveFilterIterator extends RecursiveFilterIterator {

	public static $FILTERS = array('uploads', 'upgrade', 'blogs.dir', 'bps-backup', 'w3tc', 'cache', 'plugins/si-captcha-for-wordpress/captcha/temp', 'plugins/jetpack', 'plugins', 'w3tc-config', 'w3tc-config/', 'bps-hard-exclude004', 'bps-hard-exclude005', 'bps-hard-exclude006', 'bps-hard-exclude007', 'bps-hard-exclude008', 'bps-hard-exclude009', 'bps-hard-exclude010', 'bps-hard-exclude011', 'bps-hard-exclude012', 'bps-hard-exclude013', 'bps-hard-exclude014', 'bps-hard-exclude015', 'bps-hard-exclude016', 'bps-hard-exclude017', 'bps-hard-exclude018', 'bps-hard-exclude019', 'bps-hard-exclude020');
	
	public function accept() {
		return !in_array( $this->getSubPathName(), self::$FILTERS, true );
	}
}

// wp-content Backup Hardcoded ARQ Cron Exclude filters - temp or cache files hard excluded here
class BPSWPCBackupCronRecursiveFilterIterator extends RecursiveFilterIterator {

	public static $FILTERS = array('uploads', 'upgrade', 'blogs.dir', 'bps-backup', 'w3tc', 'cache', 'plugins/si-captcha-for-wordpress/captcha/temp', 'plugins/jetpack', 'plugins', 'w3tc-config', 'w3tc-config/', 'bps-hard-exclude004', 'bps-hard-exclude005', 'bps-hard-exclude006', 'bps-hard-exclude007', 'bps-hard-exclude008', 'bps-hard-exclude009', 'bps-hard-exclude010', 'bps-hard-exclude011', 'bps-hard-exclude012', 'bps-hard-exclude013', 'bps-hard-exclude014', 'bps-hard-exclude015', 'bps-hard-exclude016', 'bps-hard-exclude017', 'bps-hard-exclude018', 'bps-hard-exclude019', 'bps-hard-exclude020');

 	public function accept() {
		return !in_array( $this->getSubPathName(), self::$FILTERS, true );
	}
}

?>