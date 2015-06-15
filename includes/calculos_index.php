<?php

function dividir($dividendo, $divisor) {
	if (!is_int($dividendo) && !is_float($dividendo)) {
		throw new InvalidArgumentException('O dividendo não é um número', 0);
	}
	if (!is_int($divisor) && !is_float($divisor)) {
		throw new InvalidArgumentException('O divisor não é um número', 1);
	}
	if ($divisor == 0) {
		throw new RangeException('Não é possível realizar uma divisão por zero', 0);
	}
	$resultado = $dividendo / $divisor;
	return $resultado;
}

//CALCULANDO PORCENTAGEM DE ORÇAMENTOS DO MES ATUAL E MES ANTERIOR


$porc_orcamentos = round(($orc_mespassado * 100)/$total_pac_mes_passado,2);
$porc_orcamentos_parcial_mes = round( $orc_mesatual * 100 / $pacientes_mes_parcial,2);
//CALULANDO PORCENTAGEM REGIONAL E NACIONAL
$porc_orcamento_regional = round(($orcamento_regional * 100)/$pacientes_regional,2);
$porc_orcamento_nacional = round(($orcamento_nacional * 100)/$pacientes_nacional,2);

//orçamentos x inicios
try {
	$porc_orcamentos_inicios_parcial_mes = dividir(($ini_mesatual * 100), $orc_mesatual);
} catch (InvalidArgumentException $e) {
	$porc_orcamentos_inicios_parcial_mes = 0;

} catch (RangeException $e) {
	$porc_orcamentos_inicios_parcial_mes = 0;
} catch (Exception $e) {
	$porc_orcamentos_inicios_parcial_mes = 0;
}

$porc_orcamentos_inicios = round(($ini_mespassado * 100 /$orc_mespassado),2);
//$porc_orcamentos_inicios_parcial_mes = round($ini_mesatual  * 100 /$orc_mesatual ,2);
$porc_orcamento_inicios_regional = round(($inicio_regional  * 100)/$orcamento_regional,2);
$porc_orcamento_inicios_nacional = round(($inicio_nacional * 100)/$orcamento_nacional,2);

//paccientes

$media_pacientes_regional =  round($pacientes_regional / $num_rows_clinicas_regional );
$media_pacientes_nacional = round ($pacientes_nacional / $num_rows_clinicas_nacional);

//documentacação
                 
$porc_documentacao = round(($total_doc_mes_anterior * 100)/$total_pac_mes_passado,2);
$porc_documentacao_parcial_mes = round($documentacao_mes * 100 / $pacientes_mes_parcial,2);
$porc_documentacao_regional = round(($documentacao_regional * 100)/$pacientes_regional,2);
$porc_documentacao_nacional = round(($documentacao_nacional * 100)/$pacientes_nacional,2) ;
                   
//inicios
$porc_inicio = round(($ini_mespassado * 100)/$total_pac_mes_passado,2);
$porc_inicio_parcial_mes = round($ini_mesatual * 100 / $pacientes_mes_parcial,2);
$porc_inicio_regional = round(($inicio_regional * 100)/$pacientes_regional,2) ;
$porc_inicio_nacional = round(($inicio_nacional * 100)/$pacientes_nacional,2)  ;

 // bloco dos flutuantes 
$porc_flutuantes = round(($flutuantes_mes_passado * 100)/$total_pac_mes_passado,2);
$porc_flutuantes_parcial_mes = round($qtd_flutuantes * 100 / $pacientes_mes_parcial,2);
$porc_flutuantes_regional = round(($total_flutuantes_regional * 100)/$pacientes_regional,2) ;
$porc_flutuantes_nacional = round(($total_flutuantes_nacional * 100)/$pacientes_nacional,2)  ;
                    
                    

