<script type="text/javascript">
$( "#link_ma_orc" ).click(function() {
        	var id = <?php echo $id?>;
          var regional = '<?php echo $regional?>';
          var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
          var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
          var total_pac  = '<?php echo round($pacientes_ma)  ?>';
          var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
            $("#wait").show();
            $("#div_orc").hide();
            $("#mp" ).removeClass( "active" );
            $("#ma" ).addClass( "active" );
            $.ajax({
            url: '../panels/panel_orcamentos_ma.php',
            type: 'GET',
            data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp},
            success: function(results) {
                    //$("#divTabelaClinicas").show();
                    $("#div_orc").show();
                    $("#div_orc").html(results);
                    $("#wait").hide();
                }
             });
		});

    $( "#link_mp_orc" ).click(function() {
    	  var id = <?php echo $id?>;
        var regional = '<?php echo $regional?>';
        var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
        var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
        var total_pac  = '<?php echo round($total_pac_mp)  ?>';
          $("#wait").show();
          $("#div_orc").hide();
          $("#ma" ).removeClass( "active" );
          $("#mp" ).addClass( "active" );
          $.ajax({
          url: '../panels/panel_orcamentos.php',
          type: 'GET',
          data: {id: id, regional:regional, total_pac:total_pac, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional  },
          success: function(results) {
                  //$("#divTabelaClinicas").show();
                  $("#div_orc").show(); 
                  $("#div_orc").html(results);
                  $("#wait").hide();
              }
        	 });
			});
     $( "#link_ma_doc" ).click(function() {
          var id = <?php echo $id?>;
          var regional = '<?php echo $regional?>';
          var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
          var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
          var total_pac  = '<?php echo round($pacientes_ma)  ?>';
          var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
            $("#wait_doc").show();
            $("#div_doc").hide();
            $("#mp_doc" ).removeClass( "active" );
            $("#ma_doc" ).addClass( "active" );
            $.ajax({
            url: '../panels/panel_documentacoes_ma.php',
            type: 'GET',
            data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp},
            success: function(results) {
                    //$("#divTabelaClinicas").show();
                    $("#div_doc").show();
                    $("#div_doc").html(results);
                    $("#wait_doc").hide();
                }
             });
    });

    $( "#link_mp_doc" ).click(function() {
        var id = <?php echo $id?>;
        var regional = '<?php echo $regional?>';
        var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
        var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
        var total_pac  = '<?php echo round($total_pac_mp)  ?>';
          $("#wait_doc").show();
          $("#div_doc").hide();
          $("#ma_doc" ).removeClass( "active" );
          $("#mp_doc" ).addClass( "active" );
          $.ajax({
          url: '../panels/panel_documentacoes_mp.php',
          type: 'GET',
          data: {id: id, regional:regional, total_pac:total_pac, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional  },
          success: function(results) {
                  //$("#divTabelaClinicas").show();
                  $("#div_doc").show(); 
                  $("#div_doc").html(results);
                  $("#wait_doc").hide();
              }
           });
      });
    
    $( "#link_ma_ini" ).click(function() {
        var id = <?php echo $id?>;
        var regional = '<?php echo $regional?>';
        var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
        var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
        var total_pac  = '<?php echo round($pacientes_ma)  ?>';
        var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
          $("#wait_ini").show();
          $("#div_ini").hide();
          $("#mp_ini" ).removeClass( "active" );
          $("#ma_ini" ).addClass( "active" );
          $.ajax({
          url: '../panels/panel_inicios_ma.php',
          type: 'GET',
          data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp},
          success: function(results) {
                  //$("#divTabelaClinicas").show();
                  $("#div_ini").show();
                  $("#div_ini").html(results);
                  $("#wait_ini").hide();
              }
           });
  });

  $( "#link_mp_ini" ).click(function() {
      var id = <?php echo $id?>;
      var regional = '<?php echo $regional?>';
      var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
      var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
      var total_pac  = '<?php echo round($total_pac_mp)  ?>';
        $("#wait_ini").show();
        $("#div_ini").hide();
        $("#ma_ini" ).removeClass( "active" );
        $("#mp_ini" ).addClass( "active" );
        $.ajax({
        url: '../panels/panel_inicios_mp.php',
        type: 'GET',
        data: {id: id, regional:regional, total_pac:total_pac, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional  },
        success: function(results) {
                //$("#divTabelaClinicas").show();
                $("#div_ini").show(); 
                $("#div_ini").html(results);
                $("#wait_ini").hide();
            }
         });
    });
