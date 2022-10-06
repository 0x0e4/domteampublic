<?php

function check_length($str, $min, $max = 5000)
{
	return strlen($str) >= $min && strlen($str) <= $max;
}

?>