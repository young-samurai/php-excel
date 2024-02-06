<?php
  //Подлключение ядра друпал
  define('DRUPAL_ROOT', getcwd());
  include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

  //подключение PHPExcell
  require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';
  $phpexcel = new PHPExcel();
  $page = $phpexcel->setActiveSheetIndex(0);

  $nodes = db_query("
  SELECT nid, title
  FROM {node}
  WHERE type = :type
  ", array(':type' => 'products'))->fetchAll();


  //ВЫОДИТ ВСЕ В 1 СТРОКУ

 /*  echo '<table border="1">';
  foreach ($nodes as $items)
  {
      foreach ($items as  $value)
      {
          echo "<td>$value</td>";
      }
  }
  echo '</table>';
 */

  //ВЫВОД В ТАБЛИЦЫ


  echo '<table border="1px">';
  foreach ($nodes as $nodes => $items){
    echo "<tr>";
      foreach ($items as $key => $value)
      {
          echo "<td>$value</td>";
      }
    echo "</tr>";
  }
  echo '</table>';

  /* print_r ($nodes); */  // вывод массива !!!!!!!!!! НУЖНАЯ ШТУКА






  //Поулучение значения из ячейки A3 
 /*  $output =  $excel->getActiveSheet()->getCell('A3')->getValue();
  print $output; */
  /* print $excel; */




?>