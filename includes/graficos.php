<?php 
require_once('includes/queries.php');
require_once('graphs.php')

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="pt-BR">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="pt-BR">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="pt-BR">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Gráficos Gerenciais | Rede Odonto</title>
                <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="http://localhost/wordpress/xmlrpc.php">
        <!--[if lt IE 9]>
        <script src="http://localhost/wordpress/wp-content/themes/a1/js/html5.js"></script>
        <![endif]-->
        <link rel="alternate" type="application/rss+xml" title="Feed de Rede Odonto &raquo;" href="http://localhost/wordpress/feed/" />
        <link rel="alternate" type="application/rss+xml" title="Rede Odonto &raquo;  Feed de comentários" href="http://localhost/wordpress/comments/feed/" />
        <link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='dashicons-css'  href='http://localhost/wordpress/wp-includes/css/dashicons.min.css?ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='admin-bar-css'  href='http://localhost/wordpress/wp-includes/css/admin-bar.min.css?ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='a1-lato-css'  href='//fonts.googleapis.com/css?family=Lato%3A300%2C400%2C700%2C900%2C300italic%2C400italic%2C700italic' type='text/css' media='all' />
        <link rel='stylesheet' id='a1-bootstrap-min-css-css'  href='http://localhost/wordpress/wp-content/themes/a1/css/bootstrap.min.css?ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='style-css'  href='http://localhost/wordpress/wp-content/themes/a1/style.css?ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='a1-media-css-css'  href='http://localhost/wordpress/wp-content/themes/a1/css/media.css?ver=4.1.1' type='text/css' media='all' />
        <link rel='stylesheet' id='a1-fontaewsome-css-css'  href='http://localhost/wordpress/wp-content/themes/a1/css/font-awesome.css?ver=4.1.1' type='text/css' media='all' />
        <script type='text/javascript' src='http://localhost/wordpress/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script>
        <script type='text/javascript' src='http://localhost/wordpress/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
        <script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/a1/js/bootstrap.min.js?ver=4.1.1'></script>
        <script type='text/javascript'>
        /* <![CDATA[ */
        var scroll_top_header = [""];
        /* ]]> */
        </script>

        <script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/a1/js/default.js?ver=4.1.1'></script>
        <script type='text/javascript' src='http://localhost/wordpress/wp-content/themes/a1/js/owl.carousel.min.js?ver=4.1.1'></script>
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://localhost/wordpress/xmlrpc.php?rsd" />
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://localhost/wordpress/wp-includes/wlwmanifest.xml" /> 
        <meta name="generator" content="WordPress 4.1.1" />
        <link rel='canonical' href='http://localhost/wordpress/graficos-gerenciais/' />
        <link rel='shortlink' href='http://localhost/wordpress/?p=77' />
        <style type="text/css" media="print">#wpadminbar { display:none; }</style>
        <style type="text/css" media="screen">
        	html {
                margin-top: 32px !important; 
               }
        	* html body {
                        margin-top: 32px !important; 
                      }
        	@media screen and ( max-width: 782px ) {
        	                                         	html {
                                                     margin-top: 46px !important; 
                                                         }
        	                                       	* html body {
                                                               margin-top: 46px !important;
                                                              }
                                              	}
        </style>
        <style>
        table, td, th {
            border: 1px solid green;
            text-align: center;
        }

        tr { padding: 2px;}

        th {
            background-color: green;
            color: white;
            text-align: center;

        }

        #lin_agendados_assiduos {
          /*display:none;*/
          position:absolute;
          top:50%;
          left:50%;
          margin-left:-150px;
          margin-top:-100px;
          padding:10px;
          width:300px;
          height:200px;
          border:1px solid #d0d0d0
        }
        </style>
  </head>
    <body class="page page-id-77 page-template page-template-page-templates page-template-full-width page-template-page-templatesfull-width-php logged-in admin-bar no-customize-support">
        <header>       
            <div class="col-md-12 bottom-header no-padding-lr">
                <div class="container a1-container">
                    <div class="col-md-2 no-padding-lr header-logo"> <a href="http://localhost/wordpress"><img src="http://localhost/wordpress/wp-content/uploads/2015/02/redeOdonto.png" alt="Rede Odonto"></a>
                    </div>
                    <div class="col-md-10 no-padding-lr">
                        <nav class="a1-nav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle navbar-toggle-top sort-menu-icon collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            </div>
                            <div class="navbar-collapse collapse no-padding-lr">           
                                <div class="menu-clinicas-container">
                                  <ul class="a1-menu">  
                                    <li id="menu-item-65" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-65"><a title="Tabela" href="/../wordpress/tabela.php">Tabela</a></li>                                  
                                  </ul>
                                </div>          
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!--header part end--> <!--section part start-->
<section class="section-main">
  <div class="col-md-12 a1-breadcrumb">
    <div class="container a1-container">
      <div class="col-md-6 col-sm-6 no-padding-lr left-part">      
      <h3><?php echo $_GET['name'];?> - Gráficos Gerenciais</h3>  
      </div>
      <div class="col-md-6 col-sm-6 no-padding-lr right-part">
        <ol class="breadcrumb"><li class="active"><a href="http://localhost/wordpress">Home</a> /  Gráficos Gerenciais </li></ol>      </div>
    </div>
  </div>
  <div class="clearfix"> 
   </div>
  <div class="container a1-container"> 
    <div class="row">
      <div class="col-md-12 blog-article">
        <div class="blog-post"> 
          <div class="blog-inner"> 
            <div class="blog-content">

              <!-- inicio do bloco agendados assiduos -->
              <p><h2><?php echo $_GET['name'];?> - Agendados Assíduos</h2></p>
               <span style="font-size: 11px">Atualizado em <?php echo date('d/m/Y H:m:i', strtotime($row_agendados_assiduos->data_inclusao))  ?></span>
                  <div id="agendados_assiduos" style="width: 500px; height: 300px;"></div>                
                  <table width="100%" border="1"   style="position:relative;top:-250px;left:450px" >
                      <tr>
                        <th width="103">Assíduos</th>
                        <th width="81">Total</td>                       
                      </tr>
                      <tr>
                        <td>Agendados Mês</td>
                        <td><?php echo $assiduos_a1; ?></td>
                      </tr>
                      <tr>
                        <td>Agendados Total</th>
                        <td><?php echo $assiduos_a2; ?></td>
                      </tr>
                    </table>
                    <a href="#" onclick="document.getElementById('lin_agendados_assiduos').style.display='none';">esconde</a>
                     <a href="#" onclick="document.getElementById('lin_agendados_assiduos').style.display='block';">mostra</a>
                  <div id="lin_agendados_assiduos" style="width: 900px; height: 300px; position: relative; top: -170px; display:none"></div>                   
               
                <!-- inicio do bloco agendados faltosos-->
                 <div id="map1"></div>
				          <p><h2><?php echo $_GET['name'];?> - Agendados Faltosos</h2></p>
                  <div id="agendados_faltosos" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Assíduos</th>
                        <th width="81">Total</th>
                      </tr>
                      <tr>
                        <td>Faltosos Mês</td>
                        <td><?php echo $faltosos_b1; ?></td>
                      </tr>
                      <tr>
                        <td>Faltosos Total</td>
                        <td><?php echo $faltosos_b2; ?></td>  
                      </tr>
                    </table>
                      <div id="lin_agendados_faltosos" style="width: 900px; height: 300px;  position: relative; top: -200px"></div>   
                     
                      <!-- inicio do bloco atendidos assiduos -->
                      <div id="map2"></div>
                   <p><h2><?php echo $_GET['name'];?> - Atendidos Assíduos</h2></p>
                  <div id="atendidos_assiduos" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Assíduos</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Atendidos até a data</td>
                        <td><?php echo $assiduos_c1; ?></td>                        
                      </tr>
                      <tr>
                        <td>Agendados até a data</td>
                        <td><?php echo $assiduos_c2; ?></td>                       
                      </tr>
                    </table>
                    <div id="lin_atendidos_assiduos" style="width: 900px; height: 500px; position: relative; top: -250px"></div>
         
          <!-- inicio do bloco atendidos faltosos -->
                  <div id="map3"></div>
                  <p><h2><?php echo $_GET['name'];?> - Atendidos Faltosos</h2></p>
                  <div id="atendidos_faltosos" style="width: 900px; height: 500px;"></div>                
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Faltosos</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Faltosos Atendidos</td>
                        <td><?php echo $faltosos_d1; ?></td>                        
                      </tr>
                      <tr>
                        <td>Total de Faltosos</td>
                        <td><?php echo $faltosos_d2; ?></td>                        
                      </tr>
                    </table>
               <div id="lin_atendidos_faltosos" style="width: 900px; height: 500px; position: relative; top: -250px"></div>


              <!-- inicio do bloco FLUXO FM -->
                  <div id="map4"></div>
                  <h2><?php echo $_GET['name'];?> - Fluxo FM</h2>
                  <div id="fluxo_fm" style="width: 600px; height: 400px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:640px" >
                      <tr>
                        <th width="103">Fluxo FM</th>
                        <th width="81">Total</th>                      
                      </tr>
                      <tr>
                        <td>FM Mês Atual</td>
                        <td><?php echo $fm_mes_passado; ?></td>                        
                      </tr>
                      <tr>
                        <td>FM Mês Passado</td>
                        <td><?php echo $fm_mes_atual; ?></td>                     
                      </tr>
                       <tr>
                        <td>FM Contenção</td>
                        <td><?php echo $porc_fluxo_fm; ?></td>                     
                      </tr>
                    </table>
                <div id="lin_fluxo_fm" style="width: 900px; height: 500px; position: relative; top: -200px"></div>

                  <!-- inicio do bloco Flutuantes -->
                  <div id="map5"></div>
                  <h2><?php echo $_GET['name'];?> - Flutuantes</h2>
                  <div id="flutuantes" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Fluxo FM</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Flutuantes</td>
                        <td><?php echo $qtd_flutuantes; ?></td>                        
                      </tr>
                      <tr>
                        <td>Total Assíduos</td>
                        <td><?php echo $assiduos_a2; ?></td>                        
                      </tr>
                    </table>    
                      <div id="lin_flutuantes" style="width: 900px; height: 500px;position: relative; top: -200px"></div>



                   <!-- inicio do bloco Orçamentos -->
                    <div id="map6"></div>
                    <h2><?php echo $_GET['name'];?> - Orçamentos</h2>
                  <div id="orcamentos" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Orçamentos</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Orçamentos Mês</td>
                        <td><?php echo $orcamento_mes; ?></td>                        
                      </tr>
                      <tr>
                        <td>Orçamentos Total</td>
                        <td><?php echo $orcamento_total; ?></td>                        
                      </tr>
                    </table>    
                     <div id="lin_orcamentos" style="width: 900px; height: 500px;position: relative; top: -250px"></div> 
                 
                   <!-- inicio do bloco Documentacao -->
                    <div id="map7"></div>
                  <h2><?php echo $_GET['name'];?> - Documentação</h2>
                  <div id="documentacao" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Documentação</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Documentação Mês</td>
                        <td><?php echo $documentacao_mes; ?></td>                        
                      </tr>
                      <tr>
                        <td>Documentação Total</td>
                        <td><?php echo $documentacao_total; ?></td                       
                      </tr>
                    </table> 
                      <div id="lin_documentacao" style="width: 900px; height: 500px;position: relative; top: -250px"></div> 
                         
                          <!-- inicio do bloco inicio -->
                           <div id="map8"></div>
               <h2><?php echo $_GET['name'];?> - Início</h2>
                  <div id="inicio" style="width: 900px; height: 500px;"></div>                
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Início</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Início Mês</td>
                        <td><?php echo $inicio_mes; ?></td>                        
                      </tr>
                      <tr>
                        <td>Início Total</td>
                        <td><?php echo $inicio_total; ?></td>                       
                      </tr>
                    </table>     
                    <div id="lin_inicio" style="width: 900px; height: 500px;position: relative; top: -200px"></div> 
                       
                         <!-- inicio do bloco envelhecimento clinica -->
                <div id="map9"></div>
                <h2><?php echo $_GET['name'];?> - Envelhecimento Clínica</h2>
                  <div id="envelhecimento" style="width: 900px; height: 500px;"></div>                
                  <table width="100%"  border="1"  style="position:relative;top:-280px;left:540px" >
                      <tr>
                        <th width="103">Período</th>
                        <th width="81">Ativos</th>                        
                      </tr>
                      <tr>
                        <td>de 0 a 1 ano</td>
                        <td><?php echo $zero_a_um; ?></td>                        
                      </tr>
                      <tr>
                        <td>de 1 a 2 anos</td>
                        <td><?php echo $um_a_dois; ?></td>                        
                      </tr>
                      <tr>
                        <td>de 2 a 3 anos</td>
                        <td><?php echo $dois_a_tres; ?></td>                       
                      </tr>
                      <tr>
                        <td>de 3 a 4 anos</td>
                        <td><?php echo $tres_a_quatro; ?></td>
                      </tr>
                      <tr>
                        <td>acima de 4 anos</td>
                        <td><?php echo $acima_4; ?></td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td><?php echo $zero_a_um+$um_a_dois+$dois_a_tres+$tres_a_quatro+$acima_4; ?></td>
                      </tr>
                    </table>     

           <!-- inicio do bloco tramento faltosos-->
            <div id="map10"></div>
                  <h2><?php echo $_GET['name'];?> - Tratamento Faltosos</h2>
                  <div id="tratamento_faltosos" style="width: 500px; height: 500px;"></div>                
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Faltosos</th>
                        <th width="81">Total</th>
                      </tr>
                      <tr>
                        <td>Agendados</td>
                        <td><?php echo $faltosos_agendados; ?></td>                       
                      </tr>
                      <tr>
                        <td>Não Agendados</td>
                        <td><?php echo $faltosos_nao_agendados; ?></td>                        
                      </tr>
                    </table>    
                       
                       <!-- inicio do bloco tramento assiduos-->
                        <div id="map11"></div>
                     <h2><?php echo $_GET['name'];?> - Tratamento Assíduos</h2>
                  <div id="tratamento_assiduos" style="width: 500px; height: 500px;"></div>
                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Assíduos</th>
                        <th width="81">Total</th>                       
                      </tr>
                      <tr>
                        <td>Agendados</td>
                        <td><?php echo $taagendados; ?></td>                        
                      </tr>
                      <tr>
                        <td>Atendidos</td>
                        <td><?php echo $taatendidos; ?></td>                       
                      </tr>
                       <tr>
                        <td>Flutuantes</td>
                        <td><?php echo $taflutuantes; ?></td>                       
                      </tr>
                    </table>   
                  
                     <!-- inicio do bloco tramento assiduos x faltosos-->
                   <h2><?php echo $_GET['name'];?> - Tratamento Assíduos x Faltosos</h2>
                  <div id="assiduos_x_faltosos" style="width: 900px; height: 500px;"></div>                
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Início</th>
                        <th width="81">Total</th>                        
                      </tr>
                      <tr>
                        <td>Faltosos</td>
                        <td><?php echo $affaltosos; ?></td>
                      </tr>
                      <tr>
                        <td>Flutuantes</td>
                        <td><?php echo $afflutuantes; ?></td>
                      </tr>
                      <tr>
                        <td>Total Faltosos</td>
                        <td><?php echo $aftotal_faltosos; ?></td>
                      </tr>
                      <tr>
                        <td>Não irá Receber</td>
                        <td><b>R$<?php echo $nao_ira_receber; ?><b></td>
                      </tr>
                    </table>    
                     <div id="lin_tratamento_assiduos_faltosos" style="width: 900px; height: 500px;position: relative; top: -250px"></div>
                    
                    <!-- inicio do bloco tramento custo paciente-->
                     <h2><?php echo $_GET['name'];?> - Custo Paciente</h2>
                  <div id="custo_paciente" style="width: 900px; height: 500px;"></div>                 
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Média</th>
                        <th width="81">Porcentagem</th>                       
                      </tr>
                      <tr>
                        <td>Média Gasto</td>
                        <td><?php echo $media_gasto; ?></td>
                      </tr>
                      <tr>
                        <td>Média Lucro</td>
                        <td><?php echo $media_lucro; ?></td>
                      </tr>                     
                    </table>     
                    <div id="lin_custo_paciente" style="width: 900px; height: 500px;position: relative; top: -250px"></div>


                  <!-- inicio do bloco proporção inicios x orcamentos -->


                  <h2><?php echo $_GET['name'];?> - Proporção Inícios x Orçamentos</h2>
                  <div id='piechart_diff' style="width: 900px; height: 500px;"></div>
                  <span id='piechart_before' style='width: 450px; display: none'></span>
                  <span id='piechart_after' style='width: 450px; display: none'></span>                
                  <table width="100%"  border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th width="103">Período</th>
                        <th width="81">Orçamentos</th>
                        <th width="81">Inícios</th>
                        <th width="81">%</th>                        
                      </tr>
                      <tr>
                        <td>Mês Anterior</td>
                        <td><?php echo $orc_mespassado;?></td>
                        <td><?php echo $ini_mespassado;?></td>
                        <td><?php echo $porc_mespassado;?></td>
                      </tr>
                      <tr>
                        <td>Mês Atual</td>
                        <td><?php echo $orc_mesatual;?></td>
                        <td><?php echo $ini_mesatual;?></td>
                        <td><?php echo $porc_mesatual;?></td>
                      </tr>                     
                    </table>   
                  <div id="lin_tratamento_inicio_x_orcamento" style="width: 900px; height: 500px; position: relative; top: -200px"></div>
           
     <!-- inicio do bloco fluxo de pacientes -->

                  <h2><?php echo $_GET['name'];?> - Fluxo de Paciente</h2>
                  <div id='fluxo_paciente' style="width: 600px; height: 300px;"></div>
               
                  <table border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th >Mês Passado</th>
                        <th >Mês Retrasado</th>
                        <th >Diferença</th>    
                      </tr>
                      <tr>
                        <td><?php echo $total_pac_mes_passado;?></td>
                        <td><?php echo $total_pac_mes_retrasado;?></td>
                        <td><?php echo $resultado;?></td>                                           
                      </tr>                     
                    </table>   
                <div id='lin_fluxo_paciente' style="width: 900px; height: 500px;position: relative; top: -100px"></div>
        
                 <!-- inicio do bloco comparativo receita e despesas -->   
                  <h2><?php echo $_GET['name'];?> - Comparativo Receita e Despesas</h2>
                 
                <div id='lin_comparativo_receita_despesas' style="width: 900px; height: 500px; "></div>

                 <!-- inicio do bloco negociação -->   
                  <h2><?php echo $_GET['name'];?> - Negociação</h2>
                  <div id='negociacao' style="width: 900px; height: 500px;"></div>               
                  <table border="1"  style="position:relative;top:-350px;left:540px" >
                      <tr>
                        <th >Total a Receber</th>
                        <th >Total em Atraso</th>
                        <th >Total Pago</th>    
                      </tr>
                      <tr>
                        <td><?php echo $total_a_receber;?></td>
                        <td><?php echo $total_em_atraso;?></td>
                        <td><?php echo $total_pago;?></td>
                      </tr>
                    </table>                
                <div id='lin_negociacao' style="width: 900px; height: 500px;position: relative; top: -200px"></div>
          </div>
        </div>                 
		</div>
     </div>
    </div>
  </section>
