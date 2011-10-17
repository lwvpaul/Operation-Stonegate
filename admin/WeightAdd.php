<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["InsertAll"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("WeightFrom", "WeightTo", "WeightCost");
  $WA_connection = $GoCreate;
  $WA_table = "shipping";
  $WA_redirectURL = "WeightList.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "WEIGHT_FROM|WEIGHT_TO|PRICE";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "WeightCost";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("WeightFrom", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("WeightTo", $WA_multipleInsertCounter)  ."" . "|" . "".WA_AB_getLoopedFieldValue("WeightCost", $WA_multipleInsertCounter)  ."";
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
	$WA_cnt_loop_1301835338970 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1301835338970->BaseName);
	$WA_cnt_loop_1301835338970->Initialize(true);
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
	$RepeatSelectionCounter_1_Iterations = "".((isset($_POST["NewAdd"]))?$_POST["NewAdd"]:"")  ."";
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
<?php echo((isset($WA_cnt_loop_1301835338970))?$WA_cnt_loop_1301835338970->Head:"") ?>
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
              <div id="HeaderTitle">Master Weight Add</div>
              <div style="left: 15px; position: relative;">
                <form name="form1" action="" method="post" enctype="multipart/form-data" id="form1">
                  <table border="0" cellpadding="4" cellspacing="4" class="form">
                    <tr align="center" class="form_txt">
                      <td>No.</td>
                      <td>Weight From</td>
                      <td>Weight To</td>
                      <td>Cost</td>
                    </tr>
 <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>              <tr align="center" class="roweffect">
                      <td class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>.</td>
                      <td class="form_txt"><input type="hidden" name="WeightFrom_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="WeightFrom_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
                        <input name="WeightFrom_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="WeightFrom_<?php echo $RepeatSelectionCounter_1; ?>" size="12" />
                      Kg</td>
                      <td class="form_txt"><input name="WeightTo_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="WeightTo_<?php echo $RepeatSelectionCounter_1; ?>" size="12" />Kg</td>
                      <td class="form_txt">&pound;<input name="WeightCost_<?php echo $RepeatSelectionCounter_1; ?>" type="text" class="form" id="WeightCost_<?php echo $RepeatSelectionCounter_1; ?>" size="12" /></td>
                      </tr>
                   
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
 <tr>
                      <td colspan="4" align="right" class="topborder">&nbsp;&nbsp;</td>
                    </tr>
                  </table>
              <div style="top: 20px; position: relative;">
               <table border="0" cellpadding="4" cellspacing="4" class="form">
                    <tr class="form_txt">
                      <td>Add&nbsp;
                        <select name="NewAdd" id="NewAdd" onchange="this.form.submit();">
                          <?php echo((isset($WA_cnt_loop_1301835338970))?$WA_cnt_loop_1301835338970->Body:"") ?>
                        </select></td>
                      <td class="leftborder"><input name="InsertAll" type="submit" class="cust_button" id="InsertAll" value="InsertAll" />                        <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','WeightList.php');return document.MM_returnValue" value="Cancel" /></td>
                    </tr>
                  </table>
              </div>  </form>
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