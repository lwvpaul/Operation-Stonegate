<?php
if (!function_exists("session_commit")) {
    function session_commit() { session_write_close(); }
}
class WAUE_Log_Bindings {
	var $SuccessOrFailure;
	var $Success;
	var $Failure;
	function WAUE_Log_Bindings() {
		$this->SuccessOrFailure = new WAUE_Log_Event();
		$this->Success = new WAUE_Log_Event();
		$this->Failure = new WAUE_Log_Event();
	}
	function processLog($isError) {
		if ($this->SuccessOrFailure->ToDo != "none") {
			$this->SuccessOrFailure->processEvent($isError);
		}
		if (!$isError && $this->Success->ToDo != "none") {
			$this->Success->processEvent($isError);
		}
		if ($isError && $this->Failure->ToDo != "none") {
			$this->Failure->processEvent($isError);
		}
	}
}
class WAUE_Log_Event {
	var $MailRef;
	var $ToDo;
	var $Connection;
	var $TableName;
	var $EmailColumn;
	var $ColumnList;
	var $TypeList;
	var $ValueList;
	function WAUE_Log_Event() {
		$this->MailRef = "WAUE";
		$this->ToDo = "none";
		$this->Connection = "";
		$this->TableName = "";
		$this->EmailColumn = "";
		$this->ColumnList = array();
		$this->TypeList = array();
		$this->ValueList = array();
	}
	function processEvent($isError) {
		if ($this->ToDo == "none") {
			return true;
		}
		if (sizeof($this->ColumnList) == 0) {
			return false;
		}
		$LogIncludeDirectory = getcwd();
		chdir(dirname(__FILE__));
		require("../../Connections/".$this->Connection.".php");
		require_once("../database_management/wa_appbuilder_php.php");
		chdir($LogIncludeDirectory);
		eval("$"."logConnection = $".$this->Connection.";");
		eval("$"."logDatabase = $"."database_".$this->Connection.";");
		mysql_select_db($logDatabase, $logConnection);
		$insertParams = WA_AB_generateInsertParams($this->ColumnList, $this->TypeList, $this->ValueList, -1);
		switch ($this->ToDo) {
			case "update":
				$emailToValue = "";
				$emailToType = "',none,''";
				for ($n=0; $n<sizeof($this->ColumnList); $n++) {
					if ($this->ColumnList[$n] == $this->EmailColumn) {
						$emailToValue = $this->ValueList[$n];
						$emailToType = $this->TypeList[$n];
						break;
					}
				}
				if (!$emailToValue && isset($_SESSION[$this->MailRef."_To"])) {
					$emailToValue = $_SESSION[$this->MailRef."_To"];
				}
				if ($emailToValue) {
					$toArrUpdate = WA_getEmailArray($emailToValue);
					$emailToValue = $toArrUpdate[0][1];
					if ($emailToValue) {
						//check to see if record exists then update / insert as needed
						$whereClause = WA_AB_generateWhereClause(array($this->EmailColumn), array($emailToType), array($emailToValue), array("="));
						//$logUpdateTest = mysql_query("SELECT ".WA_AB_cleanUpColumnName($this->EmailColumn)." FROM ".WA_AB_cleanUpColumnName($this->TableName)." WHERE ".$whereClause->sqlWhereClause, $logConnection) or die(mysql_error());
						//if (mysql_num_rows($logUpdateTest) > 0) {
						//do update
						$logUpdate = mysql_query("UPDATE ".WA_AB_cleanUpColumnName($this->TableName)." SET ".$insertParams->WA_setValues." WHERE ".$whereClause->sqlWhereClause, $logConnection) or die(mysql_error());
						//break;
						//}
					}
				}
				//mysql_free_result($logUpdateTest);
				break;
			case "create":
				//create email_log table in database (if it doesn't exist) and insert
				//creation handled by UI
				//break; // do not break, continue to insert
			case "insert":
				//insert record to table
				$logInsert = mysql_query("INSERT INTO ".WA_AB_cleanUpColumnName($this->TableName)." (".$insertParams->WA_tableValues.") VALUES (".$insertParams->WA_dbValues.")", $logConnection) or die(mysql_error());
				break;
		}
		return true;
	}
}

