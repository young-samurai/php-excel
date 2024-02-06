<?php

//Подлключение ядра друпал
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);







// ТОВАРЫ ИЗ БД ---------------------------------
/* echo '<div style="margin-bottom: 50px;">';
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: green;"> Товары из БД </h2>';
$nodes = db_query("
  SELECT title
  FROM {node}
  WHERE type = :type
  ", array(':type' => 'products'))->fetchAll();

echo '<table border="1px">';
foreach ($nodes as $nodes => $items) {
  echo "<tr>";
  echo "<td>$items->title</td>";
  echo "</br>";
  echo "</br>";
  print_r($items);

  echo "</tr>";
}
echo '</table>';
echo '</div>'; */


echo '<div style="margin-bottom: 50px;">';
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: green;"> Товары из БД </h2>';

$nodes = db_query("
  SELECT title
  FROM {node}
  WHERE type = :type
  ", array(':type' => 'products'))->fetchAll();

  echo '<table border="1px">';
  foreach ($nodes as $key => $value) {
   $site_nodes[]=$value->title;
   /* print "<tr><td>". $site_nodes. "</td></tr>"; */
   echo'<tr>';
   echo '<td>';
   echo $site_nodes;
   echo '</td>';
  echo'</tr>';
  }
echo '</table>';
echo '</div>';


/* echo '<div style="margin-bottom: 50px;">';
echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: green;"> Сравнение </h2>';
echo '<table style="background: green" border="1px">';
foreach ($row[0] as $value1) {
   if(!in_array($value1, $value)){
    $not_mat[] = $value1 ;
   }
}
foreach ($items as $value2) {
   if(!in_array($value2, $row[0])){
    $not_mat[] = $value2;
   }
}
echo '<tr>';
  echo '<td>';
    print_r($not_mat);
  echo '</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
 */





/* print_r($not_m); */



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
    if(in_array($row[0],$site_nodes)){
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
  $noden = new stdClass();
  $noden->type = 'products';
  node_object_prepare($node);
  $noden->title = $n;
  $noden->language = LANGUAGE_NONE;
  node_save($noden);
}



//ToDo
// 1. создание материалов типа товар
// 2. привязываемся к артикулу, а не к тайтлу
// 3. загрузка изображений,
// 4. удаление отсутствующих материалов


/* ТЕСТ ПЕРЕБОР ИЗ ФАЙЛА  */

/* echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: blue;"> Сравнение товаров XLS с БД </h2>';
echo '<p style="color: green; font-size: 12px;">выводит товары которые не найдены в таблице товаров бд</p>';

  echo '<table border="1">';
  // Перебор строк
  foreach ($list as $row) {
    echo '<tr>';
    // Перебор столбцов
    echo '<td>';
    if ($row[0] != $title) {
      echo "<td>" . $row[0] . "</td>";
    } else {
      echo "<td>" . $value . "</td>";
    }
    echo '</td>';
    echo '</tr>';
  }
  echo '</table>';

echo '</div>';
 */


/* Запись товаров из XLS и БД */

/* echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: #FFB90F;"> Запись товаров из XLS и БД </h2>';
echo '<table border="1">';
// Перебор строк
foreach ($list as $row) {
  echo '<tr>';
  // Перебор столбцов
    if ($row[0] !== $arrr) {
    echo "<td>" . $row[0] . "</td>";
  } else {

  } 
} */

/* foreach($resxls as $arrr){
  if($nrav = array_diff($resxls, $arrr)){
    print_r($nrav);
  }
  else{
    print_r('net');
  }
} */
$nob = get_object_vars($nodes);


$ob = array_merge($list, $nodes);
/* $uniqe = array_unique($ob); */

echo '<pre>';
  /* print_r($uniqe); */
  var_dump($ob);
echo '</pre>';




/* $nodes = db_query("
  SELECT title
  FROM {node}
  WHERE type = :type AND uid = :uid
  ", array(':type' => 'products', ':uid' => 1))->fetchAll();
echo '</div>';

foreach ($nodes as $nodes => $items) {

  foreach ($items as $key => $value) {



    echo "<td>$value</td>";

 */



    /*    $local = array("value");

       $res = compact("value");
       
       print_r($res); */
/*   }
  echo "</tr>";
}

echo '</table>';
 */
/* $nodes_zap = db_select('node', 'n')
  ->fields('n', array('$local'))
  ->condition('n.type', 'product') // <--
  ->execute()
  ->fetchAll(); */











































/* echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: violet;"> Сравнение товаров XLS с БД </h2>';
foreach ($nodes as $nodes) {
  echo '<table border="1">';
  // Перебор строк
  foreach ($nodes as $value) {
    echo '<tr>';
    // Перебор столбцов
    echo '<td>';
    if ($value !== $row) {
      echo "<td>" . $value . "</td>";
    } else {

    }
    echo '</td>';
    echo '</tr>';
  }
  echo '</table>';
}
echo '</div>';
 */


///////////// ДОБАВЛЕНИЕ ЗАПИСИ --------------------------
/*  $nodes = db_insert('helloworld')
 ->fields(array(
   'intvar' => 5,
   'stringvar' => '$row[0]',
   'floatvar' => 3.14,
 ))
 ->execute(); */

/* echo '<div style="margin-bottom: 50px;">';
echo '<h2 style="color: blue;"> Сравнение товаров </h2>';
  foreach($lists as $list){
  echo '<table border="1">';
  // Перебор строк
  foreach($list as $row){
    echo '<tr>';
    // Перебор столбцов
    foreach($row as $row){
    echo '<td>';
      if ($row !== $value){
                echo "<td> $row </td>";
            }
            else{
               
            }
    echo '</td>';
  }
  echo '</tr>';
  }
  echo '</table>';
}
echo '</div>'; */


?>