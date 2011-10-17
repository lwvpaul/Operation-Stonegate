<?php
require_once( "../../webassist/framework/library.php" );
require_once( "../../webassist/framework/framework.php" );
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_MMTypeList = 15;
$pageNum_rs_MMTypeList = 0;
if (isset($_GET['pageNum_rs_MMTypeList'])) {
  $pageNum_rs_MMTypeList = $_GET['pageNum_rs_MMTypeList'];
}
$startRow_rs_MMTypeList = $pageNum_rs_MMTypeList * $maxRows_rs_MMTypeList;

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_MMTypeList = "SELECT * FROM admin_media_type";
$query_limit_rs_MMTypeList = sprintf("%s LIMIT %d, %d", $query_rs_MMTypeList, $startRow_rs_MMTypeList, $maxRows_rs_MMTypeList);
$rs_MMTypeList = mysql_query($query_limit_rs_MMTypeList, $GoCreate) or die(mysql_error());
$row_rs_MMTypeList = mysql_fetch_assoc($rs_MMTypeList);

if (isset($_GET['totalRows_rs_MMTypeList'])) {
  $totalRows_rs_MMTypeList = $_GET['totalRows_rs_MMTypeList'];
} else {
  $all_rs_MMTypeList = mysql_query($query_rs_MMTypeList);
  $totalRows_rs_MMTypeList = mysql_num_rows($all_rs_MMTypeList);
}
$totalPages_rs_MMTypeList = ceil($totalRows_rs_MMTypeList/$maxRows_rs_MMTypeList)-1;

$queryString_rs_MMTypeList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_MMTypeList") == false && 
        stristr($param, "totalRows_rs_MMTypeList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_MMTypeList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_MMTypeList = sprintf("&totalRows_rs_MMTypeList=%d%s", $totalRows_rs_MMTypeList, $queryString_rs_MMTypeList);

if("" == ""){
	$WA_cnt_loop_1300108391712 = new WA_Include("../GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_cnt_loop_1300108391712->BaseName);
	$WA_cnt_loop_1300108391712->Initialize(true);
}
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "15";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/forms.css" rel="stylesheet" type="text/css" />
<link href="../css/page.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_cnt_loop_1300108391712))?$WA_cnt_loop_1300108391712->Head:"") ?>
</head>

<body class="pagebg">
<div id="HeaderTitle">Master Media Type List</div>
<form method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return OnSubmitForm();" >
  <table width="566" border="0" cellpadding="2" cellspacing="2" class="form" id="list" >
    <tr>
      <td width="27" align="center" class="form_txt">No.</td>
      <td width="257" align="center" class="form_txt">Media Type</td>
      <td width="82" align="center" nowrap="nowrap" class="form_txt">VAT Rated</td>
      <td align="center" nowrap="nowrap" class="form_txt">Size Options</td>
      <td colspan="2" align="center" class="form_txt">Options</td>
    </tr>
    <?php $loopcnt=1;?>
    <?php

	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rs_MMTypeList){
?>
    <tr>
      <td align="center" nowrap="nowrap" class="form_txt"><?php echo $loopcnt.".";?>
        <input name="mediaid[]" type="checkbox" id="mediaid_<?php echo $loopcnt;?>" value="<?php echo $row_rs_MMTypeList['ID']; ?>" /></td>
      <td align="center" class="form_txt"><?php echo $row_rs_MMTypeList['MEDIA_TYPE']; ?></td>
      <td align="center"><input <?php if (!(strcmp($row_rs_MMTypeList['VAT_RATING'],"Y"))) {echo "checked=\"checked\"";} ?> type="checkbox" name="checkbox" id="checkbox" DISABLED /></td>
      <td width="32" align="center" style="border-right-color: #004923; border-right-style: dashed; border-right-width: thin;"><input name="Sizes" type="button" class="cust_button" id="Sizes" onclick="MM_goToURL('parent','MasterSizeList.php?SZ_ID=<?php echo $row_rs_MMTypeList['ID']; ?>&MT=<?php echo $row_rs_MMTypeList['MEDIA_TYPE']; ?>');return document.MM_returnValue" value="Sizes" /></td>
      <td align="center">
<input name="Edit" type="submit" class="cust_button" id="Edit" value="Edit" onclick="document.getElementById('mediaid_<?php echo $loopcnt;?>').checked=true;this.form.action='../MasterTyUpdate.php';"/></td>
      <td align="center">
<input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" onclick="document.getElementById('mediaid_<?php echo $loopcnt;?>').checked=true;this.form.action='../MasterTyDelete.php';"/></td>
    </tr>
    <?php ++$loopcnt;?>
    <tr>
      <?php

	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
      <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rs_MMTypeList && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rs_MMTypeList = mysql_fetch_assoc($rs_MMTypeList);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
      <td colspan="6" align="right" nowrap="nowrap" class="form_txt" style="border-top-color: #004923; border-top-style: dashed; border-top-width: thin;"><input name="EditAll" type="submit" class="cust_button" id="EditAll" value="EditSelected" onclick="this.form.action='../MasterTyUpdate.php';"/>
        <input name="DeleteAll" type="submit" class="cust_button" id="DeleteAll" value="DeleteSelected" onclick="this.form.action='../MasterTyDelete.php';"/></td>
    </tr>
  </table>
  <table cellpadding="2" cellspacing="0" border="0">
    <tr>
      <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
    </tr>
  </table>
</form>
<br /><form action="../MasterTyAdd.php" method="post">
<table width="566" border="0" cellpadding="2" cellspacing="2" class="form">
  <tr>
    <td class="form_txt"><span style="left: auto; padding-right: 15px;">
  
  Add<select name="NewAdd" id="NewAdd" onchange="this.form.submit();">
          <?php echo((isset($WA_cnt_loop_1300108391712))?$WA_cnt_loop_1300108391712->Body:"") ?>
        </select>
    </span>
      <span class="PageRecordNo">Records <?php echo ($startRow_rs_MMTypeList + 1) ?> to <?php echo min($startRow_rs_MMTypeList + $maxRows_rs_MMTypeList, $totalRows_rs_MMTypeList) ?> of <?php echo $totalRows_rs_MMTypeList ?></span>
     
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_rs_MMTypeList > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_MMTypeList=%d%s", $currentPage, 0, $queryString_rs_MMTypeList); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_MMTypeList > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_MMTypeList=%d%s", $currentPage, max(0, $pageNum_rs_MMTypeList - 1), $queryString_rs_MMTypeList); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_MMTypeList < $totalPages_rs_MMTypeList) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_MMTypeList=%d%s", $currentPage, min($totalPages_rs_MMTypeList, $pageNum_rs_MMTypeList + 1), $queryString_rs_MMTypeList); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rs_MMTypeList < $totalPages_rs_MMTypeList) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_MMTypeList=%d%s", $currentPage, $totalPages_rs_MMTypeList, $queryString_rs_MMTypeList); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table></td>
  </tr>
</table></form>

</body>
</html>
<?php
mysql_free_result($rs_MMTypeList);
?>
