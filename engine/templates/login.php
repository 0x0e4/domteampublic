<head>
	<title>Авторизация</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./engine/styles/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/login.js"></script>
</head>
<body>
	<div class="login-panel">
		<input type="text" id="mail" required minlength="4" maxlength="64" placeholder="Введите e-mail..."><br>
		<input type="password" id="pass" required minlength="4" maxlength="64" placeholder="Введите пароль..."><br>
		<button id="submit-login" onclick="loginSubmit();">Авторизоваться</button><br>
		<button id="submit-register" onclick="registerSubmit();">Регистрация</button><br>
		<div class="error"><?php if($GLOBALS['logged']) echo "Добро пожаловать!"; ?></div>
	</div>
</body>