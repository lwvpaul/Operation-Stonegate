<?php // Add New select loop //
$loopcnt=0; do {echo"<option ";
if($_POST["NewAdd"]==$loopcnt){echo "Selected";}
echo " value=\"$loopcnt\">".$loopcnt."</option>";++$loopcnt;} while ($loopcnt <= $_GET['cnt'])
?>