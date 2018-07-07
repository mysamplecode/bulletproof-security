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

// S-Monitor Display - Root htaccess - BPS Status and Alerts in BPS pages only - bpsOn
function bps_security_status_bps_only() {
$options = get_option('bulletproof_security_options_monitor');

	if ( current_user_can('manage_options') && $options['bps_security_status'] == 'bpsOn' ) {

	global $bpspro_version, $bpspro_last_version, $wp_version, $wpdb, $aitpro_bullet;

	if ( esc_html($_SERVER['REQUEST_METHOD']) == 'POST' ) {
		
		if ( esc_html($_SERVER['QUERY_STRING']) == '' ) {
			$bps_base = basename(esc_html($_SERVER['REQUEST_URI']));
		} else {
			$bps_base = str_replace( admin_url(), '', esc_html($_SERVER['REQUEST_URI']) );
		}		
		
		echo '<div id="bps-status-display" style="float:left;margin:0px 0px 0px 6px;padding:3px 5px 3px 5px;background-color:#e8e8e8;border:1px solid gray;"><a href="'.$bps_base.'" style="text-decoration:none;font-weight:bold;">'.__('Reload BPS Pro Status Display', 'bulletproof-security').'</a></div>';
		echo '<div style="clear:both;"></div>';		

		if ( @$_POST['submit-bps-spinner'] == true || @$_POST['Submit-Setup-Wizard-Preinstallation'] == true || @$_POST['Submit-Setup-Wizard'] == true || @$_POST['Submit-DBB-Run-Job'] == true || @$_POST['Submit-DB-Table-Prefix'] == true || @$_POST['Submit-DB-Prefix-Table-Refresh'] == true || @$_POST['Submit-ARCM-RootNR'] == true || @$_POST['Submit-ARCM-Wpadmin'] == true || @$_POST['Submit-ARCM-Wpincludes'] == true || @$_POST['Submit-ARCM-Wpcontent'] == true || @$_POST['Submit-ARCM-Root-Delete'] == true || @$_POST['Submit-ARCM-Wpadmin-Delete'] == true || @$_POST['Submit-ARCM-Wpincludes-Delete'] == true || @$_POST['Submit-ARCM-Wpcontent-Delete'] == true || @$_POST['Submit-ARCM-Root-Restore'] == true || @$_POST['Submit-ARCM-Wpadmin-Restore'] == true || @$_POST['Submit-ARCM-Wpincludes-Restore'] == true || @$_POST['Submit-ARCM-Wpcontent-Restore'] == true || @$_POST['Submit-ARCM-Root-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpadmin-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpincludes-Show-Backup'] == true || @$_POST['Submit-ARCM-Wpcontent-Show-Backup'] == true || @$_POST['Submit-ARCM-Root-Show-Website'] == true || @$_POST['Submit-ARCM-Wpadmin-Show-Website'] == true || @$_POST['Submit-ARCM-Wpincludes-Show-Website'] == true || @$_POST['Submit-ARCM-Wpcontent-Show-Website'] == true || @$_POST['Submit-Quarantine-Search-Radio'] == true || @$_POST['Submit-ARQ-Quarantine-Radio'] == true || @$_POST['submit-bps-zip-install'] == true || @$_POST['Submit-DBD-Diff-Tool'] == true || @$_POST['Submit-DBD-Diff-Large'] == true || @$_POST['Submit-diagnostic-check1'] == true || @$_POST['Submit-diagnostic-check2'] == true || @$_POST['bpsStringFinder'] == true || @$_POST['bpsStringReplacer'] == true || @$_POST['bpsStringReplacerFP'] == true || @$_POST['bpsDBStringFinder9'] == true || @$_POST['bpsMulti-Scan-All-Pages-Submit'] == true || @$_POST['bpsMulti-Scan-Plugins-Submit'] == true || @$_POST['bpsMulti-Scan-Submit'] == true ) {  
		
			$bpsPro_Spinner = get_option('bulletproof_security_options_spinner');	
	
		if ( $bpsPro_Spinner['bps_spinner'] != 'Off' ) {

			echo '<div id="bps-status-display" style="padding:2px 0px 4px 8px;width:240px;">';
			echo '<div id="bps-spinner" class="bps-spinner" style="">';
			echo '<img id="bps-img-spinner" src="'.plugins_url('/bulletproof-security/admin/images/bps-spinner.gif').'" style="float:left;margin:4px 20px 0px 4px;" />'; 
			echo '<div id="bps-spinner-text-btn" style="padding:20px 0px 26px 0px;font-size:14px;background:#fff;border:4px solid black;">Processing...<br><button style="margin:10px 0px 0px 10px;" onclick="javascript:history.go(-1)">Cancel</button></div>';
			echo '</div>';
			echo '</div>';
?>
    
<style>
<!--
.bps-spinner {
    visibility:visible;
	position:fixed;
    top:7%;
    left:45%;
 	width:240px;
	padding:2px 0px 4px 8px;   
	z-index:99999;
}
-->
</style>

<?php
		}  
		}

	} elseif ( esc_html($_SERVER['QUERY_STRING']) == 'page=bulletproof-security/admin/system-info/system-info.php' ) {
		echo '<div id="bps-status-display" style="float:left;padding:0px 0px 10px 0px;">'.__('The BPS Pro Status Display is set to Off by default on the System Info page', 'bulletproof-security').'</div>';
		echo '<div style="clear:both;"></div>';	

	} else {

	$options2 = get_option('bulletproof_security_options_autolock');
	$Flockoptions = get_option('bulletproof_security_options_flock');

	$filename = ABSPATH . '.htaccess';
	$permsRootHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$sapi_type = php_sapi_name();	
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 46);	
	$htaccessARRoot = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/auto_.htaccess';
	$bps_get_domain_root = bpsGetDomainRoot();
	$bps_get_wp_root_secure = bps_wp_get_root_folder();
	$bps_plugin_dir = str_replace( ABSPATH, '', WP_PLUGIN_DIR);
	$bps_root_upgrade = '';

	$patterna = '/RedirectMatch\s403\s\/\\\.\.\*\$/';
	$pattern0 = '/ErrorDocument\s400\s(.*)400\.php\s*ErrorDocument\s401\sdefault\s*ErrorDocument(.*)\s*ErrorDocument\s404\s\/404\.php/s';
	$pattern1 = '/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s';	
	// Only match 2 or more identical duplicate referer lines: 1 will not match and 2, 3, 4... will match
	$pattern2 = '/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s';	
	$pattern4 = '/\.\*\(allow_url_include\|allow_url_fopen\|safe_mode\|disable_functions\|auto_prepend_file\) \[NC,OR\]/s';
	$pattern6 = '/(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d)/s';
	$pattern7 = '/RewriteCond %{QUERY_STRING} \^\.\*(.*)[3](.*)[5](.*)[5](.*)[7](.*)\)/';
	$pattern8 = '/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/';	
	$pattern9 = '/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*(.*)END\sBPSQSE(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]\s*(.*)LOOP\sEND/';
	$pattern10 = '/#\sBEGIN\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/';
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern11 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/';
	$pattern12 = '/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/';
	$pattern13 = '/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/';
	$pattern14 = '/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/';

	if ( !file_exists($filename)) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! An htaccess file was NOT found in your root folder. Check the BPS Pro ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' for more specific information.', 'bulletproof-security').'</font></div>';
		echo $text;
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE" ) ) {
			print($section);
		}
		break;
    case ! strpos( $check_string, "BULLETPROOF" ) && ! strpos( $check_string, "DEFAULT" ):

		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! Your site may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('The BPS version: BULLETPROOF PRO x.x SECURE .HTACCESS line of code was not found at the top of your Root htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your Root htaccess file.', 'bulletproof-security').'<br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and click the Create secure.htaccess File AutoMagic button and Activate Root Folder BulletProof Mode.', 'bulletproof-security').'</div>';
		echo $text;

		break;
	case ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ):
			
			// delete the old Maintenance Mode DB option - leave this here for 3 versions. Added in BPS Pro 8.2
			if ( get_option('bulletproof_security_options_maint') ) {	
				delete_option('bulletproof_security_options_maint');
			}
			
			if ( @substr( $sapi_type, 0, 6 ) != 'apache' || @$permsRootHtaccess != '0666' || @$permsRootHtaccess != '0777' ) { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}

			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace('/BULLETPROOF PRO(.*)SECURE .HTACCESS/s', "BULLETPROOF PRO $bpspro_version SECURE .HTACCESS", $stringReplace);

			$stringReplace = str_replace("RewriteCond %{HTTP_USER_AGENT} (libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", "RewriteCond %{HTTP_USER_AGENT} (havij|libwww-perl|wget|python|nikto|curl|scan|java|winhttp|clshttp|loader) [NC,OR]", $stringReplace);
		
		if ( preg_match( $patterna, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sDENY\sACCESS\sTO\sPROTECTED\sSERVER\sFILES(.*)RedirectMatch\s403\s\/\\\.\.\*\$/s', "# DENY ACCESS TO PROTECTED SERVER FILES AND FOLDERS\n# Files and folders starting with a dot: .htaccess, .htpasswd, .errordocs, .logs\nRedirectMatch 403 \.(htaccess|htpasswd|errordocs|logs)$", $stringReplace);
		}

		if ( !preg_match( $pattern0, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/ErrorDocument\s400\s(.*)400\.php\s*ErrorDocument(.*)\s*ErrorDocument\s404\s\/404\.php/s', "ErrorDocument 400 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/400.php\nErrorDocument 401 default\nErrorDocument 403 $bps_get_wp_root_secure"."$bps_plugin_dir/bulletproof-security/403.php\nErrorDocument 404 $bps_get_wp_root_secure"."404.php", $stringReplace);
		}
		
		if ( preg_match( $pattern1, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sFORBID\sEMPTY\sREFFERER\sSPAMBOTS(.*)RewriteCond\s%{HTTP_USER_AGENT}\s\^\$\sRewriteRule\s\.\*\s\-\s\[F\]/s', '', $stringReplace);
		}

		if ( preg_match($pattern2, $stringReplace, $matches) ) {
			$stringReplace = preg_replace('/AnotherWebsite\.com\)\.\*\s*(RewriteCond\s%\{HTTP_REFERER\}\s\^\.\*'.$bps_get_domain_root.'\.\*\s*){2,}\s*RewriteRule\s\.\s\-\s\[S=1\]/s', "AnotherWebsite.com).*\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}
		
		if ( !preg_match( $pattern10, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/#\sBPSQSE\sBPS\sQUERY\sSTRING\sEXPLOITS\s*#\sThe\slibwww-perl\sUser\sAgent\sis\sforbidden/', "# BEGIN BPSQSE BPS QUERY STRING EXPLOITS\n# The libwww-perl User Agent is forbidden", $stringReplace);
		}		
		
		if ( preg_match( $pattern10a, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10b, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10c, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern11, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=http:\/\/\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=http:// [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern12, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\[a-zA-Z0-9_\]\=\(\\\.\\\.\/\/\?\)\+\s\[OR\]/s', "RewriteCond %{QUERY_STRING} [a-zA-Z0-9_]=(\.\.//?)+ [NC,OR]", $stringReplace);
		}

		if ( preg_match($pattern13, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%\{QUERY_STRING\}\s\(\\\.\\\.\/\|\\\.\\\.\)\s\[OR\]/s', "RewriteCond %{QUERY_STRING} (\.\./|%2e%2e%2f|%2e%2e/|\.\.%2f|%2e\.%2f|%2e\./|\.%2e%2f|\.%2e/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern6, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>|%3c|%3e|%5b|%5d).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>|%3c|%3e).* [NC,OR]", $stringReplace);
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x5b|\x5d|\x7f).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f).* [NC,OR]", $stringReplace);		
		}
		
		if ( preg_match( $pattern7, $stringReplace, $matches ) ) {
$stringReplace = preg_replace('/RewriteCond %{QUERY_STRING} \^\.\*(.*)[5](.*)[5](.*)\)/', 'RewriteCond %{QUERY_STRING} ^.*(\x00|\x04|\x08|\x0d|\x1b|\x20|\x3c|\x3e|\x7f)', $stringReplace);
		}

		if ( preg_match( $pattern14, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(\\\.\/\|\\\.\.\/\|\\\.\.\.\/\)\+\(motd\|etc\|bin\)\s\[NC,OR\]/s', "RewriteCond %{QUERY_STRING} (\.{1,}/)+(motd|etc|bin) [NC,OR]", $stringReplace);
		}

		if ( !preg_match( $pattern4, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]", "RewriteCond %{QUERY_STRING} union([^a]*a)+ll([^s]*s)+elect [NC,OR]\nRewriteCond %{QUERY_STRING} \-[sdcr].*(allow_url_include|allow_url_fopen|safe_mode|disable_functions|auto_prepend_file) [NC,OR]", $stringReplace);
		}

		if ( !is_multisite() && !preg_match( $pattern9, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace('/RewriteCond\s%{QUERY_STRING}\s\(sp_executesql\)\s\[NC\]\s*(.*)\s*RewriteCond\s%{REQUEST_FILENAME}\s!-f\s*RewriteCond\s%{REQUEST_FILENAME}\s!-d\s*RewriteRule\s\.(.*)\/index\.php\s\[L\]/', "RewriteCond %{QUERY_STRING} (sp_executesql) [NC]\nRewriteRule ^(.*)$ - [F,L]\n# END BPSQSE BPS QUERY STRING EXPLOITS\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . ".$bps_get_wp_root_secure."index.php [L]\n# WP REWRITE LOOP END", $stringReplace);
		}

		// Clean up - replace 3 and 4 multiple newlines with 1 newline
		if ( preg_match('/(\n\n\n|\n\n\n\n)/', $stringReplace, $matches ) ) {			
			$stringReplace = preg_replace("/(\n\n\n|\n\n\n\n)/", "\n", $stringReplace);
		}
		// remove duplicate referer lines
		if ( preg_match( $pattern8, $stringReplace, $matches ) ) {
$stringReplace = preg_replace("/\[NC\]\s*RewriteCond\s%{HTTP_REFERER}\s\^\.\*(.*)\.\*\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*(.*)\s*RewriteRule\s\.\s\-\s\[S=1\]/", "[NC]\nRewriteCond %{HTTP_REFERER} ^.*$bps_get_domain_root.*\nRewriteRule . - [S=1]", $stringReplace);
		}
		
			file_put_contents($filename, $stringReplace);
		
		if ( @$permsRootHtaccess == '0644' && @substr( $sapi_type, 0, 6 ) != 'apache' && $options2['bps_root_htaccess_autolock'] != 'Off' || $Flockoptions['bps_lock_root_htaccess'] == 'yes' ) {			
			@chmod( $filename, 0404 );
		}

			@copy( $filename, $htaccessARRoot );

		if ( getBPSInstallTimeTXT() == getBPSRootHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSRootHtaccessLasModTime_minutes() ) {
			
			$bps_root_upgrade = 'upgrade';
			
			$pos = strpos( $check_string, 'IMPORTANT!!! DO NOT DELETE!!! - B E G I N Wordpress' );
			
			if ( $pos === false ) {
 		
				$updateText = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__("The BPS Pro Automatic htaccess File Update Completed Successfully!", 'bulletproof-security').'</font></div>';
				//print($updateText);	
			}			
			
			// Create /wp-includes/version.php ARQ exclude rule
			bps_wp_versionphp_exclude_rule();
			// Recreate the User Agent filters in the 403.php file on BPS upgrade
			bpsPro_autoupdate_useragent_filters();
			// BPS Pro 9.1 synchronize DB timestamps to GMT file timestamps
			bpsPro_sync_time_gmt();			
			// Delete all the old plugin api junk content in this transient
			delete_transient( 'bulletproof-security_info' );
			// Delete Plugin Firewall Override DB Table if it exists
			$Ptable_name = $wpdb->prefix . "bpspro_pfw_override";
			$wpdb->query("DROP TABLE IF EXISTS $Ptable_name");
			// Delete PFW-TestMode.php file if it exists
			$PFWTestMode = WP_CONTENT_DIR . '/bps-backup/test-mode/PFW-TestMode.php';
			if ( file_exists($PFWTestMode) ) {
				unlink($PFWTestMode);
			}
			// Delete Test Mode DB option if it exists
			delete_option('bulletproof_security_options_pfirewall_TMode');
			// Delete PFW dismiss notice option if it exists
			delete_option('bulletproof_security_options_pfirewall_plugins'); 
			
			// Update BPS DB option - WP version matches the current version of WP & reset the last modified time in DB
			$gmt_offset = get_option( 'gmt_offset' ) * 3600;
			$versionphp = ABSPATH . 'wp-includes/version.php';	
			$last_modified_time_versionphp = date("F d Y H:i", filemtime($versionphp) + $gmt_offset);
			$bps_option_name12 = 'bulletproof_security_options_wp_version';
			$bps_new_value12 = $wp_version;	
			$bps_new_value12_1 = date("F d Y H:i", filemtime($versionphp) + $gmt_offset + 900);	
			
			$BPS_Options12 = array( 'bps_wp_version' => $bps_new_value12, 'bps_wp_version_last_modified_time' => $bps_new_value12_1 );	
	
			if ( ! get_option( $bps_option_name12 ) ) {	
		
				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}
			
			} else {

				foreach( $BPS_Options12 as $key => $value ) {
					update_option('bulletproof_security_options_wp_version', $BPS_Options12);
				}	
			}
		} // end up upgrade processing			
		break;		
	case strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE" ):	
		
			$RBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php" title="Root Folder BulletProof Mode" style="text-decoration:none;">'.__('RBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
			$RBM_str = str_replace( "BULLETPROOF PRO $bpspro_version SECURE .HTACCESS", "BPS Pro $bpspro_version $RBM", $section );
			
			echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">'.$RBM_str.'</div>';
		
		break;
	default:
		
		if ( $bps_root_upgrade != 'upgrade' ) {		
			$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! Your site does not appear to be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and click the Create secure.htaccess File AutoMagic button and Activate Root Folder BulletProof Mode.', 'bulletproof-security').'<br>'.__('If your site is in Default Mode then it is NOT protected by BulletProof Security. Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
			echo $text;
		}
}}}}}}

// S-Monitor Display - wp-admin htaccess - BPS Status and Alerts in BPS - bpsOn
function bps_security_status_wpadmin_bps_only() {
$options = get_option('bulletproof_security_options_monitor');

	if ( current_user_can('manage_options') && $options['bps_security_status'] == 'bpsOn' ) {
		
	global $bpspro_version, $bpspro_last_version, $aitpro_bullet;

	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$BPS_wpadmin_Options = get_option('bulletproof_security_options_htaccess_res');
	$GDMW_options = get_option('bulletproof_security_options_GDMW');		
	
	if ( $BPS_wpadmin_Options['bps_wpadmin_restriction'] == 'disabled' || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) {
		return;
	}

	$filename = ABSPATH . 'wp-admin/.htaccess';
	$permsHtaccess = @substr(sprintf('%o', fileperms($filename)), -4);
	$check_string = @file_get_contents($filename);
	$section = @file_get_contents($filename, NULL, NULL, 3, 50);
	$htaccessARwpadmin = WP_CONTENT_DIR . '/bps-backup/autorestore/wp-admin/wpadmin.htaccess';
	$bps_wpadmin_upgrade = '';
	
	$pattern10a = '/RewriteCond\s%\{THE_REQUEST\}\s(.*)\?(.*)\sHTTP\/\s\[NC,OR\]\s*RewriteCond\s%\{THE_REQUEST\}\s(.*)\*(.*)\sHTTP\/\s\[NC,OR\]/';	
	$pattern10b = '/RewriteCond\s%\{THE_REQUEST\}\s.*\?\+\(%20\{1,\}.*\s*RewriteCond\s%\{THE_REQUEST\}\s.*\+\(.*\*\|%2a.*\s\[NC,OR\]/';	
	$pattern10c = '/RewriteCond\s%\{THE_REQUEST\}\s\(\\\\?.*%2a\)\+\(%20\+\|\\\\s\+.*HTTP\(:\/.*\[NC,OR\]/';
	$pattern1 = '/(\[|\]|\(|\)|<|>)/s';
	
	if ( ! file_exists($filename)) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! An htaccess file was NOT found in your wp-admin folder. Check the BPS Pro ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' for more specific information.', 'bulletproof-security').'</font></div>';
		echo $text;
	
	} else {
	
	if ( file_exists($filename) ) {

switch ( $bpspro_version ) {
    case $bpspro_last_version:
		if ( strpos( $check_string, "BULLETPROOF PRO $bpspro_last_version" ) && strpos( $check_string, "BPSQSE-check" ) ) {
			// echo or print for testing
		}
		break;
    case ! strpos( $check_string, "BULLETPROOF" ):

		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! Your wp-admin folder may not be protected by BulletProof Security', 'bulletproof-security').'</font><br>'.__('The BPS version: BULLETPROOF PRO x.x WP-ADMIN SECURE .HTACCESS line of code was not found at the top of your wp-admin htaccess file.', 'bulletproof-security').'<br>'.__('The BPS version line of code MUST be at the very top of your wp-admin htaccess file.', 'bulletproof-security').'<br>'.__('Go to the ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php">'.__('Security Modes page', 'bulletproof-security').'</a>'.__(' and Activate wp-admin Folder BulletProof Mode.', 'bulletproof-security').'</div>';
		echo $text;

		break;
	case ! strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ):
				
			if ( @substr( $sapi_type, 0, 6 ) != 'apache' || @$permsHtaccess != '0666' || @$permsHtaccess != '0777') { // Windows IIS, XAMPP, etc
				@chmod($filename, 0644);
			}
			
			$stringReplace = @file_get_contents($filename);
			$stringReplace = preg_replace('/BULLETPROOF PRO(.*)WP-ADMIN SECURE .HTACCESS/s', "BULLETPROOF PRO $bpspro_version WP-ADMIN SECURE .HTACCESS", $stringReplace);

		if ( preg_match( $pattern10a, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10a, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10b, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10b, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern10c, $stringReplace, $matches ) ) {
			$stringReplace = preg_replace( $pattern10c, "RewriteCond %{THE_REQUEST} (\?|\*|%2a)+(%20+|\\\\\s+|%20+\\\\\s+|\\\\\s+%20+|\\\\\s+%20+\\\\\s+)HTTP(:/|/) [NC,OR]", $stringReplace);
		}

		if ( preg_match( $pattern1, $stringReplace, $matches ) ) {
			$stringReplace = str_replace("RewriteCond %{QUERY_STRING} ^.*(\[|\]|\(|\)|<|>).* [NC,OR]", "RewriteCond %{QUERY_STRING} ^.*(\(|\)|<|>).* [NC,OR]", $stringReplace);		
		}

			file_put_contents($filename, $stringReplace);
			@copy($filename, $htaccessARwpadmin);	
		
		if ( getBPSInstallTimeTXT() == getBPSwpadminHtaccessLasModTime_minutes() || getBPSInstallTime_plusone() == getBPSwpadminHtaccessLasModTime_minutes() ) {
			//print("Testing wp-admin auto-update");	
			$bps_wpadmin_upgrade = 'upgrade';
		} // end upgrade processing	
		break;		
	case strpos( $check_string, "BULLETPROOF PRO $bpspro_version" ) && strpos( $check_string, "BPSQSE-check" ):
		
			$WBM = $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#WBM-Link" title="wp-admin Folder BulletProof Mode" style="text-decoration:none;">'.__('WBM', 'bulletproof-security').'</a>: <font color="green"><strong>'.__('On', 'bulletproof-security').'</strong></font>';
			$WBM_str = str_replace( "BULLETPROOF PRO $bpspro_version WP-ADMIN SECURE .HTACCESS", "$WBM", $section );			
			
			echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">'.$WBM_str;
			
			if ( $options['bps_autorestore_status'] == 'bpsOn' || $options['bps_dbm_status'] == 'bpsOn' || $options['bps_dbb_status'] == 'bpsOn' || $options['bps_plugin_firewall_status'] == 'bpsOn' || $options['bps_UAEG_status'] == 'bpsOn' || $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {

				echo '</div>';	

			} else {
				
				echo '</div><div style="clear:both;"></div>';		
			}		
		
		break;
	default:
		
		if ( $bps_wpadmin_upgrade != 'upgrade' ) {		
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('BPS Pro Alert! A valid BPS Pro htaccess file was NOT found in your wp-admin folder', 'bulletproof-security').'</font><br>'.__('BulletProof Mode for the wp-admin folder should also be activated when you have BulletProof Mode activated for the Root folder', 'bulletproof-security').'<br>'.__('Check the BPS ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#bps-tabs-2">'.__('Security Status page', 'bulletproof-security').'</a>'.__(' to view your BPS Security Status information.', 'bulletproof-security').'</div>';
		echo $text;
		}
	}
	}
	}
	}
	}
}

