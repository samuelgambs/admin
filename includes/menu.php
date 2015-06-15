<?php 
if (!isset($id)) {
 $id = ($_GET['id']);	
}
$idclinica = ($_GET['idclinica']);	
?>
<div class="navbar-default sidebar" role="navigation">
              <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                  <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                      <input type="text" class="form-control" placeholder="Pesquisar">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i></button>
                      </span></div>
                    <!-- /input-group -->
                  </li>
                  <li> <a href="index.php?idclinica=<?php echo $idclinica ?>"><i class="fa fa-dashboard fa-fw"></i> Painel</a></li>
                  <li> <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Gráficos<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                      <li> <a href="flot.php?idclinica=<?php echo $idclinica ?>">Gráficos</a></li>
                      <li> <a href="linha.php?idclinica=<?php echo $idclinica ?>">Detalhado Mês a Mês</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                  </li>
                  <li> <a href="tables.php?idclinica=<?php echo $idclinica ?>"><i class="fa fa-table fa-fw"></i> Tabelas</a></li>
                   
                         <li>
                            <a href="clinicas.php?idclinica=<?php echo $idclinica ?>"><i class="fa fa-globe fa-fw"></i>Clínicas<span class="fa arrow"></span></a>
                            
               
                </li>
                         <li><a href="filtro.php"><i class="fa fa-sliders fa-fw"></i>Filtro<span class="fa arrow"></span></a></li>
                </ul>
  </div>
              <!-- /.sidebar-collapse -->
            </div>