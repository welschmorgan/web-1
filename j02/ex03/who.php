#!/usr/bin/php
<?
	$output = "success";
	$retval = 0;
	exec("who", $output, $retval);
	foreach($output as $line)
		echo $line."\n";
?>
