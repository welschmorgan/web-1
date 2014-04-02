#!/usr/bin/php
<?

	function parse_page($name)
	{
		$handle = fopen($name, "r");
		$content = "";
		while (!feof($handle))
		{
			$line = trim(fgets($handle));
			$content .= $line;
		}
		fclose($handle);

		$pattern = '/<a(.*?)title=[\"|\']+(.*?)[\"|\']+(.*?)>(.*?)<\/a>/i';
		echo preg_replace_callback($pattern, 'hashtag_to_link', $content);
	}

	function hashtag_to_link($matches)
	{
	  return '<a' . $matches[1] . 'title="' . strtoupper($matches[2]) . '"' . $matches[3] . '>' . strtoupper($matches[4]) . '</a>';
	}
	if (isset($argv[1]))
		parse_page($argv[1]);
?>
