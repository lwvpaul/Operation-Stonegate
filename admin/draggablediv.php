<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_ajaxeditor_1302447007532 = new WA_Include("ajaxeditor.php");
	require($WA_ajaxeditor_1302447007532->BaseName);
	$WA_ajaxeditor_1302447007532->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#apDiv1 {
	position:absolute;
	z-index:1;
}
</style>
<script type="text/javascript">
function MM_scanStyles(obj, prop) { //v9.0
  var inlineStyle = null; var ccProp = prop; var dash = ccProp.indexOf("-");
  while (dash != -1){ccProp = ccProp.substring(0, dash) + ccProp.substring(dash+1,dash+2).toUpperCase() + ccProp.substring(dash+2); dash = ccProp.indexOf("-");}
  inlineStyle = eval("obj.style." + ccProp);
  if(inlineStyle) return inlineStyle;
  var ss = document.styleSheets;
  for (var x = 0; x < ss.length; x++) { var rules = ss[x].cssRules;
	for (var y = 0; y < rules.length; y++) { var z = rules[y].style;
	  if(z[prop] && (rules[y].selectorText == '*[ID"' + obj.id + '"]' || rules[y].selectorText == '#' + obj.id)) {
        return z[prop];
  }  }  }  return "";
}

function MM_getProp(obj, prop) { //v8.0
  if (!obj) return ("");
  if (prop == "L") return obj.offsetLeft;
  else if (prop == "T") return obj.offsetTop;
  else if (prop == "W") return obj.offsetWidth;
  else if (prop == "H") return obj.offsetHeight;
  else {
    if (typeof(window.getComputedStyle) == "undefined") {
	    if (typeof(obj.currentStyle) == "undefined"){
		    if (prop == "P") return MM_scanStyles(obj,"position");
        else if (prop == "Z") return MM_scanStyles(obj,"z-index");
        else if (prop == "V") return MM_scanStyles(obj,"visibility");
	    } else {
	      if (prop == "P") return obj.currentStyle.position;
        else if (prop == "Z") return obj.currentStyle.zIndex;
        else if (prop == "V") return obj.currentStyle.visibility;
	    }
    } else {
	    if (prop == "P") return window.getComputedStyle(obj,null).getPropertyValue("position");
      else if (prop == "Z") return window.getComputedStyle(obj,null).getPropertyValue("z-index");
      else if (prop == "V") return window.getComputedStyle(obj,null).getPropertyValue("visibility");
    }
  }
}

