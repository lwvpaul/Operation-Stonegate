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
		 document.getElementById('amount').value = ""; 
	 	 break; 
	  case "percent":  
	 	 document.getElementById('Cred_Am').innerHTML = "% Discount ";
	 	 document.getElementById('amount').value = ""; 
		 break; 
	  default: // unknown value -- do nothing 
	 	 document.getElementById('Cred_Am').innerHTML = "";
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
		onClose: closeDatePicker_expdate
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
</script>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../webassist/forms/fd_newfromblank_default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br />
<div id="Default_NewFromBlank_Default_ProgressWrapper">
  <form class="NewFromBlank_Default" id="Default_NewFromBlank_Default" name="Default_NewFromBlank_Default" method="post" action="#">
    <!--
WebAssist CSS Form Builder - Form v1
CC: <New From Blank>
CP: Default
TC: <New From Blank>
TP: Default
-->
    <ul class="NewFromBlank_Default">
      <li>
        <fieldset class="NewFromBlank_Default" id="fieldset">
          <legend class="groupHeader"></legend>
          <ul class="formList">
            <li class="formItem"> <span class="fieldsetDescription"> Required * </span> </li>
            <li class="formItem">
              <div class="formGroup">
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="DiscountCode" class="sublabel" > DiscountCode</label>
                    <div class="errorGroup">
                      <div class="fieldPair">
                        <div class="fieldGroup"> <span id="DiscountCode_Spry">
                          <input id="DiscountCode" name="DiscountCode" type="text" value="" class="formTextfield_Medium" tabindex="1" />
                          <span class="textfieldRequiredMsg">Please enter a value</span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="expdate" class="sublabel" > Expiry date<span class="requiredIndicator">&nbsp;*</span></label>
                    <div class="errorGroup">
                      <div class="fieldPair">
                        <div class="fieldGroup"> <span id="expdate_Spry">
                          <input id="expdate" name="expdate" type="text" value="" class="formTextfield_Medium" tabindex="2" />
                          <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldRequiredMsg"> </span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="type" class="sublabel" > type<span class="requiredIndicator">&nbsp;*</span></label>
                    <div class="errorGroup">
                      <div class="fieldPair">
                        <div class="fieldGroup"> <span id="type_Spry">
                          <select class="formMenufield_Medium" name="type" id="type" tabindex="3">
                            <option value="">Select</option>
                            <option value="amount">Credit Amount</option>
                            <option value="percent">Based on Percentage</option>
                          </select>
                          <span class="selectRequiredMsg">Please select a value</span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="amount" class="sublabel" > amount</label>
                    <div class="errorGroup">
                      <div class="fieldPair">
                        <div class="fieldGroup"> <span id="amount_Spry">
                          <input id="amount" name="amount" type="text" value="" class="formTextfield_Medium" tabindex="4" />
                          <span class="textfieldRequiredMsg">Please enter a value</span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="maxuse" class="sublabel" > maxuse</label>
                    <div class="errorGroup">
                      <div class="fieldPair">
                        <div class="fieldGroup"> <span id="maxuse_Spry">
                          <input id="maxuse" name="maxuse" type="text" value="" class="formTextfield_Medium" tabindex="5" />
                          <span class="textfieldRequiredMsg">Please enter a value</span> </span> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="formItem"> <span class="buttonFieldGroup" >
              <input class="formButton" name="Default_submit" type="submit" id="Default_submit" value="Venues"   tabindex="5" />
            </span> </li>
          </ul>
        </fieldset>
      </li>
    </ul>
  </form>
</div>
<div id="Default_NewFromBlank_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
  <script type="text/javascript">
WADFP_SetProgressToForm('Default_NewFromBlank_Default', 'Default_NewFromBlank_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
  <div id="Default_NewFromBlank_Default_ProgressMessage" >
    <p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
  </div>
</div>
<script type="text/javascript">
<!--
var DiscountCode_Spry = new Spry.Widget.ValidationTextField("DiscountCode_Spry", "none", { isRequired:false , validateOn:["blur"]});
var expdate_Spry = new Spry.Widget.ValidationTextField("expdate_Spry", "date", { format:'mm/dd/yyyy' , validateOn:["blur"]});
var type_Spry = new Spry.Widget.ValidationSelect("type_Spry",{validateOn:["change"]});
var amount_Spry = new Spry.Widget.ValidationTextField("amount_Spry", "none", { isRequired:false , validateOn:["blur"]});
var maxuse_Spry = new Spry.Widget.ValidationTextField("maxuse_Spry", "none", { isRequired:false , validateOn:["blur"]});
//-->
</script>
</body>
</html>