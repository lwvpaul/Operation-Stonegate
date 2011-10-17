<?php
header('Content-type: text/css');
header('Expires: '.gmdate("D, d M Y H:i:s", time() + 3600*24*365).' GMT');
?>
body {
	background-color: <?php echo(isset($_GET['uicolor'])?$_GET['uicolor']:"#eee"); ?>;
}
<?php
if (!function_exists("imagerotate")) {
?>
#rotateCCWItem, #rotateCWItem { display: none; }
<?php
}
?>
<?php
if (isset($_GET['uicolor']) && strtolower($_GET['uicolor'])!="#eee") {
?>
#actionBar {
	border-left:1px solid #000;
	border-bottom:1px solid #000;
}	
<?php
}
?>
#cwd_display {
    background-color: <?php echo(isset($_GET['uicolor'])?$_GET['uicolor']:"#eee"); ?>;
}
#template_footer {
    background-color: <?php echo(isset($_GET['uicolor'])?$_GET['uicolor']:"#eee"); ?>;
}
<?php
$css=file_get_contents('kfm.css');
$css.=file_get_contents('hooks.css');
$css.=file_get_contents('bb.css');
echo $css;
?>