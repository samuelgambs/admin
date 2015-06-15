<?php 
require_once '../includes/mysqli.php';

$id = $_GET['id'];

$busca_lin_agendados_assiduos =
"SELECT dataref,
		total
   FROM cli_lin_agendados_assiduos
  WHERE INSCRICAO = $id
ORDER BY data_arquivo desc
LIMIT 12";
$query_lin_agendados_assiduos = $MySQLi->query($busca_lin_agendados_assiduos) or trigger_error($MySQLi->error, E_USER_ERROR);

?>
    <?php /*<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([ */
?>
google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_agendados_assiduo = $query_lin_agendados_assiduos->fetch_object()) {
            ?>
            ['<?php echo $row_lin_agendados_assiduo->dataref; ?>', <?php echo $row_lin_agendados_assiduo->total; ?> ],            
         <?php }     ?>
        ]);
      
    

