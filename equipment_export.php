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
$result_export=search("select * from genomics_core.equipment");
require './PHPExcel.php';

$obj = new PHPExcel();
$writer = new PHPExcel_Writer_Excel2007($obj);

$sheet = new PHPExcel_Worksheet($obj, 'new sheet');
$obj->addSheet($sheet);

$obj->setActiveSheetIndex(0);
$curSheet = $obj->getActiveSheet();

$obj->getActiveSheet()->getColumnDimension('A')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$obj->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('J')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$obj->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('O')->setWidth(30);
$obj->getActiveSheet()->getDefaultRowDimension()->setRowHeight(150);

$obj->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
$obj->getActiveSheet()->getStyle('A1:O1')->getFont()->setSize(16);
$obj->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$obj->getActiveSheet()->getStyle('A1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$obj->getActiveSheet()->freezePane('A2');

$curSheet->setCellValue('A1', 'Photo');
$curSheet->setCellValue('B1', 'Name');
$curSheet->setCellValue('C1', 'Brand');
$curSheet->setCellValue('D1', 'Model no. + part / cat. numbers or Detail Specification Requirement');
$curSheet->setCellValue('E1', 'Current Location');
$curSheet->setCellValue('F1', 'Serial Number');
$curSheet->setCellValue('G1', 'Qty.');
$curSheet->setCellValue('H1', 'Current Warranty Period');
$curSheet->setCellValue('I1', 'UM Asset Number');
$curSheet->setCellValue('J1', 'Remark.');
$curSheet->setCellValue('K1', 'Item no.');
$curSheet->setCellValue('L1', 'PR no. / PIDDA');
$curSheet->setCellValue('M1', 'Extended Warranty Period');
$curSheet->setCellValue('N1', 'PM Service checking date');
$curSheet->setCellValue('O1', 'Blue Stickers (2016-2017)');


$j = 2;

foreach($result_export as $key=>$value) {
	
	if(!empty($value['photo'])) {
		$image = $value['photo'];
		if(@fopen($image , 'r' )) {
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setPath($image);
			$objDrawing->setHeight(150);
			$objDrawing->setWidth(150);
			$objDrawing->setCoordinates('A'.$j);
			$objDrawing->setWorksheet($obj->getActiveSheet());
		}
	}
	
    $curSheet->setCellValue('B'.$j, $value['application']);
    $curSheet->setCellValue('C'.$j, $value['brand']);
    $curSheet->setCellValue('D'.$j, $value['model']);
    $curSheet->setCellValue('E'.$j, $value['location']);
    $curSheet->setCellValue('F'.$j, $value['serial_number']);
    $curSheet->setCellValue('G'.$j, $value['qty']);
    $curSheet->setCellValue('H'.$j, $value['current_warranty']);
    $curSheet->setCellValue('I'.$j, $value['UM_asset']);
    $curSheet->setCellValue('J'.$j, $value['remark']);
    $curSheet->setCellValue('K'.$j, $value['item_no']);
    $curSheet->setCellValue('L'.$j, $value['pr_no']);
    $curSheet->setCellValue('M'.$j, $value['extended_warranty']);
    $curSheet->setCellValue('N'.$j, $value['pm_service']);
    $curSheet->setCellValue('O'.$j, $value['blue_sticker']);
    $j++;
}

ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=Equipment_List.xlsx");
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>