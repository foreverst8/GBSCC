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
            margin-top: 2px;
            margin-bottom: 2px;
        }
        ol{
            list-style:none;
        }
    </style>
</head>

<body>
<br>

<?php session_start();
require('login.php');?>
<hr>
<br>
<h6>ADMINISTRATION</h6>
<br><br>
<table align="center">
  <tr>
    <td align="left" valign="top">
    <?php
	  	$permission=$result_user[0]['sangerseq'];
		$result_user=search("select * from user where user_name='".$_SESSION['username']."' and main='y'");
		#echo "select * from user where user_name='".$_SESSION['username']."' and (main='y' or lab_admi='y')<br>";
		if(count($result_user)==0){
			
			echo '<p>You are not an Administrator so you do not have permission to view this page.<br /></p>';			
			exit;
		}
   	?>
       
	<table class="mytable" border="1" cellspacing="0" bordercolor="#999999">
		<tr align="center" height="40"><th><b>MAIN</b></th><th><b>SANGER</b></th><th><b>HISEQ</b></th><th><b>NOVOGENE</b></th></tr>

        <tr valign="top" align="center">
            <td width="250" height="200">
			<ul style="list-style-type:none">
			<?php
			if($result_user[0]['main']=='y'){
                echo "<br>";
			    echo "<li><a style=\"line-height:30px\" href=\"add_new_user.php\">Add new user</a></li>";
			    echo "<li><a style=\"line-height:30px\" href=\"edit_user.php\">Edit user</a></li>";
			    echo "<li><a style=\"line-height:30px\" href=\"add_new_lab.php\">Add new lab</a></li>";
			    echo "<li><a style=\"line-height:30px\" href=\"edit_lab.php\">Edit lab</a></li>";
			    echo "<li><a style=\"line-height:30px\" href=\"GenerateSeasonReport.php\">Season report</a></li>";
                //echo "<br>";
		   }
		   ?>
		   </ul>
		   </td>

		   <td width="250">
		   <ul style="list-style-type:none">
		   <?php
		   if($result_user[0]['main']=='y'){
               echo "<br>";
		       echo "<li><a style=\"line-height:30px\" href=\"upload_res_select_run.php\">Upload result</a></li>";
			   echo "<li><a style=\"line-height:30px\" href=\"delete_result.php\">Delete result</a></li>";
			   echo "<li><a style=\"line-height:30px\" href=\"export_txt_file.php\">Export .txt file</a></li>";
		   }
		   ?>
		   </ul>
		   </td>

		   <td width="250">
		   <ul style="list-style-type:none">
		   <?php
		   if($result_user[0]['main']=='y'){
               echo "<br>";
		       echo "<li><a style=\"line-height:30px\" href=\"Start_new_Hiseq_Run.php\">Start new run</a></li>";
			   echo "<li><a style=\"line-height:30px\" href=\"export_hiseq_index.php\">Export Hiseq index</a></li>";
		   }
		   ?>
		   </ul>
		   </td>
		   
		   <td width="250" height="200">
                <ul style="list-style-type:none">
                    <?php
                    if($result_user[0]['main']=='y'){
                        echo "<br>";
                        echo "<li><a style=\"line-height:30px\" href=\"novogene_report.php\">Annual report</a></li>";
                        //echo "<li><a style=\"line-height:30px\" href=\"novogene_statement.php\">Service statement</a></li>";
                    }
                    ?>
                </ul>
            </td>
        </tr>

        <tr align="center" height="40"><th><b>REAGENT</b></th><th><b>CHEMICAL</b></th></th><th><b>EQUIPMENT</b></th><th><b>GITHUB</b></th></tr>

        <tr valign="top" align="center">
            <td width="250" height="200">
                <ul style="list-style-type:none">
                    <?php
                    if($result_user[0]['main']=='y'){
                        echo "<br>";
                        echo "<li><a style=\"line-height:30px\" href=\"stock_edit.php\">Edit reagent stock</a></li>";
                        echo "<li><a style=\"line-height:30px\" href=\"reagent_search_result.php\">Manage reagent request</a></li>";
                    }
                    ?>
                </ul>
            </td>

            <td width="200">
                <ul style="list-style-type:none">
                    <?php
                    if($result_user[0]['main']=='y'){
                        echo "<br>";
                        echo "<li><a href=\"chemical.php\">Edit chemical list</a></li>";
                    }
                    ?>
                </ul>
            </td>
            
            <td width="200">
                <ul style="list-style-type:none">
                    <?php
                    if($result_user[0]['main']=='y'){
                        echo "<br>";
                        echo "<li><a href=\"equipment.php\">Edit equipment list</a></li>";
                        echo "<br>";
                        echo "<li><a href=\"usage.php\">Equipment usage log</a></li>";
                    }
                    ?>
                </ul>
            </td>
            
            <td width="200">
                <ul style="list-style-type:none">
                    <?php
                    if($result_user[0]['main']=='y'){
                        echo "<br>";
                        echo "Username: Genomics-Core";
                        echo "<br><br>";
                        echo "Password: genomics123core";
                    }
                    ?>
                </ul>
            </td>
            
            
		</tr>

	</table>
   
    </td>
  </tr>
</table>

</body>
</html>