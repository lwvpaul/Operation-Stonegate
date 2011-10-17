<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="webassist/forms/fd_lwv_contact/Datepicker/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="webassist/forms/fd_lwv_contact/Datepicker/js/jquery-1.3.2.min.js"></script>
</head>

<body><script type="text/javascript">
$(function(){
	$('#datepicker').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_AppointWhen,
		yearRange: "-0:+1",

	});
});
function closeDatePicker_AppointWhen() {
	var tElm = $('#datepicker');
	if (typeof AppointWhen_Spry != null && typeof AppointWhen_Spry != "undefined") {
		AppointWhen_Spry.validate();
	}
	var docElm = document.getElementById("datepicker");
	var tBlur = docElm.getAttribute("onBlur");
	if (!tBlur) tBlur = docElm.getAttribute("onblur");
	if (!tBlur) tBlur = docElm.getAttribute("ONBLUR");
	if (tBlur) {
		tBlur = tBlur.replace(/\bthis\b/g, "docElm");
		eval(tBlur);
	}
}
</script>

<div class="demo">

<p>Date: <input id="datepicker" type="text"></p>

</div><!-- End demo -->



<div style="display: none;" class="demo-description">
<p>The datepicker is tied to a standard form input field.  Focus on the input (click, or use the tab key) to open an interactive calendar in a small overlay.  Choose a date, click elsewhere on the page (blur the input), or hit the Esc key to close. If a date is chosen, feedback is shown as the input's value.</p>
</div><!-- End demo-description -->
<div data-role="page" id="page"></div>
</body>
</html>