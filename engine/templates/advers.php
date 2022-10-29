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
		$advers = getAdvers($houses);
		close_database_connection($db);
		for($i = 0; $i < count($advers); $i++) {
		?>
		<div class="topic"><?php echo $advers[$i]['topic']; ?></div><br><br>
		<div class="time"><?php echo date('Y-m-d H:i', $advers[$i]['time']); ?></div><br>
		<div class="hid">Адрес дома: <?php echo $addr[array_search($advers[$i]['hid'], $houses)]; ?></div><br>
		<div class="text"><?php echo $advers[$i]['text']; ?></div><hr>
	<?php } ?>
	</div>
</body>