<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8" >   
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
 <!--    Grafico Agendados Assíduos  
      
    <script type="text/javascript">
    window.onresize = function(){
        startDrawingChart();
    };
 
    window.onload = function(){
        startDrawingChart();
    };
 
    var data_array = [
                        ['Assíduos', 'Agendados'],
                        ['Assíduos Mês', <?php echo $assiduos_a1; ?>],
                        ['Total Restante de Assíduos',<?php echo $assiduos_a2-$assiduos_a1; ?>]
                    ];
                     
    startDrawingChart = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_array);
 
            var options = {
              title: 'Agendados Assíduos',
              is3D: true,
              hAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
            };
 
            var chart = new google.visualization.PieChart(document.getElementById('agendados_assiduos'));
            chart.draw(data, options);
        }
    };
    </script>




    <script type="text/javascript">
    
 
    var data_array1 = [
                       ['Data Referência', 'Total'],
                        <?php while ($row_lin_agendados_assiduo = $query_lin_agendados_assiduos->fetch_object()) {
                          ?>
                          ['<?php echo $row_lin_agendados_assiduo->dataref; ?>', <?php echo $row_lin_agendados_assiduo->total; ?> ],            
                       <?php }     ?>
                    ];
                     
    startDrawingChart = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
 
        function drawChart() {
            var data = google.visualization.arrayToDataTable(data_array1);
 
            var options = {
              title: 'Agendados Assíduos',
              is3D: true,
          
            };
 
            var chart = new google.visualization.AreaChart(document.getElementById('lin_agendados_assiduos'));
            chart.draw(data, options);
        }
    };
    </script>
    <!--
    Grafico Linha  Agendados Assíduos
      <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_agendados_assiduo = $query_lin_agendados_assiduos->fetch_object()) {
            ?>
            ['<?php echo $row_lin_agendados_assiduo->dataref; ?>', <?php echo $row_lin_agendados_assiduo->total; ?> ],            
         <?php }     ?>
        ]);
        var options = {
          title: 'Agendados Assíduos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };
        var chart = new google.visualization.AreaChart(document.getElementById('lin_agendados_assiduos'));
        chart.draw(data, options);
      }
    </script>
    <!--    Grafico Agendados Faltosos -->

 



    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Faltosos', 'Agendados'],
          ['Faltosos Mês', <?php echo $faltosos_b1; ?>],
          ['Total Restante de Faltosos',<?php echo $faltosos_b2-$faltosos_b1; ?>],
        ]);
        var options = {
          title: 'Agendados Faltosos',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('agendados_faltosos'));
        chart.draw(data, options);
      }
  </script>

     <!--    Grafico Linha Agendados Faltosos -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_agendados_faltosos = $query_lin_agendados_faltosos->fetch_object()) {
            ?>
            ['<?php echo $row_lin_agendados_faltosos->dataref; ?>', <?php echo $row_lin_agendados_faltosos->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Agendados Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_agendados_faltosos'));
        chart.draw(data, options);
      }
    </script>

       <!--    Grafico Atendidos Assíduos -->

  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Assíduos', 'Atendidos'],
          ['Atendidos Mês', <?php echo $assiduos_a1; ?>],
          ['Ainda não atendidos',<?php echo $assiduos_a2-$assiduos_a1; ?>],
        ]);

        var options = {
          title: 'Atendidos Assíduos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('atendidos_assiduos'));
        chart.draw(data, options);
      }
  </script>
 <!--    Grafico Linha Atendidos Assíduos -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_atendidos_assiduos = $query_lin_atendidos_assiduos->fetch_object()) {
            ?>
            ['<?php echo $row_lin_atendidos_assiduos->dataref; ?>', <?php echo $row_lin_atendidos_assiduos->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Atendidos Assíduos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_atendidos_assiduos'));
        chart.draw(data, options);
      }
    </script>

       <!--    Grafico Atendidos Faltosos-->
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Faltosos', 'Atendidos'],
          ['Faltosos Atendidos', <?php echo $faltosos_d1; ?>],
          ['Não atendidos',<?php echo $faltosos_d2-$faltosos_d1; ?>],
        ]);

        var options = {
          title: 'Atendidos Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('atendidos_faltosos'));
        chart.draw(data, options);
      }
    </script>
