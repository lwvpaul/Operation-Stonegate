// JavaScript Document - check all triggered by ID chkall & chkall2
function toggleAll(id1,id2)
{
	var SelAll = document.getElementById(id1);
 	var Single = document.getElementById(id2);
	if(SelAll.checked == true)
	{Single.checked = true;}else{Single.checked = false;}
	
}
 