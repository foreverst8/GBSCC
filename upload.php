<?php
header("Content-Type:text/html;charset=UTF-8");
$run=$_POST['run'];

if (!file_exists('../genomics_core/res/sanger/$run')){ mkdir ("../genomics_core/res/sanger/$run");} 


if(is_uploaded_file($_FILES['file']['tmp_name'])){
    move_uploaded_file($_FILES['file']['tmp_name'], "../genomics_core/res/sanger/$run/".iconv("UTF-8", "GBK", $_FILES['file']['name']));

}

?>