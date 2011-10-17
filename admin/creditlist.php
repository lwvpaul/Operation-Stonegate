<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_menu_1308828764173 = new WA_Include("main_menu.php");
	require($WA_menu_1308828764173->BaseName);
	$WA_menu_1308828764173->Initialize(true);
}

if("" == ""){
	$WA_venuelistCredits_1308828811107 = new WA_Include("venuelistCredits.php");
	require($WA_venuelistCredits_1308828811107->BaseName);
	$WA_venuelistCredits_1308828811107->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_menu_1308828764173))?$WA_menu_1308828764173->Head:"") ?><?php echo((isset($WA_venuelistCredits_1308828811107))?$WA_venuelistCredits_1308828811107->Head:"") ?>
</head>

<body>
<?php echo((isset($WA_menu_1308828764173))?$WA_menu_1308828764173->Body:"") ?><p /><?php echo((isset($WA_venuelistCredits_1308828811107))?$WA_venuelistCredits_1308828811107->Body:"") ?>
</body>
</html>