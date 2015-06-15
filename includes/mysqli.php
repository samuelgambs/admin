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
?>