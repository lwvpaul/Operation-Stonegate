<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_DesignListUpdateInc_1303481381271 = new WA_Include("DesignListUpdateInc.php");
	require($WA_DesignListUpdateInc_1303481381271->BaseName);
	$WA_DesignListUpdateInc_1303481381271->Initialize(true);
}

if("" == ""){
	$WA_footer_1303562048044 = new WA_Include("footer.php");
	require($WA_footer_1303562048044->BaseName);
	$WA_footer_1303562048044->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_DesignListUpdateInc_1303481381271))?$WA_DesignListUpdateInc_1303481381271->Head:"") ?>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/acl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<?php echo((isset($WA_footer_1303562048044))?$WA_footer_1303562048044->Head:"") ?>
</head>

<body class="pagebg">
<?php echo((isset($WA_DesignListUpdateInc_1303481381271))?$WA_DesignListUpdateInc_1303481381271->Body:"") ?>
<?php echo((isset($WA_footer_1303562048044))?$WA_footer_1303562048044->Body:"") ?>
</body>
</html>