<?php
error_reporting(E_ALL);

require_once('../includes/mysqli.php');
$idsocio = $_GET['idSocio'];
$idadm = $_GET['adm'];

$estado = $_GET['uf'];
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
if ($idsocio  != "Todos") {
	include ('../includes/querie_socio_old.php');
}
else {
	include ('../includes/querie_lista_nacional_estados_old.php');
}
//buscando a media nacional
include ('../includes/querie_soma_nacional_old.php');
//fazendo a listagem das clinicas nacional ou regional
if (($estado!="Nacional") && (strlen($estado) < 3))  {

	include ('../includes/querie_soma_estado_old.php');
}
$resultado = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
$resultado_soma = $MySQLi->query($sqlMediaNacional) OR trigger_error($MySQLi->error, E_USER_ERROR);

  if (mysqli_num_rows($resultado) > "0")
    {
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

	div.ColVis {
		float: left;
	}
    .coluna_par {
    background: none repeat scroll 0 0 #fafcf4;
    text-align: center;
    }
    .coluna_impar {
    background: none repeat scroll 0 0 #f4f9fc;
    text-align: center;
    }
	</style>
	 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.colVis.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.fixedColumns.js"></script>
	<script type="text/javascript" language="javascript" src="../js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../js/demo.js"></script>
 
	<script type="text/javascript" language="javascript" class="init">
		jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "currency-pre": function (a) {
        a = (a === "-") ? 0 : a.replace(/[^\d\-\,]/g, "");
        return parseFloat(a);
	    },
	    "currency-asc": function (a, b) {
	        return a - b;
	    },
	    "currency-desc": function (a, b) {
	        return b - a;
	    }
	});

		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				dom:            "Cfrtip",
				scrollY:        "500px",
				scrollX:        true,
				scrollCollapse: true,

				paging:         false,
				columnDefs: [
					{ width: 160, targets: 0 },
					{ "type": "currency", targets:[42,43,44,45,46] }

				]
			} );




			new $.fn.dataTable.FixedColumns( table, {
				leftColumns: 1
			} );
		} );

		// add sorting methods for currency columns


/*// initialize datatable and explicitly set the column type to "currency"
$('#example2').dataTable({
    "aoColumns": [{"sType": "currency"}],
    "aaSorting": [[0, "desc"]],
    "bStateSave": false,
    "iDisplayLength": 50,
});*/


	</script>
</head>
<body>

