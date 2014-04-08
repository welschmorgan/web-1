<?php
	include "ex04/auth.php";
	$users = load_users('private/passwd');
	foreach ($users as $name => $user)
	{
		echo "user: $name: ".$user['passwd']."<br />\n";
	}
?>