// bloco dos agendados faltoso
$porc_flutuantes = round(($flutuantes_mes_passado * 100)/$total_pac_mes_passado,2);
$porc_flutuantes_parcial_mes = round($qtd_flutuantes * 100 / $pacientes_mes_parcial,2);
$porc_flutuantes_regional = round(($total_flutuantes_regional * 100)/$pacientes_regional,2) ;
$porc_flutuantes_nacional = round(($total_flutuantes_nacional * 100)/$pacientes_nacional,2)  ;

//lucro x faciente
$porc_lucro = round($lucro /$total_pac_mes_passado,2);
$porc_lucro_regional = round($total_lucro_regional/$pacientes_regional,2) ;
$porc_lucro_nacional = round($total_lucro_nacional/$pacientes_nacional,2)  ;

/* 
//faltosos agendados

$porc_faltosos_agendados = round(($agendados_faltosos_mp * 100) /$total_pac_mes_passado,2);
$porc_faltosos_agendados_regional = round(($total_agendados_faltosos_regional * 100) /$pacientes_regional,2) ;
$porc_faltosos_agendados_nacional = round(($total_agendados_faltosos_nacional *100) /$pacientes_nacional,2)  ;

//faltosos atendidos

$porc_faltosos_atendidos = round(( $atendidos_faltosos_mp * 100) /$total_pac_mes_passado,2);
$porc_faltosos_atendidos_regional = round(($total_atendidos_faltosos_regional * 100)/$pacientes_regional,2) ;
$porc_faltosos_atendidos_nacional = round(($total_atendidos_faltosos_nacional * 100)/$pacientes_nacional,2)  ; */

//negociacao

$porc_total_a_receber = round($total_a_receber_mp /$total_pac_mes_passado,2 );
$porc_total_a_receber_regional = round($total_a_receber_mp_regional /$pacientes_regional,2) ;
$porc_total_a_receber_nacional = round($total_a_receber_mp_nacional/$pacientes_nacional,2)  ;

$porc_total_em_atraso = round($total_em_atraso_mp /$total_pac_mes_passado,2 );
$porc_total_em_atraso_regional = round($total_em_atraso_mp_regional/$pacientes_regional,2) ;
$porc_total_em_atraso_nacional = round($total_em_atraso_mp_nacional/$pacientes_nacional,2)  ;

$porc_total_pago = round($total_pago_mp /$total_pac_mes_passado,2 );
$porc_total_pago_regional = round($total_pago_mp_regional/$pacientes_regional,2) ;
$porc_total_pago_nacional = round($total_pago_mp_nacional/$pacientes_nacional,2)  ;

 //suspensoes
$porc_suspensao_valor = round(($suspensao_valor_mp  * 100)/$total_pac_mes_passado,2);
$porc_suspensao_quantidade = round(($suspensao_quantidade_mp  * 100)/$total_pac_mes_passado,2);

$porc_suspensao_valor_parcial_mes = round($suspensao_valor * 100 / $pacientes_mes_parcial,2);
$porc_suspensao_quantidade_parcial_mes = round($suspensao_quantidade * 100 / $pacientes_mes_parcial,2);

$porc_suspensao_valor_regional = round(($suspensoes_valor_regional * 100)/$pacientes_regional,2) ;
$porc_suspensao_quantidade_regional = round(($suspensoes_quantidade_regional * 100)/$pacientes_regional,2) ;

$porc_suspensao_valor_nacional = round(($suspensoes_valor_nacional * 100)/$pacientes_nacional,2) ;
$porc_suspensao_quantidade_nacional = round(($suspensoes_quantidade_nacional * 100)/$pacientes_nacional,2) ;
 
//gastos dental
$porc_gastos_dental_mp = ($gastos_dental_mp  / $total_pac_mes_passado);
$porc_gastos_dental_parcial_mes = ($gastos_dental_parcial_mes  / $pacientes_mes_parcial);
$porc_gastos_dental_regional = ($gastos_dental_total_regional /$pacientes_regional) ;
$porc_gastos_dental_nacional = ($gastos_dental_total_nacional / $pacientes_nacional) ;


