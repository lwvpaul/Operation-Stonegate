body {
	background-color: <?php echo(isset($_GET['uicolor'])?$_GET['uicolor']:"#eee"); ?>
}
<?php
$css=file_get_contents('kfm.css');
$css.=file_get_contents('hooks.css');
$css.=file_get_contents('bb.css');
header('Content-type: text/css');
header('Expires: '.gmdate("D, d M Y H:i:s", time() + 3600*24*365).' GMT');
echo $css;
?>