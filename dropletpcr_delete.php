<html>
<head>
    <style>
        body {
            margin-left:18%;
            margin-right:18%;
        }
        table, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
</head>

<body>
<br>

<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Delete Droplet Digital PCR Booking</h6>
<br>


<?php
$id = $_GET['id'];
$database1= $_GET['database1'];
$database2= $_GET['database2'];
?>


<?php

$myquery1 = "delete from $database1 where id='$id'";
$myquery2 = "delete from $database2 where id='$id'";

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res1 = $conn->query($myquery1);
$res2 = $conn->query($myquery2);

if (!$res1 && !$res2) {
    echo "<p>This booking failed to delete, please contact tech support.</p>";
} else {
    echo "<p>This booking has been deleted, please open a new window in browser if you would like to make a new reservation.<br></p>";
}



?>







</body>
</html>
