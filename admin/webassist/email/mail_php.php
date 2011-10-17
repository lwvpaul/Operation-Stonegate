<?php
function WAUE_AddAttachment($mailObj,$attPath)     {
  if ($attPath && $attPath != "") {
    $fileArr = explode("|WA|",$attPath);
	if (WAUE_isAttachment($fileArr[sizeof($fileArr)-1]))  {
      switch (sizeof($fileArr))     {
        case 4:
          $mailObj->attachments[] = array($fileArr[0], $fileArr[1], $fileArr[2], $fileArr[3]);
          break;
        case 3:
          $mailObj->attachments[] = array("application/octet-stream", $fileArr[0], $fileArr[1], $fileArr[2]);
          break;
        case 2:
          $mailObj->attachments[] = array("application/octet-stream", "base64", $fileArr[0], $fileArr[1]);
          break;
        default:
          $mailObj->attachments[] = array("application/octet-stream", "base64", "", $fileArr[0]);
      }
	}
  }
  return $mailObj;
}

function WAUE_AddBCC($mailObj,$bccEmail)      {
  if ($bccEmail != "")     {
    $bccArray = WA_getEmailArray($bccEmail);
    for ($bcc=0; $bcc < sizeof($bccArray); $bcc++)     {
      if (WAUE_isEmailAddress($bccArray[$bcc][1])) {
        $mailObj->bccrecip[] = array($bccArray[$bcc][1], $bccArray[$bcc][0]);
      }
    }
  }
  return $mailObj;
}

function WAUE_AddCC($mailObj,$ccEmail)      {
  if ($ccEmail != "")     {
    $ccArray = WA_getEmailArray($ccEmail);
    for ($cc=0; $cc<sizeof($ccArray); $cc++)     {
      if (WAUE_isEmailAddress($ccArray[$cc][1])) {
        $mailObj->ccrecip[] = array($ccArray[$cc][1], $ccArray[$cc][0]);
      }
    }
  }
  return $mailObj;
}

function WAUE_AddRecipient($mailObj,$recEmail)      {
  if ($recEmail != "")     {
    $recArray = WA_getEmailArray($recEmail);
    for ($rec=0; $rec<sizeof($recArray); $rec++)     {
      if (WAUE_isEmailAddress($recArray[$rec][1])) {
        $mailObj->recipients[] = array($recArray[$rec][1], $recArray[$rec][0]);
      }
    }
  }
  return $mailObj;
}

function WAUE_BodyFormat($mailObj,$bodyFormat)      {
  $mailObj->BodyFormat = $bodyFormat;
  return $mailObj;
}

function WAUE_Definition($serverName,$serverPort,$organization,$xMailer,$useAddParams,$charSet="notdefined")     {
  $mailObj = new WA_MAILOBJ($serverName,$serverPort,$organization,$xMailer,$useAddParams,$charSet);
  return $mailObj;
}

class WA_MAILOBJ {
  var $SMTP;
  var $Port;
  var $ReturnPath;
  var $ReplyTo;
  var $Organization;
  var $XMailer;
  var $CharSet;
  var $Importance;
  var $BodyFormat;
  var $attachments;
  var $recipients;
  var $ccrecip;
  var $bccrecip;
  var $useAddParams;
  function WA_MAILOBJ($serverName,$serverPort,$organization,$xMailer,$useAddParams,$charSet) {
    if ($charSet == "notdefined") {
      $charSet = $useAddParams;
      $useAddParams = "";
    }
    $this->SMTP         = $serverName;
    $this->Port         = $serverPort;
    $this->ReturnPath   = "";
    $this->ReplyTo      = "";
    $this->Organization = $organization;
    $this->XMailer      = $xMailer;
    $this->CharSet      = $charSet;
    if ($serverName != "") ini_set("SMTP", $serverName);
    if ($serverPort != "") ini_set("smtp_port", $serverPort); 
    $this->Importance = "";
    $this->BodyFormat = "";
    $this->attachments = array();
    $this->recipients  = array();
    $this->ccrecip     = array();
    $this->bccrecip    = array();
    $this->useAddParams = $useAddParams;
  }
}

