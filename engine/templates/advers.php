<?php
require_once "./engine/models/adver.php";
?>
<head>
	<title>Объявления</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<div style="text-align: center;">
		<?php
		$db = open_database_connection();
		$houses = getHousesOfUser($_COOKIE['uid']);
		$addr = getHousesAddress($houses);
		$tags = getAdverTags($houses);
		$advers = getAdvers($houses);
		close_database_connection($db);
		for($i = 0; $i < count($advers); $i++) {
			$curtags = array();
			$tagsid = $advers[$i]['tags'];
			foreach($tagsid as $id)
			{
				array_push($curtags, $tags[$id]);
			}
		?>
		<div class="topic"><?php echo $advers[$i]['topic']; ?></div><br><br>
		<div class="time"><?php echo date('Y-m-d H:i', $advers[$i]['time']); ?></div><br>
		<?php if(count($tagsid) > 0) { ?>
		<div class="tags">Теги: <?php echo implode(',', $curtags); ?></div><br>
	<?php } ?>
		<div class="hid">Адрес дома: <?php echo $addr[array_search($advers[$i]['hid'], $houses)]; ?></div><br>
		<div class="text"><?php echo $advers[$i]['text']; ?></div>
		<img src="./engine/storage/<?php echo $advers[$i]['photo_id'].getPhotoFormat($advers[$i]['photo_id']); ?>" style="width: 40%;"><hr>
	<?php } ?>
	</div>
</body>