<?php

function session_checker(){

	if(!isset($_SESSION['nome'])){

		header ("Location:login.php");

		exit(); 
	}
}

function verifica_email($EMAIL){

    list($User, $Domain) = explode("@", $EMAIL);
    $result = @checkdnsrr($Domain, 'MX');

    return($result);

}
function colorPanel($valor,$media_nacional,$media_regional){
	$color = 'red';
	if (($valor > $media_regional) | ($valor > $media_nacional)) $color = 'yellow';
	if (($valor > $media_regional) && ($valor > $media_nacional)) $color = 'green';
	return ($color);
}
function colorPanelInverso($valor,$media_nacional,$media_regional){
	$color = 'red';
	if (($valor < $media_regional) | ($valor < $media_nacional)) $color = 'yellow';
	if (($valor < $media_regional) && ($valor < $media_nacional)) $color = 'green';
	return ($color);
}

function colorPanel2($valor,$media_nacional,$media_regional){
	$color = 'danger';
	if (($valor > $media_regional) | ($valor > $media_nacional)) $color = 'warning';
	if (($valor > $media_regional) && ($valor > $media_nacional)) $color = 'success';
	return ($color);
}
function colorPanelInverso2($valor,$media_nacional,$media_regional){
	$color = 'danger';
	if (($valor < $media_regional) | ($valor < $media_nacional)) $color = 'warning';
	if (($valor < $media_regional) && ($valor < $media_nacional)) $color = 'success';
	return ($color);
}

function sobTotalPaciente($valor,$total_pacientes){
	$resultado = round($valor * 100 / $total_pacientes,2);
	return $resultado;
}


function seta($valormespassado,$valormesatual){
	if ($valormesatual > $valormespassado)
		$resultado = 'up';
	else $resultado = 'down';
	return $resultado;
	
}

