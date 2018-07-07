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
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bps-help_faq_table">
  <tr>
    <td class="bps-table_title">&nbsp;</td>
  </tr>
  <tr>
    <td class="bps-table_cell_help"> 

<h3 style="margin:0px 0px 10px 0px;"><?php _e('Primary Security & Performance Directive Settings', 'bulletproof-security'); ?>  <button id="bps-open-modal15" class="button bps-modal-button"><?php _e('Read Me', 'bulletproof-security'); ?></button></h3>

<div id="bps-modal-content15" title="<?php _e('Security &amp; Performance Directive Settings', 'bulletproof-security'); ?>">
	<p><?php echo $bps_modal_content15; ?></p>
</div>

<table width="100%" class="widefat" style="margin-bottom:15px;">
	<thead>
	<tr>
	<th scope="col" style="width:50px;"><strong><?php _e('php.ini Directive', 'bulletproof-security')?></strong></th>
	<th scope="col" style="width:250px;"><strong><?php _e('PHP Functions Disabled', 'bulletproof-security')?></strong></th>
    <th scope="col" style="width:300px;"><strong><?php _e('Description', 'bulletproof-security')?></strong></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<th scope="row"><?php 
	
	$disable_functions = ini_get('disable_functions');
	$suhosin_functions = ini_get('suhosin.executor.func.blacklist');
	
	if ( !extension_loaded( 'suhosin' ) ) { // if the suhosin extension is not loaded
		if ( ini_get('disable_functions') != '' && ini_get('disable_functions') != false ) { // is enabled and has functions listed
			echo 'disable_functions';
		}
		if ( ini_get('disable_functions') == false ) {
			echo 'disable_functions';
		}
	}
	elseif ( extension_loaded( 'suhosin' ) ) { // if the suhosing extension is loaded
		if ( ini_get('suhosin.executor.func.blacklist') != '' && ini_get('suhosin.executor.func.blacklist') != false ) {
			echo 'suhosin.executor.func.blacklist';
		}
		if ( ini_get('suhosin.executor.func.blacklist') == false ) {
			echo 'suhosin.executor.func.blacklist';
		} else {
			echo '';
		}
	}
	?>
    </th>
	<td>
	<?php 
	if ( !extension_loaded( 'suhosin' ) ) {
		if ( ini_get('disable_functions') != '' && ini_get('disable_functions') != false ) {
			echo $disable_functions;
		}
		if ( ini_get('disable_functions') == false ) {
			$text = '<font color="red"><strong>'.__('The recommended PHP functions are not disabled.', 'bulletproof-security').'</strong></font>';
			echo $text;
		}
	}
	elseif ( extension_loaded( 'suhosin' ) ) {
		if ( ini_get('suhosin.executor.func.blacklist') != '' && ini_get('suhosin.executor.func.blacklist') != false ) {
			echo $suhosin_functions;
		}
		if ( ini_get('suhosin.executor.func.blacklist') == false ) {
			$text = '<font color="red"><strong>'.__('The recommended PHP functions are not disabled.', 'bulletproof-security').'</strong></font>';
			echo $text;
		} else { 
		echo '';
		}
	}
	?>
    </td>
    <td>
	<?php 
	if ( !extension_loaded( 'suhosin' ) ) {
		if ( ini_get('disable_functions') != '' && ini_get('disable_functions') != false ) {
			_e('This disable_functions directive allows you to add PHP functions that you want to disable on your website. By default BPS is disabling several dangerous PHP functions that are commonly used by hackers.', 'bulletproof-security');
		}
		if ( ini_get('disable_functions') == false ) {
			_e('The disable_functions directive is not in use or is commented out in your php.ini file. Uncomment the disable_functions directive by removing the semi-colon from in front of it.', 'bulletproof-security');
		}
	}
	elseif ( extension_loaded( 'suhosin' ) ) {
		if ( ini_get('suhosin.executor.func.blacklist') != '' && ini_get('suhosin.executor.func.blacklist') != false ) {
			_e('The Suhosin suhosin.executor.func.blacklist directive allows you to add PHP functions that you want to disable on your website. BPS has detected that your Web Host is using Suhosin. If you do not see any functions listed under PHP Functions Disabled then comment out the disable_functions directive in your custom php.ini file and add those functions to the suhosin.executor.func.blacklist directive.', 'bulletproof-security');
		}
		if ( ini_get('suhosin.executor.func.blacklist') == false ) {
			_e('BPS has detected that your Web Host is using Suhosin, but the suhosin.executor.func.blacklist directive was not found in your custom php.ini file. Add the suhosin.executor.func.blacklist directive to your custom php.ini file and comment out the disable_functions directive in your custom php.ini file and then copy the functions shown in the disable_functions directive to your new suhosin.executor.func.blacklist directive that you just added.', 'bulletproof-security'); 
		} else {
			echo '';
		}
	}
	?>
    </td>
	</tr>
