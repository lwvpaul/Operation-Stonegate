function getWidthAndHeight(id, value) {
	var inputRightMargin = 0;
	var inputTopMargin = 0;
	var inputBottomMargin = 0;
	var inputBorder = 1;
	var addMargin = 0;
	var theInput = document.getElementById('htmleditor_browse_' + id).parentNode.getElementsByTagName('input')[0];
	if(navigator.appVersion.indexOf('WebKit') >= 0) {
		inputRightMargin = 2;
		if(!theInput.style.height) addMargin = 2;
	}
	var inputBorderColor = "#CCC";
	var imageObj = document.getElementById('htmleditor_image_' + id);
	if (theInput.style.borderWidth) {
		inputBorder = parseInt(theInput.style.borderWidth);
	}
	if (theInput.style.borderColor) inputBorderColor = theInput.style.borderColor;
	if (theInput.style.marginRight) inputRightMargin = parseInt(theInput.style.marginRight);
	if (theInput.style.marginTop) inputTopMargin = parseInt(theInput.style.marginTop);
	if (theInput.style.marginBottom) inputBottomMargin = parseInt(theInput.style.marginBottom);
	var dims = theInput.offsetHeight - (inputBorder*2);
	if(navigator.appVersion.indexOf('WebKit') >= 0) {
		//dims =+ (inputBorder * 2);
	}
	var maxWidth = dims;
	var maxHeight = dims;
	var newImg = new Image();
	if(value.indexOf('.jpg') < 0 && value.indexOf('.jpeg') < 0 && value.indexOf('.png') < 0 && value.indexOf('.gif') < 0) {
		newImg.src = 'webassist/kfm/themes/webassist_v2/icons/select_none.png';
		width = 1;
		height = 1;
		return;
	}
	else {
		newImg.src = value;
		var height = newImg.height;
		var width = newImg.width;
		if (height !=0 && width!=0)  {
			if (height>maxHeight || width>maxWidth)  {
				if ((height/width) > (maxHeight/maxWidth))  {
					width = Math.round((maxHeight/height) * width);
					height = maxHeight;
				} else  {
					height = Math.round((maxWidth/width) * height);
					width = maxWidth;
				}
			}
		}
		else {
			setTimeout("getWidthAndHeight('"+id+"','"+value+"')",100);
		}
	}
	
	var imageSpan = imageObj.parentNode;
	var padTotal = dims-height;
	var padTop = Math.floor(padTotal/2);
	var padBottom = padTotal - padTop;
	imageObj.src = newImg.src;
	imageObj.width = width;
	imageObj.height = height;
	imageObj.style.cssText = "padding-top:"+(Math.round((dims-height)/2))+"px; padding-left:"+(Math.round((dims-width)/2))+"px;";
	imageSpan.style.cssText = "float:left; position:relative; border-left:"+inputBorder+"px solid "+inputBorderColor+"; width:"+dims+"px ; height:"+(dims)+"px; background-color: white; margin-left: -"+(dims+(2*inputBorder)+inputRightMargin)+"px; margin-right:"+(2+inputRightMargin)+"px; margin-top:"+(inputTopMargin+inputBorder+addMargin)+"px;";
}

function init(){
	var els=document.getElementsByTagName("img");
	var reg=/htmleditor_browse_([0-9])*/;
	for(i in els){
		var el=els[i];
		if(el.id && reg.test(el.id)) {
			var regMatch = el.id.match(reg);
			var theInput = el.parentNode.getElementsByTagName('input')[0];
			var theInputMargin = 0;
			var inputBorder = 1;
			if (theInput.style.borderWidth) inputBorder = parseInt(theInput.style.borderWidth);
			if (theInput.style.marginTop) theInputMargin = parseInt(theInput.style.marginTop);
			el.style.marginTop = (2*inputBorder)+theInputMargin+theInput.clientHeight-el.height+"px";
			el.style.visibility = "visible";
			el.onclick=function(){
				window.SetUrl=(function(id){
					return function(value){
						value = value.replace(/"/g,"");
						var matches = id.match(reg);
						if(matches) var instanceID = matches[1];
						var theInput = document.getElementById('htmleditor_browse_' + instanceID).parentNode.getElementsByTagName('input')[0];
						value = value.replace(/^\/\//, "");
						theInput.value = value;
						getWidthAndHeight(instanceID, value);
					}
				})(this.id);
				var kfm_url="webassist/kfm/?theme=webassist_v2";
				var kfm_width = 600;
				var kfm_height = 400;
				eval("var settings = " + this.getAttribute("name") + ";");
				if(settings.dds && settings.dds != "") kfm_url = settings.dds + kfm_url;
				if(settings.startup_folder && settings.startup_folder!="") kfm_url+="&startup_folder="+settings.startup_folder;
				if(settings.show_sidebar && settings.show_sidebar!="") kfm_url+= "&showsidebar="+settings.show_sidebar;
				if(settings.width && settings.width!="") kfm_width = settings.width;
				if(settings.height && settings.height!="") kfm_height = settings.height;
				if(settings.color && settings.color!="") kfm_url += "&uicolor=" + escape(settings.color);
				newwindow = window.open(kfm_url,'kfm','modal=yes,resizable=yes,width='+kfm_width+',height='+kfm_height);
				newwindow.focus();
			}
			getWidthAndHeight(regMatch[1], theInput.value);
		}
	}
}

window.onload = init;