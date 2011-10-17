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
$query_rs_CatList = "SELECT * FROM product_cats ORDER BY TITLE_NAME ASC";
$rs_CatList = mysql_query($query_rs_CatList, $GoCreate) or die(mysql_error());
$row_rs_CatList = mysql_fetch_assoc($rs_CatList);
$totalRows_rs_CatList = mysql_num_rows($rs_CatList);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryCollapsiblePanel.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
</head>

<body style="position: relative;">
<div id="CollapsiblePanel1" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">
    <div>
      <div>
      
      <table width="500" border="0" cellpadding="4" cellspacing="0" class="form">
          <tr>
            <td align="left" nowrap="nowrap" class="form_txt" scope="col">Design Filter</td>
            <td align="left" nowrap="nowrap" class="form_txt" scope="col"><input name="Open/Close" type="button" class="cust_button" value="Open : Close" /></td>
            <td align="left" nowrap="nowrap" class="form_txt" scope="col"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="CollapsiblePanelContent"><br />
<form action="DesignList.php" method="post" id="DesignFilter" name="DesignFilter">
  <table border="0" align="left" cellpadding="4" cellspacing="2" class="form">
    <tr>
      <th align="left" scope="col"><span class="form_txt">Name : </span>
        <label for="CName"></label>
        <input name="CName" type="text" class="form" id="CName" />
        <span class="form_txt">Ref :
          <input name="CRef" type="text" class="form" id="CRef" />
          <label for="CRef"> Description :
            <input name="CDes" type="text" class="form" id="CDes" />
          </label>
        </span></th>
      <th rowspan="2" align="center" valign="bottom" scope="col"><span class="form_txt">
        <input name="button" type="submit" class="cust_button" id="button" value="Apply Filter" /><input name="ClearFilter" type="submit" class="cust_button" value="ClearFilter"  />
      </span></th>
    </tr>
    <tr>
      <th align="left" scope="row"><span class="form_txt"> Catergory :
        <select name="CCatList" class="form" id="CCatList">
          <option value="">Select..</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rs_CatList['ID']?>"><?php echo $row_rs_CatList['TITLE_NAME']?></option>
          <?php
} while ($row_rs_CatList = mysql_fetch_assoc($rs_CatList));
  $rows = mysql_num_rows($rs_CatList);
  if($rows > 0) {
      mysql_data_seek($rs_CatList, 0);
	  $row_rs_CatList = mysql_fetch_assoc($rs_CatList);
  }
?>
        </select>
      </span></th>
    </tr>
  </table>
  <table cellpadding="2" cellspacing="0" border="0">
    <tr>
      <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
    </tr>
  </table>
</form>
</div></div>
<script type="text/javascript">
var CollapsiblePanel1 = new Spry.Widget.CollapsiblePanel("CollapsiblePanel1", {contentIsOpen:false});
</script><br style="clear:both"/>
</body>
</html>
<?php
mysql_free_result($rs_CatList);
?>
