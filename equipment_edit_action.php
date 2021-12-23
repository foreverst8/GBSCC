<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<h6>Edit Equipment</h6>
<br>

<?php

$equipment_id=$_GET['equipment_id'];

$application=$_GET['application'];
$brand=$_GET['brand'];
$model=$_GET['model'];
$location=$_GET['location'];
$serial_number=$_GET['serial_number'];
$qty=$_GET['qty'];
$current_warranty=$_GET['current_warranty'];
$UM_asset=$_GET['UM_asset'];
$remark=$_GET['remark'];

$item_no=$_GET['item_no'];
$pr_no=$_GET['pr_no'];
$extended_warranty=$_GET['extended_warranty'];
$pm_service=$_GET['pm_service'];
$blue_sticker=$_GET['blue_sticker'];

$conn = db_connect();
mysqli_query($conn, "SET NAMES UTF8");

$res = $conn->query("UPDATE genomics_core.equipment SET application = '$application' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET brand = '$brand' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET model = '$model' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET location = '$location' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET serial_number = '$serial_number' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET qty = '$qty' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET current_warranty = '$current_warranty' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET UM_asset = '$UM_asset' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET remark = '$remark' WHERE equipment_id='$equipment_id'");


$res = $conn->query("UPDATE genomics_core.equipment SET item_no = '$item_no' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET pr_no = '$pr_no' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET extended_warranty = '$extended_warranty' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET pm_service = '$pm_service' WHERE equipment_id='$equipment_id'");
$res = $conn->query("UPDATE genomics_core.equipment SET blue_sticker = '$blue_sticker' WHERE equipment_id='$equipment_id'");



if (!$res) {
    echo "<p>This equipment failed to update, please contact tech support.</p>";
} else {
    echo "<p><span style=\"font-size:20px;color:red\">The new equipment has been added.<br><br></p>";
    echo "<p>Application: $application<br><br></p>";
    echo "<p>Brand: $brand<br><br></p>";
    echo "<p>Model no.: $model<br><br></p>";
    echo "<p>Current Location: $location<br><br></p>";
    echo "<p>Serial Number: $serial_number<br><br></p>";
    echo "<p>Qty.: $qty<br><br></p>";
    echo "<p>Current Warranty Period: $current_warranty<br><br></p>";
    echo "<p>UM Asset Number: $UM_asset<br><br></p>";
    echo "<p>Remark: $remark<br><br></p>";
    echo "<p>Item no.: $item_no<br><br></p>";
    echo "<p>PR no./PIDDA: $pr_no<br><br></p>";
    echo "<p>Extended Warranty Period: $extended_warranty<br><br></p>";
    echo "<p>PM Service checking date: $pm_service<br><br></p>";
    echo "<p>Blue Stickers 2016-2017: $blue_sticker<br><br></p>";
}





?>








</body>
</html>
