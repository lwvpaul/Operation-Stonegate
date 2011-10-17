<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
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

$deleteFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST['Del_ID'])) && ($_POST['Del_ID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM site_editor WHERE ID=%s",
                       GetSQLValueString($_POST['Del_ID'], "int"));

  mysql_select_db($database_GoCreate, $GoCreate);
  $Result1 = mysql_query($deleteSQL, $GoCreate) or die(mysql_error());

  $deleteGoTo = "SiteContent.php";

  header(sprintf("Location: %s", $deleteGoTo));
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE site_editor SET PAGE_NAME=%s, CONTENT=%s, VISABLE=%s WHERE ID=%s",
                       GetSQLValueString($_POST['pageName'], "text"),
                       GetSQLValueString($_POST['editorField'], "text"),
                       GetSQLValueString(isset($_POST['visible']) ? "true" : "", "defined","'Y'","'N'"),
                       GetSQLValueString($_POST['editId'], "int"));

  mysql_select_db($database_GoCreate, $GoCreate);
  $Result1 = mysql_query($updateSQL, $GoCreate) or die(mysql_error());

  $updateGoTo = "SiteContent.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "add")) {
  $insertSQL = sprintf("INSERT INTO site_editor (PAGE_NAME, CONTENT, VISABLE) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['addPageName'], "text"),
                       GetSQLValueString($_POST['addEditor'], "text"),
                       GetSQLValueString(isset($_POST['addPageVisible']) ? "true" : "", "defined","'Y'","'N'"));

  mysql_select_db($database_GoCreate, $GoCreate);
  $Result1 = mysql_query($insertSQL, $GoCreate) or die(mysql_error());

  $insertGoTo = "SiteContent.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



$editID_rs_siteEdit = "";
if (isset($_GET['Edit_ID'])) {
  $editID_rs_siteEdit = (get_magic_quotes_gpc()) ? $_GET['Edit_ID'] : addslashes($_GET['Edit_ID']);

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_siteEdit = sprintf("SELECT * FROM site_editor WHERE site_editor.ID = %s", GetSQLValueString($editID_rs_siteEdit, "int"));
$rs_siteEdit = mysql_query($query_rs_siteEdit, $GoCreate) or die(mysql_error());
$row_rs_siteEdit = mysql_fetch_assoc($rs_siteEdit);
$totalRows_rs_siteEdit = mysql_num_rows($rs_siteEdit);
}

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_siteListFull = "SELECT * FROM site_editor";
$rs_siteListFull = mysql_query($query_rs_siteListFull, $GoCreate) or die(mysql_error());
$row_rs_siteListFull = mysql_fetch_assoc($rs_siteListFull);
$totalRows_rs_siteListFull = mysql_num_rows($rs_siteListFull);

mysql_select_db($database_GoCreate, $GoCreate);
$query1_rs_siteListFull = "SELECT * FROM site_editor";
$rs1_siteListFull = mysql_query($query1_rs_siteListFull, $GoCreate) or die(mysql_error());
$row1_rs_siteListFull = mysql_fetch_assoc($rs1_siteListFull);
$totalRows1_rs_siteListFull = mysql_num_rows($rs1_siteListFull);


 require_once("../webassist/ckeditor/ckeditor.php"); ?>
<head>
<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/acl.css" rel="stylesheet" type="text/css" />
</head>

<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<fieldset>
<legend><a name="editPage" id="editPage"></a>Edit a Page</legend>
    <input name="editId" type="hidden" value="<?php if (isset($editID_rs_siteEdit)) { echo $editID_rs_siteEdit; } ?>">
    <label for="pageList">Select a page to edit</label>
    <select name="pageList" id="pageList" onchange="window.location.href='SiteContent.php?Edit_ID='+this.options[this.selectedIndex].value;">
      <option value="">Select a page to edit</option>
      <?php
 
	do {
		?>
      <option value="<?php	echo $row_rs_siteListFull['ID'] ?>" <?php	if (isset($editID_rs_siteEdit) && $editID_rs_siteEdit == $row_rs_siteListFull['ID']) echo " selected"; ?>><?php echo $row_rs_siteListFull['PAGE_NAME']; ?>
        
        
      </option>
      <?php
	} while ($row_rs_siteListFull = mysql_fetch_assoc($rs_siteListFull));
?>
    </select>
    <br />
