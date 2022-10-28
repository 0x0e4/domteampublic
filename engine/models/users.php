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
	return isInt($uid) && $db->query("SELECT COUNT(`id`) FROM `users` WHERE `id`={$uid}")->fetchColumn() > 0;
}

?>