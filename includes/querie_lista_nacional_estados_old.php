 <?php 

  $sql =     
         "SELECT a.nomefantasia, a.Estado, a.idclinica,
                 b.assiduos_a1, b.assiduos_a2, b.data_inclusao,     
                 C.faltosos_b1, C.faltosos_b2,
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
                       s.receita, s.despesa, s.lucro         
            FROM ap_clinicas a 
          LEFT JOIN (SELECT INSCRICAO, assiduos_a1, assiduos_a2, max(data_inclusao) as data_inclusao 
                  FROM cli_agendados_assiduos xx 
                       WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_agendados_assiduos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) B ON b.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, faltosos_b1, faltosos_b2, MAX(data_inclusao) AS data_inclusao
                 FROM cli_agendados_faltosos xx
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_agendados_faltosos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao 
                 FROM cli_atendidos_assiduos xx
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_atendidos_assiduos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) D ON D.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao 
                 FROM cli_atendidos_faltosos xx
                   WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_atendidos_faltosos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) E ON E.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_atual, MAX(data_inclusao) 
                FROM cli_fluxo_fm XX 
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_fluxo_fm x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) F ON F.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao 
                     FROM cli_flutuantes XX
                      WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_flutuantes x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao 
                 FROM cli_orcamento XX
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_orcamento x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) H ON H.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao 
                FROM cli_documentacao   xx
                WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_documentacao x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) I ON I.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao 
                FROM cli_inicio xx
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_inicio x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )   GROUP BY INSCRICAO ) J ON J.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  
                FROM cli_orcamentos_x_inicios xx
                WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_orcamentos_x_inicios x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) K ON K.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao 
                FROM cli_tratamento_assiduos xx
                WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_tratamento_assiduos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) L ON L.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao 
                 FROM cli_tratamento_assiduos_x_faltosos xx
                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_tratamento_assiduos_x_faltosos x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) M ON M.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao 
                    FROM cli_tratamento_faltosos  xx
                     WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                      FROM cli_tratamento_faltosos x  
                                                     WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) N ON N.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) 
              FROM cli_envelhecimento_clinica xx
              WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                            FROM cli_envelhecimento_clinica x  
                                           WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) O ON O.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
          LEFT JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) 
              FROM cli_custo_paciente xx
              WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                            FROM cli_custo_paciente x  
                                           WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) P ON P.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                LEFT JOIN (SELECT inscricao, total_pac_mes_passado, total_pac_mes_retrasado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_fluxo_paciente x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                LEFT JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                            FROM cli_negociacao  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                   FROM cli_negociacao x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) R ON R.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END         
                LEFT JOIN (SELECT dataref, receita, despesa ,lucro, inscricao
                            FROM cli_lin_comparativo_receita_despesas  xx
                            WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo) 
                                                   FROM cli_lin_comparativo_receita_despesas x  
                                                  WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END                                                                                 
          WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'  ".$andWhereEstado."
          
        ORDER BY a.estado";  

