<html>
<head>
<style>
table, th, td {
    color: black;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

<body>
<form action="reagent_search_result.php" method="get">
<table width="300" border="0" cellspacing="3" align="left">
  <tr>
	<td align="right">RgRID:</td>
	<td><input type="text" size="20" name="RgRID" id="RgRID" /> </td>
  </tr>
  <tr>
	<td width="100" align="right">Keywords: </td>
	<td><input type="text" size="20" name="Keywords" id="Keywords" /> </td>
  </tr>
  <tr>
	<td align="right"><input type="reset" class="button" value="Reset" /></td>
	<td><input type="submit" class="button" value="Search" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</form>
</body>

</html>