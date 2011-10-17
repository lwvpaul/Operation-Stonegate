<?php
class WA_Include  {
	public function __construct( $fileName) {
	  $this->Start_Dir = getcwd();
	  $this->File = $fileName;
	  $this->BaseName =  basename($fileName);
	  $this->Reset = array();
	  $this->Added = array();
      $this->CleanName();
	  $this->Dir =  dirname($fileName);
	  $this->Body = "";
	  $this->Head = "";
	  $this->HTML = "";
	  $this->Title = "";
	  $this->Above = "";
	  $this->Links = array();
	  $this->Styles = array();
	  $this->DocType = "";
	  $this->Content =  "";
	  $this->MetaTags = "";
	  $this->MetaKeywords = "";
	  $this->MetaDescription = "";
	  $this->MetaContentType = "";
	  $this->MetaKeywords_Content = "";
	  $this->MetaDescription_Content = "";
	  $this->MetaContentType_Content = "";
	  $this->EditableRegions = array();
	  if (!file_exists($this->Dir))  {
	    die("Framework file not found: ".$fileName);
	  }
	  chdir($this->Dir);
	  ob_start();
	}
	
	private function CleanName()  {
	  if (strpos($this->BaseName,"?")!==false)  {
		  $QueryString = substr($this->BaseName,strpos($this->BaseName,"?")+1);
		  $this->BaseName =  substr($this->BaseName,0,strpos($this->BaseName,"?"));
		  $QueryArray = explode("&",$QueryString);
		  for ($x=0; $x<sizeof($QueryArray); $x++)   {
			  $QueryVals = explode("=",$QueryArray[$x]);
			  if (sizeof($QueryVals)==2)  {
				  $isArray = false;
				  if(strpos($QueryVals[0],"[]") !== false && strrpos($QueryVals[0],"[]") == (strlen($QueryVals[0])-2)) {
					 $isArray = true;
					 $QueryVals[0] = substr($QueryVals[0], 0, strlen($QueryVals[0])-2);
				  }
				  $QueryVals[0] = urldecode($QueryVals[0]);
				  $QueryVals[1] = urldecode($QueryVals[1]);
				  if ($isArray)  {
					if (!isset($this->Reset[$QueryVals[0]]))  {
						if (isset($_GET[$QueryVals[0]]) && !isset($this->Added[$QueryVals[0]]))  {
						  $this->Reset[$QueryVals[0]] = $_GET[$QueryVals[0]];
						}
						$_GET[$QueryVals[0]] = array();
				          $this->Added[$QueryVals[0]] = true;
					} 
				    $_GET[$QueryVals[0]][] = $QueryVals[1];
				  }  else  {
				    if (isset($_GET[$QueryVals[0]]))  {
					  $this->Reset[$QueryVals[0]] = $_GET[$QueryVals[0]];
				    }
				    $_GET[$QueryVals[0]] = $QueryVals[1];
				  }
				  $this->Added[$QueryVals[0]] = "test";
			  }
		  }
	  }
	}
	
	public function GetEditableRegions() {
		$regions = array();
		$open = "<!-- " .'(Instance|Template)BeginEditable name="([^"]*)" -->';
		$content =$this->Content;
		$editable = preg_match("/".$open."/i",$content,$Name);
		$close =  "<!-- " . '(Instance|Template)EndEditable -->';
		$closeeditable = preg_match("/".$close."/i",$content,$End);
		while ($editable && $closeeditable)  {
		  $beforeOrig = substr($content,0,strpos($content,$Name[0]));
		  $afterOrig = substr($content,strlen($beforeOrig));
		  $regionContent = substr($afterOrig,0,strpos($afterOrig,$End[0])).$End[0];
		  $content = substr($afterOrig,strpos($afterOrig,$End[0])+strlen($End[0]));
		  $regions[$Name[2]] =$regionContent;
		  $editable = preg_match("/".$open."/i",$content,$Name);
		}
		$this->EditableRegions = $regions;
	}
	
