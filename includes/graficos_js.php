 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <script type="text/javascript">
var data_LinIniOrcDoc = [
		['Data Referência', 'Ínicios', 'Documentação', 'Orçamentos'],
		<?php
		while ($row_lin_IniDocOrc =  $query_lin_inicios_documentacao_orcamento2->fetch_object()) {
			?>
                             ['<?php echo $row_lin_IniDocOrc->dataref; ?>',<?php echo $row_lin_IniDocOrc->inicios; ?>    ,<?php echo $row_lin_IniDocOrc->documentacao; ?>,<?php echo $row_lin_IniDocOrc->orcamentos; ?> ],
                             <?php } ?>
                      ];

    var data_LinOrc = [
                                  ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                   <?php while ($row_lin_orcamento = $query_lin_orcamento2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_orcamento->dataref; ?>', <?php echo round($row_lin_orcamento->total_clinical,0); ?>, <?php echo round($row_lin_orcamento->media_regional,0); ?>, <?php echo round($row_lin_orcamento->media_nacional,0); ?> ],
                                 <?php }     ?>
                            ];

     var data_LinDoc = [
                        ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                   <?php while ($row_lin_documentacao = $query_lin_documentacao2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_documentacao->dataref; ?>', <?php echo $row_lin_documentacao->total_clinical; ?>,<?php echo round($row_lin_documentacao->media_regional,0); ?>, <?php echo round($row_lin_documentacao->media_nacional,0); ?>  ],
                                 <?php }     ?>
                                 ];


      var data_LinFlut = [
                          ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                        <?php while ($row_lin_flutuantes = $query_lin_flutuantes2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_flutuantes->dataref; ?>', <?php echo $row_lin_flutuantes->total_clinical; ?>,<?php echo round($row_lin_flutuantes->media_regional,0); ?>, <?php echo round($row_lin_flutuantes->media_nacional,0); ?>  ],
                     <?php }     ?>
                            ];

      var data_LinIni = [
                         ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                   <?php while ($row_lin_inicio = $query_lin_inicio2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_inicio->dataref; ?>', <?php echo $row_lin_inicio->total_clinical; ?>,<?php echo round($row_lin_inicio->media_regional,0); ?>, <?php echo round($row_lin_inicio->media_nacional,0); ?>  ],
                                <?php }     ?>
                                 ];

      var data_LinFluPac = [
                            ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                        <?php while ($row_lin_fluxo_paciente = $query_busca_lin_fluxo_paciente2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_fluxo_paciente->dataref; ?>', <?php echo $row_lin_fluxo_paciente->total_clinical; ?>,<?php echo round($row_lin_fluxo_paciente->media_regional,0); ?>, <?php echo round($row_lin_fluxo_paciente->media_nacional,0); ?>  ],
                                                                     <?php }     ?>
    ];

    var data_LinFalt = [
                        ['Data Referência', 'Total Clínica','Nacional Total Faltosos','Regional Total', ],
                                       <?php while ($row_lin_faltosos = $query_busca_lin_qtde_faltosos2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_faltosos->dataref; ?>', <?php echo $row_lin_faltosos->total_clinical; ?>,<?php echo round($row_lin_faltosos->media_nacional_total,0); ?>,
                                            <?php echo round($row_lin_faltosos->regional_total,0); ?>,],
                                                                     <?php }     ?>
    ];
    var data_LinFaltAge = [
                        ['Data Referência', 'Faltosos Agendados','Média Nacional','Media Regional' ],
                                       <?php while ($row_lin_faltosos_agendados = $query_busca_lin_faltosos_agendados->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_faltosos_agendados->dataref; ?>', <?php echo $row_lin_faltosos_agendados->faltosos_agendados; ?>,<?php echo $row_lin_faltosos_agendados->media_nacional_agendados; ?>,<?php echo $row_lin_faltosos_agendados->regional_agendados; ?>   ],
                                                                     <?php }     ?>
    ];
    var data_LinFaltAte = [
                        ['Data Referência', 'Faltosos Atendidos','Média Nacional','Média Regional' ],
                                       <?php while ($row_lin_faltosos_atendidos = $query_busca_lin_qtde_faltosos3->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_faltosos_atendidos->dataref; ?>', <?php echo $row_lin_faltosos_atendidos->faltosos_atendidos; ?>, <?php echo round($row_lin_faltosos_atendidos->media_nacional_atendidos,0); ?>,<?php echo round($row_lin_faltosos_atendidos->regional_atendidos,0); ?>,  ],
                                                                     <?php }     ?>
    ];
    var data_LinCompRecDesp = [
                        ['Data Referência', 'Lucro Clínica','Média Lucro Regional', 'Média Lucro Nacional'],
                                  <?php while ($row_lin_comparativo_receita_despesas = $query_lin_comparativo_receita_despesas2->fetch_object()) {
                                ?>
                                    ['<?php echo $row_lin_comparativo_receita_despesas->dataref; ?>', <?php echo $row_lin_comparativo_receita_despesas->lucro_clinical; ?>,<?php echo round($row_lin_comparativo_receita_despesas->media_regional,0); ?>, <?php echo round($row_lin_comparativo_receita_despesas->media_nacional,0); ?>  ],
                              <?php } ?>
    ];

      var data_LinNegociacao = [
                                 ['Data Referência', 'Total em Atraso', 'Total Pago', 'Total a Receber'],
                                  <?php while ($row_lin_negociacao = $query_lin_negociacao2->fetch_object()) {
                                ?>
                              ['<?php echo $row_lin_negociacao->dataref; ?>',<?php echo $row_lin_negociacao->total_em_atraso; ?>    ,<?php echo $row_lin_negociacao->total_pago; ?>,<?php echo $row_lin_negociacao->total_a_receber; ?> ],
                              <?php } ?>
    ];



  var data_LinCanc = [
                      ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                       <?php while ($row_lin_cancelamento = $query_busca_lin_cancelamento_ficha2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_cancelamento->dataref; ?>', <?php echo $row_lin_cancelamento->total_clinical; ?>,<?php echo round($row_lin_cancelamento->media_regional,0); ?>, <?php echo round($row_lin_cancelamento->media_nacional,0); ?>  ],
                                                                                                         <?php }     ?>
  ];


  var data_LinIniXOrc = [
                               ['Data Referência', 'Orçamentos', 'Ínicios', 'Proporção Ínicios x Orçamentos'],
                              <?php while ($row_lin_inicio_x_orcamento = $query_lin_tratamento_inicio_x_orcamento->fetch_object()) {
                            ?>
                          ['<?php echo $row_lin_inicio_x_orcamento->dataref; ?>',<?php echo $row_lin_inicio_x_orcamento->orcamentos; ?>    ,<?php echo $row_lin_inicio_x_orcamento->inicios; ?>,<?php echo round($row_lin_inicio_x_orcamento->proporcao); ?>  ],
                          <?php } ?>
    ];

  var data_LinGastosDental = [
                              ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                     <?php while ($row_lin_gastos_dental = $query_busca_gastos_dental2->fetch_object()) {
                                    ?>
                                    ['<?php echo $row_lin_gastos_dental->dataref; ?>', <?php echo $row_lin_gastos_dental->total_clinical; ?>,<?php echo round($row_lin_gastos_dental->media_regional,0); ?>, <?php echo round($row_lin_gastos_dental->media_nacional,0); ?>  ],
                                                                     <?php }     ?>
  ];

  var data_LinCustoFuncionario = [
                                  ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                 <?php while ($row_lin_custo_funcionario = $query_busca_lin_custo_funcionario->fetch_object()) {
                                ?>
                                ['<?php echo $row_lin_custo_funcionario->dataref; ?>', <?php echo $row_lin_custo_funcionario->valor; ?>,<?php echo round($row_lin_custo_funcionario->media_regional,0); ?>, <?php echo round($row_lin_custo_funcionario->media_nacional,0); ?>  ],
                                                             <?php }     ?>
];

  var data_LinSuspensoes = [
                            ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                 <?php while ($row_lin_suspensoes= $query_busca_lin_suspensoes->fetch_object()) {
                                ?>
                                ['<?php echo $row_lin_suspensoes->dataref; ?>', <?php echo $row_lin_suspensoes->quantidade; ?>,<?php echo round($row_lin_suspensoes->media_regional,0); ?>, <?php echo round($row_lin_suspensoes->media_nacional,0); ?>  ],
                                                             <?php }     ?>
];

  var data_LinFluxoFM = [
                         ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                                <?php while ($busca_lin_fluxo_fm= $query_lin_fluxo_fm2->fetch_object()) {
                               ?>
                               ['<?php echo $busca_lin_fluxo_fm->dataref; ?>', <?php echo $busca_lin_fluxo_fm->total_clinical; ?>,<?php echo round($busca_lin_fluxo_fm->media_regional,0); ?>, <?php echo round($busca_lin_fluxo_fm->media_nacional,0); ?>  ],
                                                           <?php }     ?>
];
  
  var data_LinEntradaOrto = [
                         ['Data Referência', 'Total Clínica','Média Regional', 'Média Nacional'],
                           <?php while ($busca_lin_entrada_orto= $query_lin_entrada_orto->fetch_object()) {
                            ?>
                               ['<?php echo $busca_lin_entrada_orto->dataref; ?>', <?php echo $busca_lin_entrada_orto->total_clinical; ?>,<?php echo round($busca_lin_entrada_orto->media_regional,0); ?>, <?php echo round($busca_lin_entrada_orto->media_nacional,0); ?>  ],
                         <?php }     ?>
];
  var data_LinClienteAmigo = [
                              ['Data Referência', 'Total Indicação', 'Total Contemplado', 'Média Regional Indicações', 'Média Regional Contemplados','Média Nacional Indicações', 'Média Nacional Contemplado'],
                              <?php while ($row_lin_cliente_amigo = $query_busca_cliente_amigo->fetch_object()) {
                               ?>
['<?php echo $row_lin_cliente_amigo->dataref; ?>', <?php echo $row_lin_cliente_amigo->total_indic_clinica; ?> ,<?php echo $row_lin_cliente_amigo->total_contemplado_clinica; ?>,
<?php echo round($row_lin_cliente_amigo->media_regional_indic,0); ?>,<?php echo round($row_lin_cliente_amigo->media_regional_contemplado,0); ?>,<?php echo round($row_lin_cliente_amigo->media_nacional_indic,0); ?>,<?php echo round($row_lin_cliente_amigo->media_nacional_contemplado,0); ?>     ],
                            <?php }     ?>
];


  var data_LinAbandono = [
                             ['Data Referência', 
                             'Total de Abandono Clínica', 'Total de Tratamento Clínica', 'Índice de Abandono Clínica',
                              'Média Regional Abandono', 'Média Regional Tratamento','Índice de Abandono Regional',
                              'Média Nacional Abandono', 'Média Nacional Tratamento','Índice de Abandono Nacional',],
                             <?php while ($row_lin_abandono = $query_busca_abandono->fetch_object()) {
                              ?>
                           ['<?php echo $row_lin_abandono->dataref; ?>',
                            <?php echo $row_lin_abandono->total_abandono_clinica; ?> ,<?php echo $row_lin_abandono->total_tratamento_clinica; ?>,<?php echo $row_lin_abandono->total_indice_clinica; ?>,
                           <?php echo round($row_lin_abandono->media_regional_abandono); ?>,<?php echo round($row_lin_abandono->media_regional_tratamento); ?>,<?php echo round($row_lin_abandono->media_regional_indice); ?>,  
                           <?php echo round($row_lin_abandono->media_nacional_abandono); ?>,<?php echo round($row_lin_abandono->media_nacional_tratamento); ?>,<?php echo round($row_lin_abandono->media_nacional_indice); ?>,  ],
                                                       <?php }     ?>
];

  var data_LinIndiceFalta = [
                             ['Data ReferÃªncia', 
                             'Total de Faltas Clínica', 'Total de Marcações Clínica', 'Índice de Falta Clínica',
                              'Média Regional Faltas', 'Média Regional Marcações','Índice de Falta Regional',
                              'Média Nacional Faltas', 'Média Nacional Marcações','Índice de Falta Nacional',],
                             <?php while ($row_lin_indice_falta = $query_busca_indice_falta->fetch_object()) {
                              ?>
                           ['<?php echo $row_lin_indice_falta->dataref; ?>',
                            <?php echo $row_lin_indice_falta->total_falta_clinica; ?> ,<?php echo $row_lin_indice_falta->total_marcacoes_clinica; ?>,<?php echo $row_lin_indice_falta->total_indice_clinica; ?>,
                           <?php echo round($row_lin_indice_falta->media_regional_falta); ?>,<?php echo round($row_lin_indice_falta->media_regional_marcacoes); ?>,<?php echo round($row_lin_indice_falta->media_regional_indice); ?>,  
                           <?php echo round($row_lin_indice_falta->media_nacional_faltas); ?>,<?php echo round($row_lin_indice_falta->media_nacional_marcacoes); ?>,<?php echo round($row_lin_indice_falta->media_nacional_indice); ?>,  ],
                                                       <?php }     ?>
];


     startDrawingLinOrc = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinOrc);


        var options = {
          title: 'Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_orcamentos'));
        chart.draw(data, options);
      }
     };

       startDrawingLinDoc = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinDoc); 

       var options = {
          title: 'Documentação',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_documentacao'));
        chart.draw(data, options);
      }
  };

  startDrawingLinIni = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinIni);

        var options = {
          title: 'Ínicios',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_inicios'));
        chart.draw(data, options);
      }
  };
    startDrawingLinFlut = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFlut); 

       var options = {
          title: 'Flutuantes',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_flutuantes'));
        chart.draw(data, options);
      }
    };

  startDrawingLinFluPac = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFluPac);

        var options = {
          title: 'Fluxo Paciente',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_paciente'));
        chart.draw(data, options);
      }
    };

      startDrawingLinFaltosos = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinFalt);

        var options = {
          title: 'Total Faltosos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.LineChart(document.getElementById('lin_faltosos'));
        chart.draw(data, options);
      }
    };

      startDrawingLinCompRecDesp = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
          function drawChart() {
          var data = google.visualization.arrayToDataTable(data_LinCompRecDesp);

          var options = {
          title: 'Histórico Lucro',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_comparativo_receita_despesas'));
        chart.draw(data, options);
      }
  };
  startDrawingLinCancelamento = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinCanc);

        var options = {
          title: 'Cancelamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_cancelamento'));
        chart.draw(data, options);
      }
    };
 startDrawingLinIniXOrc = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinIniXOrc);

        var options = {
          title: 'Tratamento Ínicios x Orçamentos',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_tratamento_inicio_x_orcamento'));
        chart.draw(data, options);
      }
  };

 startDrawingLinGastosDental = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinGastosDental);

        var options = {
          title: 'Gastos Dental',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_gasto_dental'));
        chart.draw(data, options);
      }
    };

    startDrawingLinCustoFuncionario = function(){
        google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
    function drawChart() {
    var data = google.visualization.arrayToDataTable(data_LinCustoFuncionario);

      var options = {
        title: 'Custo Funcionário',
        hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
      };

      var chart = new google.visualization.AreaChart(document.getElementById('lin_custo_funcionario'));
      chart.draw(data, options);
    }
  };
  startDrawingLinSuspensoes = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinSuspensoes);

        var options = {
          title: 'Suspensões',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_suspensoes'));
        chart.draw(data, options);
      }
  };
   startDrawingLinNegociacao = function(){
          google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
      function drawChart() {
      var data = google.visualization.arrayToDataTable(data_LinNegociacao);

        var options = {
          title: 'Negociação',
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
          colors: ['red', 'green', 'blue'],
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('lin_negociacao'));
        chart.draw(data, options);
      }
  };
  startDrawingLinFluxoFM = function(){
      google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
  function drawChart() {
  var data = google.visualization.arrayToDataTable(data_LinFluxoFM);

    var options = {
      title: 'Fluxo FM',
      hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('lin_fluxo_fm'));
    chart.draw(data, options);
  }
};

