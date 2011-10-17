<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
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
$query_rs_DB_DesignCatList = "SELECT * FROM product_cats ORDER BY TITLE_NAME ASC";
$rs_DB_DesignCatList = mysql_query($query_rs_DB_DesignCatList, $GoCreate) or die(mysql_error());
$row_rs_DB_DesignCatList = mysql_fetch_assoc($rs_DB_DesignCatList);
$totalRows_rs_DB_DesignCatList = mysql_num_rows($rs_DB_DesignCatList);

// WA DataAssist Multiple Inserts
if (isset($_POST["AddAll"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("DB_Title", "D_Image", "DB_Link");
  $WA_connection = $GoCreate;
  $WA_table = "dashboard";
  $WA_redirectURL = "dashboard_list.php";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "IMG_TITLE|IMG_FILE|LINK";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''";
  $WA_insertIfNotBlank = "DB_Title";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("DB_Title", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("D_Image", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("DB_Link", $WA_multipleInsertCounter)  ."";
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
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "".$_POST['NewAdd']  ."";
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
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?>
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
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
              <span style="left: 30px; top: 20px; position: relative; color: #FFF; font-size: 36px; font-family: Verdana, Geneva, sans-serif;">Go Create!</span> <span style="top: 20px; left: 50px; position: relative; color: #FFF; font-style: italic; font-size: 16px; font-family: Verdana, Geneva, sans-serif;">Site Admin</span> <span id="clockbox" style="color: #FFF; top: 15px; left: 575px; position: relative; font-size: 14px; font-family: Verdana, Geneva, sans-serif;"></span>
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
              <span style="top: 15px; position: relative; padding: 15px; color: #FFF; font-weight: bold; font-size: 16px; font-family: Verdana, Geneva, sans-serif;">Insert Dashboard Items</span> <span style="color: #FFF; font-weight: bold; font-size: 10px; font-family: Verdana, Geneva, sans-serif; top: 15px; position: relative; padding: 15px;">(recommend a limit of 3)</span>
              <form action="" method="post" enctype="multipart/form-data" name="D_InsertForm" style="top: 15px; position: relative; padding: 15px;">
                <table border="0" cellpadding="3" cellspacing="3" class="form">
                  <tr>
                    <td><span class="form_txt">No.</span></td>
                    <td><span class="form_txt" style="left: 10px; position: relative;">Title</span></td>
                    <td><span class="form_txt" style="left: 10px; position: relative;">Link</span></td>
                    <td><span class="form_txt" style="position: relative; padding-left: 10px;">Image</span>
                      </td>
                  </tr>
                 <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?> <tr>
                    
<td><span class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?></span></td>
                    <td><input type="hidden" name="DB_Title_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="DB_Title_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
                    <input name="DB_Title_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="DB_Title_<?php echo $RepeatSelectionCounter_1; ?>" size="35" /></td>
                    <td><select name="DB_Link_<?php echo $RepeatSelectionCounter_1; ?>" class="form" id="DB_Link_<?php echo $RepeatSelectionCounter_1; ?>">
                      <option value="">\/ Select \/</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_rs_DB_DesignCatList['ID']?>"><?php echo $row_rs_DB_DesignCatList['TITLE_NAME']?></option>
<?php
} while ($row_rs_DB_DesignCatList = mysql_fetch_assoc($rs_DB_DesignCatList));
  $rows = mysql_num_rows($rs_DB_DesignCatList);
  if($rows > 0) {
      mysql_data_seek($rs_DB_DesignCatList, 0);
	  $row_rs_DB_DesignCatList = mysql_fetch_assoc($rs_DB_DesignCatList);
  }
?>
                    </select></td>
                    <td><div class="htmleditor_upload">
                      <input type="text" value="" id="D_Image_<?php echo $RepeatSelectionCounter_1; ?>" name="D_Image_<?php echo $RepeatSelectionCounter_1; ?>" readonly style="float:left;"/>
                      <div style="float:left;"><img src="../webassist/kfm/themes/webassist_v2/spacer.gif" id="htmleditor_image_<?php echo $RepeatSelectionCounter_1; ?>" align="top" /></div>
                    <img src="../webassist/kfm/themes/webassist_v2/icon_folder.png" width="20" height="18" id="htmleditor_browse_<?php echo $RepeatSelectionCounter_1; ?>" name="{dds:'../', startup_folder:'', show_sidebar:true, width:600, height:400}" style="vertical-align:bottom; padding-bottom:2px; visibility: hidden;" /> </div></td>
                   
                  </tr> <?php
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
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="AddAll" type="submit" class="cust_button" id="AddAll" value="AddAll" />
                    <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','dashboard_list.php');return document.MM_returnValue" value="Cancel" /></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
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
          <?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Body:"") ?>
          <!-- footer Content Ends Here -->
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
mysql_free_result($rs_DB_DesignCatList);
?>
