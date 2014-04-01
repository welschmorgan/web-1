#!/usr/bin/php
<?php
	$args = $argv;
	reset($args);
	$key = key($args);
	unset($args[$key]);
	foreach ($args as $arg)
		echo $arg."\n";
?>
