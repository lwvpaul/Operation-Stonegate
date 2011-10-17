<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(isset($_SERVER['SCRIPT_FILENAME'])){
		$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
	}
}
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(isset($_SERVER['PATH_TRANSLATED'])){
		$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0,	0-strlen($_SERVER['PHP_SELF'])));
	}
}
if (!isset($absolutepath)) { 
     $docRoot = preg_replace("/\\$|\/$/", "", realpath($_SERVER['DOCUMENT_ROOT'])); 
     $absolutepath = str_replace("\\","/", $docRoot. $_SERVER["PHP_SELF"]); 
}
if (!isset($site_root)) {  
	$site_root = dirname($absolutepath);
	$phpself = dirname($_SERVER["PHP_SELF"]);
	while (strtolower(basename($site_root)) == strtolower(basename($phpself)) && $site_root != "")  {
		$site_root = dirname($site_root);
		$phpself = dirname($phpself);
		if ($phpself == "\\" || $phpself == "/")  {
			$phpself = "";
		}
		if ($site_root == "\\" || $site_root == "/")  {
			$site_root = "";
		}
	}
	if ($phpself == "\\" || $phpself == "/")  {
		$phpself = "";
	}
	$virtualdir = $phpself;
}

if (!function_exists('rel2abs') )  {
	function rel2abs($rel, $base)  {
		$baseRoot = str_replace("\\","/",$GLOBALS['site_root']);
		$base = str_replace("\\","/",$base);
		if($baseRoot != "" && strpos($base, $baseRoot) === 0) $base = str_replace($baseRoot,"",$base);
		$rel = str_replace("\\","/",$rel);
		if($baseRoot != "" && strpos($rel, $baseRoot) === 0) $rel = str_replace($baseRoot,"",$rel);
	
		if (strpos($rel,"/")===0 || $base==$rel) {
		return $rel;
		}
		$added = false;
		if  (strpos($base,"/")!==0)  {
		$base = "/" . $base;	
		$added = true;
		}
		while (strpos($rel,"../")===0)  {
		$base = substr($base,0,strrpos($base,"/"));
		$rel = substr($rel,3);
		}
		if ($added) $base = substr($base,1);
		if ($rel!=""){
			$base = $base . ( ($rel == ".") ? "" : "/" . $rel );
		}
		if ($GLOBALS['virtualdir']!="" && strpos($base,$GLOBALS['virtualdir']) !== 0)  {
			$base = $GLOBALS['virtualdir'] . $base;
		}
		
		return $base;
	}
}

if (!function_exists('abs2rel') )  {
	function abs2rel($abs, $base)  {
			$baseRoot = str_replace("\\","/",$GLOBALS['site_root']);
			$base = str_replace("\\","/",$base);
			if($baseRoot != "" && strpos($base, $baseRoot) === 0) $base = str_replace($baseRoot,"",$base);
			$abs = str_replace("\\","/",$abs);
			if($baseRoot != "" && strpos($abs, $baseRoot) === 0) $abs = str_replace($baseRoot,"",$abs);
			if  ($GLOBALS['virtualdir']!="")  {
				if(strpos($base, $GLOBALS['virtualdir']) === 0) $base = wa_replace_once($GLOBALS['virtualdir'],"",$base);
				if(strpos($abs, $GLOBALS['virtualdir']) === 0) $abs = wa_replace_once($GLOBALS['virtualdir'],"",$abs);
			}
		
		 if ($base=="/" && strpos($abs, "/") === 0) return substr($abs,1);
		 if ($base!="" && strrpos($base,"/") != strlen($base)) $base .="/";
		while  (strpos($abs,"/") !== false && strtolower(substr($abs,0,strpos($abs,"/")+1))  == strtolower(substr($base,0,strpos($base,"/")+1)) )  {
			$abs = substr($abs,strpos($abs,"/")+1);
			$base = substr($base,strpos($base,"/")+1);
		}
		while (strpos($base,"/") !== false)  {
				if (strpos($abs,"/")===0)  {
					$abs = substr($abs,1);	
				}
			$abs = "../".$abs;
			$base = substr($base,strpos($base,"/")+1);
		}
		if (strpos($abs,"/")===0)  {
			 $abs = substr($abs,1);	
		}
		// $site_root should be set in the theme_open.php page
		$abs = str_replace($GLOBALS['site_root'],"",$abs);
		return $abs;
	}
}

if (!function_exists('wa_evaluate') )  {
	function wa_evaluate($startVal)  {
		global $pg_id, $pg_theme, $pg_config, $abs_prefix, $js_mootools;
		$retVal = $startVal;
		$numGalleries = preg_match_all('/<(img|input) [^>]*name="powergallery"[^>]*\/?>/',$retVal,$theGalleries);
		for ($gal=0; $gal<$numGalleries; $gal++)  {
			$theTag = $theGalleries[0][$gal];
			$foundValue = preg_match('/ value="([^"]*)"/',$theTag,$theValue);
			$foundId = preg_match('/ id="([^"]*)"/',$theTag,$theId);
			$foundTheme = preg_match('/ theme="([^"]*)"/',$theTag,$theTheme);
			$foundDesign = preg_match('/ design="([^"]*)"/',$theTag,$theDesign);
			$galleryHTML = "";
			
			if ($foundId)  {
				$pg_id = $theId[1];
				mysql_select_db($GLOBALS['database_PowerStoreConnection']);
						$result = mysql_query(" SELECT *
				FROM ps4_gallery
				WHERE id = " . intval($theId[1]));
				if($result)  {
					$row_result = mysql_fetch_assoc($result);
					$pg_theme = $row_result['theme'];
					$pg_value = "../../galleries/".$row_result['design']."/index.php";
				}
			}
			if ($foundTheme)  {
				$pg_theme = $theTheme[1];
			}
			if ($foundDesign)  {
					$pg_value = "../../galleries/".$theDesign[1]."/index.php";
			}
			if ($foundValue)  {
				$pg_value = $theValue[1];
			}
			
			if ($result || ($foundValue && $foundId && $foundTheme)) {
				$startDir = getcwd();
				chdir(dirname(__FILE__));
				ob_start();
				include($pg_value);
				$galleryHTML = ob_get_clean();
				chdir($startDir);
			}
			$retVal = str_replace($theTag,$galleryHTML,$retVal);
		}
		return $retVal;
	}
}

if (!function_exists('wa_replace_once') )  {
	function wa_replace_once($search, $replace, $subject) {
		$firstChar = strpos($subject, $search);
		if($firstChar !== false) {
			$beforeStr = substr($subject,0,$firstChar);
			$afterStr = substr($subject, $firstChar + strlen($search));
			return $beforeStr.$replace.$afterStr;
		} else {
			return $subject;
		}
	}
}
?>