   <?php 
   $sql_soma_regional =   "SELECT 
                 AVG(k.orc_mesatual) as orc_mesatual, AVG(k.orc_mesatual * 100 / u.total) as orcamentos_sob_pacientes,
                 AVG(k.ini_mesatual) as ini_mesatual, AVG(k.ini_mesatual * 100 / u.total) as inicios_sob_pacientes,
                 AVG(k.ini_mesatual * 100 / k.orc_mesatual) as inicios_sob_orcamentos,
                 AVG(i.documentacao_mes) as documentacao_mes, AVG(i.documentacao_mes * 100 / u.total) as documentacao_sob_pacientes,
                 AVG(u.total) as total_paciente,
                 AVG(t.total) as total_faltosos, AVG(t.total * 100 / u.total) as faltosos_sob_pacientes, AVG(t.faltosos_agendados) as media_faltosos_agendados, AVG(t.faltosos_atendidos) as media_faltosos_atendidos,
                 AVG(g.qtd_flutuantes) as flutuantes, AVG(g.qtd_flutuantes * 100 / u.total) as flutuantes_sob_pacientes,
                 AVG(r.total_a_receber) as total_a_receber, AVG(r.total_em_atraso) as total_em_atraso, AVG(r.total_pago) as total_pago,
                 AVG(s.receita) as receita, AVG(s.despesa) as despesa, AVG(s.lucro) as lucro,
                 AVG(s.lucro/b.total_pac_mes_passado) as media_lucro,
                 AVG(s.despesa/b.total_pac_mes_passado) as media_gasto,
                 AVG(v.valor) as custo_funcionario, AVG(v.valor / u.total) as custo_funcionario_sob_pacientes,
                 AVG(y.quantidade) as suspensoes,AVG(y.quantidade * 100 / u.total) as suspensoes_sob_pacientes,AVG(sp22.suspensoes_pmp) AS suspensoes_pmp,
                 AVG(z.total) as cancelamento_ficha,AVG(z.total * 100 / u.total) as cancelamento_sob_pacientes,
   				 AVG(z22.cancelamento_ficha_pmp) AS cancelamento_ficha_pmp,
                 AVG(w.total) as custo_dental, AVG(w.total  / u.total) as custo_dental_sob_pacientes,AVG(w22.custo_dental_pmp) AS custo_dental_pmp,
                 AVG(b.total_pac_mes_passado) as total_pac_mes_passado,
                 AVG(c.total) as fm, AVG(c.total * 100 / u.total) as fm_sob_pacientes,
                 AVG(ze.qtd_falta_mes) as qtd_falta_mes, AVG(ze.qtd_marcacoes_mes) as qtd_marcacoes_mes, AVG(ze.indice_falta) as indice_falta,
   		         AVG(ze22.qtd_falta_mes) as qtd_falta_mes_pmp, AVG(ze22.qtd_marcacoes_mes) as qtd_marcacoes_mes_pmp, AVG(ze22.indice_falta) as indice_falta_pmp,	
                 AVG(ze11.qtd_falta) as qtd_falta_mes_mp, AVG(ze11.qtd_marcacoes) as qtd_marcacoes_mes_mp, AVG(ze11.indice_falta) as indice_falta_mp,
                 AVG(g22.flut_parcial_mp) AS flut_parcial_mp, AVG(doc_parcial_mp) AS doc_parcial_mp,AVG(fm_parcial_mp) AS fm_parcial_mp, avg(orc_parcial_mp) as orc_parcial_mp, AVG(pac_parcial_mp) AS pac_parcial_mp,
                 AVG(ini_parcial_mp) as ini_parcial_mp, AVG(falt_total_parcial_mp) falt_total_parcial_mp, AVG(falt_agend_parcial_mp) as falt_agend_parcial_mp, AVG(falt_atend_parcial_mp) as falt_atend_parcial_mp,
                 AVG(total_em_atraso_parcial_mp) as total_em_atraso_parcial_mp, AVG(total_pago_parcial_mp) as total_pago_parcial_mp,
                 AVG(am.total_indic) as total_indic_mp, AVG(am.total_contemplado) as total_contemplado_mp, AVG(am22.total_indic) as total_indic_ma, AVG(am22.total_contemplado) as total_contemplado_ma,AVG(am22.total_permitido) as total_permitido,
                 AVG(c33.fmpagantes) AS fmpagantes_ma, AVG(c33.fmnaopagantes)  as fmnaopagantes_ma,
                 AVG(ab.abandono_trat) AS abandono_trat_ma, AVG(ab.indice_abandono) as indice_abandono_ma, AVG(ab22.abandono_trat) as abandono_trat_pmp, AVG(ab22.indice_abandono) as indice_abandono_pmp,
                 AVG(ntfe.total) as nota_fiscal_ma, AVG(ntfe22.total) as nota_fiscal_mp,AVG(ntfe33.total) as nota_fiscal_pmp,
                 AVG(orto.total) as orto_mp, AVG(or22.total) as orto_atual, AVG(am33.total_indic) as total_indic_pmp, AVG(am33.total_contemplado) as total_contemplado_pmp
                		
                		
   FROM ap_clinicas a
       LEFT JOIN (SELECT INSCRICAO, qtd_flutuantes, MAX(data_inclusao) AS data_inclusao
                    FROM cli_flutuantes XX
                   WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                               FROM cli_flutuantes x
                                              WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) G ON G.INSCRICAO = CASE
                                                                                                                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                      ELSE substring(a.CNPJ,1,9)
                                                                                                                                   END
       LEFT JOIN (SELECT INSCRICAO, qtd_flutuantes as flut_parcial_mp, data_inclusao
                    FROM cli_flutuantes XX
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) G22 ON G22.INSCRICAO = CASE
                                                                                                                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                      ELSE substring(a.CNPJ,1,9)
                                                                                                                                   END

         LEFT JOIN (SELECT dataref,total,data_arquivo, inscricao
                      FROM cli_lin_flutuantes
                     WHERE  DATA_ARQUIVO 
                           BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                               AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) G2
               ON G2.inscricao = CASE
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
       LEFT JOIN (SELECT INSCRICAO, documentacao_mes as doc_parcial_mp, data_inclusao
                    FROM cli_documentacao XX
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) i22 ON i22.INSCRICAO = CASE
                                                                                                                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                      ELSE substring(a.CNPJ,1,9)
                                                                                                                                   END
        LEFT JOIN (SELECT dataref,total,data_arquivo, inscricao
                     FROM cli_lin_documentacao
                     WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y2
               ON Y2.inscricao = CASE
                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                      ELSE substring(a.CNPJ,1,9)
                                   END
         LEFT JOIN (SELECT dataref,total,data_arquivo, inscricao
                     FROM cli_lin_fluxo_fm
                     WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y3
               ON Y3.inscricao = CASE
                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                      ELSE substring(a.CNPJ,1,9)
                                   END

         LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_fluxo_fm  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_fluxo_fm x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) C ON C.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
		 LEFT JOIN (SELECT inscricao, fmpagantes, fmnaopagantes
                   FROM cli_fm_pagantes_naopagantes  xx
                   WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
                                                FROM cli_fm_pagantes_naopagantes x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) C33 ON C33.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
       LEFT JOIN (SELECT INSCRICAO, fm_mes_atual as fm_parcial_mp, data_inclusao
                    FROM cli_fluxo_fm XX
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) C22 ON C22.INSCRICAO = CASE
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
       LEFT JOIN (SELECT INSCRICAO, orc_mesatual as orc_parcial_mp, ini_mesatual as ini_parcial_mp, data_inclusao as data_inclusao_parcial_mp
                    FROM cli_orcamentos_x_inicios XX
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) K22 ON K22.INSCRICAO = CASE
                                                                                                                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                      ELSE substring(a.CNPJ,1,9)
                                                                                                                                   END

       LEFT JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                   FROM cli_lin_negociacao  xx
                   WHERE xx.data_arquivo = (SELECT max(x.data_arquivo)
                                               FROM cli_lin_negociacao x
                                              WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) R ON R.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
       LEFT JOIN (SELECT inscricao, total_a_receber as total_a_receber_parcial_mp, total_em_atraso as total_em_atraso_parcial_mp, total_pago as total_pago_parcial_mp, data_inclusao
                   FROM cli_negociacao  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) R22 ON R22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
        LEFT JOIN (SELECT inscricao, total_a_receber, total_em_atraso, total_pago
                   FROM cli_lin_negociacao  xx
                    WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) R2 ON R2.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
       LEFT JOIN (SELECT dataref, receita_liquido as receita, despesa_liquido as despesa ,lucro, inscricao
                   FROM cli_lin_comparativo_receita_despesas  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_comparativo_receita_despesas x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) S ON S.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT data_inclusao, faltosos_b2 as falt_total_parcial_mp, inscricao, faltosos_b1 as falt_agend_parcial_mp
                   FROM cli_agendados_faltosos  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)   GROUP BY INSCRICAO ) T22 ON T22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT data_inclusao, inscricao, faltosos_d1 as falt_atend_parcial_mp
                   FROM cli_atendidos_faltosos  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)   GROUP BY INSCRICAO ) T23 ON T23.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
   LEFT JOIN (SELECT dataref, total, inscricao, faltosos_agendados, faltosos_atendidos
                   FROM cli_lin_qtde_faltosos  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_qtde_faltosos x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) T ON T.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
       LEFT JOIN (SELECT dataref, total, inscricao, faltosos_agendados, faltosos_atendidos
                   FROM cli_lin_qtde_faltosos  xx
                  WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) T2 ON T2.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_fluxo_paciente  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_fluxo_paciente x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) U ON U.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT dataref, valor, inscricao
                   FROM cli_lin_custo_funcionario  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_custo_funcionario x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) V ON V.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END

      LEFT JOIN (SELECT dataref, valor, inscricao
                   FROM cli_lin_custo_funcionario  xx
                 WHERE  DATA_ARQUIVO
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) v2 ON v2.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_cancelamento_ficha  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_cancelamento_ficha x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Z ON Z.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
     LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_cancelamento_ficha  xx
                  WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1)- INTERVAL 1 SECOND, '%Y-%c-%d'))) Z2 ON Z2.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
     LEFT JOIN (SELECT  valor as cancelamento_ficha_pmp, inscricao, data_inclusao as data_cancelamento_pmp
                   FROM cli_cancelamento_ficha  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) Z22 ON Z22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                 
                                                                                                                                     
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_gastos_dental  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_gastos_dental x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) W ON W.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_gastos_dental  xx
                   WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1)- INTERVAL 1 SECOND, '%Y-%c-%d'))) W2 ON W2.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
                                                                                                                                     
        LEFT JOIN (SELECT  valor as custo_dental_pmp, inscricao, data_inclusao as data_custo_dental_pmp
                   FROM cli_gastos_dental  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) w22 ON w22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                    
      LEFT JOIN (SELECT dataref, quantidade, inscricao
                   FROM cli_lin_suspensao  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_suspensao x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) Y ON Y.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT dataref, quantidade, inscricao
                   FROM cli_lin_suspensao  xx
                    WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1)- INTERVAL 1 SECOND, '%Y-%c-%d'))) SP ON SP.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT  quantidade as suspensoes_pmp, inscricao, data_inclusao as data_suspensoes_pmp
                   FROM cli_suspensao  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) SP22 ON SP22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                 
                                                                                                                                     
                                                                                                                                     
       LEFT JOIN (SELECT  total_pac_mes_passado, inscricao
                   FROM cli_fluxo_paciente  xx
                   WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
                                                FROM cli_fluxo_paciente x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) B ON B.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
      LEFT JOIN (SELECT  total_geral as pac_parcial_mp, inscricao, data_inclusao
                   FROM cli_envelhecimento_clinica  xx
                   WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) B22 ON B22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END

       LEFT JOIN (SELECT  qtd_falta_mes, qtd_marcacoes_mes, indice_falta, inscricao
                   FROM cli_indice_falta  xx
                   WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
                                                FROM cli_indice_falta x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ZE ON ZE.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END
       LEFT JOIN (SELECT  qtd_falta_mes, qtd_marcacoes_mes, indice_falta, inscricao,data_inclusao as data_falta_pmp
                   FROM cli_indice_falta  xx
                     WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO) ZE22 ON ZE22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END 
         LEFT JOIN (SELECT dataref,qtd_falta, qtd_marcacoes, indice_falta, inscricao
                     FROM cli_lin_indice_falta
                     WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d')))   ZE11
               ON ZE11.inscricao = CASE
                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                      ELSE substring(a.CNPJ,1,9)
                                   END
                		                                                                                                                                     
        LEFT JOIN (SELECT dataref,total_indic,total_contemplado,data_arquivo, inscricao
                     FROM cli_lin_cliente_amigo
                     WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) am
               ON am.inscricao = CASE
                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                      ELSE substring(a.CNPJ,1,9)
                                   END
      LEFT JOIN (SELECT dataref, total_indic,total_contemplado, inscricao, total_permitido
                   FROM cli_lin_cliente_amigo  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_cliente_amigo x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) am22 ON am22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END  
      LEFT JOIN (SELECT  total, inscricao
                   FROM cli_indice_nota_fiscal  xx
                   WHERE xx.data_inclusao =   (SELECT max(x.data_inclusao)
                                                FROM cli_indice_nota_fiscal x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ntfe ON ntfe.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END  
                                                                                                                                     
            LEFT JOIN (SELECT total_indic,total_contemplado, inscricao, data_inclusao as data_cliente_amigo_pmp
                   FROM cli_cliente_amigo  xx
                    WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) am33 ON am33.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                       
                                                                                                                                     
  		LEFT JOIN (SELECT  total, inscricao
                   FROM cli_indice_nota_fiscal  xx
                    WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) ntfe33 ON ntfe33.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                       
                                                                                                                                     
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_indice_nota_fiscal  xx
                    WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) ntfe22 ON ntfe22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                                                                                                                                       
       LEFT JOIN (SELECT INSCRICAO, abandono_trat, indice_abandono, MAX(data_inclusao) AS data_inclusao
                    FROM cli_indice_abandono XX
                   WHERE xx.data_inclusao = (SELECT max(x.data_inclusao)
                                               FROM cli_indice_abandono x
                                              WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO ) ab ON ab.INSCRICAO = CASE
                                                                                                                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                      ELSE substring(a.CNPJ,1,9)
                                              																						END
                                                                                                                                    
       LEFT JOIN (SELECT INSCRICAO, abandono_trat, indice_abandono, MAX(data_inclusao) AS data_inclusao
                    FROM cli_indice_abandono XX
                                  WHERE date(data_inclusao) >= DATE_SUB(CURDATE(), INTERVAL 31 DAY)  GROUP BY INSCRICAO ) AB22 ON AB22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END            
                                                                                                                                     
                                                                                                                                     
        LEFT JOIN (SELECT dataref,total, inscricao
                     FROM cli_lin_valor_entrada_orto
                     WHERE  DATA_ARQUIVO 
                     BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                     AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) orto
               ON orto.inscricao = CASE
                                      WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                      ELSE substring(a.CNPJ,1,9)
                                   END
  		
      LEFT JOIN (SELECT dataref, total, inscricao
                   FROM cli_lin_valor_entrada_orto  xx
                   WHERE xx.data_arquivo =   (SELECT max(x.data_arquivo)
                                                FROM cli_lin_valor_entrada_orto x
                                               WHERE  x.INSCRICAO = xx.INSCRICAO limit 1 )  GROUP BY INSCRICAO )or22 ON or22.INSCRICAO = CASE
                                                                                                                                       WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                                                                                                                                       ELSE substring(a.CNPJ,1,9)
                                                                                                                                     END                               

          WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim' ".$andWhereEstado." ";
       $resultado_soma_regional = $MySQLi->query($sql_soma_regional) OR trigger_error($MySQLi->error, E_USER_ERROR);



       $sql_media_pacientes_regional = "
		SELECT AVG(total_pac_mes_passado) as media_pacientes
		FROM cli_fluxo_paciente B
		JOIN ap_clinicas A
		  ON B.INSCRICAO = CASE
		                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
             WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_fluxo_paciente x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 ) and A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado." ";
       $query_media_pacientes_regional = $MySQLi->query($sql_media_pacientes_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_pacientes_regional = $query_media_pacientes_regional->fetch_object();
       $media_pacientes_mp_regional = $row_media_pacientes_regional->media_pacientes;
       
       
       
       $sql_media_orcamentos_regional = "SELECT AVG(orc_mespassado) as media_orc
      FROM  cli_orcamentos_x_inicios b
INNER JOIN  ap_clinicas a
        ON  b.inscricao =   CASE   
                               WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)   
                               ELSE substring(a.CNPJ,1,9)        
                             END 
 
    WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 )
      AND a.tipoclinica = 'F' AND a.ativo = 'Sim' ".$andWhereEstado." ";
       $query_media_orcamentos_regional = $MySQLi->query($sql_media_orcamentos_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_orcamentos_regional = $query_media_orcamentos_regional->fetch_object();
       $media_orcamentos_mp_regional = $row_media_orcamentos_regional->media_orc;
       
       
       
       $sql_media_inicios_regional = "SELECT AVG(ini_mespassado) as media_ini
FROM cli_orcamentos_x_inicios B
JOIN ap_clinicas A
  ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE b.data_inclusao = (SELECT max(x.data_inclusao)
   						   FROM cli_orcamentos_x_inicios x
    WHERE  x.INSCRICAO = b.INSCRICAO limit 1 ) and A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."";
       
       $query_media_inicios_regional = $MySQLi->query($sql_media_inicios_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_inicios_regional = $query_media_inicios_regional->fetch_object();
       $media_inicios_mp_regional = $row_media_inicios_regional->media_ini;
       
       $sql_media_documentacao_mp_regional ="
SELECT avg(total) as media_doc
FROM cli_lin_documentacao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_documentacao_regional = $MySQLi->query($sql_media_documentacao_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_documentacao_regional = $query_media_documentacao_regional->fetch_object();
       $media_documentacao_mp_regional = $row_media_documentacao_regional->media_doc;
       
       $sql_media_fm_mp_regional ="
SELECT avg(total) as media_fm
FROM cli_lin_fluxo_fm B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_fm_regional = $MySQLi->query($sql_media_fm_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_fm_regional = $query_media_fm_regional->fetch_object();
       $media_fm_mp_regional = $row_media_fm_regional->media_fm;
       
       $sql_media_faltosos_mp_regional ="
SELECT avg(total) as media_faltosos, avg(faltosos_agendados) as faltosos_agendados, avg(faltosos_atendidos) as faltosos_atendidos
FROM cli_lin_qtde_faltosos B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_faltosos_mp_regional = $MySQLi->query($sql_media_faltosos_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_faltosos_mp_regional = $query_media_faltosos_mp_regional->fetch_object();
       $media_total_faltosos_mp_regional = $row_media_faltosos_mp_regional->media_faltosos;
       $media_faltosos_agendados_mp_regional = $row_media_faltosos_mp_regional->faltosos_agendados;
       $media_faltosos_atendidos_mp_regional = $row_media_faltosos_mp_regional->faltosos_atendidos;
       
       $sql_media_custo_funcionario_mp_regional ="
SELECT avg(valor) as custo_funcionario
FROM cli_lin_custo_funcionario B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_custo_funcionario_mp_regional = $MySQLi->query($sql_media_custo_funcionario_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_custo_funcionario_mp_regional = $query_media_custo_funcionario_mp_regional->fetch_object();
       $media_custo_funcionario_mp_regional = $row_media_custo_funcionario_mp_regional->custo_funcionario;
       
       $sql_media_flutuantes_mp_regional ="
SELECT avg(total) as flutuantes
FROM cli_lin_flutuantes B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_flutuantes_mp_regional = $MySQLi->query($sql_media_flutuantes_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_flutuantes_mp_regional = $query_media_flutuantes_mp_regional->fetch_object();
       $media_flutuantes_mp_regional = $row_media_flutuantes_mp_regional->flutuantes;
       
       $sql_media_cancelamentos_mp_regional ="
SELECT avg(total) as cancelamentos
FROM cli_lin_cancelamento_ficha B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_cancelamentos_mp_regional = $MySQLi->query($sql_media_cancelamentos_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_cancelamentos_mp_regional = $query_media_cancelamentos_mp_regional->fetch_object();
       $media_cancelamentos_mp_regional = $row_media_cancelamentos_mp_regional->cancelamentos;
       
       $sql_media_suspensoes_mp_regional ="
SELECT avg(quantidade) as suspensao
FROM cli_lin_suspensao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_suspensoes_mp_regional = $MySQLi->query($sql_media_suspensoes_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_suspensoes_mp_regional = $query_media_suspensoes_mp_regional->fetch_object();
       $media_suspensoes_mp_regional = $row_media_suspensoes_mp_regional->suspensao;
       
       $sql_media_gastos_dental_mp_regional ="
SELECT avg(total) as gasto_dental
FROM cli_lin_gastos_dental B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_gastos_dental_mp_regional = $MySQLi->query($sql_media_gastos_dental_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_gastos_dental_mp_regional = $query_media_gastos_dental_mp_regional->fetch_object();
       $media_gastos_dental_mp_regional = $row_media_gastos_dental_mp_regional->gasto_dental;
       
       $sql_media_negociacao_mp_regional ="
SELECT avg(total_a_receber) as total_a_receber, avg(total_pago) as total_pago, avg(total_em_atraso) as total_em_atraso
FROM cli_lin_negociacao B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' ".$andWhereEstado."
		AND b.DATA_ARQUIVO
		BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
		AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
       $query_media_negociacao_mp_regional = $MySQLi->query($sql_media_negociacao_mp_regional) or trigger_error($MySQLi->error, E_USER_ERROR);
       $row_media_negociacao_mp_regional = $query_media_negociacao_mp_regional->fetch_object();
       $media_total_a_receber_mp_regional = $row_media_negociacao_mp_regional->total_a_receber;
       $media_total_pago_mp_regional = $row_media_negociacao_mp_regional->total_pago;
       $media_total_em_atraso_mp_regional = $row_media_negociacao_mp_regional->total_em_atraso;
       
       
       
       
       
       
       
        
