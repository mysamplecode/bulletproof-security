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

// File Manager Delete Files Form - Select php.ini or other file to DELETE - dropdown list array by file lable
// perform open and write test and unlink / delete
if ( !isset( $_POST['Submit-IDel'] ) )
	$chosen3 = array(0);
	else
	if ( isset( $_POST['Submit-IDel'] ) && current_user_can('manage_options') ) {
	check_admin_referer( 'bulletproof_security_ini_deleter' );
	  
		$chosen3 = $_POST['iniDeleter'];
		$options = get_option('bulletproof_security_options');
		$bps_php_ini_file_1D = $options['bpsinifiles_input_1'];
		$bps_php_ini_file_2D = $options['bpsinifiles_input_2'];
		$bps_php_ini_file_3D = $options['bpsinifiles_input_3'];
		$bps_php_ini_file_4D = $options['bpsinifiles_input_4'];
		$bps_php_ini_file_5D = $options['bpsinifiles_input_5'];
		$bps_php_ini_file_6D = $options['bpsinifiles_input_6'];
		$bps_php_ini_file_7D = $options['bpsinifiles_input_7'];
		$bps_php_ini_file_8D = $options['bpsinifiles_input_8'];
		$bps_php_ini_file_9D = $options['bpsinifiles_input_9'];
		$bps_php_ini_file_10D = $options['bpsinifiles_input_10'];
		$write_test = "";
				
	if ( $_POST['iniDeleter'] == array(0) ) {
		echo $bps_topDiv;
		$text = '<font color="red"><strong>'.__('You did not select a file to delete.', 'bulletproof-security').'</strong></font>';
		echo $text;	
		echo $bps_bottomDiv;
	}
	
	if ( $_POST['iniDeleter'] == array(1) ) {
		$ini1D = $options['bpsinifiles_input_1_label'];
	
		if ( !file_exists($bps_php_ini_file_1D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_1D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_1D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_1D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_1D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
   		echo $bps_bottomDiv;
		}
	}
	
	if ( $_POST['iniDeleter'] == array(2) ) {
		$ini2D = $options['bpsinifiles_input_2_label'];
	
		if ( !file_exists($bps_php_ini_file_2D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_2D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;		
			echo $bps_bottomDiv;
		
		} else {	
			
			$fh = fopen($bps_php_ini_file_2D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_2D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_2D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
   		echo $bps_bottomDiv;
		}
	}
	
	if ( $_POST['iniDeleter'] == array(3) ) {
		$ini3D = $options['bpsinifiles_input_3_label'];
	
		if ( !file_exists($bps_php_ini_file_3D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_3D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;		
			echo $bps_bottomDiv;
		
		} else {
			
			$fh = fopen($bps_php_ini_file_3D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_3D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_3D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
	}
	}
		
	if ( $_POST['iniDeleter'] == array(4) ) {
		$ini4D = $options['bpsinifiles_input_4_label'];
	
		if ( !file_exists($bps_php_ini_file_4D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_4D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;		
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_4D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_4D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_4D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}
	
	if ( $_POST['iniDeleter'] == array(5) ) {
		$ini5D = $options['bpsinifiles_input_5_label'];
		
		if ( !file_exists($bps_php_ini_file_5D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_5D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
		
		} else {
			
			$fh = fopen($bps_php_ini_file_5D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_5D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_5D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}

	if ( $_POST['iniDeleter'] == array(6) ) {
		$ini6D = $options['bpsinifiles_input_6_label'];
	
		if ( !file_exists($bps_php_ini_file_6D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_6D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_6D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_6D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_6D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}

	if ( $_POST['iniDeleter'] == array(7) ) {
		$ini7D = $options['bpsinifiles_input_7_label'];
	
		if ( !file_exists($bps_php_ini_file_7D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_7D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_7D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_7D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_7D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}
	
	if ( $_POST['iniDeleter'] == array(8) ) {
		$ini8D = $options['bpsinifiles_input_8_label'];
	
		if ( !file_exists($bps_php_ini_file_8D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_8D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_8D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_8D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_8D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}

	if ( $_POST['iniDeleter'] == array(9) ) {
		$ini9D = $options['bpsinifiles_input_9_label'];
	
		if ( !file_exists($bps_php_ini_file_9D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_9D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_9D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_9D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_9D.__(' file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}
	
	if ( $_POST['iniDeleter'] == array(10) ) {
		$ini10D = $options['bpsinifiles_input_10_label'];
	
		if ( !file_exists($bps_php_ini_file_10D) ) {
			echo $bps_topDiv;
			$text = '<font color="red"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_10D.__(' file does not exist or has already been deleted.', 'bulletproof-security').'</strong></font>';
			echo $text;	
			echo $bps_bottomDiv;
	
		} else {
		
			$fh = fopen($bps_php_ini_file_10D, 'a');
			fwrite($fh, '');
			fclose($fh);
			unlink($bps_php_ini_file_10D);
		echo $bps_topDiv;
		$text = '<font color="green"><strong>'.__('The ', 'bulletproof-security').$bps_php_ini_file_10D.__('file has been deleted.', 'bulletproof-security').'</strong></font>';
		echo $text;
		echo $bps_bottomDiv;
		}
	}
}

// Dropdown list array for iniDeleter form	
function bps_showOptionsDrop3($array, $active, $echo=true) {
$string = '';

	foreach( $array as $k => $v ) {
		if ( is_array($active) )
			$s = ( in_array($k, $active) ) ? ' selected="selected"' : '';
		else
			$s = ( $active == $k ) ? ' selected="selected"' : '';
			$string .= '<option value="'.$k.'"'.$s.'>'.$v.'</option>'."\n";
	}

	if ($echo)
	echo $string;
	else
	return $string;
}

// iniDeleter Array keys - Labels shown in dropdown list
if ( current_user_can('manage_options') ) {
$options = get_option('bulletproof_security_options');
$ini1D = $options['bpsinifiles_input_1_label'];
$ini2D = $options['bpsinifiles_input_2_label'];
$ini3D = $options['bpsinifiles_input_3_label'];
$ini4D = $options['bpsinifiles_input_4_label'];
$ini5D = $options['bpsinifiles_input_5_label'];
$ini6D = $options['bpsinifiles_input_6_label'];
$ini7D = $options['bpsinifiles_input_7_label'];
$ini8D = $options['bpsinifiles_input_8_label'];
$ini9D = $options['bpsinifiles_input_9_label'];
$ini10D = $options['bpsinifiles_input_10_label'];
}    

$iniDeleter = array(' Select File to Delete:', "$ini1D", "$ini2D", "$ini3D", "$ini4D", "$ini5D", "$ini6D", "$ini7D", "$ini8D", "$ini9D", "$ini10D");

?>