function WAUE_isAttachment($attPath) {
	if ($attPath && $attPath != "" && file_exists($attPath)) {
		return true;
	}
	return false;
}

function AttachFromUpload($fieldName)  {
	 if (isset($_FILES[$fieldName]))  {
	   return($_FILES[$fieldName]["name"]."|WA|".$_FILES[$fieldName]["tmp_name"]);
	 }
	 else  {
		return ""; 
	 }
}

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function EmailArrayFromFile($fileName)  {
	$retArray = array();
	if (!file_exists($fileName)) $fileName = realpath($fileName);
	$handle = fopen($fileName, "r");
    $output = fread($handle, filesize($fileName));
	fclose($handle);
	$outputMatch = preg_match_all('/((?>[a-zA-Z\d!#$%&\'*+\-\/=?^_`{|}~]+\x20*|"((?=[\x01-\x7f])[^"\\]|\\[\x01-\x7f])*"\x20*)*(?<angle><))?((?!\.)(?>\.?[a-zA-Z\d!#$%&\'*+\-\/=?^_`{|}~]+)+|"((?=[\x01-\x7f])[^"\\]|\\[\x01-\x7f])*")@(((?!-)[a-zA-Z\d\-]+(?<!-)\.)+[a-zA-Z]{2,}|\[(((?(?<!\[)\.)(25[0-5]|2[0-4]\d|[01]?\d?\d)){4}|[a-zA-Z\d\-]*[a-zA-Z\d]:((?=[\x01-\x7f])[^\\\[\]]|\\[\x01-\x7f])+)\])(?(angle)>)/i',$output,$emailArray);
	$retArray = $emailArray[0];
	return $retArray;
}

function GetFromPage($fileName)  {
	$Include_Start_Dir = getcwd();
	$Include_Dir =  dirname($fileName);
	chdir(dirname(__FILE__));
	chdir($Include_Dir);
	ob_start();
	require(basename($fileName));
	$content = ob_get_contents();
	ob_end_clean();
	chdir($Include_Start_Dir);
	return $content;
}

