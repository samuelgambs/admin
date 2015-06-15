<?php
// Inclui o arquivo que faz a conexão ao banco de dados
require_once('../includes/mysqli.php');


$sql_regional = "SELECT DISTINCT  Estado FROM ap_clinicas where Estado is not null;";
$res = $MySQLi->query($sql_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num = mysqli_num_rows($res);

$sql_socios = "SELECT DISTINCT  idSocio, Nome FROM ap_socios ORDER BY Nome ASC;";
$res_socios = $MySQLi->query($sql_socios) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_socios = mysqli_num_rows($res_socios);


// Monta a consulta SQL 
$sql = 	   
 			   'SELECT a.NomeFantasia, a.estado,
		      		   b.ASSIDUOS_A1, b.ASSIDUOS_A2, b.data_inclusao,		  
			           C.FALTOSOS_B1, C.FALTOSOS_B2,
			           D.assiduos_c1, D.assiduos_c2,
			           e.faltosos_d1, e.faltosos_d2,
			           f.fm_mes_passado, f.fm_mes_atual,
			           g.qtd_flutuantes, g.porc_flutuantes,
			           h.orcamento_mes, h.orcamento_total,
			           i.documentacao_mes, i.documentacao_total,
			           j.inicio_mes, j.inicio_total,
			           k.orc_mespassado, k.ini_mespassado, k.orc_mesatual, k.ini_mesatual,
			           l.agendados,  l.atendidos, l.flutuantes as lflutuantes,
			           m.faltosos,  m.flutuantes as mflutuantes, m.total_faltosos,m.nao_ira_receber, m.porc_assiduos, m.porc_faltosos,
			           n.faltosos_agendados, n.faltosos_nao_agendados,
			           o.0_a_1 as zero_um, o.1_a_2 as um_dois, o.2_a_3 as dois_tres,  o.3_a_4 as tres_quatro, o.acima_4,    o.total_geral,
			           p.media_gasto, p.media_lucro,
                       q.total_pac_mes_retrasado, q.total_pac_mes_passado,
                       r.total_a_receber, r.total_em_atraso, r.total_pago,
                       s.receita, s.despesa,s.lucro         
		        FROM ap_clinicas a 
			    INNER JOIN (SELECT INSCRICAO, assiduos_a1, ASSIDUOS_A2, max(data_inclusao) as data_inclusao 
			    			  FROM cli_agendados_assiduos xx 
			              	 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_agendados_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) B ON b.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, FALTOSOS_B1, FALTOSOS_B2, MAX(data_inclusao) AS data_inclusao
			    			 FROM cli_agendados_faltosos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_agendados_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_atendidos_assiduos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_atendidos_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) D ON D.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_atendidos_faltosos xx
		        			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_atendidos_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )	GROUP BY INSCRICAO ) E ON E.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_ATUAL, MAX(data_inclusao) 
			    			FROM cli_fluxo_fm XX 
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_fluxo_fm x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) F ON F.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao 
			    	         FROM cli_flutuantes XX
			    	          WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_flutuantes x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_orcamento XX
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_orcamento x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) H ON H.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_documentacao   xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_documentacao x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) I ON I.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_inicio xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_inicio x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )   GROUP BY INSCRICAO ) J ON J.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  
			    			FROM cli_orcamentos_x_inicios xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_orcamentos_x_inicios x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) K ON K.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao 
			    			FROM cli_tratamento_assiduos xx
			    			WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_tratamento_assiduos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) L ON L.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao 
			    			 FROM cli_tratamento_assiduos_x_faltosos xx
			    			 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_tratamento_assiduos_x_faltosos x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) M ON M.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao 
			    		    	FROM cli_tratamento_faltosos  xx
			    		    	 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                                FROM cli_tratamento_faltosos x  
			                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) N ON N.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) 
			    	  FROM cli_envelhecimento_clinica xx
			    	  WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                      FROM cli_envelhecimento_clinica x  
			                                     WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) O ON O.INSCRICAO = substring(a.CNPJ,1,8)
			    INNER JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) 
			    	  FROM cli_custo_paciente xx
			    	  WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                      FROM cli_custo_paciente x  
			                                     WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) P ON P.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT inscricao, total_pac_mes_passado, total_pac_mes_retrasado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_fluxo_paciente x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                            FROM cli_negociacao  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
			                                             FROM cli_negociacao x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) R ON R.INSCRICAO = substring(a.CNPJ,1,8)       
                INNER JOIN (SELECT dataref, receita, despesa ,lucro, inscricao
                            FROM cli_lin_comparativo_receita_despesas  xx
                            WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo) 
			                                             FROM cli_lin_comparativo_receita_despesas x  
			                                            WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = substring(a.CNPJ,1,8)                                                                               
			    WHERE a.tipoclinica = "F"
			    GROUP BY substring(a.CNPJ,1,8)
				ORDER BY a.estado';
				
		
