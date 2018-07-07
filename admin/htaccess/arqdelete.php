<?php
// BulletProof Security Pro stand alone file
//
// Delete the AutoRestore DB Option - Turns Off/Deactivates AutoRestore
// Delete the Quarantine DB Table Rows and quarantined files in the Quarantine folder: /wp-content/bps-backup/quarantine.
/*
// This is the error that will occur if someone enters an incorrect DB Table Prefix:
// Warning: mysql_fetch_assoc() expects parameter 1 to be resource, boolean given in C:\xampp2\htdocs7\aitpro\arqdelete.php on line 69
*/

// Form - Delete the AutoRestore Database Option
if ( isset($_POST['ARQ-DB-Option-Delete']) ) {
	
	$DBHost = $_POST['dbhost'];
	$DBUser = $_POST['dbuser'];
	$DBPass = $_POST['dbpassword'];
	$DBName = $_POST['dbname'];
	$wp_options = $_POST['tableprefix'] . "options";	

	$mysqli = new mysqli($DBHost, $DBUser, $DBPass, $DBName);

	/* check connection */
	if ( mysqli_connect_errno() ) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    //exit();
	}

	$query = "SELECT * FROM $wp_options WHERE option_name = 'bulletproof_security_options_ARCM'";

	if ( $result = $mysqli->query($query) ) {

		/* fetch associative array & delete AutoRestore Database DB Option */
    	while ( $row = $result->fetch_assoc() ) {
			$delete_query = "DELETE FROM $wp_options WHERE option_name = 'bulletproof_security_options_ARCM'";
		
			if ( $mysqli->query($delete_query) ) {       
		
				echo '<strong><font color="green">Database option_name: ';
				printf ("%s", $row["option_name"]);
    			echo '</font><font color="green"> Deleted Successfully.</font></strong><br>';
				
			}
		}
	$result->free();
	}
	$mysqli->close();
}

// Form - Delete the Quarantine Database Table Rows and quarantined files
if ( isset($_POST['ARQ-DB-Table-Delete']) ) {
	
	$DBHost = $_POST['dbhost'];
	$DBUser = $_POST['dbuser'];
	$DBPass = $_POST['dbpassword'];
	$DBName = $_POST['dbname'];
	$Quarantine = $_POST['tableprefix'] . "bpspro_arq_quarantine";	

	///$link = mysql_connect($DBHost, $DBUser, $DBPass);
	//if (!$link) {
    //	die('<strong><font color="red">Could Not Connect to Database: </font></strong>' . mysql_error());
	//}
	//	echo '<strong><font color="green">Connected To Database: </font>' . $DBHost . ' <font color="green">Successfully.</font></strong><br>';


	//if ( !mysql_select_db($DBName, $link) ) {
	//	echo '<strong><font color="red">Unable to select: </font>' . $DBName .' </strong>' . mysql_error();
	//	exit;
	//}
	
	$mysqli = new mysqli($DBHost, $DBUser, $DBPass, $DBName);

	/* check connection */
	if ( mysqli_connect_errno() ) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    //exit();
	}

	$query = "SELECT * FROM $Quarantine WHERE arq_quarantine_qpath LIKE '%/quarantine/%'";	
	
	if ( $result = $mysqli->query($query) ) {

		/* fetch associative array & delete the username Row from the Login Security DB Table */
    	while ( $row = $result->fetch_assoc() ) {
			$delete_query = "DELETE FROM $Quarantine WHERE arq_quarantine_qpath LIKE '%/quarantine/%'";
		
			if ( unlink($row["arq_quarantine_qpath"]) ) {
		
			if ( $mysqli->query($delete_query) ) {       
				echo '<strong><font color="green">Quarantine DB Table Row & File: ';
				printf ("%s", $row["arq_quarantine_qpath"]);
    			echo '</font><font color="green"> Deleted Successfully.</font></strong><br>';
			}
			}
		}
	$result->free();
	}
	$mysqli->close();
}

