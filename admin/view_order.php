<?php
if(!isset($_GET['id']) || $_GET['id'] == ''){
    header("Location: new_orders.php");
}

require_once('../Connections/GoCreate.php');

$id = $_GET['id'];
$query = "SELECT * FROM order_history WHERE ORID = '".$id."'";
$result = mysql_query($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View Order</title>
        <style type="text/css">
            #viewOrder {
                border: 1px solid #999;
                border-collapse: collapse;
                width: 900px;
            }
            #viewOrder thead {
                background-color: #ccc;
            }
            #viewOrder td {
                text-align: center;
            }
            #viewOrder .even {
                background-color: #eee;
            }
            #viewOrder .odd {
                
            }
        </style>
    </head>
    <body>
        <h1>View Order</h1>
        <h2>Order Details</h2>
        <?php
        $sql = "SELECT PUB, ORID, ORDER_DATE, ORDER_STATUS FROM order_history WHERE ORID = '".$id."' GROUP BY ORID";
        $sqlResult = mysql_query($sql);
        $sqlRow = mysql_fetch_assoc($sqlResult);
        ?>
        <p>
            <strong>Order ID:</strong> <?php echo $sqlRow['ORID']; ?><br/>
            <strong>Pub:</strong> <?php echo $sqlRow['PUB']; ?><br/>
            <strong>Order Date:</strong> <?php echo $sqlRow['ORDER_DATE']; ?><br/>
            <strong>Status:</strong> <?php echo $sqlRow['ORDER_STATUS']; ?>
        </p>
        <table id="viewOrder">
            <thead>
                <tr>
                    <th width="150px">Image</th>
                    <th>Design</th>
                    <th>Type</th>
                    <th width="100px">Size</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            while($row = mysql_fetch_assoc($result)) {
                if($i % 2) {
                    $rowClass = 'even';
                } else {
                    $rowClass = 'odd';
                }
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td rowspan="2"><img src="../phpThumb.php?src=<?php echo '.'.$row['design_image']; ?>&amp;w=150&amp;h=150&amp;far=1"/></td>
                    <td><?php echo $row['DESIGN_NAME']; ?></td>
                    <td><?php echo $row['MEDIA_TYPE']; ?></td>
                    <td><?php echo $row['MEDIA_SIZE']; ?></td>
                    <td><?php echo $row['ORDER_QTY']; ?></td>
                </tr>
                <tr class="<?php echo $rowClass; ?>">
                    <td colspan="4">
                        <p><strong>Amendments</strong></p>
                        <p><?php echo $row['AMENDMENTS']; ?></p>
                    </td>
                </tr>
            <?php
            $i++;
            }
            ?>
            </tbody>
        </table>
    </body>
</html>