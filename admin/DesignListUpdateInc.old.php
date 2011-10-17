<?php require_once('../Connections/GoCreate.php'); ?>
<?php
//WA Database Search Include
require_once("../WADbSearch/HelperPHP.php");
?><?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rs_DesignUpdate;
//Searchpage: DesignListInc.php;
//Form: ListInc;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("ID","DS_ID","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_DesignListUpdateInc"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_DesignListUpdateInc"]) && $_SESSION["WADbSearch1_DesignListUpdateInc"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_DesignListUpdateInc"];
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
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
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
$query_rs_DesignUpdate = "SELECT * FROM designs";
setQueryBuilderSource($query_rs_DesignUpdate,$WADbSearch1,false);
$rs_DesignUpdate = mysql_query($query_rs_DesignUpdate, $GoCreate) or die(mysql_error());
$row_rs_DesignUpdate = mysql_fetch_assoc($rs_DesignUpdate);
$totalRows_rs_DesignUpdate = mysql_num_rows($rs_DesignUpdate);?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";

if("" == ""){
	$WA_catdropdown_1303554110864 = new WA_Include("GSNET_LIB/php/catdropdown.php?ID=".$row_rs_DesignUpdate['ID']  ."");
	require($WA_catdropdown_1303554110864->BaseName);
	$WA_catdropdown_1303554110864->Initialize(true);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo((isset($WA_catdropdown_1303484212303))?$WA_catdropdown_1303484212303->Head:"") ?><?php echo((isset($WA_catdropdown_1303554110864))?$WA_catdropdown_1303554110864->Head:"") ?>
</head>

<body>
<div id="HeaderTitle">Design List Update</div>
<form id="form1" name="form1" method="post" action="">
 
<table border="0" cellpadding="4" cellspacing="0" class="form">
  <tr class="form_txt">
    <th scope="col">No.
      </th>
    <th scope="col">Name</th>
    <th scope="col">Ref</th>
    <th scope="col">Catergory</th>
    <th scope="col">Description</th>
    <th scope="col">Amendments</th>
    <th scope="col">Multi-Pack</th>
    <th scope="col">Max Options</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_DesignUpdate){
?> 
  <tr class="roweffect">
    <td nowrap="nowrap" class="form_txt" scope="row"><?php echo $cnt+1; ?>.        </td>
    <td nowrap="nowrap" class="form_txt" scope="row"><label for="Dname"></label>
      <input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_DesignUpdate["ID"]; ?>" />
      <input name="Dname_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="Dname_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_DesignUpdate['DESIGN_NAME']; ?>" /></td>
    <td nowrap="nowrap" class="form_txt" scope="row"><label for="DRef"></label>
      <input name="DRef_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="DRef_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_DesignUpdate['DESIGN_REF']; ?>" /></td>
    <td nowrap="nowrap" class="form_txt" scope="row"><label for="MENU_LEVEL_"></label><?php echo((isset($WA_catdropdown_1303554110864))?$WA_catdropdown_1303554110864->Body:"") ?></td>
    <td nowrap="nowrap" class="form_txt">
      <script language="javascript"> 
function toggle<?php echo $RepeatSelectionCounter_1; ?>() {
	var ele = document.getElementById("apDiv<?php echo $RepeatSelectionCounter_1; ?>");
	var text = document.getElementById("ViewEditor<?php echo $RepeatSelectionCounter_1; ?>");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Open Editor";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Close Editor";
	}
} 
   </script>
      <a href="javascript:toggle<?php echo $RepeatSelectionCounter_1; ?>();" id="ViewEditor<?php echo $RepeatSelectionCounter_1; ?>">Open Editor</a>
      <div id="apDiv<?php echo $RepeatSelectionCounter_1; ?>" style="position:absolute; width:600px; height:300px; z-index:1; left: 10px; top: 100px;display:none;">
      <table width="120" border="0" align="center" cellpadding="0" cellspacing="0" class="form roweffect">
        <tr>
          <td align="center"><a href="javascript:toggle<?php echo $RepeatSelectionCounter_1; ?>();" id="ViewEditor<?php echo $RepeatSelectionCounter_1; ?>" >Close Editor</a></td>
        </tr>
      </table>
      <label for="editorField"></label>
      <?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".$row_rs_DesignUpdate['BREF_DESCIP']  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "GoCreate_DesEdit";
