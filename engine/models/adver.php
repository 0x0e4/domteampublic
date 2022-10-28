<?php

require_once dirname(__FILE__)."/mysql.php";
require_once dirname(__FILE__)."/main.php";
require_once dirname(__FILE__)."/users.php";

function isHouseValid(&$id)
{
	return isInt($id) && $db->query("SELECT COUNT(`id`) FROM `houses` WHERE `id`={$id}")->fetchColumn() > 0;
}

functio isAdverValid(&$id)
{
	return isInt($id) && $db->query("SELECT COUNT(`id`) FROM `advers` WHERE `id`={$id}")->fetchColumn() > 0;
}

// Получить ид дома, для которого выложено объявление
function getHIDOfAdver(&$id)
{
	if(isInt($id))
		return $db->query("SELECT `hid` FROM `advers` WHERE `id`={$id}")->fetchColumn();
	else
		return 0;
}

?>