function addBookmark(category,id)
{
    url='/bookmark/add/';
    var data ={};
    var name = prompt("Enter the Bookmark Name: (Only Characters Allowed)");

    data['category']=category;
    data['id']=id;
    data['bmName'] = name;
    
    //var RegularExpression = /d/
	var RegularExpression  =  new RegExp("[A-Za-z0-9]");
	
	var b = RegularExpression.test(name);
	if(!b)
	{
		alert("Illegal characters specified");
		return;
	}
    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
}
function removeBookmark(id)
{
    url='/bookmark/delete/';
    var data ={};
    data['id']=id;

    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
}