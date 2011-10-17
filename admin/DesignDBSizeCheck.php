<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
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

$colname_rs_InsertSizes = "-1";
if (isset($_GET['A_DT_ID'])) {
  $colname_rs_InsertSizes = (get_magic_quotes_gpc()) ? $_GET['A_DT_ID'] : addslashes($_GET['A_DT_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_InsertSizes = sprintf("SELECT * FROM admin_media_sizes WHERE F_ID = %s", GetSQLValueString($colname_rs_InsertSizes, "int"));
$rs_InsertSizes = mysql_query($query_rs_InsertSizes, $GoCreate) or die(mysql_error());
$row_rs_InsertSizes = mysql_fetch_assoc($rs_InsertSizes);
$totalRows_rs_InsertSizes = mysql_num_rows($rs_InsertSizes);

$colname1_rs_SizeChk = "-1";
if (isset($_GET['DT_ID'])) {
  $colname1_rs_SizeChk = (get_magic_quotes_gpc()) ? $_GET['DT_ID'] : addslashes($_GET['DT_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_SizeChk = sprintf("SELECT des_res_size.ID,  des_res_size.TYPE_ID,  des_res_size.A_TYPE_ID,  des_res_size.A_SIZE_ID,  des_res_size.DESIGN_ID,  des_res_size.SELECTED,  admin_media_sizes.ID AS AMS_ID,  admin_media_sizes.MEDIA_SIZE AS AMS_MEDIA_SIZES,  admin_media_sizes.F_ID AS AMS_F_ID FROM  des_res_size  RIGHT JOIN admin_media_sizes ON admin_media_sizes.F_ID = des_res_size.A_TYPE_ID WHERE des_res_size.TYPE_ID = %s ", GetSQLValueString($colname1_rs_SizeChk, "int"));
$rs_SizeChk = mysql_query($query_rs_SizeChk, $GoCreate) or die(mysql_error());
$row_rs_SizeChk = mysql_fetch_assoc($rs_SizeChk);
$totalRows_rs_SizeChk = mysql_num_rows($rs_SizeChk);?>
<?php
// WA DataAssist Multiple Inserts
if (($totalRows_rs_SizeChk == 0)) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("Type_ID", "A_Type_ID", "A_SIZE_ID", "DesignID");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_size";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "TYPE_ID|A_TYPE_ID|A_SIZE_ID|DESIGN_ID";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("Type_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("A_Type_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("A_SIZE_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("DesignID", $WA_multipleInsertCounter)  ."";
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
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<?php
if(!($totalRows_rs_SizeChk == 0)){
	$WA_Redirect_URL = "DesignSizeList.php";
	$WA_Redirect_KeepQS = true;
	if ($WA_Redirect_URL != "")  {
	 if ($WA_Redirect_KeepQS && $WA_Redirect_URL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "") {
		$WA_Redirect_URL .= ((strpos($WA_Redirect_URL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
	 }
	 header("Location: ".$WA_Redirect_URL);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body onLoad="document.form1.submit();">
<form id="form1" name="form1" method="post" action="#">
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_InsertSizes){
?><input type="hidden" name="Type_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="Type_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1"/>
  <input name="DesignID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DesignID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DES_ID'];?>"/>
  <input name="Type_ID_<?php echo $RepeatSelectionCounter_1; ?>"  type="hidden" id="Type_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DT_ID'];?>"/>
  <input name="A_Type_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="A_Type_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['A_DT_ID']; ?>"/>
  <input name="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_InsertSizes['ID']; ?>"/>
<?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_InsertSizes && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_InsertSizes = mysql_fetch_assoc($rs_InsertSizes);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
</form>
</body>
</html>
<?php
mysql_free_result($rs_InsertSizes);

mysql_free_result($rs_SizeChk);
?>
