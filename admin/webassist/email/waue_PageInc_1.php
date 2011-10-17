<?php
$MailAttachments = "";
$MailBCC         = "";
$MailCC          = "";
$MailTo          = "";
$MailBodyFormat  = "";
$MailBody        = "";
$MailImportance  = "";
$MailFrom        = "".ucfirst(((isset($_POST["Email_Address"]))?$_POST["Email_Address"]:""))  ."";
$MailSubject     = "Contact Form: ".((isset($_POST["subject"]))?$_POST["subject"]:"")  ."";
$_SERVER["QUERY_STRING"] = "";

//Global Variables

  $WA_MailObject = WAUE_Definition("","","","","","");

if ($RecipientEmail)     {
  $WA_MailObject = WAUE_AddRecipient($WA_MailObject,$RecipientEmail);
}
else      {
  //To Entries
}

//Additional Headers

//Attachment Entries

//BCC Entries

//CC Entries

//Body Format
  $WA_MailObject = WAUE_BodyFormat($WA_MailObject,0);

//Set Importance
  $WA_MailObject = WAUE_SetImportance($WA_MailObject,"3");

//Start Mail Body
$MailBody = $MailBody . "";
$MailBody = $MailBody . (GetFromPage("templates/Block_2.php"));
$MailBody = $MailBody . "";
//End Mail Body

$WA_MailObject = WAUE_SendMail($WA_MailObject,$MailAttachments,$MailBCC,$MailCC,$MailTo,$MailImportance,$MailFrom,$MailSubject,$MailBody,"waue_PageInc_1");

if (isset($_SESSION["waue_PageInc_1_Status"])) {
  $MailLogBindings = new WAUE_Log_Bindings();
  //Start Log Bindings
  //End Log Bindings
  $MailLogBindings->SuccessOrFailure->MailRef = "waue_PageInc_1";
  $MailLogBindings->Success->MailRef = "waue_PageInc_1";
  $MailLogBindings->Failure->MailRef = "waue_PageInc_1";
  $MailLogBindings->processLog(($_SESSION["waue_PageInc_1_Status"] == "Failure"));
}
$WA_MailObject = null;
?>