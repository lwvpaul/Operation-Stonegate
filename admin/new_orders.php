<?php
require_once('../Connections/GoCreate.php');
require_once( "../webassist/framework/library.php" );
require_once( "../webassist/framework/framework.php" );

$query = "
    SELECT
    Count(order_history.MEDIA_TYPE) AS media_type_count,
    Count(order_history.MEDIA_SIZE) AS media_size_count,
    order_history.*
    FROM order_history
    GROUP BY
    order_history.ORID
    ";
$result = mysql_query($query) or die(mysql_error());

$WA_main_menu_1300386231410 = new WA_Include("main_menu.php");
require($WA_main_menu_1300386231410->BaseName);
$WA_main_menu_1300386231410->Initialize(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>New Orders</title>
        <link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.16.custom.css" />
        <link rel="stylesheet" href="css/demo_table_jui.css" />
        <link href="../includes/CSSLayouts/CSSLayouts.css" rel="stylesheet" type="text/css" />
        <link href="../includes/CSSLayouts/GoCreateAdmin1.css" rel="stylesheet" type="text/css" />
        <link href="../includes/CSSLayouts/GoCreateAdmin1_user.css" rel="stylesheet" type="text/css" />
        <style>
            .GoCreateAdmin1_centercolumn_layout {
                margin-left: 0!important;
            }
            #orderTable {
                width: 100%!important;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
        <script src="javascript/jquery.dataTables.js"></script>
        <script src="javascript/jquery-ui-1.8.16.custom.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#orderTable').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "aaSorting": [[ 0, "desc" ]]
            });
        });
        </script>
    </head>

    <body class="GoCreateAdmin1_body_design">
        <div class="GoCreateAdmin1">
            <div class='cssLO GoCreateAdmin1_wrapper_layout'>
                <div class='wrapper cssLI GoCreateAdmin1_wrapper_design'>
                    <div class='cssLO GoCreateAdmin1_header_layout'>
                        <div class='header cssLI GoCreateAdmin1_header_design'>
                            <div class='cssLO GoCreateAdmin1_row_1_layout'>
                                <div class='row_1 cssLI GoCreateAdmin1_row_1_design'>
                                    <span style="left: 30px; top: 20px; position: relative; color: #000; font-size: 36px;">
                                    Stonegate Admin
                                    </span>
                                </div>
                            </div>
                            <div class='cssLO GoCreateAdmin1_row_2_layout'>
                                <div class='row_2 cssLI GoCreateAdmin1_row_2_design'>
                                    <?php echo((isset($WA_main_menu_1300386231410))?$WA_main_menu_1300386231410->Body:"") ?>
                                </div>
                            </div>
                            <div class='cssLClearR'></div>
                        </div>
                    </div>
                    <div class='cssLO GoCreateAdmin1_content_layout'>
                        <div class='content cssLI GoCreateAdmin1_content_design'>
                            <div class='cssLO GoCreateAdmin1_centercolumn_layout'>
                                <div class='centercolumn cssLI GoCreateAdmin1_centercolumn_design'>
                                    <table id="orderTable">
                                        <thead>
                                            <th>Order Date</th>
                                            <th>Order ID</th>
                                            <th>Pub Name</th>
                                            <th># of Items</th>
                                            <th>Status</th>
                                            <th>Order Total</th>
                                            <th>View</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while($row = mysql_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['ORDER_DATE']; ?></td>
                                                <td><?php echo str_replace('ORD_ID', '', $row['ORID']); ?></td>
                                                <td><?php echo $row['PUB']; ?></td>
                                                <td><?php echo $row['media_type_count']; ?></td>
                                                <td><?php echo $row['ORDER_STATUS']; ?></td>
                                                <td>&pound;<?php echo $row['ORDER_TOTAL']; ?></td>
                                                <td><a href="view_order.php?id=<?php echo $row['ORID']; ?>">View order</a></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class='cssLClearC'></div>
                        </div>
                    </div>
                    <div class='cssLClearR'></div>
                </div>
            </div>
            <div class="cssLClearL"></div>
        </div>
    </body>
</html>