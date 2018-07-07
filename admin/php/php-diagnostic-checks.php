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

// PHP Diagnostic Checks / Recommendations - php.ini Options page
function bpsPHPDiagCheck1() {
if ( isset( $_POST['Submit-diagnostic-check1'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-diagnostic-check1' );
	set_time_limit(300); 
	
	$time_start = microtime( true );

	echo '<div id="diagnostic-background" style="max-height:250px;width:85%;overflow:auto;margin-top:10px;margin-bottom:20px;padding:10px;border:2px solid black;background-color:#ffffe0;">';
	
	$rootHtaccess = ABSPATH . '.htaccess';
	$check_string = @file_get_contents($rootHtaccess);
	$LoadedConfigFile = php_ini_loaded_file();
	//$path = $_SERVER['DOCUMENT_ROOT'] . '/'; // trying to search from the Document Root is just too much to ask
	$path = ABSPATH;	
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	$options = get_option('bulletproof_security_options_iniSet');
	$options2 = get_option('bulletproof_security_options2');	
	
	// Get DNS Name Server from [target] Root Domain
	// Note: This code runs fastest in this format vs nesting conditions
	if ( isset( $_SERVER['SERVER_NAME'] ) ) {
		$bpsHostName = esc_html($_SERVER['SERVER_NAME']);	
	} elseif ( isset( $_SERVER['HTTP_HOST'] ) ) {
		$bpsHostName = esc_html($_SERVER['HTTP_HOST']);	
	}

	$bpsTargetNS = '';
	$bpsTarget = '';

	$label_1 = preg_match( '/(([a-zA-Z0-9-])+\.){1}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_1 );
	$label_2 = preg_match( '/(([a-zA-Z0-9-])+\.){2}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_2 );
	$label_3 = preg_match( '/(([a-zA-Z0-9-])+\.){3}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_3 );

	@$domain_labels = array( $matches_1[0], $matches_2[0], $matches_3[0] );
	$labels = array_filter( $domain_labels, 'strlen' );

	foreach ( $labels as $domain ) {

		if ( filter_var( gethostbyname($domain), FILTER_VALIDATE_IP ) ) {

			$bpsGetDNS = @dns_get_record( $domain, DNS_NS );
	
			if ( empty( $bpsGetDNS[0]['target'] ) ) {
			
			} else {
				
				$bpsTargetNS = $bpsGetDNS[0]['target'];
			}
	
			if ( empty( $bpsTargetNS ) ) {
				
				@dns_get_record( $domain, DNS_ALL, $authns, $addtl );
		
				if ( empty( $authns[0]['target'] ) ) {

				} else {
					
					$bpsTarget = $authns[0]['target'];
				}
			}	
	
			if ( empty( $bpsTarget ) && empty( $bpsTargetNS ) ) {
				
				@dns_get_record( $domain, DNS_ANY, $authns, $addtl );
		
				if ( empty( $authns[0]['target'] ) ) {

				} else {
					
					$bpsTarget = $authns[0]['target'];
				}
			}
		}
	}

	//ob_start();
	//phpinfo();
	//$subject = ob_get_contents();
	//$pattern = '/Configuration\sFile\s\(php.ini\)\sPath(.*?)Loaded/is';
	//preg_match($pattern, $subject, $matches);
	//ob_end_clean();

	if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	
	$text = __('PHP Version: ', 'bulletproof-security').'<strong>'.PHP_VERSION.'</strong><br>';
	echo $text;
	
	if ( !strpos($check_string, "AddHandler") && !strpos($check_string, "SetEnv PHPRC") && !strpos($check_string, "suPHP_ConfigPath") && !strpos($check_string, "application/x-pair-sphp5") ) {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was Not found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}	

	echo 'Configuration File (php.ini) Path:<strong>'.__(' Click the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="_blank" title="Link opens in a new Browser window">'.__('View PHPINFO button on the PHP Info Viewer page', 'bulletproof-security').'</a>'.__(' to get this path.', 'bulletproof-security').'</strong><br>';
	//echo $matches[1];
	
	$text = __('Loaded Configuration File: ', 'bulletproof-security').'<strong>'.$LoadedConfigFile.'</strong><br><br>';
	echo $text;

	echo '<strong>'.__('php.ini, php5.ini & .user.ini File Search Results: ', 'bulletproof-security').'</strong>'.__('(Displays the file paths below if files were found)', 'bulletproof-security').'<br>';
	
	foreach ( $objects as $inifile ) {
		try {
			if ( $inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' || $inifile->getFilename() == '.user.ini' ) {
			if ( $inifile->getFilename() == 'php.ini' ) {
				$text = __('A Custom php.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;	
			}
			if ( $inifile->getFilename() == 'php5.ini' ) {
				$text = __('A Custom php5.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;			
			}
			if ( $inifile->getFilename() == '.user.ini' ) {
				$text = __('A Custom .user.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;	
			}
			} // if isFile and either php.ini, php5.ini or .user.ini
		} catch (RuntimeException $e) {}	
	} // end foreach

/*
	foreach ($objects as $inifile) {
		if ($inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' || $inifile->getFilename() == '.user.ini') {
		if ($inifile->getFilename() == 'php.ini') {
	$text = __('A Custom php.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;	
		}
		if ($inifile->getFilename() == 'php5.ini') {
	$text = __('A Custom php5.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;			
		}
		if ($inifile->getFilename() == '.user.ini') {
	$text = __('A Custom .user.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;	
		}
		} // if isFile and either php.ini, php5.ini or .user.ini
	} // end foreach
*/

 	$disabled = explode(',', ini_get('disable_functions'));	
   	if ( in_array('ini_set', $disabled) ) {	
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<font color="red"><strong>'.__('The ini_set function is Disabled', 'bulletproof-security').'</strong></font><br><br>';
	echo $text;
	} else {
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<strong>'.__('The ini_set function is Not Disabled', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}
	
	if ( !file_exists(ABSPATH . 'wp-config.php') ) {
	$text = __('wp-config.php File: ', 'bulletproof-security').'<font color="red"><strong>'.__('The wp-config.php file was not found in the website root folder.', 'bulletproof-security').'</strong></font><br><strong>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to add the BPS Pro ini_set coding to your wp-config.php file manually. The BPS ini_set coding can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
    $text = __('wp-config.php File: ', 'bulletproof-security').'<strong>'.__('The wp-config.php file was found in the website root folder.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}

	echo __('Error Log Path Seen by Server: ', 'bulletproof-security').'<strong>'.ini_get('error_log').'</strong><br>';
	echo __('PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options2['bps_error_log_location'].'</strong><br>';
	echo __('ini_set PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options['bps_iniSet_ErrorLog'].'</strong><br><br>';

	echo __('Website Root Folder: ', 'bulletproof-security').'<strong>'.get_site_url().'</strong><br>';
	echo __('WP ABSPATH: ', 'bulletproof-security').'<strong>'.ABSPATH.'</strong><br>';	
	echo __('Host by Address: ', 'bulletproof-security').'<strong>'.esc_html(@gethostbyaddr($_SERVER['SERVER_ADDR'])).'</strong><br>';    
	echo __('DNS Name Server: ', 'bulletproof-security').'<strong>'; 
	
	if ( empty( $bpsTarget ) && empty( $bpsTargetNS ) ) {
		echo __('DNS Name Server Not Available', 'bulletproof-security');
	
	} else { 
	
		if ( ! empty( $bpsTarget ) ) {
			echo $bpsTarget; 
		} else {
			echo $bpsTargetNS;
		}
	}
	echo '</strong><br><br>';
	
	echo __('Server Type', 'bulletproof-security').': <strong>'.esc_html($_SERVER['SERVER_SOFTWARE']).'</strong><br>';
	echo __('Operating System', 'bulletproof-security').': <strong>'.PHP_OS.'</strong><br>';  
	echo __('Server API', 'bulletproof-security').': <strong>';

	$sapi_type = php_sapi_name();
	if ( @substr($sapi_type, 0, 6) != 'apache') {		
		echo $sapi_type.__(' CGI Host Server Type', 'bulletproof-security');
	} else {
    	echo $sapi_type.__(' DSO Host Server Type', 'bulletproof-security');
	}
	echo '</strong><br><br>';

	echo __('Zend Engine Version', 'bulletproof-security').': <strong>'.zend_version().'</strong><br>'; 	
	echo __('Zend Guard Loader', 'bulletproof-security').': <strong>';
	if ( extension_loaded('Zend Optimizer+') && ini_get('zend_optimizerplus.enable') == 1 || ini_get('zend_optimizerplus.enable') == 'On' ) {
		_e('Zend Optimizer+ Extension is Loaded and Enabled', 'bulletproof-security');
	}
	if ( extension_loaded('Zend Guard Loader') ) {
		_e('Zend Guard Loader Extension is Loaded', 'bulletproof-security');
	} else {
	if ( !extension_loaded('Zend Optimizer+') && !extension_loaded('Zend Guard Loader') ) {
		_e('A Zend Extension is Not Loaded', 'bulletproof-security');		
	}
	}
	echo '</strong><br>'; 	

	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('Unable to detect whether FastCGI is in use. Check your web host control panel to see if FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('Shared Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. If you would like to create a custom php.ini file for your website see this Forum Topic: ', 'bulletproof-security').'<strong><a href="http://forum.ait-pro.com/forums/topic/custom-php-ini-file-setup-php5-3-x/" target="_blank" title="Link opens in a new Browser window">'.__('Custom php.ini File Setup', 'bulletproof-security').'</a></strong><br><br>';
	echo $text;

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('VPS or Dedicated Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. You can then create a custom php.ini file, which you can upload to replace the Servers php.ini file for your website at a later time if you would like. You can create/use either a custom php.ini file or the ini_set Options method or both at the same time. If you have created a custom php.ini file and you also use ini_set Options then your ini_set Options settings will take precedence over your custom php.ini file settings.', 'bulletproof-security').'<br><br>'.__('If a custom php.ini file was found in the php.ini, php5.ini & .user.ini File Search Results: then delete that file. For VPS or Dedicated Hosting you have full access to that Servers php.ini file (Loaded Configuration File:), and you will be uploading your custom php.ini file and replacing the Servers php.ini file with your custom php.ini file instead of creating the custom php.ini file under your website folders.', 'bulletproof-security').' <strong><a href="http://www.ait-pro.com/aitpro-blog/2853/bulletproof-security-pro/php-ini-general-and-host-specific-php-ini-information-for-bps-pro#vps-dedicated-hosting-phpini-help" target="_blank" title="Link opens in a new Browser window">'.__('Click HERE', 'bulletproof-security').'</a></strong> '.__('for the custom php.ini setup steps for VPS and Dedicated hosting', 'bulletproof-security').'<br><br>';
	echo $text;

} // end if PHP5.3.x or greater

	if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {

    $text = __('PHP Version: ', 'bulletproof-security').'<strong>'.PHP_VERSION.'</strong><br>';
	echo $text;

	if ( !strpos($check_string, "AddHandler") && !strpos($check_string, "SetEnv PHPRC") && !strpos($check_string, "suPHP_ConfigPath") && !strpos($check_string, "application/x-pair-sphp5") ) {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was Not found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}	
	
	echo 'Configuration File (php.ini) Path:<strong>'.__(' Click the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="_blank" title="Link opens in a new Browser window">'.__('View PHPINFO button on the PHP Info Viewer page', 'bulletproof-security').'</a>'.__(' to get this path.', 'bulletproof-security').'</strong><br>';
	
	//echo 'Configuration File (php.ini) Path: <strong>';
	//print_r($matches[1]);
	//echo '</strong><br>';

	$text = __('Loaded Configuration File: ', 'bulletproof-security').'<strong>'.$LoadedConfigFile.'</strong><br><br>';
	echo $text;

	echo '<strong>'.__('php.ini, php5.ini & .user.ini File Search Results: ', 'bulletproof-security').'</strong>'.__('(Displays the file paths below if files were found)', 'bulletproof-security').'<br>';

	foreach ( $objects as $inifile ) {
		try {
			if ( $inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' ) {
			if ( $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' ) {
				$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was found: ').$inifile->getPathname().'</strong><br><br>';
				echo $text;	
			} else {
				$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was not found', 'bulletproof-security').'</strong><br><br>';
			echo $text;	
			}
			}
		} catch (RuntimeException $e) {}
	} // end foreach

/*
	foreach ($objects as $inifile) {
		if ($inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini') {
		if ($inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini') {
	$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was found: ').$inifile->getPathname().'</strong><br><br>';
	echo $text;	
		} else {
	$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was not found', 'bulletproof-security').'</strong><br><br>';
	echo $text;	
		}
		}
	} // end foreach
*/
 	$disabled = explode(',', ini_get('disable_functions'));	
   	if ( in_array('ini_set', $disabled) ) {	
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<font color="red"><strong>'.__('The ini_set function is Disabled', 'bulletproof-security').'</strong></font><br><br>';
	} else {
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<strong>'.__('The ini_set function is Not Disabled', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}
	
	if ( !file_exists(ABSPATH . 'wp-config.php') ) {
	$text = __('wp-config.php File: ', 'bulletproof-security').'<font color="red"><strong>'.__('The wp-config.php file was not found in the website root folder.', 'bulletproof-security').'</strong></font><br><strong>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to add the BPS Pro ini_set coding to your wp-config.php file manually. The BPS ini_set coding can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
    $text = __('wp-config.php File: ', 'bulletproof-security').'<strong>'.__('The wp-config.php file was found in the website root folder.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}

	echo __('Error Log Path Seen by Server: ', 'bulletproof-security').'<strong>'.ini_get('error_log').'</strong><br>';
	echo __('PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options2['bps_error_log_location'].'</strong><br>';
	echo __('ini_set PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options['bps_iniSet_ErrorLog'].'</strong><br><br>';

	echo __('Website Root Folder: ', 'bulletproof-security').'<strong>'.get_site_url().'</strong><br>';
	echo __('WP ABSPATH: ', 'bulletproof-security').'<strong>'.ABSPATH.'</strong><br>';	
	echo __('Host by Address: ', 'bulletproof-security').'<strong>'.esc_html(@gethostbyaddr($_SERVER['SERVER_ADDR'])).'</strong><br>';    
	echo __('DNS Name Server: ', 'bulletproof-security').'<strong>'; if ($bpsTargetNS != '') { echo $bpsTargetNS; } else { echo $bpsTarget; } echo '</strong><br><br>';

	echo __('Server Type', 'bulletproof-security').': <strong>'.esc_html($_SERVER['SERVER_SOFTWARE']).'</strong><br>';
	echo __('Operating System', 'bulletproof-security').': <strong>'.PHP_OS.'</strong><br>';  
	echo __('Server API', 'bulletproof-security').': <strong>';
	
	$sapi_type = php_sapi_name();
	if ( @substr($sapi_type, 0, 6) != 'apache') {		
		echo $sapi_type.__(' CGI Host Server Type', 'bulletproof-security');
	} else {
    	echo $sapi_type.__(' DSO Host Server Type', 'bulletproof-security');
	}
	echo '</strong><br><br>';

	echo __('Zend Engine Version', 'bulletproof-security').': <strong>'.zend_version().'</strong><br>'; 
	echo __('Zend Optimizer', 'bulletproof-security').': <strong>';
	if ( extension_loaded('Zend Optimizer') ) {
		_e('Zend Optimizer Extension is Loaded', 'bulletproof-security');
	} else {
		_e('Zend Optimizer Extension is Not Loaded', 'bulletproof-security');		
	}
	echo '</strong><br>'; 
	
	if ( strpos($check_string, "AddHandler x-httpd-php5 .php") ) {
	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('Unable to detect whether FastCGI is in use. Check your web host control panel to see if FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}
	
	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('Shared Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. If you would like to create a custom php.ini file for your website see this Forum Topic: ', 'bulletproof-security').'<strong><a href="http://forum.ait-pro.com/forums/topic/custom-php-ini-file-setup-php5-3-x/" target="_blank" title="Link opens in a new Browser window">'.__('Custom php.ini File Setup', 'bulletproof-security').'</a></strong><br><br>';
	echo $text;	

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('VPS or Dedicated Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. You can then create a custom php.ini file, which you can upload to replace the Servers php.ini file for your website at a later time if you would like. You can create/use either a custom php.ini file or the ini_set Options method or both at the same time. If you have created a custom php.ini file and you also use ini_set Options then your ini_set Options settings will take precedence over your custom php.ini file settings.', 'bulletproof-security').'<br><br>'.__('If a custom php.ini file was found in the php.ini, php5.ini & .user.ini File Search Results: then delete that file. For VPS or Dedicated Hosting you have full access to that Servers php.ini file (Loaded Configuration File:), and you will be uploading your custom php.ini file and replacing the Servers php.ini file with your custom php.ini file instead of creating the custom php.ini file under your website folders.', 'bulletproof-security').' <strong><a href="http://www.ait-pro.com/aitpro-blog/2853/bulletproof-security-pro/php-ini-general-and-host-specific-php-ini-information-for-bps-pro#vps-dedicated-hosting-phpini-help" target="_blank" title="Link opens in a new Browser window">'.__('Click HERE', 'bulletproof-security').'</a></strong> '.__('for the custom php.ini setup steps for VPS and Dedicated hosting', 'bulletproof-security').'<br><br>'.__('Note:  HostGator allows you to use a custom php.ini file in your public_html folder for VPS and Dedicated Hosting and does not require the typical custom php.ini setup steps for VPS and Dedicated Hosting.', 'bulletproof-security').'<br><br>';
	echo $text;
	} // end if less than PHP5.3

	echo '</div>';

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
} // end isset
}

// PHP Diagnostic Checks / Recommendations - ini_set Options page
function bpsPHPDiagCheck2() {
if ( isset( $_POST['Submit-diagnostic-check2'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bps-diagnostic-check2' );
	set_time_limit(300); 
	
	$time_start = microtime( true );

	echo '<div id="diagnostic-background" style="max-height:250px;width:85%;overflow:auto;margin-top:10px;margin-bottom:20px;padding:10px;border:2px solid black;background-color:#ffffe0;">';

	$rootHtaccess = ABSPATH . '.htaccess';
	$check_string = @file_get_contents($rootHtaccess);
	$LoadedConfigFile = php_ini_loaded_file();
	//$path = $_SERVER['DOCUMENT_ROOT'] . '/'; // trying to search from the Document Root is just too much to ask
	$path = ABSPATH;	
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	$options = get_option('bulletproof_security_options_iniSet');
	$options2 = get_option('bulletproof_security_options2');	
	
	// Get DNS Name Server from [target] Root Domain
	// Note: This code runs fastest in this format vs nesting conditions
	if ( isset( $_SERVER['SERVER_NAME'] ) ) {
		$bpsHostName = esc_html($_SERVER['SERVER_NAME']);	
	} elseif ( isset( $_SERVER['HTTP_HOST'] ) ) {
		$bpsHostName = esc_html($_SERVER['HTTP_HOST']);	
	}

	$bpsTargetNS = '';
	$bpsTarget = '';

	$label_1 = preg_match( '/(([a-zA-Z0-9-])+\.){1}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_1 );
	$label_2 = preg_match( '/(([a-zA-Z0-9-])+\.){2}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_2 );
	$label_3 = preg_match( '/(([a-zA-Z0-9-])+\.){3}([a-zA-Z0-9-])+$/', $bpsHostName, $matches_3 );

	@$domain_labels = array( $matches_1[0], $matches_2[0], $matches_3[0] );
	$labels = array_filter( $domain_labels, 'strlen' );

	foreach ( $labels as $domain ) {

		if ( filter_var( gethostbyname($domain), FILTER_VALIDATE_IP ) ) {

			$bpsGetDNS = @dns_get_record( $domain, DNS_NS );
	
			if ( empty( $bpsGetDNS[0]['target'] ) ) {
			
			} else {
				
				$bpsTargetNS = $bpsGetDNS[0]['target'];
			}
	
			if ( empty( $bpsTargetNS ) ) {
				
				@dns_get_record( $domain, DNS_ALL, $authns, $addtl );
		
				if ( empty( $authns[0]['target'] ) ) {

				} else {
					
					$bpsTarget = $authns[0]['target'];
				}
			}	
	
			if ( empty( $bpsTarget ) && empty( $bpsTargetNS ) ) {
				
				@dns_get_record( $domain, DNS_ANY, $authns, $addtl );
		
				if ( empty( $authns[0]['target'] ) ) {

				} else {
					
					$bpsTarget = $authns[0]['target'];
				}
			}
		}
	}

	//ob_start();
	//phpinfo();
	//$subject = ob_get_contents();
	//$pattern = '/Configuration File \(php.ini\) Path(.*?)Loaded/is';
	//preg_match($pattern, $subject, $matches);
	//ob_end_clean();

	if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {

    $text = __('PHP Version: ', 'bulletproof-security').'<strong>'.PHP_VERSION.'</strong><br>';
	echo $text;
	
	if ( !strpos($check_string, "AddHandler") && !strpos($check_string, "SetEnv PHPRC") && !strpos($check_string, "suPHP_ConfigPath") && !strpos($check_string, "application/x-pair-sphp5") ) {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was Not found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}	

	echo 'Configuration File (php.ini) Path:<strong>'.__(' Click the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="_blank" title="Link opens in a new Browser window">'.__('View PHPINFO button on the PHP Info Viewer page', 'bulletproof-security').'</a>'.__(' to get this path.', 'bulletproof-security').'</strong><br>';
	
	//echo 'Configuration File (php.ini) Path: <strong>';
	//print_r($matches[1]);
	//echo '</strong><br>';

	$text = __('Loaded Configuration File: ', 'bulletproof-security').'<strong>'.$LoadedConfigFile.'</strong><br><br>';
	echo $text;

	echo '<strong>'.__('php.ini, php5.ini & .user.ini File Search Results: ', 'bulletproof-security').'</strong>'.__('(Displays the file paths below if files were found)', 'bulletproof-security').'<br>';
	
	foreach ( $objects as $inifile ) {
		try {
			if ( $inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' || $inifile->getFilename() == '.user.ini' ) {
			if ( $inifile->getFilename() == 'php.ini' ) {
				$text = __('A Custom php.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;	
			}
			if ( $inifile->getFilename() == 'php5.ini' ) {
				$text = __('A Custom php5.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;			
			}
			if ( $inifile->getFilename() == '.user.ini' ) {
				$text = __('A Custom .user.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
				echo $text;	
			}
			} // if isFile and either php.ini, php5.ini or .user.ini
		} catch (RuntimeException $e) {}	
	} // end foreach

/*
	foreach ($objects as $inifile) {
		if ($inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' || $inifile->getFilename() == '.user.ini') {
		if ($inifile->getFilename() == 'php.ini') {
	$text = __('A Custom php.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;	
		}
		if ($inifile->getFilename() == 'php5.ini') {
	$text = __('A Custom php5.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;			
		}
		if ($inifile->getFilename() == '.user.ini') {
	$text = __('A Custom .user.ini file was found: ').'<strong>'.$inifile->getPathname().'</strong><br>';
	echo $text;	
		}
		} // if isFile and either php.ini, php5.ini or .user.ini
	} // end foreach
*/
 	$disabled = explode(',', ini_get('disable_functions'));	
   	if ( in_array('ini_set', $disabled) ) {	
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<font color="red"><strong>'.__('The ini_set function is Disabled', 'bulletproof-security').'</strong></font><br><br>';
	} else {
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<strong>'.__('The ini_set function is Not Disabled', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}

	if ( !file_exists(ABSPATH . 'wp-config.php') ) {
	$text = __('wp-config.php File: ', 'bulletproof-security').'<font color="red"><strong>'.__('The wp-config.php file was not found in the website root folder.', 'bulletproof-security').'</strong></font><br><strong>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to add the BPS Pro ini_set coding to your wp-config.php file manually. The BPS ini_set coding can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
    $text = __('wp-config.php File: ', 'bulletproof-security').'<strong>'.__('The wp-config.php file was found in the website root folder.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}

	echo __('Error Log Path Seen by Server: ', 'bulletproof-security').'<strong>'.ini_get('error_log').'</strong><br>';
	echo __('PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options2['bps_error_log_location'].'</strong><br>';
	echo __('ini_set PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options['bps_iniSet_ErrorLog'].'</strong><br><br>';

	echo __('Website Root Folder: ', 'bulletproof-security').'<strong>'.get_site_url().'</strong><br>';
	echo __('WP ABSPATH: ', 'bulletproof-security').'<strong>'.ABSPATH.'</strong><br>';	
	echo __('Host by Address: ', 'bulletproof-security').'<strong>'.esc_html(@gethostbyaddr($_SERVER['SERVER_ADDR'])).'</strong><br>';    
	echo __('DNS Name Server: ', 'bulletproof-security').'<strong>';
	
	if ( empty( $bpsTarget ) && empty( $bpsTargetNS ) ) {
		echo __('DNS Name Server Not Available', 'bulletproof-security');
	
	} else { 
	
		if ( ! empty( $bpsTarget ) ) {
			echo $bpsTarget; 
		} else {
			echo $bpsTargetNS;
		}
	}
	echo '</strong><br><br>';
	
	echo __('Server Type', 'bulletproof-security').': <strong>'.esc_html($_SERVER['SERVER_SOFTWARE']).'</strong><br>';
	echo __('Operating System', 'bulletproof-security').': <strong>'.PHP_OS.'</strong><br>';  
	echo __('Server API', 'bulletproof-security').': <strong>';

	$sapi_type = php_sapi_name();
	if ( @substr($sapi_type, 0, 6) != 'apache') {		
		echo $sapi_type.__(' CGI Host Server Type', 'bulletproof-security');
	} else {
    	echo $sapi_type.__(' DSO Host Server Type', 'bulletproof-security');
	}
	
	echo '</strong><br><br>';

	echo __('Zend Engine Version', 'bulletproof-security').': <strong>'.zend_version().'</strong><br>'; 	
	echo __('Zend Guard Loader', 'bulletproof-security').': <strong>';
	if ( extension_loaded('Zend Optimizer+') && ini_get('zend_optimizerplus.enable') == 1 || ini_get('zend_optimizerplus.enable') == 'On' ) {
		_e('Zend Optimizer+ Extension is Loaded and Enabled', 'bulletproof-security');
	}
	if ( extension_loaded('Zend Guard Loader') ) {
		_e('Zend Guard Loader Extension is Loaded', 'bulletproof-security');
	} else {
	if ( !extension_loaded('Zend Optimizer+') && !extension_loaded('Zend Guard Loader') ) {
		_e('A Zend Extension is Not Loaded', 'bulletproof-security');		
	}
	}
	echo '</strong><br>'; 	

	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('Unable to detect whether FastCGI is in use. Check your web host control panel to see if FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('Shared Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. If you would like to create a custom php.ini file for your website see this Forum Topic: ', 'bulletproof-security').'<strong><a href="http://forum.ait-pro.com/forums/topic/custom-php-ini-file-setup-php5-3-x/" target="_blank" title="Link opens in a new Browser window">'.__('Custom php.ini File Setup', 'bulletproof-security').'</a></strong><br><br>';
	echo $text;

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('VPS or Dedicated Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. You can then create a custom php.ini file, which you can upload to replace the Servers php.ini file for your website at a later time if you would like. You can create/use either a custom php.ini file or the ini_set Options method or both at the same time. If you have created a custom php.ini file and you also use ini_set Options then your ini_set Options settings will take precedence over your custom php.ini file settings.', 'bulletproof-security').'<br><br>'.__('If a custom php.ini file was found in the php.ini, php5.ini & .user.ini File Search Results: then delete that file. For VPS or Dedicated Hosting you have full access to that Servers php.ini file (Loaded Configuration File:), and you will be uploading your custom php.ini file and replacing the Servers php.ini file with your custom php.ini file instead of creating the custom php.ini file under your website folders.', 'bulletproof-security').' <strong><a href="http://www.ait-pro.com/aitpro-blog/2853/bulletproof-security-pro/php-ini-general-and-host-specific-php-ini-information-for-bps-pro#vps-dedicated-hosting-phpini-help" target="_blank" title="Link opens in a new Browser window">'.__('Click HERE', 'bulletproof-security').'</a></strong> '.__('for the custom php.ini setup steps for VPS and Dedicated hosting', 'bulletproof-security').'<br><br>';
	echo $text;
} // end if PHP5.3.x or greater

	if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {

    $text = __('PHP Version: ', 'bulletproof-security').'<strong>'.PHP_VERSION.'</strong><br>';
	echo $text;

	if ( !strpos($check_string, "AddHandler") && !strpos($check_string, "SetEnv PHPRC") && !strpos($check_string, "suPHP_ConfigPath") && !strpos($check_string, "application/x-pair-sphp5") ) {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was Not found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('PHP|php.ini Handler: ', 'bulletproof-security').'<strong>'.__('A PHP|php.ini Handler was found in your Root .htaccess file.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}	
	
	echo 'Configuration File (php.ini) Path:<strong>'.__(' Click the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-6" target="_blank" title="Link opens in a new Browser window">'.__('View PHPINFO button on the PHP Info Viewer page', 'bulletproof-security').'</a>'.__(' to get this path.', 'bulletproof-security').'</strong><br>';

	//echo 'Configuration File (php.ini) Path: <strong>';
	//print_r($matches[1]);
	//echo '</strong><br>';

	$text = __('Loaded Configuration File: ', 'bulletproof-security').'<strong>'.$LoadedConfigFile.'</strong><br><br>';
	echo $text;

	echo '<strong>'.__('php.ini, php5.ini & .user.ini File Search Results: ', 'bulletproof-security').'</strong>'.__('(Displays the file paths below if files were found)', 'bulletproof-security').'<br>';

	foreach ( $objects as $inifile ) {
		try {
			if ( $inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' ) {
			if ( $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini' ) {
				$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was found: ').$inifile->getPathname().'</strong><br><br>';
				echo $text;	
			} else {
				$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was not found', 'bulletproof-security').'</strong><br><br>';
			echo $text;	
			}
			}
		} catch (RuntimeException $e) {}
	} // end foreach

/*
	foreach ($objects as $inifile) {
		if ($inifile->isFile() && $inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini') {
		if ($inifile->getFilename() == 'php.ini' || $inifile->getFilename() == 'php5.ini') {
	$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was found: ').$inifile->getPathname().'</strong><br><br>';
	echo $text;	
		} else {
	$text = __('Custom php.ini File: ', 'bulletproof-security').'<strong>'.__('A Custom php.ini file was not found', 'bulletproof-security').'</strong><br><br>';
	echo $text;	
		}
		}
	} // end foreach
*/
 	$disabled = explode(',', ini_get('disable_functions'));	
   	if ( in_array('ini_set', $disabled) ) {	
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<font color="red"><strong>'.__('The ini_set function is Disabled', 'bulletproof-security').'</strong></font><br><br>';
	} else {
    $text = '<br>'.__('disable_functions: ', 'bulletproof-security').'<strong>'.__('The ini_set function is Not Disabled', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}
	
	if ( !file_exists(ABSPATH . 'wp-config.php') ) {
	$text = __('wp-config.php File: ', 'bulletproof-security').'<font color="red"><strong>'.__('The wp-config.php file was not found in the website root folder.', 'bulletproof-security').'</strong></font><br><strong>'.__('If you have moved your wp-config.php file to a protected Server folder then you will need to add the BPS Pro ini_set coding to your wp-config.php file manually. The BPS ini_set coding can be found in this file /bulletproof-security/admin/php/php-directives-code-for-wp-config.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
    $text = __('wp-config.php File: ', 'bulletproof-security').'<strong>'.__('The wp-config.php file was found in the website root folder.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}

	echo __('Error Log Path Seen by Server: ', 'bulletproof-security').'<strong>'.ini_get('error_log').'</strong><br>';
	echo __('PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options2['bps_error_log_location'].'</strong><br>';
	echo __('ini_set PHP Error Log Location Set To: ', 'bulletproof-security').'<strong>'.$options['bps_iniSet_ErrorLog'].'</strong><br><br>';

	echo __('Website Root Folder: ', 'bulletproof-security').'<strong>'.get_site_url().'</strong><br>';
	echo __('WP ABSPATH: ', 'bulletproof-security').'<strong>'.ABSPATH.'</strong><br>';	
	echo __('Host by Address: ', 'bulletproof-security').'<strong>'.esc_html(@gethostbyaddr($_SERVER['SERVER_ADDR'])).'</strong><br>';    
	echo __('DNS Name Server: ', 'bulletproof-security').'<strong>'; if ($bpsTargetNS != '') { echo $bpsTargetNS; } else { echo $bpsTarget; } echo '</strong><br><br>';

	echo __('Server Type', 'bulletproof-security').': <strong>'.esc_html($_SERVER['SERVER_SOFTWARE']).'</strong><br>';
	echo __('Operating System', 'bulletproof-security').': <strong>'.PHP_OS.'</strong><br>';  
	echo __('Server API', 'bulletproof-security').': <strong>';

	$sapi_type = php_sapi_name();
	if ( @substr($sapi_type, 0, 6) != 'apache') {		
		echo $sapi_type.__(' CGI Host Server Type', 'bulletproof-security');
	} else {
    	echo $sapi_type.__(' DSO Host Server Type', 'bulletproof-security');
	}
	echo '</strong><br><br>';

	echo __('Zend Engine Version', 'bulletproof-security').': <strong>'.zend_version().'</strong><br>'; 
	echo __('Zend Optimizer', 'bulletproof-security').': <strong>';
	if ( extension_loaded('Zend Optimizer') ) {
		_e('Zend Optimizer Extension is Loaded', 'bulletproof-security');
	} else {
		_e('Zend Optimizer Extension is Not Loaded', 'bulletproof-security');		
	}
	echo '</strong><br>'; 
	
	if ( strpos($check_string, "AddHandler x-httpd-php5 .php") ) {
	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	} else {
	$text = __('FastCGI: ', 'bulletproof-security').'<strong>'.__('Unable to detect whether FastCGI is in use. Check your web host control panel to see if FastCGI is in use.', 'bulletproof-security').'</strong><br><br>';
	echo $text;
	}
	
	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('Shared Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. If you would like to create a custom php.ini file for your website see this Forum Topic: ', 'bulletproof-security').'<strong><a href="http://forum.ait-pro.com/forums/topic/custom-php-ini-file-setup-php5-3-x/" target="_blank" title="Link opens in a new Browser window">'.__('Custom php.ini File Setup', 'bulletproof-security').'</a></strong><br><br>';
	echo $text;	

	echo '-------------------------------------------------------------<br><br>';

	$text = '<strong>'.__('VPS or Dedicated Hosting Recommendations: ', 'bulletproof-security').'</strong><br>'.__('For first time installations of BPS Pro it is recommended that you use the ini_set Options to quickly setup your PHP Error Log file and location. You can then create a custom php.ini file, which you can upload to replace the Servers php.ini file for your website at a later time if you would like. You can create/use either a custom php.ini file or the ini_set Options method or both at the same time. If you have created a custom php.ini file and you also use ini_set Options then your ini_set Options settings will take precedence over your custom php.ini file settings.', 'bulletproof-security').'<br><br>'.__('If a custom php.ini file was found in the php.ini, php5.ini & .user.ini File Search Results: then delete that file. For VPS or Dedicated Hosting you have full access to that Servers php.ini file (Loaded Configuration File:), and you will be uploading your custom php.ini file and replacing the Servers php.ini file with your custom php.ini file instead of creating the custom php.ini file under your website folders.', 'bulletproof-security').' <strong><a href="http://www.ait-pro.com/aitpro-blog/2853/bulletproof-security-pro/php-ini-general-and-host-specific-php-ini-information-for-bps-pro#vps-dedicated-hosting-phpini-help" target="_blank">'.__('Click HERE', 'bulletproof-security').'</a></strong> '.__('for the custom php.ini setup steps for VPS and Dedicated hosting', 'bulletproof-security').'<br><br>'.__('Note:  HostGator allows you to use a custom php.ini file in your public_html folder for VPS and Dedicated Hosting and does not require the typical custom php.ini setup steps for VPS and Dedicated Hosting.', 'bulletproof-security').'<br><br>';
	echo $text;

	} // end if less than PHP5.3

	echo '</div>';

	$time_end = microtime( true );
	$run_time = $time_end - $time_start;
	$time_display = '<strong>Completion Time: </strong>'. round( $run_time, 2 ) . ' Seconds';
	
	echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
	echo bpsPro_memory_resource_usage();
	echo $time_display;
	echo '</p></div>';
} // end isset
}

?>