$( "#link_ma_ini_orc" ).click(function() {
      var id = <?php echo $id?>;
      var regional = '<?php echo $regional?>';
      var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
      var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
      var total_pac  = '<?php echo round($pacientes_ma)  ?>';
      var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
        $("#wait_ini_orc").show();
        $("#div_ini_orc").hide();
        $("#mp_ini_orc" ).removeClass( "active" );
        $("#ma_ini_orc" ).addClass( "active" );
        $.ajax({
        url: '../panels/panel_inicios_orc_ma.php',
        type: 'GET',
        data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp},
        success: function(results) {
                //$("#divTabelaClinicas").show();
                $("#div_ini_orc").show();
                $("#div_ini_orc").html(results);
                $("#wait_ini_orc").hide();
            }
         });
});

$( "#link_mp_ini_orc" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
    var total_pac  = '<?php echo round($total_pac_mp)  ?>';
      $("#wait_ini_orc").show();
      $("#div_ini_orc").hide();
      $("#ma_ini_orc" ).removeClass( "active" );
      $("#mp_ini_orc" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_inicios_orc_mp.php',
      type: 'GET',
      data: {id: id, regional:regional, total_pac:total_pac, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional  },
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_ini_orc").show(); 
              $("#div_ini_orc").html(results);
              $("#wait_ini_orc").hide();
          }
       });
  });
$( "#link_ma_fal_tot" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
      $("#wait_fal_tot").show();
      $("#div_fal_tot").hide();
      $("#mp_fal_tot" ).removeClass( "active" );
      $("#ma_fal_tot" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fal_tot_ma.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fal_tot").show();
              $("#div_fal_tot").html(results);
              $("#wait_fal_tot").hide();
          }
       });
});

$( "#link_mp_fal_tot" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
    $("#wait_fal_tot").show();
    $("#div_fal_tot").hide();
    $("#ma_fal_tot" ).removeClass( "active" );
    $("#mp_fal_tot" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fal_tot_mp.php',
    type: 'GET',
    data: {id: id, regional:regional, total_pac:total_pac, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional  },
    success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fal_tot").show(); 
            $("#div_fal_tot").html(results);
            $("#wait_fal_tot").hide();
        }
     });
});
$( "#link_ma_fal_age" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
    
      $("#wait_fal_age").show();
      $("#div_fal_age").hide();
      $("#mp_fal_age" ).removeClass( "active" );
      $("#ma_fal_age" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fal_age.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fal_age").show();
              $("#div_fal_age").html(results);
              $("#wait_fal_age").hide();
          }
       });
});

$( "#link_mp_fal_age" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($pacientes_ma)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
    $("#wait_fal_age").show();
    $("#div_fal_age").hide();
    $("#ma_fal_age" ).removeClass( "active" );
    $("#mp_fal_age" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fal_age.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fal_age").show(); 
            $("#div_fal_age").html(results);
            $("#wait_fal_age").hide();
        }
     });
});
$( "#link_ma_fal_ate" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
      $("#wait_fal_ate").show();
      $("#div_fal_ate").hide();
      $("#mp_fal_ate" ).removeClass( "active" );
      $("#ma_fal_ate" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fal_ate.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fal_ate").show();
              $("#div_fal_ate").html(results);
              $("#wait_fal_ate").hide();
          }
       });
});

$( "#link_mp_fal_ate" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
    $("#wait_fal_ate").show();
    $("#div_fal_ate").hide();
    $("#ma_fal_ate" ).removeClass( "active" );
    $("#mp_fal_ate" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fal_ate.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
       success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fal_ate").show(); 
            $("#div_fal_ate").html(results);
            $("#wait_fal_ate").hide();
        }
     });
});
$( "#link_ma_flut" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
      $("#wait_flut").show();
      $("#div_flut").hide();
      $("#mp_flut" ).removeClass( "active" );
      $("#ma_flut" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_flut.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_flut").show();
              $("#div_flut").html(results);
              $("#wait_flut").hide();
          }
       });
});

