function addAdverSubmit()
{
		var fd = new FormData;
		fd.append('method', "add");
		fd.append('topic', $("#adver-topic").val());
		fd.append('text', $("#adver-text").val());
		fd.append('hid', $('#select-hid').val());
		if($('#photo-upload')[0].files[0] != null)
			fd.append('file', $('#photo-upload')[0].files[0]);
		$.post({ url: "./engine/api/adver.php", type: "POST", data: fd, processData: false, contentType: false, dataType: "text"})
		.done(function(data)
		{
			let errcode = parseInt(data);
			if(errcode == 0)
				navigateTo('./');
		});
}