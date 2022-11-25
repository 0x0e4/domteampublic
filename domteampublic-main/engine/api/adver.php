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
	if(!isHouseValid($_GET['hid']) || !isUserManager($_COOKIE['uid'], $_GET['hid']) || !check_length($_GET['topic'], 1, 128) || !check_length($_GET['text'], 1, 8168) || !check_length($_GET['tags'], 0, 64)) die('-2');
	$uid = $_COOKIE['uid'];
	$hid = $_GET['hid'];

	$topic = $_GET['topic'];
	$text = nl2br($_GET['text']);
	$tags = json_encode(checkTags(json_decode($_GET['tags'])));

	$sth = $db->prepare("INSERT INTO `advers` (`uid`, `topic`, `text`, `time`, `hid`, `tags`) VALUES (?, ?, ?, ?, ?, ?)");
	$sth->execute([$uid, $topic, $text, time(), $hid, $tags]);
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
elseif($_GET['method'] == "addtag")
{
	if(!isUserManager($_COOKIE['uid']) || !check_length($_GET['tag'], 1, 32)) die('-2');
	$uid = $_COOKIE['uid'];

	$tag = $_GET['tag'];

	$sth = $db->prepare("INSERT INTO `tags` (`name`, `only-manager`) VALUES (?, ?)");
	$sth->execute([$tag, $_GET['onlymanager']]);
	die('0');
}
elseif($_GET['method'] == "deltag")
{
	if(!isUIDValid($_COOKIE['uid'])) die('-2');

	if(!isUserManager($_COOKIE['uid'])) die('-200');

	$db->query("DELETE FROM `tags` WHERE `id`={$_GET['tagid']}");
	die('0');
}
elseif($_GET['method'] == "getadverwithtags")
{
	if(!isUIDValid($_COOKIE['uid'])) die('-2');

	$tags = json_decode($_GET['tags']);

	$houses = getHousesOfUser($_COOKIE['uid']);
	$q = "SELECT * FROM `advers` WHERE `hid` IN (".implode(',', $houses).") ";
		if(count($tags) > 0)
		{
		foreach($tags as $tag)
		{
			$q .= "AND `tags` LIKE '%".$tag."%' ";
		}
	}
	$q .= " ORDER BY `id` DESC";
	$query = $db->query($q);
		$addr = getHousesAddress($houses);
		$advers = $query->fetchAll(PDO::FETCH_ASSOC);
		$result = "";
		for($i = 0; $i < count($advers); $i++) {
			$tagsid = json_decode($advers[$i]['tags']);
			$tags = getAdverTags($tagsid);
		$result .= '<div class="topic">'.$advers[$i]['topic'].'</div><br><br>';
		if($advers[$i]['photo_id'] != "") {
		$result .= '<div><img class="picture" src="./engine/storage/'.$advers[$i]['photo_id'].getPhotoFormat($advers[$i]['photo_id']).'"</div>';
	}
		$result .= '<div class="time">'.date("Y-m-d H:i", $advers[$i]['time']).'</div><br>';
		if(count($tagsid) > 0) {
		$result .= '<div class="tags">Теги: '.implode(',', $tags).'</div><br>';
	}
		$result .= '<div class="hid">Адрес дома: '.$addr[array_search($advers[$i]['hid'], $houses)].'</div><br><div class="text">'.$advers[$i]['text'].'</div><hr>';
	}

	die($result);
}
}
else
{
	if($_POST['method'] == "add")
	{
		if(!isHouseValid($_POST['hid']) || !isUserManager($_COOKIE['uid'], $_POST['hid']) || !check_length($_POST['topic'], 1, 128) || !check_length($_POST['text'], 1, 8168) || !check_length($_POST['tags'], 0, 64)) die('-2');

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
		$tags = json_encode(checkTags(json_decode($_POST['tags'])));

		$sth = $db->prepare("INSERT INTO `advers` (`uid`, `topic`, `text`, `time`, `hid`, `photo_id`, `tags`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$sth->execute([$uid, $topic, $text, time(), $hid, $photo_id, $tags]);
		die('0');
	}
}

close_database_connection($db);

die("-1");

?>