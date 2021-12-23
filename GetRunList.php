<?php session_start();require('db_cancer.php')?>
<?PHP 
	  $result_user=search("select * from user where user_name='".$_SESSION['username']."' and hiseq='y'");
	  
	  if(count($result_user)==0){
		  #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
		  echo 'You do not have permission to access this page.<br />';			
		  exit;
	  }
?> 

<?php

$year=$_GET["year"];
$conn=db_connect();


$query="";
if($result_user[0]['main']=="y"){
	$query="select distinct(Run) from genomics_core.hiseq_sample where Run like '%".$year."%' ORDER BY Run DESC";
}
else{
	$query=" select distinct(Run) from genomics_core.hiseq_sample where Run like '%".$year."%' and Submitter_Name='".$_SESSION['username']."' ORDER BY Run DESC";
}


$result_search=search($query);

if(count($result_search)==0){
	$query="";
	if($result_user[0]['main']=="y"){
		$query="select distinct(Run) from genomics_core.hiseq_sample ORDER BY Run DESC";
	}
	else{
		$query=" select distinct(Run) from genomics_core.hiseq_sample where Submitter_Name='".$_SESSION['username']."' ORDER BY Run DESC";
	}
	$result_search=search($query);
}


echo "<form action=\"hiseq_search_result.php\" method=\"get\">";
if($year=="-" or $year=="Seq_later"){
	echo "<input name=\"run\" type=\"hidden\" value=\"$year\">";
}
else{
	echo "Run: <select name=\"run\">";
	for($i=0;$i<count($result_search);$i++){
		if($result_search[$i]['Run']=="-" or $result_search[$i]['Run']=="Seq_later"){
			continue;	
		}
		else{
			echo "<option value=\"".$result_search[$i]['Run']."\" ";
			$run="";
			if($run==$result_search[$i]['Run']){
				echo "selected=\"selected\"";	
			}
			echo ">".$result_search[$i]['Run']."</option>";
		}
		
	}
	echo "</select>";
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"submit\" value=\"Select\" >";
echo "</form>";

?>