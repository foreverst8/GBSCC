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
<h6>Delete Item</h6>
<br>


<?php
$id = $_GET['id'];
$database= $_GET['database'];
?>


<?php

$myquery = "delete from $database where item_id='$id'";

$conn = db_connect();
mysqli_query($conn, "SET NAMES GB2312");
$res = $conn->query($myquery);

if (!$res) {
    echo "<p>This item failed to delete, please contact tech support.</p>";
} else {
    echo "<p>This item has been deleted.<br></p>";
}



?>







</body>
</html>
