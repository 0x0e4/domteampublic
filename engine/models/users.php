<?php

require_once dirname(__FILE__)."/mysql.php";

function checkToken($uid, $token)
{
	$db = open_database_connection();

	$query = $db->query("SELECT `id`, `pass`, `hash` FROM `users` WHERE `id`={$uid}");
	$result = $query->fetchAll();
	if(count($result) == 0)
		return false;

	return $uid.$result[0]['pass'].$result[0]['hash'] == $token;
}

?>