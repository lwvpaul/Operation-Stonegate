<?php
require_once('../Connections/GoCreate.php');
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );
?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}

mysql_select_db($database_GoCreate, $GoCreate);
$query_rs_category = "SELECT * FROM product_cats";
$rs_category = mysql_query($query_rs_category, $GoCreate) or die(mysql_error());
$row_rs_category = mysql_fetch_assoc($rs_category);
$totalRows_rs_category = mysql_num_rows($rs_category);

if ("" == "") {
    $WA_main_menu_1300386231410 = new WA_Include("main_menu.php");
    require($WA_main_menu_1300386231410->BaseName);
    $WA_main_menu_1300386231410->Initialize(true);
}

if ("" == "") {
    $WA_footer_1300717372941 = new WA_Include("footer.php");
    require($WA_footer_1300717372941->BaseName);
    $WA_footer_1300717372941->Initialize(true);
}

if ("" == "") {
    $WA_catdropdown_1302430250407 = new WA_Include("GSNET_LIB/php/catdropdown.php?dis=Y&ID=" . $row_rs_category['ID'] . "&CAT=y");
    require($WA_catdropdown_1302430250407->BaseName);
    $WA_catdropdown_1302430250407->Initialize(true);
}

if ("" == "") {
    $WA_cnt_loop_1302357765912 = new WA_Include("GSNET_LIB/php/cnt_loop.php?cnt=10&sel=y");
    require($WA_cnt_loop_1302357765912->BaseName);
    $WA_cnt_loop_1302357765912->Initialize(true);
}

