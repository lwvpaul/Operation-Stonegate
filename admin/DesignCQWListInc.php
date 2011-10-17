<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
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

$colname_rs_CQWList = "-1";
if (isset($_GET['DS_ID'])) {
  $colname_rs_CQWList = (get_magic_quotes_gpc()) ? $_GET['DS_ID'] : addslashes($_GET['DS_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_CQWList = sprintf("SELECT * FROM des_res_cost WHERE SIZE_ID = %s ORDER BY QTY ASC", GetSQLValueString($colname_rs_CQWList, "int"));
$rs_CQWList = mysql_query($query_rs_CQWList, $GoCreate) or die(mysql_error());
$row_rs_CQWList = mysql_fetch_assoc($rs_CQWList);
$totalRows_rs_CQWList = mysql_num_rows($rs_CQWList);

$colname_rs_CQWList = "-1";
if (isset($_GET['A_DS_ID'])) {
  $colname_rs_CQWList = (get_magic_quotes_gpc()) ? $_GET['A_DS_ID'] : addslashes($_GET['A_DS_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_Sizetxt = sprintf("SELECT * FROM admin_media_sizes WHERE ID = %s", GetSQLValueString($colname_rs_Sizetxt, "int"));
$rs_Sizetxt = mysql_query($query_rs_Sizetxt, $GoCreate) or die(mysql_error());
$row_rs_Sizetxt = mysql_fetch_assoc($rs_Sizetxt);
$totalRows_rs_Sizetxt = mysql_num_rows($rs_Sizetxt);

$colname_rs_Typetxt = "-1";
if (isset($_GET['DT_ID'])) {
  $colname_rs_Typetxt = (get_magic_quotes_gpc()) ? $_GET['DT_ID'] : addslashes($_GET['DT_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_Typetxt = sprintf("SELECT * FROM admin_media_type WHERE ID = %s", GetSQLValueString($colname_rs_Typetxt, "int"));
$rs_Typetxt = mysql_query($query_rs_Typetxt, $GoCreate) or die(mysql_error());
$row_rs_Typetxt = mysql_fetch_assoc($rs_Typetxt);
$totalRows_rs_Typetxt = mysql_num_rows($rs_Typetxt);?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["Update"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_cost";
  $WA_redirectURL = "DesignCQWList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "SELECTED";
  $WA_columnTypesStr = "',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("Selected", $WA_multipleUpdateCounter)  ."";
    $WA_fieldValues = explode("|", $WA_fieldValuesStr);
    $WA_where_fieldValuesStr = WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleUpdateCounter);
    $WA_where_columnTypesStr = "none,none,NULL";
    $WA_where_comparisonStr = "=";
    $WA_where_fieldNames = explode("|", $WA_indexField);
    $WA_where_fieldValues = explode("|", $WA_where_fieldValuesStr);
    $WA_where_columns = explode("|", $WA_where_columnTypesStr);
    $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
    $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
    $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
    $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
    $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    $WA_multipleUpdateCounter++;
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
</head>
<body class="pagebg">
<div id="HeaderTitle">Design Size List &gt; 
<?php echo  "<span class=\"HighLight\">".$_GET['Name']."</span>"; if (isset($_GET['Name'])) {echo " &gt; ";}?> 
<?php echo  "<span class=\"HighLight\">".$row_rs_Typetxt['MEDIA_TYPE']."</span>"; if (isset($row_rs_Typetxt['MEDIA_TYPE'])) {echo " &gt; ";}?> 
<?php echo  "<span class=\"HighLight\">".$row_rs_Sizetxt['MEDIA_SIZE']."</span>"; if (isset($row_rs_Sizetxt['MEDIA_SIZE'])) {echo " &gt; ";}?></div>
<form id="form1" name="form1" method="post" action="#">
<table border="0" cellpadding="8" cellspacing="0" class="form">
  <tr class="form_txt" style="text-align: center;">
    <td>No.</td>
    <td>Cost</td>
    <td>Qty</td>
    <td>Set QTY</td>
    <td>Weight</td>
    <td>Selected</td>
  </tr>

  <?php

	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_CQWList){
?>
  <tr class="roweffect">   
<td nowrap="nowrap" class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>. </td>
    <td align="left" nowrap="nowrap" class="form_txt">&pound;<?php echo $row_rs_CQWList['COST']; ?></td>
    <td align="center" nowrap="nowrap" class="form_txt"><label for="Selected"><?php echo $row_rs_CQWList['QTY']; ?></label></td>
    <td align="center" nowrap="nowrap" class="form_txt"><?php echo $row_rs_CQWList['LIMIT']; ?></td>
    <td align="center" nowrap="nowrap" class="form_txt"><?php echo $row_rs_CQWList['WEIGHT']; ?>Kg</td>
    <td align="center" nowrap="nowrap" class="form_txt">
      <input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_CQWList["ID"]; ?>" />
      <input <?php if (!(strcmp($row_rs_CQWList['SELECTED'],"Y"))) {echo "checked=\"checked\"";} ?> name="Selected_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" id="Selected_<?php echo $RepeatSelectionCounter_1; ?>" value="Y" />
<label for="Selected"></label>
    </td>
 </tr>   <?php

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
 <tr>
   <td colspan="6" style="text-align: right;"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
      <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','DesignSizeList.php?<?php echo $_SERVER['QUERY_STRING'];?>');return document.MM_returnValue" value="Cancel" /></td>
</tr>
</table></form>
</body>
</html>
<?php
mysql_free_result($rs_CQWList);

mysql_free_result($rs_CQWList);

mysql_free_result($rs_Sizetxt);

mysql_free_result($rs_Typetxt);
?>