$( "#link_mp_flut" ).click(function() {
	 	var id = <?php echo $id?>;
	    var regional = '<?php echo $regional?>';
	    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
	    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
	    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
	    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	    var dados = 'mp';
    $("#wait_flut").show();
    $("#div_flut").hide();
    $("#ma_flut" ).removeClass( "active" );
    $("#mp_flut" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_flut.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_flut").show(); 
            $("#div_flut").html(results);
            $("#wait_flut").hide();
        }
     });
});
$( "#link_ma_ind_fal" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
      $("#wait_ind_fal").show();
      $("#div_ind_fal").hide();
      $("#mp_ind_fal" ).removeClass( "active" );
      $("#ma_ind_fal" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_ind_fal.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_ind_fal").show();
              $("#div_ind_fal").html(results);
              $("#wait_ind_fal").hide();
          }
       });
});

$( "#link_mp_ind_fal" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
    $("#wait_ind_fal").show();
    $("#div_ind_fal").hide();
    $("#ma_ind_fal" ).removeClass( "active" );
    $("#mp_ind_fal" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_ind_fal.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp, dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_ind_fal").show(); 
            $("#div_ind_fal").html(results);
            $("#wait_ind_fal").hide();
        }
     });
});
$( "#link_ma_canc" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma'
      $("#wait_canc").show();
      $("#div_canc").hide();
      $("#mp_canc" ).removeClass( "active" );
      $("#ma_canc" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_canc.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_canc").show();
              $("#div_canc").html(results);
              $("#wait_canc").hide();
          }
       });
});

$( "#link_mp_canc" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'mp';
    $("#wait_canc").show();
    $("#div_canc").hide();
    $("#ma_canc" ).removeClass( "active" );
    $("#mp_canc" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_canc.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_canc").show(); 
            $("#div_canc").html(results);
            $("#wait_canc").hide();
        }
     });
});
$( "#link_ma_susp" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
      $("#wait_susp").show();
      $("#div_susp").hide();
      $("#mp_susp" ).removeClass( "active" );
      $("#ma_susp" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_susp.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_susp").show();
              $("#div_susp").html(results);
              $("#wait_susp").hide();
          }
       });
});

$( "#link_mp_susp" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'mp';
    $("#wait_susp").show();
    $("#div_susp").hide();
    $("#ma_susp" ).removeClass( "active" );
    $("#mp_susp" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_susp.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_susp").show(); 
            $("#div_susp").html(results);
            $("#wait_susp").hide();
        }
     });
});
$( "#link_ma_gast_dent" ).click(function() {
	  var id = <?php echo $id?>;
	    var regional = '<?php echo $regional?>';
	    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
	    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
	    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
	    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	    var dados = 'ma'; 
      $("#wait_gast_dent").show();
      $("#div_gast_dent").hide();
      $("#mp_gast_dent" ).removeClass( "active" );
      $("#ma_gast_dent" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_gast_dent.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_gast_dent").show();
              $("#div_gast_dent").html(results);
              $("#wait_gast_dent").hide();
          }
       });
});

$( "#link_mp_gast_dent" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp'; 
    $("#wait_gast_dent").show();
    $("#div_gast_dent").hide();
    $("#ma_gast_dent" ).removeClass( "active" );
    $("#mp_gast_dent" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_gast_dent.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_gast_dent").show(); 
            $("#div_gast_dent").html(results);
            $("#wait_gast_dent").hide();
        }
     });
});
$( "#link_ma_cust_funci" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma'; 
    
      $("#wait_cust_funci").show();
      $("#div_cust_funci").hide();
      $("#mp_cust_funci" ).removeClass( "active" );
      $("#ma_cust_funci" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_cust_funci.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_cust_funci").show();
              $("#div_cust_funci").html(results);
              $("#wait_cust_funci").hide();
          }
       });
});

$( "#link_mp_cust_funci" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'mp'; 
    $("#wait_cust_funci").show();
    $("#div_cust_funci").hide();
    $("#ma_cust_funci" ).removeClass( "active" );
    $("#mp_cust_funci" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_cust_funci.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_cust_funci").show(); 
            $("#div_cust_funci").html(results);
            $("#wait_cust_funci").hide();
        }
     });
});
$( "#link_ma_luc_pac" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma'; 
    
      $("#wait_luc_pac").show();
      $("#div_luc_pac").hide();
      $("#mp_luc_pac" ).removeClass( "active" );
      $("#ma_luc_pac" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_luc_pac.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_luc_pac").show();
              $("#div_luc_pac").html(results);
              $("#wait_luc_pac").hide();
          }
       });
});

