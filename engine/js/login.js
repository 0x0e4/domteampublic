function loginSubmit()
{
	let mail = $("#mail").val();
	let pass = $("#pass").val();

	if(mail.length < 4 || mail.length > 64 || pass.length < 4 || pass.length > 64) //Провiрка верности логина или пароля при логине
	{
		$(".error").html("Некорректная длина логина или пароля, приятель.");
		return;
	}

	$.get("./engine/api/users.php", { method: "gettoken", mail: mail, pass: pass })
	.done(function(data) {
		let errcode = parseInt(data);
		if(errcode == 0)
			$(".error").html("Ошибок нет. Добро пожаловать в качалку.");
		else if(errcode == -2 || errcode == -200)
			$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше. Ошибка то ли -2, то ли -200, хз.");
	});
}

function registerSubmit()
{
	let mail = $("#mail").val();
	let name = $("#name").val();
	let surname = $("#surname").val();
	let pass = $("#pass").val();

	if(name.length < 4 || name.length > 64 || surname.length < 4 || surname.length > 64 || mail.length < 4 || mail.length > 64 || pass.length < 4 || pass.length > 64) //Провiрка верности логина и пароля при регистрации
	{
		$(".error").html("Некорректная длина логина или пароля, приятель.");
		return;
	}

	$.get("./engine/api/users.php", { method: "register", mail: mail, name: name, surname: surname, pass: pass })
	.done(function(data) {
		let errcode = parseInt(data);
		if(errcode > 0)
			navigateTo('.');
		else if(errcode == -2 || errcode == -200)
			$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше. Ошибка то ли -2, то ли -200, хз.");
	});
}

function goRegisterPage()
{
	navigateTo('./register');
}