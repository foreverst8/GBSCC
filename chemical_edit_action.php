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
<h6>Edit Item</h6>
<br>

<?php

$item_id=$_GET['item_id'];
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

$res = $conn->query("UPDATE genomics_core.chemical SET chemical_name = '$chemical_name' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET brand = '$brand' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET cas_number = '$cas_number' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET owner = '$owner' WHERE item_id='$item_id'");

$res = $conn->query("UPDATE genomics_core.chemical SET quantity = '$quantity' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET size = '$size' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET unit = '$unit' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET location = '$location' WHERE item_id='$item_id'");
$res = $conn->query("UPDATE genomics_core.chemical SET remark = '$remark' WHERE item_id='$item_id'");


if (!$res) {
    echo "<p>This item failed to update, please contact tech support.</p>";
} else {
    echo "<p><span style=\"font-size:20px;color:red\">This item has been updated.<br><br></p>";
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