<!--    Grafico Linha Atendidos Faltosos -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_atendidos_faltosos = $query_lin_atendidos_faltosos->fetch_object()) {
            ?>
            ['<?php echo $row_lin_atendidos_faltosos->dataref; ?>', <?php echo $row_lin_atendidos_faltosos->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Atendidos Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_atendidos_faltosos'));
        chart.draw(data, options);
      }
    </script>


           <!--     Grafico Fluxo FM-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Faltosos', 'Quantidade', { role: 'style' }],
         ['Mês Passado', <?php echo $fm_mes_passado ?>, '#017cc2'],            
         ['Mês Atual', <?php echo $fm_mes_atual ?>, '#86c127'],            
       ]);

        var options = {
        
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('fluxo_fm'));
        chart.draw(data, options);
      }
    </script>  

<!--    Grafico Linha Fluxo FM -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_fluxo_fm = $query_lin_fluxo_fm->fetch_object()) {
            ?>
            ['<?php echo $row_lin_fluxo_fm->dataref; ?>', <?php echo $row_lin_fluxo_fm->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Fluxo FM',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_fm'));
        chart.draw(data, options);
      }
    </script>


          <!--    Grafico Flutuantes-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Flutuantes', 'Total'],
          ['Flutuantes', <?php echo $qtd_flutuantes; ?>],
          ['Total Assíduos',<?php echo $assiduos_a2 ?>],
        ]);

        var options = {
          title: 'Flutuantes',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('flutuantes'));
        chart.draw(data, options);
      }
    </script>
    <!--    Grafico Linha Flutuantes -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_flutuantes = $query_lin_flutuantes->fetch_object()) {
            ?>
            ['<?php echo $row_lin_flutuantes->dataref; ?>', <?php echo $row_lin_flutuantes->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Fluxo FM',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_flutuantes'));
        chart.draw(data, options);
      }
    </script>
             <!--    Grafico Orçamentos-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Orçamentos', 'Total'],
          ['Orçamentos Mês', <?php echo $orcamento_mes; ?>],
          ['Orçamentos Total',<?php echo $orcamento_total ?>],
        ]);

        var options = {
          title: 'Orçamentos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('orcamentos'));
        chart.draw(data, options);
      }
    </script>  
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_orcamento = $query_lin_orcamento->fetch_object()) {
            ?>
            ['<?php echo $row_lin_orcamento->dataref; ?>', <?php echo $row_lin_orcamento->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_orcamentos'));
        chart.draw(data, options);
      }
    </script>

    <!--    Grafico Documentação-->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Documentação', 'Total'],
          ['Documentação Mês', <?php echo $documentacao_mes; ?>],
          ['Documentação Total',<?php echo $documentacao_total ?>],
        ]);

        var options = {
          title: 'Documentação',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('documentacao'));
        chart.draw(data, options);
      }
    </script> 
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_documentacao = $query_lin_documentacao->fetch_object()) {
            ?>
            ['<?php echo $row_lin_documentacao->dataref; ?>', <?php echo $row_lin_documentacao->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Documentação',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_documentacao'));
        chart.draw(data, options);
      }
    </script>
    <!---    Grafico Inícios-->
   <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Inícios', 'Total'],
          ['Inícios Mês', <?php echo $inicio_mes; ?>],
          ['Inícios Total',<?php echo $inicio_total ?>],
        ]);

        var options = {
          title: 'Inícios',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('inicio'));
        chart.draw(data, options);
      }
    </script>  
      <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_inicio = $query_lin_inicio->fetch_object()) {
            ?>
            ['<?php echo $row_lin_inicio->dataref; ?>', <?php echo $row_lin_inicio->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Inícios',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_inicio'));
        chart.draw(data, options);
      }
    </script>
      <!--    Grafico Envelhecimento Clínica-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Envelhecimento', 'Quantidade'],
          ['Zero a Um Ano', <?php echo $zero_a_um; ?>],
          ['Um a Dois Anos',<?php echo $um_a_dois ?>],
          ['Dois a Três Anos',<?php echo $dois_a_tres ?>],
          ['Três a Quatro Anos',<?php echo $tres_a_quatro ?>],
          ['Acima de Quatro Anos',<?php echo $acima_4 ?>],
        ]);

        var options = {
          title: 'Envelhecimento Clínica',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('envelhecimento'));
        chart.draw(data, options);
      }
    </script>  
          <!--    Grafico Tratamento Faltosos-->
     <script type="text/javascript">
     window.onresize = function(){
        startDrawingChart();
    };
 
    window.onload = function(){
        startDrawingChart();
    };
 

      var data_array = [
                       ['Faltosos', 'Quantidade', { role: 'style' }],
                       ['Não Agendados', <?php echo $faltosos_agendados ?>, '#017cc2'],            // RGB value
                       ['Agendados', <?php echo $faltosos_nao_agendados ?>, '#86c127']        
                    ];

     startDrawingChart = function(){
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(data_array);

        var options = {
          title: 'Tratamento Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('tratamento_faltosos'));
        chart.draw(data, options);
      }
    };
    </script>  
      <!--    Grafico Tratamento Assíduos-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Assíduos', 'Quantidade', { role: 'style' }],
         ['Agendados', <?php echo $taagendados ?>, '#017cc2'],            // RGB value
         ['Atendidos', <?php echo $taatendidos ?>, '#86c127'],  
         ['Flutuantes', <?php echo $taflutuantes ?>, '#da251c'],           // English color name
       ]);

        var options = {
          title: 'Tratamento Assíduos',
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('tratamento_assiduos'));
        chart.draw(data, options);
      }
    </script>  
         <!--    Grafico Tratamento Assíduos x Faltosos-->
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tratamento', 'Total'],
          ['Assíduos', <?php echo $assiduos_a2+$assiduos_c2; ?>],
          ['Faltosos',<?php echo $aftotal_faltosos ?>],
        ]);

        var options = {
          title: 'Tratamento Assíduos x Faltosos',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('assiduos_x_faltosos'));
        chart.draw(data, options);
      }
    </script>  
         <!--    Grafico Linha Tratamento Assíduos x Faltosos-->
        <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Assíduos', 'Faltosos'],

              <?php while ($row_lin_tratamento_assiduos_faltosos = $query_lin_tratamento_assiduos_faltosos->fetch_object()) {
            ?>

          ['<?php echo $row_lin_tratamento_assiduos_faltosos->dataref; ?>',<?php echo $row_lin_tratamento_assiduos_faltosos->total_assiduos; ?>    ,<?php echo $row_lin_tratamento_assiduos_faltosos->total_faltosos; ?>],
        
          <?php } ?>
        ]);

        var options = {
          title: 'Tratamento Assíduos x Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_tratamento_assiduos_faltosos'));
        chart.draw(data, options);
      }
    </script>

     <!--    Grafico Custo Paciente  -->

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Custo', 'Media', { role: 'style' }],
          <?php if ( $media_lucro > $media_gasto ) {?>
          	['Média Lucro', <?php echo $media_lucro; ?>,  '#da251c'],
            ['Média Gasto', <?php echo $media_lucro-$media_gasto;?>, '#86c127'],
         <?php  } 
          else { ?>
          	['Média Gasto', <?php echo $media_gasto; ?>,  '#86c127'],
          	['Média Lucro', <?php echo $media_gasto-$media_lucro; ?>,  '#da251c'],
         <?php  }
          	?>          
        ]);        
        var options = {
          title: 'Custo Paciente',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('custo_paciente'));
        chart.draw(data, options);
      }
    </script>  
      <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_custo_paciente = $query_lin_custo_paciente->fetch_object()) {
            ?>
            ['<?php echo $row_lin_custo_paciente->dataref; ?>', <?php echo $row_lin_custo_paciente->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Custo Paciente',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_custo_paciente'));
        chart.draw(data, options);
      }
    </script>
         <!--    Grafico Inícios x Orçamentos-->
    <script type="text/javascript">
        google.load("visualization", '1.1', {packages:['corechart']});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
           var oldData = google.visualization.arrayToDataTable([
            ['Mês Passado', 'Valores'],           
            ['Orçamentos', <?php echo $orc_mespassado;?>], 
            ['Inícios', <?php echo $ini_mespassado;?>]]);

          var newData = google.visualization.arrayToDataTable([
            ['Mês Atual', 'Valores'],        
            ['Orçamentos', <?php echo $orc_mesatual;?>], 
            ['Inícios', <?php echo $ini_mesatual;?>]]);

          var options = { pieSliceText: 'none' };
          var chartBefore = new google.visualization.PieChart(document.getElementById('piechart_before'));
          var chartAfter = new google.visualization.PieChart(document.getElementById('piechart_after'));
          var chartDiff = new google.visualization.PieChart(document.getElementById('piechart_diff'));

          chartBefore.draw(oldData, options);
          chartAfter.draw(newData, options);

          var diffData = chartDiff.computeDiff(oldData, newData);
          chartDiff.draw(diffData, options);
        }
    </script>
        <!--    Grafico linha Inícios x Orçamentos-->
          <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Orçamentos', 'Inícios', 'Proporção Inícios x Orçamentos'],

              <?php while ($row_lin_tratamento_inicio_x_orcamento = $query_lin_tratamento_inicio_x_orcamento->fetch_object()) {
            ?>

          ['<?php echo $row_lin_tratamento_inicio_x_orcamento->dataref; ?>',<?php echo $row_lin_tratamento_inicio_x_orcamento->orcamentos; ?>    ,<?php echo $row_lin_tratamento_inicio_x_orcamento->inicios; ?>,<?php echo $row_lin_tratamento_inicio_x_orcamento->proporcao; ?> ],
        
          <?php } ?>
        ]);

        var options = {
          title: 'Tratamento Inícios x Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_tratamento_inicio_x_orcamento'));
        chart.draw(data, options);
      }
    </script>

      <!--    Grafico Fluxo de Paciente -->
       <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Faltosos', 'Quantidade', { role: 'style' }],
         ['Mês Retrasado', <?php echo $total_pac_mes_retrasado ?>, '#017cc2'],            // RGB value
         ['Mês Passado', <?php echo $total_pac_mes_passado ?>, '#86c127'],            // English color name
       ]);

        var options = {       
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('fluxo_paciente'));
        chart.draw(data, options);
      }
    </script>  
     <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Total'],
          <?php while ($row_lin_fluxo_paciente = $query_lin_fluxo_paciente->fetch_object()) {
            ?>
            ['<?php echo $row_lin_fluxo_paciente->dataref; ?>', <?php echo $row_lin_fluxo_paciente->total; ?> ],            
         <?php }     ?>
        ]);

        var options = {
          title: 'Fluxo Paciente',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_paciente'));
        chart.draw(data, options);
      }
    </script>

