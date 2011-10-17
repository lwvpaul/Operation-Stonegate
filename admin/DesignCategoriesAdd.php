<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_DesignCategoriesAddInc_1306155230152 = new WA_Include("DesignCategoriesAddInc.php");
	require($WA_DesignCategoriesAddInc_1306155230152->BaseName);
	$WA_DesignCategoriesAddInc_1306155230152->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_DesignCategoriesAddInc_1306155230152))?$WA_DesignCategoriesAddInc_1306155230152->Head:"") ?>
<link href="css/acl.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
</head>

<body class="pagebg">
<?php echo((isset($WA_DesignCategoriesAddInc_1306155230152))?$WA_DesignCategoriesAddInc_1306155230152->Body:"") ?></body>
</html>