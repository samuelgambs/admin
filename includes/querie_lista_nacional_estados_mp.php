 <?php

$sql_media_pacientes = "
SELECT AVG(total_pac_mes_passado) as media_pacientes 
FROM cli_fluxo_paciente B
JOIN ap_clinicas A
  ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
              WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_fluxo_paciente x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 ) and A.Ativo = 'Sim' AND A.ativo = 'sim' AND A.TipoClinica = 'F' ";
$query_media_pacientes = $MySQLi->query($sql_media_pacientes) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_pacientes = $query_media_pacientes->fetch_object();
$media_pacientes_mp = $row_media_pacientes->media_pacientes;



$sql_media_orcamentos = "SELECT AVG(orc_mespassado) as media_orc 
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas A
  ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
              WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 ) and A.Ativo = 'Sim' AND A.TipoClinica = 'F'";
$query_media_orcamentos = $MySQLi->query($sql_media_orcamentos) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_orcamentos = $query_media_orcamentos->fetch_object();
$media_orcamentos_mp = $row_media_orcamentos->media_orc;



$sql_media_inicios = "SELECT AVG(ini_mespassado) as media_ini
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas A
  ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
             WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 ) and A.Ativo = 'Sim' AND A.TipoClinica = 'F'";

$query_media_inicios = $MySQLi->query($sql_media_inicios) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_inicios = $query_media_inicios->fetch_object();
$media_inicios_mp = $row_media_inicios->media_ini;

$sql_media_documentacao_mp ="
SELECT avg(total) as media_doc
FROM cli_lin_documentacao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_documentacao = $MySQLi->query($sql_media_documentacao_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_documentacao = $query_media_documentacao->fetch_object();
$media_documentacao_mp = $row_media_documentacao->media_doc;

$sql_media_fm_mp ="
SELECT avg(total) as media_fm
FROM cli_lin_fluxo_fm B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_fm = $MySQLi->query($sql_media_fm_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_fm = $query_media_fm->fetch_object();
$media_fm_mp = $row_media_fm->media_fm;

$sql_media_faltosos_mp ="
SELECT avg(total) as media_faltosos, avg(faltosos_agendados) as faltosos_agendados, avg(faltosos_atendidos) as faltosos_atendidos
FROM cli_lin_qtde_faltosos B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_faltosos_mp = $MySQLi->query($sql_media_faltosos_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_faltosos_mp = $query_media_faltosos_mp->fetch_object();
$media_total_faltosos_mp = $row_media_faltosos_mp->media_faltosos;
$media_faltosos_agendados_mp = $row_media_faltosos_mp->faltosos_agendados;
$media_faltosos_atendidos_mp = $row_media_faltosos_mp->faltosos_atendidos;

$sql_media_custo_funcionario_mp ="
SELECT avg(valor) as custo_funcionario
FROM cli_lin_custo_funcionario B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_custo_funcionario_mp = $MySQLi->query($sql_media_custo_funcionario_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_custo_funcionario_mp = $query_media_custo_funcionario_mp->fetch_object();
$media_custo_funcionario_mp = $row_media_custo_funcionario_mp->custo_funcionario;

$sql_media_flutuantes_mp ="
SELECT avg(total) as flutuantes
FROM cli_lin_flutuantes B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_flutuantes_mp = $MySQLi->query($sql_media_flutuantes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_flutuantes_mp = $query_media_flutuantes_mp->fetch_object();
$media_flutuantes_mp = $row_media_flutuantes_mp->flutuantes;

$sql_media_cancelamentos_mp ="
SELECT avg(total) as cancelamentos
FROM cli_lin_cancelamento_ficha B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_cancelamentos_mp = $MySQLi->query($sql_media_cancelamentos_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_cancelamentos_mp = $query_media_cancelamentos_mp->fetch_object();
$media_cancelamentos_mp = $row_media_cancelamentos_mp->cancelamentos;

$sql_media_suspensoes_mp ="
SELECT avg(quantidade) as suspensao
FROM cli_lin_suspensao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_suspensoes_mp = $MySQLi->query($sql_media_suspensoes_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_suspensoes_mp = $query_media_suspensoes_mp->fetch_object();
$media_suspensoes_mp = $row_media_suspensoes_mp->suspensao;

$sql_media_gastos_dental_mp ="
SELECT avg(total) as gasto_dental
FROM cli_lin_gastos_dental B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_gastos_dental_mp = $MySQLi->query($sql_media_gastos_dental_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_gastos_dental_mp = $query_media_gastos_dental_mp->fetch_object();
$media_gastos_dental_mp = $row_media_gastos_dental_mp->gasto_dental;

$sql_media_negociacao_mp ="
SELECT avg(total_a_receber) as total_a_receber, avg(total_pago) as total_pago, avg(total_em_atraso) as total_em_atraso
FROM cli_lin_negociacao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_media_negociacao_mp = $MySQLi->query($sql_media_negociacao_mp) or trigger_error($MySQLi->error, E_USER_ERROR);
$row_media_negociacao_mp = $query_media_negociacao_mp->fetch_object();
$media_total_a_receber_mp = $row_media_negociacao_mp->total_a_receber;
$media_total_pago_mp = $row_media_negociacao_mp->total_pago;
$media_total_em_atraso_mp = $row_media_negociacao_mp->total_em_atraso;

/*/*========================================================*/
