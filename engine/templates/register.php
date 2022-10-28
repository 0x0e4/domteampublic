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
		<input type="text" id="name" required minlength="4" maxlength="64" placeholder="Введите имя..."><br>
		<input type="text" id="surname" required minlength="4" maxlength="64" placeholder="Введите фамилию..."><br>
		<input type="password" id="pass" required minlength="4" maxlength="64" placeholder="Введите пароль..."><br>
		<hr>
    	<p>Регистрируясь вы подтверждаете свое согласие с <a href="#">Условиями пользования</a>.</p>
		<button id="submit-register" onclick="registerSubmit();">Регистрация</button><br>
		<div class="container signin">
    		<p>Уже имеете аккаунт? <a href=".">Войти</a>.</p>
  		</div>
		<div class="error"></div>
	</div>
</body>