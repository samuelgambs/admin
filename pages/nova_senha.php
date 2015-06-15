<?php
//session_start();  // Inicia a session

include "config.php";

$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_antiga = $_POST['old_pass'];
$senha_antiga = md5($senha_antiga);
	
	$sql = "SELECT IdUser, nome, a.idUserGrupo,idGenerico, b.descricao, b.codigo, ativo
		   FROM ap_usuarios_web a
		  	 INNER JOIN ap_usuarios_grupo B
				ON A.idUserGrupo = B.idUserGrupo
			 WHERE Login='{$email}' AND senha='{$senha_antiga}' ";
	$query =  $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
	$login_check = mysqli_num_rows($query);
	
	if($login_check === 0){
		echo "Sua senha atual não confere!";
		header("refresh: 2; url=formulario_nova_senha.php"); 		
		
	}
	else{
		$senha = md5($senha);
		
		$sql2 = "UPDATE ap_usuarios_web SET senha='{$senha}', DataAlteracao = now(), ativo='Sim' WHERE login ='{$email}'";
		$query2 =  $MySQLi->query($sql2) OR trigger_error($MySQLi->error, E_USER_ERROR);
		echo "Sua senha foi alterada com sucesso!";
	}
		
		/* 	
		if ($ativo == 'Sim'){
			echo "sim";
			
			//header("Location: ../pages/index.php");

		}
		else 
			//header("Location: ../pages/formulario_senha_perdida.php");
			echo "nao"; 
			
		
		
	
			
			
		

	} */
	/* else{
		echo '<script type="text/javascript">alert("Errado. Por favor tente novamente!");</script>';

		include "login.php";

	} */


?>