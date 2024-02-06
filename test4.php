<?php

//сравнение товаров по артикулу


//Подлключение ядра друпал
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);



echo '<div style="margin-bottom: 50px;">';
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: green;"> Товары из БД </h2>';

  
$articul = db_query("
SELECT field_articul_value
FROM field_data_field_articul
", array(':type' => 'products'))->fetchAll();

echo '<table border="1px">';
foreach ($articul as $key => $value) {
 $site_art[]=$value->field_articul_value;
 /* print "<tr><td>". $site_nodes. "</td></tr>"; */
 echo'<tr>';
 echo '<td>';
/*  var_dump($site_art); */
 echo '</td>';
echo'</tr>';
}




echo '</table>';
  


//подключение PHPExcell
require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';
$phpexcel = new PHPExcel();
$page = $phpexcel->setActiveSheetIndex(0);

$excel = PHPExcel_IOFactory::load('upload/bb.xls');

foreach ($excel->getWorksheetIterator() as $worksheet) {
  $lists[] = $worksheet->toArray();
}

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

var_dump($list);

// ТОВАРЫ ИЗ ФАЙЛА -------------
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: red;"> Товары из файла XLS </h2>';
foreach ($lists as $list) {
  echo '<table border="1px">';
  // Перебор строк
  foreach ($list as $row) {
    echo '<tr>';
    // Перебор столбцов
  /*   echo '<td>' . $row[0] . '</td>'; */
    if(in_array($row[1], $site_art)){
      print "<td>товар с артикулом существует ".$row[1]."</td>";
    }else{
      print "<td>Создать товар с артикулом ".$row[1]."</td>";
      $site_newart[]=$row;
    }
    echo "</tr>";
  }
  echo '</table>';
}

print_r($site_newart);

foreach($site_newart as $n){
  //создаем ноды
 /*  echo $n[0]; */ // выводит записи
 /*  $noden = new stdClass();
  $noden->type = 'products';
  node_object_prepare($node);
  $noden->title=$n[0];
  $noden->field_articul['und'][1]['value']=$n[1];
  $noden->language = LANGUAGE_NONE;
  node_save($noden); */
}



//ToDo
// 1. создание материалов типа товар
// 2. привязываемся к артикулу, а не к тайтлу
// 3. загрузка изображений,
// 4. удаление отсутствующих материалов

$nob = get_object_vars($nodes);


$ob = array_merge($list, $nodes);


echo '<pre>';
  var_dump($ob);
echo '</pre>';





?>