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

$colname_rs_CQWList = "-1";
if (isset($_GET['A_DS_ID'])) {
  $colname_rs_CQWList = (get_magic_quotes_gpc()) ? $_GET['A_DS_ID'] : addslashes($_GET['A_DS_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_CQWList = sprintf("SELECT * FROM admin_media_cqw WHERE F_ID = %s", GetSQLValueString($colname_rs_CQWList, "int"));
$rs_CQWList = mysql_query($query_rs_CQWList, $GoCreate) or die(mysql_error());
$row_rs_CQWList = mysql_fetch_assoc($rs_CQWList);
$totalRows_rs_CQWList = mysql_num_rows($rs_CQWList);

$colname_rs_CQWCheck = "-1";
if (isset($_GET['DS_ID'])) {
  $colname_rs_CQWCheck = (get_magic_quotes_gpc()) ? $_GET['DS_ID'] : addslashes($_GET['DS_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_CQWCheck = sprintf("SELECT * FROM des_res_cost WHERE SIZE_ID = %s", GetSQLValueString($colname_rs_CQWCheck, "int"));
$rs_CQWCheck = mysql_query($query_rs_CQWCheck, $GoCreate) or die(mysql_error());
$row_rs_CQWCheck = mysql_fetch_assoc($rs_CQWCheck);
$totalRows_rs_CQWCheck = mysql_num_rows($rs_CQWCheck);?>
<?php
// WA DataAssist Multiple Inserts
if (($totalRows_rs_CQWCheck == 0)) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("A_SIZE_ID", "cost", "qty", "weight", "des_id", "DT_ID", "DS_ID", "Selected", "Limit");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_cost";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "A_SIZE_ID|COST|QTY|WEIGHT|DESIGN_ID|TYPE_ID|SIZE_ID|SELECTED|LIMIT";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|',none,''|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("A_SIZE_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("cost", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("qty", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("weight", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("des_id", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("DT_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("DS_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Selected", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Limit", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounter_1_Iterations = "-1";?>
<?php
if(!($totalRows_rs_CQWCheck == 0)){
	$WA_Redirect_URL = "DesignCQWList.php";
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
<body onload="document.form1.submit();">
<form id="form1" name="form1" method="post" action="#">
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_CQWList){
?>
  <input type="hidden" name="A_SIZE_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="A_SIZE_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
  <input name="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['A_DS_ID'];?>"/>
<input name="cost_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="cost_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_CQWList['COST']; ?>" />
  <input name="qty_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="qty_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_CQWList['QTY']; ?>" />
  <input name="weight_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="weight_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_CQWList['WEIGHT']; ?>" />
  <input name="des_id_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="des_id_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DES_ID'];?>" />
  <input name="DT_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DT_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DT_ID'];?>" />
  <input name="DS_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DS_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DS_ID'];?>" />
  <input name="Selected_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Selected_<?php echo $RepeatSelectionCounter_1; ?>" value="Y" />
  <input name="Limit_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Limit_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_CQWList['LIMIT']; ?>" />
  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_CQWList && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_CQWList = mysql_fetch_assoc($rs_CQWList);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
</form>
</body>
</html>
<?php
mysql_free_result($rs_CQWList);

mysql_free_result($rs_CQWCheck);
?>