$CKEditor_config["wa_preset_file"] = "GoCreateDesEdit.xml";
$CKEditor_config["width"] = "580px";
$CKEditor_config["height"] = "300px";
$CKEditor_config["skin"] = "kama";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&startup_folder=../images/designs";
$CKEditor_config["toolbar"] = array(
array( 'Source','-','Preview','-','Templates'),
array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'),
array( 'Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
array( 'Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'TextColor','BGColor'),
array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
array( 'Styles','Format','Font','FontSize'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("editorField_".$RepeatSelectionCounter_1  ."", $CKEditor_initialValue, $CKEditor_config);
?>
      </div></td>
    <td nowrap="nowrap" class="form_txt" scope="row"><label for="Damend"></label>
      <select name="Damend_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="Damend_<?php echo $RepeatSelectionCounter_1; ?>">
        <option value="Y" <?php if (!(strcmp("Y", $row_rs_DesignUpdate['AMENDMENTS_ALLOWED']))) {echo "selected=\"selected\"";} ?>
      >Yes
      </option>
      <option value="N" <?php if (!(strcmp("N", $row_rs_DesignUpdate['AMENDMENTS_ALLOWED']))) {echo "selected=\"selected\"";} ?>>No</option>
      </select></td>
    <td nowrap="nowrap" class="form_txt" scope="row"><label for="Dmulti"></label>
      <select name="Dmulti_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="Dmulti_<?php echo $RepeatSelectionCounter_1; ?>">
        <option value="Y" <?php if (!(strcmp("Y", $row_rs_DesignUpdate['MULTI_PACK']))) {echo "selected=\"selected\"";} ?>>Yes</option>
        <option value="N" <?php if (!(strcmp("N", $row_rs_DesignUpdate['MULTI_PACK']))) {echo "selected=\"selected\"";} ?>>No</option>
      </select></td>
<td nowrap="nowrap" class="form_txt" scope="row"><label for="COptions"></label>
      <select name="COptions_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="COptions_<?php echo $RepeatSelectionCounter_1; ?>">
        <option value="0" <?php if (!(strcmp(0, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>No Limit</option>
        <option value="1" <?php if (!(strcmp(1, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>1</option>
        <option value="2" <?php if (!(strcmp(2, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>2</option>
        <option value="3" <?php if (!(strcmp(3, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>3</option>
        <option value="4" <?php if (!(strcmp(4, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>4</option>
        <option value="5" <?php if (!(strcmp(5, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>5</option>
        <option value="6" <?php if (!(strcmp(6, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>6</option>
        <option value="7" <?php if (!(strcmp(7, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>7</option>
        <option value="8" <?php if (!(strcmp(8, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>8</option>
        <option value="9" <?php if (!(strcmp(9, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>9</option>
        <option value="10" <?php if (!(strcmp(10, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>10</option>
        <option value="11" <?php if (!(strcmp(11, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>11</option>
        <option value="12" <?php if (!(strcmp(12, $row_rs_DesignUpdate['OPTIONS']))) {echo "selected=\"selected\"";} ?>>12</option>
    </select></td>
  </tr>
 <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_DesignUpdate && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_DesignUpdate = mysql_fetch_assoc($rs_DesignUpdate);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?> 
  <tr>
    <th class="topborder form_txt" scope="row"></th>
    <th colspan="7" align="left" scope="row" class="topborder"><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
      <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','DesignList.php');return document.MM_returnValue" value="Cancel" /></th>
  </tr>
</table>

</form>
</body>
</html>
<?php
mysql_free_result($rs_DesignUpdate);
?>
