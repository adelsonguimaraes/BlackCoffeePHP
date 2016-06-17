<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createRest {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/rest')) mkdir('../src/rest');
		
		$fp = fopen('../src/rest/'.$obj['table']['name'].".php", "a");
		
		$text = "<?php\n";

		$text .= "// rest : ".$obj['table']['name']."\n\n";

		// escreve documentação
		$text .= "/*\n";
		$text .= "	Projeto: ".$obj['doc']['projeto'].".\n";
		$text .= "	Project Owner: ".$obj['doc']['po'].".\n";
		if(!empty($obj['doc']['equipe'])) {
			foreach ($obj['doc']['equipe'] as $key) {
				$text .= "	".$key['funcao'].": ".$key['nome'].".\n";
			}
		}
		$text .= "	Data de início: ".$obj['doc']['datainicio'].".\n";
		$text .= "	Data Atual: ".$obj['doc']['dataatual'].".\n"; 
		$text .= "*/\n\n";

		$text .= "//inclui autoload\n";
		$text .= "require_once 'autoload.php';\n\n";

		$text .= "//verifica requisição\n";
		$text .= "switch (\$_POST['metodo']) {\n";
		$text .= "	case 'cadastrar':\n";
		$text .= "		cadastrar();\n";
		$text .= "		break;\n";
		$text .= "	case 'buscarPorId':\n";
		$text .= "		buscarPorId();\n";
		$text .= "		break;\n";
		$text .= "	case 'listar':\n";
		$text .= "		listar();\n";
		$text .= "		break;\n";
		$text .= "	case 'atualizar':\n";
		$text .= "		atualizar();\n";
		$text .= "		break;\n";
		$text .= "	case 'deletar':\n";
		$text .= "		deletar();\n";
		$text .= "		break;\n";
		$text .= "}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeCadastrar ($fp, $obj);
		$this->writeBuscarPorId ($fp, $obj);
		$this->writeListar ($fp, $obj);
		$this->writeAtualizar ($fp, $obj);
		$this->writeDeletar ($fp, $obj);

		$text = "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$text .= "?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}
	
	// metodo cadastrar
	function writeCadastrar ($fp, $obj) {

		$text = "function cadastrar () {\n";
		$text .= "	\$data = \$_POST['data'];\n";
		$attrs = "";
		foreach ($obj['table']['fields'] as $key) {
			// retiramos o id, datacadastro e dataedicao do metodo
			if($key['Field'] != "id" && $key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				// se for chave estrangeira
				if(!empty($key['fk'])) {
					$attrs .= "		new ".ucfirst($key['fk'])."(\$data['".$key['Field']."']),\n";
				}else{
					$attrs .= "		\$data['".$key['Field']."'],\n";
				}
			}
		}
		$attrs = substr($attrs, 0, -2);
		$text .= "	\$obj = new ".$obj['table']['name']."(\n";
		$text .= "		NULL,\n";
		$text .= 		$attrs."\n";
		$text .= "	);\n";
		$text .= "	\$control = new ".ucfirst($obj['table']['name'])."Control(\$obj);\n";
		$text .= "	\$id = \$control->cadastrar();\n";
		$text .= "	echo \$id;\n";
		$text .= "}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	// buscar por id
	function writeBuscarPorId ($fp, $obj) {
		$text = "function buscarPorId () {\n";
		$text .= "	\$data = \$_POST['data'];\n";
		$text .= "	\$control = new ".ucfirst($obj['table']['name'])."Control(new ".ucfirst($obj['table']['name'])."(\$data['id']));\n";
		$text .= "	\$obj = \$control->buscarPorId();\n";
		$text .= "	if(!empty(\$obj)) {\n";
		$text .= "		echo json_encode(\$obj);\n";
		$text .= "	}\n";
		$text .= "}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	// listar
	function writeListar ($fp, $obj) {
		$text = "function listar () {\n";
		$text .= "	\$control = new ".ucfirst($obj['table']['name'])."Control(new ".ucfirst($obj['table']['name']).");\n";
		$text .= "	\$lista = \$control->listar();\n";
		$text .= "	if(!empty(\$lista)) {\n";
		$text .= "		echo json_encode(\$lista);\n";
		$text .= "	}\n";
		$text .= "}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	// atualizar
	function writeAtualizar ($fp, $obj) {
		$text = "function atualizar () {\n";
		$text .= "	\$data = \$_POST['data'];\n";
		$attrs = "";
		foreach ($obj['table']['fields'] as $key) {
			// retiramos a data de edicao do metodo
			if($key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				// se for chave estrangeira
				if(!empty($key['fk'])) {
					$attrs .= "		new ".ucfirst($key['fk'])."(\$data['".$key['Field']."']),\n";
				}else{
					$attrs .= "		\$data['".$key['Field']."'],\n";
				}
			}
		}
		$attrs = substr($attrs, 0, -2);
		$text .= "	\$obj = new ".ucfirst($obj['table']['name'])."(\n";
		$text .= 		$attrs."\n";
		$text .= "	);\n";
		$text .= "	\$control = new ".ucfirst($obj['table']['name'])."Control(\$obj);\n";
		$text .= "	\$id = \$control->atualizar();\n";
		$text .= "	echo \$id;\n";
		$text .= "}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	// deletar
	function writeDeletar ($fp, $obj) {
		$text = "function deletar () {\n";
		$text .= "	\$data = \$_POST['data'];\n";
		$text .= "	\$banco = new ".ucfirst($obj['table']['name'])."();\n";
		$text .= "	\$banco->setId(\$data['id']);\n";
		$text .= "	\$control = new ".ucfirst($obj['table']['name'])."Control(\$banco);\n";
		$text .= "	echo \$control->deletar();\n";
		$text .= "}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

}
?>