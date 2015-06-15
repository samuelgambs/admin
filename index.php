<?php
    //include('../uflex/autoload.php');

    //Instantiate the User object
   // $user = new ptejada\uFlex\User();

    //Add database credentials
   // $user->config->database->host = 'localhost';
   // $user->config->database->user = 'root';
   // $user->config->database->password = '';
  //  $user->config->database->name = 'sample'; //Database name

    /*
     * You can update any customizable property of the class before starting the object
     * construction process
     */

    //Start object construction
  //  $user->start();
header("Location: pages/login.php");
die();
require_once('includes/mysqli.php');
error_reporting(E_ALL);
// Monta a consulta SQL 
$sql = 'SELECT a.NomeFantasia,
               a.CNPJ as id,
               a.cidade,
               b.ASSIDUOS_A1,
               b.ASSIDUOS_A2,
               b.data_inclusao,
               C.FALTOSOS_B1,
               C.FALTOSOS_B2,
               D.assiduos_c1,
               D.assiduos_c2,
               e.faltosos_d1,
               e.faltosos_d2,
               f.fm_mes_passado,
               f.fm_mes_atual,
               g.qtd_flutuantes,
               g.porc_flutuantes,
               h.orcamento_mes,
               h.orcamento_total,
               i.documentacao_mes,
               i.documentacao_total,
               j.inicio_mes,
               j.inicio_total,
               k.orc_mespassado,
               k.ini_mespassado,
               k.orc_mesatual,
               k.ini_mesatual,
               l.agendados,
               l.atendidos,
               l.flutuantes as lflutuantes,
               m.faltosos,
               m.flutuantes as mflutuantes,
               m.total_faltosos,
               m.nao_ira_receber,
               m.porc_assiduos,
               m.porc_faltosos,
               n.faltosos_agendados,
               n.faltosos_nao_agendados,
               o.0_a_1 as zero_um,
               o.1_a_2 as um_dois,
               o.2_a_3 as dois_tres,
               o.3_a_4 as tres_quatro,
               o.acima_4,
               o.total_geral,
               p.media_gasto,
               p.media_lucro,
               Q.receita,
               Q.despesa,
               Q.lucro
        FROM ap_clinicas a 
        INNER JOIN (SELECT INSCRICAO, assiduos_a1, ASSIDUOS_A2, MAX(data_inclusao) AS data_inclusao FROM cli_agendados_assiduos GROUP BY INSCRICAO ) B ON b.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, FALTOSOS_B1, FALTOSOS_B2, MAX(data_inclusao) AS data_inclusao FROM cli_agendados_faltosos GROUP BY INSCRICAO ) C ON C.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, assiduos_c1, assiduos_c2, MAX(data_inclusao) AS data_inclusao FROM cli_atendidos_assiduos GROUP BY INSCRICAO ) D ON D.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, faltosos_d1, faltosos_d2, MAX(data_inclusao) AS data_inclusao FROM cli_atendidos_faltosos GROUP BY INSCRICAO ) E ON E.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, fm_mes_passado, fm_mes_ATUAL, MAX(data_inclusao) FROM cli_fluxo_fm GROUP BY INSCRICAO ) F ON F.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, qtd_flutuantes, porc_flutuantes, MAX(data_inclusao) AS data_inclusao FROM cli_flutuantes GROUP BY INSCRICAO ) G ON G.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, orcamento_mes, orcamento_total, MAX(data_inclusao) AS data_inclusao FROM cli_orcamento GROUP BY INSCRICAO ) H ON H.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, documentacao_mes, documentacao_total, MAX(data_inclusao) AS data_inclusao FROM cli_documentacao GROUP BY INSCRICAO ) I ON I.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, inicio_mes, inicio_total, MAX(data_inclusao) AS data_inclusao FROM cli_inicio GROUP BY INSCRICAO ) J ON J.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, orc_mespassado, ini_mespassado, orc_mesatual, ini_mesatual  FROM cli_orcamentos_x_inicios GROUP BY INSCRICAO ) K ON K.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, agendados, atendidos, flutuantes, MAX(data_inclusao) AS data_inclusao FROM cli_tratamento_assiduos GROUP BY INSCRICAO ) L ON L.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, faltosos, flutuantes, total_faltosos, nao_ira_receber, porc_assiduos, porc_faltosos, MAX(data_inclusao) AS data_inclusao FROM cli_tratamento_assiduos_x_faltosos GROUP BY INSCRICAO ) M ON M.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, faltosos_agendados, faltosos_nao_agendados, MAX(data_inclusao) AS data_inclusao FROM cli_tratamento_faltosos GROUP BY INSCRICAO ) N ON N.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, 0_a_1, 1_a_2, 2_a_3, 3_a_4, acima_4, total_geral, MAX(data_inclusao) FROM cli_envelhecimento_clinica GROUP BY INSCRICAO ) O ON O.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO, media_gasto, media_lucro, MAX(data_inclusao) FROM cli_custo_paciente GROUP BY INSCRICAO ) P ON P.INSCRICAO = substring(a.CNPJ,1,8)
        INNER JOIN (SELECT INSCRICAO , dataref, receita, despesa,lucro  FROM cli_lin_comparativo_receita_despesas   ORDER BY data_arquivo desc LIMIT 45 ) Q ON Q.INSCRICAO = substring(a.CNPJ,1,8)
		    WHERE tipoclinica = "F"
        GROUP BY substring(a.CNPJ,1,8)
        order by a.NomeFantasia';