	public function ReplaceTemplateRegions($ContentObj) {
	  $this->GetEditableRegions();
	  foreach ($this->EditableRegions as $key => $value) {
	    if ( preg_replace("/^<[^\>]*>\s*<[^\>]*>/", "", $ContentObj->GetEditableRegion($key)) != "")  {
		  $this->Content = str_replace($value,$ContentObj->GetEditableRegion($key),$this->Content);
	    }
	  }
	}
	
	public function GetEditableRegion($region) {
		$open =  "<!-- " . '(Instance|Template)BeginEditable name="'. $region .'" -->';
		$content =$this->Content;
		$close =  "<!-- " . '(Instance|Template)EndEditable -->';
		$regionContent = "";
		$editable = preg_match("/".$open."/i",$content,$Name);
		$closeeditable = preg_match("/".$close."/i",$content,$End);
		if ($editable && $closeeditable)  {
		  $beforeOrig = substr($content,0,strpos($content,$Name[0]));
		  $afterOrig = substr($content,strlen($beforeOrig));
		  $regionContent = substr($afterOrig,0,strpos($afterOrig,$End[0])).$End[0];
		}
		$regionContent = preg_replace("/".$open."/", "", $regionContent);
		$regionContent = preg_replace("/".$close."/", "", $regionContent);
		return $regionContent;
	}
	
	public function AppendToHead($appendString) {
	  if (strpos($this->Content,"</head>") && $appendString)
	    $this->Content = substr($this->Content,0,strpos($this->Content,"</head>")) . $appendString . substr($this->Content ,strpos($this->Content,"</head>")) ;
	}
	
    public function UpdatePaths($origStr,$endDir,$startDir)  {
        if ($startDir==".")  $startDir = $endDir;
        if ($startDir=="..") $startDir = "../";
		$props = array();
		$props[] = 'href';
		$props[] = 'action';
		$props[] = 'src';
		//  @import url("css/common.css");
		$subStr = $origStr;
		$matchpat = '/url(\(|=[\'"])([\'"])?([^)\'"\r\n]*)["\']?(\)|["\'];)/i';
		preg_match($matchpat,$origStr,$subPats);
		$ignore = '/^(https?:\/\/|mailto:|javascript:|#|\/)/i';
		while (sizeof($subPats) > 0)  {
			if (preg_match($ignore,$subPats[3])==0 && $subPats[3] != "") {
			  $combineDir = rel2abs($startDir,$endDir);
			  $absDir = rel2abs($subPats[3],$combineDir);
			  $relDir = abs2rel($absDir,$endDir); 
			  $origStr = str_replace($subPats[0],'url'. $subPats[1] . $subPats[2] . $relDir. $subPats[2] . $subPats[4],$origStr);
		    }
			$subStr = str_replace($subPats[0],'',$subStr);
		    preg_match($matchpat,$subStr,$subPats);
		}
		for ($x=0; $x<sizeof($props); $x++)  {
		  $subStr = $origStr;
		  $matchptn = $props[$x];
		  preg_match('/'.$matchptn.'=([\'"])([^"\']*)["\']/i',$origStr,$subPats);
		  while (sizeof($subPats) > 0)  {
			if (preg_match($ignore,$subPats[2])==0) {
			    $combineDir = rel2abs($startDir,$endDir);
			    $absDir = rel2abs($subPats[2],$combineDir);
			    $relDir = abs2rel($absDir,$endDir);
				$origStr = str_replace($subPats[0],$matchptn.'=' . $subPats[1] . $relDir. $subPats[1] . '',$origStr);
			  }
			  $subStr = str_replace($subPats[0],'',$subStr);
			  preg_match('/'.$matchptn.'=([\'"])([^"\']*)["\']/i',$subStr,$subPats);
		  }
		}
		return $origStr;
	}
	
	public function TagContents($tag,$instr)  {
	  $retVal = $instr;
	  $tagFound = preg_match('/<'.$tag.'[^>]*>/i',$instr, $startTag);
	  $endTagFound = preg_match('/<\/'.$tag.'>/i',$instr, $endTag);
	  if ($tagFound && $endTagFound)  {
	    $retVal = substr($instr, strpos($instr,$startTag[0]) + strlen($startTag[0]));
	    $retVal = substr($retVal,0, strpos($retVal,$endTag[0]));
	  }
	  
	  // if the content hasn't changed, this indiates the tag was not found, then return empty value
	  if($retVal == $instr && $tag != 'body'){
	    $retVal = '';
	  }
	  return $retVal;
	}
	
