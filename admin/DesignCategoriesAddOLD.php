<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
require_once( "../Connections/GoCreate.php" );
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
require_once("../WA_DataAssist/WA_AppBuilder_PHP.php");
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
$query_rs_section = "SELECT gkprofiles.Section FROM gkprofiles GROUP BY gkprofiles.Section";
$rs_section = mysql_query($query_rs_section, $GoCreate) or die(mysql_error());
$row_rs_section = mysql_fetch_assoc($rs_section);
$totalRows_rs_section = mysql_num_rows($rs_section);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["InsertAll"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("CatName", "MENU_LEVEL_", "Visable", "Icon", "editorField_", "PPSection");
  $WA_connection = $GoCreate;
  $WA_table = "product_cats";
  $WA_redirectURL = "DesignCategoriesList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "TITLE_NAME|MENU_LEVEL|VISABLE|ICON|TEXTHEADER|SECTION";
  $WA_columnTypesStr = "',none,''|none,none,NULL|',none,''|',none,''|',none,''|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("CatName", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("MENU_LEVEL_", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Visable", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("Icon", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("editorField_", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("PPSection", $WA_multipleInsertCounter)  ."";
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

if("" == ""){
	$WA_cnt_loop_1302364941842 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1302364941842->BaseName);
	$WA_cnt_loop_1302364941842->Initialize(true);
}

if("" == ""){
	$WA_sitestats_1301303033310 = new WA_Include("sitestats.php");
	require($WA_sitestats_1301303033310->BaseName);
	$WA_sitestats_1301303033310->Initialize(true);
}
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "".$_POST['NewAdd']  ."";
?>
<?php
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = true;
	$RepeatSelectionCounter_2_Iterations = "".$_POST['NewAdd']  ."";
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
tday  =new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
d = new Date();
nday   = d.getDay();
nmonth = d.getMonth();
ndate  = d.getDate();
nyear = d.getYear();
nhour  = d.getHours();
nmin   = d.getMinutes();
nsec   = d.getSeconds();

if(nyear<1000) nyear=nyear+1900;

     if(nhour ==  0) {ap = " AM";nhour = 12;} 
else if(nhour <= 11) {ap = " AM";} 
else if(nhour == 12) {ap = " PM";} 
else if(nhour >= 13) {ap = " PM";nhour -= 12;}

if(nmin <= 9) {nmin = "0" +nmin;}
if(nsec <= 9) {nsec = "0" +nsec;}


document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
setTimeout("GetClock()", 1000);
}
window.onload=GetClock;


function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?><?php echo((isset($WA_sitestats_1301303033310))?$WA_sitestats_1301303033310->Head:"") ?>
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../webassist/kfm/filebrowse.js"></script>
<?php echo((isset($WA_catdropdown_1302357287822))?$WA_catdropdown_1302357287822->Head:"") ?><?php echo((isset($WA_cnt_loop_1302364941842))?$WA_cnt_loop_1302364941842->Head:"") ?><?php echo((isset($WA_catdropdown_1302525013889))?$WA_catdropdown_1302525013889->Head:"") ?>
</head>

<body class="GoCreateAdmin1_body_design">
<div class="GoCreateAdmin1">
  <!-- (CSSLayouts Begin)  #GoCreateAdmin1 #build_version=1.1.276;pack=User;category=My Page Layouts;layout=;layoutType=page;scheme=;cssSource=file;assets=;halign=center;minwidth=960px;maxwidth=1259px;width=80%;bc=My Page Layouts;bl=GoCreateAdmin-->
  <div style="padding-bottom: 15px; padding-top: 15px; position: relative;">
    
  </div>
  <div class='cssLO GoCreateAdmin1_wrapper_layout'>
    <div class='wrapper cssLI GoCreateAdmin1_wrapper_design'>
      <div class='cssLO GoCreateAdmin1_header_layout'>
        <div class='header cssLI GoCreateAdmin1_header_design'>
          <div class='cssLO GoCreateAdmin1_row_1_layout'>
            <div class='row_1 cssLI GoCreateAdmin1_row_1_design'>
              <!-- row_1 Content Starts Here -->
              <span style="left: 30px; top: 20px; position: relative; color: #FFF; font-size: 36px; font-family: Verdana, Geneva, sans-serif;">Go Create!</span> <span style="top: 20px; left: 50px; position: relative; color: #FFF; font-style: italic; font-size: 16px; font-family: Verdana, Geneva, sans-serif;">Site Admin</span> <span id="clockbox" style="color: #FFF; top: 15px; left: 575px; position: relative; font-size: 14px; font-family: Verdana, Geneva, sans-serif;"></span>
              <!-- row_1 Content Ends Here -->
              </div>
          </div>
          
          
          <div class='cssLO GoCreateAdmin1_row_2_layout'>
            <div class='row_2 cssLI GoCreateAdmin1_row_2_design'>
              <!-- row_2 Content Starts Here -->
              <?php echo((isset($WA_main_menu_1300386231410))?$WA_main_menu_1300386231410->Body:"") ?> <!-- row_2 Content Ends Here -->
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
			  <?php echo((isset($WA_sitestats_1301303033310))?$WA_sitestats_1301303033310->Body:"") ?> <!-- leftcolumn Content Ends Here -->
              </div>
          </div>
          <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
            <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
              <!-- centercolumn Content Starts Here -->
<div id="HeaderTitle">Design Category Add <span id="SubHeaderTitle">(icon size 232px wide)</span></div>

<form id="form1" name="form1" method="POST" action="">
  

<table border="0" cellpadding="4" cellspacing="4" class="form">
  <tr class="form_txt" style="text-align: center;">
    <td>No.</td>
    <td>Catergory Name</td>
    <td>Menu Path</td>
    <td>Text Header</td>
    <td>Section</td>
    <td>Icon</td>
    <td>Visable</td>
  </tr>
  <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_None){
?>
  <tr class="roweffect">
                    <td nowrap="nowrap" class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>. </td>
                    <td nowrap="nowrap" class="form_txt"><label for="CatName"></label>
                      <input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_DesCatUpdate["ID"]; ?>" />
                      <input name="CatName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="CatName_<?php echo $RepeatSelectionCounter_1; ?>" /></td>
                    <td nowrap="nowrap" class="form_txt"><?php
if("" == ""){
	$WA_catdropdown_1302452274499 = new WA_Include("GSNET_LIB/php/catdropdown.php?ID=".$row_rs_DesCatUpdate['ID']."&CAT=U");
	require($WA_catdropdown_1302452274499->BaseName);
	$WA_catdropdown_1302452274499->Initialize(true);
}
?>
                      <?php echo((isset($WA_catdropdown_1302452274499))?$WA_catdropdown_1302452274499->Body:"");?></td>
                    <td nowrap="nowrap" class="form_txt"><script language="javascript"> 
function toggle<?php echo $RepeatSelectionCounter_2; ?>() {
	var ele = document.getElementById("apDiv<?php echo $RepeatSelectionCounter_2; ?>");
	var text = document.getElementById("ViewEditor<?php echo $RepeatSelectionCounter_2; ?>");
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
                      <div id="apDiv<?php echo $RepeatSelectionCounter_1; ?>" style="position:absolute; width:600px; height:300px; z-index:1; left: 397px; top: 324px;display:none;"> <table width="120" border="0" align="center" cellpadding="0" cellspacing="0" class="form roweffect">
  <tr>
    <td align="center"><a href="javascript:toggle<?php echo $RepeatSelectionCounter_1; ?>();" id="ViewEditor<?php echo $RepeatSelectionCounter_1; ?>" >Close Editor</a></td>
  </tr>
</table>

                        <?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".$row_rs_DesCatUpdate['TEXTHEADER']  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "GoCreate_CatEdit";
$CKEditor_config["wa_preset_file"] = "GoCreateCatEdit.xml";
$CKEditor_config["width"] = "580px";
$CKEditor_config["height"] = "300px";
$CKEditor_config["skin"] = "kama";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&startup_folder=../images/CatImg";
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
                    <td nowrap="nowrap" class="form_txt"><label for="Cat_Section"></label>
                      <select name="Cat_Section_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="Cat_Section_<?php echo $RepeatSelectionCounter_1; ?>">
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_section['Section']?>"<?php if (!(strcmp($row_rs_section['Section'], "None Retail"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_section['Section']?></option>
                        <?php
} while ($row_rs_section = mysql_fetch_assoc($rs_section));
  $rows = mysql_num_rows($rs_section);
  if($rows > 0) {
      mysql_data_seek($rs_section, 0);
	  $row_rs_section = mysql_fetch_assoc($rs_section);
  }
?>
                      </select></td>
                    <td nowrap="nowrap" class="form_txt"><div class="htmleditor_upload">
                      <input type="text" value="" id="Icon_<?php echo $RepeatSelectionCounter_1; ?>" name="Icon_<?php echo $RepeatSelectionCounter_1; ?>" style="float:left;"/>
                      <div style="float:left;"><img src="../webassist/kfm/themes/webassist_v2/spacer.gif" id="htmleditor_image_<?php echo $RepeatSelectionCounter_1; ?>" align="top" /></div>
                    <img src="../webassist/kfm/themes/webassist_v2/icon_folder.png" width="20" height="18" id="htmleditor_browse_<?php echo $RepeatSelectionCounter_1; ?>" name="{dds:'../', startup_folder:'CatIcons', show_sidebar:true, width:600, height:400}" style="vertical-align:bottom; padding-bottom:2px; visibility: hidden;" /> </div></td>
                    <td nowrap="nowrap" class="form_txt"><label for="CatVis"></label>
                      <select name="CatVis_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="CatVis_<?php echo $RepeatSelectionCounter_1; ?>">
                        <option value="Yes" selected="selected">Yes</option>
                        <option value="No">No</option>
                      </select></td>
                  </tr>  
<?php

	} // RepeatSelectionCounter_2 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
