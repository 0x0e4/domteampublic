<?php

require_once dirname(__FILE__)."/mysql.php";
require_once dirname(__FILE__)."/main.php";
require_once dirname(__FILE__)."/users.php";

function isHouseValid(&$id)
{
	global $db;
	return isInt($id) && $db->query("SELECT COUNT(`id`) FROM `houses` WHERE `id`={$id}")->fetchColumn() > 0;
}

function isAdverValid(&$id)
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

function getHousesAddress($arrhid)
{
	global $db;
	if(count($arrhid))
		return $db->query("SELECT `address` FROM `houses` WHERE `id` IN (".implode(',', $arrhid).")")->fetchAll(PDO::FETCH_COLUMN);
	else
		return array();
}

function getTags()
{
	global $db;
	return $db->query("SELECT `id`, `name` FROM `tags` WHERE 1")->fetchAll();
}

function getAdvers($arrhid)
{
	global $db;
	if(count($arrhid))
	{
	$query = $db->query("SELECT * FROM `advers` WHERE `hid` IN (".implode(',', $arrhid).") ORDER BY `id` DESC");
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	else
	{
		return array();
	}
}

?>