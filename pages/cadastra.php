<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php

include "config.php";
//include "functions.php";


$email = trim($_POST['email']);
$senha = trim($_POST['senha']);


$tipouser = trim($_POST['tipo_usuario']);


if  ($tipouser == '6')
	$usuario = trim($_POST['socios']);  
else 
	$usuario = trim($_POST['administradores']);


/* Vamos checar algum erro nos campos, mas tenha em mente que existem formas bem mais eficientes de tratar os dados que s�o enviados ou n&atilde;o pelos campos do formul�rio */

if ((!$email) || (!$senha)|| (!$usuario)){

	
	echo '<script type="text/javascript">';
	echo 'alert("ERRO: Você não enviou as seguintes informações requeridas para o cadastro!");';
	echo '</script>';
	

	if (!$senha){

		echo '<script type="text/javascript">';
		echo 'alert("Senha é um campo requerido.");';
		echo '</script>';
	}

	

	if (!$email){
		echo '<script type="text/javascript">';
		echo 'alert("Email é um campo requerido.");';
		echo '</script>';
	}

	if (!$usuario){

		echo '<script type="text/javascript">';
		echo 'alert("Nome de Usuário é um campo requerido.");';
		echo '</script>';

	}

	include "formulario_cadastro.php"; 

}
else{

	/* Vamos checar se o nome de Usu�rio escolhido e/ou Email j� existem no banco de dados */

	$sql_email_check = "SELECT iduser
						  FROM ap_usuarios_web
						 WHERE login='$email'";
	$query_email_check = $MySQLi->query($sql_email_check) or trigger_error($MySQLi->error, E_USER_ERROR);
	$sql_usuario_check = "SELECT nome
						FROM ap_usuarios_web WHERE iduser='{$usuario}'";
	$query_usuario_check = $MySQLi->query($sql_usuario_check) or trigger_error($MySQLi->error, E_USER_ERROR);

	//$eReg = mysql_fetch_array($sql_email_check);
	//$uReg = mysql_fetch_array($sql_usuario_check);
	$email_check = mysqli_num_rows($query_email_check);
	$usuario_check =  mysqli_num_rows($query_usuario_check);
	if (($email_check > 0) || ($usuario_check > 0)){

		

		if ($email_check > 0){
			echo '<script type="text/javascript">';
			echo 'alert("Este email '.$email.' já está sendo utilizado. Por favor utilize outra conta de email! ");';
			echo '</script>';
			
		    unset($email);

		}

		if ($usuario_check > 0){
			
			echo '<script type="text/javascript">';
			echo 'alert("Este nome de usuário já está sendo utilizado. Por favor utilize outro nome de usuário ");';
			echo '</script>';				

			unset($usuario);

		}

		echo "<br />";
		include "formulario_cadastro.php";

	}
	else
	{

		$email = strtolower(trim($_POST['email']));
		$char = "@";
		$pos = strpos($email, $char);

        if ($pos === false){

			echo "<strong>ERRO:</strong><br />";
			echo "O endereço de email '.$email.'</em></strong> ] que está tentando utilizar não é válido.";
			echo "Por favor, utilize um email v&aacute;lido.<br /><br />";
			include "formulario_cadastro.php"; 

        }else{

				function verifica_email($EMAIL){

				    list($User, $Domain) = explode("@", $EMAIL);
				    $result = @checkdnsrr($Domain, 'MX');

				    return($result);

				}

            $v_mail = verifica_email($email);

            if ($v_mail){

                /* Se passarmos por esta verifica��o ilesos � hora de finalmente cadastrar
	    	    os dados Vamos utilizar uma fun��o para gerar uma senha rand�mica�*/ 

				$senha = md5($senha);

				// Inserindo os dados no banco de dados

					$sql_nome_check = "SELECT nome
					FROM ap_socios WHERE idsocio='{$usuario}'";
					$query_nome_check = $MySQLi->query($sql_nome_check) or trigger_error($MySQLi->error, E_USER_ERROR);
					$row_busca_nome = $query_nome_check->fetch_object();
					$nome = $row_busca_nome->nome;


				if ($tipouser == 6){
					$usergrupo= '46D0ED84-C8D8-4C7C-9FBE-EFE20AF3C6AE'; }
					else { $usergrupo= '018A62D9-638D-11E4-A503-0293ADBEA581';}


				$sql = "INSERT INTO ap_usuarios_web (iduser, idusergrupo, Ativo, nome, login, senha, dataCadastro) 
									VALUES('{$usuario}', '$usergrupo' ,' Nao', '{$nome}', '{$email}', '{$senha}', now())";

				$query_insert = $MySQLi->query($sql) or trigger_error($MySQLi->error, E_USER_ERROR);


				if (!$query_insert){
					
					echo '<script type="text/javascript">';
					echo 'alert("Ocorreu algum erro ao criar sua conta, por favor entre em contato com o Webmaster.");';
					echo '</script>';				
				}
				else {

							echo '<script type="text/javascript">'; 
							echo 'alert("Usuário cadastrado com sucesso!");'; 
							if ($_POST["tipo_usuario_logado"] == 6)
								echo 'window.location.href="formulario_cadastro.php?tipouser=6";';
							elseif ($_POST["tipo_usuario_logado"] == 0)
								echo 'window.location.href="formulario_cadastro.php?tipouser=0";';
							echo '</script>';

							/* Enviando email Destinatário */
								$to = "$email" . ", " ; // Observe a vírgula
							
								/* assunto */
								$subject = "Usuário Cadastrado no Site Rede Odonto";

								/* mensagem */
								$message = '

								<head>
								<title>Usuário Cadastrado no Site Rede Odonto</title>
								</head>
								<body>
								".$usuario."".$nome."".$email."
								</body>

								';


								/* Para enviar email HTML */
								$headers = "MIME-Version: 1.0\r\n";
								$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

								/* headers adicionais */
								$headers .= "To: ".$nome." <".$email.">";
								$headers .= "From: Webmaster Rede Odonto <webmaster@redeodonto.com.br>\r\n";

								$headers .= "Cc: webmaster@redeodonto.com.br\r\n";

								/* Enviar o email */
								mail($to, $subject, $message, $headers);
				}

            }else{

                echo "<strong>ERRO:</strong><br />";
                echo "O endereço de email [ <strong><em>".$email."</em></strong> ] que está; tentando utilizar não é válido.<br />";
                echo "Por favor, utilize um email válido.<br /><br />";
				include "formulario_cadastro.php"; 

            }

        }

    }

}

?>