function WAUE_isEmailAddress($testAddress) {
	$isValidEmail = true;
	if (strpos($testAddress, ";") !== false) {
		$testAddress = substr($testAddress, 0, strpos($testAddress, ";"));
	}
	if (strpos($testAddress, ",") !== false) {
		$testAddress = substr($testAddress, 0, strpos($testAddress, ","));
	}
	if (strpos($testAddress, "<") !== false && strpos($testAddress, "<") < strpos($testAddress, "@")) {
		$testAddress = substr($testAddress, strpos($testAddress, "<")+1);
		if (strpos($testAddress, ">") !== false && strpos($testAddress, ">") > strpos($testAddress, "@")) {
			$testAddress = substr($testAddress, 0, strpos($testAddress, ">"));
		}
	}
	if ($testAddress != "")  {
		$knownDomsPat = "/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum|cat|\w{2,2})$/i";
		$emailPat = "/^(.+)@(.+)$/";
		$accepted = "[^\s\(\)><@,;:\\\"\.\[\]]+";
		$quotedUser = "(\"[^\"]*\")";
		$ipDomainPat = "/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/";
		$section = "(".$accepted."|".$quotedUser.")";
		$userPat = "/^".$section."(\\.".$section.")*$/";
		$domainPat = "/^".$accepted."(\\.".$accepted.")*$/";
		$theMatch = preg_match($emailPat,$testAddress,$MatchVal);
		$acceptedPat = "/^" . $accepted . "$/";
		$userName = "";
		$domainName = "";
		if (!$theMatch) {
			$isValidEmail = false;
		}
		else  {
			$userName = $MatchVal[1];
			$domainName = $MatchVal[2];
			$domArr = explode(".",$domainName);
			$IPArray = preg_match($ipDomainPat,$domainName,$ipMatch);
			for ($x=0; $x < strlen($userName); $x++) {
				if ((ord(substr($userName,$x,1)) > 127 && ord(substr($userName,$x,1)) < 192) || ord(substr($userName,$x,1)) > 255) {
					$isValidEmail = false;
				}
			}
			for ($x=0; $x < strlen($domainName); $x++) {
				if ((ord(substr($domainName,$x,1)) > 127 && ord(substr($domainName,$x,1)) < 192) || ord(substr($domainName,$x,1)) > 255) {
					$isValidEmail = false;
				}
			}
			if (!preg_match($userPat,$userName)) {
				$isValidEmail = false;
			}
			if ($IPArray) {
				for ($x=1; $x <= 4; $x++) {
					if ($IPArray[x] > 255) {
						$isValidEmail = false;
					}
				}
			}
			for ($x=0; $x<sizeof($domArr); $x++) {
				if (!preg_match($acceptedPat,$domArr[$x]) || strlen($domArr[$x]) == 0 || (strlen($domArr[$x]) < 2 && $x >= sizeof($domArr)-1)) {
					$isValidEmail = false;
				}
			}
			if (strlen($domArr[count($domArr)-1]) !=2 && !preg_match($knownDomsPat,$domArr[count($domArr)-1])) {
				$isValidEmail = false;
			}
			if (count($domArr) < 2) {
				$isValidEmail = false;
			}
		}
	}
	return $isValidEmail;
}

function WA_getEmailArray($emailStr) {
	$retArray = array();
	$emailArr = explode(";",$emailStr);
	foreach ($emailArr AS $emailString) {
		if (strpos($emailString,"@") > 0) {
			$emailMatches = preg_match("/^[^\r\n]* *<([^\r\n]*)>$/",$emailString,$emailArr2);
			$doCheck = true;
			if ($emailMatches == 0) {
				$emailArr2 = explode("|WA|", $emailString);
				if (sizeof($emailArr2) == 1) {
					$retArray[] = array("", WA_StripSpaces($emailString));
					$doCheck = false;
				}
			}
			else {
				$emailArr2[0] = substr($emailArr2[0], 0, strrpos($emailArr2[0], $emailArr2[1]));
				$emailArr2[0] = substr($emailArr2[0], 0, strrpos($emailArr2[0], " <"));
			}
			if ($doCheck) {
				if (strpos($emailArr2[0], "@") !== false) {
					$retArray[] = array(WA_StripSpaces($emailArr2[1]), WA_StripSpaces($emailArr2[0]));
				}
				else {
					$retArray[] = array(WA_StripSpaces($emailArr2[0]), WA_StripSpaces($emailArr2[1]));
				}
			}
		}
	}
	if (sizeof($retArray)==0) $retArray[] = array("","");
	return $retArray;
}

function WA_FormatColumn($align,$numspaces,$content)     {
	$WA_FormatColumn_return = "";
	$numspaces = intval($numspaces);
	if (strlen($content) > $numspaces)     {
		$WA_FormatColumn_return = substr($content,0,$numspaces);
	}
	else     {
		switch (strtolower($align)) {
			case "right":
				$WA_FormatColumn_return = WA_RightAlign($numspaces,$content);
				break;
			case "left":
				$WA_FormatColumn_return = WA_LeftAlign($numspaces,$content);
				break;
		}
		if (strtolower($align) == "center")     {
			$WA_FormatColumn_return = WA_CenterAlign($numspaces,$content);
		}
	}
	
	return $WA_FormatColumn_return;
}

