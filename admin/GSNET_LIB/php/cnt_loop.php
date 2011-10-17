<?php // Add New select loop //
$loopcnt=0;
do {
    echo"<option ";
    if (isset($_GET['sel'])) {
    if($_GET['sel'] != "n") {
        if(isset($_POST['NewAdd']) && $_POST["NewAdd"] == $loopcnt){
            echo "Selected";           
        }     
    } 
	}
    echo " value=\"$loopcnt\">".$loopcnt."</option>";$loopcnt++;
} while ($loopcnt <= $_GET['cnt'])
?>