// Executa a consulta OU mostra uma mensagem de erro
$resultado = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
$resultado2 = $MySQLi->query($sql) OR trigger_error($MySQLi->error, E_USER_ERROR);
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>

     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['Cidade',   'Lucro'],
         <?php while ($row1 = $resultado2->fetch_object()) {
            ?>

          ['<?php echo $row1->cidade; ?>',<?php echo $row1->lucro; ?>],
        
          <?php } ?>      
      ]);

     var options = {

        sizeAxis: { minValue: 0, maxValue: 100 },
        region: 'BR', // Western Europe
        displayMode: 'markers',
        enableRegionInteractivity: true,
        legend: {numberFormat: 'R$'}, 
        domain: 'BR',
        resolution: 'provinces',
        datalessRegionColor: 'F5f5f5',
        magnifyingGlass: {enable: true, zoomFactor:9},
        colorAxis: {colors: ['red', 'green']} // orange to blue
      };


      var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
      chart.draw(data, options);

      var container = document.getElementById('chart_div');
      var geochart = new google.visualization.GeoChart(container);
    
    // register the 'select' event handler
    google.visualization.events.addListener(geochart, 'select', function () {
        // GeoChart selections return an array of objects with a row property; no column information
        var selection = geochart.getSelection();
       window.open('index.php?name=' + data.getValue(selection[0].row, 0), '_blank');
 
        /*alert('Você clico em ' + selection[0].row + ' que corresponde ' + data.getValue(selection[0].row, 0) + ': ' + data.getValue(selection[0].row, 1));*/
    });
    
    geochart.draw(data, options);
};
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rede Odonto - Clínicas</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Clínicas</h1>
      </div>
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div id="chart_div" style="width: 900px; height: 500px;"></div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Clínica</th>
                    <th>Lucro</th>
                    <th>Despesa(s)</th>
                    <th>Receita</th>
                    <th>Não irá Receber</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                                        // Faz um loop, passando por todos os resultados encontrados
                                        while ($row = $resultado->fetch_object()) {                                    
                                             ?>
                  <tr class="odd gradeX">
                    <td><a href="/bootstrap/pages/index.php?id=<?php echo substr($row->id,0,8);?>"><?php echo $row->NomeFantasia;?></a></td>
                    <td>R$<?php echo $row->lucro;?></td>
                    <td>R$<?php echo $row->despesa;?></td>
                    <td>R$<?php echo $row->receita;?></td>
                    <td>R$<?php echo $row->nao_ira_receber;?></td>
                  </tr>
                  <?php  }?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
            <div class="well">
              <h4><a class="btn btn-default btn-lg btn-block" target="_blank" href="../tabela.php">Visualizar Tabela Completa</a></h4>
            </div>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
 <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>