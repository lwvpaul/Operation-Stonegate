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

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_DesignTypeDBAdd = "SELECT * FROM admin_media_type";
$rs_DesignTypeDBAdd = mysql_query($query_rs_DesignTypeDBAdd, $GoCreate) or die(mysql_error());
$row_rs_DesignTypeDBAdd = mysql_fetch_assoc($rs_DesignTypeDBAdd);
$totalRows_rs_DesignTypeDBAdd = mysql_num_rows($rs_DesignTypeDBAdd);

$colname_rs_IncCheck = "-1";
if (isset($_GET['DES_ID'])) {
  $colname_rs_IncCheck = (get_magic_quotes_gpc()) ? $_GET['DES_ID'] : addslashes($_GET['DES_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_IncCheck = sprintf("SELECT * FROM des_res_type WHERE DESIGN_ID = %s", GetSQLValueString($colname_rs_IncCheck, "int"));
$rs_IncCheck = mysql_query($query_rs_IncCheck, $GoCreate) or die(mysql_error());
$row_rs_IncCheck = mysql_fetch_assoc($rs_IncCheck);
$totalRows_rs_IncCheck = mysql_num_rows($rs_IncCheck);?>
<?php
// WA DataAssist Multiple Inserts
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("DES_ID", "Type");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_type";
  $WA_redirectURL = "DesignTypeEdit.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "DESIGN_ID|TYPE|SELECTED";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("DES_ID", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Type", $WA_multipleInsertCounter)  ."" . "|" . "N";
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
<?php if ($totalRows_rs_IncCheck !=0)
		{
$WA_redirectURL = "DesignTypeEdit.php";
 $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];  
  header("Location: ".$WA_redirectURL);
		}
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
<body onLoad="document.form1.submit();">
<form name="form1" action="#" method="post" id="form1">
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_DesignTypeDBAdd){
?>
  <input type="hidden" name="DES_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="DES_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
  <input name="DES_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DES_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_GET['DES_ID'];?>" />
  <input name="Type_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Type_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_DesignTypeDBAdd['ID']; ?>" />
  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_DesignTypeDBAdd && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_DesignTypeDBAdd = mysql_fetch_assoc($rs_DesignTypeDBAdd);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
</form> 
</body>
</html>
<?php
mysql_free_result($rs_DesignTypeDBAdd);

mysql_free_result($rs_IncCheck);
?>
