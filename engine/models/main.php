<?php

function check_length(&$str, $min, $max = 5000)
{
	return isset($str) && strlen($str) >= $min && strlen($str) <= $max;
}

function isInt(&$a)
{
	return isset($a) && settype($a, "integer");
}

function createPhotoId()
{
	$uploaddir = "../storage/";
    do {
        $photo_id = substr(str_shuffle(PERMITTED_CHARS_PHOTO), 0, 80);
        $check = false;
        foreach(SUP_PHOTO_FORMAT as $format)
		{
			if(file_exists($uploaddir.$photo_id.$format))
			{
				$check = true;
				break;
			}
		}
    } while($check);
    return $photo_id;
}

function getPhotoFormat($photo_id)
{
	$uploaddir = "../storage/";
	foreach(SUP_PHOTO_FORMAT as $form)
	{
		if(file_exists($uploaddir.$photo_id.$form))
		{
			return $form;
		}
	}
	return "";
}

?>