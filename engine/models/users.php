<?php

require_once dirname(__FILE__)."/mysql.php";
require_once dirname(__FILE__)."/main.php";

function checkToken(&$uid, $token)
{
	if(!isInt($uid)) return false;

	$db = open_database_connection();

	$query = $db->query("SELECT `id`, `pass`, `hash` FROM `users` WHERE `id`={$uid}");
	$result = $query->fetchAll();

	close_database_connection($db);

	if(count($result) == 0)
		return false;

	return $uid.$result[0]['pass'].$result[0]['hash'] == $token;
}

function isUIDValid(&$uid)
{
	global $db;
	return isInt($uid) && $db->query("SELECT COUNT(`id`) FROM `users` WHERE `id`={$uid}")->fetchColumn() > 0;
}

function isUserManager(&$uid)
{
	global $db;
	return isInt($uid) && ($db->query("SELECT COUNT(`uid`) FROM `managers` WHERE `uid`={$uid}")->fetchColumn() > 0 || $db->query("SELECT COUNT(`uid`) FROM `admins` WHERE `uid`={$uid}")->fetchColumn() > 0);
}

function isUserResident(&$uid, &$hid)
{
	return isInt($uid) && isInt($hid) && ($db->query("SELECT COUNT(`uid`) FROM `residents` WHERE `uid`={$uid} AND `hid`={$hid}")->fetchColumn() > 0 || isUserManager($uid, $hid));
}

function getHousesOfUser(&$uid)
{
	global $db;
	if(!isUIDValid($uid)) return null;

	$result = $db->query("SELECT `hid` FROM `residents` WHERE `uid`={$uid}")->fetchAll(PDO::FETCH_COLUMN);

	return count($result) > 0 ? $result : null;
}

function getUserData(&$uid)
{
	global $db;
	if(!isUIDValid($uid)) return null;

	$result = $db->query("SELECT * FROM `users` WHERE `id`={$uid}")->fetchAll(PDO::FETCH_ASSOC);

	return count($result) > 0 ? $result[0] : null;
}

function getAge($birthday)
{
	$birthday = new DateTime($birthday);
    $interval = $birthday->diff(new DateTime);
    return $interval->y;
}

function getAddr($uid)
{
	global $db;
	$result = $db->query("SELECT `address` FROM `houses` WHERE `id`=(SELECT `hid` FROM `residents` WHERE `uid`={$uid} LIMIT 1)")->fetchAll(PDO::FETCH_COLUMN);
	return count($result) > 0 ? $result[0] : "";
}

?>