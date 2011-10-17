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

$colname1_rs_typeadmin = "-1";
if (isset($_GET['ID'])) {
  $colname1_rs_typeadmin = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_typeadmin = sprintf("SELECT * FROM `admin_media_type` Inner Join `des_res_type` ON `des_res_type`.`DESIGN_ID` = `admin_media_type`.`ID` WHERE %s =  `des_res_type`.`TYPE` ", GetSQLValueString($colname1_rs_typeadmin, "int"));
$rs_typeadmin = mysql_query($query_rs_typeadmin, $GoCreate) or die(mysql_error());
$row_rs_typeadmin = mysql_fetch_assoc($rs_typeadmin);
$totalRows_rs_typeadmin = mysql_num_rows($rs_typeadmin);
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
</head>

<body class="pagebg">
<div id="HeaderTitle">Design Type Select</div>
<form id="form2" name="form2" method="post" action="">
<table border="0" cellpadding="4" cellspacing="4" class="form">
  <tr class="form_txt" style="text-align: center;">
    <td>No.</td>
    <td>Type</td>
    <td>Image</td>
    <td>Selected</td>
</tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_typeadmin){
?>
<tr class="roweffect">
  <td class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>. <input type="hidden" name="hiddenField" id="hiddenField" />
  </td>
  <td class="form_txt"><input type="hidden" name="DT_ID" id="DT_ID" /></td>
  <td class="form_txt">&nbsp;</td>
  <td class="form_txt"><input type="checkbox" name="checkbox" id="checkbox" />
    <label for="checkbox"></label></td>
</tr>
<?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_typeadmin && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_typeadmin = mysql_fetch_assoc($rs_typeadmin);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
  <tr>
    <td colspan="4" style="text-align: right;"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
    <input name="Cancel" type="button" class="cust_button" id="Cancel" value="Cancel" /></td>
</tr>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($rs_typeadmin);
?>
