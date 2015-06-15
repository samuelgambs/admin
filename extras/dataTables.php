<?php

require_once '../dadosconexao.php';
$buscaAgendadosAssiduos = "SELECT b.NomeFantasia, 
								  a.ASSIDUOS_A1,
								  a.ASSIDUOS_A2,
								  a.ASSIDUOS_PORC,
								  a.DATA_INCLUSAO 
						     FROM cli_agendados_assiduos as a
					   INNER JOIN ap_clinicas as b
						   	   ON substring(b.CNPJ,1,8) = a.INSCRICAO
							WHERE a.data_inclusao = (SELECT max(b.data_inclusao)
													   FROM cli_agendados_assiduos b
													  WHERE b.inscricao = a.inscricao)";


/* 
$output = array(
		"sEcho" => 10,
		"iTotalRecords" => 14,
		"iTotalDisplayRecords" => 14,
		"aaData" => array()
);

$row = array();

$row[0]	 = "GOIANIA";
$row[1]	 = "2,90 / 1,0";
$row[2]	 = "2";
$row[3]	 = "ASDFASDF" ;
$row[4]	 = "1";
$row[5]	 = "ASDFASDAFSD";
$row[6]	 = "ASDFASDAFSD";
$row[7]	 = "ASDFASDAFSD";

$output['aaData'][0] = $row;

$row[0]	 = "ANAPOLIS";
$row[1]	 = "0,89";
$row[2]	 = "55";
$row[3]	 = "ASDFASDF" ;
$row[4]	 = "3";
$row[5]	 = "ASDFASDAFSD";

$output['aaData'][1] = $row;


$row[0]	 = "ANAPOLIS";
$row[1]	 = "2,89";
$row[2]	 = "90";
$row[3]	 = "ASDFASDF" ;
$row[4]	 = "3";
$row[5]	 = "ASDFASDAFSD";

$output['aaData'][2] = $row;

echo json_encode($output); */
	
$queryAgendadosAssiduos = mysql_query($buscaAgendadosAssiduos);
$arrayAgendadosAssiduos = mysql_fetch_array($queryAgendadosAssiduos);
$num = mysql_affected_rows();
echo $num;

$output = array(
		"sEcho" => $num,
		"iTotalRecords" => $num,
		"iTotalDisplayRecords" => $num,
		"aaData" => array()
);
$x = 0;
while ($rowBuscaAgendados = mysql_fetch_array($queryAgendadosAssiduos))

{
			$row = array();
			$row[0]	 = $rowBuscaAgendados['NomeFantasia'];
			$row[1]	 = $rowBuscaAgendados['ASSIDUOS_A1'];
			$row[2]	 = $rowBuscaAgendados['ASSIDUOS_A2'];
			$row[3]	 = "3";
			$row[4]	 = "4";
			$row[5]	 = "5";
			$row[6]	 = "6";
			$row[7]	 = "7";
			$output['aaData'][$x] = $row;
			$x++;
			echo json_encode($output);
		}
?>