<?php 

function db_connect(){
		$result=new mysqli('localhost','root','fhs12345','genomics_core');
		echo $result->connect_error;
		if(!$result){
				
				printf("Connect failed: %s\n", mysqli_connect_error());
				throw new Exception('Could not connect to databaset server.');
		}
		else{		
			return $result;
		}
			
}

function search($q){
	   $mysqli2 = db_connect();
		if ($stmt2 = $mysqli2->prepare($q)) { 
		
			
			#$stmt2->bind_param("s", $biobank_id); 
			$stmt2->execute(); 
		
			$meta2 = $stmt2->result_metadata(); 
			while ($field2 = $meta2->fetch_field()) 
			{ 
				$params2[] = &$row2[$field2->name]; 
			} 
		
			call_user_func_array(array($stmt2, 'bind_result'), $params2); 
		
			while ($stmt2->fetch()) { 
				foreach($row2 as $key => $val) 
				{ 
					$c2[$key] = $val; 
				} 
				$result2[] = $c2; 
			} 
			
			$stmt2->close(); 
		} 
		else{
			echo "ERROR:7<br>";
			
		
		}
		$mysqli2->close(); 
		return @$result2;
	 }
function exitout(){
	/*			echo "<a href=\"index.php\">Home Page.</a>";
				echo "</td></tr></table>";
				require('footer.php');*/
	}
?>