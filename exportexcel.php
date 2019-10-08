<?php
require_once 'vendors/autoload.php';
require_once 'Config/config.php';
function arbeitszeit($startzeit, $endzeit, $pause)
{
    global $tot_time;

    $start_time = explode(":", $startzeit);
    $end_time = explode(":", $endzeit);
    $break = explode(":", $pause);

    $start_time_stamp = mktime($start_time[0], $start_time[1]);
    $end_time_stamp = mktime($end_time[0], $end_time[1]);
    $break_stamp = $break[0] + ($break[1] / 60);

    $time_difference = ($end_time_stamp - $start_time_stamp) / 3600;
    $tot_time = $time_difference - ($break_stamp);
    //echo($tot_time);
}
function soll($soll)
{
    global $d;
    $start_time = explode(":", $soll);
    $d = ($start_time[1]+$start_time[0]) / 5;

}
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/// ----- Info ----- ///
echo('Test des Exports für die Monatskarte');

/// ----- Variablen ----- ///
$username = 'Simon';
$monat = '09';
$jahr = 2019;
$soll = 0;
$ist = 0;
$rows = array();
$data = array();

$monate = array(
    1 => "Januar",
    2 => "Februar",
    3 => "M&auml;rz",
    4 => "April",
    5 => "Mai",
    6 => "Juni",
    7 => "Juli",
    8 => "August",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Dezember");


$comm1= ('SELECT user.vorname,user.nachname, zeit.datum, zeit.start, zeit.stop, zeit.pause, user.soll FROM zeit 
            LEFT JOIN user ON zeit.userId = user.userId WHERE user.vorname LIKE "'.$username.'"AND datum LIKE "%-' . $monat . '-%" ORDER BY zeit.datum');

$comm = ('SELECT * FROM zeit
             LEFT JOIN user ON zeit.userId = user.userId
             LEFT JOIN projekt ON zeit.projektId = projekt.projektId
             WHERE user.vorname = "'.$username.'" AND datum LIKE "%-' . $monat . '-%" ORDER BY datum');

$query = $mysqli->query($comm);
$res = $query->fetch_assoc();
$name = ($res['vorname'].' '.$res['nachname']);
$mail = $res['email'];

/// ----- Abfrage ----- ///
$query1 = $mysqli->query($comm1);
while ($res = $query1->fetch_assoc()){
    $rows[] = $res;
}

foreach ($rows as $data) {
    arbeitszeit($data['start'], $data['stop'], $data['pause']);
    soll($data['soll']);
    $soll += $d;
    $ist += $tot_time;

}

$spreadsheet = new Spreadsheet();
$worksheet = $spreadsheet->getActiveSheet();
$spreadsheet->getDefaultStyle()->getFont()->setName('YU Gothic')->setSize(10);


//set style for A1,B1,C1 cells
$cell_st =[
    'font' =>['bold' => true],
    'font' =>['size' => 48 ],
    'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
    'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
];

$spreadsheet->getActiveSheet()->getStyle('B2')->applyFromArray($cell_st);


//add some data in excel cells
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('CB', 'Stundenübersicht')
->setCellValue('B7', $monate[9].' '.$jahr)
->setCellValue('B9', $name)
->setCellValue('B11', $mail);


$worksheet->fromArray(
    [
        ['', 'Stunden'],
        ['Soll', 12],
        ['Ist', 56],
    ]
);

// ort der ersten reie
$dataSeriesLabels = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'B14', null, 1),
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'C14', null, 1),
];

// reie der ersten spalte
$xAxisTickValues = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'B15:B16', null, 4),
];
// reie der 2ten und weiteren spalte spalte spalte
$dataSeriesValues = [
    new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'C15:C16', null, 4),
];

$series = new DataSeries(
    DataSeries::TYPE_BARCHART, // plotType
    DataSeries::GROUPING_STACKED, // plotGrouping
    range(0, count($dataSeriesValues) - 1), // plotOrder
    $dataSeriesLabels, // plotLabel
    $xAxisTickValues, // plotCategory
    $dataSeriesValues        // plotValues
);
// Richtung der Balken
$series->setPlotDirection(DataSeries::DIRECTION_COL);

$plotArea = new PlotArea(null, [$series]);
// position legende
$legend = new Legend(Legend::POSITION_TOPRIGHT, null, false);

$title = new Title('Stundenvergleich');
$chart = new Chart(
    'SollIstVergleich', // name
    $title, // title
    $legend, // legend
    $plotArea, // plotArea
    true, // plotVisibleOnly
    0, // displayBlanksAs
    null, // xAxisLabel
    $yAxisLabel  // yAxisLabel
);

// position des charts
$chart->setTopLeftPosition('E7');
$chart->setBottomRightPosition('L20');

// Add the chart to the worksheet
$worksheet->addChart($chart);
// Save Excel 2007 file
$filename = 'TestV1.Xlsx';
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->setIncludeCharts(true);
$callStartTime = microtime(true);
$writer->save($filename);

