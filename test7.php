<?php 
define('DRUPAL_ROOT', getcwd());
include_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$image = db_query("
SELECT field_data_field_image
FROM {node}
WHERE type = :type
", array(':type' => 'products'))->fetchAll();

echo '<table border="1px">';
foreach ($image as $key => $value) {
 $site_img[]=$value->field_data_field_image;
 /* print "<tr><td>". $site_nodes. "</td></tr>"; */
 echo'<tr>';
 echo '<td>';
 var_dump($site_img);
 echo '</td>';
echo'</tr>';
}


?>