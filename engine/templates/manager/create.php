<head>
	<title>Создание объявления</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./engine/styles/create.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/advers.js"></script>
</head>
<body>
	<div id="adver_bg"> </div>
	<button id="To_Main_Page_Button" onclick="navigateTo('./')">На главную</button>
	<div id = "adver-panel" style="text-align: center;">
			<input type="text" id="adver-topic" required minlength="4" maxlength="128" placeholder="Введите название объявления..."><br>
			<textarea id="adver-text" required minlength="4" maxlength="8168" placeholder="Введите текст..."></textarea><br>
			<select id="select-hid">
				<?php 
				$db = open_database_connection();
				$houses = getHousesOfUser($_COOKIE['uid']);
				foreach($houses as $house)
				{
					echo "<option value='",$house,"'>",$house,"</option>";
				}
				close_database_connection($db);
				 ?>
			</select><br>
			<input type="file" id="photo-upload" accept="image/*"><br>
			<button id="submit-add" onclick="addAdverSubmit();">Создать объявление</button><br>
			<div class="error"></div>
	</div>
</body>