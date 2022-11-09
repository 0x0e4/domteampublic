let tags_selected = [];
let search_tags = [];

function addAdverSubmit()
{
		var fd = new FormData;
		fd.append('method', "add");
		fd.append('topic', $("#adver-topic").val());
		fd.append('text', $("#adver-text").val());
		fd.append('hid', $('#select-hid').val());
		fd.append('tags', JSON.stringify(tags_selected));
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

function addTagSubmit()
{
		$.get("./engine/api/adver.php", { method: "addtag", tag: $("#tag-name").val(), onlymanager: $("#only-manager").is(":checked") ? 1 : 0 })
		.done(function(data) {
			let errcode = parseInt(data);
			if(errcode == 0)
				navigateTo('./');
		});
}

function delTagSubmit()
{
		$.get("./engine/api/adver.php", { method: "deltag", tagid: $("#select-tag").val() })
		.done(function(data) {
			let errcode = parseInt(data);
			if(errcode == 0)
				navigateTo('./');
		});
}

function addAdverTagSubmit()
{
	let tid = $("#select-tag").val();
	if(tid > 0)
		tags_selected.push(parseInt(tid));
	$("#tags-list").html($("#tags-list").html()+"<span onclick='delAdverTagSubmit(this, "+tid+");'>"+$("#select-tag").find('option:selected').text()+"</span>");
}

function delAdverTagSubmit(obj, tid)
{
	tags_selected.splice(tags_selected.indexOf(tid), 1);
	$(obj).remove();
}

function selectAdverTag()
{
	let tid = $("#select-tag").val();
	if(tid > 0)
		search_tags.push(parseInt(tid));
	$("#tags-select").html($("#tags-select").html()+"<span onclick='delAdverTagSearch(this, "+tid+");'>"+$("#select-tag").find('option:selected').text()+"</span>");
	refreshAdvers();
}

function refreshAdvers()
{
	$("#block_advers").html("");
	$.get("./engine/api/adver.php", { method: "getadverwithtags", tags: JSON.stringify(search_tags) })
		.done(function(data) {
			$("#block_advers").html(data);
		});
}

function delAdverTagSearch(obj, tid)
{
	search_tags.splice(search_tags.indexOf(tid), 1);
	$(obj).remove();
	refreshAdvers();
}