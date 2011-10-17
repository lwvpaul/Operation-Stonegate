<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
//WA Database Search Include
require_once("../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rs_catList;
//Searchpage: DesignCategoriesList.php;
//Form: form1;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("ID","C_ID","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_DesignCategoriesUpdateInc"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_DesignCategoriesUpdateInc"]) && $_SESSION["WADbSearch1_DesignCategoriesUpdateInc"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_DesignCategoriesUpdateInc"];
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
//$query_rs_SectionOptions = "SELECT gkprofiles.Section FROM gkprofiles GROUP BY gkprofiles.Section ";
$query_rs_SectionOptions = "SELECT * FROM product_cats GROUP BY SECTION";
$rs_SectionOptions = mysql_query($query_rs_SectionOptions, $GoCreate) or die(mysql_error());
$row_rs_SectionOptions = mysql_fetch_assoc($rs_SectionOptions);
$totalRows_rs_SectionOptions = mysql_num_rows($rs_SectionOptions);

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_catList = "SELECT * FROM product_cats";
setQueryBuilderSource($query_rs_catList,$WADbSearch1,false);
$rs_catList = mysql_query($query_rs_catList, $GoCreate) or die(mysql_error());
$row_rs_catList = mysql_fetch_assoc($rs_catList);
$totalRows_rs_catList = mysql_num_rows($rs_catList);?>
<?php
// WA DataAssist Multiple Updates
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "product_cats";
  $WA_redirectURL = "DesignCategoriesList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "TITLE_NAME|MENU_LEVEL|VISABLE|ICON|TEXTHEADER|SECTION";
  $WA_columnTypesStr = "',none,''|none,none,NULL|',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("CatName", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("MENU_LEVEL_", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("CatVis", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Icon", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("editorField_", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("CatSection", $WA_multipleUpdateCounter)  ."";
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

if("" == ""){
	$WA_cnt_loop_1306163184647 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=15");
	require($WA_cnt_loop_1306163184647->BaseName);
	$WA_cnt_loop_1306163184647->Initialize(true);
}

if("" == ""){
	$WA_footer_1308920822796 = new WA_Include("footer.php");
	require($WA_footer_1308920822796->BaseName);
	$WA_footer_1308920822796->Initialize(true);
}


?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../webassist/kfm/filebrowse.js"></script>
<?php echo((isset($WA_cnt_loop_1306163184647))?$WA_cnt_loop_1306163184647->Head:"") ?><?php echo((isset($WA_catdropdown_1306166337432))?$WA_catdropdown_1306166337432->Head:"") ?><?php echo((isset($WA_footer_1308920822796))?$WA_footer_1308920822796->Head:"") ?>
</head>

<body class="pagebg" >
<p id="HeaderTitle">Design Category Update <span id="SubHeaderTitle">(icon size 232px wide)</span>
</p>
<form id="form1" name="form1" method="post" action="#">
<table border="0" cellspacing="4" class="form">
  <tr class="form_txt">
    <th scope="col">No.</th>
    <th scope="col">Category Name</th>
    <th scope="col">Menu Path</th>
    <th scope="col"><table cellspacing="0" cellpadding="0">
      <tr>
        <td>Text Header</td>
        <td></td>
      </tr>
    </table></th>
    <th scope="col">Section</th>
    <th scope="col">Icon</th>
    <th scope="col">Visable</th>
  </tr>
<?php $offset=113;?>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_catList){
?><tr class="form_txt">
<th scope="row"><span class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?></span></th>
  <td><span class="form_txt">
    <input type="hidden" name="CatName_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="CatName_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
    <input name="CatName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="CatName_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_catList['TITLE_NAME']; ?>" />
  </span></td>
  <td><span class="form_txt">
    <input type="hidden" name="MENU_LEVEL_<?php echo $RepeatSelectionCounter_1; ?>" id="MENU_LEVEL_<?php echo $RepeatSelectionCounter_1; ?>" />
    <?php 
if("" == ""){
	$WA_catdropdown_1306166337432 = new WA_Include("GSNET_LIB/php/catdropdown.php?CAT=I");
	require($WA_catdropdown_1306166337432->BaseName);
	$WA_catdropdown_1306166337432->Initialize(true);
}
?>
    <?php echo((isset($WA_catdropdown_1306166337432))?$WA_catdropdown_1306166337432->Body:"") ?> </span></td>
  <td><script language="javascript"> 
function toggle<?php echo $RepeatSelectionCounter_1; ?>() {
	var ele = document.getElementById("apDiv<?php echo $RepeatSelectionCounter_1; ?>");
	var text = document.getElementById("ViewEditor<?php echo $RepeatSelectionCounter_1; ?>");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Open Editor <?php echo $RepeatSelectionCounter_1+1; ?>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Close Editor <?php echo $RepeatSelectionCounter_1+1; ?>";
	}
} 
  </script>
    <a href="javascript:toggle<?php echo $RepeatSelectionCounter_1; ?>();" id="ViewEditor<?php echo $RepeatSelectionCounter_1; ?>">Open Editor <?php echo $RepeatSelectionCounter_1+1; ?></a>
    <div id="apDiv<?php echo $RepeatSelectionCounter_1; ?>" style="position:absolute; width:600px; height:120px; z-index:1; left: 47px; top: <?php echo $offset;?>px;display:none;">
    <table width="120" border="0" align="center" cellpadding="0" cellspacing="0" class="form roweffect">
      <tr>
        <td align="center"><a href="javascript:toggle<?php echo $RepeatSelectionCounter_1; ?>();" id="ViewEditor<?php echo $RepeatSelectionCounter_1; ?>" >Close Editor <?php echo $RepeatSelectionCounter_1+1; ?></a></td>
      </tr>
    </table>
    <input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_catList["ID"]; ?>" />
    <?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "GoCreat_Admin_Categories";
$CKEditor_config["wa_preset_file"] = "GoCreatAdminCategories.xml";
$CKEditor_config["width"] = "580px";
$CKEditor_config["height"] = "100px";
$CKEditor_config["skin"] = "kama";
$CKEditor_config["uiColor"] = "#004923";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["toolbar"] = array(
array( 'Source','-','Preview','-','Templates'),
array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'),
array( 'Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
('/'),
array( 'Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'SpecialChar'),
('/'),
array( 'Styles','Format','Font','FontSize'),
array( 'Maximize','ShowBlocks'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("editorField_".$RepeatSelectionCounter_1  ."", $CKEditor_initialValue, $CKEditor_config);
?>
    </div></td>
  <td>
    <span class="form_txt">
          
        <select name="CatSection_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="CatSection_<?php echo $RepeatSelectionCounter_1; ?>">
        <?php
        do {  
        ?>
        <option value="<?php echo $row_rs_SectionOptions['SECTION']?>"<?php if (!(strcmp($row_rs_SectionOptions['SECTION'], $row_rs_catList['SECTION']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_SectionOptions['SECTION']?></option>
        <?php
        } while ($row_rs_SectionOptions = mysql_fetch_assoc($rs_SectionOptions));
        $rows = mysql_num_rows($rs_SectionOptions);
        if($rows > 0) {
            mysql_data_seek($rs_SectionOptions, 0);
            $row_rs_SectionOptions = mysql_fetch_assoc($rs_SectionOptions);
        }        
        ?>
        </select>
          
    </span>
  </td>
<td><div class="htmleditor_upload">
    <input name="Icon_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="Icon_<?php echo $RepeatSelectionCounter_1; ?>" style="float:left;" value="<?php echo $row_rs_catList['ICON']; ?>" readonly/>
    <div style="float:left;"><img src="../webassist/kfm/themes/webassist_v2/spacer.gif" id="htmleditor_image_1" align="top" /></div>
    <img src="../webassist/kfm/themes/webassist_v2/icon_folder.png" width="20" height="18" id="htmleditor_browse_1" name="{dds:'../', startup_folder:'CatIcons', show_sidebar:true, width:600, height:400}" style="vertical-align:bottom; padding-bottom:2px; visibility: hidden;" /></div></td>
  <td><span class="form_txt">
    <select name="CatVis_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="CatVis_<?php echo $RepeatSelectionCounter_1; ?>">
      <option value="Y">Yes</option>
      <option value="N">No</option>
    </select>
  </span></td></tr>
<?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_catList && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_catList = mysql_fetch_assoc($rs_catList);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
<tr class="form_txt">
  <th scope="row">&nbsp;</th>
  <td colspan="3"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
    <input name="Cancel" type="submit" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','DesignCategoriesList.php');return document.MM_returnValue" value="Cancel" /></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php $offset = $offset+28;?>
</table>
<div style="top: 10px; position: relative;"></div>
</form>
<?php echo((isset($WA_footer_1308920822796))?$WA_footer_1308920822796->Body:"") ?></body>
</html>
<?php

mysql_free_result($rs_SectionOptions);

mysql_free_result($rs_catList);
?>
