function addBookmark(category,id)
{
    url='/bookmark/add/';
    var data ={};
    var name = prompt("Enter the Bookmark Name: (Only Characters and Numbers Allowed)");

    data['category']=category;
    data['id']=id;
    data['bmName'] = name;
    
    //var RegularExpression = /d/
	var RegularExpression  =  new RegExp(/^[a-z0-9]+$/i);
	var b = RegularExpression.test(name);
	if(!b)
	{
		alert("Illegal characters specified");
		return;
	}
    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
    alert("Bookmark added successfully");
}
function removeBookmark(id,mode)
{
    url='/bookmark/delete/';
    var data ={};
    data['id']=id;

    $.post(url,data,function(resp){
        $('#bookmark-container').html(resp);
    });
    alert("Bookmark removed successfully");
    if(mode == 'longlist')
    {
    	window.location = "/bookmark/longlist";
    }
}