function WA_RightAlign($numspaces, $content)     {
	$WA_RightAlign_return = $content;
	while (strlen($WA_RightAlign_return) < $numspaces)     {
		$WA_RightAlign_return = " ".$WA_RightAlign_return;
	}
	return $WA_RightAlign_return;
}

function WA_LeftAlign($numspaces, $content)     {
	$WA_LeftAlign_return = $content;
	while (strlen($WA_LeftAlign_return) < $numspaces)     {
		$WA_LeftAlign_return = $WA_LeftAlign_return." ";
	}
	return $WA_LeftAlign_return;
}

function WA_CenterAlign($numspaces, $content)     {
	$WA_CenterAlign_return = $content;
	for ($n=strlen($content); $n<$numspaces; $n++)     {
		if (($n%2) == 1)     {
			$WA_CenterAlign_return = $WA_CenterAlign_return." ";
		}
		else     {
			$WA_CenterAlign_return = " ".$WA_CenterAlign_return;
		}
	}
	return $WA_CenterAlign_return;
}

function WA_StripSpaces($inStr)     {
	$outStr = $inStr;
	$firstchar = substr($outStr, 0, 1);
	while ($firstchar == " ")     {
		$outStr = substr($outStr,1);
		$firstchar = substr($outStr, 0, 1);
	}
	$firstchar = substr($outStr, strlen($outStr)-1, 1);
	while ($firstchar == " ")     {
		$outStr = substr($outStr, 0, strlen($outStr)-1);
		$firstchar = substr($outStr, strlen($outStr)-1, 1);
	}
	return $outStr;
}

function WA_TrimLeadingSpaces($inStr)     {
	$outStr = $inStr;
	$firstchar = substr($outStr, 0, 1);
	while ($firstchar == " ")     {
		$outStr = substr($outStr,1);
		$firstchar = substr($outStr, 0, 1);
	}
	$firstchar = substr($outStr, strlen($outStr)-1, 1);
	while ($firstchar == " ")     {
		$outStr = substr($outStr, 0, strlen($outStr)-1);
		$firstchar = substr($outStr, strlen($outStr)-1, 1);
	}
	return $outStr;
}

function WA_StripTags($bodytext)  {
	if (strpos($bodytext,"<body") !== false)
		$bodytext = substr($bodytext,strpos($bodytext,"<body"));
	$bodytext = preg_replace("/\s{1,}/"," ",$bodytext); 
	$bodytext = preg_replace("/ {1,}/"," ",$bodytext);
	$bodytext = preg_replace("/<(p|br|tr)>/i","\r\n",$bodytext);
	$bodytext = preg_replace("/<(p |br |tr )([^>]*>)/i","\r\n",$bodytext); 
	$bodytext = preg_replace("/<(li|td|th)>/i","\t",$bodytext);
	$bodytext = preg_replace("/<(li |td |th )([^>]*>)/i","\t",$bodytext);
	$bodytext = preg_replace("/(<\/?)(\w+)([^>]*>)/","",$bodytext);
	return $bodytext;
}

function wa_sleep($sleepTime)  {
    if (floatval($sleepTime) != intval($sleepTime)):
       usleep($sleepTime*1000000);
    else:
       sleep($sleepTime);
    endif;  
}

function RemoveValue($theValue, $theExact, $theStart, $theEnd, $theInclude)  {
     if (array_search($theValue,$theExact) !== false)  {
		return true; 
	 }
	 for ($x=0; $x<sizeof($theStart); $x++)  {
		 if (strpos($theValue,$theStart[$x]) === 0)  {
			 return true;
		 }
	 }
	 for ($x=0; $x<sizeof($theEnd); $x++)  {
		 if (strrpos($theValue,$theEnd[$x]) === strlen($theValue)-strlen($theEnd[$x]))  {
			 return true;
		 }
	 }
	 for ($x=0; $x<sizeof($theInclude); $x++)  {
		 if (strrpos($theValue,$theInclude[$x]) !== false)  {
			 return true;
		 }
	 }
	  return false;
}
?>