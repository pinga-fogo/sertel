<?php

include('PHPExcel.php');
include('../conexoes.inc.php');
/*
$bd_user = "banco";
$bd_pass = "BdSertel";
$link = "172.16.0.33";

$conn = mysql_connect($link, $bd_user, $bd_pass);
mysql_select_db("sertelsms", $conn);
*/

$condicao_extra = '';
$tabela_extra = '';

$campos = array(
	 "data",
	 "origem",
	 "nomeCampanha",
	 "mensagem", 
	 "nomeAgendamento",
	 "USUARIOS.NOME"
	);

//para cada campo, gerar o título
$titulos = array();
foreach ($campos as $campo){
	
	switch($campo){
		case "data":
			$titulo = 'Data';		 
		break;
		case "origem":
			$titulo = 'Origem';
		break;
		case "nomeCampanha":
			$titulo = 'Nome da Campanha';
		break;
		case "nomeAgendamento":
			$titulo = 'Nome do Agendamento';
		break;
		case "USUARIOS.NOME":
			$titulo = 'Usuário';
		break;
		case "mensagem":
			$titulo = 'Mensagem';
		break;
	}

	array_push($titulos, $titulo);
}


//Se quiser o nome do usuário
if(in_array('USUARIOS.NOME', $campos)){
	$condicao_extra .= " USUARIOS.ID = CaixaEntrada.idUsuario ";
	$tabela_extra .= "USUARIOS";
}

$condicao_extra .= ($condicao_extra != '' ? 'AND' : '')." CaixaEntrada.mensagem LIKE '%sim%' ";

$texto_campos = implode(',', $campos);

$query = "SELECT $texto_campos 
	  FROM $tabela_extra, CaixaEntrada ".($condicao_extra != '' ? 'WHERE '.$condicao_extra : '');





$result = mysql_query($query);

if(!$result){
	echo mysql_error();
}

var_dump($query);

$nome_arquivo = './arquivo'.date('dmYhmi').'.csv';
$handle = fopen($nome_arquivo,'w');

//pen dura a primeira linha
fputcsv($handle, $titulos, ',');

while($linha  = mysql_fetch_assoc($result) ){
	
	foreach($linha as $key=>$campo){
		
		if(is_numeric($key)){
			unset($linha[$key]);
		} else {
			$linha[$key] = utf8_encode($campo); 
		}
	}
	$linha['data'] = date('d/m/Y h:i:s', strtotime($linha['data'])); 
	fputcsv($handle, $linha, ',');	
}

fclose($handle);

//Início da parte do PHPExcel
$objReader = new PHPExcel_Reader_CSV();
$objPHPExcel = $objReader->load($nome_arquivo);

//Estilizar primeira linha
$linha = $objPHPExcel->getActiveSheet()->getRowIterator(1)->current();
$count = 0;

$cellIterator = $linha->getCellIterator();
$cellIterator->setIterateOnlyExistingCells(true);


$estilo = array(
	 'fill'=>array(
	 	'type'=> PHPExcel_Style_Fill::FILL_SOLID,
		'color'=> array('rgb'=>'66ccff') 
 	 ), 'alignment'=>array(
	    	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	    )
	);


foreach($cellIterator as $celula){
	$celula->getStyle()->applyFromArray($estilo);
}

//aujdas tamanho de todas as linhas e colunas
$maior_linha = $objPHPExcel->getActiveSheet()->getHighestRow();
$maior_coluna  = $objPHPExcel->getActiveSheet()->getHighestColumn();

echo 'Maior Linha: '.$maior_linha.'\r\n';
echo 'Maior Coluna '.$maior_coluna.'\r\n';

for($i = 1; $i <= $maior_linha; $i++){
	$linha = $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(15);	
}

for($j = 'A'; $j <= $maior_coluna; $j++){
 	$coluna = $objPHPExcel->getActiveSheet()->getColumnDimension($j)->setWidth(24);
}

//centralizar todo o arquivo
$objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$objWriter->save("testando.xls");

$arquivo = "testando.xls";
if(file_exists('./'.$arquivo)){
header("Content-Type: application/force-download");
header("Content-Description: File Transfer");
header("Content-Disposition, attachment; filename='".basename($arquivo)."'");
header("Content-Transfer-Encoding : binary");



	readfile('./'.$arquivo);
}



//mysql_close($conn);

?>
