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
//Recordset: rs_db_update;
//Searchpage: dashboard_list.php;
//Form: form1;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("ID","DI_ID","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_dashboard_update"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_dashboard_update"]) && $_SESSION["WADbSearch1_dashboard_update"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_dashboard_update"];
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
$query_rs_db_update = "SELECT * FROM dashboard";
$rs_db_update = mysql_query($query_rs_db_update, $GoCreate) or die(mysql_error());
$row_rs_db_update = mysql_fetch_assoc($rs_db_update);
$totalRows_rs_db_update = mysql_num_rows($rs_db_update);

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_DivList = "SELECT * FROM gk_division";
$rs_DivList = mysql_query($query_rs_DivList, $GoCreate) or die(mysql_error());
$row_rs_DivList = mysql_fetch_assoc($rs_DivList);
$totalRows_rs_DivList = mysql_num_rows($rs_DivList);


mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_CatList = "SELECT * FROM product_cats";
$rs_CatList = mysql_query($query_rs_CatList, $GoCreate) or die(mysql_error());
$row_rs_CatList = mysql_fetch_assoc($rs_CatList);
$totalRows_rs_CatList = mysql_num_rows($rs_CatList);?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["DB_Update"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "dashboard";
  $WA_redirectURL = "dashboard_list.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "IMG_TITLE|IMG_FILE|LINK|division_id";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("db_title_up", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("db_image_up", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("db_link_up", $WA_multipleUpdateCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("db_division_up", $WA_multipleUpdateCounter) ."";
    $WA_fieldValues = explode("|", $WA_fieldValuesStr);
    $WA_where_fieldValuesStr = WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleUpdateCounter);
    $WA_where_columnTypesStr = "none,none,NULL,none";
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
	$WA_main_menu_1300386231410 = new WA_Include("main_menu.php");
	require($WA_main_menu_1300386231410->BaseName);
	$WA_main_menu_1300386231410->Initialize(true);
}

