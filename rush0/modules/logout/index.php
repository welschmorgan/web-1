<?php
	session_destroy();
	$_GLOBALS['modules']['logout']['index'] = "Logging out ... <button onclick=\"javascript: window.location='index.php';\">Go back</button>, redirection dans 2 secondes.<br />\n";
	header("refresh: 2; url=index.php");
	$_GLOBALS['modules']['logout']['scripts'] = array();
	$_GLOBALS['modules']['logout']['styles'] = array();
?>
