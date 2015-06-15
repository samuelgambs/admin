<?php

$busca_media_nacional =
"SELECT SUM(orc_mespassado) as orcamento_nacional, SUM(ini_mespassado) as inicio_nacional, SUM(DOCUMENTACAO_MES) as documentacao_nacional, SUM(total_pac_mes_passado) as pacientes_nacional,
SUM(lucro), sum(qtd_flutuantes), SUM(faltosos_b1), SUM(faltosos_b2),SUM(faltosos_d1),SUM(faltosos_d2),SUM(total_a_receber), SUM(total_em_atraso),SUM(total_pago), SUM(orc_mesatual), SUM(ini_mesatual)
      FROM  cli_orcamentos_x_inicios b
INNER JOIN  ap_clinicas a
        ON  b.inscricao =  substring(a.CNPJ,1,8)
INNER JOIN (SELECT inscricao, total_pac_mes_passado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                         FROM cli_fluxo_paciente x
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END
INNER JOIN (SELECT INSCRICAO, DOCUMENTACAO_MES
            FROM cli_documentacao xx
            WHERE DATE_FORMAT(xx.DATA_INCLUSAO, '%Y-%m-%d')  =    (SELECT IFNULL(DATE_FORMAT(MAX(DATA_INCLUSAO),'%Y-%m-%d'),0) FROM cli_documentacao
                                                                    WHERE DATA_INCLUSAO BETWEEN DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d')
                                                                      AND DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%m-%d')))
                                                                           W ON W.INSCRICAO = substring(a.CNPJ,1,8)
INNER JOIN (SELECT dataref, receita, despesa ,lucro, inscricao
                            FROM cli_lin_comparativo_receita_despesas  xx
                            WHERE xx.data_arquivo = (SELECT max(x.data_arquivo)
                                                         FROM cli_lin_comparativo_receita_despesas x
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END
INNER JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao
                             FROM cli_flutuantes XX
                              WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                         FROM cli_flutuantes x
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END
INNER JOIN (SELECT INSCRICAO, faltosos_b1, faltosos_b2, MAX(data_inclusao) AS data_inclusao
                 FROM cli_agendados_faltosos xx
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_agendados_faltosos x
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = CASE
                                                                                                                                         WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                         ELSE substring(a.CNPJ,1,9)
                                                                                                                                       END
INNER JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao
                 FROM cli_atendidos_faltosos xx
                   WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_atendidos_faltosos x
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) E ON E.INSCRICAO = CASE
                                                                                                                                         WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                         ELSE substring(a.CNPJ,1,9)
                                                                                                                                      END
INNER JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                            FROM cli_negociacao  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                                   FROM cli_negociacao x
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) R ON R.INSCRICAO = CASE
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                                ELSE substring(a.CNPJ,1,9)
                                                                                                                                              END
                                                                                                                                                                                      
                                      
    WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
     FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
      AND a.tipoclinica = 'F' 
      AND a.ativo = 'Sim'		";