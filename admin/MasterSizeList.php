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

$colname_rs_SizeFilter = "-1";
if (isset($_GET['SZ_ID'])) {
  $colname_rs_SizeFilter = (get_magic_quotes_gpc()) ? $_GET['SZ_ID'] : addslashes($_GET['SZ_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_SizeFilter = sprintf("SELECT * FROM admin_media_sizes WHERE F_ID = %s", GetSQLValueString($colname_rs_SizeFilter, "int"));
$rs_SizeFilter = mysql_query($query_rs_SizeFilter, $GoCreate) or die(mysql_error());
$row_rs_SizeFilter = mysql_fetch_assoc($rs_SizeFilter);
$totalRows_rs_SizeFilter = mysql_num_rows($rs_SizeFilter);

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
	$WA_cnt_loop_1301384715693 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1301384715693->BaseName);
	$WA_cnt_loop_1301384715693->Initialize(true);
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
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_cnt_loop_1301384715693))?$WA_cnt_loop_1301384715693->Head:"") ?><?php echo((isset($WA_cnt_loop_1301385057071))?$WA_cnt_loop_1301385057071->Head:"") ?>
</head>

<body class="GoCreateAdmin1_body_design" >
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
              <div id="HeaderTitle">Master Sizes List for <span class="HighLight"><?php echo $_GET['MT'];?></span></div>
              <form action="MasterSizeDelete.php" method="post" name="form1" >
                <table border="0" cellpadding="4" cellspacing="4" class="form">
                  <tr class="form_txt">
                    <td>No.</td>
                    <td>&nbsp;&nbsp;Media Size</td>
                    <td align="center" title="Cost, Quantity & Weight">C.Q.W</td>
                    <td align="center">Options</td>
                  </tr>
                  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_SizeFilter){
?>
                  <tr class="roweffect">
                    <td valign="middle" class="form_txt"><input name="LK_MT" type="hidden" id="LK_MT" value="<?php echo $row_rs_SizeFilter['F_ID']; ?>" />
                      <?php echo $RepeatSelectionCounter_1+1; ?>.
                      <input name="SZ_ID[]" type="checkbox" id="SZ_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_SizeFilter['ID']; ?>" /></td>
                    <td><input name="textfield" type="text" class="form" id="textfield" value="<?php echo $row_rs_SizeFilter['MEDIA_SIZE']; ?>" /></td>
                    <td><input name="button" type="submit" class="cust_button" id="button" title="Cost, Quantity & Weight" onclick="MM_goToURL('parent','MasterCQWList.php?<?php echo $_SERVER['QUERY_STRING'];?>&amp;MS=<?php echo $row_rs_SizeFilter['MEDIA_SIZE']; ?>&amp;MS_ID=<?php echo $row_rs_SizeFilter['ID']; ?>');return document.MM_returnValue" value="C.Q.W." alt="Cost, Quantity & Weight"/></td>
                    <td class="leftborder"><input name="Edit" type="submit" class="cust_button" id="Edit" 
onclick="document.getElementById('SZ_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='MasterSizeUpdate.php?<?php echo $_SERVER['QUERY_STRING'];?>';" value="Edit" />
                      <input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" 
onclick="document.getElementById('SZ_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='MasterSizeDelete.php?<?php echo $_SERVER['QUERY_STRING'];?>';" /></td>
                  </tr>
                  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
                  <?php if ($totalRows_rs_SizeFilter == 0) {?>
                  <tr>
                    <td colspan="4" align="center" class="form_txt"> There are no Sizes set yet.<br />
                      Please use the drop down option below to start adding new ones now.</td>
                  </tr>
                  <?php } ?>
                  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_SizeFilter && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_SizeFilter = mysql_fetch_assoc($rs_SizeFilter);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
                  <tr>
                    <td colspan="4" align="right" class="topborder"><input name="EditSelected" type="submit" class="cust_button" id="EditSelected" value="EditSelected" onclick="this.form.action='MasterSizeUpdate.php?<?php echo $_SERVER['QUERY_STRING'];?>';"/>
                      &nbsp;&nbsp;
                      <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" value="DeleteSelected" onclick="this.form.action='MasterSizeDelete.php?<?php echo $_SERVER['QUERY_STRING'];?>';"/></td>
                  </tr>
                </table>
                <table cellpadding="2" cellspacing="0" border="0">
                  <tr>
                    <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
                  </tr>
                </table>
              </form>
              <div id="Add" style="top: 15px; position: relative;">
                <form id="form2" name="form2" method="post" action="MasterSizeAdd.php?SZ_ID=<?php echo $_GET['SZ_ID'];?>&MT=<?php echo $_GET['MT'];?>">
                  <table border="0" cellpadding="4" cellspacing="4" class="form">
                    <tr>
                      <td class="form_txt">Add&nbsp;&nbsp;<select name="NewAdd" onchange="this.form.submit();">
                      <?php echo((isset($WA_cnt_loop_1301384715693))?$WA_cnt_loop_1301384715693->Body:"") ?>
                      </select>&nbsp;&nbsp;<input name="Cancel" type="button" class="cust_button" onclick="MM_goToURL('parent','MasterTyList.php');return document.MM_returnValue" value="Cancel &amp; Go Back" /></td>
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
mysql_free_result($rs_SizeFilter);
?>
