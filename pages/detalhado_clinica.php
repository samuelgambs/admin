<?php

require_once('../includes/queries.php');
include "functions.php";
session_start();
session_checker();
error_reporting(E_ALL);
require_once('../includes/queries_linha.php');

$usuario_id =$_SESSION['usuario_id'];

//COMENTANDO PANE NO SELECT
/* 
if  ($_SESSION['cod_usuario'] === '6') {
	
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
	ORDER BY a.nomefantasia" ;
	$query_busca_clinicas = $MySQLi->query($sqlbuscaclinicas) or trigger_error($MySQLi->error, E_USER_ERROR);
} */


?>

<!DOCTYPE html>
<html lang="en">

<head>
<style type="text/css">
* {
  @include box-sizing(border-box);
}

$pad: 20px;

.grid {
  background: white;
  margin: 0 0 $pad 0;

  &:after {
    /* Or @extend clearfix */
    content: "";
    display: table;
    clear: both;
  }
}

[class*='col-'] {
  float: left;
  padding-right: $pad;
  .grid &:last-of-type {
    padding-right: 0;
  }
}
.col-2-3 {
  width: 66.66%;
}
.col-1-3 {
  width: 33.33%;
}
.col-1-2 {
  width: 50%;
}
.col-1-4 {
  width: 25%;
}
.col-1-8 {
  width: 12.5%;
}

/* Opt-in outside padding */
.grid-pad {
  padding: $pad 0 $pad $pad;
  [class*='col-']:last-of-type {
    padding-right: $pad;
  }
}
.chart {
  width: 100%;
  height: 600px;
}


