<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createAutoload {
	private $obj;

	function __construct (Config $obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/rest')) mkdir('../src/rest');
		
		$fp = fopen("../src/rest/autoload.php", "a");
		
		$text = "<?php\n";
		
		// escreve documentação
		$text .= "/*\n";
		$text .= "	Projeto: ".$obj->doc['projeto'].".\n";
		$text .= "	Project Owner: ".$obj->doc['po'].".\n";
		if(!empty($obj->doc['equipe'])) {
			foreach ($obj->doc['equipe'] as $key) {
				$text .= "	".$key['funcao'].": ".$key['nome'].".\n";
			}
		}
		$text .= "	Data de início: ".$obj->doc['datainicio'].".\n";
		$text .= "	Data Atual: ".$obj->doc['dataatual'].".\n"; 
		$text .= "*/\n\n";

		$text .= "//Trata requisição\n";
		$text .= "if(!\$_POST){\n";
		$text .= "	if(\$_GET) {\$_POST = \$_GET;}\n";
		$text .= "	else{\$_POST =  file_get_contents ( 'php://input' );}";
		$text .= "}\n\n";

		$text .= "// conexao\n";
		$text .= "require_once(\"../util/Conexao.php\");\n\n";

		$text .= "// carrega class\n";
		$text .= "function carregaClasses(\$class){\n";
		$text .= "	//Verifica se existe Control no nome da classe\n";
		$text .= "	if(strrpos(\$class, \"Control\")) {\n";
		$text .= "		require_once(\"../control/\".\$class.\".php\");\n";
		$text .= "	//Verifica se existe DAO no nome da classe\n";
		$text .= "	}else if(strrpos(\$class, \"DAO\")) {\n";
		$text .= "		\$bean = strtolower(substr(\$class, 0, strrpos(\$class, \"DAO\")));\n";
		$text .= "		require_once \"../model/\".\$bean.\"/\".\$class.\".php\";\n";
		$text .= " 	//se nao for control ou dao é model\n";
		$text .= " 	}else{\n";
		$text .= "		\$bean = strtolower(\$class);\n";
		$text .= "		require_once \"../model/\".\$bean.\"/\".\$class.\".php\";\n";
		$text .= "	}\n";
		$text .= "}\n\n";

		$text .= "//chama autoload\n";
		$text .= "spl_autoload_register(\"carregaClasses\");\n";
		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";
		$text .= "?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
}

?>