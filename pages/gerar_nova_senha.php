<?php

include "config.php";

$email = $_POST['email'];
$senha = $_POST['senha'];


/* $sql2 = "SELECT login FROM ap_usuarios_web WHERE senha='{$senha_antiga}'";
$query2 =  $MySQLi->query($sql2) OR trigger_error($MySQLi->error, E_USER_ERROR);
$num_rows = mysqli_num_rows($query2);
echo $num_rows; echo "cole"; echo $senha_antiga; */




	$senha = md5($senha);

	$sql2 = "UPDATE ap_usuarios_web SET senha='{$senha}', DataAlteracao = now(), ativo='Sim' WHERE login ='{$email}'";
		$query2 =  $MySQLi->query($sql2) OR trigger_error($MySQLi->error, E_USER_ERROR);
		echo "Sua senha foi alterada com sucesso!";
		header("refresh: 2; url=index.php");
	

	/* $headers = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: Teu Domínio - Webmaster<webmaster@redeodonto.com.br>"; //COLOQUE TEU EMAIL

	$subject = "Sua nova senha em RedeOdonto.com.br";
	$message = "Olá, redefinimos sua senha.<br /><br />

	<strong>Nova Senha</strong>: {$senha}<br /><br />

	<a href='http://www.redeodonto.com.br/'>http://www.redeodonto.com.br</a><br /><br />

	Obrigado!<br /><br />

	Webmaster<br /><br /><br />


	Esta é uma mensagem automática, por favor não responda!";

	mail($email, $subject, $message, $headers);

	echo "Sua nova senha foi gerada com sucesso e enviada para o seu email!<br />Por favor verifique seu email!<br /><br />"; */


	//echo "<META http-equiv='refresh' content='1;URL=http://www.redeodonto.com.br/admin'>"; 
?>