if("" == ""){
	$WA_footer_1300717372941 = new WA_Include("footer.php");
	require($WA_footer_1300717372941->BaseName);
	$WA_footer_1300717372941->Initialize(true);
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
<title>GoCreate Dashboard</title>
<link href="../includes/CSSLayouts/CSSLayouts.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/CSSLayouts/debug_plus.js"></script>
<link href="../includes/CSSLayouts/GoCreateAdmin1.css" rel="stylesheet" type="text/css" />
<link href="../includes/CSSLayouts/GoCreateAdmin1_user.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_main_menu_1300386231410))?$WA_main_menu_1300386231410->Head:"") ?>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?>
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../webassist/kfm/filebrowse.js"></script>
</head>

<body class="GoCreateAdmin1_body_design">
<div class="GoCreateAdmin1">
  <!-- (CSSLayouts Begin)  #GoCreateAdmin1 #build_version=1.1.276;pack=User;category=My Page Layouts;layout=;layoutType=page;scheme=;cssSource=file;assets=;halign=center;minwidth=960px;maxwidth=1259px;width=80%;bc=My Page Layouts;bl=GoCreateAdmin-->
  <div class='cssLO GoCreateAdmin1_wrapper_layout'>
    <div class='wrapper cssLI GoCreateAdmin1_wrapper_design'>
      <div class='cssLO GoCreateAdmin1_header_layout'>
        <div class='header cssLI GoCreateAdmin1_header_design'>
          <div class='cssLO GoCreateAdmin1_row_1_layout'>
            <div class='row_1 cssLI GoCreateAdmin1_row_1_design'>
              <!-- row_1 Content Starts Here -->
                            <span style="left: 30px; top: 20px; position: relative; color: #000; font-size: 36px;">Stonegate Admin</span>
<!-- row_1 Content Ends Here -->
              </div>
          </div>
          <div class='cssLO GoCreateAdmin1_row_2_layout'>
            <div class='row_2 cssLI GoCreateAdmin1_row_2_design'>
              <!-- row_2 Content Starts Here -->
              <?php echo((isset($WA_main_menu_1300386231410))?$WA_main_menu_1300386231410->Body:"") ?>
<!-- row_2 Content Ends Here -->
              </div>
          </div>
          <div class='cssLClearR'></div>
        </div>
      </div>
      <div class='cssLO GoCreateAdmin1_content_layout'>
        <div class='content cssLI GoCreateAdmin1_content_design'>
          <div class='cssLO GoCreateAdmin1_leftcolumn_layout'>
            <div class='leftcolumn cssLI GoCreateAdmin1_leftcolumn_design'>
              <!-- leftcolumn Content Starts Here -->
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <!-- leftcolumn Content Ends Here -->
              </div>
          </div>
          <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
            <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
              <!-- centercolumn Content Starts Here -->
              <div style="top: 15px; left: 10px; position: relative; font-weight: bold; font-size: 16px; ">Update Selected Dashboard Items</div>
              <div style="top: 25px; left: 5px; float:left;">
	<form action="" method="post" enctype="multipart/form-data" name="DashboardUD"><br />
<table border="0" cellpadding="3" cellspacing="3" class="form">
  <tr>
    <td><span class="form_txt">No.</span></td>
    <td><span class="form_txt">Title</span></td>
    <td><span class="form_txt">Link</span></td>
    <td><span class="form_txt">Image</span></td>
    <td><span class="form_txt">Division</span></td>
  </tr>
 



  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_db_update){
?> 
<tr class="roweffect">
   
  <td>No.<?php echo $RepeatSelectionCounter_1+1; ?></td>
  <td><input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_db_update["ID"]; ?>" />
    <input name="db_title_up_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="db_title_up_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_db_update['IMG_TITLE']; ?>" /></td>
  <td><select name="db_link_up_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="db_link_up_<?php echo $RepeatSelectionCounter_1; ?>">
    <?php
do {  
?>
    <option value="<?php echo $row_rs_CatList['ID']?>"<?php if (!(strcmp($row_rs_CatList['ID'], $row_rs_db_update['LINK']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_CatList['TITLE_NAME']?></option>
    <?php
} while ($row_rs_CatList = mysql_fetch_assoc($rs_CatList));
  $rows = mysql_num_rows($rs_CatList);
  if($rows > 0) {
      mysql_data_seek($rs_CatList, 0);
	  $row_rs_CatList = mysql_fetch_assoc($rs_CatList);
  }
?>
  </select></td>
  <td><div class="htmleditor_upload">
    <input type="text" value="<?php echo $row_rs_db_update['IMG_FILE']; ?>" id="db_image_up_<?php echo $RepeatSelectionCounter_1; ?>" name="db_image_up_<?php echo $RepeatSelectionCounter_1; ?>" readonly style="float:left;"/>
    <div style="float:left;"><img src="../webassist/kfm/themes/webassist_v2/spacer.gif" id="htmleditor_image_<?php echo $RepeatSelectionCounter_1; ?>" align="top" /></div>
    <img src="../webassist/kfm/themes/webassist_v2/icon_folder.png" width="20" height="18" id="htmleditor_browse_<?php echo $RepeatSelectionCounter_1; ?>" name="{dds:'../', startup_folder:'', show_sidebar:true, width:600, height:400}" style="vertical-align:bottom; padding-bottom:2px; visibility: hidden;" /></div></td>
    <td>

<select name="db_division_up_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="db_division_up_<?php echo $RepeatSelectionCounter_1; ?>">
<?php      do  {      ?>

  <option value="<?php if (isset($row_rs_DivList['id'])) { echo $row_rs_DivList['id']; } ?>" 
  <?php 

if (isset($row_rs_DivList['id']) && $row_rs_DivList['id'] == $row_rs_db_update['division_id']) {
  echo 'selected="selected"';
}

  ?>><?php if (isset($row_rs_DivList['name'])) { echo $row_rs_DivList['name']; } ?></option>

<?php } while ($row_rs_DivList = mysql_fetch_assoc($rs_DivList)); ?>
<?php
$rows = mysql_num_rows($rs_DivList);
  if($rows > 0) {
      mysql_data_seek($rs_DivList, 0);
    $row_rs_DivList = mysql_fetch_assoc($rs_DivList);
  }
?>

</select></td>
 </tr> <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_db_update && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_db_update = mysql_fetch_assoc($rs_db_update);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>


<tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="DB_Update" type="submit" class="cust_button" id="DB_Update" value="Update" />
      <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','dashboard_list.php');return document.MM_returnValue" value="Cancel" /></td>
    </tr>





</table>

	</form>
 </div>
              <span style="clear:both;"></span></div>
          </div>
          <div class='cssLClearC'></div>
        </div>
      </div>

          <!-- footer Content Starts Here -->
          <?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Body:"") ?>
          <!-- footer Content Ends Here -->

      <div class='cssLClearR'></div>
    </div>
  </div>
  <div class="cssLClearL"></div>
  <!-- #GoCreateAdmin1 (CSSLayouts End) -->
</div>

</body>
</html>
<?php
mysql_free_result($rs_db_update);
mysql_free_result($rs_DivList);
mysql_free_result($rs_CatList);

?>
