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
$result_export=search("select * from genomics_core.chemical order by chemical_name");

require './PHPExcel.php';

$obj = new PHPExcel();
$writer = new PHPExcel_Writer_Excel2007($obj);

$obj->setActiveSheetIndex(0);
$curSheet = $obj->getActiveSheet();

$obj->getActiveSheet()->getColumnDimension('A')->setWidth(80);
$obj->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('I')->setWidth(50);
$obj->getActiveSheet()->getDefaultRowDimension()->setRowHeight(30);

$obj->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
$obj->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(16);
$obj->getActiveSheet()->getStyle('B1:Z100')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$obj->getActiveSheet()->getStyle('B1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$curSheet->setCellValue('A1', 'Chemical Name');
$curSheet->setCellValue('B1', 'Brand');
$curSheet->setCellValue('C1', 'CAS number');
$curSheet->setCellValue('D1', 'Owner (UM ID)');
$curSheet->setCellValue('E1', 'Quantity');
$curSheet->setCellValue('F1', 'Size');
$curSheet->setCellValue('G1', 'Unit');
$curSheet->setCellValue('H1', 'Storage Location');
$curSheet->setCellValue('I1', 'Remark');


$j = 2;

foreach($result_export as $key=>$value) {

    $curSheet->setCellValue('A'.$j, $value['chemical_name']);
    $curSheet->setCellValue('B'.$j, $value['brand']);
    $curSheet->setCellValue('C'.$j, $value['cas_number']);
    $curSheet->setCellValue('D'.$j, $value['owner']);
    $curSheet->setCellValue('E'.$j, $value['quantity']);
    $curSheet->setCellValue('F'.$j, $value['size']);
    $curSheet->setCellValue('G'.$j, $value['unit']);
    $curSheet->setCellValue('H'.$j, $value['location']);
    $curSheet->setCellValue('I'.$j, $value['remark']);
    $j++;

}


ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=Chemical_List.xlsx");
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>
