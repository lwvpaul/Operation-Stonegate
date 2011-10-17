<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php require_once('../Connections/GoCreate.php'); ?>
<?php
if (isset($_POST['Editall'])) {$FormRedirect="dashboard_update.php";}
if (isset($_POST['delete'])) {$FormRedirect="dashboard_delete.php";}
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
$query_rs_designlist = "SELECT * FROM product_cats";
$rs_designlist = mysql_query($query_rs_designlist, $GoCreate) or die(mysql_error());
$row_rs_designlist = mysql_fetch_assoc($rs_designlist);
$totalRows_rs_designlist = @mysql_num_rows($query_rs_designlist);

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_dashboard = "SELECT   dashboard.division_id, 
  gk_division.id, 
  gk_division.name, 
  dashboard.ID, 
  dashboard.IMG_TITLE, 
  dashboard.IMG_DESC, 
  dashboard.IMG_FILE, 
  dashboard.LINK
FROM dashboard INNER JOIN gk_division ON dashboard.division_id = gk_division.id";
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

<script type="text/javascript">
function OnSubmitForm()
{
if(document.pressed == 'EditSelected' || document.pressed == 'edit')
{
 document.form1.action ="dashboard_update.php";
}
else
if(document.pressed == 'DeleteSelected' ||document.pressed == 'delete')
{
document.form1.action ="dashboard_delete.php";
}
return true;
}
</script>

<?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Head:"") ?>
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
              <div id="HeaderTitle">DashBoard Images List <span id="SubHeaderTitle"><br />
              (*recommended no more than 3 images, Images to be 584 x 350 inc 50 px bottom bleed)</span>
            </div>
              <div style="float:left">
  <form action="dashboard_delete.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return OnSubmitForm();">
    <table width="650" border="0" cellpadding="2" cellspacing="2" class="form">
      <tr>
        <td width="9%" nowrap="nowrap" class="form_txt" style="left: 5px; position: relative;">No.</td>
        <td width="22%" nowrap="nowrap"><span class="form_txt" style="left: 10px; position: relative;">Title</span></td>
        <td width="19%" nowrap="nowrap"><span class="form_txt" style="left: 10px; position: relative;">Link</span></td>
        <td width="12%" align="center" nowrap="nowrap" class="form_txt">Image</td>
        <td width="12%" align="center" nowrap="nowrap" class="form_txt">Division</td>

        <td width="38%" align="center" nowrap="nowrap"><span class="form_txt">Options</span></td>
        </tr>
      <?php $loopcnt=1;
						do { ?>
        <tr class="roweffect">
          <td nowrap="nowrap" class="form_txt"><?php echo $loopcnt;?>
            <input name="DI_ID[]" type="checkbox" id="DI_ID<?php echo $loopcnt;?>" value="<?php echo $row_rs_dashboard['ID']; ?>" /></td>
          <td align="center" nowrap="nowrap"><?php echo $row_rs_dashboard['IMG_TITLE']; ?></td>
          <td nowrap="nowrap"><select name="select" disabled="disabled" class="form" id="select">
            <option value="" <?php if (!(strcmp("", $row_rs_dashboard['LINK']))) {echo "selected=\"selected\"";} ?>>No Value</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rs_designlist['ID']?>"<?php if (!(strcmp($row_rs_designlist['ID'], $row_rs_dashboard['LINK']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_designlist['TITLE_NAME']?></option>
            <?php
} while ($row_rs_designlist = mysql_fetch_assoc($rs_designlist));
  $rows = mysql_num_rows($rs_designlist);
  if($rows > 0) {
      mysql_data_seek($rs_designlist, 0);
	  $row_rs_designlist = mysql_fetch_assoc($rs_designlist);
  }
?>
            </select></td>
          <td align="center" nowrap="nowrap" class="form_txt"><a href="#" onclick="ajaxLoader('imgholder.php?IMG_ID=<?php echo $row_rs_dashboard['ID']; ?>','img_holder')">view</a></td>
          <td align="center" nowrap="nowrap" class="form_txt"><?php echo $row_rs_dashboard['name']; ?></td>
          
          <td align="center" nowrap="nowrap" style="padding-left: 5px; border-left-color: #024A24; border-bottom-color: #024A24; border-right-color: #024A24; border-top-color: #024A24; border-left-style: dotted; border-left-width: thin; border-bottom-width: thin; border-right-width: thin; border-top-width: thin;" ><input name="edit" type="submit" class="cust_button" id="edit" onclick="document.getElementById('DI_ID<?php echo $loopcnt;?>').checked=true;document.pressed=this.value;" value="edit" />
            <input name="delete" type="submit" class="cust_button" id="delete" value="delete" onclick="document.pressed=this.value;document.getElementById('DI_ID<?php echo $loopcnt;?>').checked=true" /></td>
          </tr><?php ++$loopcnt;?>
        <?php } while ($row_rs_dashboard = mysql_fetch_assoc($rs_dashboard)); ?>
      <tr>
        <td colspan="5" style="border-top-color: #024A24; border-top-style: dotted; border-top-width: thin;"><input name="Editall" type="submit" class="cust_button" id="Editall"  value="EditSelected" onclick="document.pressed=this.value"/>
          <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" value="DeleteSelected" onclick="document.pressed=this.value"/></td>
        <td style="border-top-color: #024A24; border-top-style: dotted; border-top-width: thin;">&nbsp;</td>
        </tr>
      </table>
    
    <table cellpadding="2" cellspacing="0" border="0">
      <tr>
        <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
        </tr>
      </table>
  </form>
              </div>
				<div id="img_holder" style="float:left; -webkit-border-radius: 10px; -moz-border-radius: 10px;"></div>
<br style="clear:left"/>
             
         
<form action="dashboard_insert.php" method="post">
  <table width="650" border="0" cellpadding="0" cellspacing="0" class="form">
  <tr>
    <td style="padding-bottom: 5px; padding-top: 5px; padding-left: 5px;"> <span class="form_txt"><span style="padding-right: 5px;">Add</span></span>      <select name="NewAdd" id="NewAdd" onchange="this.form.submit();">
      <option>0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
        <option value="4">4</option>
              <option value="5">5</option>
    </select></td>
  </tr>
</table>
 </form>

<!-- centercolumn Content Ends Here -->
            </div>
          </div>
          <div class='cssLClearC'></div>
        </div>
      </div>
          <?php echo((isset($WA_footer_1300717372941))?$WA_footer_1300717372941->Body:"") ?>

      <div class='cssLClearR'></div>
    </div>
  </div>
  <div class="cssLClearL"></div>
  <!-- #GoCreateAdmin1 (CSSLayouts End) -->
</div>
</body>
</html>
<?php
mysql_free_result($rs_designlist);

mysql_free_result($rs_dashboard);
?>
