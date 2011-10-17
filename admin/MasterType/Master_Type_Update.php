<?php require_once('../../Connections/GoCreate.php'); ?>
<?php require_once("../../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
//WA Database Search Include
require_once("../../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rs_update;
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
    $_SESSION["WADbSearch1_Master_Type_Update"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_Master_Type_Update"]) && $_SESSION["WADbSearch1_Master_Type_Update"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_Master_Type_Update"];
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
$query_rs_update = "SELECT * FROM admin_media_type";
setQueryBuilderSource($query_rs_update,$WADbSearch1,false);
$rs_update = mysql_query($query_rs_update, $GoCreate) or die(mysql_error());
$row_rs_update = mysql_fetch_assoc($rs_update);
$totalRows_rs_update = mysql_num_rows($rs_update);?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["Update"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "admin_media_type";
  $WA_redirectURL = "../MasterTyList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "VAT_RATING";
  $WA_columnTypesStr = "',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("VATRated", $WA_multipleUpdateCounter)  ."";
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
<link href="../css/page.css" rel="stylesheet" type="text/css" />
<link href="../css/forms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body style="background-color: #004923;">
<div id="HeaderTitle">Master Media Type Update
</div>
<form action="../MasterTyUpdate.php" method="post">
<table border="0" cellpadding="4" cellspacing="4" class="form" nowrap="nowrap" style="left: 15px; position: relative;" >
  <tr class="form_txt" >
    <td>No.</td>
    <td style="left: 5px; position: relative;">Media Type</td>
    <td>VAT Rated</td>
  </tr>
  
   <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_update){
?>  
  <tr class="roweffect">
 
    <td align="center" class="form_txt"><input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_update["ID"]; ?>" />
      <input name="MT_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="MT_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_update['ID']; ?>" />
<?php echo $RepeatSelectionCounter_1+1; ?></td>
    <td><input name="mediatype_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="mediatype_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_update['MEDIA_TYPE']; ?>" size="35" disabled="disabled"/></td>
    <td align="center"><input <?php if (!(strcmp($row_rs_update['VAT_RATING'],"Y"))) {echo "checked=\"checked\"";} ?> name="VATRated_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" class="form" id="VATRated_<?php echo $RepeatSelectionCounter_1; ?>" value="Y" /></td>
    
  </tr><?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
    <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_update && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_update = mysql_fetch_assoc($rs_update);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
  
  
  
  
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
      <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','MasterTyList.php');return document.MM_returnValue" value="Cancel" /></td>
    </tr>
</table>

</form>
</body>
</html>
<?php
mysql_free_result($rs_update);
?>