<?php if (isset($editID_rs_siteEdit) && $editID_rs_siteEdit != "") { ?>
	    <label for="pageName">Page Name:</label>
    <input type="text" name="pageName" id="pageName" value="<?php echo $row_rs_siteEdit['PAGE_NAME']; ?>"     <?php
if (isset($editID_rs_siteEdit) && $row_rs_siteEdit['EDIT'] == "1") {
	echo "disabled=\"disabled\""; 
}

?>/>



  <br />
<?php if (isset($editID_rs_siteEdit) && $editID_rs_siteEdit != "") { ?>
    <label for="visible"><br />
      Visible?</label>
    <input type="checkbox" name="visible" <?php
if (isset($editID_rs_siteEdit) && $row_rs_siteEdit['EDIT'] == "1" && $editID_rs_siteEdit != "") {
	echo "disabled=\"disabled\""; 
}
?>id="visible" <?php if ($row_rs_siteEdit['VISABLE'] == "Y") { echo "checked"; } ?> />
<?php
}
?>
    <br />
    <br />
      <br />
<?php if (isset($editID_rs_siteEdit) && $editID_rs_siteEdit != "") { ?>
<?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".$row_rs_siteEdit['CONTENT']  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Add Site Content";
$CKEditor_config["wa_preset_file"] = "AddSiteContent.xml";
$CKEditor_config["width"] = "90%";
$CKEditor_config["height"] = "200px";
$CKEditor_config["skin"] = "kama";
$CKEditor_config["uiColor"] = "#006633";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["contentsLanguage"] = "";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&showsidebar=false";
$CKEditor_config["toolbar"] = array(
array( 'Source','-','NewPage','Preview'),
array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'),
array( 'Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
('/'),
array( 'Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
('/'),
array( 'Styles','Format','Font','FontSize'),
array( 'TextColor','BGColor'),
array( 'Maximize','ShowBlocks','-'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("editorField", $CKEditor_initialValue, $CKEditor_config);
?>
<?php
}
?>

    <input type="submit" name="edit" id="edit" value="Edit Page">
  
    <input type="hidden" name="MM_update" value="form1">
    
    
     <?php

if ($row_rs_siteEdit['EDIT'] == "4") {
?>
	<input type="button" id="edit" value="Delete Page" onClick="window.location.href='SiteContentDelete.php?Pg_ID=<?php echo $editID_rs_siteEdit; ?>'" />
	<?php
}
?>
<?php } ?>
</fieldset>
</form>

 <br /><br />
 <?php
if (!isset($_GET['Edit_ID']) &&	!isset($_GET['Del_ID'])) {
		?>
 <form name="add" action="<?php echo $editFormAction; ?>" method="POST">
 <fieldset><legend>Add a Page</legend>
   <label for="addPageName">Page Name</label>
   <input type="text" name="addPageName" id="addPageName" />
   <br />
   <label for="addPageVisible"><br />
    Visible?</label>
   <input type="checkbox" name="addPageVisible" id="addPageVisible" />
   <br />
<br />
 <?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "Place your content here...";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Add Site Content";
$CKEditor_config["wa_preset_file"] = "AddSiteContent.xml";
$CKEditor_config["width"] = "90%";
$CKEditor_config["height"] = "300px";
$CKEditor_config["skin"] = "kama";
$CKEditor_config["uiColor"] = "#006633";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&showsidebar=false";
$CKEditor_config["toolbar"] = array(
array( 'Source','-','NewPage','Preview'),
array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'),
array( 'Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
('/'),
array( 'Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
('/'),
array( 'Styles','Format','Font','FontSize'),
array( 'TextColor','BGColor'),
array( 'Maximize','ShowBlocks','-'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("addEditor", $CKEditor_initialValue, $CKEditor_config);
?>
 <br />
 <input type="submit" name="addPage" id="addPage" value="Add Page" />
  <input type="hidden" name="MM_insert" value="add" />
 </fieldset>

</form>
<?php
}
?>
<br /><br />
<?php
if (!isset($_GET['Edit_ID']) &&	!isset($_GET['Del_ID'])) {
		?>
 <form name="delete" action="<?php echo $deleteFormAction; ?>" method="POST">
 <fieldset><legend>Delete a Page</legend>
 <select id="Del_ID" name="Del_ID">
 <option value="" selected>Select a page to delete</option>
 <?php
 do {
	 ?>
     <option value="<?php echo $row1_rs_siteListFull['ID']; ?>" <?php if ($row1_rs_siteListFull['EDIT'] < 3) { echo "disabled=\"disabled\""; } ?>><?php echo $row1_rs_siteListFull['PAGE_NAME']; ?></option>
     <?php
 } while ($row1_rs_siteListFull = mysql_fetch_assoc($rs1_siteListFull));
?>
</select>
 <input name="DeletePage" type="submit" value="Delete" />
 </fieldset>

</form>
<?php
	}
?>
<?php

if (isset($editID_rs_siteEdit) && $editID_rs_siteEdit != "") {
mysql_free_result($rs_siteEdit);
}
mysql_free_result($rs1_siteListFull);
mysql_free_result($rs_siteListFull);

?>
