<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
</head>
<body>
<?php
	session_start();
	include ('auth.php');

	function ok($id)
	{
		echo '<iframe name="chat" src="chat.php" style="border: 0px;"></iframe><br />
			<iframe name="speak" src="speak.php" style="border: 0px;"></iframe><br />';

		$_SESSION['loggued_on_user'] = $id;
	}
	function err()
	{
		echo 'ERROR\n';
		$_SESSION['loggued_on_user'] = '';
	}

	function login()
	{
		global $_POST;
		if (isset($_POST['login']) && isset($_POST['passwd']))
		{
			if (auth($_POST['login'], $_POST['passwd']))
			{
				ok($_POST['login']);
			}
			else
				err();
		}
		else
			err();
	}

	login();
?>
</body>
</html>
