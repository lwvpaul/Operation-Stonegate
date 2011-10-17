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

$colname_rs_typeadmin = "-1";
if (isset($_GET['DES_ID'])) {
  $colname_rs_typeadmin = (get_magic_quotes_gpc()) ? $_GET['DES_ID'] : addslashes($_GET['DES_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_typeadmin = sprintf("SELECT admin_media_type.ID, admin_media_type.MEDIA_TYPE, admin_media_type.VAT_RATING, des_res_type.ID AS DT_ID, des_res_type.DESIGN_ID, des_res_type.TYPE, des_res_type.IMG, des_res_type.SELECTED FROM admin_media_type INNER JOIN des_res_type ON des_res_type.TYPE = admin_media_type.ID WHERE DESIGN_ID = %s", GetSQLValueString($colname_rs_typeadmin, "int"));
$rs_typeadmin = mysql_query($query_rs_typeadmin, $GoCreate) or die(mysql_error());
$row_rs_typeadmin = mysql_fetch_assoc($rs_typeadmin);
$totalRows_rs_typeadmin = mysql_num_rows($rs_typeadmin);?>
<?php
// WA DataAssist Multiple Updates
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{

	
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "des_res_type";
  $WA_redirectURL = "DesignTypeEdit.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "IMG|SELECTED";
  $WA_columnTypesStr = "',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("DT_Image", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("DT_select", $WA_multipleUpdateCounter)  ."";
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
<script type="text/javascript" src="../webassist/kfm/filebrowse.js"></script>
</head>
<body class="pagebg">
<div id="HeaderTitle"> Design Type Select for <?php echo  "<span class=\"HighLight\">".$_GET['Name']."</span>";?></div>
<form id="form1" name="form1" method="post" action="#">
  
<table border="0" cellpadding="4" cellspacing="0" class="form">
  <tr class="form_txt" style="text-align: center;">
    <td>No.</td>
    <td>Type</td>
    <td>Image</td>
    <td>&nbsp;</td>
    <td>Selected</td>
    <td>Options</td>
  </tr>
 <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_typeadmin){
?>
<tr class="roweffect">
    <td nowrap="nowrap" class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>. </td>
    <td align="left" nowrap="nowrap" class="form_txt"><?php echo $row_rs_typeadmin['MEDIA_TYPE']; ?>
      <input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_typeadmin['DT_ID']; ?>" /></td>
    <td valign="middle" nowrap="nowrap" class="form_txt">
<?php if ($row_rs_typeadmin['SELECTED']=="Y") {?>
<div class="htmleditor_upload">
  <input type="text" value="<?php if ($row_rs_typeadmin['SELECTED']=="Y") {echo $row_rs_typeadmin['IMG'];} else { ""; }?>" id="DT_Image_<?php echo $RepeatSelectionCounter_1; ?>" name="DT_Image_<?php echo $RepeatSelectionCounter_1; ?>" readonly style="float:left;"/>
  <div style="float:left;"><img src="../webassist/kfm/themes/webassist_v2/spacer.gif" id="htmleditor_image_<?php echo $RepeatSelectionCounter_1; ?>" align="top" /></div>
  <img src="../webassist/kfm/themes/webassist_v2/icon_folder.png" width="20" height="18" id="htmleditor_browse_<?php echo $RepeatSelectionCounter_1; ?>" name="{dds:'../', startup_folder:'Designs', show_sidebar:true, width:600, height:400}" style="vertical-align:bottom; padding-bottom:2px; visibility: hidden;" /> </div><?php } ?>
</td>
    <td align="right" nowrap="nowrap" class="form_txt"><?php if ($row_rs_typeadmin['IMG']&&$row_rs_typeadmin['SELECTED']=="Y") {?>View<?php } ?></td>
    <td align="center" nowrap="nowrap" class="form_txt"><label for="DT_select"></label><input <?php if (!(strcmp($row_rs_typeadmin['SELECTED'],"Y"))) {echo "checked=\"checked\"";} ?> name="DT_select_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" id="DT_select_<?php echo $RepeatSelectionCounter_1; ?>" value="Y" /></td>
    <td align="center" nowrap="nowrap" class="form_txt">
<?php if ($row_rs_typeadmin['SELECTED']=="Y") {?>
<input name="Sizes_<?php echo $RepeatSelectionCounter_1; ?>" type="button" class="cust_button" id="Sizes_<?php echo $RepeatSelectionCounter_1; ?>" onclick="MM_goToURL('parent','DesignAutoCQW.php?DT_ID=<?php echo $row_rs_typeadmin['DT_ID']; ?>&amp;A_DT_ID=<?php echo $row_rs_typeadmin['ID']; ?>&amp;DES_ID=<?php echo $_GET['DES_ID'];?>&Name=<?php echo $_GET['Name'];?>');return document.MM_returnValue" value="Sizes" />
<?php } ?>
</td>
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
    <td colspan="6" style="text-align: right;"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
      <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','DesignList.php?<?php echo $_SERVER['QUERY_STRING'];?>');return document.MM_returnValue" value="Cancel" /></td>
  </tr>
</table>

</form>
</body>
</html>
<?php
mysql_free_result($rs_typeadmin);
?>
