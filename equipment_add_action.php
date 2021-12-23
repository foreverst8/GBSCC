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
<h6>Add Equipment</h6>
<br><br>


<?php

$result_tmp=search("select max(equipment_id) from genomics_core.equipment");

if($result_tmp[0]['max(equipment_id)']==""){
    $result_tmp[0]['max(equipment_id)']=0;
}
$photo_id=$result_tmp[0]['max(equipment_id)']+1;

$application=$_POST['application'];
$brand=$_POST['brand'];
$model=$_POST['model'];
$location=$_POST['location'];
$serial_number=$_POST['serial_number'];
$qty=$_POST['qty'];
$current_warranty=$_POST['current_warranty'];
$UM_asset=$_POST['UM_asset'];
$remark=$_POST['remark'];

$item_no=$_POST['item_no'];
$pr_no=$_POST['pr_no'];
$extended_warranty=$_POST['extended_warranty'];
$pm_service=$_POST['pm_service'];
$blue_sticker=$_POST['blue_sticker'];


$photo = $_POST['photo'];

$tmpFilePath = $_FILES["photo"]["tmp_name"];
if ($tmpFilePath != ""){
    $photo = "files/equipment/" . $photo_id . ".png";
    if(move_uploaded_file($tmpFilePath, $photo)) {
    } else {
        echo "<p><br>Image upload failed. Please contact Genomics Core support.<br><br></p>";
        exit;
    }
}




$conn = db_connect();
mysqli_query($conn, "SET NAMES UTF8");

$value = "'" . ($result_tmp[0]['max(equipment_id)'] + 1) . "','$item_no','$photo','$application','$brand','$model','$location','$serial_number','$qty','$pr_no','$current_warranty','$extended_warranty','$pm_service','$UM_asset','$blue_sticker','$remark'";
$name = "equipment_id,item_no,photo,application,brand,model,location,serial_number,qty,pr_no,current_warranty,extended_warranty,pm_service,UM_asset,blue_sticker,remark";
$res = $conn->query("INSERT INTO genomics_core.equipment ($name) VALUES (" . $value . ")");

if (!$res) {
    echo "<p>New equipment failed to add, please contact tech support.</p>";
} else {
    echo "<p><span style=\"font-size:20px;color:red\">The new equipment has been added.<br><br></p>";
    echo "<p>Equipment Name: $application<br><br></p>";
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