$( "#link_mp_luc_pac" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'mp'; 
    $("#wait_luc_pac").show();
    $("#div_luc_pac").hide();
    $("#ma_luc_pac" ).removeClass( "active" );
    $("#mp_luc_pac" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_luc_pac.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_luc_pac").show(); 
            $("#div_luc_pac").html(results);
            $("#wait_luc_pac").hide();
        }
     });
});
$( "#link_ma_entr_orto" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma'; 
          $("#wait_entr_orto").show();
      $("#div_entr_orto").hide();
      $("#mp_entr_orto" ).removeClass( "active" );
      $("#ma_entr_orto" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_entr_orto.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
      success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_entr_orto").show();
              $("#div_entr_orto").html(results);
              $("#wait_entr_orto").hide();
          }
       });
});

$( "#link_mp_entr_orto" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'mp'; 
    $("#wait_entr_orto").show();
    $("#div_entr_orto").hide();
    $("#ma_entr_orto" ).removeClass( "active" );
    $("#mp_entr_orto" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_entr_orto.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_entr_orto").show(); 
            $("#div_entr_orto").html(results);
            $("#wait_entr_orto").hide();
        }
     });
});
$( "#link_ma_fm" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma'; 
      $("#wait_fm").show();
      $("#div_fm").hide();
      $("#mp_fm" ).removeClass( "active" );
      $("#ma_fm" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fm.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fm").show();
              $("#div_fm").html(results);
              $("#wait_fm").hide();
          }
       });
});

$( "#link_mp_fm" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'ma'; 
    $("#wait_fm").show();
    $("#div_fm").hide();
    $("#ma_fm" ).removeClass( "active" );
    $("#mp_fm" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fm.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fm").show(); 
            $("#div_fm").html(results);
            $("#wait_fm").hide();
        }
     });
});
$( "#link_ma_fm_pag" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
      $("#wait_fm_pag").show();
      $("#div_fm_pag").hide();
      $("#mp_fm_pag" ).removeClass( "active" );
      $("#ma_fm_pag" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fm_pag.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fm_pag").show();
              $("#div_fm_pag").html(results);
              $("#wait_fm_pag").hide();
          }
       });
});

$( "#link_mp_fm_pag" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
    $("#wait_fm_pag").show();
    $("#div_fm_pag").hide();
    $("#ma_fm_pag" ).removeClass( "active" );
    $("#mp_fm_pag" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fm_pag.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fm_pag").show(); 
            $("#div_fm_pag").html(results);
            $("#wait_fm_pag").hide();
        }
     });
});
$( "#link_ma_fm_n_pag" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
    
      $("#wait_fm_n_pag").show();
      $("#div_fm_n_pag").hide();
      $("#mp_fm_n_pag" ).removeClass( "active" );
      $("#ma_fm_n_pag" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_fm_n_pag.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_fm_n_pag").show();
              $("#div_fm_n_pag").html(results);
              $("#wait_fm_n_pag").hide();
          }
       });
});

$( "#link_mp_fm_n_pag" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($pacientes_ma)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
  
    $("#wait_fm_n_pag").show();
    $("#div_fm_n_pag").hide();
    $("#ma_fm_n_pag" ).removeClass( "active" );
    $("#mp_fm_n_pag" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_fm_n_pag.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_fm_n_pag").show(); 
            $("#div_fm_n_pag").html(results);
            $("#wait_fm_n_pag").hide();
        }
     });
});
$( "#link_ma_pacientes" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
    
      $("#wait_pacientes").show();
      $("#div_pacientes").hide();
      $("#mp_pacientes" ).removeClass( "active" );
      $("#ma_pacientes" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_pacientes.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_pacientes").show();
              $("#div_pacientes").html(results);
              $("#wait_pacientes").hide();
          }
       });
});

