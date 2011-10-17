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
$query_rs_totalsales = "SELECT * FROM order_history ORDER BY ORDER_DATE DESC";
$rs_totalsales = mysql_query($query_rs_totalsales, $GoCreate) or die(mysql_error());
$row_rs_totalsales = mysql_fetch_assoc($rs_totalsales);
$totalRows_rs_totalsales = mysql_num_rows($rs_totalsales);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="480" height="360">
  <param name="movie" value="../DynamicWebCharts/open-flash-chart.swf?data=../DynamicWebCharts/Data/sales_dataparser1.php?<?php echo (isset($_SERVER['QUERY_STRING'])?"GET=".str_replace("&","§",$_SERVER['QUERY_STRING']):'');?>" />
  <param name="quality" value="high" />
  <embed src="../DynamicWebCharts/open-flash-chart.swf?data=../DynamicWebCharts/Data/sales_dataparser1.php?<?php echo (isset($_SERVER['QUERY_STRING'])?"GET=".str_replace("&","§",$_SERVER['QUERY_STRING']):'');?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="480" height="360"></embed>
</object>
</body>
</html>
<?php
mysql_free_result($rs_totalsales);
?>
