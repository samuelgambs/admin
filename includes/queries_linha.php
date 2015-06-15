<?php

$busca_lin_documentacao2 =
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_documentacao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_documentacao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_documentacao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_documentacao2 = $MySQLi->query($busca_lin_documentacao2) or trigger_error($MySQLi->error, E_USER_ERROR);



$busca_lin_flutuantes2 =
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_flutuantes B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_flutuantes
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_flutuantes B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_flutuantes2 = $MySQLi->query($busca_lin_flutuantes2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_fluxo_fm2 = 
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_fm B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_fm
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_fm B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_fluxo_fm2 = $MySQLi->query($busca_lin_fluxo_fm2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_fluxo_paciente2 =

"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_fluxo_paciente B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_fluxo_paciente
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_fluxo_paciente B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_busca_lin_fluxo_paciente2 = $MySQLi->query($busca_lin_fluxo_paciente2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_inicio2 =

"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_inicio B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_inicio
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_inicio B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_inicio2 = $MySQLi->query($busca_lin_inicio2) or trigger_error($MySQLi->error, E_USER_ERROR);

$busca_lin_orcamento2 =
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_orcamento
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_orcamento B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
    							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
    							ELSE substring(a.CNPJ,1,9)
    						END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_orcamento2 = $MySQLi->query($busca_lin_orcamento2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_comparativo_receita_despesas2 =
"SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.lucro) AS media_nacional, x.lucro AS lucro_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_comparativo_receita_despesas B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,lucro,data_arquivo
             FROM cli_lin_comparativo_receita_despesas
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(lucro) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_comparativo_receita_despesas B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
  ";
$query_lin_comparativo_receita_despesas2 =  $MySQLi->query($busca_lin_comparativo_receita_despesas2) or trigger_error($MySQLi->error, E_USER_ERROR);


$sql_busca_lin_suspensoes =
"SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.quantidade) AS media_nacional, x.quantidade AS quantidade, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_suspensao B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,quantidade,data_arquivo
             FROM cli_lin_suspensao
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(quantidade) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_suspensao B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_busca_lin_suspensoes =  $MySQLi->query($sql_busca_lin_suspensoes) or trigger_error($MySQLi->error, E_USER_ERROR);



$sql_busca_gastos_dental2 =

"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_gastos_dental B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_gastos_dental
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_gastos_dental B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_busca_gastos_dental2 = $MySQLi->query($sql_busca_gastos_dental2) or trigger_error($MySQLi->error, E_USER_ERROR);



$sql_busca_custo_funcionario =
"SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.valor) AS media_nacional, x.valor AS valor, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_custo_funcionario B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,valor,data_arquivo
             FROM cli_lin_custo_funcionario
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(valor) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_custo_funcionario B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_busca_lin_custo_funcionario =  $MySQLi->query($sql_busca_custo_funcionario) or trigger_error($MySQLi->error, E_USER_ERROR);


$sql_busca_lin_qtde_faltosos2 =
"SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total, faltosos_agendados, faltosos_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

 SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
 SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.total AS total_clinical, x.faltosos_agendados,x.faltosos_atendidos,
 AVG(B.total) AS media_nacional_total, AVG(B.faltosos_Agendados) as media_nacional_agendados, avg(B.FALTOSOS_ATENDIDOS) as media_nacional_atendidos,
 y.regional_total, y.regional_agendados, y.regional_atendidos
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";

$query_busca_lin_qtde_faltosos2 = $MySQLi->query($sql_busca_lin_qtde_faltosos2) or trigger_error($MySQLi->error, E_USER_ERROR);
$query_busca_lin_qtde_faltosos3 = $MySQLi->query($sql_busca_lin_qtde_faltosos2) or trigger_error($MySQLi->error, E_USER_ERROR);



$sql_busca_lin_cancelamento_ficha2 =
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_cancelamento_ficha B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_cancelamento_ficha
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_cancelamento_ficha B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";

$query_busca_lin_cancelamento_ficha2 = $MySQLi->query($sql_busca_lin_cancelamento_ficha2) or trigger_error($MySQLi->error, E_USER_ERROR);


//CLIENTE AMIGO

$sql_busca_lin_cliente_amigo =
"SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL
  
  SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL
  
  SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL
  
  SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL
  
  SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL
  
  SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_indic) AS media_nacional_indic, AVG(B.total_contemplado) as media_nacional_contemplado, x.total_indic AS total_indic_clinica, x.total_contemplado as total_contemplado_clinica, y.media_regional_indic, y.media_regional_contemplado
FROM ap_clinicas A
JOIN cli_lin_cliente_amigo B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_indic,data_arquivo,total_contemplado
             FROM cli_lin_cliente_amigo
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_indic) AS media_regional_indic, AVG(total_contemplado) as media_regional_contemplado, data_arquivo
             FROM cli_lin_cliente_amigo B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))                                                                          
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))  ";
$query_busca_cliente_amigo =  $MySQLi->query($sql_busca_lin_cliente_amigo) or trigger_error($MySQLi->error, E_USER_ERROR);


