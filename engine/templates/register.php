<head>
	<title>Регистрация</title>
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
				<input type="text" id="name" required minlength="4" maxlength="64" placeholder="Введите имя...">  <input type="text" id="surname" required minlength="4" maxlength="64" placeholder="Введите фамилию..."><br>
				<input type="password" id="pass" required minlength="4" maxlength="64" placeholder="Введите пароль..."><br>
    			<p>Регистрируясь вы подтверждаете свое согласие с <a href="#">Условиями пользования</a>.</p>
				<button id="submit_register" onclick="registerSubmit();">Регистрация</button><br>
				<div class="container signin">
    			<p>Уже имеете аккаунт? <a href="./login">Войти</a>.</p>
  		</div>
		<div class="error"></div>
	</div> </div>
		</div>
	</div>
</body>