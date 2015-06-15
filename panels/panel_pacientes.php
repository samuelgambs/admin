<?php
error_reporting(E_ALL);

require_once('../includes/mysqli.php');
require_once('../pages/functions.php');
$meses = array(
		'01'=>'Jan',
		'02'=>'Fev',
		'03'=>'Mar',
		'04'=>'Abr',
		'05'=>'Mai',
		'06'=>'Jun',
		'07'=>'Jul',
		'08'=>'Ago',
		'09'=>'Set',
		'10'=>'Out',
		'11'=>'Nov',
		'12'=>'Dez'
);

$mespassado =  $meses[date ('m', strtotime(date('Y-m')." -1 month"))].'/'.date ('Y', strtotime(date('Y-m')." -1 month"));
$mesatual = $meses[date ('m', strtotime(date('Y-m')))].'/'.date ('Y', strtotime(date('Y-m')));

$id = $_GET['id'];
$regional = $_GET['regional'];
$estado = $regional;
$dados = $_GET['dados'];
$label = 'Pacientes';
$icon = 'fa-group';
$flag = 'aproveitamento';
$total_pac_mes_passado = $_GET['total_pac_mp'];
$pacientes_mes_parcial = $_GET['total_pac'];
$pacientes_nacional =  $_GET['media_pac_nacional'];
$pacientes_regional =  $_GET['media_pac_regional'];

if ($dados=='ma') {

 echo montaPanel($label, $pacientes_mes_parcial, $pacientes_mes_parcial, $pacientes_regional, $pacientes_nacional, $pacientes_mes_parcial, $icon,
 		 $flag, $total_pac_mes_passado, $pacientes_mes_parcial, $total_pac_mes_passado, $pacientes_nacional, $pacientes_regional);
	
}
else {
	
	
	echo montaPanel($label, $total_pac_mes_passado, $total_pac_mes_passado, $pacientes_regional, $pacientes_nacional, $pacientes_mes_parcial, $icon,
			$flag, $total_pac_mes_passado, $pacientes_mes_parcial, $total_pac_mes_passado, $pacientes_nacional, $pacientes_regional);	
	
}


/* 
  if (mysqli_num_rows($resultado) > "0") 
    {
} */


?>
<script type="text/javascript">
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})
</script>
