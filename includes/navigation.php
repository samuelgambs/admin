  <?php
/* 
 * 
$usuario_id =$_SESSION['usuario_id'];
 */
require_once('../includes/mysqli.php');

//include "functions.php";
$usuario_id =$_SESSION['usuario_id'];

if  ($_SESSION['cod_usuario'] == '6') {
		$sqlbuscaclinicas =  "SELECT t1.nomefantasia,t1.idclinica
		FROM ( SELECT a.nomefantasia,a.idclinica
		FROM ap_clinicas a
		WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'
		GROUP BY substring(a.CNPJ,1,8) 
		ORDER BY nomefantasia ) T1
		INNER JOIN ap_clinica_socios T ON T.idClinica = T1.IdClinica
		WHERE T.idSocio = '$usuario_id' " ;
		$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);
}
else {
	$sqlbuscaclinicas =  " SELECT a.nomefantasia,a.idclinica
	FROM ap_clinicas a
	WHERE a.tipoclinica = 'F' AND a.Ativo = 'Sim'
			ORDER BY nomefantasia" ;
	$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);
}

?>
  
  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" >
 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="logo" href="#"><img class="img-responsive" src="../logo.png" alt=""/></a>
                
            </div>
            <!-- /.navbar-header -->
            <div> </div>

            <ul class="nav navbar-top-links navbar-right">
            <div style="position:relative;top:34px;left:-303px;">
            <?php 
                    echo "Bem vindo <strong>". $_SESSION['nome'] ." </strong> <br />";?><input type="hidden" value="<?php echo $_SESSION['cod_usuario'] ?>"> </div>
           
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Rede Odonto</strong>
                                    <span class="pull-right text-muted">
                                        <em>Hoje</em>
                                    </span>
                                </div>
                                <div>Bem Vindo ao Painel Rede Odonto</div>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ler todas mensagens</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Explorar o Painel</strong>
                                        <span class="pull-right text-muted">40% Completa</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Completa (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver Todas Tarefas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> Novo Comentário
                                    <span class="pull-right text-muted small">4 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Mensagem Enviada
                                    <span class="pull-right text-muted small">6 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Nova Tarefa
                                    <span class="pull-right text-muted small">2 minutos atrás</span>
                                </div>
                            </a>
                        </li>
                       
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver Todos Alertas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a data-toggle="modal" data-target="#modal_senha" href="#modal_senha" id="button_senha"><i class="fa fa-user fa-fw"></i>Alterar Senha</a>
                        </li>
                       
                        <li><a data-toggle="modal" data-target="#modal_cadastro" href="#modal_cadastro" id="button_cadastro">

                        <i class="fa fa-plus fa-fw"></i>Cadastro de Usuários</a>

                        </li>
                       
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                          <!--   <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> -->
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="../pages/index.php"><i class="fa fa-dashboard fa-fw"></i> Painel</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Gráficos Gerenciais<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../includes/head.php" target="blank">Tabela</a>
                                </li>
                                <li>
                                    <a href="#">Por Clínica <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                     <?php while ($row_busca_clinicas = $query_busca_clinicas->fetch_object()) { ?>
                                     
                                         <li>
                                             <a href="detalhado_clinica.php?idclinica=<?php echo $row_busca_clinicas->idclinica;?>" target="panels"><?php echo ucfirst(strtolower($row_busca_clinicas->nomefantasia))?></a>
                                        </li>
                                     
                                              
                                        <?php  } ?> 
                                    
                                    
                                        
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                
                                
                                 
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-info-circle fa-fw"></i> Informe-se<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Comunicados</a>
                                </li>
                                <li>
                                    <a href="#">Imprensa</a>
                                </li>
                                <li>
                                    <a href="#">Apresentações</a>
                                </li>
                                <li>
                                    <a href="#">Manuais</a>
                                </li>
                                <li>
                                    <a href="#">Imagens</a>
                                </li>
                                <li>
                                    <a href="#">Bibliotecas</a>
                                </li>
                                <li>
                                    <a href="#">Vídeos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-rss fa-fw"></i> Marketing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Clipping</a>
                                </li>
                                <li>
                                    <a href="#">Destaques</a>
                                </li>
                                <li>
                                    <a href="#">Solicitação de Peças</a>
                                </li>
                                <li>
                                    <a href="#">Calendário de Marketing</a>
                                </li>
                                  <li>
                                    <a href="#">Gestão <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                         <li>
                                             <a href="#">Arquivos</a>
                                        </li>
                                        <li>
                                            <a href="#">Comunicação Franqueados</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Treinamentos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Cursos</a>
                                </li>
                                <li>
                                    <a href="#">Vídeos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Colaboração<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Forum</a>
                                </li>
                                <li>
                                    <a href="#">Calendário</a>
                                </li>
                                 <li>
                                    <a href="#">Enquete</a>
                                </li>
                                 <li>
                                    <a href="#">Questionário</a>
                                </li>
                                 <li>
                                    <a href="#">FAQ</a>
                                </li>
                                 <li>
                                    <a href="#">Listas a Fazer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Suporte<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Fale Conosco</a>
                                </li>
                                <li>
                                    <a href="#">Suporte</a>
                                </li>
                                <li>
                                    <a href="#">SAF</a>
                                </li>
                                <li>
                                    <a href="#">SAC</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         <!-- Modal  cadastro usuarios -->
                            <div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width: 300px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Cadastro de Usuários</h4>
                                        </div>
     										 <iframe src="" frameborder="0" width="100%" height="400px"></iframe>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="button_close" name="button_close" >Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                             <!-- Modal  ALTERAR SENHA -->
                            <div class="modal fade" id="modal_senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" style="width: 300px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Definir Nova Senha</h4>
                                        </div>
     										 <iframe src="" frameborder="0" width="100%" height="400px"></iframe>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="button_close" name="button_close" >Fechar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            
                        
							    
							    
							    
							    
							    