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

$colname_rs_CatTxtPreview = "-1";
if (isset($_GET['C_ID'])) {
  $colname_rs_CatTxtPreview = (get_magic_quotes_gpc()) ? $_GET['C_ID'] : addslashes($_GET['C_ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_CatTxtPreview = sprintf("SELECT * FROM product_cats WHERE ID = %s", GetSQLValueString($colname_rs_CatTxtPreview, "int"));
$rs_CatTxtPreview = mysql_query($query_rs_CatTxtPreview, $GoCreate) or die(mysql_error());
$row_rs_CatTxtPreview = mysql_fetch_assoc($rs_CatTxtPreview);
$totalRows_rs_CatTxtPreview = mysql_num_rows($rs_CatTxtPreview);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#CatTxtPreview #Icon {
	float: left;
}
#CatTxtPreview #Icon {
	float: left;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 5px;
}
</style>
</head>

<body>
<div id="CatTxtPreview" style="width: 580px; height: 380px; overflow: auto; border: medium dashed #FFF;" ><img src="<?php echo $row_rs_CatTxtPreview['ICON']; ?>" alt="" name="Icon" id="Icon" /><?php echo $row_rs_CatTxtPreview['TEXTHEADER']; ?></div>
</body>
</html>
<?php
mysql_free_result($rs_CatTxtPreview);
?>
