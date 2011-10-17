<?php
require_once('../webassist/framework/library.php');
require_once('../webassist/framework/framework.php');
require_once('../Connections/GoCreate.php');

if(isset($_POST['AddAll'])) {
    // Count how many records are being added - quick and dirty
    $count = count($_POST['name']);

    // Loop through $_POST array
    for ($i=0; $i<$count; $i++) {
        $design = array();
        foreach($_POST as $key => $value) {
            //echo $key.' - '.$value[$i].', ';
            $design[] = $value[$i];
        }
        //echo '<pre>';
        //print_r($design);
        //echo '</pre>';

        $query = "INSERT INTO designs (DATE, DESIGN_NAME, DESIGN_REF, DESC_CAT, AMENDMENTS_ALLOWED, MULTI_PACK, OPTIONS) VALUES (NOW(), '$design[0]', '$design[1]', '$design[2]', '$design[3]', '$design[4]', '$design[5]')";
        mysql_query($query) or die(mysql_error());
    }

}

?>
<div id="HeaderTitle">Design List Add</div>

<form action="#" method="post" id="form1" name="form1">
    <table border="0" cellpadding="4" cellspacing="0" class="form">
        <tr class="form_txt">
            <th scope="col">No.</th>
            <th scope="col">Name</th>
            <th scope="col">Ref</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col">Amendments</th>
            <th scope="col">Multi-Pack</th>
            <th scope="col">Max Options</th>
        </tr>

        <?php
        $i = 1;
        while($i <= $counter) {
        ?>

        <tr class="roweffect">
            <td nowrap="nowrap" class="form_txt" scope="row">
            <?php echo $i; ?>
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">
                <input name="name[]" type="text" class="form" id="name_" />
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">
                <input name="ref[]" type="text" class="form" id="ref_" />
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">
                <select name="category[]">
                    <option value="NULL">Choose a category</option>
                    <?php
                    $query = "SELECT * FROM product_cats ORDER BY TITLE_NAME ASC";
                    $result = mysql_query($query);
                    while($row = mysql_fetch_assoc($result)) {
                        if($row['MENU_LEVEL'] == '-1') {   
                            echo '<option value="'.$row['ID'].'">--'.$row['TITLE_NAME'].' --</option>';

                            $id = $row['ID'];
                            $query2 = "SELECT * FROM product_cats WHERE MENU_LEVEL = '".$id."' ORDER BY TITLE_NAME ASC";
                            $result2 = mysql_query($query2);
                            while($row2 = mysql_fetch_assoc($result2)) {
                                echo '<option value="'.$row2['ID'].'"> > > '.$row2['TITLE_NAME'].'</option>';
                            }
                        }
                    }
                    ?>
                </select>
            </td>
            <td nowrap="nowrap" class="form_txt" title="Click to open editor" >  
                <a href="javascript:toggle();" id="ViewEditor">Open Editor</a>
                <div id="apDiv" style="position:absolute; width:600px; height:300px; z-index:1; left: 10px; top: 100px;display:none;">

                    <table width="120" border="0" align="center" cellpadding="0" cellspacing="0" class="form roweffect">
                        <tr>
                            <td align="center">
                                <a href="javascript:toggle();" id="ViewEditor" >Close Editor</a>
                            </td>
                        </tr>
                    </table>

                </div>
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">>
                <select name="amend[]" class="form" id="amend_">
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">
                <select name="multi[]" class="form" id="multi_">
                    <option value="N">No</option>
                    <option value="Y">Yes</option>
                </select>
            </td>
            <td nowrap="nowrap" class="form_txt" scope="row">
                <select name="MaxOp[]" class="form" id="MaxOp_" onchange="ajaxLoader('designoptions.php?cnt=+this.form.MaxOp_.value+&num=','optionsform')">
                    <option value="" selected="selected">N/A</option>
                    <option value="0">No Limit</option>
                    <?php echo((isset($WA_cnt_loop_1303132680698)) ? $WA_cnt_loop_1303132680698->Body : "") ?>
                </select>
            </td>
        </tr>
        <?php
            $i++;
        }
        ?>
        <tr>
            <th colspan="8" align="left" scope="row">
                <span id="optionsform"></span>
            </th>
        </tr>

        <tr>
            <th colspan="8" class="topborder" scope="row">&nbsp;</th>
        </tr>
    </table>
    <div style="top: 10px; position: relative;">
        <table border="0" cellpadding="4" cellspacing="4" class="form">
            <tr>
                <td class="form_txt">Add&nbsp;Designs
                    <select name="NewAdd" class="form" onchange="this.form.submit();">
                        <?php echo((isset($WA_cnt_loop_1303308361478)) ? $WA_cnt_loop_1303308361478->Body : "") ?>
                    </select>
                    <input name="AddAll" type="submit" class="cust_button" id="AddAll" value="AddAll" />
                    <input name="Cancel" type="button" class="cust_button" onclick="MM_goToURL('parent','DesignList.php');return document.MM_returnValue" value="Cancel &amp; Go Back" />
                </td>
            </tr>
        </table>
    </div>
</form>