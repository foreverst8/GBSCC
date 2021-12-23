<?php session_start();?>
<?php
function db_connect(){
    $result=new mysqli('localhost','root','fhs12345','genomics_core');
    echo $result->connect_error;
    if(!$result){

        printf("Connect failed: %s\n", mysqli_connect_error());
        throw new Exception('Could not connect to databaset server.');
    }
    else{
        return $result;
    }

}
function search($q){
    $mysqli2 = db_connect();
    if ($stmt2 = $mysqli2->prepare($q)) {


        #$stmt2->bind_param("s", $biobank_id);
        $stmt2->execute();

        $meta2 = $stmt2->result_metadata();
        while ($field2 = $meta2->fetch_field())
        {
            $params2[] = &$row2[$field2->name];
        }

        call_user_func_array(array($stmt2, 'bind_result'), $params2);

        while ($stmt2->fetch()) {
            foreach($row2 as $key => $val)
            {
                $c2[$key] = $val;
            }
            $result2[] = $c2;
        }

        $stmt2->close();
    }
    else{
        echo "ERROR:7<br>";


    }
    $mysqli2->close();
    return @$result2;
}
?>


<?php
$equipment=$_SESSION["equipment_export"];
$table=$_SESSION["table_export"];

require './PHPExcel.php';

$obj = new PHPExcel();
$writer = new PHPExcel_Writer_Excel2007($obj);

$obj->setActiveSheetIndex(0);
$curSheet = $obj->getActiveSheet();

if ($equipment == "Freeze Drier") {

    $obj->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $obj->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    $obj->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    $obj->getActiveSheet()->getColumnDimension('H')->setWidth(30);
    $obj->getActiveSheet()->getColumnDimension('I')->setWidth(30);
    $obj->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
    $obj->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(15);
    
    
    $curSheet->setCellValue('A1', 'Name');
    $curSheet->setCellValue('B1', 'Lab');
    $curSheet->setCellValue('C1', 'Equipment');
    $curSheet->setCellValue('D1', 'Date');
    $curSheet->setCellValue('E1', 'Time');
    $curSheet->setCellValue('F1', 'Types of solvent');
    $curSheet->setCellValue('G1', 'Remark (instrument status)');
    $curSheet->setCellValue('H1', 'Water drained?');
    $curSheet->setCellValue('I1', 'Glassware cleaned?');

    $j = 2;

    foreach ($table as $key => $value) {

        $curSheet->setCellValue('A' . $j, $value['name']);
        $curSheet->setCellValue('B' . $j, $value['lab']);
        $curSheet->setCellValue('C' . $j, $value['equipment']);
        $curSheet->setCellValue('D' . $j, $value['date']);
        $curSheet->setCellValue('E' . $j, $value['time']);
        $curSheet->setCellValue('F' . $j, $value['solvent']);
        $curSheet->setCellValue('G' . $j, $value['remark']);
        $curSheet->setCellValue('H' . $j, $value['water']);
        $curSheet->setCellValue('I' . $j, $value['glassware']);

        $j++;
    }


} else {

    $obj->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $obj->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $obj->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $obj->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
    $obj->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(15);

    $curSheet->setCellValue('A1', 'Name');
    $curSheet->setCellValue('B1', 'Lab');
    $curSheet->setCellValue('C1', 'Equipment');
    $curSheet->setCellValue('D1', 'Date');
    $curSheet->setCellValue('E1', 'Time');

    $j = 2;

    foreach ($table as $key => $value) {

        $curSheet->setCellValue('A' . $j, $value['name']);
        $curSheet->setCellValue('B' . $j, $value['lab']);
        $curSheet->setCellValue('C' . $j, $value['equipment']);
        $curSheet->setCellValue('D' . $j, $value['date']);
        $curSheet->setCellValue('E' . $j, $value['time']);

        $j++;
    }


}

ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=equipment_usage_log.xlsx");
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>
