function loginSubmit()
{
	let mail = $("#mail").val();
	let pass = $("#pass").val();

	if(mail.length < 4 || mail.length > 64 || pass.length < 4 || pass.length > 64)
	{
		$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше");
		return;
	}

	$.get("./engine/api/users.php", { method: "gettoken", mail: mail, pass: pass })
	.done(function(data) {
		let code = parseInt(data);
		if(code == 0)
			$(".error").html("Молодец");
		else if(code == -2 || code == -200)
			$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше");
	});
}

function registerSubmit()
{
	let mail = $("#mail").val();
	let pass = $("#pass").val();

	if(mail.length < 4 || mail.length > 64 || pass.length < 4 || pass.length > 64)
	{
		$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше");
		return;
	}

	$.get("./engine/api/users.php", { method: "register", mail: mail, pass: pass })
	.done(function(data) {
		let code = parseInt(data);
		if(code > 0)
			$(".error").html("Молодец");
		else if(code == -2)
			$(".error").html("Ты ошибся дверью, клуб кожевников этажом выше");
	});
}