<!-- comparativo receita despesas -->
   <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data Referência', 'Receita', 'Despesas', 'Lucro'],

              <?php while ($row_lin_comparativo_receita_despesas = $query_lin_comparativo_receita_despesas->fetch_object()) {
            ?>

          ['<?php echo $row_lin_comparativo_receita_despesas->dataref; ?>',<?php echo $row_lin_comparativo_receita_despesas->receita; ?>    ,<?php echo $row_lin_comparativo_receita_despesas->despesa; ?>,<?php echo $row_lin_comparativo_receita_despesas->lucro; ?> ],
        
          <?php } ?>
        ]);

        var options = {
          title: 'Comparativo Receita Despesas',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          curveType: 'function',
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_comparativo_receita_despesas'));
        chart.draw(data, options);
      }
    </script>
    <!-- negociacao -->
       <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Data Referência', 'Total a Receber', 'Total em Atraso', 'Total Pago'],

                <?php while ($row_lin_negociacao = $query_lin_negociacao->fetch_object()) {
              ?>
            ['<?php echo $row_lin_negociacao->dataref; ?>',<?php echo $row_lin_negociacao->total_a_receber; ?>    ,<?php echo $row_lin_negociacao->total_em_atraso; ?>,<?php echo $row_lin_negociacao->total_pago; ?> ],
          
            <?php } ?>
          ]);

          var options = {
            title: 'Negociação',
            hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
          };
          var chart = new google.visualization.AreaChart(document.getElementById('lin_negociacao'));
          chart.draw(data, options);
        }
      </script>

      <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['negociacao', 'Total'],
          ['Total a Receber', <?php echo $total_a_receber; ?>],
          ['Total em Atraso',<?php echo $total_em_atraso ?>],
        ]);

        var options = {
          title: 'Negociação',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('negociacao'));
        chart.draw(data, options);
      }

     
    </script>  
    </head>
    </html>
