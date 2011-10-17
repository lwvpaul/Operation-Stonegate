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

$colname_rs_img = "-1";
if (isset($_GET['IMG_ID'])) {
  $colname_rs_img = (get_magic_quotes_gpc()) ? $_GET['IMG_ID'] : addslashes($_GET['IMG_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_img = sprintf("SELECT * FROM dashboard WHERE ID = %s", GetSQLValueString($colname_rs_img, "int"));
$rs_img = mysql_query($query_rs_img, $GoCreate) or die(mysql_error());
$row_rs_img = mysql_fetch_assoc($rs_img);
$totalRows_rs_img = mysql_num_rows($rs_img);
?>
<img src="<?php echo $row_rs_img['IMG_FILE']; ?>" width="484" height="249" />
<?php
mysql_free_result($rs_img);
?>