// S-Monitor - AutoRestore Status display - BPS pages ONLY
function bps_ARCM_admin_notice_status_bps() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_autorestore_status'] == 'bpsOn' ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

		echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">';
		echo bpsProARCMStatus();

		if ( $options['bps_dbm_status'] == 'bpsOn' || $options['bps_dbb_status'] == 'bpsOn' || $options['bps_plugin_firewall_status'] == 'bpsOn' || $options['bps_UAEG_status'] == 'bpsOn' || $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {
				
			echo '</div>';	

		} else {
				
			echo '</div><div style="clear:both;"></div>';		
		}	
	}
	}
}

// S-Monitor - DB Monitor Status display - BPS pages ONLY
function bps_DBM_admin_notice_status_bps() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_dbm_status'] == 'bpsOn' ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {
	
		echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">';
		echo bpsProDBMStatus();
			
		if ( $options['bps_dbb_status'] == 'bpsOn' || $options['bps_plugin_firewall_status'] == 'bpsOn' || $options['bps_UAEG_status'] == 'bpsOn' || $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {
				
			echo '</div>';	

		} else {
				
			echo '</div><div style="clear:both;"></div>';		
		}	
	}
	}
}

// S-Monitor - DB Backup Status display - BPS pages ONLY
function bps_DBB_admin_notice_status_bps() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_dbb_status'] == 'bpsOn' ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {
	
		echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">';
		echo bpsProDBBStatus();
		
		if ( $options['bps_plugin_firewall_status'] == 'bpsOn' || $options['bps_UAEG_status'] == 'bpsOn' || $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {
				
			echo '</div>';	

		} else {
				
			echo '</div><div style="clear:both;"></div>';		
		}
	}
	}
}

