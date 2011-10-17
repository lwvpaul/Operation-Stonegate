<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );

$WA_DesignListAddInc_1303120652016 = new WA_Include("DesignListAddInc.php");
require($WA_DesignListAddInc_1303120652016->BaseName);
$WA_DesignListAddInc_1303120652016->Initialize(true);

$WA_footer_1303320242036 = new WA_Include("footer.php");
require($WA_footer_1303320242036->BaseName);
$WA_footer_1303320242036->Initialize(true);

$counter = $_GET['counter'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Add Design</title>
	<?php echo((isset($WA_DesignListAddInc_1303120652016))?$WA_DesignListAddInc_1303120652016->Head:"") ?>
	<link href="css/forms.css" rel="stylesheet" type="text/css" />
	<link href="css/page.css" rel="stylesheet" type="text/css" />
	<link href="css/admin.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function MM_goToURL() { //v3.0
	  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
	  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
	}
	</script>
		<?php echo((isset($WA_footer_1303320242036))?$WA_footer_1303320242036->Head:"") ?>
	</head>

	<body class="pagebg">
		<?php echo((isset($WA_DesignListAddInc_1303120652016))?$WA_DesignListAddInc_1303120652016->Body:"") ?>
		<?php echo((isset($WA_footer_1303320242036))?$WA_footer_1303320242036->Body:"") ?>
	</body>
</html>