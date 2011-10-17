<?php
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );

if (!session_id())
    session_start();
if (isset($_GET['pageNum_rs_DesignList'])) {
    $_SESSION['GC_Counter'] = ((15 * $_GET['pageNum_rs_DesignList']) + 1);
} else {
    $_SESSION['GC_Counter'] = 1;
}

$WA_DesignListInc_1303047531864 = new WA_Include("DesignListInc.php");
require($WA_DesignListInc_1303047531864->BaseName);
$WA_DesignListInc_1303047531864->Initialize(true);

$WA_footer_1303480507985 = new WA_Include("footer.php");
require($WA_footer_1303480507985->BaseName);
$WA_footer_1303480507985->Initialize(true);

$WA_main_menu_1306060302892 = new WA_Include("main_menu.php");
require($WA_main_menu_1306060302892->BaseName);
$WA_main_menu_1306060302892->Initialize(true);

if (isset($_POST["ClearFilter"])) {
    // WA_ClearSession
    $clearAll = FALSE;
    $clearThese = explode(",", "WADbSearch1_DesignListInc");
    if ($clearAll) {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    } else {
        foreach ($clearThese as $value) {
            unset($_SESSION[$value]);
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../includes/CSSLayouts/GoCreateAdmin1.css" rel="stylesheet" type="text/css" />
        <link href="../includes/CSSLayouts/GoCreateAdmin1_user.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="GSNET_LIB/javascript/checkall.js"></script>
        <script>
            function MM_goToURL() { //v3.0
                var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
                for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
            }
        </script>
        <title><?php echo((isset($WA_DesignListInc_1303047531864)) ? $WA_DesignListInc_1303047531864->Title : "") ?></title>
        <?php echo((isset($WA_DesignListInc_1303047531864)) ? $WA_DesignListInc_1303047531864->Head : "") ?>
        <?php echo((isset($WA_footer_1303480507985)) ? $WA_footer_1303480507985->Head : "") ?>
        <?php echo((isset($WA_main_menu_1306060302892)) ? $WA_main_menu_1306060302892->Head : "") ?>
    </head>

    <body class="GoCreateAdmin1_body_design">
        <div class="GoCreateAdmin1">
            <!-- (CSSLayouts Begin)  #GoCreateAdmin1 #build_version=1.1.276;pack=User;category=My Page Layouts;layout=;layoutType=page;scheme=;cssSource=file;assets=;halign=center;minwidth=960px;maxwidth=1259px;width=80%;bc=My Page Layouts;bl=GoCreateAdmin-->
            <div class='cssLO GoCreateAdmin1_wrapper_layout'>
                <div class='wrapper cssLI GoCreateAdmin1_wrapper_design'>
                    <div class='cssLO GoCreateAdmin1_header_layout'>
                        <div class='header cssLI GoCreateAdmin1_header_design'>
                            <div class='cssLO GoCreateAdmin1_row_1_layout'>
                                <div class='row_1 cssLI GoCreateAdmin1_row_1_design'>
                                    <!-- row_1 Content Starts Here -->
                                                 <span style="left: 30px; top: 20px; position: relative; color: #000; font-size: 36px;">Stonegate Admin</span>
                                    <!-- row_1 Content Ends Here -->
                                </div>
                            </div>

                            <div class='cssLO GoCreateAdmin1_row_2_layout'>
                                <div class='row_2 cssLI GoCreateAdmin1_row_2_design'>
                                    <!-- row_2 Content Starts Here -->
                                    <?php echo((isset($WA_main_menu_1306060302892)) ? $WA_main_menu_1306060302892->Body : "") ?> <!-- row_2 Content Ends Here -->
                                </div>
                            </div>
                            <div class='cssLClearR'></div>
                        </div>
                    </div>
                    
                    <div class='cssLO GoCreateAdmin1_content_layout'>
                        <div class='content cssLI GoCreateAdmin1_content_design'>
                            <div class='cssLO GoCreateAdmin1_leftcolumn_layout'>
                                <div class='leftcolumn cssLI GoCreateAdmin1_leftcolumn_design'>
                                    <!-- leftcolumn Content Starts Here -->

                                </div>
                        </div>





<div class='cssLO GoCreateAdmin1_centercolumn_layout'>
                                <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
                                    <!-- centercolumn Content Starts Here -->
                                    <div id="HeaderTitle">Design Category List
                                    <div style="position: relative;">
                  <?php echo((isset($WA_DesignListInc_1303047531864)) ? $WA_DesignListInc_1303047531864->Body : "") ?>
                                    </div>
                                    <!-- centercolumn Content Ends Here -->
                                </div>
                            </div>
                            <div class='cssLClearC'></div>
                        </div>
                    </div>


















        <div class='cssLO GoCreateAdmin1_footer_layout'>
            <div class='footer cssLI GoCreateAdmin1_footer_design'>
                <?php echo((isset($WA_footer_1303480507985)) ? $WA_footer_1303480507985->Body : "") ?>
            </div>
        </div>
        </div>
    </body>
</html><?php unset($_SESSION['GC_Counter']); ?>