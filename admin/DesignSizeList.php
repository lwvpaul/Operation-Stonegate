<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_DesignSizeLisInc_1304966586261 = new WA_Include("DesignSizeLisInc.php");
	require($WA_DesignSizeLisInc_1304966586261->BaseName);
	$WA_DesignSizeLisInc_1304966586261->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_DesignSizeLisInc_1304966586261))?$WA_DesignSizeLisInc_1304966586261->Head:"") ?>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>

<body class="pagebg">
<?php echo((isset($WA_DesignSizeLisInc_1304966586261))?$WA_DesignSizeLisInc_1304966586261->Body:"") ?></body>
</html>