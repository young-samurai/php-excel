<?php

//Подлключение ядра друпал
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


require_once 'PHPExcel-1.8.2/Classes/PHPExcel.php';

$inputFileName = 'upload/bb.xls';
$excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileName);
$excelObj = $excelReader->load($inputFileName);

$worksheet = $excelObj->getActiveSheet();
$rows = $worksheet->toArray();
echo "<h1 style='color: purple;'>Товары у которых заполнена 3 колонка в xls (путь к файлу)</h1>";
$table = '<table>
            <thead>
              <tr>
                <th>Название</th>
                <th>Артикул</th>
                <th>Путь файла</th>
              </tr>
            </thead>
            <tbody>';

foreach ($rows as $row) {
  if (!empty($row[2])) {
    $table .= '<tr>
                 <td style="text-align:center; border: 1px solid #000;">' . $row[0] . '</td>
                 <td style="text-align:center; border: 1px solid #000;">' . $row[1] . '</td>
                 <td style="text-align:center; border: 1px solid #000;">' . $row[2] . '</td>
               </tr>';
  }
}

$table .= '</tbody></table>';

print $table;







echo "<h1 style='color: grey;'>Товары у которых не заполнен Изображени(new)</h1>";

$results = db_query("
  SELECT nid, title, field_data_field_articul.field_articul_value
  FROM node
  LEFT JOIN field_data_field_foto ON nid = field_data_field_foto.entity_id
  LEFT JOIN field_data_field_articul ON nid = field_data_field_articul.entity_id
  WHERE type = 'products' AND field_data_field_foto.field_foto_fid IS NULL
  ORDER BY nid;
"); 

foreach ($result as $key => $value) {
  $site_img[]=$value->title;
  echo'<tr>';
        echo '<td>';
        echo $site_nodes;
        echo '</td>';
        echo'</tr>';
}
$tablen = '<table>
            <thead>
              <tr>
                <th>ID страницы</th>
                <th>Название товара</th>
                <th>Артикул</th>
              </tr>
            </thead>
            <tbody>';

foreach ($results as $result) {
  $tablen .= '<tr>
               <td style="text-align:center; border: 1px solid #000;">' . $result->nid . '</td>
               <td style="text-align:center; border: 1px solid #000;">' . $result->title . '</td>
               <td style="text-align:center; border: 1px solid #000;">' . $result->field_articul_value . '</td>
             </tr>';
}

$tablen .= '</tbody></table>';

print $tablen;



?>