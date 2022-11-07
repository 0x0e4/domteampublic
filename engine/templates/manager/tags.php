<?php
require_once "./engine/models/adver.php";
?>
<head>
	<title>Создание тэга</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./engine/styles/create.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/advers.js"></script>
</head>
<body>
	<div id="adver_bg"> </div>
	<button id="To_Main_Page_Button" onclick="navigateTo('./')">На главную</button>
	<div id = "adver-panel" style="text-align: center;">
			<input type="text" id="tag-name" required minlength="2" maxlength="32" placeholder="Введите название тэга..."><br>
			<input type="checkbox" id="only-manager" name="only-manager"><label for="only-manager">Только для модераторов</label><br>
			<button id="submit-add" onclick="addTagSubmit();">Создать тэг</button><br>
			<div class="error"></div>
			<select id="select-tag">
				<?php 
				$db = open_database_connection();
				$tags = getTags();
				foreach($tags as $tag)
				{
					echo "<option value='",$tag['id'],"'>",$tag['name'],"</option>";
				}
				close_database_connection($db);
				 ?>
			</select><br>
			<button id="submit-del" onclick="delTagSubmit();">Удалить тэг</button><br>
	</div>
</body>