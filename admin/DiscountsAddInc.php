<?php require_once('../Connections/GoCreate.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php
$d = $_POST["expdate"];
$d = explode('-', $d); 
echo "test ".$d = $d[2].'-'.$d[1].'-'.$d[0]; 
?>
<?php 
// WA Application Builder Insert
if (isset($_POST["add"])) // Trigger
{
  $WA_connection = $GoCreate;
  $WA_table = "admin_discount";
  $WA_sessionName = "admin_discount_ID";
  $WA_redirectURL = "Discounts.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "ID";
  $WA_fieldNamesStr = "DISCOUNT_CODE|TYPE|CREDIT|MAX_USE|EXP_DATE";
  $WA_fieldValuesStr = "".((isset($_POST["DiscountCode"]))?$_POST["DiscountCode"]:"")  ."" . "|" . "".((isset($_POST["type"]))?$_POST["type"]:"")  ."" . "|" . "".((isset($_POST["amount"]))?$_POST["amount"]:"")  ."" . "|" . "".((isset($_POST["maxuse"]))?$_POST["maxuse"]:"")  ."" . "|" . "".((isset($_POST["expdate"]))?$d:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|none,none,NULL|none,none,NULL|',none,NULL";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_GoCreate;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id();
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript">
var length=8;
function randomPassword(length)
{
	chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	pass = "";

	for(x=0;x<length;x++)
	{
		i = Math.floor(Math.random() * 36);
		pass += chars.charAt(i);
	} return pass;
}	
function randomP()
{	
	
	document.form1.DiscountCode.value = randomPassword(length);
	return false;
}

function  headerText(NewSel)
	{
	var NewSel; 
	  switch (NewSel) 
	  { 
	  case "amount":
	   	 document.getElementById('Cred_Am').innerHTML = "Credit Amount"; 
		 document.getElementById('am').innerHTML = "&pound;"; 
		 document.getElementById('per').innerHTML = "";
		 document.getElementById('amount').value = ""; 
	 	 break; 
	  case "percent": 
	   	 document.getElementById('Cred_Am').innerHTML = "Discount";
	 	 document.getElementById('per').innerHTML = "%";
		 document.getElementById('am').innerHTML = "";
		 document.getElementById('amount').value = ""; 
		 break; 
	  default: // unknown value -- do nothing 
	   	 document.getElementById('Cred_Am').innerHTML = "";
	 	 document.getElementById('am').innerHTML = ""; 
		 document.getElementById('per').innerHTML = "";
		 document.getElementById('amount').value = ""; 
		  break; 
	  }	
	}
</script>
<script>
$(function(	) {
	$('#type').change(function() {
		if ($('#type').val() == 'amount' || $('#type').val() == 'percent') {
			$("#amount").attr('disabled', '');
		} else {
			$("#amount").attr('disabled', 'disabled');
			$('#amount').val('');

		}
	});
	
	$('#amount').keydown(function(event) {
		
			// Let's stop the user from using certain keys - numbers only
		
			if ((!event.shiftKey && !event.ctrlKey && !event.altKey) && ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) // 0-9 or numpad 0-9, disallow shift, ctrl, and alt
			{
			// check textbox value now and tab over if necessary
			}
			else if (event.keyCode != 8 && event.keyCode != 46 && event.keyCode != 37 && event.keyCode != 39) // not esc, del, left or right
			{
			event.preventDefault();
			} 
					
		if ($('#type').val() == 'amount') {
			
		} 	else if ($('#type').val() == 'percent') {
			if ($('#amount').val() < 0) {
				$('#amount').val(0);
			}
			if ($('#amount').val() > 100) {
				$('#amount').val(100);
			}
		}
		
	});
});

</script>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link type="text/css" href="../webassist/forms/fd_newfromblank_default/Datepicker/css/jquery-ui-1.7.1.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../webassist/forms/fd_newfromblank_default/Datepicker/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../webassist/forms/fd_newfromblank_default/Datepicker/js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#expdate').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy',
		minDate: "-0d:",
		yearRange: "-0:+1",
		onClose: closeDatePicker_expdate,
		//onClose: formatUKDateMySQL(DatePicker_expdate)
	});
});
function closeDatePicker_expdate() {
	var tElm = $('#expdate');
	if (typeof expdate_Spry != null && typeof expdate_Spry != "undefined") {
		expdate_Spry.validate();
	}
	var docElm = document.getElementById("expdate");
	var tBlur = docElm.getAttribute("onBlur");
	if (!tBlur) tBlur = docElm.getAttribute("onblur");
	if (!tBlur) tBlur = docElm.getAttribute("ONBLUR");
	if (tBlur) {
		tBlur = tBlur.replace(/\bthis\b/g, "docElm");
		eval(tBlur);
	}
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../webassist/forms/fd_newfromblank_default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br />
<form action="#" method="POST" name="form1" class="form" id="form1">
<table width="800" border="0" cellpadding="2" cellspacing="0" style="padding-left: 3px; padding-right: 3px;">
  <tr align="center"class="form_txt">
    <td nowrap="nowrap">Discount Code</td>
    <td nowrap="nowrap">Type</td>
    <td nowrap="nowrap"><span id="Cred_Am"></span></td>
    <td nowrap="nowrap">Max use</td>
    <td nowrap="nowrap">Expire Date</td>
    <td colspan="2" nowrap="nowrap">Options</td>
    <td nowrap="nowrap">Auto generate</td>
    </tr>
  <tr>
    <td align="center"><label for="DiscountCode"></label>
      <input name="DiscountCode" type="text" class="form" id="DiscountCode" value=""/></td>
    <td><label for="type"></label>
      <select name="type" class="form" id="type" onchange="headerText(this.value);">
        <option selected="selected">Select</option>
        <option value="amount">Credit Amount</option>
        <option value="percent">Based on Percentage</option>
      </select></td>
      <td align="center" nowrap="nowrap" class="form_txt"><span id="am"></span><input name="amount" type="text" disabled="disabled" class="form" id="amount" size="6" maxlength="3" /><span id="per"></span></td>
    <td align="center" ><input name="maxuse" type="text" class="form" id="maxuse" size="6" maxlength="4" /></td>
    <td align="center"><input name="expdate" type="text" class="form" id="expdate" tabindex="2" size="10" maxlength="10" /></td>
    <td><input name="edit" type="button" class="cust_button" id="edit" value="Edit" /></td>
    <td><input name="delete" type="button" class="cust_button" id="delete" value="Delete" /></td>
    <td><input name="GenerateCode" type="button" class="cust_button" id="GenerateCode" onclick="randomP()" value="Generate Code"/></td>
    </tr>
</table>
<p>
  <input name="add" type="submit" class="cust_button" id="add" value="Submit" />
  <input name="Cancel" type="button" class="cust_button" id="Cancel" onclick="MM_goToURL('parent','Discounts.php');return document.MM_returnValue" value="Cancel" />
</p>
</form>

</body>
</html>