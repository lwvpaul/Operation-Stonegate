<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_DesignCategoriesUpdateInc_1306181579435 = new WA_Include("DesignCategoriesUpdateInc.php");
	require($WA_DesignCategoriesUpdateInc_1306181579435->BaseName);
	$WA_DesignCategoriesUpdateInc_1306181579435->Initialize(true);
}

if("" == ""){
	$WA_main_menu_1306399188827 = new WA_Include("main_menu.php");
	require($WA_main_menu_1306399188827->BaseName);
	$WA_main_menu_1306399188827->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/acl.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_DesignCategoriesUpdateInc_1306181579435))?$WA_DesignCategoriesUpdateInc_1306181579435->Head:"") ?><?php echo((isset($WA_main_menu_1306399188827))?$WA_main_menu_1306399188827->Head:"") ?>
</head>

<body class="pagebg"><?php echo((isset($WA_main_menu_1306399188827))?$WA_main_menu_1306399188827->Body:"") ?>
<?php echo((isset($WA_DesignCategoriesUpdateInc_1306181579435))?$WA_DesignCategoriesUpdateInc_1306181579435->Body:"") ?>

</body>
</html>