$( "#link_mp_pacientes" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'mp';
    $("#wait_pacientes").show();
    $("#div_pacientes").hide();
    $("#ma_pacientes" ).removeClass( "active" );
    $("#mp_pacientes" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_pacientes.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_pacientes").show(); 
            $("#div_pacientes").html(results);
            $("#wait_pacientes").hide();
        }
     });
});

$( "#link_mp_cli_amigo" ).click(function() {
	  var id = <?php echo $id?>;
	  var regional = '<?php echo $regional?>';
	  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
	  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
	  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
	  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	  var dados = 'mp';
	    $("#wait_cli_amigo").show();
	    $("#div_cli_amigo").hide();
	    $("#ma_cli_amigo" ).removeClass( "active" );
	    $("#mp_cli_amigo" ).addClass( "active" );
	    $.ajax({
	    url: '../panels/panel_cli_amigo.php',
	    type: 'GET',
	    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
	        success: function(results) {
	            //$("#divTabelaClinicas").show();
	            $("#div_cli_amigo").show(); 
	            $("#div_cli_amigo").html(results);
	            $("#wait_cli_amigo").hide();
	        }
	     });
	});
$( "#link_ma_cli_amigo" ).click(function() {
    var id = <?php echo $id?>;
    var regional = '<?php echo $regional?>';
    var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
    var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
    var total_pac  = '<?php echo round($pacientes_ma)  ?>';
    var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
    var dados = 'ma';
    
      $("#wait_cli_amigo").show();
      $("#div_cli_amigo").hide();
      $("#mp_cli_amigo" ).removeClass( "active" );
      $("#ma_cli_amigo" ).addClass( "active" );
      $.ajax({
      url: '../panels/panel_cli_amigo.php',
      type: 'GET',
      data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
            success: function(results) {
              //$("#divTabelaClinicas").show();
              $("#div_cli_amigo").show();
              $("#div_cli_amigo").html(results);
              $("#wait_cli_amigo").hide();
          }
       });
});
$( "#link_mp_cli_amigo_conte" ).click(function() {
	  var id = <?php echo $id?>;
	  var regional = '<?php echo $regional?>';
	  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
	  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
	  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
	  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	  var dados = 'mp';
	    $("#wait_cli_amigo_conte").show();
	    $("#div_cli_amigo_conte").hide();
	    $("#ma_cli_amigo_conte" ).removeClass( "active" );
	    $("#mp_cli_amigo_conte" ).addClass( "active" );
	    $.ajax({
	    url: '../panels/panel_cli_amigo_conte.php',
	    type: 'GET',
	    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
	        success: function(results) {
	            //$("#divTabelaClinicas").show();
	            $("#div_cli_amigo_conte").show(); 
	            $("#div_cli_amigo_conte").html(results);
	            $("#wait_cli_amigo_conte").hide();
	        }
	     });
	});
$( "#link_ma_cli_amigo_conte" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
  var total_pac  = '<?php echo round($pacientes_ma)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'ma';
  
    $("#wait_cli_amigo_conte").show();
    $("#div_cli_amigo_conte").hide();
    $("#mp_cli_amigo_conte" ).removeClass( "active" );
    $("#ma_cli_amigo_conte" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_cli_amigo_conte.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
          success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_cli_amigo_conte").show();
            $("#div_cli_amigo_conte").html(results);
            $("#wait_cli_amigo_conte").hide();
        }
     });
});

$( "#link_mp_cli_amigo_permitido" ).click(function() {
	  var id = <?php echo $id?>;
	  var regional = '<?php echo $regional?>';
	  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
	  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
	  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
	  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	  var dados = 'mp';
	    $("#wait_cli_amigo_permitido").show();
	    $("#div_cli_amigo_permitido").hide();
	    $("#ma_cli_amigo_permitido" ).removeClass( "active" );
	    $("#mp_cli_amigo_permitido" ).addClass( "active" );
	    $.ajax({
	    url: '../panels/panel_cli_amigo_permitido.php',
	    type: 'GET',
	    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
	        success: function(results) {
	            //$("#divTabelaClinicas").show();
	            $("#div_cli_amigo_permitido").show(); 
	            $("#div_cli_amigo_permitido").html(results);
	            $("#wait_cli_amigo_permitido").hide();
	        }
	     });
	});
