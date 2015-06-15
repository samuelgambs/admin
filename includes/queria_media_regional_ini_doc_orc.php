<?php
 
//BUSCANDO SOMA REGIONAL DE INICIOS DOC E ORÇAMENTOS
$busca_media_regional =
    "SELECT SUM(orc_mespassado) as orcamento_regional, SUM(ini_mespassado) as inicio_regional, SUM(DOCUMENTACAO_MES) as documentacao_regional, SUM(total_pac_mes_passado) as pacientes_regional
      FROM  cli_orcamentos_x_inicios b
INNER JOIN  ap_clinicas a
        ON  b.inscricao =   CASE   
                               WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                               ELSE substring(a.CNPJ,1,9)        
                             END 
 INNER JOIN (SELECT inscricao, total_pac_mes_passado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_fluxo_paciente x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END         
LEFT JOIN (SELECT INSCRICAO, DOCUMENTACAO_MES
            FROM cli_documentacao xx
            WHERE DATE_FORMAT(xx.DATA_INCLUSAO, '%Y-%m-%d')  =    (SELECT IFNULL(DATE_FORMAT(MAX(DATA_INCLUSAO),'%Y-%m-%d'),0) FROM cli_documentacao
                                                                    WHERE DATA_INCLUSAO BETWEEN DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d 00:00:00')
                                                                      AND DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%m-%d 23:59:59')))
                                                                           W ON W.INSCRICAO = CASE   
                                                                                                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                  ELSE substring(a.CNPJ,1,9)        
                                                                                               END 
    WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
     FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
      AND a.tipoclinica = 'F' and a.Estado = '$regional' ";


