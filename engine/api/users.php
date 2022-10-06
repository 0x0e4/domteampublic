<?php

if(!isset($_GET['method'])) die('-1');

require_once "../models/mysql.php";
require_once "../models/main.php";
$db = open_database_connection();

if($_GET['method'] == "register")
{
	if(!isset($_GET['mail']) || !isset($_GET['pass']) || !check_length($_GET['mail'], 4, 64) || !check_length($_GET['pass'], 4, 64)) die('-2');

	$mail = $_GET['mail'];
	$pass = $_GET['pass'];

	$result = $db->query("SELECT COUNT(`id`) FROM `users` WHERE `mail`='{$mail}'");
	if($result->fetchColumn() > 0)
		die('-200');

	$db->query("INSERT INTO `users` (`mail`, `pass`) VALUES ('{$mail}', '{$pass}')");
	die($db->lastInsertId());
}

close_database_connection($db);

die("-1");

?>