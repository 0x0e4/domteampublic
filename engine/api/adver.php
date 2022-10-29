<?php

if(!isset($_GET['method']) && !isset($_POST['method'])) die('-1');

require_once "../models/mysql.php";
require_once "../models/main.php";
require_once "../models/adver.php";
require_once "../models/users.php";
$db = open_database_connection();

if(!check_length($_COOKIE['token'], 1, 256) || !checkToken($_COOKIE['uid'], $_COOKIE['token'])) die('-3');

if(isset($_GET['method'])) {
if($_GET['method'] == "add")
{
	if(!isHouseValid($_GET['hid']) || !isUserManager($_COOKIE['uid'], $_GET['hid']) || !check_length($_GET['topic'], 1, 128) || !check_length($_GET['text'], 1, 8168)) die('-2');
	$uid = $_COOKIE['uid'];
	$hid = $_GET['hid'];

	$topic = $_GET['topic'];
	$text = nl2br($_GET['text']);

	$sth = $db->prepare("INSERT INTO `advers` (`uid`, `topic`, `text`, `time`, `hid`) VALUES (?, ?, ?, ?, ?)");
	$sth->execute([$uid, $topic, $text, time(), $hid]);
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
}
else
{
	if($_POST['method'] == "add")
	{
		if(!isHouseValid($_POST['hid']) || !isUserManager($_COOKIE['uid'], $_POST['hid']) || !check_length($_POST['topic'], 1, 128) || !check_length($_POST['text'], 1, 8168)) die('-2');

		$photo_id = "";
		if(isset($_FILES) && isset($_FILES['file']))
		{
			$uploaddir = "../storage/";
			$file = explode(".", $_FILES['file']['name']);
			$format = '.'.$file[count($file)-1];
			if(!array_search(strtolower($format), SUP_PHOTO_FORMAT))
				die('-200');
			$photo_id = createPhotoId();
			move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.$photo_id.strtolower($format));
		}

		$uid = $_COOKIE['uid'];
		$hid = $_POST['hid'];

		$topic = $_POST['topic'];
		$text = nl2br($_POST['text']);

		$sth = $db->prepare("INSERT INTO `advers` (`uid`, `topic`, `text`, `time`, `hid`, `photo_id`) VALUES (?, ?, ?, ?, ?, ?)");
		$sth->execute([$uid, $topic, $text, time(), $hid, $photo_id]);
		die('0');
	}
}

close_database_connection($db);

die("-1");

?>