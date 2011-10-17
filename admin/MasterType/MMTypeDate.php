<?php require_once('../../Connections/GoCreate.php'); ?>
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

$maxRows_rs_mmTypeData = 10;
$pageNum_rs_mmTypeData = 0;
if (isset($_GET['pageNum_rs_mmTypeData'])) {
  $pageNum_rs_mmTypeData = $_GET['pageNum_rs_mmTypeData'];
}
$startRow_rs_mmTypeData = $pageNum_rs_mmTypeData * $maxRows_rs_mmTypeData;

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_mmTypeData = "SELECT * FROM admin_media_type";
$query_limit_rs_mmTypeData = sprintf("%s LIMIT %d, %d", $query_rs_mmTypeData, $startRow_rs_mmTypeData, $maxRows_rs_mmTypeData);
$rs_mmTypeData = mysql_query($query_limit_rs_mmTypeData, $GoCreate) or die(mysql_error());
$row_rs_mmTypeData = mysql_fetch_assoc($rs_mmTypeData);

if (isset($_GET['totalRows_rs_mmTypeData'])) {
  $totalRows_rs_mmTypeData = $_GET['totalRows_rs_mmTypeData'];
} else {
  $all_rs_mmTypeData = mysql_query($query_rs_mmTypeData);
  $totalRows_rs_mmTypeData = mysql_num_rows($all_rs_mmTypeData);
}
$totalPages_rs_mmTypeData = ceil($totalRows_rs_mmTypeData/$maxRows_rs_mmTypeData)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="1" cellspacing="1" id="mmTypeData">
  <tr>
    <td>ID</td>
    <td>MEDIA_TYPE</td>
    <td>VAT_RATING</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs_mmTypeData['ID']; ?></td>
      <td><?php echo $row_rs_mmTypeData['MEDIA_TYPE']; ?></td>
      <td><?php echo $row_rs_mmTypeData['VAT_RATING']; ?></td>
    </tr>
    <?php } while ($row_rs_mmTypeData = mysql_fetch_assoc($rs_mmTypeData)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rs_mmTypeData);
?>
