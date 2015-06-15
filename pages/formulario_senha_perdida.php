<?php 
session_start();

include "functions.php";

session_checker();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Formulário Nova Senha</title>
<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
}
-->
</style>
  <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<script type="text/javascript">
    function validarSenha(){
    
    	senha1 = document.form1.senha.value
    	senha2 = document.form1.senha2.value

    	if(senha1 == null || senha2 =="" ){
            alert('Favor preencher todos os campos');      
            return false;
        }

    	if (senha1 == senha2)
    		document.forms["form1"].submit();
    	else
    		alert("Sua nova senha não confere");
			return false;
    }
</script>

<body>

    
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top:0">
                   
                    <div class="panel-body">
Vamos precisar alterar sua senha. <br></br>                   
<form name="form1" method="post" action="gerar_nova_senha.php">

Por favor digite sua nova senha:<br />

<input name="email" type="hidden" class="form-control" id="email" value="<?php echo $_SESSION['email']?>" /><br>

<input name="senha"  id="senha" type="password" placeholder="Digite sua senha" class="form-control" /></br>

<input name="senha2"  id="senha2" type="password" placeholder="Confirme sua nova senha" class="form-control" /></br>

<input  name="Submit" value="Definir Nova Senha" class="btn btn-success" onClick="validarSenha()" /></br>
</form>
</div>
                </div>
            </div>
   


	
   <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>