</tbody>
</table>

<table width="100%" class="widefat" style="margin-bottom:20px;">
	<thead>
	<tr>
	<th scope="col" style="width:40px;"><strong><?php _e('php.ini Directive', 'bulletproof-security')?></strong></th>
	<th scope="col" style="width:20px;"><strong><?php _e('Status', 'bulletproof-security')?></strong></th>
    <th scope="col" style="width:500px;"><strong><?php _e('Description', 'bulletproof-security')?></strong></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<th scope="row"><?php echo 'asp_tags'; ?></th>
	<td>
	<?php if ( ini_get('asp_tags') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Clean Code:', 'bulletproof-security').'</strong> '.__('Allow or Disallow ASP-style <% %> tags instead of the standard PHP tags. Not a critical requirement, performance issue or security problem. This is a standard php.ini setting to avoid code compatibility issues.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'allow_call_time_pass_reference'; ?></th>
	<td>
	<?php if ( ini_get('allow_call_time_pass_reference') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow warnings which PHP will issue if you pass a value by reference at function call time. The acceptable method for passing a value by reference to a function is by declaring the reference in the functions definition, not at call time. These warnings should only be enabled in development environments.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'allow_url_fopen'; ?></th>
	<td>
	<?php if ( ini_get('allow_url_fopen') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow the treatment of URLs like (http:// or ftp://) as files. Allow or Disallow PHP file functions such as file_get_contents() and the include and require statements to be able to retrieve data from remote locations.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'allow_url_include'; ?></th>
	<td>
	<?php if ( ini_get('allow_url_include') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow include and require statements to open URLs like (http:// or ftp://) as files. Allow or Disallow remote file access via the include and require statements. Include and require are the most common attack points for code injection attempts. Does not affect the remote file access capabilities of the standard file functions.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'define_syslog_variables'; ?></th>
	<td>
	<?php if ( ini_get('define_syslog_variables') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Define or not Define the various syslog variables (e.g. $LOG_PID, $LOG_CRON, etc.). Increased performance by turning this directive off. In runtime, you can define these variables by calling define_syslog_variables()', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'display_errors'; ?></th>
	<td>
	<?php if ( ini_get('display_errors') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow PHP output errors, notices and warnings to remote users. The error message content may expose information about your script, web server or database server that may be exploitable for hacking. Sensitive information such as database usernames and passwords could also be leaked out. BPS logs php errors instead of displaying them to remote users. The BPS php error log is htaccess protected.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'display_startup_errors'; ?></th>
	<td>
	<?php if ( ini_get('display_startup_errors') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow the display of errors which occur during PHPs startup sequence. Handled separately from the display_errors directive. Useful in debugging configuration problems in a development environment, but should never be set to On for production servers.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'expose_php'; ?></th>
	<td>
	<?php if ( ini_get('expose_php') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Standard non-Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow PHP to expose that it is installed on the server by adding its signature to the Web server header. Not a security threat in any way, but it makes it possible to determine whether you use PHP on your server or not.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'implicit_flush';?></th>
	<td>
	<?php if ( ini_get('implicit_flush') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow PHP to tell the output layer to flush itself automatically after every output block. This is equivalent to calling the PHP function flush() after each and every call to print() or echo() and each and every HTML block. Turning this option on has serious performance implications and is generally recommended for debugging purposes only.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'magic_quotes_gpc'; ?></th>
	<td>
	<?php if ( ini_get('magic_quotes_gpc') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow magic quotes. A preprocessing feature of PHP where PHP will attempt to escape (slashes) any character sequences in GET, POST, COOKIE and ENV data which might otherwise corrupt data being placed in resources such as databases before making that data available to you. This feature has been deprecated as of PHP 5.3.0 and is scheduled for removal in PHP 6.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'magic_quotes_runtime'; ?></th>
	<td>
	<?php if ( ini_get('magic_quotes_runtime') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow magic quotes for runtime-generated data, e.g. data from SQL, from exec(), etc.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'mysql.allow_persistent'; ?></th>
	<td>
	<?php if ( ini_get('mysql.allow_persistent') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow persistent MySQL database connections. The mysql_pconnect() function might be used in a WordPress plugin on your site, but it is unlikely. There are Pros and Cons to this directive setting, but without explaining what those Pros and Cons are, we log hackers attempting to exploit the mysql_pconnect() function on a regular basis in the AITpro HoneyPots.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'output_buffering'; ?></th>
	<td>
	<?php $output_buffering = ini_get('output_buffering');
	if ( ini_get('output_buffering') != 0 ) { 
		echo '<font color="red"><strong>'.$output_buffering.'</strong></font>';
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance WP Specific:', 'bulletproof-security').'</strong> '.__('Allow or Disallow output buffering. Output buffering is a mechanism for controlling how much output data (excluding headers and cookies) PHP should keep internally before pushing that data to the client. Output buffering does not work well on WordPress sites and causes slower performance. For other types of sites that are NOT WordPress the recommended output buffering setting is: output_buffering = 4096. The ouput buffering setting for WordPress should be: output_buffering = 0 or output_buffering = Off.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'register_globals'; ?></th>
	<td>
	<?php if ( ini_get('register_globals') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security &amp; Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow the EGPCS variables, input data (POST, GET, cookies, environment and other server variables), to be registered as global variables. Perfomance increase by avoiding global scope script clutter with user data. Allowing register_globals will register form variables as globals and can lead to possible security problems.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'register_long_arrays'; ?></th>
	<td>
	<?php if ( ini_get('register_long_arrays') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow the deprecated long $HTTP_*_VARS type predefined variables to be registered by PHP. As this is deprecated and superglobals have been introduced as of PHP 4.1.0 this should never be turned On/Allowed.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'register_argc_argv'; ?></th>
	<td>
	<?php if ( ini_get('register_argc_argv') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('Allow or Disallow whether PHP registers $argv & $argc each time it runs. $argv contains an array of all the arguments passed to PHP when a script is invoked. $argc contains an integer representing the number of arguments that were passed when the script was invoked. Registering these variables consumes CPU cycles and memory each time a script is executed. For performance reasons, this feature should be disabled on production servers.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'report_memleaks'; ?></th>
	<td>
	<?php if ( ini_get('report_memleaks') == 'On' ) { 
		$text = '<font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="red"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Standard Debug Error Logging:', 'bulletproof-security').'</strong> '.__('Allow or Disallow memory leaks to be logged. This directive only applies to debugging and will only effect a debug compile if error reporting includes E_WARNING in the allowed list', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
	<th scope="row"><?php echo 'safe_mode'; ?></th>
	<td>
	<?php if ( ini_get('safe_mode') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Obsolete Deprecated:', 'bulletproof-security').'</strong> '.__('Allow or Disallow whether to enable PHPs safe mode if PHP is compiled with --enable-safe-mode. This feature has been DEPRECATED as of PHP 5.3.0.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'sql.safe_mode'; ?></th>
	<td>
	<?php if ( ini_get('sql.safe_mode') == 1 ) { 
		$text = '<font color="red"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} else { 
		$text = '<font color="green"><strong>'.__('Off', 'bulletproof-security').'</strong></font>';
		echo $text; } 
	?>
    </td>
    <td><?php $text = '<strong>'.__('Security:', 'bulletproof-security').'</strong> '.__('Allow or Disallow database connect functions to use default values (host, user and password) in place of supplied arguments.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
    <tr>
    <th scope="row"><?php echo 'variables_order'; ?></th>
	<td>
	<?php $variables_order = ini_get('variables_order'); 
	if ( ini_get('variables_order') == 'GPCS' ) {
		$text = '<font color="green"><strong>'.__('GPCS', 'bulletproof-security').'</strong></font>';
		echo $text;
	}
	if ( ini_get('variables_order') == 'EGPCS' ) { 
		$text = '<font color="red"><strong>'.__('EGPCS', 'bulletproof-security').'</strong></font>';
		echo $text; 
	} 
	?>
     </td>
    <td><?php $text = '<strong>'.__('Performance:', 'bulletproof-security').'</strong> '.__('GPCS is the optimum performance variables order. This directive determines which super global arrays are registered when PHP starts up. By default BPS has register_globals set to Off/Disallowed so that the environment variables are not hashed into the $_ENV. Variables: G,P,C,E & S (super globals: GET, POST, COOKIE, ENV and SERVER). Using EGPCS variables order will cause a performance decrease. If you see EGPCS instead of GPCS displayed here then remove the E from your variables_order directive in your php.ini file.', 'bulletproof-security'); echo $text; ?></td>
	</tr>
</tbody>
</table>
</td>
  </tr>
   <tr>
    <td class="bps-table_cell_bottom">&nbsp;</td>
  </tr>
</table>