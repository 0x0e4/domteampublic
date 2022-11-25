<head>
	<title>Вход</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./engine/styles/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./engine/js/login.js"></script>
</head>
<body>
	<div id="register_container">
		<div id="register_page">
			<div id="register_bg"> </div>
			<div id="register_panel">
				<img src="./engine/images/register_logo.png" id="register_logo_img" />
				<input type="text" id="mail" required minlength="4" maxlength="64" placeholder="Введите e-mail..."><br>
				<input type="password" id="pass" required minlength="4" maxlength="64" placeholder="Введите пароль..."><br>
				
				<button id="submit-login" onclick="loginSubmit();">Войти</button><br>
				<div class="container register">
    			<p>Нет аккаунта? <a href="./register">Регистрация</a>.</p>
  		</div>
		<div class="error"></div>
	</div> </div>
		</div>
	</div>
</body>