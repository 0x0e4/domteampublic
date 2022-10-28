<?php

if(!isset($_GET['method'])) die('-1');

require_once "../models/mysql.php";
require_once "../models/main.php";
require_once "../models/adver.php";
require_once "../models/users.php";
$db = open_database_connection();

if(!check_length($_GET['token'], 1, 256) || !check_token($_GET['uid'], $_GET['token'])) die('-3');

if($_GET['method'] == "addadver")
{
	if(!isRecIdValid($_GET['rec_id']) || !check_length($_GET['text'], 1, 512)) die('-2');

	$uid = $_GET['uid'];
	$rec_id = $_GET['rec_id'];
	$text = $_GET['text'];

	if(!isRecIdValid($rec_id)) die('-200');

	if($rec_id < 0)
	{
		if(!isUserInChat($uid, -$rec_id)) die('-201');
	}

	$mid = $db->query("SELECT MAX(`id`) AS `id` FROM `messages` WHERE ".(($rec_id < 0) ? "`owner_id`={$uid} AND `receiver_id`={$rec_id}" : "(`owner_id`={$uid} AND `receiver_id`={$rec_id}) OR (`owner_id`={$rec_id} AND `receiver_id`={$uid})"))->fetchColumn()+1;

	$db->query("INSERT INTO `messages` (`id`, `owner_id`, `receiver_id`, `text`) VALUES ({$mid}, {$uid}, {$rec_id}, '{$text}')");
	die('-202');
}

close_database_connection($db);

die("-1");

?>