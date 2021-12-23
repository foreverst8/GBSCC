<html>
<head>
    <style>
        body {
            margin-left:10%;
            margin-right:10%;
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
<h6>Add Item</h6>
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

echo "<form action=\"Chemical_add_action.php\" method=\"get\">";

echo "<table border=\"2\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"#999999\">";

echo "<tr align=\"center\" style=\"font-size:18px;line-height:50px;\">";
echo "<td><b>Chemical Name</td>";
echo "<td><b>Brand</td>";
echo "<td><b>CAS number</td>";
echo "<td><b>Owner</td>";
echo "<td><b>Quantity</td>";
echo "<td><b>Size</td>";
echo "<td><b>Unit</td>";
echo "<td><b>Storage Location</td>";
echo "<td><b>Remark</td>";
echo "</tr>";


echo "<tr align=\"center\">";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"chemical_name\" size=\"50\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"brand\" size=\"25\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"cas_number\" size=\"25\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"owner\" size=\"25\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"quantity\" size=\"15\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"size\" size=\"15\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"unit\" size=\"15\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"location\" size=\"35\"/>";
echo "</td>";

echo "<td>";
echo "<input type=\"text\" style=\"height:20px\" name=\"remark\" size=\"35\"/>";
echo "</td>";

echo "</tr>";
echo "</table>";

echo "<br><input class=\"button\" type=\"submit\">&nbsp;&nbsp;&nbsp;&nbsp;<input class=\"button\" type=\"reset\">";
echo "</form>";

?>

</body>
</html>
