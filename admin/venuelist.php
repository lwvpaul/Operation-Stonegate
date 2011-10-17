<?php if (!session_id()) { session_start(); }?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$PubList = $_POST['SelList']; $loop=count($PubList);

$cnt=0; do {
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO discount_venues (F_ID, VENUE) VALUES (%s, %s)",
                       GetSQLValueString($_POST['DiscountID'], "int"),
                       GetSQLValueString($PubList[$cnt], "text"));

  mysql_select_db($database_GoCreate, $GoCreate);
  $Result1 = mysql_query($insertSQL, $GoCreate) or die(mysql_error());
}
++$cnt; } while ($cnt < $loop);
mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_MM_Publist = "SELECT gkprofiles.CUSTID, gkprofiles.Pub, gkprofiles.SDM, gkprofiles.SDD, gkprofiles.Section, gk_sdm.Title, gk_sdm.Firstname, gk_sdm.Surname, gk_sdm.F_ID AS SDM_F_ID, gk_sdd.F_ID AS SDD_F_ID FROM gk_sdm LEFT JOIN gkprofiles ON gk_sdm.F_ID = gkprofiles.SDM LEFT JOIN gk_sdd ON gk_sdd.F_ID = gkprofiles.SDD ORDER BY gk_sdm.Surname ASC, gkprofiles.Pub ASC";
$rs_MM_Publist = mysql_query($query_rs_MM_Publist, $GoCreate) or die(mysql_error());
$row_rs_MM_Publist = mysql_fetch_assoc($rs_MM_Publist);
$totalRows_rs_MM_Publist = mysql_num_rows($rs_MM_Publist);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="GSNET_LIB/javascript/checkall.js"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.SelectAllVenues {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-weight: bold;
	background-color: #060;
	color: #FFF;
	height: 22px;
}
</style>
<link href="css/core.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
<div id="Accordion1" class="Accordion" tabindex="0">
<?php 
	$startloop=1; 
	$venloop=0; 
		do { ?>
<?php if ($_SESSION['AMCheck'] != $row_rs_MM_Publist['SDM'] && $startloop !=1) 
			{ ++$venloop;?>                          
            </table>
        </div>
      </div>
      <?php }  ?>
<?php if ($_SESSION['AMCheck'] != $row_rs_MM_Publist['SDM']) {?> 
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">
         <label for="checkbox"></label>
          <?php if (isset($row_rs_MM_Publist['Title'])&&$row_rs_MM_Publist['Title']!="") {echo $row_rs_MM_Publist['Title']."&nbsp;";} ?>
    <?php echo $row_rs_MM_Publist['Firstname']; ?>&nbsp;<?php echo $row_rs_MM_Publist['Surname']; ?> </div>
        <div class="AccordionPanelContent">
          <div class="SelectAllVenues" id="SelectAllVenues">&nbsp;<input type="checkbox" onclick="toggleAll(SelAll<?php echo $venloop;?>,SelList<?php echo $venloop;?>)" name="SelAll<?php echo $venloop;?>" id="SelAll<?php echo $venloop;?>" />&nbsp;&nbsp;&nbsp;Select all&nbsp;<?php echo $row_rs_MM_Publist['Firstname']; ?><?php echo $row_rs_MM_Publist['Surname']; ?>&nbsp;Venues</div>
		  <table width="350" border="0" cellspacing="0" cellpadding="4">
            <?php } ?>
				<tr>                       
        	      <td><input name="SelList[]" type="checkbox" id="SelList<?php echo $venloop;?>" value="<?php echo $row_rs_MM_Publist['CUSTID']; ?>" /></td>
         	      <td><?php echo $row_rs_MM_Publist['Pub']; ?> - <?php echo $row_rs_MM_Publist['CUSTID']; ?></td>
				</tr>
			      <?php $_SESSION['AMCheck'] = $row_rs_MM_Publist['SDM'];
				  			 ++$startloop; 
							 	} while ($row_rs_MM_Publist = mysql_fetch_assoc($rs_MM_Publist)); ?>
                        </table>
        </div>
      </div>
</div>
<input name="DiscountID" type="hidden" id="DiscountID" value="<?php echo $_GET['DSC_ID'];?>" />
<input type="submit" name="AddVenues" id="AddVenues" class="addToCart" value="Add Venues" />
<input type="hidden" name="MM_insert" value="form1" />
</form>

<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
</body>
</html>
<?php
mysql_free_result($rs_MM_Publist);
?>
