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
//Recordset: rs_MediaSizeUpdate;
//Searchpage: MasterSizeList.php;
//Form: form1;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromList("ID","SZ_ID","AND","=",1);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_MasterSizeUpdate"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_MasterSizeUpdate"]) && $_SESSION["WADbSearch1_MasterSizeUpdate"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_MasterSizeUpdate"];
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
$query_rs_MediaSizeUpdate = "SELECT * FROM admin_media_sizes";
setQueryBuilderSource($query_rs_MediaSizeUpdate,$WADbSearch1,false);
$rs_MediaSizeUpdate = mysql_query($query_rs_MediaSizeUpdate, $GoCreate) or die(mysql_error());
$row_rs_MediaSizeUpdate = mysql_fetch_assoc($rs_MediaSizeUpdate);
$totalRows_rs_MediaSizeUpdate = mysql_num_rows($rs_MediaSizeUpdate);?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["Update"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_ID");
  $WA_connection = $GoCreate;
  $WA_table = "admin_media_sizes";
  $WA_redirectURL = "MasterSizeList.php?".$_SERVER['QUERY_STRING']  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "MEDIA_SIZE";
  $WA_columnTypesStr = "',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("MediaSize", $WA_multipleUpdateCounter)  ."";
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
	$WA_sitestats_1301303033310 = new WA_Include("sitestats.php");
	require($WA_sitestats_1301303033310->BaseName);
	$WA_sitestats_1301303033310->Initialize(true);
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
			  <?php echo((isset($WA_sitestats_1301303033310))?$WA_sitestats_1301303033310->Body:"") ?>
<!-- leftcolumn Content Ends Here -->
              </div>
          </div>
          <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
            <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
              <!-- centercolumn Content Starts Here -->
              <div id="HeaderTitle">Master Size Update <span class="HighLight"><?php echo $_GET['MT'];?></span></div>
              <div style="left: 15px; position: relative;" >
                <form action="" method="post">
                  <table border="0" cellpadding="4" cellspacing="4" class="form">
                    <tr class="form_txt">
                      <td>No.</td>
                      <td>Media Size</td>
                    </tr>
                    <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_MediaSizeUpdate){
?>
                    <tr class="roweffect">
                      <td class="form_txt"><input type="hidden" name="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_MediaSizeUpdate["ID"]; ?>" />
                      <input name="SZ_ID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="SZ_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_MediaSizeUpdate['ID']; ?>" />                        <?php echo $RepeatSelectionCounter_1+1; ?></td>
                      <td><input name="MediaSize_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="MediaSize_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_MediaSizeUpdate['MEDIA_SIZE']; ?>" /></td>
                    </tr>
                    <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
                    <tr>
                      <td colspan="2" align="center">
                      <?php if ($totalRows_rs_MediaSizeUpdate == 0) {?>
                      <span class="form_txt"> You did not select anything to edit!</span>
                      <?php } ?></td>
                    </tr>
                    <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_MediaSizeUpdate && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_MediaSizeUpdate = mysql_fetch_assoc($rs_MediaSizeUpdate);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
                    <tr class="roweffect">
                      <td>&nbsp;</td>
                      <td><input name="Update" type="submit" class="cust_button" id="Update" value="Update" />
                        &nbsp;&nbsp;
                        <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','MasterSizeList.php?<?php echo $_SERVER['QUERY_STRING'];?>');return document.MM_returnValue" value="Cancel" /></td>
                    </tr>
                  </table>
                </form>
              </div>
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
mysql_free_result($rs_MediaSizeUpdate);
?>