// Executa a consulta OU mostra uma mensagem de erro
$resultado = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_rows = mysqli_num_rows($resultado);

$sql_soma = 'SELECT  
                       SUM(B.assiduos_a1) as assiduos_a1, SUM(B.assiduos_a2) as assiduos_a2, SUM(C.FALTOSOS_B1) as FALTOSOS_B1, 
                       SUM(C.FALTOSOS_B2) as FALTOSOS_B2, SUM(D.assiduos_c1) as assiduos_c1,SUM(D.assiduos_c2) as assiduos_c2,
                       SUM(E.faltosos_d1) as faltosos_d1 ,SUM(E.faltosos_d2) as faltosos_d2,SUM(F.fm_mes_passado) as fm_mes_passado,SUM(F.fm_mes_ATUAL) as fm_mes_ATUAL,
                       SUM(G.qtd_flutuantes) as qtd_flutuantes, SUM(G.porc_flutuantes) as porc_flutuantes,
                       SUM(H.orcamento_mes) as orcamento_mes, SUM(H.orcamento_total) as orcamento_total, 
                       SUM(I.documentacao_mes) as documentacao_mes, SUM(I.documentacao_total) as documentacao_total, SUM(J.inicio_mes) as inicio_mes, SUM(J.inicio_total) as inicio_total, 
                       SUM(k.orc_mespassado) as orc_mespassado, SUM(k.ini_mespassado) as ini_mespassado, SUM(k.orc_mesatual) as orc_mesatual, SUM(k.ini_mesatual) as ini_mesatual,
                       SUM(l.agendados) as agendados,  SUM(l.atendidos) as atendidos,     SUM(l.flutuantes) as flutuantes,
                       SUM(m.faltosos) as faltosos,  SUM(m.flutuantes) as mflutuantes, SUM(m.total_faltosos) as total_faltosos,SUM(m.nao_ira_receber) as nao_ira_receber, SUM(m.porc_assiduos) as porc_assiduos, SUM(m.porc_faltosos) as porc_faltosos,
                       SUM(n.faltosos_agendados) as faltosos_agendados,     SUM(n.faltosos_nao_agendados) as faltosos_nao_agendados,
                       SUM(0_a_1) as zero_um, SUM(1_a_2) as um_dois, SUM(2_a_3) as dois_tres, SUM(3_a_4) as tres_quatro,  SUM(o.acima_4) as acima_4,    SUM(o.total_geral) as total_geral,
                       SUM(p.media_gasto) as media_gasto,  SUM(p.media_lucro) as media_lucro,
                       SUM(q.total_pac_mes_retrasado) as total_pac_mes_retrasado, SUM(q.total_pac_mes_passado) as total_pac_mes_passado,
                       SUM(r.total_a_receber) as total_a_receber, SUM(r.total_em_atraso) as total_em_atraso, SUM(r.total_pago) as total_pago,
                       SUM(s.receita) as receita, SUM(s.despesa) as despesa ,SUM(s.lucro) as lucro         
                FROM ap_clinicas a 
                INNER JOIN (SELECT INSCRICAO, assiduos_a1, ASSIDUOS_A2, max(data_inclusao) as data_inclusao 
                              FROM cli_agendados_assiduos xx 
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_agendados_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) B ON b.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, (FALTOSOS_B1), (FALTOSOS_B2), MAX(data_inclusao) AS data_inclusao
                             FROM cli_agendados_faltosos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_agendados_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_atendidos_assiduos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_atendidos_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) D ON D.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_atendidos_faltosos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_atendidos_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) E ON E.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_ATUAL, MAX(data_inclusao), SUM(fm_mes_passado) as soma 
                            FROM cli_fluxo_fm XX 
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_fluxo_fm x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) F ON F.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_flutuantes XX
                              WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_flutuantes x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_orcamento XX
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_orcamento x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) H ON H.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_documentacao   xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_documentacao x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) I ON I.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_inicio xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_inicio x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )   GROUP BY INSCRICAO ) J ON J.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  
                            FROM cli_orcamentos_x_inicios xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_orcamentos_x_inicios x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) K ON K.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_tratamento_assiduos xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) L ON L.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_tratamento_assiduos_x_faltosos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_assiduos_x_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) M ON M.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao 
                                FROM cli_tratamento_faltosos  xx
                                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) N ON N.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) 
                      FROM cli_envelhecimento_clinica xx
                      WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_envelhecimento_clinica x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) O ON O.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) 
                      FROM cli_custo_paciente xx
                      WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_custo_paciente x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) P ON P.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT inscricao, total_pac_mes_passado, total_pac_mes_retrasado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_fluxo_paciente x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = substring(a.CNPJ,1,8)
                INNER JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                            FROM cli_negociacao  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_negociacao x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) R ON R.INSCRICAO = substring(a.CNPJ,1,8)       
                INNER JOIN (SELECT dataref, receita, despesa ,lucro, inscricao
                            FROM cli_lin_comparativo_receita_despesas  xx
                            WHERE xx.data_arquivo = (SELECT max(x.data_arquivo) 
                                                         FROM cli_lin_comparativo_receita_despesas x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = substring(a.CNPJ,1,8)                                                                                
                WHERE a.tipoclinica = "F"';

                $resultado_soma = $MySQLi->query($sql_soma) OR trigger_error($MySQLi->error, E_USER_ERROR);  



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>FixedColumns example - ColVis integration</title>
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.colVis.css">
	<link rel="stylesheet" type="text/css" href="../css/dataTables.fixedColumns.css">
	<link rel="stylesheet" type="text/css" href="../css/shCore.css">
	<!-- <link rel="stylesheet" type="text/css" href="../../../examples/resources/demo.css"> -->
	<style type="text/css" class="init">

	/* Ensure that the demo table scrolls */
	th, td { white-space: nowrap; }
	div.dataTables_wrapper {
		width: 1280px;
		margin: 10 auto;
		margin-top: 20px;

	}

	div.ColVis {
		float: left;
	}

	</style>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.colVis.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.fixedColumns.js"></script>
	<script type="text/javascript" language="javascript" src="../js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">

	$(document).ready(function() {
		var table = $('#example').DataTable( {
			dom:            "Cfrtip",
			scrollY:        "500px",
			scrollX:        true,
			scrollCollapse: true,
			paging:         false,
			columnDefs: [
				{ width: 160, targets: 0 }
			]
		} );

		new $.fn.dataTable.FixedColumns( table, {
			leftColumns: 1
		} );
	} );

	</script>
	<script language="javascript">

	 function carregaGridClinicas()
    {
    	var estado = $("select[name='estado'] option:selected").text();
    	var socios = $("select[name='socios'] option:selected").val();
        $("#wait").show();
        $("#divTabelaClinicas").hide();
		$.ajax({
	    url: 'ajax_busca_clinicas.php',
	    type: 'GET',
		data: {uf: estado, idSocio: socios},
		success: function(results) {
				$("#divTabelaClinicas").show();
		        $("#divTabelaClinicas").html(results);
		        $("#wait").hide();
		    }
		});
    }
</script>
</head>

<body class="dt-example">
	<div class="container">
		<section>
			<p>
			<img src="redeOdonto.png" width="200" height="71" /></p>
			<h1>Tabela Gerencial</h1>
			
			<div style="position:relative; left:50%;"> Filtrar por Regional:
			
			 <select name="estado" id="estado" >
			 	 Selecione... 
			 	<option>Nacional</option>
			    <?php	// Faz um loop, passando por todos os resultados encontrados
						while ($dados = $res->fetch_object()) {   
						?>
					<option><?php echo $dados->Estado; ?></option> 

						<?php } ?>   
			</select>
			
			Sócios: 
			
			 <select name="socios" id="socios" >
			 	 Selecione... 
			 	<option> Todos </option>
			    <?php	// Faz um loop, passando por todos os resultados encontrados
						while ($dados_socios = $res_socios->fetch_object()) {   
						?>
					<option value="<?php echo $dados_socios->idSocio; ?>"> <?php echo $dados_socios->Nome; ?></option> 

						<?php } ?>  
			</select>
			<button onclick="carregaGridClinicas()">Filtrar</button></div>

			

			<div id="wait" style="display:none;width:69px;height:89px;;position:absolute;top:50%;left:50%;padding:2px;z-index:10"><img src='loading.gif' width="64" height="64" /><br>Carregando...</div>
<div id="divTabelaClinicas">

<table id="example" class="stripe row-border order-column" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th rowspan="2">Clínica</th>
						<th colspan="4">Agendados</th>
						<th colspan="4">Atendidos</th>
						<th colspan="2">Fluxo FM</th>
						<th colspan="2">Flutuantes</th>
						<th colspan="2">Documentação</th>
						<th colspan="3">Inícios</th>
						<th colspan="3">Orçamentos</th>
						<th colspan="3">Tratamento Assíduos</th>
						<th colspan="6">Assíduos x Faltosos</th>
						<th colspan="2">Tratamento Faltosos</th>
						<th colspan="6">Envelhecimento Clínica</th>
						<th colspan="2">Custo Paciente</th>
						<th colspan="2">Fluxo Paciente</th>
						<th colspan="3">Negociação</th>
						<th colspan="3">Receitas x Despesas</th>
					</tr>
					<tr>
					  <th>Assíduos</th>
					  <th>Total</th>
					  <th>Faltosos</th>
					  <th>Total</th>
					  <th>Assíduos</th>
					  <th>Total</th>
					  <th>Faltosos</th>
					  <th>Total</th>
					  <th>Mês Anterior</th>
					  <th>Mês Atual</th>
					  <th>Quantidade</th>
					  <th>%Flutuantes</th>
					  <th>Mês</th>
					  <th>Total</th>
					  <th>Mês Atual</th>
					  <th>Mês Anterior</th>
					  <th>Total</th>
					  <th>Mês Atual</th>
					  <th>Mês Anterior</th>
					  <th>Total</th>
					  <th>Agendados</th>
					  <th>Atendidos</th>
					  <th>Flutuantes</th>
					  <th>Faltosos</th>
					  <th>Flutuantes</th>
					  <th>Total Faltosos</th>
					  <th>Não Irá Receber</th>
					  <th>%Assíduos</th>
					  <th>%Faltosos</th>
					  <th>Faltosos Agendados</th>
					  <th>Faltosos Ñ Agendados</th>
					  <th>0-1</th>
					  <th>1-2</th>
					  <th>2-3</th>
					  <th>3-4</th>
					  <th>+4</th>
					  <th>Total</th>
					  <th>Mês Gasto</th>
					  <th>Mês Lucro</th>
					  <th>Mês Retrasado</th>
					  <th>Mês Passado</th>
					  <th>Total a Receber</th>
					  <th>Total em Atraso</th>
					  <th>Total Pago</th>
					  <th>Receita</th>
					  <th>Despesa</th>
					  <th>Lucro</th>
                  </tr>
				</thead>
				<tfoot>
					<tr>
					  <th>Média</th>
					   <?php 
						// Faz um loop, passando por todos os resultados encontrados
						while ($row_soma = $resultado_soma->fetch_object()) {                                               
							 ?>    

					  <th><?php echo round(($row_soma->assiduos_a1)/$num_rows)  ;?> </th>
					  <th><?php echo round($row_soma->assiduos_a2/$num_rows);?></th>
					  <th><?php echo round($row_soma->FALTOSOS_B1/$num_rows);?></th>
					  <th><?php echo round($row_soma->FALTOSOS_B2/$num_rows);?></th>
					  <th><?php echo round($row_soma->assiduos_c1/$num_rows);?></th>
					  <th><?php echo round($row_soma->assiduos_c2/$num_rows);?></th>
					  <th><?php echo round($row_soma->faltosos_d1/$num_rows);?></th>
					  <th><?php echo round($row_soma->faltosos_d2/$num_rows);?></th>
					  <th><?php echo round($row_soma->fm_mes_passado/$num_rows);?></th>
					  <th><?php echo round($row_soma->fm_mes_ATUAL/$num_rows);?></th>
					  <th><?php echo round($row_soma->qtd_flutuantes/$num_rows);?></th>
					  <th><?php echo round($row_soma->porc_flutuantes/$num_rows);?></th>
					  <th><?php echo round($row_soma->documentacao_mes/$num_rows);?></th>
					  <th><?php echo round($row_soma->documentacao_total/$num_rows);?></th>
					  <th><?php echo round($row_soma->inicio_mes/$num_rows);?></th>
					  <th><?php echo round($row_soma->ini_mespassado/$num_rows);?></th>
                      <th><?php echo round($row_soma->inicio_total/$num_rows);?></th>
                      <th><?php echo round($row_soma->orc_mesatual/$num_rows);?></th>
					  <th><?php echo round($row_soma->orc_mespassado/$num_rows);?></th>
					  <th><?php echo round($row_soma->orcamento_total/$num_rows);?></th>					 
					  <th><?php echo round($row_soma->agendados/$num_rows);?></th>
					  <th><?php echo round($row_soma->atendidos/$num_rows);?></th>
					  <th><?php echo round($row_soma->flutuantes/$num_rows);?></th>
					  <th><?php echo round($row_soma->faltosos/$num_rows);?></th>
					  <th><?php echo round($row_soma->mflutuantes/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_faltosos/$num_rows);?></th>
					  <th><?php echo round($row_soma->nao_ira_receber/$num_rows);?></th>
					  <th><?php echo round($row_soma->porc_assiduos/$num_rows);?></th>
					  <th><?php echo round($row_soma->porc_faltosos/$num_rows);?></th>
					  <th><?php echo round($row_soma->faltosos_agendados/$num_rows);?></th>
					  <th><?php echo round($row_soma->faltosos_nao_agendados/$num_rows);?></th>
					  <th><?php echo round($row_soma->zero_um/$num_rows);?></th>
					  <th><?php echo round($row_soma->um_dois/$num_rows);?></th>
					  <th><?php echo round($row_soma->dois_tres/$num_rows);?></th>
					  <th><?php echo round($row_soma->tres_quatro/$num_rows);?></th>
					  <th><?php echo round($row_soma->acima_4/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_geral/$num_rows);?></th>
					  <th><?php echo round($row_soma->media_gasto/$num_rows);?></th>
					  <th><?php echo round($row_soma->media_lucro/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_pac_mes_retrasado/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_pac_mes_passado/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_a_receber/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_em_atraso/$num_rows);?></th>
					  <th><?php echo round($row_soma->total_pago/$num_rows);?></th>
					  <th><?php echo round($row_soma->receita/$num_rows);?></th>
					  <th><?php echo round($row_soma->despesa/$num_rows);?></th>
					  <th><?php echo round($row_soma->lucro/$num_rows);?></th>
					  <?php } ?>
				  </tr>
				
				</tfoot>

				<tbody>
                <?php 
			// Faz um loop, passando por todos os resultados encontrados
			while ($row = $resultado->fetch_object()) {                                               
				 ?>    
					<tr align="center">
						<td><a href="../graficos.php?name=<?php echo $row->NomeFantasia;?>"><?php echo $row->NomeFantasia;?></a></td>
						<td><?php echo $row->ASSIDUOS_A1;?></td>
						<td><?php echo $row->ASSIDUOS_A2;?></td>
						<td><?php if ($row->FALTOSOS_B1 < $num_rows){?>
                          <font color="red"><?php echo $row->FALTOSOS_B1;?></font>
                        <?php } else {  echo $row->FALTOSOS_B1; }?></td>
						<td><?php echo $row->FALTOSOS_B2;?></td>
						<td><?php echo $row->assiduos_c1;?></td>
						<td><?php echo $row->assiduos_c2;?></td>
						<td><?php echo $row->faltosos_d1;?></td>
						<td><?php if ($row->faltosos_d2 >100){?>
						  <font color="red"><?php echo $row->faltosos_d2;?></font>
					    <?php } else {  echo $row->faltosos_d2; }?></td>
						<td><?php echo $row->fm_mes_passado;?></td>
						<td><?php echo $row->fm_mes_atual;?></td>
						<td><?php if ($row->qtd_flutuantes > 50){?>
						  <font color="red"><?php echo $row->qtd_flutuantes;?></font>
					    <?php } else {  echo $row->qtd_flutuantes; }?></td>
						<td><?php echo $row->porc_flutuantes;?>%</td>
						<td><?php echo $row->documentacao_mes;?></td>
					  <td><?php echo $row->documentacao_total;?></td>
						<td><?php echo $row->inicio_mes;?></td>
						<td><?php echo $row->ini_mespassado;?></td>
						<td><?php echo $row->inicio_total;?></td>
						<td><?php echo $row->orcamento_mes;?></td>
						<td><?php echo $row->orc_mespassado;?></td>
						<td><?php echo $row->orcamento_total;?></td>
						<td><?php echo $row->agendados;?></td>
						<td><?php echo $row->atendidos;?></td>
						<td><?php echo $row->lflutuantes;?></td>
						<td><?php echo $row->faltosos;?></td>
						<td><?php echo $row->mflutuantes;?></td>
						<td><?php echo $row->total_faltosos;?></td>
						<td><font color="red"><b><?php echo $row->nao_ira_receber;?></b></font></td>
						<td><?php echo $row->porc_assiduos;?>%</td>
						<td><?php echo $row->porc_faltosos;?>%</td>
						<td><?php echo $row->faltosos_agendados;?></td>
						<td><?php echo $row->faltosos_nao_agendados;?></td>
						<td><?php echo $row->zero_um;?></td>
						<td><?php echo $row->um_dois;?></td>
						<td><?php echo $row->dois_tres;?></td>
						<td><?php echo $row->tres_quatro;?></td>
						<td><?php echo $row->acima_4;?></td>
						<td><?php echo $row->total_geral;?></td>
						<td><?php echo $row->media_gasto;?></td>
						<td><?php echo $row->media_lucro;?></td>
						<td><?php echo $row->total_pac_mes_retrasado;?></td>
						<td><?php echo $row->total_pac_mes_passado;?></td>
						<td><?php echo $row->total_a_receber;?></td>
						<td><?php echo $row->total_em_atraso;?></td>
						<td><?php echo $row->total_pago;?></td>
						<td><?php echo $row->receita;?></td>
						<td><?php echo $row->despesa;?></td>
						<td><?php echo $row->lucro;?></td>
						<?php } ?>
					</tr>
					
				</tbody>
			</table>	
			</div>		
		</section>
</body>
</html>