if ("" == "") {
    $WA_sitestats_1301303033310 = new WA_Include("sitestats.php");
    require($WA_sitestats_1301303033310->BaseName);
    $WA_sitestats_1301303033310->Initialize(true);
}
?>
<?php
// RepeatSelectionCounter_1 Initialization
$RepeatSelectionCounter_1 = 0;
$RepeatSelectionCounterBasedLooping_1 = false;
$RepeatSelectionCounter_1_Iterations = "-1";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>GoCreate Dashboard</title>
        <script type="text/javascript" src="GSNET_LIB/javascript/checkall.js"></script>
        <link href="../includes/CSSLayouts/CSSLayouts.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../includes/CSSLayouts/debug_plus.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/acl.css" />
        <script language="javascript" src="javascript/jquery.min.js" type="text/javascript"></script>
        <script language="javascript" src="javascript/jquery.blockUI.js" type="text/javascript"></script>
        <link href="../includes/CSSLayouts/GoCreateAdmin1.css" rel="stylesheet" type="text/css" />
        <link href="../includes/CSSLayouts/GoCreateAdmin1_user.css" rel="stylesheet" type="text/css" />
        <?php echo((isset($WA_main_menu_1300386231410)) ? $WA_main_menu_1300386231410->Head : "") ?>
        <script type="text/javascript">
            function MM_showHideLayers() { //v9.0
                var i,p,v,obj,args=MM_showHideLayers.arguments;
                for (i=0; i<(args.length-2); i+=3) 
                with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
                    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
                    obj.visibility=v; }
            }
            function MM_popupMsg(msg) { //v1.0
                alert(msg);
            }
        </script>
        <?php echo((isset($WA_footer_1300717372941)) ? $WA_footer_1300717372941->Head : "") ?><?php echo((isset($WA_sitestats_1301303033310)) ? $WA_sitestats_1301303033310->Head : "") ?>
        <link href="css/forms.css" rel="stylesheet" type="text/css" />
        <link href="css/page.css" rel="stylesheet" type="text/css" />
        <?php echo((isset($WA_cnt_loop_1302357765912)) ? $WA_cnt_loop_1302357765912->Head : "") ?><?php echo((isset($WA_catdropdown_1302430250407)) ? $WA_catdropdown_1302430250407->Head : "") ?><?php echo((isset($WA_catdropdown_1306323940331)) ? $WA_catdropdown_1306323940331->Head : "") ?>
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
                                    <?php echo((isset($WA_main_menu_1300386231410)) ? $WA_main_menu_1300386231410->Body : "") ?> <!-- row_2 Content Ends Here -->
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
                                    <?php echo((isset($WA_sitestats_1301303033310)) ? $WA_sitestats_1301303033310->Body : "") ?> <!-- leftcolumn Content Ends Here -->
                                </div>
                            </div>
                            <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
                                <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
                                    <!-- centercolumn Content Starts Here -->
                                    <div id="HeaderTitle">Design Category List <span id="SubHeaderTitle">(icons to be 232px wide)</span></div>
                                    <div style="position: relative;">
                                        <form id="form1" name="form1" method="POST" action="DesignCategoriesUpdateInc.php">
                                            <table border="0" cellpadding="4" cellspacing="0" class="form">
                                                <tr class="form_txt" style="text-align: center;">
                                                    <td align="left">All 
                                                        <input name="chkall_1" type="checkbox" id="chkall_1" onclick="CheckAll(this.form,this.value);" value="C_ID[]" /></td>
                                                    <td>Category Name</td>
                                                    <td>Path</td>
                                                    <td>Text Header</td>
                                                    <td>Section</td>
                                                    <td>Icon</td>
                                                    <td>Visable</td>
                                                    <td colspan="2">Options</td>
                                                </tr>
                                                <?php
                                                // RepeatSelectionCounter_1 Begin Loop
                                                $RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
                                                while ($RepeatSelectionCounter_1_IterationsRemaining--) {
                                                    if ($RepeatSelectionCounterBasedLooping_1 || $row_rs_category) {
                                                        ?>
                                                        <tr class="roweffect">
                                                            <td class="form_txt"><?php echo $RepeatSelectionCounter_1 + 1; ?>.
                                                                <input name="C_ID[]" type="checkbox" id="C_ID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rs_category['ID']; ?>" /></td>
                                                            <td class="form_txt"><?php echo $row_rs_category['TITLE_NAME']; ?></td>
                                                            <td class="form_txt">
                                                                <?php
                                                                if ("" == "") {
                                                                    //$WA_catdropdown_1306323940331 = new WA_Include("GSNET_LIB/php/catdropdown.php?ID=" . $row_rs_category['DES_CAT'] . "&dis=Y");
                                                                    $WA_catdropdown_1306323940331 = new WA_Include("GSNET_LIB/php/catdropdown.php");
                                                                    require($WA_catdropdown_1306323940331->BaseName);
                                                                    $WA_catdropdown_1306323940331->Initialize(true);
                                                                }
                                                                echo((isset($WA_catdropdown_1306323940331)) ? $WA_catdropdown_1306323940331->Body : "");
                                                                ?>
                                                            </td>
                                                            <td class="form_txt" title="Click to view text" ><?php if ($row_rs_category['TEXTHEADER'] != "") { ?>
                                                                    <script language="javascript">$(document).ready(function() { $.blockUI.defaults.css = {};$.blockUI.defaults.overlayCSS = {}; $().ajaxStart(function() {$.blockUI({ message: '<div id="loading"><img  src="images/green_small.gif" /><span>Loading Category HTML Preview...</span></div>'}); });$('#TxtPreviewLink_<?php echo $RepeatSelectionCounter_1; ?>').click(function() {$.ajax({url : 'cattxtpreview.php?C_ID=<?php echo $row_rs_category['ID']; ?>',success : function (data) {$.blockUI({message: $('#TxtPreviewHolder_<?php echo $RepeatSelectionCounter_1; ?>'),css: {padding:0,margin:0,width:'580px',top:'15%',left:'25%',color:'#000',padding:'15px',backgroundColor:'#fff'}});$("#TxtPreviewHolder_<?php echo $RepeatSelectionCounter_1; ?>").html(data);$('.blockOverlay').attr('title',' ').click($.unblockUI);}})});});</script>
                                                                    <a href="javascript:void(0)" id="TxtPreviewLink_<?php echo $RepeatSelectionCounter_1; ?>">View</a>
                                                                    <div id="TxtPreviewHolder_<?php echo $RepeatSelectionCounter_1; ?>" style="display:none"></div>
                                                                <?php } ?></td>
                                                            <td align="center" class="form_txt"><?php echo $row_rs_category['SECTION']; ?></td>
                                                            <td class="form_txt"title="hover to view image" ><?php if ($row_rs_category['ICON'] != "") { ?>
                                                                    <a href="javascript:void(0)" onmouseover="MM_showHideLayers('apDiv<?php echo $RepeatSelectionCounter_1; ?>','','show')" onmouseout="MM_showHideLayers('apDiv<?php echo $RepeatSelectionCounter_1; ?>','','hide')">View</a>
                                                                    <div>
                                                                        <div id="apDiv<?php echo $RepeatSelectionCounter_1; ?>" style="visibility: hidden; position:absolute; width:200px;height:115px;z-index:1;"> <img src="<?php echo $row_rs_category['ICON']; ?>" alt="<?php echo $row_rs_category['TITLE_NAME']; ?>" name="<?php echo $row_rs_category['TITLE_NAME']; ?>" /></div>
                                                                    </div>
                                                                <?php } ?></td>
                                                            <td class="form_txt"><?php if ($row_rs_category['VISABLE'] == "Y") {
                                                            echo "Yes";
                                                        } else {
                                                            echo "No";
                                                        } ?></td>
                                                            <td class="leftborder"><input name="Edit" type="submit" class="cust_button" id="Edit" value="Edit" onclick="
                                  document.getElementById('C_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='DesignCategoriesUpdate.php';"/></td>
                                                            <td><input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" onclick="
                                  document.getElementById('C_ID_<?php echo $RepeatSelectionCounter_1; ?>').checked=true;this.form.action='DesignCategoriesDelete.php';" /></td>
                                                        </tr>
        <?php
    } // RepeatSelectionCounter_1 Begin Alternate Content
    elseif ($totalRows_rs_category = 0) {
        ?>

                                                        <tr class="roweffect">
                                                            <td colspan="9" class="form_txt">It appears there are no catergories in your site yet.<br />
                                                                Please use the drop down option below to selct how many catergories you would like to add</td>
                                                        </tr>
                                                    <?php
                                                    } // RepeatSelectionCounter_1 End Alternate Content
                                                    if (!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0) {
                                                        if (!$row_rs_category && $RepeatSelectionCounter_1_Iterations == -1) {
                                                            $RepeatSelectionCounter_1_IterationsRemaining = 0;
                                                        }
                                                        $row_rs_category = mysql_fetch_assoc($rs_category);
                                                    }
                                                    $RepeatSelectionCounter_1++;
                                                } // RepeatSelectionCounter_1 End Loop
                                                ?><tr>
                                                    <td class="form_txt topborder">All
                                                        <input name="chkall_2" type="checkbox" id="chkall_2" onclick="CheckAll(this.form,this.value);" value="C_ID[]" />
                                                        <label for="chkall_2"></label></td>
                                                    <td colspan="8" class="topborder">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="9" class="topborder" style="text-align: right;">
                                                        <input name="EditSelected" type="submit" class="cust_button" id="EditSelected" onclick="this.form.action='DesignCategoriesUpdate.php?CAT=U';" value="EditSelected" />
                                                        <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" onclick="this.form.action='DesignCategoriesDelete.php';" value="DeleteSelected" /></td>
                                                </tr>
                                            </table>

                                            <table cellpadding="2" cellspacing="0" border="0">
                                                <tr>
                                                    <td align="center"><input type="hidden" name="WADbSearch1" value="Submit" /></td>
                                                </tr>
                                            </table>
                                        </form>
                                        <form action="DesignCategoriesAdd.php" method="post" name="form2">
                                            <div style="padding-top: 15px; position: relative;">
                                                <table border="0" align="left" cellpadding="4" cellspacing="4" class="form">
                                                    <tr>
                                                        <td class="form_txt">Add  
                                                            <select name="NewAdd" class="form" onchange="this.form.submit();">
                                                            <?php
                                                            echo((isset($WA_cnt_loop_1302357765912)) ? $WA_cnt_loop_1302357765912->Body : "") ?>
                                                            </select>
                                                        </td>
                                                        <td class="form_txt">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- centercolumn Content Ends Here -->
                                </div>
                            </div>
                            <div class='cssLClearC'></div>
                        </div>
                    </div>

                    <div class='cssLO GoCreateAdmin1_footer_layout'>
                        <div class='footer cssLI GoCreateAdmin1_footer_design'>
                            <!-- footer Content Starts Here -->
<?php echo((isset($WA_footer_1300717372941)) ? $WA_footer_1300717372941->Body : "") ?> <!-- footer Content Ends Here -->
                        </div>
                    </div>
                    <div class='cssLClearR'></div>
                </div>
            </div>
            <div class="cssLClearL"></div>
            <!-- #GoCreateAdmin1 (CSSLayouts End) -->
        </div>
    </body>
</html>
<?php
mysql_free_result($rs_category);
?>