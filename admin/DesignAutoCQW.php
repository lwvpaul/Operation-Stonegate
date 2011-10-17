<?php require_once('../Connections/GoCreate.php'); ?>
<?php

// let's take his SQL clean function
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

// The Des Type ID
if (isset($_GET['DT_ID'])) {
  $colname_rs_DesignType = (get_magic_quotes_gpc()) ? $_GET['DT_ID'] : addslashes($_GET['DT_ID']);
}
// The Admin Des Type ID
if (isset($_GET['A_DT_ID'])) {
  $colname_rs_AdminType = (get_magic_quotes_gpc()) ? $_GET['A_DT_ID'] : addslashes($_GET['A_DT_ID']);
}
// The Design ID
if (isset($_GET['DES_ID'])) {
  $colname_rs_DesId = (get_magic_quotes_gpc()) ? $_GET['DES_ID'] : addslashes($_GET['DES_ID']);
}
// The Design Name
if (isset($_GET['Name'])) {
  $colname_rs_DesignName = (get_magic_quotes_gpc()) ? $_GET['Name'] : addslashes($_GET['Name']);
}

// Do the Admin Media Size query

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_AdminType = sprintf("SELECT * FROM admin_media_sizes WHERE F_ID = %s", GetSQLValueString($colname_rs_AdminType, "int"));
$rs_AdminType = mysql_query($query_rs_AdminType, $GoCreate) or die(mysql_error());
$row_rs_AdminType = mysql_fetch_assoc($rs_AdminType);
$totalRows_rs_AdminType = mysql_num_rows($rs_AdminType);


// Check if the sizes exist in the database for this design and Type ID

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_SizeCheck = sprintf("SELECT des_res_size.ID,  des_res_size.TYPE_ID,  des_res_size.A_TYPE_ID,  des_res_size.A_SIZE_ID,  des_res_size.DESIGN_ID,  des_res_size.SELECTED,  admin_media_sizes.ID AS AMS_ID,  admin_media_sizes.MEDIA_SIZE AS AMS_MEDIA_SIZES,  admin_media_sizes.F_ID AS AMS_F_ID FROM  des_res_size  RIGHT JOIN admin_media_sizes ON admin_media_sizes.F_ID = des_res_size.A_TYPE_ID WHERE des_res_size.TYPE_ID = %s AND des_res_size.DESIGN_ID = ". $colname_rs_DesId ."", GetSQLValueString($colname_rs_DesignType, "int"));
$rs_SizeCheck = mysql_query($query_rs_SizeCheck, $GoCreate) or die(mysql_error());
$row_rs_SizeCheck = mysql_fetch_assoc($rs_SizeCheck);
$totalRows_rs_SizeCheck = mysql_num_rows($rs_SizeCheck);

// Let's begin the size loop
if ($totalRows_rs_SizeCheck == 0) {
  // Start the loop by getting each of the sizes for this available type from the admin table
  

  // Reset the sql internal iterator to 0
  mysql_data_seek($rs_AdminType, 0);

  // let's start the auto CQW
  while ($row_rs_AdminType = mysql_fetch_assoc($rs_AdminType)) {
    $insertSize = "";
    // let's double check as we go through

        // Available vars
        //
        //
      mysql_select_db($database_GoCreate, $GoCreate);
      $query_rs_SizeInsert = "
      INSERT IGNORE INTO `des_res_size`
        SET `ID` = NULL,
        `TYPE_ID` = ". $colname_rs_DesignType . ",
        `A_TYPE_ID` = ". $row_rs_AdminType['F_ID'] . ",
        `A_SIZE_ID` = ". $row_rs_AdminType['ID'] .",
        `DESIGN_ID` = ". $colname_rs_DesId . ",
        `SELECTED` = 'Y'";
     // echo $query_rs_SizeInsert;
      mysql_query($query_rs_SizeInsert, $GoCreate) or die(mysql_error());
      $insertSize = mysql_insert_id();
      
      // let's check if there are CQW's for this type
      // Replacing the function that a typical url below would do
      // DesignCQWListDB.php?DES_ID=2054&Name=Food Offers Placemat&DS_ID=6775&A_DS_ID=61&DT_ID=2012&A_DT_ID=54

        $query_rs_CQWCheck = sprintf("SELECT * FROM admin_media_cqw WHERE F_ID = %s", GetSQLValueString($row_rs_AdminType['F_ID'], "int"));
        $rs_CQWCheck = mysql_query($query_rs_CQWCheck, $GoCreate);
        // $row_rs_CQWCheck = mysql_fetch_assoc($rs_CQWCheck);
        // $totalRows_rs_CQWCheck = mysql_num_rows($rs_CQWCheck);
        if (isset($insertSize)) {
          // Reset the CQW to the start again
          mysql_data_seek($rs_CQWCheck, 0);
          while ($row_rs_CQWCheck = mysql_fetch_assoc($rs_CQWCheck)) {           
              //  echo $row_rs_CQWCheck['ID'];
                mysql_select_db($database_GoCreate, $GoCreate);
                $query_rs_CQWInsert = "
                  INSERT IGNORE INTO `des_res_cost`
                    SET `ID` = NULL,
                    `A_SIZE_ID` = ". $row_rs_AdminType['ID'] .", 
                    `COST` = ". $row_rs_CQWCheck['COST'].", 
                    `DESIGN_ID` = ". $colname_rs_DesId.", 
                    `TYPE_ID` = ". $colname_rs_DesignType .", 
                    `SIZE_ID` = ". $insertSize .", 
                    `SELECTED` = 'Y', 
                    `LIMIT` = '". $row_rs_CQWCheck['LIMIT']."', 
                    `QTY` = ". $row_rs_CQWCheck['QTY'].", 
                    `WEIGHT` = ". $row_rs_CQWCheck['WEIGHT']."";

                mysql_query($query_rs_CQWInsert, $GoCreate) or die(mysql_error());

          }
        }
  }
} 

  // Send them back to the Design Size List - if a design type exists the insert will be skipped.
   header ("Location: DesignSizeList.php?DT_ID=".$colname_rs_DesignType."&A_DT_ID=". $colname_rs_AdminType ."&DES_ID=". $colname_rs_DesId ."&Name=". $colname_rs_DesignName ."");
   exit();
?>