// Form - Delete the arqdelete.php file
if ( isset($_POST['Self-Delete']) ) {
unlink($_SERVER["SCRIPT_FILENAME"]);
}

?>

<table width="100%" border="1" cellspacing="1" cellpadding="5">
  <tr>
    <td width="50%"><h1>Delete AutoRestore Database Option</h1></td>
    <td width="50%"><h1>Delete Quarantine Database Table Rows and Files</h1></td>
  </tr>
  <tr>
    <td>This form allows you to delete the AutoRestore Database Option so that AutoRestore will be Turned Off / deactivated on your website.</td>
    <td>This form allows you to delete the Quarantine Database Table Rows &amp; files in the Quarantine folder: /wp-content/bps-backup/quarantine.<br /><span style="color:#FF0000; font-weight:bold;">WARNING!!! Using this Form will delete all of your files in Quarantine.</span></td>
  </tr>
  <tr>
    <td>Open your wp-config.php file to get your Database connection information below:</td>
    <td>Open your wp-config.php file to get your Database connection information below:</td>
  </tr>
  <tr>
    <td>Enter your DB Name, DB User, DB Password, DB Host and DB Table Prefix.</td>
    <td>Enter your DB Name, DB User, DB Password, DB Host and DB Table Prefix.</td>
  </tr>
  <tr>
    <td><strong>NOTE:</strong> If your DB Table Prefix is the standard wp_ DB Table Prefix in your wp-config.php file <strong>$table_prefix  = 'wp_';</strong><br />
then enter wp_ in the DB Table Prefix form field or enter the DB Table Prefix that you are using instead.</td>
    <td><strong>NOTE:</strong> If your DB Table Prefix is the standard wp_ DB Table Prefix in your wp-config.php file <strong>$table_prefix  = 'wp_';</strong><br />
then enter wp_ in the DB Table Prefix form field or enter the DB Table Prefix that you are using instead.</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="color:#0000FF;">
<div style="margin:10px 0px 0px 0px;">
<form action="" method="post">   
<label for="SelfDelete"><strong>IMPORTANT!!! Delete this file after you are done using it by clicking the Delete arqdelete.php File button below: </strong></label><br />
<input type="submit" name="Self-Delete" value="Delete arqdelete.php File" />    
</form>
</div>
    </td>
  </tr>
  <tr>
    <td>	
    <form action="" method="post">
<table width="400" border="1" align="left" style="margin:10px 0px 10px 10px; background-color:#DBDBDB;">
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Name: </strong></label></td>
    <td><input type="text" name="dbname" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB User: </strong></label></td>
    <td><input type="text" name="dbuser" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Password: </strong></label></td>
    <td><input type="password" name="dbpassword" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Host: </strong></label></td>
    <td><input type="text" name="dbhost" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Table Prefix: </strong></label></td>
    <td><input type="text" name="tableprefix" value="" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="ARQ-DB-Option-Delete" value="Delete AutoRestore DB Option" /></td>
  </tr>
</table>
</form>
</td>
    <td>	
    <form action="" method="post">
<table width="400" border="1" align="left" style="margin:10px 0px 10px 10px; background-color:#DBDBDB;">
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Name: </strong></label></td>
    <td><input type="text" name="dbname" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB User: </strong></label></td>
    <td><input type="text" name="dbuser" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Password: </strong></label></td>
    <td><input type="password" name="dbpassword" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Host: </strong></label></td>
    <td><input type="text" name="dbhost" value="" /></td>
  </tr>
  <tr>
    <td><label for="ARQDBDelete"><strong>DB Table Prefix: </strong></label></td>
    <td><input type="text" name="tableprefix" value="" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="ARQ-DB-Table-Delete" value="Delete Quarantine DB Table Rows &amp; Files" /></td>
  </tr>
</table>
</form>
</td>
  </tr>
</table>