startDrawingLinEntradaOrto = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinEntradaOrto);

  var options = {
    title: 'Entrada Orto',
    hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('lin_entrada_orto'));
  chart.draw(data, options);
}
};

startDrawingLinClienteAmigo = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinClienteAmigo);

  var options = {
    title: 'Cliente Amigo',
    hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.AreaChart(document.getElementById('lin_cliente_amigo'));
  chart.draw(data, options);
}
};

startDrawingValorNegociacao_ma = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_ValorNegociacao_ma);

   var options = {
          title: 'Valores Negociação',
          is3D: true,
          colors: ['red', 'green'],
        };

  var chart = new google.visualization.PieChart(document.getElementById('valor_negociacao'));
  chart.draw(data, options);
}
};

startDrawingValorNegociacao_mp = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_ValorNegociacao_mp);

   var options = {
          title: 'Valores Negociação',
          is3D: true,
          colors: ['red', 'green'],
        };

  var chart = new google.visualization.PieChart(document.getElementById('valor_negociacao_mp'));
  chart.draw(data, options);
}
};

startDrawingFaltososAgendados = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinFaltAge);

   var options = {
          title: 'Faltosos Agendados',
          is3D: true
        };

  var chart = new google.visualization.AreaChart(document.getElementById('lin_faltosos_agendados'));
  chart.draw(data, options);
}
};
startDrawingFaltososAtendidos = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinFaltAte);

   var options = {
          title: 'Faltosos Atendidos',
          is3D: true
        };

  var chart = new google.visualization.AreaChart(document.getElementById('lin_faltosos_atendidos'));
  chart.draw(data, options);
}
};

startDrawingLinAbandono = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinAbandono);

  var options = {
    title: 'Histórico Abandono',
    hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.LineChart(document.getElementById('lin_abandono'));
  chart.draw(data, options);
}
};

startDrawingLinIndiceFalta = function(){
    google.load("visualization", "1", {packages:["corechart"],callback: drawChart});
function drawChart() {
var data = google.visualization.arrayToDataTable(data_LinIndiceFalta);

  var options = {
    title: 'Histórico ìndice de Faltas',
    hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
    vAxis: {minValue: 0}
  };

  var chart = new google.visualization.LineChart(document.getElementById('lin_indice_de_faltas'));
  chart.draw(data, options);
}
};
</script>
