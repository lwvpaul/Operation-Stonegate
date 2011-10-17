// JavaScript Document
function toggleAll(id)
{
	box = document.getElementById(id); 
	if(box.checked == true)
	{
		var setting = true;
	}
	else
	{
		var setting = false;
	}
 	box = document.getElementById(id)
	box.checked = setting;
	
}

