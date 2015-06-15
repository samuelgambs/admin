<?php
error_reporting(E_ALL);


function colorPanel($valor,$media_nacional,$media_regional){
	$color = 'danger';
	if (($valor > $media_regional) | ($valor > $media_nacional)) $color = 'warning';
	if (($valor > $media_regional) && ($valor > $media_nacional)) $color = 'success';
	return ($color);
}

function colorPanelInverso($valor,$media_nacional,$media_regional){
	$color = 'danger';
	if (($valor < $media_regional) | ($valor < $media_nacional)) $color = 'warning';
	if (($valor < $media_regional) && ($valor < $media_nacional)) $color = 'success';
	return ($color);
}



require_once('../includes/mysqli.php');
$idsocio = $_GET['idSocio'];
$estado = $_GET['uf'];
$idadm = $_GET['adm'];
$mes = $_GET['mes'];
if (empty($estado)) $estado = 'Nacional';
$andWhereSocio ='';
$andWhereEstado ='';
if ($estado!="Nacional") {
	 if (strlen($estado) > 2) {

							 	$array_estados = str_split($estado, 2);
									 	function quote($str) {return sprintf("'%s'", $str);
															 }
								$estados =	implode(',', array_map('quote', $array_estados));
								$andWhereEstado =  "and  a.estado IN ($estados)";

							  }

 	else {$andWhereEstado =  "and  a.estado IN ('$estado')";
 	}

}
//SE A BUSCA FOR FILTRADO POR SOCIO:
include ('../includes/querie_lista_nacional_estados_mp.php');
if (($idsocio == "Todos") && ($idadm == "Todos")) 
	include ('../includes/querie_lista_nacional_estados.php');
else  {
	include ('../includes/querie_socio.php');	
}
$resultado = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
//buscando a media nacional
include ('../includes/querie_soma_nacional.php');
//fazendo a listagem das clinicas nacional ou regional
if (($estado!="Nacional") && (strlen($estado) < 3))  {
	include ('../includes/querie_soma_estado.php');
}
$resultado_soma = $MySQLi->query($sqlMediaNacional) OR trigger_error($MySQLi->error, E_USER_ERROR);

  if (mysqli_num_rows($resultado) > "0")
    {
		$bandeira = array(
    'AM'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Bandeira_do_Amazonas.svg/125px-Bandeira_do_Amazonas.svg.png',
    'DF'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Bandeira_do_Distrito_Federal_%28Brasil%29.svg/125px-Bandeira_do_Distrito_Federal_%28Brasil%29.svg.png',
    'BA'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Bandeira_da_Bahia.svg/125px-Bandeira_da_Bahia.svg.png',
    'BR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/125px-Flag_of_Brazil.svg.png',
    'ES'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Bandeira_do_Esp%C3%ADrito_Santo.svg/125px-Bandeira_do_Esp%C3%ADrito_Santo.svg.png',
    'GO'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bandeira_de_Goi%C3%A1s.svg/125px-Bandeira_de_Goi%C3%A1s.svg.png',
    'MG'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Bandeira_de_Minas_Gerais.svg/125px-Bandeira_de_Minas_Gerais.svg.png',
    'PR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Bandeira_do_Paran%C3%A1.svg/125px-Bandeira_do_Paran%C3%A1.svg.png',
    'RJ'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Bandeira_da_cidade_do_Rio_de_Janeiro.svg/125px-Bandeira_da_cidade_do_Rio_de_Janeiro.svg.png',
    'RS'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Bandeira_do_Rio_Grande_do_Sul.svg/125px-Bandeira_do_Rio_Grande_do_Sul.svg.png',
    'SC'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Bandeira_de_Santa_Catarina.svg/125px-Bandeira_de_Santa_Catarina.svg.png',
    'SP'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Bandeira_do_estado_de_S%C3%A3o_Paulo.svg/125px-Bandeira_do_estado_de_S%C3%A3o_Paulo.svg.png'
);
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
?>

	<html>
	<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">


	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.colVis.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.fixedColumns.css">
	<link rel="stylesheet" type="text/css" href="../css/shCore.css">
	<!-- <link rel="stylesheet" type="text/css" href="../../../examples/resources/demo.css"> -->
	<style type="text/css" class="init">

	/* Ensure that the demo table scrolls */
	th, td {
	white-space: nowrap;
	text-align: center;
	border-right: 1px solid #fff;
	border-left: 1px solid #fff;
    font-weight: bold;

}
	div.dataTables_wrapper {
		width: 100%;
		margin: 0 auto;
	}

	
    .coluna_par {
    background: none repeat scroll 0 0 #FFFFFF;
    text-align: center;
    }
    .coluna_impar {
    background: none repeat scroll 0 0 #f1f1f1;
    text-align: center;
    }
	</style>
	 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.colVis.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.fixedColumns.js"></script>
	<script type="text/javascript" language="javascript" src="../js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../js/demo.js"></script>
    
 
    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <script>
	function popUP(nome, url, settings){
		var  w, h, left, top
		
		w=screen.width
		h=screen.height    
			
		left=(w-1080)/2
		top=(h-400)/2
		
		settings+=", left="+left+", top="+top
		
		window.open(url, nome, settings)
	}
	</script>

	<script type="text/javascript" language="javascript" class="init">

		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				dom:            "Cfrtip",
				scrollY:        "460px",
				scrollX:        true,
				scrollCollapse: true,

				paging:         false,
				columnDefs: [
					{ width: 160, targets: 0 },
					//{ "type": "currency", targets:[42,43,44,45,46] }
				]
			} );

			new $.fn.dataTable.FixedColumns( table, {
				leftColumns: 1
			} );
		} );
		
		 // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()


	</script>
</head>
<body>

