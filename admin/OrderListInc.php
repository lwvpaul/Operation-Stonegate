<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="HeaderTitle">Orders List</div>
<table border="0" cellpadding="4" cellspacing="4" class="form">
  <tr class="form_txt" style="text-align: center;">
    <td>No.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Options</td>
  </tr>

  <tr class="roweffect">
    <td class="form_txt"><?php echo $RepeatSelectionCounter_1+1; ?>.
      <input name="checkbox" type="checkbox" id="checkbox" value="<?php echo $row_rs_category['ID']; ?>" /></td>
    <td class="form_txt">&nbsp;</td>
    <td class="form_txt">&nbsp;</td>
    <td class="form_txt">&nbsp;</td>
    <td class="form_txt">&nbsp;</td>
    <td class="form_txt">&nbsp;</td>
    <td class="form_txt">&nbsp;</td>
    <td><input name="Edit" type="submit" class="cust_button" id="Edit" value="Edit" /></td>
    <td><input name="Delete" type="submit" class="cust_button" id="Delete" value="Delete" /></td>
  </tr>
  
  <tr>
    <td colspan="9" style="text-align: right;"><input name="EditSelected" type="submit" class="cust_button" id="EditSelected" value="EditSelected" />
      <input name="DeleteSelected" type="submit" class="cust_button" id="DeleteSelected" value="DeleteSelected" /></td>
  </tr>
</table>
</body>
</html>