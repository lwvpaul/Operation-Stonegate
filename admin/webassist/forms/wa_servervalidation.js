function hideServerError(theID) {
  if (document.getElementById(theID)) document.getElementById(theID).style.display='none';
}

function clearAllServerErrors(theFormID)  {
  if (Spry)  {
	      var theForm = document.getElementById(theFormID);
          var q = Spry.Widget.Form.onSubmitWidgetQueue;  
          var qlen = q.length;  
          for (var i = 0; i < qlen; i++) 
		  if (q[i].form == theForm)  {
			 clearRelated(q[i].element.id); 
		  }
	}	
}


function clearRelated(theID) {
  var theTestID = theID.replace(/_[^_]*$/,"");
  while (theTestID != "")  {
    if (document.getElementById(theTestID+"_ServerError")) {
	  document.getElementById(theTestID+"_ServerError").style.display='none';
	  return;  
    }
	if (theTestID.search(/_[^_]*$/)<0) theTestID = ""; else theTestID = theTestID.replace(/_[^_]*$/,"");
  }
}