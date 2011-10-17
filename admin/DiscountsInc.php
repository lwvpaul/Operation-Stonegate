<?php require_once('../Connections/GoCreate.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_discounts = "SELECT * FROM admin_discount ORDER BY EXP_DATE ASC";
$rs_discounts = mysql_query($query_rs_discounts, $GoCreate) or die(mysql_error());
$row_rs_discounts = mysql_fetch_assoc($rs_discounts);
$totalRows_rs_discounts = mysql_num_rows($rs_discounts);
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
			$('#selvenue').fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
				});
			</script>

</head>

<body><p />
<table width="800" border="0" cellpadding="2" cellspacing="0" style="padding-left: 3px; padding-right: 3px;">
  <tr align="center" class="bottomborder form_txt">
    <td nowrap="nowrap">Discount Code</td>
    <td nowrap="nowrap"><span id="Cred_Am">Discount Amount</span></td>
    <td nowrap="nowrap">Max use</td>
    <td nowrap="nowrap">Expire Date</td>
    <td colspan="2" nowrap="nowrap">Options</td>
    <td nowrap="nowrap">Venue</td>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_discounts){
?>
<tr class="form_txt roweffect">
  <td align="center"><?php echo $row_rs_discounts['DISCOUNT_CODE']; ?></td>
  <td align="center" nowrap="nowrap"><?php 
	if ($row_rs_discounts['TYPE']=="amount") {echo "upto &pound;".number_format($row_rs_discounts['CREDIT'], 2, '.', ',');}
	
	if ($row_rs_discounts['TYPE']=="percent") {echo $row_rs_discounts['CREDIT']."%";}
	?></td>
  <td align="center"><?php echo $row_rs_discounts['MAX_USE']; ?></td>
  <td align="center"><?php  $d = explode('-', $row_rs_discounts['EXP_DATE']); $d = $d[2].'-'.$d[1].'-'.$d[0]; echo $d;?></td>
  <td align="center" class="leftborder"><input name="edit" type="button" class="cust_button" id="edit" value="Edit" /></td>
  <td align="center"><input name="delete" type="button" class="cust_button" id="delete" value="Delete" /></td>
  <td align="center" class="leftborder">
  <a id="selvenue" href="venuelist.php?DSC_ID=<?php echo $row_rs_discounts['ID']; ?>"><input name="SelectVenue" type="button" class="cust_button" value="Select Venues" />  </a>
    </td>
</tr>
<?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php if ($totalRows_rs_discounts==0) {?> <tr>
  <td colspan="7" align="center" class="alert">There are no discounts currently set</td>
  </tr>
<?php } } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_discounts && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_discounts = mysql_fetch_assoc($rs_discounts);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?><tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table><br />
<input name="button" type="submit" class="cust_button" id="button" onclick="MM_goToURL('parent','DiscountAdd.php');return document.MM_returnValue" value="Add new discount" />
</body>
</html>
<?php
mysql_free_result($rs_discounts);
?>
