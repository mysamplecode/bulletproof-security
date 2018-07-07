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

// File Editor Form - Get file contents from iniSelector selection used in templatephp2 and written by the File writing Form: submit-php2
function bps_get_php_ini_file() {
	
	if ( current_user_can('manage_options') ) {	
	$options = get_option('bulletproof_security_options');
	$bps_php_ini_file_1 = $options['bpsinifiles_input_1'];
	$bps_php_ini_file_2 = $options['bpsinifiles_input_2'];
	$bps_php_ini_file_3 = $options['bpsinifiles_input_3'];
	$bps_php_ini_file_4 = $options['bpsinifiles_input_4'];
	$bps_php_ini_file_5 = $options['bpsinifiles_input_5'];
	$bps_php_ini_file_6 = $options['bpsinifiles_input_6'];
	$bps_php_ini_file_7 = $options['bpsinifiles_input_7'];
	$bps_php_ini_file_8 = $options['bpsinifiles_input_8'];
	$bps_php_ini_file_9 = $options['bpsinifiles_input_9'];
	$bps_php_ini_file_10 = $options['bpsinifiles_input_10'];
	
	if ( @$_POST['iniSelector'] == array(1) ) {
	if ( !file_exists($bps_php_ini_file_1) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_1.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_1 = file_get_contents($bps_php_ini_file_1);
		echo htmlspecialchars($bps_php_ini_file_1);
	}
	}
	
	if ( @$_POST['iniSelector'] == array(2) ) {
	if ( !file_exists($bps_php_ini_file_2) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_2.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_2 = file_get_contents($bps_php_ini_file_2);
		echo htmlspecialchars($bps_php_ini_file_2);
	}
	}
	
	if ( @$_POST['iniSelector'] == array(3) ) {
	if ( !file_exists($bps_php_ini_file_3) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_3.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_3 = file_get_contents($bps_php_ini_file_3);
		echo htmlspecialchars($bps_php_ini_file_3);
	}
	}
	
	if ( @$_POST['iniSelector'] == array(4) ) {
	if ( !file_exists($bps_php_ini_file_4) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_4.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_4 = file_get_contents($bps_php_ini_file_4);
		echo htmlspecialchars($bps_php_ini_file_4);
	}
	}

	if ( @$_POST['iniSelector'] == array(5) ) {
	if ( !file_exists($bps_php_ini_file_5) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_5.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_5 = file_get_contents($bps_php_ini_file_5);
		echo htmlspecialchars($bps_php_ini_file_5);
	}
	}

	if ( @$_POST['iniSelector'] == array(6) ) {
	if ( !file_exists($bps_php_ini_file_6) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_6.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_6 = file_get_contents($bps_php_ini_file_6);
		echo htmlspecialchars($bps_php_ini_file_6);
	}
	}

	if ( @$_POST['iniSelector'] == array(7) ) {
	if ( !file_exists($bps_php_ini_file_7) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_7.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_7 = file_get_contents($bps_php_ini_file_7);
		echo htmlspecialchars($bps_php_ini_file_7);
	}
	}

	if ( @$_POST['iniSelector'] == array(8) ) {
	if ( !file_exists($bps_php_ini_file_8) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_8.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_8 = file_get_contents($bps_php_ini_file_8);
		echo htmlspecialchars($bps_php_ini_file_8);
	}
	}

	if ( @$_POST['iniSelector'] == array(9) ) {
	if ( !file_exists($bps_php_ini_file_9) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_9.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_9 = file_get_contents($bps_php_ini_file_9);
		echo htmlspecialchars($bps_php_ini_file_9);
	}
	}

	if ( @$_POST['iniSelector'] == array(10) ) {
	if ( !file_exists($bps_php_ini_file_10) ) {
		echo $bps_topDiv;
		$text = __('The ', 'bulletproof-security').$bps_php_ini_file_10.__(' file either does not exist or is not named correctly. Check that the file really exists, is named correctly and the file path is correct. You can use the Find php.ini Files search tool to find php.ini files or check for the file via FTP.', 'bulletproof-security');
		echo $text;
		echo $bps_bottomDiv;
	
	} else {
	
		$bps_php_ini_file_10 = file_get_contents($bps_php_ini_file_10);
		echo htmlspecialchars($bps_php_ini_file_10);
	}
	}
	}
}