</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto - Relatórios Gerenciais</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>


     <?php include '../includes/graficos_js.php';?>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php /*include '../includes/navigation.php';*/?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-header">
                    Relatórios Gerenciais:
                     <?php echo ucfirst(strtolower($nomefantasia)); ?><small>   <?php echo ' • '.$estado.' • '.$mespassado; ?>  </small> 
                     <input id="inscricaoclinica" type="hidden" value="<?php echo $id; ?>"></h1>
                                       <?php /*  <div class="form-group">
                                            <select class="form-control" style="width:200px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
  
                                            <option>Clínicas...</option>
                                        <?php while ($row_busca_clinicas = $query_busca_clinicas->fetch_object()) { ?>
                                                <option value="index.php?idclinica=<?php echo $row_busca_clinicas->idclinica;?>"><?php echo ucfirst(strtolower($row_busca_clinicas->nomefantasia))?></option>
                                        <?php  } ?> 
                                            </select>
                                        </div> */?>
                    <i>Atualizado em: <?php  echo date('d/m/Y H:m:i', strtotime($data_atualizacao))  ;?></i>

                </div>

                   <div class="col-md-4 tooltip-demo" style="text-align: right; margin-top: 125px;">
                  <button type="button" class="btn btn-default btn-circle btn-lg" data-container="body" data-toggle="popover" data-placement="left" data-content="Vermelho: Abaixo das médias regionais e nacionais. Laranja: Acima de uma média e abaixo de outra. Verde: Acima das médias " data-original-title="" title="" aria-describedby="popover329217">
                  <i class="fa fa-question"></i>
                            </button>
                </div>

                <!-- /.col-lg-12 -->
            </div>
             <div class="row">

                </div>

            <div class="row">
              <div class="col-md-8">
          	 <h3>Orçamentos & Inícios</h3 > 
           </div>
           </div>
            <!-- /.row  BLOCOS DOS INICIOS-->
            <div class="row">

            <br>

             <!-- /.PAINEL ORCAMENTOS-->
             <div class="col-lg-3 col-md-6">
	             <div class="pull-right">
		             <ul class="nav nav-tabs">

					  <li role="presentation" id="ma" ><a  id="link_ma_orc">Mês Atual</a></li>
			 		  <li role="presentation" id="mp" class="active"><a  id= "link_mp_orc">Mês Passado</a></li>
					 </ul>
				 </div>
	             <div id="wait" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>   
	             <div id="div_orc"></div>
             </div>
                          <!-- /.PAINEL ORCAMENTOS-->

                          <!-- /.PAINEL DOCUMENTACAO-->

             <div class="col-lg-3 col-md-6">  
	             <div class="pull-right">
		             <ul class="nav nav-tabs">
				
					  <li role="presentation" id="ma_doc" ><a  id="link_ma_doc">Mês Atual</a></li>
			 		  <li role="presentation" id="mp_doc" class="active"><a  id= "link_mp_doc">Mês Passado</a></li>
					 </ul>
				 </div>
	             <div id="wait_doc" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>   
	             <div id="div_doc"></div>
             </div>
                                       <!-- /.PAINEL DOCUMENTACAO-->
                                       
                                       <!-- /.PAINEL INICIOS-->
             
             
             <div class="col-lg-3 col-md-6">  
	             <div class="pull-right">
		             <ul class="nav nav-tabs">
				
					  <li role="presentation" id="ma_ini" ><a  id="link_ma_ini">Mês Atual</a></li>
			 		  <li role="presentation" id="mp_ini" class="active"><a  id= "link_mp_ini">Mês Passado</a></li>
					 </ul>
				 </div>
	             <div id="wait_ini" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>   
	             <div id="div_ini"></div>
             </div>    
                                                    <!-- /.PAINEL INICIOS-->
                                                    <!-- /.PAINEL APROVEITAMENTO orçamentos-->

             <div class="col-lg-3 col-md-6">  
	             <div class="pull-right">
		             <ul class="nav nav-tabs">
				
					  <li role="presentation" id="ma_ini_orc" ><a  id="link_ma_ini_orc">Mês Atual</a></li>
			 		  <li role="presentation" id="mp_ini_orc" class="active"><a  id= "link_mp_ini_orc">Mês Passado</a></li>
					 </ul>
				 </div>
	             <div id="wait_ini_orc" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>   
	             <div id="div_ini_orc"></div>
             </div>   
                                                    <!-- /.PAINEL APROVEITAMENTO-->
			
            </div>
              <div class="row">
                           <h3>Cliente Amigo</h3 > 

                                                           <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->

             <div class="col-lg-3 col-md-6">  
	             <div class="pull-right">
		             <ul class="nav nav-tabs">
      					  <li role="presentation" id="ma_cli_amigo" ><a  id="link_ma_cli_amigo">Mês Atual</a></li>
      			 		  <li role="presentation" id="mp_cli_amigo" class="active"><a  id= "link_mp_cli_amigo">Mês Passado</a></li>
      					 </ul>
      				 </div>
	             <div id="wait_cli_amigo" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>
	             <div id="div_cli_amigo"></div>
             </div>
                   <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->

                                                                              <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->

             <div class="col-lg-3 col-md-6">  
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_cli_amigo_conte" ><a  id="link_ma_cli_amigo_conte">Mês Atual</a></li>
                  <li role="presentation" id="mp_cli_amigo_conte" class="active"><a  id= "link_mp_cli_amigo_conte">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_cli_amigo_conte" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_cli_amigo_conte"></div>
             </div>
                   <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->

                                                                                   <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->

             <div class="col-lg-3 col-md-6">  
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_cli_amigo_permitido" ><a  id="link_ma_cli_amigo_permitido">Mês Atual</a></li>
                  <li role="presentation" id="mp_cli_amigo_permitido" class="active"><a  id= "link_mp_cli_amigo_permitido">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_cli_amigo_permitido" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_cli_amigo_permitido"></div>
             </div>
                   <!-- /.PAINEL INDICAÇÃO CLIENTE AMIGO-->      



            </div>
              
              
          
                
                
                
                
                
            <div class="row">
              <div class="col-md-8">
          	 <h3>Faltosos</h3 > 
           </div> </div>
          
                                                         
           
              <div class="row">
              
                                                           <!-- /.PAINEL FALTOSOS TOTAL-->

              <div class="col-lg-3 col-md-6">
	             <div class="pull-right">
		             <ul class="nav nav-tabs">
      					  <li role="presentation" id="ma_fal_tot" ><a  id="link_ma_fal_tot">Mês Atual</a></li>
      			 		  <li role="presentation" id="mp_fal_tot" class="active"><a  id= "link_mp_fal_tot">Mês Passado</a></li>
      					 </ul>
      				 </div>
	             <div id="wait_fal_tot" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
	             		 Carregando...
	             </div>
	             <div id="div_fal_tot"></div>
             </div>
                                                                        <!-- /.PAINEL FALTOSOS TOTAL-->
                                                           <!-- /.PAINEL FALTOSOS AGENDADOS-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_fal_age" ><a  id="link_ma_fal_age">Mês Atual</a></li>
                  <li role="presentation" id="mp_fal_age" class="active"><a  id= "link_mp_fal_age">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_fal_age" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_fal_age"></div>
             </div>
                                                           <!-- /.PAINEL FALTOSOS AGENDADOS-->
                                                           <!-- /.PAINEL FALTOSOS AteNDiDOS-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_fal_ate" ><a  id="link_ma_fal_ate">Mês Atual</a></li>
                  <li role="presentation" id="mp_fal_ate" class="active"><a  id= "link_mp_fal_ate">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_fal_ate" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_fal_ate"></div>
             </div>
                                                           <!-- /.PAINEL FALTOSOS AteNDiDOS-->
                                                                        <!-- /.PAINEL FLUTUANTES-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_flut" ><a  id="link_ma_flut">Mês Atual</a></li>
                  <li role="presentation" id="mp_flut" class="active"><a  id= "link_mp_flut">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_flut" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_flut"></div>
             </div>
                                                           <!-- /.PAINEL FLUTUANTES-->
               </div>
              <div class="row">
                                                            <!-- /.PAINEL INDICE FALTAS-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_ind_fal" ><a  id="link_ma_ind_fal">Mês Atual</a></li>
                  <li role="presentation" id="mp_ind_fal" class="active"><a  id= "link_mp_ind_fal">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_ind_fal" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_ind_fal"></div>
             </div>
                                                            <!-- /.PAINEL INDICE FALTAS-->
                                              



            
   </div>
             <div class="row">
              <div class="col-md-8">
          	 <h3>Financeiro</h3 > 
           </div> </div> 
          
             <div class="row">
 		
                                                              <!-- /.PAINEL CUSTO FUNCIONARIO-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_cust_funci" ><a  id="link_ma_cust_funci">Mês Atual</a></li>
                  <li role="presentation" id="mp_cust_funci" class="active"><a  id= "link_mp_cust_funci">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_cust_funci" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_cust_funci"></div>
             </div>
                                                              <!-- /.PAINEL CUSTO FUNCIONARIO -->
                                                               <!-- /.PAINEL GASTO DENTAL-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_gast_dent" ><a  id="link_ma_gast_dent">Mês Atual</a></li>
                  <li role="presentation" id="mp_gast_dent" class="active"><a  id= "link_mp_gast_dent">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_gast_dent" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_gast_dent"></div>
             </div>
                                                              <!-- /.PAINEL GASTO DENTAL-->
                                                              <!-- /.PAINEL LUCRO POR PACIENTE-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_luc_pac" ><a  id="link_ma_luc_pac">Mês Atual</a></li>
                  <li role="presentation" id="mp_luc_pac" class="active"><a  id= "link_mp_luc_pac">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_luc_pac" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_luc_pac"></div>
             </div>
                                                              <!-- /.PAINEL LUCRO POR PACIENTE-->
                                                              <!-- /.PAINEL ENTRADA ORTO -->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_entr_orto" ><a  id="link_ma_entr_orto">Mês Atual</a></li>
                  <li role="presentation" id="mp_entr_orto" class="active"><a  id= "link_mp_entr_orto">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_entr_orto" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_entr_orto"></div>
             </div>
             </div>
           
             <div class="row">

                 <!-- /.PAINEL negociacao -->

               <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_negociacao" ><a  id="link_ma_negociacao">Mês Atual</a></li>
                  <li role="presentation" id="mp_negociacao" class="active"><a  id= "link_mp_negociacao">Mês Passado</a></li>
                 </ul>
               </div>

                    <div class="clearfix"></div>
                    <div class="panel panel-yellow">
                       <a data-toggle="modal" data-target="#modal_negociacao" href="#modal_negociacao" id="button_negociacao">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right">&nbsp;</i></span>
                                <span class="pull-left"><i class="fa fa-legal fa-2x" data-toggle="tooltip" data-placement="right" title="Aproveitamento"></i></span>
                                <span class="pull-left" style="margin-top: 3px;">&nbsp;<strong>Negociação Pago • &nbsp;MAI/2015 </strong></span>
                              <div class="clearfix"></div>
                            </div>
                        </a>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 tooltip-demo">
                                <div class="huge">
                                        <b data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Porcentagem Pago Sob o Total de Negociação">
                                       <?php echo  $porc_total_pago = round($total_pago_mp*100/($total_pago_mp+$total_em_atraso_mp),2)?>%</b>

                                      </div>
                                      <div><strong><font size="+1" data-toggle="tooltip" data-placement="bottom" title="Total de Aproveitamento"> <?php  echo 'R$' . number_format($total_pago_mp  , 2, ',', '.'); ?></font></strong>
                                      <font size="1px"> Pago </font>
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right tooltip-demo">
                                    <div> <b data-toggle="tooltip" data-placement="left" title="" data-original-title="% Média Regional">
                                        <img alt="Média Regional" rel="tooltip" title="Média Regional" src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bandeira_de_Goi%C3%A1s.svg/125px-Bandeira_de_Goi%C3%A1s.svg.png" width="15%" height="15%">
                                        <font size="+1">  1.6%</font>
                                         </b>
                                        <b data-toggle="tooltip" data-placement="top" title="" data-original-title="Valor Médio Regional">
                                       <small> (46)</small></b>
                                    </div>
                                    <div> <b data-toggle="tooltip" data-placement="left" title="" data-original-title="% Média Nacional">
                                        <img alt="Média Nacional" rel="tooltip" title="Média Nacional" src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/125px-Flag_of_Brazil.svg.png" width="15%" height="15%">
                                        <font size="+1"> 
                                         2.5%                                         </font>
                                        </b>
                                        <b data-toggle="tooltip" data-placement="top" title="" data-original-title="Valor Médio Nacional">
                                        <small>(46)</small></b>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
			</div>
			  <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_negociacao" ><a  id="link_ma_negociacao">Mês Atual</a></li>
                  <li role="presentation" id="mp_negociacao" class="active"><a  id= "link_mp_negociacao">Mês Passado</a></li>
                 </ul>
               </div>

                    <div class="clearfix"></div>
                    <div class="panel panel-yellow">
                       <a data-toggle="modal" data-target="#modal_negociacao" href="#modal_negociacao" id="button_negociacao">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right">&nbsp;</i></span>
                                <span class="pull-left"><i class="fa fa-legal fa-2x" data-toggle="tooltip" data-placement="right" title="Aproveitamento"></i></span>
                                <span class="pull-left" style="margin-top: 3px;">&nbsp;<strong>Em Atraso • &nbsp;MAI/2015 </strong></span>
                              <div class="clearfix"></div>
                            </div>
                        </a>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 tooltip-demo">
                                <div class="huge">
                                        <b data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Porcentagem em Atraso Sob o Total de Negociação">
                                       <?php echo  $porc_total_pago = round($total_em_atraso_mp*100/($total_pago_mp+$total_em_atraso_mp),2)?>%</b>
                                      </div>
                                      <div><strong><font size="+1" data-toggle="tooltip" data-placement="bottom" title="Total de Aproveitamento"> <?php  echo 'R$' . number_format($total_em_atraso_mp  , 2, ',', '.'); ?></font></strong>
                                      <font size="1px"> Em Atraso </font>
                                    </div>
                                </div>
                                <div class="col-xs-9 text-right tooltip-demo">
                                    <div> <b data-toggle="tooltip" data-placement="left" title="" data-original-title="% Média Regional">
                                        <img alt="Média Regional" rel="tooltip" title="Média Regional" src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bandeira_de_Goi%C3%A1s.svg/125px-Bandeira_de_Goi%C3%A1s.svg.png" width="15%" height="15%">
                                        <font size="+1">  1.6%</font>
                                         </b>
                                        <b data-toggle="tooltip" data-placement="top" title="" data-original-title="Valor Médio Regional">
                                       <small> (46)</small></b>
                                    </div>
                                    <div> <b data-toggle="tooltip" data-placement="left" title="" data-original-title="% Média Nacional">
                                        <img alt="Média Nacional" rel="tooltip" title="Média Nacional" src="http://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/125px-Flag_of_Brazil.svg.png" width="15%" height="15%">
                                        <font size="+1"> 
                                         2.5%                                         </font>
                                        </b>
                                        <b data-toggle="tooltip" data-placement="top" title="" data-original-title="Valor Médio Nacional">
                                        <small>(46)</small></b>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
			</div>

                                                            <!-- /.PAINEL NEGOCIACAO-->
