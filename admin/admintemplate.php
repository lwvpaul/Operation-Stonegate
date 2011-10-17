<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?><?php
if("" == ""){
	$WA_menu_1302717872195 = new WA_Include("menu.php");
	require($WA_menu_1302717872195->BaseName);
	$WA_menu_1302717872195->Initialize(true);
}

if("" == ""){
	$WA_calender_1302770197442 = new WA_Include("GSNET_LIB/inc/calender.html");
	require($WA_calender_1302770197442->BaseName);
	$WA_calender_1302770197442->Initialize(true);
}

if("" == ""){
	$WA_AdminHeader_1302769428616 = new WA_Include("AdminHeader.php");
	require($WA_AdminHeader_1302769428616->BaseName);
	$WA_AdminHeader_1302769428616->Initialize(true);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/CSSLayouts/CSSLayouts.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../includes/CSSLayouts/debug_plus.js"></script>
<link href="../includes/CSSLayouts/GoCreateAdminV2.css" rel="stylesheet" type="text/css" />
<link href="../includes/CSSLayouts/GoCreateAdminV2_user.css" rel="stylesheet" type="text/css" />
<?php echo((isset($WA_menu_1302717872195))?$WA_menu_1302717872195->Head:"") ?><?php echo((isset($WA_AdminHeader_1302769428616))?$WA_AdminHeader_1302769428616->Head:"") ?><?php echo((isset($WA_calender_1302770197442))?$WA_calender_1302770197442->Head:"") ?>
</head>

<body class="GoCreateAdminV2_body_design">
<div class="GoCreateAdminV2">
  <!-- (CSSLayouts Begin)  #GoCreateAdminV2 #build_version=1.1.276;pack=;category=;layout=;layoutType=page;scheme=;cssSource=file;assets=;halign=center;minwidth=960px;maxwidth=2000px;width=100%;bc=;bl=-->
  <div class='cssLO GoCreateAdminV2_wrapper_layout'>
    <div class='wrapper cssLI GoCreateAdminV2_wrapper_design'>
      <div class='cssLO GoCreateAdminV2_logoclock_layout'>
        <div class='logoclock cssLI GoCreateAdminV2_logoclock_design'>
          <!-- logoclock Content Starts Here --><?php echo((isset($WA_AdminHeader_1302769428616))?$WA_AdminHeader_1302769428616->Body:"") ?><!-- logoclock Content Ends Here -->
        </div>
      </div>
      <div class='cssLO GoCreateAdminV2_contentholder2_layout'>
        <div class='contentholder2 cssLI GoCreateAdminV2_contentholder2_design'>
          <div class='cssLO GoCreateAdminV2_statsinfo_layout'>
            <div class='statsinfo cssLI GoCreateAdminV2_statsinfo_design'>
              <!-- statsinfo Content Starts Here -->
			  <?php echo((isset($WA_calender_1302770197442))?$WA_calender_1302770197442->Body:"") ?><br />
			               
              <!-- statsinfo Content Ends Here -->
            </div>
          </div>
          <div class='cssLO GoCreateAdminV2_contentholder3_layout'>
            <div class='contentholder3 cssLI GoCreateAdminV2_contentholder3_design'>
              <div class='cssLO GoCreateAdminV2_menu_layout'>
                <div class='menu cssLI GoCreateAdminV2_menu_design'>
                  <!-- menu Content Starts Here -->
                  <?php echo((isset($WA_menu_1302717872195))?$WA_menu_1302717872195->Body:"") ?>
                  <!-- menu Content Ends Here -->
                </div>
              </div>
              <div class='cssLO GoCreateAdminV2_info_layout'>
                <div class='info cssLI GoCreateAdminV2_info_design'>
                  <!-- info Content Starts Here -->
                  <div id="ScrollInfoHolder" style="left: 10px; position: relative; overflow: auto;"> sdvsdvsdvdsvsvdv </div>
                  <!-- info Content Ends Here -->
                </div>
              </div>
              <div class='cssLClearR'></div>
            </div>
          </div>
          <div class='cssLClearC'></div>
        </div>
      </div>
      <div class='cssLClearR'></div>
    </div>
  </div>
  <div class="cssLClearL"></div>
  <!-- #GoCreateAdminV2 (CSSLayouts End) -->
</div>
</body>
</html>