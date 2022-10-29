<?php

if(!isset($_GET['method'])) die('-1');

require_once "../models/mysql.php";
require_once "../models/main.php";
require_once "../models/adver.php";
require_once "../models/users.php";
$db = open_database_connection();

if(!check_length($_COOKIE['token'], 1, 256) || !checkToken($_COOKIE['uid'], $_COOKIE['token'])) die('-3');

if($_GET['method'] == "add")
{
	if(!isHouseValid($_GET['hid']) || !isUserManager($_COOKIE['uid'], $_GET['hid']) || !check_length($_GET['topic'], 1, 128) || !check_length($_GET['text'], 1, 8168)) die('-2');
	$uid = $_COOKIE['uid'];
	$hid = $_GET['hid'];

	$topic = $_GET['topic'];
	$text = $_GET['text'];

	$db->query("INSERT INTO `advers` (`uid`, `topic`, `text`, `time`, `hid`) VALUES ({$uid}, '{$topic}', '{$text}', ".time().", {$hid})");
	die('0');
}
elseif($_GET['method'] == "del")
{
	if(!isUIDValid($_COOKIE['uid']) || !isAdverValid($_GET['id'])) die('-2');

	$hid = getHIDOfAdver($_GET['id']);

	if($hid == 0) die('-200');
	if(!isUserManager($_COOKIE['uid'], $_GET['hid'])) die('-201');

	$db->query("DELETE FROM `advers` WHERE `id`={$_GET['id']}");
	die('0');
}

close_database_connection($db);

die("-1");

?>