function MM_dragLayer(objId,x,hL,hT,hW,hH,toFront,dropBack,cU,cD,cL,cR,targL,targT,tol,dropJS,et,dragJS) { //v9.01
  //Copyright 2005-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved.
  var i,j,aLayer,retVal,curDrag=null,curLeft,curTop,IE=document.all;
  var NS=(!IE&&document.getElementById); if (!IE && !NS) return false;
  retVal = true; if(IE && event) event.returnValue = true;
  if (MM_dragLayer.arguments.length > 1) {
    curDrag = document.getElementById(objId); if (!curDrag) return false;
    if (!document.allLayers) { document.allLayers = new Array();
      with (document){ if (NS) { var spns = getElementsByTagName("span"); var all = getElementsByTagName("div");
        for (i=0;i<spns.length;i++) if (MM_getProp(spns[i],'P')) allLayers[allLayers.length]=spns[i];}
        for (i=0;i<all.length;i++) {
	        if (MM_getProp(all[i],'P')) allLayers[allLayers.length]=all[i]; 
        }
    } }
    curDrag.MM_dragOk=true; curDrag.MM_targL=targL; curDrag.MM_targT=targT;
    curDrag.MM_tol=Math.pow(tol,2); curDrag.MM_hLeft=hL; curDrag.MM_hTop=hT;
    curDrag.MM_hWidth=hW; curDrag.MM_hHeight=hH; curDrag.MM_toFront=toFront;
    curDrag.MM_dropBack=dropBack; curDrag.MM_dropJS=dropJS;
    curDrag.MM_everyTime=et; curDrag.MM_dragJS=dragJS;
  
    curDrag.MM_oldZ = MM_getProp(curDrag,'Z');
    curLeft = MM_getProp(curDrag,'L');
    if (String(curLeft)=="NaN") curLeft=0; curDrag.MM_startL = curLeft;
    curTop = MM_getProp(curDrag,'T');
    if (String(curTop)=="NaN") curTop=0; curDrag.MM_startT = curTop;
    curDrag.MM_bL=(cL<0)?null:curLeft-cL; curDrag.MM_bT=(cU<0)?null:curTop-cU;
    curDrag.MM_bR=(cR<0)?null:curLeft+cR; curDrag.MM_bB=(cD<0)?null:curTop+cD;
    curDrag.MM_LEFTRIGHT=0; curDrag.MM_UPDOWN=0; curDrag.MM_SNAPPED=false; //use in your JS!
    document.onmousedown = MM_dragLayer; document.onmouseup = MM_dragLayer;
    if (NS) document.captureEvents(Event.MOUSEDOWN|Event.MOUSEUP);
    } else {
    var theEvent = ((NS)?objId.type:event.type);
    if (theEvent == 'mousedown') {
      var mouseX = (NS)?objId.pageX : event.clientX + document.body.scrollLeft;
      var mouseY = (NS)?objId.pageY : event.clientY + document.body.scrollTop;
      var maxDragZ=null; document.MM_maxZ = 0;
      for (i=0; i<document.allLayers.length; i++) { aLayer = document.allLayers[i];
        var aLayerZ = MM_getProp(aLayer,'Z');
        if (aLayerZ > document.MM_maxZ) document.MM_maxZ = aLayerZ;
        var isVisible = (MM_getProp(aLayer,'V')).indexOf('hid') == -1;
        if (aLayer.MM_dragOk != null && isVisible) with (aLayer) {
          var parentL=0; var parentT=0;
          if (NS) { parentLayer = aLayer.parentNode;
            while (parentLayer != null && parentLayer != document && MM_getProp(parentLayer,'P')) {
              parentL += parseInt(MM_getProp(parentLayer,'L')); parentT += parseInt(MM_getProp(parentLayer,'T'));
              parentLayer = parentLayer.parentNode;
              if (parentLayer==document) parentLayer = null;
          } } else if (IE) { parentLayer = aLayer.parentElement;       
            while (parentLayer != null && MM_getProp(parentLayer,'P')) {
              parentL += MM_getProp(parentLayer,'L'); parentT += MM_getProp(parentLayer,'T');
              parentLayer = parentLayer.parentElement; } }
          var tmpX=mouseX-((MM_getProp(aLayer,'L'))+parentL+MM_hLeft);
          var tmpY=mouseY-((MM_getProp(aLayer,'T'))+parentT+MM_hTop);
          if (String(tmpX)=="NaN") tmpX=0; if (String(tmpY)=="NaN") tmpY=0;
          var tmpW = MM_hWidth;  if (tmpW <= 0) tmpW += MM_getProp(aLayer,'W');
          var tmpH = MM_hHeight; if (tmpH <= 0) tmpH += MM_getProp(aLayer,'H');
          if ((0 <= tmpX && tmpX < tmpW && 0 <= tmpY && tmpY < tmpH) && (maxDragZ == null
              || maxDragZ <= aLayerZ)) { curDrag = aLayer; maxDragZ = aLayerZ; } } }
      if (curDrag) {
        document.onmousemove = MM_dragLayer;
        curLeft = MM_getProp(curDrag,'L');
        curTop = MM_getProp(curDrag,'T');
        if (String(curLeft)=="NaN") curLeft=0; if (String(curTop)=="NaN") curTop=0;
        MM_oldX = mouseX - curLeft; MM_oldY = mouseY - curTop;
        document.MM_curDrag = curDrag;  curDrag.MM_SNAPPED=false;
        if(curDrag.MM_toFront) {
          var newZ = parseInt(document.MM_maxZ)+1;
          eval('curDrag.'+('style.')+'zIndex=newZ');
          if (!curDrag.MM_dropBack) document.MM_maxZ++; }
        retVal = false; if(!NS) event.returnValue = false;
    } } else if (theEvent == 'mousemove') {
      if (document.MM_curDrag) with (document.MM_curDrag) {
        var mouseX = (NS)?objId.pageX : event.clientX + document.body.scrollLeft;
        var mouseY = (NS)?objId.pageY : event.clientY + document.body.scrollTop;
        var newLeft = mouseX-MM_oldX; var newTop  = mouseY-MM_oldY;
        if (MM_bL!=null) newLeft = Math.max(newLeft,MM_bL);
        if (MM_bR!=null) newLeft = Math.min(newLeft,MM_bR);
        if (MM_bT!=null) newTop  = Math.max(newTop ,MM_bT);
        if (MM_bB!=null) newTop  = Math.min(newTop ,MM_bB);
        MM_LEFTRIGHT = newLeft-MM_startL; MM_UPDOWN = newTop-MM_startT;
        if (NS){style.left = newLeft + "px"; style.top = newTop + "px";}
        else {style.pixelLeft = newLeft; style.pixelTop = newTop;}
        if (MM_dragJS) eval(MM_dragJS);
        retVal = false; if(!NS) event.returnValue = false;
    } } else if (theEvent == 'mouseup') {
      document.onmousemove = null;
      if (NS) document.releaseEvents(Event.MOUSEMOVE);
      if (NS) document.captureEvents(Event.MOUSEDOWN); //for mac NS
      if (document.MM_curDrag) with (document.MM_curDrag) {
        if (typeof MM_targL =='number' && typeof MM_targT == 'number' &&
            (Math.pow(MM_targL-(MM_getProp(document.MM_curDrag,'L')),2)+
             Math.pow(MM_targT-(MM_getProp(document.MM_curDrag,'T')),2))<=MM_tol) {
          if (NS) {style.left = MM_targL + "px"; style.top = MM_targT + "px";}
          else {style.pixelLeft = MM_targL; style.pixelTop = MM_targT;}
          MM_SNAPPED = true; MM_LEFTRIGHT = MM_startL-MM_targL; MM_UPDOWN = MM_startT-MM_targT; }
        if (MM_everyTime || MM_SNAPPED) eval(MM_dropJS);
        if(MM_dropBack) {style.zIndex = MM_oldZ;}
        retVal = false; if(!NS) event.returnValue = false; }
      document.MM_curDrag = null;
    }
    if (NS) document.routeEvent(objId);
  } return retVal;
}
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
</script>
<?php echo((isset($WA_ajaxeditor_1302447007532))?$WA_ajaxeditor_1302447007532->Head:"") ?>
</head>

<body onload="MM_dragLayer('apDiv1','',0,0,580,50,true,false,-1,-1,-1,-1,false,false,0,'',false,'')">
<div id="apDiv1"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="edit">
  <tr>
    <td align="center" style="font-family: Verdana, Geneva, sans-serif; text-align: right; color: #FFF; font-weight: bold; font-size: 14px; background-color: #060; cursor: hand; cursor: pointer;" onclick="MM_showHideLayers('apDiv1','','hide')">Close Editor</td>
  </tr>
</table>
<?php echo((isset($WA_ajaxeditor_1302447007532))?$WA_ajaxeditor_1302447007532->Body:"") ?></div>
</body>
</html>