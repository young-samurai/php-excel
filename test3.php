<?php

//Подлключение ядра друпал
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);



echo '<div style="margin-bottom: 50px;">';
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: green;"> Товары из БД </h2>';

  
    $result = db_query("
        SELECT title
        FROM field_data_field_articul, {node}, field_data_field_image
        WHERE type = :type
        ", array(':type' => 'products'))->fetchAll();

     /*    echo '<table border="1px">';   */
        foreach ($result as $key => $value) {
        $site_nodes[]=$value->title;
        echo'<tr>';
        echo '<td>';
        echo $site_nodes;
        echo '</td>';
        echo'</tr>';
        }
       /*  foreach ($result as $key => $value1) {
          $site_nodes1[]=$value1->field_data_field_image;
          echo'<tr>';
          echo '<td>';
          echo $site_nodes1;
          echo '</td>';
          echo'</tr>';
          } */

   /*  echo '</table>'; */
  


//подключение PHPExcell
require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';
$phpexcel = new PHPExcel();
$page = $phpexcel->setActiveSheetIndex(0);

$excel = PHPExcel_IOFactory::load('upload/bb.xls');

foreach ($excel->getWorksheetIterator() as $worksheet) {
  $lists[] = $worksheet->toArray();
}

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
    if(in_array($row[0], $site_nodes)){
      print "<td>такой товар есть ".$row[0]."</td>";
    }else{
      print "<td>Нужно создать товар ".$row[0]."</td>";
      $site_newnodes[]=$row[0];
    }
    echo "</tr>";
  }
  echo '</table>';
}

echo($site_newnodes);

foreach($site_newnodes as $n){
  //создаем ноды
  /* echo $n; */ // выводит записи
 /*  $noden = new stdClass();
  $noden->type = 'products';
  node_object_prepare($node);
  $noden->field_articul_value = $n;
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