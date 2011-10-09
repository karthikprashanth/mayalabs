$("#content1").change(function(){
	checkExt("content1");
});
$("#content2").change(function(){
	checkExt("content2");
});
$("#content3").change(function(){
	checkExt("content3");
});
$("#content4").change(function(){
	checkExt("content4");
});
$("#content5").change(function(){
	checkExt("content5");
});

function checkExt(content)
{
	var filename = document.getElementById(content).value;
	var file_ext = filename.substring(filename.indexOf(".")+1);
	file_ext = file_ext.toLowerCase();
	if(file_ext == 'pdf' || file_ext == 'doc' || file_ext == 'ppt' ||
	file_ext == 'docx' || file_ext == 'pptx' || file_ext == 'xls' ||
	file_ext == 'xlsx' || file_ext == 'jpg' || file_ext == 'jpeg' ||
	file_ext == 'gif' || file_ext == 'png')
	{
		return;
	}
	else
	{
		alert("'" + file_ext + "' Files are not allowed");
		document.getElementById(content).value = "";
	}
}
