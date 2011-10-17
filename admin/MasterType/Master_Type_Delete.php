<?php require_once('../../Connections/GoCreate.php'); ?>
<?php require_once("../../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
//WA Database Search Include
require_once("../../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rs_delete;
//Searchpage: Master_Type_List.php;
//Form: form1;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("ID","mediaid","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_Master_Type_Delete"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_Master_Type_Delete"]) && $_SESSION["WADbSearch1_Master_Type_Delete"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_Master_Type_Delete"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
?>
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
$query_rs_delete = "SELECT * FROM admin_media_type";
setQueryBuilderSource($query_rs_delete,$WADbSearch1,false);
$rs_delete = mysql_query($query_rs_delete, $GoCreate) or die(mysql_error());
$row_rs_delete = mysql_fetch_assoc($rs_delete);
$totalRows_rs_delete = mysql_num_rows($rs_delete);?>
<?php
// WA DataAssist Multiple Deletes
if (isset($_POST["delete"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_loopedField = array("MT_ID");
  $WA_connection = $GoCreate;
  $WA_table = "admin_media_type";
  $WA_redirectURL = "../MasterTyList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_columnTypesStr = "none,none,NULL";
  $WA_fieldNames = explode("|", $WA_indexField);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_comparisions = array("=");
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleDeleteCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleDeleteCounter)) {
    if (WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleDeleteCounter) == WA_AB_getLoopedFieldValue($WA_loopedField[0], $WA_multipleDeleteCounter)) {
      $WA_fieldValuesStr = WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleDeleteCounter);
      $WA_fieldValues = array($WA_fieldValuesStr);
      $deleteParamsObj = WA_AB_generateWhereClause($WA_fieldNames, $WA_columns, $WA_fieldValues, $WA_comparisions);
      $WA_Sql = "DELETE FROM `" . $WA_table . "` WHERE " . $deleteParamsObj->sqlWhereClause;
      $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    }
    $WA_multipleDeleteCounter++;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/forms.css" rel="stylesheet" type="text/css" />
<link href="../css/page.css" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: #004923;">
<div id="HeaderTitle">Master Media Type Delete
</div>
<form id="form1" name="form1" method="post" action="../MasterTyDelete.php">
  <div style="left: 15px; position: relative;" >
    <table border="0" cellpadding="4" cellspacing="4" class="form" >
      <tr class="form_txt">
        <td>No.</td>
        <td colspan="2">Media Type</td>
      </tr>
      
      <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_delete){
?>

      <tr class="roweffect">
        <td class="form_txt"><input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_delete["ID"]; ?>" />
          <input name="MT_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="MT_ID_<?php echo $RepeatSelectionCounter_1; ?>" value='<?php echo $row_rs_delete["ID"]; ?>' />
        <?php echo $RepeatSelectionCounter_1+1; ?>.</td>
        <td colspan="2"><?php echo $row_rs_delete['MEDIA_TYPE']; ?></td>
      </tr>
      <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_delete && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_delete = mysql_fetch_assoc($rs_delete);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
      <tr>
        <td>&nbsp;</td>
        <td><input name="delete" type="submit" class="cust_button" id="delete" value="Confirm Deletion" /></td>
        <td><input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','MasterTyList.php');return document.MM_returnValue" value="Cancel" /></td>
      </tr>
  </table>
  </div>

</form>
</body>
</html>
<?php
mysql_free_result($rs_delete);

mysql_free_result($rs_delete);
?>
