<?php if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') { 
phpinfo();
} else {
header("Status: 404 Not Found");
header("HTTP/1.0 404 Not Found");
exit();
}
?>