window.kfm_downloadSelectedFiles_addIframe=function(wrapper,id){
	var iframe=document.createElement('iframe');
	iframe.src='get_thumb.php?id='+id+'&forcedownload=1'+kfm_vars.get_params;
	kfm.addEl(wrapper,iframe);
}
