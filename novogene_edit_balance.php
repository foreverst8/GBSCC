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
        div{
            text-align: center;
        }
    </style>
</head>


<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Edit Opening Balance</h6>
<br>

<table>
    <tr>
        <td align="left" valign="top" >
            <?PHP
            $result_user=search("select * from user where user_name='".$_SESSION['username']."'");

            if(count($result_user)==0){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            if(!($result_user[0]["lab"]=="General Office" or $result_user[0]["main"]=="y")){
                #echo $result_user[0]['sangerseq'].$result_user[0]['user_name']."--<br>";
                echo 'You do not have permission to access this page.<br />';
                exit;
            }
            ?>
        </td>
    </tr>
</table>



<?php

$result_year=search("select * from novo_balance");
$result_year_array=array();

for($i=0;$i<count($result_year);$i++){
    $result_year_array[$result_year[$i]['year']]=$result_year[$i]['balance'];
}



echo "<form action=\"novogene_edit_balance_action.php\" method=\"post\">";

echo "<table align=\"center\" border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";
echo "<tr>";
echo "<td align=\"center\" width=\"200px\" height=\"40px\" valign=\"middle\">";
echo "<b>Year</b>";
echo "</td>";
echo "<td align=\"center\" width=\"200px\" height=\"40px\" valign=\"middle\">";
echo "<b>Opening Balance (USD)</b>";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2019";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2019'] . "\" name=\"balance_2019\" id=\"balance_2019\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2020";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2020'] . "\" name=\"balance_2020\" id=\"balance_2020\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2021";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2021'] . "\" name=\"balance_2021\" id=\"balance_2021\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2022";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2022'] . "\" name=\"balance_2022\" id=\"balance_2022\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2023";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2023'] . "\" name=\"balance_2023\" id=\"balance_2023\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2024";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2024'] . "\" name=\"balance_2024\" id=\"balance_2024\">";
echo "</td>";
echo "</tr>";

echo "<tr align=\"center\" height=\"40px\">";
echo "<td>";
echo "2025";
echo "</td>";
echo "<td>";
echo "<input type=\"text\" size=\"28\" value=\"" . $result_year_array['2025'] . "\" name=\"balance_2025\" id=\"balance_2025\">";
echo "</td>";
echo "</tr>";
echo "</table><br><br>";

echo "<div>";
echo "<input align=\"center\" type=\"submit\" class=\"button\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" class=\"button\">";
echo "</div>";

echo "</form>";

?>
</body>
</html>
