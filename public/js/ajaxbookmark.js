function addBookmark(category,id)
{
    url='/bookmark/add/';
    var data ={};
    var name = prompt("Enter the Bookmark Name: (Only Characters Allowed)");

    data['category']=category;
    data['id']=id;
    data['bmName'] = name;
    
    //var RegularExpression = /d/
	var RegularExpression  =  new RegExp('/[^a-zA-Z0-9$_.@]+/');
	
	var b = RegularExpression.test(name);
	if(b)
	{
		alert("Illegal characters specified");
		return;
	}
	return;
    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
}
function removeBookmark(id,mode)
{
    url='/bookmark/delete/';
    var data ={};
    data['id']=id;

    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
    if(mode == 'longlist')
    {
    	window.location = "/bookmark/longlist";
    }
}