$( "#link_ma_cli_amigo_permitido" ).click(function() {
var id = <?php echo $id?>;
var regional = '<?php echo $regional?>';
var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
var total_pac  = '<?php echo round($pacientes_ma)  ?>';
var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
var dados = 'ma';

  $("#wait_cli_amigo_permitido").show();
  $("#div_cli_amigo_permitido").hide();
  $("#mp_cli_amigo_permitido" ).removeClass( "active" );
  $("#ma_cli_amigo_permitido" ).addClass( "active" );
  $.ajax({
  url: '../panels/panel_cli_amigo_permitido.php',
  type: 'GET',
  data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
        success: function(results) {
          //$("#divTabelaClinicas").show();
          $("#div_cli_amigo_permitido").show();
          $("#div_cli_amigo_permitido").html(results);
          $("#wait_cli_amigo_permitido").hide();
      }
   });
});


$( "#link_mp_aband" ).click(function() {
	  var id = <?php echo $id?>;
	  var regional = '<?php echo $regional?>';
	  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
	  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
	  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
	  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	  var dados = 'mp';
	    $("#wait_aband").show();
	    $("#div_aband").hide();
	    $("#ma_aband" ).removeClass( "active" );
	    $("#mp_aband" ).addClass( "active" );
	    $.ajax({
	    url: '../panels/panel_aband.php',
	    type: 'GET',
	    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
	        success: function(results) {
	            //$("#divTabelaClinicas").show();
	            $("#div_aband").show(); 
	            $("#div_aband").html(results);
	            $("#wait_aband").hide();
	        }
	     });
	});
$( "#link_ma_aband" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
  var total_pac  = '<?php echo round($pacientes_ma)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'ma';
  
    $("#wait_aband").show();
    $("#div_aband").hide();
    $("#mp_aband" ).removeClass( "active" );
    $("#ma_aband" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_aband.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
          success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_aband").show();
            $("#div_aband").html(results);
            $("#wait_aband").hide();
        }
     });
});


$( "#link_mp_aproveitamento" ).click(function() {
	  var id = <?php echo $id?>;
	  var regional = '<?php echo $regional?>';
	  var media_pac_regional =  '<?php echo round($pacientes_regional_mp)?>';
	  var media_pac_nacional =  '<?php echo round($pacientes_nacional_mp)?>';
	  var total_pac  = '<?php echo round($total_pac_mp)  ?>';
	  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
	  var dados = 'mp';
	    $("#wait_aproveitamento").show();
	    $("#div_aproveitamento").hide();
	    $("#ma_aproveitamento" ).removeClass( "active" );
	    $("#mp_aproveitamento" ).addClass( "active" );
	    $.ajax({
	    url: '../panels/panel_aproveitamento.php',
	    type: 'GET',
	    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
	        success: function(results) {
	            //$("#divTabelaClinicas").show();
	            $("#div_aproveitamento").show(); 
	            $("#div_aproveitamento").html(results);
	            $("#wait_aproveitamento").hide();
	        }
	     });
	});
$( "#link_ma_aproveitamento" ).click(function() {
  var id = <?php echo $id?>;
  var regional = '<?php echo $regional?>';
  var media_pac_regional =  '<?php echo round($pacientes_regional_ma)?>';
  var media_pac_nacional =  '<?php echo round($pacientes_nacional_ma)?>';
  var total_pac  = '<?php echo round($pacientes_ma)  ?>';
  var total_pac_mp  = '<?php echo round($total_pac_mp)  ?>';
  var dados = 'ma';
  
    $("#wait_aproveitamento").show();
    $("#div_aproveitamento").hide();
    $("#mp_aproveitamento" ).removeClass( "active" );
    $("#ma_aproveitamento" ).addClass( "active" );
    $.ajax({
    url: '../panels/panel_aproveitamento.php',
    type: 'GET',
    data: {id: id, regional:regional, media_pac_regional:media_pac_regional,media_pac_nacional:media_pac_nacional,total_pac:total_pac, total_pac_mp:total_pac_mp,dados:dados},
          success: function(results) {
            //$("#divTabelaClinicas").show();
            $("#div_aproveitamento").show();
            $("#div_aproveitamento").html(results);
            $("#wait_aproveitamento").hide();
        }
     });
});
	
</script>