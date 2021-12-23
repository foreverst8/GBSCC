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
<h6>Add Item</h6>
<br><br>


<?php

$result_tmp=search("select max(item_id) from genomics_core.chemical");

if($result_tmp[0]['max(item_id)']==""){
    $result_tmp[0]['max(item_id)']=0;
}

$chemical_name=$_GET['chemical_name'];
$brand=$_GET['brand'];
$cas_number=$_GET['cas_number'];
$owner=$_GET['owner'];
$quantity=$_GET['quantity'];
$size=$_GET['size'];
$unit=$_GET['unit'];
$location=$_GET['location'];
$remark=$_GET['remark'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");

$value = "'" . ($result_tmp[0]['max(item_id)'] + 1) . "','$chemical_name','$brand','$cas_number','$owner','$quantity','$size','$unit','$location','$remark'";
$name = "item_id,chemical_name,brand,cas_number,owner,quantity,size,unit,location,remark";
$res = $conn->query("INSERT INTO genomics_core.chemical ($name) VALUES (" . $value . ")");

if (!$res) {
    echo "<p>Item failed to add, please contact tech support.</p>";
} else {
    echo "<p><span style=\"font-size:20px;color:red\">The new item has been added.<br><br></p>";
    echo "<p>Chemical Name: $chemical_name<br><br></p>";
    echo "<p>Brand: $brand<br><br></p>";
    echo "<p>CAS number: $cas_number<br><br></p>";
    echo "<p>Owner (UM ID): $owner<br><br></p>";
    echo "<p>Quantity: $quantity<br><br></p>";
    echo "<p>Size: $size<br><br></p>";
    echo "<p>Unit: $unit<br><br></p>";
    echo "<p>Location: $location<br><br></p>";
    echo "<p>Remark: $remark<br><br></p>";

}



?>






</body>
</html>
