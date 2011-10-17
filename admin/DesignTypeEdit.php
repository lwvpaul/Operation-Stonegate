<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php
if("" == ""){
	$WA_DesignTypeEditInc_1303647216886 = new WA_Include("DesignTypeEditInc.php");
	require($WA_DesignTypeEditInc_1303647216886->BaseName);
	$WA_DesignTypeEditInc_1303647216886->Initialize(true);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<title>Untitled Document</title>
<?php echo((isset($WA_DesignTypeEditInc_1303647216886))?$WA_DesignTypeEditInc_1303647216886->Head:"") ?>
<link rel="stylesheet" type="text/css" href="css/acl.css"/>
<link rel="stylesheet" type="text/css" href="css/page.css"/>
<link rel="stylesheet" type="text/css" href="css/forms.css"/>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<body class="pagebg">
</head>
<?php echo((isset($WA_DesignTypeEditInc_1303647216886))?$WA_DesignTypeEditInc_1303647216886->Body:"") ?>
</body>
</html>