function WAUE_SendMail($mailObj,$mailAttachments,$mailBCC,$mailCC,$mailTo,$mailImportance,$mailFrom,$mailSubject,$mailBody,$mailRef="WAUE")     {
	$fromArray = WA_getEmailArray($mailFrom);
	$mailTo2 = "";
	$mailContent = "";
	$mailHeader = "";
	$mailFrom = $fromArray[0][1];
	
	if ($mailObj->ReturnPath == "")  {
		$mailObj->ReturnPath = $fromArray[0][1];
	}
	if ($mailObj->ReplyTo == "")  {
		$mailObj->ReplyTo = $fromArray[0][1];
	}
	$isIIS =  (isset($_SERVER['SERVER_SOFTWARE']) && stristr($_SERVER['SERVER_SOFTWARE'],'microsoft'));
	if ($isIIS) {
		$lineEnd = "\r\n";
	}else{
		$lineEnd = "\n";
	} 
	
	if ($fromArray[0][0] != "")     {
		$mailFrom = $fromArray[0][0]." <".$fromArray[0][1].">";
		if($isIIS) $mailFrom = $fromArray[0][1];
	}
	
	$mailHeader .= "MIME-Version: 1.0".$lineEnd;
	if (sizeof($mailObj->attachments) > 0 && is_array($mailObj->attachments[0]))     {
		$mailHeader .= "Content-Type: multipart/mixed";
		if ($mailObj->CharSet != "") $mailHeader .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"");
		$mailHeader .= "; boundary=\"WAMULTIBREAKWA\"".$lineEnd;
	}
	else if ($mailObj->BodyFormat == 2 || $mailObj->BodyFormat == 0) {
		$mailHeader .= "Content-Type: multipart/alternative";
		if ($mailObj->CharSet != "") $mailHeader .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"");
		$mailHeader .= "; boundary=\"WAMULTIBREAKWA\"".$lineEnd;
		$headers  = "";
	}
	else {
		if ($mailObj->BodyFormat == 1) $mailHeader .= "Content-Type: text/plain";
		if ($mailObj->CharSet != "") $mailHeader .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"").$lineEnd;
		else $mailHeader .= $lineEnd;
	}
	
	foreach ($mailObj->recipients AS $emailArr) {
		if ($mailTo != "") $mailTo .= ", ";
		if ($mailTo2 != "") $mailTo2 .= ", ";
		if ($emailArr[0] != "") $mailTo .= $emailArr[0];
		if ($emailArr[1] != "" && ! $isIIS)  $mailTo2 .= $emailArr[1]." <".$emailArr[0].">"; 
		else $mailTo2 .= $emailArr[0];
	}
	
	if (strpos($mailTo2, "@")) {
		$mailTo = $mailTo2;
	}
	$mailHeader .= preg_replace("/[\r\n]/", "", "From: ".$mailFrom).$lineEnd;
	
	foreach ($mailObj->ccrecip AS $emailArr) {
		if ($mailCC != "") $mailCC .= ", ";
		if ($emailArr[1] != "" && ! $isIIS) $mailCC .= $emailArr[1]." <".$emailArr[0].">";
		else $mailCC .= $emailArr[0];
	}
	if (strpos($mailCC, "@")) {
		$mailHeader .= preg_replace("/[\r\n]/", "", "Cc: ".$mailCC).$lineEnd;
	}
	
	foreach ($mailObj->bccrecip AS $emailArr) {
		if ($mailBCC != "") $mailBCC .= ", ";
		if ($emailArr[1] != "" && ! $isIIS) $mailBCC .= $emailArr[1]." <".$emailArr[0].">";
		else $mailBCC .= $emailArr[0];
	}
	if (strpos($mailBCC, "@")) {
		$mailHeader .= preg_replace("/[\r\n]/", "", "Bcc: ".$mailBCC).$lineEnd;
	}
	
	$mailHeader .= preg_replace("/[\r\n]/", "", "Reply-To: ".$mailObj->ReplyTo).$lineEnd;
	$mailHeader .= preg_replace("/[\r\n]/", "", "Return-Path: ".$mailObj->ReturnPath."").$lineEnd;
	$mailHeader .= preg_replace("/[\r\n]/", "", "X-Sender: ".$mailFrom).$lineEnd;
	$mailHeader .= preg_replace("/[\r\n]/", "", "X-Priority: ".$mailObj->Importance).$lineEnd;
	$mailHeader .= "Date: ". date('r (T)').$lineEnd;
	
	$theMSGID = $fromArray[0][1];
	$theMSGID = explode("@", $theMSGID);
	if (sizeof($theMSGID)==1) $theMSGID[] = $theMSGID[0];
	$theMSGID = "<".rand().".".md5($theMSGID[0])."@".$theMSGID[1].">";
	$mailHeader .= preg_replace("/[\r\n]/", "", "Message-ID: ".$theMSGID).$lineEnd;
	
	if ($mailObj->Organization != "") {
		$mailHeader .= preg_replace("/[\r\n]/", "", "Organization: ".$mailObj->Organization).$lineEnd;
	}
	if ($mailObj->XMailer != "") {
		$mailHeader .= preg_replace("/[\r\n]/", "", "X-Mailer: ".$mailObj->XMailer).$lineEnd;
	}
	if ($mailObj->BodyFormat == 2 || $mailObj->BodyFormat == 0 || sizeof($mailObj->attachments) > 0)     {
		$mailContent = $lineEnd."--WAMULTIBREAKWA".$lineEnd;
		switch ($mailObj->BodyFormat)   {
			case 0:
			case 2:
				$splitBreak = "--WAMULTIBREAKWA";
				if (sizeof($mailObj->attachments) > 0)  {
					$mailContent .= "Content-Type: multipart/alternative";
					if ($mailObj->CharSet != "") $mailHeader .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"");
					$mailContent .= '; boundary="WAATTBREAKWA"'.$lineEnd.$lineEnd."--WAATTBREAKWA".$lineEnd;
					$splitBreak = "--WAATTBREAKWA";
				}
				$mailContent .= "Content-Type: text/plain";
				if ($mailObj->CharSet != "") $mailContent .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"").$lineEnd;
				else $mailContent .= $lineEnd;
				$mailContent .= "Content-Transfer-Encoding: 8bit".$lineEnd;
				$theReplace  = $lineEnd.$splitBreak.$lineEnd;
				$theReplace .= "Content-Type: text/html";
				if ($mailObj->CharSet != "") $theReplace .= "; charset=\"".$mailObj->CharSet."\"";
				$theReplace  .= $lineEnd.$lineEnd;
				if (strpos($mailBody,"<multipartbreak>") === false)  {
					$mailBody = WA_StripTags($mailBody) . "<multipartbreak>" . $mailBody;
				}
				$mailBody    = str_replace("<multipartbreak>", $theReplace, $mailBody);
				$mailContent .= $lineEnd.$mailBody;
				$mailContent .= $lineEnd.$splitBreak."--".$lineEnd;
				break;
			case 1:
				$mailContent .= "Content-Type: text/plain";
				if ($mailObj->CharSet != "") $mailContent .= preg_replace("/[\r\n]/", "", "; charset=\"".$mailObj->CharSet."\"").$lineEnd;
				else $mailContent .= $lineEnd;
				$mailContent .= "Content-Transfer-Encoding: 8bit".$lineEnd;
				$mailContent .= $lineEnd.$mailBody;
				break;
		}
	}
	else {
		$mailContent .= $mailBody;
	}
	if(sizeof($mailObj->attachments) > 0)    {
		foreach ($mailObj->attachments as $fileArr)    {
			if (is_readable($fileArr[3]))    {
				if (strtolower($fileArr[1]) == "base64")     {
					$data = chunk_split(base64_encode(implode("", file($fileArr[3]))));
				}
				else     {
					$data = implode("", file($fileArr[3]));
				}
				$mailAttachments .= $lineEnd."--WAMULTIBREAKWA";
				$mailAttachments .= $lineEnd."Content-Type: ".$fileArr[0];
				if ($fileArr[2] != "")  {
					$mailAttachments .= "; name=\"".basename($fileArr[2])."\"".$lineEnd;
				}
				else  {
					$mailAttachments .= "; name=\"".basename($fileArr[3])."\"".$lineEnd;
				}
				$mailAttachments .= "Content-Transfer-Encoding: ".$fileArr[1].$lineEnd;
				$mailAttachments .= "Content-Disposition: inline;";
				if ($fileArr[2] != "")  {
					$mailAttachments .= " filename=\"".basename($fileArr[2])."\"".$lineEnd.$lineEnd;
				}
				else  {
					$mailAttachments .= " filename=\"".basename($fileArr[3])."\"".$lineEnd.$lineEnd;
				}
				$mailAttachments .= $data;
			}
		}
	}
	$mailContent = str_replace("<multipartbreak>", "--WAMULTIBREAKWA".$lineEnd, $mailContent);
	$mailHeader  = str_replace("<multipartbreak>", "--WAMULTIBREAKWA".$lineEnd, $mailHeader);
	$mailContent = $mailContent.$mailAttachments;
	
	session_commit();
	session_start();
	if (!isset($_SESSION[$mailRef."_Index"] )) $_SESSION[$mailRef."_Index"]  = 1;
	if (!isset($_SESSION[$mailRef."_Log"] ) || $_SESSION[$mailRef."_Index"]  == 1) $_SESSION[$mailRef."_Log"]  = "";
	$_SESSION[$mailRef."_From"] = $mailFrom;
	$_SESSION[$mailRef."_To"] = $mailTo;
	$_SESSION[$mailRef."_Subject"] = $mailSubject;
	$_SESSION[$mailRef."_Body"] = $mailContent;
	$_SESSION[$mailRef."_Header"] = $mailHeader;
	$_SESSION[$mailRef."_Log"] .=  "Sending To: " .$mailTo  . "... ";
	set_error_handler(create_function('$errno, $errstr','$_SESSION["'.$mailRef.'_Error"] = ($errstr); return true;'));
	if ($mailObj->useAddParams) {
		$mailObj = @mail($mailTo,$mailSubject,$mailContent,$mailHeader,"-f".$mailFrom);
	}
	else {
		$mailObj = @mail($mailTo,$mailSubject,$mailContent,$mailHeader);
	}
	restore_error_handler();
	if ( $mailObj)  {
		$_SESSION[$mailRef."_Status"] = "Success";
		$_SESSION[$mailRef."_Log"] .=  "Success <br>\n";
	}
	else  {
		$_SESSION[$mailRef."_Status"] = "Failure";
		$_SESSION[$mailRef."_Log"] .=  $_SESSION[$mailRef."_Error"]. " - Failure <br>\n";
	}
	return $mailObj;
}

function WAUE_SetImportance($mailObj,$Importance)     {
  $newPriority = 3;
  if (!is_numeric($Importance))     {
    if (strtoupper($Importance) == "HIGH")     {
      $newPriority = 1;
    }
    if (strtoupper($Importance) == "LOW")     {
      $newPriority = 5;
    }
  }
  else     {
    $newPriority = $Importance;
  }
  
  $mailObj->Importance = $newPriority;
  return $mailObj;
}
?>