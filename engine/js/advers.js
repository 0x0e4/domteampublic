function addAdverSubmit(hid)
{
	let topic = $("#adver-topic").val();
	let text = $("#adver-text").val();

	if(text.length < 4 || text.length > 8168 || topic.length < 4 || topic.length > 256) //Провiрка верности логина или пароля при логине
	{
		$(".error").html("Некорректная длина заголовка или текста, приятель.");
		return;
	}

	$.get("./engine/api/adver.php", { method: "add", text: text, topic: topic, hid: hid })
	.done(function(data) {
		let errcode = parseInt(data);
		if(errcode == 0)
			navigateTo('./news');
	});
}