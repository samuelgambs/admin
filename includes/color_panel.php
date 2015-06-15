<?php
/* 
//cor dos paneis ORÇAMENTOS
if (($porc_orcamentos > $porc_orcamento_regional) && ($porc_orcamentos > $porc_orcamento_nacional))
{
	$color_panel_orcamentos = 'green';
}

elseif (($porc_orcamentos < $porc_orcamento_regional) && ($porc_orcamentos < $porc_orcamento_nacional)) {
	$color_panel_orcamentos = 'red';
}

else {
	$color_panel_orcamentos = 'yellow';
}

if ($porc_orcamentos > $porc_orcamentos_parcial_mes)
	$arrow = 'down';
else
	$arrow = 'up';
*/
//cor dos paneis ORÇAMENTOS INICIOS
/* if (($porc_orcamentos_inicios > $porc_orcamento_inicios_regional) && ($porc_orcamentos_inicios > $porc_orcamento_inicios_nacional))
{
	$color_panel_orcamentos_inicios = 'green';
}

elseif (($porc_orcamentos_inicios < $porc_orcamento_inicios_regional) && ($porc_orcamentos_inicios < $porc_orcamento_inicios_nacional)) {
	$color_panel_orcamentos_inicios = 'red';
}

else {
	$color_panel_orcamentos_inicios = 'yellow';
}

if ($porc_orcamentos_inicios > $porc_orcamentos_inicios_parcial_mes)
	$arrow_orcamentos_inicios = 'down';
else
	$arrow_orcamentos_inicios = 'up';
 */

/*

//cor dos paneis dOCUMENTAÇÕES
if (($porc_documentacao > $porc_documentacao_regional) && ($porc_documentacao > $porc_documentacao_nacional)){
	$color_panel_documentacao = 'green';
}
elseif (($porc_documentacao < $porc_documentacao_regional) && ($porc_documentacao < $porc_documentacao_nacional)) {
	$color_panel_documentacao = 'red';
}
else{
	$color_panel_documentacao = 'yellow';
}
//
if ($porc_orcamentos > $porc_orcamentos_parcial_mes)
	$arrow_doc = 'down';
	else
		$arrow_doc ='up';
	
	
	//cor dos paneis inicios
	
	
	
	if (($porc_inicio > $porc_inicio_regional) && ($porc_inicio > $porc_inicio_nacional)){
		$color_panel_inicio = 'green';
	}
	elseif (($porc_inicio < $porc_inicio_regional) && ($porc_inicio < $porc_inicio_nacional)) {
		$color_panel_inicio = 'red';
	}
	else{
		$color_panel_inicio = 'yellow';
	}
	
	if ($porc_inicio > $porc_inicio_parcial_mes)
		$arrow_ini = 'down';
	else
		$arrow_ini ='up';	
	
	 */

	//cor dos paneis pacientes
	
	  
	
	if (($total_pac_mes_passado > $media_pacientes_regional) && ($total_pac_mes_passado > $media_pacientes_nacional)){
		$color_panel_pacientes = 'green';
	}
	elseif (($total_pac_mes_passado < $media_pacientes_regional) && ($total_pac_mes_passado < $media_pacientes_nacional)) {
		$color_panel_pacientes = 'red';
	}
	else{
		$color_panel_pacientes = 'yellow';
	}
	
/* 	if ($pacientes_mes_parcial > $total_pac_mes_passado)
		$arrow_pacientes = 'up';
	else
		$arrow_pacientes ='down';
	 */
	
	
	
	//cor dos paneis LUCRO X PACIENTE /*
	
	/* 
	
	if (($porc_lucro > $porc_lucro_regional) && ($porc_lucro > $porc_lucro_nacional)){
		$color_panel_lucro = 'green';
	}
	elseif (($porc_lucro < $porc_lucro_regional) && ($porc_lucro < $porc_lucro_nacional)) {
		$color_panel_lucro = 'red';
	}
	else{
		$color_panel_lucro = 'yellow';
	}	 */
	
	
//cor do painel flutuantes

/* 
	if (($porc_flutuantes < $porc_flutuantes_regional) && ($porc_flutuantes < $porc_flutuantes_nacional)){
		$color_panel_flutuantes = 'green';
	}
	elseif (($porc_flutuantes > $porc_flutuantes_regional) && ($porc_flutuantes > $porc_flutuantes_nacional)) {
		$color_panel_flutuantes = 'red';
	}
	else{
		$color_panel_flutuantes = 'yellow';
	}
	
	if ($porc_flutuantes > $porc_flutuantes_parcial_mes)
		$arrow_flutuantes = 'up';
	else
		$arrow_flutuantes ='down';
	
	 */
	
	//cor do painel suspensao
	/* 
	
	if (($porc_suspensao_quantidade < $porc_suspensao_quantidade_regional) && ($porc_suspensao_quantidade < $porc_suspensao_quantidade_nacional)){
		$color_panel_suspensoes = 'green';
	}
	elseif (($porc_suspensao_quantidade > $porc_suspensao_quantidade_regional) && ($porc_suspensao_quantidade > $porc_suspensao_quantidade_nacional)) {
		$color_panel_suspensoes = 'red';
	}
	else{
		$color_panel_suspensoes = 'yellow';
	}
	
	if ($porc_suspensao_quantidade < $porc_suspensao_quantidade_parcial_mes)
		$arrow_suspensoes = 'up';
	else
		$arrow_suspensoes ='down';	 
 */


	//cor do painel GASTOS DENTAL
	
	
