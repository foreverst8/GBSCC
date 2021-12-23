<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, th, td {
    color: #002A60;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 0px;
    margin-bottom: 2px;
}
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>
<body>
<br>

<?php 
#session_start();
#require('login.php');?> 

<!--
<hr>
<br>
-->	

<h6>CALCULATOR<h6>

<table>
  <tr>
  	<td align="left" valign="top">
	<br>
    <p>EXAMPLE
	<br><br>
    Y=15 &micro;L, X=20 nM for N=4 samples, C<sub>i</sub>=10000 for the first sample (i=1),
	<br><br>
    <table cellpadding="0" cellspacing="0" border="0">
      <tr align="center">
      <td style="border-bottom:solid; border-bottom-width:medium">0.01 * X (nM) * Y (&micro;L)</td>
      <td rowspan="2" valign="middle"><span style="font-size:32px">&nbsp;/&nbsp;</span></td>
      <td style="border-bottom:solid;border-bottom-width:medium">C<sub>i</sub> (pmol/L)</td>
      </tr>
      <tr align="center">
      <td>N</td>
      <td>10<sup>6</sup></td>
      </tr>
    </table>
      
	is
	<br><br>
	<table cellpadding="0" cellspacing="0" border="0">
      <tr align="center">
      <td style="border-bottom:solid; border-bottom-width:medium">0.01 * 20 (nM) * 15 (&micro;L>)</td>
      <td rowspan="2" valign="middle"><span style="font-size:32px">&nbsp;/&nbsp;</span></td>
      <td style="border-bottom:solid;border-bottom-width:medium">10000 (pmol/L)</td>
      <td rowspan="2" valign="middle"><span style="font-size:22px">&nbsp;=&nbsp;</span></td>
      <td rowspan="2" valign="middle">75</td>
      </tr>
      <tr align="center">
      <td>4</td>
      <td>10<sup>6</sup></td>
      </tr>
     </table>
	 <br><br>
      
     INSERT VALUES HERE
	 <br><br>
	  
     <form action="formula_calculator.php" method="get">
      N:&nbsp;&nbsp;<input type="number" min="1" name="N" id="N" />&nbsp;Samples<br />
      X:&nbsp;&nbsp;<input type="text" name="X" id="X" />&nbsp;nM<br />
      Y:&nbsp;&nbsp;<input type="text" name="Y" id="Y" />&nbsp;&micro;L<br /><br>
      Concentrations(pmol/L) for each sample (separated by commas ","):<br />
      <textarea id="C" name="C" rows="5" cols="70"></textarea><br />
	  <div style="margin-top: 10px !important; text-align:center"><input type="submit" class="button" value="Submit"/></div>
      
	  <br>
	  
      <?php
      $n=$_GET["N"];
	  $x=$_GET["X"];
	  $y=$_GET["Y"];
	  $c=$_GET["C"];
	 	  
	  if($n=="" and $x==""  and $y=="" and $c==""){
			  
		}
	else{
		if($n=="" or $x==""  or $y=="" or $c==""){
			 echo "ERROR: Missing values detected. N,X,Y and Concentrations cannot be empty<br>"; 
		}
		else{
			while(preg_match('/[\r\n\s]+/',$c)){
				$c=preg_replace('/[\r\n\s]+/',',',$c);
			}
			while(preg_match('/[\r\n\s]+/',$c)){
				$c=preg_replace('/[\r\n\s]+/',',',$c);
			}
			while(preg_match('/,,/',$c)){
				$c=preg_replace('/,+/',',',$c);
			}
			$c=preg_replace('/,$/','',$c);
			$c_array=explode(',',$c);
			echo "<b>Input</b><br>";
			echo "N: $n samples<br>";
		    echo "X: $x nM<br>";
		    echo "Y: $y &micro;L<br>";
		    echo "Concentration $c (pmol/L)";
			echo "<br /><br>";
			if(count($c_array)!=$n){
				echo "ERROR: The number of concentration values is not equal to your sample number<br><br><br>";	
			}
			else{
				
				  echo "<b>Result</b>";
				  echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" width=\"450\">";
				  for($i=0;$i<count($c_array);$i++){
					echo "<tr align=\"center\">";
					echo "<td>".($i+1)."</td>";
					echo "<td>".$c_array[$i]."</td>";
					echo "<td>".(0.01*$x*$y*1000000/($n*$c_array[$i]))."</td>";
					echo "</tr>";
					 
				  }
				  echo "</table><br /><br />";
			}
		}
	}
?>
  
    </td>
  </tr>
</table>

</body>
</html>