</div>
      <div class="row">
              <div class="col-md-8">
             <h3>Fim de Mensalidade</h3 > 
           </div>
           </div>
             <div class="row">

                                                              <!-- /.PAINEL LUCRO POR PACIENTE-->
                                                              <!-- /.PAINEL FM -->
	
              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_fm" ><a  id="link_ma_fm">Mês Atual</a></li>
                  <li role="presentation" id="mp_fm" class="active"><a  id= "link_mp_fm">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_fm" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_fm"></div>
         
                                                              <!-- /.PAINEL FM -->
               </div>
                                                              
                                                            <!-- /.PAINEL FM  PAGANTES-->
                                                              

            <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_fm_pag" ><a  id="link_ma_fm_pag">Mês Atual</a></li>
                  <li role="presentation" id="mp_fm_pag" class="active"><a  id= "link_mp_fm_pag">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_fm_pag" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_fm_pag"></div>
             </div>
                                                            <!-- /.PAINEL FM  PAGANTES-->
                                                            <!-- /.PAINEL FM  NAO PAGANTES-->
            <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_fm_n_pag" ><a  id="link_ma_fm_n_pag">Mês Atual</a></li>
                  <li role="presentation" id="mp_fm_n_pag" class="active"><a  id= "link_mp_fm_n_pag">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_fm_n_pag" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_fm_n_pag"></div>
             </div>
                                                            <!-- /.PAINEL FM NAO PAGANTES-->
                <!-- /.PAINEL CANCELAMENTO-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_canc" ><a  id="link_ma_canc">Mês Atual</a></li>
                  <li role="presentation" id="mp_canc" class="active"><a  id= "link_mp_canc">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_canc" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_canc"></div>
             </div>
                </div>
             <div class="row">
                                                              <!-- /.PAINEL CANCELAMENTO-->
                                                              <!-- /.PAINEL SUSPENSOES-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_susp" ><a  id="link_ma_susp">Mês Atual</a></li>
                  <li role="presentation" id="mp_susp" class="active"><a  id= "link_mp_susp">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_susp" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_susp"></div>
             </div>
                                                              <!-- /.PAINEL SUSPENSOES-->
                                                              
                                                                                                                            <!-- /.PAINEL ABANDONO-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_aband" ><a  id="link_ma_aband">Mês Atual</a></li>
                  <li role="presentation" id="mp_aband" class="active"><a  id= "link_mp_aband">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_aband" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_aband"></div>
             </div>
                                                              <!-- /.PAINEL ABANDONO    
                                                                <!-- /.PAINEL nota fiscal-->

              <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_aproveitamento" ><a  id="link_ma_aproveitamento">Mês Atual</a></li>
                  <li role="presentation" id="mp_aproveitamento" class="active"><a  id= "link_mp_aproveitamento">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_aproveitamento" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_aproveitamento"></div>
             </div>
  <!-- /.PAINEL nota fiscal-->



              </div>
               <div class="row">
              <div class="col-md-8">
          	 <h3>Pacientes</h3 > 
           </div> </div> 
                 <div class="row">
                    <!-- /.PAINEL PACIENTES-->
               <div class="col-lg-3 col-md-6">
               <div class="pull-right">
                 <ul class="nav nav-tabs">
                  <li role="presentation" id="ma_pacientes" ><a  id="link_ma_pacientes">Mês Atual</a></li>
                  <li role="presentation" id="mp_pacientes" class="active"><a  id= "link_mp_pacientes">Mês Passado</a></li>
                 </ul>
               </div>
               <div id="wait_pacientes" style="display:block;width:69px;height:173px;position:relative;top:80px;left:190px;padding:2px;z-index:10"><img src='loading2.gif' width="53" height="53" align="right" /><br>
                   Carregando...
               </div>
               <div id="div_pacientes"></div>
             </div>
                                                            <!-- /.PAINEL PACIENTES-->
  
              </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
     <!-- Modal -->
                          <?php include '../includes/modals.php';?>



    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <?php include  '../includes/chama_ajax.php'; ?>
    <script>
  
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })


    // popover demo
    $("[data-toggle=popover]")
        .popover()

   


      $(document).ready(function() {

    		$( "#link_mp_orc" ).click();
        	$( "#link_mp_doc" ).click();
        	$( "#link_mp_ini" ).click();
        	$( "#link_mp_ini_orc" ).click();
        	$( "#link_mp_fal_tot" ).click();
            $( "#link_mp_fal_ate" ).click();
            $( "#link_mp_fal_age" ).click();
            $( "#link_mp_flut" ).click();
            $( "#link_mp_ind_fal" ).click();
            $( "#link_mp_canc" ).click();
            $( "#link_mp_susp" ).click();
            $( "#link_mp_gast_dent" ).click();
            $( "#link_mp_cust_funci" ).click();
            $( "#link_mp_luc_pac" ).click();
            $( "#link_mp_entr_orto" ).click();
            $( "#link_mp_fm" ).click();
            $( "#link_mp_fm_pag" ).click();
            $( "#link_mp_fm_n_pag" ).click();
            $( "#link_mp_negociacao" ).click();
            $( "#link_mp_pacientes" ).click();
            $( "#link_mp_cli_amigo" ).click();
            $( "#link_mp_cli_amigo_conte" ).click(); 
            $( "#link_mp_cli_amigo_permitido" ).click();   
            $( "#link_mp_aproveitamento" ).click();            
                       
            $( "#link_mp_aband" ).click();



		      $("#modal_flutuantes").on('shown.bs.modal', function () {
		           startDrawingLinFlut()
		      });
		      $("#modal_fm").on('shown.bs.modal', function () {
		           startDrawingLinFluxoFM()
		      });
		      $("#modal_entrada_orto").on('shown.bs.modal', function () {
		           startDrawingLinEntradaOrto()
		      });
		      $("#modal_orcamentos").on('shown.bs.modal', function () {
		           startDrawingLinOrc()
		      });
		       $("#modal_documentacoes").on('shown.bs.modal', function () {
		           startDrawingLinDoc()
		      });
		        $("#modal_inicios").on('shown.bs.modal', function () {
		           startDrawingLinIni()
		      });
		        $("#modal_pacientes").on('shown.bs.modal', function () {
		              startDrawingLinFluPac()
		      });
          	  $("#modal_cliente_amigo").on('shown.bs.modal', function () {
                  startDrawingLinClienteAmigo()
         	  });
		        $("#modal_faltosos").on('shown.bs.modal', function () {
		              startDrawingLinFaltosos()
		      });
		        $("#modal_lucro_paciente").on('shown.bs.modal', function () {
		              startDrawingLinCompRecDesp()
		      });
		        $("#modal_cancelamentos").on('shown.bs.modal', function () {
		              startDrawingLinCancelamento()
		      });
		        $("#modal_aproveitamento").on('shown.bs.modal', function () {
		              startDrawingLinIniXOrc()
		      });
		        $("#modal_gasto_dental").on('shown.bs.modal', function () {
		              startDrawingLinGastosDental()
		      });
		    	$("#modal_custo_funcionario").on('shown.bs.modal', function () {
		            startDrawingLinCustoFuncionario()
		 	   });
       	  	   $("#modal_suspensoes").on('shown.bs.modal', function () {
                startDrawingLinSuspensoes()
     		   });
          	  $("#modal_negociacao").on('shown.bs.modal', function () {
                startDrawingLinNegociacao()
       		  });
          	  $("#modal_abandono").on('shown.bs.modal', function () {
                  startDrawingLinAbandono()
         		 });
          	  $("#modal_faltosos_agendados").on('shown.bs.modal', function () {
                  startDrawingFaltososAgendados()
         		 });
          	  $("#modal_faltosos_atendidos").on('shown.bs.modal', function () {
                  startDrawingFaltososAtendidos()
         		 });
          	$("#modal_indice_de_faltas").on('shown.bs.modal', function () {
          		startDrawingLinIndiceFalta()
       		 });

           $('#modal_cadastro').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
            $(this).find('iframe').attr('src','formulario_cadastro.php?tipouser=<?php echo ($_SESSION['cod_usuario'])?>')
          }) 
      		       		 $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                startDrawingValorNegociacao_ma()
                startDrawingValorNegociacao_mp()
           });

      });


    </script>
    <script language="JavaScript" type="text/javascript">
  parent.document.getElementById("panels").height = document.getElementById("wrapper").scrollHeight + 40; //40: Margem Superior e Inferior, somadas
</script>


</body>

</html>
