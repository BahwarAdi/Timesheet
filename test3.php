<?php
require 'vendor/autoload.php';
require 'Config/config.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('L8','Ein');
$sheet->setCellValue('M8','Aus');
$sheet->setCellValue('N8','Ein');
$sheet->setCellValue('O8','Aus');

$sheet->setCellValue('P8','VorMi');
$sheet->setCellValue('Q8','NachMi');
$sheet->setCellValue('R8','Total');
$sheet->setCellValue('S8','MiPause');

$sheet->setCellValue('P9','=+M9-L9');
$sheet->setCellValue('Q9','=+O9-N9');
$sheet->setCellValue('R9','=+Q9+P9');
$sheet->setCellValue('S9','=+N9-M9');
$sql="SELECT ((TIME_TO_SEC(stop) - TIME_TO_SEC(start)))/60 AS minutes FROM zeit WHERE projektId = '2' AND userId = 4";
$query = $mysqli->query($sql);
$res=$query->fetch_assoc();
$result=$res['minutes'];

var_dump($result);

function hoursandmins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

var_dump(hoursandmins($result));
$endresult = hoursandmins($result);
var_dump($endresult);

$sheet->getStyle('A1')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_TIME3);
$sheet->setCellValue('A1',"$endresult");

$hours = floor(259/60);
$minutes = (259 % 60);
echo $hours;
echo $minutes;
$write = new Xlsx($spreadsheet);
$write-> save('baybayWorld.xlsx');
$time=$result;
