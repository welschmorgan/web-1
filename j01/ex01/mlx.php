#!/usr/bin/php
<?
	$count = 0;
	for ($i = 0; $i < 1000; $i++)
	{
		if ($count > 100)
		{
			echo "\n";
			$count = 0;
		}
		echo "X";
		$count += 1;
	}
	echo "\n";
?>
