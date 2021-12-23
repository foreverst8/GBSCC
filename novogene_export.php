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
$time=$_SESSION["year_export"];
$result_export=search("select * from novo_hiseq where Approval='Confirmed' and year(date)=$time order by run");

require './PHPExcel.php';

$obj = new PHPExcel();
$writer = new PHPExcel_Writer_Excel2007($obj);

$obj->setActiveSheetIndex(0);
$curSheet = $obj->getActiveSheet();

$obj->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$obj->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$obj->getActiveSheet()->getColumnDimension('E')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('F')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('G')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('H')->setWidth(50);
$obj->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$obj->getActiveSheet()->getColumnDimension('J')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('N')->setWidth(30);
$obj->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$obj->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$obj->getActiveSheet()->getRowDimension('1')->setRowHeight(60);

$obj->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
$obj->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$obj->getActiveSheet()->getStyle('B1:Z100')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$obj->getActiveSheet()->getStyle('B1:Z100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$obj->getActiveSheet()->getStyle('B1:H1')->getAlignment()->setWrapText(true);

$curSheet->setCellValue('A1', 'Request ID');
$curSheet->setCellValue('B1', "Sequencing (Novaseq)\rUnit:G\rUnit Price (USD):7.00\rUnit Price (MOP):56.70");
$curSheet->setCellValue('C1', "Library QC (for user-prepared library)\rUnit:library\rUnit Price (USD):10.00\rUnit Price (MOP):81.00");
$curSheet->setCellValue('D1', "RNA Extraction (from TRIzol sample)\rUnit:sample\rUnit Price (USD):15.00\rUnit Price (MOP):121.50");
$curSheet->setCellValue('E1', "RNA-Seq 6G Raw Data (includes library preparation)\rUnit:sample\rUnit Price (USD):110.00\rUnit Price (MOP):891.00");
$curSheet->setCellValue('F1', "RNA-Seq 12G Raw Data (includes library preparation)\rUnit:sample\rUnit Price (USD):170.00\rUnit Price (MOP):1377.00");
$curSheet->setCellValue('G1', "ChIP-Seq 6G Raw Data (includes library preparation)\rUnit:sample\rUnit Price (USD):160.00\rUnit Price (MOP):1296.00");
$curSheet->setCellValue('H1', "ChIP-Seq 12G Raw Data (includes library preparation)\rUnit:sample\rUnit Price (USD):220.00\rUnit Price (MOP):1782.00");
$curSheet->setCellValue('I1', 'Other Service');
$curSheet->setCellValue('J1', 'Total Price of Other Service (USD)');
$curSheet->setCellValue('K1', 'Grand Total (USD)');
$curSheet->setCellValue('L1', 'Grand Total (MOP)');
$curSheet->setCellValue('M1', 'Submitter');
$curSheet->setCellValue('N1', 'Email');
$curSheet->setCellValue('O1', 'Lab');
$curSheet->setCellValue('P1', 'Date');

$j = 2;

foreach($result_export as $key=>$value) {

    $curSheet->setCellValue('A'.$j, $value['run']);
    $curSheet->setCellValue('B'.$j, $value['sequencing']);
    $curSheet->setCellValue('C'.$j, $value['library_QC']);
    $curSheet->setCellValue('D'.$j, $value['RNA_extraction']);
    $curSheet->setCellValue('E'.$j, $value['RNA6G']);
    $curSheet->setCellValue('F'.$j, $value['RNA12G']);
    $curSheet->setCellValue('G'.$j, $value['ChIP6G']);
    $curSheet->setCellValue('H'.$j, $value['ChIP12G']);
    $curSheet->setCellValue('I'.$j, $value['othername']);
    $curSheet->setCellValue('J'.$j, $value['otherusd']);
    $curSheet->setCellValue('K'.$j, $value['total_cost_usd']);
    $curSheet->setCellValue('L'.$j, $value['total_cost']);
    $curSheet->setCellValue('M'.$j, $value['Submitter_Name']);
    $curSheet->setCellValue('N'.$j, $value['email']);
    $curSheet->setCellValue('O'.$j, $value['lab']);
    $curSheet->setCellValue('P'.$j, $value['date']);

    $j++;
}


ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=Novogene_annual_report_$time.xlsx");
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>