function setaInversa($valormespassado,$valormesatual){
	if ($valormesatual > $valormespassado)
		$resultado = 'down';
	else $resultado = 'up';
	return $resultado;

}

 function montaPanel($label,$var_mespassado,$var_mesatual,$var_regional,$var_nacional,$var_parcial_mp,
 		$icon,$flag,$total_pac_mes_passado,$pacientes_mes_parcial,$data_inclusao_mp,$pacientes_nacional,$pacientes_regional){
 	global $estado;
 	

 	if (($flag == 'normal') || ($flag == 'invertido') ||  ($flag == 'ma-invertido')||  ($flag == 'mp-invertido')|| ($flag == 'ma')){
	$porc_mp = round(($var_mespassado * 100)/$total_pac_mes_passado,1);
	$porc_parcial_mes = round( $var_mesatual * 100 / $pacientes_mes_parcial,1);
	$porc_pmp = round( $var_parcial_mp * 100 / $total_pac_mes_passado,1);
	
	//CALULANDO PORCENTAGEM REGIONAL E NACIONAL
	$porc_regional = round(($var_regional * 100)/$pacientes_regional,1);
	$porc_nacional = round(($var_nacional * 100)/$pacientes_nacional,1);
	
 	}
 	
 	elseif (($flag == 'aproveitamento')|($flag == 'aproveitamento-mp') ){
 		
 		$porc_mp = round($var_mespassado,1);
 		$porc_pmp = round( $var_parcial_mp * 100 / $total_pac_mes_passado,1);
 		$porc_parcial_mes = round($var_mesatual,1);
 		//CALULANDO PORCENTAGEM REGIONAL E NACIONAL
 		$porc_regional = round($var_regional,1);
 		$porc_nacional = round($var_nacional,1);
 	
 	} 
 	
 	else {
 		
 	$porc_mp = round(($var_mespassado)/$total_pac_mes_passado,1);
 	$porc_parcial_mes = round( $var_mesatual  / $pacientes_mes_parcial,1);
 	$porc_pmp = round( $var_parcial_mp * 100 / $total_pac_mes_passado,1);
 	
 	
 	//CALULANDO PORCENTAGEM REGIONAL E NACIONAL
 	$porc_regional = round(($var_regional )/$pacientes_regional,1);
 	$porc_nacional = round(($var_nacional )/$pacientes_nacional,1);
 	}
 	
	$labellink = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $label ) );
	//modal cliente amigo
	if (($label=='Indicações')||($label=='Contemplações')||($label=='Permitidos'))
		$labellink = 'cliente_amigo';
	if (($label=='Total')||($label=='Agendados')||($label=='Atendidos'))
		$labellink = 'faltosos';
	if (($label=='FM Pagantes')||($label=='Não Pagantes'))
		$labellink = 'fm';
		
	$labellink = mb_strtolower($labellink);
	$labellink = str_replace(" ", "_", $labellink);
	/*if ($label=='orcamentos') 
		$label ='Orçamentos';*/
	$color = 'red';
	

	
	if (($flag == 'normal')||($flag == 'valor')) {	
				
		
		if (($porc_mp > $porc_regional) | ($porc_mp > $porc_nacional)) $color = 'yellow';
		if (($porc_mp > $porc_regional) && ($porc_mp > $porc_nacional)) $color = 'green';
		
		if ($porc_parcial_mes > $porc_mp)
			$seta = 'up';
		else $seta = 'down';
		
	}
	
	elseif ($flag == 'ma'){
		
		if (($porc_parcial_mes > $porc_regional) | ($porc_parcial_mes > $porc_nacional)) $color = 'yellow';
		if (($porc_parcial_mes > $porc_regional) && ($porc_parcial_mes > $porc_nacional)) $color = 'green';
		
		if ($porc_parcial_mes > $porc_pmp)
			$seta = 'up';
		else $seta = 'down';
		
	}
	elseif ($flag == 'ma-invertido'){
	
		if (($porc_parcial_mes > $porc_regional) | ($porc_parcial_mes > $porc_nacional)) $color = 'yellow';
		if (($porc_parcial_mes > $porc_regional) && ($porc_parcial_mes > $porc_nacional)) $color = 'green';
	
		if ($porc_parcial_mes > $porc_mp)
			$seta = 'up';
		else $seta = 'down';	
	}
	elseif ($flag == 'mp-invertido'){
	
		if (($porc_parcial_mes > $porc_regional) | ($porc_parcial_mes > $porc_nacional)) $color = 'yellow';
		if (($porc_parcial_mes > $porc_regional) && ($porc_parcial_mes > $porc_nacional)) $color = 'green';
	
		if ($porc_parcial_mes > $porc_mp)
			$seta = 'up';
		else $seta = 'down';
	}
	elseif ($flag == 'valor-invertido'){
	
		if (($porc_parcial_mes < $porc_regional) | ($porc_parcial_mes < $porc_nacional)) $color = 'yellow';
		if (($porc_parcial_mes < $porc_regional) && ($porc_parcial_mes < $porc_nacional)) $color = 'green';
	
		if ($porc_parcial_mes < $porc_mp)
			$seta = 'up';
		else $seta = 'down';
	}
	
		
 	else {
		$color = 'red';
		if (($porc_mp < $porc_regional) | ($porc_mp < $porc_nacional)) $color = 'yellow';
		if (($porc_mp < $porc_regional) && ($porc_mp < $porc_nacional)) $color = 'green';
	
		if ($porc_parcial_mes < $porc_mp)
			$seta = 'up';
		else $seta = 'down';
		}	
		
		$bandeira = array(
				'AM'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Bandeira_do_Amazonas.svg/125px-Bandeira_do_Amazonas.svg.png',
				'DF'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Bandeira_do_Distrito_Federal_%28Brasil%29.svg/125px-Bandeira_do_Distrito_Federal_%28Brasil%29.svg.png',
				'BA'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/28/Bandeira_da_Bahia.svg/125px-Bandeira_da_Bahia.svg.png',
				'BR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Flag_of_Brazil.svg/125px-Flag_of_Brazil.svg.png',
				'ES'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/4/43/Bandeira_do_Esp%C3%ADrito_Santo.svg/125px-Bandeira_do_Esp%C3%ADrito_Santo.svg.png',
				'GO'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Bandeira_de_Goi%C3%A1s.svg/125px-Bandeira_de_Goi%C3%A1s.svg.png',
				'MG'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Bandeira_de_Minas_Gerais.svg/125px-Bandeira_de_Minas_Gerais.svg.png',
				'PR'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Bandeira_do_Paran%C3%A1.svg/125px-Bandeira_do_Paran%C3%A1.svg.png',
				'RJ'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Bandeira_da_cidade_do_Rio_de_Janeiro.svg/125px-Bandeira_da_cidade_do_Rio_de_Janeiro.svg.png',
				'RS'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/6/63/Bandeira_do_Rio_Grande_do_Sul.svg/125px-Bandeira_do_Rio_Grande_do_Sul.svg.png',
				'SC'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Bandeira_de_Santa_Catarina.svg/125px-Bandeira_de_Santa_Catarina.svg.png',
				'SP'=>'http://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Bandeira_do_estado_de_S%C3%A3o_Paulo.svg/125px-Bandeira_do_estado_de_S%C3%A3o_Paulo.svg.png'
		);

		$meses = array(
				'01'=>'Jan',
				'02'=>'Fev',
				'03'=>'Mar',
				'04'=>'Abr',
				'05'=>'Mai',
				'06'=>'Jun',
				'07'=>'Jul',
				'08'=>'Ago',
				'09'=>'Set',
				'10'=>'Out',
				'11'=>'Nov',
				'12'=>'Dez'
		);
		
		$mespassado =  $meses[date ('m', strtotime(date('Y-m')." -1 month"))].'/'.date ('Y', strtotime(date('Y-m')." -1 month"));
		$mesatual = $meses[date ('m', strtotime(date('Y-m')))].'/'.date ('Y', strtotime(date('Y-m')));
		
		?>
                    <div class="clearfix"></div>
                    <div class="panel panel-<?php echo $color;?>">
                       <a data-toggle="modal" data-target="#modal_<?php echo $labellink ?>" href="#modal_<?php echo $labellink ?>" id="button_<?php echo $labellink ?>">
                            <div class="panel-footer">
                                <span class="pull-right"><i class="fa fa-arrow-circle-right">&nbsp</i></span>
                                <span class="pull-left"><i class="fa <?php echo $icon ?> fa-2x"  data-toggle="tooltip" data-placement="right" title="<?php echo $label ?>"></i></span>
                                <span class="pull-left" style="margin-top: 3px;" >&nbsp<strong><?php echo $label.' • '.''; ?>&nbsp<?php if (($flag == 'ma')|($flag == 'ma-invertido')) echo strtoupper($mesatual); else echo strtoupper($mespassado); ?> </strong></span>
                              <div class="clearfix"></div>
                            </div>
                        </a>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 tooltip-demo">
                                <div class="huge">   <?php  if  ($flag != 'normal')   {  if ($flag != 'invertido') {  if ($flag != 'aproveitamento-mp')  {?>
                                        <i style="font-size:medium;" class="fa fa-arrow-<?php echo $seta?>" data-toggle="tooltip" data-placement="top" 
                                        title="Valores em <?php echo date('d/m/y', strtotime($data_inclusao_mp))  ;?>: <?php echo $porc_pmp ?>% e <?php echo $var_parcial_mp.' '.$label?>"></i>
                                        <?php  } }}?>
                                        <?php if (($flag != 'aproveitamento')&&($flag != 'aproveitamento-mp')){?>
                                    <b data-toggle="tooltip" data-placement="bottom" title="<?php if (($flag != 'valor')) echo 'Porcentagem'; else echo "Valor";?> de <?php echo $label; ?>
                                     Sob o Total de Pacientes">

                                     <?php  if ($flag != 'ma') echo $porc_mp;
                                  	   else echo $porc_parcial_mes; ?>
                                     <?php if ($flag != 'valor') echo '%';
                                 	    else echo 'R$'; ?></b>
                                      <?php }
                                      else {?>
                                       <b data-toggle="tooltip" data-placement="bottom" title="Porcentagem de Inícios 
                                     Sob o Total de Orçamentos" ><?php  if ($flag != 'ma') echo $porc_mp; else echo $porc_parcial_mes; ?>%</b>
                                        <?php } ?>

                                      </div>
                                      <?php if (($flag != 'aproveitamento')&&($flag != 'aproveitamento-mp'))  { ?>
                                      <div><strong><font size="+1"  data-toggle="tooltip" data-placement="bottom" title="Total de <?php echo $label?>"> <?php  if ($flag != 'ma') echo round($var_mespassado); else echo round($var_mesatual)?></font></strong>
                                      <font size="1px"> <?php echo $label?> </font>
                                    </div>
                                    <?php }?>
                               </div>
                                <div class="col-xs-9 text-right tooltip-demo">
                                    <div> <b data-toggle="tooltip" data-placement="left" title="% Média Regional">
                                        <img alt="Média Regional" rel="tooltip" title="Média Regional"  src="<?php echo $bandeira[$estado]?>" width="15%" height="15%">
                                        <font size="+1">  <?php echo  $porc_regional; ?><?php if ($flag != 'valor') echo '%'; else echo ' R$'; ?></font>
                                         </b>
                                        <b data-toggle="tooltip" data-placement="top" title="Valor Médio Regional">
                                       <small> <?php  if ($flag != 'aproveitamento') echo '('.round($var_regional).')'?></small></b>
                                    </div>
                                    <div> <b data-toggle="tooltip" data-placement="left" title="% Média Nacional">
                                        <img alt="Média Nacional" rel="tooltip" title="Média Nacional"  src="<?php echo $bandeira['BR']?>" width="15%" height="15%">  
                                        <font size="+1"> 
                                         <?php if (($flag != 'valor')&&($flag != 'valor-invertido')) echo $porc_nacional.'%';
                                          else  echo 'R$' . number_format($porc_nacional  , 2, ',', '.'); ?>
                                         </font>
                                        </b>
                                        <b data-toggle="tooltip" data-placement="top" title="Valor Médio Nacional">
                                        <small><?php if ($flag != 'aproveitamento') echo '('.round($var_nacional).')'?></small></b>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<?php
}



