<?php
require_once "./engine/models/adver.php";
?>
<html>
<head>
	<title>ДомТим</title>
	<link rel="stylesheet" href="./main.css">
	<link rel="stylesheet" href="./engine/styles/header_main_page.css">
	<link rel="stylesheet" href="./engine/styles/main_page.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/Sliding_Panel.js"></script>
	<script type="text/javascript" src="./engine/js/advers.js"></script>
	<script type="text/javascript" src="./engine/js/main.js"></script>
	<meta charset="utf-8">
</head>
<body> <header> <div class="header-panel">
  	<div class="container" onclick="Sliding_Panel()">
  		<div class="bar_icon"></div>
  		<div class="bar_icon"></div>
  		<div class="bar_icon"></div>
  		<div id="Sliding_Panel" class="Sliding_Panel">
  		</div>
  	</div>
  	<button id="Enter_Button" onclick="navigateTo('./login')">Войти</button>
  </div>
  
</header>

<div class="background_site">
	<div id = "block_advers" class = "block_advers">
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
</div>

<footer>
  
</footer>

</body>
</html>