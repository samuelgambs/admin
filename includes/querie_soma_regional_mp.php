<?php



$sql_soma_regional_mp = 

"    SELECT A.NomeFantasia,
            AVG(B.total) as total_orcamentos,
            AVG(C.total) as total_documentacao, 
            AVG(D.TOTAL) as total_inicios, 
            AVG(E.LUCRO) as total_lucro,
            AVG(F.TOTAL) as total_pacientes_mes_passado,
            AVG(G.TOTAL) as total_flutuantes,
            AVG(H.TOTAL) as total_agendados_faltosos,
            AVG(I.TOTAL) AS total_atendidos_faltosos,
            AVG(J.TOTAL_A_RECEBER) as total_a_receber, AVG(J.TOTAL_EM_ATRASO) as total_em_atraso, AVG(J.TOTAL_PAGO) as total_pago
        FROM ap_clinicas A
  LEFT JOIN (SELECT TOTAL, DATAREF, INSCRICAO 
                FROM cli_lin_orcamento
                WHERE dataref = '$mespassado') B
          ON B.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                          END  
  LEFT JOIN  (SELECT TOTAL, DATAREF, INSCRICAO
                 FROM cli_lin_documentacao 
                 WHERE dataref = '$mespassado') C
          ON C.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                          END      
  LEFT JOIN  (SELECT TOTAL, DATAREF, INSCRICAO
                 FROM cli_lin_inicio
                 WHERE dataref = '$mespassado') D
          ON D.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                          END             
  LEFT JOIN  (SELECT LUCRO, DATAREF, INSCRICAO
                 FROM cli_lin_comparativo_receita_despesas
                 WHERE dataref = '$mespassado') E
          ON E.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                          END    
  LEFT JOIN  (SELECT TOTAL, INSCRICAO
                 FROM cli_lin_fluxo_paciente
                 WHERE dataref = '$mespassado') F
          ON F.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                           END    
           
  LEFT JOIN  (SELECT TOTAL, INSCRICAO
                 FROM cli_lin_flutuantes
                 WHERE dataref = '$mespassado') G
          ON G.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                           END     
  LEFT JOIN  (SELECT TOTAL, INSCRICAO
                 FROM cli_lin_agendados_faltosos
                 WHERE dataref = '$mespassado') H
          ON H.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                           END      
  LEFT JOIN  (SELECT TOTAL, INSCRICAO
                 FROM cli_lin_atendidos_faltosos
                 WHERE dataref = '$mespassado') I
          ON I.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                           END 
  LEFT JOIN  (SELECT TOTAL_A_RECEBER, TOTAL_EM_ATRASO, TOTAL_PAGO, INSCRICAO
                 FROM cli_lin_negociacao
                 WHERE dataref = '$mespassado') J
          ON J.inscricao = CASE   
                             WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                             ELSE substring(a.CNPJ,1,9)        
                           END                              
       WHERE A.tipoclinica = 'F' AND A.Ativo = 'Sim'  and a.Estado = '$regional'  ";
$query_sql_soma_regional_mp = $MySQLi->query($sql_soma_regional_mp) or trigger_error($MySQLi->error, E_USER_ERROR);  
$row_sql_soma_regional_mp = $query_sql_soma_regional_mp->fetch_object();
$total_orcamentos_regional = $row_sql_soma_regional_mp->total_orcamentos; 
$total_documentacao_regional = $row_sql_soma_regional_mp->total_documentacao; 
$total_lucro_regional = $row_sql_soma_regional_mp->total_lucro;
$total_inicios_regional = $row_sql_soma_regional_mp->total_inicios;
$total_pacientes_mp_regional = $row_sql_soma_regional_mp->total_pacientes_mes_passado;
$total_flutuantes_regional = $row_sql_soma_regional_mp->total_flutuantes;
$total_agendados_faltosos_regional =  $row_sql_soma_regional_mp->total_agendados_faltosos;
$total_atendidos_faltosos_regional = $row_sql_soma_regional_mp->total_atendidos_faltosos;
$total_a_receber_mp_regional = $row_sql_soma_regional_mp->total_a_receber;
$total_em_atraso_mp_regional = $row_sql_soma_regional_mp->total_em_atraso;
$total_pago_mp_regional = $row_sql_soma_regional_mp->total_pago;
