<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<script type='text/css'>
		body
		{
			background-color: steelblue;
			border-radius: 15px;
			border: 1px solid aliceblue;
		}
	</script>
</head>
<body>
<form method='POST'>
	<input type=text name=msg placeholder='Entrez un message a envoyer' title='Entrez un message a envoyer' />
	<button type=submit>Envoyer!</button>
</form>
<?php
	@session_start();

	function load_chat($fname)
	{
		if (!file_exists($fname))
			$chat = array();
		else
		{
			$content = '';
			$line = '';
			$file = fopen($fname, 'r+');
			// shared lock
			if (flock($file,LOCK_SH))
			{
				while (!feof($file))
				{
					$line = fread($file, 255);
					$content .= $line;
				}
				$chat = unserialize(trim($content));
				flock($file,LOCK_UN);
			}
			else
			{
				echo "Error locking file!";
			}
			fclose($file);
		}
		return ($chat);
	}

	function save_chat($chat, $fname)
	{
		// exclusive lock
		$file = fopen($fname, 'w+');
		if (flock($file,LOCK_EX))
		{
			fwrite($file, serialize($chat));
			flock($file,LOCK_UN);
		}
		else
		{
			echo "Error locking file!";
		}
		fclose($file);
	}
	@mkdir('../private');
	if (isset($_SESSION['loggued_on_user'])
		&& isset($_POST['msg']))
	{
		$chat = load_chat('../private/chat');
		$chat[] = array('login' => $_SESSION['loggued_on_user'], 'time' => time(), 'msg' => $_POST['msg']);
		save_chat($chat, '../private/chat');
	}
?>

</body>
</html>
