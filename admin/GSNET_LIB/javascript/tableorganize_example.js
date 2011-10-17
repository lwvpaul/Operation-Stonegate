function $(v) { return(document.getElementById(v)); }
function $T(v,i) { return((typeof(i)=='string'?$(i):(i?i:document)).getElementsByTagName(v)); }
function agent(v) { return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0)); }
function inArray(v,r) { for(var i in r) if(r[i]==v) return true; } 
function iSW(w,n) { if($(w)) $(w).id=''; if(n) n.id=w; }

/* TBODY */

function trMAP(a,b,z) { var s=a%2?0:1; for(var i=a?a:0; i<=(b?b:Trl); i++) { Tr[i].className=(s=!s)?'even':'odd'; Tr[i].cells[0].innerHTML=i+1; if(z) trMouse(Tr[i]); } }
function trMV(w,n) { w-=1; n-=1; var b=n<=w?n+1:n-1, z=Tb.replaceChild(Tr[w],Tr[n]); Tb.insertBefore(z,Tr[b]); trMAP(Math.min(w,n),Math.max(w,n)); }
function trRM(o) { var v=o.rowIndex; T.deleteRow(v); Tr[v-1].id='this'; Trl-=1; trMAP(v-1); }
function trMouse(o) {

	o.onclick=function(){ if(stop) return false; };
	o.onmousedown=function(){ stop=1; iSW('this',this); document.onmouseup=function(){ var v=$('hover'); if(v) { v.id=''; trMV($('this').rowIndex,v.rowIndex); } stop=0; }; };
	o.onmouseover=function(){ iSW('hover',(stop && this.id!='this')?this:''); };

}

/* THEAD */

function thMV(w,n) { var r=T.rows,v='',b='',z='';

	for(var i=0; i<r.length; i++) { v=r[i].cells; SW(v[w],v[n],'innerHTML'); if(i==0) { SW(v[w],v[n],'style.width'); } }

}

function thMouse(r,R) {

	for(var i=0; i<r.length; i++) { if((R && !inArray(i,R)) || !R) {

		r[i].onclick=function() { resortTable(this,this.cellIndex); if(this.cellIndex!=0) trMAP(0); };
		r[i].onmousedown=function() { stopTH=1; iSW('thisTH',this); document.onmouseup=function() { var v=$('hoverTH'); if(v) { v.id=''; thMV($('thisTH').cellIndex,v.cellIndex); } stopTH=0; }; };
		r[i].onmouseover=function() { iSW('hoverTH',(stopTH && this.id!='thisTH')?this:''); };

	} }
}

function SW(w,n,v) { function f(a,b) { return(eval("a."+v+(b?"='"+b+"'":'')+";")); }; var z=f(n); f(n,f(w)); f(w,z); }

/* KEY STROKE */

function mkTime(v) { var z=new Date().getTime(v); return(z); }
function kCode(e) { var k=agent('opera')?e.kCode:(agent('msie')?event.keyCode:e.which); return(k); }
function kRun(e,r,fn) { var k=kCode(e); if(inArray(k,r) && !stopK[1]) { stopK=Array('',mkTime()); kStop(k,fn); } }
function kStop(k,fn) { if(!stopK[0]) { if(fn) fn(k); setTimeout("kStop('"+k+"',"+fn+")",120/((mkTime()-stopK[1]>500)?3:1)); } else { stopK[1]=''; } }