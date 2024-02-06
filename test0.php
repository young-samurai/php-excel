<?php

//подключение библиотеки 
require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';
//подключение документа
$excel = PHPExcel_IOFactory::load('upload/bb.xls');






$excel->setActiveSheetIndex(0); //получает данные из данного листа
$sheet = $excel->getActiveSheet();






/* $sheet->setCellValue("A10", "Значение"); */ // запись в ячейку А10
/* $sheet->setCellValue("B11", "Ответ"); */	// запись в ячейку В11






Foreach($excel ->getWorksheetIterator() as $worksheet) {
	$lists[] = $worksheet->toArray();
}

//вывод значения ячейки В2
$output =  $excel->getActiveSheet()->getCell('B2')->getValue();
print $output;






//вывод значений с шагом 5 из таблицы В 
/* $step = 5;
$column = 1;
do {
    $value = $excel->getActiveSheet()->getCell('B' . $column)->getValue();
    echo $value;
    $column += $step;
} while ($value); */
// ---------------------------------------------------------------------------------






// вывод всех значений
foreach($lists as $list){
	echo '<table border="1">';
	// Перебор строк
	foreach($list as $row){
	  echo '<tr>';
	  // Перебор столбцов
	  foreach($row as $col){
		echo '<td>';
			echo $col;
		echo '</td>';
	}
	echo '</tr>';
	}
	echo '</table>';
}
   

//---------------------------------------
?> 


