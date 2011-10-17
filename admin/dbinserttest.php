<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["button"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("A_SIZE_ID", "cost", "qty", "weight", "des_id", "DT_ID", "DS_ID", "Selected", "Limit");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_cost";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
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
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "5";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form id="form1" name="form1" method="POST">
<?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>
  <input type="hidden" name="A_SIZE_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="A_SIZE_ID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
  <input name="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="A_SIZE_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="1"/>
<input name="cost_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="cost_<?php echo $RepeatSelectionCounter_1; ?>" value="2" />
  <input name="qty_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="qty_<?php echo $RepeatSelectionCounter_1; ?>" value="3" />
  <input name="weight_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="weight_<?php echo $RepeatSelectionCounter_1; ?>" value="4" />
  <input name="des_id_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="des_id_<?php echo $RepeatSelectionCounter_1; ?>" value="5" />
  <input name="DT_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DT_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="6" />
  <input name="DS_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="DS_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="7" />
  <input name="Selected_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Selected_<?php echo $RepeatSelectionCounter_1; ?>" value="Y" />
  <input name="Limit_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Limit_<?php echo $RepeatSelectionCounter_1; ?>" value="8" />
<?php
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
<input type="submit" name="button" id="button" value="Submit" />
</form>
</body>
</html>