//CUSTO FUNCIONARIO
$porc_custo_funcionario_mp = ($custo_funcionario_valor_mp / $total_pac_mes_passado);
$porc_custo_funcionario_parcial_mes = ($custo_funcionario_valor / $pacientes_mes_parcial);
$porc_custo_funcionario_regional = ($custo_funcionario_valor_regional / $pacientes_regional) ;
$porc_custo_funcionario_nacional = ($custo_funcionario_valor_nacional / $pacientes_nacional) ;


//FALTOSOS

$porc_qtde_faltosos_mp =  round(($qtde_faltosos_mp * 100)  / $total_pac_mes_passado ,2) ;
$porc_qtde_faltosos_parcial_mes = round(($qtde_faltosos_parcial_mes * 100) /  $pacientes_mes_parcial,2) ;
$porc_qtde_faltosos_regional =  round($qtde_faltosos_regional * 100/ $pacientes_regional,2 );
$porc_qtde_faltosos_nacional = round($qtde_faltosos_nacional * 100/ $pacientes_nacional,2 );

//CANCELAMENTO

$porc_cancelamento_ficha_mp =  round($cancelamento_ficha_mp * 100  / $total_pac_mes_passado ,2) ;
$porc_cancelamento_ficha_parcial_mes = round($cancelamento_ficha_parcial_mes * 100 /  $pacientes_mes_parcial,2) ;
$porc_cancelamento_ficha_regional =  round($cancelamento_ficha_regional * 100  / $pacientes_regional,2 );
$porc_cancelamento_ficha_nacional = round($cancelamento_ficha_nacional *100 / $pacientes_nacional,2 );



//INDICAÇÃO CLIENTE AMIGO

$porc_cliente_amigo_total_indic_mp = sobTotalPaciente($cliente_amigo_total_indic_mp, $total_pac_mes_passado);
$porc_cliente_amigo_total_indic_parcial_mes = sobTotalPaciente($cliente_amigo_total_indic_ma, $pacientes_mes_parcial);

$porc_cliente_amigo_total_contemplado_mp = sobTotalPaciente($cliente_amigo_total_contemplado_mp, $total_pac_mes_passado);
$porc_cliente_amigo_total_contemplado_parcial_mes = sobTotalPaciente($cliente_amigo_total_contemplado_ma, $pacientes_mes_parcial);

$porc_cliente_amigo_total_indic_regional = sobTotalPaciente($cliente_amigo_total_indic_regional_mp, $pacientes_regional);
$porc_cliente_amigo_total_indic_nacional = sobTotalPaciente($cliente_amigo_total_indic_nacional_mp, $pacientes_nacional);

$porc_cliente_amigo_total_contemplado_regional = sobTotalPaciente($cliente_amigo_total_contemplado_regional_mp, $pacientes_regional);
$porc_cliente_amigo_total_contemplado_nacional = sobTotalPaciente($cliente_amigo_total_contemplado_nacional_mp, $pacientes_nacional);

//FM FIM DE MENSALIDADE
$porc_fm_mp = sobTotalPaciente($fluxo_fm_mp, $total_pac_mes_passado);
$porc_fm_ma = sobTotalPaciente($fluxo_fm_ma, $pacientes_mes_parcial);
$porc_fm_regional = sobTotalPaciente($fluxo_fm_media_regional_mp, $pacientes_regional);
$porc_fm_nacional = sobTotalPaciente($fluxo_fm_media_nacional_mp, $pacientes_nacional);

//ENTRADA ORTO
$porc_entrada_orto_mp = round($entrada_orto_mp/ $total_pac_mes_passado,2);
$porc_entrada_orto_ma = round($entrada_orto_ma/ $pacientes_mes_parcial,2);
$porc_entrada_orto_regional = round($entrada_orto_media_regional_mp/ $pacientes_regional,2);
$porc_entrada_orto_nacional = round($entrada_orto_media_nacional_mp/ $pacientes_nacional,2);




