<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_menu_1308052255953 = new WA_Include("main_menu.php");
	require($WA_menu_1308052255953->BaseName);
	$WA_menu_1308052255953->Initialize(true);
}

if("" == ""){
	$WA_DiscountsInc_1308052304667 = new WA_Include("DiscountsInc.php");
	require($WA_DiscountsInc_1308052304667->BaseName);
	$WA_DiscountsInc_1308052304667->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_menu_1308052255953))?$WA_menu_1308052255953->Head:"") ?><?php echo((isset($WA_DiscountsInc_1308052304667))?$WA_DiscountsInc_1308052304667->Head:"") ?>
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php echo((isset($WA_menu_1308052255953))?$WA_menu_1308052255953->Body:"") ?>
<?php echo((isset($WA_DiscountsInc_1308052304667))?$WA_DiscountsInc_1308052304667->Body:"") ?>

</body>
</html>