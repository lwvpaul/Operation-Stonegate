<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js" type="text/javascript"></script>
<script src="http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js" type="text/javascript"></script>
<script src="http://dwpe.googlecode.com/svn/trunk/_shared/jquery.min.js" type="text/javascript"></script>
<script src="http://dwpe.googlecode.com/svn/trunk/charting/js/visualize.jQuery.js" type="text/javascript"></script>
<link href="http://dwpe.googlecode.com/svn/trunk/charting/css/basic.css" rel="stylesheet" type="text/css" />
<link href="http://dwpe.googlecode.com/svn/trunk/charting/css/visualize.css" rel="stylesheet" type="text/css" />
<link href="http://dwpe.googlecode.com/svn/trunk/charting/css/visualize-light.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/* BeginOAWidget_Instance_2281525: #jQueryVisualizeChart */

@import url("http://dwpe.googlecode.com/svn/trunk/charting/css/visualize-light.css");

.dwpeAd {
	color: #333;
	background-color: #F4F3Ea;
	position:fixed;
	right: 20px;
	top: 20px;
	padding: 5px;
}

.visualize { 
	margin: 20px 0 0 30px; 
}
		
/* EndOAWidget_Instance_2281525 */
</style>
<script type="text/xml">
<!--
<oa:widgets>
  <oa:widget wid="2281525" binding="#jQueryVisualizeChart" />
</oa:widgets>
-->
</script>
</head>

<body>
<script type="text/javascript">
// BeginOAWidget_Instance_2281525: #jQueryVisualizeChart

   	$(function(){
		 $('table').visualize({type: 'line', height: '200px', width: '350px', appendTitle : false, lineWeight : 2, colors : ['#be1e2d','#666699','#92d5ea','#ee8310','#8d10ee','#5a3b16','#26a4ed','#f45a90','#e9e744']}).appendTo('#jQueryVisualizeChart').trigger('visualizeRefresh');

		});
	 	
// EndOAWidget_Instance_2281525
</script>
<div id="jQueryVisualizeChart"></div>
<br />
<table>
  <caption>
    2010 Employee Sales by Department
  </caption>
  <thead>
    <tr>
      <td></td>
      <th scope="col">food</th>
      <th scope="col">auto</th>
      <th scope="col">household</th>
      <th scope="col">furniture</th>
      <th scope="col">kitchen</th>
      <th scope="col">bath</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Mary</th>
      <td>190</td>
      <td>160</td>
      <td>40</td>
      <td>120</td>
      <td>30</td>
      <td>70</td>
    </tr>
    <tr>
      <th scope="row">Tom</th>
      <td>3</td>
      <td>40</td>
      <td>30</td>
      <td>45</td>
      <td>35</td>
      <td>49</td>
    </tr>
    <tr>
      <th scope="row">Brad</th>
      <td>10</td>
      <td>180</td>
      <td>10</td>
      <td>85</td>
      <td>25</td>
      <td>79</td>
    </tr>
    <tr>
      <th scope="row">Kate</th>
      <td>40</td>
      <td>80</td>
      <td>90</td>
      <td>25</td>
      <td>15</td>
      <td>119</td>
    </tr>
  </tbody>
</table>
</body>
</html>