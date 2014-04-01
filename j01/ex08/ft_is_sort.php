<?php
	function ft_is_sort($arr)
	{
		if (!is_array($arr))
			$arr = array($arr);
		$sorted = $arr;
		sort($sorted);
		var_dump($arr);
		var_dump($sorted);
		return ($sorted == $arr);
	}
?>
