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
$query_rs_designlist = "SELECT * FROM designs ORDER BY DESIGN_NAME ASC";
$rs_designlist = mysql_query($query_rs_designlist, $GoCreate) or die(mysql_error());
$row_rs_designlist = mysql_fetch_assoc($rs_designlist);
$totalRows_rs_designlist = mysql_num_rows($rs_designlist);

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_dashboard = "SELECT * FROM dashboard";
$rs_dashboard = mysql_query($query_rs_dashboard, $GoCreate) or die(mysql_error());
$row_rs_dashboard = mysql_fetch_assoc($rs_dashboard);
$totalRows_rs_dashboard = mysql_num_rows($rs_dashboard);

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
<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?>
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ajaxLoader(url,id) {
  if (document.getElementById) {
    var x = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();
  }
  if (x) {
    x.onreadystatechange = function() {
      if (x.readyState == 4 && x.status == 200) {
        el = document.getElementById(id);
        el.innerHTML = x.responseText;
      }
    }
    x.open("GET", url, true);
    x.send(null);
  }
}
</script>
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
              <div id="HeaderTitle" style="padding-left: 15px; padding-top: 15px; font-weight: bold; color: #FFF; font-size: 16px; font-family: Verdana, Geneva, sans-serif;">DashBoard Images List <span style="font-size: 10px;">(recommended no more than 3 images*</span>)</div>
<div class="form" style="position: relative; margin-top: 15px; padding-bottom: 15px; padding-top: 15px; padding-left: 15px; padding-right: 15px;"><?php $loopcnt=1;?>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="form">
                    <tr>
                      <td width="9%" nowrap="nowrap" class="form_txt" style="left: 5px; position: relative;">No.</td>
                      <td width="10%" nowrap="nowrap"><span class="form_txt" style="left: 10px; position: relative;">Title</span></td>
                      <td width="19%" nowrap="nowrap"><span class="form_txt" style="left: 10px; position: relative;">Link</span></td>
                      <td width="29%" align="center" nowrap="nowrap" class="form_txt">Image</td>
                      <td colspan="2" align="center" nowrap="nowrap"><span class="form_txt">Options</span></td>
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td nowrap="nowrap" class="form_txt"><?php echo $loopcnt;?></td>
                        <td nowrap="nowrap"><?php echo $row_rs_dashboard['IMG_TITLE']; ?></td>
                        <td nowrap="nowrap"><select name="select" disabled="disabled" class="form" id="select">
                          <?php ++$loopcnt;?>   <?php
do {  
?>
                          <option value="<?php echo $row_rs_designlist['ID']?>"<?php if (!(strcmp($row_rs_designlist['ID'], $row_rs_dashboard['LINK']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_designlist['DESIGN_NAME']?></option>
                          <?php
} while ($row_rs_designlist = mysql_fetch_assoc($rs_designlist));
  $rows = mysql_num_rows($rs_designlist);
  if($rows > 0) {
      mysql_data_seek($rs_designlist, 0);
	  $row_rs_designlist = mysql_fetch_assoc($rs_designlist);
  }
?>
                        </select></td>
                        <td align="center" nowrap="nowrap" class="form_txt">view</td>
                        <td colspan="2" align="center" nowrap="nowrap" style="border-left-color: #024A24; border-bottom-color: #024A24; border-right-color: #024A24; border-top-color: #024A24; border-left-style: dotted; border-right-style: none; border-left-width: thin; border-bottom-width: thin; border-right-width: thin; border-top-width: thin;" ><input name="edit" type="button" class="cust_button" id="edit" value="edit" />
                          <input name="delete" type="button" class="cust_button" id="delete" value="delete" /></td>
                      </tr>
                      <?php } while ($row_rs_dashboard = mysql_fetch_assoc($rs_dashboard)); ?>
<tr>
                      <td colspan="4"><input name="Editall" type="submit" class="cust_button" id="Editall" value="Editall" /></td>
                      <td width="16%">&nbsp;</td>
                      <td width="17%">&nbsp;</td>
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
mysql_free_result($rs_designlist);

mysql_free_result($rs_dashboard);
?>
