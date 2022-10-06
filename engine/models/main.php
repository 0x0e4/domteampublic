<?php

function check_length(&$str, $min, $max = 5000)
{
	return isset($str) && strlen($str) >= $min && strlen($str) <= $max;
}

?>