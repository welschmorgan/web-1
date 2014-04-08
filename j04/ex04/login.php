<?php
	session_start();
	include ('auth.php');

	function ok($id)
	{
		echo 'OK\n';
		$_SESSION['loggued_on_user'] = $id;
	}
	function err()
	{
		echo 'ERROR\n';
		$_SESSION['loggued_on_user'] = '';
	}

	function login()
	{
		global $_GET;
		if (isset($_GET['login']) && isset($_GET['passwd']))
		{
			if (auth($_GET['login'], $_GET['passwd']))
			{
				ok($_GET['login']);
			}
			else
				err();
		}
		else
			err();
	}

	login();
	var_dump($_SESSION);
?>
