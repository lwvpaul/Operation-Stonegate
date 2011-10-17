<?php 
// TEST VAR 
// echo "id= ".$_GET['ID']."<br />";
$_SESSION['CatCounter']++; --$_SESSION['CatCounter'];?>
<select name="MENU_LEVEL_<?php echo $_SESSION['CatCounter']; ?>" id="MENU_LEVEL_<?php echo $_SESSION['CatCounter']; ?>" <?php if ($_GET['dis']=="Y") {echo "disabled=\"disabled\"";}?> class="form" >
<?php require_once('../../../Connections/GoCreate.php'); ?>
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

	/////////////////////IJS GSNET/////////////////////////
	// IF SENT FROM AN EDIT PAGE : SET DROP DOWN DEFAULT //
	///////////////////////////////////////////////////////
    // $colname_RS_DEFSEL = 141; // TEST VAR FOR LOADING INCLUDE ON ITS OWN
	

if (isset($_GET['ID'])) {
  $colname_RS_DEFSEL = (get_magic_quotes_gpc()) ? $_GET['ID'] : addslashes($_GET['ID']);
}
mysql_select_db($database_GoCreate, $GoCreate);
$query_RS_DEFSEL = sprintf("SELECT * FROM product_cats WHERE ID = %s", GetSQLValueString($colname_RS_DEFSEL, "int"));
$RS_DEFSEL = mysql_query($query_RS_DEFSEL, $GoCreate) or die(mysql_error());
$row_RS_DEFSEL = mysql_fetch_assoc($RS_DEFSEL);
$totalRows_RS_DEFSEL = mysql_num_rows($RS_DEFSEL);
	
	/////////////////////////IJS GSNET////////////////////////////
	// GET ALL CATEGORY RECORDS TO GET TOTAL COUNT FOR LOOP VAR //
	//////////////////////////////////////////////////////////////
	
	$maxRows_RS_ALLCATS = 100;
$pageNum_RS_ALLCATS = 0;
if (isset($_GET['pageNum_RS_ALLCATS'])) {
  $pageNum_RS_ALLCATS = $_GET['pageNum_RS_ALLCATS'];
}
$startRow_RS_ALLCATS = $pageNum_RS_ALLCATS * $maxRows_RS_ALLCATS;

mysql_select_db($database_GoCreate, $GoCreate);
$query_RS_ALLCATS = "SELECT * FROM product_cats ORDER BY ID ASC";
$query_limit_RS_ALLCATS = sprintf("%s LIMIT %d, %d", $query_RS_ALLCATS, $startRow_RS_ALLCATS, $maxRows_RS_ALLCATS);
$RS_ALLCATS = mysql_query($query_limit_RS_ALLCATS, $GoCreate) or die(mysql_error());
$row_RS_ALLCATS = mysql_fetch_assoc($RS_ALLCATS);

if (isset($_GET['totalRows_RS_ALLCATS'])) {
  $totalRows_RS_ALLCATS = $_GET['totalRows_RS_ALLCATS'];
} else {
  $all_RS_ALLCATS = mysql_query($query_RS_ALLCATS);
  $totalRows_RS_ALLCATS = mysql_num_rows($all_RS_ALLCATS);
}
$totalPages_RS_ALLCATS = ceil($totalRows_RS_ALLCATS/$maxRows_RS_ALLCATS)-1;
			
     /////////////////////////***IJS GSNET***/////////////////////////////
	 // START LOOP BASED ON TOTAL NUMBER OF ENTRIES IN CATEGORIES TABLE //
	 //         BASED ON RESULTS FROM RS_ALLCATS RECORDSET              //
	 /////////////////////////////////////////////////////////////////////
  	
	 //     ADD MAIN CATERGORY OPTION NEW CATERGORY HAS BEEN ADDED      //
		if ($_GET['CAT']=="I") { echo "<option value=\"\">Please Select</option>\n<option value=\"0\" >Main Catergory</option>\n";}
		if ($_GET['CAT']=="U") { echo "<option value=\"0\" >Main Catergory</option>\n";}		
		elseif (!isset($_GET['ID'])&&!$_GET['CAT']) {echo "<option value=\"\" >Please Select</option>\n";}
		
	// START MASTER LOOP //
	do {	
	// SET ID FOR EACH MASTER LOOP
	$_SESSION['memuloop'] = $row_RS_ALLCATS['ID'];
	
		if ($_GET['ID'] == $row_RS_ALLCATS['ID'])
			{
					if ($row_RS_ALLCATS['MENU_LEVEL']==0) {echo '<option value="'.$row_RS_ALLCATS['ID'].'" selected="selected" >';}
					else {
						 if ($_GET['CAT']=="U") { 
								echo'<option value="'.$row_RS_ALLCATS['ID'].'" selected="selected" >';
												} else {							
								echo'<option value="'.$row_RS_ALLCATS['MENU_LEVEL'].'" selected="selected" >';
													    }
						}
			} else {
					if ($row_RS_ALLCATS['MENU_LEVEL']==0) {echo '<option value="'.$row_RS_ALLCATS['ID'].'">';}
					else { 
							if ($_GET['CAT']=="I" || $_GET['DES']) { 
								echo'<option value="'.$row_RS_ALLCATS['ID'].'">';
												} else {							
								echo'<option value="'.$row_RS_ALLCATS['MENU_LEVEL'].'">';
							}			   
			             }
			       }
	// START LOOP TO COMPILE COMPLETE PATH FOR EACH CATEGORY //
		$prntcnt =1;
				do {
		$colname_RS_SELCAT = "-1";
	if (isset($_SESSION['memuloop'])) {
	  $colname_RS_SELCAT = (get_magic_quotes_gpc()) ? $_SESSION['memuloop'] : addslashes($_SESSION['memuloop']);
	}
	mysql_select_db($database_GoCreate, $GoCreate);
	$query_RS_SELCAT = sprintf("SELECT * FROM product_cats WHERE ID = %s", GetSQLValueString($colname_RS_SELCAT, "int"));
	$RS_SELCAT = mysql_query($query_RS_SELCAT, $GoCreate) or die(mysql_error());
	$row_RS_SELCAT = mysql_fetch_assoc($RS_SELCAT);
	$totalRows_RS_SELCAT = mysql_num_rows($RS_SELCAT);
		
		if ($prntcnt!=1) {echo ' << ';}
		if (($row_RS_DEFSEL['ID']==$row_RS_ALLCATS['ID'])&&($row_RS_DEFSEL['MENU_LEVEL'] ==0)&&$_GET['CAT']=="U") 
			{
			echo "Self - Main Category ";
			} else {
			echo $row_RS_SELCAT['TITLE_NAME'];
			} 
			$_SESSION['memuloop'] = $row_RS_SELCAT['MENU_LEVEL'];
				++$prntcnt;
				//echo " loop2 = ".$row_RS_SELCAT['MENU_LEVEL'];
			} while ($_SESSION['memuloop'] != 0);
		
		//  END LOOP TO COMPILE COMPLETE PATH FOR EACH CATEGORY //
		
		echo "</option>\n";
	  
	} while ($row_RS_ALLCATS = mysql_fetch_assoc($RS_ALLCATS)); 
	
	// END LOOP BASED ON TOTAL NUMBER OF ENTRIES IN CATEGORIES TABLE //
	
	 $_SESSION['CatCounter']++;
	?>
</select>
 <?php  unset($_SESSION['memuloop']);
@mysql_free_result($RS_DEFSEL);
@mysql_free_result($RS_ALLCATS);
@mysql_free_result($RS_SELCAT);
?>