// S-Monitor - Plugin Firewall Status display - BPS pages ONLY
function bps_PFWAP_admin_notice_status_bps() {
$options = get_option('bulletproof_security_options_monitor');
	
	if ( current_user_can('manage_options') && $options['bps_plugin_firewall_status'] == 'bpsOn' ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {
	
		echo '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">';
		echo bpsProPFWAPStatus();
			
		if ( $options['bps_UAEG_status'] == 'bpsOn' || $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {

			echo '</div>';	

		} else {
				
			echo '</div><div style="clear:both;"></div>';		
		}	
	}
	}
}

// S-Monitor - Uploads Anti-Exploit Guard Status display - BPS pages ONLY
function bps_UAEG_admin_notice_status_bps() {
	
	if ( current_user_can('manage_options') ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	global $aitpro_bullet;
	$options = get_option('bulletproof_security_options_monitor');

	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - no need to also display a notification for this
	if ( !$options['bps_first_launch'] && !$options['bps_UAEG_status'] ) { 
		return;
	}
	
	if ( $options['bps_UAEG_status'] == 'Off' ) {
		return;
	}

	if ( $options['bps_UAEG_status'] == 'bpsOn') {

		if ( $options['bps_login_security_status'] == 'bpsOn' || $options['bps_jtc_antispam_status'] == 'bpsOn' ) {
			
			$status_DDiv = '</div>';

		} else {
			
			$status_DDiv = '</div><div style="clear:both;"></div>';			
		}

	$bps_Uploads_Dir = wp_upload_dir();	
	$UploadsHtaccess = $bps_Uploads_Dir['basedir'] . '/.htaccess'; // for both single and Multisite is the standard /uploads folder	

	if ( file_exists($UploadsHtaccess) ) {
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link" title="Uploads Anti-Exploit Guard" style="text-decoration:none;">'.__('UAEG', 'bulletproof-security').'</a>: <font color="green">'.__('On', 'bulletproof-security').'</font>'.$status_DDiv;
		echo $text;
	
	} else {
		
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/core/options.php#UAEG-Menu-Link" title="Uploads Anti-Exploit Guard" style="text-decoration:none;">'.__('UAEG', 'bulletproof-security').'</a>: <font color="red"><strong>'.__('Off', 'bulletproof-security').'</font>'.$status_DDiv;
		echo $text;
	}	
	}
	}
	}
}