<table id="example2" class="stripe row-border order-column" cellspacing="0" width="100%" >
				<thead bgcolor="f1f1f1">
					<tr>
						<th rowspan="2" bgcolor="#f1f1f1">Clínica</th>
					  <th colspan="3" bgcolor="#f1f1f1" class="coluna_impar">Pacientes</th>
                        <td colspan="5" bgcolor="#FFFFFF" class="coluna_par">Orçamentos</td>
                        <th colspan="5" bgcolor="#f1f1f1" class="coluna_impar">Documentação</th>
                        <th colspan="7" class="coluna_par">Inícios</th>
                        <th colspan="7" bgcolor="#f1f1f1" class="coluna_impar">Indicação Cliente Amigo</th>
                        <th colspan="5" class="coluna_par">Fluxo FM</th>
                        <th class="coluna_par">FM Não Pagantes</th>
                        <th class="coluna_par">FM Pagantes</th>
                     	<th colspan="3" bgcolor="#f1f1f1" class="coluna_impar">Aproveitamento</th>
                      	<th colspan="3" class="coluna_par">Faltosos Total</th>
                      	<th colspan="3" bgcolor="#f1f1f1" class="coluna_impar">Faltosos Agendados</th>
                        <th colspan="3" class="coluna_par">Faltosos Atendidos</th>
                        <th colspan="5" bgcolor="#f1f1f1" class="coluna_impar">Flutuantes</th>
                        <th colspan="9" class="coluna_par">Indice de Faltas</th>
                        <th colspan="5" bgcolor="#f1f1f1" class="coluna_impar">Cancelamentos</th>
                        <th colspan="5" class="coluna_par">Suspensões</th>
                        <th colspan="4" bgcolor="#f1f1f1" class="coluna_impar">Abandono</th>
                        <th colspan="5" class="coluna_par">Receitas x Despesas</th>
                        <th colspan="2" bgcolor="#f1f1f1" class="coluna_impar">Custo x Paciente</th>
                        <th colspan="2" class="coluna_par">Custo Funcionario</th>
                        <th colspan="5" bgcolor="#f1f1f1" class="coluna_impar">Gasto Dental</th>
                        <th colspan="6" class="coluna_par">Negociação</th>
                    </tr>
					<tr class="tooltip-demo">
					  <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
					  <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
					  <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
					  <td bgcolor="#FFFFFF" style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></td>
                      <td bgcolor="#FFFFFF" style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do total do mês atual sob o total de pacientes">%Sob Total Paciente</small></td>
                      <td bgcolor="#FFFFFF" style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></td>
                      <td bgcolor="#FFFFFF" style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></td>
                      <td bgcolor="#FFFFFF" style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do fechamento do mês anterior sob o total de pacientes">%Sob Total Paciente</small></td>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% de documentações mês atual sob o total de pacientes">%Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento mês anterior"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do fechamento mês passado sob o total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob o total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Inícios sob o total de orçamentos do mês atual">Aproveitamento</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do fechamento mês passado sob o total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Inícios sob o total de orçamentos do mês passado">Aproveitamento</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Indicados <?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Permitidos <?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Contemplados <?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Indicados Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"> <small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Contemplados Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Indicados <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"> <small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Contemplados <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do FM sob total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do mês passado sob total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total de faltosos do mês dividido pelo total de pacientes"><?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total de faltosos de 30 dias atrás dividido pelo total de pacientes"> Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total de faltosos do mês passado pelo total de pacientes"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total de Faltosos Agendados no mês Atual até a presente data e Dividido pelo Total de Faltosos"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Faltosos Agendados de 30 dias atrás dividido pelo total de Faltosos "> Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total de faltosos do mês passado dividido pelo total de pacientes"> <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total de Faltosos Agendados no mês dividido pelo total de Faltosos"><?php echo $mesatual ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento mês Passado"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">%Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês passado sob total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Qtd Falta <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Qtd Marcacoes <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data">Índice de Falta <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Qtd Falta Parcial<?php echo $mespassado?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Qtd Marcacoes Parcial<?php echo $mespassado?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Índice de Falta Parcial<?php echo $mespassado?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Qtd Falta <?php echo $mespassado?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Qtd Marcacoes<?php echo $mespassado?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Índice de Falta <?php echo $mespassado?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">%Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês passado sob total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">%Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado"><?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% do mês passado sob total de pacientes">%Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">%Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Parcial<?php echo $mespassado?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">%Sob Total Paciente</small><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes"></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Receita</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Despesa</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento do mês passado">Lucro</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total Mês Atual">Entrada Orto <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total Mês Passado">Entrada Orto <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1">
                      <small data-toggle="tooltip" data-placement="top" title="Total de Custo da Clínica Dividido Pelo Total de Pacientes "><?php echo $mespassado ?> Gasto</small>
                      </th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1">            
                      <small data-toggle="tooltip" data-placement="top" title="Total de Lucro da Clínica Dividido Pelo Total de Pacientes"><?php echo $mespassado ?> Lucro</small>
                      </th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total de Custos com Funcionários no Mês Passado"><?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="% de Custos com Funcionários mês passado sob total de pacientes">Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual até a presente data"><?php echo $mesatual?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês atual sob total de pacientes">Sob Total Paciente</small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Parcial <?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="Total Mês Passado"><?php echo $mespassado ?></small></th>
                      <th bgcolor="#f1f1f1" style="background-color:#f1f1f1"><small data-toggle="tooltip" data-placement="top" title="% do mês passado sob total de pacientes">Sob Total Paciente</small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual"> Pago <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Total do mês atual">em Atraso <?php echo $mesatual?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Total Pago Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Valor de 30 dias atrás">Total em Atraso Parcial <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento Mês Passado">Pago <?php echo $mespassado ?></small></th>
                      <th style="background-color:#ffffff"><small data-toggle="tooltip" data-placement="top" title="Fechamento Mês Passado"> Atraso <?php echo $mespassado ?></small> </th>
                  </tr>
				</thead>
				<tfoot>

                      <?php
                      if (($estado!="Nacional") && (strlen($estado) < 3)){

						// Faz um loop, passando por todos os resultados encontrados
						while ($row_soma_regional = $resultado_soma_regional->fetch_object()) {
							 ?>
						  <tr>

                    <th bgcolor="#f1f1f1"> Média Regional <b data-toggle="tooltip" data-placement="left" title="Média Regional"><img alt="Média Regional" rel="tooltip" title="Média Regional"  src="<?php echo $bandeira[$estado]?>" width="15%" height="15%"></b></th>
                    <th bgcolor="#f1f1f1"><?php echo $media_regional_total_paciente = round($row_soma_regional->total_paciente); ?></th>
                    <th bgcolor="#f1f1f1"><?php echo $media_pacientes_parcial_mp_regional =  round($row_soma_regional->pac_parcial_mp);  ?></th>
                    <th bgcolor="#f1f1f1"><?php echo round($media_pacientes_mp_regional) ?></th>
                    <td bgcolor="#FFFFFF"><?php echo $media_regional_orc_mesatual = round($row_soma_regional->orc_mesatual) ; ?> </td>
					  <td bgcolor="#FFFFFF"><?php echo $media_regional_orcamentos_sob_pacientes = round($row_soma_regional->orcamentos_sob_pacientes,2); ?>%</td>
					  <td bgcolor="#FFFFFF"><?php echo $media_orcamento_parcial_mp_regional =  round($row_soma_regional->orc_parcial_mp);  ?></td>
					  <td bgcolor="#FFFFFF"><?php echo round($media_orcamentos_mp_regional)?></td>
					  <td bgcolor="#FFFFFF"><?php echo $media_regional_orcamentos_sob_pacientes_mp = round($media_orcamentos_mp_regional*100/$media_pacientes_mp_regional,2)?>%</td>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_documentacao_mes = round($row_soma_regional->documentacao_mes); ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_documentacao_sob_pacientes = round($row_soma_regional->documentacao_sob_pacientes,2); ?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_documentacao_parcial_mp_regional =  round($row_soma_regional->doc_parcial_mp);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_documentacao_mp_regional)?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_documentacao_sob_pacientes_mp = round($media_documentacao_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th><?php echo $media_regional_ini_mesatual = round($row_soma_regional->ini_mesatual); ?></th>
					  <th><?php echo $media_regional_inicios_sob_pacientes = round($row_soma_regional->inicios_sob_pacientes,2); ?>%</th>
					  <th><?php echo $media_regional_inicios_sob_orcamentos = round($row_soma_regional->inicios_sob_orcamentos,2); ?>%</th>
					  <th><?php echo $media_inicios_parcial_mp_regional =  round($row_soma_regional->ini_parcial_mp);  ?></th>
					  <th><?php echo round($media_inicios_mp_regional)?></th>
					  <th><?php echo $media_regional_inicios_sob_pacientes_mp = round ($media_inicios_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th><?php echo $media_inicios_sob_orcamentos_mp_regional = round ($media_inicios_mp_regional*100/$media_orcamentos_mp_regional,2)?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_ma_regional =  round($row_soma_regional->total_indic_ma);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_permitido_cli_ami_ma_regional =  round($row_soma_regional->total_permitido);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_ma_regional =  round($row_soma_regional->total_contemplado_ma,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_pmp_regional =  round($row_soma_regional->total_indic_pmp,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_pmp_regional =  round($row_soma_regional->total_contemplado_pmp,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_mp_regional =  round($row_soma_regional->total_indic_mp);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_mp_regional =  round($row_soma_regional->total_contemplado_mp,2);  ?></th>
					  <th><?php echo $media_regional_fm = round($row_soma_regional->fm,0); ?></th>
					  <th><?php echo $media_regional_fm_sob_pacientes = round($row_soma_regional->fm_sob_pacientes,2); ?>%</th>
					  <th><?php echo $media_fm_parcial_mp_regional =  round($row_soma_regional->fm_parcial_mp);  ?></th>
					  <th><?php echo round($media_fm_mp_regional)?></th>
					  <th><?php echo $media_fm_sob_pacientes_mp_regional = round($media_fm_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th><?php echo $media_fm_n_pagantes_ma_regional =  round($row_soma_regional->fmnaopagantes_ma,2);  ?></th>
					  <th><?php echo $media_fm_pagantes_ma_regional =  round($row_soma_regional->fmpagantes_ma,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_ma_regional =  round($row_soma_regional->nota_fiscal_ma,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_pmp_regional =  round($row_soma_regional->nota_fiscal_pmp,2);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_mp_regional =  round($row_soma_regional->nota_fiscal_mp,2);  ?></th>
					  <th><?php echo $media_regional_total_faltosos = round($row_soma_regional->total_faltosos); ?> <small>(<?php echo $media_regional_faltosos_sob_pacientes = round($row_soma_regional->faltosos_sob_pacientes,2); ?>%)</small></th>
					  <th><?php echo $media_faltosos_parcial_mp_regional =  round($row_soma_regional->falt_total_parcial_mp);  ?>
					  <small>(<?php echo $media_regional_faltosos_sob_pacientes_pmp = round($media_faltosos_parcial_mp_regional*100/$media_pacientes_parcial_mp_regional,2); ?>%)</small></th>
					  <th><?php echo round($media_total_faltosos_mp_regional)?> <small>(<?php echo $media_regional_faltosos_sob_pacientes_mp = round ($media_total_faltosos_mp_regional*100/$media_pacientes_mp_regional,2)?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_faltosos_agendados_regional = round($row_soma_regional->media_faltosos_agendados) ?><small>(<?php echo $media_regional_faltosos_age_sob_total = round($media_faltosos_agendados_regional*100/$media_regional_total_faltosos,2); ?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_faltosos_agendados_parcial_mp_regional =  round($row_soma_regional->falt_agend_parcial_mp);  ?> 
                      <small>(<?php echo $media_regional_faltosos_age_sob_total_pmp = round($media_faltosos_agendados_parcial_mp_regional*100/$media_faltosos_parcial_mp_regional,2); ?>%)</small>
                      </th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_faltosos_agendados_mp_regional)?>
                      <small>(<?php echo $media_regional_faltosos_age_sob_total_mp = round($media_faltosos_agendados_mp_regional*100/$media_total_faltosos_mp_regional,2); ?>%)</small>
                      </th>
					  <th><?php echo $media_faltosos_atendidos_regional = round($row_soma_regional->media_faltosos_atendidos) ?><small>(<?php echo $media_regional_faltosos_ate_sob_total = round($media_faltosos_atendidos_regional*100/$media_regional_total_faltosos,2); ?>%)</small></th>
					  <th><?php echo $media_faltosos_atendidos_parcial_mp_regional =  round($row_soma_regional->falt_atend_parcial_mp);  ?><small>(<?php echo $media_regional_faltosos_ate_sob_total_pmp = round($media_faltosos_atendidos_parcial_mp_regional*100/$media_faltosos_parcial_mp_regional,2); ?>%)</small></th>
					  <th><?php echo round($media_faltosos_atendidos_mp_regional)?> <small>(<?php echo $media_regional_faltosos_ate_sob_total_mp = round($media_faltosos_atendidos_mp_regional*100/$media_total_faltosos_mp_regional,2); ?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_flutuantes = round($row_soma_regional->flutuantes);?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_flutuantes_sob_pacientes = round($row_soma_regional->flutuantes_sob_pacientes,2);?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flut_parcial_mp_regional =  round($row_soma_regional->flut_parcial_mp);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_flutuantes_mp_regional)?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flutuantes_sob_pacientes_mp_regional =  round($media_flutuantes_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th><?php echo $media_qtd_falta_ano_regional = round($row_soma_regional->qtd_falta_mes)?></th>
					  <th><?php echo $media_qtd_marcacoes_regional = round($row_soma_regional->qtd_marcacoes_mes)?></th>
					  <th><?php echo $media_indice_falta_regional = round($row_soma_regional->indice_falta,2)?>%</th>
					  <th><?php echo $media_qtd_falta_ano_regional_pmp = round($row_soma_regional->qtd_falta_mes_pmp)?></th>
					  <th><?php echo $media_qtd_marcacoes_regional_pmp = round($row_soma_regional->qtd_marcacoes_mes_pmp)?></th>
					  <th><?php echo $media_indice_falta_regional_pmp = round($row_soma_regional->indice_falta_pmp,2)?>%</th>
					  <th><?php echo $media_qtd_falta_ano_mp_regional = round($row_soma_regional->qtd_falta_mes_mp)?></th>
					  <th><?php echo $media_qtd_marcacoes_regional_mp = round($row_soma_regional->qtd_marcacoes_mes_mp)?></th>
					  <th><?php echo $media_indice_falta_regional_mp = round($row_soma_regional->indice_falta_mp,2)?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_cancelamento_ficha = round($row_soma_regional->cancelamento_ficha);?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_cancelamento_sob_pacientes = round($row_soma_regional->cancelamento_sob_pacientes,2);?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_regional_cancelamento_ficha_pmp = round($row_soma_regional->cancelamento_ficha_pmp);?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_cancelamentos_mp_regional)?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_cancelamentos_sob_pacientes_mp_regional = round($media_cancelamentos_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th><?php echo $media_regional_suspensoes = round($row_soma_regional->suspensoes);?></th>
					  <th><?php echo $media_regional_suspensoes_sob_pacientes = round($row_soma_regional->suspensoes_sob_pacientes,2);?>%</th>
					  <th><?php echo $media_regional_suspensoes_pmp = round($row_soma_regional->suspensoes_pmp);?></th>
					  <th><?php echo round($media_suspensoes_mp_regional)?></th>
					  <th><?php echo $media_suspensoes_sob_pacientes_mp_regional = round($media_suspensoes_mp_regional*100/$media_pacientes_mp_regional,2)?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_abandono_trat_ma_regional =  round($row_soma_regional->abandono_trat_ma);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indice_abandono_ma_regional =  round($row_soma_regional->indice_abandono_ma);  ?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_abandono_trat_pmp_regional = round($row_soma_regional->abandono_trat_pmp); ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indice_abandono_pmp_regional = round($row_soma_regional->indice_abandono_pmp,2); ?>%</th>
					  <th><?php  $media_regional_receita = round($row_soma_regional->receita,2); echo 'R$' . number_format( $media_regional_receita  , 2, ',', '.') ?></th>
					  <th><?php  $media_regional_despesa = round($row_soma_regional->despesa,2); echo 'R$' . number_format( $media_regional_despesa  , 2, ',', '.')?></th>
					  <th><?php $media_regional_lucro = round($row_soma_regional->lucro,2);  echo 'R$' . number_format( $media_regional_lucro  , 2, ',', '.') ?></th>
					  <th><?php $media_entrada_orto_ma_regional =  round($row_soma_regional->orto_atual);  ?>
					    <?php   echo 'R$' . number_format( $media_entrada_orto_ma_regional  , 2, ',', '.')?></th>
					  <th><?php $media_entrada_orto_mp_regional =  round($row_soma_regional->orto_mp);  ?>
					    <?php   echo 'R$' . number_format( $media_entrada_orto_mp_regional  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php  $media_regional_media_gasto = round($row_soma_regional->media_gasto); echo 'R$' . number_format( $media_regional_media_gasto  , 2, ',', '.') ?></th>
					  <th bgcolor="#f1f1f1"><?php $media_regional_media_lucro = round($row_soma_regional->media_lucro); echo 'R$' . number_format( $media_regional_media_lucro  , 2, ',', '.') ?></th>
					  <th><?php   echo 'R$' . number_format( $media_custo_funcionario_mp_regional  , 2, ',', '.')?></th>
                      <th><?php $media_custo_funcionario_sob_pacientes_mp_regional =  round($media_custo_funcionario_mp_regional/$media_pacientes_mp_regional,2);  echo 'R$' . number_format( $media_custo_funcionario_sob_pacientes_mp_regional  , 2, ',', '.')?></th>
                      <th bgcolor="#f1f1f1"><?php $media_regional_custo_dental = round($row_soma_regional->custo_dental); echo 'R$' . number_format( $media_regional_custo_dental  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php $media_regional_custo_dental_sob_pacientes = round($row_soma_regional->custo_dental_sob_pacientes,2); echo 'R$' . number_format( $media_regional_custo_dental_sob_pacientes  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php $media_regional_custo_dental_pmp = round($row_soma_regional->custo_dental_pmp); echo 'R$' . number_format( $media_regional_custo_dental_pmp  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php echo 'R$' . number_format( $media_gastos_dental_mp_regional  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php $media_gasto_dental_sob_pacientes_mp_regional =  ($media_gastos_dental_mp_regional/$media_pacientes_mp_regional) ; 
					  echo 'R$' . number_format( $media_gasto_dental_sob_pacientes_mp_regional  , 2, ',', '.');?></th>
					  <th><?php $media_total_pago_regional = $row_soma_regional->total_pago;$media_total_em_atraso_regional = $row_soma_regional->total_em_atraso; echo 'R$' . number_format( $media_total_pago_regional  , 2, ',', '.')?><small>(<?php echo $porc_media_regional_total_pago = round($media_total_pago_regional *100/($media_total_pago_regional+$media_total_em_atraso_regional),2) ;?>%)</small></th>
					  <th><?php echo 'R$' . number_format( $media_total_em_atraso_regional  , 2, ',', '.')?><small>(<?php echo $porc_media_total_em_atraso_regional = round($media_total_em_atraso_regional *100/($media_total_pago_regional+$media_total_em_atraso_regional),2) ;?>%)</small></th>
					  <th><?php $media_total_em_atraso_parcial_mp_regional =  round($row_soma_regional->total_em_atraso_parcial_mp); echo $media_total_pago_parcial_mp_regional =  round($row_soma_regional->total_pago_parcial_mp);  ?>
                      	<small>
                      		(<?php echo $porc_media_regional_total_pago_pmp = round($media_total_pago_parcial_mp_regional *100/($media_total_pago_parcial_mp_regional+$media_total_em_atraso_parcial_mp_regional),2) ;?>%)
                      	</small>
                      </th>
					  <th><?php echo $media_total_em_atraso_parcial_mp_regional =  round($row_soma_regional->total_em_atraso_parcial_mp);  ?><small>(<?php echo $porc_media_total_em_atraso_pmp_regional = round($media_total_em_atraso_parcial_mp_regional *100/($media_total_em_atraso_parcial_mp_regional+$media_total_pago_parcial_mp_regional),2) ;?>%)</small></th>
					  <th><?php echo 'R$' . number_format( $media_total_pago_mp_regional  , 2, ',', '.')?>
                      <small>(<?php echo $porc_media_regional_total_pago_mp = round($media_total_pago_mp_regional *100/($media_total_pago_mp_regional+$media_total_em_atraso_mp_regional),2) ;?>%) </small>
                      </th>
					  <th><?php echo 'R$' . number_format( $media_total_em_atraso_mp_regional  , 2, ',', '.')?><small>(<?php echo $porc_media_total_em_atraso_mp_regional = round($media_total_em_atraso_mp_regional *100/($media_total_em_atraso_mp_regional+$media_total_pago_mp_regional),2) ;?>%)</small></th>
				  </tr>

                  <?php }} ?>

                  <tr align="center">
                   <?php
					  /*  $sql_num_rows_nacional = "  SELECT nomefantasia FROM ap_clinicas WHERE tipoclinica = 'F' and Ativo = 'Sim' ";
					   $resultado_nacional = $MySQLi->query($sql_num_rows_nacional) OR trigger_error($MySQLi->error, E_USER_ERROR);
					   $num_rows = mysqli_num_rows($resultado_nacional); */

						// Faz um loop, passando por todos os resultados encontrados
					   while ($row_soma = $resultado_soma->fetch_object()) {
							 ?>
					  <th bgcolor="#f1f1f1">Média Nacional <b data-toggle="tooltip" data-placement="left" title="Média Nacional"><img alt="Média Nacional" rel="tooltip" title="Média Nacional"  src="<?php echo $bandeira['BR']?>" width="15%" height="15%"></b></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_total_paciente = round($row_soma->total_paciente); ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_pacientes_parcial_mp =  round($row_soma->pac_parcial_mp);  ?></th>
				    <th bgcolor="#f1f1f1"><?php echo round($media_pacientes_mp) ?></th>
					  <td bgcolor="#FFFFFF"><?php echo $media_orc_mesatual = round($row_soma->orc_mesatual) ; ?> </td>
					  <td bgcolor="#FFFFFF"><?php echo $media_orcamentos_sob_pacientes = round($row_soma->orcamentos_sob_pacientes,2); ?>%</td>
					  <td bgcolor="#FFFFFF"><?php echo $media_orcamento_parcial_mp =  round($row_soma->orc_parcial_mp);  ?></td>
					  <td bgcolor="#FFFFFF"><?php echo round($media_orcamentos_mp) ?></td>
					  <td bgcolor="#FFFFFF"><?php echo $media_orcamentos_sob_pacientes_mp = round($media_orcamentos_mp*100/$media_pacientes_mp,2) ?>%</td>
					  <th bgcolor="#f1f1f1"><?php echo $media_documentacao_mes = round($row_soma->documentacao_mes); ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_documentacao_sob_pacientes = round($row_soma->documentacao_sob_pacientes,2); ?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_documentacao_parcial_mp =  round($row_soma->doc_parcial_mp);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_documentacao_mp) ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_documentacao_sob_pacientes_mp = round($media_documentacao_mp*100/$media_pacientes_mp,2) ?>%</th>
					  <th><?php echo $media_ini_mesatual = round($row_soma->ini_mesatual); ?></th>
					  <th><?php echo $media_inicios_sob_pacientes = round($row_soma->inicios_sob_pacientes,2); ?>%</th>
					  <th><?php echo $media_inicios_sob_orcamentos = round($row_soma->inicios_sob_orcamentos,2); ?>%</th>
					  <th><?php echo $media_inicios_parcial_mp =  round($row_soma->ini_parcial_mp);  ?></th>
					  <th><?php echo round($media_inicios_mp) ?></th>
					  <th><?php echo $media_inicios_sob_pacientes_mp = round($media_inicios_mp*100/$media_pacientes_mp,2) ?>%</th>
		       		  <th><?php echo $media_inicios_sob_orcamentos_mp = round ($media_orcamentos_mp*100 / $media_inicios_mp,2) ?>%</th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_ma =  round($row_soma->total_indic_ma);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_permitido_cli_ami_ma =  round($row_soma->total_permitido);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_ma =  round($row_soma->total_contemplado_ma,2);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_pmp =  round($row_soma->total_indic_pmp);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_pmp =  round($row_soma->total_contemplado_pmp,2);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_indicados_cli_ami_mp =  round($row_soma->total_indic_mp);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_contemplados_cli_ami_mp =  round($row_soma->total_contemplado_mp,2);  ?></th>
		       		  <th><?php echo $media_fm = round($row_soma->fm,0); ?></th>
		       		  <th><?php echo $media_fm_sob_pacientes = round($row_soma->fm_sob_pacientes,2); ?>%</th>
		       		  <th><?php echo $media_fm_parcial_mp =  round($row_soma->fm_parcial_mp);  ?></th>
		       		  <th><?php echo round($media_fm_mp)?></th>
		       		  <th><?php echo $media_fm_sob_pacientes_mp = round($media_fm_mp*100/$media_pacientes_mp) ?>%</th>
		       		  <th><?php echo $media_fm_n_pagantes_ma =  round($row_soma->fmnaopagantes_ma,2);  ?></th>
		       		  <th><?php echo $media_fm_pagantes_ma =  round($row_soma->fmpagantes_ma,2);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_ma =  round($row_soma->nota_fiscal_ma,2);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_pmp =  round($row_soma->nota_fiscal_pmp,2);  ?></th>
		       		  <th bgcolor="#f1f1f1"><?php echo $media_nota_fiscal_mp =  round($row_soma->nota_fiscal_mp,2);  ?></th>
		       		  <th><?php echo $media_total_faltosos = round($row_soma->total_faltosos); ?> <small>(<?php echo $media_faltosos_sob_pacientes = round($row_soma->faltosos_sob_pacientes,2); ?>%)</small></th>
		       		  <th><?php echo $media_faltosos_parcial_mp =  round($row_soma->falt_total_parcial_mp);  ?><small>(<?php echo $media_faltosos_sob_pacientes_pmp = round($media_faltosos_parcial_mp*100/$media_pacientes_parcial_mp,2); ?>%)</small></th>
		       		  <th><?php echo round($media_total_faltosos_mp) ?> <small>(<?php echo $media_faltosos_sob_pacientes_mp = round($media_total_faltosos_mp*100/$media_pacientes_mp); ?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_faltosos_agendados = round($row_soma->media_faltosos_agendados,0) ?><small>(<?php echo $media_faltosos_age_sob_total = round($media_faltosos_agendados*100/$media_total_faltosos,2); ?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_faltosos_agendados_parcial_mp =  round($row_soma->falt_agend_parcial_mp);  ?>
                        <small>(<?php echo $media_faltosos_age_sob_total_pmp = round($media_faltosos_agendados_parcial_mp*100/$media_faltosos_parcial_mp,2); ?>%)</small>
                    </th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_faltosos_agendados_mp) ?> <small>(<?php echo $media_faltosos_age_sob_total_mp = round($media_faltosos_agendados_mp*100/$media_total_faltosos_mp,2); ?>%)</small></th>
					  <th><?php echo $media_faltosos_atendidos = round($row_soma->media_faltosos_atendidos,0) ?><small>(<?php echo $media_faltosos_ate_sob_total = round($media_faltosos_atendidos*100/$media_total_faltosos,2); ?>%)</small></th>
					  <th><?php echo $media_faltosos_atendidos_parcial_mp =  round($row_soma->falt_atend_parcial_mp);  ?> <small>(<?php echo $media_faltosos_ate_sob_total_pmp = round($media_faltosos_atendidos_parcial_mp*100/$media_faltosos_parcial_mp,2); ?>%)</small></th>
					  <th><?php echo round($media_faltosos_atendidos_mp) ?> <small>(<?php echo $media_faltosos_ate_sob_total_mp = round($media_faltosos_atendidos_mp*100/$media_total_faltosos_mp,2); ?>%)</small></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flutuantes = round($row_soma->flutuantes);?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flutuantes_sob_pacientes = round($row_soma->flutuantes_sob_pacientes,2);?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flut_parcial_mp =  round($row_soma->flut_parcial_mp);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_flutuantes_mp)?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_flutuantes_sob_pacientes_mp = round($media_flutuantes_mp*100/$media_pacientes_mp,2)?>%</th>
					  <th><?php echo $media_qtd_falta_ano = round($row_soma->qtd_falta_mes); ?></th>
					  <th><?php echo $media_qtd_marcacoes_ano = round($row_soma->qtd_marcacoes_mes); ?></th>
					  <th><?php echo $media_indice_falta = round($row_soma->indice_falta); ?>%</th>
					  <th><?php echo $media_qtd_falta_ano_pmp = round($row_soma->qtd_falta_mes_pmp); ?></th>
					  <th><?php echo $media_qtd_marcacoes_ano_pmp = round($row_soma->qtd_marcacoes_mes_pmp); ?></th>
					  <th><?php echo $media_indice_falta_pmp = round($row_soma->indice_falta_pmp); ?>%</th>
					  <th><?php echo $media_qtd_falta_ano_mp = round($row_soma->qtd_falta_mes_mp); ?></th>
					  <th><?php echo $media_qtd_marcacoes_ano_mp = round($row_soma->qtd_marcacoes_mes_mp); ?></th>
					  <th><?php echo $media_indice_falta_mp = round($row_soma->indice_falta_mp); ?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_cancelamento_ficha = round($row_soma->cancelamento_ficha);?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_cancelamento_sob_pacientes = round($row_soma->cancelamento_sob_pacientes,2);?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_cancelamento_ficha_pmp = round($row_soma->cancelamento_ficha_pmp);?></th>
					  <th bgcolor="#f1f1f1"><?php echo round($media_cancelamentos_mp)?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_cancelamentos_sob_pacientes_mp = round($media_cancelamentos_mp*100/$media_pacientes_mp,2)?>%</th>
					  <th><?php echo $media_suspensoes = round($row_soma->suspensoes);?></th>
					  <th><?php echo $media_suspensoes_sob_pacientes = round($row_soma->suspensoes_sob_pacientes,2);?>%</th>
					  <th><?php echo $media_suspensoes_pmp = round($row_soma->suspensoes_pmp);?></th>
					  <th><?php echo round($media_suspensoes_mp)?></th>
					  <th><?php echo $media_suspensoes_sob_pacientes_mp = round($media_suspensoes_mp*100/$media_pacientes_mp)?>% </th>
					  <th bgcolor="#f1f1f1"><?php echo $media_abandono_trat_ma =  round($row_soma->abandono_trat_ma);  ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indice_abandono_ma =  round($row_soma->indice_abandono_ma);  ?>%</th>
					  <th bgcolor="#f1f1f1"><?php echo $media_abandono_trat_pmp = round($row_soma->abandono_trat_pmp); ?></th>
					  <th bgcolor="#f1f1f1"><?php echo $media_indice_abandono_pmp = round($row_soma->indice_abandono_pmp,2); ?>%</th>
					  <th><?php $media_receita = round($row_soma->receita,2);echo 'R$' . number_format( $media_receita  , 2, ',', '.') ?></th>
					  <th><?php $media_despesa = round($row_soma->despesa,2); echo 'R$' . number_format( $media_despesa  , 2, ',', '.')?></th>
					  <th><?php $media_lucro = round($row_soma->lucro,2); echo 'R$' . number_format( $media_lucro  , 2, ',', '.')?></th>
					  <td><?php $media_entrada_orto_ma =  round($row_soma->orto_atual);  ?>
                        <?php   echo 'R$' . number_format( $media_entrada_orto_ma  , 2, ',', '.')?>
                        
				    <th><?php $media_entrada_orto_mp =  round($row_soma->orto_mp);  ?>
				        <?php   echo 'R$' . number_format( $media_entrada_orto_mp  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php $media_media_gasto = round($row_soma->media_gasto,2); echo 'R$' . number_format( $media_media_gasto  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php $media_media_lucro = round($row_soma->media_lucro,2);  echo 'R$' . number_format( $media_media_lucro  , 2, ',', '.')?></th>
					  <th>
				      <?php   echo 'R$' . number_format( $media_custo_funcionario_mp  , 2, ',', '.')?></th>
           			  <th><?php $media_custo_funcionario_sob_pacientes_mp = round($media_custo_funcionario_mp/$media_pacientes_mp); echo 'R$' . number_format( $media_custo_funcionario_sob_pacientes_mp  , 2, ',', '.')?></th>
          			  <th bgcolor="#f1f1f1"><?php  $media_custo_dental = round($row_soma->custo_dental);  echo 'R$' . number_format( $media_custo_dental  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php  $media_custo_dental_sob_pacientes = round($row_soma->custo_dental_sob_pacientes,2); echo 'R$' . number_format( $media_custo_dental_sob_pacientes  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php  $media_custo_dental_pmp = round($row_soma->custo_dental_pmp);  echo 'R$' . number_format( $media_custo_dental_pmp  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php   echo 'R$' . number_format( $media_gastos_dental_mp  , 2, ',', '.')?></th>
					  <th bgcolor="#f1f1f1"><?php  $media_gasto_dental_sob_pacientes_mp = round($media_gastos_dental_mp/$media_pacientes_mp,2);   echo 'R$' . number_format( $media_gasto_dental_sob_pacientes_mp  , 2, ',', '.')?></th>
					  <th><?php  $media_total_em_atraso = $row_soma->total_em_atraso;  $media_total_pago = round($row_soma->total_pago); echo 'R$' . number_format( $media_total_pago  , 2, ',', '.'); ?> <small>(<?php echo $porc_media_total_pago = round($media_total_pago *100/($media_total_pago +$media_total_em_atraso),2) ;?>%)</small></th>
					  <th><?php  echo 'R$' . number_format( $media_total_em_atraso  , 2, ',', '.') ?><small>(<?php echo $porc_media_total_em_atraso = round($media_total_em_atraso *100/($media_total_pago +$media_total_em_atraso),2) ;?>%)</small></th>
					  <th><?php $media_total_em_atraso_pmp = $row_soma->total_em_atraso_parcial_mp; 
						  echo $media_total_pago_parcial_mp =  round($row_soma->total_pago_parcial_mp);  ?>
						  <small>(<?php echo $porc_media_total_pago_pmp = round($media_total_pago_parcial_mp *100/($media_total_pago_parcial_mp +$media_total_em_atraso_pmp),2) ;?>%)</small>
					  </th>
					  <th><?php echo $media_total_em_atraso_parcial_mp =  round($row_soma->total_em_atraso_parcial_mp);  ?><small>(<?php echo $porc_media_total_em_atraso_pmp = round($media_total_em_atraso_pmp *100/($media_total_pago_parcial_mp +$media_total_em_atraso_pmp),2) ;?>%)</small></th>
					  <th><?php echo 'R$' . number_format( $media_total_pago_mp  , 2, ',', '.')?>
                       <small>(<?php echo $porc_media_total_pago_mp = round($media_total_pago_mp *100/($media_total_pago_mp +$media_total_em_atraso_mp),2) ;?>%)</small>
                      </th>
					  <th><?php echo 'R$' . number_format( $media_total_em_atraso_mp  , 2, ',', '.')?>
                      <small>(<?php echo $porc_media_total_em_atraso_mp = round($media_total_em_atraso_mp *100/($media_total_pago_mp +$media_total_em_atraso_mp),2) ;?>%)</small></th>
                      <?php }
					   if (($estado=="Nacional") | (strlen($estado) > 2)) {

                  	$media_regional_orc_mesatual =   $media_orc_mesatual;
                  	$media_regional_orcamentos_sob_pacientes = $media_orcamentos_sob_pacientes;
                  	$media_regional_documentacao_mes = $media_documentacao_mes;
                  	$media_regional_documentacao_sob_pacientes = $media_documentacao_sob_pacientes;
                  	$media_regional_ini_mesatual = $media_ini_mesatual;
                  	$media_regional_inicios_sob_pacientes = $media_inicios_sob_pacientes;
                  	$media_regional_inicios_sob_orcamentos = $media_inicios_sob_orcamentos;
                  	$media_regional_fm_sob_pacientes = $media_fm_sob_pacientes;
                  	$media_regional_fm = $media_fm;
                  	$media_regional_total_paciente = $media_total_paciente;
                  	$media_regional_total_faltosos = $media_total_faltosos;
                  	$media_regional_faltosos_sob_pacientes = $media_faltosos_sob_pacientes;
                  	$media_regional_receita = $media_receita;
                  	$media_regional_despesa = $media_despesa;
                  	$media_regional_lucro = $media_lucro;
                  	$media_regional_media_gasto = $media_media_gasto;
                  	$media_regional_media_lucro = $media_media_lucro;
               
                  
                  	$media_regional_flutuantes = $media_flutuantes;
                  	$media_regional_flutuantes_sob_pacientes = $media_flutuantes_sob_pacientes;
                  	$media_regional_cancelamento_ficha = $media_cancelamento_ficha;
                  	$media_regional_cancelamento_sob_pacientes = $media_cancelamento_sob_pacientes;
                  	$media_regional_suspensoes = $media_suspensoes;
                  	$media_regional_suspensoes_sob_pacientes = $media_suspensoes_sob_pacientes;
                  	$media_regional_custo_dental = $media_custo_dental;
                  	$media_regional_custo_dental_sob_pacientes = $media_custo_dental_sob_pacientes;
                  	$media_regional_total_em_atraso = $media_total_em_atraso;
                  	$media_regional_total_pago = $media_total_pago;
                  	$media_pacientes_mp_regional = $media_pacientes_mp;
                  	$media_orcamentos_mp_regional = $media_orcamentos_mp;
                  	$media_regional_orcamentos_sob_pacientes_mp = $media_orcamentos_sob_pacientes_mp;
                    $media_regional_faltosos_sob_pacientes_mp =	$media_faltosos_sob_pacientes_mp; 
                    $media_faltosos_agendados_mp_regional = $media_faltosos_agendados_mp;
                    $media_faltosos_atendidos_mp_regional = $media_faltosos_atendidos_mp;
                    $media_qtd_falta_ano_regional = $media_qtd_falta_ano;
                    $media_qtd_marcacoes_regional = $media_qtd_marcacoes_ano;
                    $media_indice_falta_regional = $media_indice_falta;
                    $media_total_faltosos_mp_regional = $media_total_faltosos_mp;
                    $media_total_pago_mp_regional = $media_total_pago_mp;
                    $media_total_a_receber_mp_regional = $media_total_a_receber_mp;
                    $media_total_em_atraso_mp_regional = $media_total_em_atraso_mp;
                    $media_faltosos_atendidos_regional = $media_faltosos_atendidos;
                    $media_faltosos_agendados_regional =  $media_faltosos_agendados;
                    $media_documentacao_mp_regional = $media_documentacao_mp;
                    $media_regional_documentacao_sob_pacientes_mp = $media_documentacao_sob_pacientes_mp;
                    $media_inicios_sob_orcamentos_mp_regional = $media_inicios_sob_orcamentos_mp;
                    $media_regional_inicios_sob_pacientes_mp = $media_inicios_sob_pacientes_mp;
                    $media_inicios_mp_regional = $media_inicios_mp;
                    $media_fm_sob_pacientes_mp_regional = $media_fm_sob_pacientes_mp;
                    $media_fm_mp_regional = $media_fm_mp;
                    $media_custo_funcionario_sob_pacientes_mp_regional = $media_custo_funcionario_sob_pacientes_mp;
                    $media_custo_funcionario_mp_regional = $media_custo_funcionario_mp;
                    $media_gasto_dental_sob_pacientes_mp_regional = $media_gasto_dental_sob_pacientes_mp;
                    $media_flutuantes_sob_pacientes_mp_regional = $media_flutuantes_sob_pacientes_mp;
                    $media_cancelamentos_mp_regional = $media_cancelamentos_mp;
                    $media_cancelamentos_sob_pacientes_mp_regional = $media_cancelamentos_sob_pacientes_mp;
                    $media_suspensoes_mp_regional = $media_suspensoes_mp;
                    $media_suspensoes_sob_pacientes_mp_regional = $media_suspensoes_sob_pacientes_mp;
                    $media_gastos_dental_mp_regional = $media_gastos_dental_mp;
                    $media_flutuantes_mp_regional = $media_flutuantes_mp;
					$media_total_em_atraso_parcial_mp_regional = $media_total_em_atraso_parcial_mp;
					$media_total_pago_parcial_mp_regional = $media_total_pago_parcial_mp;
					$media_orcamento_parcial_mp_regional = $media_orcamento_parcial_mp;
					$media_documentacao_parcial_mp_regional = $media_documentacao_parcial_mp;
					$media_inicios_parcial_mp_regional = $media_inicios_parcial_mp;
					$media_fm_parcial_mp_regional = $media_fm_parcial_mp;
					$media_faltosos_parcial_mp_regional = $media_faltosos_parcial_mp;
					$media_faltosos_agendados_parcial_mp_regional = $media_faltosos_agendados_parcial_mp;
					$media_faltosos_atendidos_parcial_mp_regional = $media_faltosos_atendidos_parcial_mp;
					$media_flut_parcial_mp_regional = $media_flut_parcial_mp;
					$media_total_pago_parcial_mp_regional = $media_total_pago_parcial_mp;
					$media_total_em_atraso_parcial_mp_regional = $media_total_em_atraso_parcial_mp;
					$media_indicados_cli_ami_ma_regional = $media_indicados_cli_ami_ma;
					$media_contemplados_cli_ami_ma_regional = $media_contemplados_cli_ami_ma;
					$media_indicados_cli_ami_mp_regional = $media_indicados_cli_ami_mp;
					$media_contemplados_cli_ami_mp_regional = $media_contemplados_cli_ami_mp;
					$media_fm_n_pagantes_ma_regional = $media_fm_n_pagantes_ma;
					$media_fm_pagantes_ma_regional = $media_fm_pagantes_ma;
					$media_nota_fiscal_ma_regional = $media_nota_fiscal_ma;
					$media_nota_fiscal_pmp_regional = $media_nota_fiscal_pmp;
					$media_nota_fiscal_mp_regional = $media_nota_fiscal_mp;
					$media_abandono_trat_ma_regional = $media_abandono_trat_ma;
					$media_indice_abandono_ma_regional = $media_indice_abandono_ma;
					$media_abandono_trat_pmp_regional = $media_abandono_trat_pmp;
					$media_indice_abandono_pmp_regional = $media_indice_abandono_pmp;
					$media_entrada_orto_mp_regional = $media_entrada_orto_mp;
					$media_entrada_orto_ma_regional = $media_entrada_orto_ma;
					$media_total_pago_regional = $media_total_pago;
					$media_total_em_atraso_regional = $media_total_em_atraso;
					$media_indicados_cli_ami_pmp_regional = $media_indicados_cli_ami_pmp;
					$media_contemplados_cli_ami_pmp_regional = $media_contemplados_cli_ami_pmp;
					$porc_media_regional_total_pago = $porc_media_total_pago ;
					$porc_media_total_em_atraso_regional = $porc_media_total_em_atraso ; 
					$media_qtd_falta_ano_regional_pmp = $media_qtd_falta_ano_pmp;
					$media_regional_cancelamento_ficha_pmp = $media_cancelamento_ficha_pmp;
					$media_regional_suspensoes_pmp = $media_suspensoes_pmp;
					$media_regional_custo_dental_pmp = $media_custo_dental_pmp;
					$media_indice_falta_regional_pmp = $media_indice_falta_pmp;
					$media_qtd_falta_ano_regional_pmp = $media_qtd_falta_ano_pmp;
					$media_qtd_marcacoes_regional_mp = $media_qtd_marcacoes_regional;
					$media_indice_falta_regional_mp =  $media_indice_falta_regional;
					$media_qtd_falta_ano_mp_regional = $media_qtd_falta_ano_mp;
					$media_regional_faltosos_age_sob_total_pmp = $media_faltosos_age_sob_total_pmp;
					$media_regional_faltosos_age_sob_total_mp = $media_faltosos_age_sob_total_mp;
					$media_regional_faltosos_ate_sob_total = $media_faltosos_ate_sob_total;
					$media_regional_faltosos_ate_sob_total_mp = $media_faltosos_ate_sob_total_mp;
					$media_regional_faltosos_ate_sob_total_pmp = $media_faltosos_ate_sob_total_pmp;
					$media_regional_faltosos_sob_pacientes_pmp = $media_faltosos_sob_pacientes_pmp;
					$media_permitido_cli_ami_ma_regional = $media_permitido_cli_ami_ma;
					
					
					
                    
                  }?>

				  </tr>

				</tfoot>

				<tbody>
                <?php
			// Faz um loop, passando por todos os resultados encontrados
			while ($row = $resultado->fetch_object()) {
				 ?>
  					<tr class="tooltip-demo">
  						<td style="text-align:right">
                <a target="_blank"	href="detalhado_clinica.php?idclinica=<?php echo $row->idclinica;?>"><?php echo $row->nomefantasia;?></a>
              </td>
				  <td bgcolor="#f1f1f1" ><a href="javascript:popUP('minhaJanela', 'grafico_pacientes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
  						  <div class="alert alert-<?php echo colorPanel($row->total_paciente, $media_total_paciente, $media_regional_total_paciente) ?> tooltip-demo"> 
						     <?php echo $row->total_paciente; ?> 
                          </div>
						  </a>
					  </td>
  						<td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_pacientes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_pac_pmp)) ?>">
  						  <div class="alert alert-<?php echo colorPanel($row->pac_parcial_mp, $media_pacientes_parcial_mp, $media_pacientes_mp_regional) ?> "> <?php echo $row->pac_parcial_mp; ?> </div>
					    </a></td>
					  <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_pacientes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
  						  <div class="alert alert-<?php echo colorPanel($row->total_pac_mes_passado, $media_pacientes_mp, $media_pacientes_mp_regional) ?> "> <?php echo $row->total_pac_mes_passado; ?> </div>
						  </a></td>
  						<td bgcolor="#FFFFFF">
		                  <a href="javascript:popUP('minhaJanela', 'grafico_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
		                    <div class="alert alert-<?php echo colorPanel($row->orc_mesatual, $media_orc_mesatual, $media_regional_orc_mesatual) ?> tooltip-demo ">
		                       <?php echo $row->orc_mesatual; ?>
		                    </div>
		                  </a>
		                </td>

  			  <td bgcolor="#FFFFFF">
               <a href="javascript:popUP('minhaJanela', 'grafico_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                  <div class="alert alert-<?php echo colorPanel($row->orcamentos_sob_pacientes, $media_orcamentos_sob_pacientes, $media_regional_orcamentos_sob_pacientes) ?> tooltip-demo">
                            <?php echo $row->orcamentos_sob_pacientes; ?>%

               </div>
                </a>
              </td>
  			  <td bgcolor="#FFFFFF"  class="tooltip-demo">
                      
             <a href="javascript:popUP('minhaJanela', 'grafico_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')"  data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_ini_orc_pmp)) ?>">
              
               <div class="alert alert-<?php echo colorPanel($row->orc_parcial_mp, $media_orcamento_parcial_mp, $media_orcamento_parcial_mp_regional)?>">
			  	 <?php echo $row->orc_parcial_mp; ?>
             </div>
  			    </a>
              </td>
  			  <td bgcolor="#FFFFFF">
  			    <a href="javascript:popUP('minhaJanela', 'grafico_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
		         <div class="alert alert-<?php echo colorPanel($row->orc_mespassado, $media_orcamentos_mp, $media_orcamentos_mp_regional)?>">
		           <?php echo $row->orc_mespassado; ?>
                </div>
	            </a>			    </td>
  			  <td bgcolor="#FFFFFF">
               <a href="javascript:popUP('minhaJanela', 'grafico_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
  			  <div class="alert alert-<?php echo colorPanel($row->orc_mespassado*100/$row->total_pac_mes_passado, $media_regional_orcamentos_sob_pacientes_mp, $media_orcamentos_sob_pacientes_mp)?>">
  			   <?php echo round($row->orc_mespassado*100/$row->total_pac_mes_passado,2); ?>%
			   </div>
                </a>
				</td>
  			  <td bgcolor="#f1f1f1">
                  <a href="javascript:popUP('minhaJanela', 'grafico_documentacoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                    <div class="alert alert-<?php echo colorPanel($row->documentacao_mes, $media_documentacao_mes, $media_regional_documentacao_mes) ?> tooltip-demo ">
                                  <?php echo $row->documentacao_mes; ?>

                  </div>
                </a>
              </td>

    					           <td bgcolor="#f1f1f1">
                                    <a href="javascript:popUP('minhaJanela', 'grafico_documentacoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanel($row->documentacao_sob_pacientes, $media_documentacao_sob_pacientes, $media_regional_documentacao_sob_pacientes) ?> tooltip-demo">
                           	 <?php echo $row->documentacao_sob_pacientes; ?>%
                            </div>
                            </a>
                        </td>
    					           <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_documentacoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')"  data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_doc_pmp)) ?>">
    					             <div class="alert alert-<?php echo colorPanel($row->doc_parcial_mp, $media_documentacao_parcial_mp, $media_documentacao_parcial_mp_regional)?>"><?php echo round($row->doc_parcial_mp,0); ?></div>
  					             </a></td>
		              <td bgcolor="#f1f1f1">
             <a href="javascript:popUP('minhaJanela', 'grafico_documentacoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
    			<div class="alert alert-<?php echo colorPanel($row->documentacao_mp, $media_documentacao_mp, $media_documentacao_mp_regional)?>">
    			<?php echo round($row->documentacao_mp,0); ?>
    			</div>
              </a>
    		</td>

    		<td bgcolor="#f1f1f1">
             <a href="javascript:popUP('minhaJanela', 'grafico_documentacoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1130,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
    			<div class="alert alert-<?php echo colorPanel($row->documentacao_mp*100/$row->total_pac_mes_passado, $media_documentacao_sob_pacientes_mp, $media_regional_documentacao_sob_pacientes_mp)?>">
    			<?php echo round($row->documentacao_mp*100/$row->total_pac_mes_passado,2); ?>%
    			</div>
              </a>
    		</td>
    		<td>
              <a href="javascript:popUP('minhaJanela', 'grafico_inicios.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                     <div class="alert alert-<?php echo colorPanel($row->ini_mesatual, $media_ini_mesatual, $media_regional_ini_mesatual) ?> tooltip-demo  ">
                       <?php echo $row->ini_mesatual; ?>
                     </div>
              </a>
              </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_inicios.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                              <div class="alert alert-<?php echo colorPanel($row->inicios_sob_pacientes, $media_inicios_sob_pacientes, $media_regional_inicios_sob_pacientes) ?> tooltip-demo">
                              <?php echo $row->inicios_sob_pacientes; ?>%</div>
                            </a>
                          </td>

                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_inicios_sob_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanel($row->inicios_sob_orcamentos, $media_inicios_sob_orcamentos, $media_regional_inicios_sob_orcamentos) ?> tooltip-demo">

                             <?php echo $row->inicios_sob_orcamentos; ?>%

                            </div>
                            </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_inicios.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_ini_orc_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanel($row->ini_parcial_mp, $media_inicios_parcial_mp, $media_inicios_parcial_mp_regional)?>"> <?php echo $row->ini_parcial_mp; ?></div>
                          </a></td>
                          <td>
                            <a href="javascript:popUP('minhaJanela', 'grafico_inicios.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          	<div class="alert alert-<?php echo colorPanel($row->ini_mespassado, $media_inicios_mp, $media_inicios_mp_regional)?>">
                          	<?php echo $row->ini_mespassado; ?>
                          	</div>
                            </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_inicios.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          	<div class="alert alert-<?php echo colorPanel($row->ini_mespassado*100/$row->total_pac_mes_passado, $media_inicios_sob_pacientes_mp, $media_regional_inicios_sob_pacientes_mp)?>">
                          	<?php echo round($row->ini_mespassado*100/$row->total_pac_mes_passado,2); ?>%
                          	</div>
                            </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_inicios_sob_orcamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          	<div class="alert alert-<?php echo colorPanel($row->ini_mespassado*100/$row->orc_mespassado, $media_inicios_sob_orcamentos_mp, $media_inicios_sob_orcamentos_mp_regional)?>">
                               <?php echo round($row->ini_mespassado*100/$row->orc_mespassado,2); ?>%
                            </div>  
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->total_indic_ma, $media_indicados_cli_ami_ma, $media_indicados_cli_ami_ma_regional)?>">
						  <?php echo $row->total_indic_ma; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">  <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->total_permitido, $media_permitido_cli_ami_ma, $media_permitido_cli_ami_ma_regional)?>">
						  <?php echo $row->total_permitido; ?>
                          </div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->total_contemplado_ma, $media_contemplados_cli_ami_ma, $media_contemplados_cli_ami_ma_regional)?>">
						  <?php echo $row->total_contemplado_ma; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          	   <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
	                          <div class="alert alert-<?php echo colorPanel($row->total_indic_pmp, $media_indicados_cli_ami_pmp, $media_indicados_cli_ami_pmp_regional)?>">
	                          <?php echo $row->total_indic_pmp; ?>
	                          </div>
                              </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
                          	<div class="alert alert-<?php echo colorPanel($row->total_contemplado_pmp, $media_contemplados_cli_ami_pmp, $media_contemplados_cli_ami_pmp_regional)?>">
                          	<?php echo $row->total_contemplado_pmp; ?>
                          	</div>
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->total_indic_mp, $media_indicados_cli_ami_mp, $media_indicados_cli_ami_mp_regional)?>">	
                          					  <?php echo $row->total_indic_mp; ?></div>
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cliente_amigo.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cliente_amigo_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->total_contemplado_mp, $media_contemplados_cli_ami_mp, $media_contemplados_cli_ami_mp_regional)?>">
						  <?php echo $row->total_contemplado_mp; ?></div>
                          </a>
                          </td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->fluxo_fm, $media_fm, $media_regional_fm) ?> tooltip-demo"> <?php echo round($row->fluxo_fm,0); ?> </div>
                          </a></td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->fluxo_fm_sob_pacientes, $media_fm_sob_pacientes, $media_regional_fm_sob_pacientes) ?> tooltip-demo"> <?php echo $row->fluxo_fm_sob_pacientes; ?>% </div>
                          </a></td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_fm_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->fm_parcial_mp, $media_fm_parcial_mp, $media_fm_parcial_mp_regional)?>"><?php echo round($row->fm_parcial_mp,0); ?></div>
                          </a></td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->fm_mp, $media_fm_mp, $media_fm_mp_regional)?>"> <?php echo round($row->fm_mp,0); ?> </div>
                          </a></td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->fm_mp*100/$row->total_pac_mes_passado, $media_fm_sob_pacientes_mp, $media_fm_sob_pacientes_mp_regional)?>"> <?php echo round($row->fm_mp*100/$row->total_pac_mes_passado,2); ?>% </div>
                          </a></td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->fmnaopagantes, $media_fm_n_pagantes_ma, $media_fm_n_pagantes_ma_regional)?>">
						  <?php echo $row->fmnaopagantes; ?></div>
                          </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_fm.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->fmpagantes, $media_fm_pagantes_ma, $media_fm_pagantes_ma_regional)?>">
						  <?php echo $row->fmpagantes; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_aproveitamento.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->nota_fiscal_ma, $media_nota_fiscal_ma, $media_nota_fiscal_ma_regional)?>">
						  <?php echo $row->nota_fiscal_ma; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_aproveitamento.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->nota_fiscal_pmp, $media_nota_fiscal_pmp, $media_nota_fiscal_pmp_regional)?>"> <?php echo $row->nota_fiscal_pmp; ?> </div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_aproveitamento.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->nota_fiscal_mp, $media_nota_fiscal_mp , $media_nota_fiscal_mp_regional)?>">
						  <?php echo $row->nota_fiscal_mp; ?>
                          </div>
                          </a>
                          </td>
                          <td>
                            <a href="javascript:popUP('minhaJanela', 'grafico_faltosos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                              <div class="alert alert-<?php echo colorPanelInverso($row->faltosos_sob_pacientes, $media_faltosos_sob_pacientes,$media_regional_faltosos_sob_pacientes) ?> tooltip-demo">
                              <?php echo $row->total_faltosos; ?> <small>(<?php echo $row->faltosos_sob_pacientes; ?>%)</small>  </div>
                            </a>
                          </td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_faltosos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falt_age_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso(($row->falt_total_parcial_mp*100/$row->pac_parcial_mp), $media_faltosos_sob_pacientes_pmp, $media_regional_faltosos_sob_pacientes_pmp)?>"><?php echo $row->falt_total_parcial_mp; ?> <small>(<?php echo  round($row->falt_total_parcial_mp*100/$row->pac_parcial_mp,2); ?>%)</small></div>
                          </a></td>
                          <td> <a href="javascript:popUP('minhaJanela', 'grafico_faltosos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso(($row->total_faltosos_mp*100/$row->total_pac_mes_passado), $media_faltosos_sob_pacientes_mp, $media_regional_faltosos_sob_pacientes_mp)?>"> <?php echo $row->total_faltosos_mp; ?> <small>(<?php echo round($row->total_faltosos_mp*100/$row->total_pac_mes_passado,2); ?>%)</small>  </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_faltosos_agendados.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          	<div class="alert alert-<?php echo colorPanelInverso($row->faltosos_agendados, $media_faltosos_agendados, $media_faltosos_agendados_regional) ?>">
                       	   <?php echo $row->faltosos_agendados; ?> <small>(<?php if (isset($row->total_faltosos)) echo round($row->faltosos_agendados*100/$row->total_faltosos,2); ?>)%</small> </div>
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_faltosos_agendados.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falt_age_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->falt_agend_parcial_mp*100/$row->falt_total_parcial_mp, $media_faltosos_age_sob_total_pmp, $media_regional_faltosos_age_sob_total_pmp)?>"><?php echo $row->falt_agend_parcial_mp; ?> <small>(<?php echo round($row->falt_agend_parcial_mp*100/$row->falt_total_parcial_mp,2); ?>)%</small></div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_faltosos_agendados.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->faltosos_agendados_mp*100/$row->total_faltosos_mp, $media_faltosos_age_sob_total_mp, $media_regional_faltosos_age_sob_total_mp)?>"> 
                          <?php echo $row->faltosos_agendados_mp; ?> <small>(<?php if (isset($row->total_faltosos)) echo round($row->faltosos_agendados_mp*100/$row->total_faltosos_mp,2); ?>)%</small> </div>
                           </a>
                      </td>
                          <td> <a href="javascript:popUP('minhaJanela', 'grafico_faltosos_atendidos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->faltosos_atendidos*100/$row->total_faltosos, $media_faltosos_ate_sob_total, $media_regional_faltosos_ate_sob_total) ?>"> 
                            <?php echo $row->faltosos_atendidos; ?> <small>(<?php  if (isset($row->total_faltosos)) echo round($row->faltosos_atendidos*100/$row->total_faltosos,2); ?>)</small>%</div>
                          <a href="javascript:popUP('minhaJanela', 'grafico_faltosos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')"></td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_faltosos_atendidos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falt_age_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->falt_atend_parcial_mp*100/$row->falt_total_parcial_mp, $media_regional_faltosos_ate_sob_total_pmp, $media_faltosos_ate_sob_total_pmp)?>"><?php echo $row->falt_atend_parcial_mp; ?> <small>(<?php echo round($row->falt_atend_parcial_mp*100/$row->falt_total_parcial_mp,2); ?>)%</small></div>
                          </a></td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_faltosos_atendidos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falt_age_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->faltosos_atendidos_mp*100/$row->total_faltosos_mp, $media_faltosos_ate_sob_total_mp, $media_regional_faltosos_ate_sob_total_mp)?>"> 
                          <small><?php echo $row->faltosos_atendidos_mp; ?> (<?php if (isset($row->total_faltosos))echo round($row->faltosos_atendidos_mp*100/$row->total_faltosos_mp,2); ?>)%</small></div></a></td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_flutuantes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->flutuantes, $media_flutuantes, $media_regional_flutuantes) ?> tooltip-demo"> <?php echo $row->flutuantes; ?> </div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_flutuantes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->flutuantes_sob_pacientes, $media_flutuantes_sob_pacientes, $media_flutuantes_sob_pacientes) ?> tooltip-demo"> <?php echo $row->flutuantes_sob_pacientes; ?>% </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_flutuantes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falt_age_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->flut_parcial_mp, $media_flut_parcial_mp, $media_flut_parcial_mp_regional)?>"><?php echo round($row->flut_parcial_mp,0); ?></div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_flutuantes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->flutuantes_mp, $media_flutuantes_mp, $media_flutuantes_mp_regional)?>"> <?php echo round($row->flutuantes_mp,0); ?> </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_flutuantes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->flutuantes_mp*100/$row->total_pac_mes_passado, $media_flutuantes_sob_pacientes_mp, $media_flutuantes_sob_pacientes_mp_regional)?>"> <?php echo round($row->flutuantes_mp*100/$row->total_pac_mes_passado,2); ?>% </div>
                          </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" >
                          	<div class="alert alert-<?php echo colorPanelInverso($row->qtd_falta_mes, $media_qtd_falta_ano, $media_qtd_falta_ano_regional)?>">
                          	<?php echo $row->qtd_falta_mes; ?>
                          </div>
                          </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" >
                          	<div class="alert alert-<?php echo colorPanel($row->qtd_marcacoes_mes, $media_qtd_marcacoes_ano, $media_qtd_marcacoes_regional)?>">
                          	<?php echo $row->qtd_marcacoes_mes; ?>
                          </div>
                          </a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" >
                          	<div class="alert alert-<?php echo colorPanelInverso($row->indice_falta_pmp, $media_indice_falta_pmp, $media_indice_falta_regional_pmp)?>">
                          	<?php echo $row->indice_falta; ?>%
                          </div>
                          </a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falta_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanelInverso($row->qtd_falta_mes_pmp, $media_qtd_falta_ano_pmp, $media_qtd_falta_ano_regional_pmp)?>"> 
						  <?php echo $row->qtd_falta_mes_pmp; ?> </div></a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falta_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanel($row->qtd_marcacoes_mes, $media_qtd_marcacoes_ano, $media_qtd_marcacoes_regional)?>"> <?php echo $row->qtd_marcacoes_mes_pmp; ?> 
                          
                          </div>
                          </a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_falta_pmp)) ?>">
                          <div class="alert alert-<?php echo colorPanelInverso($row->indice_falta, $media_indice_falta, $media_indice_falta_regional)?>"> 
						  <?php echo $row->indice_falta_pmp; ?>% 
                          </div>
                          </a>
                          </td>
                          <td> <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->qtd_falta_mes_mp, $media_qtd_falta_ano_mp, $media_qtd_falta_ano_mp_regional)?>"> 
						  <?php echo $row->qtd_falta_mes_mp; ?> </div></a></td>
                          <td> <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" >
                          <div class="alert alert-<?php echo colorPanel($row->qtd_marcacoes_mes_mp, $media_qtd_marcacoes_ano_mp, $media_qtd_marcacoes_regional_mp)?>">
                           <?php echo $row->qtd_marcacoes_mes_mp; ?> 
                          
                          </div>
                          </a></td>
                          <td> <a href="javascript:popUP('minhaJanela', 'grafico_indice_faltas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" >
                          <div class="alert alert-<?php echo colorPanelInverso($row->indice_falta_mp, $media_indice_falta_mp, $media_indice_falta_regional_mp)?>"> 
						  <?php echo $row->indice_falta_mp; ?>% 
                          </div>
                          </a></td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_cancelamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->cancelamento_ficha, $media_cancelamento_ficha, $media_regional_cancelamento_ficha) ?> tooltip-demo"> <?php echo round($row->cancelamento_ficha,0); ?> </div>
                          </a></td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_cancelamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->cancelamento_sob_pacientes, $media_cancelamento_sob_pacientes, $media_cancelamento_sob_pacientes) ?> tooltip-demo"> <?php echo $row->cancelamento_sob_pacientes; ?>% </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1"> <a href="javascript:popUP('minhaJanela', 'grafico_cancelamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cancelamento_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->cancelamento_ficha_pmp, $media_cancelamento_ficha_pmp, $media_regional_cancelamento_ficha_pmp) ?> tooltip-demo"> 
						  <?php echo round($row->cancelamento_ficha_pmp,0); ?></div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cancelamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->cancelamento_ficha_mp, $media_cancelamentos_mp, $media_cancelamentos_mp_regional)?>"> <?php echo round($row->cancelamento_ficha_mp,0); ?> </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_cancelamentos.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->cancelamento_ficha_mp*100/$row->total_pac_mes_passado, $media_cancelamentos_sob_pacientes_mp, $media_cancelamentos_sob_pacientes_mp_regional)?>"> <?php echo round($row->cancelamento_ficha_mp*100/$row->total_pac_mes_passado,2); ?>% 
                          </div>
                          </a>
                          </td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_suspensoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->suspensoes, $media_suspensoes, $media_regional_suspensoes) ?> tooltip-demo"> <?php echo $row->suspensoes; ?> </div>
                          </a></td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_suspensoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->suspensoes_sob_pacientes, $media_suspensoes_sob_pacientes, $media_regional_suspensoes_sob_pacientes) ?> tooltip-demo"> <?php echo $row->suspensoes_sob_pacientes; ?>% 
                          </div>
                          </a>
                          </td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_suspensoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=240,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_cancelamento_pmp)) ?>">
                            <div class="alert alert-<?php echo colorPanelInverso($row->suspensoes_pmp, $media_suspensoes_pmp, $media_regional_suspensoes_pmp) ?> tooltip-demo"> <?php echo $row->suspensoes_pmp; ?></div>
                          </a></td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_suspensoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->suspensoes_mp, $media_suspensoes_mp, $media_suspensoes_mp_regional)?>"> <?php echo round($row->suspensoes_mp,0); ?> 
                          </div>
                          </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_suspensoes.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->suspensoes_mp*100/$row->total_pac_mes_passado, $media_suspensoes_sob_pacientes_mp, $media_suspensoes_sob_pacientes_mp_regional)?>"> 
						  <?php echo round($row->suspensoes_mp*100/$row->total_pac_mes_passado,2); ?>% 
                          </div></a></td>
                          <td bgcolor="#f1f1f1">
                           <a href="javascript:popUP('minhaJanela', 'grafico_abandono.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->abandono_trat, $media_abandono_trat_ma, $media_abandono_trat_ma_regional)?>"> 
						  <?php echo $row->abandono_trat; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_abandono.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->indice_abandono, $media_indice_abandono_ma, $media_indice_abandono_ma_regional)?>"> 
						  <?php echo $row->indice_abandono; ?>
                          %</div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_abandono.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->abandono_trat_pmp, $media_abandono_trat_pmp, $media_abandono_trat_pmp_regional)?>"> 
						  <?php echo $row->abandono_trat_pmp; ?>
                          </div>
                          </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_abandono.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->indice_abandono_pmp, $media_indice_abandono_pmp, $media_indice_abandono_pmp_regional)?>"> 
						  <?php echo $row->indice_abandono_pmp; ?>
                          
                          %</div>
                          </a>
                          </td>
                          <td>
                             <a href="javascript:popUP('minhaJanela', 'grafico_receitas_despesas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                                <div class="alert alert-<?php echo colorPanel($row->receita, $media_receita, $media_regional_receita) ?> tooltip-demo">
                                                        <?php echo  $row->receita; ?>
                                </div>
                             </a>
                          </td>
                          <td>
                             <a href="javascript:popUP('minhaJanela', 'grafico_receitas_despesas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                                <div class="alert alert-<?php echo colorPanelInverso($row->despesa, $media_despesa, $media_regional_despesa) ?>">
                                                                                <?php echo  $row->despesa ; ?>
                                </div>
                            </a>
                          </td>
                          <td>
                            <a href="javascript:popUP('minhaJanela', 'grafico_receitas_despesas.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                              <div class="alert alert-<?php echo colorPanel($row->lucro, $media_lucro, $media_regional_lucro) ?>">
                                                                              <?php echo  $row->lucro; ?>
                              </div>
                            </a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_entrada_orto.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->orto_mp, $media_entrada_orto_mp, $media_entrada_orto_mp_regional) ?>"> <?php echo round($row->orto_atual); ?> </div>
                          </a>
                          </td>
                          <td>
                           <a href="javascript:popUP('minhaJanela', 'grafico_entrada_orto.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanel($row->orto_atual, $media_entrada_orto_ma, $media_entrada_orto_ma_regional) ?>"> <?php echo round($row->orto_mp); ?> </div></a></td>
                          <td bgcolor="#f1f1f1">
                          <a href="javascript:popUP('minhaJanela', 'grafico_custo_paciente.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->media_gasto, $media_media_gasto, $media_regional_media_gasto) ?>">
                              <?php echo $row->media_gasto; ?>
                            </div>
                            </a>
                          </td>

                          <td bgcolor="#f1f1f1">
                             <a href="javascript:popUP('minhaJanela', 'grafico_custo_paciente.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanel($row->media_lucro, $media_media_lucro, $media_regional_media_lucro) ?>">
                                                      <?php echo $row->media_lucro; ?>
                            </div>
                            </a>
                          </td>
                          <td>
                          <a href="javascript:popUP('minhaJanela', 'grafico_custo_funcionario.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alet alert-<?php echo colorPanelInverso($row->custo_funcionario_mp, $media_custo_funcionario_mp, $media_custo_funcionario_mp_regional)?>">
                              <?php echo $row->custo_funcionario_mp; ?>
                            </div>  </a>                        </td>
                          <td>
                             <a href="javascript:popUP('minhaJanela', 'grafico_custo_funcionario.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alet alert-<?php echo colorPanelInverso($row->custo_funcionario_mp/$row->total_pac_mes_passado, $media_custo_funcionario_sob_pacientes_mp, $media_custo_funcionario_sob_pacientes_mp_regional)?>">
                          	<?php echo round($row->custo_funcionario_mp/$row->total_pac_mes_passado,2); ?></div></a>
                          </td>
                          <td bgcolor="#f1f1f1">
                             <a href="javascript:popUP('minhaJanela', 'grafico_gasto_dental.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                                <div class="alert alert-<?php echo colorPanelInverso($row->custo_dental, $media_custo_dental, $media_regional_custo_dental) ?> tooltip-demo">
                                <?php echo $row->custo_dental; ?>
                               </div>
                             </a>
                          </td>

                          <td bgcolor="#f1f1f1">
                            <a href="javascript:popUP('minhaJanela', 'grafico_gasto_dental.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->custo_dental_sob_pacientes, $media_custo_dental_sob_pacientes, $media_regional_custo_dental_sob_pacientes) ?> tooltip-demo">
             			  <div data-toggle="tooltip" data-placement="top" title="Mês Passado <?php echo round($row->custo_dental_mp/$row->total_pac_mes_passado,2); ?>%" > 
                             <?php echo $row->custo_dental_sob_pacientes; ?></div>
                            </div>
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1"><a href="javascript:popUP('minhaJanela', 'grafico_gasto_dental.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                            <div class="alert alert-<?php echo colorPanelInverso($row->custo_dental_pmp, $media_custo_dental_pmp, $media_regional_custo_dental_pmp) ?> tooltip-demo"> <?php echo $row->custo_dental_pmp; ?> </div>
                          </a></td>
                          <td bgcolor="#f1f1f1">
                            <a href="javascript:popUP('minhaJanela', 'grafico_gasto_dental.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                           <div class="alert alert-<?php echo colorPanelInverso($row->custo_dental_mp, $media_gastos_dental_mp, $media_gastos_dental_mp_regional)?>">
                          	<?php echo round($row->custo_dental_mp,0); ?>
                          	</div>
                            </a>
                          </td>
                          <td bgcolor="#f1f1f1">
                            <a href="javascript:popUP('minhaJanela', 'grafico_gasto_dental.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                          <div class="alert alert-<?php echo colorPanelInverso($row->custo_dental_mp/$row->total_pac_mes_passado, $media_gasto_dental_sob_pacientes_mp, $media_gasto_dental_sob_pacientes_mp_regional) ?>">
                          	<?php echo round($row->custo_dental_mp/$row->total_pac_mes_passado,2); ?></div>	
                            </a>
                          </td>
                          <td><a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')"> 
                          <?php if (($row->total_pago+$row->total_em_atraso) > 0) $porc_total_pago = round($row->total_pago*100/($row->total_pago+$row->total_em_atraso),2) ;?>
                          <div class="alert alert-<?php echo colorPanel($porc_total_pago, $porc_media_total_pago, $porc_media_regional_total_pago) ?> tooltip-demo">
                            <?php echo  round($row->total_pago);?> <small>  (<?php  if (isset($row->total_pago_mp)) echo $porc_total_pago; ?>%)</small></div>
                          </a></td>

                         <td>
                             <a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                             
                             <?php if (($row->total_pago+$row->total_em_atraso) > 0) $porc_total_em_atraso = round($row->total_em_atraso*100/($row->total_pago+$row->total_em_atraso),2) ;?>
                          <div class="alert alert-<?php echo colorPanelInverso($porc_total_em_atraso, $porc_media_total_em_atraso, $porc_media_total_em_atraso_regional) ?> tooltip-demo">
                                 <?php echo round($row->total_em_atraso); ?>  <small>
                             (<?php if (isset($row->total_pago_mp)) echo  round($row->total_em_atraso*100/($row->total_pago+$row->total_em_atraso)) ; ?>%)</small>
                           </div>      
                           </a>
                          
                          </span></td>
                         <td><a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_neg_pmp)) ?>">
                         
                         <?php
                          if ($row->total_pago_parcial_mp>0)
                          $porc_total_pago_pmp = round($row->total_pago_parcial_mp*100/($row->total_pago_parcial_mp+$row->total_em_atraso_parcial_mp),2);
                          else $porc_total_pago_pmp = 0;
                         $porc_media_total_pago_pmp = round($media_total_pago_parcial_mp *100/($media_total_pago_parcial_mp +$media_total_em_atraso_parcial_mp),2);
						 $porc_media_regional_total_pago_pmp = round($media_total_pago_parcial_mp_regional *100/($media_total_pago_parcial_mp_regional+$media_total_em_atraso_parcial_mp_regional),2) ;?>
						 
                           <div class="alert alert-<?php echo colorPanel($porc_total_pago_pmp, $porc_media_total_pago_pmp, $porc_media_regional_total_pago_pmp) ?>">
                             <?php if (isset($row->total_pago_mp)) echo round($row->total_pago_parcial_mp,0); ?>
                             <span class=" tooltip-demo"><small> (
                               <?php  if ((isset($row->total_pago_mp)) && ($row->total_pago_parcial_mp>0)) echo  round($row->total_pago_parcial_mp*100/($row->total_pago_parcial_mp+$row->total_em_atraso_parcial_mp)) ; ?>
                               %)</small></span></div>
                         </a></td>
                         <td><a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')" data-toggle="tooltip" data-placement="top" title="<?php  echo date('d/m/Y', strtotime($row->data_neg_pmp)) ?>">
                            <?php
                            if ($row->total_pago_parcial_mp>0)
                            $porc_total_em_atraso_pmp = round($row->total_em_atraso_parcial_mp*100/($row->total_pago_parcial_mp+$row->total_em_atraso_parcial_mp),2);
                            else $porc_total_em_atraso_pmp = 0;
                         $porc_media_total_em_atraso_pmp = round($media_total_em_atraso_parcial_mp *100/($media_total_pago_parcial_mp +$media_total_em_atraso_parcial_mp),2);
						 $porc_media_regional_total_em_atraso_pmp = round($media_total_em_atraso_parcial_mp_regional *100/($media_total_pago_parcial_mp_regional+$media_total_em_atraso_parcial_mp_regional),2) ;?>
                         
                           <div class="alert alert-<?php echo colorPanelInverso($porc_total_em_atraso_pmp, $porc_media_total_em_atraso_pmp, $porc_media_regional_total_em_atraso_pmp) ?>">
                             <?php if (isset($row->total_pago_mp)) echo round($row->total_em_atraso_parcial_mp,0); ?>
                             <small> (
                               <?php if ( (isset($row->total_em_atraso_mp)) && ($row->total_em_atraso_parcial_mp>0))
                              echo  round($row->total_em_atraso_parcial_mp*100/($row->total_pago_parcial_mp+$row->total_em_atraso_parcial_mp)) ; ?>
                               %)</small> </div></td>
                         <td>      
                          <?php 
                          if ($row->total_pago_parcial_mp>0)
                          $porc_total_pago_mp = round($row->total_pago_mp*100/($row->total_pago_mp+$row->total_em_atraso_mp),2);
                          else  $porc_total_pago_mp = 0;
                         $porc_media_total_pago_mp = round($media_total_pago_mp *100/($media_total_pago_mp +$media_total_em_atraso_mp),2);
						 $porc_media_regional_total_pago_mp = round($media_total_pago_mp_regional *100/($media_total_pago_mp_regional+$media_total_em_atraso_mp_regional),2) ;?>
                           <a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">                  
                         <div class="alert alert-<?php echo colorPanel($porc_total_pago_mp, $porc_media_total_pago_mp, $porc_media_regional_total_pago_mp) ?> tooltip-demo">
                           <?php if (isset($row->total_pago_mp)) echo round($row->total_pago_mp,0); ?>
                           <small>
                           (<?php  if (isset($row->total_pago_mp)) echo  round($row->total_pago_mp*100/($row->total_pago_mp+$row->total_em_atraso_mp)) ; ?>%)</small>
                         </div></a></td>
                         <td>
                   <?php
                   if ($row->total_em_atraso_mp>0)
                       $porc_total_em_atraso_mp = round($row->total_em_atraso_mp*100/($row->total_pago_mp+$row->total_em_atraso_mp),2);
                   else $porc_total_em_atraso_mp = 0;
                         $porc_media_total_em_atraso_mp = round($media_total_em_atraso_mp *100/($media_total_pago_mp +$media_total_em_atraso_mp),2);
						 $porc_media_regional_total_em_atraso_mp = round($media_total_em_atraso_mp_regional *100/($media_total_pago_mp_regional+$media_total_em_atraso_mp_regional),2) ;?>
                       	      <a href="javascript:popUP('minhaJanela', 'grafico_negociacao.php?idclinica=<?php echo $row->idclinica;?>', 'width=1100,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,titlebar=no,location=no')">
                           <div class="alert alert-<?php echo colorPanelInverso($porc_total_em_atraso_mp, $porc_media_total_em_atraso_mp, $porc_media_regional_total_em_atraso_mp) ?>">
                          	<?php if (isset($row->total_em_atraso_mp)) echo round($row->total_em_atraso_mp,0); ?>
                        <span class=" tooltip-demo"><small>
                            (<?php if (isset($row->total_pago_mp)) echo  round($row->total_em_atraso_mp*100/($row->total_pago_mp+$row->total_em_atraso_mp)) ; ?>%)</small>
                           </span></div></a>
                      </td>
                          <?php } ?>
  					</tr>
				</tbody>
</table>
</body>
            </html>
<?php
}
else
{
?>

<table style="position:relative; top:120px; left:-690px">
  <tr>
    <td colspan="4" style="text-align: center; padding:5px; background-color:#FFD2D2;">
       <p>Sua busca não encontrou nenhum resultado :(</p>
    </td>
   </tr>
</table>
<?php
}
?>