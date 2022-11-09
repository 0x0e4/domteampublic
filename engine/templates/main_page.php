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
  			<button class="To_Add_Adver_Button" onclick="navigateTo('./addadver')">Создать объявление</button>
  			<button class="To_Add_Adver_Button" onclick="navigateTo('./tags')">Тэги</button>
  		</div>
  	</div>
  	<img src="../../engine/images/domteam_logo.svg" id="main_page_logo" />
  	<?php if(!$GLOBALS['logged']) { ?>
  	<button id="Enter_Button" class="Enter_Button" onclick="navigateTo('./login')">Войти</button>
  	<button id="Register_Button" class="Enter_Button" onclick="navigateTo('./register')">Зарегистрироваться</button>
  <?php } ?>
  </div>

</header>

<div class="background_site">
	<div id="tags-select" style="text-align: center;">Поиск по тегам: <select id="select-tag">
				<?php 
				$db = open_database_connection();
				$tags = getTags();
				foreach($tags as $tag)
				{
					echo "<option value='",$tag['id'],"'>",$tag['name'],"</option>";
				}
				close_database_connection($db);
				 ?>
			</select><button onclick="selectAdverTag();">Добавить тег</button><br></div>
	<div id = "block_advers" class = "block_advers">
			<?php
		$db = open_database_connection();
		$houses = getHousesOfUser($_COOKIE['uid']);
		$addr = getHousesAddress($houses);
		$advers = getAdvers($houses);
		for($i = 0; $i < count($advers); $i++) {
			$tagsid = json_decode($advers[$i]['tags']);
			$tags = getAdverTags($tagsid);
		?>
		<div class="topic"><?php echo $advers[$i]['topic']; ?></div><br><br>
		<?php if($advers[$i]['photo_id'] != "") { ?>
		<div><img class="picture" src="./engine/storage/<?php echo $advers[$i]['photo_id'].getPhotoFormat($advers[$i]['photo_id']); ?>"></div>
	<?php } ?>
		<div class="time"><?php echo date('Y-m-d H:i', $advers[$i]['time']); ?></div><br>
		<?php if(count($tagsid) > 0) { ?>
		<div class="tags">Теги: <?php echo implode(',', $tags); ?></div><br>
	<?php } ?>
		<div class="hid">Адрес дома: <?php echo $addr[array_search($advers[$i]['hid'], $houses)]; ?></div><br>
		<div class="text"><?php echo $advers[$i]['text']; ?></div><hr>
	<?php }
	close_database_connection($db);
	 ?>
	</div>
</div>

<footer>
  
</footer>

</body>
</html>