<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php require_once('../Connections/GoCreate.php'); ?>
<?php
//WA Database Search Include
require_once("../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: rs_DesignList;
//Searchpage: DesignListSearch.php;
//Form: DesignFilter;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_POST["WADbSearch1"])) && ($_POST["WADbSearch1"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations
  $KeyArr0 = array("DESIGN_NAME");
  $KeyArr1 = array("BREF_DESCIP");

  //comparison list additions
  $WADbSearch1->keywordComparison($KeyArr0,"".((isset($_POST["CName"]))?$_POST["CName"]:"")  ."","AND","Includes",",%20","%20","%22","%22",0);
  $WADbSearch1->addComparisonFromEdit("DESC_CAT","CCatList","OR","=",1);
  $WADbSearch1->addComparisonFromEdit("DESIGN_REF","CRef","OR","=",0);
  $WADbSearch1->keywordComparison($KeyArr1,"".((isset($_POST["CDes"]))?$_POST["CDes"]:"")  ."","OR","Includes",",%20","%20","%22","%22",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_DesignListInc"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_DesignListInc"]) && $_SESSION["WADbSearch1_DesignListInc"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_DesignListInc"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_DesignList = 15;
$pageNum_rs_DesignList = 0;
if (isset($_GET['pageNum_rs_DesignList'])) {
  $pageNum_rs_DesignList = $_GET['pageNum_rs_DesignList'];
}
$startRow_rs_DesignList = $pageNum_rs_DesignList * $maxRows_rs_DesignList;

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_DesignList = "SELECT * FROM designs ORDER BY `DATE` DESC";
setQueryBuilderSource($query_rs_DesignList,$WADbSearch1,false);
$query_limit_rs_DesignList = sprintf("%s LIMIT %d, %d", $query_rs_DesignList, $startRow_rs_DesignList, $maxRows_rs_DesignList);
$rs_DesignList = mysql_query($query_limit_rs_DesignList, $GoCreate) or die(mysql_error());
$row_rs_DesignList = mysql_fetch_assoc($rs_DesignList);

if (isset($_GET['totalRows_rs_DesignList'])) {
  $totalRows_rs_DesignList = $_GET['totalRows_rs_DesignList'];
} else {
  $all_rs_DesignList = mysql_query($query_rs_DesignList);
  $totalRows_rs_DesignList = mysql_num_rows($all_rs_DesignList);
}
$totalPages_rs_DesignList = ceil($totalRows_rs_DesignList/$maxRows_rs_DesignList)-1;

$queryString_rs_DesignList = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_DesignList") == false && 
        stristr($param, "totalRows_rs_DesignList") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_DesignList = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_DesignList = sprintf("&totalRows_rs_DesignList=%d%s", $totalRows_rs_DesignList, $queryString_rs_DesignList);
?>
<?php
if("" == ""){
	$WA_catdropdown_1302881271357 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10");
	require($WA_catdropdown_1302881271357->BaseName);
	$WA_catdropdown_1302881271357->Initialize(true);
}

if("" == ""){
	$WA_DesignListSearch_1303048712177 = new WA_Include("DesignListSearch.php");
	require($WA_DesignListSearch_1303048712177->BaseName);
	$WA_DesignListSearch_1303048712177->Initialize(true);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/acl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/jquery.blockUI.js"></script>
<script type="text/javascript" src="../gsnet_lib/js/checkall.js"></script>
<?php echo((isset($WA_catdropdown_1302881271357))?$WA_catdropdown_1302881271357->Head:"") ?><?php echo((isset($WA_catdropdown_1302977031949))?$WA_catdropdown_1302977031949->Head:"") ?><?php echo((isset($WA_DesignListSearch_1303048712177))?$WA_DesignListSearch_1303048712177->Head:"") ?>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
</head>
<body class="pagebg">

<div id="HeaderTitle">Design List</div><?php echo((isset($WA_DesignListSearch_1303048712177))?$WA_DesignListSearch_1303048712177->Body:"") ?><br />

<form action="DesignListUpdateInc.php" method="post" name="ListInc">
  <table border="0" cellpadding="4" cellspacing="0" class="form">
    <tr class="form_txt">
      <th scope="col">All
        <input type="checkbox" name="chkall1" id="chkall1" onclick="CheckAll(this.form);" />
        <label for="chkall"></label></th>
      <th scope="col">Name</th>
      <th scope="col">Ref</th>
      <th scope="col">Category</th>
      <th scope="col">Description</th>
      <th scope="col">Amendments</th>
      <th scope="col">Multi-Pack</th>
      <th scope="col">Max Options</th>
      <th colspan="3" scope="col">Options</th>
    </tr>
    <?php $cnt=0; if ($row_rs_DesignList!=0) {
do { ?>
    <tr class="roweffect">
      <td nowrap="nowrap" class="form_txt" scope="row"><?php echo $cnt+1; ?>.
        <input name="DS_ID[]" type="checkbox" id="DS_ID_<?php echo $cnt; ?>" value="<?php echo $row_rs_DesignList['ID']; ?>" /></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><?php echo $row_rs_DesignList['DESIGN_NAME']; ?></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><?php echo $row_rs_DesignList['DESIGN_REF']; ?></td>
        <td nowrap="nowrap" class="form_txt" scope="row">
            <select name="MENU_LEVEL_" id="MENU_LEVEL_">
            <?php
            /*$WA_catdropdown_1302977031949 = new WA_Include("GSNET_LIB/php/catdropdown.php?dis=Y&ID=".$row_rs_DesignList['ID']);
            require($WA_catdropdown_1302977031949->BaseName);
            $WA_catdropdown_1302977031949->Initialize(true);
            
            echo((isset($WA_catdropdown_1302977031949))?$WA_catdropdown_1302977031949->Body:"")*/
            
            // New, WORKING, pre-selected drop-downs - Paul Canning, 09-09-2011
            // Updated to show Root Categories - Paul Canning, 14-10-2011

            $query = "SELECT * FROM product_cats ORDER BY TITLE_NAME ASC";
            $result = mysql_query($query);
            while($row = mysql_fetch_assoc($result)) {
              if($row['MENU_LEVEL'] == '-1') {

                if($row_rs_DesignList['DESC_CAT'] == $row['ID']) {
                  $selected = 'selected="selected"';
                } else {
                  $selected = '';
                }

                echo '<option value="'.$row['ID'].'" '.$selected.'>--'.$row['TITLE_NAME'].' --</option>';

                $id = $row['ID'];
                $query2 = "SELECT * FROM product_cats WHERE MENU_LEVEL = '".$id."' ORDER BY TITLE_NAME ASC";
                $result2 = mysql_query($query2);
                while($row2 = mysql_fetch_assoc($result2)) {
                  if($row_rs_DesignList['DESC_CAT'] == $row2['ID']) {
                    $selected = 'selected="selected"';
                  } else {
                    $selected = '';
                  }
                    echo '<option value="'.$row2['ID'].'" '.$selected.'> > > '.$row2['TITLE_NAME'].'</option>';
                }
              }
            }

            /*$query = "SELECT * FROM product_cats ORDER BY TITLE_NAME ASC";
            $result = mysql_query($query);
            while($row = mysql_fetch_assoc($result)) {
                if($row_rs_DesignList['DESC_CAT'] == $row['ID']) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
                echo '<option value="'.$row['ID'].'" '.$selected.'>'.$row['TITLE_NAME'].'</option>';
            }*/
            ?>
            </select>
        </td>
      <td nowrap="nowrap" class="form_txt" 
<?php if (isset($row_rs_DesignList['BREF_DESCIP']) || $row_rs_DesignList['BREF_DESCIP'] !=""){?> title="Click to view text" ><script language="javascript">$(document).ready(function() { $.blockUI.defaults.css = {};$.blockUI.defaults.overlayCSS = {}; $().ajaxStart(function() {$.blockUI({ message: '<div id="loading"><img  src="images/green_small.gif" /><span>Loading Category HTML Preview...</span></div>'}); });$('#TxtPreviewLink_<?php echo $cnt; ?>').click(function() {$.ajax({url : 'designtxtpreview.php?ID=<?php echo $row_rs_DesignList['ID']; ?>',success : function (data) {$.blockUI({message: $('#TxtPreviewHolder_<?php echo $cnt; ?>'),css: {padding:0,margin:0,width:'580px',top:'15%',left:'25%',color:'#000',padding:'15px',backgroundColor:'#fff'}});$("#TxtPreviewHolder_<?php echo $cnt; ?>").html(data);$('.blockOverlay').attr('title',' ').click($.unblockUI);}})});});</script>
        <a href="javascript:void(0)" id="TxtPreviewLink_<?php echo $cnt; ?>">View</a>
        <div id="TxtPreviewHolder_<?php echo $cnt; ?>" style="display:none"></div>
        <?php } else { echo ">NA";}?></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><?php if ($row_rs_DesignList['AMENDMENTS_ALLOWED']=="Y") {echo"Yes";}else{echo"No";}?></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><?php if ($row_rs_DesignList['MULTI_PACK']!="Y") {echo "No";}else{echo $row_rs_DesignList['MULTI_PACK'];} ?></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><?php if ($row_rs_DesignList['OPTIONS']==0) {echo"N/A";}else{echo $row_rs_DesignList['OPTIONS'];} ?></td>
      <td nowrap="nowrap" class="form_txt leftborder" scope="row"><input name="MediaType" type="button" class="cust_button" id="MediaType" onclick="MM_goToURL('parent','DesignDBEditInc.php?DES_ID=<?php echo $row_rs_DesignList['ID']; ?>&amp;Name=<?php echo $row_rs_DesignList['DESIGN_NAME']; ?>');return document.MM_returnValue" value="MediaType" /></td>
      <td nowrap="nowrap" class="form_txt leftborder" scope="row"><input name="Edit" type="submit" class="cust_button" id="Edit" value="Edit" onclick="document.getElementById('DS_ID_<?php echo $cnt; ?>').checked=true;this.form.action='DesignListUpdate.php';" /></td>
      <td nowrap="nowrap" class="form_txt" scope="row"><input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" onclick="document.getElementById('DS_ID_<?php echo $cnt; ?>').checked=true;this.form.action='DesignListDelete.php';"  /></td>
    </tr>
    <?php ++$cnt;} while ($row_rs_DesignList = mysql_fetch_assoc($rs_DesignList));
} else { ?>
<tr><td colspan="11">No Designs Added</td></tr>
 <?php } ?>   <tr>
      <th class="topborder form_txt" scope="row">All
        <input type="checkbox" name="chkall2" id="chkall2" onclick="CheckAll(this.form);" />
        <label for="chkall2"></label></th>
      <th colspan="10" align="left" scope="row" class="topborder"> <input name="EditSelected" type="submit" class="cust_button" id="EditSelected" value="EditSelected" onclick="this.form.action='DesignListUpdate.php';"/>
        <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" value="DeleteSelected"  onclick="this.form.action='DesignListDelete.php';"/></th>
    </tr>
  </table>
  <table cellpadding="2" cellspacing="0" border="0">
    <tr>
      <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
    </tr>
  </table>
</form>


<div id="Add" style="top: 15px; position: relative;">
  <form action="DesignListAdd.php" method="get">
    <table width="500" border="0" cellpadding="4" cellspacing="0" class="form">
      <tr class="form_txt">
        <td width="108" align="center" scope="col">Add
          <label for="NewAdd"></label>
          <select name="counter" class="form" id="NewAdd" onchange="this.form.submit();">
            <?php echo((isset($WA_catdropdown_1302881271357))?$WA_catdropdown_1302881271357->Body:"") ?>
          </select>
        </td>
        <td width="242" align="center" class="leftborder" scope="col">&nbsp;
Records <?php echo ($startRow_rs_DesignList + 1) ?> to <?php echo min($startRow_rs_DesignList + $maxRows_rs_DesignList, $totalRows_rs_DesignList) ?> of <?php echo $totalRows_rs_DesignList ?></td>
        <td width="124" align="center" valign="middle" class="leftborder" scope="col">
          <table border="0">
            <tr>
              <td><?php if ($pageNum_rs_DesignList > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs_DesignList=%d%s", $currentPage, 0, $queryString_rs_DesignList); ?>"><img src="First.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_rs_DesignList > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_rs_DesignList=%d%s", $currentPage, max(0, $pageNum_rs_DesignList - 1), $queryString_rs_DesignList); ?>"><img src="Previous.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_rs_DesignList < $totalPages_rs_DesignList) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs_DesignList=%d%s", $currentPage, min($totalPages_rs_DesignList, $pageNum_rs_DesignList + 1), $queryString_rs_DesignList); ?>"><img src="Next.gif" /></a>
              <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_rs_DesignList < $totalPages_rs_DesignList) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_rs_DesignList=%d%s", $currentPage, $totalPages_rs_DesignList, $queryString_rs_DesignList); ?>"><img src="Last.gif" /></a>
              <?php } // Show if not last page ?></td>
            </tr>
        </table></td>
      </tr>
    
    </table>
  </form>
</div>

</body>
</html>
<?php
mysql_free_result($rs_DesignList);
?>
