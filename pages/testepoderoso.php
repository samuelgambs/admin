<?php
/**
 * PHP e MySQL 
 *
 * 
 */

// Dados de acesso ao servidor MySQL
$MySQL = array(
	'servidor' => 'redeodonto.dyndns.org',	// Endereço do servidor
	'usuario' => 'protese',		// Usuário
	'senha' => 'jb88ff',				// Senha
	'banco' => 'redeodonto_beta'		// Nome do banco de dados
);

$MySQLi = new MySQLi($MySQL['servidor'], $MySQL['usuario'], $MySQL['senha'], $MySQL['banco']);

// Verifica se ocorreu um erro e exibe a mensagem de erro
if (mysqli_connect_errno())
    trigger_error(mysqli_connect_error(), E_USER_ERROR);
//$user->start();

$sqlclinica =
"   SELECT total, dataref
     FROM cli_lin_orcamento
    WHERE INSCRICAO = 17790630
      AND date(data_arquivo) BETWEEN ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1) 
      AND date(now()) 
 ORDER BY data_arquivo";


$sqlmedianacional =
"   SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 12 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 12 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 11 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 11 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))


UNION ALL

SELECT   AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 10 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 10 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))


UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 9 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 9 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))


UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 8 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 8 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 7 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 7 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT   AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 6 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 6 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 5 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 5 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT   AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 4 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 4 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT   AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 3 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 3 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 2 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 2 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))



UNION ALL

SELECT  AVG(B.total), b.dataref 
FROM ap_clinicas A
JOIN cli_lin_orcamento B
ON B.INSCRICAO = CASE
							WHEN LENGTH(a.CNPJ) > 11 THEN substring(a.CNPJ,1,8)
							ELSE substring(a.CNPJ,1,9)
						END
WHERE A.Ativo = 'Sim' AND A.TipoClinica = 'F'
AND B.DATA_ARQUIVO 
BETWEEN (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1),  '%Y-%m-%d'))
AND (SELECT DATE_FORMAT(ADDDATE(LAST_DAY(SUBDATE(ADDDATE(LAST_DAY(CURDATE()),1), INTERVAL 1 MONTH)), 1) - INTERVAL 1 SECOND, '%Y-%c-%d'))

		";

$query_clinica = $MySQLi->query($sqlmedianacional) or trigger_error($MySQLi->error, E_USER_ERROR);
$query_media = $MySQLi->query($sqlclinica) or trigger_error($MySQLi->error, E_USER_ERROR);
/* 

$meals = array('breakfast' => array('Walnut Bun','Coffee'),
			   'lunch'     => array('Cashew Nuts', 'White Mushrooms'),
			   'snack'     => array('Dried Mulberries','Salted Sesame Crab')); */

/* 
$row_clinica = $query_clinica->fetch_object();

$arrayClinica = array(); // criar array vazio

while($linha = mysqli_fetch_array($query_clinica, MYSQL_NUM)) {
	// incluir valores no array
	array_push($arrayClinica,
	array('dataref'=>$linha[1],
	'total'=>$linha[0]
	)
	);
}


while ($row_media = $query_media->fetch_object()){
   $arrayClinica["total"] =+ $row_media->total;
}
 */

/* $arrayMedia= array();
while($linha2 = mysqli_fetch_array($query_media, MYSQL_NUM)) {
	// incluir valores no array
	array_push($arrayMedia,
	array('dataref'=>$linha2[1],
	'total'=>$linha2[0]
	)
	);
}
 */

//$arrayClinica["total"]["dataref"] = 66666;

/* 
foreach($arrayMedia as $chave2) {
	echo var_dump($chave2). "
";
}  */

/* foreach($arrayClinica as $chave2) {
	echo var_dump($chave2). "
";
}


 */

/*
foreach($arrayDados2 as $key => $value) {
	$data[] = array('name' => $value, 'email' => $arrayDados[$key]);
}
print_r($data);


//array_unique(array_merge($array1, $array2));


$i=0;
$NewArray = array();
foreach($arrayDados as $value) {
	$NewArray[] = array_merge($value,array($arrayDados2));
	$i++;
}

$arroso = array_unique(array_merge($arrayDados, $arrayDados2)); //array_combine($row_media_nacional_cliente_amigo_mp2, $arrayDados);
 // conferir valores do array
  foreach($arroso as $chave) {
	echo var_dump($chave). "
";
}/*
  foreach($arrayDados2 as $chave2) {
	echo var_dump($chave2). "
";
}  */
 

/* $testa = array_merge_recursive($arrayDados,$arrayDados2);*/
/*   foreach($arroso as $chave2) {
	echo var_dump($chave2). "
";
}  
 */

// liberar mem�ria utilizada para consulta
//mysqli_free_result($query_lin_inicios_documentacao_orcamento2);