// S-Monitor - Login Security Status display - BPS pages ONLY
function bps_Login_Security_admin_notice_status_bps() {
global $aitpro_bullet;
	
	if ( current_user_can('manage_options') ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$options = get_option('bulletproof_security_options_monitor');
	$BPSoptions = get_option('bulletproof_security_options_login_security');	

	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - no need to also display a notification for this
	if ( !$options['bps_first_launch'] && !$options['bps_login_security_status'] ) { 
		return;
	}
	// this is already handled by the WP Dashboard alert
	if ( $options['bps_first_launch'] && !$options['bps_login_security_status'] ) { 
		return;
	}
	
	if ( $options['bps_login_security_status'] == 'Off' && $BPSoptions['bps_login_security_OnOff'] == 'Off' ) {
		return;
	}

		if ( $options['bps_jtc_antispam_status'] == 'bpsOn' ) {
			
			$status_DDiv = '</div>';

		} else {
			
			$status_DDiv = '</div><div style="clear:both;"></div>';			
		}

	if ( $options['bps_login_security_status'] == 'bpsOn' ) {

	if ( $BPSoptions['bps_login_security_OnOff'] == 'On' ) {
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="green">'.__('On', 'bulletproof-security').'</font>'.$status_DDiv;
		echo $text;
	}

	if ( $BPSoptions['bps_login_security_OnOff'] == 'Off' || $BPSoptions['bps_login_security_OnOff'] == 'pwreset' ) {
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php" title="Login Security & Monitoring" style="text-decoration:none;">'.__('LSM', 'bulletproof-security').'</a>: <font color="red">'.__('Off', 'bulletproof-security').'</font>'.$status_DDiv;
		echo $text;
	}
	}
	}
	}
}

