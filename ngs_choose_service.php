<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
th {
	font-weight: bold;
}
li.end {
	margin-left: 50px;
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>
<body>
<br>
<?php 
session_start();
require('login.php');?> 
<hr>
<br>	
<h6>ILLUMINA SEQUENCING SERVICES<h6>
<br>
<table>
  <tr>
	<td><p>Please choose the Illumina Sequencing service you are interested in:<br>
	<br></p>
	<ul>
		<li>FHS Illumina Sequencing Service: <a class="button" href="hiseq.php">Click</a>.</li>
		<li>Novogene Illumina Sequencing Service: <a class="button" href="novogene_hiseq.php">Click</a>.</li>
	</ul>
	</td>
  </tr>
</table>
</body>
</html>