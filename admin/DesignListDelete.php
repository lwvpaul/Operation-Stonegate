<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_DesignListDeleteInc_1303477148350 = new WA_Include("DesignListDeleteInc.php");
	require($WA_DesignListDeleteInc_1303477148350->BaseName);
	$WA_DesignListDeleteInc_1303477148350->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_DesignListDeleteInc_1303477148350))?$WA_DesignListDeleteInc_1303477148350->Head:"") ?>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<link rel="stylesheet" type="text/css" href="css/acl.css"/>
<link rel="stylesheet" type="text/css" href="css/forms.css"/>
<link rel="stylesheet" type="text/css" href="css/page.css"/>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>

<body class="pagebg">
<?php echo((isset($WA_DesignListDeleteInc_1303477148350))?$WA_DesignListDeleteInc_1303477148350->Body:"") ?></body>
</html>