// S-Monitor - JTC Anti-Spam Status display WP Dashboard - BPS Pages ONLY
function bps_jtc_antispam_admin_notice_status_bps() {
global $aitpro_bullet;
	
	if ( current_user_can('manage_options') ) {
	
	if ( esc_html($_SERVER['REQUEST_METHOD']) != 'POST' && esc_html($_SERVER['QUERY_STRING']) != 'page=bulletproof-security/admin/system-info/system-info.php' ) {

	$options = get_option('bulletproof_security_options_monitor');
	$BPSoptionsJTC = get_option('bulletproof_security_options_login_security_jtc');

	// new installations of BPS - First Install / Launch S-Monitor Notification is already displayed - do not display an additional notification
	if ( ! $options['bps_first_launch'] && ! $options['bps_jtc_antispam_status'] ) { 
		return;
	}

	if ( $options['bps_jtc_antispam_status'] == 'Off' ) {
		return;
	}

	if ( $options['bps_jtc_antispam_status'] == 'bpsOn' ) {

	if ( $BPSoptionsJTC['bps_jtc_login_form'] == '1' || $BPSoptionsJTC['bps_jtc_register_form'] == '1' || $BPSoptionsJTC['bps_jtc_lostpassword_form'] == '1' || $BPSoptionsJTC['bps_jtc_comment_form'] == '1' || $BPSoptionsJTC['bps_jtc_buddypress_register_form'] == '1' || $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] == '1' ) {
		
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2" title="JTC Anti-Spam|Anti-Hacker" style="text-decoration:none;">'.__('JTC', 'bulletproof-security').'</a>: <font color="green">'.__('On', 'bulletproof-security').'</font></div><div style="clear:both;"></div>';
		echo $text;
	} 

	if ( $BPSoptionsJTC['bps_jtc_login_form'] != '1' && $BPSoptionsJTC['bps_jtc_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_lostpassword_form'] != '1' && $BPSoptionsJTC['bps_jtc_comment_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_register_form'] != '1' && $BPSoptionsJTC['bps_jtc_buddypress_sidebar_form'] != '1' ) {
		
		$text = '<div id="bps-status-display" style="background-color:#eeeeee;font-weight:bold;float:left;margin:0px 0px 10px 0px;">' . $aitpro_bullet . '<a href="admin.php?page=bulletproof-security/admin/login/login.php#bps-tabs-2" title="JTC Anti-Spam|Anti-Hacker" style="text-decoration:none;">'.__('JTC', 'bulletproof-security').'</a>: <font color="red">'.__('Off', 'bulletproof-security').'</font></div><div style="clear:both;"></div>';
		echo $text;
	}
	}
	}
	}
}

