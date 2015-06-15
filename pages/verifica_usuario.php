<?php
session_start();  // Inicia a session

include "config.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

if((!$email) || (!$senha)){
	echo '<script type="text/javascript">alert("Por favor, todos campos devem ser preenchidos!");</script>';

	include "login.php";

}
else{

	$senha = md5($senha);
	
	$sql = "SELECT a.IdUser, a.nome, a.idUserGrupo, b.descricao, b.codigo, a.ativo
		   FROM ap_usuarios_web a
		  	 INNER JOIN ap_usuarios_grupo B
				ON A.idUserGrupo = B.idUserGrupo
			 WHERE Login='{$email}' AND senha='{$senha}' ";
	$query =  $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
	$login_check = mysqli_num_rows($query);
	

	if($login_check > 0){

  		while ($row = $query->fetch_object()) {
			$usuario_id = $row->IdUser; 
			$nome =	$row->nome;
			$nivel_usuario = $row->codigo;
			$idgenerico = $row->idGenerico;
			$descricao = $row->descricao;	
			$ativo = $row->ativo;	
  		}

  		 $_SESSION['IdUser'] = $usuario_id;
  		 $_SESSION['nome'] = $nome;
  		 //$_SESSION['sobrenome'] = $sobrenome;
  		 $_SESSION['email'] = $email;
  		 $_SESSION['nivel_usuario'] = $descricao; 
  		 $_SESSION['cod_usuario'] = $nivel_usuario;
			
			
		$sql2="UPDATE ap_usuarios_web SET DataAlteracao = now() WHERE IdUser = '$usuario_id'";
		$query2 =  $MySQLi->query($sql2) OR trigger_error($MySQLi->error, E_USER_ERROR);
		
		$_SESSION['usuario_id'] = $usuario_id;
		
		if ($ativo == 'Sim'){
			
			header("Location: ../pages/index.php");

		}
		else 
			header("Location: ../pages/formulario_senha_perdida.php");
			
		
		
	
			
			
		

	}
	else{
		echo '<script type="text/javascript">alert("Errado. Por favor tente novamente!");</script>';

		include "login.php";

	}
}

?>