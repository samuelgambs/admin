<?php
/*
define('BD_USER', 'protese'); // USE O TEU USU�RIO DE BANCO DE DADOS
define('BD_PASS', 'jb88ff'); // USE A TUA SENHA DO BANCO DE DADOS
define('BD_NAME', 'redeodonto_beta'); // USE O NOME DO TEU BANCO DE DADOS

mysql_connect('redeodonto.dyndns.org', BD_USER, BD_PASS);
mysql_select_db(BD_NAME);
*/

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

?>

