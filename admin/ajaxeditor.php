<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<label for="textcat_<?php echo $RepeatSelectionCounter_1; ?>"></label>
<?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "GoCreateCat";
$CKEditor_config["wa_preset_file"] = "GoCreateCat.xml";
$CKEditor_config["width"] = "100%";
$CKEditor_config["height"] = "300px";
$CKEditor_config["skin"] = "office2003";
$CKEditor_config["uiColor"] = "#009900";
$CKEditor_config["docType"] = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 2;
$CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&startup_folder=../images/CatImg";
$CKEditor_config["toolbar"] = array(
array( 'Source','Preview','Templates'),
array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'),
array( 'Undo','Redo','Find','Replace','SelectAll','RemoveFormat'),
array( 'Image','Table','HorizontalRule','SpecialChar'),
('/'),
array( 'Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'TextColor','BGColor'),
('/'),
array( 'Styles','Format','Font','FontSize'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("editorField", $CKEditor_initialValue, $CKEditor_config);
?>
</body>
</html>s