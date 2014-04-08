<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="refresh" content="1">-->
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
	<script type='text/javascript'>
		setInterval(function(){ajax('chatbody', 'chat.php?ajax=1')}, 1000);
		function ajax(elem_id, $url)
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById(elem_id).innerHTML=xmlhttp.responseText;
				}
			}
		xmlhttp.open("GET",$url,true);
		xmlhttp.send();
		}
	</script>
</head>
<body>
<div id='chatbody'>
<?php
	@session_start();
	function display_timestamp($timestamp)
	{}
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

	if (isset($_SESSION['loggued_on_user']) && !empty($_SESSION['loggued_on_user']))
	{
		$chat = load_chat('../private/chat');
		if (!empty($chat))
		{
			for ($i=count($chat) - 1; $i>=0; $i--)
			{
				$msg = $chat[$i];
				echo "<span class='chat-msg'><".date('H:i:s d/m/y', $msg['time'])."> ".$msg['login'].": ".$msg['msg']."</span><br />";
			}
		}
	}
?>
</div>
</body>
</html>