<tr>
    <td colspan="7" style="text-align: right;">&nbsp;</td>
  </tr>
</table>

<div style="top: 10px; position: relative;">
  <table border="0" cellpadding="4" cellspacing="4" class="form">
    <tr class="form_txt">
      <td nowrap="nowrap">Add
        <label for="NewAdd"></label>
        <select name="NewAdd" class="form" id="NewAdd" onchange="this.form.submit();">
          <?php echo((isset($WA_cnt_loop_1302364941842))?$WA_cnt_loop_1302364941842->Body:"") ?>
          </select></td>
      <td align="center" nowrap="nowrap" class="leftborder"><input name="InsertAll" type="submit" class="cust_button" id="InsertAll" value="InsertAll" />
        <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','DesignCategoriesList.php');return document.MM_returnValue" value="Cancel" /></td>
      </tr>
  </table>
</div>
</form>
<!-- centercolumn Content Ends Here -->
              
</div>
          </div>
          <div class='cssLClearC'></div>
        </div>
      </div>
      
      
      <div class='cssLO GoCreateAdmin1_footer_layout'>
        <div class='footer cssLI GoCreateAdmin1_footer_design'>
          <!-- footer Content Starts Here -->
          <?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Body:"") ?> <!-- footer Content Ends Here -->
          </div>
      </div>
      <div class='cssLClearR'></div>
    </div>
  </div>
  <div class="cssLClearL"></div>
  <!-- #GoCreateAdmin1 (CSSLayouts End) -->
</div>
<span style="padding-top: 30px; margin-left: 45%; color: #FFF">Glass Spider Network - Web Solutions</span>
</body>
</html>
<?php
mysql_free_result($rs_section);
?>
