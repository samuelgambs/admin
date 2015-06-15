   <?php 
   $sql_soma_regional = "SELECT  
                       SUM(B.assiduos_a1) as assiduos_a1, SUM(B.assiduos_a2) as assiduos_a2, SUM(C.faltosos_b1) as faltosos_b1, 
                       SUM(C.faltosos_b2) as faltosos_b2, SUM(D.assiduos_c1) as assiduos_c1,SUM(D.assiduos_c2) as assiduos_c2,
                       SUM(E.faltosos_d1) as faltosos_d1 ,SUM(E.faltosos_d2) as faltosos_d2,SUM(F.fm_mes_passado) as fm_mes_passado,SUM(F.fm_mes_atual) as fm_mes_atual,
                       SUM(G.qtd_flutuantes) as qtd_flutuantes, SUM(G.porc_flutuantes) as porc_flutuantes,
                       SUM(H.orcamento_mes) as orcamento_mes, SUM(H.orcamento_total) as orcamento_total, 
                       SUM(I.documentacao_mes) as documentacao_mes, SUM(I.documentacao_total) as documentacao_total, SUM(J.inicio_mes) as inicio_mes, SUM(J.inicio_total) as inicio_total, 
                       SUM(k.orc_mespassado) as orc_mespassado, SUM(k.ini_mespassado) as ini_mespassado, SUM(k.orc_mesatual) as orc_mesatual, SUM(k.ini_mesatual) as ini_mesatual,
                       SUM(l.agendados) as agendados,  SUM(l.atendidos) as atendidos,     SUM(l.flutuantes) as lflutuantes,
                       SUM(m.faltosos) as faltosos,  SUM(m.flutuantes) as mflutuantes, SUM(m.total_faltosos) as total_faltosos,SUM(m.nao_ira_receber) as nao_ira_receber, SUM(m.porc_assiduos) as porc_assiduos, SUM(m.porc_faltosos) as porc_faltosos,
                       SUM(n.faltosos_agendados) as faltosos_agendados,     SUM(n.faltosos_nao_agendados) as faltosos_nao_agendados,
                       SUM(0_a_1) as zero_um, SUM(1_a_2) as um_dois, SUM(2_a_3) as dois_tres, SUM(3_a_4) as tres_quatro,  SUM(o.acima_4) as acima_4,    SUM(o.total_geral) as total_geral,
                       SUM(p.media_gasto) as media_gasto,  SUM(p.media_lucro) as media_lucro,
                       SUM(q.total_pac_mes_retrasado) as total_pac_mes_retrasado, SUM(q.total_pac_mes_passado) as total_pac_mes_passado,
                       SUM(r.total_a_receber) as total_a_receber, SUM(r.total_em_atraso) as total_em_atraso, SUM(r.total_pago) as total_pago,
                       SUM(s.receita) as receita, SUM(s.despesa) as despesa ,SUM(s.lucro) as lucro         
                FROM ap_clinicas a 
                INNER JOIN (SELECT INSCRICAO, assiduos_a1, assiduos_a2, max(data_inclusao) as data_inclusao 
                              FROM cli_agendados_assiduos xx 
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_agendados_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) B ON b.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, (faltosos_b1), (faltosos_b2), MAX(data_inclusao) AS data_inclusao
                             FROM cli_agendados_faltosos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_agendados_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) C ON C.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_atendidos_assiduos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_atendidos_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) D ON D.INSCRICAO = CASE   
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
                INNER JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_atual, MAX(data_inclusao), SUM(fm_mes_passado) as soma 
                            FROM cli_fluxo_fm XX 
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_fluxo_fm x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) F ON F.INSCRICAO = CASE   
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
                INNER JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_orcamento XX
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_orcamento x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) H ON H.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_documentacao   xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_documentacao x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) I ON I.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_inicio xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_inicio x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )   GROUP BY INSCRICAO ) J ON J.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  
                            FROM cli_orcamentos_x_inicios xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_orcamentos_x_inicios x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) K ON K.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao 
                            FROM cli_tratamento_assiduos xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_assiduos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) L ON L.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao 
                             FROM cli_tratamento_assiduos_x_faltosos xx
                             WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_assiduos_x_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) M ON M.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao 
                                FROM cli_tratamento_faltosos  xx
                                 WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_tratamento_faltosos x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) N ON N.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) 
                          FROM cli_envelhecimento_clinica xx
                          WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_envelhecimento_clinica x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) O ON O.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) 
                          FROM cli_custo_paciente xx
                          WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_custo_paciente x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 ) GROUP BY INSCRICAO ) P ON P.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END  
                INNER JOIN (SELECT inscricao, total_pac_mes_passado, total_pac_mes_retrasado
                            FROM cli_fluxo_paciente  xx
                            WHERE xx.data_inclusao = (SELECT max(x.data_inclusao) 
                                                         FROM cli_fluxo_paciente x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Q ON Q.INSCRICAO = CASE   
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
                INNER JOIN (SELECT dataref, receita, despesa ,lucro, inscricao
                            FROM cli_lin_comparativo_receita_despesas  xx
                            WHERE xx.data_arquivo = (SELECT max(x.data_arquivo) 
                                                         FROM cli_lin_comparativo_receita_despesas x  
                                                        WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = CASE   
                                                                                                                                                WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                                                                                                                                                ELSE substring(a.CNPJ,1,9)        
                                                                                                                                              END                                                                                  
                          WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'  ".$andWhereEstado." ";
       $resultado_soma_regional = $MySQLi->query($sql_soma_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);

