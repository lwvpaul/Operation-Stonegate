<?php
/*
-----------------------------------------------------------------------------
-    File Name:
-        WAFV_Scripts_PHP.php
-
-    Description:
-        Shared functions for WA Form Validations - Server Side PHP
-
-    This file contains proprietary and confidential information from WebAssist.com
-    corporation.  Any unauthorized reuse, reproduction, or modification without
-    the prior written consent of WebAssist.com is strictly prohibited.
-
-    Copyright 2004 WebAssist.com Corporation.  All rights reserved.
-----------------------------------------------------------------------------
*/
function SaveFormToSession($theErrors, $valPage)  {
  $postVars = "";
  $formVars = array_keys($_POST);
  $loopInde = 0;
  foreach ($formVars as $theKey) {
    $toAdd = "WAVT_".($theKey)."=".($_POST[$theKey]);
    if (is_array($_POST[$theKey]))  {
      $toAdd = "";
       for ($x=0; $x < count($_POST[$theKey]); $x++) {
        if ($x != 0)  {
          $toAdd .= "&";         
        }
        $toAdd .= "WAVT_".($theKey)."[".$x."]=".($_POST[$theKey][$x]);
      }
    }
    if ($loopInde != 0) {
      $postVars .= "&";
    }
    $postVars .= $toAdd;
    $loopInde++;
  }
  $postVars .= "&WAVT_".$valPage."_Errors=".substr($theErrors,1);
  $_SESSION['WAVT_'.$valPage."_Errors"] = $postVars;
}

function PostResult($thePage, $theErrors, $valPage) {
  $thePostURL = "";
  SaveFormToSession($theErrors, $valPage);
  $thePostURL .= $thePage;
  $urlParams = "";
  $schema = $_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http';
  $host = strlen($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
  
  if (strpos($thePostURL,"://") === false)  {
    if (strpos($thePage,"/") !== 0)  {
      $thePostURL = substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],"/")+1) . $thePostURL;
    }
	if (strpos($thePostURL,"?") !== false)  {
	  $urlParams = substr($thePostURL,strpos($thePostURL,"?"));
	  $thePostURL = substr($thePostURL,0,strpos($thePostURL,"?"));
	}
    $thePostURL = $schema."://".str_replace("%2F","/",$host.rawurlencode($thePostURL)).$urlParams;
  }
  while (!(strpos($thePostURL,"/../") === false)) { 
    $thePostURL = substr($thePostURL, 0, strrpos(substr($thePostURL,0,strpos($thePostURL,"/../")),"/")+1).substr($thePostURL,strpos($thePostURL,"/../")+4);
  }

  if (isset($_SERVER['QUERY_STRING']) && ($_SERVER['QUERY_STRING'] != '')) {
   if (strpos($thePostURL,"?") !== false)  {
     $thePostURL.= "&" . ($_SERVER['QUERY_STRING']);
    } else {
    $thePostURL.= "?" . ($_SERVER['QUERY_STRING']);
    }
  }
  header("Location: ". $thePostURL); 
  exit;
}

function WAtrimIt($theString,$leaveLeft,$leaveRight) {
  if (!isset($leaveLeft) || $leaveLeft == 0)  {
    $theString = ltrim($theString);
  }
  if (!isset($leaveRight) || $leaveRight == 0)  {
    $theString = rtrim($theString);
  }
  return $theString;
}

