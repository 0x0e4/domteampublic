<head>
	<title>Создание объявления</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./engine/styles/create.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/advers.js"></script>
</head>
<body>
	<div id="adver_bg"> </div>
	<div id = "adver-panel" style="text-align: center;">
			<input type="text" id="adver-topic" required minlength="4" maxlength="128" placeholder="Введите название объявления..."><br>
			<textarea id="adver-text" required minlength="4" maxlength="8168" placeholder="Введите текст..."></textarea><br>
			<button id="submit-add" onclick="addAdverSubmit(<?php echo $_GET['hid']; ?>);">Создать объявление</button><br>
			<div class="error"></div>
	</div>
</body>