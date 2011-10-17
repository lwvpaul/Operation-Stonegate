<?php
require_once( "../../webassist/framework/library.php" );
require_once( "../../webassist/framework/framework.php" );
?>
<?php require_once('../../Connections/GoCreate.php'); ?>
<?php require_once("../../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
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
$query_rs_grp_id = "SELECT GRP_ID FROM admin_media_type ORDER BY GRP_ID DESC";
$rs_grp_id = mysql_query($query_rs_grp_id, $GoCreate) or die(mysql_error());
$row_rs_grp_id = mysql_fetch_assoc($rs_grp_id);
$totalRows_rs_grp_id = mysql_num_rows($rs_grp_id);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["InsertAll"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("MMType", "MMVatRated", "GRP_ID");
  $WA_connection = $GoCreate;
  $WA_table = "admin_media_type";
  $WA_redirectURL = "../DesignGRPUpdate.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "MEDIA_TYPE|VAT_RATING|GRP_ID";
  $WA_columnTypesStr = "',none,''|none,'Y','N'|none,none,NULL";
  $WA_insertIfNotBlank = "MMType";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("MMType", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("MMVatRated", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("GRP_ID", $WA_multipleInsertCounter)  ."";
      $WA_fieldValues = explode("|", $WA_fieldValuesStr);
      $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
      $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
      $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    }
    $WA_multipleInsertCounter++;
  }
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<?php

if("" == ""){
	$WA_cnt_loop_1299929861511 = new WA_Include("../GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1299929861511->BaseName);
	$WA_cnt_loop_1299929861511->Initialize(true);
}
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "".((isset($_POST["NewAdd"]))?$_POST["NewAdd"]:"")  ."";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../css/page.css" rel="stylesheet" type="text/css" />
<link href="../css/forms.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_cnt_loop_1299929861511))?$WA_cnt_loop_1299929861511->Head:"") ?>
<script type="text/javascript">
<!--
function tfm_confirmLink(message) { //v1.0
	if(message == "") message = "Ok to continue?";	
	document.MM_returnValue = confirm(message);
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body class="pagebg">
<div id="HeaderTitle">Master Media Insert</div>
<form action="../MasterTyAdd.php" method="post">
<table width="466" border="0" cellpadding="2" cellspacing="2" class="form">
  <tr>
    <td align="center" class="form_txt">No.</td>
    <td align="left" class="form_txt"><span style="padding-left: 35px;">Media Type</span></td>
    <td align="center" class="form_txt">VAT Rated</td>
    </tr><?php $loopcnt=1;?>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?> <tr>
    <td align="center" class="form_txt"><?php echo $loopcnt.".";?></td>
    <td align="center"><span id="sprytextfield1">
      <input type="hidden" name="MMType_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="MMType_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
      <input name="MMType_<?php echo $RepeatSelectionCounter_1; ?>" type="text"  id="MMType_<?php echo $RepeatSelectionCounter_1; ?>" size="35" />
<span class="textfieldRequiredMsg">A value is required.</span></span>
      <input name="GRP_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="GRP_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php if ($row_rs_grp_id['GRP_ID'] == "") {echo "1";} else {echo ++$row_rs_grp_id['GRP_ID'];} ?>" /></td>
    <td align="center"><input name="MMVatRated_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" class="form" id="MMVatRated_<?php echo $RepeatSelectionCounter_1; ?>" /></td>
    </tr><?php ++$loopcnt;?><?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
</table>
<p />
<table width="466" border="0" cellpadding="2" cellspacing="2" class="form">
  <tr>
    <td align="left"><span style="padding-right: 15px;"><span class="form_txt">Add</span>
        <select name="NewAdd" id="NewAdd" onchange="this.form.submit();">
          <?php echo((isset($WA_cnt_loop_1299929861511))?$WA_cnt_loop_1299929861511->Body:"") ?>
        </select>
        <span class="form_txt">
      <input name="InsertAll" type="submit" class="cust_button" id="InsertAll" value="InsertAll" />
      <input name="cancel" type="button" class="cust_button" id="cancel" onclick="MM_goToURL('parent','../MasterTyList.php');return document.MM_returnValue" value="Cancel" />
      </span></td>
    </tr>
</table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($rs_grp_id);
?>