function WAValidateAN($value,$allowUpper,$allowLower,$allowNumbers,$allowSpace,$extraChars,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  for ($x=0; $x < strlen($value); $x++) {
    $charGood = false;
    $nextChar = substr($value,$x,1);
    $charCode = ord(substr($value,$x,1));
    if ($allowLower)  {
      if ($charCode >= 97 && $charCode <= 122)  {
        $charGood = true;
      }
    }
    if ($allowUpper)  {
      if ($charCode >= 65 && $charCode <= 90)  {
        $charGood = true;
      }
    }
    if ($allowNumbers)  {
      if ($charCode >= 48 && $charCode <= 57)  {
        $charGood = true;
      }
    }
    if ($allowSpace)  {
      if ($nextChar == " ")  {
        $charGood = true;
      }
    }
    if ($extraChars != "")  {
      if (strpos(str_replace("&quot;",'"',$extraChars),$nextChar) !== false)  {
        $charGood = true;
      }
    }
    if (!$charGood)  {
      $isValid = false;
      $x = strlen($value);
    }
  }
  if ($required && $value == "") $isValid = false;
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateCC($value,$allow,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $accepted = "\r\n\t.- ";
  if (!(!$required && $value == ""))  {
    $stripVal = "";
    for ($x=0; $x < strlen($value); $x++) {
      $charGood = false;
      $nextChar = substr($value,$x,1);
      $charCode = ord($nextChar);
      if ($charCode >= 48 AND $charCode <= 57)  {
          $stripVal .= $nextChar;
      } else {
        if (strpos($accepted,$nextChar)==0)  {
          $isValid = false;
        }
      }
    }
    if (strlen($stripVal) < 13)
	 $isValid = false;
    if ($isValid)  {
      if ($allow != "")  {
        $isValid = false;
        $allow = explode(":",$allow);
        foreach ($allow as $aStr) {
          if ($aStr != "" && strpos($stripVal, $aStr) === 0) { 
            $isValid = true;
            break;
          }
        }
      }
    }
    if ($isValid)  {
      $isValid = WA_isCreditCard($stripVal);
    }
  }
  if (!$isValid) {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WA_isCreditCard($st) {
  if ($st == 0)
    return (false);
  if (strlen($st) > 19)
    return (false);
  $sum = 0; $mul = 1; $l = strlen($st);
  for ($i = 0; $i < $l; $i++) {
    $digit = substr($st, $l-$i-1, 1);
    $tproduct = $digit*$mul;
    if ($tproduct >= 10)
      $sum += ($tproduct % 10) + 1;
    else
      $sum += $tproduct;
    if ($mul == 1)
      $mul++;
    else
      $mul--;
  }
  if (($sum % 10) == 0)
    return (true);
  else
    return (false);
}

function WAValidateDT($value,$doDate,$dateFormatStr,$dateMin,$dateMax,$doTime,$timeFormatStr,$timeMin,$timeMax,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $Now = getdate();
  $Today = mktime(0, 0, 0, date("n"), date("j"), date("Y"));
  if (!(!$required && $value==""))  {
    if ($value=="")  {
      $isValid = false;
    }
    if ($doDate)  {
      if ($dateFormatStr != "")  {
        if (preg_match("/".$dateFormatStr."/i", $value)==0)  {
          $isValid = false;
        }
      }
      if ($isValid)  {
        $dateVar = WAGetDateFormat($value, $dateFormatStr);
        if (strtotime($value)===true || $dateVar == -1 || is_numeric($value) || (strpos($value, "/") == strrpos($value, "/") && strpos($value, "/") != false))
          $isValid = false;
        if ($dateMin != "")  {
          $compareDay = WAGetDateFormat($dateMin, $dateFormatStr);
          if ($compareDay == -1)  {
            eval("\$compareDay = ".str_replace("&quot;",'"',$dateMin));
          }
          if ($dateVar < $compareDay)
            $isValid = false;
        }
        if ($dateMax != "")  {
          $compareDay = WAGetDateFormat($dateMax, $dateFormatStr);
          if ($compareDay == -1)  {
            eval("\$compareDay = ".str_replace("&quot;",'"',$dateMax));
          }
          if ($dateVar > $compareDay)
            $isValid = false;
        }
      }
    }
    if ($doTime)  {
      $isValid = WAValidateTheTime($doTime, $timeFormatStr, $value, $isValid, $timeMin, $timeMax);
    }
  }
  if (!$isValid) {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateTheTime($doTime, $timeFormatStr, $value, $isValid, $timeMin, $timeMax) {
  if ($doTime)  {
    if ($timeFormatStr != "")  {
      if (preg_match("/".$timeFormatStr."/i", $value)==0)  {
        $isValid = false;
      }
    }
    if (strpos($value, ":")===false)  {
      $isValid = false;
    }
    if ($isValid)  {
      $dateVar = strtotime($value);
      $fullYear = date("Y", $dateVar);
      if ($dateVar == -1)
        $dateVar = strtotime("1/1/1 ".$value);
      if ($dateVar == -1)
        $isValid = false;
      if ($timeMin != "")  {
        $Today = strtotime("1/1/1 ".$timeMin);
        if (!$Today == -1)  {
          $Today = eval(str_replace("&quot;",'"',$timeMin));
        }
        $enterTime = (date("H", $dateVar)*360) + (date("i", $dateVar)*60) + date("s", $dateVar);
        $minTime = (date("H", $Today)*360) + (date("i", $Today)*60) + date("s", $Today);
        if ($enterTime < $minTime)
          $isValid = false;
      }
      if ($timeMax != "")  {
        $Today = strtotime("1/1/1 ".$timeMax);
        if ($Today == -1)  {
          $Today = eval(str_replace("&quot;",'"',$timeMax));
        }
        $enterTime = ($dateVar["hours"]*360) + ($dateVar["minutes"]*60) + $dateVar["seconds"];
        $minTime = ($Today["hours"]*360) + ($Today["minutes"]*60) + $Today["seconds"];
        if ($enterTime > $minTime)
          $isValid = false;
      }
    }
  }
  return $isValid;
}


function WAGetDateFormat($value, $dateFormat) {
  $isUSServ = (date("n", strtotime("1/2/2006")) == 1);
  $tValue = $value;
  $isEuroDate = (($dateFormat && strpos($dateFormat, "[12]\\d|3[0-1]") < strpos($dateFormat, "1[0-2]|") && strpos($dateFormat, "\\w*") === false) || (!$isUSServ));
  if (($isEuroDate && $isUSServ) || (!$isEuroDate && !$isUSServ)) {
    $datePattn = "/(\\d*)[-\\.\\/](\\d*)[-\\.\\/](\d*)/";
    preg_match($datePattn, $tValue, $tMatch);
    if ($tMatch && sizeof($tMatch)) {
      if ($isEuroDate) {
        $value = $tMatch[2] . "/" . $tMatch[1] . "/" . $tMatch[3];
      }
      else {
        $value = $tMatch[1] . "/" . $tMatch[2] . "/" . $tMatch[3];
      }
      if (strpos($tValue, " ") !== false) {
        $value .= substr($tValue, strpos($tValue, " "));
      }
    }
  }
  return strtotime(preg_replace("/[\.-]/", "/", $value));
}


function WAValidateEM($value,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  if (!(!$required && $value == ""))  {
    $knownDomsPat = "/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/";
    $emailPat = "/^(.+)@(.+)$/";
    $accepted = "[^\s\(\)><@,;:\\\"\.\[\]]+";
    $quotedUser = "(\"[^\"]*\")";
    $ipDomainPat = "/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/";
    $section = "(".$accepted."|".$quotedUser.")";
    $userPat = "/^".$section."(\\.".$section.")*$/";
    $domainPat = "/^".$accepted."(\\.".$accepted.")*$/";
    $theMatch = preg_match($emailPat,$value,$MatchVal);
    $acceptedPat = "/^" . $accepted . "$/";
    $userName = "";
    $domainName = "";
    if (!$theMatch) {
      $isValid = false;
    }
    else  {
      $userName = $MatchVal[1];
      $domainName = $MatchVal[2];
	  $domArr = explode(".",$domainName);
	  $IPArray = preg_match($ipDomainPat,$domainName,$ipMatch);
      for ($x=0; $x < strlen($userName); $x++) {
        if ((ord(substr($userName,$x,1)) > 127 && ord(substr($userName,$x,1)) < 192) || ord(substr($userName,$x,1)) > 255) {
          $isValid = false;
        }
      }
      for ($x=0; $x < strlen($domainName); $x++) {
        if ((ord(substr($domainName,$x,1)) > 127 && ord(substr($domainName,$x,1)) < 192) || ord(substr($domainName,$x,1)) > 255) {
          $isValid = false;
        }
      }
      if (!preg_match($userPat,$userName)) {
        $isValid = false;
      }
      if ($IPArray) {
        for ($x=1; $x <= 4; $x++) {
          if ($IPArray[x] > 255) {
            $isValid = false;
          }
        }
      }
	  for ($x=0; $x<sizeof($domArr); $x++) {
        if (!preg_match($acceptedPat,$domArr[$x]) || strlen($domArr[$x]) == 0 || (strlen($domArr[$x]) < 2 && $x >= (sizeof($domArr)-2) && $x > 0)) {
          $isValid = false;
        }
      }
      if (strlen($domArr[count($domArr)-1]) !=2 && !preg_match($knownDomsPat,$domArr[count($domArr)-1])) {
        $isValid = false;
      }
      if (count($domArr) < 2) {
        $isValid = false;
      }
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateEL($value,$minLength,$maxLength,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  if (!(!$required && $value == ""))  {
    if ((strlen($value) < $minLength) || (strlen($value) > $maxLength && $maxLength > 0))  {
      $isValid = false;
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateFE($value,$extensions,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $extensions = str_replace(", ",",",$extensions);
  $ExtensionArr = explode(",",$extensions);
  if (!(!$required && $value == ""))  {
    $isValid = false;
    if (strrpos($value,".") > 0)     {
      $value = substr($value, strrpos($value,"."));
      foreach ($ExtensionArr as $extension) {
        $extension = str_replace(" ","",$extension);
        if (strtolower($value) == strtolower($extension))     {
          $isValid = true;
		  break;
        }
      }
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateLE($value1,$value2,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  if ($value1 != $value2 || ($required && $value1 == "")) {
    $isValid = false;
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateNM($value,$minLength,$maxLength,$allowDecimals,$punctuationMarks,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $theThousand = substr($punctuationMarks,0,1);
  $theDecimal = substr($punctuationMarks,1,1);
  $theCheck = (11/10);
  $trueDecimal = substr($theCheck,1,1);
  $startVal = $value;
  $decimalIndex = strlen($value);
  if (strrpos($punctuationMarks, $trueDecimal)===false && strrpos($value, $trueDecimal) !== false)  {
    $isValid = false;
  }
  $tempValue = $value;
  if (strpos($value, $theDecimal) !== false) {
    if (strpos($value, $theDecimal) != strrpos($value, $theDecimal)) {
      $isValid = false;
    }
    else {
      $decimalIndex = strpos($value, $theDecimal);
      $tempValue = substr($value, 0, $decimalIndex);
    }
  }
  if ($isValid && strpos($tempValue, $theThousand) !== false)  {
    if (strpos($tempValue, $theThousand) > 3 || strpos($tempValue, $theThousand) == 0) {
      $isValid = false;
    }
    else {
      $valArr = explode($theThousand,$tempValue);
      for ($v=1; $v < sizeof($valArr); $v++) {
        if (strlen($valArr[$v]) != 3) {
          $isValid = false;
          break;
        }
      }
      $tempValue = implode("",$valArr);
    }
  }
  if ($isValid && strpos($value, $theDecimal) !== false) {
    $tempValue = $tempValue . substr($value, strpos($value, $theDecimal));
  }
  $value = $tempValue;
  if ($isValid && $trueDecimal != $theDecimal && strpos($value, $theDecimal) !== false)  {
    $value = substr($value,0,strpos($value, $theDecimal)) . $trueDecimal . substr($value,strpos($value, $theDecimal)+1);
  }
  if ($isValid && !(!$required && $value==""))  {
    for ($x=0; $x < strlen($value); $x++)  {
      $theDigit = substr($value, $x, 1);
      if  (!is_numeric($theDigit) && $theDigit != " " && $theDigit != "," && $theDigit != "."  && $theDigit != "-")  {
        $isValid = false;
          break;
      }
     }
    if ($value == "")  {
      $isValid = false;
    }
    if (!is_numeric($value))  {
      $isValid = false;
    } 
    else {
      if (($minLength !== "" && $minLength > $value) || ($maxLength !== "" && $maxLength < $value)) {
        $isValid = false;
      } else {
        if ($allowDecimals !== "")  {
          $decCheck = strpos($startVal,$theDecimal);
          $decCheck += $allowDecimals;
          $decCheck += 2;
          if (strpos($startVal,$theDecimal)!==false && ($decCheck <= strlen($startVal) || $allowDecimals === 0))  {
            $isValid = false;
          }
        }
      }
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidatePN($value,$areaCode,$international,$required,$number) {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $allowed = "*() -./_+".Chr(10).Chr(8);
  $newVal = "";
  if (!(!$required AND $value == ""))  {
    for ($x=0; $x < strlen($value); $x++) {
      $z = substr($value,$x,1);
      if (($z >= "0") && ($z <= "9")) {
        $newVal = $newVal.$z;
      } else {
        if (strpos($allowed,$z) === false)  {
          $isValid = false;
        }
      }
    }
    if ($international)  {
      if  (strlen($newVal) < 5)  {
        $isValid = false;
      }
    } else {
      if (strlen($newVal) == 11)  {
        if (substr($newVal,0,1) != "1")    {
          $isValid = false;
        }
      } else {
		if ((strlen($newVal) != 10 && strlen($newVal) != 7) || (strlen($newVal)==7 && $areaCode)) {
          $isValid = false;
        }
      }
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateRX($value,$regExStr,$required,$number)  {
  $value = $value;
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $regExStr = str_replace("&quot;", '"', $regExStr);
  if (!(!$required && $value==""))  {
    $theMatch = preg_match($regExStr, $value);
    if (!$theMatch)  {
      $isValid = false;
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateRQ($value,$trimWhite,$number)  {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  if ($trimWhite)  {
    $value = WAtrimIt($value,0,0);
  }
  if (!isset($value) || $value === "")  {
    $isValid = false;
  }

  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateRT($value,$notAllowed,$required,$number)  {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $augValue = " ".strtolower($value)." ";
  $tempVal = $augValue;
  if (!(!$required && $value==""))  {
    $notAllowed = explode(", ", $notAllowed);
    foreach ($notAllowed AS $x)  {
      if ($x != "") {
        $notAllowedInfo = explode("|", $x);
        $notAllowedInfo[0] = str_replace ("&quot;", "\"", $notAllowedInfo[0]);
        $notAllowedInfo[1] = str_replace ("&quot;", "\"", $notAllowedInfo[1]);
        if (!(strpos($tempVal, strtolower($notAllowedInfo[0]))===false))  {
          $isValid = false;
		  break;
        }
      }
    }
  }
  if ($required && $value=="")
    $isValid = false;
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;
}

function WAValidateSS($value,$required,$number)  {
  $WAFV_ErrorMessage = "";  
  $isValid = true;
  $allowed = "*() -./_\n\r+";
  if (!(!$required && $value==""))  {
    $newVal = "";
    for ($x=0; $x < strlen($value); $x++)  {
      $z = substr($value, $x, 1);
      if (($z >= "0") && ($z <= "9")) {
	      $newVal .= $z;
	    }
	    else  {
		    if (strpos($allowed, $z) < 0)  {
		      $isValid = false;
		    }
	    }
    }	
	  if (strlen($newVal) != 9) {
	    $isValid = false;
	  }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;  
}

function WAValidateUR($value,$force,$required,$number)  {
  $WAFV_ErrorMessage = "";  
  $isValid = true;
  $valURL = $value;
  if (!strpos($valURL, "://")===false)  {
    $valURL = substr($valURL, strpos($valURL, "://")+3);
  }
  if (strpos($valURL, "?")>0)  {
    $valURL = substr($valURL, 0,strpos($valURL, "?"));
  }
  if (!(!$required && preg_replace("/\s/", "", $valURL)==""))  {
    if (strtolower($force) == "none")  {
      if (strpos($value, "://")!==false)
        $isValid = false;
    }
    if (strpos($value, "?") != strrpos($value, "?") || !strpos($value, " ") === false)  {
      $isValid = false;
    }
    if ($isValid)  {
      if (!strpos($valURL, ";") === false || !strpos($valURL, "&") === false || !strpos($valURL, "=") === false || !strpos($valURL, ",") === false)  {
        $isValid = false;
      }
    }	
    if (strtolower($force) != "false" && strtolower($force) != "none" && $isValid)  {
      $force = preg_replace("/\\s*,\\s*/", ",", $force);
      $force = explode(",", $force);
      $isValid = false;
      foreach ($force as $x)  {
        if (strpos(strtolower($value), strtolower($x))===0) {
          $isValid = true;
          break;
        }
      }
    }
    if ($isValid && strpos($valURL, ".") < 1)
      $isValid = false;
    if ($isValid) {
      $tDomain = $valURL;
      if (strpos($tDomain, ":") !== false) {
        $tDomain = substr($tDomain, 0, strpos($tDomain, ":"));
        $tPort = substr($valURL, strlen($tDomain)+1);
        if (strpos($tDomain, "/") !== false) {
          $isValid = false;
        }
        else {
          if (strpos($tPort, "/") !== false) {
            $tPort = substr($tPort, 0, strpos($tPort, "/"));
          }
          if (!is_numeric($tPort) && $tPort !== "") {
            $isValid = false;
          }
        }
      }
      if ($isValid && strpos($tDomain, "/") !== false) {
        $tDomain = substr($tDomain, 0, strpos($tDomain, "/"));
      }
      if ($isValid) {
        $tDomainA = explode(".", $tDomain);
        if (sizeof($tDomainA) < 2) {
          $isValid = false;
        }
        else {
          $ipMatch = "/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/";
          if (preg_match($ipMatch,$tDomain)) {
            if ($tDomainA[0] > 255 || $tDomainA[1] > 255 || $tDomainA[2] > 255 || $tDomainA[3] > 255) {
              $isValid = false;
            }
          }
          else {
            if (strlen($tDomainA[sizeof($tDomainA)-1]) < 2 || strlen($tDomainA[sizeof($tDomainA)-2]) < 2) {
              $isValid = false;
            }
          }
        }
      }
    }
  }
  if ($isValid && $required && preg_replace("/\s/", "", $valURL)=="")
    $isValid = false;
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;  
}

function WAValidateZC($value,$us5,$us9,$can6,$uk,$required,$number)  {
  $WAFV_ErrorMessage = "";
  $isValid = true;
  $allowed = "() -.\n\r";
  $charVal = "";
  if (!(!$required && $value==""))  {
    $newVal = "";
    $hasLetters = false;
    for ($x=0; $x < strlen($value); $x++)  {
      $z = substr($value, $x, 1);
      if (($z >= "0") && ($z <= "9")) {
        $newVal .= $z;
        $charVal .= "N";
      }
      else if (($uk || $can6) && ((($z >= "a") && ($z <= "z")) || (($z >= "A") && ($z <= "Z"))))  {
        $charVal .= "A";
        $hasLetters = true;
      }
      else if (strpos($allowed, $z) < 0 || $x == 0 || $x == strlen($value)-1)  {
        $isValid = false;
      }
    }
    $acceptPattern = ",";
    if ($us5)  {
      $acceptPattern .= "NNNNN,";
    }
    if ($us9)  {
      $acceptPattern .= "NNNNNNNNN,";
    }
    if ($uk)  {
      $acceptPattern .= "ANNAA,ANNNAA,AANNAA,AANNNAA,ANANAA,AANANAA,";
    }
    if ($can6)  {
      $acceptPattern .= "ANANAN,";
    }
    if (strpos($acceptPattern,",".$charVal.",") === false)
      $isValid = false;
    if ($isValid && !$hasLetters && ($us5 || $us9)) {
      if ($us5) {
        $isValid = preg_match('/^\d{5}$/', $value);
      }
      if ($us9 && (($us5 && !$isValid) || !$us5)) {
        $isValid = (preg_match('/^\d{5}[-\. ]\d{4}$/', $value) || preg_match('/^\d{9}$/', $value));
      }
    }
  }
  if (!$isValid)  {
    $WAFV_ErrorMessage .= ",".$number;
  }
  return $WAFV_ErrorMessage;  
}
?>