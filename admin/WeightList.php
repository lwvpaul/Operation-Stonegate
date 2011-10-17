<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php require_once('../Connections/GoCreate.php'); ?>
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
$query_rs_weightlist = "SELECT * FROM shipping ORDER BY WEIGHT_FROM ASC";
$rs_weightlist = mysql_query($query_rs_weightlist, $GoCreate) or die(mysql_error());
$row_rs_weightlist = mysql_fetch_assoc($rs_weightlist);
$totalRows_rs_weightlist = mysql_num_rows($rs_weightlist);

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
	$WA_cnt_loop_1301833798518 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1301833798518->BaseName);
	$WA_cnt_loop_1301833798518->Initialize(true);
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
</script>
<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?><?php echo((isset($WA_sitestats_1301303033310))?$WA_sitestats_1301303033310->Head:"") ?>
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_cnt_loop_1301833798518))?$WA_cnt_loop_1301833798518->Head:"") ?>
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
			  <?php echo((isset($WA_sitestats_1301303033310))?$WA_sitestats_1301303033310->Body:"") ?>
<!-- leftcolumn Content Ends Here -->
              </div>
          </div>
          <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
            <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
              <!-- centercolumn Content Starts Here -->
              <div id="HeaderTitle">Master Weight List</div>
              <div style="left: 15px; position: relative;">
                <form action="WeightDelete.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <table border="0" cellpadding="4" cellspacing="4" class="form">
                    <tr class="form_txt">
                      <td>No.</td>
                      <td>Weight From (Kg)</td>
                      <td>Weight To (Kg)</td>
                      <td>Cost</td>
                      <td colspan="2" align="center">Options</td>
                    </tr>
                    <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_weightlist){
?>
                    <tr align="center" class="roweffect">
                      <td class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>.&nbsp;
                        <input name="WGT_ID[]" type="checkbox" id="WGT_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_weightlist['ID']; ?>" /></td>
                      <td class="form_txt"><?php echo number_format($row_rs_weightlist['WEIGHT_FROM'],2,'.',','); ?>Kg</td>
                      <td class="form_txt"><?php echo number_format($row_rs_weightlist['WEIGHT_TO'],2,'.',','); ?>Kg</td>
                      <td class="form_txt">&pound;<?php echo number_format($row_rs_weightlist['PRICE'],2,'.',','); ?></td>
                      <td class="leftborder"><input name="Edit" type="submit" class="cust_button" id="Edit" value="Edit" onclick="document.getElementById('WGT_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='WeightUpdate.php?<?php echo $_SERVER['QUERY_STRING'];?>';"  /></td>
                      <td><input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" onclick="document.getElementById('WGT_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='WeightDelete.php?<?php echo $_SERVER['QUERY_STRING'];?>';" /></td>
                    </tr>
                    <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_weightlist && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_weightlist = mysql_fetch_assoc($rs_weightlist);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
                    <tr>
                      <td colspan="6" align="right" class="topborder"><input name="EditSelected" type="submit" class="cust_button" id="EditSelected" value="EditSelected" onclick="this.form.action='WeightUpdate.php?<?php echo $_SERVER['QUERY_STRING'];?>';"/>
                        &nbsp;&nbsp;
                        <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" value="DeleteSelected" onclick="this.form.action='WeightDelete.php?<?php echo $_SERVER['QUERY_STRING'];?>';" /></td>
                    </tr>
                  </table>
                  <table cellpadding="2" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
                    </tr>
                  </table>
                </form>
                 <div style="top: 15px; left: 15px; position: relative;">
              <form action="WeightAdd.php" method="post" enctype="multipart/form-data" id="form2" name="form2">
                <table border="0" cellpadding="4" cellspacing="4" class="form">
                  <tr class="form_txt">
                    <td>Add&nbsp;
                      <select name="NewAdd" id="NewAdd" onchange="this.form.submit();">
                        <?php echo((isset($WA_cnt_loop_1301833798518))?$WA_cnt_loop_1301833798518->Body:"") ?>
                      </select></td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </form>
            </div>
              </div>
              <!-- centercolumn Content Ends Here -->
              </div>
          </div>
          <div class='cssLClearC'>
           
          </div>
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
mysql_free_result($rs_weightlist);
?>