<!--section part end-->
<div class="clearfix"></div>
<!--footer start-->
<footer>
        <div class="footer-botom">
        <div class="container a1-container">
            <div class="row">
                <div class="col-md-6 col-sm-6 copyright-text">
                    <p>Todos os Direitos Reservados © Copyright Rede Odonto 2015. </p>
                </div>
                <div class="col-md-6 col-sm-6 footer-menu">
                </div>
            </div>
        </div>
    </div>
</footer>

<!--footer end--> 

<script type='text/javascript' src='http://localhost/wordpress/wp-includes/js/admin-bar.min.js?ver=4.1.1'></script>
	<script type="text/javascript">
		(function() {
			var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

			request = true;

			b[c] = b[c].replace( rcs, ' ' );
			b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
		}());
	</script>
			<div id="wpadminbar" class="nojq nojs" role="navigation">
			<a class="screen-reader-shortcut" href="#wp-toolbar" tabindex="1">Pular para a barra de ferramentas</a>
			<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Barra de ferramentas do topo." tabindex="0">
				<ul id="wp-admin-bar-root-default" class="ab-top-menu">
      		<li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item"  aria-haspopup="true" href="http://localhost/wordpress/wp-admin/about.php" title="Sobre o WordPress"><span class="ab-icon"></span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
      		<li id="wp-admin-bar-about"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/about.php">Sobre o WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
      		<li id="wp-admin-bar-wporg"><a class="ab-item"  href="https://br.wordpress.org/">WordPress.org</a>		</li>
      		<li id="wp-admin-bar-documentation"><a class="ab-item"  href="http://codex.wordpress.org/pt-br:Página_Inicial">Documentação</a>		</li>
      		<li id="wp-admin-bar-support-forums"><a class="ab-item"  href="http://br.forums.wordpress.org">Fóruns de Suporte</a>		</li>
      		<li id="wp-admin-bar-feedback"><a class="ab-item"  href="http://br.forums.wordpress.org/forum/pedidos-e-feedback">Feedback</a>		</li></ul></div>		</li>
      		<li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item"  aria-haspopup="true" href="http://localhost/wordpress/wp-admin/">Rede Odonto</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
      		<li id="wp-admin-bar-dashboard"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/">Painel</a>		</li></ul><ul id="wp-admin-bar-appearance" class="ab-submenu">
      		<li id="wp-admin-bar-themes"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/themes.php">Temas</a>		</li>
      		<li id="wp-admin-bar-customize" class="hide-if-no-customize"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/customize.php?url=http%3A%2F%2Flocalhost%2Fwordpress%2Fgraficos-gerenciais%2F">Personalizar</a>		</li>
      		<li id="wp-admin-bar-widgets"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/widgets.php">Widgets</a>		</li>
      		<li id="wp-admin-bar-menus"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/nav-menus.php">Menus</a>		</li>
      		<li id="wp-admin-bar-background" class="hide-if-customize"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/themes.php?page=custom-background">Fundo</a>		</li>
      		<li id="wp-admin-bar-customize-background" class="hide-if-no-customize"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/customize.php?url=http%3A%2F%2Flocalhost%2Fwordpress%2Fgraficos-gerenciais%2F&#038;autofocus%5Bcontrol%5D=background_image">Fundo</a>		</li></ul></div>		</li>
      		<li id="wp-admin-bar-updates"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/update-core.php" title="1 atualização de temas"><span class="ab-icon"></span><span class="ab-label">1</span><span class="screen-reader-text">1 atualização de temas</span></a>		</li>
      		<li id="wp-admin-bar-new-content" class="menupop"><a class="ab-item"  aria-haspopup="true" href="http://localhost/wordpress/wp-admin/post-new.php" title="Adicionar Novo"><span class="ab-icon"></span><span class="ab-label">Novo</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-new-content-default" class="ab-submenu">
      		<li id="wp-admin-bar-new-post"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/post-new.php">Post</a>		</li>
      		<li id="wp-admin-bar-new-media"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/media-new.php">Mídia</a>		</li>
      		<li id="wp-admin-bar-new-page"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/post-new.php?post_type=page">Página</a>		</li>
      		<li id="wp-admin-bar-new-user"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/user-new.php">Usuário</a>		</li></ul></div>		</li>
      		<li id="wp-admin-bar-edit"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/post.php?post=77&#038;action=edit">Editar página</a>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
      		<li id="wp-admin-bar-search" class="admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="http://localhost/wordpress/" method="get" id="adminbarsearch"><input class="adminbar-input" name="s" id="adminbar-search" type="text" value="" maxlength="150" /><input type="submit" class="adminbar-button" value="Pesquisar"/></form></div>		</li>
      		<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item"  aria-haspopup="true" href="http://localhost/wordpress/wp-admin/profile.php" title="Minha Conta">Olá, admin<img alt='' src='http://0.gravatar.com/avatar/07ccec6df20c29409c057479cea61d98?s=26&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D26&amp;r=G' class='avatar avatar-26 photo' height='26' width='26' /></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
      		<li id="wp-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="http://localhost/wordpress/wp-admin/profile.php"><img alt='' src='http://0.gravatar.com/avatar/07ccec6df20c29409c057479cea61d98?s=64&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D64&amp;r=G' class='avatar avatar-64 photo' height='64' width='64' /><span class='display-name'>admin</span></a>		</li>
      		<li id="wp-admin-bar-edit-profile"><a class="ab-item"  href="http://localhost/wordpress/wp-admin/profile.php">Editar Meu Perfil</a>		</li>
      		<li id="wp-admin-bar-logout"><a class="ab-item"  href="http://localhost/wordpress/wp-login.php?action=logout&#038;_wpnonce=f64f983f53">Sair</a>		</li></ul></div>		</li>
        </ul>		
      </div>					
					</div>
		
</body>

</html>