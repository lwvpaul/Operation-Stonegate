<?php
require_once('../../../Connections/GoCreate.php');

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
$query_RS_ALLCATS = "SELECT * FROM product_cats ORDER BY ID ASC";
$RS_ALLCATS = mysql_query($query_RS_ALLCATS, $GoCreate) or die(mysql_error());
$row_RS_ALLCATS = mysql_fetch_assoc($RS_ALLCATS);
$totalRows_RS_ALLCATS = mysql_num_rows($RS_ALLCATS);
?>

<form id="form1" name="form1" method="post" action="">
    <select name="MENU_LEVEL_" id="MENU_LEVEL_">
        <?php
        do {
            $_SESSION['MENULOOP'] = $row_RS_ALLCATS['ID'];
            $prntcnt = 1;
            ?>
            <option value="<?php echo $row_RS_ALLCATS['ID'] ?>"
            <?php
            if(!(strcmp($row_RS_ALLCATS['ID'], "Matched Value"))) {
                echo 'selected="selected"';
            }
            ?>
            >
                        <?php
                        do {

                            $colname_RS_LOOP = "-1";
                            if (isset($_SESSION['MENULOOP'])) {
                                $colname_RS_LOOP = (get_magic_quotes_gpc()) ? $_SESSION['MENULOOP'] : addslashes($_SESSION['MENULOOP']);
                            }
                            mysql_select_db($database_GoCreate, $GoCreate);
                            $query_RS_LOOP = sprintf("SELECT * FROM product_cats WHERE ID = %s", GetSQLValueString($colname_RS_LOOP, "int"));
                            $RS_LOOP = mysql_query($query_RS_LOOP, $GoCreate) or die(mysql_error());
                            $row_RS_LOOP = mysql_fetch_assoc($RS_LOOP);
                            $totalRows_RS_LOOP = mysql_num_rows($RS_LOOP);

                            echo ' >> ';
                            echo $row_RS_LOOP['TITLE_NAME'];
                            $_SESSION['MENULOOP'] = $row_RS_LOOP['MENU_LEVEL'];
                            ++$prntcnt;
                        } while ($row_RS_LOOP['MENU_LEVEL'] != 0)
                        ?>
            </option>
            <?php
        } while ($row_RS_ALLCATS = mysql_fetch_assoc($RS_ALLCATS));
        $rows = mysql_num_rows($RS_ALLCATS);
        if ($rows > 0) {
            mysql_data_seek($RS_ALLCATS, 0);
            $row_RS_ALLCATS = mysql_fetch_assoc($RS_ALLCATS);
        }
        ?>
    </select>
</form>
<?php
mysql_free_result($RS_ALLCATS);
mysql_free_result($RS_LOOP);
?>