// File Editor selector Form - Select file to edit - dropdown list array by file label
// return string for template2 form hidden input field and perform write check
if ( !isset( $_POST['Submit-IS'] ) )
	$chosen2 = array(0);
	else
	if ( isset( $_POST['Submit-IS'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ini_selector' );
	  
	    $chosen2 = $_POST['iniSelector'];
		$options = get_option('bulletproof_security_options');
		$bps_php_ini_file_1 = $options['bpsinifiles_input_1'];
		$bps_php_ini_file_2 = $options['bpsinifiles_input_2'];
		$bps_php_ini_file_3 = $options['bpsinifiles_input_3'];
		$bps_php_ini_file_4 = $options['bpsinifiles_input_4'];
		$bps_php_ini_file_5 = $options['bpsinifiles_input_5'];
		$bps_php_ini_file_6 = $options['bpsinifiles_input_6'];
		$bps_php_ini_file_7 = $options['bpsinifiles_input_7'];
		$bps_php_ini_file_8 = $options['bpsinifiles_input_8'];
		$bps_php_ini_file_9 = $options['bpsinifiles_input_9'];
		$bps_php_ini_file_10 = $options['bpsinifiles_input_10'];

		$topDivInner = '<div id="messageinner" class="updatedinner" style="width:690px; margin-top:20px;">';

	if ( $_POST['iniSelector'] == array(1) ) {
		$iniFilename = 'saveini1';
		$ini1 = $options['bpsinifiles_input_1_label'];
	
	if ( !is_writable($bps_php_ini_file_1) ) {
		echo $topDivInner;	
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_1.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_1.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(2) ) {
		$iniFilename = 'saveini2';
		$ini2 = $options['bpsinifiles_input_2_label'];
	
	if ( !is_writable($bps_php_ini_file_2) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_2.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_2.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(3) ) {
		$iniFilename = 'saveini3';
		$ini3 = $options['bpsinifiles_input_3_label'];
	
	if ( !is_writable($bps_php_ini_file_3) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_3.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_3.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	  
	if ( $_POST['iniSelector'] == array(4) ) {
		$iniFilename = 'saveini4';
		$ini4 = $options['bpsinifiles_input_4_label'];
	
	if ( !is_writable($bps_php_ini_file_4) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_4.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_4.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(5) ) {
		$iniFilename = 'saveini5';
		$ini5 = $options['bpsinifiles_input_5_label'];
	
	if ( !is_writable($bps_php_ini_file_5) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_5.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_5.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(6) ) {
		$iniFilename = 'saveini6';
		$ini6 = $options['bpsinifiles_input_6_label'];
	
	if ( !is_writable($bps_php_ini_file_6) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_6.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_6.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(7) ) {
		$iniFilename = 'saveini7';
		$ini7 = $options['bpsinifiles_input_7_label'];
	
	if ( !is_writable($bps_php_ini_file_7) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_7.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_7.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}

	if ( $_POST['iniSelector'] == array(8) ) {
		$iniFilename = 'saveini8';
		$ini8 = $options['bpsinifiles_input_8_label'];
	
	if ( !is_writable($bps_php_ini_file_8) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_8.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_8.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(9) ) {
		$iniFilename = 'saveini9';
		$ini9 = $options['bpsinifiles_input_9_label'];
	
	if ( !is_writable($bps_php_ini_file_9) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_9.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_9.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
	
	if ( $_POST['iniSelector'] == array(10) ) {
		$iniFilename = 'saveini10';
		$ini10 = $options['bpsinifiles_input_10_label'];
	
	if ( !is_writable($bps_php_ini_file_10) ) {
		echo $topDivInner;
		$text = '<font color="red"><strong>'.__('Error: The ', 'bulletproof-security').$bps_php_ini_file_10.__(' file is NOT writable.', 'bulletproof-security').'<br>'.__('Your editing changes to this file will NOT be saved. Check the file permissions and path for this file.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo '</div>';
	
	} else {
	
		echo $topDivInner;
		$text = '<font color="green"><strong>'.__('File Write test successful!', 'bulletproof-security').'<br>'.__('Your ', 'bulletproof-security').$bps_php_ini_file_10.__(' file is writable.', 'bulletproof-security').'</strong></font>';
		echo $text;		
		echo '</div>';
	}
	}
}

// Dropdown list array for iniSelector form	
function bps_showOptionsDrop2( $array, $active, $echo=true ) {
$string = '';

	foreach( $array as $k => $v ) {
		if ( is_array($active) )
			$s = ( in_array( $k, $active ) ) ? ' selected="selected"' : '';
		else
			$s = ( $active == $k ) ? ' selected="selected"' : '';
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}

	if ($echo)   
	echo $string;
	else
	return $string;
}

// iniSelector Array keys - Lables shown in dropdown list
if ( current_user_can('manage_options') ) {
$options = get_option('bulletproof_security_options');
$ini1 = $options['bpsinifiles_input_1_label'];
$ini2 = $options['bpsinifiles_input_2_label'];
$ini3 = $options['bpsinifiles_input_3_label'];
$ini4 = $options['bpsinifiles_input_4_label'];
$ini5 = $options['bpsinifiles_input_5_label'];
$ini6 = $options['bpsinifiles_input_6_label'];
$ini7 = $options['bpsinifiles_input_7_label'];
$ini8 = $options['bpsinifiles_input_8_label'];
$ini9 = $options['bpsinifiles_input_9_label'];
$ini10 = $options['bpsinifiles_input_10_label'];
}    

$iniSelector = array(' Select File to Edit:', "$ini1", "$ini2", "$ini3", "$ini4", "$ini5", "$ini6", "$ini7", "$ini8", "$ini9", "$ini10");

// File Editor writing Form - BPS php.ini Editor
if ( isset( $_POST['submit-php2'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_save_settings_php2' );
	
	$iniFilename = $_POST['iniFilename']; 
	$newcontentphp2 = stripslashes($_POST['newcontentphp2']);
	$options = get_option('bulletproof_security_options');
	$bps_php_ini_file_1 = $options['bpsinifiles_input_1'];
	$bps_php_ini_file_2 = $options['bpsinifiles_input_2'];
	$bps_php_ini_file_3 = $options['bpsinifiles_input_3'];
	$bps_php_ini_file_4 = $options['bpsinifiles_input_4'];
	$bps_php_ini_file_5 = $options['bpsinifiles_input_5'];
	$bps_php_ini_file_6 = $options['bpsinifiles_input_6'];
	$bps_php_ini_file_7 = $options['bpsinifiles_input_7'];
	$bps_php_ini_file_8 = $options['bpsinifiles_input_8'];
	$bps_php_ini_file_9 = $options['bpsinifiles_input_9'];
	$bps_php_ini_file_10 = $options['bpsinifiles_input_10'];
	
	if ( $iniFilename == 'saveini1' ) {
	if ( is_writable($bps_php_ini_file_1) ) {
		$handle = fopen($bps_php_ini_file_1, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_1.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;	
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_1) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_1.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini2' ) {
	if ( is_writable($bps_php_ini_file_2) ) {
		$handle = fopen($bps_php_ini_file_2, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_2.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_2) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_2.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}
	
	if ( $iniFilename == 'saveini3' ) {
	if ( is_writable($bps_php_ini_file_3) ) {
		$handle = fopen($bps_php_ini_file_3, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_3.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_3) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_3.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}
	
	if ( $iniFilename == 'saveini4' ) {
	if ( is_writable($bps_php_ini_file_4) ) {
		$handle = fopen($bps_php_ini_file_4, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_4.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_4) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_4.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}
	
	if ( $iniFilename == 'saveini5' ) {
	if ( is_writable($bps_php_ini_file_5) ) {
		$handle = fopen($bps_php_ini_file_5, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_5.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_5) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_5.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini6' ) {
	if ( is_writable($bps_php_ini_file_6) ) {
		$handle = fopen($bps_php_ini_file_6, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_6.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;	
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_6) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_6.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini7' ) {
	if ( is_writable($bps_php_ini_file_7) ) {
		$handle = fopen($bps_php_ini_file_7, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_7.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_7) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_7.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini8' ) {
	if ( is_writable($bps_php_ini_file_8) ) {
		$handle = fopen($bps_php_ini_file_8, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_8.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;	
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_8) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_8.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini9' ) {
	if ( is_writable($bps_php_ini_file_9) ) {
		$handle = fopen($bps_php_ini_file_9, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_9.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_9) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_9.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}

	if ( $iniFilename == 'saveini10' ) {
	if ( is_writable($bps_php_ini_file_10) ) {
		$handle = fopen($bps_php_ini_file_10, 'w+b');
		fwrite($handle, $newcontentphp2);
	echo $bps_topDiv;
	$text = '<font color="green"><strong>'.__('Success! Your ', 'bulletproof-security').$bps_php_ini_file_10.__(' file has been updated.', 'bulletproof-security').'</strong></font>';
	echo $text;	
    echo $bps_bottomDiv;
	fclose($handle);
	} 
	elseif ( !is_writable($bps_php_ini_file_10) ) {
	echo $bps_topDiv;
	$text = '<font color="red"><strong>'.__('Error: Your ', 'bulletproof-security').$bps_php_ini_file_10.__(' file has NOT been updated. Unable to write to file. Check the file permissions for this file.', 'bulletproof-security').'</strong></font>';		
	echo $text;			
	echo $bps_bottomDiv;
	}
	}
}

?>