/* 	if (($porc_gastos_dental_mp < $porc_gastos_dental_regional) && ($porc_gastos_dental_mp < $porc_gastos_dental_nacional)){
		$color_panel_gastos_dental = 'green';
	}
	elseif (($porc_gastos_dental_mp > $porc_gastos_dental_regional) && ($porc_gastos_dental_mp > $porc_gastos_dental_nacional)) {
		$color_panel_gastos_dental = 'red';
	}
	else{
		$color_panel_gastos_dental = 'yellow';
	}
	
	if ($porc_gastos_dental_mp > $porc_gastos_dental_parcial_mes)
		$arrow_gastos_dental = 'up';
	else
		$arrow_gastos_dental ='down';	  */

/* 	//cor do painel custo funcionario
	
	
	if (($porc_custo_funcionario_mp < $porc_custo_funcionario_regional) && ($porc_custo_funcionario_mp < $porc_custo_funcionario_nacional)){
		$color_panel_custo_funcionario = 'green';
	}
	elseif (($porc_custo_funcionario_mp > $porc_custo_funcionario_regional) && ($porc_custo_funcionario_mp > $porc_custo_funcionario_nacional)) {
		$color_panel_custo_funcionario = 'red';
	}
	else{
		$color_panel_custo_funcionario = 'yellow';
	}
	
	if ($porc_custo_funcionario_mp > $porc_custo_funcionario_parcial_mes)
		$arrow_custo_funcionario = 'up';
	else
		$arrow_custo_funcionario ='down';	 
	 */
////cor dos paneis FALTOSOS AGENDADOS /
	
	/*
	
	if (($porc_faltosos_agendados > $porc_faltosos_agendados_regional) && ($porc_faltosos_agendados > $porc_faltosos_agendados_nacional)){
		$color_panel_faltosos_agendados = 'green';
	}
	elseif (($porc_faltosos_agendados < $porc_faltosos_agendados_regional) && ($porc_faltosos_agendados < $porc_faltosos_agendados_nacional)) {
		$color_panel_faltosos_agendados = 'red';
	}
	else{
		$color_panel_faltosos_agendados = 'yellow';
	}	
	
 	if ($porc_faltosos_agendados > )
		$arrow_faltosos_agendados = 'up';
	else
		$arrow_faltosos_agendados ='down';
	 
		
/// FALTOSOS ATENDIDOS	
		
	if (($porc_faltosos_atendidos > $porc_faltosos_atendidos_regional) && ($porc_faltosos_atendidos > $porc_faltosos_atendidos_nacional)){
		$color_panel_faltosos_atendidos	 = 'green';
	}
	elseif (($porc_faltosos_atendidos < $porc_faltosos_atendidos_regional) && ($porc_faltosos_atendidos < $porc_faltosos_atendidos_nacional)) {
		$color_panel_faltosos_atendidos = 'red';
	}
	else{
		$color_panel_faltosos_atendidos = 'yellow';
	}	
	/* if ($porc_faltosos_atendidos > $porc_faltosos_atendidos_parcial_mes)
		$arrow_faltosos_atendidos = 'up';
	else
		$arrow_faltosos_atendidos ='down'; 
//
/// FALTOSOS 
	if (($porc_qtde_faltosos_mp < $porc_qtde_faltosos_regional) && ($porc_qtde_faltosos_mp < $porc_qtde_faltosos_nacional)){
		$color_panel_qtde_faltosos	 = 'green';
	}
	elseif (($porc_qtde_faltosos_mp > $porc_qtde_faltosos_regional) && ($porc_qtde_faltosos_mp > $porc_qtde_faltosos_nacional)) {
		$color_panel_qtde_faltosos = 'red';
	}
	else{
		$color_panel_qtde_faltosos = 'yellow';
	}	
	 if ($porc_qtde_faltosos_mp > $porc_qtde_faltosos_parcial_mes)
		$arrow_qtde_faltosos = 'up';
	else
		$arrow_qtde_faltosos ='down'; 
//

/// CANCELAMENTO 
	if (($porc_cancelamento_ficha_mp < $porc_cancelamento_ficha_regional) && ($porc_cancelamento_ficha_mp < $porc_cancelamento_ficha_nacional)){
		$color_panel_cancelamento_ficha	 = 'green';
	}
	elseif (($porc_cancelamento_ficha_mp > $porc_cancelamento_ficha_regional) && ($porc_cancelamento_ficha_mp > $porc_cancelamento_ficha_nacional)) {
		$color_panel_cancelamento_ficha = 'red';
	}
	else{
		$color_panel_cancelamento_ficha = 'yellow';
	}	
	 if ($porc_cancelamento_ficha_mp > $porc_cancelamento_ficha_parcial_mes)
		$arrow_cancelamento = 'up';
	else
		$arrow_cancelamento ='down'; 
//
*/
		