//entrada ORTO

$busca_lin_entrada_orto =
"SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
  SELECT   b.dataref, AVG(B.total) AS media_nacional, x.total AS total_clinical, y.media_regional
FROM ap_clinicas A
JOIN cli_lin_valor_entrada_orto B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,data_arquivo
             FROM cli_lin_valor_entrada_orto
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
 left JOIN (SELECT dataref,AVG(total) AS MEDIA_REGIONAL,data_arquivo
             FROM cli_lin_valor_entrada_orto B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_lin_entrada_orto = $MySQLi->query($busca_lin_entrada_orto) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_inicios_documentacao_orcamento =
"SELECT a.dataref, b.total as inicios, c.total as documentacao,a.total as orcamentos
FROM cli_lin_orcamento a
INNER JOIN (SELECT dataref,total, inscricao FROM cli_lin_inicio) b on b.inscricao = a.inscricao and a.dataref = b.dataref
INNER JOIN (SELECT dataref,total, inscricao FROM cli_lin_documentacao) c on c.inscricao = a.inscricao and a.dataref = c.dataref
WHERE a.INSCRICAO = $id
ORDER BY a.data_arquivo desc
LIMIT 12";
$busca_lin_inicios_documentacao_orcamento2 =
"SELECT a.dataref, b.total as inicios, c.total as documentacao,a.total as orcamentos
FROM cli_lin_orcamento a
INNER JOIN (SELECT dataref,total, inscricao FROM cli_lin_inicio) b on b.inscricao = a.inscricao and a.dataref = b.dataref
INNER JOIN (SELECT dataref,total, inscricao FROM cli_lin_documentacao) c on c.inscricao = a.inscricao and a.dataref = c.dataref
WHERE a.INSCRICAO = $id
ORDER BY a.data_arquivo asc
LIMIT 12";

$query_lin_inicios_documentacao_orcamento = $MySQLi->query($busca_lin_inicios_documentacao_orcamento) or trigger_error($MySQLi->error, E_USER_ERROR);
$query_lin_inicios_documentacao_orcamento2 = $MySQLi->query($busca_lin_inicios_documentacao_orcamento2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_negociacao2 =
"SELECT dataref,
total_a_receber,total_em_atraso,
total_pago,
data_arquivo
FROM cli_lin_negociacao
WHERE INSCRICAO = $id
AND date(data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1)
AND date(now())
ORDER BY data_arquivo";
$query_lin_negociacao2 = $MySQLi->query($busca_lin_negociacao2) or trigger_error($MySQLi->error, E_USER_ERROR);


$busca_lin_tratamento_inicio_x_orcamento =
"SELECT a.dataref,a.total as orcamentos, b.total as inicios, b.total/a.total*100 as proporcao, a.data_arquivo
FROM cli_lin_orcamento a
INNER JOIN (SELECT dataref,total,data_arquivo, inscricao FROM cli_lin_inicio) b on b.inscricao = a.inscricao and a.dataref = b.dataref
WHERE a.INSCRICAO = $id
AND date(a.data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1)
AND date(now())
ORDER BY a.data_arquivo";
$query_lin_tratamento_inicio_x_orcamento = $MySQLi->query($busca_lin_tratamento_inicio_x_orcamento) or trigger_error($MySQLi->error, E_USER_ERROR);

$busca_lin_faltosos_agendados = 
"SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total, faltosos_agendados, faltosos_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))                                                                             AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y           
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL

SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo
             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END 
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref 
 
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO 
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
  
    UNION ALL
  
  
SELECT b.dataref, x.faltosos_agendados,
AVG(B.faltosos_Agendados) as media_nacional_agendados,
 y.regional_agendados 
FROM ap_clinicas A
JOIN cli_lin_qtde_faltosos B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
LEFT JOIN (SELECT dataref,total,faltosos_agendados, faltosos_atendidos,data_arquivo
             FROM cli_lin_qtde_faltosos
            WHERE INSCRICAO = $id) x
 ON x.dataref = b.dataref 
 
LEFT JOIN (SELECT dataref,AVG(total) AS Regional_total, avg(faltosos_agendados) as regional_agendados, avg(faltosos_atendidos) as regional_atendidos, data_arquivo

             FROM cli_lin_qtde_faltosos B
             JOIN ap_clinicas A 
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO 
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
                                                                          AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))";
$query_busca_lin_faltosos_agendados = $MySQLi->query($busca_lin_faltosos_agendados) or trigger_error($MySQLi->error, E_USER_ERROR);


$sql_busca_lin_abandono =
"SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

  UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
    UNION ALL

SELECT   b.dataref, AVG(B.total_abandono) AS media_nacional_abandono, AVG(B.total_tratamento) as media_nacional_tratamento, AVG(B.indice_abandono) as media_nacional_indice,
x.total_abandono AS total_abandono_clinica, x.total_tratamento as total_tratamento_clinica, x.indice_abandono as total_indice_clinica,
y.media_regional_abandono, y.media_regional_tratamento,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_abandono B
ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                 END
LEFT JOIN (SELECT dataref,total_abandono,data_arquivo,total_tratamento, indice_abandono
             FROM cli_lin_indice_abandono
            WHERE INSCRICAO = 18170435) x
 ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(total_abandono) AS media_regional_abandono, AVG(total_tratamento) as media_regional_tratamento,AVG(indice_abandono) as media_regional_indice, data_arquivo
             FROM cli_lin_indice_abandono B
             JOIN ap_clinicas A
              ON B.INSCRICAO = CASE
                  WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
                  ELSE substring(a.CNPJ,1,9)
                END
            WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = 'go' AND B.DATA_ARQUIVO
                                                                          BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
   AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
 ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
  AND B.DATA_ARQUIVO
  BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
  AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d')) ";
$query_busca_abandono =  $MySQLi->query($sql_busca_lin_abandono) or trigger_error($MySQLi->error, E_USER_ERROR);
$sql_busca_lin_indice_falta =
"SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))
UNION ALL

SELECT   b.dataref, AVG(B.qtd_falta) AS media_nacional_faltas, AVG(B.qtd_marcacoes) as media_nacional_marcacoes, AVG(B.indice_falta) as media_nacional_indice,
x.qtd_falta AS total_falta_clinica, x.qtd_marcacoes as total_marcacoes_clinica, x.indice_falta as total_indice_clinica,
y.media_regional_falta, y.media_regional_marcacoes,y.media_regional_indice
FROM ap_clinicas A
JOIN cli_lin_indice_falta B
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
LEFT JOIN (SELECT dataref,qtd_falta,data_arquivo,qtd_marcacoes, indice_falta
FROM cli_lin_indice_falta
WHERE INSCRICAO = $id) x
ON x.dataref = b.dataref

LEFT JOIN (SELECT dataref,AVG(qtd_falta) AS media_regional_falta, AVG(qtd_marcacoes) as media_regional_marcacoes,AVG(indice_falta) as media_regional_indice, data_arquivo
FROM cli_lin_indice_falta B
JOIN ap_clinicas A
ON B.INSCRICAO = CASE
WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
ELSE substring(a.CNPJ,1,9)
END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F' AND A.ESTADO = '$estado' AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))) Y
ON Y.dataref = b.dataref

WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d')) ";
$query_busca_indice_falta =  $MySQLi->query($sql_busca_lin_indice_falta) or trigger_error($MySQLi->error, E_USER_ERROR);
