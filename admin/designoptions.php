<?php if (!session_id()) session_start();?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "".$_GET['cnt']  ."";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<div id="optionstab" style="left: 30px; position: relative;">  
<table border="0" cellspacing="4" class="form">
  <tr class="form_txt">
    <th scope="col">No</th>
    <th align="left" scope="col">Option Name</th>
    <th align="left" scope="col">Option description</th>
  </tr>
<?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>  
   <tr class="bottomborder form_txt">
    <td valign="top" scope="row"><?php echo $RepeatSelectionCounter_1+1; ?>.</th>
    <td valign="top"><label for="textfield"></label>
      <input name="textfield" type="text" id="textfield" size="45" /></td>
    <td><label for="textarea"></label>
     
          <textarea name="textarea2" id="textarea2" cols="45" rows="1"></textarea>
          
      
    </td>
  </tr>
 <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>   
</table>
</div>
<hr style="color:#004923"/>
</body>
</html>