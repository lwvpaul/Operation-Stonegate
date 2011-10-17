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

$colname_rs_DesignTxtPreview = "-1";
if (isset($_GET['ID'])) {
  $colname_rs_DesignTxtPreview = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_DesignTxtPreview = sprintf("SELECT * FROM designs WHERE ID = %s", GetSQLValueString($colname_rs_DesignTxtPreview, "int"));
$rs_DesignTxtPreview = mysql_query($query_rs_DesignTxtPreview, $GoCreate) or die(mysql_error());
$row_rs_DesignTxtPreview = mysql_fetch_assoc($rs_DesignTxtPreview);
$totalRows_rs_DesignTxtPreview = mysql_num_rows($rs_DesignTxtPreview);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
#DesignTxtPreview #Icon {
	float: left;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 5px;
}
</style>
</head>

<body>
<div id="DesignTxtPreview" style="width: 580px; height: 380px; overflow: auto; border: medium dashed #FFF;" ><?php echo $row_rs_DesignTxtPreview['BREF_DESCIP']; ?></div>
</body>
</html>
<?php
mysql_free_result($rs_DesignTxtPreview);
?>