// S-Monitor - Login Security Last modified check - BPS Only
function bps_smonitor_LoginSecurityResetModTimeDiff_bps() {

	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');

	if ( $options['bps_login_security_status'] == 'bpsOn' ) {
	
	$LSAlertsoptions = get_option('bulletproof_security_options_login_alerts');
	$filename = WP_CONTENT_DIR . '/bps-backup/master-backups/Login-Security-Alert-Reset.txt'; 	
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;	
	
	if ( strcmp( bps_getLoginSecurityResetFileLastMod_secs(), $LSAlertsoptions['bps_login_security_db_mod_time'] ) != 0 && $LSAlertsoptions['bps_login_security_db_mod_time'] != '' && strcmp( bps_getLoginSecurityResetFileLastMod_minutes(), getBPSInstallTime() ) == 0 ) {
	
		touch( $filename, strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $LSAlertsoptions['bps_login_security_db_mod_time'] ) - 3600;	
	
	if ( strcmp( bps_getLoginSecurityResetFileLastMod_secs(), $LSAlertsoptions['bps_login_security_db_mod_time'] ) != 0  && $db_timestamp_plus_one != strtotime( bps_getLoginSecurityResetFileLastMod_secs() ) && $db_timestamp_minus_one != strtotime( bps_getLoginSecurityResetFileLastMod_secs() ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Login Security Alert', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/login/login.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Login Security page.', 'bulletproof-security').'<br>'.__('To reset/clear Login Security Alerts click the Reset|Clear Login Security Alerts button on the Login Security page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
}

// S-Monitor - PHP Error Log new errors - String comparison of DB Last Modified Time and Actual File Last Modified Time - BPS Only
function bps_smonitor_ELogModTimeDiff_bps() {
	
	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');	
	
	if ( $options['bps_PHP_ELog_error'] == 'bpsOn' ) {
	
	$ELog_mod_time = get_option('bulletproof_security_options_elog');
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	$ELog_location = get_option('bulletproof_security_options2');
	$filename = $ELog_location['bps_error_log_location'];	
	
	if ( strcmp( bps_getPhpELogLastMod_smonitor(), $ELog_mod_time['bps_error_log_date_mod'] ) != 0 && $ELog_mod_time['bps_error_log_date_mod'] != '' && strcmp( bps_getPhpELogLastMod_minutes(), getBPSInstallTime() ) == 0 ) {

		touch( $ELog_location['bps_error_log_location'], strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) - $gmt_offset );
	}
	
	$db_timestamp_plus_one = strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $ELog_mod_time['bps_error_log_date_mod'] ) - 3600;	
	
	if ( strcmp( bps_getPhpELogLastMod_smonitor(), $ELog_mod_time['bps_error_log_date_mod'] ) != 0  && $db_timestamp_plus_one != strtotime( bps_getPhpELogLastMod_smonitor() ) && $db_timestamp_minus_one != strtotime( bps_getPhpELogLastMod_smonitor() ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('A PHP Error has been logged in your PHP Error Log', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To go to the P-Security PHP Error Log page.', 'bulletproof-security').'<br>'.__('To remove/clear this Alert click on the Reset Last Modified Time in DB button.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
}

// S-Monitor - Security Log new errors - String comparison of DB Last Modified Time and Actual File Last Modified Time - BPS Only
function bps_smonitor_SecurityLogModTimeDiff_bps() {

	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');	
	
	if ( $options['bps_SecLog_entry'] == 'bpsOn' ) {
	
	$SecLog_mod_date = get_option('bulletproof_security_options_Security_log');
	$filename = WP_CONTENT_DIR . '/bps-backup/logs/http_error_log.txt';	
	$gmt_offset = get_option( 'gmt_offset' ) * 3600;
	
	if ( strcmp( bps_getSecurityLogLastMod_secs(), $SecLog_mod_date['bps_security_log_date_mod'] ) != 0 && $SecLog_mod_date['bps_security_log_date_mod'] != '' && strcmp( bps_getSecurityLogLastMod_minutes(), getBPSInstallTime() ) == 0 ) {

		touch( $filename, strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) - $gmt_offset );	
	}
	
	$db_timestamp_plus_one = strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) + 3600;
	$db_timestamp_minus_one = strtotime( $SecLog_mod_date['bps_security_log_date_mod'] ) - 3600;	
	
	if ( strcmp( bps_getSecurityLogLastMod_secs(), $SecLog_mod_date['bps_security_log_date_mod'] ) != 0 && $db_timestamp_plus_one != strtotime( bps_getSecurityLogLastMod_secs() ) && $db_timestamp_minus_one != strtotime( bps_getSecurityLogLastMod_secs() ) ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Security Log Alert', 'bulletproof-security').'</font><br>'.__('A New Security Log Entry Has Been Logged. ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/security-log/security-log.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Security Log.', 'bulletproof-security').'<br>'.__('To remove this alert click the Reset Last Modified Time in DB button on the Security Log page.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
}

// S-Monitor - PHP Error Log Path/Location Check - Check if the php error log path is valid - BPS Only
// ini_set Options Checks & auto-update wp-config.php & add the 3 new ini_set options.
function bps_smonitor_phpini_bps() {

	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');	
	$options3 = get_option('bulletproof_security_options2');	
	$ElogPathSet = $options3['bps_error_log_location'];	

	if ( $options['bps_PHP_ELogLoc_set'] == 'bpsOn' && $ElogPathSet != '' ) { 
	
	$ElogPathServer = ini_get('error_log');	
	$ElogPathServerXampp = addslashes( ini_get('error_log') );	
	
	if ( strcmp($ElogPathServer, $ElogPathSet) != 0 && strcmp($ElogPathServerXampp, $ElogPathSet) != 0 ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red"><font color="red">'.__('PHP Error Log Path Does Not Match', 'bulletproof-security').'</font><br>'.__('The PHP Error Log Location Set To: folder path does not match the Error Log Path Seen by Server: folder path.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-5">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the PHP Error Log page and click the Htaccess Protected Secure PHP Error Log Read Me button for troubleshooting steps.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}

	if ( $options['bps_phpini_created'] == 'bpsOn' ) { 
	
	$ini_set_options = get_option('bulletproof_security_options_iniSet');	
	
	if ( !$ini_set_options['bps_iniSet_ErrorReporting'] ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;">'.__('ini_set Options Need To Be Saved & The PHP Error Log Path|Location Needs To Be Set', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/php/php-options.php#bps-tabs-2">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the P-Security ini_set Options page and click the 1. Save Options button, click the 2. Enable Options button, click the Refresh Status button and go to the PHP Error Log tab page.', 'bulletproof-security').'<br>'.__('Copy the Error Log Path Seen by Server: file path to the PHP Error Log Location Set To: text box and click the Set Error Log Location button.', 'bulletproof-security').'<br>'.__('Click the Read Me Help buttons if you need additional help info.', 'bulletproof-security').'</div>';
		echo $text;
	}

	$wpconfig = ABSPATH . 'wp-config.php';
	$wpconfigARQ = WP_CONTENT_DIR . '/bps-backup/autorestore/root-files/wp-config.php';

	// automatic ini_set update if the wp-config.php file exists in the root folder & display a one time New Feature notification
	if ( file_exists($wpconfig) && !$ini_set_options['bps_iniSet_session_cookie_httponly'] ) {
		$sapi_type = php_sapi_name();
		$permsWpconfig = @substr(sprintf('%o', fileperms($wpconfig)), -4);
		$Flockoptions = get_option('bulletproof_security_options_flock');
		$subject = file_get_contents($wpconfig);
		$pattern = '/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s';
		
		$replacement = "/** BEGIN BPS Pro ini_set Settings **/
@error_reporting(".$ini_set_options['bps_iniSet_ErrorReporting'].");
@ini_set('log_errors','".$ini_set_options['bps_iniSet_LogErrors']."');
@ini_set('error_log','".$ini_set_options['bps_iniSet_ErrorLog']."'); // add the path to your php error log
@ini_set('log_errors_max_len','".$ini_set_options['bps_iniSet_LogErrorsMaxLen']."');
@ini_set('memory_limit','".$ini_set_options['bps_iniSet_MemoryLimit']."');
@ini_set('session.cookie_httponly','On');
@ini_set('session.use_only_cookies','On');
@ini_set('session.cookie_secure','Off');
@ini_set('ignore_repeated_errors','".$ini_set_options['bps_iniSet_IgnoreRepeatedErrors']."');
@ini_set('ignore_repeated_source','".$ini_set_options['bps_iniSet_IgnoreRepeatedSource']."');
@ini_set('allow_url_include','".$ini_set_options['bps_iniSet_AllowUrlInclude']."');
@ini_set('define_syslog_variables','".$ini_set_options['bps_iniSet_DefineSyslogVar']."');
@ini_set('display_errors','".$ini_set_options['bps_iniSet_DisplayErrors']."');
@ini_set('display_startup_errors','".$ini_set_options['bps_iniSet_DisplayStartupErrors']."');
@ini_set('implicit_flush','".$ini_set_options['bps_iniSet_ImplicitFlush']."');
@ini_set('magic_quotes_runtime','".$ini_set_options['bps_iniSet_MagicQuotesRuntime']."');
@ini_set('max_execution_time','".$ini_set_options['bps_iniSet_MaxExecutionTime']."');
@ini_set('mysql.connect_timeout','".$ini_set_options['bps_iniSet_MysqlConnectTimeout']."');
@ini_set('mysql.trace_mode','".$ini_set_options['bps_iniSet_MysqlTraceMode']."');
@ini_set('report_memleaks','".$ini_set_options['bps_iniSet_ReportMemleaks']."');
/** END BPS Pro ini_set Settings **/";		
		
		if ( preg_match($pattern, $subject, $matches) && $ini_set_options['bps_iniSet_ErrorLog'] != '' && $ini_set_options['bps_iniSet_LogErrorsMaxLen'] != '' && $ini_set_options['bps_iniSet_MemoryLimit'] != '' && $ini_set_options['bps_iniSet_MaxExecutionTime'] != '' && $ini_set_options['bps_iniSet_MysqlConnectTimeout'] != '') {
		
			if ( substr($sapi_type, 0, 6) != 'apache' || @$permsWpconfig != '0666' || @$permsWpconfig != '0777') { // Windows IIS, XAMPP, etc
				@chmod($wpconfig, 0644);
			}
		
			$stringReplace = @file_get_contents($wpconfig);
			$stringReplace = preg_replace('/\/\*\* BEGIN BPS Pro ini_set Settings \*\*\/(.*?)\/\*\* END BPS Pro ini_set Settings \*\*\//s', $replacement, $stringReplace);
		
			if ( file_put_contents($wpconfig, $stringReplace) ) {		
				@copy($wpconfig, $wpconfigARQ);	
					$text = '<div class="update-nag" style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:2px 5px;margin-top:2px;"><font color="blue">'.__('New Feature|Options Notification', 'bulletproof-security').'</font><br>'.__('3 New ini_set Options added to wp-config.php successfully: session.cookie_httponly, session.cookie_secure & session.use_only_cookies.', 'bulletproof-security').'<br>'.__('This is a one time New Feature|Options Notification that will go away automatically.', 'bulletproof-security').'</div>';
					echo $text;

					$BPS_Options5 = array(
					'bps_iniSet_ErrorReporting' 			=> $ini_set_options['bps_iniSet_ErrorReporting'], 
					'bps_iniSet_LogErrors' 					=> $ini_set_options['bps_iniSet_LogErrors'], 
					'bps_iniSet_ErrorLog' 					=> $ini_set_options['bps_iniSet_ErrorLog'], 
					'bps_iniSet_LogErrorsMaxLen' 			=> $ini_set_options['bps_iniSet_LogErrorsMaxLen'], 
					'bps_iniSet_MemoryLimit' 				=> $ini_set_options['bps_iniSet_MemoryLimit'], 
					'bps_iniSet_session_cookie_httponly' 	=> 'On', 
					'bps_iniSet_session_use_only_cookies' 	=> 'On', 
					'bps_iniSet_session_cookie_secure' 		=> 'Off', 
					'bps_iniSet_IgnoreRepeatedErrors' 		=> $ini_set_options['bps_iniSet_IgnoreRepeatedErrors'], 
					'bps_iniSet_IgnoreRepeatedSource' 		=> $ini_set_options['bps_iniSet_IgnoreRepeatedSource'], 
					'bps_iniSet_AllowUrlInclude' 			=> $ini_set_options['bps_iniSet_AllowUrlInclude'], 
					'bps_iniSet_DefineSyslogVar' 			=> $ini_set_options['bps_iniSet_DefineSyslogVar'], 
					'bps_iniSet_DisplayErrors' 				=> $ini_set_options['bps_iniSet_DisplayErrors'], 
					'bps_iniSet_DisplayStartupErrors' 		=> $ini_set_options['bps_iniSet_DisplayStartupErrors'], 
					'bps_iniSet_ImplicitFlush' 				=> $ini_set_options['bps_iniSet_ImplicitFlush'], 
					'bps_iniSet_MagicQuotesRuntime' 		=> $ini_set_options['bps_iniSet_MagicQuotesRuntime'], 
					'bps_iniSet_MaxExecutionTime' 			=> $ini_set_options['bps_iniSet_MaxExecutionTime'], 
					'bps_iniSet_MysqlConnectTimeout' 		=> $ini_set_options['bps_iniSet_MysqlConnectTimeout'], 
					'bps_iniSet_MysqlTraceMode' 			=> $ini_set_options['bps_iniSet_MysqlTraceMode'], 
					'bps_iniSet_ReportMemleaks' 			=> $ini_set_options['bps_iniSet_ReportMemleaks'] 
					);
					
					foreach( $BPS_Options5 as $key => $value ) {
						update_option('bulletproof_security_options_iniSet', $BPS_Options5);
					}

				if ( substr($sapi_type, 0, 6) != 'apache' && @$permsWpconfig == '0644' || $Flockoptions['bps_lock_wpconfig'] == 'yes') {			
					@chmod($wpconfig, 0400);
				}		
			}
		}
	}
	}
	}
}

// F-Lock - Check if F-Lock options saved - F-Lock Lock / Unlock File Status & actual file permissions 404 or 400 - BPS Only
function bps_smonitor_flock_bps() {
	
	if ( current_user_can('manage_options') ) {
	
	$options = get_option('bulletproof_security_options_monitor');	
	
	if ( $options['bps_flock_status'] == 'Off' ) { 
		return;
	}

	if ( ! get_option('bulletproof_security_options_flock' ) ) {
	if ( $options['bps_flock_status'] == 'bpsOn' ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;">'.__('BPS Pro F-Lock Notification', 'bulletproof-security').'<br>'.__('F-Lock options have not been saved yet.', 'bulletproof-security').'<br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the F-Lock page to choose and save your File Lock|Unlock options.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	
	if ( $options['bps_flock_status'] == 'bpsOn' ) { 
	
	clearstatcache();

	$fileRH = ABSPATH . '.htaccess';
	$fileWPC = ABSPATH . 'wp-config.php';
	$fileRI = ABSPATH . 'index.php';
	$fileBH = ABSPATH . 'wp-blog-header.php';
	$fileDRH = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
	$fileDRI = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
	$fileHGWIOD = dirname(ABSPATH) . '/.htaccess';
	$fileIGWIOD = dirname(ABSPATH) . '/index.php';

	$permsRH = @substr(sprintf('%o', fileperms($fileRH)), -4);
	$permsWPC = @substr(sprintf('%o', fileperms($fileWPC)), -4);
	$permsRI = @substr(sprintf('%o', fileperms($fileRI)), -4);
	$permsBH = @substr(sprintf('%o', fileperms($fileBH)), -4);
	$permsDRH = @substr(sprintf('%o', fileperms($fileDRH)), -4);
	$permsDRI = @substr(sprintf('%o', fileperms($fileDRI)), -4);
	$permsHGWIOD = @substr(sprintf('%o', fileperms($fileHGWIOD)), -4);
	$permsIGWIOD = @substr(sprintf('%o', fileperms($fileIGWIOD)), -4);

	$options2 = get_option('bulletproof_security_options_flock'); 
	$GDMW_options = get_option('bulletproof_security_options_GDMW');	
	
	if ( $options2['bps_lock_root_htaccess'] == 'off' || !$options2['bps_lock_root_htaccess'] ) { 
		echo '';
	}	
	elseif ( $options2['bps_lock_root_htaccess'] == 'no' || $permsRH != '0404' ) {
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your Root htaccess File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your Root htaccess file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_wpconfig'] == 'off' || !$options2['bps_lock_wpconfig'] ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_wpconfig'] == 'no'  || $permsWPC != '0400' && file_exists($fileWPC) ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your wp-config.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your wp-config.php file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_index_php'] == 'off' || !$options2['bps_lock_index_php'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_index_php'] == 'no' || $permsRI != '0400' ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your WP Root index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your WP Root index.php file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_wpblog_header'] == 'off' || !$options2['bps_lock_wpblog_header'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_wpblog_header'] == 'no' || $permsBH != '0400' ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your wp-blog-header.php File is not Locked', 'bulletproof-security').'</font><br><strong><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your wp-blog-header.php file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_root_htaccess_dr'] == 'off' || !$options2['bps_lock_root_htaccess_dr'] ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_root_htaccess_dr'] == 'no' || $permsDRH != '0404' && file_exists($fileDRH) ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your DR Root htaccess File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your DR Root htaccess file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_index_php_dr'] == 'off' || !$options2['bps_lock_index_php_dr'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_index_php_dr'] == 'no' || $permsDRI != '0400' && file_exists($fileDRI) ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your DR WP index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your DR WP index.php file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_root_htaccess_gwiod'] == 'off' || !$options2['bps_lock_root_htaccess_gwiod'] ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_root_htaccess_gwiod'] == 'no' || $permsHGWIOD != '0404' && file_exists($fileHGWIOD) ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your GWIOD Root htaccess File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your GWIOD Root htaccess file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	if ( $options2['bps_lock_index_php_gwiod'] == 'off' || !$options2['bps_lock_index_php_gwiod'] || $GDMW_options['bps_gdmw_hosting'] == 'yes' ) { 
		echo '';
	}
	elseif ( $options2['bps_lock_index_php_gwiod'] == 'no' || $permsIGWIOD != '0400' && file_exists($fileIGWIOD) ) { 
		$text = '<div style="background-color:#ffffe0;font-size:1em;font-weight:bold;padding:0px 5px;"><font color="red">'.__('Your GWIOD WP index.php File is not Locked', 'bulletproof-security').'</font><br><a href="admin.php?page=bulletproof-security/admin/lock/flock.php">'.__('Click Here', 'bulletproof-security').'</a>'.__(' To Lock your GWIOD WP index.php file.', 'bulletproof-security').'</div>';
		echo $text;
	}
	}
	}
}

// Plugin Firewall Whitelist checks for valid whitelist rules/paths/scripts
function bpsPFWWhitelistRulesCheck() {

	if ( current_user_can('manage_options') ) {

	$options = get_option('bulletproof_security_options_pfirewall'); 
	$pattern1 = '/(\/(.*)\s{2}\/|\/(.*)\s{3}\/|\/(.*)\s{4}\/|\/(.*)\s{5}\/|\/(.*),\/|\n|\r)/';		
	$pattern2 = '/(\bver=\b|\bpage=\b|\bsrc=\b|\bwww\b|\bhttp\b|\bhttps\b|\bhref\b|\b\.com\b|\b\.net\b|\b\.org\b\b\.biz\b|\b\.info\b|\b\.gov\b|\b\.edu\b)/';
	$pattern3 = '/[\%\"\'\&\;\<\>]/';
	$pattern4 = '/(\/bulletproof-security\/admin\/js\/\(\.\*\)\.js|\/bulletproof-security\/)/';
	//$pattern5 = '/(\/themes\/|\/plugins\/|\/wp-content\/|\/wp-includes\/|\/uploads\/)/';
	$pattern5 = '/(\/plugins\/|\/wp-content\/|\/wp-includes\/)/';

	$error = '0';

	if ( preg_match( $pattern1, $options['bps_pfw_whitelist'], $matches ) ) {
		$text = '<font color="red"><strong>'.__('Error: Your Whitelist rules either have additional/extra whitespaces between whitelist rules, line breaks/new lines between<br>or after your whitelist rules or no space after the comma between your plugin scripts/paths/rules.', 'bulletproof-security').'</font><br>'.__('Click on the Plugin Firewall Whitelist Tools accordian tab and click the Save Whitelist Data button to see if this automatically fixes the problem.<br>If the error is still occurring then correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area.', 'bulletproof-security').'<br>'.__('Edit your Whitelist rules to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js.<br>Plugin paths/scripts are separated by a comma and a single space. Your whitelist rules should be one continuous single line of scripts/paths/rules without any line breaks/new lines.', 'bulletproof-security').'</strong><br>';
		echo $text;
	$error = '1';
	}
	if ( preg_match( $pattern2, $options['bps_pfw_whitelist'], $matches ) ) {
		$text = '<font color="red"><strong>'.__('Error: One or more of your Whitelist rules are not valid', 'bulletproof-security').'</font><br>'.__('Click on the Plugin Firewall Whitelist Tools accordian tab and correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area.', 'bulletproof-security').'<br>'.__('Edit your Whitelist rules and correct whitelist rules that contain any of these invalid things:', 'bulletproof-security').'<br>'.__('ver=, page=, src=, www, http, https, href, .com, .net, .org, .biz, .info, .gov, .edu and', 'bulletproof-security').'<br>'.__('click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	$error = '2';
	}
	if ( preg_match( $pattern3, $options['bps_pfw_whitelist'], $matches ) ) {
		$text = '<font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid characters: %, ", \', &, <, > or ;', 'bulletproof-security').'</font><br>'.__('Click on the Plugin Firewall Whitelist Tools accordian tab and correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area.', 'bulletproof-security').'<br>'.__('Edit your Whitelist rules to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	$error = '3';
	}
	if ( preg_match( $pattern4, $options['bps_pfw_whitelist'], $matches ) ) {
		$text = '<font color="red"><strong>'.__('Error: Your Whitelist rules have a /bulletproof-security/admin/js/ script whitelisted', 'bulletproof-security').'</font><br>'.__('The bulletproof-security plugin js scripts should NOT be whitelisted.', 'bulletproof-security').__('Click on the Plugin Firewall Whitelist Tools accordian tab and correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area.', 'bulletproof-security').'<br>'.__('Delete the bulletproof-security js script(s) and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	$error = '4';
	}
	if ( preg_match( $pattern5, $options['bps_pfw_whitelist'], $matches ) ) {
		$text = '<font color="red"><strong>'.__('Error: One or more of your Whitelist rules contain these invalid paths: /plugins/ or /wp-content/ or /wp-includes/', 'bulletproof-security').'</font><br>'.__('Click on the Plugin Firewall Whitelist Tools accordian tab and correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area.', 'bulletproof-security').'<br>'.__('Edit your Whitelist rules to correct the error and click the Save Whitelist Data button, click the Create Firewall Master File button and activate the Plugin Firewall again.', 'bulletproof-security').'<br>'.__('Valid plugin Whitelist rules MUST use ONLY this Format: /plugin-folder-name/plugin-script.js, /plugin-folder-name/(.*).js. Plugin paths/scripts are separated by a comma and a single space.', 'bulletproof-security').'</strong><br>';
		echo $text;
	$error = '5';
	}
	if ( $error != '0' ) {
		echo '<div id="message" class="updated" style="border:1px solid #999999;margin-left:220px;background-color:#ffffe0;"><p>';
		$text = '<font color="red"><strong>'.__('BPS Alert! Plugin Firewall Invalid Whitelist Rules', 'bulletproof-security').'</font><br>'.__('One or more of your Plugin Firewall Whitelist rules are not valid. ', 'bulletproof-security').'<a href="admin.php?page=bulletproof-security/admin/core/options.php#PFWScan-Menu-Link" style="text-decoration:underline;">'.__('Click Here', 'bulletproof-security').'</a>'.__(' to go to the Plugin Firewall Tools section. A detailed error message will be displayed to you with what needs to be corrected. Click on the Plugin Firewall Whitelist Tools accordian tab and correct/fix any invalid plugin whitelist rules in the Plugins Script|File Whitelist Text Area. The Plugin Firewall has been automatically deactivated/turned Off until this issue is corrected so that this issue does not cause a problem for your website.', 'bulletproof-security').'</strong><br>';
		echo $text;
		echo '</p></div>';			
	}
}
}

?>