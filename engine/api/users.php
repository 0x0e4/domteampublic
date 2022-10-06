<?php

if(!isset($_GET['method'])) die('-1');

require_once "../models/mysql.php";
require_once "../models/main.php";
$db = open_database_connection();

if($_GET['method'] == "register")
{
	if(!check_length($_GET['mail'], 4, 64) || !check_length($_GET['pass'], 4, 64)) die('-2');

	$mail = $_GET['mail'];
	$pass = md5($_GET['pass'].SALT);

	$result = $db->query("SELECT COUNT(`id`) FROM `users` WHERE `mail`='{$mail}'");
	if($result->fetchColumn() > 0)
		die('-200');

	$hash = substr(str_shuffle(PERMITTED_CHARS), 0, 7); // формирование уникального хэша пользователя

	$db->query("INSERT INTO `users` (`mail`, `pass`, `hash`) VALUES ('{$mail}', '{$pass}', '{$hash}')");
	die($db->lastInsertId());
}
elseif($_GET['method'] == "gettoken")
{
	if(!check_length($_GET['mail'], 4, 64) || !check_length($_GET['pass'], 4, 64)) die('-2');

	$mail = $_GET['mail'];
	$pass = md5($_GET['pass'].SALT);

	$query = $db->query("SELECT `id`, `hash` FROM `users` WHERE `mail`='{$mail}' AND `pass`='{$pass}'");
	$result = $query->fetchAll();
	if(count($result) == 0)
		die('-200');

	$token = $result[0]['id'].$pass.$result[0]['hash']; // токен формируется по схеме: (ид пользователя)(зашифр. пароль)(уникальный хэш пользователя)

	setcookie("uid", $result[0]['id'], time() + 86400, '/');
	setcookie("token", $token, time() + 86400, '/');

	die('0');
}

close_database_connection($db);

die("-1");

?>