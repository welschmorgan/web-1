<?php
	require_once ("Grid/Grid.class.php");

	$test_pt1 = new Point(10, 10);
	$test_pt2 = new Point(100, 10);
	$test_pt3 = new Point(10, 100);
	echo Point::doc();
	echo $test_pt1.PHP_EOL;
	echo $test_pt2.PHP_EOL;
	echo $test_pt3.PHP_EOL;
	$test_gd1 = new Grid(10, 10);
	$test_gd2 = new Grid(100, 10);
	$test_gd3 = new Grid(10, 100);
	echo Grid::doc();
	echo $test_gd1.PHP_EOL;
	echo $test_gd2.PHP_EOL;
	echo $test_gd3.PHP_EOL;
?>
