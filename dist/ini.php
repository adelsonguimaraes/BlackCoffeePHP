<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

//rquisições de classes
require_once ("config.php");
require_once ("createConnection.php");
require_once ("createAutoload.php");
require_once ("createModel.php");
require_once ("createDAO.php");
require_once ("createControl.php");
require_once ("createRest.php");
require_once ("createTeste.php");
require_once ("createIndexTeste.php");

if(!$_POST){
	if($_GET) {$_POST = $_GET;}
	else{$_POST =  json_decode(file_get_contents ( 'php://input' ), true);}
}

// ini
$data = $_POST['data'];

$obj = createObj($data);

switch ($data['metodo']) {
	case 'verificaConexao':
		verificaConexao($obj);
		break;
	case 'verificaDiretorio':
		verificaDiretorio($obj);
		break;
	case 'criarModel':
		criarModel($obj);
		break;
	case 'criarDAO':
		criarDAO($obj);
		break;
	case 'criarControl':
		criarControl($obj);
		break;
	case 'criarRest':
		criarRest($obj);
		break;
	case 'criarTeste':
		criarTeste($obj);
		break;
	case 'criarIndexTeste':
		criarIndexTeste($obj);
		break;
	case 'criarAutoload':
		criarAutoload($obj);
		break;
	case 'criarConexao':
		criarConexao($obj);
		break;
}

function createObj ($data) {
	return new Config (
		$data['host'], //host
		$data['user'], //usuario
		$data['senha'], //senha
		$data['banco'], //banco
		$data['table'], // table
		$data['doc'] //doc
	);
}

function verificaConexao ($obj) {
	$con = @mysqli_connect($obj->host, $obj->user, $obj->senha, $obj->banco);
	
	if (!$con) {
		die(json_encode(array("success"=>false, "msg"=>"Hove erro de comunicação com o banco de dados!")));
	}

	$sql = sprintf("SELECT TABLE_NAME as 'table' FROM information_schema.TABLES t where t.TABLE_SCHEMA = '%s'", $obj->banco);

	$result = mysqli_query($con, $sql);

	if(!$result) {
		die("Erro: " . mysqli_error($con));
	}

	while ($row = mysqli_fetch_object($result)) {

		$table = array("name"=>$row->table, "fields"=>array());

		$sql = "SHOW COLUMNS FROM " . $table['name'];

		$resultColls = mysqli_query($con, $sql);

		if(!$resultColls) {
			die("Erro " . mysqli_error($con));
		}

		while ($row2 = mysqli_fetch_object($resultColls)) {
			$sql = sprintf("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '%s' AND TABLE_NAME = '%s' AND REFERENCED_TABLE_NAME IS NOT NULL", $obj->banco, $table['name']);
			$resultKeys = mysqli_query($con, $sql);
			if(!$resultKeys) {
				die("Erro " . mysqli_error($con));
			}
			
			while($row3 = mysqli_fetch_object($resultKeys)) {
				if($row3->COLUMN_NAME == $row2->Field) {
					$row2->fk = $row3->REFERENCED_TABLE_NAME;
				}

			}
			array_push($table['fields'], $row2);
		}
		array_push($obj->table, $table);

	}

	echo json_encode(array("success"=>true,"msg"=>"Conexão com o banco de dados estabilizada", "data"=>$obj));
}

function verificaDiretorio ($obj) {
	if(file_exists('../src')) {
		echo json_encode(array("success"=>false,"msg"=>"Diretório \"src\" já existe, apague-o e tente novamente", "data"=>$obj));
	}else{
		echo json_encode(array("success"=>true,"msg"=>"Diretório \"src\" verificado e criado", "data"=>$obj));
	}
}

function criarModel ($obj) {
	foreach ($obj->table as $key) {
		$data = array("table"=>$key, "doc"=>$obj->doc);
		new createModel($data);
	}
	echo json_encode(array("success"=>true,"msg"=>"Analise e criação das Classes \"Model\" finalizado", "data"=>$obj));
}

function criarDAO ($obj) {
	foreach ($obj->table as $key) {
		$data = array("table"=>$key, "doc"=>$obj->doc);
		new createDAO($data);
	}
	echo json_encode(array("success"=>true,"msg"=>"Analise e criação das Classes \"DAO\" finalizado", "data"=>$obj));
}

function criarControl ($obj) {
	foreach ($obj->table as $key) {
		$data = array("table"=>$key, "doc"=>$obj->doc);
		new createControl($data);
	}
	echo json_encode(array("success"=>true,"msg"=>"Analise e criação das Classes \"Control\" finalizado", "data"=>$obj));
}

function criarRest ($obj) {
	foreach ($obj->table as $key) {
		$data = array("table"=>$key, "doc"=>$obj->doc);
		new createRest($data);
	}
	echo json_encode(array("success"=>true,"msg"=>"Analise e criação das Classes \"Rest\" finalizado", "data"=>$obj));
}

function criarTeste ($obj) {
	foreach ($obj->table as $key) {
		$data = array("table"=>$key, "doc"=>$obj->doc);
		new createTeste($data);
	}
	echo json_encode(array("success"=>true,"msg"=>"Analise e criação das classes \"Teste\" finalizado", "data"=>$obj));
}

function criarIndexTeste ($obj) {
	new createIndexTeste($obj);
	echo json_encode(array("success"=>true,"msg"=>"Criação da página \"Home de Testes\"", "data"=>$obj));

}

function criarAutoload ($obj) {
	new createAutoload($obj);
	echo json_encode(array("success"=>true,"msg"=>"Criação da Classe \"Autoload\"", "data"=>$obj));
}

function criarConexao ($obj) {
	new createConnection($obj);
	echo json_encode(array("success"=>true,"msg"=>"Criação da Classe \"Conexão\"", "data"=>$obj));
}



?>