<table id="example2" class="stripe row-border order-column" cellspacing="0" width="100%">
				<thead bgcolor="f1f1f1">
					<tr>
						<th rowspan="2" bgcolor="#f1f1f1">Clínica</th>
                        <th colspan="4" class="coluna_impar">Agendados</th>
                        <th colspan="4" class="coluna_par">Atendidos</th>
                        <th colspan="2" class="coluna_impar">Fluxo FM</th>
                        <th colspan="2" class="coluna_par">Flutuantes</th>
                        <th colspan="2" class="coluna_impar">Documentação</th>
                        <th colspan="3" class="coluna_par">Inícios</th>
                        <th colspan="3" class="coluna_impar">Orçamentos</th>
                        <th colspan="3" class="coluna_par">Tratamento Assíduos</th>
                        <th colspan="6" class="coluna_impar">Assíduos x Faltosos</th>
                        <th colspan="2" class="coluna_par">Tratamento Faltosos</th>
                        <th colspan="6" class="coluna_impar">Envelhecimento Clínica</th>
                        <th colspan="2" class="coluna_par">Custo Paciente</th>
                        <th colspan="2" class="coluna_impar">Fluxo Paciente</th>
                        <th colspan="3" class="coluna_par">Negociação</th>
                        <th colspan="3" class="coluna_impar">Receitas x Despesas</th>
					</tr>
					<tr>
					 <th style="background-color:#f4f9fc">Assíduos</th>
                      <th style="background-color:#f4f9fc">Total</th>
                      <th style="background-color:#f4f9fc">Faltosos</th>
                      <th style="background-color:#f4f9fc">Total</th>
                      <th style="background-color:#fafcf4"> Assíduos</th>
                      <th style="background-color:#fafcf4">Total</th>
                      <th style="background-color:#fafcf4">Faltosos</th>
                      <th style="background-color:#fafcf4">Total</th>
                      <th style="background-color:#f4f9fc">Mês Anterior</th>
                      <th style="background-color:#f4f9fc">Mês Atual</th>
                      <th style="background-color:#fafcf4">Quantidade</th>
                      <th style="background-color:#fafcf4">%Flutuantes</th>
                      <th style="background-color:#f4f9fc">Mês</th>
                      <th style="background-color:#f4f9fc">Total</th>
                      <th style="background-color:#fafcf4">Mês Atual</th>
                      <th style="background-color:#fafcf4">Mês Anterior</th>
                      <th style="background-color:#fafcf4">Total</th>
                      <th style="background-color:#f4f9fc">Mês Atual</th>
                      <th style="background-color:#f4f9fc">Mês Anterior</th>
                      <th style="background-color:#f4f9fc">Total</th>
                      <th style="background-color:#fafcf4">Agendados</th>
                      <th style="background-color:#fafcf4">Atendidos</th>
                      <th style="background-color:#fafcf4">Flutuantes</th>
                      <th style="background-color:#f4f9fc">Faltosos</th>
                      <th style="background-color:#f4f9fc">Flutuantes</th>
                      <th style="background-color:#f4f9fc">Total Faltosos</th>
                      <th style="background-color:#f4f9fc">Não Irá Receber</th>
                      <th style="background-color:#f4f9fc">%Assíduos</th>
                      <th style="background-color:#f4f9fc">%Faltosos</th>
                      <th style="background-color:#fafcf4">Faltosos Agendados</th>
                      <th style="background-color:#fafcf4">Faltosos Ñ Agendados</th>
                      <th style="background-color:#f4f9fc">0-1</th>
                      <th style="background-color:#f4f9fc">1-2</th>
                      <th style="background-color:#f4f9fc">2-3</th>
                      <th style="background-color:#f4f9fc">3-4</th>
                      <th style="background-color:#f4f9fc">+4</th>
                      <th style="background-color:#f4f9fc">Total</th>
                      <th style="background-color:#fafcf4">Mês Gasto</th>
                      <th style="background-color:#fafcf4">Mês Lucro</th>
                      <th style="background-color:#f4f9fc">Mês Retrasado</th>
                      <th style="background-color:#f4f9fc">Mês Passado</th>
                      <th style="background-color:#fafcf4">Total a Receber</th>
                      <th style="background-color:#fafcf4">Total em Atraso</th>
                      <th style="background-color:#fafcf4">Total Pago</th>
                      <th style="background-color:#f4f9fc">Receita</th>
                      <th style="background-color:#f4f9fc">Despesa</th>
                      <th style="background-color:#f4f9fc">Lucro</th>
                  </tr>
				</thead>
				<tfoot>

                      <?php
                      if (($estado!="Nacional") && (strlen($estado) < 3)){
                      	//pegando numero de registros da regional
                      		$sql_num_rows_regional = "  SELECT nomefantasia FROM ap_clinicas WHERE estado = '$estado' and tipoclinica = 'F' and Ativo = 'Sim' ";
                      		$resultado_regional = $MySQLi->query($sql_num_rows_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);
                      		$num_rows_regional = mysqli_num_rows($resultado_regional);

						// Faz um loop, passando por todos os resultados encontrados
						while ($row_soma_regional = $resultado_soma_regional->fetch_object()) {
							 ?>
                   <tr>

                    <th bgcolor="#f1f1f1"> Média Regional </th>
                      <th><?php echo $media_regional_assiduos_a1 = round(($row_soma_regional->assiduos_a1)/$num_rows_regional) ; ?> </th>
					  <th><?php echo $media_regional_assiduos_a2 = round($row_soma_regional->assiduos_a2/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_faltosos_b1 = round($row_soma_regional->faltosos_b1/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_faltosos_b2 = round($row_soma_regional->faltosos_b2/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_assiduos_c1 = round($row_soma_regional->assiduos_c1/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_assiduos_c2 = round($row_soma_regional->assiduos_c2/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_faltosos_d1 = round($row_soma_regional->faltosos_d1/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_faltosos_d2 = round($row_soma_regional->faltosos_d2/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_fm_mes_passado = round($row_soma_regional->fm_mes_passado/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_fm_mes_atual = round($row_soma_regional->fm_mes_atual/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_qtd_flutuantes = round($row_soma_regional->qtd_flutuantes/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_porc_flutuantes = round($row_soma_regional->porc_flutuantes/$num_rows_regional);?>%</th>
					  <th><?php echo $media_regional_documentacao_mes = round($row_soma_regional->documentacao_mes/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_documentacao_total = round($row_soma_regional->documentacao_total/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_inicio_mes = round($row_soma_regional->inicio_mes/$num_rows_regional); ?></th>
					  <th><?php echo $media_regional_ini_mespassado = round($row_soma_regional->ini_mespassado/$num_rows_regional);?></th>
                      <th><?php echo $media_regional_inicio_total = round($row_soma_regional->inicio_total/$num_rows_regional);?></th>
                      <th><?php echo $media_regional_orc_mesatual = round($row_soma_regional->orc_mesatual/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_orc_mespassado = round($row_soma_regional->orc_mespassado/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_orcamento_total = round($row_soma_regional->orcamento_total/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_agendados = round($row_soma_regional->agendados/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_atendidos = round($row_soma_regional->atendidos/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_lflutuantes = round($row_soma_regional->lflutuantes/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_faltosos = round($row_soma_regional->faltosos/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_mflutuantes = round($row_soma_regional->mflutuantes/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_total_faltosos = round($row_soma_regional->total_faltosos/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_nao_ira_receber = round($row_soma_regional->nao_ira_receber/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_porc_assiduos = round($row_soma_regional->porc_assiduos/$num_rows_regional);?>%</th>
					  <th><?php echo $media_regional_porc_faltosos = round($row_soma_regional->porc_faltosos/$num_rows_regional);?>%</th>
					  <th><?php echo $media_regional_faltosos_agendados = round($row_soma_regional->faltosos_agendados/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_faltosos_nao_agendados = round($row_soma_regional->faltosos_nao_agendados/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_zero_um = round($row_soma_regional->zero_um/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_um_dois = round($row_soma_regional->um_dois/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_dois_tres = round($row_soma_regional->dois_tres/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_tres_quatro = round($row_soma_regional->tres_quatro/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_acima_4 = round($row_soma_regional->acima_4/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_total_geral = round($row_soma_regional->total_geral/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_media_gasto = round($row_soma_regional->media_gasto/$num_rows_regional);?>%</th>
					  <th><?php echo $media_regional_media_lucro = round($row_soma_regional->media_lucro/$num_rows_regional);?>%</th>
					  <th><?php echo $media_regional_total_pac_mes_retrasado = round($row_soma_regional->total_pac_mes_retrasado/$num_rows_regional);?></th>
					  <th><?php echo $media_regional_total_pac_mes_passado = round($row_soma_regional->total_pac_mes_passado/$num_rows_regional);?></th>
					  <th><?php  $media_regional_total_a_receber = round($row_soma_regional->total_a_receber/$num_rows_regional);  echo 'R$' . number_format( $media_regional_total_a_receber  , 2, ',', '.');?></th>
					  <th><?php  $media_regional_total_em_atraso = round($row_soma_regional->total_em_atraso/$num_rows_regional);  echo 'R$' . number_format( $media_regional_total_em_atraso  , 2, ',', '.');?></th>
					  <th><?php  $media_regional_total_pago = round($row_soma_regional->total_pago/$num_rows_regional); echo 'R$' . number_format( $media_regional_total_pago  , 2, ',', '.');?></th>
					  <th><?php  $media_regional_receita = round($row_soma_regional->receita/$num_rows_regional); echo 'R$' . number_format( $media_regional_receita  , 2, ',', '.');?></th>
					  <th><?php  $media_regional_despesa = round($row_soma_regional->despesa/$num_rows_regional); echo 'R$' . number_format( $media_regional_despesa  , 2, ',', '.');?></th>
					  <th><?php  $media_regional_lucro = round($row_soma_regional->lucro/$num_rows_regional); echo 'R$' . number_format( $media_regional_lucro  , 2, ',', '.');?></th>
                  </tr>
                  <?php } } ?>

					<tr align="center">
					  <th bgcolor="#f1f1f1">Média Nacional</th>
					   <?php
					   $sql_num_rows_nacional = "  SELECT nomefantasia FROM ap_clinicas WHERE tipoclinica = 'F' and Ativo = 'Sim' ";
					   $resultado_nacional = $MySQLi->query($sql_num_rows_nacional) OR trigger_error($MySQLi->error, E_USER_ERROR);
					   $num_rows = mysqli_num_rows($resultado_nacional);

						// Faz um loop, passando por todos os resultados encontrados
						while ($row_soma = $resultado_soma->fetch_object()) {
							 ?>

					  <th><?php echo $media_assiduos_a1 = round(($row_soma->assiduos_a1)/$num_rows) ; ?> </th>
					  <th><?php echo $media_assiduos_a2 = round($row_soma->assiduos_a2/$num_rows); ?></th>
					  <th><?php echo $media_faltosos_b1 = round($row_soma->faltosos_b1/$num_rows); ?></th>
					  <th><?php echo $media_faltosos_b2 = round($row_soma->faltosos_b2/$num_rows); ?></th>
					  <th><?php echo $media_assiduos_c1 = round($row_soma->assiduos_c1/$num_rows); ?></th>
					  <th><?php echo $media_assiduos_c2 = round($row_soma->assiduos_c2/$num_rows); ?></th>
					  <th><?php echo $media_faltosos_d1 = round($row_soma->faltosos_d1/$num_rows); ?></th>
					  <th><?php echo $media_faltosos_d2 = round($row_soma->faltosos_d2/$num_rows); ?></th>
					  <th><?php echo $media_fm_mes_passado = round($row_soma->fm_mes_passado/$num_rows); ?></th>
					  <th><?php echo $media_fm_mes_atual = round($row_soma->fm_mes_atual/$num_rows); ?></th>
					  <th><?php echo $media_qtd_flutuantes = round($row_soma->qtd_flutuantes/$num_rows); ?></th>
					  <th><?php echo $media_porc_flutuantes = round($row_soma->porc_flutuantes/$num_rows);?>%</th>
					  <th><?php echo $media_documentacao_mes = round($row_soma->documentacao_mes/$num_rows); ?></th>
					  <th><?php echo $media_documentacao_total = round($row_soma->documentacao_total/$num_rows); ?></th>
					  <th><?php echo $media_inicio_mes = round($row_soma->inicio_mes/$num_rows); ?></th>
					  <th><?php echo $media_ini_mespassado = round($row_soma->ini_mespassado/$num_rows);?></th>
                      <th><?php echo $media_inicio_total = round($row_soma->inicio_total/$num_rows);?></th>
                      <th><?php echo $media_orc_mesatual = round($row_soma->orc_mesatual/$num_rows);?></th>
					  <th><?php echo $media_orc_mespassado = round($row_soma->orc_mespassado/$num_rows);?></th>
					  <th><?php echo $media_orcamento_total = round($row_soma->orcamento_total/$num_rows);?></th>
					  <th><?php echo $media_agendados = round($row_soma->agendados/$num_rows);?></th>
					  <th><?php echo $media_atendidos = round($row_soma->atendidos/$num_rows);?></th>
					  <th><?php echo $media_lflutuantes = round($row_soma->lflutuantes/$num_rows);?></th>
					  <th><?php echo $media_faltosos = round($row_soma->faltosos/$num_rows);?></th>
					  <th><?php echo $media_mflutuantes = round($row_soma->mflutuantes/$num_rows);?></th>
					  <th><?php echo $media_total_faltosos = round($row_soma->total_faltosos/$num_rows);?></th>
					  <th><?php echo $media_nao_ira_receber = round($row_soma->nao_ira_receber/$num_rows);?></th>
					  <th><?php echo $media_porc_assiduos = round($row_soma->porc_assiduos/$num_rows);?>%</th>
					  <th><?php echo $media_porc_faltosos = round($row_soma->porc_faltosos/$num_rows);?>%</th>
					  <th><?php echo $media_faltosos_agendados = round($row_soma->faltosos_agendados/$num_rows);?></th>
					  <th><?php echo $media_faltosos_nao_agendados = round($row_soma->faltosos_nao_agendados/$num_rows);?></th>
					  <th><?php echo $media_zero_um = round($row_soma->zero_um/$num_rows);?></th>
					  <th><?php echo $media_um_dois = round($row_soma->um_dois/$num_rows);?></th>
					  <th><?php echo $media_dois_tres = round($row_soma->dois_tres/$num_rows);?></th>
					  <th><?php echo $media_tres_quatro = round($row_soma->tres_quatro/$num_rows);?></th>
					  <th><?php echo $media_acima_4 = round($row_soma->acima_4/$num_rows);?></th>
					  <th><?php echo $media_total_geral = round($row_soma->total_geral/$num_rows);?></th>
					  <th><?php echo $media_media_gasto = round($row_soma->media_gasto/$num_rows);?>%</th>
					  <th><?php echo $media_media_lucro = round($row_soma->media_lucro/$num_rows);?>%</th>
					  <th><?php echo $media_total_pac_mes_retrasado = round($row_soma->total_pac_mes_retrasado/$num_rows);?></th>
					  <th><?php echo $media_total_pac_mes_passado = round($row_soma->total_pac_mes_passado/$num_rows);?></th>
					  <th><?php  $media_total_a_receber = round($row_soma->total_a_receber/$num_rows); echo 'R$' . number_format( $media_total_a_receber  , 2, ',', '.');?></th>
					  <th><?php  $media_total_em_atraso = round($row_soma->total_em_atraso/$num_rows);echo 'R$' . number_format( $media_total_em_atraso  , 2, ',', '.') ?></th>
					  <th><?php  $media_total_pago = round($row_soma->total_pago/$num_rows);echo 'R$' . number_format( $media_total_pago  , 2, ',', '.') ?></th>
					  <th><?php  $media_receita = round($row_soma->receita/$num_rows); echo 'R$' . number_format( $media_receita  , 2, ',', '.') ?></th>
					  <th><?php  $media_despesa = round($row_soma->despesa/$num_rows);echo 'R$' . number_format( $media_despesa  , 2, ',', '.') ?></th>
					  <th><?php  $media_lucro = round($row_soma->lucro/$num_rows); echo 'R$' . number_format( $media_lucro  , 2, ',', '.')?></th>
					  <?php } ?>
				  </tr>

				</tfoot>

				<tbody>
                <?php
			// Faz um loop, passando por todos os resultados encontrados
			while ($row = $resultado->fetch_object()) {
				 ?>
					<tr >
						<td style="text-align:right"><a target="_blank"	href="index.php?idclinica=<?php echo $row->idclinica;?>"><?php echo $row->nomefantasia;?></a></td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_assiduos_a1)) $media_regional_assiduos_a1 = $media_assiduos_a1;
								if (($row->assiduos_a1 > $media_regional_assiduos_a1) | ($row->assiduos_a1 > $media_assiduos_a1)) $color = 'warning';
								if (($row->assiduos_a1 > $media_assiduos_a1) && ($row->assiduos_a1 >= $media_regional_assiduos_a1)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->assiduos_a1; ?>
                            </div>
                        </td>

                      	<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_assiduos_a2)) $media_regional_assiduos_a2 = $media_assiduos_a2;
								if (($row->assiduos_a2 > $media_regional_assiduos_a2) | ($row->assiduos_a1 > $media_assiduos_a2)) $color = 'warning';
								if (($row->assiduos_a2 > $media_assiduos_a2) && ($row->assiduos_a2 >= $media_regional_assiduos_a2)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->assiduos_a2; ?>
                            </div>
                        </td>


                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_b1)) $media_regional_faltosos_b1 = $media_faltosos_b1;
								if (($row->faltosos_b1 < $media_regional_faltosos_b1) | ($row->faltosos_b1 < $media_faltosos_b1)) $color = 'warning';
								if (($row->faltosos_b1 < $media_faltosos_b1) && ($row->faltosos_b1 <= $media_regional_faltosos_b1)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos_b1; ?>
                            </div>
                        </td>


						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_b2)) $media_regional_faltosos_b2 = $media_faltosos_b2;
								if (($row->faltosos_b2 < $media_regional_faltosos_b2) | ($row->faltosos_b2 < $media_faltosos_b2)) $color = 'warning';
								if (($row->faltosos_b2 < $media_faltosos_b2) && ($row->faltosos_b2 <= $media_regional_faltosos_b2)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos_b2; ?>
                            </div>
                        </td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_assiduos_c1)) $media_regional_assiduos_c1 = $media_assiduos_c1;
								if (($row->assiduos_c1 > $media_regional_assiduos_c1) | ($row->assiduos_c1 > $media_assiduos_c1)) $color = 'warning';
								if (($row->assiduos_c1 > $media_assiduos_c1) && ($row->assiduos_c1 >= $media_regional_assiduos_c1)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->assiduos_c1; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_assiduos_c2)) $media_regional_assiduos_c2 = $media_assiduos_c2;
								if (($row->assiduos_c2 > $media_regional_assiduos_c2) | ($row->assiduos_c2 > $media_assiduos_c2)) $color = 'warning';
								if (($row->assiduos_c2 > $media_assiduos_c2) && ($row->assiduos_c2 >= $media_regional_assiduos_c2)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->assiduos_c2; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_d1)) $media_regional_faltosos_d1 = $media_faltosos_d1;
								if (($row->faltosos_d1 < $media_regional_faltosos_d1) | ($row->faltosos_d1 < $media_faltosos_d1)) $color = 'warning';
								if (($row->faltosos_d1 < $media_faltosos_d1) && ($row->faltosos_d1 <= $media_regional_faltosos_d1)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos_d1; ?>
                            </div>
                        </td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_d2)) $media_regional_faltosos_d2 = $media_faltosos_d2;
								if (($row->faltosos_d2 < $media_regional_faltosos_d2) | ($row->faltosos_d2 < $media_faltosos_d2)) $color = 'warning';
								if (($row->faltosos_d2 < $media_faltosos_d2) && ($row->faltosos_d2 <= $media_regional_faltosos_d2)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos_d2; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_fm_mes_passado)) $media_regional_fm_mes_passado = $media_fm_mes_passado;
								if (($row->fm_mes_passado < $media_regional_fm_mes_passado) | ($row->fm_mes_passado < $media_fm_mes_passado)) $color = 'warning';
								if (($row->fm_mes_passado < $media_fm_mes_passado) && ($row->fm_mes_passado <= $media_regional_fm_mes_passado)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->fm_mes_passado; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_fm_mes_atual)) $media_regional_fm_mes_atual = $media_fm_mes_atual;
								if (($row->fm_mes_atual < $media_regional_fm_mes_atual) | ($row->fm_mes_atual < $media_fm_mes_atual)) $color = 'warning';
								if (($row->fm_mes_atual < $media_fm_mes_atual) && ($row->fm_mes_atual <= $media_regional_fm_mes_atual)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->fm_mes_atual; ?>
                            </div>
                        </td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_qtd_flutuantes)) $media_regional_qtd_flutuantes = $media_qtd_flutuantes;
								if (($row->qtd_flutuantes < $media_regional_qtd_flutuantes) | ($row->qtd_flutuantes < $media_qtd_flutuantes)) $color = 'warning';
								if (($row->qtd_flutuantes < $media_qtd_flutuantes) && ($row->qtd_flutuantes <= $media_regional_qtd_flutuantes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->qtd_flutuantes; ?>
                            </div>
                        </td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_porc_flutuantes)) $media_regional_porc_flutuantes = $media_porc_flutuantes;
								if (($row->porc_flutuantes < $media_regional_porc_flutuantes) | ($row->porc_flutuantes < $media_porc_flutuantes)) $color = 'warning';
								if (($row->porc_flutuantes < $media_porc_flutuantes) && ($row->porc_flutuantes <= $media_regional_porc_flutuantes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->porc_flutuantes; ?>%
                            </div>
                        </td>

  					    <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_documentacao_mes)) $media_regional_documentacao_mes = $media_documentacao_mes;
								if (($row->documentacao_mes > $media_regional_documentacao_mes) | ($row->documentacao_mes > $media_documentacao_mes)) $color = 'warning';
								if (($row->documentacao_mes > $media_documentacao_mes) && ($row->documentacao_mes >= $media_regional_documentacao_mes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->documentacao_mes; ?>
                            </div>
                        </td>

  					    <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_documentacao_total)) $media_regional_documentacao_total = $media_documentacao_total;
								if (($row->documentacao_total > $media_regional_documentacao_total) | ($row->documentacao_total > $media_documentacao_total)) $color = 'warning';
								if (($row->documentacao_total > $media_documentacao_total) && ($row->documentacao_total >= $media_regional_documentacao_total)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->documentacao_total; ?>
                            </div>
                        </td>

  					    <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_inicio_mes)) $media_regional_inicio_mes = $media_inicio_mes;
								if (($row->inicio_mes > $media_regional_inicio_mes) | ($row->inicio_mes > $media_inicio_mes)) $color = 'warning';
								if (($row->inicio_mes > $media_inicio_mes) && ($row->inicio_mes >= $media_regional_inicio_mes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->inicio_mes; ?>
                            </div>
                        </td> 

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_ini_mespassado)) $media_regional_ini_mespassado = $media_ini_mespassado;
								if (($row->ini_mespassado > $media_regional_ini_mespassado) | ($row->ini_mespassado > $media_ini_mespassado)) $color = 'warning';
								if (($row->ini_mespassado > $media_ini_mespassado) && ($row->ini_mespassado >= $media_regional_ini_mespassado)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->ini_mespassado; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_inicio_total)) $media_regional_inicio_total = $media_inicio_total;
								if (($row->inicio_total > $media_regional_inicio_total) | ($row->inicio_total > $media_inicio_total)) $color = 'warning';
								if (($row->inicio_total > $media_inicio_total) && ($row->inicio_total >= $media_regional_inicio_total)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->inicio_total; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_orc_mesatual)) $media_regional_orc_mesatual = $media_orc_mesatual;
								if (($row->orc_mesatual > $media_regional_orc_mesatual) | ($row->orc_mesatual > $media_orc_mesatual)) $color = 'warning';
								if (($row->orc_mesatual > $media_orc_mesatual) && ($row->orc_mesatual >= $media_regional_orc_mesatual)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->orcamento_mes; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_orc_mespassado)) $media_regional_orc_mespassado = $media_orc_mespassado;
								if (($row->orc_mespassado > $media_regional_orc_mespassado) | ($row->orc_mespassado > $media_orc_mespassado)) $color = 'warning';
								if (($row->orc_mespassado > $media_orc_mespassado) && ($row->orc_mespassado >= $media_regional_orc_mespassado)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->orc_mespassado; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_orcamento_total)) $media_regional_orcamento_total = $media_orcamento_total;
								if (($row->orcamento_total > $media_regional_orcamento_total) | ($row->orcamento_total > $media_orcamento_total)) $color = 'warning';
								if (($row->orcamento_total > $media_orcamento_total) && ($row->orcamento_total >= $media_regional_orcamento_total)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->orcamento_total; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_agendados)) $media_regional_agendados = $media_agendados;
								if (($row->agendados > $media_regional_agendados) | ($row->agendados > $media_agendados)) $color = 'warning';
								if (($row->agendados > $media_agendados) && ($row->agendados >= $media_regional_agendados)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->agendados; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_atendidos)) $media_regional_atendidos = $media_atendidos;
								if (($row->atendidos > $media_regional_atendidos) | ($row->atendidos > $media_atendidos)) $color = 'warning';
								if (($row->atendidos > $media_atendidos) && ($row->atendidos >= $media_regional_atendidos)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->atendidos; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_lflutuantes)) $media_regional_lflutuantes = $media_lflutuantes;
								if (($row->lflutuantes < $media_regional_lflutuantes) | ($row->lflutuantes < $media_lflutuantes)) $color = 'warning';
								if (($row->lflutuantes < $media_lflutuantes) && ($row->lflutuantes <= $media_regional_lflutuantes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->lflutuantes; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos)) $media_regional_faltosos = $media_faltosos;
								if (($row->faltosos < $media_regional_faltosos) | ($row->faltosos < $media_faltosos)) $color = 'warning';
								if (($row->faltosos < $media_faltosos) && ($row->faltosos <= $media_regional_faltosos)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_mflutuantes)) $media_regional_mflutuantes = $media_mflutuantes;
								if (($row->mflutuantes < $media_regional_mflutuantes) | ($row->mflutuantes < $media_mflutuantes)) $color = 'warning';
								if (($row->mflutuantes < $media_mflutuantes) && ($row->mflutuantes <= $media_regional_mflutuantes)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->mflutuantes; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_faltosos)) $media_regional_total_faltosos = $media_total_faltosos;
								if (($row->total_faltosos < $media_regional_total_faltosos) | ($row->total_faltosos < $media_total_faltosos)) $color = 'warning';
								if (($row->total_faltosos < $media_total_faltosos) && ($row->total_faltosos <= $media_regional_total_faltosos)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->total_faltosos; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_nao_ira_receber)) $media_regional_nao_ira_receber = $media_nao_ira_receber;
								if (($row->nao_ira_receber < $media_regional_nao_ira_receber) | ($row->nao_ira_receber < $media_nao_ira_receber)) $color = 'warning';
								if (($row->nao_ira_receber < $media_nao_ira_receber) && ($row->nao_ira_receber <= $media_regional_nao_ira_receber)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo round($row->nao_ira_receber); ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_porc_assiduos)) $media_regional_porc_assiduos = $media_porc_assiduos;
								if (($row->porc_assiduos > $media_regional_porc_assiduos) | ($row->porc_assiduos > $media_porc_assiduos)) $color = 'warning';
								if (($row->porc_assiduos > $media_porc_assiduos) && ($row->porc_assiduos >= $media_regional_porc_assiduos)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->porc_assiduos; ?>%
                            </div>
                        </td>

						<td>
								<?php
								$color = 'danger';
								if (empty($media_regional_porc_faltosos)) $media_regional_porc_faltosos = $media_porc_faltosos;
								if (($row->porc_faltosos < $media_regional_porc_faltosos) | ($row->porc_faltosos < $media_porc_faltosos)) $color = 'warning';
								if (($row->porc_faltosos < $media_porc_faltosos) && ($row->porc_faltosos <= $media_regional_porc_faltosos)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo round($row->porc_faltosos); ?>%
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_agendados)) $media_regional_faltosos_agendados = $media_faltosos_agendados;
								if (($row->faltosos_agendados > $media_regional_faltosos_agendados) | ($row->faltosos_agendados > $media_faltosos_agendados)) $color = 'warning';
								if (($row->faltosos_agendados > $media_faltosos_agendados) && ($row->faltosos_agendados >= $media_regional_faltosos_agendados)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->faltosos_agendados; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_faltosos_nao_agendados)) $media_regional_faltosos_nao_agendados = $media_faltosos_nao_agendados;
								if (($row->faltosos_nao_agendados < $media_regional_faltosos_nao_agendados) | ($row->faltosos_nao_agendados < $media_faltosos_nao_agendados)) $color = 'warning';
								if (($row->faltosos_nao_agendados < $media_faltosos_nao_agendados) && ($row->faltosos_nao_agendados <= $media_regional_faltosos_nao_agendados)) $color = 'success';							
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo round($row->faltosos_nao_agendados); ?>
                            </div>
                        </td>

                         <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_zero_um)) $media_regional_zero_um = $media_zero_um;
								if (($row->zero_um > $media_regional_zero_um) | ($row->zero_um > $media_zero_um)) $color = 'warning';
								if (($row->zero_um > $media_zero_um) && ($row->zero_um >= $media_regional_zero_um)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->zero_um; ?>
                            </div>
                        </td> 

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_um_dois)) $media_regional_um_dois = $media_um_dois;
								if (($row->um_dois > $media_regional_um_dois) | ($row->um_dois > $media_um_dois)) $color = 'warning';
								if (($row->um_dois > $media_um_dois) && ($row->um_dois >= $media_regional_um_dois)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->um_dois; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_dois_tres)) $media_regional_dois_tres = $media_dois_tres;
								if (($row->dois_tres > $media_regional_dois_tres) | ($row->dois_tres > $media_dois_tres)) $color = 'warning';
								if (($row->dois_tres > $media_dois_tres) && ($row->dois_tres >= $media_regional_dois_tres)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->dois_tres; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_tres_quatro)) $media_regional_tres_quatro = $media_tres_quatro;
								if (($row->tres_quatro > $media_regional_tres_quatro) | ($row->tres_quatro > $media_tres_quatro)) $color = 'warning';
								if (($row->tres_quatro > $media_tres_quatro) && ($row->tres_quatro >= $media_regional_tres_quatro)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->tres_quatro; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_acima_4)) $media_regional_acima_4 = $media_acima_4;
								if (($row->acima_4 > $media_regional_acima_4) | ($row->acima_4 > $media_acima_4)) $color = 'warning';
								if (($row->acima_4 > $media_acima_4) && ($row->acima_4 >= $media_regional_acima_4)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->acima_4; ?>
                            </div>
                        </td>


                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_geral)) $media_regional_total_geral = $media_total_geral;
								if (($row->total_geral > $media_regional_total_geral) | ($row->total_geral > $media_total_geral)) $color = 'warning';
								if (($row->total_geral > $media_total_geral) && ($row->total_geral >= $media_regional_total_geral)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->total_geral; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_media_gasto)) $media_regional_media_gasto = $media_media_gasto;
								if (($row->media_gasto < $media_regional_media_gasto) | ($row->media_gasto < $media_media_gasto)) $color = 'warning';
								if (($row->media_gasto < $media_media_gasto) && ($row->media_gasto <= $media_regional_media_gasto)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->media_gasto; ?>%
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_media_lucro)) $media_regional_media_lucro = $media_media_lucro;
								if (($row->media_lucro > $media_regional_media_lucro) | ($row->media_lucro > $media_media_lucro)) $color = 'warning';
								if (($row->media_lucro > $media_media_lucro) && ($row->media_lucro >= $media_regional_media_lucro)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->media_lucro; ?>%
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_pac_mes_retrasado)) $media_regional_total_pac_mes_retrasado = $media_total_pac_mes_retrasado;
								if (($row->total_pac_mes_retrasado > $media_regional_total_pac_mes_retrasado) | ($row->total_pac_mes_retrasado > $media_total_pac_mes_retrasado)) $color = 'warning';
								if (($row->total_pac_mes_retrasado > $media_total_pac_mes_retrasado) && ($row->total_pac_mes_retrasado >= $media_regional_total_pac_mes_retrasado)) $color = 'success';							
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->total_pac_mes_retrasado; ?>
                            </div>
                        </td>

 					   <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_pac_mes_passado)) $media_regional_total_pac_mes_passado = $media_total_pac_mes_passado;
								if (($row->total_pac_mes_passado > $media_regional_total_pac_mes_passado) | ($row->total_pac_mes_passado > $media_total_pac_mes_passado)) $color = 'warning';
								if (($row->total_pac_mes_passado > $media_total_pac_mes_passado) && ($row->total_pac_mes_passado >= $media_regional_total_pac_mes_passado)) $color = 'success';							
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo $row->total_pac_mes_passado; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_a_receber)) $media_regional_total_a_receber = $media_total_a_receber;
								if (($row->total_a_receber > $media_regional_total_a_receber) | ($row->total_a_receber > $media_total_a_receber)) $color = 'warning';
								if (($row->total_a_receber > $media_total_a_receber) && ($row->total_a_receber >= $media_regional_total_a_receber)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                <?php echo  $row->total_a_receber ; ?>

                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_em_atraso)) $media_regional_total_em_atraso = $media_total_em_atraso;
								if (($row->total_em_atraso < $media_regional_total_em_atraso) | ($row->total_em_atraso < $media_total_em_atraso)) $color = 'warning';
								if (($row->total_em_atraso < $media_total_em_atraso) && ($row->total_em_atraso <= $media_regional_total_em_atraso)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                 <?php echo  $row->total_em_atraso; ?>

                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_total_pago)) $media_regional_total_pago = $media_total_pago;
								if (($row->total_pago < $media_regional_total_pago) | ($row->total_pago < $media_total_pago)) $color = 'warning';
								if (($row->total_pago < $media_total_pago) && ($row->total_pago <= $media_regional_total_pago)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                 <?php echo  $row->total_pago ; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_receita)) $media_regional_receita = $media_receita;
								if (($row->receita > $media_regional_receita) | ($row->receita > $media_receita)) $color = 'warning';
								if (($row->receita > $media_receita) && ($row->receita >= $media_regional_receita)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                 <?php echo  $row->receita ; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_despesa)) $media_regional_despesa = $media_despesa;
								if (($row->despesa < $media_regional_despesa) | ($row->despesa < $media_despesa)) $color = 'warning';
								if (($row->despesa < $media_despesa) && ($row->despesa <= $media_regional_despesa)) $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                 <?php echo  $row->despesa ; ?>
                            </div>
                        </td>

                        <td>
								<?php
								$color = 'danger';
								if (empty($media_regional_lucro)) $media_regional_lucro = $media_lucro;
								//if (($row->lucro > $media_regional_lucro) | ($row->lucro > $media_lucro)) $color = 'warning';
								if ($row->lucro > 0)  $color = 'success';
									 ?>
								<div class="alert alert-<?php echo $color ?>">
                                 <?php echo  $row->lucro; ?>
                            </div>
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

<table style="position:relative; top:120px; left:-90px">
  <tr>
    <td colspan="4" style="text-align: center; padding:5px; background-color:#FFD2D2;">
       <p>Sua busca não encontrou nenhum resultado :(</p>
    </td>
   </tr>
</table>
<?php
}
?>