<?php
if (!session_id())  {
  session_start();
}
function ValidatedField($page,$field)  {
  $theFields= "";
  $retVal = "";
  if (isset($_SESSION["WAVT_".$page."_Errors"]))  {
    $theFields = "&".$_SESSION["WAVT_".$page."_Errors"];
  }
  if (strpos($theFields,"&WAVT_".$field."=") !== false)  {
    $retVal = substr($theFields,strpos($theFields,"&WAVT_".$field."=")+strlen("&WAVT_".$field."="));
  }
  if (strpos($retVal,"&WAVT_") !== false)  {
    $retVal = substr($retVal,0,strpos($retVal,"&WAVT_"));
  }
  if ($retVal == "" && $page == $field) {
    $retVal = ValidatedField($page,$field."_Errors");
  }
   return str_replace("<","&lt;",str_replace(">","&gt;",str_replace('"',"&quot;",$retVal)));
}

?>