<?php
 
               $andWhereSocio =  "WHERE T.idSocio = '$idsocio'";

	$sql = 	   
 			   "SELECT *
					FROM ( SELECT a.nomefantasia, a.Estado, a.idclinica, a.idempresa,
                  k.orc_mesatual, Round(k.orc_mesatual * 100 / u.total,2) as orcamentos_sob_pacientes,
                 k.ini_mesatual, Round(k.ini_mesatual * 100 / u.total,2) as inicios_sob_pacientes, K22.ini_parcial_mp, K22.orc_parcial_mp, k22.data_inclusao_parcial_mp as data_ini_orc_pmp,
                 Round(k.ini_mesatual * 100 / k.orc_mesatual,2) as inicios_sob_orcamentos, k.orc_mespassado,k.ini_mespassado,
                 i.documentacao_mes, y2.total as documentacao_mp, Round(i.documentacao_mes * 100 / u.total,2) as documentacao_sob_pacientes, i22.doc_parcial_mp, i22.data_inclusao as data_doc_pmp,
                 Round(u.total,0) as total_paciente,  Round(t.total * 100 / u.total,2) as faltosos_sob_pacientes, t.faltosos_agendados, t.faltosos_atendidos,
      			 t.total as total_faltosos, t2.total as total_faltosos_mp, t2.faltosos_atendidos as faltosos_atendidos_mp,
  				 t2.faltosos_agendados as faltosos_agendados_mp, t22.falt_total_parcial_mp, t22.falt_agend_parcial_mp, t23.falt_atend_parcial_mp, t22.data_inclusao as data_falt_age_pmp,t23.data_inclusao as data_falt_ate_pmp,
                 g.qtd_flutuantes as flutuantes, g2.total as flutuantes_mp,  Round(g.qtd_flutuantes * 100 / u.total,2) as flutuantes_sob_pacientes, flut_parcial_mp,G22.data_inclusao as data_flut_pmp,
                 r.total_a_receber, r.total_em_atraso, r.total_pago, r2.total_a_receber as total_a_receber_mp, r2.total_em_atraso as total_em_atraso_mp, r2.total_pago as total_pago_mp,
                 r22.total_a_receber_parcial_mp, r22.total_pago_parcial_mp, r22.total_em_atraso_parcial_mp, r22.data_inclusao as data_neg_pmp,
                 s.receita, s.despesa, s.lucro,
                 Round(s.lucro/b.total_pac_mes_passado,2) as media_lucro,
                 Round(s.despesa/b.total_pac_mes_passado,2) as media_gasto,
                 v.valor as custo_funcionario, v2.valor as custo_funcionario_mp, Round(v.valor / u.total,2) as custo_funcionario_sob_pacientes,
                 y.quantidade as suspensoes,sp.quantidade as suspensoes_mp,Round(y.quantidade * 100 / u.total,2) as suspensoes_sob_pacientes, sp22.suspensoes_pmp, sp22.data_suspensoes_pmp,
                 z.total as cancelamento_ficha,  z2.total as cancelamento_ficha_mp,Round(z.total * 100 / u.total,2) as cancelamento_sob_pacientes,z22.cancelamento_ficha_pmp,z22.data_cancelamento_pmp,
                 w.total as custo_dental,w2.total as custo_dental_mp, Round(w.total / u.total,2) as custo_dental_sob_pacientes,w22.custo_dental_pmp,w22.data_custo_dental_pmp,
                 c.total as fluxo_fm,y3.total as fm_mp,  Round(c.total * 100 / u.total,2) as fluxo_fm_sob_pacientes,C22.fm_parcial_mp, c33.fmpagantes, c33.fmnaopagantes, c22.data_inclusao as data_fm_pmp,
                 b.total_pac_mes_passado, b22.pac_parcial_mp, b22.data_inclusao as data_pac_pmp,
                 ze.qtd_falta_mes, ze.qtd_marcacoes_mes, ze.indice_falta,
                 ze22.qtd_falta_mes as qtd_falta_mes_pmp, ze22.qtd_marcacoes_mes as qtd_marcacoes_mes_pmp, ze22.indice_falta as indice_falta_pmp,ze22.data_falta_pmp,
                 ze11.qtd_falta as qtd_falta_mes_mp, ze11.qtd_marcacoes as qtd_marcacoes_mes_mp, ze11.indice_falta as indice_falta_mp,
                 am.total_indic as total_indic_mp, am.total_contemplado as total_contemplado_mp, am22.total_indic as total_indic_ma, am22.total_contemplado as total_contemplado_ma,am22.total_permitido,
                 ntfe.total as nota_fiscal_ma,  ntfe22.total as nota_fiscal_mp, ntfe33.total as nota_fiscal_pmp,
                 ab.abandono_trat, ab.indice_abandono, ab22.abandono_trat as abandono_trat_pmp, ab22.indice_abandono as indice_abandono_pmp, ab22.data_inclusao as data_abandono_pmp,
                 orto.total as orto_mp, or22.total as orto_atual, am33.total_indic as total_indic_pmp, am33.total_contemplado as total_contemplado_pmp,am33.data_cliente_amigo_pmp

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
      LEFT JOIN (SELECT dataref, total_indic,total_contemplado,total_permitido, inscricao
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

          WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'   ".$andWhereEstado."
			    GROUP BY substring(a.CNPJ,1,8) ) T1 
                INNER JOIN ap_clinica_socios T ON T.idClinica = T1.IdClinica AND T.IDEMPRESA = T1.IDEMPRESA  
                ".$andWhereSocio." ";