	public function Initialize($doUpdates=false) {
	  $content = ob_get_clean();
	  chdir($this->Start_Dir);
	  foreach ($this->Added as $key => $value) {
			unset($_GET[$key]);
	  }
	  foreach ($this->Reset as $key => $value) {
			$_GET[$key] = $value;
	  }
	  // update paths
	  if ($doUpdates) $content = $this->UpdatePaths($content,$this->Start_Dir,$this->Dir);
	  
	  $this->Content = $content;
	  preg_match("/<!DOCTYPE[^>]*>\s*/",$content,$doctypes);
	  $doctype = "";
	  if ($doctypes)  {
	    $doctype = $doctypes[0];
	  }
	  
	  $above = $content;
	  
	  $html = $this->TagContents("html",$content);
	  
	  if ($html!="")  {
	    $above = substr($content, 0, strpos($content,$html));
	    if ($doctype) $above = str_replace($doctype,"",$above);
	  }
	  
	  $templateOpen = "/<!-- " .'(Instance|Template)BeginEditable name="([^"]*)" -->/';
	  $templateClose =  "/<!-- " . '(Instance|Template)EndEditable -->/';
	  
	  $body = $this->TagContents("body",$content);
	  $head = $this->TagContents("head",$content);
	   
	  $title = $this->TagContents("title",$content);
	  $title = preg_replace("/^[\w\W]*<title[^>]*>/i", "", $title);
	  $title = preg_replace("/<\/title>[\w\W]*$/i", "", $title);
	  $head = preg_replace("/<title[^>]*>[\w\W]*?<\/title>/i", "", $head);
	  $head = preg_replace($templateOpen, "", $head);
	  $head = preg_replace($templateClose, "", $head);
	  
	  $body = preg_replace($templateOpen, "", $body);
	  $body = preg_replace($templateClose, "", $body);
	  
	  $this->Body = $body;
	  $this->Head = $head;
	  $this->HTML = $html;
	  $this->Title = $title;
	  $this->Above = $above;
	  $this->DocType = $doctype;
	  
	  preg_match_all("/<meta[^>]*>[\n\r]*/i", $head, $metas);
      foreach ($metas as  $meta) {
		if (isset($meta[0]))  {
          $this->MetaTags.= $meta[0] . "\n";
		  if (preg_match('/\s{1,}name\s*=\s*"keywords"/i',$meta[0]))  {
			$this->MetaKeywords = $meta[0];
			if (preg_match("/\scontent\s*=(['".'"'."])([^\r\n]*)\\1/i",$meta[0],$contents))  {
				$this->MetaKeywords_Content = $contents[2];
			}
		  }
		  if (preg_match('/\s{1,}name\s*=\s*"description"/i',$meta[0]))  {
			$this->MetaDescription = $meta[0];
			if (preg_match("/\scontent\s*=(['".'"'."])([^\r\n]*)\\1/i",$meta[0],$contents))  {
				$this->MetaDescription_Content = $contents[2];
			}
		  }
		  if (preg_match('/\s{1,}http-equiv\s*=\s*"Content-Type"/i',$meta[0]))  {
			$this->MetaContentType = $meta[0];
			if (preg_match("/\scontent\s*=(['".'"'."])([^\r\n]*)\\1/i",$meta[0],$contents))  {
				$this->MetaContentType_Content = $contents[2];
			}
		  }
		}
      }
	  preg_match_all("/<link[^>]*>[\n\r]*/i", $head, $links);
      foreach ($links[0] as  $link) {
        if ($link) $this->Links[] = $link. "\n";
      }
      preg_match_all("/(\<\!--\[if [\w\W]*\]\>[\n\r\s\t]*)?<style[^>]*>[\w\W]*?<\/style>[\n\r]*([\n\r\s\t]*\<\!\[endif\]--\>[\n\r\s\t]*)?/i", $head, $styles);
      foreach ($styles[0] as $style) {
        if ($style) $this->Styles[] =$style . "\n";
      }
    }
}
?>